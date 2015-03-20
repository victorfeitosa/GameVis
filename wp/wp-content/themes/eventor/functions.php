<?php
global $wpdb;

require( get_template_directory() . '/inc/theme-settings.php');                //Building theme administration

require( get_template_directory() . '/inc/meta-boxes.php');                    //Building meta boxes

require( get_template_directory() . '/inc/post-types.php');                    //Building post types

require( get_template_directory() . '/inc/custom-taxonomies.php');             //Building post types

function tk_theme_name() {
    return 'eventor';
}

define('tk_theme_name', 'eventor');
update_option('tk_theme_name', tk_theme_name);

$lang = get_template_directory() . '/languages/';                               //Make this theme available for translation.
load_theme_textdomain(tk_theme_name, $lang);

add_theme_support('automatic-feed-links');

add_theme_support('custom-background');

add_theme_support('post-thumbnails');                                         //This enables Post Thumbnails support for this theme.
add_image_size('blog', 560, 302, true);
add_image_size('blog-full', 820, 442, true);
add_image_size('sponsor', 300, 206, true);
add_image_size('speakers', 300, 275, true);
add_image_size('speaker-single', 475, 443, true);
add_image_size('home_speaker', 180, 152, true);
add_image_size('widget-advert', 225, 188, true);
add_image_size('widget-advert-small', 107, 89, true);
add_image_size('full', 980, 999999, true);



register_nav_menu('primary', __('Primary Menu', tk_theme_name));                //This theme uses wp_nav_menu()
//THEME NAME
$tk_theme_name = tk_theme_name;

function new_excerpt_more($more) {
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');




/* * ********************************************************** */
/* * **********LOAD STYLES*********************************** */
/* * ********************************************************** */

function tk_add_stylesheet() {
    wp_register_style('main_style', get_stylesheet_uri());
    wp_enqueue_style('main_style');

    wp_register_style('superfish', get_template_directory_uri() . '/script/menu/superfish.css');
    wp_enqueue_style('superfish');

    wp_register_style('tabs', get_template_directory_uri() . '/script/tabs/jquery-ui-1.10.1.custom.min.css');
    wp_enqueue_style('tabs');

    wp_register_style('fancybox', get_template_directory_uri() . '/script/fancybox/source/jquery.fancybox.css');
    wp_enqueue_style('fancybox');

    wp_register_style('flexslider', get_template_directory_uri() . '/script/flexslider/flexslider.css');
    wp_enqueue_style('flexslider');

    wp_register_style('scroll-button', get_template_directory_uri() . '/script/scroll-button/scroll-button.css');
    wp_enqueue_style('scroll-button');
 
    wp_register_style('horizontal-slider', get_template_directory_uri() . '/script/horizontal/skin.css');
    wp_enqueue_style('horizontal-slider');

    if(is_front_page()){
        wp_register_style('slitcss', get_template_directory_uri().'/script/slit-slider/css/style.css');
        wp_enqueue_style('slitcss');
    }

    if(is_front_page()){
        wp_register_style('customslitcss', get_template_directory_uri().'/script/slit-slider/css/custom.css');
        wp_enqueue_style('customslitcss');
    }
    
    wp_register_style('Anvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700');
    wp_enqueue_style('Anvo');


    if (is_archive() || is_search() || is_single() || is_page_template('_blog.php') || is_category()) {
        wp_register_style('jplayer', get_template_directory_uri() . '/script/jplayer/skin/blue.monday/jplayer.blue.monday.css');
        wp_enqueue_style('jplayer');
    }


    $browser = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($browser, 'iPhone')) {
        wp_register_style('iphone', get_template_directory_uri() . '/style/iphone.css');
        wp_enqueue_style('iphone');
    }

    if (strpos($browser, 'MSIE 8.0')) {
        wp_register_style('ie8', get_template_directory_uri() . '/style/ie8.css');
        wp_enqueue_style('ie8');
    }

    if (strpos($browser, 'MSIE 9.0')) {
        wp_register_style('ie9', get_template_directory_uri() . '/style/ie9.css');
        wp_enqueue_style('ie9');
    }

    if (strpos($browser, 'MSIE 10.0')) {
        wp_register_style('ie10', get_template_directory_uri() . '/style/ie10.css');
        wp_enqueue_style('ie10');
    }

    if (strpos($browser, 'Firefox')) {
        wp_register_style('firefox', get_template_directory_uri() . '/style/firefox.css');
        wp_enqueue_style('firefox');
    }
    

    if (strpos($browser, 'iPad')) {
         wp_register_style('ipad', get_template_directory_uri().'/style/ipad.css');
         wp_enqueue_style('ipad');
     }

}

add_action('wp_enqueue_scripts', 'tk_add_stylesheet');

/* * ********************************************************** */
/* * **********LOAD SCRIPTS********************************** */
/* * ********************************************************** */

function tk_add_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('superfish', get_template_directory_uri() . '/script/menu/superfish.js', false, false, true);
    wp_enqueue_script('my-commons', get_template_directory_uri() . '/script/common.js', false, false, true);
    wp_enqueue_script('fancybox', get_template_directory_uri() . '/script/fancybox/source/jquery.fancybox.js', false, false, true);
    wp_enqueue_script('easing', get_template_directory_uri() . '/script/easing/jquery.easing.1.3.js', false, false, true);
    wp_enqueue_script('scroll-button', get_template_directory_uri() . '/script/scroll-button/scroll-button.js', false, false, true);
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/script/flexslider/jquery.flexslider-min.js', false, false, true);
    if (is_page_template('_blog.php') || is_single()) {
        wp_enqueue_script('flex-slider', get_template_directory_uri() . '/script/flexslider/flex-slider.js', false, false, true);
    }
    wp_enqueue_script('isotope', get_template_directory_uri() . '/script/isotope/jquery.isotope.min.js', false, false, true);
    wp_enqueue_script('spiner', get_template_directory_uri() . '/script/spiner/spin.min.js', false, false, true);
    wp_enqueue_script('jplayer', get_template_directory_uri() . '/script/jplayer/js/jquery.jplayer.min.js', false, false, true);
    wp_enqueue_script('respond', get_template_directory_uri() . '/script/respond/respond.src.js', false, false, true);
    wp_enqueue_script('hover-modernzr', get_template_directory_uri() . '/script/hover-gallery/modernizr.custom.97074.js', false, false, true);
    wp_enqueue_script('hover-gallery', get_template_directory_uri() . '/script/hover-gallery/jquery.hoverdir.js', false, false, true);
    wp_enqueue_script('jquery-easing', get_template_directory_uri() . '/script/jquery/jquery.easing-1.3.min.js', false, false, true);
    wp_enqueue_script('horizontal-slider', get_template_directory_uri() . '/script/horizontal/jquery.jcarousel.min.js', false, false, true);
    wp_enqueue_script('countdown-timer', get_template_directory_uri() . '/script/countdown/jquery.countdown.js', false, false, true);
    wp_enqueue_script('slitsmodernizr', get_template_directory_uri().'/script/slit-slider/js/modernizr.custom.79639.js', false, false, true );
    wp_enqueue_script('slitslider', get_template_directory_uri().'/script/slit-slider/js/jquery.slitslider.js', false, false, true );
    wp_enqueue_script('slitslidercond', get_template_directory_uri().'/script/slit-slider/js/jquery.ba-cond.min.js', false, false, true );
    wp_enqueue_script('madmimi', get_template_directory_uri() . '/script/madmimi/madmimi.js', false, false, true);


    /*     * *********************************************************** */
    /*     * **********SLIT SLIDER************************************ */
    /*     * ********************************************************* */
    
    $sl_slider_autoplay = get_option(tk_theme_name.'_home_slider_autoplay');
    $sl_slider_speed = get_option(tk_theme_name.'_home_slider_pause_time');
    if(empty($sl_slider_speed)){$sl_slider_speed =  4000 ;}
    $sl_slider_animation = get_option(tk_theme_name.'_home_slider_animation_time');
    if(empty($sl_slider_animation)){$sl_slider_animation = 500 ;}
    
    $slider_option = array(
      'slider_autoplay' => $sl_slider_autoplay,
      'slider_pause_time' => $sl_slider_speed,
      'slider_animation_time' => $sl_slider_animation,
    );
    
    wp_localize_script('slitslider', 'slit_slider_option', $slider_option);
    
    /*     * *********************************************************** */
    /*     * **********CONTACT MESSAGES*************************** */
    /*     * ********************************************************* */

    $subject_error_msg = get_option(tk_theme_name . '_contact_subject_error_message');
    $name_error_msg = get_option(tk_theme_name . '_contact_name_error_message');
    $email_error_msg = get_option(tk_theme_name . '_contact_email_error_message');
    $message_error_msg = get_option(tk_theme_name . '_contact_message_error_message');
    $mail_success_msg = get_option(tk_theme_name . '_contact_message_successful');
    $mail_error_msg = get_option(tk_theme_name . '_contact_message_unsuccessful');
    $phone_error_msg = get_option(tk_theme_name . '_contact_phone_error');
    $date_error_msg = get_option(tk_theme_name . '_contact_date_error');
    $doctor_error_msg = get_option(tk_theme_name . '_contact_doctor_error');

    $variable_array = array(
        
        'subject_error_message' => $subject_error_msg,
        'name_error_message' => $name_error_msg,
        'email_error_message' => $email_error_msg,
        'message_error_message' => $message_error_msg,
        'all_fields_are_required' => __('All fields are required', tk_theme_name()),
        'mail_success_msg' => $mail_success_msg,
        'mail_error_msg' => $mail_error_msg,
        'phone_error_msg' => $phone_error_msg,
        'date_error_msg' => $date_error_msg,
        'doctor_error_msg' => $doctor_error_msg,
        'admin_bar_showing' => is_admin_bar_showing()
    );



    wp_localize_script('my-commons', 'contact_variables', $variable_array);



    if (is_singular())
        wp_enqueue_script('comment-reply', false, false, true);
}

