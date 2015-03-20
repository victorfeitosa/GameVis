<?php 
/*

Template Name: Blog

*/
get_header();
$prefix = 'tk_';
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="bg-content left">
                <div class="bg-content-center">
                    
                    <div class="content-pages-left">

                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args=array('post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1);

                        //The Query
                        query_posts($args);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $video_link = get_post_meta($post->ID, 'tk_video_link', true);                        
                        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);

                        ?>   

                        <div class="blog-one left">
                            <div class="blog-date-user-comment left">
                                <div class="blog-date left"><?php echo get_the_date()?></div><!--/blog-date-->
                                <div class="blog-user left"><?php the_author_posts_link();?></div><!--/blog-user-->
                                <div class="blog-comment left"><?php comments_number( '0', '1', '%' ); ?> <?php _e('comments', tk_theme_name) ?></div><!--/blog-comment-->
                            </div><!--/blog-date-user-comment-->                            
                            <div class="blog-title left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/blog-title-->       
                            <?php
                                    $images = '';
                                    if(!empty($slide_images)){
                                        foreach($slide_images as $slide) {

                                        if($slide != ''){
                                        $images .= '<li><img src="'.tk_get_thumb_new(625, 360, $slide).'"/></li>';
                                        }
                                    }
                            }?>

                            <?php if($video_link || has_post_thumbnail() || $images != ''){?>
                            <div class="blog-images left">

                                <div class="blog-images-content left">

                                    <?php

                                    if($video_link) { ?>
                                            <?php tk_video_player($video_link);?>
                                                 <?php } elseif(!empty($images)) { ?>

                                                    <?php if($images != ''){?>
                                                            <div class="flexslider">
                                                                <ul class="slides">
                                                                    <?php echo $images;?>
                                                                </ul>
                                                            </div><!-- flex slider -->
                                                     <?php
                                                }
                                             }
                                            elseif (has_post_thumbnail()) { ?>
                                                 <?php
                                                 tk_thumbnail($post->ID, 'blog'); ?>
                                                <a href="<?php the_permalink(); ?>"><span></span></a>
                                    <?php } ?>

                                </div><!--/blog-images-content-->
                                <div class="border-down-blog"></div><!--/border-down-blog-->
                            </div><!--/blog-images-->
                            <?php } ?>

                            
                            <div class="blog-text left"><?php the_excerpt()?></div><!--/blog-text-->
                            <div class="blog-more left"><a href="<?php the_permalink()?>"><?php _e('More info', tk_theme_name) ?></a></div><!--/blog-more-->
                        </div><!--/blog-one-->    
                        
                        <?php endwhile; ?>
                        <?php else: ?>
                        <?php endif; ?>
            
                    <!--PAGINATION-->
                    <div class="pagination left tk-pagination">
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
                        
                    </div><!--/content-pages-left-->
                    
                    <div class="border-content-right left"></div><!--/border-content-right-->
                    
                <!--SIDBAR-->
                  <?php tk_get_right_sidebar('Right', 'Blog Template')?>
                    
                </div><!--/bg-content-center-->
            </div><!--/bg-content-->
            
            <div class="border-down-content left"></div><!--/border-down-content-->

        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>
