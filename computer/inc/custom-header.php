<?php
/**
 * @package Computer
 * Setup the WordPress core custom header feature.
 *
 * @uses computer_header_style()

 */
function computer_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'computer_custom_header_args', array(
		'default-text-color'     => 'f69323',
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'computer_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'computer_custom_header_setup' );

if ( ! function_exists( 'computer_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see computer_custom_header_setup().
 */
function computer_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		#header{
			background-image: url(<?php echo esc_url(get_header_image()); ?>);
			background-position: center top;
		}
		h1.site-title a { color:#<?php echo esc_attr(get_header_textcolor()); ?>;}
	<?php endif; ?>	
	</style>
	<?php
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
    <style type="text/css">
		.logo {
			margin: 0 auto;
		}

		h1.site-title,
		p.site-description{
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
    </style>
	
    <?php
	
}
endif; // computer_header_style