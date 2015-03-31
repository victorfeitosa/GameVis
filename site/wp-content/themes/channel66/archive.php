<?php get_header();?>

<div class="content left">
    <div class="wrapper">

        <div class="content-page-sidebar left">

            <div class="blog-post-content left">

                <div class="blog-post-data-comment left">

                    <?php if(have_posts()) :  while(have_posts()) : the_post();  ?>

                    <div class="post-title"><a href="<?php the_permalink()?>"><?php the_title()?></a></div>
                    <div class="blog-post-data-comment left">
                        <div class="blog-post-data left"><?php echo get_the_date()?></div><!--/blog-post-data-->
                        <div class="blog-post-comment left"><?php comments_number( '0', '1', '%' ); ?> <?php _e("Comments", tk_theme_name)?></div><!--/blog-post-comment-->
                    </div><!--/blog-post-data-comment-->

                    <div class="blog-post-text left">
                                <?php the_excerpt()?>
                    </div><!--/blog-post-data-text-->
                    <div class="title-border left"><span></span></div><!--title-border-->

                        <?php endwhile; else : ?>

                    <?php endif; ?>

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
                        $search_array = array('<span','</span>', '<a', '</a>');
                        $replace_array = array(
                                '<div class="pagination-button left"><span',
                                '</span></div>',
                                '<div class="pagination-button left"><div class="pagination-left left"></div><a',
                                '</a><div class="pagination-right left"></div></div>',
                        );
                        $pageing = str_replace($search_array, $replace_array, $pageing);
                        echo $pageing;
                        ?>
                    </div>

                </div><!--/content-right-->
            </div><!--/content-right-->

            <!--SIDBAR-->
            <?php tk_get_right_sidebar('Right', 'Archive/Search')?>
        </div><!--/content-right-->


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