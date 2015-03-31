<?php get_header();
$sidebar_postition = 'right';
?>

    <div class="row-fluid shortcodes-margin">
        <div class="container">
            <h1 class="title-divider">
                <span><?php _e('Search Result', 'tkingdom'); ?></span>
                <p><?php printf( __('Search Results for: %s', 'tkingdom'),'' . get_search_query() . ''); ?></p>
            </h1>

            <div class="row-fluid">

                <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'left'){echo 'right span8';}elseif($sidebar_postition == 'right'){echo 'left span8';}?> blog-page our-causes-page">
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
                            <hr>
                        </div>
                    <?php }?>
                </div>

                <?php if($sidebar_postition != 'fullwidth'){ 
                    $sidebar_selected = 'Archive/Search';
                    ?>
                    <div class="span4 <?php if($sidebar_postition == 'right'){echo 'sidebar-right';}elseif($sidebar_postition == 'left'){echo 'sidebar-left';}?>" id="sidebar">
                        <!-- Sidebar Left -->
                        <?php
                        if ($sidebar_postition == 'left'){
                            echo '<div class="span11 pull-left" style="margin-left:0px;">';
                            tk_get_sidebar('Left', $sidebar_selected);
                            echo '</div>';
                        }
                        ?>
                        <!-- Sidebar Right -->
                        <?php
                        if ($sidebar_postition == 'right'){
                            echo '<div class="span11 pull-right">';
                            tk_get_sidebar('Right', $sidebar_selected);
                            echo '</div>';
                        }
                        ?>
                        <!--/sidebar-->
                    </div>
                <?php }?>

            </div>

        </div>
    </div>
<?php get_footer(); ?>