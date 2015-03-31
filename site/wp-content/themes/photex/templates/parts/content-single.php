<?php
$prefix = 'tk_';
$sidebar_selected = get_post_meta($post->ID, 'tk_sidebar', true);
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
$position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<div id="main-wrapper">
    <div class="blog single <?php if($sidebar_position != 'fullwidth'){ echo 'sidebar'; } ?>" id="blog">
        <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
            <div class="row">
              <?php if($sidebar_position != 'fullwidth'): ?>
                <?php $pull = ($sidebar_position == 'left') ? 'right' : 'left';  ?>
                    <div class="col-md-9 pull-<?php echo $pull; ?>">
              <?php else: ?>
                    <div class="col-xs-12">
              <?php endif; ?>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        if (get_post_format()) {
                            $post_format = get_post_format();
                        } else {
                            $post_format = 'standard';
                        }
                        get_template_part('/templates/parts/format', $post_format); ?>

                        <?php
                            $posttags = get_the_tags();
                            if($posttags){ ?>
                              <div class="widget_tag_cloud">
                                  <?php 
                                      foreach($posttags as $tag) {
                                        echo '<a class="btn-sm" data-hover="'.$tag->name.'" href="'.get_tag_link($tag->term_id).'"><span class="secondary-color-btn">'.$tag->name.'</span></a>'; 
                                      } 
                                  ?>
                              </div>
                        <?php } ?>

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

                        <!-- Related Posts -->
                        <?php
                            $taxonomies = get_object_taxonomies($post);
                            $taxonomy = $taxonomies[0];
                            $post_type = get_post_type($post);

                            $related_posts = tk_related_posts($post->ID, $post_type, $taxonomy);
                         ?>
                            <?php if($related_posts && $related_posts->have_posts()): ?>
                                <article class="related-posts row">
                                    <h3><?php _e('Related Posts', 'tkingdom'); ?></h3>
                                    <div class="row">
                                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
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
                                <?php endwhile; ?>
                                    </div>
                                </article>
                            <?php wp_reset_query(); ?>
                            <?php endif; ?>
                        <!--COMMENTS-->
                        <div class="comments-area shortcodes" id="comments">
                          <?php if(comments_open()): ?>
                            <?php comments_template(); ?>
                          <?php endif; ?>
                        </div><!-- /#comments -->
                    <?php endwhile; ?>
                <?php endif; ?>


              <!-- sidebar -->

                <?php if($sidebar_position != 'fullwidth'): ?>
                    </div> <!-- col-md-9 -->
                <?php
                    if ($sidebar_position == 'left'){
                        echo '<div class="col-md-3" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                        tk_get_sidebar('Left', $sidebar_selected);
                        echo '</div></div>';
                    }
                ?>
                <!-- Sidebar Right -->
                <?php
                    if ($sidebar_position == 'right'){
                        echo '<div class="col-md-3" id="sidebar" ><div class="sidebar-content">';
                        tk_get_sidebar('Right', $sidebar_selected);
                        echo '</div></div>';
                    }
                ?>
                <?php else: ?>
                    </div> <!-- /.col-xs-12 -->
                <?php endif; ?>
           </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.blog .single -->
</div> <!-- /#main-wrapper -->