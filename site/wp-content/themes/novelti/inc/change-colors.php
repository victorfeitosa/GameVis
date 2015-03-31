<?php
$theme_name = 'novelti_';
        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/



    $theme_color  = get_option($theme_name.'theme_color', '#30549a');
    $navigation_background  = get_option($theme_name.'nav_background_color', '#1f232a');
    $nav_color  = get_option($theme_name.'nav_color', '#fff');
    $header_background  = get_option($theme_name.'header_background', '#272c34');
    $footer_text_color  = get_option($theme_name.'footer_text_color', '#d8d8d8');
    $widget_headline_color  = get_option($theme_name.'footer_headline_color', '#fff');
    $nav_color_hover  = get_option($theme_name.'nav_color_hover', '#31559c');


    ?>

<style type="text/css">

    .footer, .content {
        border-top-color:<?php echo $theme_color; ?>;
    }
    
    
    .footer_box #wp-calendar thead th, .header-big-menu .sub-menu,  .footer_box .tagcloud a, .footer_box #searchform, .footer_box .twitter_ul span.twitter-links, .footer .post-date, .text-slider-one, .bg-slider-fans .flexslider .flex-direction-nav li a, .text-slider-two, .text-slider-three, .footer_box .newsletter .bg-newsletter-input, .header-big-menu ul li {
        background-color:<?php echo $theme_color; ?>;
    }
    
    .footer_box .textwidget a {color:<?php echo $theme_color; ?>;}
    
    .footer_box ul li a:hover, .footer-copyright-text a:hover, .footer_box .recentcomments a:hover, .footer_box .box-twitter-center a:hover, .footer_box #recentcomments li a:hover, .footer_box tfoot a:hover {
        color:<?php echo $theme_color; ?>;
    }

    .nav, .header .nav .sub-menu {
        background-color:<?php echo $navigation_background; ?>;
    }
    
    .nav ul li a:link, .nav ul li a:visited, .header-date {
        color:<?php echo $nav_color; ?>;
    }
    
    .header, .bg-slider-fans, .footer {
        background-color:<?php echo $header_background; ?>;
    }
    
    .footer_widget_holder h2, .footer_widget_holder h2 .rsswidget {
        color:<?php echo $widget_headline_color; ?>;
    }
    
    .footer_box ul li a, .footer_box .textwidget, .footer_box .textwidget a:hover,  .footer_box .textwidget p,  .footer_box .box-twitter-center span, .footer_box .box-twitter-center a, .footer_box #recentcomments li, .footer_box #recentcomments li a, .footer_widget_holder .rss-date, .footer_widget_holder ul li .rssSummary, .footer_widget_holder ul li cite,  .footer_box #wp-calendar caption {
        color:<?php echo $footer_text_color; ?>;
    }
    
    .footer_box .tagcloud a:hover {
        background-color:<?php echo $footer_text_color; ?>;
    }
    
    .nav .sf-menu .sub-menu li a:hover {
        color:<?php echo $nav_color_hover; ?>;
    }
    
    

    
    

</style>                      