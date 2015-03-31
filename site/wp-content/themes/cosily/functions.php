<?php
global $wpdb;

require(  get_template_directory() . '/inc/theme-settings.php');                //Building theme administration

require(  get_template_directory() . '/inc/meta-boxes.php');                    //Building meta boxes

require(  get_template_directory() . '/inc/post-types.php');                    //Building post types

require(  get_template_directory() . '/inc/custom-taxonomies.php');             //Building post types

function tk_theme_name(){
    return 'cosily';
}
define( 'tk_theme_name', 'cosily' );
update_option('tk_theme_name', tk_theme_name);

$lang = get_template_directory() . '/languages/';                               //Make this theme available for translation.
load_theme_textdomain(tk_theme_name, $lang);

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'custom-background' );

add_theme_support( 'post-thumbnails' );                                         //This enables Post Thumbnails support for this theme.
        add_image_size( 'blog', 620 , 306, true);
        add_image_size( 'blog-full', 1014 , 500, true);
        add_image_size( 'gallery', 309 , 268, true);
        add_image_size( 'gallery-4-columns', 221 , 178, true);
        add_image_size( 'rooms', 271 , 173, true);
        add_image_size( 'home-room', 340 , 329, true);
        add_image_size( 'horizontal-slider', 200 , 157, true);
        add_image_size( 'rooms-slider', 1014 , 490, true);
        
        add_image_size('widget-advert', 300, 250, true);
        add_image_size('widget-advert-small', 125, 125, true);

register_nav_menu( 'primary', __( 'Primary Menu', tk_theme_name ) );                //This theme uses wp_nav_menu()
register_nav_menu( 'secondary', __( 'Right Menu', tk_theme_name ) );                //This theme uses wp_nav_menu()


//THEME NAME
$tk_theme_name = tk_theme_name;

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/* * ********************************************************** */
/* * **********CREATE TABLE FOR ADVERTISING************** */
/* * ********************************************************** */


add_action("after_switch_theme", "tk_create_tables"); //theme switch action

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
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    
    
    $table_name2 = $wpdb->prefix . "cosily_rooms";

    if ($wpdb->get_var("show tables like '$table_name2'") !== $table_name2) {

        $sql2 = "CREATE TABLE " . $table_name2 . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        post_id int(11) NOT NULL,
        arrival_date date NOT NULL,
        departure_date date NOT NULL,
        nights int(11) NOT NULL,
        message varchar(1000) COLLATE utf8_bin NOT NULL,
        email varchar(100) COLLATE utf8_bin NOT NULL,
        title varchar(5) COLLATE utf8_bin NOT NULL,
        first_name varchar(50) COLLATE utf8_bin NOT NULL,
        last_name varchar(50) COLLATE utf8_bin NOT NULL,
        country varchar(50) COLLATE utf8_bin NOT NULL,
        address varchar(100) COLLATE utf8_bin NOT NULL,
        city varchar(100) COLLATE utf8_bin NOT NULL,
        state varchar(100) COLLATE utf8_bin NOT NULL,
        postal_code varchar(30) COLLATE utf8_bin NOT NULL,
        phone varchar(50) COLLATE utf8_bin NOT NULL,
        price int(11) NOT NULL,
        confirm int(11) NOT NULL,
        PRIMARY KEY (id)
      ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table used by cosily theme for room booking'";
        
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql2);
        
    }


    tk_populate_initial_theme_settings_data();
    
}

/* * ********************************************************** */
/* * **********RANDOM GENERATOR******************** */
/* * ********************************************************** */

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

/* * ********************************************************** */
/* * **********WIDGETS FOR CATEGORIES******************** */
/* * ********************************************************** */

add_action('edit_category_form_fields', 'tk_sidebar_field');
add_action('category_add_form_fields', 'tk_sidebar_field');
add_action('edited_category', 'tk_save_sidebar_select');
add_action('create_category', 'tk_save_sidebar_select');


/* SAVES CHOOSEN SIDEBAR */

