<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">

        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
        <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

        <title>
            <?php
            global $page, $paged;

            wp_title('|', true, 'right');

            bloginfo('name');

            $site_description = get_bloginfo('description', 'display');
            if ($site_description && ( is_home() || is_front_page() ))
                echo " | $site_description";

            if ($paged >= 2 || $page >= 2)
                echo ' | ' . sprintf(__('Page %s', tk_theme_name), max($paged, $page));
            ?>
        </title>

        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
        <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <!--[if IE 8]>
        <link href="<?php echo get_template_directory_uri(); ?>/style/ie8-media.css" media="screen and (min-width: 250px;)" rel="stylesheet"/>
        <![endif]-->
        <!--[if IE 9]>
        <link rel="stylesheet" href="css/ie9.css" media="screen, projection" type="text/css" >
        <![endif]-->


        <!--[if lt IE 9]>
           <script>
              document.createElement('header');
              document.createElement('nav');
              document.createElement('section');
              document.createElement('article');
              document.createElement('aside');
              document.createElement('footer');
           </script>
        <![endif]-->


        <?php
        $favicon = get_theme_option(tk_theme_name . '_general_favicon');
        if (empty($favicon)) {
            $favicon = get_template_directory_uri() . "/style/img/favicon.ico";
        }
        ?>
        <link rel="shortcut icon" href="<?php echo $favicon; ?>" />


        <?php
        $g_analitics = get_theme_option(tk_theme_name . '_general_google_analytics');
        if (isset($g_analitics) && $g_analitics != '') {
            echo $g_analitics;
        }
        ?>


        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=205808082877982";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div id="container">

            <!-- HEADER -->
            <div class="header left">

                <!--MENU-->
                <?php if (function_exists('has_nav_menu') && has_nav_menu('primary')) { ?>
                    <div class="nav left">
                        <div class="wrapper">
                            <div class="button-menu"><a href="#"></a></div><!--/button-menu-->
                            <nav>
                                <div class="top-border-menu-for-responsive"></div>
                                <?php
                                $nav_menu = array('title_li' => '', 'theme_location' => 'primary', 'menu_class' => 'sf-menu');
                                wp_nav_menu($nav_menu);
                                ?>
                            </nav>

                            <div class="header-search-form-wrap">
                                <div class="header-search-form right">
                                    <div class="opener"></div>
                                    <?php get_search_form(); ?>
                                </div>      
                            </div><!-- header-search-form-wrap -->

                            <?php
                            $display_header_date = get_option(tk_theme_name . '_general_header_date_visible');

                            if ($display_header_date[0] == 'yes') {
                                ?> 
                                <div class="header-date left"><?php echo date_i18n(get_option('date_format'), time()); ?></div>
                            <?php } ?>

                        </div><!--/wrapper-->                    
                    </div><!--/nav-->
                <?php } // if there is no navigation?>

                <div class="wrapper">

                    <!--LOGO-->
                    <?php
                    $logo = get_option(tk_theme_name . '_general_header_logo');
                    $logo_margin_top = get_option(tk_theme_name . '_general_header_margin_top');
                    $logo_margin_right = get_option(tk_theme_name . '_general_header_margin_right');
                    $logo_margin_bottom = get_option(tk_theme_name . '_general_header_margin_bottom');
                    $logo_margin_left = get_option(tk_theme_name . '_general_header_margin_left');
                    if (empty($logo)) {
                        $logo = get_template_directory_uri() . "/style/img/logo.png";
                    }
                    ?>
                    <div class="logo left" style="margin-top:<?php echo $logo_margin_top ?>px;margin-right:<?php echo $logo_margin_right ?>px;margin-bottom:<?php echo $logo_margin_bottom ?>px;margin-left:<?php echo $logo_margin_left ?>px;">
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                    </div>

                    <?php
                    // HEADER BANNER

                    $header_banner = get_option(tk_theme_name . '_general_header_advert');
                    $banner_margin_top = get_option(tk_theme_name . '_general_banner_margin_top');
                    $banner_margin_right = get_option(tk_theme_name . '_general_banner_margin_right');
                    $banner_margin_bottom = get_option(tk_theme_name . '_general_banner_margin_bottom');
                    $banner_margin_left = get_option(tk_theme_name . '_general_banner_margin_left');
                    $prefix="tk_";                    
                    $custom_banner =  get_post_meta($header_banner, $prefix.'custom_banner_code', true);
                    
                    if(!empty($custom_banner)){ ?>
                        <div class="header-baner right" style="margin-top:<?php echo $banner_margin_top ?>px;margin-right:<?php echo $banner_margin_right ?>px;margin-bottom:<?php echo $banner_margin_bottom ?>px;margin-left:<?php echo $banner_margin_left ?>px;">
                            <?php 
                                tk_add_banner_view($header_banner);
                                echo $custom_banner; 
                            ?>
                        </div>
                    
                    <?php } else {
                                            
                        if ($header_banner && $header_banner != 'none') {
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($header_banner), 'full');
                        $post_title = get_the_title($header_banner);
                        tk_add_banner_view($header_banner);
                        ?>              
                        <div class="header-baner right" style="margin-top:<?php echo $banner_margin_top ?>px;margin-right:<?php echo $banner_margin_right ?>px;margin-bottom:<?php echo $banner_margin_bottom ?>px;margin-left:<?php echo $banner_margin_left ?>px;">
                            <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $header_banner; ?>">
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo $post_title ?>" title="<?php echo $post_title ?>" />
                            </a>
                        </div>
                    <?php } 
                    } ?>
                    
                    


                    <div class="header-big-menu left">
                        <div class="big-button-menu">
                            <div class="big-button-menu-content left">
                                <span><?php _e('Navigation', tk_theme_name); ?></span>
                                <div class="big-menu-right right"><p></p></div>
                            </div>
                        </div><!--/button-menu-->
                        <nav>
                            <?php
                            if (function_exists('has_nav_menu') && has_nav_menu('category')) {
                                add_filter('wp_nav_menu_objects', 'tk_custom_menus', 1, 2);
                                $nav_menu_main = array('menu' => 'category-menu', 'title_li' => '', 'theme_location' => 'category', 'menu_class' => 'sf-menu', 'walker' => new Description_Walker);
                                wp_nav_menu($nav_menu_main);
                            }
                            ?>
                        </nav>
                    </div><!--/header-big-menu-->
                </div><!--/wrapper-->
            </div><!--/header-->     