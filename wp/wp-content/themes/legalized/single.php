<?php

get_header();

$prefix = 'tk_';

// Blog Page ID
$tk_blog_id = get_option('id_blog_page');

/* Blog Page title */
$blog_headline = get_post_meta($tk_blog_id, $prefix . 'headline', true);

/* Single Post featured image */
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

/* Single Post sidebar */
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);};


/* Content padding */
if ($sidebar_postition == 'right'){
    $padding = 'style="padding-right:20px;"';
}else if($sidebar_postition == 'left'){
    $padding = 'style="padding-left:20px;"';
}else{
    $padding = '';
}


/* Selected sidebar */
$sidebar_select = get_post_meta($post->ID, $prefix . 'sidebar', true);

?>

<!-- CONTENT STARTS -->
<section>
    <div class="container">

        <!-- Page Title -->
        <?php if(get_post_type() == 'team-members') {?>
        <!-- Page Title -->
            <div class="row-fluid">
                <div class="span12">
                 <h1 class="page_title"><?php the_title(); ?></h1>
                </div>
            </div>
        <?php }else{ ?>
            <div class="row-fluid">
                <div class="span12">
                    <h1 class="page_title"><?php echo get_the_title($tk_blog_id)?></h1>
                <?php if ($blog_headline !== "") { ?>
                    <h2 class="page_description"><?php echo $blog_headline ?></h2>
                <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="row-fluid">
            <div class="span12">
                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png"  alt="separator"/>
            </div>
        </div>
        <br>



        <!-- Page Content -->
        <div class="row-fluid">



            <!-- Main Content -->
            <div id="content" class="<?php if($sidebar_postition == 'right'){echo 'span8 pull-left';}elseif($sidebar_postition == 'left'){echo 'span8 pull-right';}elseif($sidebar_postition == 'fullwidth'){echo 'span12';}?>">

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


                <!-- Post -->
                <article class="blog_post" <?php echo $padding; ?>>

                    <!-- Post Standard-->
                    <?php if ($format == 'image' || $format == '') {?>                                
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="blog-images">
                                <a class="fancybox" href="<?php echo $image[0]; ?>"><?php the_post_thumbnail('blog-full'); ?></a>
                                <div class="blog_img_hover rounded"><a class="fancybox img_plus" href="<?php echo $image[0]; ?>"></a></div>
                            </div>
                            <br>
                    <?php } ?>
                                        
                    <!-- Post Video -->
                    <?php } elseif ($format == 'video') { ?>
                        <div class="blog-video"><?php tk_video_player($video_link); ?></div>
                        <br>
                        
                    <!-- Post Gallery -->
                    <?php } elseif ($format == 'gallery') { 
                        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                        if(!empty($slide_images)) {
                        ?>
                        <div id="work-slider" class="work-slider"></div>
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                jQuery('.flexslider').flexslider({
                                    pauseOnHover:true,
                                    slideshow: true,
                                    useCSS: false
                                });
                            });
                        </script>

                        <div class="blog-gallery">
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php
                                        foreach($slide_images as $the_image) { ?>
                                            <li>
                                                <?php if($sidebar_postition == 'fullwidth'){?>
                                                    <img src="<?php tk_get_thumb(963, 537, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php tk_get_thumb(963, 537, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                <?php } ?>
                                            </li>
                                        <?php }?>
                                    <?php } ?>
                                </ul>
                            </div><!--/flexslider-->
                        </div><!--/blog-gallery--> 
                        <div class="clear"></div>  
                        <br>  
                        
                    <!-- Post Audio -->
                    <?php } elseif ($format == 'audio') { 
                            $audio_text = get_post_meta($post->ID, $prefix.'audio_text', true); ?>
                            <div class="blog-text-content">
                                <div class="blog-player-content">   
                                    <div class="blog-player">
                                        <div class="home-latest-news-border-img"></div>
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
                                                    <div class="jp-progress <?php if($sidebar_postition == 'fullwidth'){echo 'fullwidth-progress';} ?>">
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
                                </div>
                            </div><!--/blog-text-content--> 
                            <br> 
                            
                    <!-- Post Link -->
                    <?php } elseif ($format == 'link') {
                            $link_text = get_post_meta($post->ID, $prefix . 'link_text', true);
                            $link_url = get_post_meta($post->ID, $prefix . 'link_url', true);   
                        ?>
                        <div class="post-link">
                            <?php if($link_text) { ?><h3><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></h3><?php } ?>
                            <?php if($link_url){ ?><span class="by"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></span><?php } ?>
                        </div>
                        <br>
                        <?php //if($link_url){ echo '<br>' } ?>
                
                    <!-- Post Quote -->
                    <?php } elseif ($format == 'quote') { 
                            $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
                            $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true); 
                        ?>
                        <div class="post-quote">
                            <?php if($quote_text) { ?><h3><?php echo $quote_text; ?></h3><?php } ?>
                            <?php if($quote_author){ ?><span class="by"><?php echo $quote_author; ?></span><?php } ?>
                        </div>
                        <br>
                        <?php //if($quote_author){ echo '<br>' } ?>
                        <?php } ?>
                            
                        
                    <!-- Post Meta -->    
                    <?php 
                        //Meta Date
                        $post_day = get_the_date('d');
                        $post_month = get_the_date('M');
                        $post_year = get_the_date('Y');
                    ?>
                    
                    <!-- Post Date -->
                    <div class="post_date rounded pull-left">
                        <div class="date pull-left"><span><?php echo $post_day; ?></span><?php echo $post_month; ?><br><?php echo $post_year; ?></div>
                        <div class="format pull-left">
                            <?php 
                                if ($format == 'standard') {
                                    $post_format_img = 'standard';
                                } elseif($format == 'audio'){
                                    $post_format_img = 'audio';
                                } elseif($format == 'gallery'){
                                    $post_format_img = 'gallery';
                                } elseif($format == 'link'){
                                    $post_format_img = 'link';
                                } elseif($format == 'quote'){
                                    $post_format_img = 'quote';
                                } else {
                                    $post_format_img = 'standard';
                                }
                            ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/style/images/post-format-<?php echo $post_format_img; ?>.png" />
                        </div>
                        <div class="clear"></div>
                    </div>


                    <!-- Post title -->
                    <h3 class="post_title red"><?php the_title(); ?></h3>

                    
                    <!-- By -->
                    <span class="by"><?php if($format == 'audio') { if($audio_text != ''){ echo $audio_text.' / '; } } ?><?php the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments / ', tk_theme_name) ?></a></span>
                    <span class="by">
                        <ul>
                            <li>
                                <?php
                                    foreach ($categories as $cat_id) {
                                    $cat_name = get_cat_name($cat_id);
                                    $cat_link = get_category_link($cat_id);

                                    if ($count == $i) {
                                        $comma = "";
                                    } else {
                                        $comma = ",";
                                    }
                                ?>
                                <a href="<?php echo $cat_link;?>"><?php echo $cat_name.$comma;?></a>
                                <?php $i++;} ?>   
                            </li>
                        </ul>
                    </span>
                    <div class="clear"></div>


                    <!-- Post Content -->
                    <br>
                    <?php the_content(); ?>


                    <!-- Tags -->
                    <div class="tags_wrap">
                        <?php the_tags('<span class="red pull-left">Tags: </span>', ', ', ' '); ?>
                    </div><!--/blog-single-tag--> 
                    <div class="clear"></div> 

                    <div class="row-fluid">
                        <div class="span12">
                            <img src="<?php echo get_template_directory_uri(); ?>/style/images/sep.png" alt="separator"/>
                            <div class="sep_border"></div>
                        </div>
                    </div>


            <?php endwhile; endif; //loop end?>


                    <?php //Enable Social Share
                        $social_share_blog = get_theme_option(tk_theme_name . '_social_social_share_blog');
                        if ($social_share_blog != 'yes') { 
                    ?>
                
                        <!-- Social Share Buttons -->
                        <?php
                            $facebook_share = get_theme_option(tk_theme_name . '_social_use_facebook');
                            $twitter_share = get_theme_option(tk_theme_name . '_social_use_twitter');
                            $google_share = get_theme_option(tk_theme_name . '_social_use_google');
                            $linkedin_share = get_theme_option(tk_theme_name . '_social_use_linkedin');
                            $pinterest_share = get_theme_option(tk_theme_name . '_social_use_pinterest');
                            $stumbleupon_share = get_theme_option(tk_theme_name . '_social_use_stumbleupon');
                            $thepermalink = get_permalink();

                            if ($facebook_share != 'yes' || $twitter_share != 'yes' || $google_share != 'yes' || $linkedin_share != 'yes' || $pinterest_share != 'yes' || $stumbleupon_share != 'yes') {
                        ?>
                                <div class="social_sharing">

                                    <?php if ($facebook_share != 'yes') { ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_likes($thepermalink); ?>
                                            </div>
                                            <div id="share_facebook" class="rounded">
                                                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>"><?php _e('Facebook', tk_theme_name) ?></a>
                                            </div>
                                        </div>
                                    <?php } ?>       

                                    <?php if ($twitter_share != 'yes') { ?> 
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_tweets(get_permalink()); ?>
                                            </div>
                                            <div id="share_twitter" class="rounded">
                                                <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>" class="twitter-share-button"><?php _e('Twitter', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>

                                    <?php if ($google_share != 'yes') { ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_plusones($thepermalink); ?>
                                            </div>
                                            <div id="share_google" class="rounded">
                                                <a target="_blank" href="https://plus.google.com/share?url=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>"><?php _e('Google+', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>

                                    <?php if ($linkedin_share != 'yes') { ?> 
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_linkedin($thepermalink); ?>
                                            </div>
                                            <div id="share_linkedin" class="rounded">
                                                <a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>"><?php _e('LinkedIn', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?> 

                                    <?php if ($pinterest_share != 'yes') { ?>
                                        <?php $pin_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_pinit($thepermalink); ?>
                                            </div>
                                            <div id="share_pinterest" class="rounded">
                                                <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $thepermalink; ?>&media=<?php echo $pin_image[0]; ?>&description=<?php the_title(); ?>"><?php _e('Pinterest', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>    

                                    <?php if ($stumbleupon_share != 'yes') { ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_stumbleupon($thepermalink); ?>
                                            </div>
                                            <div id="share_stumbleupon" class="rounded">
                                                <a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>"><?php _e('Stumbleupon', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="clear"></div>        
                                </div><!--/social_sharing -->
                            <?php } ?>

                    <?php } //Enable Social Share ?>

            
                    <!--COMMENTS-->
                    <div class="comment-start">
                        <?php if (comments_open()) : ?>
                            <?php comments_template(); // Get wp-comments.php template  ?>
                        <?php endif; ?>
                    </div><!--/comment-start-->

                </article><!--/blog_post-->

            </div><!-- #content -->



            <!-- Sidebar Left -->
            <?php 
                if ($sidebar_postition == 'left'){
                    echo '<div class="span4 pull-left" style="margin-left:0px;">';
                        tk_get_sidebar('Left', $sidebar_select);
                    echo '</div>';
                }
            ?>


            <!-- Sidebar Right -->
            <?php 
                if ($sidebar_postition == 'right'){
                    echo '<div class="span4 pull-right">';
                        tk_get_sidebar('Right', $sidebar_select);
                    echo '</div>';
                }
            ?>


        </div><!-- row-fluid -->  



<?php get_footer(); ?>