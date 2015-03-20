<?php
/* * *****MAIN SLIDER****** */

$prefix = 'tk_';
$slider_width = get_theme_option(tk_theme_name() . '_general_slider_fullwidth');

if ($slider_width == 'fullwidth_slider') {
    $fullwidth = 'slider-fullwidth';
} else {
    $fullwidth = '';
}
$slide_category = get_theme_option(tk_theme_name . '_general_slider_category');
$slide_number = get_theme_option(tk_theme_name . '_general_slides_number');
?>

<?php if ($slider_width !== 'none') { ?>

    <div class="bg-slider-fans part-slider left">
        <div class="wrapper">
            <div class="slider-fans-content <?php echo $fullwidth; ?> left">
                <div class="main-slider" id="main-slider"></div>       
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        $slider_fold = get_theme_option(tk_theme_name.'_general_slider_fold');
                        $args = array('cat' => $slide_category, 'post_status' => 'publish', 'posts_per_page' => $slide_number);
                        query_posts($args);
                        //The Loop
                        if (have_posts()) : while (have_posts()) : the_post();
                                if ($slider_width == 'fullwidth_slider') {
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'main-slider-full');
                                } else {
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'main-slider');
                                }
                                $format = get_post_format();
                                $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                if(has_post_thumbnail() || !empty($video_link) || !empty($slide_images[0])) {
                                ?>
                                <li>
                                    <div class="topborder"></div>
                                    <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                                        <?php if ($format == false && !empty($image)) { ?>
                                            <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                            <?php
                                        } elseif ($format == 'video') {
                                            tk_video_player($video_link);
                                        } elseif ($format == 'gallery') {
                                            ?>
                                            <img src="<?php echo tk_get_thumb(900, 476, $slide_images[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                        <?php } // if checks image, gallery and video ?>
                                    <?php } ?>


                                    <?php if ($format !== 'video') { ?>
                                        <div class="text-slider">
                                            <div class="text-slider-one left">
                                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                <span><?php echo get_the_category_list(', ', $post->ID); ?></span>
                                            </div>
                                            <?php if($slider_fold=='yes'){ ?>
                                            <div class="text-slider-two left">
                                                <span><?php echo get_the_date('d'); ?></span>
                                                <p><?php echo get_the_date('m Y'); ?></p>
                                            </div>
                                            <div class="text-slider-three left">
                                                <span><?php comments_number('0', '1', '%'); ?></span>
                                                <p><?php _e('Comments', tk_theme_name) ?></p>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>

                                </li>
                                <?php } ?>
                                
                                
                                
                                <?php
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>   
                    </ul>
                </div><!--/flexslider-->

                <?php
                if ($fullwidth !== 'slider-fullwidth') {
                    // GET FOLLOWERS TABLE
                    $twitter_acc = get_theme_option(tk_theme_name . '_social_twitter');
                    $facebook_user = get_theme_option(tk_theme_name . '_social_facebook');
                    $gplus_username = get_theme_option(tk_theme_name() . '_social_google_plus');

                    $twitter_followers = 0;
                    $facebook_followers = 0;
                    $google_followers = 0;

                    if ($twitter_acc) {
                        $twitter_followers = tk_get_twitter_followers();
                    }
                    if ($facebook_user) {
                        $facebook_followers = tk_get_facebook_likes();
                    }
                    if ($gplus_username) {
                        $google_followers = gplus_count();
                    }

                    $getResult = $twitter_followers + $facebook_followers + $google_followers;

                    $use_social_home_total_animation = get_option(tk_theme_name() . '_social_use_social_home_animation');
                    $social_home_total_animation_speed = get_option(tk_theme_name() . '_social_social_home_animation_speed');
                    $social_social_home_update_interval = get_option(tk_theme_name() . '_social_social_home_update_interval');
                    if ($use_social_home_total_animation[0] == 'yes') {
                        ?>
                        <script>
                            jQuery(document).ready(function($){
                                var counter = jQuery(".fans-home-number span");
                                counter.animateNumber(<?php echo $getResult; ?>, <?php echo $social_home_total_animation_speed; ?>, <?php echo $social_social_home_update_interval; ?>);          
                            });
                        </script>
                    <?php } ?>
                    <?php if ($twitter_acc || $facebook_user || $gplus_username) { ?>
                        <div class="fans-home right">
                            <div class="fans-home-number left">
                                <span><?php
            if ($use_social_home_total_animation[0] == 'yes') {
                echo 0;
            } else {
                echo $getResult;
            }
                        ?></span>
                                <p><?php _e('Followers / Fans / Subscribers', tk_theme_name); ?></p>
                            </div><!--/fans-home-number-->
                            <?php if ($twitter_acc) { ?>
                                <div class="fans-twitter left"><a href="http://twitter.com/<?php echo $twitter_acc; ?>"><span><?php _e('Twitter', tk_theme_name); ?></span><p><?php echo tk_get_twitter_followers(); ?></p></a></div>
                            <?php } ?>

                            <?php if ($facebook_user) { ?>
                                <div class="fans-fb left"><a href="http://facebook.com/<?php echo $facebook_user; ?>"><span><?php _e('Facebook', tk_theme_name); ?></span><p><?php echo tk_get_facebook_likes(); ?></p></a></div>
                            <?php } ?>

                            <?php if ($gplus_username) { ?>
                                <div class="fans-g left"><a href="https://plus.google.com/<?php echo $gplus_username; ?>"><span><?php _e('Google+', tk_theme_name); ?></span><p><?php echo gplus_count(); ?></p></a></div>
                            <?php } ?>
                        </div><!--/fans-home-->
                    <?php } ?>
                <?php } ?>

            </div><!--/slider-fans-content-->
        </div><!--/wrapper-->
    </div><!--/bg-slider-fans-->

    <?php
    $slider_animation = get_option(tk_theme_name . '_general_slider_animation_time');
    if (empty($slider_animation)) {
        $slider_animation = 600;
    }
    $slider_delay = get_option(tk_theme_name . '_general_slider_pause_time');
    if (empty($slider_delay)) {
        $slider_delay = 7000;
    }
    $slider_easing_effect = get_option(tk_theme_name . '_general_slider_easing_effect');
    if (empty($slider_easing_effect)) {
        $slider_easing_effect = 'linear';
    }
    $slider_effect = get_option(tk_theme_name . '_general_slider_effect');
    if (empty($slider_effect)) {
        $slider_effect = 'slide';
    }
    $work_slider_animation = get_option(tk_theme_name . '_general_work_slider_animation_time');
    if (empty($work_slider_animation)) {
        $work_slider_animation = 500;
    }
    $work_slider_delay = get_option(tk_theme_name . '_general_work_slider_pause_time');
    if (empty($work_slider_delay)) {
        $work_slider_delay = 4000;
    }
    $work_slider_easing_effect = get_option(tk_theme_name . '_general_work_slider_easing_effect');
    if (empty($work_slider_easing_effect)) {
        $work_slider_easing_effect = 'linear';
    }
    ?>
    
    

    <script type="text/javascript">
        // FLEXSLIDER
        jQuery(window).load(function() {
            jQuery('.slider-fans-content .flexslider').flexslider({
                animation: '<?php echo $slider_effect; ?>',
                slideshowSpeed: <?php echo $slider_delay; ?>,
                animationDuration: <?php echo $slider_animation ?>,
                pauseOnHover: true,
                touch: false
            });
            jQuery('.bg-slider-fans .flex-direction-nav a').append("<p></p>");
        });
    </script>

<?php } ?>