function tk_save_sidebar_select($term_id) {
    if (isset($_POST['sidebar-selection'])) {
        $tag_id = $term_id;
        $cat_meta = get_option("sidebar_$tag_id");
        $cat_keys = array_keys($_POST['sidebar-selection']);

        foreach ($cat_keys as $key) {
            if (isset($_POST['sidebar-selection'][$key])) {
                $cat_meta[$key] = $_POST['sidebar-selection'][$key];
            }
        }
        //save the option array
        update_option("sidebar_$tag_id", $cat_meta);
    }
}

/* CREATES THE SIDEBAR FIELD IN CATEGORY */

function tk_sidebar_field($tag) {
    if (isset($_GET['tag_ID'])) {
        $tag_id = $tag->term_id;
        $cat_meta = get_option("sidebar_$tag_id");
    }

    global $wpdb;
    global $wp_registered_sidebars;


    $results = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'sidebars' AND post_status = 'publish'");
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="sidebar-selection"><?php _e('Select Sidebar', tk_theme_name); ?></label></th>
        <td>
            <select name="sidebar-selection[sidebar]" id="sidebar-selection[sidebar]">
                <?php
                $results = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'sidebars' AND post_status = 'publish'");

                $i = 1;
                foreach ($wp_registered_sidebars as $sidebar) {
                    if ($sidebar['name'] !== 'Footer Widget ' . $i) {
                        if (isset($_GET['tag_ID'])) {
                            echo '<option', $cat_meta['sidebar'] == $sidebar['name'] ? ' selected="selected"' : '', ' value="' . $sidebar['name'] . '">', $sidebar['name'], '</option>';
                        } else {
                            echo '<option value="' . $sidebar['name'] . '">', $sidebar['name'], '</option>';
                        }
                    }
                    $i++;
                }

                foreach ($results as $result) {
                    if (isset($_GET['tag_ID'])) {
                        ?>                
                        <option <?php
            if ($cat_meta['sidebar'] == $result->post_title) {
                echo 'selected';
            }
                        ?>  value='<?php echo $result->post_title; ?>'><?php echo $result->post_title; ?></option>
                        <?php } else { ?>
                        <option value='<?php echo $result->post_title; ?>'><?php echo $result->post_title; ?></option>
                    <?php } ?>

                <?php } ?>

            </select>
            <br />
            <span class="description"  style=" margin-bottom: 25px;display: inline-block;"><?php _e('Select sidebar for this category.', tk_theme_name); ?></span>
        </td>
    </tr>
    <?php
}

        /*************************************************************/
        /************LOAD STYLES************************************/
        /*************************************************************/

        function tk_add_stylesheet() {
                wp_register_style('main_style', get_stylesheet_uri());
                wp_enqueue_style('main_style');
                
                wp_register_style('superfish', get_template_directory_uri().'/script/menu/superfish.css');
                wp_enqueue_style('superfish');
                
                wp_register_style('fancybox', get_template_directory_uri().'/script//fancybox/source/jquery.fancybox.css');
                wp_enqueue_style('fancybox');
                
                wp_register_style('flexslider', get_template_directory_uri().'/script/flexslider/flexslider.css');
                wp_enqueue_style('flexslider');
                
                wp_register_style('scroll-button', get_template_directory_uri().'/script/scroll-button/scroll-button.css');
                wp_enqueue_style('scroll-button');
                
                if(is_front_page()){
                    wp_register_style('workslider', get_template_directory_uri().'/script/horizontal/jcarousel.css');
                    wp_enqueue_style('workslider');
                }
                
                if(is_front_page()){
                    wp_register_style('slitcss', get_template_directory_uri().'/script/slit-slider/css/style.css');
                    wp_enqueue_style('slitcss');
                }
                
                if(is_front_page()){
                    wp_register_style('customslitcss', get_template_directory_uri().'/script/slit-slider/css/custom.css');
                    wp_enqueue_style('customslitcss');
                }
                
                if(is_archive() || is_front_page() ||  is_search() || is_single() || is_page_template('page-templates/_blog.php') || is_category()){
                    wp_register_style('jplayer', get_template_directory_uri().'/script/jplayer/skin/blue.monday/jplayer.blue.monday.css');
                    wp_enqueue_style('jplayer');
                }
                
                wp_register_style('Merriweather', 'http://fonts.googleapis.com/css?family=Merriweather:400,300,700');
                wp_enqueue_style('Merriweather');
                
                wp_register_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:300,400');
                wp_enqueue_style('Lato');
                
                wp_register_style('SourceSansPro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700');
                wp_enqueue_style('SourceSansPro');
                
                
                
                $browser = $_SERVER['HTTP_USER_AGENT'];

                if (strpos($browser, 'iPhone')) {
                    wp_register_style('iphone', get_template_directory_uri().'/style/iphone.css');
                    wp_enqueue_style('iphone');
                }

                if (strpos($browser, 'MSIE 8.0')) {
                    wp_register_style('ie8', get_template_directory_uri().'/style/ie8.css');
                    wp_enqueue_style('ie8');
                }

                if (strpos($browser, 'MSIE 9.0')) {                    
                    wp_register_style('ie9', get_template_directory_uri().'/style/ie9.css');
                    wp_enqueue_style('ie9');
                }
                
                if (strpos($browser, 'Firefox')) {
                    wp_register_style('firefox', get_template_directory_uri().'/style/firefox.css');
                    wp_enqueue_style('firefox');
                }

                if (strpos($browser, 'Presto')) {
                    wp_register_style('opera', get_template_directory_uri() . '/style/opera.css');
                    wp_enqueue_style('opera');
                }

            }
        add_action( 'wp_enqueue_scripts', 'tk_add_stylesheet' );



        /*************************************************************/
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/
        
        function tk_add_scripts() {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('superfish', get_template_directory_uri().'/script/menu/superfish.js', false, false, true  );
            wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js', false, false, true );
            wp_enqueue_script('fancybox', get_template_directory_uri().'/script/fancybox/source/jquery.fancybox.js', false, false, true );
            wp_enqueue_script('easing', get_template_directory_uri().'/script/easing/jquery.easing.1.3.js', false, false, true );
            wp_enqueue_script('scroll-button', get_template_directory_uri().'/script/scroll-button/scroll-button.js', false, false, true );
            wp_enqueue_script('flexslider', get_template_directory_uri().'/script/flexslider/jquery.flexslider.js', false, false, true );
            wp_enqueue_script('workslider', get_template_directory_uri().'/script/horizontal/jquery.jcarousel.min.js', false, false, true );
            wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.min.js', false, false, true );
            wp_enqueue_script('spiner', get_template_directory_uri().'/script/spiner/spin.min.js', false, false, true );
            wp_enqueue_script('jplayer', get_template_directory_uri().'/script/jplayer/js/jquery.jplayer.min.js', false, false, true );
            wp_enqueue_script('respond', get_template_directory_uri().'/script/respond/respond.src.js', false, false, true );
            wp_enqueue_script('slitsmodernizr', get_template_directory_uri().'/script/slit-slider/js/modernizr.custom.79639.js', false, false, true );
            wp_enqueue_script('slitslider', get_template_directory_uri().'/script/slit-slider/js/jquery.slitslider.js', false, false, true );
            wp_enqueue_script('slitslidercond', get_template_directory_uri().'/script/slit-slider/js/jquery.ba-cond.min.js', false, false, true );

            if ( is_singular() ) wp_enqueue_script( 'comment-reply', false, false, true );
            
            
            //passing get template variable to jqueyr
            
            $get_template = get_template_directory_uri();
            $variable_array = array(
                'get_template_dir' => $get_template           
             );

            wp_localize_script('my-commons', 'template_dir_variables', $variable_array);
            
                                    
    /*     * *********************************************************** */
    /*     * **********SLIT SLIDER************************************ */
    /*     * ********************************************************* */
    
    $sl_slider_autoplay = get_option(tk_theme_name.'_home_slider_slider_autoplay');
    $sl_slider_speed = get_option(tk_theme_name.'_home_slider_slider_pause_time');
    if(empty($sl_slider_speed)){$sl_slider_speed =  4000 ;}
    $sl_slider_animation = get_option(tk_theme_name.'_home_slider_slider_animation_time');
    if(empty($sl_slider_animation)){$sl_slider_animation = 500 ;}
    
    $slider_option = array(
      'slider_autoplay' => $sl_slider_autoplay,
      'slider_pause_time' => $sl_slider_speed,
      'slider_animation_time' => $sl_slider_animation,
    );
    
    wp_localize_script('slitslider', 'slit_slider_option', $slider_option);
            
            
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
   
   
        function get_video_image($url, $post_ID) {

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
                                <img src="http://img.youtube.com/vi/<?php echo $url;?>/0.jpg" title="<?php echo get_the_title($post_ID)?>" alt="<?php echo get_the_title($post_ID)?>" />
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
                                    <img src="<?php echo $data[0]->thumbnail_medium;?>" title="<?php echo get_the_title($post_ID)?>" alt="<?php echo get_the_title($post_ID)?>" />
		  <?php }
		if (empty($pos_vimeo) && empty($pos_youtube)) {

		  echo "Video only allowes vimeo and youtube!";
		}
        }}
   
   
        /*************************************************************/
        /************REGISTER POST FORMATS************************/
        /************************************************************/

            $post_formats = array( 
                                    'gallery', 
                                    'link', 
                                    'quote', 
                                    'audio',
                                    'video');

            add_theme_support( 'post-formats', $post_formats ); 

            add_post_type_support( 'post', 'post-formats' );

            add_post_type_support( 'gallery', 'post-formats' );
            
            add_post_type_support( 'rooms', 'post-formats' );

   
            
            
        /*************************************************************/
        /************ENQUEUE ADMINSCRIPT**************************/
        /************************************************************/




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



   
            
            
            
            
        /*************************************************************/
        /************AUDIO PLAYER***********************************/
        /************************************************************/

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
                                          swfPath: "<?php echo get_template_directory_uri()?>/script/jplayer/js"
                                      });

                                  }
                              });
                      </script>
      <?php
      }

      
        /*********************************************************/
        /************GET CUSTOM THUMB SIZE***********************/
        /************************************************************/
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
            function tk_get_thumb($width, $height, $src)
            {
                $img_id = get_attachment_id_from_src($src);
                $size = wp_get_attachment_image_src($img_id, 'full');
                if($width >= $size[1] || $height >= $size[2]){
                      echo $src;
                }else {
                if(strpos($src, '.jpg')){
                    $new_src = explode('.jpg', $src);
                    $new_src = $new_src[0].'-'.$width.'x'.$height.'.jpg';
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
        /************LOAD WIDGETS**********************************/
        /*************************************************************/

	require_once (TEMPLATEPATH . '/inc/widgets/widget-twitter.php');
	require_once (TEMPLATEPATH . '/inc/widgets/widget-newsletter.php');
	require_once (TEMPLATEPATH . '/inc/widgets/widget-ad.php');
                  require_once (TEMPLATEPATH . '/inc/widgets/widget-facebook.php');



        

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
     function tk_get_sidebar($sidebar_position, $sidebar_name) {
                $sidebar_option = get_theme_option(tk_theme_name . '_general_custom_sidebars');
                if ($sidebar_position == 'Right') {
                    ?>
                        <div id="sidebar" class="right">
                            <div class="sidebar-shadow-left left"><img alt="" src="<?php echo get_template_directory_uri()?>/style/img/sidebar-shadow.jpg"></div>
                           <div class="sidebar-shadow-top left"><img alt="" src="<?php echo get_template_directory_uri()?>/style/img/sidebar-top-images.png"></div>
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                            <?php endif; ?>
                        </div><!--/#sidebar-->
                    <?php                    
                }elseif($sidebar_position == 'Left'){
                    ?>
                    <?php
                    $sidebar_option = get_theme_option(tk_theme_name . '_general_custom_sidebars');
?>
                        <div id="sidebar" class="left">
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                            <?php endif; ?>
                            <div class="sidebar-shadow-left-sidebar-left left"><img alt="" src="<?php echo get_template_directory_uri()?>/style/img/sidebar-shadow-left-sidebar.jpg"></div>
                            <div class="sidebar-shadow-top left"><img alt="" src="<?php echo get_template_directory_uri()?>/style/img/sidebar-top-images.png"></div>
                        </div><!--/#sidebar-->
                    <?php
                    }
                }            


    /*********************************************************** /
    /**********REGISTERING SIDEBARS************************* /
    /***********************************************************/




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



    $results = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_type = 'sidebars' AND post_status = 'publish'");


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

        
        /*************************************************************/
        /************LOAD FUNCTION FOR COLOR CHANGE************/
        /*************************************************************/
    
        function tk_change_color() {
                    get_template_part('/inc/change-colors');
        }
        add_action('wp_head', 'tk_change_color', '99');
        
        
        /*************************************************************/
        /************SET DEFAULTS***********************************/
        /*************************************************************/
        if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
            update_option('cosily_colors_body_bg_img', get_template_directory_uri().'/style/img/bg-body.jpg');
        }


        /*************************************************************/
        /************LOAD SHORTCODES******************************/
        /*************************************************************/


        require_once ( get_template_directory().'/inc/shortcodes/tinymce_loader.php');

        // This one enables hr tag to default tiny options
        function enable_more_buttons($buttons) {
          $buttons[] = 'hr';
          return $buttons;
        }
        add_filter("mce_buttons", "enable_more_buttons");

        // Columns one half
        function shortcode_one_half( $atts, $content = null ) {
                extract(shortcode_atts(array(
                        'position'     	 => '',
            ), $atts));

           return '<div class="one-half '.$position.'"><p>' . do_shortcode($content) . '</p></div>';
        }

        add_shortcode('one_half', 'shortcode_one_half');

        // Columns one third
        function shortcode_one_third( $atts, $content = null ) {
                extract(shortcode_atts(array(
                        'position'     	 => '',
            ), $atts));

           return '<div class="one-third '.$position.'"><p>' . do_shortcode($content) . '</p></div>';
        }

        add_shortcode('one_third', 'shortcode_one_third');

        // Columns one fourth
        function shortcode_one_fourth( $atts, $content = null ) {
                extract(shortcode_atts(array(
                        'position'     	 => '',
            ), $atts));

           return '<div class="one-fourth '.$position.'"><p>' . do_shortcode($content) . '</p></div>';
        }

        add_shortcode('one_fourth', 'shortcode_one_fourth');

        // Shortcode for buttons
        function shortcode_button( $atts, $content = null ) {

                extract(shortcode_atts(array(
                        'url'     	 => '#',
                        'style'   => 'black',
            ), $atts));

           return '<div class="color-buttons color-button-'.$style.' left"><a href="'.$url.'">' . do_shortcode($content) . '</a></div>';
        }

        add_shortcode('button', 'shortcode_button');

        // Shortcode for unordered list with different looks
        function shortcode_list( $atts, $content = null ) {

                extract(shortcode_atts(array(
                        'style'   => '1'
            ), $atts));

           return '<ul style="list-style:none;padding-left:0px"><li class="'.$style.'">' . do_shortcode($content) . '</li></ul>';
        }

        add_shortcode('list', 'shortcode_list');

        // Shortcode for toggled content
        function shortcode_toggle( $atts, $content = null ) {

                extract(shortcode_atts(array(
                        'title'   => 'Title',
                        'value'   => ''
            ), $atts));

                if($value != ''){
                    $image_class = 'active-togle-img';
                    $box_class = 'no-active-togle';
                }else{
                    $image_class = '';
                    $box_class = '';
                }
             
           return '<div class="toggle-holder"><div class="toggle-holder-image"><h6 class="'.$image_class.'"></h6></div><span>'.$title.'</span><p class="'.$box_class.'">'.do_shortcode($content).'</p></div>';
        }

        add_shortcode('toggle', 'shortcode_toggle');

        // Shortcode for tabbed content
function tz_tabs( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'tabs' => ''
    ), $atts));

    $output = '';
    $output .= '<div id="tabs" class="tabs"><ul>';

    $tabs = trim($tabs, ",");
    $myTabs = explode(',', $tabs);

    foreach($myTabs as $tab) {
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

function tz_tabs_panes( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'title' => ''
    ), $atts));


    $create_id = sanitize_title($title);
    $output = '<div id="' . $create_id . '">' . do_shortcode($content) . '</div>';

    return $output;
}

