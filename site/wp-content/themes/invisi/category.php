<?php get_header(); 
$cur_cat_id = get_cat_id( single_cat_title("",false) );
$prefix = 'tk_';
?>


    <!-- SLIDER CONTENT -->
    <div class="slider-content left">
        <div class="wrapper">

                <?php
                $number_of_posts = get_theme_option(tk_theme_name.'_home_number_of_posts');
                $query = array(
                        'cat' => $cur_cat_id,
                        'post_type' => 'post',
                        'posts_per_page' => '1'
                );
                $the_query = new WP_Query( $query );
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    $rememberthepost = $post->ID;
                    $post_views = get_post_meta($post->ID, 'post_stats', true);
                    $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'recent-image');
                    $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                    ?>

                    <div class="bg-category-pages left">
                        <div class="category-pages-content left">

                            <div class="category-post-first left">
                                        <?php
                                        if($video_link) {?>
                                        <div class="category-post-first-img left">
                                            <?php tk_video_player($video_link);?>
                                        </div><!--/category-post-first-img-->
                                        <?php }else {
                                            $attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
                                            if ($attachments[0] != '') {
                                                ?>
                                        <div class="category-post-first-img left">
                                            <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo tk_get_thumb_new(251, 159, $attachments[0]); ?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                                        </div><!--/category-post-first-img-->
                                                <?php }
                                            elseif(has_post_thumbnail()) {
                                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'category-image');
                                                ?>
                                        <div class="category-post-first-img left">
                                            <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                                        </div><!--/category-post-first-img-->
                                                <?php }
                                        }

                                        ?>
                                        <div class="category-post-first-text-content right" <?php if ($video_link =='' && $attachments[0] == '' && !has_post_thumbnail()){echo 'style="width: auto;max-width: none;margin: 0;"';}?>>
                                    <div class="category-post-first-title left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/category-post-first-title-->
                                    <div class="category-post-first-date left">
                                        <span><?php the_author_posts_link();?> / <?php echo get_the_date()?></span>
                                        <span><?php comments_number( '0', '1', '%' ); ?> <?php _e('COMMENTS', tk_theme_name) ?></span>
                                    </div><!--/category-post-first-date-->
                                    <div class="category-post-first-text left"><?php if (!$video_link && empty($attachments) && !has_post_thumbnail()){the_excerpt_length(170);}else{the_excerpt_length(88);}?></div><!--/category-post-first-text-->
                                </div><!--/category-post-first-text-content-->
                                <div class="slider-more-info left">
                                    <div class="silver-bg-more-info right">
                                        <a href="<?php the_permalink()?>">
                                            <div>
                                                <div class="button-left-16 left"></div>
                                                <div class="button-center-16 left"><?php _e('More info', tk_theme_name) ?></div>
                                                <div class="button-right-16 left"></div>
                                            </div>
                                        </a>
                                    </div><!--/silver-bg-more-info-->
                                </div><!--/slider-more-info-->
                            </div><!--/category-post-first-->

                        </div><!--/category-pages-content-->
                    </div><!--/bg-category-pages-->

                <?php
                endwhile;
                // Reset Post Data
                ?>

        </div><!--/wrapper-->
    </div><!--/slider-content-->

    <!-- CONTENT -->
    <div class="content-category left">
        <div class="wrapper">
            <div class="bg-content left">

                <div class="content-left left">

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args=array('cat' => $cur_cat_id,'post_status' => 'publish', 'ignore_sticky_posts'=> 1,  'posts_per_page' => get_option('posts_per_page'), 'paged' => $paged, 'post__not_in' => array($rememberthepost));

                    //The Query
                    query_posts($args);
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
                            <div class="category-post-one-text left"><?php the_excerpt_length(190)?></div><!--/category-post-one-text-->
                        </div><!--/category-post-one-text-content-->
                    </div><!--/category-post-one-->

                    <?php endwhile;?>
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
                  <?php tk_get_right_sidebar('Right', 'Category Template')?>

                <div class="silver-big-fake right"></div><!--/silver-big-fake-->

            </div><!--/bg-content-->

            <div class="help-content-down left"><div class="silver-big-fake right"></div></div><!--/help-content-down-->

        </div><!--/wrapper-->
    </div><!--/content-category-->


<?php get_footer(); ?>
