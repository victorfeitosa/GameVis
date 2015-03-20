<?php
global $wpdb;

require( get_template_directory() . '/inc/theme-settings.php');                //Building theme administration

require( get_template_directory() . '/inc/meta-boxes.php');                    //Building meta boxes

require( get_template_directory() . '/inc/post-types.php');                    //Building post types

add_action("admin_init", "tk_create_tables"); //theme switch action

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



    /*
     * Create second table: user_rating
     */

    $table_name2 = $wpdb->prefix . "user_rating";

    if ($wpdb->get_var("show tables like '$table_name2'") !== $table_name2) {

        $sql2 = "CREATE TABLE " . $table_name2 . " (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        userip tinytext NOT NULL,
        userrate text NOT NULL,
        postid text NOT NULL,
        UNIQUE KEY id (id));";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql2);
    }

    tk_populate_initial_theme_settings_data();
}

function tk_theme_name() {
    return 'novelti';
}

if (!isset($content_width)) {
    $content_width = 825;
}

function tk_theme_adjust_content_width() {
    global $content_width;

    if (is_page_template('_fullwidth.php')) {
        $content_width = 1200;
    }
}

add_action('template_redirect', 'tk_theme_adjust_content_width');

define('tk_theme_name', 'novelti');
update_option('tk_theme_name', tk_theme_name);

$lang = get_template_directory() . '/languages/';                               //Make this theme available for translation.
load_theme_textdomain(tk_theme_name, $lang);

add_theme_support('automatic-feed-links');

add_theme_support('custom-background');

add_theme_support('post-thumbnails');                                         //This enables Post Thumbnails support for this theme.
add_image_size('main-slider', 900, 476, true);
add_image_size('main-slider-full', 1200, 436, true);
add_image_size('one-column-top', 825, 415, true);
add_image_size('one-column-side', 600, 416, true);
add_image_size('two-columns-top', 630, 354, true);
add_image_size('two-columns-side', 50, 50, true);
add_image_size('sticky', 558, 387, true);
add_image_size('carousel', 190, 142, true);
add_image_size('related-posts', 195, 103, true);

add_image_size('widget-posts', 50, 50, true);
add_image_size('widget-advert', 300, 250, true);
add_image_size('widget-advert-small', 125, 125, true);

register_nav_menu('primary', __('Primary Menu', tk_theme_name));                //This theme uses wp_nav_menu()
register_nav_menu('category', __('Category Menu', tk_theme_name));                //This theme uses wp_nav_menu()
register_nav_menu('footer', __('Footer Menu', tk_theme_name));                //This theme uses wp_nav_menu()
//THEME NAME
$tk_theme_name = tk_theme_name;

function new_excerpt_more($more) {
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');




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


    $results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'sidebars' AND post_status = 'publish'");
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="sidebar-selection"><?php _e('Select Sidebar', tk_theme_name); ?></label></th>
        <td>
            <select name="sidebar-selection[sidebar]" id="sidebar-selection[sidebar]">
                <?php
                $results = $wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."posts WHERE post_type = 'sidebars' AND post_status = 'publish'");

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

?>
            </select>
            <br />
            <span class="description"  style=" margin-bottom: 25px;display: inline-block;"><?php _e('Select sidebar for this category.', tk_theme_name); ?></span>
        </td>
    </tr>
    <?php
}

/* * ********************************************************** */
/* * **********CUSTOM CATEGORY FIELDS********************* */
/* * ********************************************************** */
//add color to edit category page
add_action('edit_category_form_fields', 'tk_category_field');
add_action('category_add_form_fields', 'tk_category_field');

function tk_category_field($tag) {
    if (isset($_GET['tag_ID'])) {
        $tag_id = $tag->term_id;
        $cat_meta = get_option("category_$tag_id");
        $cat_display = get_option("category_display_$tag_id");
    }
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="category_color"><?php _e('Category Color', tk_theme_name); ?></label></th>
        <td>
            <input type="text" name="category[color]" id="category[color]" size="3" value="<?php
    if (isset($cat_meta)) {
        echo $cat_meta['color'] ? $cat_meta['color'] : '';
    }
    ?>" class="color" style="width: 125px"><br />
            <span class="description"  style=" margin-bottom: 25px;display: inline-block;"><?php _e('Select color for this category.', tk_theme_name); ?></span>
        </td>
    </tr>
    <tr>
        <th scope="row" valign="top"><label for="category_color"><?php _e('Category Display', tk_theme_name); ?></label></th>
        <td>
            <select name="category_display" id="category_display">
                <option value="one-column" <?php
               if (!isset($cat_display) || $cat_display == 'one-column') {
                   echo 'selected';
               }
    ?>><?php _e('One Column', tk_theme_name) ?></option>
                <option value="two-columns" <?php
            if (isset($cat_display) && $cat_display == 'two-columns') {
                echo 'selected';
            }
    ?>><?php _e('Two Columns', tk_theme_name) ?></option>
            </select>
            <br />
            <span class="description"  style=" margin-bottom: 25px;display: inline-block;"><?php _e('Select how to display this category.', tk_theme_name); ?></span>
        </td>

    </tr>
    <?php
}

