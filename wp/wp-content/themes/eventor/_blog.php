<?php
/*
  
Template Name: Blog
   
*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_position == ''){$sidebar_position = 'right';}
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);
?>

    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <!-- Page Headline-->
            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php the_title(); ?></h1>
                        <?php if ($page_headline !== '') { ?>
                        <span><?php echo '| ' . $page_headline ?></span>
                        <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->

            <div class="blog-holder left">
            <div class="blog-content <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">

                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                            $args = array('post_status' => 'publish', 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();
                            $format = get_post_format();
                            $categories = wp_get_post_categories($post -> ID);
                            $count = count($categories);
                            $i = 1;
                            
                            //Get Post Loop
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


                        </div><!--/blog-content-left-->

                <!--SIDBAR-->
                <div class="<?php if($sidebar_position == 'right'){echo 'right';}elseif($sidebar_position == 'left'){echo 'left';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
                    <?php                     
                        if($sidebar_position == 'right'){
                            tk_get_sidebar('Right', $sidebar_select);
                        }elseif($sidebar_position == 'left'){
                            tk_get_sidebar('Left', $sidebar_select);
                        }
                    ?>
                </div>

            </div><!-- /blog-holder -->



        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>