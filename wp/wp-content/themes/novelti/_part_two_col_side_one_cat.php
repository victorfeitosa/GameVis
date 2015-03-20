<?php 
global $prefix, $check_rating, $category_color, $post_id;
$prefix = 'tk_';
$post_id = $post->ID;
?>

<div class="home-packaging-photoghy left">
    <?php
    // gather variables
    $two_col_side_one_cat = get_option('two_col_side_one_cat-' . $post_id);
    $two_col_side_one_cat_number = get_option('two_col_side_one_cat-number-' . $post_id);
    if($two_col_side_one_cat == '0'){
        $selected_category = __('All Categories', tk_theme_name);
    }else{
        $selected_category = get_the_category_by_ID( $two_col_side_one_cat );
    }
    $category_color = get_option('category_'.$two_col_side_one_cat);
    ?>
        <div class="home-photoghy-header left" style="border-right: 10px solid #<?php echo $category_color['color']?>;"><?php echo $selected_category?></div><!--/home-photoghy-header-->
    <?php
    $i=0;
    $args = array('post_status' => 'publish', 'posts_per_page' => $two_col_side_one_cat_number, 'post_type' => 'post', 'cat' => $two_col_side_one_cat);
    //The Query
    $cat_query = new WP_Query($args);

    //The Loop
    if ($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'two-columns-side');
        $format = get_post_format();
        $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
        $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
        ?>    
            <div class="home-photoghy-content left post-<?php echo $post->ID?>-<?php echo $post_id?>" <?php if($i % 2 == 0){echo 'style="margin-right: 25px"';}?>>
                    <div class="home-photoghy-one left">
                        <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                            <div class="home-photoghy-img left">
                                <?php if ($format == false && !empty($image)) { ?>
                                    <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                <?php
                                } elseif ($format == 'video') {
                                    echo get_video_image($video_link, $post->ID);
                                } elseif ($format == 'gallery' && !empty($slide_images)) {
                                    ?>
                                        <img src="<?php tk_get_thumb(50, 50, $slide_images[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                    <?php } // if checks image, gallery and video ?>
                            </div>
                        <?php } // if checks image, gallery and video ?>
                        <div class="home-photoghy-num-category left">
                            
                            <?php 
                              // GET POST LOOP
                              get_template_part('_part_rating_box');
                            ?>
                            
                            <div class="design-home-images-one-category left" style="background-color: #<?php echo $category_color['color'] ?>">
                                <ul>
                                        <li><p><?php echo get_the_date() ?></p></li>
                                        <li><p>/</p></li>
                                        <li><p><?php _e('by ', tk_theme_name) ?></p></span><?php the_author_posts_link(); ?></li>
                                        <li><p>/</p></li>
                                        <li><a href="<?php the_permalink() ?>"><?php comments_number('0', '1', '%'); ?> <?php _e(' comments', tk_theme_name) ?></a></li>
                                </ul>
                            </div><!--/home-photoghy-category-content-->
                        </div><!--/home-photoghy-num-category-->
                        <div class="home-photoghy-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/home-photoghy-title-->
                    </div><!--/home-photoghy-one-->
            </div>
            <?php
            $i++;
            wp_reset_query();
            endwhile;
            endif;
            ?>
</div>
