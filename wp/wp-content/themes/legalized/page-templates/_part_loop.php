<?php 
$prefix = 'tk_';

global $paged, $args, $format, $categories, $count, $i, $tk_blog_id, $sidebar_postition;

//Meta Date
$post_day = get_the_date('d');
$post_month = get_the_date('M');
$post_year = get_the_date('Y');

/* Single Post featured image */
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

$format = get_post_format();
$categories = wp_get_post_categories($post -> ID);
$count = count($categories);
$i = 1;
?>

<!--Post Standard-->
<?php if ($format == 'image' || $format == '') { ?>

        <?php if (has_post_thumbnail()) { ?>
            <div class="blog-images">
                <a class="fancybox" href="<?php echo $image[0]; ?>"><?php the_post_thumbnail('blog-full'); ?></a>
                <div class="blog_img_hover rounded"><a class="fancybox img_plus" href="<?php echo $image[0]; ?>"></a></div>
            </div><!--/blog-images-->
            <br>
        <?php } ?>



<!-- Post Video -->
<?php } elseif ($format == 'video') { 

        $video_link = get_post_meta($post->ID, $prefix.'video_link', true); ?>
        <div class="blog-video"><?php tk_video_player($video_link); ?></div><!--/blog-video-->
        <br>

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

                <div class="blog-gallery">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php foreach($slide_images as $the_image) { ?>
                                <li class="blog_images blog-images">
                                    <a class="fancybox" href="<?php tk_get_thumb(963, 537, $the_image); ?>"><img src="<?php tk_get_thumb(963, 537, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
                                    
                                </li>
                            <?php } ?>
                        </ul>
                    </div><!--/flexslider-->
                </div><!--/blog-gallery-->

            <?php } ?>
            <div class="clear"></div>
            <br>
<?php } ?>



<!-- COMMON -->

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
        <img src="<?php echo get_template_directory_uri(); ?>/style/images/post-format-<?php echo $post_format_img; ?>.png" alt="post format"/>
    </div>
    <div class="clear"></div>
</div>



<!-- Post title -->
<?php if ($format == 'standard' || $format == '' || $format == 'gallery' || $format == 'aside' || $format == 'video') { ?> 

        <h3 class="post_title red"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

<?php } elseif ($format == 'image') { ?>

        <h3 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

<?php } elseif ($format == 'link') { 

        $link_text = get_post_meta($post->ID, $prefix.'link_text', true);
        $link_url = get_post_meta($post->ID, $prefix.'link_url', true); ?>

        <h3 class="post_title link_title"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></h3>
        <span class="by"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></span>
        <div class="clear"></div>

<?php } elseif ($format == 'quote') {

        $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
        $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true); ?>

        <?php if($quote_text) { ?>
            <h3 class="post_title quote_title"><?php echo $quote_text; ?></h3>
        <?php } else { ?>
            <h3 class="post_title quote_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php } ?>

        <?php if ($quote_author){ echo '<span class="by">'.$quote_author.'</span><div class="clear"></div>'; }

    } ?>

<!-- COMMON ends -->



<!-- Post Audio -->        
<?php if ($format == 'audio') { 

        $audio_text = get_post_meta($post->ID, $prefix.'audio_text', true); ?>

        <!-- Audio player -->
        <div class="blog-player-content">   
            <div class="blog-player" <?php if($sidebar_postition == 'fullwidth'){echo 'style="width:94.5%"';} ?>>
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
<?php } ?>



<!-- COMMON -->

<!-- By -->
<?php if ($format == 'standard' || $format == '' || $format == 'gallery' || $format == 'aside' || $format == 'image' || $format == 'video') { ?>  
    <span class="by"><?php the_author_posts_link(); ?> / <a href="<?php the_permalink()?>"><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', tk_theme_name) ?></a></span>
    <?php if($format == 'audio') { ?><div class="clear"></div> <?php } ?>
<?php } elseif ($format == 'audio') { ?>
    <span class="by"><?php if($format == 'audio') { if($audio_text != ''){ echo $audio_text; } } ?></span>
    <div class="clear"></div>
<?php } ?>


<!-- Post content/exerpt -->
<?php if ($format == 'standard' || $format == '' || $format == 'gallery' || $format == 'aside' || $format == 'video') { ?>  


<!-- Show categories -->
<?php if ($categories) { echo '<span class="by"> /&nbsp;</span>'; } ?>
<span class="by">
    <ul>
        <?php 
            foreach ($categories as $cat_id) {
                $cat_name = get_cat_name($cat_id);
                $cat_link = get_category_link($cat_id);

                if ($count == $i) {
                    $comma = '';
                } else {
                    $comma = ",";
                }
        ?>
        <li>
            <a href="<?php echo $cat_link;?>"><?php echo $cat_name.$comma;?></a>
        </li>
        <?php $i++;} ?>
    </ul>
</span>
<div class="clear"></div>


<!-- Content -->
<p><?php the_excerpt_length(230);?></p>

   
<?php } ?>


    <!-- Read more -->
    <?php if ($format == 'video') { echo '<div class="clear"></div>'; } ?>
    <a class="read_more" href="<?php the_permalink();?>"><?php _e('Read More', tk_theme_name) ?></a>
    <br>
    <div class="row-fluid">
        <div class="span12 holder">
            <!-- Sticky Post -->
            <?php  if(is_sticky()) { ?>
                <div class="sticky"><?php _e('Feautred Post', tk_theme_name) ?></div>
            <?php } ?>
            <img src="<?php echo get_template_directory_uri(); ?>/style/images/sep.png" alt="separator" />
            <div class="sep_border"></div>
        </div>
    </div>
    <br>

<!-- COMMON ends -->