<?php
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog_id ), 'full');
$sidebar_selected = get_post_meta($post->ID, 'tk_sidebar', true);
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
$enable_slider = get_post_meta($wp_query->post->ID, 'tk_enable_slider', true);
?>


                                        
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                if (get_post_format()) {
                    $post_format = get_post_format();
                } else {
                    $post_format = 'standard';
                }
                get_template_part('/templates/parts/format', $post_format); ?>
            <?php endwhile; ?>
        <?php endif; ?>