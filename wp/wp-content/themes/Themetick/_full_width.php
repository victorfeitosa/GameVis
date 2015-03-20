<?php
/*

Template Name: Full Width

*/
get_header();
?>
 
    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
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
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>