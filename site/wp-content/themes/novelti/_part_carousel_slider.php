<?php 
    // gather variables
    $carousel_selected_category = get_option('carousel-slider-'.$post->ID);
    if(empty($carousel_selected_category) || $carousel_selected_category == '0'){$carousel_selected_category = 0;}
    if($carousel_selected_category == '0'){
        $selected_category = __('All Categories', tk_theme_name);
    }else{
        $selected_category = get_the_category_by_ID( $carousel_selected_category );
    }
    $carousel_post_number = get_option('carousel-post-number-'.$post->ID);
    $category_color = get_option('category_'.$carousel_selected_category);

    $carousel_animation_time = get_option('carousel-animation-time-'.$post->ID);
    $carousel_easing = get_option('carousel-easing-'.$post->ID);
    $post_id = $post->ID;
    
?>
    <div class="horizontal-slider left">
        <div class="carousel-wrapper">
            <div class="design-home-title-top left" <?php if(isset($category_color)){echo 'style="border-right: 10px solid #'.$category_color['color'].'"';}?>><?php echo $selected_category;?></div><!--/design-home-title-top-->
            <div class="nav-arrows-slider right">
                <div class="nav-arrows-slider-prev left"><a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev"></a></div><!--/nav-arrows-prev-->
                <div class="nav-arrows-slider-next right"><a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next"></a></div><!--/nav-arrows-next-->
            </div><!--/nav-arrows-->

            <div data-jcarousel="true" data-wrap="circular" class="carousel">
            <ul>
                <?php
                $prefix = 'tk_';
                // gather variables

                $args = array('post_status' => 'publish', 'posts_per_page' => $carousel_post_number, 'post_type' => 'post', 'cat' => $carousel_selected_category);
                //The Query
                $cat_query = new WP_Query($args);

                //The Loop
                if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'carousel');
                    $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                    $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                ?>    
                    <li>
                        <a href="<?php the_permalink()?>">
                            <div class="horisontal-images left">
                                <?php if (has_post_thumbnail()) { ?>
                                    <?php the_post_thumbnail('carousel'); ?>
                                <?php }elseif ($video_link) { ?>
                                    <?php get_video_image($video_link, $post->ID); ?>
                                <?php }elseif(count($slide_images) > 1){ ?>
                                    <img src="<?php tk_get_thumb(190, 142, $slide_images[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                <?php }else{?>
                                    <img src="<?php echo get_template_directory_uri()?>/style/img/no_190.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                <?php }?>
                                <div class="horisontal-images-hover"><p></p></div>
                            </div>
                            <div class="horisontal-text left"><?php the_title(); ?></div>
                        </a>
                    </li>
                <?php
                wp_reset_query();
                endwhile;
                endif;
                ?>
            </ul>
        </div>
    </div>
    </div><!--/horizontal-slider-->

<script type="text/javascript">
    jQuery(document).ready(function($){

        $('.carousel').jcarousel({
             'animation': {
                    'duration': <?php echo $carousel_animation_time ?>,
                    'easing':   '<?php echo $carousel_easing ?>'
            }
        });

        //HORIZONTAL SLIDER
        $('[data-jcarousel]').each(function() {
            var el = $(this);
            el.jcarousel(el.data());
        });

        $('[data-jcarousel-control]').each(function() {
            var el = $(this);
            el.jcarouselControl(el.data());
        });
    });
</script>