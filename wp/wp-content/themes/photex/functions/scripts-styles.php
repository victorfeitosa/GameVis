<?php

function tk_add_stylesheet() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('bootstrap');

    wp_register_style('fancybox', get_template_directory_uri().'/script/fancybox/fancybox.css');
    wp_enqueue_style('fancybox');

    wp_register_style('main_style', get_stylesheet_uri());
    wp_enqueue_style('main_style');

    wp_register_style('woocommerce', get_template_directory_uri().'/css/woocommerce.css');
    wp_enqueue_style('woocommerce');

     wp_register_style('isotope', get_template_directory_uri().'/script/isotope/css/style.css');
    wp_enqueue_style('isotope');

    wp_register_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
    wp_enqueue_style('fontawesome');


    /***************************************/
    /******LOAD CSS FOR BROWSERS******/
    /***************************************/

    $browser = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($browser, 'Chrome')) { // CSS FOR IE 11
        wp_register_style('chrome', get_template_directory_uri() . '/css/chrome.css');
        wp_enqueue_style('chrome');
    }

}
add_action( 'wp_enqueue_scripts', 'tk_add_stylesheet' );


/*************************************************************/
/************LOAD SCRIPTS***********************************/
/*************************************************************/

function tk_add_scripts() {

    $browser = $_SERVER['HTTP_USER_AGENT'];
    global $variable_array;
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui', get_template_directory_uri().'/script/jquery/jquery-ui-1.10.3.js', false, false, true );
    wp_enqueue_script('easing', get_template_directory_uri().'/script/jquery/jquery.easing-1.3.min.js', false, false, true );
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/script/bootstrap/bootstrap.js', false, false, true );
    wp_enqueue_script('modernizer', get_template_directory_uri().'/script/modernizr/modernizr.js', false, false, true );
    wp_enqueue_script('fancybox', get_template_directory_uri().'/script/fancybox/fancybox.js', false, false, true );
    wp_enqueue_script('fancybox-media', get_template_directory_uri().'/script/fancybox/helpers/jquery.fancybox-media.js', false, false, true );
    wp_enqueue_script('sly-slider', get_template_directory_uri().'/script/sly-slider/sly.js', false, false, true );
    wp_enqueue_script('nicescroll', get_template_directory_uri().'/script/nicescroll/jquery.nicescroll.min.js', false, false, true );
    wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.js', false, false, true );
    wp_enqueue_script('isotope-masonry', get_template_directory_uri().'/script/isotope/jquery.isotope.sloppy-masonry.min.js', false, false, true );
    wp_enqueue_script('placeholders', get_template_directory_uri().'/script/placeholders/placeholders.js', false, false, true );
    wp_enqueue_script('call-scripts', get_template_directory_uri().'/script/call-scripts.js', false, false, true );
    wp_enqueue_script('vimeo-api', 'http://a.vimeocdn.com/js/froogaloop2.min.js', false, false, true );
    if(is_singular()) wp_enqueue_script( 'comment-reply' );

    wp_enqueue_script('like_post', get_template_directory_uri().'/script/post-like.js', array('jquery'), '1.0', true );
    wp_localize_script('like_post', 'ajax_var', array( 'url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax-nonce') ));

    if (strpos($browser, 'MSIE 8.0')) {
        wp_enqueue_script('respond', get_template_directory_uri() . '/script/respond/respond.src.js', false, false, true);
    }

    require(get_template_directory().'/config/localize-script-config.php');
    wp_localize_script('call-scripts', 'js_variables', $variable_array);
    wp_localize_script('admin', 'js_variables', $variable_array);
}

add_action('wp_enqueue_scripts', 'tk_add_scripts');
?>