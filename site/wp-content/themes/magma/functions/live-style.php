<?php
require( '../../../../wp-load.php' );
$theme_name = 'magma_';

$tabs = array(

    /***********************************************************************/
    /***********************  STYLE SETTINGS  ******************************/
    /***********************************************************************/

 array(
        'id' => 'site_colors',
        'title' => 'Site Colors',
        'priority' => 35,
        'fields' => array(
            array(
                'id' => $theme_name.'theme_color',
                'selector' => '#container .header-style-2 .category-header .navbar-nav > li > a:hover, #container .header-style-2 .category-header .navbar-nav > li > a:focus, #container .header-style-2 .category-header .navbar-default .navbar-nav > .active > a, .half-width-posts a:hover, .woocommerce .shipping-calculator-button:before, .woocommerce .addresses .address a:before, table.shop_table tbody .order td .button, .footer-widgets .block ul li a:hover, .sidebar-content .block ul li a:hover, .star-rating span:before, .woocommerce .product .tk-shop-title-link a:hover, .archive-page ul li a:hover, .contact-form .captcha-holder .refresh-text a:hover, .twitter-links, .latest-reciews-widget a:hover, #comments .meta-data a:hover, #container .pagination li a:hover, #container .pagination .page-numbers:hover, .st-menu ul li a:hover, .rss-date, #wp-calendar a, .footer-widgets .block ul li a:hover, .sidebar-content .block ul li a:hover, #container .container .rating li strong a:hover, .full-width-posts a:hover, .footer-widgets .block .tk-latest-posts-widget a:hover, .sidebar-content .block .tk-latest-posts-widget a:hover, a, .latest-reciews-widget ul li:hover, .footer-widgets .block ul.tk-latest-posts-widget li:hover, .sidebar-content .block ul.tk-latest-posts-widget li:hover, .single-review .single-review-top, #container .dropdown-menu, #container .navbar-nav > li > a:hover, #container .navbar-nav > li > a:focus, #container .navbar-default .navbar-nav > .active > a, #container .pagination li a:hover, #container .pagination .page-numbers:hover, .latest-reciews-widget ul li:hover p, .aq-block-aq_allposttypes_block .news-wrap .img-post figure:hover, .footer-widgets .block .widget_shopping_cart_content .buttons a, #sidebar .block .widget_shopping_cart_content .buttons a, .onsale, .footer-widgets .block .price_slider_amount button.button, #sidebar .block .price_slider_amount button.button, #container .contact-form button:hover, #container .contact-form button:focus, #container .tag-widget a:hover, .single-review .single-review-top span, .newsletter-icon, body .progress .bar, #container .tagcloud a:hover, .sb-readmore, .sb-readmore span, .sb-readmore a, .sb-readmore a:visited, .shipping-calculator-form button[name="calc_shipping"], .shop_table .actions input.button, input[type="submit"], .woocommerce .button, .tk-header-cart-holder a.cart-contents span, .footer-widgets .block .product_list_widget li a img:hover, #sidebar .block .product_list_widget li a img:hover, .woocommerce table td img:hover, .shortcodes .sticky.featured-banner, .category-page .full-width-posts .block.featured-post .featured-banner, .rating-value, .pb-rating-value, .tk-header-cart-holder .widget_shopping_cart_content .buttons a, .half-width-posts a.link-home-images:hover, .full-width-posts a.link-home-images:hover',
                'type' => 'option',
                'value' => '#fe4445',
                'label' => 'Choose Main Theme Color',
                'desc' => '',
                'options' => 'color background-color border-top background border',
                'priority' => 1,
            ),
            
            array(
                'id' => $theme_name.'header_color',
                'selector' => '#container .header-style-2 .category-header .navbar-nav > li > a strong, #container > header',
                'type' => 'option',
                'value' => '#000000',
                'label' => 'Choose Header Background Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 2,
            ),
            array(
                'id' => $theme_name.'selector_color',
                'selector' => '::selection, ::-moz-selection',
                'type' => 'option',
                'value' => '#fe4445',
                'label' => 'Choose Selector Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 3,
            ),
        ),
    ),
    
);

