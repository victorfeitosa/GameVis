<?php get_header();
$prefix = 'tk_';
$post_type = get_post_type();
?>


    <div class="content left">
        <div class="wrapper">



            <div class="content-page-sidebar left">

                <div class="blog-post-content left">

                    <div class="blog-post-data-comment left">
                        <div class="blog-post-user left"><?php the_author_posts_link(); ?></div><!--/blog-post-user-->
                        <div class="blog-post-data left"><?php echo get_the_date()?></div><!--/blog-post-data-->
                        <?php if($post_type !== 'pt_portfolio'){ ?><div class="blog-post-comment left"><?php comments_number( '0', '1', '%' ); ?></div><!--/blog-post-comment--><?php }?>
                    </div><!--/blog-post-data-comment-->

                    <div class="blog-post-text left">
                        <div class="shortcodes left" style="width: 100%">
                                <?php
                                    wp_reset_query();
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                        endwhile;
                                    else:
                                    endif;
                                    wp_reset_query();
                                    ?>
                        </div><!--/blog-post-data-text-->
                    </div><!--/blog-post-data-text-->

                        
                    <!--BLOG-POST -->
                    <div class="comment-start left">

                        <?php if ( comments_open() ) : ?>

                            <?php comments_template(); // Get wp-comments.php template ?>

                        <?php endif; ?>

                    </div><!--/blog-page-content-->
                    </div><!--/blog-single-page-->

            <!--SIDBAR-->
            <?php
            if($post_type == 'pt_portfolio'){tk_get_right_sidebar('Right', 'Portfolio Template');}else{tk_get_right_sidebar('Right', 'Blog');}
            ?>
            
                </div><!--portfolio-content-->
<?php
            $trending = get_theme_option(tk_theme_name.'_home_disable_trending');
            if($trending !== 'yes') {
                ?>
                <?php
                /*************************************************************/
                /************MOSTLY VIEWED POSTS*****************************/
                /*************************************************************/


                ?>

            <div class="home-stories left">
                <div class="home-stories-content left">
                    <div class="home-stories-title left"><span><?php _e("Trending stories", tk_theme_name)?></span></div><!--/home-stories-title-->

                        <?php
                        wp_reset_postdata();
                        $query = array(
                                'post_type' => 'post',
                                'meta_key' => 'post_stats',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'posts_per_page' => '4'
                        );
                        $the_query = new WP_Query( $query );
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            $post_views = get_post_meta($post->ID, 'post_stats', true);
                            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'small-image');
                            ?>

                    <div class="home-storie-one left">
                        <div class="home-storie-img left"><a href="<?php the_permalink()?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
                        <div class="home-storie-text left">
                            <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            <p><?php echo $post_views?></p>
                        </div><!--/home-storie-text-->
                    </div><!--/home-storie-one-->

                        <?php
                        endwhile;
                        // Reset Post Data
                        wp_reset_postdata();
                        ?>

                </div><!--/home-stories-content-->
            </div><!--/home-stories-->
                <?php }?>
            </div><!--/content-right-->


        </div><!--/bg-content-one-->


<?php get_footer(); ?>