//save color in edit category page
add_action('edited_category', 'tk_save_category_field');
add_action('create_category', 'tk_save_category_field');

function tk_save_category_field($term_id) {
    if (isset($_POST['category'])) {
        $tag_id = $term_id;
        $cat_meta = get_option("$tag_id");
        $cat_keys = array_keys($_POST['category']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['category'][$key])) {
                $cat_meta[$key] = $_POST['category'][$key];
            }
        }
        //save the option array
        update_option("category_$tag_id", $cat_meta);
        update_option("category_display_$term_id", $_POST["category_display"]);
    }
}

/* * ********************************************************** */
/* * **********LOAD STYLES*********************************** */
/* * ********************************************************** */

function tk_add_stylesheet() {
    wp_register_style('main_style', get_stylesheet_uri());
    wp_enqueue_style('main_style');

    wp_register_style('carousel', get_template_directory_uri() . '/script/horizontal/jcarousel.css');
    wp_enqueue_style('carousel');

    wp_register_style('flexslider', get_template_directory_uri() . '/script/flexslider/flexslider.css');
    wp_enqueue_style('flexslider');

    wp_register_style('superfish', get_template_directory_uri() . '/script/menu/superfish.css');
    wp_enqueue_style('superfish');

    wp_register_style('fancybox', get_template_directory_uri() . '/script/fancybox/source/jquery.fancybox.css');
    wp_enqueue_style('fancybox');

    wp_register_style('SourceSansPro', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700');
    wp_enqueue_style('SourceSansPro');

    wp_register_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
    wp_enqueue_style('fontawesome');


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
    
    if (strpos($browser, 'Safari') !== false && strpos($browser, 'Chrome') == false ) {
        wp_register_style('safari', get_template_directory_uri() . '/style/safari.css');
        wp_enqueue_style('safari');
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
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/script/flexslider/jquery.flexslider-min.js', false, false, true);
    wp_enqueue_script('jcarousel', get_template_directory_uri() . '/script/horizontal/jquery.jcarousel.min.js', false, false, true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/script/isotope/jquery.isotope.min.js', false, false, true);
    wp_enqueue_script('spiner', get_template_directory_uri() . '/script/spiner/spin.min.js', false, false, true);
    wp_enqueue_script('jplayer', get_template_directory_uri() . '/script/jplayer/js/jquery.jplayer.min.js', false, false, true);
    wp_enqueue_script('respond', get_template_directory_uri() . '/script/respond/respond.src.js', false, false, true);
    wp_enqueue_script('stars', get_template_directory_uri() . '/script/star/jquery.rating.js', false, false, true);
    wp_enqueue_script('starsmeta', get_template_directory_uri() . '/script/star/jquery.MetaData.js', false, false, true);

    if (is_singular())
        wp_enqueue_script('comment-reply', false, false, true);
}

add_action('wp_enqueue_scripts', 'tk_add_scripts');



/* * ********************************************************** */
/* * **********VIDEO PLAYER********************************** */
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

/* * ********************************************************** */
/* * **********GET VIDEO IMAGE********************************** */
/* * ********************************************************** */

function get_video_image($url, $post_ID) {

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
            <img src="http://img.youtube.com/vi/<?php echo $url; ?>/0.jpg" title="<?php echo get_the_title($post_ID) ?>" alt="<?php echo get_the_title($post_ID) ?>" class="video-image" />
            <?php
        }
        if (!empty($pos_vimeo)) {
            $url = explode('.com/', $url);
            $data = wp_remote_retrieve_body(wp_remote_get("http://vimeo.com/api/v2/video/" . $url[1] . ".json"));
            $data = json_decode($data);
            ?>
            <img src="<?php echo $data[0]->thumbnail_medium; ?>" title="<?php echo get_the_title($post_ID) ?>" alt="<?php echo get_the_title($post_ID) ?>" class="video-image"/>
            <?php
        }
        if (empty($pos_vimeo) && empty($pos_youtube)) {

            echo "Video only allowes vimeo and youtube!";
        }
    }
}

/* * ********************************************************** */
/* * **********REGISTER POST FORMATS*********************** */
/* * ********************************************************* */

$post_formats = array(
    'gallery',
    'video');

add_theme_support('post-formats', $post_formats);

add_post_type_support('post', 'post-formats');



/* * ********************************************************** */
/* * **********ENQUEUE ADMINSCRIPT************************* */
/* * ********************************************************* */

function enqueue_admin_script($hook) {
    global $typenow;

    /* wp_register_script('jquery-ui', 'http://code.jquery.com/ui/1.10.2/jquery-ui.js', 'jquery'); */
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

/* * ******************************************************** */
/* * **********GET CUSTOM THUMB SIZE********************** */
/* * ********************************************************* */

/*
 * $height -> height of new image
 * $width -> width of new image
 * $src -> url of image you want to get thumb from
 */

function tk_get_thumb($width, $height, $src) {
    $size = getimagesize($src);
    if ($width >= $size[0] || $height >= $size[1]) {
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
require_once (TEMPLATEPATH . '/inc/widgets/widget-tabbed.php');
require_once (TEMPLATEPATH . '/inc/widgets/widget-facebook.php');

/* * ********************************************************** */
/* * **********INCREASE IMAGE QUALITY********************** */
/* * ********************************************************* */

function jpeg_quality_callback($arg) {
    return (int) 100;
}

add_filter('jpeg_quality', 'jpeg_quality_callback');


/* * ********************************************************** */
/* * **********IMAGE WITHOUT DIMENSIONS******************* */
/* * ********************************************************* */

function tk_thumbnail($post_id, $img_size) {
    $thumbnail = get_the_post_thumbnail($post_id, $img_size);
    $thumbnail = preg_replace('/(width|height)=\"\d*\"\s/', "", $thumbnail);
    echo $thumbnail;
}

/* * ********************************************************** */
/* * **********CHECK CATEGORY PARENT********************* */
/* * ********************************************************* */

function tk_has_parent($catid) {
    $category = get_category($catid);
    if ($category->category_parent > 0) {
        return true;
    }
    return false;
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
            <div id="sidebar" class="right">
                <div class="sidebar-bacground"></div>
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Default')) : ?>
            <?php endif; ?>
            </div><!--/#sidebar-->
            <?php } else { ?>
            <div id="sidebar" class="right">
                <div class="sidebar-bacground"></div>
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
            <div id="sidebar" class="left">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Default')) : ?>
            <?php endif; ?>
            </div><!--/#sidebar-->
            <?php } else { ?>
            <div id="sidebar" class="left">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
            <?php endif; ?>
            </div><!--/#sidebar-->
                <?php
            }
        }
    }

    /*     * ********************************************************** */
    /*     * **********REGISTERING SIDEBARS************************* */
    /*     * ********************************************************* */




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



    $results = $wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."posts WHERE post_type = 'sidebars' AND post_status = 'publish'");


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


    /*     * ********************************************************** */
    /*     * **********FUNCTION FOR RATING SYSTEM***************** */
    /*     * ********************************************************** */

    /*
     * Function for inserting custom amount of stars for star rating system
     * also enables to call this stars with or without ability to rate
     * 
     * $starts number amount of rating options
     * $split how many pieces one star has
     * $rating status if set as "yes" rating box will be clickable ,default state off
     *  */

    function tk_rating($stars_number, $split, $rating_status, $selected, $class) {
        global $post;
        $checked = array();
        for ($i = 1; $i < $stars_number + 1; $i++) {
            if ($selected == $i) {
                $checked[$i] = 'checked';
            }
        }
        for ($i = 1; $i < $stars_number + 1; $i++) {
            ?>
        <input class="<?php echo $class ?> {split:<?php echo $split ?>}" type="radio" name="<?php echo $class ?>" value="<?php echo $i ?>" <?php
        if (isset($checked[$i])) {
            echo 'checked';
        }
            ?> <?php
        if ($rating_status == 'yes') {
            
        } else {
            echo 'disabled';
        }
            ?>/>

           <?php } ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
    <?php if ($rating_status == 'yes') { ?>
                jQuery('.stars-rater .<?php echo $class ?>').rating({
                    callback: function(value, link){
                        jQuery('.stars-rater .<?php echo $class ?>').rating('readOnly');
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo site_url() ?>/index.php",
                            data: {user_rate:value, postid:'<?php echo $post->ID ?>'}
                        }).done(function( ) {
                        });
                                                                                                                                        
                        var total = jQuery('.old_rate').attr('total');
                        var old_rate = jQuery('.old_rate').attr('ratenumber');
                        var new_total = parseFloat(total) * old_rate;
                        old_rate++;
                        new_total = (new_total + parseFloat(value))/parseFloat(old_rate);
                        new_total = Math.round(new_total).toFixed(0);
                        jQuery('.single-rating-one .single-user-rate').html('').html('<?php _e('User Rating: ', tk_theme_name); ?> '+new_total+' ('+old_rate+'<?php _e(' votes)', tk_theme_name); ?>' );
                    }
                });
    <?php } else { ?>
                jQuery('.stars-rater .<?php echo $class ?>').rating({
                    cancel: 'Cancel', cancelValue: '0'
                });
    <?php } ?>
        })
    </script>
    <?php
}

