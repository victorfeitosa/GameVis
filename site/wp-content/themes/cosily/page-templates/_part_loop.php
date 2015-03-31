<?php 
$prefix = 'tk_';
global $paged, $args, $format, $categories, $count, $i, $blog_id, $sidebar_postition;
?>

<?php
if($sidebar_postition == 'fullwidth'){
  $classes = array(
    'blog-one',
    'left',
    'fullwidth-wrap',
  );
}else{
$classes = array(
    'blog-one',
    'left',
  );
}
?>

<div <?php post_class( $classes ); ?>>

<!--Post Standard-->
    <?php if ($format == 'image' || $format == '') {?>
        <?php if (has_post_thumbnail()) { ?>
            <?php if($sidebar_postition == 'fullwidth'){?>
                <div class="blog-images left"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog-full'); ?><div class="horisontal-images-hover"><p></p></div></a>
                </div><!--/blog-images-->
            <?php }else{ ?>
                <div class="blog-images left"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog'); ?><div class="horisontal-images-hover"><p></p></div></a>
                </div><!--/blog-images-->
        <?php } ?>
    <?php } ?>

<!-- Post Video -->
    <?php } elseif ($format == 'video') { 
        $video_link = get_post_meta($post->ID, $prefix.'video_link', true); 
        if(!empty($video_link)) {?>
            <div class="video-border"><div class="blog-video left tk-video-holder"><?php tk_video_player($video_link); ?></div><!--/blog-video--></div>
        <?php } ?>

<!-- Post Gallery -->
    <?php } elseif ($format == 'gallery') {
            $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
            if(!empty($slide_images)) { ?>

        <script type="text/javascript">
            jQuery(document).load(function($){
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
                                    <?php if($sidebar_postition == 'fullwidth'){?>
                                        <img src="<?php tk_get_thumb(1014, 500, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                    <?php } else { ?>
                                        <img src="<?php tk_get_thumb(620, 306, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                    <?php } ?>
                                <?php }?>
                            </li>
                   
                </ul>
            </div><!--/flexslider-->
        </div><!--/blog-gallery-->
         <?php } ?>
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
                <?php if($audio_text != ''){?><div class="blog-audio-info left"><p><?php echo $audio_text?></p><a href="<?php the_permalink();?>"><?php _e('Read More', tk_theme_name) ?></a></div><?php }?> 
            </div>                         

<!-- Post Link-->    
    <?php } elseif ($format == 'link') {
        $link_text = get_post_meta($post->ID, $prefix.'link_text', true);
        $link_url = get_post_meta($post->ID, $prefix.'link_url', true); ?>

        <div class="blog-link left">
            <div class="post-link-top left"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></div><!--/post-link-top-->
            <div class="post-link-down left"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a><a class="blog-page-link" href="<?php the_permalink();?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/post-link-down-->
        </div><!--/blog-link--> 

<!-- Post Quote -->
    <?php } elseif ($format == 'quote') {
        $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
        $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true); ?>

        <div class="post-quote left">
            <?php if($quote_text) { ?><span><?php echo $quote_text; ?></span><?php } ?>
            <?php if($quote_author){ ?><p><?php echo $quote_author; ?><a href="<?php the_permalink();?>"><?php _e('Read More', tk_theme_name) ?></a></p><?php } ?>
        </div><!--/post-quote-->  
    <?php } ?>

<!-- Post Meta -->    
<?php if($format !=='audio' && $format !=='link' && $format !== 'quote') {?>
    <div class="home-latest-news-title left"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></div><!--/home-latest-news-title-->
    <div class="home-latest-news-category left">
        <ul>
                                <!-- Sticky Post -->
        <?php  if(is_sticky()) { ?>
            <li class="sticky">
                <img src="<?php echo get_template_directory_uri(); ?>/style/img/featured_post.png" alt="images" title="images"  />
                <div class="sticky-text"><?php _e('Featured Post', tk_theme_name) ?></div>
            </li>
        <?php } ?>
            <li>
                <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-1.png" alt="images" title="images"  />
                <p><?php _e('Posted: ', tk_theme_name) ?><?php echo get_the_date()?></p>
            </li>
            <li>
                <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-2.png" alt="images" title="images"  />
                <p><?php _e('By:', tk_theme_name)?><?php the_author_posts_link(); ?></p>
            </li>
            
            <?php if(!empty($categories)){ ?>
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
            <?php } ?>
            
            <li>
                <img src="<?php echo get_template_directory_uri(); ?>/style/img/category-4.png" alt="images" title="images"  />
                <p><?php _e('Comments: ', tk_theme_name)?><?php comments_number( '0', '1', '%' ); ?></p>
            </li>
        </ul>
    </div><!--/home-latest-news-category-->

<!-- Content -->
    <div class="home-latest-news-text left">
        <p><?php the_excerpt_length(275);?></p>
    </div><!--/home-latest-news-text-->    

    <div class="blog-read-more left"><a href="<?php the_permalink();?>"><?php _e('Read More', tk_theme_name) ?></a></div><!--/blog-read-more-->
<?php } ?>
</div><!--/blog-one-->