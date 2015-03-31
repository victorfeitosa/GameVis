<?php get_header();
$prefix = 'tk_';
$author = get_userdata( $post->post_author );
$post_type = get_post_type();
$video_link = get_post_meta($post->ID, 'tk_video_link', true);
$args = array(
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_type' => 'attachment',
        'post_parent' => $post->ID,
        'post_mime_type' => 'image',
        'post_status' => null,
        'numberposts' => -1,
);
$attachments = get_posts($args);
$show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');
$show_call_to_action= get_theme_option(tk_theme_name.'_home_use_call_to_action');
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <?php if ($show_call_to_action == 'yes'){?>
            <div class="bg-content left">
                <div class="bg-content-center">
                    
                <?php
                    $show_call_to_action= get_theme_option(tk_theme_name.'_home_use_call_to_action');
                    $call_to_action_image = get_theme_option(tk_theme_name.'_home_use_call_to_action_image');
                    $call_to_action_title = get_theme_option(tk_theme_name.'_home_call_to_action_title');
                    $call_to_action_text = get_theme_option(tk_theme_name.'_home_call_to_action_text');
                    $call_to_action_button_text = get_theme_option(tk_theme_name.'_home_call_to_action_button_text');
                    $call_to_action_button_url = get_theme_option(tk_theme_name.'_home_call_to_action_button_url');
                        if($show_call_to_action == 'yes') {
                ?> 
                    
                    <div class="about-me-home left">
                        <?php if(isset($call_to_action_image)){?>
                        <div class="about-me-home-images left">
                            <img src="<?php tk_get_thumb(125, 142, $call_to_action_image);?>" title="<?php echo $call_to_action_title?>" alt="<?php echo $call_to_action_title?>" style="float:left;width: 100%"/>
                            <div class="about-me-home-mask right"></div><!--/about-me-home-mask-->
                        </div><!--/about-me-home-images-->
                        <?php }?>
                        <div class="about-me-home-text right" <?php if(!isset($call_to_action_image)){?>style="width: 100%!important"<?php }?>>
                            <span><?php echo $call_to_action_title?></span>
                            <p><?php echo $call_to_action_text?></p>
                            <a href="<?php echo $call_to_action_button_url?>"><?php echo $call_to_action_button_text?></a>
                        </div><!--/about-me-home-text-->
                    </div><!--/about-me-home-->
                    
                <?php }?>   
                    
                </div><!--/bg-content-center-->
            </div><!--/bg-content-->
            
            <?php }?>
            
            <?php if ($show_home_content == 'yes' && $show_call_to_action == 'yes'){?><div class="border-down-content left"></div><!--/border-down-content--><?php }?>

        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>