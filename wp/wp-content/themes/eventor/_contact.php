<?php
/*
  
Template Name: Contact
   
*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta ($post -> ID, $prefix. 'sidebar_position', true);
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
$show_map = get_theme_option(tk_theme_name . '_contact_show_map');
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);

?>


    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <!-- Page Headline-->
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

            <div class="blog-content <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">

                    <div class="blog-one left">
                       
                    <?php //Map Options
                        $x_coord = get_option(tk_theme_name.'_contact_googlemap_x');
                        $y_coord = get_option(tk_theme_name.'_contact_googlemap_y');
                        $zoom_factor = get_option(tk_theme_name.'_contact_googlemap_zoom');
                        $map_type = get_option(tk_theme_name.'_contact_google_map_type');
                        $marker_title = get_option(tk_theme_name.'_contact_marker_title');
                        $map_color = get_theme_option(tk_theme_name.'_contact_map_color');
                        $default_color = get_theme_option(tk_theme_name.'_contact_default_map');

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
                        
                        
            <?php if(empty($show_map)) { ?>
                <!-- Google Maps-->
                <div class="map-contact left">
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                    <div id="map_canvas" class="contact-img"></div>

                    <?php if($map_color){ ?>
                    
                                 <script type="text/javascript">

                                      var styles = [
                                                            {
                                                              "stylers": [
                                                                { "hue": "<?php echo '#'.$map_color; ?>" }
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
                <?php } ?>

                
                        <!-- Page Content -->
                        <?php if (!empty ($post -> post_content)) { ?>
                            <div class="blog-one-text left"> 
                                <div class="shortcodes">
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
                            </div><!-- /blog-one-text -->  
                        <?php } ?>

                    </div><!--blog-one-->
                    
                    <!-- Contact Form-->
                    <div class="blog-one left">
                        <div class="blog-categories left">
                            <div class="bg-form-contact left"></div>
                        </div><!--blog-categories-->

                        <div class="blog-one-content right <?php if($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
                        <?php
                            $mail_success_msg = get_option(tk_theme_name.'_contact_message_successful');
                            $mail_error_msg = get_option(tk_theme_name.'_contact_message_unsuccessful');
                            ?>

                
                            <?php $captcha_option = get_theme_option(tk_theme_name.'_contact_disable_captcha'); ?>

                            <div class="form left">
                                <form method="GET" id="contactform" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                                    <div class="form-input left">
                                    <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactname'];} ?>"name="contactname" id="contactname" tabindex="1" /><span>Name *</span></div>
                                    <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactemail'];} ?>" name="email" id="contactemail" tabindex="2" /><span>Email *</span></div>
                                    </div><!--/form-input-->
                                <div class="form-textarea">
                                    <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="message" id="contactmessage" tabindex="3"><?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactmessage'];}else{_e('Message', tk_theme_name);} ?></textarea>
                                </div><!--/form-textarea-->

                                <?php if ($captcha_option !==  'yes') { //Disable captcha ?>
                                <div class="contact-captcha">
                                    <img src="<?php echo get_template_directory_uri()?>/script/captcha/captcha.php" id="captcha" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                    <div class="bg-input captcha-holder">
                                        <input type="text" name="captcha" id="captcha-form" autocomplete="off" />
                                    <div class="refresh-text"><?php _e('Cant read? Refresh Image: ', tk_theme_name); ?></div>
                                    <a onclick="
                                        document.getElementById('captcha').src='<?php echo get_template_directory_uri()?>/script/captcha/captcha.php?'+Math.random();
                                        document.getElementById('captcha-form').focus();"
                                        id="change-image" class="captcha-refresh"></a>   
                                        </div>
                                    </div>
                                <?php } //Disable captcha?>

                                    <div class="tag-left left"></div><input class="search-submit-button left" type="submit" name="submit" value="<?php _e('Send', tk_theme_name); ?>" /><div class="tag-right left"></div>
                                    <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">
                                </form>        

                                        <div id="contact-success">
                                            <?php if(isset($_GET['sent'])) {
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
                                                    _e('Invalid Captcha!', tk_theme_name);
                                                };
                                            ?>
                                            <?php if(isset($_GET['sent'])) {
                                                $what = $_GET['sent'];
                                                if($what == 'error') {
                                                    echo $mail_error_msg;
                                                }
                                            }
                                            ?>
                                        </div><!-- contact-error -->



                            </div><!--/form-->
                        </div><!--blog-one-content-->
                    </div><!--blog-one-->

                </div><!--blog-content-->

                <!--SIDBAR-->
                                <!-- Sidebar -->
                   <?php                     
                        if($sidebar_position == 'right'){
                            tk_get_sidebar('Right', $sidebar_select);
                        }elseif($sidebar_position == 'left'){
                            tk_get_sidebar('Left', $sidebar_select);
                        }
                    ?>

            </div><!-- /shortcodes -->



        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>