/*************************************************************/
/************   PASTE ARRAY HERE    **************************/
/*************************************************************/
?>
( function( $ ) {


        wp.customize( '<?php echo $theme_name.'theme_color'?>', function( value ) { 
            value.bind( function( newval ) { 
                jQuery('.footer-widgets .block span.rss-date, .navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus, .navbar .nav > li > a:hover, .navbar .nav > li > a:focus, .comment-form .cta, .banner.banner-background, .gallery-filter .gallery-filter-nav ul li a ').css('background-color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'theme_hover_color'?>', function( value ) { 
            value.bind( function( newval ) { 
                jQuery('.shortcodes a:hover, .comment-form a:hover, .post-author-info a:hover, #sidebar .block a:hover, .comment-form .cta:hover').css('color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'navigation_text_color'?>', function( value ) {
            value.bind( function( newval ) { 
                jQuery('.dropdown-menu > li.menu-item > a, .navbar .nav > li.menu-item  > a').css('color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'footer_color'?>', function( value ) {
            value.bind( function( newval ) { 
                jQuery('.footer-widgets').css('background-color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'footer_title_color'?>', function( value ) {
            value.bind( function( newval ) { 
                jQuery('.footer-widgets .block h6, .footer-widgets .block h6 a.rsswidget').css('background-color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'footer_text_color'?>', function( value ) {
            value.bind( function( newval ) { 
                jQuery('.footer-widgets #recentcomments li a:last-child, .textwidget, .footer-widgets .block a, .footer-widgets .block span, .footer-widgets .block p, .footer-widgets ul li cite, .footer-widgets .block ul li a, .rssSummary').css('background-color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'copyright_color'?>', function( value ) {
            value.bind( function( newval ) { 
                jQuery('.navbar-inverse .navbar-inner, .dropdown-menu').css('background-color', newval );
            });
        });
        wp.customize( '<?php echo $theme_name.'header_color'?>', function( value ) {
            value.bind( function( newval ) { 
                jQuery('.footer-copyright').css('background-color', newval );
            });
        });


<?php foreach ($tabs as $one_tab) {
            foreach ($one_tab['fields'] as $one_setting){
    ?>

    <?php if($one_setting['type'] == 'option'){?>
        wp.customize( '<?php echo $one_setting['id']?>', function( value ) {
            value.bind( function( newval ) {
                $('<?php echo $one_setting['selector']?>').css('<?php echo $one_setting['options']?>', newval );
            } );
        } );
    <?php } // check if type is option?>

    <?php if($one_setting['type'] == 'select'){?>
        wp.customize( '<?php echo $one_setting['id']?>', function( value ) {
            value.bind( function( newval ) {
                $('<?php echo $one_setting['selector']?>').attr('style', 'background:url('+newval+')');
            } );
        } );
    <?php } // check if type is select?>

    <?php if($one_setting['type'] == 'radio'){?>
        wp.customize( '<?php echo $one_setting['id']?>', function( value ) {
            value.bind( function( newval ) {
                if(newval == 'boxed'){
                    $('<?php echo $one_setting['selector']?>').removeClass('container-fullwhite');
                }
                if(newval == 'full_width'){
                    $('<?php echo $one_setting['selector']?>').addClass('container-fullwhite');
                }
            } );
        } );
    <?php } // check if type is radio?>

    <?php if($one_setting['type'] == 'test'){?>
        wp.customize( '<?php echo $one_setting['id']?>', function( value ) {
            value.bind( function( newval ) {
                $('<?php echo $one_setting['selector']?>').css('<?php echo $one_setting['options']?>', newval );
            } );
        } );
    <?php } // check if type is option?>



<?php } // foreach fields
} // foreach tabs?>

} )( jQuery );