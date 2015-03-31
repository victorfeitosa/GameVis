<?php get_header();
$prefix = 'tk_';
$enable_slider = get_theme_option(tk_theme_name.'_home_enable_slider');
$slider_cat = get_theme_option(tk_theme_name.'_home_slider_category');
?>

<div class="slider-content left">
        <div class="wrapper">
            
            <div class="home-slider-fix">

            <div class="flexslider">
                <ul class="slides">

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args=array('cat' => $slider_cat,'post_status' => 'publish', 'ignore_sticky_posts'=> 1,  'posts_per_page' => 100);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $author = get_userdata( $post->post_author );
                    $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                    ?>
                        <li>
                            <div class="slider-images left">
                                        <?php
                                        if($video_link) {
                                            tk_video_player($video_link);
                                        }else {
                                            $attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
                                            if (!empty($attachments)) {
                                                ?>
                                                <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $attachments[0]; ?>" alt="<?php the_title()?>" title="<?php the_title()?>" style="float:left;width: 100%"/></a>

                                                <?php }
                                            elseif(has_post_thumbnail()) {
                                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slider-image');
                                                ?>
                                                <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"  title="<?php the_title()?>" style="float:left;width: 100%"/></a>

                                                <?php }
                                        }
                                        ?>
                                <div class="white-triangle right"></div>
                            </div><!--/slider-images-->
                            <div class="flex-caption right">
                                <div class="slider-title left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/slider-title-->
                                <div class="slider-comments left"><span><?php the_author_posts_link();?> / <?php echo get_the_date()?></span><span><?php comments_number( '0', '1', '%' ); ?> <?php _e('COMMENTS', tk_theme_name) ?></span></div><!--/slider-comments-->
                                <div class="slider-text left"><?php the_excerpt_length(170)?></div><!--/slider-text-->
                                <div class="slider-more-info left">
                                    <div class="white-bg-more-info right">
                                        <a href="<?php the_permalink()?>">
                                            <div>
                                                <div class="button-left-16 left"></div>
                                                <div class="button-center-16 left"><?php _e('More info', tk_theme_name) ?></div>
                                                <div class="button-right-16 left"></div>
                                            </div>
                                        </a>
                                    </div><!--/white-bg-more-info-->
                                </div><!--/slider-more-info-->
                            </div><!--/flex-caption-->
                        </li>
                    <?php  endwhile;?>
                    <?php else: ?>
                    <?php endif; ?>

                </ul>
            </div><!--/flexslider-->
        </div>
        </div><!--/wrapper-->
    </div><!--/slider-content-->





