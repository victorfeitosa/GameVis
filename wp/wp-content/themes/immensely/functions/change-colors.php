<?php

$theme_name = 'immensely_';


/*************************************************************/
/********************   COLOR SCHEME    **********************/
/*************************************************************/

$theme_color  = get_option($theme_name.'theme_color', '');
$theme_hover_color  = get_option($theme_name.'theme_hover_color', '');
$header_background_color = get_option($theme_name.'header_color', '');
$footer_color = get_option($theme_name.'footer_color','');
$footer_title_color = get_option($theme_name.'footer_title_color','');
$footer_text_color = get_option($theme_name.'footer_text_color','');
$navigation_text_color = get_option($theme_name.'navigation_text_color','');
$copyright_color = get_option($theme_name.'copyright_color','');


if(empty($theme_color)) {
    $theme_color = '#436BB8';
}

if(!empty($theme_color)) {
?>

<style type="text/css">
    .link-post-big .link > a, .link-post-big .link a:hover, .quote-post-big blockquote p, .shortcodes blockquote.quote-single p, .shortcodes a.icon-link:hover,
    .footer-widgets #recentcomments li a:hover, #sidebar .block ul li a:hover, .footer-widgets .block ul li a:hover, .footer-widgets #recentcomments li a:hover, .footer-widgets #recentcomments li, #sidebar #recentcomments li, .meta-data .categories a, .post-big h4 a:hover, a, .img-post .post h6 a:hover, .meta-data ul li a, .meta-data ul.gallery-categories {        
        color: <?php echo $theme_color  ?>
    }
    
    .footer-widgets .block span.rss-date, .navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus, .navbar .nav > li > a:hover, .navbar .nav > li > a:focus, .comment-form .cta, .banner.banner-background, .gallery-filter .gallery-filter-nav ul li a {        
        background-color: <?php echo $theme_color  ?>;
    }
    
    .shortcodes a:hover, .comment-form a:hover, .post-author-info a:hover, #sidebar .block a:hover {
        color: <?php echo $theme_hover_color ?>;
    }
    
    .comment-form .cta:hover {
        background-color: <?php echo $theme_hover_color;?>
    }
    
    .navbar-inverse .navbar-inner, .dropdown-menu, .search-big form input {
        background-color: <?php echo $header_background_color; ?>
    }
    
    @media all and (max-width: 979px){
        .search-big {background-color: <?php echo $header_background_color  ?>;}
    }
    
    .dropdown-menu > li.menu-item > a, .navbar .nav > li.menu-item  > a, .navbar .nav > li a i, .nav .dropdown-menu .fa-plus {
        color: <?php echo $navigation_text_color; ?>
    }
    
    .footer-widgets {
        background-color: <?php echo $footer_color; ?>
    }
    
    .footer-widgets .block h6, .footer-widgets .block h6 a.rsswidget {
        color: <?php echo $footer_title_color; ?>
    }
    
    .footer-widgets #recentcomments li a:last-child, .textwidget, .footer-widgets .block a, .footer-widgets .block span, .footer-widgets .block p, .footer-widgets ul li cite, .footer-widgets .block ul li a, .rssSummary {
        color: <?php echo $footer_text_color; ?>
    }
    
    
    .footer-copyright {
       background-color:<?php echo $copyright_color; ?>
    }
    
    .navbar .nav > li.menu-item.active > a,
    .navbar .nav > li.menu-item > a:hover {color: #fff}
    
    </style>
 <?php  } ?>