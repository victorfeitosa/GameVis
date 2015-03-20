<?php
/*         * *****STICKY POST****** */
global $prefix, $post, $image, $format, $video_link, $slide_images, $check_rating, $post_title, $post_category, $i, $post_id, $category_color, $cur_cat_id;


    wp_reset_postdata();
    if(count(get_option('sticky_posts')) >= 1){
    $sticky_args = array('cat' => $cur_cat_id, 'post_status' => 'publish', 'posts_per_page' => 1, 'ignore_sticky_posts' => 1, 'post__in' => get_option('sticky_posts'));

    //The Query
    $sticky_query = new WP_Query($sticky_args);

    //The Loop
    if ($sticky_query->have_posts()) : while ($sticky_query->have_posts()) : $sticky_query->the_post();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'sticky');
            $format = get_post_format();
            $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
            $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
            $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
            $post_title = get_the_title();
            $post_category = wp_get_post_categories( $post->ID );
            ?>
            <div class="category-full-width left post-<?php echo $post->ID?>-<?php echo $post_id?>">
                <div class="design-home-images-one left">
                    <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                        <div class="design-home-images-one-img left sticky-video">  
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
                                        jQuery('.post-<?php echo $post->ID?>-<?php echo $post_id?> .flexslider').flexslider({
                                            pauseOnHover: true,
                                            slideshow: true,
                                            useCSS: false
                                        });

                                    jQuery('.post-<?php echo $post->ID?>-<?php echo $post_id?> .flex-control-nav').attr('style', 'background-color: #<?php echo $category_color['color']?>');

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
                    <div class="category-post-right right " <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { }else{echo 'style="width:100%"';}?>>
                        <div class="design-home-images-one-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/design-home-images-one-title-->                                

                            <?php 
                              // GET POST LOOP
                              get_template_part('_part_rating_box');
                            ?>

                        <div class="design-home-images-one-category left margin-bottom-12" style="background-color: #<?php echo $category_color['color'] ?>">
                            <ul>
                                <li><p><?php _e('Featured Post', tk_theme_name) ?></p></li>
                                <li><p>/</p></li>
                                <li><p><?php echo get_the_date() ?></p></li>
                                <li><p>/</p></li>
                                <li><p><?php _e('by ', tk_theme_name) ?></p></span><?php the_author_posts_link(); ?></li>
                                <li><p>/</p></li>
                                <li><a href="<?php the_permalink() ?>"><?php comments_number('0', '1', '%'); ?> <?php _e(' comments', tk_theme_name) ?></a></li>
                                <?php if(is_page_template('_blog.php') || is_page_template('_blog_one_column.php') || is_page_template('_blog_one_column_image_top.php') || is_page_template('archive.php') || is_page_template('search.php') || is_page_template('author.php') ){?>
                                    <li><p>/</p></li>
                                    <li><?php echo get_the_category_list(', ', $post->ID); ?></li>
                                <?php }?>
                            </ul>
                        </div><!--/design-home-images-one-category-->
                        <div class="design-home-images-one-text left">
                            <div class="shortcodes"><p><?php the_excerpt_length(160); ?></p></div>
                        </div><!--/design-home-images-one-text-->
                        <div class="design-home-images-one-read-more left"><a href="<?php the_permalink() ?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/design-home-images-one-read-more-->
                    </div><!--/category-post-right-->
                </div><!--/design-home-images-one-->
            </div>
            <?php
            wp_reset_postdata();
        endwhile;
    endif;
} // if there is no sticky
?>
