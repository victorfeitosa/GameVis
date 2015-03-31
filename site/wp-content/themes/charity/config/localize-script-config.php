<?php
require_once ABSPATH . 'wp-load.php';

/************************************************************/
/*                                                          */
/*   Define like this:                                      */
/*   'some_unique_name' => value_of_this_variable           */
/*   Call like this in js                                   */
/*   js_variables.some_unique_name                          */
/*                                                          */
/************************************************************/
$subject_error_msg = get_option(wp_get_theme()->name . '_contact_subject_error_message');
$name_error_msg = get_option(wp_get_theme()->name . '_contact_name_error_message');
$email_error_msg = get_option(wp_get_theme()->name . '_contact_email_error_message');
$message_error_msg = get_option(wp_get_theme()->name . '_contact_message_error_message');
$mail_success_msg = get_option(wp_get_theme()->name . '_contact_message_successful');
$mail_error_msg = get_option(wp_get_theme()->name . '_contact_message_unsuccessful');
$slider_type = get_theme_option(wp_get_theme()->name . '_general_slider_type');

if($slider_type == 'slit') {
    $check_slider = 'slit-on';
} else {
    $check_slider = '';
}

$gallery_template = is_page_template('templates/template_gallery.php');

$variable_array = array(
    'get_template_directory_uri' => get_template_directory_uri(),
    'theme_date_format' => get_option( 'date_format' ),
    'subject_error_message' => $subject_error_msg,
    'name_error_message' => $name_error_msg,
    'email_error_message' => $email_error_msg,
    'message_error_message' => $message_error_msg,
    'all_fields_are_required' => __('All fields are required', 'tkingdom'),
    'mail_success_msg' => $mail_success_msg,
    'mail_error_msg' => $mail_error_msg,
    'check_slit' => $check_slider,
    'check_gallery' => $gallery_template
);
?>