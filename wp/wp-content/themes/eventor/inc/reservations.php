<?php 
global $wpdb;

//code for editing room options
if(!empty($_POST['fullname'])) {
    
    //gets the value from form
    $fullname = $_POST['fullname'];
    $appointment = $_POST['appointment_for'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $service = $_POST['service'];
    $message = $_POST['message'];
    
    $get_id = $_POST['get_id'];    
    
    //checks to see if name is already taken, if not saves it to database
    $check_result = $wpdb->get_results( "SELECT * FROM `" . $wpdb->prefix . tk_theme_name . "_reservations` WHERE room_options = '$room_option_edit' AND price ='$room_option_price';" );
    var_dump($check_result);
    if(empty($check_result)){
        $wpdb->query( $wpdb->prepare("UPDATE " . $wpdb->prefix . tk_theme_name . "_reservations SET id=%s, fullname=%s, appointment_for=%s, email=%s, phone=%s, date=%s, service=%s, message=%s WHERE id=%d", 
        $get_id, $fullname , $appointment, $email, $phone, $date, $service, $message, $get_id));
        
        $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
    }
}


?>

<!-- showing list of available room options and edit field -->
<div class="wrap">

        <table class="widefat">
            
            <thead>
                <tr>                    
                    <th><?php _e('ID', tk_theme_name); ?></th>   
                    <th><?php _e('Name', tk_theme_name); ?></th>   
                    <th><?php _e('Team Member', tk_theme_name); ?></th>                    
                    <th><?php _e('E-Mail', tk_theme_name); ?></th> 
                    <th><?php _e('Phone', tk_theme_name); ?></th> 
                    <th><?php _e('Date', tk_theme_name); ?></th> 
                    <th><?php _e('Service', tk_theme_name); ?></th> 
                    <th><?php _e('Message', tk_theme_name); ?></th> 
                    <th></th>
                </tr>
            </thead>

            <tbody>                
                <?php                 
                    $appointments = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix.tk_theme_name."_reservations");    
                    foreach($appointments as $appointment_one){ ?>
                        <tr>
                            <td width="10%"><?php echo $appointment_one->id; ?></td>   
                            <td width="10%"><?php echo $appointment_one->fullname; ?></td> 
                            <td width="10%"><?php echo $appointment_one->appointment_for; ?></td>
                            <td width="10%"><?php echo $appointment_one->email; ?></td>
                            <td width="10%"><?php echo $appointment_one->phone; ?></td>
                            <td width="10%"><?php echo $appointment_one->date; ?></td>
                            <td width="10%"><?php echo $appointment_one->service; ?></td>
                            <td width="10%"><?php echo $appointment_one->message; ?></td>
                            <td width="10%"><a href="#" class="edit_button" rev="edit-<?php echo $appointment_one->id; ?>">Edit</a></td>
                        </tr>
                        
                        
                        <tr class="edit-<?php echo $appointment_one->id; ?> reservations-hide option-row">
                          <form action="" method="post">
                               
                              <td width="10%"></td>
                              
                              <td width="10%">
                                <input type="text" name="fullname" value="<?php echo $appointment_one->fullname; ?>" />
                                <input type="hidden" name="get_id" value="<?php echo $appointment_one->id; ?>" />
                              </td>
                              
                              <td width="10%">
                                <input type="text" name="appointment_for" value="<?php echo $appointment_one->appointment_for; ?>" />                                
                              </td>
                              
                              <td width="10%">
                                <input type="text" name="email" value="<?php echo $appointment_one->email; ?>" />                                
                              </td>
                              
                              <td width="10%">
                                <input type="text" name="phone" value="<?php echo $appointment_one->phone; ?>" />                                
                              </td>
                              
                              <td width="10%">
                                <input type="text" name="date" value="<?php echo $appointment_one->date; ?>" />                                
                              </td>
                              
                              <td width="10%">
                                <input type="text" name="service" value="<?php echo $appointment_one->service; ?>" />                                
                              </td>
                              
                              
                              <td width="10%">
                                <input type="textarea" name="message" value="<?php echo $appointment_one->message; ?>" />                                 
                              </td>                                                         
                                                            
                              <td width="10%"><input type="submit" value="<?php _e('Save', tk_theme_name); ?>" /></td>    
                              
                          </form>
                       </tr>
                        
                        
                    <?php } ?>        
            </tbody>
            
        </table>
        
</div><!--wrap-->


<!-- jQuery for showing and hiding edit fields -->
<script type="text/javascript">
    jQuery('a.edit_button').click(function(){
        var getRev = jQuery(this).attr('rev');
        jQuery('tr.'+getRev).toggleClass('reservations-show');
    });
</script>