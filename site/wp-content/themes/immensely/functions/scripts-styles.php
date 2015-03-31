<?php

function tk_add_stylesheet() {
    wp_register_style('reset', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('reset');
    
    wp_register_style('animation', get_template_directory_uri() . '/css/animation.css');
    wp_enqueue_style('animation');

    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('bootstrap');

    wp_register_style('bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css');
    wp_enqueue_style('bootstrap-responsive');

    //wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css');
    //wp_enqueue_style('responsive');

    wp_register_style('main_style', get_stylesheet_uri());
    wp_enqueue_style('main_style');

    wp_register_style('home_slider_main_style', get_template_directory_uri().'/script/home-slider/css/style.css');
    wp_enqueue_style('home_slider_main_style');

    wp_register_style('home_slider_custom_style', get_template_directory_uri().'/script/home-slider/css/custom.css');
    wp_enqueue_style('home_slider_custom_style');

    wp_register_style('flexslider_style', get_template_directory_uri().'/script/flexslider/flexslider.css');
    wp_enqueue_style('flexslider_style');

    wp_register_style('countdown', get_template_directory_uri().'/script/countdown/jquery.countdown.css');
    wp_enqueue_style('countdown');

    wp_register_style('jplayer', get_template_directory_uri().'/script/jplayer/skin/blue.monday/jplayer.blue.monday.css');
    wp_enqueue_style('jplayer');
  
    wp_register_style('fancybox', get_template_directory_uri().'/script/fancybox/jquery.fancybox.css');
    wp_enqueue_style('fancybox');
        
    wp_register_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
    wp_enqueue_style('fontawesome');
    
    wp_register_style('DroidSans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
    wp_enqueue_style('DroidSans');
    
    

    /***************************************/
    /******LOAD CSS FOR BROWSERS******/
    /***************************************/
    
    $browser = $_SERVER['HTTP_USER_AGENT'];
    /*
    if (strpos($browser, 'iPhone')) {   // CSS FOR IPHONE
        wp_register_style('iphone', get_template_directory_uri() . '/css/iphone.css');
        wp_enqueue_style('iphone');
    }*/

    if (strpos($browser, 'MSIE 8.0')) { // CSS FOR IE 8
        wp_register_style('ie8', get_template_directory_uri() . '/css/ie8.css');
        wp_enqueue_style('ie8');
    }
    
    if (strpos($browser, 'MSIE 9.0')) { // CSS FOR IE 9
        wp_register_style('ie9', get_template_directory_uri() . '/css/ie9.css');
        wp_enqueue_style('ie9');
    }
    
    if (strpos($browser, 'MSIE 10.0')) {    // CSS FOR IE 10
        wp_register_style('ie10', get_template_directory_uri() . '/css/ie10.css');
        wp_enqueue_style('ie10');
    }
    
    if (strpos($browser, 'MSIE 11.0')) {    // CSS FOR IE 11
        wp_register_style('ie11', get_template_directory_uri() . '/css/ie11.css');
        wp_enqueue_style('ie11');
    }

    if (strpos($browser, 'Firefox')) {  // CSS FOR FIREFOX
        wp_register_style('firefox', get_template_directory_uri() . '/css/firefox.css');
        wp_enqueue_style('firefox');
    }
    
    if (strpos($browser, 'Safari')) {  // CSS FOR SAFARI
        wp_register_style('safari', get_template_directory_uri() . '/css/safari.css');
        wp_enqueue_style('safari');
    }
    
    
    if (strpos($browser, 'iPad')) { // CSS FOR IPAD
         wp_register_style('ipad', get_template_directory_uri().'/css/ipad.css');
         wp_enqueue_style('ipad');
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
    wp_enqueue_script('jquery-ui', get_template_directory_uri().'/script/jquery/jquery-ui-1.10.1.custom.min.js', false, false, true );
    wp_enqueue_script('easing', get_template_directory_uri().'/script/jquery/jquery.easing-1.3.min.js', false, false, true );
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/script/bootstrap/bootstrap.min.js', false, false, true );
    wp_enqueue_script('bootstrap-dropdown', get_template_directory_uri().'/script/bootstrap/twitter-bootstrap-hover-dropdown.min.js', false, false, true );
    wp_enqueue_script('modernizer', get_template_directory_uri().'/script/home-slider/js/modernizr.custom.79639.js', false, false, true );
    wp_enqueue_script('ba-cond', get_template_directory_uri().'/script/home-slider/js/jquery.ba-cond.min.js', false, false, true );
    wp_enqueue_script('slitslider', get_template_directory_uri().'/script/home-slider/js/jquery.slitslider.js', false, false, true );
    wp_enqueue_script('flexslider', get_template_directory_uri().'/script/flexslider/jquery.flexslider.js', false, false, true );
    wp_enqueue_script('jplayer', get_template_directory_uri().'/script/jplayer/js/jquery.jplayer.min.js', false, false, true );
    wp_enqueue_script('fancybox', get_template_directory_uri().'/script/fancybox/jquery.fancybox.pack.js', false, false, true );
    wp_enqueue_script('spiner', get_template_directory_uri().'/script/spiner/spin.min.js', false, false, true );
    wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.min.js', false, false, true );
    wp_enqueue_script('countdown', get_template_directory_uri().'/script/countdown/jquery.countdown.min.js', false, false, true );
    wp_enqueue_script('common', get_template_directory_uri().'/script/common.js', false, false, true );
    wp_enqueue_script('call-scripts', get_template_directory_uri().'/script/call-scripts.js', false, false, true );
    
    if (strpos($browser, 'MSIE 8.0')) { 
        wp_enqueue_script('respond', get_template_directory_uri() . '/script/respond/respond.src.js', false, false, true);
    }

    require(get_template_directory().'/config/localize-script-config.php');
    wp_localize_script('call-scripts', 'js_variables', $variable_array);
    wp_localize_script('admin', 'js_variables', $variable_array);


        /*     * *********************************************************** */
    /*     * **********SLIT SLIDER************************************ */
    /*     * ********************************************************* */
    
    $sl_slider_autoplay = get_theme_option(wp_get_theme()->name . '_general_slider_autoplay');
    $sl_slider_speed = get_theme_option(wp_get_theme()->name . '_general_slider_pause_time');
    if(empty($sl_slider_speed)){$sl_slider_speed =  4000 ;}
    $sl_slider_animation = get_theme_option(wp_get_theme()->name . '_general_slider_animation_time');
    if(empty($sl_slider_animation)){$sl_slider_animation = 500 ;}
    
    $slider_option = array(
      'slider_autoplay' => $sl_slider_autoplay,
      'slider_pause_time' => $sl_slider_speed,
      'slider_animation_time' => $sl_slider_animation,
    );
    
    wp_localize_script('slitslider', 'slit_slider_option', $slider_option);
            
            
        }  
    
add_action('wp_enqueue_scripts', 'tk_add_scripts');
?>