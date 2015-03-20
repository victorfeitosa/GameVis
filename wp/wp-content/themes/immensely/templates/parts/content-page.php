<?php
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$disable_banner = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);

?>

    <?php if($slider_type == 'revolution' || $slider_type == 'slit') { ?>
        <div <?php if($disable_banner) { ?>class="slider-margin"<?php } ?>>
            <?php get_template_part('/templates/parts/header', 'slider'); ?>
        </div>
    <?php } //check if slider is turned on?>

<div id="content">

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
        <?php } ?>
    
        <div class="row-fluid">
            <div class="container">
                <div class="shortcodes <?php if($sidebar_postition == 'fullwidth'){echo '';}elseif($sidebar_postition == 'left'){echo 'span9 pull-right';}else{echo 'span9';}?>">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                    <?php endif;?>
                </div>

                        <!-- Sidebar Left -->
                        <?php
                        
                        if($disable_banner == 'on') {
                            $add_margin = 'add_margin';
                        } else {
                            $add_margin = '';
                        }
                        
                        if ($sidebar_postition == 'left'){
                            echo '<div class="span3 '.$add_margin.' pull-left" id="sidebar" style="margin-left:0px;">';
                            tk_get_sidebar('Left', $sidebar_selected);
                            echo '</div>';
                        }
                        ?>
                        <!-- Sidebar Right -->
                        <?php
                        if ($sidebar_postition == 'right'){
                            echo '<div class="span3 '.$add_margin.' pull-right" id="sidebar" >';
                            tk_get_sidebar('Right', $sidebar_selected);
                            echo '</div>';
                        }
                        ?>
                        <!--/sidebar-->

            </div>
    </div>

</div>