<!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="bg-content left">

                <div class="content-left left">

                <?php
                $recent_posts = get_theme_option(tk_theme_name.'_home_recent_posts');
                $recent_number = get_theme_option(tk_theme_name.'_home_recent_number');
                if(empty($recent_number)) {$recent_number = 2;}
                if($recent_posts !== 'yes') {
                ?>
                    
                    <div class="recent-news-home left">
                        <div class="title-home left"><?php _e('Recent News', tk_theme_name) ?></div><!--/title-home-->

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args=array('post_status' => 'publish', 'ignore_sticky_posts'=> 1,  'posts_per_page' => $recent_number);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $author = get_userdata( $post->post_author );
                    $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                    ?>

                        <div class="recent-news-one left">
                                        <?php
                                        if($video_link) {?>
                                            <div class="recent-news-one-images left">
                                                <?php tk_video_player($video_link); ?>
                                            </div>
                                        <?php }else {
                                            $attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
                                            if(!empty($attachments)){
                                            if ($attachments[0] != '') {
                                                ?>
                                                <div class="recent-news-one-images left">
                                                    <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo tk_get_thumb_new(251, 159, $attachments[0]); ?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                                                </div><!--/recent-news-one-images-->
                                                <?php }
                                            elseif(has_post_thumbnail()) {
                                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slider-image');
                                                ?>
                                                <div class="recent-news-one-images left">
                                                    <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                                                </div><!--/recent-news-one-images-->

                                                <?php }
                                        }}
                                        ?>

                            <div class="recent-news-one-title left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/recent-news-one-title-->
                            <div class="recent-news-one-comment left">
                                <span><?php the_author_posts_link();?> / <?php echo get_the_date()?></span>
                                <span><?php comments_number( '0', '1', '%' ); ?> <?php _e('COMMENTS', tk_theme_name) ?></span>
                            </div><!--/recent-news-one-comment-->
                            <div class="recent-news-one-text left"><?php the_excerpt_length(170)?></div><!--/recent-news-one-text-->
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
                        </div><!--/recent-news-one-->

                    <?php  endwhile;?>
                    <?php else: ?>
                    <?php endif; ?>

                    </div><!--/recent-news-home-->
                <?php }?>

                <?php
                $categories_posts = get_theme_option(tk_theme_name.'_home_categories');
                $cat_number_of_posts = get_theme_option(tk_theme_name.'_home_number_of_posts');
                if(empty($recent_number)) {$recent_number = 4;}
                if($categories_posts !== 'yes') {
                ?>     
                    
              <?php
                $args = array(
                        'orderby'            => 'name',
                        'hide_empty'         => 1,
                        'depth'              => 10,
                );
                $categories = get_categories($args);
                $number_of_posts = get_theme_option(tk_theme_name.'_home_number_of_posts');
                $catarray = array();
                foreach ($categories as $category_list ) {
                  $catarray = get_theme_option(tk_theme_name.'_home_cat_'.$category_list->term_id);
                  if($catarray == 'yes'){
              ?>


<!-- CATEGORY -->
                    <div class="recent-news-home left">
                        <div class="title-home left"><?php echo $category_list->cat_name ?></div><!--/title-home-->

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args=array('cat' => $category_list->term_id, 'post_status' => 'publish', 'ignore_sticky_posts'=> 1,  'posts_per_page' => $cat_number_of_posts);
                    

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                    $attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
                    ?>

                        <div class="nature-home-one left">
                                        <?php if($video_link) {?>
                                        <div class="nature-home-one-images left">               
                                            <?php tk_video_player($video_link);?>
                                        </div><!--/nature-home-one-images-->
                                        <?php }else {

                                            if ($attachments[0] != '') {
                                                ?>
                                                <div class="nature-home-one-images left">    
                                                    <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo tk_get_thumb_new(208, 132, $attachments[0]); ?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                                                </div><!--/nature-home-one-images-->
                                                <?php }
                                            elseif(has_post_thumbnail()) {
                                                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'category-image');
                                                ?>
                                                <div class="nature-home-one-images left">   
                                                    <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" title="<?php the_title()?>"  style="float:left;width: 100%"/><span></span></a>
                                                </div><!--/nature-home-one-images-->
                                                <?php }
                                        }
                                        ?>

                            <div class="nature-home-one-right left" <?php if (empty($video_link) && $attachments[0] == '' && !has_post_thumbnail()){echo 'style="width: auto;max-width: none;margin: 0;"';}?>>
                                <div class="recent-news-one-title left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/recent-news-one-title-->
                                <div class="recent-news-one-comment left">
                                    <span><?php the_author_posts_link();?> / <?php echo get_the_date()?></span>
                                    <span><?php comments_number( '0', '1', '%' ); ?> <?php _e('COMMENTS', tk_theme_name) ?></span>
                                </div><!--/recent-news-one-comment-->
                                <div class="recent-news-one-text left"><?php the_excerpt_length(190)?></div><!--/recent-news-one-text-->
                            </div><!--/nature-home-one-right-->
                        </div><!--/nature-home-one-->

                    <?php  endwhile;?>
                    <?php else: ?>
                    <?php endif; ?>

                        <div class="slider-more-info left">
                            <div class="white-bg-more-info right">
                                <a href="<?php echo get_category_link( $category_list->term_id ); ?>">
                                    <div>
                                        <div class="button-left-16 left"></div>
                                        <div class="button-center-16 left"><?php _e('View All', tk_theme_name) ?></div>
                                        <div class="button-right-16 left"></div>
                                    </div>
                                </a>
                            </div><!--/white-bg-more-info-->
                        </div><!--/slider-more-info-->

                    </div><!--/recent-news-home-->

                <?php }}} ?>

                </div><!--/content-left-->


                <!--SIDBAR-->

                    <?php tk_get_right_sidebar('Right', 'Sidebar Default/Home')?>


                <div class="silver-big-fake right"></div><!--/silver-big-fake-->

            </div><!--/bg-content-->

            <div class="help-content-down left"><div class="silver-big-fake right"></div></div><!--/help-content-down-->

        </div><!--/wrapper-->
    </div><!--/content-->



            
<?php get_footer(); ?>