<?php get_header();
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_theme_option(tk_theme_name. '_general_archive_sidebar');
if($sidebar_postition == ''){$sidebar_postition = 'right';}
?>

    <!-- Page Headline -->
    <div class="title-pages left">
            <div class="title-pages-image left"></div>
            <div class="wrapper">
                <span><?php _e('Archive', tk_theme_name) ?></span>
            </div>
    </div><!--/title-pages-->
    <div class="bottom-slider-red"></div><!--/bottom-slider-red-->

    <!-- CONTENT -->
    <div class="content-full left">
        <div class="wrapper">
            
            <div class="content-left <?php if($sidebar_postition == 'right'){echo 'left';}elseif($sidebar_postition == 'left'){echo 'right';}elseif($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">

                <?php
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                    $format = get_post_format();
                    $categories = wp_get_post_categories($post -> ID);
                    $count = count($categories);
                    $i = 1;

                    //Get post loop
                    get_template_part('page-templates/_part_loop');
                
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
            
        </div><!-- /content-left -->



                    <!-- Sidebar -->
                    <?php if($sidebar_postition == 'right'){
                        tk_get_sidebar('Right', 'Archive/Search');
                    }elseif($sidebar_postition == 'left'){
                        tk_get_sidebar('Left', 'Archive/Search');
                    }
                    ?>

            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->
    
    <?php get_footer(); ?>