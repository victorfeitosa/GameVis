<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

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

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
                <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/menu/superfish.css"; ?>" type="text/css"/>
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/pirobox/css/demo5/style.css"; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/style/font.css"; ?>" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/script/flexslider/flexslider.css"; ?>" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/script/scroll-button/scroll-button.css"; ?>" type="text/css" charset="utf-8" />
        
<!--[if lt IE 9]>
   <script>
      document.createElement('nav');
   </script>
<![endif]-->


<?php

        /*************************************************************/
        /*Test user agent and load css for it***************************/
        /*************************************************************/


        $ua = $_SERVER["HTTP_USER_AGENT"];

        // Macintosh
        $mac = strpos($ua, 'Macintosh') ? true : false;

        // Windows
        $win = strpos($ua, 'Windows') ? true : false;


        $browser = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($browser, 'Safari')) {
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-safari.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'Firefox')) {
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-firefox.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'MSIE 8.0')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie8.css" type="text/css" />
                <script src="./script/respond/respond.src.js"></script>
            <?php
        }

        if (strpos($browser, 'MSIE 9.0')) {
            ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie9.css" type="text/css" />
            <?php
        }

        if (strpos($browser, 'Chrome')) {?>
                <script src="<?php echo get_template_directory_uri(); ?>/script/respond/respond.src.js"></script>
           <?php if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-chrome.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'pera')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/opera.css" type="text/css" />
            <?php
            if(!empty($win)) {
                if($win == Windows) { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-opera.css" type="text/css" />
                <?php
                }
            }
        }
