<?php
require( '../../../../wp-load.php' );
$theme_name = 'novelti_';
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
                'id' => $theme_name.'nav_background_color',
                'selector' => '.nav,  .nav .sub-menu',
                'type' => 'option',
                'value' => '1f232a',
                'label' => 'Background Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 2,
            ),
            
            array(
                'id' => $theme_name.'nav_color',
                'selector' => '.nav a, .header-date',
                'type' => 'option',
                'value' => 'fff',
                'label' => 'Navigation Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),
            

            array(
                'id' => $theme_name.'nav_color_hover',
                'selector' => '.nav .sub-menu a',
                'type' => 'option',
                'value' => '31559c',
                'label' => 'Navigation Hover Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),
            
            
            array(
                'id' => $theme_name.'header_background',
                'selector' => '.header, .bg-slider-fans, .footer',
                'type' => 'option',
                'value' => '272c34',
                'label' => 'Header Background Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 2,
            ),
            
            array(
                'id' => $theme_name.'theme_color',
                'selector' => '.footer',
                'type' => 'option',
                'value' => '30549a',
                'label' => 'Theme Color',
                'desc' => '',
                'options' => 'border-top-color',
                'priority' => 2,
            ),
            
            
            array(
                'id' => $theme_name.'footer_headline_color',
                'selector' => '.footer_widget_holder h2, .footer_widget_holder h2 .rsswidget',
                'type' => 'option',
                'value' => 'fff',
                'label' => 'Footer Headlines Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),

            
            array(
                'id' => $theme_name.'footer_text_color',
                'selector' => '.footer_box ul li a, .footer_box .textwidget p, .footer_box .textwidget, .footer_box .box-twitter-center span, .footer_box .box-twitter-center a, .footer_box #recentcomments li, .footer_box #recentcomments li a, .footer_widget_holder .rss-date, .footer_widget_holder ul li .rssSummary, .footer_widget_holder ul li cite, .footer_box #wp-calendar caption',
                'type' => 'option',
                'value' => 'd8d8d8',
                'label' => 'Footer Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),

        ),
    ),

);


    /*     * ********************************************************** */
    /*     * **********PASTE ARRAY HERE***************************** */
    /*     * ********************************************************** */
?>
( function( $ ) {

        wp.customize( '<?php echo $theme_name.'theme_color'?>', function( value ) {
            value.bind( function( newval ) {
                $('.footer_box #wp-calendar thead th, .footer_box .tagcloud a, .footer_box #searchform, .footer_box .twitter_ul span.twitter-links, .footer .post-date, .text-slider-one, .bg-slider-fans .flexslider .flex-direction-nav li a, .text-slider-two, .text-slider-three ').css('background-color', newval );
                $('.footer_box .textwidget a').css('color', newval );
                $('.content').css('border-top-color', newval );
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

    <?php if($one_setting['type'] == 'test'){ ?>
        wp.customize( '<?php echo $one_setting['id']?>', function( value ) {
            value.bind( function( newval ) {
                $('<?php echo $one_setting['selector']?>').css('<?php echo $one_setting['options']?>', newval );
            } );
        } );
    <?php } // check if type is option?>


<?php } // foreach fields
} // foreach tabs?>

} )( jQuery );