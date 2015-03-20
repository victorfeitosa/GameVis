<?php
/*

Template Name: Team

*/
get_header();
$enable_single = get_theme_option(wp_get_theme()->name . '_gallery_gallery_single');
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$heading_background = get_post_meta($post->ID, 'tkingdom'.'background_color', true);
$disable_banner = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);
?>

    <?php if($slider_type == 'revolution' || $slider_type == 'slit') { ?>
        <div <?php if($disable_banner) { ?>class="slider-margin"<?php } ?>>
            <?php get_template_part('/templates/parts/header', 'slider'); ?>
        </div>
    <?php } //check if slider is turned on?>

<div class="team page" id="content">

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

<article>
    <div class="row-fluid">
        <div class="container">

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
            <div id="work-slider" class="work-slider"></div>
            <div class="row-fluid fourths circle-img">
                <div class="gallery-images-content team-page">
                    <?php
                    $args=array('post_type' => 'team-members', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => -1);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $post_category = wp_get_post_terms( $post->ID );
                        $facebook_ico = get_post_meta($post->ID, 'tk_member_facebook', true);
                        $twitter_ico = get_post_meta($post->ID, 'tk_member_twitter', true);
                        $google_ico = get_post_meta($post->ID, 'tk_member_google', true);
                        $linkedin_ico = get_post_meta($post->ID, 'tk_member_linkedin', true);
                        $pinterest_ico = get_post_meta($post->ID, 'tk_member_pinterest', true);
                        $dribbble_ico = get_post_meta($post->ID, 'tk_member_dribbble', true);
                        $mail_ico = get_post_meta($post->ID, 'tk_member_mail', true);
                        $job_title = get_post_meta($post->ID, 'tk_member_position', true);
                      ?>
                            <div class="span3 img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                <figure>
                                    <?php the_post_thumbnail('our-team'); ?>
                                </figure>
                                <div class="profile-info">
                                    <h6><?php the_title(); ?></h6>
                                    <span><?php echo $job_title; ?></span>

                                     <?php /*---SOCIAL ICONS---*/
                                        if ($facebook_ico != '' || $twitter_ico != '' || $google_ico != '' || $linkedin_ico != '' || $pinterest_ico != '' || $dribbble_ico != '' || $mail_ico != '') {
                                            ?>
                                    <ul class="soc-icon">
                                        <?php if(!empty($facebook_ico)) { ?><a href="http://www.facebook.com/<?php echo $facebook_ico; ?>"><li class="facebook"><i class="fa fa-facebook"></i></li></a><?php } ?>
                                        <?php if(!empty($twitter_ico)) { ?><a href="http://www.twitter.com/<?php echo $twitter_ico; ?>"><li class="twitter"><i class="fa fa-twitter"></i></li></a><?php } ?>
                                        <?php if(!empty($google_ico)) { ?><a href="http://plus.google.com/<?php echo $google_ico; ?>"><li class="google-plus"><i class="fa fa-google-plus"></i></li></a><?php } ?>
                                        <?php if(!empty($linkedin_ico)) { ?><a href="<?php echo $linkedin_ico; ?>"><li class="linkedin"><i class="fa fa-linkedin"></i></li></a><?php } ?>
                                        <?php if(!empty($pinterest_ico)) { ?><a href="http://www.pinterest.com//<?php echo $pinterest_ico; ?>"><li class="pinterest"><i class="fa fa-pinterest"></i></li></a><?php } ?>
                                        <?php if(!empty($dribbble_ico)) { ?><a href="http://dribbble.com/<?php echo $dribbble_ico; ?>"><li class="dribble"><i class="fa fa-dribbble"></i></li></a><?php } ?>
                                        <?php if(!empty($mail_ico)) { ?><a href="mailto:<?php echo $mail_ico; ?>"><li class="email"><i class="fa fa-envelope"></i></li></a><?php } ?>
                                    </ul>
                                    <?php } ?>

                                    <p><?php the_content(); ?></p>
                                </div>
                            </div><!--/gallery-images-one-->

                    <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>

                </div><!--/gallery-images-content-->
         </div>
        </div>
    </div>
</article>
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