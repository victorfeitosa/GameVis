<?php
require( '../../../../wp-load.php' );
$theme_name = 'photex_';

$tk_tabs = array(

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
                'selector' => '.tk-header-cart-holder .widget_shopping_cart, .md-content > div, .blog nav .social a:hover, .tk-header-cart-holder .widget_shopping_cart a:hover img, .tk-header-cart-holder .widget_shopping_cart .buttons a, .social a:hover, .portfolio-slider .prev:hover, .portfolio-slider .next:hover, .gallery-item .img-meta, .full-width-sly-wrapper .slide-data .pages-wrapp, .full-width-sly-wrapper .slide-data .post-data, .md-content .btn, .post-slider .pages li:hover, .post-slider .pages li.active, .img-options .btn-wrapper a:hover, .contact-form .control-group button.cta:hover, .tk-header-cart-holder .widget_shopping_cart .buttons a:hover, .tk-header-cart-holder, body .progress .bar, input[type="submit"]:hover, .portfolio-slider .prev:hover, .portfolio-slider .next:hover, #scrollbar .handle, .md-content .btn:hover, .md-content .close, .post .shout.link, .post .shout.quote, .post-slider .pages li:hover, .post-slider .pages li.active, .img-options .btn-wrapper a:hover, .btn-sm:before, .primary-color-btn, .blog nav .social a:hover, .blog nav .social a, .woocommerce-info a, .tk-header-cart-holder .widget_shopping_cart a:hover, .tk-header-cart-holder .widget_shopping_cart .total .amount, .tk-header-cart-holder .product_list_widget .amount, .full-width-sly-wrapper .slide-data .post-name a:hover, .social a:hover, .star-rating span:before, .star-rating:before, .filter-trigger, .gallery-item .img-meta a:hover p, .full-width-sly-wrapper .pages li.active, .likes a.liked, .masonry .likes a.liked, .likes a:hover, .masonry .likes a:hover, .blog .social a:hover, a:hover, a:focus, .navbar-default .navbar-nav li > a:hover, .navbar-default .navbar-nav li > a:focus',
                'type' => 'option',
                'value' => '#fd9e21',
                'label' => 'Choose Main Theme Color',
                'desc' => '',
                'options' => 'color background-color border-top border-bottom background border-color',
                'priority' => 1,
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
                jQuery('.tk-header-cart-holder .widget_shopping_cart, .md-content > div, .blog nav .social a:hover, .tk-header-cart-holder .widget_shopping_cart a:hover img, .tk-header-cart-holder .widget_shopping_cart .buttons a, .social a:hover, .portfolio-slider .prev:hover, .portfolio-slider .next:hover, .gallery-item .img-meta, .full-width-sly-wrapper .slide-data .pages-wrapp, .full-width-sly-wrapper .slide-data .post-data, .md-content .btn, .post-slider .pages li:hover, .post-slider .pages li.active, .img-options .btn-wrapper a:hover, .contact-form .control-group button.cta:hover, .tk-header-cart-holder .widget_shopping_cart .buttons a:hover, .tk-header-cart-holder, body .progress .bar, input[type="submit"]:hover, .portfolio-slider .prev:hover, .portfolio-slider .next:hover, #scrollbar .handle, .md-content .btn:hover, .md-content .close, .post .shout.link, .post .shout.quote, .post-slider .pages li:hover, .post-slider .pages li.active, .img-options .btn-wrapper a:hover, .btn-sm:before, .primary-color-btn, .blog nav .social a:hover, .blog nav .social a, .woocommerce-info a, .tk-header-cart-holder .widget_shopping_cart a:hover, .tk-header-cart-holder .widget_shopping_cart .total .amount, .tk-header-cart-holder .product_list_widget .amount, .full-width-sly-wrapper .slide-data .post-name a:hover, .social a:hover, .star-rating span:before, .star-rating:before, .filter-trigger, .gallery-item .img-meta a:hover p, .full-width-sly-wrapper .pages li.active, .likes a.liked, .masonry .likes a.liked, .likes a:hover, .masonry .likes a:hover, .blog .social a:hover, a:hover, a:focus, .navbar-default .navbar-nav li > a:hover, .navbar-default .navbar-nav li > a:focus').css('background-color', newval );
            });
        });

<?php foreach ($tk_tabs as $one_tab) {
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