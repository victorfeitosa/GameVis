<?php
get_header();
$prefix = 'tk_';
$tk_blog_id = get_option('id_blog_page');
$author = get_userdata( $post->post_author );
$blog_title = get_option('title_blog_page');
$sidebar_position = get_post_meta($post -> ID, $prefix.'sidebar_position', true);
if($sidebar_position == ''){$sidebar_position = get_post_meta($tk_blog_id, $prefix.'sidebar_position', true);};

$sidebar_select = get_post_meta($post->ID, $prefix . 'sidebar', true);

if ($sidebar_select == 'none') {
    $sidebar_select = get_post_meta($tk_blog_id, $prefix.'sidebar', true);
}
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);

?>


    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <!-- Page Headline-->
            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php echo $blog_title; ?></h1>
                        <?php if ($page_headline !== '') { ?>
                        <span><?php echo '| ' . $page_headline ?></span>
                        <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->


            <div class="blog-holder left">

            <div class="blog-content left <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">

                    <div class="blog-one left">
                        <div class="blog-categories <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
                            <ul>
                                <li><span><?php _e('Posted on:', tk_theme_name) ?></span><p><?php echo get_the_date()?></p></li>
                                <li><span><?php _e('Categories:', tk_theme_name) ?></span>
                                <?php
                                    $categories = wp_get_post_categories($post -> ID);
                                    $count = count($categories);
                                    $i = 1;
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
                                <li class="blog-meta-by"><span><?php _e('By:', tk_theme_name) ?></span><a href="<?php echo get_author_posts_url($author->ID);?>"><?php echo $author->display_name?></a></li>
                            </ul>
                        </div><!--blog-categories-->

                        <div class="blog-one-content <?php if($sidebar_position == 'right'){echo 'right';}elseif($sidebar_position == 'left'){echo 'left';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
                            <div class="blog-one-title left">
                                <div class="blog-one-comments left"><span><?php comments_number( '0', '1', '%' ); ?></span></div><!--blog-one-comments-->
                                <div class="blog-single-title <?php if($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>"><?php the_title(); ?></div>
                            </div><!--blog-one-title-->
                    
                            <?php
                                    $i = 1;
                                    $format = get_post_format();
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                    $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                                    ?>  
                            <!--Post Standard-->
                            <?php if ($format == 'image' || $format == '') {?>
                                <?php if (has_post_thumbnail()) { ?>
                                    <?php if($sidebar_position == 'fullwidth'){?>
                                        <div class="blog-one-images left"><?php the_post_thumbnail('blog-full'); ?>
                                        </div><!--/blog-images-->
                                    <?php }else{ ?>
                                        <div class="blog-one-images left"><?php the_post_thumbnail('blog'); ?>
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
                                    <?php if($quote_author){ ?><div class="quote-author-holder"><p><?php echo $quote_author; ?></p></div><?php } ?>
                                </div><!--/post-quote-->  
                            <?php } ?>  
                                
                            <div class="blog-one-text left">
                                <div class="shortcodes no-margin left">
                                <?php
                                    wp_reset_query();
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                        endwhile;
                                    else:
                                    endif;
                                    wp_reset_query();
                                    ?>
                                </div><!--/shortcodes-->                                
                            </div><!--blog-one-text-->
                            
                            <!-- Tags -->
                            <div class="blog-single-tag left">
                                <?php the_tags('<span class="tags">Tags: </span>', ', ', ' '); ?>
                            </div><!--/blog-single-tag-->  
                            
                        </div><!--blog-one-content-->
                
                    </div><!--blog-one-->
            
            
                    <div class="<?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
                        <!--COMMENTS-->
                            
                            <?php if ( comments_open() ) : ?>
                                <?php comments_template(); // Get wp-comments.php template ?>
                            <?php endif; ?>
                    </div><!--blog-one-->
                    
            </div><!--blog-content-->
 
                    <!-- Sidebar -->
                    <?php 
                    $sidebar_select = get_post_meta($post->ID, $prefix . 'sidebar', true);
                    if ($sidebar_select == 'none') {
                        $sidebar_select = get_post_meta($tk_blog_id, $prefix.'sidebar', true);
                    }
                    if($sidebar_position == 'right'){
                        tk_get_sidebar('Right', $sidebar_select);
                    }elseif($sidebar_position == 'left'){
                        tk_get_sidebar('Left', $sidebar_select);
                    }
                    ?>


            </div><!-- /blog-holder -->

        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>