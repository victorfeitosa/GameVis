<?php
global $wpdb;

require(  get_template_directory() . '/inc/theme-settings.php');                //Building theme administration

require(  get_template_directory() . '/inc/meta-boxes.php');                    //Building meta boxes

require(  get_template_directory() . '/inc/post-types.php');                    //Building post types

require(  get_template_directory() . '/inc/custom-taxonomies.php');             //Building post types

function tk_theme_name(){
    $theme = wp_get_theme();  
    return $theme->name;
}
define( 'tk_theme_name', tk_theme_name());
update_option('tk_theme_name', tk_theme_name);

$lang = get_template_directory() . '/languages/';                               //Make this theme available for translation.
load_theme_textdomain('Themetick', $lang);

add_theme_support( 'automatic-feed-links' );                                    //Add default posts and comments RSS feed links to <head>

add_theme_support( 'post-thumbnails' );                                         //This enables Post Thumbnails support for this theme.
        add_image_size( 'slider', 979, 9999);
        add_image_size( 'home_speaker', 180 , 152 , true );
        add_image_size( 'blog', 560 , 302 , true );
        add_image_size( 'speaker', 210 , 154 , true );
        add_image_size( 'sponsor', 161 , 119 , true );
        add_image_size( 'single', 648, 330, true );
        add_image_size( 'singlespeaker', 299, 222, true );
        add_image_size( 'partners', 210, 154, true );
        add_image_size( 'fullslider', 822, 360, true );

register_nav_menu( 'primary', __( 'Primary Menu', 'Themetick' ) );                //This theme uses wp_nav_menu()

//THEME NAME
$tk_theme_name = 'Themetick';

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


        /*************************************************************/
        /************LOAD WIDGETS**********************************/
        /*************************************************************/

	require_once (TEMPLATEPATH . '/inc/widgets/widget-twitter.php');
	require_once (TEMPLATEPATH . '/inc/widgets/widget-newsletter.php');






        /*************************************************************/
        /************INCREASE IMAGE QUALITY***********************/
        /************************************************************/

            function jpeg_quality_callback($arg)
            {
            return (int)100;
            }

            add_filter('jpeg_quality', 'jpeg_quality_callback');


            

        /*************************************************************/
        /************INCLUDE POST TYPE IN ARCHIVE*****************/
        /************************************************************/

        function add_custom_types( $query ) {
          if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
            $query->set( 'post_type', array(
             'post', 'pt_portfolio', 'nav_menu_item'
                        ));
                  return $query;
                }
        }
        add_filter( 'pre_get_posts', 'add_custom_types' );



        /*************************************************************/
        /************GET URL OF CURENT PAGE**********************/
        /************************************************************/

function get_page_url(){

	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"])) {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;

}

        /*************************************************************/
        /************CHOSE SIDEBAR POSITION************************/
        /************************************************************/

        function tk_get_left_sidebar($sidebar_position, $sidebar_name) {

            $sidebar_option = get_theme_option(tk_theme_name.'_general_custom_sidebars');
           
            if($sidebar_position == 'Left'){
                if($sidebar_option !== 'yes') { ?>

                    <div id="sidebar" class="left" style="margin-right: 30px">

                           <?php  if(function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Default')) : ?>
                            <?php endif; ?>
                    </div>

               <?php } else {  ?>

                    <div id="sidebar" class="left" style="margin-right: 30px">
                           <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                           <?php endif; ?>
                    </div>

            <?php }
            }
        }


        
        function tk_get_right_sidebar($sidebar_position, $sidebar_name) {

            $sidebar_option = get_theme_option(tk_theme_name.'_general_custom_sidebars');
            if($sidebar_position == 'Right'){?>
            <?php
                $sidebar_option = get_theme_option(tk_theme_name.'_general_custom_sidebars');
                if($sidebar_option !== 'yes') { ?>

            <div id="sidebar" class="left" style="margin-left: 30px">
                   <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Default')) : ?>
                    <?php endif; ?>
            </div><!--/#sidebar-->

               <?php } else { ?>

            <div id="sidebar" class="left" style="margin-left: 30px">
                   <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                   <?php endif; ?>
            </div><!--/#sidebar-->
            <?php }
             }
        }


        
        /*************************************************************/
        /************SAVE ID AND TITLE OF PAGE TEMPLATES*********/
        /************************************************************/

   add_action ( 'publish_page', 'saveBlogId' );

        function saveBlogId($post_ID) {
            global $wp_query;
            $template_title =  get_the_title($post_ID);
            $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
            if($template_name == "_blog.php") {
                update_option('id_blog_page',$post_ID);
                update_option('title_blog_page',$template_title);
            }

            $oldtemplate = get_option('id_blog_page');
            if($post_ID == $oldtemplate) {
                if($template_name <> "_blog.php") {
                    update_option('id_blog_page','');
                }
            }
        }

   add_action ( 'publish_page', 'saveProgram' );

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

   add_action ( 'publish_page', 'saveSpeaker' );

        function saveSpeaker($post_ID) {
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

           add_action ( 'publish_page', 'savePartner' );

        function savePartner($post_ID) {
            global $wp_query;
            $template_title =  get_the_title($post_ID);
            $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
            if($template_name == "_partners.php") {
                update_option('id_partners_page',$post_ID);
                update_option('title_partners_page',$template_title);
            }

            $oldtemplate = get_option('id_partners_page');
            if($post_ID == $oldtemplate) {
                if($template_name <> "_partners.php") {
                    update_option('id_partners_page','');
                }
            }
        }


        /*************************************************************/
        /************REGISTERING SIDEBARS**************************/
        /************************************************************/

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Sidebar Default',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}


        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Blog',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}


        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Page Template',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}


        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Program Template',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Speakers Single Page',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Archive/Search',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Contact',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="bg-widget-title"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 1',
						'before_widget' => '<div class="footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2>',
						'after_title'   => '</h2>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 2',
						'before_widget' => '<div class="footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2>',
						'after_title'   => '</h2>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 3',
						'before_widget' => '<div class="footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2>',
						'after_title'   => '</h2>' )
						);
	}




        
        /*************************************************************/
        /************MAINTENANCE MODE****************************/
        /*************************************************************/

