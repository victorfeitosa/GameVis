<?php 
global $prefix;
$post_id = $post->ID;

$get_post_type = get_option('col_1-'.$post->ID);
$testimonials_title = get_option('sub_testimonial_title-'.$post->ID);

?>

<div class="fullwidth-wrap left">

    <?php 
        if($get_post_type == 'news') {      
            //gets number of posts and selected category from page builder 
            $news_post_num = get_option('sub_news_number-'.$post->ID);
            $news_post_cat = get_option('sub_news_category-'.$post->ID);
            $news_title = get_option('sub_news_title-'.$post->ID);
        ?>

    
    <script type="text/javascript"> 
        // FLEXSLIDER
        jQuery(window).load(function() {
                jQuery('.flexslider<?php echo $post_id; ?>').flexslider({
                    controlNav: false,
                    slideshow: false,
                    prevText: "Prev",           //String: Set the text for the "previous" directionNav item
                    nextText: "Next",  
                    controlsContainer: ".home-navigation<?php echo $post_id; ?>"
                });
        });                  
    </script>
    
    
    <div class="home-latest-news-rooms left">
            <div class="home-latest-news  left">
                
                
                <div class="home-title-nav home-navigation<?php echo $post_id; ?> left">
                    <?php if(!empty($news_title)){ ?>
                        <span><?php echo $news_title; ?></span>
                    <?php } ?>
                </div><!--/home-title-nav-->
                

                <div class="flex-container">
                  <div class="flexslider flexslider<?php echo $post_id; ?>">

                    <ul class="slides">
                        <?php
                        $args = array('post_status' => 'publish', 'posts_per_page' => $news_post_num, 'cat' => $news_post_cat);
                        // The Query
                        query_posts ($args);
                        // The Loop
                        if (have_posts()): while (have_posts()) : the_post();
                        ?>

                        <li>
                            <div class="home-latest-news-one left">
                                <?php if(has_post_thumbnail()){ ?>
                                    <div class="home-latest-news-one-image left">
                                        <?php the_post_thumbnail('home-room'); ?>
                                    </div>
                                <?php } ?>
                                <div class="home-latest-news-one-text-content <?php if(!has_post_thumbnail()) { ?> fullwidth <?php } else { ?>has-thumbnail-text-content <?php } ?> left">
                                    <div class="home-latest-news-one-title left">
                                        <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                        <p><?php _e('Posted:', tk_theme_name);  the_time('F j, Y'); ?></p>
                                    </div>
                                    <div class="home-latest-news-one-text left">
                                        <p><?php the_excerpt_length(300); ?></p>
                                    </div>
                                    <div class="home-latest-news-one-read-more left"><a href="<?php the_permalink(); ?>"><?php _e('Read More', tk_theme_name); ?></a></div>
                                </div>
                            </div>
                        </li>
                        <?php endwhile; endif; ?>


                    </ul>
                </div><!-- flexslider -->



            </div><!-- flex-container -->

            </div><!--/home-latest-news-->
    </div><!-- home-latest-news-wrap -->
<?php } elseif ($get_post_type == 'rooms') { //checks to see if  rooms are selected in page builder ?>
    
        <?php 
            //gets the room page template id
            $rooms_id = get_theme_option('id_rooms_page'); 
            
            //gets number of posts, title and selected category from page builder 
            $rooms_post_num = get_option('sub_rooms_number-'.$post->ID);
            $rooms_title = get_option('sub_rooms_title-'.$post->ID);       
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
                    $room_post_format = get_post_format();                  
                ?>


                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                                                         
                                <span>
                                    <?php if($room_post_format == ''){ ?>
                                    <?php if(has_post_thumbnail()){ 
                                        the_post_thumbnail('home-room');
                                     } //has_post_thumbnail() ?>   
                                    <?php } elseif($room_post_format == 'gallery') { 
                                        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true); ?>
                                        <img src="<?php echo $slide_images[0]; ?>"  alt="<?php the_title(); ?>" />
                                    <?php } elseif($room_post_format == 'video') {                                          
                                        $video_link = get_post_meta($post -> ID, $prefix.'video_link', true); ?>
                                        <?php echo get_video_image($video_link, $post->ID); ?>
                                    <?php } ?>
                                    
                                </span>
                                                             
                    </a>
                </li>

                <?php endwhile; endif; ?>

            </ul>
        </div>
    </div><!--/home-latest-news-->
    
    
<?php } elseif($get_post_type == 'testimonials') { ?>
    
    
            <?php 
                //get testimonials page id
                $testimonials_id = get_theme_option('id_testimonials_page');             
                //gets testimonial title                
                $testimonials_title = get_theme_option('sub_testimonial_title-'.$post_id);                
            ?>
            
            <div class="home-testimonials left">
                
                <?php if(!empty($testimonials_title)){ ?>
                    <div class="home-title-nav left">
                        <span><?php echo $testimonials_title; ?></span>
                        <div class="nav-view-all left"><a href="<?php echo get_permalink($testimonials_id); ?>"><?php _e('View all', tk_theme_name); ?></a></div>
                    </div><!--/home-title-nav-->
                <?php } ?>
                <?php
                    $i =1;
                    
                    //checks for selected post or random testimonial
                    $testimonial_post = get_option('sub_testimonial-'.$post_id);
                    $random_post = get_option('sub_check_testimonials-'. $post_id);

                    
                    //depending if post is random or selected
                    if($random_post[0] == 'yes'){
                     $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                    } else {
                     $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post);
                    }

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                    $name_user = get_post_meta($post->ID, $prefix.'name', true);
                    $avatar = get_avatar( $email_avatar, 74);
                    
                ?>
                
                    <div class="home-testimonials-one <?php if($i == 1) { echo 'left';} else { echo 'right';} ?>">
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
    $gallery_title = get_option('sub_gallery_title-'.$post->ID);
    //gets number of posts from page builder 
    $gallery_post_num = get_option('sub_gallery_number-'.$post->ID);
            
    ?>
                 
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
            
            
            
            
    
<?php } elseif($get_post_type == 'adbanner'){
                
                $ad_post = get_option('sub_bulder_banner-' . $post_id);                
                $custom_banner = get_post_meta($ad_post, $prefix.'custom_banner_code', true);
                $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($ad_post), 'full' ); 
                //tk_add_banner_view($ad_post);
                ?>
                <div class="home-content-ad ad-full-width left">

                    <?php if(!empty($custom_banner)) { 
                        echo $custom_banner;        
                    } else { ?>        
                        <a href="<?php site_url(); ?>?banner_id=<?php echo $ad_post; ?>">
                            <img src="<?php echo $image_src[0]; ?>" title="<?php the_title($ad_post)?>" alt="<?php the_title($ad_post)?>"/>
                        </a>
                    <?php } ?>

                </div>
            
<?php } elseif($get_post_type =='content') {

            $page_content = get_option('sub_page_content-'.$post_id);
            ?>
            <div class="home-page-content full-width last-width left">
                
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
            
            
      <?php }  ?>      
                
</div><!-- fullwidth -->