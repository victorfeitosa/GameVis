<?php
  /*

  Template Name: Blog

  */
  get_header();

  $prefix = 'tk_';
  $sidebar_selected = get_post_meta($post->ID, 'tk_sidebar', true);
  $sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
  $position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<div id="main-wrapper">
  <div class="blog archive" id="blog">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
      <div class="row">
        <?php if($sidebar_position != 'fullwidth'): ?>
          <?php if($sidebar_position == 'left'){$pull = 'pull-right'; } else $pull = ""; ?>
                    <div class="col-md-9 <?php echo $pull; ?>">
                    <h1 class="page-title"><?php the_title(); ?></h1>
            <?php else: ?>
                    <div class="col-xs-12">
                    <h1 class="page-title"><?php the_title(); ?></h1>
        <?php endif; ?>
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                $sticky = get_option('sticky_posts');
                $args = array('post_status' => 'publish', 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                //The Query
                $the_query = new WP_Query($args);
                if($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php
                      $show = true;

                      /* Don't show sticky post in pagination */
                      $sticky = get_option('sticky_posts');
                      if(($paged > 1) && (in_array($post->ID, $sticky))){
                          $show = false;
                      }

                      if($show){
                          if (get_post_format()) {
                              $post_format = get_post_format();
                          } else {
                              $post_format = 'standard';
                          }
                          get_template_part('/templates/parts/format', $post_format);
                      }
                    ?>
                <?php endwhile; ?>
                <?php endif;?>
                <?php if($the_query->max_num_pages > 1){?>
                    <div class="pagination">
                        <?php tk_pageing($the_query)?>
                    </div>
                <?php } ?>

          <!-- sidebar -->
          <?php if($sidebar_position != 'fullwidth'): ?>
              </div> <!-- col-md-9 -->
          <?php
              if ($sidebar_position == 'left'){
                  echo '<div class="col-md-3 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
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
      </div> <!--/.row -->
    </div> <!-- container -->
  </div> <!-- blog archive page -->
</div> <!-- main-wrapper -->

<?php
  get_footer();
?>