add_action('wp_enqueue_scripts', 'tk_add_scripts');



/* * ********************************************************** */
/* * **********VIDEO PLAYER**************************** */
/* * ********************************************************** */

function tk_video_player($url) {

    if (!empty($url)) {
        $key_str1 = 'youtube';
        $key_str2 = 'vimeo';

        $pos_youtube = strpos($url, $key_str1);
        $pos_vimeo = strpos($url, $key_str2);
        if (!empty($pos_youtube)) {
            $url = str_replace('watch?v=', '', $url);
            $url = explode('&', $url);
            $url = $url[0];
            $url = str_replace('http://www.youtube.com/', '', $url);
            ?>
            <div class="holder">
                <iframe src="http://www.youtube.com/embed/<?php echo $url; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php
        }
        if (!empty($pos_vimeo)) {
            $url = explode('.com/', $url);
            ?>

            <div class="holder">
                <iframe src="http://player.vimeo.com/video/<?php echo $url[1]; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>
            <?php
        }
        if (empty($pos_vimeo) && empty($pos_youtube)) {

            echo "Video only allowes vimeo and youtube!";
        }
    }
}

add_action("switch_theme", "tk_create_tables"); //theme switch action

function tk_create_tables() {
    global $wpdb;

    /*
     * Create first table: user_rating
     */
    $table_name1 = $wpdb->prefix . "banner_stats";

    if ($wpdb->get_var("show tables like '$table_name1'") !== $table_name1) {

        $sql = "CREATE TABLE " . $table_name1 . " (
stat_id bigint(20) NOT NULL AUTO_INCREMENT,
banner_id bigint(20) NOT NULL,
date date NOT NULL,
clicks bigint(20) NOT NULL,
views bigint(20) NOT NULL,
PRIMARY KEY (stat_id),
KEY banner_id (banner_id));";


        require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
        dbDelta($sql);
    }
}

/*************************************************************/
/************SAVE ID AND TITLE OF PAGE TEMPLATES*********/
/************************************************************/

   add_action ( 'publish_page', 'saveProgram');

        function saveProgram($post_ID) {
            global $wp_query;
            $template_title =  get_the_title($post_ID);
            $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
            if($template_name == "_program.php") {
                update_option('id_program_page',$post_ID);
                update_option('title_program_page',$template_title);
            }

            $oldtemplate = get_option('id_program_page');
            if($post_ID == $oldtemplate) {
                if($template_name <> "_program.php") {
                    update_option('id_program_page','');
                }
            }
        }
        
   add_action ( 'publish_page', 'saveSpeakers');

        function saveSpeakers($post_ID) {
            global $wp_query;
            $template_title =  get_the_title($post_ID);
            $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
            if($template_name == "_speakers.php") {
                update_option('id_speakers_page',$post_ID);
                update_option('title_speakers_page',$template_title);
            }

            $oldtemplate = get_option('id_speakers_page');
            if($post_ID == $oldtemplate) {
                if($template_name <> "_speakers.php") {
                    update_option('id_speakers_page','');
                }
            }
        }
        


/*
 * SOCIAL SHARE COUNTERS
 */

// Facebook Share Counter
function get_likes($url) {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = md5('facebook_' . $url);

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    if (false === ( $trans = get_transient($transient_name) )) {

        $get_link = wp_remote_get('http://graph.facebook.com/' . $url, array('timeout' => 60));

        if (is_wp_error($get_link)) {
            return "0";
        } else {
            $facebook_count = json_decode($get_link['body'], true);

            if (!isset($facebook_count['shares']) or $facebook_count['shares'] == '') {
                set_transient($transient_name, 0, $cache_time * 60);
                return 0;
            } else {
                set_transient($transient_name, intval($facebook_count['shares']), $cache_time * 60);
                return $facebook_count['shares'];
            }
        }
    } else {
        return get_transient($transient_name);
    }
}

// Twitter Share Counter
function get_tweets($url) {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = md5('twitter_' . $url);

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }
    if (false === ( $trans = get_transient($transient_name) )) {
        $get_link = wp_remote_get('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
        if (is_wp_error($get_link)) {
            return "0";
        } else {
            $twitter_count = json_decode($get_link['body'], true);
            set_transient($transient_name, intval($twitter_count['count']), $cache_time * 60);
            return intval($twitter_count['count']);
        }
    } else {
        return get_transient($transient_name);
    }
}

// Google plus Share Counter
function get_plusones($url) {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = md5('google_plus_' . $url);

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    if (false === ( $trans = get_transient($transient_name) )) {

        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'timeout' => 30,
            'redirection' => 1,
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog' => true,
                    'id' => $url,
                    'source' => 'widget',
                    'userId' => '@viewer',
                    'groupId' => '@self'
                )
            )),
            'sslverify' => false
        );

        $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);

        if (is_wp_error($json_string)) {
            return "0";
        } else {
            $json = json_decode($json_string['body'], true);
            set_transient($transient_name, intval($json['result']['metadata']['globalCounts']['count']), $cache_time * 60);
            return intval($json['result']['metadata']['globalCounts']['count']);
        }
    } else {
        return get_transient($transient_name);
    }
}

// Stumbleupon Share Counter
function get_stumbleupon($url) {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = md5('stumbleupon_' . $url);

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    if (false === ( $trans = get_transient($transient_name) )) {
        $get_link = wp_remote_get('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url);
        if (is_wp_error($get_link)) {
            return "0";
        } else {
            $stumbleupon_count = json_decode($get_link['body'], true);
            if (@$stumbleupon_count['result']['views'] == '') {
                return 0;
            } else {
                set_transient($transient_name, intval($stumbleupon_count['result']['views']), $cache_time * 60);
                return intval($stumbleupon_count['result']['views']);
            }
        }
    } else {
        return get_transient($transient_name);
    }
}

// Linkedin Share Counter
function get_linkedin($url) {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = md5('linkedin_' . $url);

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    if (false === ( $trans = get_transient($transient_name) )) {
        $get_link = wp_remote_get('http://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json');
        if (is_wp_error($get_link)) {
            return "0";
        } else {
            $linkedin_count = json_decode($get_link['body'], true);
            if ($linkedin_count['count'] == '') {
                return 0;
            } else {
                set_transient($transient_name, intval($linkedin_count['count']), $cache_time * 60);
                return intval($linkedin_count['count']);
            }
        }
    } else {
        return get_transient($transient_name);
    }
}

// Pinterest Share Counter
function get_pinit($url) {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = md5('pinit_' . $url);

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    if (false === ( $trans = get_transient($transient_name) )) {

        $get_link = wp_remote_get('http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=' . $url);

        $temp_json = str_replace("receiveCount(", "", $get_link['body']);
        $temp_json = substr($temp_json, 0, -1);

        if (is_wp_error($get_link)) {
            return "0";
        } else {
            $pinit_count = json_decode($temp_json, true);
            if ($pinit_count['count'] == '') {
                return 0;
            } else {
                set_transient($transient_name, intval($pinit_count['count']), $cache_time * 60);
                return intval($pinit_count['count']);
            }
        }
    } else {
        return get_transient($transient_name);
    }
}

/* get twitter followers on home page */

function tk_get_twitter_followers() {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = 'tk_overall_twitter_followers';

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }


    $twitter_user = get_theme_option(tk_theme_name . '_social_twitter');

    if (false === ( $tk_overall_twitter_followers = get_transient($transient_name) )) {
        $json = wp_remote_get('https://api.twitter.com/1/users/show.json?screen_name=' . $twitter_user . '&include_entities=true', array('timeout' => 60));

        if (is_wp_error($json)) {
            return "0.";
        } else {
            if (is_wp_error($json))
                return "0";
            $twitter_date = json_decode($json['body'], true);
            set_transient($transient_name, intval($twitter_date['followers_count']), $cache_time * 60);
            return intval($twitter_date['followers_count']);
        }
    } else {
        return get_transient($transient_name);
    }
}

