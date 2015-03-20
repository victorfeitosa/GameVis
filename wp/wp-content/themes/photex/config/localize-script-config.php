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
$variable_array = array(
    'get_template_directory_uri' => get_template_directory_uri(),
    'theme_date_format' => get_option( 'date_format' ),
);
?>