<?php
/*

Template Name: Reservations

*/

$reservations_page = get_option('id_reservations_page');
if(!empty($_POST['first-name'])){    
    wp_redirect(get_permalink($reservations_page).'?confirmation=true');
}

get_header();

$prefix = 'tk_';
$room_taxes = get_theme_option(tk_theme_name.'_reservations_room_taxes');

$currency_sign = get_theme_option(tk_theme_name.'_reservations_currency');
$currency_position = get_theme_option(tk_theme_name.'_reservations_currency_side');

/*--Page Headline--*/
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
$heading_background = get_post_meta($post->ID, $prefix.'background_color', true);
$heading_title_color = get_post_meta($post->ID, $prefix.'headline_color', true);
?>

 <?php
 //checks to see if it's confirmation page
 if(!isset($_GET['confirmation']) && !isset($_GET['reservation_page'])){
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
            
                <div class="bg-booking-step booking-step1-content left">
                    <div class="booking-step-nav left">
                        <ul>
                            <li class="active booking-step1-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Choose your room', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 1  -', tk_theme_name); ?></p>
                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/booking-step-img-active.png" alt="">
                            </li>
                            <li class="booking-step2-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Submit Reservation', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 2  -', tk_theme_name); ?></p>
                                </div>                              
                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/booking-step-img.png" alt="">
                            </li>
                            <li class="booking-step3-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Confirmation', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 3  -', tk_theme_name); ?></p>
                                </div>
                            </li>
                        </ul>
                    </div><!--/booking-step-nav-->
                    
                    <div class="booking-step-content-down left">
                                                
                        <div class="booking-step-content-left left">
                            
                            <div class="booking-step-content-left-top left">                                
                                <?php if(!empty($arrival_date) && !empty($departure_date)){ ?>                                
                                    <div class="left">
                                        <p><?php _e('Arrival Date:', tk_theme_name); ?> <?php echo $arrival_date->format('l\, F jS Y'); ?></p>
                                        <p><?php _e('Departure Date:', tk_theme_name); ?> <?php echo $departure_date->format('l\, F jS Y'); ?></p>
                                    </div>                                
                                <?php } ?>                               
                            </div>
                            
                            <div class="home-action-select left">
                                <input name="arrival_date" class="arrival_date datepicker" id="arrival_date" value="<?php _e('Arrival Date', tk_theme_name); ?>" />
                            </div> 
                            <div class="home-action-select left">
                                <input name="departure_date" class="departure_date datepicker" id="departure_date" value="<?php _e('Departure Date', tk_theme_name); ?>" />
                            </div> 
                            <div class="home-action-select left">
                                <select name="guests" class="guests">
                                    <option value=""><?php _e('Guests', tk_theme_name); ?></option>
                                    
                                    <?php
                                        $querystr = $wpdb->prepare("SELECT `meta_value` FROM  `".$wpdb->prefix."postmeta` WHERE  `meta_key` =  %s ORDER BY `meta_value`", $prefix."number_beds");
                                        $page_posts = $wpdb->get_col($querystr);
                                        $page_posts = array_unique($page_posts);                
                                        foreach ($page_posts as $bed_num) { ?>                                    
                                            <option value="<?php echo $bed_num; ?>"><?php echo $bed_num; ?></option>
                                        <?php } ?>
                                    
                                    
                                </select>
                            </div> 
                        </div><!--/booking-step-content-left-->
                        
                        <div class="home-action-shadow left"></div>
                            
                        <div class="booking-step-content-right booking-search right">
                            <a class="reservation-search" /><p><?php _e('Search', tk_theme_name); ?></p></a>
                        </div><!--/booking-step-content-right-->
                         <div class="error-book-search"></div>
                    </div><!--/booking-step-content-down-->
                    
                </div><!--/bg-booking-step-->

                
                
                <div class="booking1-content left">
                    
                    <p class="no-free-rooms"><?php _e('Please select arrival date, departure date and number of guests.', tk_theme_name); ?></p>
                    
                    <script type="text/javascript">                                                
                        // ajax for querying available rooms                        
                        jQuery('.reservation-search').click(function(){
                            
                            var arrival_date = jQuery('.arrival_date').val();
                            var departure_date = jQuery('.departure_date').val();
                            var guests = jQuery('.guests').val();                            
                            var get_screen = 1;
                            
                            if(arrival_date == 'Arrival Date' || departure_date == 'Departure Date' || guests == 'Guests') {
                                jQuery('.error-book-search').html('<p class="red">Please fill in all the fields</p>');
                            }
                            
                            if(arrival_date && departure_date && guests){
                            jQuery.ajax({
                                type:"POST",
                                url: "<?php echo get_template_directory_uri(); ?>/ajax.php", // our PHP handler file
                                context: document.body,
                                data: { arrival_date: arrival_date, departure_date: departure_date, guests: guests, check_screen: get_screen},
                                success:function(results){                            
                                    jQuery('.error-book-search').remove();
                                    jQuery('.booking1-content').html(results);                                    
                                    jQuery('.room-only-content-right a').click(function(){
                                        var get_screen = 2;                                       
                                    
                                        var room_id = jQuery(this).attr('rel');                                    
                                        jQuery.ajax({
                                            type:"POST",
                                            url: "<?php echo get_template_directory_uri(); ?>/ajax.php", // our PHP handler file
                                            context: document.body,
                                            data: { arrival_date: arrival_date, departure_date: departure_date, guests: guests, room_id: room_id, check_screen: get_screen},
                                            success:function(results){
                                                jQuery('.booking1-content').html(results);
                                            } //success:function(results){             
                                        }); //jQuery.ajax({
                                                                                
                                    }); //jQuery('.room-only-content-right a').click(function()
                                } //success:function(results)
                            }); //jQuery.ajax
                            } //if(arrival_date && departure_date)
                        }); //jQuery('.datepicker, .guests').change(function()

                    </script>
                </div><!--/booking1-content-->
                
                
                

            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->
 <?php } //confirmation ?>
  
    
    <?php
     //checks to see if it's confirmation page
    if(isset($_GET['confirmation'])){ ?>
  
    
    
    <div class="title-pages left">
        <div class="title-pages-image left" style="<?php if(has_post_thumbnail()){echo 'background:url('.$title_bg_image[0].')';} else { echo 'background:#'.$heading_background; } ?>"></div>
        <div class="wrapper">
            <span><?php _e('Confirmation', tk_theme_name); ?></span>
            <p><?php _e('Step 3', tk_theme_name); ?></p>
        </div>        
    </div><!--/title-pages-->
    <div class="bottom-slider-red"></div><!--/bottom-slider-red-->

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">

            
                <div class="bg-booking-step booking-step3-content left">
                    <div class="booking-step-nav left">
                        <ul>
                            <li class="booking-step1-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Choose your room', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 1  -', tk_theme_name); ?></p>
                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/booking-step-img.png" alt="">
                            </li>
                            <li class="booking-step2-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Submit Reservation', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 2  -', tk_theme_name); ?></p>
                                </div>                              
                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/booking-step-img-active-left.png" alt="">
                            </li>
                            <li class="booking-step3-nav active">
                                <div class="booking-step-content">
                                    <span><?php _e('Confirmation', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 3  -', tk_theme_name); ?></p>
                                </div>
                            </li>
                        </ul>
                    </div><!--/booking-step-nav-->
                    
                    <div class="booking-step-content-down left">
                                                
                        <div class="booking-step3-text left">
                            <span><?php _e('Your reservation has been submitted', tk_theme_name); ?></span>
                            <p><?php _e('We will let you know soon if your reservation has been approved.', tk_theme_name); ?></p>
                        </div><!--/booking-step-content-left-->
                                                                        
                        
                        <div class="bg-reservation-summary-content left">
                            <div class="reservation-summary-content">
                                
                                <div class="reservation-summary-content-top left">
                                    <span><?php echo get_the_title($_SESSION['room_id']); ?></span>                                    
   
                                </div><!--/reservation-summary-content-->
                                
                                <ul>
                                    <li>
                                        <span><?php _e('Room Price', tk_theme_name); ?></span>
                                        <p><?php if($currency_position == 'left') { echo $currency_sign; }?><?php echo $_SESSION['room_price']; if($currency_position=='right') { echo $currency_sign; }  ?></p>
                                    </li>
                                    <li>
                                        <?php $room_taxes = ($room_taxes / 100) * $_SESSION['room_price']; ?>
                                        <span><?php _e('Room Taxes', tk_theme_name); ?></span>                           
                                        <p> <?php echo $room_taxes; ?></p>
                                    </li>
                                    <li style="border-bottom: none;">
                                        <span><?php _e('Total (incl. tax)', tk_theme_name); ?></span>
                                        <p><?php if($currency_position == 'left') { echo $currency_sign; }?> <?php echo $_SESSION['room_price'] + $room_taxes; if($currency_position=='right') { echo $currency_sign; }  ?></p>
                                    </li>
                                </ul>
                                
                            </div><!--/reservation-summary-content-->
                        </div><!--/reservation-summary-content-->
                        
                            <a class="search-rooms" href="<?php echo home_url(); ?>" /><?php _e('Go back to Home Page', tk_theme_name); ?></a>
                  
                    </div><!--/booking-step-content-down-->
                </div><!--/bg-booking-step-->


            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->
    <?php } ?>



<?php
if(isset($_GET['reservation_page'])){
    if($_GET['reservation_page']=='confirmation'){ 
        ?>

    

  <div class="title-pages left">
        <div class="title-pages-image left" style="<?php if(has_post_thumbnail()){echo 'background:url('.$title_bg_image[0].')';} else { echo 'background:#'.$heading_background; } ?>"></div>
        <div class="wrapper">
            <span><?php _e('Submit Reservation', tk_theme_name); ?></span>
            <p><?php _e('Step 2', tk_theme_name); ?></p>
        </div>        
    </div><!--/title-pages-->
    <div class="bottom-slider-red"></div><!--/bottom-slider-red-->

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">

            
                <div class="bg-booking-step booking-step2-content left">
                    <div class="booking-step-nav left">
                        <ul>
                            <li class="booking-step1-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Choose your room', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 1  -', tk_theme_name); ?></p>
                                </div>
                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/booking-step-img-active-left.png" alt=""/>
                            </li>
                            <li class="active booking-step2-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Submit Reservation', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 2  -', tk_theme_name); ?></p>
                                </div>                              
                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/booking-step-img-active.png" alt=""/>
                            </li>
                            <li class="booking-step3-nav">
                                <div class="booking-step-content">
                                    <span><?php _e('Confirmation', tk_theme_name); ?></span>
                                    <p><?php _e('-  Step 3  -', tk_theme_name); ?></p>
                                </div>
                            </li>
                        </ul>
                    </div><!--/booking-step-nav-->
                    
                    <div class="booking-step-content-down left">
                                                
                        <div class="booking-step-content-left left">
                            
                            <div class="booking-step-content-left-top left">
                                <span><?php _e('Reservation Summary', tk_theme_name); ?></span>
                                <div class="left">
                                    
                                    <?php                                    
                                        $arrival_date = $_GET['arrival_date'];
                                        $departure_date = $_GET['departure_date'];
                                        $room_id = $_GET['room_id'];
                                        
                                        $_SESSION['arrival_date'] = $_GET['arrival_date'];
                                        $_SESSION['departure_date'] = $_GET['departure_date'];
                                        $_SESSION['room_id'] = $_GET['room_id'];
                                       
                                        $_SESSION['room_id'] = $room_id;
                                        
                                        //count day difference
                                        $start = strtotime($arrival_date);
                                        $end = strtotime($departure_date);
                                        $days_between = ceil(abs($end - $start) / 86400);
                                        
                                        $room_price = get_post_meta($room_id, $prefix.'room_price_adult', true) * $days_between;
                                                
                                        if(!empty($room_taxes) || $room_taxes == 0){
                                        $room_taxes = ($room_taxes / 100) * $room_price; 
                                            $end_price = $room_price + $room_taxes;
                                        } else {
                                            $end_price = $room_price;
                                        }
                                        $_SESSION['room_price'] = $room_price;
                                        
                                        
                                        //change date format
                                        $arrival_date_show = date("l, F d, Y", strtotime($arrival_date));
                                        $departure_date_show = date("l, F d, Y", strtotime($departure_date));                                    
                                        
                                        
                                    ?>
                                    
                                    
                                    <p><?php _e('Arrival Date:', tk_theme_name); ?> <?php echo $arrival_date_show; ?></p>
                                    <p><?php _e('Departure Date:', tk_theme_name); ?> <?php echo $departure_date_show; ?></p>
                                </div>
                                <a href="<?php echo get_permalink($reservations_page); ?>"><?php _e('Change Date', tk_theme_name); ?></a>
                            </div>
                        </div><!--/booking-step-content-left-->
                        
                        
                        <div class="bg-reservation-summary-content left">
                            <div class="reservation-summary-content">
                                
                                <div class="reservation-summary-content-top left">
                                    <span><?php echo get_the_title($room_id); ?></span>
                                </div><!--/reservation-summary-content-->
                                
                                <ul>
                                    <li>
                                        <span><?php _e('Room Price', tk_theme_name); ?></span>
                                        <p><?php if($currency_position == 'left') { echo $currency_sign; }?> <?php echo $room_price;  if($currency_position=='right') { echo $currency_sign; } ?></p>
                                    </li>
                                    <li class="no-border">                                        
                                        <span><?php _e('Room Taxes', tk_theme_name); ?></span>                           
                                        <p><?php if($currency_position == 'left') { echo $currency_sign; }?> <?php echo $room_taxes; if($currency_position=='right') { echo $currency_sign; } ?></p>
                                    </li>
                                </ul>
                                
                            </div><!--/reservation-summary-content-->
                        </div><!--/reservation-summary-content-->                        
                    </div><!--/booking-step-content-down-->
                        
                    <div class="reservation-summary-sum left">
                        <div class="reservation-summary-sum-content right">
                            <span><?php _e('Grand Total:', tk_theme_name); ?></span>
                            <p><?php if($currency_position == 'left') { echo $currency_sign; }?><?php echo $end_price; ?> <?php _e('incl tax', tk_theme_name); ?></p>
                        </div>
                    </div>
                </div><!--/bg-booking-step-->

                
                        <?php
                            $title_error = get_option(tk_theme_name.'_reservations_title_error');
                            if(empty($title_error)) { $title_error='Please select your title'; }
                            $email_error = get_option(tk_theme_name.'_reservations_email_error');
                            if(empty($email_error)) { $email_error='Please enter your e-mail'; }
                            $first_name_error = get_option(tk_theme_name.'_reservations_first_name_error');
                            if(empty($first_name_error)) { $first_name_error='Please enter your first name'; }
                            $last_name_error = get_option(tk_theme_name.'_reservations_last_name_error');
                            if(empty($last_name_error)) { $last_name_error='Please enter your last name'; }
                            $phone_error = get_option(tk_theme_name.'_reservations_phone_error');
                            if(empty($phone_error)) { $phone_error='Please enter your phone number'; }
                            $address_error = get_option(tk_theme_name.'_reservations_address_error');
                            if(empty($address_error)) { $address_error='Please enter your address'; }
                            $country_error = get_option(tk_theme_name.'_reservations_country_error');
                            if(empty($country_error)) { $country_error='Please enter your country'; }
                            $city_error = get_option(tk_theme_name.'_reservations_city_error');
                            if(empty($city_error)) { $city_error='Please enter your city'; }
                            $postal_code_error = get_option(tk_theme_name.'_reservations_postal_code_error');
                            if(empty($postal_code_error)) { $postal_code_error='Please enter your postal code'; }
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
                                    var is_element_input = jQuery(field).is("input");           
                                    
                                    var checkfalse = 0;
                                    if(field.value == ""){
                                        jQuery('#contact-error').empty().append(alerttxt);
                                        field.focus();
                                        checkfalse=1;
                                    }

                                    if(field.value==checktext)
                                    {
                                        jQuery('#contact-error').empty().append(alerttxt);
                                        field.focus();
                                        checkfalse=1;
                                    }

                                    if(checkfalse==1){
                                        if(is_element_input == true) { 
                                            jQuery(field).attr('style', 'border:1px solid #e27b67;');
                                        } else {
                                            jQuery(field).parent().attr('style', 'border:1px solid #e27b67;');
                                        }                                        
                                        return false;
                                    }else{ 
                                        if(is_element_input == true) { 
                                            jQuery(field).attr('style', 'border:1px solid #e27b67;');
                                        } else {
                                            jQuery(field).parent().attr('style', 'border:1px solid #e27b67;');
                                        }
                                        return true;    
                                    }


                                    }

                            }


                            function checkForm(thisform)
                            {
                                with (thisform)
                                {
                                    var error = 0;

                                   
                                    var guest_title = document.getElementById('guest-title');
                                    if(check_field(guest_title, "<?php echo $postal_code_error ?>")==false){
                                        error = 1;
                                    }                                   

                                    var guest_postal = document.getElementById('guest-postal');
                                    if(check_field(guest_postal, "<?php echo $postal_code_error; ?>","<?php _e('Postal Code *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }
                                    
                                    var guest_city = document.getElementById('guest-city');
                                    if(check_field(guest_city, "<?php echo $city_error; ?>","<?php _e('City *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }
                                    
                                    var guest_country = document.getElementById('guest-country');
                                    if(check_field(guest_country, "<?php echo $country_error; ?>","<?php _e('Country *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }
                                    
                                    var guest_address = document.getElementById('guest-address');
                                    if(check_field(guest_address,"<?php echo $address_error; ?>","<?php _e('Address *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }
                                    
                                    var guest_phone_number = document.getElementById('guest-phone-number');
                                    if(check_field(guest_phone_number,"<?php echo $phone_error; ?>","<?php _e('Phone *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }
                                    
                                    var last_name = document.getElementById('last-name');
                                    if(check_field(last_name,"<?php echo $last_name_error; ?>","<?php _e('Last Name *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }
                                    
                                    var first_name = document.getElementById('first-name');
                                    if(check_field(first_name,"<?php echo $first_name_error; ?>","<?php _e('First Name *', tk_theme_name); ?>")==false){
                                        error = 1;
                                    }

                                    var guest_email = document.getElementById('guest-email');
                                    if (validate_email(guest_email,"<?php echo $email_error; ?>")==false)
                                    {guest_email.focus();error = 1;}
   
   
                                    if(error == 0){
                                        
                                        /*var guest_title = document.getElementById('guest-title').value;*/
                                        
                                        var guest_email = document.getElementById('guest-email').value;
                                        var first_name = document.getElementById('first-name').value;
                                        var guest_title = document.getElementById('guest-title').value;
                                        var last_name = document.getElementById('last-name').value;
                                        var guest_phone_number = document.getElementById('guest-phone-number').value;
                                        var guest_address = document.getElementById('guest-address').value;
                                        var guest_country = document.getElementById('guest-country').value;
                                        var guest_city = document.getElementById('guest-city').value;
                                        var guest_postal = document.getElementById('guest-postal').value;                                        

                                        return true;
                                    }
                                    return false;
                                }
                            }
                        </script>
                        <!-- end of script -->
                
                
                
                
                <div class="booking1-content left">
                    <form method="POST" action="" onsubmit="return checkForm(this)" name="guest_information" id="room_submit">
                    

                        <div class="form-booking1-content left">
                            <span><?php _e('PERSONAL INFORMATION', tk_theme_name); ?></span>

                            <div class="booking-form-full left">
                                <div class="home-action-select left">
                                    <select name="guest-title" id="guest-title">
                                        <option value="0"><?php _e('Title *', tk_theme_name); ?></option>
                                        <option value="<?php _e('mr', tk_theme_name); ?>"><?php _e('Mr.', tk_theme_name); ?></option>
                                        <option value="<?php _e('mrs', tk_theme_name); ?>"><?php _e('Mrs.', tk_theme_name); ?></option>
                                        <option value="<?php _e('ms', tk_theme_name); ?>"><?php _e('Ms', tk_theme_name); ?></option>
                                    </select>
                                </div>
                                <input class="right" id="guest-email" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Email *', tk_theme_name); ?>" name="guest-email" />
                            </div>

                            <div class="booking-form-full left">
                                <input class="left" id="first-name" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('First Name *', tk_theme_name); ?>" name="first-name" />
                                <input class="right" id="last-name" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="Last Name *" name="last-name" />
                            </div>

                            <div class="booking-form-full left">
                                <input class="left" id="guest-phone-number" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Phone *', tk_theme_name); ?>" name="guest-phone-number" />
                                <input class="right" id="guest-address" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Address *', tk_theme_name); ?>" name="guest-address" />
                            </div>

                            <div class="booking-form-full left">
                                <input class="left" id="guest-country" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Country *', tk_theme_name); ?>" name="guest-country" />
                                <input class="right" id="guest-state" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('State/Province', tk_theme_name); ?>" name="guest-state" />
                            </div>

                            <div class="booking-form-full left">
                                <input class="left" id="guest-city" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('City *', tk_theme_name); ?>" name="guest-city" />
                                <input class="right" id="guest-postal" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Postal Code *', tk_theme_name); ?>" name="guest-postal" />
                            </div>

                            <div class="booking-form-full left">
                                <textarea id="guest-message" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue"  name="guest-message"><?php _e('Message', tk_theme_name); ?></textarea>
                            </div><!-- booking-form-full -->

                            <!--  hidden fields  -->
                            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>" />
                            
                        </div><!--/form-booking1-content-->
                        
                        
                        <div class="form-booking1-button right">
                            <div>
                                <input type="submit" name="submit" class="room_submit" value="<?php _e('Submit Reservation', tk_theme_name); ?>" onclick="return checkForm(this)"  />
                            </div>
                            
                            <?php
                            $get_terms = get_theme_option(tk_theme_name. '_reservations_terms');
                            if($get_terms){ ?>
                                <div>
                                    <p><?php _e('By clicking this button, I accept Terms & Conditions', tk_theme_name); ?></p>
                                </div>
                            <?php } ?>
                            <div>
                                
                               <?php                     
                               if(!empty($get_terms)){ ?>                                
                                    <a href="#terms" class="fancytext"><?php _e('Terms and Conditions', tk_theme_name); ?></a>
                                    
                                    <div id="terms">
                                        <h4><?php _e('Terms and Conditions', tk_theme_name); ?></h4>
                                        <p><?php echo $get_terms; ?></p>
                                    </div><!-- terms -->
                               <?php } ?>
                            </div>
                        </div>           
                    </form>
                    
                    <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">
                    <div id="contact-success"><?php if(isset($_GET['sent'])) {
                            $what = $_GET['sent'];
                            if($what == 'success') {
                                echo $mail_success_msg;
                            }
                        }
                        ?>
                    </div>
                    <div id="contact-error"><?php if(isset($_GET['sent'])) {
                            $what = $_GET['sent'];
                            if($what == 'error') {
                                echo $mail_error_msg;
                            }
                        }
                        ?>
                    </div>
                    

            <?php
                if(isset($_POST['first-name'])){

                    $arrival_date = urldecode($_GET['arrival_date']);
                    $departure_date = urldecode($_GET['departure_date']);


                    $arrival_date = date('o-m-d', strtotime($arrival_date));
                    $departure_date = date('o-m-d', strtotime($departure_date));

                    
                    //writes reservation info into database
                    $wpdb->insert($wpdb->prefix.'cosily_rooms',
                    array('post_id' => $_GET['room_id'], 'arrival_date' => $arrival_date, 'departure_date' => $departure_date, 'message' => $_POST['guest-message'], 'email' => $_POST['guest-email'], 'title' => $_POST['guest-title'] ,'first_name' => $_POST['first-name'], 
                    'last_name' => $_POST['last-name'], 'country' => $_POST['guest-country'], 'address' => $_POST['guest-address'], 'city' => $_POST['guest-city'], 'state' => $_POST['guest-state'],  'postal_code' => $_POST['guest-postal'], 'phone' => $_POST['guest-phone-number'], 'price' => $end_price),
                    array('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d'));

                    $sitename =get_bloginfo('name');
                    $from = $_POST['guest-email'];
                    $admin_email = get_option('admin_email');
                    $site_address = get_site_url();

                    $tk_first_name = $_POST['first-name'];
                    $tk_last_name = $_POST['last-name'];
                    $tk_room_id = $_POST['room_id'];
                    $tk_message = $_POST['guest-message'];
                    $tk_email = $_POST['guest-email'];
                    $tk_title = $_POST['guest-title'];
                    $tk_country = $_POST['guest-country'];
                    $tk_address = $_POST['guest-address'];
                    $tk_city = $_POST['guest-city'];
                    $tk_state = $_POST['guest-state'];
                    $tk_postal_code = $_POST['guest-postal'];
                    $tk_phone = $_POST['guest-phone-number'];

                    
                    $_SESSION['first-name'] = $tk_first_name;
                    $_SESSION['last-name'] = $tk_last_name;
                    $_SESSION['room_id'] = $tk_room_id;
                    $_SESSION['guest-message'] = $tk_message;
                    $_SESSION['guest-email'] = $tk_email;
                    $_SESSION['guest-title'] = $tk_title;
                    $_SESSION['guest-country'] = $tk_country;
                    $_SESSION['guest-address'] = $tk_address;
                    $_SESSION['guest-city'] = $tk_city;
                    $_SESSION['guest-state'] = $tk_state;
                    $_SESSION['guest-postal'] = $tk_postal_code;
                    $_SESSION['guest-phone-number'] = $tk_phone;
                    
                    $_SESSION['arrival-date'] = $arrival_date;
                    $_SESSION['departure-date'] = $departure_date;
                   
                    
                    
                    $tk_room_title = get_the_title($tk_room_id);

                    $subject = 'Room Reservation - '.$tk_room_title;


                    //SENDS EMAIL TO ADMINISTRATION TO CONFIRM/CANCEL RESERVATION
                    $headers  = 'MIME-Version: 1.0'. "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= "From: ".$admin_email."r\n";
                    $headers .= "Reply-To: ".$from."r\n";


                   $message = "You have received room reservation from ".$tk_title.' '.$tk_first_name." ".$tk_last_name." - ".$tk_email."<br />
                        <strong>Room: </strong>".$tk_room_title."<br />
                        <strong>Arrival Date: </strong>".$arrival_date."<br />
                        <strong>Departure Date: </strong>".$departure_date."<br />
                        <strong>Phone: </strong>".$tk_phone."<br />
                        <strong>Address: </strong>".$tk_address."<br />
                        <strong>Country: </strong>".$tk_country."<br />
                        <strong>State/Province: </strong>".$tk_state."<br />
                        <strong>City: </strong>".$tk_city."<br />
                        <strong>Postal Code: </strong>".$tk_postal_code."<br />
                        <strong>Message: </strong>".$tk_message."<br />
                        <strong>Please go to ".$site_address."/wp-admin/admin.php?page=room-options to confirm or cancel users reservation";

                    wp_mail( $admin_email, $subject, $message, $headers); 



                    //SENDS EMAIL TO USER TO CONFIRM HIS RESERVATION HAS BEEN SUBMITTED
                    $headers  = 'MIME-Version: 1.0'. "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= "From: ".$from."r\n";
                    $headers .= "Reply-To: ".$admin_email."r\n";


                   $message = "Thank you for making a reservation. You will receive confirmation mail or a phone call soon. <br />
                                        Here is your reservation info:<br />
                                        <strong>Room: </strong>".$tk_room_title."<br />
                                        <strong>Arrival Date: </strong>".$arrival_date."<br />
                                        <strong>Departure Date: </strong>".$departure_date."<br />
                                        <strong>Phone: </strong>".$tk_phone."<br />
                                        <strong>Address: </strong>".$tk_address."<br />
                                        <strong>Country: </strong>".$tk_country."<br />
                                        <strong>State/Province: </strong>".$tk_state."<br />
                                        <strong>City: </strong>".$tk_city."<br />
                                        <strong>Postal Code: </strong>".$tk_postal_code."<br />
                                        <strong>Message: </strong>".$tk_message."<br />";

                    wp_mail( $tk_email, $subject, $message, $headers); 


        }?>
                    
                </div><!--/booking1-content-->
                               

            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->

    <?php } ?>
<?php } ?>


<?php 
get_footer(); ?>