/* get facebook page likes on home page */

function tk_get_facebook_likes() {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = 'tk_overall_facebook_likes';
    $facebook_likes = '';

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    $facebook_user = get_theme_option(tk_theme_name . '_social_facebook');

    if (false === ( $tk_overall_facebook_followers = get_transient($transient_name) )) {
        $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));

        if (is_wp_error($json)) {
            return "0.";
        } else {
            $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));
            if (is_wp_error($json))
                return "0";
            $fbData = json_decode($json['body'], true);

            set_transient($transient_name, intval($fbData['likes']), $cache_time * 60);

            return intval($fbData['likes']);
        }
    } else {
        return get_transient($transient_name);
    }
}

/* get googe plus circled count */

function gplus_count() {
    $cache_time = get_option(tk_theme_name() . '_social_cache_time');
    $transient_name = 'tk_overall_google_pluses';
    $google_plus_count = '';

    if ($cache_time == 0) {
        delete_transient($transient_name);
    }
    if ($cache_time == '') {
        $cache_time = 15;
    }

    $gplus_username = get_theme_option(tk_theme_name() . '_social_google_plus');
    $gplus_api = get_theme_option(tk_theme_name() . '_social_google_plus_api');

    if (false === ( $tk_overall_twitter_followers = get_transient($transient_name) )) {
        $get_link = wp_remote_get("https://www.googleapis.com/plus/v1/people/" . $gplus_username . "?key=" . $gplus_api, array('timeout' => 30));

        if (is_wp_error($get_link)) {
            return "0.";
        } else {
            $google_plus_count = json_decode($get_link['body'], true);
            set_transient($transient_name, intval($google_plus_count['plusOneCount']), $cache_time * 60);
            return intval($google_plus_count['plusOneCount']);
        }
    } else {
        return get_transient($transient_name);
    }
}

/* * ********************************************************** */
/* * **********REGISTER POST FORMATS*********************** */
/* * ********************************************************* */

$post_formats = array(
    'gallery',
    'link',
    'quote',
    'audio',
    'video');

add_theme_support('post-formats', $post_formats);

add_post_type_support('post', 'post-formats');






/* * ********************************************************** */
/* * **********ENQUEUE ADMINSCRIPT************************* */
/* * ********************************************************* */

function enqueue_admin_script($hook) {
    global $typenow;

    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-accordion');
    wp_enqueue_script('jquery-ui-sortable');

    wp_register_script('adminscript', get_template_directory_uri() . '/script/adminscript/adminscript.js', 'jquery');
    wp_enqueue_script('adminscript');

    if (($hook == 'post.php' || $hook == 'post-new.php') and $typenow == 'advertisement' and isset($_GET['post'])) {

        wp_register_script('flot', get_template_directory_uri() . '/script/flot/jquery.flot.js', 'jquery');
        wp_enqueue_script('flot');

        wp_register_script('flot_resize', get_template_directory_uri() . '/script/flot/jquery.flot.resize.js', 'jquery');
        wp_enqueue_script('flot_resize');

        wp_register_script('flot_tooltip', get_template_directory_uri() . '/script/flot/jquery.flot.tooltip_0.4.4.js', 'jquery');
        wp_enqueue_script('flot_tooltip');

        wp_register_script('flot_time', get_template_directory_uri() . '/script/flot/jquery.flot.time.js', 'jquery');
        wp_enqueue_script('flot_time');
        ?>

        <?php
        global $wpdb;
        $todays_date = date('Y-m-d');
        $date = strtotime(date("Y", strtotime($todays_date)) . " -7 days");
        $date = date('Y-m-d', $date);

        $pageposts = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "banner_stats WHERE banner_id = %d AND date BETWEEN '" . $date . "' AND '" . $todays_date . "' ORDER BY date ASC", $_GET['post']), OBJECT);

        $views = '';
        $clicks = '';
        foreach ($pageposts as $post) {
            $views .= "[(new Date(\"" . $post->date . "\")).getTime()," . $post->views . "],";
            $clicks .= "[(new Date(\"" . $post->date . "\")).getTime()," . $post->clicks . "],";
        }
        ?>
        <script>
            var views = [<?php echo $views; ?>];
            var clicks = [<?php echo $clicks; ?>];
        </script>


        <?php
    }
}

add_action('admin_enqueue_scripts', 'enqueue_admin_script', 10, 1);



/* * ********************************************************** */
/* * **********AUDIO PLAYER********************************** */
/* * ********************************************************* */

function tk_jplayer($postid) {
    $audio_link = get_post_meta($postid, 'tk_audio_link', true);
    ?>
    <script type="text/javascript">

        jQuery(document).ready(function(){

            if(jQuery().jPlayer) {
                jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
                    ready: function () {
                        jQuery(this).jPlayer("setMedia", {
                            mp3: "<?php echo $audio_link; ?>",
                            end: ""
                        });
                    },
                    swfPath: "<?php echo get_template_directory_uri(); ?>/script/player",
                    cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
                    supplied: "mp3, all",
                    swfPath: "<?php echo get_template_directory_uri() ?>/script/jplayer/js"
                });

            }
        });
    </script>
    <?php
}

/* * ****************************************************** */
/* * **********GET CUSTOM THUMB SIZE********** */
/* * ***************************************************** */

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}

/*
 * $height -> height of new image
 * $width -> width of new image
 * $src -> url of image you want to get thumb from
 */

function tk_get_thumb($width, $height, $src) {
    $img_id = get_attachment_id_from_src($src);
    $size = wp_get_attachment_image_src($img_id, 'full');
    if ($width >= $size[1] || $height >= $size[2]) {
        echo $src;
    } else {
        if (strpos($src, '.jpg')) {
            $new_src = explode('.jpg', $src);
            $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.jpg';
            echo $new_src;
        } elseif (strpos($src, '.jpeg')) {
            $new_src = explode('.jpeg', $src);
            $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.jpeg';
            echo $new_src;
        } elseif (strpos($src, '.gif')) {
            $new_src = explode('.gif', $src);
            $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.gif';
            echo $new_src;
        } elseif (strpos($src, '.png')) {
            $new_src = explode('.png', $src);
            $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.png';
            echo $new_src;
        }
    }
}

/* * ********************************************************** */
/* * **********GET CUSTOM THUMB SIZE v2******************** */
/* * ********************************************************* */

function tk_get_thumb_new($width, $height, $src) {
    if (strpos($src, '.jpg')) {
        $new_src = explode('.jpg', $src);
        $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.jpg';
        /*
         * THIS STILL NEEDS TO BE TESTED!!!!
          if(@fopen($new_src, 'r')){
          echo $new_src;
          }else{
          echo $src;
          }
         */
        return $new_src;
    } elseif (strpos($src, '.jpeg')) {
        $new_src = explode('.jpeg', $src);
        $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.jpeg';
        return $new_src;
    } elseif (strpos($src, '.gif')) {
        $new_src = explode('.gif', $src);
        $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.gif';
        return $new_src;
    } elseif (strpos($src, '.png')) {
        $new_src = explode('.png', $src);
        $new_src = $new_src[0] . '-' . $width . 'x' . $height . '.png';
        return $new_src;
    }
}

/* * ********************************************************** */
/* * **********LOAD WIDGETS********************************* */
/* * ********************************************************** */

require_once (TEMPLATEPATH . '/inc/widgets/widget-twitter.php');
require_once (TEMPLATEPATH . '/inc/widgets/widget-newsletter.php');
require_once (TEMPLATEPATH . '/inc/widgets/widget-ad.php');
require_once (TEMPLATEPATH . '/inc/widgets/widget-facebook.php');





/* * ********************************************************** */
/* * **********INCREASE IMAGE QUALITY********************** */
/* * ********************************************************* */

function jpeg_quality_callback($arg) {
    return (int) 100;
}

add_filter('jpeg_quality', 'jpeg_quality_callback');



/* * ********************************************************** */
/* * **********REMOVE IMAGE SIZE**************************** */
/* * ********************************************************* */

add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
// Removes attached image sizes as well
add_filter('the_content', 'remove_thumbnail_dimensions', 10);

