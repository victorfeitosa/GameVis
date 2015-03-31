<?php
/*

Template Name: Contact Us

*/
get_header();

$disable_title = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);

$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);

$show_map = get_theme_option(wp_get_theme()->name.'_contact_show_map');
$use_large_map = get_theme_option(wp_get_theme()->name.'_contact_header_map');

$x_coord = get_option(wp_get_theme()->name.'_contact_googlemap_x');
$y_coord = get_option(wp_get_theme()->name.'_contact_googlemap_y');
$zoom_factor = get_option(wp_get_theme()->name.'_contact_googlemap_zoom');
$map_type = get_option(wp_get_theme()->name.'_contact_google_map_type');
$marker_title = get_option(wp_get_theme()->name.'_contact_marker_title');

$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
// check for slider, map and latest news and add css class
if($use_slider !== 'on'){$slider_class = 'no-slider';}else{$slider_class = '';}
if($template_name == 'templates/template-contact.php' && ($show_map != 'yes' && $use_large_map != 'content' )){$css_class = '';}
if($use_latest_news !== 'on'){$news_class = 'no-news';}else{$news_class = '';}
if($slider_class == 'no-slider' && $news_class == 'no-news'){$css_class = 'no-slider-no-news';
}elseif($slider_class == 'no-slider'){$css_class = '';
}elseif($news_class == 'no-news'){$css_class = '';}


if(empty($x_coord)) {$x_coord = 45.256024;}
if(empty($y_coord)) {$y_coord = 19.853861;}
if(empty($zoom_factor)) {$zoom_factor = 15;}
if(empty($map_type)) {$map_type = 'ROADMAP';}
?>

<div class="row-fluid shortcodes-margin">
    <div class="container">
               
        <?php if(empty($disable_title)){?>
            <h1 class="title-divider">
                <span><?php the_title()?></span>
                <?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?>
            </h1>
        <?php } ?>

        <div class="row-fluid">

             <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}else{echo 'span8';}?> <?php if($sidebar_postition == 'left'){ echo 'pull-right'; } ?> contact-page">

                <?php if ($show_map !==  'yes' && $use_large_map == 'content') { ?>
                    <div class="map-contact" id="map_fancy">
                        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                        <div id="map_canvas" style="width: 100%; height: 100%; min-height: 0px;" class="contact-img"></div>

    
                            <script type="text/javascript">
                                var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);
                                var myOptions = {
                                    zoom: <?php echo $zoom_factor ?>,
                                    center: latlng,
                                    mapTypeControl: false,
                                    streetViewControl: false,
                                    overviewMapControl: false,
                                    mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>,
                                    scrollwheel: false
                                };

                                var mapa = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                <?php if(!empty($marker_title)) { ?>
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: mapa,
                                    title:"<?php echo $marker_title?>"
                                });
                                <?php }?>
                            </script>
                        </div><!--/map-contact-->
                        
                        <?php } ?>
                    

                <?php if (!empty ($post->post_content)) { ?>
                    <div class="shortcodes contact-text-padding">

                        <?php
                        wp_reset_query();
                        if (have_posts()) : while (have_posts()) : the_post();
                            the_content();
                        endwhile;
                        else:
                        endif;
                        wp_reset_query();
                        ?>

                    </div><!--/contact-text-->
                <?php } ?>

                <?php
                $mail_success_msg = get_option(wp_get_theme()->name.'_contact_message_successful');
                $mail_error_msg = get_option(wp_get_theme()->name.'_contact_message_unsuccessful');
                ?>

                <?php $captcha_option = get_theme_option(wp_get_theme()->name.'_contact_disable_captcha'); ?>

                <div class="block">
                    <form method="GET" id="contact" class="contact-form" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                        <div class="control-group">
                            <div class="input-prepend">
                                <span class="add-on"><i class="name-icon"></i></span>
                                <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactname'];}else{_e('Name*' ,'tkingdom');} ?>"name="contactname" id="contactname" tabindex="1" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="input-prepend">
                                <span class="add-on"><i class="email-icon"></i></span>
                                <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactemail'];}else{_e('Email*', 'tkingdom');} ?>" name="email" id="contactemail" tabindex="2" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="input-prepend texteria-holder">
                                <span class="add-on"><i class="message-icon"></i></span>
                                <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="message" id="contactmessage" tabindex="3" rows="10"><?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactmessage'];}else{_e('Message', 'tkingdom');} ?></textarea>
                            </div>
                        </div>
                        <?php if ($captcha_option !==  'yes') { //Disable captcha ?>
                            <div class="contact-captcha">
                                <img src="<?php echo get_template_directory_uri()?>/script/captcha/captcha.php" id="captcha" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                <div class="bg-input captcha-holder">
                                    <div class="control-group">
                                        <div class="input-prepend">
                                            <input type="text" name="captcha" id="captcha-form" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="refresh-text">
                                        <?php _e('Cant read? Refresh Image: ', 'tkingdom'); ?>
                                        <a onclick="document.getElementById('captcha').src='<?php echo get_template_directory_uri()?>/script/captcha/captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();"
                                           id="change-image" class="captcha-refresh"></a>
                                    </div>
                                </div>
                            </div>
                            <br>
                        <?php } //Disable captcha?>
                            
                                                        
                    <div id="contact-success">
                        <?php
                        if(isset($_GET['sent'])) {
                            $what = $_GET['sent'];
                            if($what == 'success') {
                                echo $mail_success_msg;
                            }
                        }
                        ?>
                    </div><!-- contact-success -->

                    <div id="contact-error">
                        <?php
                        if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){
                            _e('Invalid Captcha!', 'tkingdom');
                        };
                        ?>
                        <?php
                        if(isset($_GET['sent'])) {
                            $what = $_GET['sent'];
                            if($what == 'error') {
                                echo $mail_error_msg;
                            }
                        }
                        ?>
                    </div><!-- contact-error -->
                            
                            
                        <div class="control-group">
                            <div class="controls">
                                <input type="submit" name="submit" class="btn form_btn" value="<?php _e('Send a Message', 'tkingdom'); ?>" />
                            </div>
                        </div>
                            
                        <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">
                    </form>


                </div>

            </div>

            <?php if($sidebar_postition != 'fullwidth'){?>
                <div class="span4 <?php if($sidebar_postition == 'right'){echo 'sidebar-right';}elseif($sidebar_postition == 'left'){echo 'sidebar-left';}?>" id="sidebar">
                    <!-- Sidebar Left -->
                    <?php
                    if ($sidebar_postition == 'left'){
                        echo '<div class="span11 pull-left" style="margin-left:0px;">';
                        tk_get_sidebar('Left', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!-- Sidebar Right -->
                    <?php
                    if ($sidebar_postition == 'right'){
                        echo '<div class="span11 pull-right">';
                        tk_get_sidebar('Right', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!--/sidebar-->
                </div>
            <?php }?>

        </div>

    </div>
</div>

<?php get_footer(); ?>