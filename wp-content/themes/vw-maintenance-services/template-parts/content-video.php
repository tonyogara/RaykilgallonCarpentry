<?php
/**
 * The template part for displaying post
 *
 * @package VW Maintenance Services 
 * @subpackage vw_maintenance_services
 * @since VW Maintenance Services 1.0
 */
?>
<?php 
  $vw_maintenance_services_archive_year  = get_the_time('Y'); 
  $vw_maintenance_services_archive_month = get_the_time('m'); 
  $vw_maintenance_services_archive_day   = get_the_time('d'); 
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;

  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box">
    <?php
      if ( ! is_single() ) {
        // If not a single post, highlight the video file.
        if ( ! empty( $video ) ) {
          foreach ( $video as $video_html ) {
            echo '<div class="entry-video">';
              echo $video_html;
            echo '</div>';
          }
        };
      };
    ?> 
    <div class="new-text">
      <h2 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
      <?php if( get_theme_mod( 'vw_maintenance_services_toggle_postdate',true) != '' || get_theme_mod( 'vw_maintenance_services_toggle_author',true) != '' || get_theme_mod( 'vw_maintenance_services_toggle_comments',true) != '') { ?>
        <div class="post-info">
          <?php if(get_theme_mod('vw_maintenance_services_toggle_postdate',true)==1){ ?>
            <i class="fas fa-calendar-alt"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $vw_maintenance_services_archive_year, $vw_maintenance_services_archive_month, $vw_maintenance_services_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span>|</span>
          <?php } ?>

          <?php if(get_theme_mod('vw_maintenance_services_toggle_author',true)==1){ ?>
            <i class="far fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span>|</span>
          <?php } ?>

          <?php if(get_theme_mod('vw_maintenance_services_toggle_comments',true)==1){ ?>
            <i class="fa fa-comments" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'vw-maintenance-services'), __('0 Comments', 'vw-maintenance-services'), __('% Comments', 'vw-maintenance-services') ); ?> </span>
          <?php } ?>
          <hr>
        </div>
      <?php } ?>
      <div class="entry-content">
        <p>
          <?php $vw_maintenance_services_theme_lay = get_theme_mod( 'vw_maintenance_services_excerpt_settings','Excerpt');
          if($vw_maintenance_services_theme_lay == 'Content'){ ?>
            <?php the_content(); ?>
          <?php }
          if($vw_maintenance_services_theme_lay == 'Excerpt'){ ?>
            <?php if(get_the_excerpt()) { ?>
              <?php $excerpt = get_the_excerpt(); echo esc_html( vw_maintenance_services_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_maintenance_services_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('vw_maintenance_services_excerpt_suffix',''));?>
            <?php }?>
          <?php }?>
        </p>
      </div>
      <?php if( get_theme_mod('vw_maintenance_services_button_text','Read More') != ''){ ?>
        <div class="content-bttn">
          <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('vw_maintenance_services_button_text',__('Read More','vw-maintenance-services')));?><i class="<?php echo esc_attr(get_theme_mod('vw_maintenance_services_blog_button_icon','fa fa-angle-right')); ?>"></i><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('vw_maintenance_services_button_text',__('Read More','vw-maintenance-services')));?></span></a>
        </div>
      <?php } ?>
    </div>
  </div>
</article>