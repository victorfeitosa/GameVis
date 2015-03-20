<?php if(get_post_type() != 'gallery'): ?><article class="post clearfix <?php if(!is_single()){ echo 'row';} ?>"><?php endif; ?>
<?php
    //Get gallery images
    $slide_images = get_post_meta($post->ID, 'tk_repeatable', true);

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){
        ?>
            <?php if(!empty ($slide_images[0])){?>
            <figure class="post-slider">
              <ul class="slidee">
                <?php
                    foreach($slide_images as $the_image) {
                        echo '<li><img src="'.tk_get_thumb(1300, 999999, $the_image).'" alt="gallery_alt" title="gallery_title"/></li>';
                     }
                ?>
              </ul>
              <div class="pages"></div>
            </figure>
            <?php } ?>
            <div class="post-author">
              <figure>
                <?php echo get_avatar($post->post_author, 32); ?>
              </figure>
              <span class="roboto-bold-italic"><?php echo get_the_author(); ?></span>
            </div>
            <h1><?php echo get_the_title(); ?></h1>
            <?php  if(is_sticky()) { ?><div class="sticky featured-banner"><?php _e('Featured Post', 'tkingdom') ?></div><?php } ?>
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
    }elseif(get_post_type() == 'gallery'){ ?>
        <?php
          $category_filter = "";
          $post_categories = wp_get_post_terms( $post->ID, 'ct_gallery' );
          foreach($post_categories as $post_category){
              $category_filter[] = $post_category->slug;
          }

          if(!empty($category_filter)) { $category_filter = implode(' ', $category_filter); }
          $random_name = generateRandomString();

          $thumb_id = get_post_thumbnail_id();
          $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'gallery-grid', true);
          $thumb_url_full_array = wp_get_attachment_image_src($thumb_id, 'full', true);
          $thumb_url_full = $thumb_url_full_array[0];

        ?>
        <section class="gallery-item col-lg-3 col-md-4 col-sm-6 isotope-item <?php echo $category_filter; ?>">
          <figure class="img-wrapper">
          <?php if($thumb_id && !empty($slide_images)){ ?>
              <?php $thumb_url = $thumb_url_array[0]; ?>
                <img src="<?php echo $thumb_url; ?>" />
          </figure>
            <?php foreach(array_slice($slide_images, 0) as $the_image): ?>
                    <div class="img-options">
                      <div class="btn-wrapper">
                        <a href="<?php echo get_permalink(); ?>"><i class="icon-next"></i></a>
                        <a href="<?php echo $the_image; ?>" title="<?php echo get_the_title(); ?>" class="fancybox" rel="<?php echo $random_name; ?>"><i class="icon-zoom"></i></a>
                      </div>
                    </div>
            <?php endforeach; ?>
          <?php }
              elseif(!$thumb_id && !empty($slide_images)){ ?>
                <img src="<?php echo $slide_images[0]; ?>" />
          </figure>
          <?php foreach(array_slice($slide_images, 0) as $the_image): ?>
                  <div class="img-options">
                    <div class="btn-wrapper">
                      <a href="<?php echo get_permalink(); ?>"><i class="icon-next"></i></a>
                      <a href="<?php echo $the_image; ?>" title="<?php echo get_the_title(); ?>" class="fancybox" rel="<?php echo $random_name; ?>"><i class="icon-zoom"></i></a>
                    </div>
                  </div>
          <?php endforeach; ?>
          <?php }else{ // if has image set ?>
                  <?php if($thumb_id){ ?>
                    <?php $thumb_url = $thumb_url_array[0]; ?>
                  <?php }else{ ?>
                  <?php 
                      $thumb_url = get_template_directory_uri().'/theme-images/no-image.jpg';
                      $thumb_url_full = get_template_directory_uri().'/theme-images/no-image.jpg';
                  ?>
                  <?php } ?>
                  <img src="<?php echo $thumb_url; ?>" alt="gallery_alt" title="gallery_title"/>
          </figure>
          <div class="img-options">
            <div class="btn-wrapper">
              <a href="<?php echo get_permalink(); ?>">
                <i class="icon-next"></i>
              </a>
              <a href="<?php echo $thumb_url_full; ?>" title="<?php echo get_the_title(); ?>" class="fancybox" rel="fancybox-masonry">
                <i class="icon-zoom"></i>
              </a>
            </div>
          </div>
          <?php } // if not :-) ?>
        </section>
    <?php

        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Blog page                     */
        /*                                                          */
        /************************************************************/
    }else{ ?>
        
      <?php $has_thumb = false; if(has_post_thumbnail()){ $has_thumb = true; } ?>

      <?php if(!empty ($slide_images[0])):?>
          <div class="col-md-5">
            <figure class="post-slider">
              <ul class="slidee">
                <?php
                    foreach($slide_images as $the_image) {
                      echo '<li><img src="'.tk_get_thumb(405, 280, $the_image).'" alt="gallery_alt" title="gallery_title"/></li>';
                    }
                ?>
              </ul>
              <div class="pages"></div>
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
            <h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?></a></h2>
            <?php  if(is_sticky()) { ?><div class="sticky featured-banner"><?php _e('Featured Post', 'tkingdom') ?></div><?php } ?>
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
          <?php if(!empty ($slide_images[0])): ?>
          </section>
          <?php else: ?>
            </div>
       <?php endif; ?> <!-- If has thumbnail -->
    <?php } // close if is single?>
<?php if(get_post_type() != 'gallery'): ?></article><?php endif; ?>