function remove_thumbnail_dimensions($html) {
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

/* * ********************************************************** */
/* * **********IMAGE WITHOUT DIMENSIONS******************* */
/* * ********************************************************* */

function tk_thumbnail($post_id, $img_size) {
    $thumbnail = get_the_post_thumbnail($post_id, $img_size);
    $thumbnail = preg_replace('/(width|height)=\"\d*\"\s/', "", $thumbnail);
    echo $thumbnail;
}

/* * ********************************************************** */
/* * **********EXCERPT LENGTH****************************** */
/* * ********************************************************* */

function the_excerpt_length($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if (strlen($excerpt) > $charlength) {
        $subex = substr($excerpt, 0, $charlength - 5);
        $exwords = explode(' ', $subex);
        $excut = - ( strlen($exwords[count($exwords) - 1]) );
        if ($excut < 0) {
            echo substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

/* * ********************************************************** */
/* * **********LOAD FUNCTION FOR COLOR CHANGE*********** */
/* * ********************************************************** */

function tk_change_color() {
    get_template_part('/inc/change-colors');
}

add_action('wp_head', 'tk_change_color', '99');

/* * ********************************************************** */
/* * **********GET URL OF CURENT PAGE********************* */
/* * ********************************************************* */

function get_page_url() {

    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"])) {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

/* * ********************************************************** */
/* * **********CHOSE SIDEBAR POSITION*********************** */
/* * ********************************************************* */

function tk_get_sidebar($sidebar_position, $sidebar_name) {
    $sidebar_option = get_theme_option(tk_theme_name . '_general_custom_sidebars');
    if ($sidebar_position == 'Right') {
        ?>
        <?php
        $sidebar_option = get_theme_option(tk_theme_name . '_general_custom_sidebars');
        if ($sidebar_option !== 'yes') {
            ?>
            <div id="sidebar" class="right third-width last-width">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Default')) : ?>
                <?php endif; ?>
            </div><!--/#sidebar-->
        <?php } else { ?>
            <div id="sidebar" class="right third-width last-width">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                <?php endif; ?>
            </div><!--/#sidebar-->
            <?php
        }
    }elseif ($sidebar_position == 'Left') {
        ?>
        <?php
        $sidebar_option = get_theme_option(tk_theme_name . '_general_custom_sidebars');
        if ($sidebar_option !== 'yes') {
            ?>
            <div id="sidebar" class="left third-width last-width">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Default')) : ?>
                <?php endif; ?>
            </div><!--/#sidebar-->
        <?php } else { ?>
            <div id="sidebar" class="left third-width last-width">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                <?php endif; ?>
            </div><!--/#sidebar-->
            <?php
        }
    }
}

/* * ********************************************************* /
  /**********REGISTERING SIDEBARS************************* /
  /********************************************************** */




if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Widget 1',
        'before_widget' => '<div class="footer_widget_holder left">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Widget 2',
        'before_widget' => '<div class="footer_widget_holder left">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Widget 3',
        'before_widget' => '<div class="footer_widget_holder left">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Footer Widget 4',
        'before_widget' => '<div class="footer_widget_holder left">',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Home/Index',
        'before_widget' => '<div class="sidebar_widget_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Default',
        'before_widget' => '<div class="sidebar_widget_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>')
    );
}


if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Archive/Search',
        'before_widget' => '<div class="sidebar_widget_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => '404 Sidebar',
        'before_widget' => '<div class="sidebar_widget_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>')
    );
}



$results = $wpdb->get_results("SELECT * FROM  " . $wpdb->prefix . "posts WHERE post_type = 'sidebars' AND post_status = 'publish'");

foreach ($results as $one_col) {

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => $one_col->post_title,
            'before_widget' => '<div class="sidebar_widget_holder left">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>')
        );
    }
}



/* * ********************************************************** */
/* * **********SET DEFAULTS********************************** */
/* * ********************************************************** */
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
    update_option('eventor_colors_body_bg_img', get_template_directory_uri() . '/style/img/bg-body.jpg');
}


/* * ********************************************************** */
/* * **********LOAD SHORTCODES***************************** */
/* * ********************************************************** */


require_once ( ABSPATH . 'wp-content/themes/' . tk_theme_name . '/inc/shortcodes/tinymce_loader.php');

// This one enables hr tag to default tiny options
function enable_more_buttons($buttons) {
    $buttons[] = 'hr';
    return $buttons;
}

add_filter("mce_buttons", "enable_more_buttons");

// Columns one half
function shortcode_one_half($atts, $content = null) {
    extract(shortcode_atts(array(
                'position' => '',
                    ), $atts));

    return '<div class="one-half ' . $position . '"><p>' . do_shortcode($content) . '</p></div>';
}

add_shortcode('one_half', 'shortcode_one_half');

// Columns one third
function shortcode_one_third($atts, $content = null) {
    extract(shortcode_atts(array(
                'position' => '',
                    ), $atts));

    return '<div class="one-third ' . $position . '"><p>' . do_shortcode($content) . '</p></div>';
}

add_shortcode('one_third', 'shortcode_one_third');

// Columns one fourth
function shortcode_one_fourth($atts, $content = null) {
    extract(shortcode_atts(array(
                'position' => '',
                    ), $atts));

    return '<div class="one-fourth ' . $position . '"><p>' . do_shortcode($content) . '</p></div>';
}

add_shortcode('one_fourth', 'shortcode_one_fourth');

// Shortcode for buttons
function shortcode_button( $atts, $content = null ) {

        extract(shortcode_atts(array(
                'url'     	 => '#',
                'style'   => 'black',
    ), $atts));

    return '<div class="color-buttons left"><a href="'.$url.'"><div class="'.$style.'"><div class="'.$style.'-left left"></div><div class="'.$style.'-center left">' . do_shortcode($content) . '</div><div class="'.$style.'-right left"></div></div></a></div>';
}

add_shortcode('button', 'shortcode_button');

// Shortcode for unordered list with different looks
function shortcode_list($atts, $content = null) {

    extract(shortcode_atts(array(
                'style' => '1'
                    ), $atts));

    return '<ul style="list-style:none;padding-left:0px"><li class="' . $style . '">' . do_shortcode($content) . '</li></ul>';
}

add_shortcode('list', 'shortcode_list');

// Shortcode for toggled content
function shortcode_toggle($atts, $content = null) {

    extract(shortcode_atts(array(
                'title' => 'Title',
                'value' => ''
                    ), $atts));

    if ($value != '') {
        $image_class = 'active-togle-img';
        $box_class = 'no-active-togle';
    } else {
        $image_class = '';
        $box_class = '';
    }

    return '<div class="toggle-holder"><div class="toggle-holder-image"><h6 class="' . $image_class . '"></h6></div><span>' . $title . '</span><p class="' . $box_class . '">' . do_shortcode($content) . '</p></div>';
}

add_shortcode('toggle', 'shortcode_toggle');

// Shortcode for tabbed content
function tz_tabs($atts, $content = null) {
    extract(shortcode_atts(array(
                'tabs' => ''
                    ), $atts));

    $output = '';
    $output .= '<div class="tabs"><ul>';

    $tabs = trim($tabs, ",");
    $myTabs = explode(',', $tabs);

    foreach ($myTabs as $tab) {
        $create_href = sanitize_title($tab);
        $output .= '<li><a href="#' . $create_href . '">' . $tab . '</a></li>';
    }

    $output .= '</ul>';
    $output .= '<div class="tab">';
    $myContent = do_shortcode($content);
    $output .= $myContent;
    $output .= '</div></div>';

    return $output;
}

add_shortcode('tabs', 'tz_tabs');

function tz_tabs_panes($atts, $content = null) {
    extract(shortcode_atts(array(
                'title' => ''
                    ), $atts));


    $create_id = sanitize_title($title);
    $output = '<div id="' . $create_id . '">' . do_shortcode($content) . '</div>';

    return $output;
}

add_shortcode('tab', 'tz_tabs_panes');

// Shortcode for PRICETABLE
function tk_price_table($atts, $content = null) {
    extract(shortcode_atts(array(
                'column' => '',
                'position' => '',
                'title' => '',
                'subtitle' => '',
                'bgcolor' => '',
                'textcolor' => '',
                'usebutton' => '',
                'url' => '',
                'style' => '',
                'buttontext' => ''
                    ), $atts));

    if ($usebutton == 'yes') {
        $button_output = '<div class="color-buttons pricing-button left"><a href="'.$url.'"><div class="'.$style.'"><div class="'.$style.'-left left"></div><div class="'.$style.'-center left">' . do_shortcode($buttontext) . '</div><div class="'.$style.'-right left"></div></div></a></div>';
    } else {
        $button_output = '';
    }
    $output = '

                        <div class="pricing-table-one left ' . $column . ' ' . $position . '">
                            <div class="pricing-table-one-border left">
                                <div class="pricing-table-one-top pricing-table-green left" style="background:' . $bgcolor . '">
                                    <span style="color:' . $textcolor . '">' . $title . '</span>
                                    <p style="color:' . $textcolor . '">' . $subtitle . '</p>
                                </div>
                                ' . do_shortcode($content) . $button_output . '
                            </div>
                        </div>
                        ';


    return $output;
}

add_shortcode('pricing', 'tk_price_table');

