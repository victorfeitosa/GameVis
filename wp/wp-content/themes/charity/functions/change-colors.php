<?php

$theme_name = 'charity_';


/*************************************************************/
/********************   COLOR SCHEME    **********************/
/*************************************************************/

$theme_color  = get_option($theme_name.'theme_color', '');
$theme_hover_color  = get_option($theme_name.'theme_hover_color', '');


if(empty($theme_color)) {
    $theme_color = '#00acee';
}

if(!empty($theme_color)) {
?>

<style type="text/css">
    a, h1, h2, h3, h4, h5, h6, .top-content-text p a,  .top-content-text a, .top-content-text ul li span, #sidebar .block .twitter_ul li a, #sidebar #wp-calendar caption, .footer-widgets #wp-calendar caption,
    #sidebar .block .post-date, .breadcrumb li a, h1.title-divider .bread-bullet, .page-404 .container a, .blog-page table.table td p, #sidebar #wp-calendar thead tr th, .footer-widgets #wp-calendar thead tr th,
    a.link-post, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover,  .navbar-inverse .nav a:hover,  .navbar-inverse .nav .active > a:focus {        
        color: <?php echo $theme_color  ?>
    }
    
    #commentform button.btn, .image-relative .home-meta-ul li, .gallery-filter .active, .contact-form input.btn, .plus-up, .plus-hor, .top-content-image ul li, #sidebar #wp-calendar tfoot, .footer-widgets #wp-calendar tfoot,
    .blog-page table.table td.span2, .pagination .current, .blog-player, .home-audio-player {
        background-color: <?php echo $theme_color  ?>;
    }
    
    .top-content-text p a:hover, body .gallery-filter a:hover, .home-directors .top-content-text ul li a:hover .top-content-text a:hover,  #sidebar .block .twitter_ul li a:hover, .footer-widgets ul li a:hover, body .top-content-text h3 a:hover,.navbar .nav > li > a:hover,
     .breadcrumb li a:hover, h1.title-divider .bread-bullet, .page-404 .container a:hover, a.link-post:hover, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:hover,  .navbar-inverse .nav a:hover,  .navbar-inverse .nav .active > a:focus {
        color: <?php echo $theme_hover_color ?>;
    }
    
    .navbar-inverse .navbar-inner, .footer-widgets .span3 {
        border-color: <?php echo $theme_color; ?>;
    }
    
    .contact-form input.btn:hover {
        background-color: <?php echo $theme_hover_color ?>;
    }
    
    </style>
 <?php  } ?>