?>

 <?php

        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/

            //load colors
            $header_color = get_theme_option(tk_theme_name.'_colors_header_color');
            $header_nav_color = get_theme_option(tk_theme_name.'_colors_header_nav_color');
            $category_nav_color = get_theme_option(tk_theme_name.'_colors_category_nav_color');
            $body_color = get_theme_option(tk_theme_name.'_colors_body_color');
            $footer_color = get_theme_option(tk_theme_name.'_colors_footer_color');
            $copyright_color = get_theme_option(tk_theme_name.'_colors_copyright_color');

            $font_navigation_color = get_theme_option(tk_theme_name.'_colors_navigation_color');
            $font_navigation_hover = get_theme_option(tk_theme_name.'_colors_navigation_hover');
            $font_category_navigation_color = get_theme_option(tk_theme_name.'_colors_category_navigation_color');
            $font_category_navigation_hover = get_theme_option(tk_theme_name.'_colors_category_navigation_hover');
            $font_title_color = get_theme_option(tk_theme_name.'_colors_title_color');
            $font_link_color = get_theme_option(tk_theme_name.'_colors_link_color');
            $font_copyright = get_theme_option(tk_theme_name.'_colors_copyright');
        ?>

                    <style type="text/css">
                        /*Background*/
                        .bg-top-header, .header-down-border, .sf-shadow ul, .sf-menu li li{background-color: <?php echo '#'.$header_nav_color.''?>;}
                        .sf-shadow ul{border-bottom:<?php echo '#'.$header_nav_color.'!important'?>;}
                        
                        .bg-center-header{background-color: <?php echo '#'.$header_color?>;}
                        
                        .header-categories, .header-categories li ul.children li, .header-categories li ul.children{background-color: <?php echo '#'.$category_nav_color?>;}
                        
                        body{background-color: <?php echo '#'.$body_color?>;}
                        
                        .footer, .silver-big-fake, #sidebar{background-color: <?php echo '#'.$footer_color?>;}
                        
                        .copyrigt-footer{background-color: <?php echo '#'.$copyright_color?>;}
                       
                        
                        /*Fonts*/      
                        .menu-header nav ul li a:link, .menu-header nav ul li a:visited{color: <?php echo '#'.$font_navigation_color.''?>;}
                        
                        .menu-header nav ul li a:hover, .menu-header nav ul li.active a, .current-menu-item a{color: <?php echo '#'.$font_navigation_hover.'!important'?>;}
                        
                        .header-categories ul li a{color: <?php echo '#'.$font_category_navigation_color.''?>;}
                        
                        .current-cat > a, .header-categories ul li a:hover{color: <?php echo '#'.$font_category_navigation_hover.'!important'?>;}
                        
                        .category-post-first-title a, .category-post-first-date span, .category-post-first-text, .sidebar_widget_holder h3,
                        .footer_box ul li a, .sidebar_widget_holder ul li a, .category-post-first-date a, .category-post-one-title a, .category-post-one-date span,
                        p, .category-post-one-date a, .footer_box .box-twitter-center span, .sidebar_widget_holder .box-twitter-center span, 
                        .footer_box .box-twitter-center a, .sidebar_widget_holder .box-twitter-center a, .footer_box .twittime, .sidebar_widget_holder .twittime,
                        .sidebar_widget_holder #wp-calendar caption, .footer_box #wp-calendar caption, .sidebar_widget_holder thead, .footer_box thead,
                        .pirobox_content table, tbody, tr, th, td, .sidebar_widget_holder tfoot a, .footer_box tfoot a, .rsswidget,
                        .footer_box ul li, .sidebar_widget_holder ul li,.sidebar_widget_holder #s input.search-input, .footer_box #s input.search-input,
                        .sidebar_widget_holder .newsletter span, .footer_box .newsletter span,.sidebar_widget_holder .textwidget p, .sidebar_widget_holder .textwidget, .footer_box .textwidget, .footer_box .textwidget p,
                        .footer_box h2,.title-home,.recent-news-one-title a,.recent-news-one-comment span,.recent-news-one-comment a,.slider-comments span,.slider-comments a,.shortcodes ul li,blockquote p,
                        h1, h2, h3, h4, h5, h6,.one-half,.one-third,.one-fourth,.shortcodes ol li,.post-title,.post-date span, .post-date span a,.post-text p,.post-share span,.post-autor-title a,.post-autor-touch ul li span,.post-autor-text,
                        .comment-start h2,.comment-start-title span,.comment-start-title p,.comment-start-text p,.comment-start-title a,.title-page,.contact-text span,.contact-text p,.bg-input input,.textwidget a:hover,
                        .slider-title a:hover,.shortcodes a:hover
                        {color: <?php echo '#'.$font_title_color?>;}
                        
                        .footer_box ul li a:hover, .sidebar_widget_holder ul li a:hover,.footer_box .twitter_ul span.twitter-links, .sidebar_widget_holder .twitter_ul span.twitter-links,.sidebar_widget_holder tbody a, .footer_box tbody a,
                        .post-autor-title a:hover,.comment-start-title a:hover,.sidebar_widget_holder tfoot a:hover, .footer_box tfoot a:hover,.comment-start-title a:hover,.textwidget a,#back-top a:hover, #back-top a:hover span,
                        .slider-title a,.recent-news-one-title a:hover,.recent-news-one-comment a:hover,.shortcodes a, .post-date span a:hover
                        {color: <?php echo '#'.$font_link_color?>;}
                        
                        .copyrigt-footer-text,#back-top a{color: <?php echo '#'.$font_copyright?>;}
                        
                        
                    </style>
                    
                    
                    
        <?php

        /*************************************************************/
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/


            wp_enqueue_script('jquery');
            wp_enqueue_script('superfish', get_template_directory_uri().'/script/menu/superfish.js' );
            wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js' );
            wp_enqueue_script('pirobox', get_template_directory_uri().'/script/pirobox/js/pirobox.js' );
            wp_enqueue_script('contact', get_template_directory_uri().'/script/contact/contact.js' );
            wp_enqueue_script('easing', get_template_directory_uri().'/script/easing/jquery.easing.1.3.js' );
            wp_enqueue_script('elastic', get_template_directory_uri().'/script/elastic/jquery.elastic.source.js' );
            wp_enqueue_script('jscolor', get_template_directory_uri().'/script/jscolor/jscolor.js' );
            wp_enqueue_script('flexslider', get_template_directory_uri().'/script/flexslider/jquery.flexslider.js' );
            wp_enqueue_script('scroll-button', get_template_directory_uri().'/script/scroll-button/scroll-button.js' );
            wp_enqueue_script('pinterest', 'http://assets.pinterest.com/js/pinit.js' );
            
            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        ?>

        <?php $favicon = get_theme_option(tk_theme_name.'_general_favicon'); if(empty($favicon)) { $favicon = get_template_directory_uri()."/style/img/favicon.ico"; }?>
        <link rel="shortcut icon" href="<?php echo $favicon;?>" />

        
        <?php

         $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');

         if( isset ($g_analitics) && $g_analitics != ''){
             echo $g_analitics;
         }

        ?>


