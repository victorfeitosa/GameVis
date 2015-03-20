<?php
/*

Template Name: Gallery

*/
get_header();

$enable_single = get_theme_option(wp_get_theme()->name . '_gallery_gallery_single');
$gallery_post_type = get_post_meta($post->ID, 'tk_gallery_post_type', true);
$disable_title = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

// check for slider, map and latest news and add css class
if($use_slider !== 'on'){$slider_class = 'no-slider';}else{$slider_class = '';}
if($template_name == 'templates/template-contact.php' && ($show_map != 'yes' && $use_large_map != 'content' )){$css_class = '';}
if($use_latest_news !== 'on'){$news_class = 'no-news';}else{$news_class = '';}
?>


    <div class="row-fluid photos-gallery-page shortcodes-margin">
        <div class="container">

        <?php if(empty($disable_title)){?>
            <h1 class="title-divider">
                <span><?php the_title()?></span>
                <?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?>
            </h1>
        <?php } ?>

            <div class="row-fluid margin-bottom-80">

                <?php if($post->post_content != ""){?>
                    <div class="shortcodes left container margin-bottom-60">
                        <?php
                        /* Run the loop to output the page.
                                                 * If you want to overload this in a child theme then include a file
                                                 * called loop-page.php and that will be used instead.
                        */
                        //get_template_part( 'loop', 'page' );
                        wp_reset_query();
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                        else:
                        endif;
                        wp_reset_query();
                        ?>
                    </div><!-- /contact-text -->
                <?php } // if content?>

                <div class="gallery-filter left home-tab-nav">                   
                    <nav class="gallery-filter-nav">
                        <ul class="nav nav-tabs-gallery">
                            <li><a  href="#" data-filter="*" class="active-project active"><?php _e('All', 'tkingdom') ?></a></li>
                            <?php
                            global $wpdb;
                            $gallery_orderby = get_theme_option(wp_get_theme()->name.'_gallery_gallery_orderby');
                            $gallery_order = get_theme_option(wp_get_theme()->name.'_gallery_gallery_order');
                            $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'gallery' AND post_status = 'publish'");
                            if(!empty ($post_type_ids )){
                                $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_gallery',array('orderby' => $gallery_orderby, 'order' => $gallery_order, 'fields' => 'ids') );
                                if($post_type_cats){
                                    $post_type_cats = array_unique($post_type_cats);
                                }
                            }
                            $include_category = null;
                            if(!empty ($post_type_ids )){
                                foreach ($post_type_cats as $category_list) {
                                    $cat = 	$category_list.",";
                                    $include_category = $include_category.$cat;
                                    $cat_name = get_term($category_list, 'ct_gallery');
                                    ?>
                                    <li>
                                        <a href="#" data-filter="<?php echo '.class-'.$category_list?>"><?php echo $cat_name->name ?></a>
                                    </li>
                                <?php } }?>
                        </ul>
                    </nav>
                </div><!--/gallery-filter-->

               
                    <div class="gallery-images-content left">
                        <?php
                        $i=1;
                        $args=array('post_type' => 'gallery', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => -1);

                        //The Query
                        query_posts($args);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $post_category = wp_get_post_terms( $post->ID, 'ct_gallery' );
                            $format = get_post_format();
                            $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'gallery-images');
                            $get_post_format = get_post_format();


                            //GALLERY POST FORMAT
                            if($format == 'gallery'){
                                $slide_images = get_post_meta($post->ID, 'tk_repeatable', true); ?>
                        
                                <script type="text/javascript">
                                    jQuery(document).ready(function($){
                                        jQuery("a.gallery_box<?php echo $i; ?>").attr('rel', 'gallery').fancybox();
                                    });
                                </script>
                        
                                <div class="gallery-images-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                    <?php if(!empty($slide_images[0])){?>
                                        <?php if(!empty($slide_images[0])){?><img src="<?php echo tk_get_thumb(420, 420, $slide_images[0]); ?>" /><?php }?>
                                    <?php  }else{ // if has image set?>
                                        <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                    <?php }// if not :-)?>
                                    <div class="gallery-hover">
                                        <div class="gallery-hover-title">
                                            <?php if($enable_single == 'yes'){?>
                                                <a href="<?php the_permalink()?>">
                                                    <span><?php the_title()?></span>
                                                </a>
                                            <?php } ?>
                                        </div><!--/gallery-hover-title-->
                                        <div class="gallery-hover-wrap">
                                            <div class="gallery-hover-icon get-gallery-icon">                                        
                                                <a href="<?php echo $slide_images[0]; ?>"  class="gallery_box<?php echo $i; ?>"></a>                                           
                                            </div><!--/gallery-hover-icon-->
                                        </div><!-- gallery-hover-wrap -->
                                    </div><!--/gallery-hover-->
                                </div><!--/gallery-images-one-->
                                
                                <span style="display:none !important;">
                                    <?php var_dump($slide_images);
                                    foreach(array_slice($slide_images, 1) as $the_image) { ?>
                                        <a href="<?php echo $the_image; ?>" rel="gallery" class="gallery_box<?php echo $i; ?>" title="<?php echo the_title() ?>"><img src="<?php tk_get_thumb(420, 420, $the_image); ?>" /></a>
                                    <?php } ?>
                                </span>
                                


                            <!-- VIDEO FORMAT -->
                            <?php }elseif($format == 'video'){
                                $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                                $pos_youtube = strpos($video_link, 'youtube');
                                ?>
                                <div class="gallery-images-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?> video-project">
                                    <?php if(!empty($video_link)){?>
                                        <?php if(!empty($video_link)){ the_post_thumbnail('gallery-images'); }?>
                                    <?php  }else{ // if has image set?>
                                        <img src="<?php echo get_template_directory_uri().'/img/no-image.jpg';?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"/>
                                    <?php }// if not :-)?>
                                    <div class="gallery-hover">
                                        <div class="gallery-hover-title">
                                            <?php if($enable_single == 'yes'){?>
                                                <a href="<?php the_permalink()?>">
                                                    <span><?php the_title()?></span>
                                                </a>
                                            <?php }?>
                                        </div><!--/gallery-hover-title-->
                                        <div class="gallery-hover-wrap">
                                            <div class="gallery-hover-icon get-video-icon">
                                                <a class="<?php if (!empty($pos_youtube)){echo 'youtube';}else{echo 'vimeo';}?>" href="<?php echo $video_link; ?>" class="fancybox" title="<?php echo the_title() ?>"></a>
                                            </div><!--/gallery-hover-icon-->
                                        </div><!-- gallery-hover-wrap -->
                                    </div><!--/gallery-hover-->
                                </div><!--/gallery-images-one-->

                            <!-- STANDARD FORMAT -->
                            <?php }elseif($format == 'image'){?>
                                <div class="gallery-images-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                    <?php if(!empty($image)){?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                    <?php  }else{ // if has image set?>
                                        <img src="<?php echo get_template_directory_uri().'/img/no-image.jpg';?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"/>
                                    <?php }// if not :-)?>
                                    <div class="gallery-hover">
                                        <div class="gallery-hover-title">
                                            <?php if($enable_single == 'yes'){?>
                                                <a href="<?php the_permalink()?>">
                                                    <span><?php the_title()?></span>
                                                </a>
                                            <?php }?>
                                        </div><!--/gallery-hover-title-->
                                        <div class="gallery-hover-wrap">
                                            <div class="gallery-hover-icon get-standard-image">
                                                <a href="<?php echo $image_full[0]; ?>" class="fancybox" title="<?php echo the_title() ?>"></a>
                                            </div><!--/gallery-hover-icon-->
                                        </div><!-- gallery-hover-wrap -->
                                    </div><!--/gallery-hover-->
                                </div><!--/gallery-images-one-->

                            <!-- STANDARD FORMAT -->
                            <?php }else{?>
                                <div class="gallery-images-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                    <?php if(!empty($image)){?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                    <?php  }else{ // if has image set?>
                                        <img src="<?php echo get_template_directory_uri().'/img/no-image.jpg';?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"/>
                                    <?php }// if not :-)?>
                                    <div class="gallery-hover">
                                        <div class="gallery-hover-title">
                                            <?php if($enable_single == 'yes'){?>
                                                <a href="<?php the_permalink()?>">
                                                    <span><?php the_title()?></span>
                                                </a>
                                            <?php }?>
                                        </div><!--/gallery-hover-title-->

                                        <div class="gallery-hover-wrap">
                                            <div class="gallery-hover-icon get-standard-image">
                                                <a href="<?php echo $image_full[0]; ?>" class="fancybox" title="<?php echo the_title() ?>"></a>
                                            </div><!--/gallery-hover-icon-->
                                        </div><!-- gallery-hover-wrap -->

                                    </div><!--/gallery-hover-->
                                </div><!--/gallery-images-one-->
                            <?php } // if  checking format type ?>

                        <?php $i++; endwhile; ?>
                        <?php else: ?>
                        <?php endif; ?>

                    </div><!--/gallery-images-content-->               
            </div>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(function(){
            var opts = {
                lines: 9, // The number of lines to draw
                length: 6, // The length of each line
                width: 2, // The line thickness
                radius: 5, // The radius of the inner circle
                corners: 0.4, // Corner roundness (0..1)
                rotate: 0, // The rotation offset
                color: '#FFF', // #rgb or #rrggbb
                speed: 1, // Rounds per second
                trail: 60, // Afterglow percentage
                shadow: true, // Whether to render a shadow
                hwaccel: false, // Whether to use hardware acceleration
                className: 'spinner', // The CSS class to assign to the spinner
                zIndex: 2e9, // The z-index (defaults to 2000000000)
                top: 'auto', // Top position relative to parent in px
                left: 'auto' // Left position relative to parent in px
            };
            var target = document.getElementById('portfolio-loader');
            var spinner = new Spinner(opts).spin(target);
            var target2 = document.getElementById('portfolio-loader2');
            var spinner2 = new Spinner(opts).spin(target2);
        })

        jQuery(document).ready(function(){

            //LOAD ISOTOPE
            var container = jQuery('.gallery-images-content');
            jQuery(container).imagesLoaded(function(){
                jQuery('.portfolio-loader').attr('style', 'display:none');
                jQuery(container).show().animate({opacity:1},1000);
                jQuery('.gallery-images-content').show();
                jQuery(container).isotope({
                    layoutMode:'fitRows',
                    itemSelector:'.gallery-images-one',
                    isAnimated:true,
                    animationEngine:'jquery',
                    animationOptions:{
                        duration:800,
                        easing:'easeOutCubic',
                        queue:false
                    }
                });
            });

            jQuery('.gallery-single-images').imagesLoaded(function(){
                jQuery('.portfolio-loader2').attr('style', 'display:none');
                jQuery('.gallery-single-images').attr('style', 'display:inline-block');
            });

            jQuery('.gallery-filter ul li a').click(function(){
                var selector = jQuery(this).attr('data-filter');
                jQuery(container).isotope({ filter: selector });
                return false;
            });


            jQuery('.gallery-filter li a').each(function(){
                jQuery(this).click(function(){
                    jQuery('.gallery-filter li a').each(function(){
                        jQuery(this).removeClass('active');
                    });
                    jQuery(this).addClass('active');
                });
            });

        })

        jQuery(function($) {

            jQuery("<select />").appendTo(".gallery-filter");

            // Create default option "Go to..."
            jQuery("<option />", {
                "selected": "selected",
                "value"   : "",
                "text"    : "Go to..."
            }).appendTo(".gallery-filter select");

            // Populate dropdown with menu items
            jQuery(".gallery-filter a").each(function() {
                var el = $(this);
                jQuery("<option />", {
                    "value"   : el.attr("href"),
                    "data-filter"   : el.attr("data-filter"),
                    "text"    : el.text()
                }).appendTo(".gallery-filter select");
            });

            // To make dropdown actually work
            // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
            jQuery(".gallery-filter select").change(function() {
                var container = jQuery('.gallery-images-content');
                var selector = jQuery(this).find("option:selected").attr('data-filter');
                jQuery(container).isotope({ filter: selector });
                return false;
            });

        });

    </script>

<?php get_footer(); ?>