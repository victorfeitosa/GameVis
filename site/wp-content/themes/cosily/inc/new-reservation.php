<?php 
    global $post;
    global $wpdb;
    
//CONFIRMS ROOMS RESERVATION ANDS SENDS EMAIL TO THE GUEST
?>
    
<script type="text/javascript">    
    //alert box confirmation for reservation deletion
    jQuery(document).ready(function($){
        jQuery('.delete_button').click(function(){
           var r=confirm("Are you sure you want to delete this reservation?");
                var get_id =jQuery(this).attr('rev');              
                if (r==true){
                      window.location = "<?php echo admin_url()."admin.php?page=room-options&delete=yes&id=" ?>"+get_id;
                  } else {
                      window.location = "<?php echo admin_url()."admin.php?page=room-options" ?>";
                  }
        });
    });
</script>
    
<?php
if(isset($_GET['confirmation'])){
    $get_room_id = $_GET['id'];    
        $wpdb->query( $wpdb->prepare("UPDATE `".$wpdb->prefix."cosily_rooms` SET `confirm`= 1 WHERE id = $get_room_id", 
             $get_room_id));
}



//DELETE ROW

if(isset($_GET['delete'])) {   
    $room_id = $_GET['id'];    
    $wpdb->query( $wpdb->prepare("DELETE FROM `".$wpdb->prefix."cosily_rooms` WHERE id = ".$room_id.""));    
}


