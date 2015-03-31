<?php
get_header();
?>

    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">
                <div class="content-left left">
                    <?php
                        // The Loop
                        if (have_posts()): while (have_posts()) : the_post();
                            $format = get_post_format();
                            $categories = wp_get_post_categories($post -> ID);
                            $count = count($categories);
                            $i = 1;

                        //Get Post Loop
                        get_template_part('page-templates/_part_loop');

                        endwhile; 
                        endif; 
                    ?>
                    
                    <!--PAGINATION-->
                        <div class="pagination left">
                            <?php
                                global $wp_query;

                                $big = 999999999; // need an unlikely integer

                                $pageing =  paginate_links( array(
                                        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                        'format' => '?paged=%#%',
                                        'current' => max( 1, get_query_var('paged') ),
                                        'total' => $wp_query->max_num_pages
                                ) );
                                echo $pageing;
                            ?>
                        </div><!--/pagination-->
                    
                </div><!--  content-left -->
                <?php   tk_get_sidebar('Right', 'Default'); ?>
            </div><!-- content-full -->            
        </div><!-- wrapper -->
    </div><!-- content -->

<?php get_footer(); ?>