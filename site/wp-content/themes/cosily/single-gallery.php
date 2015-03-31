<?php
get_header();
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_post_meta($blog_id, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
?>

    <!-- Page Headline -->
    <div class="title-pages left">
            <div class="wrapper">
                <span><?php the_title()?></span>
            </div>
    </div><!--/title-pages-->  
    <div class="bottom-slider-red"></div><!--/bottom-slider-red-->


<!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">

            
                <div class="content-left no-sidebar">

                <?php
                //The Loop
                if (have_posts()): while (have_posts()): the_post();
                $format = get_post_format();
                $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                
                if (has_post_thumbnail() || $format == "video") {
                    $noimage = '';
                } else {
                    $noimage = 'blog-no-image';
                }
                
                ?>  

                    <div class="blog-one fullwidth-wrap">
                        <div class="preloader-image"></div>
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
                        <?php } elseif ($format == 'video') { ?>
                                <div class="blog-video left"><?php tk_video_player($video_link); ?></div>    
                                
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
                                                            <img src="<?php tk_get_thumb(1024, 505, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                    <?php }?>
                                                </li>
                                        <?php } ?>
                                    </ul>
                                </div><!--/flexslider-->
                            </div><!--/blog-gallery-->
                            <?php } ?>
                                                    <!-- Content -->
                        <div class="home-latest-news-text left">
                            <?php the_content(); ?>
                        </div><!--/home-latest-news-text-->   
                    </div><!--/blog-one-->
                <?php endwhile; endif; ?>
                
            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>