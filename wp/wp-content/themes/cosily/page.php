<?php
get_header();
$prefix = 'tk_';
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);
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
                <p style="<?php echo 'color:#'.$heading_title_color; ?>"><?php echo $page_headline ?></p>
            </div>
    </div><!--/title-pages-->
    <div class="bottom-slider-red"></div><!--/bottom-slider-red-->



    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">
                <div class="content-left <?php if($sidebar_postition == 'right'){echo 'left';}elseif($sidebar_postition == 'left'){echo 'right';}elseif($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">
            
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
       
                </div><!-- /content-left-->
                
                    <!-- Sidebar -->
                    <?php                     
                                       
                    if($sidebar_postition == 'right'){
                        tk_get_sidebar('Right', $sidebar_select);
                    }elseif($sidebar_postition == 'left'){
                        tk_get_sidebar('Left', $sidebar_select);
                    }
                    ?>
            
            </div><!-- /content-full -->
        </div><!--/wrapper-->        
    </div><!--/content-->

           

<?php get_footer(); ?>