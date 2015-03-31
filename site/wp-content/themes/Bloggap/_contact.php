<?php
/*

Template Name: Contact

*/
get_header();
$prefix = 'tk_';

?>


       <?php
           /* MAP CONFIGURATION*/
            $x_coord = get_option(tk_theme_name.'_contact_googlemap_x');
            $y_coord = get_option(tk_theme_name.'_contact_googlemap_y');
            $zoom_factor = get_option(tk_theme_name.'_contact_googlemap_zoom');
            $map_type = get_option(tk_theme_name.'_contact_google_map_type');
            $marker_title = get_option(tk_theme_name.'_contact_marker_title');
            $show_map = get_theme_option(tk_theme_name.'_contact_show_map');
            if(empty($x_coord)) {$x_coord = 45.256024;}
            if(empty($y_coord)) {$y_coord = 19.853861;}
            if(empty($zoom_factor)) {$zoom_factor = 15;}
            if(empty($map_type)) {$map_type = 'ROADMAP';}
        ?>

        <!-- CONTENT -->
        <div class="content right">

            <div class="title-page left"><h1><?php the_title(); ?></h1></div><!--/title-page-->


            <?php if(empty($show_map)) { ?>
            <div class="bg-map-contact left">
                <div class="map-contact left">
                    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                    <div id="map_canvas" style="width: 100%; height: 100%; min-height: 0px;" class="contact-img"></div>

                    <script type="text/javascript">
                        // Map javascript
                        var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);
                        var myOptions = {
                            zoom: <?php echo $zoom_factor ?>,
                            center: latlng,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title:"<?php echo $marker_title?>"
                        });

                    </script>
                </div><!--/map-contact-->
            </div><!--/bg-map-contact-->
            <?php } ?>

            <div class="contact-text shortcodes left">
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
            </div><!--/contact-text-->


               <?php
                    $subject_error_msg = get_option(tk_theme_name.'_contact_subject_error_message');
                    $name_error_msg = get_option(tk_theme_name.'_contact_name_error_message');
                    $email_error_msg = get_option(tk_theme_name.'_contact_email_error_message');
                    $message_error_msg = get_option(tk_theme_name.'_contact_message_error_message');
                    $mail_success_msg = get_option(tk_theme_name.'_contact_message_successful');
                    $mail_error_msg = get_option(tk_theme_name.'_contact_message_unsuccessful');
                    $captcha_error_msg = get_option(tk_theme_name.'_contact_captcha_error_message');
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

                            var message = document.getElementById('message');
                            if(check_field(message,"<?php echo $message_error_msg?>","")==false){
                                error = 1;
                            }

                            var email = document.getElementById('contactemail');
                            if (validate_email(email,"<?php echo $email_error_msg?>")==false)
                            {email.focus();error = 1;}

                            var contactname = document.getElementById('contactname');
                            if(check_field(contactname,"<?php echo $name_error_msg?>","Name*")==false){
                                error = 1;
                            }


                            if(error == 0){
                                var contactname = document.getElementById('contactname').value;
                                var email = document.getElementById('contactemail').value;
                                var message = document.getElementById('message').value;

                                return true;
                            }
                            return false;
                        }
                    }
                </script>
                <!-- end of script -->



            <div class="form left">
                <h2><?php _e('Say Hello', tk_theme_name); ?></h2>
                <form method="GET" id="contactform" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                    <div class="form-input left">
                        <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactname'];}else{_e('Name*' ,tk_theme_name);} ?>" id="contactname" name="contactname" tabindex="1" /></div>
                        <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactemail'];}else{_e('Email*', tk_theme_name);} ?>" id="email" name="email" tabindex="2" /></div>
                    </div><!--/form-input-->
                    <div class="form-textarea">
                        <textarea  name="message" id="message" tabindex="3"><?php if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){echo $_SESSION['contactmessage1'];}else{_e('', tk_theme_name);} ?></textarea>
                    </div><!--/form-textarea-->

                        <div class="contact-captcha">
                            <img src="<?php echo get_template_directory_uri()?>/script/captcha/captcha.php" id="captcha" />
                            <div class="bg-input captcha-holder">
                                <input type="text" name="captcha" id="captcha-form" autocomplete="off" />
                            <div class="refresh-text"><?php _e('Cant read? Refresh Image: ', tk_theme_name); ?></div>
                            <a onclick="
                                document.getElementById('captcha').src='<?php echo get_template_directory_uri()?>/script/captcha/captcha.php?'+Math.random();
                                document.getElementById('captcha-form').focus();"
                                id="change-image" class="captcha-refresh"></a>
                            </div>
                        </div>

                    <div class="search-submit-button left"><input type="submit" name="submit" value="<?php _e('Send', tk_theme_name); ?>" onclick="return checkForm(this)" tabindex="4" /></div>
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
                        if(isset($_GET['sent'])) {
                            $what = $_GET['sent'];
                            if($what == 'error') {
                                echo $mail_error_msg;
                            }
                        }

                        if(isset($_GET['captcha']) && $_GET['captcha'] == 'error'){
                            echo $captcha_error_msg;
                        };
                    ?>
                </div><!-- contact-error -->

            </div><!--/form-->
        </div><!--/content-->
    </div><!--/wrapper-->

<?php get_footer(); ?>