// Shortcode for ONEPRICE
function tk_one_price($atts, $content = null) {
    extract(shortcode_atts(array(
                'title' => ''
                    ), $atts));

    $create_id = $title; //sanitize_title
    if (strlen($content) <= 3) {
        $output = '<div class="pricing-table-one-center pricing-table-white left"><h5>' . $create_id . '</h5></div>';
    } else {
        $output = '<div class="pricing-table-one-center pricing-table-white left"><span>' . $create_id . '</span><p>' . do_shortcode($content) . '</p></div>';
    }

    return $output;
}

add_shortcode('price', 'tk_one_price');

// Shortcode for infobox
function shortcode_infobox($atts, $content = null) {

    extract(shortcode_atts(array(
                'bgcolor' => '#e85c2c',
                'textcolor' => '#FFF',
                    ), $atts));

    return '<div class="shortcode-infobox left" style="background-color:' . $bgcolor . '"><p style="color:' . $textcolor . '">' . do_shortcode($content) . '<p></div>';
}

add_shortcode('infobox', 'shortcode_infobox');

// Shortcode DROPCAP
function shortcode_dropcap($atts, $content = null) {
    extract(shortcode_atts(array(
                'style' => '',
                    ), $atts));

    return '<span class="dropcap-' . $style . '">' . do_shortcode($content) . '</span>';
}

add_shortcode('dropcap', 'shortcode_dropcap');

// Shortcode for calltoaction
function shortcode_calltoaction($atts, $content = null) {

    extract(shortcode_atts(array(
                'url' => '#',
                'style' => 'black',
                'buttontext' => '',
                'usebutton' => '',
                    ), $atts));

    $tk_return = '';
    if ($usebutton != 'yes') {
        $shortcode_call_class = 'home-call-action-fullwidth';
    } else {
        $shortcode_call_class = '';
    }

    $tk_return .= '<div class="home-call-action call-to-action-shortcode left">
                        <div class="home-call-action-content">
                            <div class="home-call-action-text ' . $shortcode_call_class . ' left">
                                <p>' . do_shortcode($content) . '</p>
                            </div>';

    if ($usebutton == 'yes') {
        $tk_return .= '<div class="color-buttons left"><a href="'.$url.'"><div class="'.$style.'"><div class="'.$style.'-left left"></div><div class="'.$style.'-center left">' . do_shortcode($buttontext) . '</div><div class="'.$style.'-right left"></div></div></a></div>';
    }
    $tk_return .= '</div></div>';

    return($tk_return);
}

add_shortcode('calltoaction', 'shortcode_calltoaction');

/* * ********************************************************** */
/* * **********SAVE TEMPLATE  ID AND NAME****************** */
/* * ********************************************************** */

add_action('publish_page', 'saveBlogId');

function saveBlogId($post_ID) {
    global $wp_query;
    $the_title = get_the_title($post_ID);
    $template_name = get_post_meta($post_ID, '_wp_page_template', true);
    if ($template_name == "_blog.php") {
        update_option('id_blog_page', $post_ID);
        update_option('title_blog_page', $the_title);
    }

    $oldblog = get_option('id_blog_page');
    if ($post_ID == $oldblog) {
        if ($template_name <> "_blog.php") {
            update_option('id_blog_page', '');
        }
    }
}

add_action('publish_page', 'saveServicesId');

function saveServicesId($post_ID) {
    global $wp_query;
    $the_title = get_the_title($post_ID);
    $template_name = get_post_meta($post_ID, '_wp_page_template', true);
    if ($template_name == "_services.php") {
        update_option('id_services_page', $post_ID);
        update_option('title_services_page', $the_title);
    }

    $oldblog = get_option('id_services_page');
    if ($post_ID == $oldblog) {
        if ($template_name <> "_services.php") {
            update_option('id_services_page', '');
        }
    }
}


add_action('publish_page', 'saveGalleryId');

function saveGalleryId($post_ID) {
    global $wp_query;
    $the_title = get_the_title($post_ID);
    $template_name = get_post_meta($post_ID, '_wp_page_template', true);
    if ($template_name == "_gallery_3_columns.php") {
        update_option('id_gallery_page', $post_ID);
        update_option('title_gallery_page', $the_title);
    }

    $oldblog = get_option('id_gallery_page');
    if ($post_ID == $oldblog) {
        if ($template_name <> "_gallery_3_columns.php") {
            update_option('id_gallery_page', '');
        }
    }
}

add_action('publish_page', 'saveSponsorsId');

function saveSponsorsId($post_ID) {
    global $wp_query;
    $the_title = get_the_title($post_ID);
    $template_name = get_post_meta($post_ID, '_wp_page_template', true);
    if ($template_name == "_sponsors.php") {
        update_option('id_sponsors_page', $post_ID);
        update_option('title_sponsors_page', $the_title);
    }

    $oldblog = get_option('id_sponsors_page');
    if ($post_ID == $oldblog) {
        if ($template_name <> "_sponsors.php") {
            update_option('id_sponsors_page', '');
        }
    }
}


/* * ********************************************************** */
/* * **********GOOGLE FONTS*********************** */
/* * ********************************************************** */
add_action('admin_enqueue_scripts', 'tk_enqueue_google_fonts_in_admin');

