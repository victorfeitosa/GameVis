<?php
global $wpdb;

require(  get_template_directory() . '/inc/theme-settings.php');                //Building theme administration

require(  get_template_directory() . '/inc/meta-boxes.php');                    //Building meta boxes

require(  get_template_directory() . '/inc/post-types.php');                    //Building post types

require(  get_template_directory() . '/inc/custom-taxonomies.php');             //Building post types

function tk_theme_name(){
    return 'radioos';
}
define( 'tk_theme_name', 'radioos' );
update_option('tk_theme_name', tk_theme_name);

$lang = get_template_directory() . '/languages/';                               //Make this theme available for translation.
load_theme_textdomain(tk_theme_name, $lang);

add_theme_support( 'automatic-feed-links' );                                    //Add default posts and comments RSS feed links to <head>

add_theme_support( 'post-thumbnails' );                                         //This enables Post Thumbnails support for this theme.
        add_image_size( 'project', 270 , 352 , true );
        add_image_size( 'single', 260 , 9999);

register_nav_menu( 'primary', __( 'Primary Menu', tk_theme_name ) );                //This theme uses wp_nav_menu()

//THEME NAME
$tk_theme_name = tk_theme_name;

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

        /*************************************************************/
        /************LOAD STYLES************************************/
        /*************************************************************/

        function tk_add_stylesheet() {
                wp_register_style('main_style', get_bloginfo('stylesheet_url'));
                wp_enqueue_style('main_style');
                wp_register_style('superfish', get_template_directory_uri().'/script/menu/superfish.css');
                wp_enqueue_style('superfish');
                wp_register_style('pirobox', get_template_directory_uri().'/script/pirobox/css/demo5/style.css');
                wp_enqueue_style('pirobox');
                wp_register_style('scroll-button', get_template_directory_uri().'/script/scroll-button/scroll-button.css');
                wp_enqueue_style('scroll-button');

                $browser = $_SERVER['HTTP_USER_AGENT'];

                if (strpos($browser, 'MSIE 8.0')) {
                    wp_register_style('ie8', get_template_directory_uri().'/style/ie8.css');
                    wp_enqueue_style('ie8');
                    wp_enqueue_script('ierespond', get_template_directory_uri().'/script/respond/respond.src.js' );
                }

                if (strpos($browser, 'MSIE 9.0')) {
                    wp_register_style('ie9', get_template_directory_uri().'/style/ie9.css');
                    wp_enqueue_style('ie9');
                }

                if (strpos($browser, 'Chrome')) {
                }

                if (strpos($browser, 'pera')) {
                    wp_register_style('opera', get_template_directory_uri().'/style/opera.css');
                    wp_enqueue_style('opera');
                }
            }
        add_action( 'wp_enqueue_scripts', 'tk_add_stylesheet' );



        /*************************************************************/
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/
        
        function tk_add_scripts() {
                wp_enqueue_script('jquery');
                wp_enqueue_script('superfish', get_template_directory_uri().'/script/menu/superfish.js' );
                wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js' );
                wp_enqueue_script('pirobox', get_template_directory_uri().'/script/pirobox/js/pirobox.js' );
                wp_enqueue_script('contact', get_template_directory_uri().'/script/contact/contact.js' );
                wp_enqueue_script('easing', get_template_directory_uri().'/script/easing/jquery.easing.1.3.js' );
                wp_enqueue_script('elastic', get_template_directory_uri().'/script/elastic/jquery.elastic.source.js' );
                wp_enqueue_script('jscolor', get_template_directory_uri().'/script/jscolor/jscolor.js' );
                wp_enqueue_script('scroll-button', get_template_directory_uri().'/script/scroll-button/scroll-button.js' );
                wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.min.js' );
                wp_enqueue_script('spiner', get_template_directory_uri().'/script/spiner/spin.min.js' );

                if ( is_singular() ) wp_enqueue_script( 'comment-reply' );   
        }  
        add_action('wp_enqueue_scripts', 'tk_add_scripts');          
                        
                        
                        
                        
        /*************************************************************/
        /************VIDEO PLAYER***********************************/
        /*************************************************************/

        function tk_video_player($url) {

		if(!empty($url)){
		$key_str1='youtube';
		$key_str2='vimeo';

		$pos_youtube = strpos($url, $key_str1);
		$pos_vimeo = strpos($url, $key_str2);
			if (!empty($pos_youtube)) {
			$url = str_replace('watch?v=','',$url);
			$url = explode('&',$url);
			$url = $url[0];
			$url = str_replace('http://www.youtube.com/','',$url);
		?>
			<div class="holder">
                                                        <iframe src="http://www.youtube.com/embed/<?php echo $url;?>?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
		<?php  }
		if (!empty($pos_vimeo)) {
			$url = explode('.com/',$url);
		?>

		<div class="holder">
                                    <iframe src="http://player.vimeo.com/video/<?php echo $url[1];?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<?php  }
		if (empty($pos_vimeo) && empty($pos_youtube)) {

		  echo "Video only allowes vimeo and youtube!";
		}

   }}

   
   
        /*************************************************************/
        /************GET VIDEO IMAGE***********************************/
        /*************************************************************/

   
        function get_video_image($url) {

		if(!empty($url)){
		$key_str1='youtube';
		$key_str2='vimeo';

		$pos_youtube = strpos($url, $key_str1);
		$pos_vimeo = strpos($url, $key_str2);
                                if (!empty($pos_youtube)) {
			$url = str_replace('watch?v=','',$url);
			$url = explode('&',$url);
			$url = $url[0];
			$url = str_replace('http://www.youtube.com/','',$url);
		?>
                                    <img src="http://img.youtube.com/vi/<?php echo $url;?>/0.jpg" title="naslov" alt="nesto" />
		<?php  }
		if (!empty($pos_vimeo)) {
                                    $url = explode('.com/',$url);
                                    $data = @file_get_contents("http://vimeo.com/api/v2/video/".$url[1].".json");
                        if($data){
                                    $data = file_get_contents("http://vimeo.com/api/v2/video/".$url[1].".json");
                        }else{
                            curl_setopt($ch=curl_init(), CURLOPT_URL, "http://vimeo.com/api/v2/video/".$url[1].".json");
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            $data = $response;
                        }
                                    $data = json_decode($data); 
                                    
                                    ?>
                                    <img src="<?php echo $data[0]->thumbnail_medium;?>" title="naslov" alt="nesto" />
		  <?php }
		if (empty($pos_vimeo) && empty($pos_youtube)) {

		  echo "Video only allowes vimeo and youtube!";
		}
        }}
   
      
        /*************************************************************/
        /************GET CUSTOM THUMB SIZE***********************/
        /************************************************************/

            /*
             * $height -> height of new image
             * $width -> width of new image
             * $src -> url of image you want to get thumb from
             */
            function tk_get_thumb($width, $height, $src)
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
                        echo $new_src;
                }elseif(strpos($src, '.jpeg')){
                    $new_src = explode('.jpeg', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.jpeg';
                    echo $new_src;
                }elseif(strpos($src, '.gif')){
                    $new_src = explode('.gif', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.gif';
                    echo $new_src;
                }elseif(strpos($src, '.png')){
                    $new_src = explode('.png', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.png';
                    echo $new_src;
                }
            }

            
            
        /*************************************************************/
        /************GET CUSTOM THUMB SIZE v2*********************/
        /************************************************************/  
            
            
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

            function add_twitter_contactmethod( $contactmethods ) {
                    // Add Twitter
                    $contactmethods['twitter'] = 'Twitter';
                    $contactmethods['facebook'] = 'Facebook';
                    $contactmethods['linkedin'] = 'Linkedin';
                    $contactmethods['google'] = 'Google+';
                    $contactmethods['rss'] = 'Author RSS';

                    // Remove Yahoo IM
                    unset($contactmethods['yim']);
                    unset($contactmethods['aim']);
                    unset($contactmethods['jabber']);

                    return $contactmethods;
            }
            add_filter('user_contactmethods','add_twitter_contactmethod',10,1);

            
                        
        /*************************************************************/
        /************GET POSTS WITH AJAX***************************/
        /*************************************************************/

        add_action('init', 'tk_get_posts', 1);
        
        function tk_get_posts(){
            
            if(isset($_POST['tk_paged'])) {
                
            ?>
                <?php 
                        $cat_array = explode(',', $_POST['cat']);
                        $new_args=array('tax_query' => array(array('taxonomy' => 'ct_projects','field' => 'term_id', 'terms' => $cat_array)), 'post_type' => 'projects', 'post_status' => 'publish', 'paged' => $_POST['tk_paged'], 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1);
                        //The Query
                        query_posts($new_args);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                    <div class="home-portfolio-one left">
                        <?php if (has_post_thumbnail()) { ?>
                            <?php the_post_thumbnail('project') ?>
                        <?php } ?>
                        <div class="home-portfolio-hover">                        
                            <div class="project-hider">
                                <div class="home-portfolio-title left"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></div><!--/home-portfolio-title--> 
                                <div class="home-portfolio-text left"><?php the_excerpt() ?></div><!--/home-portfolio-text--> 
                            </div>
                            <div class="home-portfolio-link left"><a href="<?php echo the_permalink() ?>"></a></div><!--/home-portfolio-link--> 
                        </div><!--/home-portfolio-one--> 
                    </div><!--/home-portfolio-one-->
                <?php endwhile; ?>
                <?php else: ?>
                <?php endif; get_template_part( 'inc/postformats/loadmore' );?>        
            <?php exit();
            }
            
            if(isset($_POST['homepaged'])) {
            ?>
                <?php 
                        $new_args=array( 'post_type' => 'projects', 'post_status' => 'publish', 'paged' => $_POST['homepaged'], 'posts_per_page' => 5, 'ignore_sticky_posts'=> 1);
                        //The Query
                        query_posts($new_args);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                    <div class="home-portfolio-one left">
                        <?php if (has_post_thumbnail()) { ?>
                            <?php the_post_thumbnail('project') ?>
                        <?php } ?>
                        <div class="home-portfolio-hover">                        
                            <div class="project-hider">
                                <div class="home-portfolio-title left"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></div><!--/home-portfolio-title--> 
                                <div class="home-portfolio-text left"><?php the_excerpt() ?></div><!--/home-portfolio-text--> 
                            </div>
                            <div class="home-portfolio-link left"><a href="<?php echo the_permalink() ?>"></a></div><!--/home-portfolio-link--> 
                        </div><!--/home-portfolio-one--> 
                    </div><!--/home-portfolio-one-->
                <?php endwhile; ?>
                <?php else: ?>
                <?php endif; get_template_part( 'inc/postformats/home-loadmore' );?>        
            <?php exit();
            }
         
        }

            
            
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
        /************REMOVE IMAGE SIZE*****************************/
        /************************************************************/

            add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
             add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
             // Removes attached image sizes as well
             add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
             function remove_thumbnail_dimensions( $html ) {
             $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
             return $html;
             }

            
            
        /*************************************************************/
        /************IMAGE WITHOUT DIMENSIONS********************/
        /************************************************************/

            function tk_thumbnail($post_id, $img_size) {
                    $thumbnail = get_the_post_thumbnail($post_id, $img_size);
                    $thumbnail = preg_replace( '/(width|height)=\"\d*\"\s/', "", $thumbnail );
                    echo $thumbnail;
            }

            
        /*************************************************************/
        /************EXCERPT LENGTH*******************************/
        /************************************************************/

            function the_excerpt_length($charlength) {
                    $excerpt = get_the_excerpt();
                    $charlength++;

                    if ( strlen( $excerpt ) > $charlength ) {
                            $subex = substr( $excerpt, 0, $charlength - 5 );
                            $exwords = explode( ' ', $subex );
                            $excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
                            if ( $excut < 0 ) {
                                    echo substr( $subex, 0, $excut );
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
						'name'          => 'Footer Widget 1',
						'before_widget' => '<div class="widget-holder">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2>',
						'after_title'   => '</h2>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 2',
						'before_widget' => '<div class="widget-holder">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2>',
						'after_title'   => '</h2>' )
						);
	}

	if(function_exists('register_sidebar')){
		register_sidebar(array(
						'name'          => 'Footer Widget 3',
						'before_widget' => '<div class="widget-holder">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2>',
						'after_title'   => '</h2>' )
						);
	}

        
        
        /*************************************************************/
        /************SET DEFAULTS*********************************/
        /*************************************************************/
        if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
            update_option('radioos_colors_body_bg_img', get_template_directory_uri().'/style/img/bg-body.jpg');
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

           return '<ul style="list-style:none;padding-left:0px"><li class="'.$style.'">' . do_shortcode($content) . '</li></ul>';
        }

        add_shortcode('list', 'shortcode_list');



        /*************************************************************/
        /************BREADCRUMBS***********************************/
        /*************************************************************/



   function dimox_breadcrumbs() {

  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<li class="current">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '  <div class="breadcrumbs-content"><ul><li style="background: none; padding: 0;">You are here: </li>';

    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ';

    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo '<li>'.get_category_parents($cat, TRUE, '</li> ');
        echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', tk_theme_name ) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ul></div>';

  }
} // end dimox_breadcrumbs()



        /*************************************************************/
        /************SAVE TEMPLATE  ID AND NAME*******************/
        /*************************************************************/

 add_action ( 'publish_page', 'saveBlogId' );

