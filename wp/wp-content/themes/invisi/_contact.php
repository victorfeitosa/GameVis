<?php
/*

Template Name: Contact

*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
?>
    <!-- TITLE PAGE -->
    <div class="slider-content left">
        <div class="wrapper">
            <div class="bg-title-page left">
                <div class="title-page left"><?php the_title()?></div><!--/title-page-->
            </div><!--/bg-title-page-->
        </div><!--/wrapper-->
    </div><!--/slider-content-->



    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="bg-content left">
            
                <div class="content-left left">
                    
                    
                    <!--MAP-->
                    <div class="map-contact left">
                        <?php
                             $x_coord = get_option(tk_theme_name.'_contact_googlemap_x');
                             $y_coord = get_option(tk_theme_name.'_contact_googlemap_y');
                             $zoom_factor = get_option(tk_theme_name.'_contact_googlemap_zoom');
                             $map_type = get_option(tk_theme_name.'_contact_google_map_type');
                             $marker_title = get_option(tk_theme_name.'_contact_marker_title');
                             if(empty($x_coord)) {$x_coord = 45.256024;}
                             if(empty($y_coord)) {$y_coord = 19.853861;}
                             if(empty($zoom_factor)) {$zoom_factor = 15;}
                             if(empty($map_type)) {$map_type = 'ROADMAP';}
                         ?>
                        <div class="map-contact left">
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
                    </div><!--/map-->
                    
                    
                    <div class="contact-text left">
                        <span><?php _e('Find us  on a map', tk_theme_name)?></span>
                        <div class="shortcodes left">
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
                        </div>
                        
                        


   <?php
                $subject_error_msg = get_option(tk_theme_name.'_contact_subject_error_message');
                $name_error_msg = get_option(tk_theme_name.'_contact_name_error_message');
                $email_error_msg = get_option(tk_theme_name.'_contact_email_error_message');
                $message_error_msg = get_option(tk_theme_name.'_contact_message_error_message');
                $mail_success_msg = get_option(tk_theme_name.'_contact_message_successful');
                $mail_error_msg = get_option(tk_theme_name.'_contact_message_unsuccessful');
                ?>

                <!-- Validate script -->
                <script type="text/javascript">
                    function validate_email(field,alerttxt)
                    {
                        with (field)
                        {
                            apos=value.indexOf("@");
                            dotpos=value.lastIndexOf(".");
                            if (apos<1||dotpos-apos<2)
                            {jQuery('#contact-error').empty().append(alerttxt);return false;}
                            else {return true;}
                        }
                    }

                    function check_field(field,alerttxt,checktext){
                        with (field)
                        {
                            var checkfalse = 0;
                            if(field.value == ""){
                                jQuery('#contact-error').empty().append(alerttxt);
                                field.focus();checkfalse=1;}

                            if(field.value==checktext)
                            {
                                jQuery('#contact-error').empty().append(alerttxt);
                                field.focus();checkfalse=1;}

                            if(checkfalse==1){return false;}else{return true;}
                        }
                    }

                    function checkForm(thisform)
                    {
                        with (thisform)
                        {
                            var error = 0;

                            var contactmessage = document.getElementById('contactmessage');
                            if(check_field(contactmessage,"<?php echo $message_error_msg?>","")==false){
                                error = 1;
                            }

                            var email = document.getElementById('contactemail');
                            if (validate_email(email,"<?php echo $email_error_msg?>")==false)
                            {email.focus();error = 1;}

                            var contactname = document.getElementById('contactname');
                            if(check_field(contactname,"<?php echo $name_error_msg?>","Name")==false){
                                error = 1;
                            }


                            if(error == 0){                              
                                var contactname = document.getElementById('contactname').value;
                                var email = document.getElementById('contactemail').value;
                                var contactmessage = document.getElementById('contactmessage').value;

                                return true;
                            }
                            return false;
                        }
                    }
                </script>
                <!-- end of script -->

                        
                        
                        <!--FORM-->
                        <div class="form left">                     
                            <div class="title-home left"><?php _e('Say Hello', tk_theme_name)?></div><!--/title-home-->                                               
                        
                            <form method="POST" id="contactform" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                                <div class="form-input left">
                                    <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Name', tk_theme_name)?>" name="contactname" id="contactname" tabindex="2"/></div>
                                    <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('E-mail', tk_theme_name)?>" name="email" id="contactemail" tabindex="3"/></div>
                                </div><!--/form-input-->
                                <div class="form-textarea">
                                    <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="message" id="contactmessage" tabindex="4"></textarea>
                                </div><!--/form-textarea-->

                                <div class="form-button left">
                                        <input class="search-submit-button" type="submit" name="submit" value="<?php _e('Send', tk_theme_name)?>" />
                                    <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">
                                    <div id="contact-success"><?php if(isset($_GET['sent'])) {
                                            $what = $_GET['sent'];
                                            if($what == 'success') {
                                                echo $mail_success_msg;
                                            }
                                        }
                                        ?></div>
                                    <div id="contact-error"><?php if(isset($_GET['sent'])) {
                                            $what = $_GET['sent'];
                                            if($what == 'error') {
                                                echo $mail_error_msg;
                                            }
                                        }
                                        ?></div>
                                </div><!--/form-button-->

                            </form>
                        </div><!--/form-->
                            
                    </div><!--/contact-text-->
                    
                    
                </div><!--/content-left-->

                <div style="width: 100%;height: 110px"></div>
                <!--SIDBAR-->
                <?php tk_get_right_sidebar('Right', 'Contact')?>
                
                <div class="silver-big-fake right"></div><!--/silver-big-fake-->

            </div><!--/bg-content-->
            
            <div class="help-content-down left"><div class="silver-big-fake right"></div></div><!--/help-content-down-->
            
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>




