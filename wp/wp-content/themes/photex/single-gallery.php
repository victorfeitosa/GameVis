<?php
  get_header();

  $gallery_layout = get_post_meta($post->ID, 'tk_view_layout', true);
  $position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
  $slide_images = get_post_meta($post->ID, 'tk_repeatable', true);

  $post_format = get_post_format();
?>

<div id="main-wrapper">
  <div class="blog portfolio <?php if($gallery_layout == 'column_layout'){echo 'single';} ?>">
    <?php if($gallery_layout == 'full_layout' && !empty($slide_images[0]) && 'gallery' == $post_format){ ?>
             <figure class="portfolio-slider">
              <ul class="slidee">
                <?php
                  foreach($slide_images as $the_image) {
                      echo '<li><img src="'.tk_get_thumb(1170, 999999, $the_image).'" /></li>';
                  }
                ?>
              </ul>
              <a href="#" class="prev"><i class="icon-prev"></i></a>
              <a href="#" class="next"><i class="icon-next"></i></a>
              <div id="scrollbar">
                  <div class="handle"></div>
              </div>
            </figure>
    <?php } if($gallery_layout == 'full_layout' && 'gallery' != $post_format) { ?>
             <figure class="featured-wrapper">
                <?php
                  $thumb_id = get_post_thumbnail_id();
                  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
                  $thumb_url = $thumb_url_array[0];

                if('video' == $post_format) { ?>
                    <?php 
                      $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                      tk_video_player($video_link); 
                    ?>
                <?php } else { ?>
                <?php if($thumb_id){ ?><img src="<?php echo $thumb_url ?>" /><?php } ?>
                <?php } ?>
             </figure>
    <?php } ?>

    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>" >
    <?php if($gallery_layout == 'column_layout'){ ?>
      <div class="row">
        <ul class="portfolio-images col-md-8">
          <?php if('gallery' == $post_format){ ?>
            <?php if(!empty($slide_images[0])){ ?>
                    <?php
                      foreach($slide_images as $the_image) {
                          echo '<li><img src="'.tk_get_thumb(840, 999999, $the_image).'" /></li>';
                      }
                    ?>
            <?php } else { ?>
                      <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
            <?php } ?>
          <?php } elseif('video' == $post_format) { ?>
                      <?php $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                      echo '<li>';
                        tk_video_player($video_link);
                      echo '</li>'; ?>
          <?php } else { ?>
                  <?php
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
                    $thumb_url = $thumb_url_array[0];
                    if(!$thumb_id){
                        $thumb_url = get_template_directory_uri().'/theme-images/no-image-related.jpg';
                        if('gallery' == get_post_format()){
                            $slide_images = get_post_meta($post->ID, 'tk_repeatable', true);
                            if(!empty($slide_images[0])){
                              $thumb_url = $slide_images[0];
                            }
                        }
                    }
                    echo '<li><img src="'.$thumb_url.'" /></li>'; ?>
          <?php } ?>
        </ul>
        <div class="col-md-4">
          <article class="post clearfix">
            <h1><?php echo get_the_title(); ?></h1>
            <div class="post-meta">
              <ul>
                  <?php
                    $additional_infos = get_post_meta($wp_query->post->ID, 'tk_additional_info', true);
                    $additional_info_titles = get_post_meta($wp_query->post->ID, 'title-tk_additional_info', true);
                    $additional_info_contents = get_post_meta($wp_query->post->ID, 'content-tk_additional_info', true);
                    $i = 0;

                  ?>
                <?php if($additional_info_titles[0] != '' && $additional_info_contents[0] !=''): ?>
                <li>
                <li>
                  <?php
                      foreach($additional_infos as $additional_info){
                        //Check if it is URL
                        if(!filter_var($additional_info_contents[$i], FILTER_VALIDATE_URL)){
                          $info_content = '<span>'.$additional_info_contents[$i].'</span>';
                        }
                        else{
                          $info_content = '<span><a target="_blank" href href="'.$additional_info_contents[$i].'">'.$additional_info_contents[$i].'</a></span>';
                        }

                        echo '<strong>'.$additional_info_titles[$i].'</strong>';
                        echo $info_content;
                        echo '<hr>';
                        $i++;
                      }
                  ?>
                </li>
              <?php endif; ?>
                <li>
                  <strong><?php _e('Category', 'tkingdom'); ?></strong>
                  <!-- GET CATEGORIES -->
                  <?php $post_categories = wp_get_post_terms($post->ID, 'ct_gallery');
                      $num_cats = count($post_categories);
                      $i=1;
                      if(!empty($post_categories)){
                        foreach($post_categories as $post_category){
                          $term_link = get_term_link($post_category);
                          if($i == $num_cats){ $comma = ''; } else { $comma = ', '; }
                          echo '<a href="'.$term_link.'">'.$post_category->name.'</a>'.$comma;
                          $i++;
                        }
                      }
                      else {
                          echo '<a href="#">'.__('No categories', 'tkingdom').'</a>';
                      }
                  ?>
                </li>
              </ul>
            </div>
            <div class="shortcodes">
              <?php echo apply_filters('the_content', get_post_field('post_content', $post->ID)); ?>
            </div>
          </article>

          <!-- Likes -->
          <div class="likes">
            <?php $vote_count = get_post_meta($post->ID, "votes_count", true); $liked = ""; if ( tk_has_voted($post->ID) ) { $liked = 'class="liked" '; } ?>
                <a href="#" data-post_id="<?php echo $post->ID; ?>" <?php echo $liked ?>>
                    <i class="icon-heart"></i>
                    <i class="icon-heart-full"></i>
                    <span class="like-counter"><?php if ($vote_count == '') { echo '0'; } else { echo $vote_count; }; ?></span>
                </a>
          </div>

          <!-- Social links -->
          <?php get_template_part('/templates/parts/entry', 'social'); ?>

        </div>
        <?php } else { ?> <!-- If is full layout -->
        
        <article class="post clearfix">
        <h1><?php echo get_the_title(); ?></h1>
        <div class="row">
          <div class="col-md-4">
            <div class="post-meta">
              <ul>
                  <?php
                    $additional_infos = get_post_meta($wp_query->post->ID, 'tk_additional_info', true);
                    $additional_info_titles = get_post_meta($wp_query->post->ID, 'title-tk_additional_info', true);
                    $additional_info_contents = get_post_meta($wp_query->post->ID, 'content-tk_additional_info', true);
                    $i = 0;

                  ?>
                <?php if($additional_info_titles[0] != '' && $additional_info_contents[0] !=''): ?>
                <li>
                  <?php
                      foreach($additional_infos as $additional_info){
                        //Check if it is URL
                        if(!filter_var($additional_info_contents[$i], FILTER_VALIDATE_URL)){
                          $info_content = '<span>'.$additional_info_contents[$i].'</span>';
                        }
                        else{
                          $info_content = '<span><a target="_blank" href="'.$additional_info_contents[$i].'">'.$additional_info_contents[$i].'</a></span>';
                        }

                        echo '<strong>'.$additional_info_titles[$i].'</strong>';
                        echo $info_content;
                        echo '<hr>';
                        $i++;
                      }
                  ?>
                </li>
                <?php endif; ?>
                <li>
                  <strong><?php _e('Category', 'tkingdom'); ?></strong>
                  <!-- GET CATEGORIES -->
                  <?php $post_categories = wp_get_post_terms( $post->ID, 'ct_gallery' );
                      $num_cats = count($post_categories);
                      $i=1;
                      if(!empty($post_categories)){
                        foreach($post_categories as $post_category){
                          $term_link = get_term_link($post_category);
                          if($i == $num_cats){ $comma = ''; } else { $comma = ', '; }
                          echo '<a href="'.$term_link.'">'.$post_category->name.'</a>'.$comma;
                          $i++;
                        }
                      }
                      else {
                          echo '<a href="#">'.__('No categories', 'tkingdom').'</a>';
                      }
                  ?>
                </li>
              </ul>
            </div>
            <!-- Likes -->
            <div class="likes">
              <?php $vote_count = get_post_meta($post->ID, "votes_count", true); $liked = ""; if ( tk_has_voted($post->ID) ) { $liked = 'class="liked" '; } ?>
                  <a href="#" data-post_id="<?php echo $post->ID; ?>" <?php echo $liked ?>>
                      <i class="icon-heart"></i>
                      <i class="icon-heart-full"></i>
                      <span class="like-counter"><?php if ($vote_count == '') { echo '0'; } else { echo $vote_count; }; ?></span>
                  </a>
            </div>

            <!-- Social links -->
            <?php get_template_part('/templates/parts/entry', 'social'); ?>
          </div>
          <div class="col-md-8">
            <div class="shortcodes">
              <?php echo apply_filters('the_content', get_post_field('post_content', $post->ID)); ?>
            </div>
          </div>
        </div>
      </article>

      <?php } ?>

        <!-- Related Posts -->
        <?php
            $taxonomies = get_object_taxonomies($post);
            $taxonomy = $taxonomies[0];
            $post_type = get_post_type($post);

            $related_posts = tk_related_posts($post->ID, $post_type, $taxonomy);
         ?>
         <?php if($related_posts && $related_posts->have_posts()): ?>
          <article class="related-posts row">
              <h3 class="col-xs-12"><?php _e('Related Projects', 'tkingdom'); ?></h3> 
          <?php if($related_posts->have_posts()): while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                <section class="col-md-3 col-xs-6">
                  <a href="<?php echo get_permalink(); ?>" class="clearfix">
                    <figure>
                    <?php
                      $thumb_id = get_post_thumbnail_id();
                      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'related-posts', true);
                      $thumb_url = $thumb_url_array[0];
                      if(!$thumb_id){
                        $thumb_url = get_template_directory_uri().'/theme-images/no-image-related.jpg';
                        if('gallery' == get_post_format()){
                            $slide_images = get_post_meta($post->ID, 'tk_repeatable', true);
                            if(!empty($slide_images[0])){
                              $thumb_url = $slide_images[0];
                            }
                        }
                      }
                      echo '<img src="'.$thumb_url.'" />'; ?>
                    </figure>
                    <p><?php echo get_the_title(); ?></p>
                  </a>
                </section>
          <?php endwhile; endif; ?>
          </article>
          <?php wp_reset_query(); ?>
        <?php endif; ?>
        <!-- Comments -->
        <div class="comments-area" id="comments">
          <?php if(comments_open()): ?>
            <?php comments_template(); ?>
          <?php endif; ?>
        </div><!-- /#comments -->
      </div><!-- row -->
    </div><!-- container -->
  </div><!-- blog portfolio single page -->
</div><!-- main-wrapper -->

<?php get_footer(); ?>