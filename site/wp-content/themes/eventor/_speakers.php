<?php
/*

Template Name: Speakers

*/
get_header();
$prefix = 'tk_';

$page_headline = get_post_meta($post->ID, $prefix.'page_headline', true);
?>


    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php the_title(); ?></h1>
                        <?php if ($page_headline !== '') { ?>
                        <span><?php echo '| ' . $page_headline ?></span>
                        <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->



            <div class="blog-holder left">

                <?php //Page Content
                if(!empty($post->post_content)) { ?>
                    <div class="gallery-text left">
                        <div class="shortcodes bottom-margin">
                            <?php
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                                the_content();
                            endwhile; endif;
                            ?>
                        </div><!--/contact-text-->
                    </div><!--/gallery-text-->
                <?php } ?>
                
                <div class="speakers-filter left">
                    
                        <a  href="#" data-filter="*" class="active-project active"><?php _e('All', tk_theme_name) ?><p></p></a>
                            <?php
                              global $wpdb;
                              $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'speaker' AND post_status = 'publish'");
                              if(!empty ($post_type_ids )){
                                $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_speakers',array('orderby' => 'name', 'fields' => 'ids') );
                                if($post_type_cats){
                                  $post_type_cats = array_unique($post_type_cats);
                                }
                              }
                              $include_category = null;
                                if(!empty ($post_type_ids )){
                                     foreach ($post_type_cats as $category_list) {
                                        $cat = 	$category_list.",";
                                        $include_category = $include_category.$cat;
                                        $cat_name = get_term($category_list, 'ct_speakers');
                                ?>
                                <a href="#" data-filter="<?php echo '.class-'.$category_list?>"><?php echo $cat_name->name ?><p></p></a>
                            <?php } }?>
                </div><!-- /speakers-filter -->
                
                <div class="portfolio-loader" id="portfolio-loader"></div>

                <div class="speakers-row left">
                    <?php
                            $args=array('post_type' => 'speaker', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => -1);
                            
                            //The Query
                            query_posts($args);

                            //The Loop
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $post_category = wp_get_post_terms( $post->ID, 'ct_speakers' );
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'speakers');
                            $member_title = get_post_meta($post->ID, $prefix.'title_info', true);

                            
                        ?>

                    <div class="speakers-content-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                        <div class="speakers-img left">
                            <?php if(!empty($image)) { ?>
                            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  />
                            <?php } else { ?>
                            <img src="<?php echo get_template_directory_uri() ?>/style/img/default-speaker.png" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  />
                            <?php } ?>
                            <a href="<?php the_permalink(); ?>"><p></p></a>
                        </div><!-- /speakers-img -->
                        <div class="speakers-text left">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php if($member_title) { ?><span><?php echo $member_title; ?></span><?php } ?>
                            <p><?php the_excerpt_length(60); ?></p>
                        </div><!-- /speakers-text -->
                    </div><!-- /speakers-content-one -->

                    <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>

                </div><!-- /speakers-row -->

            </div><!-- /shortcodes -->

        </div><!--/wrapper-->
    </div><!--/content-->

    <script type="text/javascript">

    jQuery(document).ready(function(){

            //LOAD ISOTOPE
            var container = jQuery('.speakers-row');
            jQuery(container).imagesLoaded(function(){
                jQuery('.portfolio-loader').attr('style', 'display:none');
                jQuery(container).show().animate({opacity:1},1000);
                jQuery('.speakers-row').show();
                jQuery(container).isotope({
                    layoutMode:'fitRows',
                    itemSelector:'.speakers-content-one',
                    isAnimated:true,
                    animationEngine:'jquery',
                    animationOptions:{
                        duration:800,
                        easing:'easeOutCubic',
                        queue:false
                    }
                });
            });
            
            jQuery('.team-single-images').imagesLoaded(function(){
                jQuery('.portfolio-loader').attr('style', 'display:none');
                jQuery('.team-single-images').attr('style', 'display:inline-block');
            });

            jQuery('.speakers-filter a').click(function(){
                var selector = jQuery(this).attr('data-filter');
                jQuery(container).isotope({ filter: selector });
                return false;
            });

            jQuery('.speakers-filter a').each(function(){
                jQuery(this).click(function(){
                   jQuery('.speakers-filter a').each(function(){
                     jQuery(this).removeClass('active');
               });
                    jQuery(this).addClass('active');
                });
            });

        })


    </script>
    
    
<?php get_footer(); ?>