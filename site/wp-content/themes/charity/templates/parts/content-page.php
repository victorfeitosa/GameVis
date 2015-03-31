<?php
$disable_title = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

// check for slider, map and latest news and add css class
if($use_slider !== 'on'){$slider_class = 'no-slider';}else{$slider_class = '';}
if($use_latest_news !== 'on'){$news_class = 'no-news';}else{$news_class = '';}
?>

<div class="row-fluid margin-bottom-80 shortcodes-margin">
        <div class="container about-page tk-shortcodes">
            <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'left'){echo 'right span8';}elseif($sidebar_postition == 'right'){echo 'left span8';}?>">
                <?php if(!$disable_title){?>
                    <h1 class="title-divider">
                        <span><?php echo get_the_title($wp_query->post->ID)?></span>
                        <?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?>
                    </h1>
                <?php } // in not front page?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php endif;?>
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
