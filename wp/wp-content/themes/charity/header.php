<?php session_start(); ?>
<!DOCTYPE html>

<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
   <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
   <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    
    
    <title>
        <?php
        global $page, $paged;

        wp_title('|', true, 'right');

        bloginfo('name');

        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() ))
            echo " | $site_description";

        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'tkingdom'), max($paged, $page));
        ?>
    </title>

    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed"
          href="<?php echo home_url(); ?>/feed/">
    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/script/html5.js" type="text/javascript"></script>
    <![endif]-->

    <?php
    // *** get custom favicon
    $favicon = get_option(wp_get_theme()->name . '_general_favicon'); if (empty($favicon)) {
        $favicon = get_template_directory_uri() . "/theme-images/favicon.ico";
    }?>
    <link rel="shortcut icon" href="<?php echo $favicon; ?>"/>

    <?php
    // *** get google analitics code
    $g_analitics = get_option(wp_get_theme()->name . '_general_google_analytics');
    if (isset ($g_analitics) && $g_analitics != '') {
        echo $g_analitics;
    }

    $custom_css = get_theme_option(wp_get_theme()->name.'_custom_style_custom_css');
    if(isset($custom_css) && $custom_css !== ''){
        echo '<style type="text/css">'.$custom_css.'</style>';
    }
   ?>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 940; ?>
    
<div id="container">
    <?php
    // *** get navigation ***
    if (function_exists('has_nav_menu') && has_nav_menu('primary')) {
        get_template_part('templates/parts/navigation');
    }
    ?>

    <?php
    if(isset($wp_query->post)){
    if($wp_query->post){
    // GET Slider or Map in case of contact page
    $use_large_map = get_theme_option(wp_get_theme()->name.'_contact_header_map');
    $show_map = get_theme_option(wp_get_theme()->name.'_contact_show_map');
    $x_coord = get_option(wp_get_theme()->name.'_contact_googlemap_x');
    $y_coord = get_option(wp_get_theme()->name.'_contact_googlemap_y');
    $zoom_factor = get_option(wp_get_theme()->name.'_contact_googlemap_zoom');
    $map_type = get_option(wp_get_theme()->name.'_contact_google_map_type');
    $marker_title = get_option(wp_get_theme()->name.'_contact_marker_title');
    $map_color = get_theme_option(wp_get_theme()->name.'_contact_map_color');
    $default_color = get_theme_option(wp_get_theme()->name.'_contact_default_map');
    $show_map = get_theme_option(wp_get_theme()->name.'_contact_show_map');

    if($default_color) {
        if(empty($map_color)) {
            $map_color ='';
        }
    } else {
        $map_color='';
    }

    if(empty($x_coord)) {$x_coord = 45.256024;}
    if(empty($y_coord)) {$y_coord = 19.853861;}
    if(empty($zoom_factor)) {$zoom_factor = 15;}
    if(empty($map_type)) {$map_type = 'ROADMAP';}
    if(is_page_template('templates/template-contact.php') == true && $use_large_map == 'header' && $show_map !==  'yes'){
    ?>
        <div class="full-width">
            <div class="block map-contact contact-map2">
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                <div id="map_canvas" style="width: 100%; height: 100%; min-height: 0px;" class="contact-img"></div>

                <?php if($map_color){ ?>

                    <script type="text/javascript">

                        var styles = [
                            {
                                "stylers": [
                                    { "hue": "<?php echo '#'.$map_color; ?>" }
                                ]
                            }
                        ];

                        var styledMap = new google.maps.StyledMapType(styles,
                            {name: "Styled Map"});

                        var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);

                        var myOptions = {
                            zoom: <?php echo $zoom_factor ?>,
                            center: latlng,
                            mapTypeControl: false,
                            streetViewControl: false,
                            overviewMapControl: false,
                            mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>,
                            scrollwheel: false
                        };

                        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                        map.mapTypes.set('map_style', styledMap);
                        map.setMapTypeId('map_style');

                        <?php if(!empty($marker_title)) { ?>
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title:"<?php echo $marker_title?>"
                        });
                        <?php }?>

                    </script>

                <?php } else { ?>

                    <script type="text/javascript">
                        var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);
                        var myOptions = {
                            zoom: <?php echo $zoom_factor ?>,
                            center: latlng,
                            mapTypeControl: false,
                            streetViewControl: false,
                            overviewMapControl: false,
                            mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>,
                            scrollwheel: false
                        };

                        var mapa = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                        <?php if(!empty($marker_title)) { ?>
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: mapa,
                            title:"<?php echo $marker_title?>"
                        });
                        <?php }?>
                    </script>

                <?php } ?>
            </div>

        </div>
    <?php
        }else{
            get_template_part('templates/parts/header-slider');
        }

    // GET Latest News
    get_template_part('templates/parts/header-news');
    } // check if site have posts
}

    ?>