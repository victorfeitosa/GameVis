<?php get_header();
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_general_archive_sidebar');
$category_layout = get_theme_option(wp_get_theme()->name . '_general_cat_page_layout');
?>

<div class="block bg-content">

<?php if(is_home()) {
    get_template_part('/templates/parts/entry', 'slider');
 } ?>

<?php 
    $home_layout = get_theme_option(wp_get_theme()->name . '_home_home_sidebar_pos');
    $home_sidebar = get_theme_option(wp_get_theme()->name . '_home_home_sidebar');
    $home_sidebar_name = get_the_title($home_sidebar);
    $home_display = get_theme_option(wp_get_theme()->name . '_home_home_posts_layout');
?>


                <div class="container">
                    <div class="row">
                        <div class="white-bg">

                            <div class="<?php if($home_layout == 'home_fullwidth'){echo 'col-xs-12';}elseif($home_layout == 'home_sidebar_left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?> content-with-sidebar">

                                <div class="block category-page">
                                <?php if($home_display !== 'cat_layout_one') { ?><div class="row"><?php } ?>
                                    <div class="<?php if ( $home_display == 'cat_layout_one' ) { echo 'full-width-posts'; } else { echo 'half-width-posts'; }; ?>">

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
                                        <ul class="pagination">
                                            <?php tk_pageing($wp_query)?>
                                        </ul>
                                    <?php }?>

                                    </div>
                                    <?php if($home_display !== 'cat_layout_one') { ?></div><?php } ?>
                                </div>

                            </div><!--/col-xs-8-->
                            

                            <?php if($home_layout != 'fullwidth'){?>
                            <!-- Sidebar Left -->
                            <?php
                            if ($home_layout == 'home_sidebar_left'){
                                echo '<div class="col-xs-4" id="sidebar"><div class="sidebar-content">';
                                tk_get_sidebar('Left', $home_sidebar_name);
                                echo '</div>';
                            }
                            ?>
                            <!-- Sidebar Right -->
                            <?php
                            if ($home_layout == 'home_sidebar_right'){
                                echo '<div class="col-xs-4" id="sidebar"><div class="sidebar-content">';
                                tk_get_sidebar('Right', $home_sidebar_name);
                                echo '</div>';
                            }
                            ?>
                            <!--/sidebar-->
                            <?php }?>


                        </div><!--/row-fluid-->
                    </div>
                </div><!--/container-->
            </div>

<?php get_footer(); ?>