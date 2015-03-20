<?php
/*

  Template Name: Blog One Column Type 2

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
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'one-column-side');
                        $format = get_post_format();
                        $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                        $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                        $post_title = get_the_title();
                        $post_category = wp_get_post_categories( $post->ID );
                        $category_color = get_option('category_'.$post_category[0]);
                        
                        // GET POST LOOP
                        get_template_part('_part_one_column_loop');
                                
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