<?php
/**
 * The Top Bar for our theme.
 *
 * Display all information related to top bar
 *
 * @package Computer
 */

$comshwtphd = get_theme_mod('computer_hide_tphead','1');

if( empty( $comshwtphd ) ) {
	
	$getweltxt = get_theme_mod('computer_wel_txt');
?>
	
	<div class="com-top-head">
		<div class="container">
			<div class="flex-box">
				<div class="com-top-left"><p><?php echo esc_html($getweltxt); ?></p></div>
				<div class="com-top-right"><?php wp_nav_menu( array('theme_location' => 'secondary') ); ?></div>
			</div>
		</div>
	</div>
<?php 
}
?>