<?php
  get_header();

  $prefix = 'tk_';
  $position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<div id="main-wrapper">
  <div class="blog archive" id="blog">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
      <div class="row">
            <div class="col-md-9">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                $args = array('post_status' => 'publish', 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                // The Query
                $the_query = new WP_Query($args);

                if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <?php
                    if (get_post_format()) {
                        $post_format = get_post_format();
                    } else {
                        $post_format = 'standard';
                    }
                    get_template_part('/templates/parts/format', $post_format); ?>
                <?php endwhile; ?>
                <?php endif;?>
                <?php if($the_query->max_num_pages > 1){?>
                    <div class="pagination">
                        <?php tk_pageing($the_query)?>
                    </div> 
                <?php }?>
              </div>
          <!-- Sidebar Right -->
              <div class="col-md-3" id="sidebar" ><div class="sidebar-content">
                <?php tk_get_sidebar('Right', 'Default'); ?>
              </div></div>

      </div> <!--/.row -->
    </div> <!-- container -->
  </div> <!-- blog archive page -->
</div> <!-- main-wrapper -->
<?php
  get_footer();
?>