<?php
/*

  Template Name: Blog One Column Type 1

 */
get_header();
$prefix = 'tk_';
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);
?>

<?php 
$blog_slider = get_theme_option(tk_theme_name().'_general_disable_blog_slider');
if ($blog_slider != 'yes') {
    // get main slider and followers
    get_template_part('_part_main_slider');
}
?>

<!-- CONTENT -->
<div class="content left">
    <div class="wrapper">
        <div class="content-full left">

            <div class="content-left left">

                <?php 
                // get sticky post

                get_template_part('_part_sticky_post');
                
                /*
                 * 
                 * REGULAR POSTS
                 */
                $i = 1;
                wp_reset_postdata();
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                $query_args = array('post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'post__not_in' => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 1);

                //The Query
                $main_query = new WP_Query($query_args);

                //The Loop
                if ($main_query->have_posts()) : while ($main_query->have_posts()) : $main_query->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'one-column-top');
                        $format = get_post_format();
                        $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                        $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                        $post_title = get_the_title();
                        $post_category = wp_get_post_categories( $post->ID );
                        $category_color = get_option('category_'.$post_category[0]);
                    ?>
                    <div class="home4-full-width left post-<?php echo $post->ID?>-<?php echo $post_id?>">   
                        <div class="design-home-images-one left">
                            <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                            <div class="design-home-images-one-img left  margin-bottom-15">
                                <?php if ($format == false && !empty($image)) { ?>
                                    <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                    <div class="design-home-images-one-img-hover"><a href="<?php the_permalink()?>"><p></p></a></div>
                                <?php
                                } elseif ($format == 'video') {
                                    ?>
                                    <div class="one_cat_top_video">
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
                                                    <li><img src="<?php tk_get_thumb(825, 415, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></li>
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

                            <div class="design-home-images-one-category left margin-bottom-12" style="background-color: #<?php echo $category_color['color']?>">
                                <ul>
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
                                <?php
                                global $more;
                                $more = 0;
                                if( $post->post_excerpt ) {
                                    the_excerpt();
                                } else { ?>
                                    <div class="shortcodes">
                                        <?php the_content('', false); ?>
                                    </div>
                                <?php } ?>
                            </div><!--/design-home-images-one-text-->
                            <div class="design-home-images-one-read-more left"><a href="<?php the_permalink() ?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/design-home-images-one-read-more-->
                        </div>
                        </div>
                    <?php          
                        $i++;
                    endwhile;
                endif;
                ?>

                <div class="pagination left">
                    <?php
                    global $main_query;
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $main_query->max_num_pages
                    ));
                    ?>
                </div><!--/pagination-->

            </div><!--/content-left-->

                <?php                 
                    tk_get_sidebar('Right', $sidebar_select);               
                ?>

        </div><!--/content-full-->
    </div><!--/wrapper-->
</div><!--/content-->

<?php get_footer(); ?>