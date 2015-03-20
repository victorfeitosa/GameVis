<?php
/*

Template Name: Gallery 3 Columns

*/
get_header();
$enable_single = get_theme_option(wp_get_theme()->name . '_gallery_gallery_single');
$gallery_post_type = get_post_meta($post->ID, 'tk_gallery_post_type', true);
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$disable_banner = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);
?>

    <?php if($slider_type == 'revolution' || $slider_type == 'slit') { ?>
        <div <?php if($disable_banner) { ?>class="slider-margin"<?php } ?>>
            <?php get_template_part('/templates/parts/header', 'slider'); ?>
        </div>
    <?php } //check if slider is turned on?>

    <div class="row-fluid photos-gallery-page three-col" id="content">

        <?php if($disable_banner == '') { ?>
            <div class="banner <?php if(!has_post_thumbnail($post -> ID)){ echo 'banner-background'; } ?>" style="<?php if(has_post_thumbnail($post -> ID)){echo 'background:url('.$title_bg_image[0].') no-repeat center';} ?>">
                <div class="row-fluid">
                    <div class="container">
                        <h3 class="BeanFadeDown"><?php echo get_the_title($post -> ID)?></h3>
                        <div class="pull-right BeanFadeDown">
                            <?php 
                                if ( function_exists('yoast_breadcrumb') ) { //Yoast SEO plugin breadcrumbs 
                                        yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                                    } else {
                                        get_template_part('/templates/parts/content', 'breadcrumbs'); 
                                    }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif($disable_banner !=='' && $slider_type =='none') {?>
            <div class="no-banner-spacing"></div>
        <?php } ?>  
        
    <div class="row-fluid">
        <div class="container">

            <div class="row-fluid">
                
                <?php if($post->post_content != ""){?>
                    <div class="shortcodes left container" style="margin-bottom: 50px">
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

                <div class="gallery-filter left container home-tab-nav">
                    <nav class="gallery-filter-nav pull-left">
                        <ul class="nav nav-tabs">
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

            <div class="gallery-wrapper clearfix">
                <div class="gallery-images-content">
                    <?php
                    $args=array('post_type' => 'gallery', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => -1);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $post_category = wp_get_post_terms( $post->ID, 'ct_gallery' );
                        $format = get_post_format();
                        $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'gallery-3-images');
                      
                        if($format == 'gallery'){
                            $random_name = generateRandomString();
                            $slide_images = get_post_meta($post->ID, 'tk_repeatable', true); ?>
                            <div class="span4 img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                    <figure>
                                        <?php if(!empty($slide_images[0])){?>
                                            <img src="<?php echo tk_get_thumb(366, 274, $slide_images[0]); ?>" />
                                        <?php  }else{ // if has image set?>
                                            <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                                        <?php }// if not :-)?>                       
                                        <?php foreach(array_slice($slide_images, 0) as $the_image) { ?>
                                        <div class="post-opt-wrapper">
                                                <div class="post-options <?php if($enable_single == 'no') { echo 'no-single'; } ?>">
                                                    <a href="<?php echo $the_image; ?>" class="fancybox" rel="<?php echo $random_name ?>"><i class="gallery-hover-dots gallery-page"></i></a>
                                                    <?php if($enable_single == 'yes') { ?><a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a><?php } ?>
                                                </div>
                                        </div>
                                        <?php } ?>
                                    </figure>
                                
                                    <div class="post">
                                        <?php if($enable_single == 'yes') { ?><h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6><?php } else { ?><h6><?php the_title(); ?></h6><?php } ?>
                                        <div class="meta-data">
                                            <ul class="categories clearfix gallery-categories">
                                                <?php echo strip_tags(get_the_term_list($post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null)); ?>
                                            </ul>
                                        </div>
                                    </div>
                            </div><!--/gallery-images-one-->       

                        <?php }elseif($format == 'video'){
                            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                            $pos_youtube = strpos($video_link, 'youtube');
                            ?>
                            <div class="span4 img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?> video-project">
                                    <figure>
                                        <?php if(!empty($image)){?>
                                          <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                        <?php  }else{ // if has image set?>
                                            <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                                        <?php }// if not :-)?>                                        
                                        <div class="post-opt-wrapper">
                                            <div class="post-options <?php if($enable_single == 'no') { echo 'no-single'; } ?>">
                                                <a class="<?php if (!empty($pos_youtube)){echo 'youtube';}else{echo 'vimeo';}?>" href="<?php echo $video_link; ?>" title="<?php echo the_title() ?>"><i class="fa fa-play gallery-page"></i></a>
                                                <?php if($enable_single == 'yes') { ?><a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a><?php } ?>
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="post">
                                        <?php if($enable_single == 'yes') { ?><h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6><?php } else { ?><h6><?php the_title(); ?></h6><?php } ?>
                                        <div class="meta-data">
                                            <ul class="categories clearfix gallery-categories">
                                                <?php echo strip_tags(get_the_term_list($post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null)); ?>
                                            </ul>
                                        </div>
                                    </div>
                            </div><!--/gallery-images-one-->        
                        <?php }else{?>
                            <div class="span4 img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                    <figure>
                                        <?php if(!empty($image)){?>
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                        <?php  }else{ // if has image set?>
                                            <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                                        <?php }// if not :-)?>                                        
                                        <div class="post-opt-wrapper">
                                            <div class="post-options <?php if($enable_single == 'no') { echo 'no-single'; } ?>">
                                                <a href="<?php echo $image_full[0]; ?>" class="fancybox" title="<?php echo the_title() ?>"><i class="fa fa-plus"></i></a>
                                                <?php if($enable_single == 'yes') { ?><a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a><?php } ?>
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="post">
                                        <?php if($enable_single == 'yes') { ?><h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6><?php } else { ?><h6><?php the_title(); ?></h6><?php } ?>
                                        <div class="meta-data">
                                            <ul class="categories clearfix gallery-categories">
                                                <?php echo strip_tags(get_the_term_list($post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null)); ?>
                                            </ul>
                                        </div>
                                    </div>
                            </div><!--/gallery-images-one-->
                        <?php } // if  checking format type ?>

                    <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>

                </div><!--/gallery-images-content-->
            </div>
            </div>
        </div>
    </div>
            
</div><!-- work three-col -->

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
                    itemSelector:'.img-post',
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

            jQuery('.img-post').hover(function(){
                jQuery('.gallery-hover',this).stop().animate({opacity:1},300);
                jQuery('.gallery-hover a',this).stop().animate({opacity:1},300);
                jQuery('.gallery-hover-title',this).stop().animate({top: '22%'},300);
                jQuery('.gallery-hover-icon',this).stop().animate({bottom: '<?php if($enable_single == 'yes'){echo '22%';}else{echo '40%';}?>'},300);
            },function(){
                jQuery('.gallery-hover',this).stop().animate({opacity:0},300);
                jQuery('.gallery-hover a',this).stop().animate({opacity:0},300);
                jQuery('.gallery-hover-title',this).stop().animate({top: '-5%'},500);
                jQuery('.gallery-hover-icon',this).stop().animate({bottom: '-5%'},500);
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