
<?php

        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/



    $body_background  = get_option('body_color', '#fff');
    $headline_colors  = get_option('headline_colors', '#515050');
    $header_background  = get_option('header_background_pattern');
    $paragraph_colors  = get_option('paragraph_colors', '#555555');
    $footer_background  = get_option('footer_background', '#494949');
    $footer_text_color = get_option('footer_text_color', '#d8d8d8');
    $footer_headlines_colors = get_option('footer_headlines_color', '#fff');
    $footer_link_color = get_option('footer_link_color','#d8d8d8');
    $footer_border_color = get_option('footer_border_color','#d8d8d8');


    if(empty($header_background)) {
        $header_background  = get_template_directory_uri().'/style/img/pat1.png';
    }
    ?>

<style type="text/css">

    body {
        background-color:<?php echo $body_background; ?>;
    }

    .shortcodes h1, .shortcodes h2, .shortcodes h3, .shortcodes h4, .shortcodes h5, .shortcodes h6, .title-page h1, .form h2 {
        color: <?php echo $headline_colors; ?>;
    }

    .shortcodes, .shortcodes p, .shortcodes a, .shortcodes ol li, .shortcodes ul li, .shortcodes blockquote p, .pagination .page-numbers {
        color:<?php echo $paragraph_colors; ?>;
    }

    .shortcodes blockquote p {
        border-left:2px solid <?php echo $paragraph_colors; ?>;
    }

    .footer {
        background-color:<?php echo $footer_background; ?>;
    }

   .footer .footer_box ul li, .footer .footer_box .newsletter span, .footer_box .box-twitter-center span, .footer_box #wp-calendar caption, .footer_box #recentcomments li, .footer_box .rss-date, .footer .footer_box .twitter-links,
   .rssSummary, .footer_box cite, .footer-text, .footer_box .textwidget, .footer_box .textwidget p, .footer_box_holder .post-date, .footer_box #calendar_wrap th, .footer_box #wp-calendar tr td, .footer_box .twitter_ul span.twitter-links {
        color:<?php echo $footer_text_color; ?>;
    }

    .footer_box h2 {
        color:<?php echo $footer_headlines_colors; ?>;
    }


    .footer_box li a, .footer-text a, .footer_box tfoot a, .footer_box tbody a, .footer_box .box-twitter-center a, .footer_box .twittime, .footer_box_holder .rsswidget, .footer_box .sub-menu li a, .footer_box .recentcomments a {
        color:<?php echo $footer_link_color; ?>
    }

   body .footer {
        border-top:4px solid <?php echo $footer_border_color; ?>;
    }

    .footer .slide a {
        background-color:<?php echo $footer_border_color; ?>;
    }


    body .header {
        background-image:url('<?php echo $header_background; ?>');
    }

  

</style>                      