<?php get_header();
$prefix = 'tk_';
$enable_slider = get_theme_option(tk_theme_name.'_home_enable_slider');
$slider_cat = get_theme_option(tk_theme_name.'_home_slider_category');
?>

       <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">



            <div class="post-home-content left">

                <?php
                wp_reset_postdata();
                $the_query = new WP_Query( array( 'posts_per_page' => 4, 'offset' => 2 ) );
                while ( $the_query->have_posts() ) : $the_query->the_post();
                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium-image');
                ?>
                <div class="post-home left">
                    <a href="<?php the_permalink()?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a>
                    <div class="hover-post-home">
                        <span><?php the_title()?></span>
                        <a href="<?php the_permalink()?>"></a>
                    </div><!--/hover-post-home-->
                </div><!--/fpost-home-->

                <?php
                endwhile;

                // Reset Post Data
                wp_reset_postdata();
                ?>

            </div><!--/post-home-content-->

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
            <?php } ?>



        <?php
        $disable_authors = get_theme_option(tk_theme_name.'_home_disable_authors');
        if($disable_authors !== 'yes') {
        ?>
<?php
        /*************************************************************/
        /************AUTHORS****************************************/
        /*************************************************************/

        $disable_authors = get_theme_option(tk_theme_name.'_home_disable_authors');
        $author_1 = get_theme_option(tk_theme_name.'_home_author_box_1');
        $author_2 = get_theme_option(tk_theme_name.'_home_author_box_2');
        $author_3 = get_theme_option(tk_theme_name.'_home_author_box_3');
        $author_4 = get_theme_option(tk_theme_name.'_home_author_box_4');
        $author_5 = get_theme_option(tk_theme_name.'_home_author_box_5');
        $author_6 = get_theme_option(tk_theme_name.'_home_author_box_6');
?>
            <div class="home-authors left">
                <div class="home-authors-text left">
                    <span style="margin-top: 10px;"><?php _e("Look who are prominent authors", tk_theme_name)?></span>
                </div><!--/home-authors-text-->
                <div class="home-authors-images right">
                    <div class="home-authors-img left"><a href="<?php echo get_author_posts_url( $author_1 )?>"><?php echo get_avatar($author_1,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                    <div class="home-authors-img left"><a href="<?php echo get_author_posts_url( $author_2 )?>"><?php echo get_avatar($author_2,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                    <div class="home-authors-img left"><a href="<?php echo get_author_posts_url( $author_3 )?>"><?php echo get_avatar($author_3,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                    <div class="home-authors-img left"><a href="<?php echo get_author_posts_url( $author_4 )?>"><?php echo get_avatar($author_4,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                    <div class="home-authors-img left"><a href="<?php echo get_author_posts_url( $author_5 )?>"><?php echo get_avatar($author_5,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                    <div class="home-authors-img left"><a href="<?php echo get_author_posts_url( $author_6 )?>"><?php echo get_avatar($author_6,$size='79',$default='<path_to_url>' ); ?></a></div><!--/home-authors-img-->
                </div><!--/home-authors-images-->
            </div><!--/home-authors-->
            <?php } ?>



        <?php
        $disable_categories = get_theme_option(tk_theme_name.'_home_disable_category');
        if($disable_categories !== 'yes') {
        ?>
<?php
        /*************************************************************/
        /************CATEGORIES*************************************/
        /*************************************************************/


        $category_1 = get_theme_option(tk_theme_name.'_home_category_box_1');
        $category_2 = get_theme_option(tk_theme_name.'_home_category_box_2');
        $category_3 = get_theme_option(tk_theme_name.'_home_category_box_3');
?>
            <div class="home-stories left">
                <div class="home-stories-content left">
                    <div class="home-stories-title left"><span><?php _e("Category: ", tk_theme_name)?></span></div><!--/home-stories-title-->

                    <div class="home-posts-post-links left">

                        <div class="home-storie-one left">

                        <?php
                            wp_reset_postdata();
                            $post_counter = 1;
                            $the_query = new WP_Query( array( 'cat' => $category_1, 'post_status' => 'publish', 'posts_per_page' => 5, 'ignore_sticky_posts'=> 1 ) );
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                                $post_views = get_post_meta($post->ID, 'post_stats', true);
                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'small-image');
                            ?>
                                <?php if($post_counter == 1){?>
                                <div class="home-storie-title left"><?php echo get_cat_name( $category_1 )?><a href="<?php echo get_category_link( $category_1 );?>"></a></div><!--/home-storie-title-->
                                <div class="home-storie-img left"><a href="<?php the_permalink()?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
                                <div class="home-storie-text left">
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                    <p style="margin-bottom: 10px;"><?php echo $post_views?></p>
                                </div><!--/home-storie-text-->
                                <?php }else{?>
                                <div class="home-storie-post-links left">
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                </div><!--/home-storie-post-links-->
                                <?php }?>
                            <?php $post_counter++;
                            endwhile;

                            // Reset Post Data
                            wp_reset_postdata();
                            ?>
                        </div><!--/home-storie-one-->


                        <div class="home-storie-one left">

                        <?php
                            wp_reset_postdata();
                            $post_counter = 1;
                            $the_query = new WP_Query( array( 'cat' => $category_2, 'post_status' => 'publish', 'posts_per_page' => 5, 'ignore_sticky_posts'=> 1 ) );
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                                $post_views = get_post_meta($post->ID, 'post_stats', true);
                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'small-image');
                            ?>
                                <?php if($post_counter == 1){?>
                                <div class="home-storie-title left"><?php echo get_cat_name( $category_2 )?><a href="<?php echo get_category_link( $category_2 );?>"></a></div><!--/home-storie-title-->
                                <div class="home-storie-img left"><a href="<?php the_permalink()?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
                                <div class="home-storie-text left">
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                    <p style="margin-bottom: 10px;"><?php echo $post_views?></p>
                                </div><!--/home-storie-text-->
                                <?php }else{?>
                                <div class="home-storie-post-links left">
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                </div><!--/home-storie-post-links-->
                                <?php }?>
                            <?php $post_counter++;
                            endwhile;

                            // Reset Post Data
                            wp_reset_postdata();
                            ?>
                        </div><!--/home-storie-one-->

                        
                        <div class="home-storie-one left">

                        <?php
                            wp_reset_postdata();
                            $post_counter = 1;
                            $the_query = new WP_Query( array( 'cat' => $category_3, 'post_status' => 'publish', 'posts_per_page' => 5, 'ignore_sticky_posts'=> 1 ) );
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                                $post_views = get_post_meta($post->ID, 'post_stats', true);
                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'small-image');
                            ?>
                                <?php if($post_counter == 1){?>
                                <div class="home-storie-title left"><?php echo get_cat_name( $category_3 )?><a href="<?php echo get_category_link( $category_3 );?>"></a></div><!--/home-storie-title-->
                                <div class="home-storie-img left"><a href="<?php the_permalink()?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
                                <div class="home-storie-text left">
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                    <p style="margin-bottom: 10px;"><?php echo $post_views?></p>
                                </div><!--/home-storie-text-->
                                <?php }else{?>
                                <div class="home-storie-post-links left">
                                    <a href="<?php the_permalink()?>"><?php the_title()?></a>
                                </div><!--/home-storie-post-links-->
                                <?php }?>
                            <?php $post_counter++;
                            endwhile;

                            // Reset Post Data
                            wp_reset_postdata();
                            ?>
                        </div><!--/home-storie-one-->

                    </div><!--/home-posts-post-links-->





                    <!--SIDBAR-->
                    <?php tk_get_right_sidebar('Right', 'Sidebar Default/Home')?>


                </div><!--/home-stories-content-->
            </div><!--/home-stories-->
            <?php } ?>


        </div><!--/wrapper-->
    </div><!--/content-->



            
<?php get_footer(); ?>