add_shortcode('tab', 'tz_tabs_panes');


// Shortcode for infobox
function shortcode_infobox( $atts, $content = null ) {

    extract(shortcode_atts(array(
        'bgcolor'     	 => '#e85c2c',
        'textcolor'   => '#FFF',
    ), $atts));

    return '<div class="shortcode-infobox left" style="background-color:'.$bgcolor.'"><p style="color:'.$textcolor.'">' . do_shortcode($content) . '<p></div>';
}

add_shortcode('infobox', 'shortcode_infobox');

        // Shortcode DROPCAP
        function shortcode_dropcap( $atts, $content = null ) {
            extract(shortcode_atts(array(
                'style'     	 => '',
            ), $atts));

            return '<span class="dropcap-'.$style.'">' . do_shortcode($content) . '</span>';
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
                $tk_return .= '<div class="cta-button-floater"><div class="color-buttons color-button-' . $style . '"><a href="' . $url . '">' . $buttontext . '</a></div></div>';
            }
            $tk_return .= '</div></div>';

            return($tk_return);
        }

        add_shortcode('calltoaction', 'shortcode_calltoaction');

        /*************************************************************/
        /************SAVE TEMPLATE  ID AND NAME*******************/
        /*************************************************************/

 add_action ( 'publish_page', 'saveBlogId' );

