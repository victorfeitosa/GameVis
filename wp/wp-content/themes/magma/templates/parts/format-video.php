<?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){
        $prefix = 'tk_';
        $blog_id = get_option('id_blog_page');
        $sidebar_selected = get_post_meta($post->ID, 'tk_sidebar', true);
        $sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
        $enable_slider = get_post_meta($wp_query->post->ID, 'tk_enable_slider', true);
        $check_image_single = get_the_post_thumbnail();
        $rating_position = get_post_meta($post->ID, 'tk_rating_position' );
        $check_rating = get_post_meta($post->ID, 'tk_enable_rating', true);
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>

<div class="block bg-content single-post">

    <?php if($enable_slider) { ?>
        <div class="block slider-page">
            <?php get_template_part('/templates/parts/header', 'slider'); ?>
        </div>
    <?php } //check if slider is turned on?>

    <div class="container post-with-video">
        <div class="sc-fullwidth-holder row">

            <?php if($video_link) { ?>
                <div class="video scalable-wrapper">
                    <div class="scalable-elementr">
                        <div class="tk-video-holder">
                          <?php tk_video_player($video_link) ;?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="white-bg <?php if($check_image_single) { echo 'white-bg-no-margin'; } else { echo 'white-bg-margin'; } ?>">

                <div class="content-with-sidebar <?php if($sidebar_postition == 'fullwidth'){echo 'col-xs-12';}elseif($sidebar_postition == 'left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?>">

                    <?php if ($sidebar_postition == 'right') { ?>
                        <div class="shadow-box"></div>
                    <?php } elseif ($sidebar_postition == 'left') { ?>
                        <div class="shadow-box-left"></div>
                    <?php } ?>
                    <div class="block single-post-page shortcodes">
                        <ul class="rating">
                            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                        </ul>

                        <h1><?php the_title()?></h1>
                        
                        <?php  if(is_sticky()) { ?><div class="sticky featured-banner"><?php _e('Featured Post', 'tkingdom') ?></div><?php } ?>

                        <?php // top rating
                            if($check_rating == 'on' && $rating_position[0] == 'top_rating') {
                              get_template_part( '/templates/parts/entry', 'rating' ); 
                            }
                        ?>

                        <!-- Post content-->
                        <?php the_content(); ?>

                        
                        <?php //bottom rating
                            if($check_rating == 'on' && $rating_position[0] == 'bot_rating') {
                              get_template_part( '/templates/parts/entry', 'rating' ); 
                            }
                        ?>


                        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                        <!-- Tag Cloud -->
                        <?php $check_tags = get_the_tags();
                        if ($check_tags) { ?>
                            <div class="tag-widget">
                                <?php the_tags('', ''); ?>
                            </div>
                        <?php } ?>
                        <!-- /Tag Cloud -->


                        <div class="shares-content">
                            <?php get_template_part( '/templates/parts/entry', 'social' ); ?>
                        </div><!--/single-soc-share-->


                        <div class="posts-single">
                              <?php
                                $prev_post = get_previous_post();
                                $next_post =  get_next_post();
                              ?>
                              <?php if(isset($prev_post->guid)) { ?>
                                  <div class="gallery-single-prev left">
                                      <a href="<?php echo $prev_post->guid; ?>"><div class="box-previous"></div><span><?php _e('Previous Post', 'tkingdom'); ?></span></a>

                                      <p>
                                          <?php echo $prev_post->post_title; ?>
                                      </p>
                                  </div><!--/gallery-single-prev-->
                              <?php } ?>


                              <?php if(isset($next_post->guid)) { ?>
                                  <div class="gallery-single-next right">
                                      <a href="<?php echo $next_post->guid; ?>"><div class="box-next"></div><span><?php _e('Next Post', 'tkingdom'); ?></span></a>

                                      <p>
                                          <?php echo $next_post->post_title; ?>
                                      </p>
                                  </div><!--/gallery-single-next-->
                              <?php }  ?>
                        </div><!--/gallery-single-pagination-->

                        <?php
                        // POST BANNER
                        $post_banner = get_post_meta($post->ID, 'tk_advertising', true);                        
                        $custom_banner =  get_post_meta($wp_query->post->ID,'custom_banner_code', true);

                        if(!empty($custom_banner)){ ?>
                            <div class="header-baner right">
                                <?php 
                                    tk_add_banner_view($post_banner);
                                    echo $custom_banner; 
                                ?>
                            </div>
                        <?php } else {

                            if ($post_banner && $post_banner != 'none') {
                                $ad_status = get_post_status($post_banner);
                                if($ad_status == 'publish'): //Checking if advertisement is published
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_banner), 'banner_wide');
                                    $post_title = get_the_title($post_banner);
                                    tk_add_banner_view($post_banner);
                                    ?>              
                                    <div class="baners">

                                        <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $post_banner; ?>">
                                            <img src="<?php echo $image[0]; ?>" alt="<?php echo $post_title ?>" title="<?php echo $post_title ?>" />
                                        </a>
                                    </div>
                                <?php endif; ?>
                        <?php } 
                        } ?>

                        <?php $disable_author = get_post_meta($post->ID, 'tk_disable_author', true);
                            if ($disable_author != 'on') { ?>
                            <?php get_template_part( '/templates/parts/entry', 'author' ); ?>
                        <?php }?>

                        <!--COMMENTS-->
                        <?php if (comments_open()) : ?>
                            <?php comments_template(); // Get wp-comments.php template  ?>
                        <?php endif; ?>




                 </div><!--/block single-post-page shortcodes -->
            </div><!--/content-with-sidebar col-xs -->
            <?php
            if ($sidebar_postition == 'left'){
                echo '<div class="col-xs-4 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                tk_get_sidebar('Left', $sidebar_selected);
                echo '</div></div>';
            }
            ?>
            <!-- Sidebar Right -->
            <?php
            if ($sidebar_postition == 'right'){
                echo '<div class="col-xs-4 pull-right" id="sidebar" ><div class="sidebar-content">';
                tk_get_sidebar('Right', $sidebar_selected);
                echo '</div></div>';
            }
            ?> 
        </div><!--/row white-bg-->
    </div>
