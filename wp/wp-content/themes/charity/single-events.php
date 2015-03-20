<?php get_header(); ?>

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post();

$prefix = 'tk_';
$disable_title = get_post_meta( $post->ID, 'tk_disable_title', true);
$page_headline = get_post_meta($wp_query->post->ID, 'tk_headline', true);
$use_slider = get_post_meta( $post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta( $post->ID, 'tk_use_latest_news', true);
$sidebar_position = get_post_meta( $post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta( $post->ID, 'tk_sidebar', true);
$template_name = get_post_meta( $post->ID, '_wp_page_template', true );

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
            <div class="<?php if($sidebar_position == 'fullwidth'){echo 'span12';}elseif($sidebar_position == 'left'){echo 'right span8';}elseif($sidebar_position == 'right'){echo 'left span8';}?> events-page event-single-page">
                <?php
                        $main_event_date = get_post_meta($post->ID, 'tk_event_datetime', true);
                        $datedate = date('d-m-Y', $main_event_date);
                        $datetime = date('H:i:s', $main_event_date);
                        $event_date = explode('-', $datedate);
                        $event_time = explode(':', $datetime);

                        $event_address = get_post_meta($post->ID, 'tk_event_address', true);
                        $event_duration = get_post_meta($post->ID, 'tk_event_duration', true);
                        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
                        ?>
                        <div class="block images-single-blog">
                            <?php if (get_post_format() == 'video') {?>
                                <div class="top-content-image <?php if(!$video_link){echo 'events-title-no-image';}?>">
                                    <?php if($video_link){tk_video_player($video_link);}?>
                                      <div class="clear-video"></div>
                                        <a href="<?php the_permalink()?>">
                                            <ul class="countdown-<?php echo $post->ID?>"></ul>
                                            <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($){
                                                        $('.countdown-<?php echo $post->ID?>').countdown({
                                                            alwaysExpire: true,
                                                            expiryText: ' ',
                                                            until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), 
                                                            layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', 
                                                            compact: true,
                                                            timezone:new Date().getTimezoneOffset()/60 * -1
                                                        });
                                                    });
                                                </script>
                                            <?php }?>
                                        </a>
                                </div>
                              
                            <?php } elseif (get_post_format() == 'gallery') {?>
                                    <div class="top-content-image event-gallery <?php if(empty($attachments[0])){echo 'events-title-no-image';}?>">   
                                        <?php if(!empty ($attachments[0])){?>
                                            <div class="flexslider">
                                                <ul class="slides">
                                                    <?php
                                                    foreach($attachments as $attach) {                              
                                                        echo '<li><img src="'.tk_get_thumb(1170, 9999, $attach).'" alt="'.get_the_title().'" title="'.get_the_title().'"/></li>';
                                                    }
                                                    ?>
                                                </ul>
                                            </div><!-- flex slider -->                                            
                                        <?php }?>
                                            
                                                                     
                                        <ul class="countdown-<?php echo $post->ID?>"></ul>
                                        <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                                            <script type="text/javascript">
                                                    jQuery(document).ready(function($){
                                                        $('.countdown-<?php echo $post->ID?>').countdown({
                                                            alwaysExpire: true, 
                                                            expiryText: ' ', 
                                                            until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), 
                                                            layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', 
                                                            compact: true, 
                                                            timezone:new Date().getTimezoneOffset()/60 * -1
                                                        });

                                                    });
                                            </script>
                                        <?php }?>                                   
                                    </div>
                                            
                            <?php } else {?>
                                    <?php 
                                    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                                    $post_thumbnail_src = $post_thumbnail['0'];
                                    ?>
                                    <div class="top-content-image <?php if(!has_post_thumbnail()){echo 'events-title-no-image';}?>">
                                        <a href="<?php the_permalink()?>">
                                            <ul class="countdown-<?php echo $post->ID?>"></ul>
                                            <?php if(has_post_thumbnail()){the_post_thumbnail();}?>
                                            <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                                                <script type="text/javascript">
                                                    jQuery(document).ready(function($){ 
                                                        $('.countdown-<?php echo $post->ID?>').countdown({
                                                            alwaysExpire: true, 
                                                            expiryText: ' ', 
                                                            until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), 
                                                            layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', 
                                                            compact: true, 
                                                            timezone:new Date().getTimezoneOffset()/60 * -1
                                                        });
                                                    });
                                                </script>
                                            <?php }?>
                                        </a>
                                    </div>
                            <?php } // endif check post format?>

                            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                        </div>

                        <div class="shortcodes">
                            <?php the_content(); ?>
                        </div>

                        <div class="social-divider"></div>
                        <?php get_template_part( '/templates/parts/entry', 'social' ); ?>

                    <?php endwhile; ?>

                <?php endif; ?>
                <!--COMMENTS-->
                <?php if (comments_open()) : ?>
                    <?php comments_template(); // Get wp-comments.php template  ?>
                <?php endif; ?>

            </div>

            <?php if($sidebar_position != 'fullwidth'){?>
                <div class="span4 <?php if($sidebar_position == 'right'){echo 'sidebar-right';}elseif($sidebar_position == 'left'){echo 'sidebar-left';}?>" id="sidebar">
                    <!-- Sidebar Left -->
                    <?php
                    if ($sidebar_position == 'left'){
                        echo '<div class="span11 pull-left" style="margin-left:0px;">';
                        tk_get_sidebar('Left', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!-- Sidebar Right -->
                    <?php 
                    if ($sidebar_position == 'right'){
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