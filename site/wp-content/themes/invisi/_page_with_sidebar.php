<?php
/*

Template Name: Default Page With Sidebar

*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
?>

    <!-- TITLE PAGE -->
    <div class="slider-content left">
        <div class="wrapper">
            <div class="bg-title-page left">
                <div class="title-page left"><?php the_title()?></div><!--/title-page-->
            </div><!--/bg-title-page-->
        </div><!--/wrapper-->
    </div><!--/slider-content-->





    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="bg-content left">
            
                <div class="content-page left">
                    
                    
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
                    </div><!-- /shortcodes-right -->
                    
                    
                </div><!--/content-full-->
                <div style="width: 100%;height: 110px"></div>
                
                <?php tk_get_right_sidebar('Right', 'Default Page Sidebar'); ?>
                <div class="silver-big-fake right"></div>

            </div><!--/bg-content-->
            
            <div class="help-content-down left"></div><!--/help-content-down-->
            
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>