/* * ********************************************************** */
/* * **********FUNCTION FOR STORING USER RATES************ */
/* * ********************************************************** */
if (isset($_POST['user_rate'])) {
    $value = $_POST['user_rate'];
    $id = $_POST['postid'];
    $userip = $_SERVER['REMOTE_ADDR'];
    $servtime = date('Y-m-d h:i:s');
    global $wpdb;
    $tablename = $wpdb->prefix . "user_rating";
    $sqlx = $wpdb->get_results("SELECT * FROM $tablename WHERE userip = '$userip' AND postid = '$id'");
    if (empty($sqlx)) {
        $wpdb->insert($tablename, array('time' => $servtime, 'userip' => $userip, 'userrate' => $value, 'postid' => $id));
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
/* * **********SET DEFAULTS********************************** */
/* * ********************************************************** */
if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
    update_option('novelti_colors_body_bg_img', get_template_directory_uri() . '/style/img/bg-body.jpg');
}


/* * ********************************************************** */
/* * **********WIDGET AREA DETECTION FUNCTION********* */
/* * ********************************************************** */

function tk_is_widget_in_widget_area($widget_name, $widget_area_name) {
    $ilc_widget_active = get_option('sidebars_widgets');

    $widget_area_contains_widget = false;
    $widget_area_count = 0;
    foreach ($ilc_widget_active as $key => $value) {
        $widget_area_count++;
        if ($key == $widget_area_name) {
            foreach ($value as $widget) {
                if (preg_match("/" . $widget_name . "/i", $widget)) {
                    $widget_area_contains_widget = true;
                }
            }
        }
    }
    if ($widget_area_count > 0) {
        return $widget_area_contains_widget;
    }
}



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

add_action('publish_page', 'saveGalleryId');

function saveGalleryId($post_ID) {
    global $wp_query;
    $the_title = get_the_title($post_ID);
    $template_name = get_post_meta($post_ID, '_wp_page_template', true);
    if ($template_name == "_gallery.php") {
        update_option('id_gallery_page', $post_ID);
        update_option('title_gallery_page', $the_title);
    }

    $oldblog = get_option('id_gallery_page');
    if ($post_ID == $oldblog) {
        if ($template_name <> "_gallery.php") {
            update_option('id_gallery_page', '');
        }
    }
}

add_action('publish_page', 'saveProjectsId');

function saveProjectsId($post_ID) {
    global $wp_query;
    $the_title = get_the_title($post_ID);
    $template_name = get_post_meta($post_ID, '_wp_page_template', true);
    if ($template_name == "_projects.php") {
        update_option('id_projects_page', $post_ID);
        update_option('title_projects_page', $the_title);
    }

    $oldblog = get_option('id_projects_page');
    if ($post_ID == $oldblog) {
        if ($template_name <> "_projects.php") {
            update_option('id_projects_page', '');
        }
    }
}

/* * ********************************************************** */
/* * **********GALLERY FANCYBOX FILTER******************** */
/* * ********************************************************** */

add_filter('wp_get_attachment_link', 'add_lighbox_rel');

function add_lighbox_rel($attachment_link) {
    if (strpos($attachment_link, 'a href') != false) {
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

/* * ********************************************************** */
/* * **********TWITTER SCRIPT******************************** */
/* * ********************************************************** */



function twitter_script($unique_id, $limit) {
    
require_once(dirname( __FILE__ ).'/script/twitter/TwitterAPIExchange.php');

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
            <li>
                <div class="box-twitter-center left">                    
                    <span><?php echo $twitter_status; ?></span>
                </div>
                <span class="twitter-links"><?php echo twitter_time($twitter_time); ?></span>
            </li>
    <?php }//$unique_id == 'home' ?>      

<?php } //single_tweet->text

     }//uniquer_id              
 if($unique_id !== 'home') {?>
    </ul>
    <?php }    

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

require_once ( ABSPATH . 'wp-content/themes/' . tk_theme_name . '/inc/theme-style.php');

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

/*
 * SOCIAL SHARE COUNTERS
 */

// Facebook Share Counter
function get_likes($url) {
    $get_link = wp_remote_get('http://graph.facebook.com/' . $url, array('timeout' => 60));

    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $facebook_count = json_decode($get_link['body'], true);

        if (!isset($facebook_count['shares']) or $facebook_count['shares'] == '') {            
            return 0;
        } else {
            return $facebook_count['shares'];
        }
    }
}

