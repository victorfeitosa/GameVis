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
        
        $reservation_info = $wpdb->get_row("SELECT * FROM`".$wpdb->prefix."cosily_rooms` WHERE id = $get_room_id");

        //SENDS EMAIL TO USER TO CONFIRM HIS RESERVATION HAS BEEN SUBMITTED
        $headers  = 'MIME-Version: 1.0'. "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: ".get_option('admin_email')."r\n";
        $headers .= "Reply-To: ".$reservation_info->email."r\n";

        $subject = 'Room Reservation - '.get_the_title($reservation_info->post_id);

       $message = "Your reservation has been confirmed. <br />
                            Here are the details:<br />
                            <strong>Room: </strong>".get_the_title($reservation_info->post_id)."<br />
                            <strong>Arrival Date: </strong>".$reservation_info->arrival_date."<br />
                            <strong>Departure Date: </strong>".$reservation_info->departure_date."<br />
                            <strong>Phone: </strong>".$reservation_info->phone."<br />
                            <strong>Address: </strong>".$reservation_info->address."<br />
                            <strong>Country: </strong>".$reservation_info->country."<br />
                            <strong>State/Province: </strong>".$reservation_info->state."<br />
                            <strong>City: </strong>".$reservation_info->city."<br />
                            <strong>Postal Code: </strong>".$reservation_info->postal_code."<br />
                            <strong>Message: </strong>".$reservation_info->message."<br />";

        wp_mail( $reservation_info->email, $subject, $message, $headers); 
}



//DELETE ROW

