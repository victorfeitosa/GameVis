<?php

$theme_name = 'legalized_';


/*************************************************************/
/********************   COLOR SCHEME    **********************/
/*************************************************************/

$body_bg_color  = get_option($theme_name.'body_bg_color', '');
$header_bg_color = get_option($theme_name.'header_bg_color');
$footer_bg_color  = get_option($theme_name.'footer_bg_color', '');

$widget_title_color  = get_option($theme_name.'widget_title_color', '');

$primary_color = get_option($theme_name.'primary_color');
$secondary_color = get_theme_option($theme_name.'secondary_color');
$tertiary_color = get_theme_option($theme_name.'tertiary_color');

$body_bg_image  = get_option($theme_name.'body_image');

?>

<style type="text/css">
    body {
        <?php if(isset($body_bg_image) && $body_bg_image !== ''){ ?>
            background-image:url(<?php echo $body_bg_image; ?>);
        <?php } ?>
        background-color:<?php echo $body_bg_color; ?>;
    }
    .top {
        background: <?php echo $header_bg_color; ?>;
    }
    footer, #sidebar{
        background-color:<?php echo $footer_bg_color; ?>;
    }
    .footer_widget .widget_title, .widget_title {
        color:<?php echo $widget_title_color; ?>;
    }
    a:hover, 
    .red, 
    .header_contact a:hover, 
    .navbar-inverse .brand, 
    .navbar-inverse .nav > li > a:hover, 
    .navbar-inverse .brand, 
    .navbar-inverse .nav > li > a:focus, 
    .navbar-inverse .brand, 
    .navbar-inverse .nav > li > a:active, 
    .navbar-inverse .nav > li.current-menu-ancestor > a, 
    .navbar-inverse .nav .active > a, 
    .navbar-inverse .nav .active > a:hover, 
    .navbar-inverse .nav .active > a:focus, 
    .navbar-inverse .nav li.dropdown.open > .dropdown-toggle, 
    .navbar-inverse .nav li.dropdown.active > .dropdown-toggle, 
    .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle, 
    .dropdown-menu > li:hover >a, 
    ul.nav > li:hover > a, 
    ul.nav li:hover > a, 
    h1.hero_heading span, 
    .ca-menu .ca-item, 
    .ca-menu .ca-item:hover .ca-main, 
    .vertical_tabs_content > h3, 
    .vertical_tabs_content > h3 > a, 
    .by > a:hover, .by ul li a:hover, 
    .vertical_tabs_content .read_more:hover, 
    .front h3, 
    .back h3, 
    .front h3 a, 
    .back h3 a, 
    #contact input.error, 
    #comment input.error, 
    .team_member h3, 
    .team_member h3 a, 
    .post_title a:hover, 
    .post_title.red a, 
    .comments a:hover,  
    .page-404 a, 
    .tagcloud a:hover, 
    #wp-calendar tfoot a, 
    .twitter_author a, 
    .twitter_author a:hover, 
    .widget_rss ul li a:hover, 
    .widget_meta ul li a:hover, 
    .widget_pages ul li a:hover, 
    .widget_archive ul li a:hover, 
    .widget_nav_menu ul li a:hover, 
    .widget_categories ul li a:hover, 
    .widget_recent_entries ul li a:hover, 
    .widget_recent_comments ul li a:hover, 
    .navbar-inverse .nav-collapse .nav li.active > a, 
    .navbar-inverse .nav-collapse .nav li.active > a:hover, 
    .navbar-inverse .nav-collapse .nav li.active > a:focus, 
    .navbar-inverse .nav-collapse .dropdown-menu a:hover,
    .accordion-heading .accordion-toggle:hover,
    .post_title.link_title a:hover,
    .post-link h3 a:hover,
    .tags_wrap a:hover,
    .widget_text a,
    .twitter_wrap a:hover,
    #content .blog_post .read_more:hover{
        color:<?php echo $primary_color; ?>;
    }

    .post_title.link_title a:hover{
        border-bottom: 1px solid <?php echo $primary_color; ?>;
    }


    body, a, .dropdown-menu > li > a, 
    ul.nav ul a, 
    .vertical_tabs_content .read_more, 
    .recent_comments_widget ul li a, 
    .recent_posts_widget ul li a, 
    #wp-calendar tbody, 
    #wp-calendar tbody a, 
    .twitter_wrap > a, 
    .widget_rss ul li a, 
    .widget_meta ul li a, 
    .widget_pages ul li a, 
    .widget_archive ul li a, 
    .widget_nav_menu ul li a, 
    .widget_categories ul li a, 
    .widget_recent_entries ul li a, 
    .widget_recent_comments ul li a,
    .post_title.link_title a,
    .post-link h3 a,
    .widget_text a:hover,
    .back h3 a:hover,
    .vertical_tabs_content > h3 > a:hover,
    .post_title.red a:hover{
        color:<?php echo $secondary_color; ?>;
    }


    .site_heading, 
    .header_contact, 
    .header_contact a, 
    .page_description, 
    .page_description a, 
    .by, 
    .by > a, 
    .by ul li a, 
    .vertical_tabs_content .by, 
    .team_member span{
        color:<?php echo $tertiary_color; ?>
    }

</style>


<?php

/*************************************************************/
/*****************   GOOGLE FONTS    *************************/
/*************************************************************/

$titles_font = get_option($theme_name.'typography_titles_font', '');
$subtitles_font = get_option($theme_name.'typography_subtitles_font', '');
$buttons_font = get_option($theme_name.'typography_buttons_font', '');
$body_font = get_option($theme_name.'typography_body_font', '');
$navigation_font = get_option($theme_name.'typography_navigation_font', '');

