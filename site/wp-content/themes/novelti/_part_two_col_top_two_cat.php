<?php $post_id = $post->ID;?>

<div class="design-home left">
    <div class="home-photoghy-content left">
            <?php
            $prefix = 'tk_';
            // gather variables
            $two_col_top_two_cat_left = get_option('two_col_top_two_cat_left-' . $post_id);
            $two_col_top_two_cat_left_number = get_option('two_col_top_two_cat_left-number-' . $post_id);
            if($two_col_top_two_cat_left == '0'){
                $selected_category = __('All Categories', tk_theme_name);
            }else{
                $selected_category = get_the_category_by_ID( $two_col_top_two_cat_left );
            }
            $category_color = get_option('category_'.$two_col_top_two_cat_left);
            ?>
        
            <div class="home-photoghy-header left" style="width:360px; border-right: 10px solid #<?php echo $category_color['color']?>;"><?php echo $selected_category?></div><!--/home-photoghy-header-->
            
            <?php
            $args = array('post_status' => 'publish', 'posts_per_page' => $two_col_top_two_cat_left_number, 'post_type' => 'post', 'cat' => $two_col_top_two_cat_left);
            //The Query
            $cat_query = new WP_Query($args);

            //The Loop
            if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post();
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'two-columns-top');
                $format = get_post_format();
                $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                    ?>    
                <div class="design-home-images-one left post-<?php echo $post->ID?>-<?php echo $post_id?>-left" style="margin:0 0 35px 0;">
                    <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                        <div class="design-home-images-one-img left margin-bottom-15">                                
                            <?php if ($format == false && !empty($image)) { ?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                <div class="design-home-images-one-img-hover"><a href="<?php the_permalink()?>"><p></p></a></div>
                                <?php
                            } elseif ($format == 'video') {
                                ?>
                                <div class="blog-images left single-gallery-video display-none gallery-single">
                                    <?php tk_video_player($video_link); ?>
                                </div>
                                <?php
                            } elseif ($format == 'gallery' && !empty($slide_images)) {
                                ?>
                                <script type="text/javascript">
                                    jQuery(document).ready(function($) {
                                        jQuery('.post-<?php echo $post->ID?>-<?php echo $post_id?>-left .flexslider').flexslider({
                                            pauseOnHover: true,
                                            slideshow: true,
                                            useCSS: false
                                        });
                                        
                                    jQuery('.post-<?php echo $post->ID?>-<?php echo $post_id?>-left .flex-control-nav').attr('style', 'background-color: #<?php echo $category_color['color']?>');
                                        
                                    });
                                </script>
                                <div class="flexslider">
                                    <ul class="slides">
                                        <?php foreach ($slide_images as $the_image) { ?>
                                            <li><img src="<?php tk_get_thumb(600, 416, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></li>
                                        <?php } // foreach image gallery?>
                                    </ul>
                                </div><!--/flexslider-->
                            <?php } // if checks image, gallery and video ?>
                        </div><!--/design-home-images-one-img-->
                    <?php } ?>
                        
                    <div class="design-home-images-one-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/design-home-images-one-title-->                                

                        <?php if($check_rating == 'on'){
                            $rating_type = get_post_meta($post->ID, $prefix.'rating_type', true);
                            $post_rate = get_post_meta($post->ID, 'rating-'.$prefix.'post_rating', true);
                            $average_rate = array_sum($post_rate) / count($post_rate);
                            if($rating_type == 'Stars'){
                        ?>
                            <div class="stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
                                <?php tk_rating(20, 4, 'no', round($average_rate), 'post-'.$post->ID.$post_id.'-left');?>
                            </div><!--/stars-rater-->
                            <?php }else{?>
                            <div class="home-photoghy-num-content stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
                                <span style="padding:6px 5px 6px 0"><?php _e('rating ', tk_theme_name);?></span>
                                <span style="padding:6px 0px 6px 0"><?php echo round($average_rate);?></span>
                            </div>
                            <?php }?>
                        <?php }?>
                        <div class="clear"></div>

                    <div class="design-home-images-one-category left margin-bottom-12" style="background-color: #<?php echo $category_color['color'] ?>">
                        <ul>
                            <li><p><?php echo get_the_date() ?></p></li>
                            <li><p>/</p></li>
                            <li><p><?php _e('by ', tk_theme_name) ?></p></span><?php the_author_posts_link(); ?></li>
                            <li><p>/</p></li>
                            <li><a href="<?php the_permalink() ?>"><?php comments_number('0', '1', '%'); ?> <?php _e(' comments', tk_theme_name) ?></a></li>
                        </ul>
                    </div><!--/design-home-images-one-category-->
                    <div class="design-home-images-one-text left">
                        <div class="shortcodes"><p><?php the_excerpt_length(160); ?></p></div>
                    </div><!--/design-home-images-one-text-->
                    <div class="design-home-images-one-read-more left"><a href="<?php the_permalink() ?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/design-home-images-one-read-more-->
            </div><!--/home-photoghy-one-->
            <?php
            wp_reset_query();
            endwhile;
            endif;
            ?>
        </div>
    
        <div class="home-packaging-content right">                        
                <?php
                // gather variables
                $two_col_top_two_cat_right = get_option('two_col_top_two_cat_right-' . $post_id);
                $two_col_top_two_cat_right_number = get_option('two_col_top_two_cat_right-number-' . $post_id);
                if($two_col_top_two_cat_right == '0'){
                    $selected_category = __('All Categories', tk_theme_name);
                }else{
                    $selected_category = get_the_category_by_ID( $two_col_top_two_cat_right );
                }
                $category_color = get_option('category_'.$two_col_top_two_cat_right);
                ?>
                    <div class="home-photoghy-header left" style="width:360px; border-right: 10px solid #<?php echo $category_color['color']?>;"><?php echo $selected_category?></div><!--/home-photoghy-header-->
                <?php
                $args = array('post_status' => 'publish', 'posts_per_page' => $two_col_top_two_cat_right_number, 'post_type' => 'post', 'cat' => $two_col_top_two_cat_right);
                //The Query
                $cat_query = new WP_Query($args);

                //The Loop
                if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post();
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'two-columns-top');
                    $format = get_post_format();
                    $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                    $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                    $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                        ?>    
                        <div class="design-home-images-one left post-<?php echo $post->ID?>-<?php echo $post_id?>-right" style="margin:0 0 35px 0;">
                            <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                                <div class="design-home-images-one-img left margin-bottom-15">                                
                                    <?php if ($format == false && !empty($image)) { ?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                        <div class="design-home-images-one-img-hover"><a href="<?php the_permalink()?>"><p></p></a></div>
                                        <?php
                                    } elseif ($format == 'video') {
                                        $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                        ?>
                                        <div class="blog-images left single-gallery-video display-none gallery-single">
                                            <?php tk_video_player($video_link); ?>
                                        </div>
                                        <?php
                                    } elseif ($format == 'gallery') {
                                        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                        ?>
                                        <script type="text/javascript">
                                            jQuery(document).ready(function($) {
                                                jQuery('.post-<?php echo $post->ID?>-<?php echo $post_id?>-right .flexslider').flexslider({
                                                    pauseOnHover: true,
                                                    slideshow: true,
                                                    useCSS: false
                                                });
                                                
                                                jQuery('.post-<?php echo $post->ID?>-<?php echo $post_id?>-right .flex-control-nav').attr('style', 'background-color: #<?php echo $category_color['color']?>');
                                                
                                            });
                                        </script>
                                        <div class="flexslider">
                                            <ul class="slides">
                                                <?php foreach ($slide_images as $the_image) { ?>
                                                    <li><img src="<?php tk_get_thumb(600, 416, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></li>
                                                <?php } // foreach image gallery?>
                                            </ul>
                                        </div><!--/flexslider-->

                                    <?php } // if checks image, gallery and video ?>
                                </div><!--/design-home-images-one-img-->
                            <?php } // if checks image, gallery and video ?>
                                
                            <div class="design-home-images-one-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/design-home-images-one-title-->                                

                                    <?php if($check_rating == 'on'){
                                        $rating_type = get_post_meta($post->ID, $prefix.'rating_type', true);
                                        $post_rate = get_post_meta($post->ID, 'rating-'.$prefix.'post_rating', true);
                                        $average_rate = array_sum($post_rate) / count($post_rate);
                                        if($rating_type == 'Stars'){
                                    ?>
                                        <div class="stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
                                            <?php tk_rating(20, 4, 'no', round($average_rate), 'post-'.$post->ID.$post_id.'-right');?>
                                        </div><!--/stars-rater-->
                                        <?php }else{?>
                                        <div class="home-photoghy-num-content stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
                                            <span style="padding:6px 5px 6px 0"><?php _e('rating ', tk_theme_name);?></span>
                                            <span style="padding:6px 0px 6px 0"><?php echo round($average_rate);?></span>
                                        </div>
                                        <?php }?>
                                    <?php }?>
                                    <div class="clear"></div>

                            <div class="design-home-images-one-category left margin-bottom-12" style="background-color: #<?php echo $category_color['color'] ?>">
                                <ul>
                                    <li><p><?php echo get_the_date() ?></p></li>
                                    <li><p>/</p></li>
                                    <li><p><?php _e('by ', tk_theme_name) ?></p></span><?php the_author_posts_link(); ?></li>
                                    <li><p>/</p></li>
                                    <li><a href="<?php the_permalink() ?>"><?php comments_number('0', '1', '%'); ?> <?php _e(' comments', tk_theme_name) ?></a></li>
                                </ul>
                            </div><!--/design-home-images-one-category-->
                            <div class="design-home-images-one-text left">
                                <div class="shortcodes"><p><?php the_excerpt_length(160); ?></p></div>
                            </div><!--/design-home-images-one-text-->
                            <div class="design-home-images-one-read-more left"><a href="<?php the_permalink() ?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/design-home-images-one-read-more-->
                    </div><!--/home-photoghy-one-->
                <?php
                wp_reset_query();
                endwhile;
                endif;
                ?>
    </div>
</div>