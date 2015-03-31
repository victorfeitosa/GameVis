<?php

$theme_name = 'magma_';


/*************************************************************/
/********************   COLOR SCHEME    **********************/
/*************************************************************/

$theme_color  = get_option($theme_name.'theme_color', '');
$header_background_color = get_option($theme_name.'header_color', '');
$selector_color = get_option($theme_name.'selector_color', '');


if(empty($theme_color)) {
    $theme_color = '#FE4445';
}

if(!empty($theme_color)) {
?>

<style type="text/css">
    .footer-widgets .post-date, #sidebar .post-date, .aq-block-aq_allposttypes_block .news-wrap .img-post .post h6 a:hover, .woocommerce-pagination .page-numbers li a:hover, #container .header-style-2 .category-header .navbar-nav > li > a:hover, #container .header-style-2 .category-header .navbar-nav > li > a:focus, #container .header-style-2 .category-header .navbar-default .navbar-nav > .active > a, .half-width-posts a:hover, .woocommerce .shipping-calculator-button:before, .woocommerce .addresses .address a:before, table.shop_table tbody .order td .button, .footer-widgets .block ul li a:hover, .sidebar-content .block ul li a:hover, .star-rating span:before, .woocommerce .product .tk-shop-title-link a:hover, .archive-page ul li a:hover, .contact-form .captcha-holder .refresh-text a:hover, .twitter-links, .latest-reciews-widget a:hover, #comments .meta-data a:hover, #container .pagination li a:hover, #container .pagination .page-numbers:hover, .st-menu ul li a:hover, .rss-date, #wp-calendar a, .footer-widgets .block ul li a:hover, .sidebar-content .block ul li a:hover, #container .container [class*="block-wrap-"] .rating li strong a:hover, #container .container .rating li strong a:hover, .full-width-posts a:hover, .footer-widgets .block .tk-latest-posts-widget a:hover, .sidebar-content .block .tk-latest-posts-widget a:hover, a {
        color: <?php echo $theme_color; ?>
    }

    #comments .media-list li.bypostauthor, .latest-reciews-widget ul li:hover, .footer-widgets .block ul.tk-latest-posts-widget li:hover, .sidebar-content .block ul.tk-latest-posts-widget li:hover, .single-review .single-review-top, #container .dropdown-menu, #container .navbar-nav > li > a:hover, #container .navbar-nav > li > a:focus, #container .navbar-default .navbar-nav > .active > a {
        border-top: 1px solid <?php echo $theme_color; ?>;
    }

    .aq-block-aq_allposttypes_block .news-wrap .img-post.no-image-padding:hover, #container .pagination li a:hover, #container .pagination .page-numbers:hover, .latest-reciews-widget ul li:hover p, .aq-block-aq_allposttypes_block .news-wrap .img-post figure:hover {
        border: 1px solid <?php echo $theme_color; ?>;
    }
    
    .footer-widgets .block .widget_shopping_cart_content .buttons a, #sidebar .block .widget_shopping_cart_content .buttons a, .onsale, .footer-widgets .block .price_slider_amount button.button, #sidebar .block .price_slider_amount button.button, #container .contact-form button:hover, #container .contact-form button:focus, #container .tag-widget a:hover, .single-review .single-review-top span, .newsletter-icon, body .progress .bar, #container .tagcloud a:hover, .sb-readmore, .sb-readmore span, .sb-readmore a, .sb-readmore a:visited, .shipping-calculator-form button[name="calc_shipping"], .shop_table .actions input.button, input[type="submit"], .woocommerce .button, .tk-header-cart-holder a.cart-contents span {
        background: <?php echo $theme_color  ?>;
    }

    .footer-widgets .block .product_list_widget li a img:hover, .woocommerce table td img:hover, .shortcodes .sticky.featured-banner, .category-page .full-width-posts .block.featured-post .featured-banner, .rating-value, .pb-rating-value, .tk-header-cart-holder .widget_shopping_cart_content .buttons a {        
        background-color: <?php echo $theme_color  ?>;
    }

    #sidebar .block .product_list_widget li a img:hover, .woocommerce-pagination .page-numbers li a:hover, .half-width-posts a.link-home-images:hover, .full-width-posts a.link-home-images:hover {
        border-color: <?php echo $theme_color  ?>;
    }
    
    #container .navbar-form .details-search, #container .header-style-2 .category-header .navbar-nav > li > a strong, #container > header {
        background-color: <?php echo $header_background_color; ?>;
    }

    ::selection {
        background: <?php echo $selector_color  ?>; 
    }

    ::-moz-selection {
        background: <?php echo $selector_color  ?>; 
    }
    
</style>
<?php  } ?>