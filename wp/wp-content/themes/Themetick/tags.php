<?php get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta(get_option('id_blog_page'), $prefix.'sidebar_position', true);
    $cats = get_the_category($post->ID);
    $curent_url = get_page_url();
        foreach($cats as $one_cat){
            $key = strtolower($one_cat->name);
            $cat_name = strpos($curent_url, $key);
            if($cat_name !== false){
                $page_title = $one_cat->name;
            }
        }
?>
    <!-- CONTENT -->
    <div class="content left">


        <div class="bg-white left">
            <div class="wrapper">
                <div class="title-on-page left">
                    <div class="point-border-title left"><h5><?php echo $page_title?></h5></div><!--/point-border-title-->
                </div><!--/title-on-page-->
            </div><!--/wrapper-->
            <div class="border-bottom-slider left"></div>
        </div><!--/bg-white-->



        <div class="wrapper">


            <?php tk_get_left_sidebar($sidebar_position, 'Archive/Search')?>


            <div class="blog-page-content left">
		<?php if(have_posts()) :  while(have_posts()) : the_post(); ?>

                <!-- BLOG-POST -->
                <div class="blog-one left">
                    <div class="blog-images-title left" style="margin-top: 80px">
                        <div class="blog-title-box left" ><a href="<?php the_permalink()?>"><?php the_title() ?></a></div>
                    </div><!--/blog-images-title-->
                    <div class="post-date-content right">
                        <ul>
                            <li><span><?php _e("Posted:", 'Themetick')?></span></li>
                            <li><?php echo get_the_date()?></li>
                        </ul>
                        <ul>
                            <li><span><?php _e("Categories:", 'Themetick')?></span></li>
                            <li><?php echo get_the_category_list( '&nbsp; &nbsp;|&nbsp; &nbsp;', $post->ID ); ?></li>
                        </ul>
                        <ul>
                            <li><span><?php _e("Comments:", 'Themetick')?></span><p><?php comments_number( '0', '1', '%' ); ?></p></li>
                        </ul>
                    </div><!--/post-date-->
                    <div class="post-text left">
                        <p><?php the_excerpt()?></p>
                    </div><!--/text-->
                    <div class="more-info left"><a href="<?php the_permalink()?>"><?php _e("Read more", 'Themetick')?></a></div><!--/call-action-text-->
                </div><!--/content-one-->


		<?php endwhile; else : ?>

		<?php endif; ?>

            </div><!--/blog-page-content-->


            <?php tk_get_right_sidebar($sidebar_position, 'Archive/Search')?>


                </div><!--/bg-content-red-tape-->
    </div><!--/content-->
<div class="bg-down-container left"></div>

<?php get_footer(); ?>