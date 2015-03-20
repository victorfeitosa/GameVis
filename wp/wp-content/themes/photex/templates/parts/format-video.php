<?php if(get_post_type() != 'gallery'): ?><article class="post clearfix <?php if(!is_single()){ echo 'row';} ?>"><?php endif; ?>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
        
        <?php tk_video_player($video_link);?>

        <div class="post-author">
          <figure>
            <?php echo get_avatar($post->post_author, 32); ?>
          </figure>
          <span class="roboto-bold-italic"><?php echo get_the_author(); ?></span>
        </div>
        <h1>
          <?php echo get_the_title(); ?>
          <?php if(is_sticky()){ ?><span class="sticky featured-banner"><?php _e('Featured Post', 'tkingdom') ?></span><?php } ?>
        </h1>
        <div class="post-meta">
          <ul>
            <li>
              <strong><?php _e('Category:', 'tkingdom'); ?></strong><?php echo get_the_category_list(', ', $post->ID); ?>
            </li>
            <li>
              <strong><?php _e('Date:', 'tkingdom'); ?></strong><time><?php echo get_the_date(); ?></time>
            </li>
            <li class="meta-comments"><a href="<?php comments_link(); ?>" class="roboto-bold"><?php echo get_comments_number(); ?></a></li>
          </ul>
        </div>
        <div class="shortcodes">
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        </div>

        <?php
        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Gallery page                  */
        /*                                                          */
        /************************************************************/
    }elseif(get_post_type() == 'gallery'){
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        if($video_link){ ?>
            <?php
                $category_filter = "";
                $post_categories = wp_get_post_terms( $post->ID, 'ct_gallery' );
                foreach($post_categories as $post_category){
                    $category_filter[] = $post_category->slug;
                }

                if(!empty($category_filter)) { $category_filter = implode(' ', $category_filter); }
            ?>
            <section class="gallery-item col-lg-3 col-md-4 col-sm-6 isotope-item <?php echo $category_filter; ?>">
              <figure class="img-wrapper">
                <?php
                  $thumb_id = get_post_thumbnail_id();
                  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'gallery-grid', true);
                  $thumb_url = $thumb_url_array[0];
                  $thumb_url_full_array = wp_get_attachment_image_src($thumb_id, 'full', true);
                  $thumb_url_full = $thumb_url_full_array[0];
                ?>
                <?php if($thumb_id){ ?>
                  <img src="<?php echo $thumb_url; ?>" />
                <?php } else { ?>
                  <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                <?php } ?>
              </figure>
              <div class="img-options">
                <div class="btn-wrapper">
                  <a href="<?php echo get_permalink(); ?>">
                    <i class="icon-next"></i>
                  </a>
                  <a href="<?php echo $video_link; ?>" title="<?php echo get_the_title(); ?>" class="fancybox" rel="fancybox-masonry">
                    <i class="icon-play"></i>
                  </a>
                </div>
              </div>
            </section>
        <?php } ?>

        <?php
        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Blog page                     */
        /*                                                          */
        /************************************************************/
    }else{
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        $has_thumb = false; if(has_post_thumbnail()){ $has_thumb = true; } ?>

      <?php if($has_thumb): ?>
          <div class="col-md-5">
            <figure>
              <?php the_post_thumbnail('blog'); ?>
              <div class="img-options">
                <div class="btn-wrapper single">
                  <a href="<?php echo $video_link; ?>" title="<?php echo get_the_title(); ?>" class="fancybox">
                    <i class="icon-play"></i>
                  </a>
                </div>
              </div>
            </figure>
          </div>
          <section class="col-md-7">
        <?php else: ?>
            <div class="col-xs-12">
        <?php endif; ?> <!-- If has thumbnail -->
            <div class="post-author">
              <figure>
                <?php echo get_avatar( $post->post_author, 32 ); ?>
              </figure>
              <span class="roboto-bold-italic"><?php echo get_the_author(); ?></span>
            </div>
            <h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?></a>
              <?php if(is_sticky()){ ?><span class="sticky featured-banner"><?php _e('Featured Post', 'tkingdom') ?></span><?php } ?>
            </h2>
            <div class="post-meta">
              <ul>
                <li>
                  <strong><?php _e('Category:', 'tkingdom'); ?></strong>
                  <?php echo get_the_category_list(', ', $post->ID); ?>
                </li>
                <li>
                  <strong><?php _e('Date:', 'tkingdom'); ?></strong><time><?php echo get_the_date(); ?></time>
                </li>
                <li class="meta-comments"><a href="<?php comments_link(); ?>" class="roboto-bold"><?php echo get_comments_number(); ?></a></li>
              </ul>
            </div>
              <?php
              global $more;
              $more = 0;
              if( $post->post_excerpt ) {
                  the_excerpt();
              } else { ?>
                  <div class="shortcodes">
                      <?php the_content('More...', false); ?>
                  </div>
              <?php } ?>
            <a href="<?php echo get_permalink($post->ID); ?>" data-hover="<?php _e('Read More', 'tkingdom'); ?>" class="btn-sm roboto-bold"><span class="secondary-color-btn"><?php _e('Read More', 'tkingdom'); ?></span></a>
          <?php if($has_thumb): ?>
          </section>
          <?php else: ?>
            </div> <!-- /.col-xs-12 -->
          <?php endif; ?> <!-- If has thumbnail -->

    <?php } // close if is single?>
<?php if(get_post_type() != 'gallery'): ?></article><?php endif; ?>