// Twitter Share Counter

// Twitter Share Counter
function get_tweets($url) {
    
    
require_once(dirname( __FILE__ ).'/script/twitter/TwitterAPIExchange.php');
        
/*GET TWITTER KEYS FROM ADMINISTRATION*/
$twitter_consumer_key = get_theme_option(tk_theme_name.'_social_twitter_consumer_key');
$twitter_consumer_secret = get_theme_option(tk_theme_name.'_social_twitter_consumer_secret');
$twitter_access_token = get_theme_option(tk_theme_name.'_social_twitter_access_token');
$twitter_token_secret = get_theme_option(tk_theme_name.'_social_twitter_token_secret');

if(!empty($twitter_consumer_key)){
            /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
            $settings = array(
                'oauth_access_token' => $twitter_access_token,
                'oauth_access_token_secret' => $twitter_token_secret,
                'consumer_key' => $twitter_consumer_key,
                'consumer_secret' => $twitter_consumer_secret
            );

            /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
            $url = 'http://urls.api.twitter.com/1/urls/count.json';
            $getfield = '?url='.get_permalink();

            $requestMethod = 'GET';

            /** Perform the request and echo the response **/
            $twitter = new TwitterAPIExchange($settings);
            $twitter_results = $twitter->setGetfield($getfield)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();
            return $twitter_results -> count;
            
    } else {
        return 0;
        }
        
}

