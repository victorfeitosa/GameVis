<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html  class="no-js" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        $favicon = get_template_directory_uri() . "/style/img/favicon.ico";
    }?>
    <link rel="shortcut icon" href="<?php echo $favicon; ?>"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <?php
    // *** get google analitics code
    $g_analitics = get_option(wp_get_theme()->name . '_general_google_analytics');
    if (isset ($g_analitics) && $g_analitics != '') {
        echo stripslashes($g_analitics);
    }
    ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 870; ?>
    
<div id="container">
    <?php
    // *** get navigation ***
    get_template_part('templates/parts/navigation');
    ?>