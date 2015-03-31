<?php
$theme_name = 'cosily_';
        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/


    $top_bar  = get_option($theme_name.'top_bar', '');
    $border_colors  = get_option($theme_name.'border_color', '');
    $footer_widgets_color  = get_option($theme_name.'footer_widgets_color', '');
    $footer_copyright_color  = get_option($theme_name.'footer_copyright_color', '');
    $footer_title_color  = get_option($theme_name.'footer_title_color', '');
    $footer_link_hover_color  = get_option($theme_name.'footer_link_hover_color', '');
    $footer_paragraph_color  = get_option($theme_name.'footer_paragraph_color', '');
    $theme_colors  = get_option($theme_name.'theme_colors');
    $booking_colors  = get_option($theme_name.'booking_buttons');
    $booking_hover_colors  = get_option($theme_name.'booking_buttons_hover');
    ?>

<style type="text/css">
    
    .bg-top-bar {
        background: <?php echo $top_bar; ?>;
    }
    
    .bottom-slider-red, .footer-red-border, .red-action-room {
        background: <?php echo $border_colors; ?>;
    }

    .footer {
        background:<?php echo $footer_widgets_color; ?>;
    }

    .footer-copyright-text {
        color:<?php echo $footer_copyright_color; ?>;
    }

    .footer_box h2, .footer_widget_holder h2 a, .footer_box #wp-calendar caption, .footer_box thead {
        color:<?php echo $footer_title_color; ?>;
    }

    .footer_box ul li, .footer_box ul li a, .footer_box .recentcomments a, .footer_box .box-twitter-center span, .footer_box .box-twitter-center a, .footer_box .rss-date, .footer_box .textwidget p {
        color:<?php echo $footer_paragraph_color; ?>;
    }

   .footer_box .current-menu-item > a, .footer_box ul li a:hover, .footer_widget_holder h2 a:hover {
        color:<?php echo $footer_link_hover_color; ?>!important;
    }

    .home-rooms-one ul li a, .home-testimonials-one-title span, .shortcodes blockquote p, .current-menu-item > a, .nav ul li a:hover, .home-latest-news-title a, .blog-read-more a:hover, .search-rooms:hover, .home-latest-news-category ul li p a:hover, .blog-audio-info p, .current-menu-parent > a, .room-tab-title span, .room-only-content-right span, .booking-step-content span, .booking-step-content-left-top span, .reservation-summary-content-top span, .reservation-summary-content ul li span, .reservation-summary-content ul li p, .form-booking1-content span, .booking-step3-text span {
        color:<?php echo $theme_colors; ?>!important;
    }
    
    h1, h2, h3, h4, h5, h6, .home-latest-news-one-read-more a, .home-latest-news-one-title span a, .post-link-top a:hover, .post-link-down a, .post-link-down a.blog-page-link:hover, .blog-audio-info a:hover, .post-quote p a:hover, .post-quote p, .page-rooms-one-text .room-link, .room-night h5, .shortcodes a, .toggle-holder span, #tabs .ui-state-active a, #tabs .ui-state-active a:link, #tabs .ui-state-default a, #tabs .ui-state-default a:link, .room-single-title, .room-single-book-night span, .home-latest-news-title, .comment-start-title span, .comment-start-title a:hover, .page-404 span, .page-404 a, .tag-blog-single span, .tag-blog-single a:hover, .rsswidget, .sidebar_widget_holder ul li a:hover, .sidebar_widget_holder h3, .sidebar_widget_holder ul li a:hover, .sidebar_widget_holder .box-twitter-center a:hover, .sidebar_widget_holder #wp-calendar caption, .sidebar_widget_holder thead {
        color:<?php echo $theme_colors; ?>;
    }
    
    .shortcodes blockquote p {
        border-left: 3px solid <?php echo $theme_colors; ?>;
    }
    
    .home-latest-news .flex-direction-nav li .flex-prev:hover,  .home-latest-news .flex-direction-nav li .flex-next:hover, .nav-view-all a:hover, .nav-next a:hover, .nav-prev a:hover, .gallery-filter a:hover, .contact-button-map span, .tab-text-down a:hover, .booking-step-content-left-top a:hover {
        background-color:<?php echo $theme_colors; ?>;
    }
    
    .home-call-action-buttom a, .room-only-content-right a {
        background: <?php echo $booking_colors; ?>;
    }
    
    .home-call-action-buttom a:hover, .room-only-content-right a:hover {
        background: <?php echo $booking_hover_colors; ?>;
    }
    
    .page-rooms-one-text .details, .form-booking1-button input {
        background-color: <?php echo $booking_colors; ?>;
    }
    
    .page-rooms-one-text .details:hover, .form-booking1-button input:hover {
        background-color: <?php echo $booking_hover_colors; ?>;
    }
  
</style>                      