/*  BACKEND RESERVATIONS SAVE QUERY */
if(!empty($_POST['select_room'])) {
    
    //values from form
    $room_select = $_POST['select_room'];
    $arrival_date = $_POST['arrival_date'];
    $departure_date = $_POST['departure_date'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $phone = $_POST['phone'];
    $price = $_POST['price'];

    $arrival_date  = explode('/', $arrival_date);
    $departure_date  = explode('/', $departure_date);
    
    $arrival_date = $arrival_date['2'].'-'.$arrival_date['0'].'-'.$arrival_date['1'];
    $departure_date = $departure_date['2'].'-'.$departure_date['0'].'-'.$departure_date['1'];
        
    //check if room is booked for that day
    $single_room_search = $wpdb->get_results( "SELECT DISTINCT p.ID FROM ".$wpdb->prefix."posts p, ".$wpdb->prefix."cosily_rooms b WHERE  b.post_id = p.ID AND b.post_id = ".$room_select." AND post_type = 'rooms'
                                        AND
                                             (('".$arrival_date."' BETWEEN b.arrival_date AND b.departure_date)
                                        OR
                                        ('".$departure_date."' BETWEEN b.arrival_date AND b.departure_date))");
    
        //if not writes into database
        if(empty($single_room_search)){
                        
        $wpdb->query( $wpdb->prepare( "INSERT INTO " . $wpdb->prefix . "cosily_rooms
            (post_id, arrival_date, departure_date, nights, message, email, title, first_name, last_name, country, address, city, state, postal_code, phone, price, confirm) 
            VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %d, %s);", 
            $room_select, $arrival_date, $departure_date, $nights, $message, $email, $title, $first_name, $last_name, $country, $address, $city, $state, $postal_code, $phone, $price, '1')); 
        $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
        
        
        //SENDS EMAIL CONFIRMTION FOR ROOM RESERVATION
        
        $to = $email;  //Enter your e-mail here.
        $subject =  __('Room Reservation:', tk_theme_name).$room_select;  //Customize your subject

        $from = get_bloginfo('name');
        $admin_email = get_option('admin_email');        
        $headers = "From: $from <$admin_email>\n";
        $headers .= "Reply-To: $subject <$admin_email>\n";
    //    $return = $_POST['returnurl'];
               
         $body = "Room Booking Confirmation                        
                        <strong>Name:</strong> ".$title . $first_name . " ".$last_name."<br /><br />
                        <strong>Room:</strong>" . get_the_title($room_select) . "<br /><br />
                        <strong>Arrival Date:</strong> " . $arrival_date . "<br /><br />
                        <strong>Departure Date:</strong> " . $departure_date . "<br /><br />
                        <strong>Country: </strong>" . $country . "<br /><br />
                        <strong>Address: </strong>" . $address . "<br /><br />
                        <strong>City: </strong>" . $city . "<br /><br />
                        <strong>State: </strong>" . $state . "<br /><br />
                        <strong>Postal Code: </strong>" . $postal_code . "<br /><br />
                        <strong>Phone: </strong>" . $phone . "<br /><br />
                        <strong>Price: </strong>" . $price . "<br /><br />";

            if($send){
            //wp_redirect($return.'?sent=success');
            }else{
          //      wp_redirect($return.'?sent=error');
            }

        
        add_filter('wp_mail_content_type', 'set_content_type');
        function set_content_type($content_type) {
            return 'text/html';
        }

        add_filter('wp_mail_from', 'my_mail_from_function');
        function my_mail_from_function($email) {
            global $to;
            return $to;
        }

        add_filter('wp_mail_from_name', 'my_mail_from_name_function');
        function my_mail_from_name_function($email) {
            global $full_name;
            return $full_name;
        }

        add_filter('wp_mail_charset', 'set_charset');
        function set_charset($charset) {
            return 'UTF-8'; //default is blog charset
        }
        

        $send = wp_mail($to, $subject, $body);
        
        
        
    } else {
        //if yes just redirects page
        $url_parameters = isset($tab) ? 'same_name=true&tab=' . $tab : 'error=true';
        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
        

        
        $_SESSION['select_room'] = $_POST['select_room'];
        $_SESSION['arrival_date'] = $_POST['arrival_date'];
        $_SESSION['departure_date'] = $_POST['departure_date'];
        $_SESSION['message'] = $_POST['message'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['title'] = $_POST['title'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        $_SESSION['country'] = $_POST['country'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['postal_code'] = $_POST['postal_code'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['price'] = $_POST['price'];
        
        echo "<p class='taken-room'>The room is taken for this date. Please select another one.</p>";
    }
}


/* IF NAME IN DATABASE IS ALREADY TAKEN SHOWS THE ERROR MESSAGE */ 
 if(isset($_GET['same_name'])){
    if($_GET['same_name'] == true) {
        _e('The room option already exists', tk_theme_name);
    }
 }
    
 
 //WHEN USER EDITES RESERVATION THIS QUERY IS USED
if(isset($_POST['get_id'])){
    
    $get_id = $_POST['get_id'];
    $arrival_date = $_POST['arrival_date_edit'];
    $departure_date = $_POST['departure_date_edit'];
    $message = $_POST['message_edit'];
    $email = $_POST['email_edit'];
    $title = $_POST['title_edit'];
    $first_name = $_POST['first_name_edit'];
    $last_name = $_POST['last_name_edit'];
    $country = $_POST['country_edit'];
    $address = $_POST['address_edit'];
    $city = $_POST['city_edit'];
    $state = $_POST['state_edit'];
    $postal_code = $_POST['postal_code_edit'];
    $phone = $_POST['phone_edit'];
    $price = $_POST['price_edit'];
    
    $arrival_date  = explode('/', $arrival_date);
    $departure_date  = explode('/',  $departure_date);

    $arrival_date = $arrival_date['2'].'-'.$arrival_date['0'].'-'.$arrival_date['1'];
    $departure_date = $departure_date['2'].'-'.$departure_date['0'].'-'.$departure_date['1'];
      
    //CHECKS TO SEE IF THE ROOM IS BOOKED FOR THAT DAY
    $single_room_search = $wpdb->get_results( "SELECT DISTINCT p.ID FROM ".$wpdb->prefix."posts p, ".$wpdb->prefix."cosily_rooms b WHERE  b.post_id = p.ID AND b.post_id = ".$get_id." AND post_type = 'rooms'
                                        AND
                                             (('".$arrival_date."' BETWEEN b.arrival_date AND b.departure_date)
                                        OR
                                        ('".$departure_date."' BETWEEN b.arrival_date AND b.departure_date))");


        $wpdb->query( $wpdb->prepare("UPDATE " . $wpdb->prefix."cosily_rooms SET `arrival_date`=%s, `departure_date`=%s,`message`=%s, `email`=%s, `title`=%s, `first_name`=%s,
            `last_name`=%s, `country`=%s, `address`=%s,`city`=%s, `state`=%s, `postal_code`=%s, `phone`=%s, `price`=%s WHERE id=%d", 
            $arrival_date, $departure_date, $message, $email, $title, $first_name, $last_name, $country, $address, $city, $state, $postal_code, $phone, $price , $get_id));
        $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));    
}

?>


<!-- form for inserting room options and price -->
<form action="" method="post">
    <table width="300" class="custom-reservations"> 
        <tr valign="top">            
                <td><?php _e('Select Room:', tk_theme_name); ?></td>
                <td>
                    
                    <select name="select_room">
                        <option value="0"><?php _e('Select Room', tk_theme_name); ?></option>                        
                        <?php                        
                            $args = array('post_status' => 'publish', 'post_type' => 'rooms', 'posts_per_page' =>-1);
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();    
                        ?>
                            <option value="<?php echo $post->ID ?>" <?php if(!empty($_SESSION['select_room'] )){ if($_SESSION['select_room'] == $post->ID) { echo "selected";}} ?> ><?php the_title(); ?></option>
                        <?php endwhile; endif; ?>        
                    </select>                                
                </td>
        </tr>
        
        <tr valign="top">
                <td><?php _e('Arrival Date:', tk_theme_name); ?></td>
                <td><input type="text"  class="room-options arrival-date admin-datepicker" name="arrival_date" value="<?php if(isset($_SESSION['arrival_date'])) { echo $_SESSION['arrival_date'];} ?>" /></td>    
        </tr>
                
         <tr valign="top">
                <td><?php _e('Departure Date:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options departure-date admin-datepicker" name="departure_date" value="<?php if(isset($_SESSION['departure_date'])) { echo $_SESSION['departure_date'];} ?>" /></td> 
         </tr>                
               
                
          <tr valign="top">       
                <td><?php _e('Message:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options message" name="message" value="<?php if(isset($_SESSION['message'])) { echo $_SESSION['message'];} ?>" /></td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('E-Mail:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options email" name="email" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email'];} ?>" /></td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('Title:', tk_theme_name); ?></td>
                <td>                    
                    
                    <select name="title">
                        <option value="<?php _e('Mr.', tk_theme_name); ?>"  <?php if(!empty($_SESSION['title'] )){ if($_SESSION['title'] == 'Mr.') { echo "selected";}} ?>><?php _e('Mr.', tk_theme_name); ?></option>
                        <option value="<?php _e('Mrs.', tk_theme_name); ?>" <?php if(!empty($_SESSION['title'] )){ if($_SESSION['title'] == 'Mrs.') { echo "selected";}} ?>><?php _e('Mrs.', tk_theme_name); ?></option>
                        <option value="<?php _e('Ms', tk_theme_name); ?>" <?php if(!empty($_SESSION['title'] )){ if($_SESSION['title'] == 'Ms') { echo "selected";}} ?>><?php _e('Ms', tk_theme_name); ?></option>
                    </select>
                                        
                </td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('First Name:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options first_name" name="first_name" value="<?php if(isset($_SESSION['first_name'])) { echo $_SESSION['first_name'];} ?>" /></td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('Last Name:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options last_name" name="last_name" value="<?php if(isset($_SESSION['last_name'])) { echo $_SESSION['last_name'];} ?>" /></td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('Country:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options country" name="country" value="<?php if(isset($_SESSION['country'])) { echo $_SESSION['country'];} ?>" /></td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('Address:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options address" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address'];} ?>" /></td> 
         </tr>
                
                
          <tr valign="top">       
                <td><?php _e('City:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options city" name="city" value="<?php if(isset($_SESSION['city'])) { echo $_SESSION['city'];} ?>" /></td> 
          </tr>
                
                
          <tr valign="top">       
                <td><?php _e('State:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options state" name="state" value="<?php if(isset($_SESSION['state'])) { echo $_SESSION['state'];} ?>" /></td> 
          </tr>
                
          <tr valign="top">       
                <td><?php _e('Postal Code:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options postal_code" name="postal_code" value="<?php if(isset($_SESSION['postal_code'])) { echo $_SESSION['postal_code'];} ?>" /></td> 
          </tr>
                
          <tr valign="top">       
                <td><?php _e('Phone:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options phone" name="phone" value="<?php if(isset($_SESSION['price'])) { echo $_SESSION['price'];} ?>" /></td> 
          </tr>
          
          <tr valign="top">       
                <td><?php _e('Price:', tk_theme_name); ?></td>
                <td><input type="text" class="room-options price" name="price" value="<?php if(isset($_SESSION['phone'])) { echo $_SESSION['phone'];} ?>" /></td>
          </tr>       
                

    </table>    
    <p class="submit"> <input type="submit" class="button-primary" value="<?php _e('Add', tk_theme_name); ?>" /></p>
</form>


