<?php
get_header();
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_post_meta($post -> ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){
    $sidebar_postition = get_post_meta($blog_id, $prefix.'sidebar_position', true);
    if(empty($sidebar_postition)){
        $sidebar_postition = 'right';
    }
} 
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog_id ), 'full');
?>

        <!-- Page Headline -->
        <div class="title-pages left">
            
            <div class="title-pages-image left">
                <?php if(has_post_thumbnail($blog_id)) { ?>
                    <div class="title-pages-image left" style="<?php echo 'background:url('.$title_bg_image[0].')' ?>"></div>
                <?php } ?>
            </div>
            
            <div class="wrapper">
                <span><?php echo get_the_title($blog_id)?></span>
                
                <?php
                $page_headline = get_post_meta($blog_id, $prefix . 'headline', true);
                if ($page_headline !== "") { ?>
                <p><?php echo $page_headline ?></p>
                <?php } /*-- /page headline --*/?>
            </div>
        </div><!--/title-pages-->  
        <div class="bottom-slider-red"></div><!--/bottom-slider-red-->


<!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">

            
                <div class="content-left <?php if($sidebar_postition == 'right'){echo 'left';}elseif($sidebar_postition == 'left'){echo 'right';}elseif($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">

                <?php
                //The Loop
                if (have_posts()) : while (have_posts()) : the_post();
                        $categories = wp_get_post_categories($post -> ID);
                        $count = count($categories);
                        $i = 1;
                        $format = get_post_format();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                        ?>     

                    <div class="blog-one <?php if($sidebar_postition == 'fullwidth'){echo 'fullwidth-wrap';} ?> left">
                        
                        <?php if(has_post_thumbnail()){ ?>
                            <div class="preloader-image"></div>
                        <?php } ?>
                        <!--Post Standard-->
                        <?php if ($format == 'image' || $format == '') {?>
                            <?php if (has_post_thumbnail()) { ?>
                                <?php if($sidebar_postition == 'fullwidth'){?>
                                    <div class="blog-images left"><?php the_post_thumbnail('blog-full'); ?></div>
                                <?php }else{ ?>
                                    <div class="blog-images left"><?php the_post_thumbnail('blog'); ?></div>
                            <?php } ?>
                        <?php } ?>
                         
                        <!-- Post Video -->
                        <?php } elseif ($format == 'video') { 
                            
                            if(!empty($video_link)){ ?>
                                <div class="video-border"><div class="blog-video left tk-video-holder"><?php tk_video_player($video_link); ?></div></div>    
                            <?php } ?>
                                
                        <!-- Post Gallery -->
                        <?php } elseif ($format == 'gallery') { 
                            $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                            if(!empty($slide_images)) {
                            ?>
                        
                            <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    jQuery('.flexslider').flexslider({
                                        pauseOnHover:true,
                                        slideshow: true,
                                        useCSS: false
                                    });
                                });
                            </script>
                            
                            <div class="blog-gallery left">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <?php

                                        foreach($slide_images as $the_image) { ?>
                                                <li>
                                                        <?php if($sidebar_postition == 'fullwidth'){?>
                                                            <img src="<?php tk_get_thumb(1014, 500, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                        <?php } else { ?>
                                                            <img src="<?php tk_get_thumb(620, 306, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                        <?php } ?>
                                                    <?php }?>
                                                </li>
                                        <?php } ?>
                                    </ul>
                                </div><!--/flexslider-->
                            </div><!--/blog-gallery-->
                            
                            <!-- Post Audio -->
                            <?php } elseif ($format == 'audio') { 
                                        $audio_text = get_post_meta($post->ID, $prefix.'audio_text', true); ?>
                                    <div class="blog-text-content right">
                                        <div class="blog-player-content left">   
                                            <div class="blog-player left">
                                                <div class="home-latest-news-border-img left"></div>
                                                    <?php tk_jplayer($post->ID); ?>
                                                <div id="jquery_jplayer_<?php echo $post->ID ?>" class="jp-jplayer"></div>
                                                <div id="jp_container_<?php echo $post->ID ?>" class="jp-audio">
                                                    <div class="jp-type-single">
                                                        <div class="jp-gui jp-interface" id="jp_interface_<?php echo $post->ID; ?>">
                                                            <ul class="jp-controls">
                                                                <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                                                <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                                                <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                                                <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                                            </ul>
                                                            <div class="jp-progress">
                                                                <div class="jp-seek-bar">
                                                                    <div class="jp-play-bar"></div>
                                                                </div>
                                                            </div>
                                                            <div class="jp-volume-bar">
                                                                <div class="jp-volume-bar-value"></div>
                                                            </div>
                                                        </div><!--/jp-gui jp-interface-->
                                                    </div><!--/jp-type-single-->
                                                </div><!--/jp-audio-->
                                            </div><!--/blog-player--> 
                                            <?php if($audio_text != ''){?><div class="blog-audio-info left"><p><?php echo $audio_text?></p></div><?php }?> 
                                        </div>
                                    </div><!--/blog-text-content-->  
                                    
                            <!-- Post Link -->
                            <?php } elseif ($format == 'link') {
                                $link_text = get_post_meta($post->ID, $prefix . 'link_text', true);
                                $link_url = get_post_meta($post->ID, $prefix . 'link_url', true);   
                                ?>
                                <div class="blog-link left">
                                    <div class="post-link-top left"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></div><!--/post-link-top-->
                                    <div class="post-link-down left"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></div><!--/post-link-down-->
                                </div><!--/blog-link--> 
                        
                            <!-- Post Quote -->
                            <?php } elseif ($format == 'quote') { 
                                    $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
                                    $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true); ?>

                                    <div class="post-quote left">
                                        <?php if($quote_text) { ?><span><?php echo $quote_text; ?></span><?php } ?>
                                        <?php if($quote_author){ ?><p><?php echo $quote_author; ?></p><?php } ?>
                                    </div><!--/post-quote-->  
                                <?php } ?>

                                    
                                    
                                    
                         <!-- Title and content -->          
                        <div class="home-latest-news-title left"><?php the_title(); ?></div><!--/home-latest-news-title-->
                        <div class="home-latest-news-category left">
                            <ul>
                                <li>
                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-1.png" alt="images" title="images"  />
                                    <p><?php _e('Posted: ', tk_theme_name) ?><?php echo get_the_date()?></p>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-2.png" alt="images" title="images"  />
                                    <p><?php _e('By:', tk_theme_name)?><?php the_author_posts_link(); ?></p>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-3.png" alt="images" title="images"  />
                                    <p><?php _e('Categories:', tk_theme_name) ?></p>
                                    <?php
                                        foreach ($categories as $cat_id) {
                                        $cat_name = get_cat_name($cat_id);
                                        $cat_link = get_category_link($cat_id);

                                        if ($count == $i) {
                                            $comma ="";
                                        } else {
                                            $comma = ",";
                                        }
                                    ?>
                                    
                                    <p><a href="<?php echo $cat_link;?>"><?php echo $cat_name.$comma;?></a></p>
                                    <?php $i++;} ?>
                                </li>
                                <li>
                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-4.png" alt="images" title="images"  />
                                    <p><?php _e('Comments: ', tk_theme_name)?><?php comments_number( '0', '1', '%' ); ?></p>
                                </li>
                            </ul>
                        </div><!--/home-latest-news-category-->

                        <!-- Content -->
                        <div class="shortcodes left">
                            <?php the_content(); ?>
                            <div class="single-post-pagination left">
                                <?php wp_link_pages(); ?>
                            </div><!-- single-post-pagination -->
                        </div><!--/home-latest-news-text-->   
                        
                        <!-- Tags -->
                        <div class="tag-blog-single left">
                            <?php the_tags('<span class="tags">Tags: </span>', ', ', ' '); ?>
                        </div>
                                    
                    </div><!--/blog-one-->
                <?php endwhile; endif; ?>

                    <!--COMMENTS-->
                    <div class="comment-start left">
                        <?php if (comments_open()) : ?>
                            <?php comments_template(); // Get wp-comments.php template  ?>
                        <?php endif; ?>
                    </div><!--/comment-start-->

                </div><!--/content-left-->



                    <!-- Sidebar -->
                    <?php 
                    
                    $sidebar_select = get_post_meta($post->ID, $prefix . 'sidebar', true);


                    if ($sidebar_select == 'none') {
                        $sidebar_select = get_post_meta($blog_id, $prefix.'sidebar', true);
                    }
                    
                    if($sidebar_postition == 'right'){
                        tk_get_sidebar('Right', $sidebar_select);
                    }elseif($sidebar_postition == 'left'){
                        tk_get_sidebar('Left', $sidebar_select);
                    }
                    ?>


            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>