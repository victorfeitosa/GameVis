<?php
/*

Template Name: Our Causes

*/
get_header();

$page_headline = get_post_meta($wp_query->post->ID, 'tk_headline', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$disable_title = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

// check for slider, map and latest news and add css class
if($use_slider !== 'on'){$slider_class = 'no-slider';}else{$slider_class = '';}
if($template_name == 'templates/template-contact.php' && ($show_map != 'yes' && $use_large_map != 'content' )){$css_class = '';}
if($use_latest_news !== 'on'){$news_class = 'no-news';}else{$news_class = '';}
?>

    <div class="row-fluid shortcodes-margin">
        <div class="container">

        <?php if(empty($disable_title)){?>
            <h1 class="title-divider">
                <span><?php the_title()?></span>
                <?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?>
            </h1>
        <?php } ?>

            <div class="row-fluid">

                <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'left'){echo 'right span8';}elseif($sidebar_postition == 'right'){echo 'left span8';}?> our-causes-page">

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args = array('post_status' => 'publish', 'post_type' => 'services', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
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

                    <div class="pagination">
                        <?php tk_pageing($the_query)?>
                        <hr>
                    </div>
                </div>

                <?php if($sidebar_postition != 'fullwidth'){?>
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