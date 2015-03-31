<?php
require( '../../../../wp-load.php' );
$theme_name = 'immensely_';

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
                'selector' => '.footer-widgets #recentcomments li a:hover, #sidebar .block ul li a:hover, .footer-widgets .block ul li a:hover, .footer-widgets #recentcomments li a:hover, .footer-widgets #recentcomments li, #sidebar #recentcomments li, .meta-data .categories a, .post-big h4 a:hover, a, .img-post .post h6 a:hover, .meta-data ul li a, .meta-data ul.gallery-categories, .nav .dropdown-menu .fa-plus, .footer-widgets .block span.rss-date, .navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus, .navbar .nav > li > a:hover, .navbar .nav > li > a:focus, .comment-form .cta, .banner.banner-background, .gallery-filter .gallery-filter-nav ul li a',
                'type' => 'option',
                'value' => '#436bb8',
                'label' => 'Choose Main Theme Color',
                'desc' => '',
                'options' => 'color background-color',
                'priority' => 1,
            ),
            
            array(
                'id' => $theme_name.'theme_hover_color',
                'selector' => '.shortcodes a:hover, .comment-form a:hover, .post-author-info a:hover, #sidebar .block a:hover, .comment-form .cta:hover',
                'type' => 'option',
                'value' => '#22468a',
                'label' => 'Choose Secondary Theme Color',
                'desc' => '',
                'options' => 'color background-color',
                'priority' => 2,
            ),
            
            array(
                'id' => $theme_name.'header_color',
                'selector' => '.navbar-inverse .navbar-inner, .dropdown-menu',
                'type' => 'option',
                'value' => '#fff',
                'label' => 'Choose Header Background Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 3,
            ),
            
            array(
                'id' => $theme_name.'navigation_text_color',
                'selector' => '.dropdown-menu > li.menu-item > a, .navbar .nav > li.menu-item  > a',
                'type' => 'option',
                'value' => '#444',
                'label' => 'Choose Navigation Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 4,
            ),
            
            array(
                'id' => $theme_name.'footer_color',
                'selector' => '.footer-widgets',
                'type' => 'option',
                'value' => '#ececec',
                'label' => 'Choose Footer Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 5,
            ),
            
            array(
                'id' => $theme_name.'footer_title_color',
                'selector' => '',
                'type' => 'option',
                'value' => '#222',
                'label' => 'Choose Footer Title Color',
                'desc' => '.footer-widgets .block h6, .footer-widgets .block h6 a.rsswidget',
                'options' => 'color',
                'priority' => 6,
            ),
            
            array(
                'id' => $theme_name.'footer_text_color',
                'selector' => '.footer-widgets #recentcomments li a:last-child, .textwidget, .footer-widgets .block a, .footer-widgets .block span, .footer-widgets .block p, .footer-widgets ul li cite, .footer-widgets .block ul li a, .rssSummary',
                'type' => 'option',
                'value' => '#444',
                'label' => 'Choose Footer Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 7,
            ),
            
            array(
                'id' => $theme_name.'copyright_color',
                'selector' => '.footer-copyright',
                'type' => 'option',
                'value' => '#fff',
                'label' => 'Choose Copyright Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 8,
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