if(isset($_GET['delete'])) {   
    $room_id = $_GET['id'];    
    $wpdb->query( $wpdb->prepare("DELETE FROM `".$wpdb->prefix."cosily_rooms` WHERE id = ".$room_id.""));    
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

<!-- showing list of available room options and edit field -->

<div class="wrap">

        <table class="widefat">
            
            <thead>
                <tr>
                    <th><?php _e('No', tk_theme_name); ?></th>
                    <th><?php _e('Room Name', tk_theme_name); ?></th>
                    <th><?php _e('Arrival Date', tk_theme_name); ?></th>
                    <th><?php _e('Departure Date', tk_theme_name); ?></th>
                    <th><?php _e('Message', tk_theme_name); ?></th>
                    <th><?php _e('E-Mail', tk_theme_name); ?></th>
                    <th><?php _e('Title', tk_theme_name); ?></th>
                    <th><?php _e('First Name', tk_theme_name); ?></th>
                    <th><?php _e('Last Name', tk_theme_name); ?></th>
                    <th><?php _e('Country', tk_theme_name); ?></th>
                    <th><?php _e('Address', tk_theme_name); ?></th>
                    <th><?php _e('City', tk_theme_name); ?></th>
                    <th><?php _e('State', tk_theme_name); ?></th>
                    <th><?php _e('Postal Code', tk_theme_name); ?></th>
                    <th><?php _e('Phone', tk_theme_name); ?></th>
                    <th><?php _e('Price', tk_theme_name); ?></th>                    
                    <th><?php _e('Confirmation', tk_theme_name); ?></th>            
                    <th><?php _e('Edit Reservation', tk_theme_name); ?></th>
                </tr>
            </thead>                     
            <tbody>
                
                <?php
                    //gets info for room pagination
                    $room_count = count($wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."cosily_rooms"));                       
                    $page = @$_GET['roombooking_page'];
                    
                    if((!$page) || (is_numeric($page) == false) || ($page < 0) || ($page > $room_count)) {
                            $page = 1;
                    }
                    
                    $rows_limit = 20;
                    $total_pages = ceil($room_count / $rows_limit);
                    $set_limit = $page * $rows_limit - ($rows_limit);
                
                    $i = 1+$set_limit;
                    $list_room_options = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."cosily_rooms ORDER BY id DESC LIMIT ".$set_limit.",".$rows_limit);    
                    $rows_total_count = count($list_room_options);
                    
                    
                    foreach($list_room_options as $room_options){
                            $arrival_date  = explode('-', $room_options-> arrival_date);
                            $departure_date  = explode('-', $room_options ->departure_date);
                        
                            $arrival_date = $arrival_date['1'].'/'.$arrival_date['2'].'/'.$arrival_date['0'];
                            $departure_date = $departure_date['1'].'/'.$departure_date['2'].'/'.$departure_date['0'];
                        ?>
                 <form action="" method="post">
                        <tr <?php if($room_options->confirm == '0'){ echo "class='red'"; } else { echo "class='green'"; } ?>>
                            <td><?php echo $i; ?></td> 
                            <td><?php echo get_the_title($room_options->post_id); ?></td> 
                            <td><?php echo $arrival_date; ?></td>   
                            <td><?php echo $departure_date; ?></td>    
                            <td><?php echo $room_options->message; ?></td>   
                            <td><?php echo $room_options->email; ?></td>   
                            <td><?php echo $room_options->title; ?></td> 
                            <td><?php echo $room_options->first_name; ?></td>   
                            <td><?php echo $room_options->last_name; ?></td>   
                            <td><?php echo $room_options->country; ?></td>   
                            <td><?php echo $room_options->address; ?></td>   
                            <td><?php echo $room_options->city; ?></td>   
                            <td><?php echo $room_options->state; ?></td>   
                            <td><?php echo $room_options->postal_code; ?></td>   
                            <td><?php echo $room_options->phone; ?></td>  
                            <td><?php echo $room_options->price; ?></td>
                            <td>          
                                <?php if($room_options->confirm == '0'){ echo "<a href='".admin_url()."admin.php?page=room-options&confirmation=yes&id=".$room_options->id."'  rev='edit-".$room_options->id."'  style='float:left;'>".__('Confirm', tk_theme_name)."</a>";} else {echo "Confirmed";} ?>
                            </td>   
                            <td>                                
                                <a class="edit_button" rev="edit-<?php echo $room_options->id; ?>"  style="float:left;"><?php _e('Edit ', tk_theme_name); ?></a>
                                <a class="delete_button" rev="<?php echo $room_options->id; ?>"> <?php _e(' Delete', tk_theme_name); ?></a>                                
                            </td>                            
                        </tr>

                       
                        <tr class="edit-<?php echo $room_options->id; ?> room-option-row-hide option-row">       
                            <td></td> 
                            <td><?php echo get_the_title($room_options->post_id); ?></td> 
                            
                            <td>
                                <input type="text" name="arrival_date_edit" class="admin-datepicker reservation-input" value="<?php echo $arrival_date; ?>" />                                
                                <input type="hidden" name="get_id" class="get_id" value="<?php echo $room_options->id; ?>" />
                            </td>
                            
                            <td><input type="text" name="departure_date_edit" class="admin-datepicker reservation-input" value="<?php echo $departure_date; ?>" /></td>                                            
                            <td><textarea type="text" name="message_edit" class="reservation-input" value="<?php echo $room_options->message; ?>"></textarea></td>
                            <td><input type="text" name="email_edit" class="reservation-input" value="<?php echo $room_options->email; ?>" /></td>
                            <td>
                                <select name="title_edit">
                                    <option value="<?php _e('mr.', tk_theme_name); ?>" <?php if($room_options->title == "mr") { echo "selected='selected'"; } ?>><?php _e('Mr.', tk_theme_name); ?></option>
                                    <option value="<?php _e('mrs.', tk_theme_name); ?>" <?php if($room_options->title == "mrs") { echo "selected='selected'"; } ?>><?php _e('Mrs.', tk_theme_name); ?></option>
                                    <option value="<?php _e('ms', tk_theme_name); ?>" <?php if($room_options->title == "ms") { echo "selected='selected'"; } ?>><?php _e('Ms', tk_theme_name); ?></option>
                                </select>
                            </td>                                                        
                            <td><input type="text" name="first_name_edit" class="reservation-input" value="<?php echo $room_options->first_name; ?>" /></td>
                            <td><input type="text" name="last_name_edit" class="reservation-input" value="<?php echo $room_options->last_name; ?>" /></td>
                            <td><input type="text" name="country_edit" class="reservation-input" value="<?php echo $room_options->country; ?>" /></td>                            
                            <td><input type="text" name="address_edit" class="reservation-input" value="<?php echo $room_options->address; ?>" /></td>   
                            <td><input type="text" name="city_edit" class="reservation-input" value="<?php echo $room_options->city; ?>" /></td>   
                            <td><input type="text" name="state_edit" class="reservation-input" value="<?php echo $room_options->state; ?>" /></td>   
                            <td><input type="text" name="postal_code_edit" class="reservation-input" value="<?php echo $room_options->postal_code; ?>" /></td>   
                            <td><input type="text" name="phone_edit" class="reservation-input" value="<?php echo $room_options->phone; ?>" /></td>  
                            <td><input type="text" name="price_edit" class="smaller-input" value="<?php echo $room_options->price; ?>" /></td>
                            <td></td>   
                            <td><input type="submit" value="<?php _e('Save', tk_theme_name); ?>" /></td>
                            <td></td>   
                        </tr>

                    </form>
                    <?php $i++; } ?>        
            </tbody>
        </table>
    
    
    
<div class="tablenav bottom">
    <div class="tablenav-pages"><span class="displaying-num"><?php echo $rows_total_count;?> <?php _e('items', tk_theme_name); ?></span>
    <span class="pagination-links">
        
        <a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page=room-options&roombooking_page=1'?>" title="Go to the first page" class="first-page <?php if($page==1){echo "disabled";}?>">&laquo;</a>
        <a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page=room-options&roombooking_page='.($page-1);?>" title="Go to the previous page" class="prev-page <?php if($page==1){echo "disabled";}?>">&lt;</a>

    <span class="paging-input"><?php echo $page;?> of <span class="total-pages"><?php echo $total_pages;?></span></span>

    <a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page=room-options&roombooking_page='.($page+1);?>" title="Go to the next page" class="next-page <?php if($page==$total_pages){echo "disabled";}?>">&gt;</a>
    <a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page=room-options&roombooking_page='.$total_pages;?>" title="Go to the last page" class="last-page <?php if($page==$total_pages){echo "disabled";}?>">&raquo;</a></span></div>
    <br class="clear">
</div>    
    
    
    
</div><!--wrap-->


<!-- jQuery for showing and hiding edit fields -->
<script type="text/javascript">
    jQuery('a.edit_button').click(function(){
        var getRev = jQuery(this).attr('rev');   
        jQuery('tr.'+getRev).toggleClass('room-option-row-hide', 'room-option-row-show');
    });
</script>