function saveBlogId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_blog.php") {
        update_option('id_blog_page',$post_ID);
        update_option('title_blog_page',$the_title);
    }

    $oldblog = get_option('id_blog_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_blog.php") {
            update_option('id_blog_page','');
        }
    }
}


 add_action ( 'publish_page', 'saveRoomsId' );

function saveRoomsId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_rooms.php") {
        update_option('id_rooms_page',$post_ID);
        update_option('title_rooms_page',$the_title);
    }

    $oldblog = get_option('id_rooms_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_rooms.php") {
            update_option('id_rooms_page','');
        }
    }
}

 add_action ( 'publish_page', 'saveGalleryId' );

function saveGalleryId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_gallery_3_columns.php") {
        update_option('id_gallery_page',$post_ID);
        update_option('title_gallery_page',$the_title);
    }

    $oldblog = get_option('id_gallery_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_gallery_3_columns.php") {
            update_option('id_gallery_page','');
        }
    }
}


 add_action ( 'publish_page', 'saveGallery4Id' );

function saveGallery4Id($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_gallery_4_columns.php") {
        update_option('id_gallery4_page',$post_ID);
        update_option('title_gallery4_page',$the_title);
    }

    $oldblog = get_option('id_gallery4_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_gallery_4_columns.php") {
            update_option('id_gallery4_page','');
        }
    }
}

 add_action ( 'publish_page', 'saveTestimonialsId' );

