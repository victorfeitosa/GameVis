<?php get_header();
$prefix = 'tk_';?>

<style>
    .content-category #sidebar {
        margin: 30px 25px 0 0!important;
    }
    .silver-big-fake{top: 302px!important}
</style>
    <!-- CONTENT -->
    <div class="content-category left">
        <div class="wrapper">
            <div class="bg-content left">

                <div class="content-left left">


                    <?php

                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $author = get_userdata( $post->post_author );
                            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                            ?>

                    <div class="category-post-one left">

                        <?php
                        if($video_link) {?>
                        <div class="category-post-one-img left">
                            <?php tk_video_player($video_link);?>
                        </div><!--/category-post-one-img-->
                        <?php }else {
                            $attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
                            if ($attachments[0] != '') {
                                ?>
                        <div class="category-post-one-img left">
                            <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo tk_get_thumb_new(208, 132, $attachments[0]); ?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                            <div class="category-post-icon-img"></div><!--/category-post-icon-img-->
                        </div><!--/category-post-one-img-->
                                <?php }
                            elseif(has_post_thumbnail()) {
                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'category-image');
                                ?>
                        <div class="category-post-one-img left">
                            <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                            <div class="category-post-icon-img"></div><!--/category-post-icon-img-->
                        </div><!--/category-post-one-img-->
                                <?php }
                        }
                        ?>
                
                        <div class="category-post-one-text-content right" <?php if ($video_link =='' && $attachments[0] == '' && !has_post_thumbnail()){echo 'style="width: 100%"';}?>>
                            <div class="category-post-one-title left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/category-post-one-title-->
                            <div class="category-post-one-date left">
                                <span><?php the_author_posts_link();?> / <?php echo get_the_date()?></span>
                                <span><?php comments_number( '0', '1', '%' ); ?> <?php _e('COMMENTS', tk_theme_name) ?></span>
                            </div><!--/category-post-one-date-->
                            <div class="category-post-one-text left"><?php the_excerpt()?></div><!--/category-post-one-text-->
                        </div><!--/category-post-one-text-content-->
                    </div><!--/category-post-one-->

		<?php endwhile; else : ?>

                                <h2 class="center"><?php _e("No posts found. Try a different search?", tk_theme_name)?></h2>

		<?php endif; ?>


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
                        $search_array = array('<span','</span>', '<a', '</a>');
                        $replace_array = array(
                            '<div class="small-black"><div class="small-black-left left"></div><div class="small-black-center left" style="color: #fff "><span',
                            '</span></div><div class="small-black-right left"></div></div>',
                            '<div class="small-black"><div class="small-black-left left"></div><div class="small-black-center left"><a style="color: #fff "',
                            '</a></div><div class="small-black-right left"></div></div>',
                            );
                        $pageing = str_replace($search_array, $replace_array, $pageing);
                        echo $pageing;
                        ?>
                    </div><!--/pagination-->

                </div><!--/content-left-->

                <!--SIDBAR-->
                  <?php tk_get_right_sidebar('Right', 'Archive/Search/Author')?>

                <div class="silver-big-fake right"></div><!--/silver-big-fake-->

            </div><!--/bg-content-->

            <div class="help-content-down left"><div class="silver-big-fake right"></div></div><!--/help-content-down-->

        </div><!--/wrapper-->
    </div><!--/content-category-->


<?php get_footer(); ?>