</div><!-- /container -->    

   <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Archive                       */
    /*                                                          */
    /************************************************************/
    } else { ?>

    <?php 
    $cur_cat_id = get_cat_id( single_cat_title("",false) );
    $cur_category = get_cat_name( $cur_cat_id );
    $category = get_category( get_query_var( 'cat' ) );
    //$cat_id = $category->cat_ID;
    //$cat_option = get_option('sidebar_' . $cat_id);
    if(is_home()) {
        $category_display = get_theme_option(wp_get_theme()->name . '_home_home_posts_layout');
    } elseif(is_search() || is_author() || is_tag()) {
        $category_display = get_theme_option(wp_get_theme()->name . '_general_cat_page_layout');        
    } else {
        $category_display = get_option("category_display_$cur_cat_id");
    }
    $category_layout_sb = get_option("category_layout_$cur_cat_id");
    $post_id = $cur_cat_id;
    $video_link = get_post_meta($post->ID, 'tk_video_link', true);
    $pos_youtube = strpos($video_link, 'youtube');
    ?>
    <?php if ( $category_display == 'cat_layout_one' ) { ?>

    <div class="row full-width-posts">
        <div class="block <?php if (is_sticky()) { echo 'featured-post'; } ?> <?php if( has_post_thumbnail()) { echo 'post-with-image'; } else { echo 'post-no-image'; } ?>">

                <?php if(has_post_thumbnail()){

                    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-archive-one-col' );
                    $post_thumbnail_src = $post_thumbnail['0']; ?>
                    <div class="row">
                    <div class="col-xs-3">
                        <a class="fancybox link-home-images <?php if (!empty($pos_youtube)){echo 'youtube';}else{echo 'vimeo';}?>" href="<?php echo $video_link; ?>" title="<?php echo the_title() ?>">
                            <img src="<?php echo $post_thumbnail_src; ?>" alt="<?php the_title()?>" title="<?php the_title()?>" />
                            <?php
                                /*
                                 * RATING SYSTEM
                                 */
                                $i = 0;
                                $overal_rating = 0;
                                $check_rating = get_post_meta($wp_query->post->ID, 'tk_enable_rating', true);
                                $check_user_rating = get_post_meta($wp_query->post->ID, 'tk_reader_rating', true);
                                if ($check_rating == 'on') {
                                    $post_rating = get_post_meta($wp_query->post->ID, 'tk_post_rating', true);
                                    $total_label = get_post_meta($wp_query->post->ID, 'tk_rating_total', true);
                                    $post_rating_criteria = get_post_meta($wp_query->post->ID, 'criteria-tk_post_rating', true);
                                    $post_rating_rate = get_post_meta($wp_query->post->ID, 'rating-tk_post_rating', true);

                                    ?>
                                            <?php foreach ($post_rating as $one_criteria) { ?>
                                                    <?php $post_rating_criteria[$i] ?>
                                                    <?php $post_rating_rate[$i]; ?>
                                            <?php 
                                            $overal_rating = $overal_rating + $post_rating_rate[$i];
                                            $i++;
                                            } ?>
                            <p class="rating-value"><?php echo round($overal_rating / $i, 1); ?></p>
                            <?php } ?>
                        </a>
                    </div>

                    <div class="col-xs-9 <?php if( !$post->post_excerpt ) { echo 'content-holder'; }?>">
                        <a href="<?php the_permalink()?>" class="full-post-title">
                            <?php 
                            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                            if($video_link) { ?><i class="fa fa-youtube-play"></i><?php } ?>
                            <?php the_title()?></a>
                        <ul class="rating">
                            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                        </ul>
                            <?php
                            if( $post->post_excerpt ) {
                                the_excerpt();
                            } else { ?>
                                <div class="shortcodes">
                                    <?php the_content('More...'); ?>
                                </div>
                            <?php } ?>

                    </div>
                    <?php if (is_sticky()) { ?><div class="featured-banner"><?php _e('Featured Post', 'tkingdom'); ?></div><?php } ?>
                    </div>

                <?php } else { ?>

                    <a href="<?php the_permalink()?>" class="half-post-title"><?php the_title()?></a>
                    <ul class="rating">
                        <?php
                            /*
                             * RATING SYSTEM
                             */
                            $i = 0;
                            $overal_rating = 0;
                            $check_rating = get_post_meta($wp_query->post->ID, 'tk_enable_rating', true);
                            $check_user_rating = get_post_meta($wp_query->post->ID, 'tk_reader_rating', true);
                            if ($check_rating == 'on') {
                                $post_rating = get_post_meta($wp_query->post->ID, 'tk_post_rating', true);
                                $total_label = get_post_meta($wp_query->post->ID, 'tk_rating_total', true);
                                $post_rating_criteria = get_post_meta($wp_query->post->ID, 'criteria-tk_post_rating', true);
                                $post_rating_rate = get_post_meta($wp_query->post->ID, 'rating-tk_post_rating', true);

                                ?>
                                        <?php foreach ($post_rating as $one_criteria) { ?>
                                                <?php $post_rating_criteria[$i] ?>
                                                <?php $post_rating_rate[$i]; ?>
                                        <?php 
                                        $overal_rating = $overal_rating + $post_rating_rate[$i];
                                        $i++;
                                        } ?>
                        <p class="rating-value-meta"><?php echo round($overal_rating / $i, 1); ?></p>
                        <?php } ?>
                            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                    </ul>
                        <?php
                        if( $post->post_excerpt ) {
                            the_excerpt();
                        } else { ?>
                            <div class="shortcodes">
                                <?php the_content('More...'); ?>
                            </div>
                        <?php } ?>
                    <?php if (is_sticky()) { ?><div class="featured-banner"><?php _e('Featured Post', 'tkingdom'); ?></div><?php } ?>

                <?php } ?>
         </div>
    </div>

    <?php  } else {  ?>

    <?php if(has_post_thumbnail()){

    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-archive-one-col' );
    $post_thumbnail_src = $post_thumbnail['0']; ?>

    <div class="col-xs-6">
        <div class="block post-with-image">
            <a class="fancybox link-home-images <?php if (!empty($pos_youtube)){echo 'youtube';}else{echo 'vimeo';}?>" href="<?php echo $video_link; ?>" title="<?php echo the_title() ?>">
                <img src="<?php echo $post_thumbnail_src; ?>" alt="image" title="image" />
                <?php
                    /*
                     * RATING SYSTEM
                     */
                    $i = 0;
                    $overal_rating = 0;
                    $check_rating = get_post_meta($wp_query->post->ID, 'tk_enable_rating', true);
                    $check_user_rating = get_post_meta($wp_query->post->ID, 'tk_reader_rating', true);
                    if ($check_rating == 'on') {
                        $post_rating = get_post_meta($wp_query->post->ID, 'tk_post_rating', true);
                        $total_label = get_post_meta($wp_query->post->ID, 'tk_rating_total', true);
                        $post_rating_criteria = get_post_meta($wp_query->post->ID, 'criteria-tk_post_rating', true);
                        $post_rating_rate = get_post_meta($wp_query->post->ID, 'rating-tk_post_rating', true);

                        ?>
                                <?php foreach ($post_rating as $one_criteria) { ?>
                                        <?php $post_rating_criteria[$i] ?>
                                        <?php $post_rating_rate[$i]; ?>
                                <?php 
                                $overal_rating = $overal_rating + $post_rating_rate[$i];
                                $i++;
                                } ?>
                <p class="rating-value"><?php echo round($overal_rating / $i, 1); ?></p>
                <?php } ?>
            <a href="<?php the_permalink()?>">
                <?php 
                $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                if($video_link) { ?><i class="fa fa-youtube-play"></i><?php } ?>
                <?php the_title()?></a>
                        <?php
                        if( $post->post_excerpt ) {
                            the_excerpt();
                        } else { ?>
                            <div class="shortcodes">
                                <?php the_content('More...'); ?>
                            </div>
                        <?php } ?>
                ?>
            <ul class="rating meta-border">
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
            </ul>
        </div>
    </div>

    <?php } else { ?>

    <div class="col-xs-6">
        <div class="block post-no-image">
            <a href="<?php the_permalink()?>" class="half-post-title"><?php the_title()?></a>
                <?php
                if( $post->post_excerpt ) {
                    the_excerpt();
                } else { ?>
                    <div class="shortcodes">
                        <?php the_content('More...'); ?>
                    </div>
                <?php } ?>
            <ul class="rating meta-border">
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
            </ul>
        </div>
    </div>

    <?php } } }; ?>