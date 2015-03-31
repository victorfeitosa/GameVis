<?php

get_header();
$prefix = 'tk_';
global $post;

/* Service sub title */
//$subheading = get_post_meta($post->ID, $prefix.'subheading_text', true);

/* Service Title */
$get_services_title = get_option('id_services_page');
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);

/* Service small featured image */
$featured_service_img = get_post_meta($post->ID, $prefix.'featured_service', true);

/* Service colors */
$tk_background_color = get_post_meta($post->ID, $prefix.'background_color', true);
$tk_headline_color = get_post_meta($post->ID, $prefix.'headline_color', true);
$tk_text_color = get_post_meta($post->ID, $prefix.'text_color', true);

/* Service sidebar */
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}

/* Service sidebar select */
$sidebar_select = get_post_meta($post->ID, $prefix . 'sidebar', true);
if ($sidebar_select == 'none') {
    $sidebar_select = get_post_meta($blog_id, $prefix.'sidebar', true);
}

/* Content padding */
if ($sidebar_postition == 'right'){
    $padding = 'style="padding-right:20px;"';
}else if($sidebar_postition == 'left'){
    $padding = 'style="padding-left:20px;"';
}else{
    $padding = '';
}

/* Single Service featured image */
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

/* Next and Prev arrows for Service Posts */
$prev_post = get_previous_post();
$next_post = get_next_post(); 

/* Start the Loop */
if (have_posts()) : while (have_posts()) : the_post();
?>




<!-- CONTENT STARTS -->
<section>
    <div class="container">

            <!-- Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <?php if (is_front_page()) { ?>
                        <h1 class="hero_heading"><?php echo $page_headline ?></h1>
                    <?php } else { ?>
                        <h1 class="page_title rounded" style="padding:20px 28px; background: #<?php echo $tk_background_color; ?>; color: #<?php echo $tk_headline_color; ?>; margin-bottom: 18px;">
                            <img src="<?php echo $featured_service_img; ?>" style="margin-right: 10px;" />
                            <?php echo the_title(); ?>
                        </h1>
                        <h2 class="page_description"><?php echo $page_headline; ?></h2>
                    <?php } ?>
                </div>
            </div>
            
            <div class="row-fluid">
                <div class="span12">
                    <!-- Work nav -->
                    <div class="work_nav_wrap">
                        <div class="work_nav">
                            <a class="next_work" <?php if(empty($next_post->ID)){ echo 'style="display:none;"'; } ?> href="<?php echo get_permalink($next_post->ID); ?>"></a>
                            <a class="prev_work" <?php if(empty($prev_post->ID)){ echo 'style="display:none;"'; } ?> href="<?php echo get_permalink($prev_post->ID); ?>"></a>
                        </div>
                    </div>
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" />
                </div>
            </div>
            <br>



            <!-- Page Content -->
            <div class="row-fluid">

                
                
                <!-- Main Content -->
                <div id="content" class="<?php if($sidebar_postition == 'right'){echo 'span8 pull-left';}elseif($sidebar_postition == 'left'){echo 'span8 pull-right';}elseif($sidebar_postition == 'fullwidth'){echo 'span12';}?>">
          

                    <div class="page" <?php echo $padding; ?>> 

                        <?php if(has_post_thumbnail()) { ?>
                            <div class="team-images">
                                <a href="<?php echo $image[0]; ?>" class="fancybox"><?php the_post_thumbnail('work-single-big'); ?></a>
                                <div class="team_img_hover rounded"><a class="fancybox img_plus" href="<?php echo $image[0]; ?>"></a></div>
                            </div>                                           
                            <br>
                            <br> 
                        <?php } ?>

                        <?php the_content(); ?>



                        <?php //Enable Social Share
                            $social_share_services = get_theme_option(tk_theme_name . '_social_social_share_services');
                            if ($social_share_services != 'yes') { 
                        ?>

                        <br>
                        <div class="row-fluid">
                            <div class="span12">
                                <img src="<?php echo get_template_directory_uri(); ?>/style/images/sep.png" alt="separator" />
                                <div class="sep_border"></div>
                            </div>
                        </div>
                    
                            <!-- Social Share Buttons -->
                            <?php
                                $facebook_share = get_theme_option(tk_theme_name . '_social_use_facebook');
                                $twitter_share = get_theme_option(tk_theme_name . '_social_use_twitter');
                                $google_share = get_theme_option(tk_theme_name . '_social_use_google');
                                $linkedin_share = get_theme_option(tk_theme_name . '_social_use_linkedin');
                                $pinterest_share = get_theme_option(tk_theme_name . '_social_use_pinterest');
                                $stumbleupon_share = get_theme_option(tk_theme_name . '_social_use_stumbleupon');
                                $thepermalink = get_permalink();

                                if ($facebook_share != 'yes' || $twitter_share != 'yes' || $google_share != 'yes' || $linkedin_share != 'yes' || $pinterest_share != 'yes' || $stumbleupon_share != 'yes') {
                            ?>
                            
                                <div class="social_sharing">

                                    <?php if ($facebook_share != 'yes') { ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_likes($thepermalink); ?>
                                            </div>
                                            <div id="share_facebook" class="rounded">
                                                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>"><?php _e('Facebook', tk_theme_name) ?></a>
                                            </div>
                                        </div>
                                    <?php } ?>       

                                    <?php if ($twitter_share != 'yes') { ?> 
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_tweets(get_permalink()); ?>
                                            </div>
                                            <div id="share_twitter" class="rounded">
                                                <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>" class="twitter-share-button"><?php _e('Twitter', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>

                                    <?php if ($google_share != 'yes') { ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_plusones($thepermalink); ?>
                                            </div>
                                            <div id="share_google" class="rounded">
                                                <a target="_blank" href="https://plus.google.com/share?url=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>"><?php _e('Google+', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>

                                    <?php if ($linkedin_share != 'yes') { ?> 
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_linkedin($thepermalink); ?>
                                            </div>
                                            <div id="share_linkedin" class="rounded">
                                                <a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>"><?php _e('LinkedIn', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?> 

                                    <?php if ($pinterest_share != 'yes') { ?>
                                        <?php $pin_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_pinit($thepermalink); ?>
                                            </div>
                                            <div id="share_pinterest" class="rounded">
                                                <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $thepermalink; ?>&media=<?php echo $pin_image[0]; ?>&description=<?php the_title(); ?>"><?php _e('Pinterest', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>    

                                    <?php if ($stumbleupon_share != 'yes') { ?>
                                        <div class="share">
                                            <div class="share_counter rounded">
                                                <?php echo get_stumbleupon($thepermalink); ?>
                                            </div>
                                            <div id="share_stumbleupon" class="rounded">
                                                <a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>"><?php _e('Stumbleupon', tk_theme_name) ?></a>
                                            </div>    
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="clear"></div>        
                                </div><!--/social_sharing -->
                            <?php } ?>

                        <?php } //Enable Social Share ?>

                    </div><!-- end div with padding -->


                </div><!--/content-->


                <!-- Sidebar Left -->
                <?php 
                    if ($sidebar_postition == 'left'){
                        echo '<div class="span4 pull-left" style="margin-left:0px;">';
                            tk_get_sidebar('Left', $sidebar_select);
                        echo '</div>';
                    }
                ?>


                <!-- Sidebar Right -->
                <?php 
                    if ($sidebar_postition == 'right'){
                        echo '<div class="span4 pull-right">';
                            tk_get_sidebar('Right', $sidebar_select);
                        echo '</div>';
                    }
                ?>
                
            </div><!-- row-fluid -->


<?php endwhile; endif; get_footer(); ?>