function saveBlogId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "_blog.php") {
        update_option('id_blog_page',$post_ID);
        update_option('title_blog_page',$the_title);
    }

    $oldblog = get_option('id_blog_page');
    if($post_ID == $oldblog) {
        if($template_name <> "_blog.php") {
            update_option('id_blog_page','');
        }
    }
}

add_action ( 'publish_page', 'saveProjectId' );
function saveProjectId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "_projects.php") {
        update_option('id_projects_page',$post_ID);
        update_option('title_projects_page',$the_title);
    }

    $oldblog = get_option('id_projects_page');
    if($post_ID == $oldblog) {
        if($template_name <> "_projects.php") {
            update_option('id_projects_page','');
        }
    }
}

        /*************************************************************/
        /************SET DEFAULTS*********************************/
        /*************************************************************/
        if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
            update_option('exhibit_colors_header_bg_img', get_template_directory_uri().'/style/img/bg-header.jpg');
        }



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
            <div class="home-twitter-text right">
                    <span><?php echo $twitter_status; ?></span>
                    <p><?php echo '@' . $twitter_name; ?></p>
            </div><!--/home-twitter-text-->
        </div><!--/home-twitter-content-->
    </div><!--/home-twitter-->       
            
    <?php 
    //use this if it's twitter widget
        } else { ?>    
            <li><div class="box-twitter-center left"><img src="<?php echo get_template_directory_uri(); ?>/style/img/twitter-img.png" /><span><?php echo $twitter_status; ?></span></div><span class="twitter-links"><?php echo twitter_time($twitter_time); ?></span></li>     
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
  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}


 include("update_notifier.php");
 
 ?>