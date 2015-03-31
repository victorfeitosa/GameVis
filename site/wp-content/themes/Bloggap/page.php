<?php get_header();
$prefix = 'tk_';
?>

        <!-- CONTENT -->
        <div class="content right">
            <div class="title-page left"><h1><?php the_title(); ?></h1></div><!--/title-page-->
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
        </div><!--/content-->
    </div><!--/wrapper-->



<?php get_footer(); ?>

    
    