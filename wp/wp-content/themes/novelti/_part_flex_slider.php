<?php 
    // gather variables
    $flex_selected_category = get_option('flex-slider-'.$post->ID);
    if(empty($flex_selected_category) || $flex_selected_category == '0'){$flex_selected_category = 0;}
    $flex_post_number = get_option('flex-post-number-'.$post->ID);
    $flex_pause_time = get_option('flex-pause-time-'.$post->ID);
    $flex_animation_time = get_option('flex-animation-time-'.$post->ID);
    $flex_easing = get_option('flex-easing-'.$post->ID);
    $flex_effect = get_option('flex-effect-'.$post->ID);
    $post_id = $post->ID;
    $prefix = "tk_";
    
    if (empty($flex_effect)) {
        $flex_effect = 'slide';
    }
    
    if (empty($flex_pause_time)) {
        $flex_pause_time = 7000;
    }
    
    if (empty($flex_animation_time)) {
        $flex_animation_time = 4000;
    }
    
?>
<div class="bg-slider-fans no-background left">
    <div class="content-slider-<?php echo $post_id?> content-slider">
        <div class="flexslider">
            <ul class="slides">
                <?php
                $args = array('cat' => $flex_selected_category,  'post_status' => 'publish', 'posts_per_page' => $flex_post_number);
                query_posts($args);
                //The Loop
                if (have_posts()) : while (have_posts()) : the_post();
                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'main-slider');
                $format = get_post_format();
                $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                
                if(has_post_thumbnail() || !empty($video_link) || !empty($slide_images[0])  ) {
                ?>
                    <li>
                                        <div class="topborder"></div>
                                        <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                                            <?php if ($format == false && !empty($img_src)) { ?>
                                                <img src="<?php echo $img_src[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                                <?php
                                            } elseif ($format == 'video') {
                                                tk_video_player($video_link);
                                            } elseif ($format == 'gallery') {


                                                ?>
                                                <img src="<?php echo tk_get_thumb(900, 476, $slide_images[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                            <?php } // if checks image, gallery and video ?>
                                        <?php } ?>

                                        <?php if($format !== 'video') { ?>
                                            <div class="text-slider">
                                                <div class="text-slider-one left">
                                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                                    <span><?php echo get_the_category_list(', ', $post->ID); ?></span>
                                                </div>                                
                                            </div>
                                        <?php } ?>

                    </li>
                <?php } ?>
                <?php endwhile;
                endif; ?>
            </ul>
        </div><!--/flexslider-->
    </div>
</div>
<script type="text/javascript">
    
    jQuery(window).load(function($){
        jQuery('.content-slider-<?php echo $post_id?> .flexslider').flexslider({
            animation: '<?php echo $flex_effect?>',
            easing: '<?php echo $flex_easing?>',
            slideshowSpeed: <?php echo $flex_pause_time?>,
            animationSpeed: <?php echo $flex_animation_time?>,
            directionNav: true,
            controlNav: false
        });
        jQuery('.content-slider-<?php echo $post_id?> .flex-direction-nav a').append("<p></p>");
    });
</script>