function tk_enqueue_google_fonts_in_admin() {

    global $wpdb;
    $google_fonts =
            array(
                array('name' => "Select", 'variant' => ''),
                array('name' => "Cantarell", 'variant' => ':r,b,i,bi'),
                array('name' => "Cardo", 'variant' => ''),
                array('name' => "Crimson Text", 'variant' => ''),
                array('name' => "Droid Sans", 'variant' => ':r,b'),
                array('name' => "Droid Sans Mono", 'variant' => ''),
                array('name' => "Droid Serif", 'variant' => ':r,b,i,bi'),
                array('name' => "IM Fell DW Pica", 'variant' => ':r,i'),
                array('name' => "Inconsolata", 'variant' => ''),
                array('name' => "Josefin Sans", 'variant' => ':400,400italic,700,700italic'),
                array('name' => "Josefin Slab", 'variant' => ':r,b,i,bi'),
                array('name' => "Lobster", 'variant' => ''),
                array('name' => "Molengo", 'variant' => ''),
                array('name' => "Nobile", 'variant' => ':r,b,i,bi'),
                array('name' => "OFL Sorts Mill Goudy TT", 'variant' => ':r,i'),
                array('name' => "Old Standard TT", 'variant' => ':r,b,i'),
                array('name' => "Reenie Beanie", 'variant' => ''),
                array('name' => "Tangerine", 'variant' => ':r,b'),
                array('name' => "Vollkorn", 'variant' => ':r,b'),
                array('name' => "Yanone Kaffeesatz", 'variant' => ':r,b'),
                array('name' => "Cuprum", 'variant' => ''),
                array('name' => "Neucha", 'variant' => ''),
                array('name' => "Neuton", 'variant' => ''),
                array('name' => "PT Sans", 'variant' => ':r,b,i,bi'),
                array('name' => "PT Sans Caption", 'variant' => ':r,b'),
                array('name' => "PT Sans Narrow", 'variant' => ':r,b'),
                array('name' => "Philosopher", 'variant' => ''),
                array('name' => "Allerta", 'variant' => ''),
                array('name' => "Allerta Stencil", 'variant' => ''),
                array('name' => "Arimo", 'variant' => ':r,b,i,bi'),
                array('name' => "Arvo", 'variant' => ':r,b,i,bi'),
                array('name' => "Bentham", 'variant' => ''),
                array('name' => "Coda", 'variant' => ':800'),
                array('name' => "Cousine", 'variant' => ''),
                array('name' => "Covered By Your Grace", 'variant' => ''),
                array('name' => "Geo", 'variant' => ''),
                array('name' => "Just Me Again Down Here", 'variant' => ''),
                array('name' => "Puritan", 'variant' => ':r,b,i,bi'),
                array('name' => "Raleway", 'variant' => ':100'),
                array('name' => "Tinos", 'variant' => ':r,b,i,bi'),
                array('name' => "UnifrakturCook", 'variant' => ':bold'),
                array('name' => "UnifrakturMaguntia", 'variant' => ''),
                array('name' => "Mountains of Christmas", 'variant' => ''),
                array('name' => "Lato", 'variant' => ':400,700,400italic'),
                array('name' => "Orbitron", 'variant' => ':r,b,i,bi'),
                array('name' => "Allan", 'variant' => ':bold'),
                array('name' => "Anonymous Pro", 'variant' => ':r,b,i,bi'),
                array('name' => "Copse", 'variant' => ''),
                array('name' => "Kenia", 'variant' => ''),
                array('name' => "Ubuntu", 'variant' => ':r,b,i,bi'),
                array('name' => "Vibur", 'variant' => ''),
                array('name' => "Sniglet", 'variant' => ':800'),
                array('name' => "Syncopate", 'variant' => ''),
                array('name' => "Cabin", 'variant' => ':400,400italic,700,700italic,'),
                array('name' => "Merriweather", 'variant' => ''),
                array('name' => "Maiden Orange", 'variant' => ''),
                array('name' => "Just Another Hand", 'variant' => ''),
                array('name' => "Kristi", 'variant' => ''),
                array('name' => "Corben", 'variant' => ':b'),
                array('name' => "Gruppo", 'variant' => ''),
                array('name' => "Buda", 'variant' => ':light'),
                array('name' => "Lekton", 'variant' => ''),
                array('name' => "Luckiest Guy", 'variant' => ''),
                array('name' => "Crushed", 'variant' => ''),
                array('name' => "Chewy", 'variant' => ''),
                array('name' => "Coming Soon", 'variant' => ''),
                array('name' => "Crafty Girls", 'variant' => ''),
                array('name' => "Fontdiner Swanky", 'variant' => ''),
                array('name' => "Permanent Marker", 'variant' => ''),
                array('name' => "Rock Salt", 'variant' => ''),
                array('name' => "Sunshiney", 'variant' => ''),
                array('name' => "Unkempt", 'variant' => ''),
                array('name' => "Calligraffitti", 'variant' => ''),
                array('name' => "Cherry Cream Soda", 'variant' => ''),
                array('name' => "Homemade Apple", 'variant' => ''),
                array('name' => "Irish Growler", 'variant' => ''),
                array('name' => "Kranky", 'variant' => ''),
                array('name' => "Schoolbell", 'variant' => ''),
                array('name' => "Slackey", 'variant' => ''),
                array('name' => "Walter Turncoat", 'variant' => ''),
                array('name' => "Radley", 'variant' => ''),
                array('name' => "Meddon", 'variant' => ''),
                array('name' => "Kreon", 'variant' => ':r,b'),
                array('name' => "Dancing Script", 'variant' => ''),
                array('name' => "Goudy Bookletter 1911", 'variant' => ''),
                array('name' => "PT Serif Caption", 'variant' => ':r,i'),
                array('name' => "PT Serif", 'variant' => ':r,b,i,bi'),
                array('name' => "Astloch", 'variant' => ':b'),
                array('name' => "Bevan", 'variant' => ''),
                array('name' => "Anton", 'variant' => ''),
                array('name' => "Expletus Sans", 'variant' => ':b'),
                array('name' => "VT323", 'variant' => ''),
                array('name' => "Pacifico", 'variant' => ''),
                array('name' => "Candal", 'variant' => ''),
                array('name' => "Architects Daughter", 'variant' => ''),
                array('name' => "Indie Flower", 'variant' => ''),
                array('name' => "League Script", 'variant' => ''),
                array('name' => "Quattrocento", 'variant' => ''),
                array('name' => "Amaranth", 'variant' => ''),
                array('name' => "Irish Grover", 'variant' => ''),
                array('name' => "Oswald", 'variant' => ':400,300,700'),
                array('name' => "EB Garamond", 'variant' => ''),
                array('name' => "Nova Round", 'variant' => ''),
                array('name' => "Nova Slim", 'variant' => ''),
                array('name' => "Nova Script", 'variant' => ''),
                array('name' => "Nova Cut", 'variant' => ''),
                array('name' => "Nova Mono", 'variant' => ''),
                array('name' => "Nova Oval", 'variant' => ''),
                array('name' => "Nova Flat", 'variant' => ''),
                array('name' => "Terminal Dosis Light", 'variant' => ''),
                array('name' => "Michroma", 'variant' => ''),
                array('name' => "Miltonian", 'variant' => ''),
                array('name' => "Miltonian Tattoo", 'variant' => ''),
                array('name' => "Annie Use Your Telescope", 'variant' => ''),
                array('name' => "Dawning of a New Day", 'variant' => ''),
                array('name' => "Sue Ellen Francisco", 'variant' => ''),
                array('name' => "Waiting for the Sunrise", 'variant' => ''),
                array('name' => "Special Elite", 'variant' => ''),
                array('name' => "Quattrocento Sans", 'variant' => ''),
                array('name' => "Smythe", 'variant' => ''),
                array('name' => "The Girl Next Door", 'variant' => ''),
                array('name' => "Aclonica", 'variant' => ''),
                array('name' => "News Cycle", 'variant' => ''),
                array('name' => "Damion", 'variant' => ''),
                array('name' => "Wallpoet", 'variant' => ''),
                array('name' => "Over the Rainbow", 'variant' => ''),
                array('name' => "MedievalSharp", 'variant' => ''),
                array('name' => "Six Caps", 'variant' => ''),
                array('name' => "Swanky and Moo Moo", 'variant' => ''),
                array('name' => "Bigshot One", 'variant' => ''),
                array('name' => "Francois One", 'variant' => ''),
                array('name' => "Sigmar One", 'variant' => ''),
                array('name' => "Carter One", 'variant' => ''),
                array('name' => "Holtwood One SC", 'variant' => ''),
                array('name' => "Paytone One", 'variant' => ''),
                array('name' => "Monofett", 'variant' => ''),
                array('name' => "Rokkitt", 'variant' => ':400,700'),
                array('name' => "Megrim", 'variant' => ''),
                array('name' => "Judson", 'variant' => ':r,ri,b'),
                array('name' => "Didact Gothic", 'variant' => ''),
                array('name' => "Play", 'variant' => ':r,b'),
                array('name' => "Ultra", 'variant' => ''),
                array('name' => "Metrophobic", 'variant' => ''),
                array('name' => "Mako", 'variant' => ''),
                array('name' => "Shanti", 'variant' => ''),
                array('name' => "Caudex", 'variant' => ':r,b,i,bi'),
                array('name' => "Jura", 'variant' => ''),
                array('name' => "Ruslan Display", 'variant' => ''),
                array('name' => "Brawler", 'variant' => ''),
                array('name' => "Nunito", 'variant' => ''),
                array('name' => "Wire One", 'variant' => ''),
                array('name' => "Podkova", 'variant' => ''),
                array('name' => "Muli", 'variant' => ''),
                array('name' => "Maven Pro", 'variant' => ':400,500,700'),
                array('name' => "Tenor Sans", 'variant' => ''),
                array('name' => "Limelight", 'variant' => ''),
                array('name' => "Playfair Display", 'variant' => ''),
                array('name' => "Artifika", 'variant' => ''),
                array('name' => "Lora", 'variant' => ''),
                array('name' => "Kameron", 'variant' => ':r,b'),
                array('name' => "Cedarville Cursive", 'variant' => ''),
                array('name' => "Zeyada", 'variant' => ''),
                array('name' => "La Belle Aurore", 'variant' => ''),
                array('name' => "Shadows Into Light", 'variant' => ''),
                array('name' => "Lobster Two", 'variant' => ':r,b,i,bi'),
                array('name' => "Nixie One", 'variant' => ''),
                array('name' => "Redressed", 'variant' => ''),
                array('name' => "Bangers", 'variant' => ''),
                array('name' => "Open Sans Condensed", 'variant' => ':300italic,400italic,700italic,400,300,700'),
                array('name' => "Open Sans", 'variant' => ':r,i,b,bi'),
                array('name' => "Varela", 'variant' => ''),
                array('name' => "Goblin One", 'variant' => ''),
                array('name' => "Asset", 'variant' => ''),
                array('name' => "Gravitas One", 'variant' => ''),
                array('name' => "Hammersmith One", 'variant' => ''),
                array('name' => "Stardos Stencil", 'variant' => ''),
                array('name' => "Love Ya Like A Sister", 'variant' => ''),
                array('name' => "Loved by the King", 'variant' => ''),
                array('name' => "Bowlby One SC", 'variant' => ''),
                array('name' => "Forum", 'variant' => ''),
                array('name' => "Patrick Hand", 'variant' => ''),
                array('name' => "Varela Round", 'variant' => ''),
                array('name' => "Yeseva One", 'variant' => ''),
                array('name' => "Give You Glory", 'variant' => ''),
                array('name' => "Modern Antiqua", 'variant' => ''),
                array('name' => "Bowlby One", 'variant' => ''),
                array('name' => "Tienne", 'variant' => ''),
                array('name' => "Istok Web", 'variant' => ':r,b,i,bi'),
                array('name' => "Yellowtail", 'variant' => ''),
                array('name' => "Pompiere", 'variant' => ''),
                array('name' => "Unna", 'variant' => ''),
                array('name' => "Rosario", 'variant' => ''),
                array('name' => "Leckerli One", 'variant' => ''),
                array('name' => "Snippet", 'variant' => ''),
                array('name' => "Ovo", 'variant' => ''),
                array('name' => "IM Fell English", 'variant' => ':r,i'),
                array('name' => "IM Fell English SC", 'variant' => ''),
                array('name' => "Gloria Hallelujah", 'variant' => ''),
                array('name' => "Kelly Slab", 'variant' => ''),
                array('name' => "Black Ops One", 'variant' => ''),
                array('name' => "Carme", 'variant' => ''),
                array('name' => "Aubrey", 'variant' => ''),
                array('name' => "Federo", 'variant' => ''),
                array('name' => "Delius", 'variant' => ''),
                array('name' => "Rochester", 'variant' => ''),
                array('name' => "Rationale", 'variant' => ''),
                array('name' => "Abel", 'variant' => ''),
                array('name' => "Marvel", 'variant' => ':r,b,i,bi'),
                array('name' => "Actor", 'variant' => ''),
                array('name' => "Delius Swash Caps", 'variant' => ''),
                array('name' => "Smokum", 'variant' => ''),
                array('name' => "Tulpen One", 'variant' => ''),
                array('name' => "Coustard", 'variant' => ':r,b'),
                array('name' => "Andika", 'variant' => ''),
                array('name' => "Alice", 'variant' => ''),
                array('name' => "Questrial", 'variant' => ''),
                array('name' => "Comfortaa", 'variant' => ':r,b'),
                array('name' => "Geostar", 'variant' => ''),
                array('name' => "Geostar Fill", 'variant' => ''),
                array('name' => "Volkhov", 'variant' => ''),
                array('name' => "Voltaire", 'variant' => ''),
                array('name' => "Montez", 'variant' => ''),
                array('name' => "Short Stack", 'variant' => ''),
                array('name' => "Vidaloka", 'variant' => ''),
                array('name' => "Aldrich", 'variant' => ''),
                array('name' => "Numans", 'variant' => ''),
                array('name' => "Days One", 'variant' => ''),
                array('name' => "Gentium Book Basic", 'variant' => ''),
                array('name' => "Monoton", 'variant' => ''),
                array('name' => "Alike", 'variant' => ''),
                array('name' => "Delius Unicase", 'variant' => ''),
                array('name' => "Abril Fatface", 'variant' => ''),
                array('name' => "Dorsa", 'variant' => ''),
                array('name' => "Antic", 'variant' => ''),
                array('name' => "Passero One", 'variant' => ''),
                array('name' => "Fanwood Text", 'variant' => ''),
                array('name' => "Prociono", 'variant' => ''),
                array('name' => "Merienda One", 'variant' => ''),
                array('name' => "Changa One", 'variant' => ''),
                array('name' => "Julee", 'variant' => ''),
                array('name' => "Prata", 'variant' => ''),
                array('name' => "Adamina", 'variant' => ''),
                array('name' => "Sorts Mill Goudy", 'variant' => ''),
                array('name' => "Terminal Dosis", 'variant' => ''),
                array('name' => "Sansita One", 'variant' => ''),
                array('name' => "Chivo", 'variant' => ''),
                array('name' => "Spinnaker", 'variant' => ''),
                array('name' => "Poller One", 'variant' => ''),
                array('name' => "Alike Angular", 'variant' => ''),
                array('name' => "Gochi Hand", 'variant' => ''),
                array('name' => "Poly", 'variant' => ''),
                array('name' => "Andada", 'variant' => ''),
                array('name' => "Federant", 'variant' => ''),
                array('name' => "Ubuntu Condensed", 'variant' => ''),
                array('name' => "Ubuntu Mono", 'variant' => ''),
                array('name' => "Sancreek", 'variant' => ''),
                array('name' => "Coda", 'variant' => ''),
                array('name' => "Rancho", 'variant' => ''),
                array('name' => "Satisfy", 'variant' => ''),
                array('name' => "Pinyon Script", 'variant' => ''),
                array('name' => "Vast Shadow", 'variant' => ''),
                array('name' => "Marck Script", 'variant' => ''),
                array('name' => "Salsa", 'variant' => ''),
                array('name' => "Amatic SC", 'variant' => ''),
                array('name' => "Quicksand", 'variant' => ''),
                array('name' => "Linden Hill", 'variant' => ''),
                array('name' => "Corben", 'variant' => ''),
                array('name' => "Creepster Caps", 'variant' => ''),
                array('name' => "Butcherman Caps", 'variant' => ''),
                array('name' => "Eater Caps", 'variant' => ''),
                array('name' => "Nosifer Caps", 'variant' => ''),
                array('name' => "Atomic Age", 'variant' => ''),
                array('name' => "Contrail One", 'variant' => ''),
                array('name' => "Jockey One", 'variant' => ''),
                array('name' => "Cabin Sketch", 'variant' => ':r,b'),
                array('name' => "Cabin Condensed", 'variant' => ':r,b'),
                array('name' => "Fjord One", 'variant' => ''),
                array('name' => "Rametto One", 'variant' => ''),
                array('name' => "Mate", 'variant' => ':r,i'),
                array('name' => "Mate SC", 'variant' => ''),
                array('name' => "Arapey", 'variant' => ':r,i'),
                array('name' => "Supermercado One", 'variant' => ''),
                array('name' => "Petrona", 'variant' => ''),
                array('name' => "Lancelot", 'variant' => ''),
                array('name' => "Convergence", 'variant' => ''),
                array('name' => "Cutive", 'variant' => ''),
                array('name' => "Karla", 'variant' => ':400,400italic,700,700italic'),
                array('name' => "Bitter", 'variant' => ':r,i,b'),
                array('name' => "Asap", 'variant' => ':400,700,400italic,700italic'),
                array('name' => "Bree Serif", 'variant' => '')
    );

    $font_count = 1;
    $font_output = '';
    $transh = 1;

    foreach ($google_fonts as $font) {
        $font_output .= $font['name'] . '' . $font['variant'] . '|';
        $font_count++;

        if ($font_count == 20) {
            tk_font_output_helper($font_output, 'google_font_' . $transh);
            $font_output = '';
            $font_count = 1;
            $transh++;
        }
    }
}

