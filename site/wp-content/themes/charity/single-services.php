<?php get_header(); ?>

<?php
$prefix = 'tk_';
$tk_page_id = get_option('id_services_page');
$page_headline = get_post_meta($wp_query->post->ID, 'tk_headline', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$services_donation = get_post_meta($wp_query->post->ID, 'tk_services_donation', true);
$services_amount = get_post_meta($wp_query->post->ID, 'tk_services_collected', true);
$attachments  = get_post_meta($wp_query->post->ID, 'tk_repeatable', true);
$video_link = get_post_meta($wp_query->post->ID, 'tk_video_link', true);
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

                <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'left'){echo 'right span8';}elseif($sidebar_postition == 'right'){echo 'left span8';}?> our-causes-page causes-single-page">

                    <div class="block">
                        <?php if (get_post_format($wp_query->post->ID) == 'video') {?>
                            <?php if($video_link){?>
                                <div class="top-content-image">
                                    <?php tk_video_player($video_link);?>
                                </div>
                            <?php }?>
                        <?php } elseif (get_post_format($wp_query->post->ID) == 'gallery') {?>
                            <?php if(!empty ($attachments[0])){?>
                                <div class="top-content-image">
                                    <div class="flexslider">
                                        <ul class="slides">
                                            <?php
                                            foreach($attachments as $attach) {
                                                echo '<li><img src="'.$attach.'" alt="'.get_the_title($wp_query->post->ID).'" title="'.get_the_title($wp_query->post->ID).'"/></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div><!-- flex slider -->
                                </div>
                            <?php }?>
                        <?php }else {?>
                            <?php if(has_post_thumbnail()){?>
                                <div class="top-content-image">
                                    <?php the_post_thumbnail();?>
                                </div>
                            <?php }?>
                        <?php }?>
                        <div class="top-content-text">
                            <?php if(!empty($services_donation) || !empty($services_amount)){?>
                                <ul>
                                    <?php if($services_donation){?><li class="span4 make-donation"><a href='<?php echo $services_donation?>'><?php _e('Make Donation', 'tkingdom')?><i class="plas-wite10"></i></a></li><?php }?>
                                    <?php if($services_amount){?>
                                        <li class="span4"><p><?php _e('Collected money so far:', 'tkingdom')?></p></li>
                                        <li class="span4"><span><?php echo $services_amount?></span></li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                            <div class="clear"></div>
                            <?php
                            //The Loop
                            if (have_posts()) : while (have_posts()) : the_post();
                                the_content();
                            endwhile;
                            endif;
                            
                            
                           get_template_part( '/templates/parts/entry', 'social' ); ?>
                        </div>
                    </div>
                    <!--COMMENTS-->
                    <?php if (comments_open()) : ?>
                        <?php comments_template(); // Get wp-comments.php template  ?>
                    <?php endif; ?>
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