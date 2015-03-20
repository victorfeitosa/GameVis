<?php
get_header();
$prefix = 'tk_';
?>

<!-- CONTENT -->
<div class="content left category-page">
    <div class="wrapper">
        <div class="content-full left">

            <div class="content-left left">

                <div class="design-home left">
                        <?php
                        $i = 1;
                        //The Loop
                        if (have_posts()) : while (have_posts()) : the_post();
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'one-column-side');
                                $format = get_post_format();
                                $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                                $post_title = get_the_title();
                                $post_category = wp_get_post_categories( $post->ID );
                                $category_color = get_option('category_'.$post_category[0]);
                                $post_id = $post->ID;
                                
                                // GET POST LOOP
                                get_template_part('_part_one_column_loop');
                                
                                $i++;
                                wp_reset_postdata();
                            endwhile;
                        endif;
                        ?>
                </div><!--/design-home-->

                <div class="pagination left">
                    <?php
                    global $wp_query;
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages
                    ));
                    ?>
                </div><!--/pagination-->

            </div><!--/content-left-->

            <?php
            /* include sidebar */
                tk_get_sidebar('Right', 'Archive/Search');
            ?>

        </div><!--/content-full-->
    </div><!--/wrapper-->
</div><!--/content-->

<?php get_footer(); ?>