function tk_font_output_helper($output_font_string, $identifier) {
    wp_register_style($identifier, 'http://fonts.googleapis.com/css?family=' . $output_font_string);
    wp_enqueue_style($identifier);
}

add_action('wp_enqueue_scripts', 'tk_enqueue_google_fonts');

function tk_enqueue_google_fonts() {
    global $wpdb;

    $fonts = $wpdb->get_results("SELECT DISTINCT(option_value) FROM " . $wpdb->prefix . "options WHERE option_value LIKE 'tk_font_%'", ARRAY_A);
    $from_replaces = array('tk_font_', ' ');
    $to_replaces = array('', '+');
    $font_output = '';

    foreach ($fonts as $font) {
        $font_output .= str_replace($from_replaces, $to_replaces, $font['option_value']) . '|';
    }

    if(empty($font_output) || $font_output == 'Select|') {
        $font_output = 'Arvo';
    }
    
    wp_register_style('google_fonts', 'http://fonts.googleapis.com/css?family=' . $font_output);
    wp_enqueue_style('google_fonts');
}

function tk_get_font_name($font_option) {
    $font_name = str_replace('tk_font_', '', $font_option);
    $font_name = str_replace(substr(strrchr($font_name, ":"), 0), '', $font_name);
    return $font_name;
}

/* * ********************************************************** */
/* * **********GALLERY FANCYBOX FILTER*********************** */
/* * ********************************************************** */

add_filter('wp_get_attachment_link', 'add_lighbox_rel');

function add_lighbox_rel($attachment_link) {
    if (strpos($attachment_link, 'a href') != false) {
        $attachment_link = str_replace('a href', 'a class="fancybox" href', $attachment_link);
    }
    return $attachment_link;
}

/* * ********************************************************** */
/* * **********TWITTER SCRIPT******************************** */
/* * ********************************************************** */

    //gets twitter relative time
    function twitter_time($get_twitter_time) {

       $base = strtotime("now"); 
       //get timestamp when tweet created 
       $tweet_time = strtotime($get_twitter_time); 
       //get difference 
       $time_result = $base - $tweet_time; 
       //calculate different time values 
       $minute = 60;
       $hour = $minute * 60; 
       $day = $hour * 24; 
       $week = $day * 7; 
       if(is_numeric($time_result) && $time_result > 0) { 
       //if less then 3 seconds 
       if($time_result < 3) return "right now"; 
       //if less then minute 
       if($time_result < $minute) return floor($time_result) . " seconds ago"; 
       //if less then 2 minutes 
       if($time_result < $minute * 2) return "about 1 minute ago"; 
       //if less then hour 
       if($time_result < $hour) return floor($time_result / $minute) . " minutes ago"; 
       //if less then 2 hours 
       if($time_result < $hour * 2) return "about 1 hour ago"; 
       //if less then day
       if($time_result < $day) return floor($time_result / $hour) . " hours ago"; 
       //if more then day, but less then 2 days 
       if($time_result > $day && $time_result < $day * 2) return "yesterday"; 
       //if less then year 
       if($time_result < $day * 365) return floor($time_result / $day) . " days ago"; 
       //else return more than a year 
        return "over a year ago"; }      
       } 