<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>



    
<div id="container">

    <!-- HEADER -->
    <div class="header left">

          <div class="bg-top-header left">
            <div class="wrapper">

                <!--MENU-->
                <div class="menu-header left">
                    <nav>
                        <!--MENU-->
                        <?php
                        if ( function_exists('has_nav_menu') && has_nav_menu('primary') ) {
                            $nav_menu = array('title_li'=> '', 'theme_location' => 'primary',   'menu_class'      => 'sf-menu');
                            wp_nav_menu($nav_menu);
                        } else { ?>

                        <ul class="sf-menu">
                                <?php
                                $pageargs = array(
                                        'depth'        => 3,
                                        'title_li'     => '',
                                        'echo'         => 1,
                                        'authors'      => '',
                                        'link_before'  => '',
                                        'link_after'   => '',
                                        'walker' => '' );
                                wp_list_pages($pageargs);?>
                        </ul>
                        <?php } ?>
                    </nav>
                </div><!--/menu-header-->

              <?php
                $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
                $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
                $linkedin_acc = get_theme_option(tk_theme_name.'_social_linked_in');
                $admin_email = get_option('admin_email');
                if( $enable_rss == true || $enable_rss[0] == '' || $twitter_acc == '' || $facebook_acc == '' || $facebook_acc == '' || $rss_acc == '' || $google_acc == '' || $linkedin_acc == '' ){
                ?>
                <div class="stay-tuned right">
                    <ul>
                        <li><span><?php _e('Get in touch', tk_theme_name) ?></span></li>
                        <?php if(!empty($twitter_acc)){ ?><li><a href="http://twitter.com/<?php echo $twitter_acc; ?>" class="stay-tuned-1 left"></a></li><?php } ?>
                        <?php if(!empty($facebook_acc)){ ?><li><a href="http://facebook.com/<?php echo $facebook_acc; ?>" class="stay-tuned-2 left"></a></li><?php } ?>
                        <?php if(!empty($linkedin_acc)){ ?><li><a href="<?php echo $linkedin_acc; ?>" class="stay-tuned-3 left"></a></li><?php } ?>
                        <?php if(!empty($google_acc)){ ?><li><a href="https://plus.google.com/<?php echo $google_acc; ?>" class="stay-tuned-4 left"></a></li><?php } ?>
                        <?php if ($enable_rss == false || $enable_rss[0] == ''){}else{ if(!empty($rss_acc )){ ?><li><a href="<?php echo $rss_acc; ?>" class="stay-tuned-5 left"></a></li><?php } else { ?><li><a href="<?php echo get_bloginfo('rss2_url'); ?>" class="icon-header-3"></a><div class="social-bg"></div></li><?php } }?>
                        <?php if(!empty($admin_email)){ ?><li><a href="mailto:<?php echo $admin_email; ?>" class="stay-tuned-6 left"></a></li><?php } ?>
                    </ul>
                </div><!--/links-header-->

                <?php }?>

            </div><!--/wrapper-->
        </div>


          <div class="bg-center-header left">
            <div class="wrapper">

<!--LOGO-->
            <div class="logo left">
           <?php
                $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                if(empty($logo)) {
                $logo = get_template_directory_uri()."/style/img/logo.png";
             }?>

                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
            </div>


        <?php
        $advertisement = get_theme_option(tk_theme_name.'_home_advertisement');
        $add_banner = get_theme_option(tk_theme_name.'_home_add_banner');
        if(empty($add_banner)) {$add_banner = get_template_directory_uri()."/style/img//baner468x60.jpg";}
        $banner_link = get_theme_option(tk_theme_name.'_home_banner_link');
        if(empty($banner_link)) {$banner_link = 'http://www.themeskingdom.com';}
        $banner_title = get_theme_option(tk_theme_name.'_home_banner_title');
        if(empty($banner_title)) {$banner_title = '';}
        if($advertisement !== 'yes') {
        ?>

                <div class="header-baner right"><a href="<?php echo $banner_link?>"><img src="<?php echo $add_banner?>" alt='<?php echo $banner_title ?>' title="<?php echo $banner_title ?>" /></a></div><!--/header-baner-->
                
        <?php }?>
                
                
                <div class="header-categories left">
                    <nav>
                        <ul>
                <?php
                
                $args = array(
                        'orderby'            => 'name',
                        'hide_empty'         => 1,
                        'depth'              => 10,
                );
                $categories = get_categories($args);

                $catarray = array();
                $nesto = '';
                foreach ($categories as $category_list ) {
                  $catarray = get_theme_option(tk_theme_name.'_general_cat_'.$category_list->term_id);
                  if($catarray == 'yes'){
                      $nesto .= $category_list->term_id.',';
                  }}
                  
                $args = array(
                            'include'              => $nesto,
                            'style'              => 'list',
                            'title_li'           => __( '' ),
                            'depth'              => 10,
                            'hide_empty'         => 1,
                    );
                wp_list_categories($args)
                ?>
                            
                            
                <?php
?>
                        </ul>
                    </nav>
                </div><!--/header-categories-->

            </div><!--/wrapper-->
        </div><!--/bg-center-header-->

        <div class="header-down-border left"></div><!--/header-down-border-->

    </div>
