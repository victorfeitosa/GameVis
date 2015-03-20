<?php

$theme_name = 'photex_';


/*************************************************************/
/********************   COLOR SCHEME    **********************/
/*************************************************************/

$theme_color  = get_option($theme_name.'theme_color', '');
$header_background_color = get_option($theme_name.'header_color', '');
$selector_color = get_option($theme_name.'selector_color', '');


if(empty($theme_color)) {
    $theme_color = '#fd9e21';
}

if(!empty($theme_color)) {
?>

<style type="text/css">
    .archive-cat-name, .blog nav .social a:hover, .woocommerce-info a, .tk-header-cart-holder .widget_shopping_cart a:hover, .tk-header-cart-holder .widget_shopping_cart .total .amount, .tk-header-cart-holder .product_list_widget .amount, .full-width-sly-wrapper .slide-data .post-name a:hover, .social a:hover, .star-rating span:before, .star-rating:before, .filter-trigger, .gallery-item .img-meta a:hover p, .full-width-sly-wrapper .pages li.active, .likes a.liked, .masonry .likes a.liked, .likes a:hover, .masonry .likes a:hover, .blog .social a:hover, a:hover, a:focus, .navbar-default .navbar-nav li > a:hover, .navbar-default .navbar-nav li > a:focus {
        color: <?php echo $theme_color; ?>
    }

    .contact-form .control-group button.cta:hover, .tk-header-cart-holder .widget_shopping_cart .buttons a:hover, .tk-header-cart-holder, body .progress .bar, input[type="submit"]:hover, .portfolio-slider .prev:hover, .portfolio-slider .next:hover, #scrollbar .handle, .md-content .btn:hover, .md-content .close, .post .shout.link, .post .shout.quote, .post-slider .pages li:hover, .post-slider .pages li.active, .img-options .btn-wrapper a:hover, .btn-sm:before, .primary-color-btn {
        background-color: <?php echo $theme_color; ?>
    }

    .blog nav .social a:hover, .tk-header-cart-holder .widget_shopping_cart a:hover img, .tk-header-cart-holder .widget_shopping_cart .buttons a, .social a:hover, .portfolio-slider .prev:hover, .portfolio-slider .next:hover, .gallery-item .img-meta, .full-width-sly-wrapper .slide-data .pages-wrapp, .full-width-sly-wrapper .slide-data .post-data, .md-content .btn, .post-slider .pages li:hover, .post-slider .pages li.active, .img-options .btn-wrapper a:hover {
        border-color: <?php echo $theme_color; ?>
    }
    
    .md-content > div {
        border-top: 2px solid <?php echo $theme_color; ?>
    }

    .tk-header-cart-holder .widget_shopping_cart {
        border-bottom: 3px solid <?php echo $theme_color; ?>
    }

    .tk-header-cart-holder a {color: #fff;}

</style>
<?php  } ?>