<?php
/**
 * The Slider for our theme.
 *
 * Display all information related to slider
 *
 * @package Computer
*/

if (!is_home() && is_front_page()) {

  $computer_hide_slider = get_theme_mod( 'computer_hide_slider', '1' );
  if( $computer_hide_slider == '' ){
    $computer_pages = array();

    for( $sld=1; $sld<4; $sld++ ) {
      $getsld = absint( get_theme_mod( 'slide'.$sld ) );
      if ( 'page-none-selected' != $getsld ) {
        $computer_pages[] = $getsld;
      }
    }

    if( !empty( $computer_pages ) ) :

      $args = array(
        'posts_per_page' => 3,
        'post_type' => 'page',
        'post__in' => $computer_pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) : 
      $sld = 7;
?>
<div id="theme-slider" class="com-slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
      <?php
        $i = 0;
        while ( $query->have_posts() ) : $query->the_post();
          $i++;
          $computer_slideno[] = $i;
          $computer_slidetitle[] = get_the_title();
          $computer_slidedesc[] = get_the_excerpt();
          $computer_slidelink[] = esc_url(get_permalink());
          $image_id = get_post_thumbnail_id();
          $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
          ?>
          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
          <?php
          $getsld++;
        endwhile;
      ?>
    </div><!-- slider wraper -->
    <?php
      $k = 0;
      foreach( $computer_slideno as $computer_sln ){ ?>
      <div id="slidecaption<?php echo esc_attr( $computer_sln ); ?>" class="nivo-html-caption">
        <div class="inner-caption">
          <h2><a href="<?php echo esc_url($computer_slidelink[$k] ); ?>"><?php echo esc_html($computer_slidetitle[$k] ); ?></a></h2>
          <p><?php echo esc_html($computer_slidedesc[$k] ); ?></p>
          <?php if( !empty( get_theme_mod('slide_more',true) ) ){ ?>
          <a class="sliderbtn" href="<?php echo esc_url($computer_slidelink[$k] ); ?>">
            <?php echo esc_html(get_theme_mod('slide_more',__('Read More','computer')));?>
          </a>
          <?php } ?>
        </div><!-- inner caption -->
      </div>
      <?php $k++;
      wp_reset_postdata();
      }
    ?>
  </div><!-- slider -->
</div><!-- computer slider -->
<?php endif;

    endif;

  }

}