<?php get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
?>



    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
         <?php tk_get_left_sidebar($sidebar_position, 'Page Template')?>
            <div class="page-content left">
                <div class="shortcodes left">


                            <?php
                            /* Run the loop to output the page.
                                                     * If you want to overload this in a child theme then include a file
                                                     * called loop-page.php and that will be used instead.
                            */
                            //get_template_part( 'loop', 'page' );
                            wp_reset_query();
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                                    the_content();
                                endwhile;
                            else:
                            endif;
                            wp_reset_query();
                            ?>

                </div><!-- /shortcodes -->
            </div><!-- page-content -->
         <?php tk_get_right_sidebar($sidebar_position, 'Page Template')?>
        </div><!--/wrapper-->
    </div><!--/content-->







<?php get_footer(); ?>