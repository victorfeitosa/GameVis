<?php get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta(get_option('id_blog_page'), $prefix.'sidebar_position', true);
$blog_title = get_option('title_blog_page');
$author = get_userdata( $post->post_author );
$video_link = get_post_meta($post->ID, 'tk_video_link', true);
$post_type = get_post_type();

$embed_code = wp_oembed_get($video_link, array('width'=>660));


$slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
$images = '';
 if(!empty($slide_images)){
     foreach($slide_images as $slide) {
         if($slide != ''){
         $images .= '<img src="'.tk_get_thumb_new(648, 330, $slide).'"/>';
             }
         }
     }

 $default_attr = array( 'alt' =>get_the_title(), 'title' =>get_the_title());

?>

<script type="text/javascript">
jQuery(document).ready(function(){

        // NIVO SLIDER
        jQuery('#slider-nivo').nivoSlider({
            effect:'random', //Specify sets like: 'fold,fade,sliceDown'
            slices:15,
            animSpeed:500, //Slide transition speed
            pauseTime:3000,
            startSlide:0, //Set starting Slide (0 index)
            directionNav:false, //Next & Prev
            directionNavHide:false, //Only show on hover
            controlNav:true, //1,2,3...
            controlNavThumbs:false, //Use thumbnails for Control Nav
            controlNavThumbsFromRel:false, //Use image rel for thumbs
            controlNavThumbsSearch: '.jpg', //Replace this with...
            controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
            keyboardNav:true, //Use left & right arrows
            pauseOnHover:false, //Stop animation while hovering
            manualAdvance:false, //Force manual transitions
            captionOpacity:0.8, //Universal caption opacity
            beforeChange: function(){},
            afterChange: function(){},
            slideshowEnd: function(){}, //Triggers after all slides have been shown
            lastSlide: function(){}, //Triggers when last slide is shown
            afterLoad: function(){} //Triggers when slider has loaded
        });
});


</script>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">



        <!--SIDEBAR-->
      <?php tk_get_left_sidebar($sidebar_position, 'Blog')?>
            <div class="page-content left">

                <div class="blog-single left">
                    <div class="blog-title left"><?php the_title(); ?></div><!--/blog-title-->
                    
                    <div class="blog-comments-date left">
                        <div class="blog-comments left"><?php _e("Comments", 'Themetick')  ?> <?php comments_number( '0', '1', '%' ); ?></div><!--/blog-comments-->
                        <div class="blog-date left">-  <?php echo $author->display_name; ?> on <?php echo get_the_date(); ?> in<?php echo get_the_category_list( '&#10;', $post->ID ); ?> </div><!--/blog-date-->
                    </div><!--/blog-comments-date-->
                    

                      <?php if(!empty($video_link)){?>
                                    <div class="blog-one-video left"><?php echo $embed_code;?></div><!--blog-one-video-->
                    <?php } elseif(!empty($images)) { ?>
                    <div class="blog-bg-images left">

                        <div id="slider-nivo" class="nivoSlider">
                            <?php echo $images; ?>

                        </div>
                    </div><!--/slider-wrapper-->

                    <?php
                    } elseif(has_post_thumbnail()){?>
                        <div class="blog-bg-images left"><a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>" class="pirobox"><?php the_post_thumbnail('single', $default_attr); ?></a></div><!--/blog-bg-images-->
                    <?php } ?>


                    <div class="shortcodes blog-text left">
                                <?php
                                    wp_reset_query();
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                        endwhile;
                                    else:
                                    endif;
                                    wp_reset_query();
                                    ?> 
                    </div><!--/blog-text-->
                </div><!--/blog-single-->


                
                <!--COMMENTS-->
                <div class="comment-start left">
                        <?php if ( comments_open() ) : ?>
                            <?php comments_template(); // Get wp-comments.php template ?>
                        <?php endif; ?>
                </div><!--/comment-start-->
            </div><!--/page-content-->


            <?php tk_get_right_sidebar($sidebar_position, 'Blog')?>
        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>