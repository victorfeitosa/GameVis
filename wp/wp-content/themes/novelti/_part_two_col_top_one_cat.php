<div class="">
<?php
    global $prefix, $check_rating, $category_color, $post_id;
    $prefix = 'tk_';
    
    // gather variables
    $two_col_top_one_cat = get_option('two_col_top_one_cat-' . $post->ID);
    $two_col_top_one_cat_number = get_option('two_col_top_one_cat-number-' . $post->ID);
    if($two_col_top_one_cat == '0'){
        $selected_category = __('All Categories', tk_theme_name);
    }else{
        $selected_category = get_the_category_by_ID( $two_col_top_one_cat );
    }
    $post_id = $post->ID;
    $category_color = get_option('category_'.$two_col_top_one_cat);
    ?>
    
    <div class="home-photoghy-header left" style="border-right: 10px solid #<?php echo $category_color['color']?>;"><?php echo $selected_category?></div><!--/home-photoghy-header-->
    <div class="design-home-images left">
    
    <?php
    $i = 1;
    $args = array('post_status' => 'publish', 'posts_per_page' => $two_col_top_one_cat_number, 'post_type' => 'post', 'cat' => $two_col_top_one_cat);
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
            <div class="design-home-images-one left post-<?php echo $post->ID?>-<?php echo $post_id?>">
                <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                    <div class="design-home-images-one-img left  margin-bottom-15">
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
                <div class="design-home-images-one-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/design-home-images-one-title-->

                <?php 
                  // GET POST LOOP
                  get_template_part('_part_rating_box');
                ?>

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
                    <div class="shortcodes"><p><?php the_excerpt_length(220); ?></p></div>
                </div><!--/design-home-images-one-text-->
                <div class="design-home-images-one-read-more left"><a href="<?php the_permalink() ?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/design-home-images-one-read-more-->
            </div><!--/design-home-images-one-->
        <?php if($i % 2 == 0){?>
            <div class="clear"></div>
        <?php }?>            
        <?php
        $i++;
    wp_reset_query();
    endwhile;
    endif;
    ?>
</div>
</div>
