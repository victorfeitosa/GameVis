<?php 
$prefix = 'tk_';
global $paged, $args, $format, $categories, $count, $i, $tk_blog_id, $sidebar_position;
?>

<div class="blog-one left <?php  if(is_sticky()) { ?>sticky-wrap<?php } ?> <?php if($sidebar_position == 'fullwidth'){echo 'fullwidth-wrap';}; if ($post -> post_type == 'page') { echo 'hide-meta-if-page'; } ?>">
    <div class="blog-categories <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
        <ul>
                    <!-- Sticky Post -->
        <?php  if(is_sticky()) { ?>
            <li class="sticky"><?php _e('Featured Post', tk_theme_name) ?></li>
        <?php } ?>
            <li><span><?php _e('Posted on:', tk_theme_name) ?></span><p><?php echo get_the_date()?></p></li>
            <li><span><?php _e('Categories:', tk_theme_name) ?></span>
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
                <a href="<?php echo $cat_link;?>"><?php echo $cat_name.$comma;?></a>
                <?php $i++;} ?>
            </li>
            <li class="blog-meta-by"><span><?php _e('By:', tk_theme_name) ?></span><?php the_author_posts_link(); ?></li>
        </ul>
    </div><!--blog-categories-->

    <div class="blog-one-content <?php if($sidebar_position == 'right'){echo 'right';}elseif($sidebar_position == 'left'){echo 'left';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
        <div class="blog-one-title left">
            <div class="blog-one-comments left"><span><?php comments_number( '0', '1', '%' ); ?></span></div><!--blog-one-comments-->
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </div><!--blog-one-title-->
        
        <!--Post Standard-->
    <?php if ($format == 'image' || $format == '') {?>
        <?php if (has_post_thumbnail()) { ?>
            <?php if($sidebar_position == 'fullwidth'){?>
                <div class="blog-one-images left"><?php the_post_thumbnail('blog-full'); ?><a href="<?php the_permalink(); ?>"><p></p></a>
                </div><!--/blog-images-->
            <?php }else{ ?>
                <div class="blog-one-images left"><?php the_post_thumbnail('blog'); ?><a href="<?php the_permalink(); ?>"><p></p></a>
                </div><!--/blog-images-->
        <?php } ?>
    <?php } ?>
                
<!-- Post Video -->
    <?php } elseif ($format == 'video') { 
        $video_link = get_post_meta($post->ID, $prefix.'video_link', true); ?>
            <div class="blog-one-video left <?php if($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>"><?php tk_video_player($video_link); ?></div><!--/blog-video-->       
            
<!-- Post Gallery -->
    <?php } elseif ($format == 'gallery') {
            $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
            if(!empty($slide_images)) { ?>

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

                    foreach($slide_images as $the_image) {    ?>
                            <li>
                                    <?php if($sidebar_position == 'fullwidth'){?>
                                        <img src="<?php tk_get_thumb(820, 442, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                    <?php } else { ?>
                                        <img src="<?php tk_get_thumb(560, 302, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
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
                                <div class="jp-progress <?php if($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
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

<!-- Post Link-->    
    <?php } elseif ($format == 'link') {
        $link_text = get_post_meta($post->ID, $prefix.'link_text', true);
        $link_url = get_post_meta($post->ID, $prefix.'link_url', true); ?>

        <div class="blog-link left">
            <div class="post-link-top left"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></div><!--/post-link-top-->
            <div class="post-link-down left"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></div><!--/post-link-down-->
        </div><!--/blog-link--> 

<!-- Post Quote -->
    <?php } elseif ($format == 'quote') {
        $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
        $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true); ?>

        <div class="post-quote left">
            <?php if($quote_text) { ?><span><?php echo $quote_text; ?></span><?php } ?>
            <?php if($quote_author){ ?><div class="quote-author-holder"><p><?php echo $quote_author; ?></p><?php } ?></div>
        </div><!--/post-quote-->  
    <?php } ?>            

        <div class="blog-one-text left"><?php the_excerpt_length(300);?></div><!--blog-one-text-->
        <div class="home-post-one-button left"><a href="<?php the_permalink();?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--home-post-one-button-->
    </div><!--blog-one-content-->
</div><!--blog-one-->