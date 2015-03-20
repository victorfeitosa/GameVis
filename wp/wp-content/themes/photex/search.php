<?php get_header();
    $sidebar_position = get_theme_option(wp_get_theme()->name . '_general_archive_sidebar');
    $position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<div id="main-wrapper">
  <div class="archive">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
        <div class="row">
            <div class="<?php if($sidebar_position == 'fullwidth'){echo '';}elseif($sidebar_position == 'left'){echo 'col-md-9 pull-right';}else{echo 'col-md-9';}?>">

                <h1 class="page-title">
                    <?php printf( __('Search Results for: %s', 'tkingdom'),'' . get_search_query() . ''); ?>
                </h1>


                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php
                            if (get_post_format()) {
                                $post_format = get_post_format();
                            } else {
                                $post_format = 'standard';
                            }
                            get_template_part('/templates/parts/format', $post_format); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <h1><?php _e('No Results Found', 'tkingdom'); ?></h1>
                    <?php endif;?>
                    <?php if($wp_query->max_num_pages > 1){?>
                        <div class="pagination">
                            <?php tk_pageing($wp_query)?>
                        </div>
                    <?php }?>

            </div><!--/col-->

            <?php if($sidebar_position !== 'fullwidth'){?>
                <!-- Sidebar Left -->
                <?php

                if ($sidebar_position == 'left'){
                    echo '<div class="col-md-3 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                    tk_get_sidebar('Left', 'Archive/Search');
                    echo '</div></div>';
                }
                ?>
                <!-- Sidebar Right -->
                <?php
                if ($sidebar_position == 'right'){
                    echo '<div class="col-md-3 pull-right" id="sidebar" ><div class="sidebar-content">';
                    tk_get_sidebar('Right', 'Archive/Search');
                    echo '</div></div>';
                }
                ?>
                <!--/sidebar-->
            <?php } ?>           

        </div>
    </div><!--/row-fluid-->
  </div>
</div><!--/container-->

<?php get_footer(); ?>