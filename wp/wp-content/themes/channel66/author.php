<?php get_header();
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
$author_bio = get_the_author_meta( 'user_description', $curauth->ID );
?>

<div class="content left">
        <div class="wrapper">

            <div class="content-page-sidebar left">

                <div class="blog-post-content left">

                    <div class="blog-post-data-comment left">
                        <?php

                        ?>
                        <div class="home-authors-img left no-margin" style="display: inline-block"><a href="<?php echo get_author_posts_url( $curauth->ID )?>"><?php echo get_avatar($curauth->ID,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                        <div class="user-info">
                            <div class="blog-post-user left"><?php echo count_user_posts( $curauth->ID );?> <?php _e('Posts', tk_theme_name)?></div><!--/blog-post-user-->
                            <p><?php echo $author_bio?></p><!--/blog-post-user-->
                        </div>
                    </div><!--/blog-post-data-comment-->

                    <div class="title-border left"><span></span></div><!--title-border-->

                    
                            <?php wp_reset_postdata();
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                            $the_query = new WP_Query( array( 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1, 'author'=> $curauth->ID ) );
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                                $post_views = get_post_meta($post->ID, 'post_stats', true);
                            ?>
                                <div class="post-title"><a href="<?php the_permalink()?>"><?php the_title()?></a></div>
                                <div class="blog-post-data-comment left">
                                    <div class="blog-post-data left"><?php echo get_the_date()?></div><!--/blog-post-data-->
                                    <div class="blog-post-comment left"><?php comments_number( '0', '1', '%' ); ?> <?php _e("Comments", tk_theme_name)?></div><!--/blog-post-comment-->
                                </div><!--/blog-post-data-comment-->

                                <div class="blog-post-text left">
                                    <?php the_excerpt()?>
                                </div><!--/blog-post-data-text-->
                                <div class="title-border left"><span></span></div><!--title-border-->

                            <?php 
                            endwhile;

                            // Reset Post Data
                            wp_reset_postdata();
                            ?>

                    



                </div><!--/blog-post-content-->


            <!--SIDBAR-->
            <?php tk_get_right_sidebar('Right', 'Sidebar Default/Home')?>

            </div><!--/content-page-sidebar-->



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
                            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'small-image');
                            ?>

                    <div class="home-storie-one left">
                        <div class="home-storie-img left"><a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>" class="pirobox" title="<?php the_title(); ?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
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




        </div><!--/wrapper-->
    </div><!--/content-->




<?php get_footer(); ?>