// Google plus Share Counter
function get_plusones($url) {

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
            return intval($json['result']['metadata']['globalCounts']['count']);
        }
}

// Stumbleupon Share Counter
function get_stumbleupon($url) {
        $get_link = wp_remote_get('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url);
        if (is_wp_error($get_link)) {
            return "0";
        } else {
            $stumbleupon_count = json_decode($get_link['body'], true);
            if (@$stumbleupon_count['result']['views'] == '') {
                return 0;
            } else {
                return intval($stumbleupon_count['result']['views']);
            }
        }
}

// Linkedin Share Counter
function get_linkedin($url) {
    $get_link = wp_remote_get('http://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json');
    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $linkedin_count = json_decode($get_link['body'], true);
        if ($linkedin_count['count'] == '') {
            return 0;
        } else {          
            return intval($linkedin_count['count']);
        }
    }
}

// Pinterest Share Counter
function get_pinit($url) {
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
            return intval($pinit_count['count']);
        }
    }
}

/* get twitter followers on home page */

function tk_get_twitter_followers() {
    
require_once(dirname( __FILE__ ).'/script/twitter/TwitterAPIExchange.php');
    
/*GET TWITTER KEYS FROM ADMINISTRATION*/
$twitter_consumer_key = get_theme_option(tk_theme_name.'_social_twitter_consumer_key');
$twitter_consumer_secret = get_theme_option(tk_theme_name.'_social_twitter_consumer_secret');
$twitter_access_token = get_theme_option(tk_theme_name.'_social_twitter_access_token');
$twitter_token_secret = get_theme_option(tk_theme_name.'_social_twitter_token_secret');
$twitter_username = get_theme_option(tk_theme_name.'_social_twitter');


if(!empty($twitter_consumer_key)){
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => $twitter_access_token,
        'oauth_access_token_secret' => $twitter_token_secret,
        'consumer_key' => $twitter_consumer_key,
        'consumer_secret' => $twitter_consumer_secret
    );


            //$json = wp_remote_get('https://api.twitter.com/1/users/show.json?screen_name=' . $twitter_user . '&include_entities=true', array('timeout' => 60));

            /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
            $url = 'https://api.twitter.com/1.1/users/show.json';
            $getfield = '?screen_name='.$twitter_username.'&include_entities=true';


            $requestMethod = 'GET';

            /** Perform the request and echo the response **/
            $twitter = new TwitterAPIExchange($settings);
            $json = $twitter->setGetfield($getfield)
                         ->buildOauth($url, $requestMethod)
                         ->performRequest();

            if (is_wp_error($json)) {
                return "1.";
            } else {             
                return $json->followers_count;
            }
    }   //$twitter_consumer_key
        
        
}

