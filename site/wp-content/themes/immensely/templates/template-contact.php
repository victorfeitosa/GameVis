<?php
/*

Template Name: Contact Us

*/
get_header();
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$disable_banner = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);

$show_map = get_theme_option(wp_get_theme()->name.'_contact_show_map');

$x_coord = get_option(wp_get_theme()->name.'_contact_googlemap_x');
$y_coord = get_option(wp_get_theme()->name.'_contact_googlemap_y');
$zoom_factor = get_option(wp_get_theme()->name.'_contact_googlemap_zoom');
$map_type = get_option(wp_get_theme()->name.'_contact_google_map_type');
$marker_title = get_option(wp_get_theme()->name.'_contact_marker_title');
$map_color = get_theme_option(wp_get_theme()->name.'_contact_map_color');
$default_color = get_theme_option(wp_get_theme()->name.'_contact_default_map');
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
if($default_color) {
    if(empty($map_color)) {
        $map_color ='';
    }
} else {
    $map_color='';
}

if(empty($x_coord)) {$x_coord = 45.256024;}
if(empty($y_coord)) {$y_coord = 19.853861;}
if(empty($zoom_factor)) {$zoom_factor = 15;}
if(empty($map_type)) {$map_type = 'ROADMAP';}
?>
    
    <?php if($slider_type == 'revolution' || $slider_type == 'slit') { ?>
        <div <?php if($disable_banner) { ?>class="slider-margin"<?php } ?>>
            <?php get_template_part('/templates/parts/header', 'slider'); ?>
        </div>
    <?php } //check if slider is turned on?>

<div class="contact <?php if($sidebar_postition == 'fullwidth'){echo 'fullwidth';}elseif($sidebar_postition == 'right' ){echo 'sidebar right';}else{echo 'sidebar left';}?> page" id="content">

<?php if(empty($show_map)) { ?>    
    <div class="full-width">
        <div class="block map-contact contact-map2">
                    <div class="map-contact" id="map_fancy">
                        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                        <div id="map_canvas" style="width: 100%; height: 100%; min-height: 0px;" class="contact-img"></div>

                        <?php if($map_color){ ?>

                            <script type="text/javascript">

                                var styles = [
                                    {
                                        "stylers": [
                                            { "hue": "<?php echo $map_color; ?>" }
                                        ]
                                    }
                                ];

                                var styledMap = new google.maps.StyledMapType(styles,
                                    {name: "Styled Map"});

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

                                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                map.mapTypes.set('map_style', styledMap);
                                map.setMapTypeId('map_style');

                                <?php if(!empty($marker_title)) { ?>
                                var marker = new google.maps.Marker({
                                    position: latlng,
                                    map: map,
                                    title:"<?php echo $marker_title?>"
                                });
                                <?php }?>

                            </script>

                        <?php } else { ?>

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

                        <?php } ?>
                    </div><!--/map-contact-->
        </div>
    </div>
<?php } else { ?>
    <?php if($disable_banner == '') { ?>
        <div class="banner <?php if(!has_post_thumbnail($post -> ID)){ echo 'banner-background'; } ?>" style="<?php if(has_post_thumbnail($post -> ID)){echo 'background:url('.$title_bg_image[0].')';} ?>">
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
<?php } ?>
    
    <div class="row-fluid <?php if(!empty($show_map)) { echo 'map-disabled'; }?>">
        <div class="container">
            
            <div class="<?php if($sidebar_postition !== 'fullwidth') { echo 'row-fluid';} ?>">
                
                <div class="<?php if($sidebar_postition !== 'fullwidth') { echo 'span9';} ?> <?php if($sidebar_postition == 'left') {echo 'pull-right';}?>">
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
                $captcha_option = get_theme_option(wp_get_theme()->name.'_contact_disable_captcha');
                ?>

                <div class="block">
                    <form method="GET" id="contact" class="comment-form" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                        <fieldset>
                            <h2 class="comment-reply-title">Say Hello</h2>
                            <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactname'];}else{_e('Name*' ,'tkingdom');} ?>"name="contactname" id="contactname" tabindex="1" />
                            <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactemail'];}else{_e('Email*', 'tkingdom');} ?>" name="email" id="contactemail" tabindex="2" />
                            <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="message" id="contactmessage" tabindex="3" rows="10"><?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactmessage'];}else{_e('Message', 'tkingdom');} ?></textarea>

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
                                            <i class="fa fa-repeat"><a onclick="document.getElementById('captcha').src='<?php echo get_template_directory_uri()?>/script/captcha/captcha.php?'+Math.random(); document.getElementById('captcha-form').focus();"
                                               id="change-image" class="captcha-refresh"></a></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php } //Disable captcha?>

                            <button type="submit" class="cta"><?php _e('Send Message', 'tkingdom'); ?></button>
                        </fieldset>
                        
                        <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">
                    
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
                    
                    </form>              
                </div>
                </div>
                
                    <!-- Sidebar Left -->
                    <?php

                    if ($sidebar_postition == 'left'){
                        echo '<div class="span3 pull-left" id="sidebar">';
                        tk_get_sidebar('Left', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!-- Sidebar Right -->
                    <?php
                    if ($sidebar_postition == 'right'){
                        echo '<div class="span3 pull-right" id="sidebar" >';
                        tk_get_sidebar('Right', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!--/sidebar-->
                
            </div>
            
        </div>
    </div>
</div>


<?php get_footer(); ?>