<?php session_start();
//loading wordpress functions
require( '../../../wp-load.php' );
$return = $_REQUEST['returnurl'];
$from = $_REQUEST['name'];
$name = $_REQUEST['contactemail'];
$message = $_REQUEST['message'];
$_SESSION['contactname'] = $from;
$_SESSION['contactemail'] = $name;
$_SESSION['contactmessage'] = $message;

    $to = get_option('admin_email');                  //Enter your e-mail here.
    $subject =  get_theme_option(wp_get_theme()->name.'_contact_contact_subject');

    $headers = "From: $name <$from>\n";
    $headers .= "Reply-To: $subject <$from>\n";
    $sitename =get_bloginfo('name');

    $body = __("You received e-mail from ", 'tkingdom').$from."  [".$name."] ". __(" using ", 'tkingdom').$sitename."\n\n\n".$message;

    $send = wp_mail($to, $subject, $body, $headers) ;

    if($send){
        wp_redirect($return.'?sent=success');
    }else{
        wp_redirect($return.'?sent=error');
    }
?>