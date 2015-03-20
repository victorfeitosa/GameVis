<?php
  /*
  Template Name: Gallery Full Screen
  */
  get_header();
?>
<div id="main-wrapper">
  <div class="home" id="home">
    <article class="full-width-sly-wrapper">
      <!-- Get gallery post types -->
      <?php
          $categories_selected = get_post_meta($post->ID, 'tk_gallery_categories', true);
          $posts_per_page = get_option(wp_get_theme()->name . '_gallery_number_of_gallery_fs_posts');
          if($posts_per_page == '') { $posts_per_page = 6; }

          if(!empty($categories_selected)){
            $args = array(
              'posts_per_page' => $posts_per_page, 
              'post_type' => 'gallery', 
              'post_status' => 'publish',
              'tax_query' => array( //(array) - use taxonomy parameters (available with Version 3.1).
                array(
                  'taxonomy' => 'ct_gallery', //(string) - Taxonomy.
                  'field' => 'id', //(string) - Select taxonomy term by ('id' or 'slug')
                  'terms' => $categories_selected, //(int/string/array) - Taxonomy term(s).
                  'include_children' => true, //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
                  'operator' => 'IN' //(string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND'.
                ),
              )
            );
          }
        else{
            $args = array(
              'posts_per_page' => $posts_per_page, 
              'post_type' => 'gallery', 
              'post_status' => 'publish'
            );
        }


          $gallery_query = new WP_Query($args);

          $nr_posts = $gallery_query->found_posts;
      ?>
      <section id="full-width-sly">
        <ul class="slidee">
          <?php $i = 1; if($gallery_query->have_posts()): while($gallery_query->have_posts()): $gallery_query->the_post(); $post_format = get_post_format(); $thumb_id = get_post_thumbnail_id($post->ID); if($thumb_id) { $image = wp_get_attachment_image_src($thumb_id, 'full', true); } else { $slide_images = get_post_meta($post->ID, 'tk_repeatable', true); if(!empty($slide_images)){ $image = $slide_images; } } ?><li data-post_id="<?php echo $post->ID; ?>" class="slide-<?php echo $i; ?>" <?php if($post_format != 'video'){ ?>style="background-image: url('<?php echo $image[0]; ?>');"<?php } ?>><?php if($post_format == 'video'){ $video_link = get_post_meta($post->ID, 'tk_video_link', true); tk_video_player($video_link); } ?></li><?php if($i < $nr_posts - 2){ echo '<!--
          -->'; } $i++; $post_id = $post->ID; endwhile; endif; ?>
        </ul>
        <?php wp_reset_query(); ?>
      </section>
      <aside class="slide-data">
        <div class="pages-wrapp verticalize-container">
          <div class="pages verticalize"></div>
          <a href="#" class="prev"><i class="icon-prev"></i></a>
          <a href="#" class="next"><i class="icon-next"></i></a>
        </div>
        <div class="post-data">
          <div class="post-name">
            <p>&nbsp;</p>
          </div>
          <!-- Likes -->
          <div class="verticalize-container likes">
          </div>
        </div>
      </aside>
    </article><!-- full-width-sly-wrapper -->
  </div><!-- home page -->
</div><!-- main-wrapper -->
<!-- Pass theme url to post-like -->
<input type="hidden" id="theme_url" data-theme_url="<?php echo get_template_directory_uri(); ?>" />
<?php
  get_footer();
?>