function saveTestimonialsId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_testimonials.php") {
        update_option('id_testimonials_page',$post_ID);
        update_option('title_testimonials_page',$the_title);
    }

    $oldblog = get_option('id_testimonials_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_testimonials.php") {
            update_option('id_testimonials_page','');
        }
    }
}


 add_action ( 'publish_page', 'saveReservationsId' );

function saveReservationsId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_reservations.php") {
        update_option('id_reservations_page',$post_ID);
        update_option('title_reservations_page',$the_title);
    }

    $oldblog = get_option('id_reservations_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_reservations.php") {
            update_option('id_reservations_page','');
        }
    }
}

 add_action ( 'publish_page', 'saveContactId' );

function saveContactId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );
    if($template_name == "page-templates/_contact.php") {
        update_option('id_contact_page',$post_ID);
        update_option('title_contact_page',$the_title);
    }

    $oldblog = get_option('id_contact_page');
    if($post_ID == $oldblog) {
        if($template_name <> "page-templates/_contact.php") {
            update_option('id_contact_page','');
        }
    }
}


 /*************************************************************/
/************GALLERY FANCYBOX FILTER************************/
/*************************************************************/

    add_filter('wp_get_attachment_link', 'add_lighbox_rel');

    function add_lighbox_rel($attachment_link) {
        if (strpos($attachment_link, 'a href') != false){
            $attachment_link = str_replace('a href', 'a class="fancybox" href', $attachment_link);
        }
        return $attachment_link;
    }

    