function twitter_script($unique_id, $limit) {
    
require_once(dirname( __FILE__ ).'/script/twitter/TwitterAPIExchange.php');

/*GET TWITTER KEYS FROM ADMINISTRATION*/
$twitter_consumer_key = get_theme_option(tk_theme_name.'_social_twitter_consumer_key');
$twitter_consumer_secret = get_theme_option(tk_theme_name.'_social_twitter_consumer_secret');
$twitter_access_token = get_theme_option(tk_theme_name.'_social_twitter_access_token');
$twitter_token_secret = get_theme_option(tk_theme_name.'_social_twitter_token_secret');
$twitter_username = get_theme_option(tk_theme_name.'_social_twitter');


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => $twitter_access_token,
    'oauth_access_token_secret' => $twitter_token_secret,
    'consumer_key' => $twitter_consumer_key,
    'consumer_secret' => $twitter_consumer_secret
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$twitter_username;

if(!empty($unique_id)) {
    $getfield .= "&count=".$limit;
} else {
    $getfield .= "&count=1";
}

$requestMethod = 'GET';

/** Perform the request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
$twitter_results = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

if($unique_id !== 'home') { ?>
    <ul class="twitter_ul">
<?php } 

    foreach($twitter_results as $single_tweet) {        

        
        
//gets twitter content, time and name
$twitter_status = $single_tweet -> text;
$twitter_time = $single_tweet -> created_at;
$twitter_name = $single_tweet -> user -> screen_name;
        
$twitter_status = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\">\\2</a>", $twitter_status);
$twitter_status = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\">\\2</a>", $twitter_status);
$twitter_status = preg_replace("/@(\w+)/", "<a href=\"http://twitter.com/\\1\">@\\1</a>", $twitter_status);
$twitter_status = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $twitter_status);
        
        //checks if it's single tweet on home or twitter widget
        if($unique_id == 'home'){    
    ?>
                        
    <div class="home-twitter left">
        <div class="home-twitter-content">
            <img src="<?php echo get_template_directory_uri() ?>/style/img/twitter-home.png" alt="img" title="img" />
            <div class="home-twitter-text right">
                    <span><?php echo $twitter_status; ?></span>
                    <p><?php echo '@' . $twitter_name; ?></p>
            </div><!--/home-twitter-text-->
        </div><!--/home-twitter-content-->
    </div><!--/home-twitter-->       
            
    <?php 
    //use this if it's twitter widget
        } else { ?>    
            <li><div class="box-twitter-center left"><span><?php echo $twitter_status; ?></span></div><span class="twitter-links"><?php echo twitter_time($twitter_time); ?></span></li>     
    <?php }//$unique_id == 'home' ?>      
<?php } ?>
    
<?php if($unique_id !== 'home') { ?>
    </ul>
<?php } ?>    
                        
<?php
}

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if (empty($first_img)) { //Defines a default image
        $first_img = "/images/default.jpg";
    }
    return $first_img;
}

add_action('init', 'tk_check_for_banner_redirection', 0); //Awaiting for banner click redirections
add_action('init', 'tk_check_for_banner_stats', 0);

function tk_check_for_banner_stats() {
    global $wpdb;

    if (isset($_GET['banner_stat_id'])) {
        $banner_id = $_GET['banner_stat_id'];
        $period = $_GET['period'];
        $today = date("Y-m-d");
        $date = '';
        if ($period == 0) {
            $date = '2011-01-01';
        }

        if ($period == 7) {

            $date = strtotime(date("Y", strtotime($today)) . " -7 days");
            $date = date('Y-m-d', $date);
        }
        if ($period == 30) {
            $date = strtotime(date("Y", strtotime($today)) . " -30 days");
            $date = date('Y-m-d', $date);
        }
        if ($period == 365) {
            $date = strtotime(date("Y", strtotime($today)) . " -365 days");
            $date = date('Y-m-d', $date);
        }

        $pageposts = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "banner_stats WHERE banner_id = %d AND date BETWEEN '" . $date . "' AND '" . $today . "' ORDER BY date ASC", $banner_id), OBJECT);
        $views = '';
        $clicks = '';

        if (isset($_GET['data_type']) and $_GET['data_type'] == 'views') {
            foreach ($pageposts as $post) {
                $views .= "[" . (strtotime($post->date) * 1000) . "," . $post->views . "],";
            }
            $views = str_replace('],]', ']]', '[' . $views . ']');
            echo $views;
        }

        if (isset($_GET['data_type']) and $_GET['data_type'] == 'clicks') {
            foreach ($pageposts as $post) {
                $clicks .= "[" . (strtotime($post->date) * 1000) . "," . $post->clicks . "],";
            }
            $clicks = str_replace('],]', ']]', '[' . $clicks . ']');
            echo $clicks;
        }

        exit;
    }
}

function tk_check_for_banner_redirection() {//Save click for the banner and redirect to the banner URL
    if (isset($_GET['banner_id'])) {
        global $wpdb;
        tk_add_banner_click($_GET['banner_id']);
    }
}

function tk_add_banner_view($banner_id) {
    global $wpdb;
    global $post;
    if (!is_admin()) {
        $todays_date = date('Y-m-d');
        $insert_query = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "banner_stats SET views = (views + 1) WHERE banner_id = %d AND date = '" . $todays_date . "'", $banner_id));
        if (!$insert_query) {
            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "banner_stats (banner_id, date, clicks, views) VALUES(%d, '" . $todays_date . "', 0, 1)", $banner_id));
        }
    }
}

function tk_add_banner_click($banner_id) {
    global $wpdb;
    $todays_date = date('Y-m-d');
    $insert_query = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "banner_stats SET clicks = (clicks + 1) WHERE banner_id = %d AND date = '" . $todays_date . "'", $banner_id));
    if (!$insert_query) {
        $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "banner_stats (banner_id, date, clicks, views) VALUES(%d, '" . $todays_date . "', 1, 0)", $banner_id));
    }
    wp_redirect(get_post_meta($banner_id, 'tk_advertisement_link', true));
    exit;
}

/* * ********************************************************** */
/* * ****COLOR CHANGER FOR SERVICES POSTS************* */
/* * ********************************************************** */

function service_color() {
    $prefix = 'tk_';
    global $wpdb;
    $services_posts = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'services' AND post_status = 'publish'");
//var_dump($services_posts);

    foreach ($services_posts as $one_post) {

        $tk_background_color = get_post_meta($one_post->ID, $prefix . 'background_color', true);
        $tk_headline_color = get_post_meta($one_post->ID, $prefix . 'headline_color', true);
        $tk_text_color = get_post_meta($one_post->ID, $prefix . 'text_color', true);
        $tk_hover_color = get_post_meta($one_post->ID, $prefix . 'hover_color', true);
        $subheadline_color = get_post_meta($one_post->ID, $prefix . 'sub_headline_color', true);
        $subheading = get_post_meta($one_post->ID, $prefix . 'sub_headline_color', true);
        ?>


        <style type="text/css">
            .services-template .home-services-one<?php echo $one_post->ID; ?>,  .bg-services-single<?php echo $one_post->ID; ?>, .home .home-services-one<?php echo $one_post->ID; ?> {
                background-color:#<?php echo $tk_background_color; ?>;
            }

            .home-services-one<?php echo $one_post->ID; ?> .home-services-one-image-title span a, .bg-services-single<?php echo $one_post->ID; ?> .bg-services-single-text span {
                color:#<?php echo $tk_headline_color; ?>;
            }

            .home-services-one<?php echo $one_post->ID; ?> .home-services-one-image-text p, .home-services-one<?php echo $one_post->ID; ?> .home-services-one-image-link a {
                color:#<?php echo $tk_text_color; ?>;
            }

            .home-services-one<?php echo $one_post->ID; ?> .home-services-one-image-link a:hover {
                color:#<?php echo $tk_hover_color; ?>;
            }

            .home-services-one<?php echo $one_post->ID; ?> .ca-sub, .home-services-one<?php echo $one_post->ID; ?> p, .bg-services-single<?php echo $one_post->ID; ?> ul li p  {
                color:#<?php echo $subheading; ?>;
            }


        </style>

        <?php
    } //service_post
}

//service_color

add_action('wp_footer', 'service_color');


require_once ( ABSPATH . 'wp-content/themes/' . tk_theme_name . '/inc/theme-style.php');

//Registers Revolution Slider Plugin
require_once dirname( __FILE__ ) . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'register_slider_plugin' );
function register_slider_plugin() {

	
	$plugins = array(
		
		array(
			'name'     				=> 'Revolutions Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = tk_theme_name();

	$config = array(
		'domain'       		=> tk_theme_name(),         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', tk_theme_name() ),
			'menu_title'                       			=> __( 'Install Plugins', tk_theme_name() ),
			'installing'                       			=> __( 'Installing Plugin: %s', tk_theme_name() ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', tk_theme_name() ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', tk_theme_name() ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', tk_theme_name() ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', tk_theme_name() ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}

?>