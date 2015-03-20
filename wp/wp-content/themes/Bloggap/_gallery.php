<?php 
/*

Template Name: Gallery

*/
get_header(); 
$prefix = 'tk_';
$gallery_link = get_theme_option(tk_theme_name.'_gallery_gallery_linking');

$gallery_orderby = get_theme_option(tk_theme_name.'_gallery_gallery_orderby');
$gallery_order = get_theme_option(tk_theme_name.'_gallery_gallery_order');
?>

        <!-- CONTENT -->
        <div class="content right">
            <div class="title-page left"><h1><?php the_title(); ?></h1></div><!--/title-page-->
            <div class="gallery-text shortcodes left">
                
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

            </div><!--/gallery-text-->

            <div class="gallery-filter left">
                <span></span>
                        <ul>
                            <a  href="#" data-filter="*" class="active-project"><?php _e('All', tk_theme_name) ?></a>
                            <?php
                              global $wpdb;
                              $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'gallery' AND post_status = 'publish'");
                              if(!empty ($post_type_ids )){
                                $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_gallery',array('orderby' => $gallery_orderby, 'order' =>$gallery_order, 'fields' => 'ids') );
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

                                <a href="#" data-filter="<?php echo '.class-'.$category_list?>"><?php echo $cat_name->name ?></a>

                         <?php } } ?>
                        </ul>
            </div><!--/gallery-filter-->

  
            <div class="gallery-single-content left">
                <div class="gallery-images-content left">

                    <?php
                        if(empty($gallery_link)) {
                            $gallery_link = 'single';
                        }
                        $i = 1;
                        $args=array('post_type' => 'gallery', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => -1, 'order' => $gallery_order);

                        //The Query
                        query_posts($args);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $post_category = wp_get_post_terms( $post->ID, 'ct_gallery' );
                        $format = get_post_format();


                        if($format == 'gallery'){
                        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);} 
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'gallery-front');
                        $image_big = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                        ?>


                            <div class="gallery-images-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                <div class="gallery-content-hover-images left">
                                  <div class="topborder"></div>
                                    <?php if($format =='') { ?>

                                        <?php the_post_thumbnail('gallery'); ?>

                                    <?php } elseif ($format=='video') {

                                            $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                                            $video_test = strpos($video_link, 'youtube');
                                            if($video_test) {
                                                $video = 'video';
                                            } else {
                                                $video = 'vimeo';
                                            }

                                         if(!empty($video_link)){
                                             get_video_image($video_link, $post->ID);
                                             }
                                        } elseif ($format=='gallery') {

                                        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                        if(!empty($slide_images)){?><img src="<?php tk_get_thumb(452, 357, $slide_images[0]); ?>" /><?php } ?>
                                        
                                    <?php } ?>


                                    
                                    <div class="gallery-hover">
                                        <div class="gallery-hover-title">
                                            <?php if($format == '') { ?>
                                                    <?php if($gallery_link  == 'single') { ?>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } elseif($gallery_link  == 'image_pirobox') { ?>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } elseif($gallery_link == 'pirobox')  { ?>
                                                            <a href="<?php echo $image_big[0]; ?>" class="fancybox"><?php the_title(); ?></a>
                                                    <?php } else { ?>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } ?>

                                                <?php } elseif($format == 'video') {
                                                            $video_link = get_post_meta($post->ID, $prefix.'video_link', true);                                              
                                                            $video_test = strpos($video_link, 'youtube');
                                                            if($video_test) {
                                                                $video = 'video';
                                                            } else {
                                                                $video = 'vimeo';
                                                            }
                                                    ?>
                                                    <?php if($gallery_link  == 'single') { ?>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } elseif($gallery_link  == 'image_pirobox') { ?>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } elseif($gallery_link == 'pirobox')  { ?>
                                                            <a href="<?php echo $video_link; ?>" class="<?php echo $video; ?>"><?php the_title(); ?></a>
                                                    <?php } else { ?>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } ?>

                                                <?php } elseif($format == 'gallery') {
                                                    $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                                    if($gallery_link  == 'single') { ?>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } elseif($gallery_link  == 'image_pirobox') { ?>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } elseif($gallery_link == 'pirobox')  { ?>
                                                            <a href="<?php echo $slide_images[0]; ?>" class="fancybox"><?php the_title(); ?></a>
                                                    <?php } else { ?>
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    <?php } ?>
                                              <?php  } ?>
                                        </div><!--/gallery-hover-title-->


                                        <div class="gallery-hover-icon">
                                        <?php if($format == '') { ?>
                                                <?php if($gallery_link  == 'single') { ?>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php } elseif($gallery_link  == 'image_pirobox') { ?>
                                                        <a href="<?php echo $image_big[0]; ?>" class="fancybox" title="<?php the_title(); ?>">
                                                <?php } elseif($gallery_link == 'pirobox')  { ?>
                                                        <a href="<?php echo $image_big[0]; ?>" class="fancybox" title="<?php the_title(); ?>">
                                                <?php } else { ?>
                                                        <a href="<?php the_permalink(); ?>" class="fancybox" title="<?php the_title(); ?>">
                                                <?php } ?>


                                            <?php } elseif($format == 'video') {

                                                        $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                                                        $video_test = strpos($video_link, 'youtube');
                                                        if($video_test) {
                                                            $video = 'video';
                                                        } else {
                                                            $video = 'vimeo';
                                                        }

                                                ?>
                                                 <?php if($gallery_link  == 'single') { ?>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php } elseif($gallery_link  == 'image_pirobox') { ?>
                                                        <a href="<?php echo $video_link; ?>" class="<?php echo $video; ?>" title="<?php the_title(); ?>">
                                                <?php } elseif($gallery_link == 'pirobox')  { ?>
                                                        <a href="<?php echo $video_link; ?>" class="<?php echo $video; ?>" title="<?php the_title(); ?>">
                                                <?php } else { ?>
                                                        <a href="<?php the_permalink(); ?>"  title="<?php the_title(); ?>">
                                                <?php } ?>


                                             <?php } elseif($format == 'gallery') {
                                                         $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                                         ?>
                                                            
                                                        <script type="text/javascript">
                                                            jQuery(document).ready(function($){
                                                                jQuery("a.gallery_box<?php echo $i; ?>").attr('rel', 'gallery').fancybox();
                                                            });
                                                        </script>

                                                         <?php
                                                 if($gallery_link  == 'single') { ?>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php } elseif($gallery_link  == 'image_pirobox') { ?>
                                                        <a href="<?php echo $slide_images[0]; ?>" rel="gallery" class="gallery_box<?php echo $i; ?>"  title="<?php the_title(); ?>">
                                                <?php } elseif($gallery_link == 'pirobox')  { ?>
                                                        <a href="<?php echo $slide_images[0]; ?>" rel="gallery" class="gallery_box<?php echo $i; ?>"   title="<?php the_title(); ?>">
                                                <?php } else { ?>
                                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php } ?>
                                            <?php } ?>


                                            <?php if($format =='') { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/icon-gallery-images.png" alt="" />
                                                <?php } elseif ($format=='video') { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/icon-gallery-audio.png" alt="" />
                                                <?php } elseif ($format=='gallery') { ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/icon-gallery-gallery.png" alt="" />
                                                <?php } ?>
                                            </a>


                                            <?php if($format=='gallery') { ?>
                                                <div style="display:none;">
                                                    <?php
                                                    foreach(array_slice($slide_images, 1) as $the_image) { ?>
                                                        <a href="<?php echo $the_image; ?>" rel="gallery" class="gallery_box<?php echo $i; ?>" title="<?php echo the_title() ?>"><img src="<?php tk_get_thumb(287, 238, $slide_images[0]); ?>" /></a>
                                                    <?php }
                                                    ?>
                                                </div>
                                            <?php } ?>


                                        </div><!--/gallery-hover-icon-->
                                    </div><!--/gallery-hover-->


                                </div><!--/gallery-content-hover-images-->
                            </div><!--/gallery-images-one-->


                    <?php $i++; endwhile; endif; ?>


                </div><!--/gallery-images-content-->
            </div><!--/gallery-single-content-->
          <div id="portfolio-loader"></div>


        </div><!--/content-->
    </div><!--/wrapper-->


<?php get_footer(); ?>