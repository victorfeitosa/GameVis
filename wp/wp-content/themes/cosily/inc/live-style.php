<?php
require( '../../../../wp-load.php' );
$theme_name = 'cosily_';
    /*     * ********************************************************** */
    /*     * **********PASTE ARRAY HERE***************************** */
    /*     * ********************************************************** */
$tabs = array(
    /*     * ********************************************************** */
    /*     * **********STYLE SETTINGS******************************** */
    /*     * ********************************************************** */

    array(
        'id' => 'site_colors',
        'title' => 'Site Colors',
        'priority' => 35,
        'fields' => array(


            array(
                'id' => $theme_name.'top_bar',
                'selector' => '.bg-top-bar',
                'type' => 'option',
                'value' => '3c3132',
                'label' => 'Top Bar Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 1,
            ),
            
            array(
                'id' => $theme_name.'border_color',
                'selector' => '.bottom-slider-red, .footer-red-border',
                'type' => 'option',
                'value' => '6b2a2a',
                'label' => 'Header/Footer Border Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 2,
            ),

            array(
                'id' => $theme_name.'footer_widgets_color',
                'selector' => '.footer',
                'type' => 'option',
                'value' => '3A2F30',
                'label' => 'Footer Widget Section Background Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 3,
            ),

            array(
                'id' => $theme_name.'footer_copyright_color',
                'selector' => '.footer-copyright-text',
                'type' => 'option',
                'value' => '514748',
                'label' => 'Footer Copyright Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 4,
            ),

            array(
                'id' => $theme_name.'footer_title_color',
                'selector' => '.footer_box h2, .footer_widget_holder h2 a',
                'type' => 'option',
                'value' => 'ffffff',
                'label' => 'Footer Widget Title Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 5,
            ),

            array(
                'id' => $theme_name.'footer_paragraph_color',
                'selector' => '.footer_box ul li, .footer_box ul li a, .footer_box .recentcomments a, .footer_box .box-twitter-center span, .footer_box .box-twitter-center a, .footer_box .rss-date, .footer_box .textwidget p',
                'type' => 'option',
                'value' => 'd8d8d8',
                'label' => 'Footer Widget Paragraph Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 6,
            ),

            array(
                'id' => $theme_name.'footer_link_hover_color',
                'selector' => '.footer_box ul li a:hover',
                'type' => 'option',
                'value' => 'c45b5b',
                'label' => 'Footer Hover Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 7,
            ),
            
            array(
                'id' => $theme_name.'theme_colors',
                'selector' => '.home-rooms-one ul li a, .home-latest-news-one-title span a, .home-latest-news-one-read-more a, .home-testimonials-one-title span, .shortcodes blockquote p, .current-menu-item > a, .nav ul li a:hover, .home-latest-news-title a, .blog-read-more a:hover, .search-rooms:hover, .home-latest-news-category ul li p a:hover, .blog-audio-info p, .current-menu-parent > a, h1, h2, h3, h4, h5, h6, .post-link-top a:hover, .post-link-down a, .post-link-down a.blog-page-link:hover, .blog-audio-info a:hover, .post-quote p a:hover, .post-quote p, .page-rooms-one-text .room-link, .room-night h5, .shortcodes a, .toggle-holder span, #tabs .ui-state-active a, #tabs .ui-state-active a:link, #tabs .ui-state-default a, #tabs .ui-state-default a:link, .room-single-title, .room-single-book-night span, .home-latest-news-title, .comment-start-title span, .comment-start-title a:hover, .page-404 span, .page-404 a, .tag-blog-single span, .tag-blog-single a:hover',
                'type' => 'option',
                'value' => '6b2a2a',
                'label' => 'Theme Colors',
                'desc' => '',
                'options' => 'color',
                'priority' => 8,
            ),
            
            array(
                'id' => $theme_name.'booking_buttons',
                'selector' => '.home-call-action-buttom a',
                'type' => 'option',
                'value' => '5c4343',
                'label' => 'Booking Buttons Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 9,
            ),
            
            array(
                'id' => $theme_name.'booking_buttons_hover',
                'selector' => '.home-call-action-buttom a:hover',
                'type' => 'option',
                'value' => '6b2a2a',
                'label' => 'Booking Buttons Hover Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 10,
            ),
            
        ),
    ),

);


    /*     * ********************************************************** */
    /*     * **********PASTE ARRAY HERE***************************** */
    /*     * ********************************************************** */
?>
( function( $ ) {

        wp.customize( '<?php echo $theme_name.'link_hover_color'?>', function( value ) {
            value.bind( function( newval ) {
                $('.home-call-action-button a').css('background-color', newval );
                jQuery('.menu-content ul li a').hover(
                        function () {$(this).attr('style', 'color:'+newval+'!important');},
                        function () {$(this).attr('style', 'color:#5d4f4f!important');});
                jQuery('.footer-menu ul li a').hover(
                        function () {$(this).attr('style', 'color:'+newval+'!important');},
                        function () {$(this).attr('style', 'color:#5d4f4f!important');});
            } );
        } );


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