$titles_font_style = get_option($theme_name.'typography_titles_font_style', '');
$subtitles_font_style = get_option($theme_name.'typography_subtitles_font_style', '');
$buttons_font_style = get_option($theme_name.'typography_buttons_font_style', '');
$body_font_style = get_option($theme_name.'typography_body_font_style', '');
$navigation_font_style = get_option($theme_name.'typography_navigation_font_style', '');

?>

    <style type="text/css">

        <?php if($titles_font != 'tk_font_Select' || $titles_font != '' || $titles_font_style != '' ){?>
            .page_title,
            .post_title{
                <?php
                    if($titles_font != 'tk_font_Select' && $titles_font != ''){
                        echo ("font-family:".tk_get_font_name($titles_font).";");
                    }elseif($titles_font == 'tk_font_Select'){
                        echo 'font-family:"Merriweather", serif;';
                    }
                    if($titles_font_style != '' && $titles_font_style == 'regular'){
                        echo ("font-weight:normal;font-style:normal");
                    }elseif($titles_font_style != '' && $titles_font_style == 'bold'){
                        echo ("font-weight:bold;font-style:normal");
                    }elseif($titles_font_style != '' && $titles_font_style == 'italic'){
                        echo ("font-weight:normal;font-style:italic");
                    }elseif($titles_font_style != '' && $titles_font_style == 'bolditalic'){
                        echo ("font-weight:bold;font-style:italic");
                    }
                ?>
            }

        <?php } // end if fonts are selected?>

        <?php if($subtitles_font != 'tk_font_Select' || $subtitles_font != '' || $subtitles_font_style != '' ){?>
            .page_description{
                <?php
                    if($subtitles_font != 'tk_font_Select' && $subtitles_font != ''){
                        echo ("font-family:".tk_get_font_name($subtitles_font).";");
                    }elseif($subtitles_font == 'tk_font_Select'){
                        echo 'font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;';
                    }
                    if($subtitles_font_style != '' && $subtitles_font_style == 'regular'){
                        echo ("font-weight:normal;font-style:normal");
                    }elseif($subtitles_font_style != '' && $subtitles_font_style == 'bold'){
                        echo ("font-weight:bold;font-style:normal");
                    }elseif($subtitles_font_style != '' && $subtitles_font_style == 'italic'){
                        echo ("font-weight:normal;font-style:italic");
                    }elseif($subtitles_font_style != '' && $subtitles_font_style == 'bolditalic'){
                        echo ("font-weight:bold;font-style:italic");
                    }
                ?>
            }
        <?php } // end if fonts are selected?>

        <?php if($buttons_font != 'tk_font_Select' || $buttons_font != '' || $buttons_font_style != '' ){?>
            .ca-menu .ca-item a.more_link, .vertical_tabs_content .read_more, .service_wrap a.read_more, .blog_post .read_more{
                <?php
                    if($buttons_font != 'tk_font_Select' && $buttons_font != ''){
                        echo ("font-family:".tk_get_font_name($buttons_font).";");
                    }elseif($buttons_font == 'tk_font_Select'){
                        echo 'font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;';
                    }
                    if($buttons_font_style != '' && $buttons_font_style == 'regular'){
                        echo ("font-weight:normal;font-style:normal");
                    }elseif($buttons_font_style != '' && $buttons_font_style == 'bold'){
                        echo ("font-weight:bold;font-style:normal");
                    }elseif($buttons_font_style != '' && $buttons_font_style == 'italic'){
                        echo ("font-weight:normal;font-style:italic");
                    }elseif($buttons_font_style != '' && $buttons_font_style == 'bolditalic'){
                        echo ("font-weight:bold;font-style:italic");
                    }
                ?>
            }
        <?php } // end if fonts are selected?>

        <?php if($body_font != 'tk_font_Select' || $body_font != '' || $body_font_style != '' ){?>
             body{
                <?php
                    if($body_font != 'tk_font_Select' && $body_font != ''){
                        echo ("font-family:".tk_get_font_name($body_font).";");
                    }elseif($body_font == 'tk_font_Select'){
                        echo 'font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;';
                    }
                    if($body_font_style != '' && $body_font_style == 'regular'){
                        echo ("font-weight:normal;font-style:normal");
                    }elseif($body_font_style != '' && $body_font_style == 'bold'){
                        echo ("font-weight:bold;font-style:normal");
                    }elseif($body_font_style != '' && $body_font_style == 'italic'){
                        echo ("font-weight:normal;font-style:italic");
                    }elseif($body_font_style != '' && $body_font_style == 'bolditalic'){
                        echo ("font-weight:bold;font-style:italic");
                    }
                ?>
            }
        <?php } // end if fonts are selected?>

        <?php if($navigation_font != 'tk_font_Select' || $navigation_font != '' || $navigation_font_style != '' ){?>
            .navbar ul.nav a{
                <?php
                    if($navigation_font != 'tk_font_Select' && $navigation_font != ''){
                        echo ("font-family:".tk_get_font_name($navigation_font).";");
                    }elseif($navigation_font == 'tk_font_Select'){
                        echo 'font-family:"Merriweather", serif;';
                    }
                    if($navigation_font_style != '' && $navigation_font_style == 'regular'){
                        echo ("font-weight:normal;font-style:normal");
                    }elseif($navigation_font_style != '' && $navigation_font_style == 'bold'){
                        echo ("font-weight:bold;font-style:normal");
                    }elseif($navigation_font_style != '' && $navigation_font_style == 'italic'){
                        echo ("font-weight:normal;font-style:italic");
                    }elseif($navigation_font_style != '' && $navigation_font_style == 'bolditalic'){
                        echo ("font-weight:bold;font-style:italic");
                    }
                ?>
            }
        <?php } // end if fonts are selected?>

    </style>
