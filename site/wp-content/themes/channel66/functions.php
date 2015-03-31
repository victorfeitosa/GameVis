<?php
global $wpdb;

require(  get_template_directory() . '/inc/theme-settings.php');                //Building theme administration

require(  get_template_directory() . '/inc/meta-boxes.php');                    //Building meta boxes

require(  get_template_directory() . '/inc/post-types.php');                    //Building post types

require(  get_template_directory() . '/inc/custom-taxonomies.php');             //Building post types

function tk_theme_name(){
    return 'channel66';
}
define( 'tk_theme_name', 'channel66' );
update_option('tk_theme_name', tk_theme_name);

$lang = get_template_directory() . '/languages/';                               //Make this theme available for translation.
load_theme_textdomain(tk_theme_name, $lang);

add_theme_support( 'automatic-feed-links' );                                    //Add default posts and comments RSS feed links to <head>

add_theme_support( 'post-thumbnails' );                                         //This enables Post Thumbnails support for this theme.
        add_image_size( 'large-image', 715 , 462 , true );
        add_image_size( 'medium-image', 245 , 245 , true );
        add_image_size( 'portfolio', 240 , 240 , true );
        add_image_size( 'small-image', 79 , 79 , true );

register_nav_menu( 'primary', __( 'Primary Menu', tk_theme_name ) );                //This theme uses wp_nav_menu()

//THEME NAME
$tk_theme_name = tk_theme_name;

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

if ( version_compare( $wp_version, '3.4', '>=' ) ) {add_theme_support( 'custom-background' );}else{add_custom_background();}


        /*************************************************************/
        /************VIEW COUNTER**********************************/
        /*************************************************************/

            add_filter('manage_posts_columns', 'posts_columns'); //Filter defining new columns
            add_action('manage_posts_custom_column', 'posts_custom_columns', 1, 2); //Action for adding new columns

            function posts_columns($defaults) {
                $defaults['post_stats'] = __('Views', tk_theme_name); // Create a new column called 'Visits'
                return $defaults;
            }

            // Populate the new column with the Visits
            function posts_custom_columns($column_name, $id) {
                if ($column_name === 'post_stats') {
                    $current_stats = get_post_meta($id, 'post_stats', true); //get visit count from database
                    echo (int) $current_stats;
                }
            }

            function set_post_stats() {
                $post_id = get_the_ID(); //get current post id
                if (is_single($post_id)) {//is it post? Otherwise, we don't need to track visits
                    $current_stats = get_post_meta($post_id, 'post_stats', true); //get current visit stats for the post
                    if (!isset($current_stats)) {//this is first visit to this post
                        add_post_meta($post_id, 'post_stats', 1, true); //add first fisit to database
                    } else {
                        update_post_meta($post_id, 'post_stats', $current_stats + 1); //increment number of visits
                    }
                }
            }
            add_action('wp_head', 'set_post_stats', 1000);



        /*************************************************************/
        /************LOAD WIDGETS**********************************/
        /*************************************************************/

	require_once (TEMPLATEPATH . '/inc/widgets/widget-twitter.php');
	require_once (TEMPLATEPATH . '/inc/widgets/widget-newsletter.php');
        require_once (TEMPLATEPATH . '/inc/widgets/widget-share.php');



        /*************************************************************/
        /************INCREASE IMAGE QUALITY***********************/
        /************************************************************/

            function jpeg_quality_callback($arg)
            {
            return (int)100;
            }

            add_filter('jpeg_quality', 'jpeg_quality_callback');



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

                    <div id="sidebar" class="left">
                           <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Default/Home')) : ?>
                            <?php endif; ?>
                    </div>

               <?php } else { ?>

                    <div id="sidebar" class="left">
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

            <div id="sidebar" class="right">
                   <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Default/Home')) : ?>
                    <?php endif; ?>
            </div><!--/#sidebar-->

               <?php } else { ?>

            <div id="sidebar" class="right">
                   <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                   <?php endif; ?>
            </div><!--/#sidebar-->
            <?php }
             }
        }



        /*************************************************************/
        /************REGISTERING SIDEBARS**************************/
        /************************************************************/

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Sidebar Default/Home',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}


        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Blog',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}


        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Page Template',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}


        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Portfolio Template',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Archive/Search',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Contact',
						'before_widget' => '<div class="sidebar_widget_holder %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget"><h3>',
						'after_title'   => '</h3></div>' )
						);
	}

        if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 1',
						'before_widget' => '<div class="footer-box-down footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget left"><h2>',
						'after_title'   => '</h2></div>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 2',
						'before_widget' => '<div class="footer-box-down footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget left"><h2>',
						'after_title'   => '</h2></div>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 3',
						'before_widget' => '<div class="footer-box-down footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget left"><h2>',
						'after_title'   => '</h2></div>' )
						);
	}

        	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 4',
						'before_widget' => '<div class="footer-box-down footer_box %s">',
						'after_widget'  => '</div>',
						'before_title'  => '<div class="border-title-widget left"><h2>',
						'after_title'   => '</h2></div>' )
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


require_once (  ABSPATH.'wp-content/themes/'.tk_theme_name.'/inc/shortcodes/tinymce_loader.php');

function enable_more_buttons($buttons) {
  $buttons[] = 'hr';
  return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

function shortcode_one_half( $atts, $content = null ) {
    	extract(shortcode_atts(array(
		'position'     	 => '',
    ), $atts));

   return '<div class="one-half '.$position.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_half', 'shortcode_one_half');

function shortcode_one_third( $atts, $content = null ) {
    	extract(shortcode_atts(array(
		'position'     	 => '',
    ), $atts));
        
   return '<div class="one-third '.$position.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_third', 'shortcode_one_third');

function shortcode_one_fourth( $atts, $content = null ) {
    	extract(shortcode_atts(array(
		'position'     	 => '',
    ), $atts));
        
   return '<div class="one-fourth '.$position.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('one_fourth', 'shortcode_one_fourth');


function shortcode_button( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'url'     	 => '#',
		'style'   => 'black',
    ), $atts));

   return '<div class="color-buttons color-button-'.$style.' left"><a href="'.$url.'">' . do_shortcode($content) . '</a></div>';
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
        
if(!empty($single_tweet -> text)){
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
            <li><div class="bg-widget-center left"><span class="twitt"></span><span><?php echo $twitter_status; ?></span></div><p class="twitter-links"><?php echo twitter_time($twitter_time); ?></p></li>
    <?php }//$unique_id == 'home' ?>      

<?php } //single_tweet->text

     }//uniquer_id              
 if($unique_id !== 'home') {?>
    </ul>
    <?php }    

} //twitter_script

  function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];
  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}

 ?>