$options = get_option('maintenance_mode_maintenance');


if ( $options[0] == 'on' ) { add_action('get_header', 'activate_maintenance_mode'); }

function activate_maintenance_mode() {                                          //Maintenance mode

    if ( !(current_user_can( 'administrator' ) ||  current_user_can( 'super admin' ))) {

        wp_die('<h1>Website Under Maintenance</h1><p>Hi, our Website is currently undergoing scheduled maintenance.
        Please check back very soon.<br /><strong>Sorry for the inconvenience!</strong></p>', 'Maintenance Mode');
    }
}




        /*************************************************************/
        /************LOAD SHORTCODES******************************/
        /*************************************************************/


require_once (  ABSPATH.'wp-content/themes/Themetick/inc/shortcodes/tinymce_loader.php');

function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

function shortcode_one_half( $atts, $content = null ) {
    	extract(shortcode_atts(array(
		'position'     	 => '',
    ), $atts));

   return '<div class="onehalf '.$position.'"><div class="cell_text">'. do_shortcode($content) .'</div></div>';
}

add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_third( $atts, $content = null ) {
    	extract(shortcode_atts(array(
		'position'     	 => '',
    ), $atts));
        
   return '<div class="one-third '.$position.'"><div class="cell_text">'. do_shortcode($content).'</div></div>';
}

add_shortcode('one_third', 'shortcode_one_third');

function shortcode_one_fourth( $atts, $content = null ) {
    	extract(shortcode_atts(array(
		'position'     	 => '',
    ), $atts));
        
   return '<div class="one-fourth '.$position.'"><div class="cell_text">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('one_fourth', 'shortcode_one_fourth');


function shortcode_button( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'url'     	 => '#',
		'style'   => 'black',
    ), $atts));

   return '<a href="'.$url.'"><div class="color-buttons left"><div class="'.$style.'"><div class="'.$style.'-left left"></div><div class="'.$style.'-center left">' . do_shortcode($content) . '</div><div class="'.$style.'-right left"></div></div></div></a>';
}

add_shortcode('button', 'shortcode_button');


function shortcode_list( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'style'   => '1'
    ), $atts));

   return '<ul><li class="'.$style.'">' . do_shortcode($content) . '</li></ul>';
}

add_shortcode('list', 'shortcode_list');


        /*************************************************************/
        /************TWITTER SCRIPT*********************************/
        /*************************************************************/


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
            function tk_get_thumb_new($width, $height, $src)
            {
                if(strpos($src, '.jpg')){
                    $new_src = explode('.jpg', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.jpg';
                            /*
                             * THIS STILL NEEDS TO BE TESTED!!!!
                            if(@fopen($new_src, 'r')){
                                echo $new_src;
                            }else{
                                echo $src;
                            }
                            */
                        return $new_src;
                }elseif(strpos($src, '.jpeg')){
                    $new_src = explode('.jpeg', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.jpeg';
                    return $new_src;
                }elseif(strpos($src, '.gif')){
                    $new_src = explode('.gif', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.gif';
                    return $new_src;
                }elseif(strpos($src, '.png')){
                    $new_src = explode('.png', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.png';
                    return $new_src;
                }
            }


        /*************************************************************/
        /************EXCERPT LENGTH*******************************/
        /************************************************************/

            function the_excerpt_length($charlength) {
                    $excerpt = get_the_excerpt();
                    $charlength++;

                    if ( mb_strlen( $excerpt ) > $charlength ) {
                            $subex = mb_substr( $excerpt, 0, $charlength - 5 );
                            $exwords = explode( ' ', $subex );
                            $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
                            if ( $excut < 0 ) {
                                    echo mb_substr( $subex, 0, $excut );
                            } else {
                                    echo $subex;
                            }
                            echo '...';
                    } else {
                            echo $excerpt;
                    }
            }

        
        /*************************************************************/
        /************GET SERVER TIME*******************************/
        /*************************************************************/
        
    add_action('init', 'getServerTime', 1);

    function getServerTime() {
        if (isset($_GET['getServerTime'])) {
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Fri, 1 Jan 2010 00:00:00 GMT");
            header("Content-Type: text/plain; charset=utf-8");
            $now = current_time('timestamp', false);
            $now_date = date("M j, Y H:i(worry) O", $now);
            echo $now_date . "\n";
            exit;
        }
    }

 ?>