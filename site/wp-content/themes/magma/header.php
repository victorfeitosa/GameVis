<?php session_start(); ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html  class="no-js" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>

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
    // get google analitics code
    $g_analitics = get_option(wp_get_theme()->name . '_general_google_analytics');
    if (isset ($g_analitics) && $g_analitics != '') {
        echo stripslashes($g_analitics);
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 870; ?>


    <div id="st-container" class="st-container">
        <div class="st-pusher">
            <nav class="st-menu st-effect-3" id="menu-3">
                <h2 class="icon icon-lab"><a href="#" class="close-search">Close</a></h2>
                <ul>
                <?php $args = array(
                    'style'              => 'list',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'title_li'           => '',
                ); ?>
                <?php wp_list_categories($args); ?>
                </ul>
            </nav>



            <div id="container" class="st-content">


            <?php $header_type = get_theme_option(wp_get_theme()->name.'_general_header_type'); ?>
            <?php if ($header_type == 'header_two') { ?>
                <!-- Load header two -->
                <?php get_template_part('/templates/parts/header', 'two'); ?>
            <?php } elseif ($header_type == 'header_three') { ?>
                <!-- Load header three -->
                <?php get_template_part('/templates/parts/header', 'three'); ?>
            <?php } else { ?>
                <!-- Load header one -->
                <?php get_template_part('/templates/parts/header', 'one'); ?>
            <?php } ?>