/* get facebook page likes on home page */

function tk_get_facebook_likes() {
    $facebook_likes = '';
    $facebook_user = get_theme_option(tk_theme_name . '_social_facebook');

        $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));

        if (is_wp_error($json)) {
            return "0.";
        } else {
            $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));
            if (is_wp_error($json))
                return "0";
            $fbData = json_decode($json['body'], true);

            return intval($fbData['likes']);
        }
}

/* get googe plus circled count */

function gplus_count() {

    $google_plus_count = '';
    $gplus_username = get_theme_option(tk_theme_name() . '_social_google_plus');
    $gplus_api = get_theme_option(tk_theme_name() . '_social_google_plus_api');

        $get_link = wp_remote_get("https://www.googleapis.com/plus/v1/people/" . $gplus_username . "?key=" . $gplus_api, array('timeout' => 30));

        if (is_wp_error($get_link)) {
            return "0.";
        } else {
            $google_plus_count = json_decode($get_link['body'], true);
            return intval($google_plus_count['plusOneCount']);
        }
}

function tk_custom_menus($menu, $args) {


    global $custom_style;
    $level = 0;
    $stack = array('0');

    $navigation_count = get_theme_option(tk_theme_name.'_general_navigation_count');
    
    foreach ($menu as $key => $item) {
        while ($item->menu_item_parent != array_pop($stack)) {
            $level--;
        }

        if ($item->menu_item_parent == 0) {
            $category_color = get_option('category_' . $item->object_id);
        }

        $one_category = get_category($item->object_id);

        $level++;
        $stack[] = $item->menu_item_parent;

        $stack[] = $item->ID;

        $color = $category_color['color'];
        


        if($navigation_count == 'yes'){
            if (isset($one_category->count)) {
                $count = $one_category->count;
            } else {
                $count = '';
            }
        } else {
            $count = '';
        }

        $custom_style[$item->ID] = 'background-color: #' . $color;
        if ($args->menu == 'category-menu') {
            if ($level == 1) {
                $menu[$key]->title = '<p>' . $count . '</p><span>' . $item->title . '</span>';
            } else {
                $menu[$key]->title = '<span>' . $item->title . '</span>';
            }
        }
    }

    return $menu;
}

global $custom_style;
$custom_style = array();

class Description_Walker extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = array(), $current_object_id = 0) {        
        global $custom_style;

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args= array(), $current_object_id = 0 ) {
        global $custom_style;
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(
                ' '
                , apply_filters(
                        'nav_menu_css_class'
                        , array_filter($classes), $item
                )
        );

        !empty($class_names)
                and $class_names = ' class="' . esc_attr($class_names) . '"';

        if (isset($custom_style[$item->ID])) {
            $output .= "<li style='" . $custom_style[$item->ID] . "'>";
        }

        $attributes = '';

        !empty($item->attr_title)
                and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
        !empty($item->target)
                and $attributes .= ' target="' . esc_attr($item->target) . '"';
        !empty($item->xfn)
                and $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
        !empty($item->url)
                and $attributes .= ' href="' . esc_attr($item->url) . '"';

        // insert description for top level elements only
        // you may change this
        $description = (!empty($item->description) and 0 == $depth ) ? '<small class="nav_desc">' . esc_attr($item->description) . '</small>' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before
                . "<a $attributes>"
                . $args->link_before
                . $title
                . '</a> '
                . $args->link_after
                . $description
                . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
                'walker_nav_menu_start_el'
                , $item_output
                , $item
                , $depth
                , $args
        );
    }

}
/**************************************************************/
/********   REGISTER PLUGINS    **************/
/**************************************************************/

require_once dirname( __FILE__ ) . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'register_slider_plugin' );
function register_slider_plugin() {

    
    $plugins = array(
        
        array(
            'name'                  => 'ThemesKingdom Shortcodes', // The plugin name
            'slug'                  => 'shortcodes', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/inc/plugins/shortcodes.zip', // The plugin source
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