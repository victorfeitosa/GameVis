<?php get_header();
$prefix = 'tk_';
$tk_blog_id = get_option('id_blog_page');
$sidebar_position = get_theme_option(tk_theme_name. '_general_archive_sidebar');
if($sidebar_position == ''){$sidebar_position = 'right';}
?>


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

                        <!-- Page Headline-->
                        <div class="bg-title-page left">
                            <div class="bg-title-page-center left">
                                <div class="title-page-content left">
                                    <h1><?php _e('Archive', tk_theme_name) ?></h1>
                                </div><!--/title-page-conten-->
                            </div><!--/bg-title-page-center-->
                            <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
                        </div><!--/bg-title-page-->

                <div class="blog-holder left">
                    <div class="blog-content <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">

                        
                            <?php
                                // The Loop
                                if (have_posts()): while (have_posts()) : the_post();
                                $format = get_post_format();
                                $categories = wp_get_post_categories($post -> ID);
                                $count = count($categories);
                                $i = 1;

                                //Get post loop
                                get_template_part('_part_loop');

                                endwhile; endif; ?>

                                
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
                                
                    </div><!--/blog-content-->
                    
                    <!-- Sidebar -->
                    <?php if($sidebar_position == 'right'){
                        tk_get_sidebar('Right', 'Archive/Search');
                    }elseif($sidebar_position == 'left'){
                        tk_get_sidebar('Left', 'Archive/Search');
                    }
                    ?>
                </div><!--/blog-holder-->


        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>