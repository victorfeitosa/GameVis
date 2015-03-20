<?php

get_header(); ?>

    <!-- CONTENT -->
 <div class="content left">
        <div class="wrapper">

            <div class="shortcodes left">

                <div class="content-404 left">
                    <span><?php _e("Looks like the page you were looking for does not exist. </br> Sorry about that.", tk_theme_name)?></span>
                    <div class="link-404"><p><?php _e("Check the web address for typos, or go to", tk_theme_name)?></p><a href="<?php echo home_url()?>"><?php _e("Home page", tk_theme_name)?></a></div>
                </div><!--/content-404-->

            </div><!--/shortcodes-->


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