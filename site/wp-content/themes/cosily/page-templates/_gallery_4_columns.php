<?php 
/*

Template Name: Gallery_4_Columns

*/
get_header(); 
$prefix = 'tk_';
?>

<?php
/*--Page Headline--*/
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
$heading_background = get_post_meta($post->ID, $prefix.'background_color', true);
$heading_title_color = get_post_meta($post->ID, $prefix.'headline_color', true);
 ?>

        <!-- Page Headline -->
        <div class="title-pages left">
                <div class="title-pages-image left" style="<?php if(has_post_thumbnail()){echo 'background:url('.$title_bg_image[0].')';} else { echo 'background:#'.$heading_background; } ?>"></div>
                <div class="wrapper">
                    <span style="<?php echo 'color:#'.$heading_title_color; ?>"><?php the_title()?></span>
                    <?php
                    $page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
                    if ($page_headline !== "") { ?>
                    <p style="<?php echo 'color:#'.$heading_title_color; ?>"><?php echo $page_headline ?></p>
                    <?php } /*-- /page headline --*/?>
                </div>
        </div><!--/title-pages-->
        <div class="bottom-slider-red"></div><!--/bottom-slider-red-->


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">

                <?php if (!empty ($post -> post_content)) { ?>
                <div class="gallery-text left">
                    <div class="shortcodes left"> 
                        <?php
                        wp_reset_query();
                        if (have_posts()) : while (have_posts()) : the_post();
                                the_content();
                            endwhile;
                        else:
                        endif;
                        wp_reset_query();
                        ?>
                    </div><!-- /shortcodes -->
                </div>
                <?php } ?>
                
            
                <?php //Disable gallery filter
                $filter_option = get_theme_option(tk_theme_name.'_gallery_disable_filter');
                if ($filter_option !== 'yes') {
                ?>
                
                <div class="gallery-filter left">
                    <span><?php _e('Filter', tk_theme_name) ?></span>
                    <div class="gallery-filter-link left">
                        <div class="gallery-filter-link-content left">
                            <a  href="#" data-filter="*" class="active-project active"><?php _e('All', tk_theme_name) ?></a>
                            <?php
                                global $wpdb;
                                $gallery_orderby = get_theme_option(tk_theme_name . '_gallery_gallery_orderby');
                                $gallery_order = get_theme_option(tk_theme_name . '_gallery_gallery_order');
                                $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'gallery' AND post_status = 'publish'");
                                if (!empty($post_type_ids)) {
                                    $post_type_cats = wp_get_object_terms($post_type_ids, 'ct_gallery', array('orderby' => $gallery_orderby, 'order' => $gallery_order, 'fields' => 'ids'));
                                    if ($post_type_cats) {
                                        $post_type_cats = array_unique($post_type_cats);
                                    }
                                }
                                $include_category = null;
                                if (!empty($post_type_ids)) {
                                    foreach ($post_type_cats as $category_list) {
                                        $cat = $category_list . ",";
                                        $include_category = $include_category . $cat;
                                        $cat_name = get_term($category_list, 'ct_gallery');
                            ?>
                            <a href="#" data-filter="<?php echo '.class-' . $category_list ?>"><?php echo $cat_name->name ?></a>
                            <?php }
                               } ?>
                        </div> <!-- /gallery-filter-link-content -->
                    </div> <!-- /gallery-filter-link -->
                </div><!--/gallery-filter-->
                <?php } ?>
                
                
                <div class="gallery4-single-content left">
                    
                    <?php 
                    $args = array ('post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => -1);
                    // The Query
                    query_posts( $args );
                    // The Loop
                    if (have_posts()) : while (have_posts()) : the_post();
                    $post_category = wp_get_post_terms( $post->ID, 'ct_gallery' );
                    $format = get_post_format();
                    $video_link = get_post_meta($post -> ID, $prefix.'video_link', true);
                    $i = 1;
                    $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');                
                    ?>

                    <div class="gallery-content-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                        
                        <?php if ($format == '') { ?>   
                            <a href="<?php echo $image_full[0] ?>" class="fancybox">
                        
                        <?php } elseif ($format =='video') { ?>
                            <a href="<?php echo $video_link?>" class="fancybox <?php if(strpos($video_link, 'youtube')){echo 'youtube';}elseif(strpos($video_link, 'vimeo')){echo 'vimeo';}?>">
                               
                        
                        <?php } elseif ($format == 'gallery') { ?>     
                            <!-- gallery post fancybox -->    
                            <?php
                                $random_name = generateRandomString();
                                if(!empty($slide_images)) { ?>
                                <?php foreach(array_slice($slide_images, 1) as $the_image) {    ?>
                                    <a href="<?php echo $the_image?>" class="fancybox" rel="<?php echo $random_name ?>" style="display:none"></a>
                                <?php } ?>
                            <?php } ?>
                            <a href="<?php echo $slide_images[0]; ?>" class="fancybox" rel="<?php echo $random_name ?>">                                
                        <?php } ?>
                                
                            <div class="horisontal-images left">
                                
                                <?php if ($format == '') { ?>
                                <?php the_post_thumbnail('gallery-4-columns'); ?>

                                <?php } elseif ($format == 'video') { ?>
                                <?php get_video_image($video_link, $post -> id); ?>
                                <?php } elseif ($format == 'gallery') { ?>
                                <img  src="<?php tk_get_thumb(221, 178, $slide_images[0])?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                <?php } else {} ?>
                                
                                <div class="horisontal-images-hover">
                                    <div class="text-wrap">
                                        <div class="center-wrap">
                                        <span><?php the_title(); ?></span>
                                        <?php if ($format =='') { ?>
                                        <p></p>
                                        <?php } elseif ($format == 'video') {?>
                                        <p class="video-hover"></p>
                                        <?php } elseif ($format == 'gallery') {?>
                                        <p class="gallery-hover"></p>
                                        <?php } ?>
                                        </div><!-- center-wrap -->
                                    </div><!-- text-wrap -->
                                </div>
                            </div>
                        </a>
                    </div><!--/gallery-content-one-->
                    <?php endwhile; endif; ?>  
                
                </div><!--/gallery-single-content-->


            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->

<script type="text/javascript">
        
    jQuery(document).ready(function(){
            "use strict";
            //LOAD ISOTOPE
            var container = jQuery('.gallery4-single-content');
            jQuery(container).imagesLoaded(function(){
                jQuery(container).isotope({
                    layoutMode:'fitRows',
                    itemSelector:'.gallery-content-one',
                    isAnimated:true,
                    animationEngine:'jquery',
                    animationOptions:{
                        duration:800,
                        easing:'easeOutCubic',
                        queue:false
                    }
                });
            });

            jQuery('.gallery-filter-link-content a').click(function(){
                var selector = jQuery(this).attr('data-filter');
                jQuery(container).isotope({ filter: selector });
                return false;
            });
            
            jQuery('.gallery-filter-link-content a').each(function(){
                jQuery(this).click(function(){
                   jQuery('.gallery-filter-link-content a').each(function(){
                     jQuery(this).removeClass('active');
               });
                    jQuery(this).addClass('active');
                });
            });
        });
        
        jQuery(function() {
            "use strict";
            jQuery("<select />").appendTo(".gallery-filter-link-content");
                jQuery("<option />", {
                 "selected": "selected",
                 "value"   : "",
                 "text"    : "Go to..."
                }).appendTo(".gallery-filter-link-content select");
            jQuery(".gallery-filter-link-content a").each(function() {
                var el = jQuery(this);
                jQuery("<option />", {
                   "value"   : el.attr("href"),
                   "data-filter"   : el.attr("data-filter"),
                   "text"    : el.text()
                }).appendTo(".gallery-filter-link-content select");
            });
            jQuery(".gallery-filter-link-content select").change(function() {
                var container = jQuery('.gallery4-single-content');
                var selector = jQuery(this).find("option:selected").attr('data-filter');
                jQuery(container).isotope({ filter: selector });
                return false;
            });
        });
    </script>
    
<?php get_footer(); ?>