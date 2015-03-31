<?php

if(function_exists('is_woocommerce')) {
    if(is_shop()) {
        $slider_type = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_page_slider');
        $slider_alias = get_theme_option(wp_get_theme()->name . '_woocommerce_revolution_shop_alias');
    } elseif(is_product()) {
        $slider_type = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_page_slider');
        $slider_alias = get_theme_option(wp_get_theme()->name . '_woocommerce_revolution_product_alias');
    } else {
        $slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);
        $slider_alias = get_post_meta($wp_query->post->ID, 'tk_slider_id', true);        
    }
} else {
    $slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);
    $slider_alias = get_post_meta($wp_query->post->ID, 'tk_slider_id', true);        
}
    

    if($slider_type == 'revolution'){
        ?>
        <div class="full-width">
            <div class="demo-2">
            <?php
                if (function_exists('putRevSlider')) {
                    putRevSlider($slider_alias);
                }
            ?>
            </div>
        </div>

<?php }elseif($slider_type == 'slit') {
    $slider_height = get_theme_option(wp_get_theme()->name . '_general_slider_height');
    ?>
<style> .work-slider {height: <?php echo $slider_height?>px;}
</style>

<div id="work-slider" class="work-slider"></div>

    <div class="slider-content left demo-2">

           <div id="slider" class="sl-slider-wrapper" style="height: <?php echo $slider_height?>px;">

                <div class="sl-slider">



                    <?php
                    $i = 0;
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args = array('post_status' => 'publish', 'post_type' => 'slider', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                    // The Query
                    query_posts ($args);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                        $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                        $post_thumbnail_src = $post_thumbnail['0'];
                    
                    
                    $background_color = get_post_meta($post->ID, 'tk_background_color', true);                
                    $slider_link = get_post_meta($post->ID, 'tk_slider_link', true);
                    $slider_heading_color = get_post_meta($post->ID, 'tk_slider_heading_color', true);
                    $slider_heading_hover_color = get_post_meta($post->ID, 'tk_slider_heading_hover_color', true);
                    $slider_paragraph_color = get_post_meta($post->ID, 'tk_slider_paragraph_color', true);
                    $pattern_upload = get_post_meta($post->ID, 'tk_pattern_upload', true);
                    $slider_button_color = get_post_meta($post->ID, 'tk_slider_button_color', true);
                    $slider_button_text = get_post_meta($post->ID, 'tk_button_text', true);
                    $slider_author_text = get_post_meta($post->ID, 'tk_author_text', true);
                    $slider_content = get_post_meta($post->ID, 'tk_slider_content', true);
                    $slider_author_color = get_post_meta($post->ID, 'tk_slider_author_color', true);
                    $slider_content_position = get_post_meta($post->ID, 'tk_content_position', true);

                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                     ?>

                    <style type="text/css">                    
                        .sl-slide-horizontal  .inner<?php echo $post->ID ?> {
                            background:url('<?php echo $pattern_upload; ?>') center repeat, <?php echo $background_color; ?>;          
                        }

                        .inner<?php echo $post->ID ?>  h2,   .inner<?php echo $post->ID ?>  h2 a {
                            color:<?php echo $slider_heading_color  ?>;
                        }

                        .inner<?php echo $post->ID ?>  h2 a:hover {
                            color:<?php echo $slider_heading_hover_color; ?>
                        }

                        .inner<?php echo $post->ID ?> p {
                            color:<?php echo $slider_paragraph_color  ?>;
                        }

                        .inner<?php echo $post->ID ?> .cta {
                            color:<?php echo $slider_button_color ?>!important;
                            border-color:<?php echo $slider_button_color ?>!important;
                        }
                        
                        .inner<?php echo $post->ID ?> .cta:hover {
                            color:#444!important;
                            background-color: <?php echo $slider_button_color ?>!important;
                         }
                        
                         .inner<?php echo $post->ID ?> blockquote cite {
                             color: <?php echo $slider_author_color ?>;
                         }
                         
                    </style>


                        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                            <div class="sl-slide-inner <?php echo 'inner'.$post->ID ?> slider-text-holder" <?php if(!empty($background_color)) { ?>style="background-color:<?php echo $background_color; ?>;"<?php } ?>>
                                                         
                                    <div class="slider-text-wrapper">
                                        <div class="bg-img" <?php if(has_post_thumbnail()){echo 'style="background:url('.$post_thumbnail_src.') no-repeat center top"';}?>></div>
                                        <?php if(!empty($slider_link)){ ?>
                                            <h2 class="<?php if($slider_content_position == 'value_two') { echo 'slider-left'; } elseif($slider_content_position == 'value_three') {echo 'slider-right'; }?>"><a target="_blank" href="<?php echo $slider_link; ?>"><?php the_title(); ?></a></h2>
                                        <?php } else { ?>
                                            <h2 class="<?php if($slider_content_position == 'value_two') { echo 'slider-left'; } elseif($slider_content_position == 'value_three') {echo 'slider-right'; }?>"><?php the_title(); ?></h2>
                                        <?php } ?>
                                        <blockquote class="<?php if($slider_content_position == 'value_two') { echo 'slider-left'; } elseif($slider_content_position == 'value_three') {echo 'slider-right'; }?>">
                                            <p><?php echo $slider_content; ?></p>
                                            <cite><?php echo $slider_author_text; ?></cite>
                                        </blockquote>
                                        <div class="button-position <?php if($slider_content_position == 'value_two') { echo 'slider-left'; } elseif($slider_content_position == 'value_three') {echo 'slider-right'; }?>"><?php if(!empty($slider_button_text)) { ?><a href="<?php echo $slider_link; ?>" class="cta"><?php echo $slider_button_text; ?></a><?php } ?></div>
                                    </div><!-- slider-text-wrapper -->
                                                              
                            </div>
                        </div>

                    <?php $i++; endwhile; endif; wp_reset_query();?>



                </div><!-- /sl-slider -->
                
                <?php if($i > 1){ ?>
                    <nav id="nav-arrows" class="nav-arrows">
                        <span class="nav-arrow-prev"><i class="fa fa-chevron-left"></i></span>
                        <span class="nav-arrow-next"><i class="fa fa-chevron-right"></i></span>
                    </nav>
                
                    <nav id="nav-dots" class="nav-dots">                
                        <?php
                        $c = 1;
                        while($c <= $i){ ?>                
                            <?php if($c == 1) { ?>
                                <span class="nav-dot-current"></span>
                            <?php } else { ?>
                                <span></span>
                            <?php } ?>
                        <?php $c++; } ?>
                    </nav>
                <?php } ?>
                
                
            </div><!-- /slider-wrapper -->




        </div><!--/slider-content-->
<?php
    } // if slider type ?>