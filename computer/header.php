<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Computer
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php if(is_singular() && pings_open()) { ?>
<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' )); ?>">
<?php } ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	//wp_body_open hook from WordPress 5.2
	if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#sitemain">
	<?php _e( 'Skip to content', 'computer' ); ?>
</a>

<?php
	/*****************************
	** Get Header Top
	*****************************/
	get_template_part('header/header','top');
?>
<header id="header" class="header">
	<div class="container">
		<div class="flex-box">
			<div class="head-left">
				<div class="site-logo">
					<?php if ( has_custom_logo() ) { ?>
						<div class="custom-logo">
							<?php computer_the_custom_logo(); ?>
						</div><!-- cutom logo -->
					<?php } ?>
					<div class="site-title-desc">
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
						</h1>
						<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) :
								echo '<p class="site-description">'.esc_html($description).'</p>';
							endif;
						?>
					</div><!-- site-title-desc -->
				</div><!-- site-logo -->
			</div>
			<?php
				$comhdinfo = get_theme_mod('computer_hide_headinfo','1');
				$comicn1 = get_theme_mod('computer_head_icn1');
				$comsub1 = get_theme_mod('computer_head_sub1');
				$comtxt1 = get_theme_mod('computer_head_main1');
				$comicn2 = get_theme_mod('computer_head_icn2');
				$comsub2 = get_theme_mod('computer_head_sub2');
				$comtxt2 = get_theme_mod('computer_head_main2');
			?>
			<div class="head-right">
				<div class="flex-box">
					<?php if( empty( $comhdinfo ) ) {
						if( !empty( $comicn1 || $comsub1 || $comtxt1 || $comicn2 || $comsub2 || $comtxt2 ) ){
					?>
					<div class="header-info">
						<?php if( !empty( $comicn1 || $comsub1 || $comtxt1 ) ){ ?>
						<div class="header-info-box">
							<?php if( !empty( $comicn1 ) ){ ?>
							<div class="header-info-icon">
								<i class="fa fa-<?php echo esc_attr($comicn1); ?>"></i>
							</div><!-- header info icon -->
							<?php } ?>
							<div class="header-info-text">
								<h5><?php echo esc_html($comsub1); ?></h5>
								<span><?php echo esc_html($comtxt1); ?></span>
							</div><!-- header info text -->
						</div><!-- header info box -->
						<?php } if( !empty( $comicn2 || $comsub2 || $comtxt2 ) ){ ?>
						<div class="header-info-box">
							<?php if( !empty( $comicn2 ) ){ ?>
							<div class="header-info-icon">
								<i class="fa fa-<?php echo esc_attr($comicn2); ?>"></i>
							</div><!-- header info icon -->
							<?php } ?>
							<div class="header-info-text">
								<h5><?php echo esc_html($comsub2); ?></h5>
								<span><?php echo esc_html($comtxt2); ?></span>
							</div><!-- header info text -->
						</div><!-- header info box -->
						<?php } ?>
					</div><!-- header info -->
					<?php } } if( !empty( get_theme_mod('computer_cta_lbl') || get_theme_mod('computer_cta_link') ) ){ ?>
					<div class="header-btn">
						<a href="<?php echo esc_url(get_theme_mod('computer_cta_link'));?>"><?php echo esc_html(get_theme_mod('computer_cta_lbl')); ?></a>
					</div><!-- header btn -->
					<?php } ?>
				</div><!-- flex box -->
			</div><!-- header right -->
			
		</div><!-- flex-box -->
	</div><!-- wrap -->
</header><!-- header -->

<div id="navigation">
	<div class="container">
		<div class="toggle">
			<a class="toggleMenu" href="#"><?php esc_html_e('Menu','computer'); ?></a>
		</div><!-- toggle --> 	
		<nav id="main-navigation" class="site-navigation primary-navigation sitenav" role="navigation">		
			<?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
		</nav>
	</div>
</div><!-- navigation -->