<?php
/*

Template Name: Contact

*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
?>


               <?php
                    $x_coord = get_option(tk_theme_name.'_contact_googlemap_x');
                    $y_coord = get_option(tk_theme_name.'_contact_googlemap_y');
                    $zoom_factor = get_option(tk_theme_name.'_contact_googlemap_zoom');
                    $map_type = get_option(tk_theme_name.'_contact_google_map_type');
                    $marker_title = get_option(tk_theme_name.'_contact_marker_title');
                    $background_color = get_option('theme_mods_'.tk_theme_name);
                    $background_color = $background_color['background_color'];
                    if(empty($background_color)) {$background_color = 'f0f0f0';}
                    if(empty($x_coord)) {$x_coord = 45.256024;}
                    if(empty($y_coord)) {$y_coord = 19.853861;}
                    if(empty($zoom_factor)) {$zoom_factor = 15;}
                    if(empty($map_type)) {$map_type = 'ROADMAP';}
                ?>
    <div class="content left">
        <div class="wrapper">



            <div class="content-page-sidebar left">

                <div class="shortcodes left">

                    <!--MAP-->
                    <div class="map left">

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

                            var message = document.getElementById('message');
                            if(check_field(message,"<?php echo $message_error_msg?>","")==false){
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
                                var message = document.getElementById('message').value;

                                return true;
                            }
                            return false;
                        }
                    }
                </script>
                <!-- end of script -->



                    <div class="form left">
                        <div class="title-border left" style="background:url(<?php echo get_template_directory_uri()?>/style/img/border-title-widget.png) repeat-x left 8px;"><span style="font-weight:bold;background-color: <?php echo '#'.$background_color?>"><?php _e("Say Hello", tk_theme_name)?></span></div><!--title-border-->
                                <form method="POST" id="contactform" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                                    <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Name', tk_theme_name)?>" name="contactname" id="contactname" tabindex="2"/></div>
                                    <div class="bg-input left"><input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('E-mail', tk_theme_name)?>" name="email" id="contactemail" tabindex="3"/></div>

                                    <div class="form-textarea"><textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="message" id="message" tabindex="4"></textarea></div><!--/form-textarea-->

                                    <div class="form-button left">
                                        <input class="search-submit-button" name="submit" type="submit" id="submit" tabindex="5" value="Send" onclick="return checkForm(this)" />
                                    </div><!--/white-->



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

                                </form><!--close form -->
                            </div><!-- form-left -->
                        </div><!--/content-right-->

                            <!--SIDBAR-->
                            <?php tk_get_right_sidebar('Right', 'Contact')?>


        </div><!--/bg-content-one-->
        <?php
            $trending = get_theme_option(tk_theme_name.'_home_disable_trending');
            if($trending !== 'yes') {
                ?>
                <?php
                /*************************************************************/
                /************MOSTLY VIEWED POSTS*****************************/
                /*************************************************************/


                ?>

            <div class="home-stories left">
                <div class="home-stories-content left">
                    <div class="home-stories-title left"><span><?php _e("Trending stories", tk_theme_name)?></span></div><!--/home-stories-title-->

                        <?php
                        wp_reset_postdata();
                        $query = array(
                                'post_type' => 'post',
                                'meta_key' => 'post_stats',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'posts_per_page' => '4'
                        );
                        $the_query = new WP_Query( $query );
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            $post_views = get_post_meta($post->ID, 'post_stats', true);
                            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'small-image');
                            ?>

                    <div class="home-storie-one left">
                        <div class="home-storie-img left"><a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>" class="pirobox" title="<?php the_title(); ?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
                        <div class="home-storie-text left">
                            <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            <p><?php echo $post_views?></p>
                        </div><!--/home-storie-text-->
                    </div><!--/home-storie-one-->

                        <?php
                        endwhile;
                        // Reset Post Data
                        wp_reset_postdata();
                        ?>

                </div><!--/home-stories-content-->
            </div><!--/home-stories-->
                <?php }?>
        </div><!--/bg-content-one-->



            


<?php get_footer(); ?>




