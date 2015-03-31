<?php 
/*

Template Name: Work 3 Columns

*/
get_header(); 

$prefix = 'tk_';

$enable_single = get_theme_option(tk_theme_name.'_work_work_single');

$page_headline = get_post_meta($post -> ID, $prefix . 'headline', true);
?>


<!-- CONTENT STARTS -->
<section>
    <div class="container">

        <!-- Page Title -->
        <div class="row-fluid">
            <div class="span12">
                <h1 class="page_title"><?php the_title(); ?></h1>
                <?php if ($page_headline !== "") { ?>
                    <h2 class="page_description"><?php echo $page_headline ?></h2>
                <?php } ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" alt="separator" />
            </div>
        </div>
        <br>


        <div class="row-fluid">


            <div class="work-filter rounded pull-left">
                <span><?php _e('Filter:', tk_theme_name); ?></span>
                <div class="work-filter-link">
                    <div class="work-filter-link-content">
                        <a  href="#" data-filter="*" class="active-project rounded active"><?php _e('All', tk_theme_name) ?></a>
                        <?php
                            global $wpdb;
                            $work_orderby = get_theme_option(tk_theme_name . '_work_work_orderby');
                            $work_order = get_theme_option(tk_theme_name . '_work_work_order');
                            $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'work' AND post_status = 'publish'");
                            if (!empty($post_type_ids)) {
                                $post_type_cats = wp_get_object_terms($post_type_ids, 'ct_work', array('orderby' => $work_orderby, 'order' => $work_order, 'fields' => 'ids'));
                                if ($post_type_cats) {
                                    $post_type_cats = array_unique($post_type_cats);
                                }
                            }
                            $include_category = null;
                            if (!empty($post_type_ids)) {
                                foreach ($post_type_cats as $category_list) {
                                    $cat = $category_list . ",";
                                    $include_category = $include_category . $cat;
                                    $cat_name = get_term($category_list, 'ct_work');
                                    ?>
                                    <a href="#" data-filter="<?php echo '.class-' . $category_list ?>" class="rounded"><?php echo $cat_name->name ?></a>
                                <?php }
                            } 
                        ?>
                    </div>
                </div>
            </div><!--/work-filter-->


            <div class="row-fluid">
                <?php if(!empty($post->post_content)){ ?>
                    <div id="content" class="span12">
                        <?php
                            wp_reset_query();
                            if (have_posts()) : while (have_posts()) : the_post();
                                    the_content();
                                endwhile;
                            else:
                            endif;
                            wp_reset_query();
                        ?>
                    </div>
                <?php } ?>
            </div>



            <div class="work-single-content three-up pull-left isotope">
                <?php
                    $i = 1;
                    $args = array('post_type' => 'work', 'post_status' => 'publish', 'posts_per_page' => -1);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $post_category = wp_get_post_terms( $post->ID, 'ct_work' );
                    $format = get_post_format();
                    
                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                ?>
                 

                <div class="work-content-one pull-left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>  ">


                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                        <div class="<?php if (has_post_thumbnail()) { echo 'flipper'; } ?>">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="front rounded">
                                    <?php if (has_post_thumbnail() && $format == false) { the_post_thumbnail('work-3-column'); } ?>
                                </div>
                            <?php } ?>
                            <div class="back rounded <?php if (!has_post_thumbnail()) { echo 'fixed'; } ?>">
                                <?php if($enable_single == 'yes'){ ?>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php } else { ?>
                                    <h3><?php the_title(); ?></h3>
                                <?php } ?>
                                
                                <div class="row-fluid">
                                    <div class="span12">
                                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-small.png" alt="separator" />
                                    </div>
                                </div>
                               <p><?php the_excerpt_length(100); ?></p>
                            </div>
                        </div>
                   </div>
                    
                    
                    <?php if ($format == 'video') { 

                        $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                    ?>
                        
                        <a href="<?php echo $video_link; ?>" class=" <?php if(strpos($video_link, 'youtube')){echo 'youtube';}elseif(strpos($video_link, 'vimeo')){echo 'vimeo';}?>">                                            
                            <?php echo get_video_image($video_link, $post->ID); ?>
                            <div>
                                <span><?php the_title(); ?></span>
                                <p></p>
                            </div>
                        </a>
                    
                    <?php } elseif ($format == 'gallery'){ 
                        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);                                           
                    ?>
                    
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                jQuery("a.gallery_box<?php echo $i; ?>").attr('rel', 'gallery').fancybox();
                            });
                        </script>
                    
                        <a href="<?php echo $slide_images[0]; ?>" rel="gallery" class="gallery_box<?php echo $i; ?>">                                            
                            <img src="<?php tk_get_thumb(412, 276, $slide_images[0]); ?>" alt="<?php the_title(); ?>" />
                            <div>
                                <span><?php the_title(); ?></span>
                                <p></p>
                            </div>
                        </a>
                        <span style="display:none !important;">
                            <?php
                            foreach(array_slice($slide_images, 1) as $the_image) { ?>
                                <a href="<?php echo $the_image; ?>" rel="gallery" class="gallery_box<?php echo $i; ?>" title="<?php echo the_title() ?>"><img src="<?php tk_get_thumb(397, 397, $slide_images[0]); ?>" /></a>
                            <?php } ?>
                        </span>
                    
                    
                   <?php } ?>

                </div><!--/work-content-one pull-left-->
                
                <?php $i++; endwhile; endif; ?>

            </div><!-- work-single-content  -->  


        </div><!-- row-fluid -->

    
<?php get_footer(); ?>