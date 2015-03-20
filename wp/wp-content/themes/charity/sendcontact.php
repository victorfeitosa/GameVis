<?php session_start();
//loading wordpress functions
require( '../../../wp-load.php' );
$captcha_option = get_theme_option(wp_get_theme()->name.'_contact_disable_captcha');
$return = $_REQUEST['returnurl'];
$from = $_REQUEST['contactname'];
$name = $_REQUEST['email'];
$message = $_REQUEST['message'];
$_SESSION['contactname'] = $from;
$_SESSION['contactemail'] = $name;
$_SESSION['contactmessage'] = $message;

if ($captcha_option !== 'yes') { //Captcha enabled
    if (empty($_SESSION['captcha']) || strtolower(trim($_REQUEST['captcha'])) != $_SESSION['captcha']) {

        $structure = get_option('permalink_structure');
        if($structure == '') {
            wp_redirect($return.'&captcha=error');
        } else {
            wp_redirect($return.'?captcha=error');
        }
    }else{
        unset($_SESSION['contactname']);
        unset($_SESSION['contactemail']);
        unset($_SESSION['contactmessage']);
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
    }

} else /*if captcha disabled*/ {

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
}
?>