<?php get_header();
$prefix = 'tk_';
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="bg-content left">
                <div class="bg-content-center">
                    
                    <div class="content-pages-left">

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
                    </div><!--/shortcodes-->
                        
                    </div><!--/content-pages-left-->
                    
                    <div class="border-content-right left"></div><!--/border-content-right-->
                    
                <!--SIDBAR-->
                  <?php tk_get_right_sidebar('Right', 'Sidebar Default/Home')?>
                    
                </div><!--/bg-content-center-->
            </div><!--/bg-content-->
            
            <div class="border-down-content left"></div><!--/border-down-content-->

        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>