/* * ********************************************************** */
/* * *******************POST VIEW COUNT******************** */
/* * ********************************************************** */

function getPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count . ' Views';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

        /*************************************************************/
        /************TWITTER SCRIPT*********************************/
        /*************************************************************/


/*************************************************************/
/************     TWITTER SCRIPT   ***************************/
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
 
        if(!empty($single_tweet->text)){
        //gets twitter content, time and name
        $twitter_status = $single_tweet->text;
        $twitter_time = $single_tweet->created_at;
        $twitter_name = $single_tweet->user->screen_name;
                
        $twitter_status = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\">\\2</a>", $twitter_status);
        $twitter_status = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\">\\2</a>", $twitter_status);
        $twitter_status = preg_replace("/@(\w+)/", "<a href=\"http://twitter.com/\\1\">@\\1</a>", $twitter_status);
        $twitter_status = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $twitter_status);
        
        //checks if it's single tweet on home or twitter widget
        if($unique_id == 'home'){    
    ?>
                        

        <section>
                <div class="row-fluid">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/shadow-divider.png" class="shadow_divider" />
                </div>
                <div class="container">
                    <div class="row-fluid twitter_wrap">                        
                            <div class="span9"><img class="twitter_img pull-left" src="<?php echo get_template_directory_uri(); ?>/style/images/twitter.png" /><p><?php echo $twitter_status; ?></p></div>
                            <div class="span3 twitter_author"><a href="https://twitter.com/<?php echo $twitter_name; ?>" target="_blank"><?php echo '@' . $twitter_name; ?></a></div>
                    </div>
                </div>  
        </section>    

            
    <?php //use this if it's twitter widget

        } else { ?> 
           
            <li>
                <div class="box-twitter-center left">
                    <span><?php echo $twitter_status; ?></span>
                </div>
                <span class="twitter-links"><?php echo twitter_time($twitter_time); ?></span>
                <div class="clear"></div>
            </li>  

        <?php } //$unique_id == 'home' ?>  
    <?php } //$single_tweet->text ?>
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
    require_once (  get_template_directory().'/inc/theme-style.php');
    
    
    
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
        $button_output = '
                    <div class="color-buttons color-button-' . $style . ' pricing-button">
                        <a href="' . $url . '">' . $buttontext . '</a>
                    </div>';
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
    


/**************************************************************/
/********   REGISTER REVOLUTION SLIDER PLUGIN    *********/
/**************************************************************/

require_once dirname( __FILE__ ) . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'register_slider_plugin' );
function register_slider_plugin() {

    
    $plugins = array(
        
        array(
            'name'                  => 'Revolutions Slider', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/revslider.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

    );

    // Change this to your theme text domain, used for internationalising strings
    

    $config = array(
        'domain'            => tk_theme_name,          // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
        'parent_url_slug'   => 'themes.php',                // Default parent URL slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', tk_theme_name ),
            'menu_title'                                => __( 'Install Plugins', tk_theme_name ),
            'installing'                                => __( 'Installing Plugin: %s', tk_theme_name), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', tk_theme_name ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', tk_theme_name ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', tk_theme_name ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', tk_theme_name ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );
}
    

 ?>