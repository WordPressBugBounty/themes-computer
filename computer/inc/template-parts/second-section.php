<?php
/**
 * The Second Section for our theme.
 *
 * Display all information related to Second section
 *
 * @package Computer
*/

$computer_hide_intro = get_theme_mod('computer_hide_intro', '1');

if($computer_hide_intro  == '') {

	$computer_intro_more = get_theme_mod('intro_more');
	if( !empty( $computer_intro_more ) ){
	  $shwcomputer_intro_more .= '<a href="'.get_the_permalink().'" class="read-more">'.esc_html($computer_intro_more).'</a>';
	}

	echo '<section class="introduction"><div class="container"><div class="flex-box">';
	if(get_theme_mod('computer_intro') != '') {
		$intro_query = new WP_Query(array('page_id' => get_theme_mod('computer_intro')));

		while( $intro_query->have_posts() ) : $intro_query->the_post();
			if( has_post_thumbnail() ) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
				$url = $src[0];
				$image_id = get_post_thumbnail_id();
				$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			  echo '<div class="thumb"><img src="'.esc_url($url).'" alt="'.esc_attr($image_alt).'"></div><!-- thumb -->';
			}
			echo '<div class="intro-content"><div class="section_head"><h2 class="section_title">'.get_the_title().'</h2></div><p>'.get_the_excerpt().'</p>'.$shwcomputer_intro_more.'</div>';
		endwhile;
	}
	echo '</div></div></section>';
}