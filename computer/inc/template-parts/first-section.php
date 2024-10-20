<?php
/**
 * The Welcome Section for our theme.
 *
 * Display all information related to Welcome section
 *
 * @package Computer
*/

$comhidewel = get_theme_mod( 'computer_hide_fsec','1' );

if( $comhidewel == '' ){
    echo '<section class="welcome-section"><div class="container">';

        $welcttl = get_theme_mod('computer_fsec_ttl','1');
        if( !empty( $welcttl ) ){
          echo '<div class="section_head"><h2 class="section_title">'.esc_html($welcttl).'</h2></div>';
        }
        $welcmore = get_theme_mod('fsec_more');
        if( !empty( $welcmore ) ){
          $shwwelcmore .= '<a href="'.get_the_permalink().'" class="welcome-more">'.esc_html($welcmore).'</a>';
        }

        echo '<div class="flex-box">';
            for( $welcome = 1; $welcome<4; $welcome++ ){
                if( get_theme_mod( 'fsec'.$welcome,true ) !='' ){
                    $abtsecquery = new WP_Query( array( 'page_id' => get_theme_mod( 'fsec'.$welcome ) ) );
                    while( $abtsecquery->have_posts() ) : $abtsecquery->the_post();
                        $shwthumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
                        $image_id = get_post_thumbnail_id();
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        echo '<div class="col"><div class="welcome-box"><div class="inner-welcome-box">';
                            if( has_post_thumbnail() ) {
                              echo '<div class="welcome-box-thumb"><img src="'.$shwthumb[0].'" alt="'.esc_attr($image_alt).'"/></div><!-- welcome box thumb -->';
                            }
                            echo '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3><p>'.get_the_excerpt().'</p>'.$shwwelcmore.'';
                        echo '</div></div></div>';
                    endwhile; wp_reset_postdata();
                }
            }
    echo '</div></div></section>';
}