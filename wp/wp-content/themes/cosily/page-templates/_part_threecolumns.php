<?php
$prefix = "tk_";
$post_id = $post->ID;
$get_post_type = get_option('col_1-'.$post->ID);
$get_post_type_col_center = get_option('col_2-'.$post->ID);
$get_post_type_col_right = get_option('col_3-'.$post->ID);
?>

<div class="wrapper-content left">
    <div class="third-width left">
    
<?php
    if ($get_post_type == 'news') {
        //get title, number of posts and a category for news
        $latest_news_title_left = get_option('sub_news_title_left-'.$post_id);
        $news_post_num_left = get_option('sub_news_number_left-'.$post_id);
        $news_post_cat_left = get_option('sub_news_category_left-'.$post_id);
    ?>
        
        <script type="text/javascript"> 
            // FLEXSLIDER
            jQuery(window).load(function() {
                    jQuery('.flexslider-left<?php echo $post_id; ?>').flexslider({
                        controlNav: false,
                        slideshow: false,
                        prevText: "Prev",           //String: Set the text for the "previous" directionNav item
                        nextText: "Next",  
                        controlsContainer: ".home-navigation-left<?php echo $post_id; ?>"
                    });
            });                  
        </script>

        <div class="home-latest-news-rooms left">
                <div class="home-latest-news left">
                    <div class="home-title-nav home-navigation-left<?php echo $post_id; ?> left">                    
                        <?php if(!empty($latest_news_title_left)){ ?>
                            <span><?php echo $latest_news_title_left; ?></span>
                        <?php } ?>
                    </div><!--/home-title-nav-->


                    <div class="flex-container">
                      <div class="flexslider flexslider-left<?php echo $post_id; ?>">

                        <ul class="slides">
                            <?php
                            $args = array('post_status' => 'publish', 'posts_per_page' => $news_post_num_left, 'cat' => $news_post_cat_left);
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();
                            ?>

                            <li>
                                <div class="home-latest-news-one left">
                                    <?php if(has_post_thumbnail()){ ?><div class="home-latest-news-one-image left"><?php the_post_thumbnail('home-room'); ?></div><?php } ?>
                                    <div class="home-latest-news-one-text-content <?php if(!has_post_thumbnail()) { ?> fullwidth <?php } else { ?>has-thumbnail-text-content <?php } ?> left">
                                        <div class="home-latest-news-one-title left">
                                            <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                            <p><?php _e('Posted:', tk_theme_name);   the_time('F j, Y'); ?></p>
                                        </div>                                  


                                    </div>

                                        <div class="home-latest-news-content-wrap <?php if(!has_post_thumbnail()){ ?>no-thumbnail<?php } ?> left">
                                            <div class="home-latest-news-one-text left">
                                                <p><?php the_excerpt_length(135); ?></p>
                                            </div>
                                            <div class="home-latest-news-one-read-more left"><a href="<?php the_permalink(); ?>"><?php _e('Read More', tk_theme_name); ?></a></div>
                                        </div><!-- content-latest-news-wrap -->

                                </div>
                            </li>
                            <?php endwhile; endif; ?>


                        </ul>
                    </div><!-- flexslider -->
                </div><!-- flex-container -->

                </div><!--/home-latest-news-->
        </div><!-- home-latest-news-wrap -->
    <?php } elseif($get_post_type == 'testimonials') {
                
            //get testimonials page id
            $testimonials_id = get_theme_option('id_testimonials_page');             
            //gets testimonial title                
            $testimonials_title_left = get_option('sub_testimonial_title_left-'.$post_id);                
        ?>

        <div class="home-testimonials left">

            <?php if(!empty($testimonials_title_left)){ ?>
                <div class="home-title-nav left">
                    <span><?php echo $testimonials_title_left; ?></span>
                    <div class="nav-view-all left"><a href="<?php echo get_permalink($testimonials_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                </div><!--/home-title-nav-->
            <?php } ?>       
            <?php
                $i =1;

                //checks for selected post or random testimonial
                $testimonial_post_left = get_option('sub_testimonial_left-'.$post_id);
                $random_post_left = get_option('sub_check_testimonials_left-'. $post_id);


                //depending if post is random or selected
                if($random_post_left[0] == 'yes'){
                 $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                } else {
                 $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post_left);
                }

                //The Query
                query_posts($args);

                //The Loop
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                $name_user = get_post_meta($post->ID, $prefix.'name', true);
                $avatar = get_avatar( $email_avatar, 74);

            ?>

                <div class="home-testimonials-one <?php if(empty($testimonials_title_left)){ ?>testimonial-margin<?php } ?> <?php if($i == 1) { echo 'left';} else { echo 'right';} ?>">
                    <div class="testimonials-wrap left">
                        <div class="home-testimonials-one-image left"><?php echo $avatar; ?></div><!--/home-testimonials-one-image-->
                        <div class="home-testimonials-one-title left">
                            <span><?php the_title(); ?></span>
                            <?php if(!empty($name_user)){ ?><p><?php echo $name_user; ?></p><?php } ?>
                        </div><!--/home-testimonials-one-title-->
                        <div class="home-testimonials-one-text left">
                            <?php the_content(); ?>
                        </div><!--/home-testimonials-one-text-->
                    </div><!-- testimonials-wrap -->
                </div><!--/home-testimonials-one-->

            <?php $i++; endwhile; endif; ?>




        </div><!--/home-testimonials-->

   <?php } elseif($get_post_type == 'gallery') { 
            
          //get gallery page id
            $gallery_id = get_theme_option('id_gallery_page');                
            //gets gallery title                
            $gallery_title = get_option('sub_gallery_title_left-'.$post_id);
            //gets number of posts from page builder 
            $gallery_post_num = get_option('sub_gallery_number_left-'.$post_id);

            ?>
            <div class="horizontal-slider-wrap left">
                <div class="horizontal-slider left">

                    <div class="carousel-wrapper">                    
                        <div class="home-title-nav left">

                            <?php if(!empty($gallery_title)){ ?>
                                <span><?php echo $gallery_title; ?></span>
                            <?php } ?>

                            <div class="nav-prev left"><a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev"><?php _e('Prev', tk_theme_name); ?></a></div>
                            <div class="nav-next left"><a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next"><?php _e('Next', tk_theme_name); ?></a></div>
                        </div><!--/home-title-nav-->


                        <div data-jcarousel="true" data-wrap="circular" class="carousel">                        
                            <ul>
                                <?php
                                    $args = array('post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' =>$gallery_post_num);

                                    // The Query
                                    query_posts ($args);
                                    // The Loop
                                    if (have_posts()): while (have_posts()) : the_post();
                                    $post_format = get_post_format();
                                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                                    $random_name = generateRandomString();

                                ?>
                                <li>
                                    <a href="<?php echo $image_full[0]; ?>" class="fancybox" rel="<?php echo $random_name ?>">
                                        <div class="horisontal-images <?php if($post_format == 'video') {echo 'video-thumb';} ?> left">

                                            <?php 
                                            if($post_format == '') {
                                                 if(has_post_thumbnail()) {the_post_thumbnail('horizontal-slider');} 
                                                 } elseif($post_format == 'video'){
                                                     $video_link = get_post_meta($post -> ID, $prefix.'video_link', true);                                                
                                                     if(!empty($video_link)) {
                                                        get_video_image($video_link, $post->ID);                                                    
                                                     }                                                 
                                                 } elseif($post_format == 'gallery') {
                                                     $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                                     if(!empty($slide_images[0])){ ?>
                                                        <img src="<?php echo tk_get_thumb(200, 157, $slide_images[0]); ?>" alt="<?php the_title(); ?>" />
                                                     <?php } ?>                                                    
                                            <?php } ?>

                                            <div class="horisontal-images-hover">
                                                
                                                <div class="text-wrap">
                                                    <div class="center-wrap">
                                                        <span><?php the_title(); ?></span>
                                                        <p></p>
                                                    </div><!-- center-wrap -->
                                                </div><!-- text-wrap -->    
                                            
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <?php endwhile; endif; ?>                            
                            </ul>
                        </div>
                    </div>
                </div><!--/horizontal-slider-->
            </div><!-- horizontal-slider-wrap -->
        
        <?php } elseif($get_post_type == 'adbanner'){ 
                $ad_post = get_option('sub_bulder_banner_left-' . $post_id);                
                $custom_banner = get_post_meta($ad_post, $prefix.'custom_banner_code', true);
                $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($ad_post), 'full' ); 
                //tk_add_banner_view($ad_post);
                ?>
                <div class="home-content-ad left">

                    <?php if(!empty($custom_banner)) { 
                        echo $custom_banner;        
                    } else { ?>        
                        <a href="<?php site_url(); ?>?banner_id=<?php echo $ad_post; ?>">
                            <img src="<?php echo $image_src[0]; ?>" title="<?php the_title($ad_post)?>" alt="<?php the_title($ad_post)?>"/>
                        </a>
                    <?php } ?>

                </div>
        <?php } elseif($get_post_type =='content') {

            $page_content = get_option('sub_page_content_left-'.$post_id);
            ?>
            <div class="home-page-content last-width left">                
                    <?php wp_reset_query();
                    global $more;    // Declare global $more (before the loop).
                    query_posts('page_id='.$page_content);
                    if (have_posts()) : while (have_posts()) : the_post();
                    ?>
                    
                        <div class="shortcodes" style="margin:0">
                            <?php                   
                                $more = 0;
                                the_content("Read More"); 
                            ?>
                        </div><!--/shortcodes-->
                    
                    <?php
                        endwhile;
                    else:
                    endif;
                    wp_reset_query(); ?>           
            </div><!--/wrapper-->
            
            
      <?php } elseif ($get_post_type == 'rooms') { //checks to see if  rooms are selected in page builder ?>
    
        <?php 
            //gets the room page template id
            $rooms_id = get_theme_option('id_rooms_page'); 
            
            //gets number of posts, title and selected category from page builder 
            $rooms_post_num = get_option('sub_rooms_number_left-'.$post_id);
            $rooms_title = get_option('sub_rooms_title_left-'.$post_id);       
         ?>
        
        <div class="home-rooms left">
            
            <?php if(!empty($rooms_title)){ ?>
                <div class="home-title-nav left">                
                        <span><?php echo $rooms_title; ?></span>
                    <div class="nav-view-all left"><a href="<?php echo get_permalink($rooms_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                </div><!--/home-title-nav-->
            <?php } ?>
                
        <div class="home-rooms-one left">
            <ul>
                <?php
                    $args = array('post_status' => 'publish', 'post_type' => 'rooms', 'posts_per_page' => $rooms_post_num);

                    // The Query
                    query_posts ($args);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                ?>


                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                            <?php if(has_post_thumbnail()){ ?>
                                <span><?php the_post_thumbnail('home-room'); ?></span>
                            <?php } ?>                                    
                    </a>
                </li>

                <?php endwhile; endif; ?>

            </ul>
        </div>
    </div><!--/home-latest-news-->
    
    
<?php }  ?>   
          
    </div><!-- third-width -->
    
    
    
    <div class="third-width left">       
        
    <?php
        if ($get_post_type_col_center == 'news') {
            //get title, number of posts and a category for news
            $latest_news_title_center = get_option('sub_news_title_center-'.$post_id);
            $news_post_num_center = get_option('sub_news_number_center-'.$post_id);
            $news_post_cat_center = get_option('sub_news_category_center-'.$post_id);
        ?>

    <script type="text/javascript"> 
            // FLEXSLIDER
            jQuery(window).load(function() {
                    jQuery('.flexslider-center<?php echo $post_id; ?>').flexslider({
                        controlNav: false,
                        slideshow: false,
                        prevText: "Prev",           //String: Set the text for the "previous" directionNav item
                        nextText: "Next",  
                        controlsContainer: ".home-navigation-center<?php echo $post_id; ?>"
                    });
            });                  
        </script>
        
            <div class="home-latest-news-rooms left">
                    <div class="home-latest-news left">
                        <div class="home-title-nav home-navigation-center<?php echo $post_id; ?> left">                    
                            <?php if(!empty($latest_news_title_center)){ ?>
                                <span><?php echo $latest_news_title_center; ?></span>
                            <?php } ?>
                        </div><!--/home-title-nav-->


                        <div class="flex-container">
                          <div class="flexslider flexslider-center<?php echo $post_id; ?>">

                            <ul class="slides">
                                <?php
                                $args = array('post_status' => 'publish', 'posts_per_page' => $news_post_num_center, 'cat' => $news_post_cat_center);
                                // The Query
                                query_posts ($args);
                                // The Loop
                                if (have_posts()): while (have_posts()) : the_post();
                                ?>

                                <li>
                                    <div class="home-latest-news-one left">
                                        <?php if(has_post_thumbnail()){ ?><div class="home-latest-news-one-image left"><?php the_post_thumbnail('home-room'); ?></div><?php } ?>
                                        <div class="home-latest-news-one-text-content <?php if(!has_post_thumbnail()) { ?> fullwidth <?php } else { ?>has-thumbnail-text-content <?php } ?> left">
                                            <div class="home-latest-news-one-title left">
                                                <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                                <p><?php _e('Posted:', tk_theme_name);   the_time('F j, Y'); ?></p>
                                            </div>                                  


                                        </div>

                                        <div class="home-latest-news-content-wrap <?php if(!has_post_thumbnail()){ ?>no-thumbnail<?php } ?> left">
                                            <div class="home-latest-news-one-text left">
                                                <p><?php the_excerpt_length(135); ?></p>
                                            </div>
                                            <div class="home-latest-news-one-read-more left"><a href="<?php the_permalink(); ?>"><?php _e('Read More', tk_theme_name); ?></a></div>
                                        </div><!-- content-latest-news-wrap -->

                                    </div>
                                </li>
                                <?php endwhile; endif; ?>


                            </ul>
                        </div><!-- flexslider -->
                    </div><!-- flex-container -->

                    </div><!--/home-latest-news-->
            </div><!-- home-latest-news-wrap -->
        <?php } elseif($get_post_type_col_center == 'testimonials') {         
            //get testimonials page id
            $testimonials_id = get_theme_option('id_testimonials_page');             
            //gets testimonial title                
            $testimonials_title_center = get_option('sub_testimonial_title_center-'.$post_id);                
        ?>

        <div class="home-testimonials left">

            <?php if(!empty($testimonials_title_center)){ ?>
                <div class="home-title-nav left">                    
                        <span><?php echo $testimonials_title_center; ?></span>
                    <div class="nav-view-all left"><a href="<?php echo get_permalink($testimonials_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                </div><!--/home-title-nav-->
            <?php } ?>     
                
            <?php
                $i =1;

                //checks for selected post or random testimonial
                $testimonial_post_center = get_option('sub_testimonial_center-'.$post_id);
                $random_post_center = get_option('sub_check_testimonials_center-'. $post_id);


                //depending if post is random or selected
                if($random_post_center[0] == 'yes'){
                 $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                } else {
                 $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post_center);
                }

                //The Query
                query_posts($args);

                //The Loop
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                $name_user = get_post_meta($post->ID, $prefix.'name', true);
                $avatar = get_avatar( $email_avatar, 74);

            ?>

                <div class="home-testimonials-one <?php if(empty($testimonials_title_left)){ ?>testimonial-margin<?php } ?> <?php if($i == 1) { echo 'left';} else { echo 'right';} ?>">
                    <div class="testimonials-wrap left">
                        <div class="home-testimonials-one-image left"><?php echo $avatar; ?></div><!--/home-testimonials-one-image-->
                        <div class="home-testimonials-one-title left">
                            <span><?php the_title(); ?></span>
                            <?php if(!empty($name_user)){ ?><p><?php echo $name_user; ?></p><?php } ?>
                        </div><!--/home-testimonials-one-title-->
                        <div class="home-testimonials-one-text left">
                            <?php the_content(); ?>
                        </div><!--/home-testimonials-one-text-->
                    </div><!-- testimonials-wrap -->
                </div><!--/home-testimonials-one-->

            <?php $i++; endwhile; endif; ?>
        </div><!--/home-testimonials-->
        
        <?php } elseif($get_post_type_col_center == 'gallery') { 
            
          //get gallery page id
            $gallery_id = get_theme_option('id_gallery_page');                
            //gets gallery title                
            $gallery_title = get_option('sub_gallery_title_center-'.$post_id);
            //gets number of posts from page builder 
            $gallery_post_num = get_option('sub_gallery_number_center-'.$post_id);

            ?>
            <div class="horizontal-slider-wrap left">
                <div class="horizontal-slider left">

                    <div class="carousel-wrapper">                    
                        <div class="home-title-nav left">

                            <?php if(!empty($gallery_title)){ ?>
                                <span><?php echo $gallery_title; ?></span>
                            <?php } ?>

                            <div class="nav-prev left"><a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev"><?php _e('Prev', tk_theme_name); ?></a></div>
                            <div class="nav-next left"><a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next"><?php _e('Next', tk_theme_name); ?></a></div>
                        </div><!--/home-title-nav-->


                        <div data-jcarousel="true" data-wrap="circular" class="carousel">                        
                            <ul>
                                <?php
                                    $args = array('post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' =>$gallery_post_num);

                                    // The Query
                                    query_posts ($args);
                                    // The Loop
                                    if (have_posts()): while (have_posts()) : the_post();
                                    $post_format = get_post_format();
                                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                                    $random_name = generateRandomString();

                                ?>
                                <li>
                                    <a href="<?php echo $image_full[0]; ?>" class="fancybox" rel="<?php echo $random_name ?>">
                                        <div class="horisontal-images <?php if($post_format == 'video') {echo 'video-thumb';} ?> left">

                                            <?php 
                                            if($post_format == '') {
                                                 if(has_post_thumbnail()) {the_post_thumbnail('horizontal-slider');} 
                                                 } elseif($post_format == 'video'){
                                                     $video_link = get_post_meta($post -> ID, $prefix.'video_link', true);                                                
                                                     if(!empty($video_link)) {
                                                        get_video_image($video_link, $post->ID);                                                    
                                                     }                                                 
                                                 } elseif($post_format == 'gallery') {
                                                     $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                                     if(!empty($slide_images[0])){ ?>
                                                        <img src="<?php echo tk_get_thumb(200, 157, $slide_images[0]); ?>" alt="<?php the_title(); ?>" />
                                                     <?php } ?>                                                    
                                            <?php } ?>

                                            <div class="horisontal-images-hover">
                                               <div class="text-wrap">
                                                    <div class="center-wrap">
                                                        <span><?php the_title(); ?></span>
                                                        <p></p>
                                                    </div><!-- center-wrap -->
                                                </div><!-- text-wrap -->    
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <?php endwhile; endif; ?>                            
                            </ul>
                        </div>
                    </div>
                </div><!--/horizontal-slider-->
            </div><!-- horizontal-slider-wrap -->
        
        <?php } elseif($get_post_type_col_center == 'adbanner'){
                $ad_post = get_option('sub_bulder_banner_center-' . $post_id);                
                $custom_banner = get_post_meta($ad_post, $prefix.'custom_banner_code', true);
                $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($ad_post), 'full' ); 
                //tk_add_banner_view($ad_post);
                ?>
                <div class="home-content-ad left">

                    <?php if(!empty($custom_banner)) { 
                        echo $custom_banner;        
                    } else { ?>        
                        <a href="<?php site_url(); ?>?banner_id=<?php echo $ad_post; ?>">
                            <img src="<?php echo $image_src[0]; ?>" title="<?php the_title($ad_post)?>" alt="<?php the_title($ad_post)?>"/>
                        </a>
                    <?php } ?>

                </div>
        <?php } elseif($get_post_type_col_center =='content') {

            $page_content = get_option('sub_page_content_center-'.$post_id);
            ?>
            <div class="home-page-content last-width left">
                    <?php wp_reset_query();
                    global $more;    // Declare global $more (before the loop).
                    query_posts('page_id='.$page_content);
                    if (have_posts()) : while (have_posts()) : the_post();
                    ?>
                
                    <div class="shortcodes" style="margin:0">
                        <?php                   
                            $more = 0;
                            the_content("Read More"); 
                        ?>
                    </div><!--/shortcodes-->
                    
                    <?php
                        endwhile;
                    else:
                    endif;
                    wp_reset_query(); ?>
            </div><!--/wrapper-->
            
            
      <?php }  elseif ($get_post_type_col_center == 'rooms') { //checks to see if  rooms are selected in page builder ?>
    
        <?php 
            //gets the room page template id
            $rooms_id = get_theme_option('id_rooms_page'); 
            
            //gets number of posts, title and selected category from page builder 
            $rooms_post_num = get_option('sub_rooms_number_center-'.$post_id);
            $rooms_title = get_option('sub_rooms_title_center-'.$post_id);       
         ?>
        
        <div class="home-rooms left">
            
            <?php if(!empty($rooms_title)){ ?>
                <div class="home-title-nav left">                
                        <span><?php echo $rooms_title; ?></span>                
                    <div class="nav-view-all left"><a href="<?php echo get_permalink($rooms_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                </div><!--/home-title-nav-->
            <?php } ?>
                
        <div class="home-rooms-one left">
            <ul>
                <?php
                    $args = array('post_status' => 'publish', 'post_type' => 'rooms', 'posts_per_page' => $rooms_post_num);

                    // The Query
                    query_posts ($args);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                ?>


                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                            <?php if(has_post_thumbnail()){ ?>
                                <span><?php the_post_thumbnail('home-room'); ?></span>
                            <?php } ?>                                    
                    </a>
                </li>

                <?php endwhile; endif; ?>

            </ul>
        </div>
    </div><!--/home-latest-news-->
    
    
<?php }  ?>  
        
        
    </div><!-- third-width -->
    
    
     <div class="third-width last-width left">
        
        
    <?php
        if ($get_post_type_col_right == 'news') {
            //get title, number of posts and a category for news
            $latest_news_title_right = get_option('sub_news_title_right-'.$post_id);
            $news_post_num_right = get_option('sub_news_number_right-'.$post_id);
            $news_post_cat_right = get_option('sub_news_category_right-'.$post_id);
        ?>
         
        <script type="text/javascript"> 
            // FLEXSLIDER
            jQuery(window).load(function() {
                    jQuery('.flexslider-right<?php echo $post_id; ?>').flexslider({
                        controlNav: false,
                        slideshow: false,
                        prevText: "Prev",           //String: Set the text for the "previous" directionNav item
                        nextText: "Next",  
                        controlsContainer: ".home-navigation-right<?php echo $post_id; ?>"
                    });
            });                  
        </script>

            <div class="home-latest-news-rooms  left">
                    <div class="home-latest-news left">
                        <div class="home-title-nav home-navigation-right<?php echo $post_id; ?> left">                    
                            <?php if(!empty($latest_news_title_right)){ ?>
                                <span><?php echo $latest_news_title_right; ?></span>
                            <?php } ?>
                        </div><!--/home-title-nav-->


                        <div class="flex-container">
                          <div class="flexslider flexslider-right<?php echo $post_id; ?>">

                            <ul class="slides">
                                <?php
                                $args = array('post_status' => 'publish', 'posts_per_page' => $news_post_num_right, 'cat' => $news_post_cat_right);
                                // The Query
                                query_posts ($args);
                                // The Loop
                                if (have_posts()): while (have_posts()) : the_post();
                                ?>

                                <li>
                                    <div class="home-latest-news-one left">
                                        <?php if(has_post_thumbnail()){ ?><div class="home-latest-news-one-image left"><?php the_post_thumbnail('home-room'); ?></div><?php } ?>
                                        <div class="home-latest-news-one-text-content <?php if(!has_post_thumbnail()) { ?> fullwidth <?php } else { ?>has-thumbnail-text-content <?php } ?> left">
                                            <div class="home-latest-news-one-title left">
                                                <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                                <p><?php _e('Posted:', tk_theme_name);   the_time('F j, Y'); ?></p>
                                            </div>
                                        </div>

                                        <div class="home-latest-news-content-wrap <?php if(!has_post_thumbnail()){ ?>no-thumbnail<?php } ?> left">
                                            <div class="home-latest-news-one-text left">
                                                <p><?php the_excerpt_length(135); ?></p>
                                            </div>
                                            <div class="home-latest-news-one-read-more left"><a href="<?php the_permalink(); ?>"><?php _e('Read More', tk_theme_name); ?></a></div>
                                        </div><!-- content-latest-news-wrap -->
                                        
                                    </div>
                                </li>
                                <?php endwhile; endif; ?>


                            </ul>
                        </div><!-- flexslider -->
                    </div><!-- flex-container -->

                    </div><!--/home-latest-news-->
            </div><!-- home-latest-news-wrap -->
        <?php } elseif($get_post_type_col_right == 'testimonials') {
                
            //get testimonials page id
            $testimonials_id = get_theme_option('id_testimonials_page');             
            //gets testimonial title                
            $testimonials_title_right = get_option('sub_testimonial_title_right-' . $post_id);                
        ?>

        <div class="home-testimonials left">

            <?php if(!empty($testimonials_title_right)){ ?>
                <div class="home-title-nav left">
                            <span><?php echo $testimonials_title_right; ?></span>                       
                    <div class="nav-view-all left"><a href="<?php echo get_permalink($testimonials_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                </div><!--/home-title-nav-->
            <?php } ?>
                
            <?php
                $i =1;

                //checks for selected post or random testimonial
                $testimonial_post_right = get_option('sub_testimonial_right-'. $post_id);
                $random_post_right = get_option('sub_check_testimonials_right-'. $post_id);


                //depending if post is random or selected
                if($random_post_right[0] == 'yes'){
                 $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                } else {
                 $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post_right);
                }

                //The Query
                query_posts($args);

                //The Loop
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                $name_user = get_post_meta($post->ID, $prefix.'name', true);
                $avatar = get_avatar( $email_avatar, 74);

            ?>

                <div class="home-testimonials-one <?php if(empty($testimonials_title_left)){ ?>testimonial-margin<?php } ?> <?php if($i == 1) { echo 'left';} else { echo 'right';} ?>">
                    <div class="testimonials-wrap left">
                        <div class="home-testimonials-one-image left"><?php echo $avatar; ?></div><!--/home-testimonials-one-image-->
                        <div class="home-testimonials-one-title left">
                            <span><?php the_title(); ?></span>
                            <?php if(!empty($name_user)){ ?><p><?php echo $name_user; ?></p><?php } ?>
                        </div><!--/home-testimonials-one-title-->
                        <div class="home-testimonials-one-text left">
                            <?php the_content(); ?>
                        </div><!--/home-testimonials-one-text-->
                    </div><!-- testimonials-wrap -->
                </div><!--/home-testimonials-one-->

            <?php $i++; endwhile; endif; ?>
        </div><!--/home-testimonials-->
        
        <?php } elseif($get_post_type_col_right == 'gallery') { 
            
          //get gallery page id
            $gallery_id = get_theme_option('id_gallery_page');                
            //gets gallery title                
            $gallery_title = get_option('sub_gallery_title_right-'.$post_id);
            //gets number of posts from page builder 
            $gallery_post_num = get_option('sub_gallery_number_right-'.$post_id);

            ?>
            <div class="horizontal-slider-wrap left">
                <div class="horizontal-slider left">

                    <div class="carousel-wrapper">                    
                        <div class="home-title-nav left">

                            <?php if(!empty($gallery_title)){ ?>
                                <span><?php echo $gallery_title; ?></span>
                            <?php } ?>

                            <div class="nav-prev left"><a data-jcarousel-control="true" data-target="-=1" href="#" class="carousel-control-prev"><?php _e('Prev', tk_theme_name); ?></a></div>
                            <div class="nav-next left"><a data-jcarousel-control="true" data-target="+=1" href="#" class="carousel-control-next"><?php _e('Next', tk_theme_name); ?></a></div>
                        </div><!--/home-title-nav-->


                        <div data-jcarousel="true" data-wrap="circular" class="carousel">                        
                            <ul>
                                <?php
                                    $args = array('post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' =>$gallery_post_num);

                                    // The Query
                                    query_posts ($args);
                                    // The Loop
                                    if (have_posts()): while (have_posts()) : the_post();
                                    $post_format = get_post_format();
                                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                                    $random_name = generateRandomString();

                                ?>
                                <li>
                                    <a href="<?php echo $image_full[0]; ?>" class="fancybox" rel="<?php echo $random_name ?>">
                                        <div class="horisontal-images <?php if($post_format == 'video') {echo 'video-thumb';} ?> left">

                                            <?php 
                                            if($post_format == '') {
                                                 if(has_post_thumbnail()) {the_post_thumbnail('horizontal-slider');} 
                                                 } elseif($post_format == 'video'){
                                                     $video_link = get_post_meta($post -> ID, $prefix.'video_link', true);                                                
                                                     if(!empty($video_link)) {
                                                        get_video_image($video_link, $post->ID);                                                    
                                                     }                                                 
                                                 } elseif($post_format == 'gallery') {
                                                     $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                                     if(!empty($slide_images[0])){ ?>
                                                        <img src="<?php echo tk_get_thumb(200, 157, $slide_images[0]); ?>" alt="<?php the_title(); ?>" />
                                                     <?php } ?>                                                    
                                            <?php } ?>

                                            <div class="horisontal-images-hover">
                                               <div class="text-wrap">
                                                    <div class="center-wrap">
                                                        <span><?php the_title(); ?></span>
                                                        <p></p>
                                                    </div><!-- center-wrap -->
                                                </div><!-- text-wrap -->    
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <?php endwhile; endif; ?>                            
                            </ul>
                        </div>
                    </div>
                </div><!--/horizontal-slider-->
            </div><!-- horizontal-slider-wrap -->
        <?php } elseif($get_post_type_col_right == 'adbanner'){ 
                $ad_post = get_option('sub_bulder_banner_right-' . $post_id);                
                $custom_banner = get_post_meta($ad_post, $prefix.'custom_banner_code', true);
                $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($ad_post), 'full' ); 
                //tk_add_banner_view($ad_post);
                ?>
                <div class="home-content-ad left">

                    <?php if(!empty($custom_banner)) { 
                        echo $custom_banner;        
                    } else { ?>        
                        <a href="<?php site_url(); ?>?banner_id=<?php echo $ad_post; ?>">
                            <img src="<?php echo $image_src[0]; ?>" title="<?php the_title($ad_post)?>" alt="<?php the_title($ad_post)?>"/>
                        </a>
                    <?php } ?>

                </div>
        <?php } elseif($get_post_type_col_right =='content') {

            $page_content = get_option('sub_page_content_right-'.$post_id);
            ?>
            <div class="home-page-content last-width left">               
                    <?php wp_reset_query();
                    global $more;    // Declare global $more (before the loop).
                    query_posts('page_id='.$page_content);
                    if (have_posts()) : while (have_posts()) : the_post();
                    ?>

                
                    <div class="shortcodes" style="margin:0">
                        <?php                   
                            $more = 0;
                            the_content("Read More"); 
                        ?>
                    </div><!--/shortcodes-->
                    
                    <?php
                        endwhile;
                    else:
                    endif;
                    wp_reset_query(); ?>              
            </div><!--/wrapper-->
            
            
      <?php }  elseif ($get_post_type_col_right == 'rooms') { //checks to see if  rooms are selected in page builder ?>
    
        <?php 
            //gets the room page template id
            $rooms_id = get_theme_option('id_rooms_page'); 
            
            //gets number of posts, title and selected category from page builder 
            $rooms_post_num = get_option('sub_rooms_number_right-'.$post_id);
            $rooms_title = get_option('sub_rooms_title_right-'.$post_id);       
         ?>
        
        <div class="home-rooms left">
            
            <?php if(!empty($rooms_title)){ ?>
                <div class="home-title-nav left">                
                        <span><?php echo $rooms_title; ?></span>                    
                    <div class="nav-view-all left"><a href="<?php echo get_permalink($rooms_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                </div><!--/home-title-nav-->
            <?php } ?>
                
        <div class="home-rooms-one left">
            <ul>
                <?php
                    $args = array('post_status' => 'publish', 'post_type' => 'rooms', 'posts_per_page' => $rooms_post_num);

                    // The Query
                    query_posts ($args);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                ?>


                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                            <?php if(has_post_thumbnail()){ ?>
                                <span><?php the_post_thumbnail('home-room'); ?></span>
                            <?php } ?>                                    
                    </a>
                </li>

                <?php endwhile; endif; ?>

            </ul>
        </div>
    </div><!--/home-latest-news-->
    
    
<?php }  ?>        
    </div><!-- third-width -->
    
    
    
</div><!-- wrapper-content -->