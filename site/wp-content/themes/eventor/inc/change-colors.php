<?php
$theme_name = 'eventor_';
        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/

    $header_backgorund = get_option($theme_name.'header_color');
    $slider_bg_color = get_option($theme_name.'slider_background');
    $footer_link_hover = get_option($theme_name.'footer_link_hover_color');
    $call_to_action_color = get_option($theme_name.'call_to_action_color');
    $theme_color = get_option($theme_name.'theme_colors');
    $footer_title_color  = get_option($theme_name.'footer_title_color', '');
    $body_background  = get_option($theme_name.'body_color');
    $footer_widgets_color  = get_option($theme_name.'footer_widgets_color', '');
    $footer_paragraph_color  = get_option($theme_name.'footer_paragraph_color', '');
    $theme_color_hover = get_theme_option($theme_name.'theme_color_hover');
    $call_to_action_title = get_theme_option($theme_name.'call_to_action_title');
    $call_to_action_undertitle = get_theme_option($theme_name.'call_to_action_undertitle');
    $call_to_action_text = get_theme_option($theme_name.'call_to_action_text');
    $heading_color = get_theme_option($theme_name.'title_and_headings');
    $menu_color = get_theme_option($theme_name.'menu_color');
    $menu_hover_color = get_theme_option($theme_name.'menu_hover_color');
    
    if(empty($theme_color_hover)){$theme_color_hover == '#ff6825';}
    ?>

<style type="text/css">

    body {
        background-color:<?php echo $body_background; ?>!important;
    }
    
    .nav ul li a:link, .nav ul li a:visited {
        color: <?php echo $menu_color; ?>!important;
    }
    
    .nav ul li a:hover, .nav ul li.active a, .sf-menu .sub-menu a:hover, .nav nav .sf-menu li.current-menu-item > a {
        color: <?php echo $menu_hover_color; ?>!important;
    }
    
    .slider-home {
        background-color:<?php echo $slider_bg_color; ?>
    }
  
    .header {
        background: <?php echo $header_backgorund; ?>;
    }
    
    .home-ticket-box-center {
        background: <?php echo $call_to_action_color; ?>;
    }

    .footer {
        background-color:<?php echo $footer_widgets_color; ?>;
    }
    
    .home-ticket-box-center .call-to-action-title {
        color: <?php echo $call_to_action_title; ?>
    }
    
    .home-ticket-box-center span {
        color: <?php echo $call_to_action_undertitle; ?>
    }
    
    .home-ticket-box-center .shortcodes p {
        color: <?php echo $call_to_action_text; ?>!important
    }
    
    .shortcodes a:hover, .shortcodes p a:hover, .shortcodes p, .home-speaker-excerpt, .blog-one-text, .sidebar_widget_holder ul li a, .sidebar_widget_holder .textwidget p, .sidebar_widget_holder ul li, .comment-start-text p, .comment-start-text a:hover, .sidebar_widget_holder .textwidget, .sidebar_widget_holder .newsletter span, .sidebar_widget_holder tbody, .blog-categories ul li span, .tabs .tab div, .call-to-action-shortcode .home-call-action-text p, .shortcodes, .shortcodes ol li, .speakers-text p, .home-ticket-box-center a:hover, .home-post-one-text a:hover, .sticky, .textwidget a:hover, .shortcodes ul li, .speakers-text a:hover {
        color: <?php echo $theme_color; ?>!important;
    }
    
    .shortcodes a, .shortcodes p a, .home-post-center-content h5 a, .home-post-one-text a, .footer-copy-content span a, .blog-categories ul li a:hover, .post-link-down a, .blog-one-title a:hover, .sidebar_widget_holder ul li a:hover, .sidebar_widget_holder li.recentcomments, .textwidget a, .sidebar_widget_holder ul li a:hover, .title-page-content span, .sidebar_widget_holder tfoot a:hover, .sidebar_widget_holder .post-date, .sidebar_widget_holder .rss-date, .home-post-one-button a:hover, .sidebar_widget_holder h3 .rsswidget:hover, .pagination span, .pagination a:hover, .sidebar_widget_holder .current-menu-item a, .sidebar_widget_holder .tag-center:hover, .comment-start-title a, .comment-start-text a, .form input.search-submit-button:hover, .sidebar_widget_holder #s input.search-submit-button:hover, .toggle-holder span, .tabs .ui-state-active a, .tabs .ui-state-active a:link, .tabs .ui-state-active a:visited, .tabs .ui-state-default a, .tabs .ui-state-default a:link, .tabs .ui-state-default a:visited, .speakers-text a, .speakers-filter a.active, .speakers-filter a:hover, .speakers-single-text h6, .home-ticket-box-center a, .home-ticket-box-right a:hover, .home-post-one-text.only-speakers .home-post-one-button a:hover, .speakers-folow ul li a:hover, .home-single-program h5 a {
        color: <?php echo $theme_color_hover; ?>!important;
    }
    
    .bg-sidebar-newsletter:hover .newsletter-icon, .links-header ul li:hover .soc-icon-bg, #back-top:hover span.soc-icon-bg {
        background: <?php echo $theme_color_hover; ?>;
    }
    
    h1, h2, h3, h4, h5, .sidebar_widget_holder h3 .rsswidget, .blog-one-title, .blog-one-title a, .sidebar_widget_holder #wp-calendar caption, .sidebar_widget_holder thead, .sidebar_widget_holder tfoot a {
        color: <?php echo $heading_color; ?>!important;
    }
    

    .footer_widget_holder h2, .footer_widget_holder h2 a.rsswidget {
        color:<?php echo $footer_title_color; ?>!important;
    }

     .footer_widget_holder .textwidget, .footer_widget_holder .textwidget p, .footer_widget_holder .box-twitter-center span, .footer_widget_holder .rsswidget, .footer_widget_holder .rssSummary, .footer_widget_holder cite, .footer_widget_holder .newsletter span, .footer_widget_holder .recentcomments a, .footer_widget_holder li a, .footer_widget_holder li, .footer_widget_holder .box-twitter-center a:hover, .footer_widget_holder .textwidget a:hover {
        color:<?php echo $footer_paragraph_color; ?>!important;
    }
    
    .footer_widget_holder .box-twitter-center a, .footer_widget_holder .tagcloud .tag-center:hover, .footer_widget_holder .twitter_ul span.twitter-links, .footer_widget_holder .rss-date, .footer_widget_holder .twitter_ul span.twitter-links, .footer_widget_holder li a:hover, .footer_widget_holder .recentcomments a:hover, .footer_widget_holder #recentcomments li, .footer_widget_holder .textwidget a, .footer_widget_holder .post-date, .footer-copy-content span a:hover {
        color: <?php echo $footer_link_hover; ?>!important;
    }
</style>