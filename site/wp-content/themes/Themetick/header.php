<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/menu/superfish.css"; ?>" type="text/css"/>
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/pirobox/css/demo5/style.css"; ?>" type="text/css"/>
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/anythingslider/css/anythingslider.css"; ?>" type="text/css"/>
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/scroll-button/scroll-button.css"; ?>" type="text/css" />
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/horizontal/skin.css"; ?>" type="text/css" />
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/nivoSlider/nivo-slider.css"; ?>" type="text/css" />
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/flexslider/flexslider.css"; ?>" type="text/css" />
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/tabs/ui-lightness/jquery-ui-1.8.16.custom.css"; ?>" type="text/css" />
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/scroll-button/scroll-button.css"; ?>" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Dosis:500&subset=latin,latin-ext' rel='stylesheet' type='text/css' />

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
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/safari.css" type="text/css" />
            <?php
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-safari.css" type="text/css" />
                <?php
                }
            }

            if(strpos($browser, 'iPad')) {
             ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/iPad-safari.css" type="text/css" />
                <?php

            }

        }

        if (strpos($browser, 'Firefox')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/firefox.css" type="text/css" />
            <?php
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
            <?php
        }

        if (strpos($browser, 'MSIE 9.0')) {
            ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie9.css" type="text/css" />
            <?php
        }

        if (strpos($browser, 'Chrome') && strpos($browser, 'Safari') ) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/chrome.css" type="text/css" />
            <?php
            if(!empty($win)) {
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
            $slider_color = get_theme_option(tk_theme_name.'_colors_slider_color');
            //Body style
            $body_bg_image = get_theme_option(tk_theme_name.'_colors_body_bg_img');
            
            $body_image_position = get_theme_option(tk_theme_name.'_colors_body_img_position');
            $body_image_repeat = get_theme_option(tk_theme_name.'_colors_body_img_repeat');
            $body_image_attachment = get_theme_option(tk_theme_name.'_colors_body_img_attachment');
            $body_color = get_theme_option(tk_theme_name.'_colors_body_color');
            
            
            $footer_color = get_theme_option(tk_theme_name.'_colors_footer_color');
            $call_to_action_color = get_theme_option(tk_theme_name.'_colors_call_to_action_color');

            $link_color = get_theme_option(tk_theme_name.'_colors_link_color');
            $link_hover_color = get_theme_option(tk_theme_name.'_colors_hover_color');
           
            $titles_color = get_theme_option(tk_theme_name.'_colors_titles_color');
            $paragraph_color = get_theme_option(tk_theme_name.'_colors_paragraph_color');
            $labes_and_links = get_theme_option(tk_theme_name.'_colors_labels_color');

            $colors_call_to_action_title = get_theme_option(tk_theme_name.'_colors_call_to_action_title_color');
            $colors_call_to_action_undertitle = get_theme_option(tk_theme_name.'_colors_call_to_action_undertitle_color');
            $colors_call_to_action_button = get_theme_option(tk_theme_name.'_colors_button_color');           

            $footer_title_color = get_theme_option(tk_theme_name.'_colors_footer_title_color');
            $footer_text_color = get_theme_option(tk_theme_name.'_colors_footer_text_color');

                     
            if($colors_call_to_action_button == 'Default' ) {
                $button_back ='';
                $button_back2 ='-orange';

                $button_font_color = '8b4f34';
                $text_shadow = 'f7a47e';

                $plugin_button_color = "fb9f69";
                $plugin_button_color2 = "f48a5d";

            } elseif ($colors_call_to_action_button == 'Black' ) {
                $button_back='-black';
                $button_back2='-black';
                $button_font_color = '232323';
                $text_shadow = '676767';

                $plugin_button_color = "666666";
                $plugin_button_color2 = "484848";

            } elseif ($colors_call_to_action_button == 'Silver' ) {
                $button_back='-silver';
                $button_back2='-silver';
                $button_font_color = '626262';
                $text_shadow = 'd7d7d7';

                $plugin_button_color = "dbdbdb";
                $plugin_button_color2 = "c2c2c2";

            } elseif ($colors_call_to_action_button == 'Blue' ) {
                $button_back='-blue';
                $button_back2='-blue';
                $button_font_color = '15506b';
                $text_shadow = '51a2c9';

                $plugin_button_color = "46a5d1";
                $plugin_button_color2 = "3987ab";

            } elseif ($colors_call_to_action_button == 'Red' ) {
                $button_back='-red';
                $button_back2='-red';
                $button_font_color = '812319';
                $text_shadow = 'de7f65';

                $plugin_button_color = "e36948";
                $plugin_button_color2 = "c95a3b";

            } elseif ($colors_call_to_action_button == 'Green' ) {
                $button_back='-green';
                $button_back2='-green';
                $button_font_color = '305833';
                $text_shadow = '77c17e';

                $plugin_button_color = "6ac072";
                $plugin_button_color2 = "59a460";

            } elseif ($colors_call_to_action_button == 'Yellow' ) {
                $button_back='-yellow';
                $button_back2='-yellow';
                $button_font_color = '737020';
                $text_shadow = 'e7e268';

                $plugin_button_color = "eee848";
                $plugin_button_color2 = "d4cf3c";

            } elseif ($colors_call_to_action_button == 'Brown' ) {
                $button_back='-brown';
                $button_back2='-brown';
                $button_font_color = '514137';
                $text_shadow = '987a67';

                $plugin_button_color = "967866";
                $plugin_button_color2 = "7b6152";

            } else {
                $button_back='';
                $button_back2='';
                $button_font_color = '8b4f34';
                $text_shadow = 'f7a47e';

                $plugin_button_color = "123121";
                $plugin_button_color2 = "123121";

            }

            
        ?>


                     <style type="text/css">
                        /*Background*/                    
                        body{
                            background-color: <?php echo '#'.$body_color?>;
                            background-attachment: <?php echo $body_image_attachment?>;
                            background-image: url(<?php echo $body_bg_image?>);
                            background-position: <?php echo $body_image_position?>;
                            background-repeat: <?php echo $body_image_repeat?>}
                        
                       
                        .home-ticket-box-center{background-color: #<?php echo $call_to_action_color?>;}

                        /*Text*/
                        .shortcodes h1,
                        .shortcodes h2,
                        .shortcodes h3,
                        .shortcodes h4,
                        .shortcodes h5,
                        .shortcodes h6,
                        h1, h2, h3, h4, h5, h6,
                        .blog-one-title a,
                        .sidebar_widget_holder h3,
                        .sidebar_widget_holder #wp-calendar caption,
                        .sidebar_widget_holder thead,
                        .bg-widget-title h3 a
                        {color: #<?php echo $titles_color?>}

                        blockquote p{color: #<?php echo $titles_color?>!important}
                        .current_page_item a{color: #<?php echo $link_color?>!important}

                        .speakers-folow ul li, .speakers-folow ul li a, .home-post-one-text p{color: #<?php echo $labes_and_links?>!important}

                        .home-post-one-text span p{color: #<?php echo $paragraph_color?>!important}

                       .header .nav ul li a, .shortcodes a, #tabs ul li a, .footer_box ul li a, .sidebar_widget_holder ul li a, .footer_box .sub-menu li a, .sidebar_widget_holder .sub-menu li a,
                        .footer_box ul li  .rsswidget, .sidebar_widget_holder ul li .rsswidget, .sidebar_widget_holder .recentcomments a, .footer_box .recentcomments a, .footer_box .twitter_ul span a, 
                        .sidebar_widget_holder .twitter_ul span a, .sidebar_widget_holder tfoot a, .footer_box tfoot a, .gallery-filter ul li a, .speakers-text a, .blog-title a, .blog-date a,
                        .blog-read-more a, .nav ul li .sub-menu a, .comment-start-title a, .copyright-text a, .nav ul  .current-menu-item .sub-menu li a
                        {color: #<?php echo $link_color?>;}

                        .nav ul  .current-menu-item .sub-menu li a
                        {color: #<?php echo $link_color?> !important;}

                         .nav ul  .current-menu-item .sub-menu li a:hover
                        {color: #<?php echo $link_hover_color?> !important;}

                       .header .nav ul li a:hover, .shortcodes a:hover, #tabs ul li a:hover, .footer_box ul li a:hover, .sidebar_widget_holder ul li a:hover, .footer_box .sub-menu li a:hover, .sidebar_widget_holder .sub-menu li a:hover,
                        .footer_box ul li  .rsswidget:hover, .sidebar_widget_holder ul li .rsswidget:hover, .sidebar_widget_holder .recentcomments a:hover, .footer_box .recentcomments a:hover, .footer_box .twitter_ul span a:hover,
                        .sidebar_widget_holder .twitter_ul span a:hover, .sidebar_widget_holder tfoot a:hover, .footer_box tfoot a:hover, .gallery-filter ul li a:hover, .speakers-text a:hover, .blog-title a:hover, .blog-date a:hover,
                        .blog-read-more a:hover, .nav ul li .sub-menu a:hover, .comment-start-title a:hover, .copyright-text a:hover
                        {color: #<?php echo $link_hover_color?>;}

                        .ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited, .cat_cell_active a {
                        color:#<?php echo $link_hover_color ?> !important;    }

                        .shortcodes h1, .shortcodes h2, .shortcodes h3 , .shortcode h4, .shortcodes h5, .shortcodes h6, .footer_box h2, .sidebar_widget_holder h2, .footer_box h2 .rsswidget,
                        .sidebar_widget_holder h2 .rsswidget, .program-title .headline, .speakers-row .partners-title, .blog-single .blog-title, .comment-start-title span, .text-slider span, .text-slider-noimage span,
                        .speaker_name, .slide-holder .header, .sidebar_widget_holder #calendar_wrap th, .footer_box #calendar_wrap th, #sidebar .sidebar_widget_holder #wp-calendar caption, #sidebar .footer_box #wp-calendar caption
                        
                        {color:#<?php echo $titles_color; ?>}

                        .shortcodes, .shortcodes ul li, .comment-start-text p, .text-slider-noimage p, .text-slider p, .sidebar_widget_holder .rssSummary, .footer_box .rssSummary, .footer_box cite,
                        .sidebar_widget_holder cite, .footer_box .textwidget, .sidebar_widget_holder .textwidget, .footer_box .newsletter span, .sidebar_widget_holder .newsletter span,
                        .footer_box .bg-widget-center span,  .sidebar_widget_holder .bg-widget-center span, .footer_box ul li, .sidebar_widget_holder ul li, .footer_box thead, .sidebar_widget_holder thead,
                        .footer_box #wp-calendar tr td, .sidebar_widget_holder #wp-calendar tr td, .footer_box #wp-calendar caption, .sidebar_widget_holder #wp-calendar caption, .footer_box ul  .rss-date,
                        .sidebar_widget_holder ul .rss-date, .footer-copyright span, #back-top, .slide-holder p, .blog-text p, .blog-comments-date .blog-comments, .blog-date, .cell_text, .shortcodes p, .hours-home-content,  .days-home-content, .minutes-home-content
                        {color:#<?php echo $paragraph_color; ?>}

                        .current-menu-item a, .cat_cell_active a{color: #<?php echo $link_color?>;}
                            
                        .business-conference-title span {
                            color:#<?php echo $colors_call_to_action_title ?>;
                        }
                        
                        .business-button-left {
                             background:url("<?php echo get_template_directory_uri() ?>/style/img/button-56-left<?php echo $button_back  ?>.png") no-repeat left top;
                        }
                        
                        .business-conference-title p {
                            color:#<?php echo $colors_call_to_action_undertitle ?>;
                        }
                        
                        .business-button-center {
                            background:url("<?php echo get_template_directory_uri() ?>/style/img/button-56-center<?php echo $button_back ?>.png") repeat-x left top;                       
                            color:#<?php echo $button_font_color; ?>;
                            text-shadow:0 1px #<?php echo $text_shadow; ?>;
                        }
                        
                        .business-button-right {
                            background:url("<?php echo get_template_directory_uri() ?>/style/img/button-56-right<?php echo $button_back; ?>.png") no-repeat left top;
                        }

                        .sidebar_widget_holder .tag-left, .footer_box .tag-left {
                            background: url("<?php echo get_template_directory_uri(); ?>/style/img/button<?php echo $button_back2; ?>-left.png") no-repeat !important;
                        }
                        .sidebar_widget_holder .tag-center, .footer_box .tag-center {
                            background: url("<?php echo get_template_directory_uri(); ?>/style/img/button<?php echo $button_back2; ?>-center.png") repeat-x !important;
                            color:#<?php echo $button_font_color ?>;
                            text-shadow: 1px 1px #<?php echo $text_shadow; ?> ;
                        }

                        .sidebar_widget_holder .tag-right, .footer_box .tag-right {
                            background: url("<?php echo get_template_directory_uri(); ?>/style/img/button<?php echo $button_back2; ?>-right.png") no-repeat !important;
                        }

                        .tickera_table #submit, .coupon .tickera_button, .ticket-quantity .tickera_button {
                            color: #<?php echo $button_font_color ?>;
                            text-shadow:0 1px #<?php echo $text_shadow ?> !important;
                            background: #<?php echo $plugin_button_color; ?>;
                            background: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $plugin_button_color; ?>), to(#<?php echo $plugin_button_color2; ?>));
                            background: -moz-linear-gradient(top,  #<?php echo $plugin_button_color; ?>,  #<?php echo $plugin_button_color2; ?>);
                            filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $plugin_button_color; ?>', endColorstr='#<?php echo $plugin_button_color2; ?>');
                            border: solid 1px #<?php echo $button_font_color; ?>;
                        }

                        .tickera_table #submit:hover, .coupon .tickera_button:hover, .ticket-quantity .tickera_button:hover{
                            background: #f78d1d;
                            background: -webkit-gradient(linear, left top, left bottom, from(#<?php echo $plugin_button_color2; ?>), to(#<?php echo $plugin_button_color; ?>));
                            background: -moz-linear-gradient(top, #<?php echo $plugin_button_color2; ?>,  #<?php echo $plugin_button_color; ?>);
                            filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $plugin_button_color2; ?>', endColorstr='#<?php echo $plugin_button_color; ?>');
                        }

                        .nav ul .current-menu-item a{
                            color:#<?php echo $link_hover_color; ?> !important;
                        }

                    </style>

             

        <?php

        /*************************************************************/
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/

            wp_enqueue_script("jquery");
            wp_enqueue_script('jqueryiu', get_template_directory_uri().'/script/jquery/jquery-ui-1.8.16.custom.min.js' );
            wp_enqueue_script('superfish', get_template_directory_uri().'/script/menu/superfish.js' );
            wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js' );
            wp_enqueue_script('pirobox', get_template_directory_uri().'/script/pirobox/js/pirobox.js' );
            wp_enqueue_script('easing', get_template_directory_uri().'/script/easing/jquery.easing.1.3.js' );
            wp_enqueue_script('anything', get_template_directory_uri().'/script/anythingslider/js/jquery.anythingslider.js' );
            wp_enqueue_script('counter', get_template_directory_uri().'/script/countdown/jquery.countdown.js' );
            wp_enqueue_script('horizontal', get_template_directory_uri().'/script/horizontal/jquery.jcarousel.min.js' );
            wp_enqueue_script('nivoSlider', get_template_directory_uri().'/script/nivoSlider/jquery.nivo.slider.pack.js' );
            wp_enqueue_script('jscolor', get_template_directory_uri().'/script/jscolor/jscolor.js' );
            wp_enqueue_script('flexSlider', get_template_directory_uri().'/script/flexslider/jquery.flexslider.js' );
            wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.min.js' );
            wp_enqueue_script('ajaxpager', get_template_directory_uri() . '/script/quickpager/quickpager.jquery.js');
            wp_enqueue_script('spiner', get_template_directory_uri().'/script/spiner/spin.min.js' );
            wp_enqueue_script('scrollbutton', get_template_directory_uri().'/script/scroll-button/scroll-button.js' );
            
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
      
    	<div class="wrapper">

            <!--LOGO-->
            <div class="logo left">
               <?php
                    $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                    if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
            </div><!-- logo -->
            
            <!--SOCIAL ICONS-->
          <?php
            $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
            $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
            $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
            $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
            $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
            $linkedin = get_theme_option(tk_theme_name.'_social_linkedin');
            $emailaddress =  get_option('admin_email');
            if( $enable_rss == true || !empty ($twitter_acc)  || !empty ($facebook_acc) || !empty($facebook_acc) || !empty($rss_acc) || !empty($google_acc)){
            ?>
            <div class="stay-tuned right">
                <ul>
                    <li><span><?php _e('Stay tuned', tk_theme_name); ?></span></li>
                    <?php if($twitter_acc) { ?>
                    <li><a href="<?php echo $twitter_acc; ?>" class="stay-tuned-1 left"></a></li>
                    <?php } ?>

                    <?php if($facebook_acc) { ?>
                        <li><a href="<?php echo $facebook_acc ?>" class="stay-tuned-2 left"></a></li>
                    <?php } ?>

                    <?php if($rss_acc) { ?>
                       <?php if ($enable_rss == false || $enable_rss[0] == ''){ } else{ if(!empty($rss_acc )){ ?><li><a href="<?php echo $rss_acc; ?>" class="stay-tuned-3 left"></a></li><?php } else { ?><li><a href="<?php echo get_bloginfo('rss2_url'); ?>" class="stay-tuned-3 left"></a></li><?php } }?>
                    <?php } ?>
                        
                    <?php if($linkedin) { ?>
                        <li><a href="<?php echo $linkedin; ?>" class="stay-tuned-4 left"></a></li>
                    <?php } ?>
                    <?php if($google_acc) { ?>
                        <li><a href="<?php echo $google_acc ?>" class="stay-tuned-5 left"></a></li>
                    <?php } ?>
                    <li><a href="mailto:<?php echo $emailaddress; ?>" class="stay-tuned-6 left"></a></li>
                </ul>
            </div><!--/stay-tuned-->

            <?php }?>



    <div class="nav left">
        
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
                </div>
           


            <div class="header-border-down left"></div></div><!--/header-border-down-->


        </div><!--/wrapper-->
    </div><!--/header-->
