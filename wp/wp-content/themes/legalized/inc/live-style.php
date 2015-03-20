<?php
require( '../../../../wp-load.php' );
$theme_name = 'legalized_';

    /***********************************************************************/
    /***********************  PASTE ARRAY HERE  ****************************/
    /***********************************************************************/

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
                'id' => $theme_name.'body_bg_color',
                'selector' => 'body',
                'type' => 'option',
                'value' => '#f0f0f0',
                'label' => 'Choose Body Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 1,
            ),
            
            array(
                'id' => $theme_name.'header_bg_color',
                'selector' => '.top',
                'type' => 'option',
                'value' => '#484848',
                'label' => 'Choose Header Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 2,
            ),
            
            array(
                'id' => $theme_name.'footer_bg_color',
                'selector' => 'footer, #sidebar',
                'type' => 'option',
                'value' => '#f3f3f3',
                'label' => 'Choose Sidebar and Footer Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 3,
            ),
            
            array(
                'id' => $theme_name.'widget_title_color',
                'selector' => '.footer_widget .widget_title, .widget_title',
                'type' => 'option',
                'value' => '#5d5d5d',
                'label' => 'Widget Title Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 4,
            ),
            
            array(
                'id' => $theme_name.'primary_color',
                'selector' => 'a:hover, .red, .header_contact a:hover, .navbar-inverse .brand, .navbar-inverse .nav > li > a:hover, .navbar-inverse .brand, .navbar-inverse .nav > li > a:focus, .navbar-inverse .brand, .navbar-inverse .nav > li > a:active, .navbar-inverse .nav > li.current-menu-ancestor > a, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus, .navbar-inverse .nav li.dropdown.open > .dropdown-toggle, .navbar-inverse .nav li.dropdown.active > .dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle, .dropdown-menu > li:hover >a, ul.nav > li:hover > a, ul.nav li:hover > a, h1.hero_heading span, .ca-menu .ca-item, .ca-menu .ca-item:hover .ca-main, .vertical_tabs_content > h3, .vertical_tabs_content > h3 > a, .by > a:hover, .by ul li a:hover, .vertical_tabs_content .read_more:hover, .front h3, .back h3, .front h3 a, .back h3 a, #contact input.error, #comment input.error, .team_member h3, .team_member h3 a, .post_title a:hover, .post_title.red a, .comments a:hover, .page-404 a, .tagcloud a:hover, #wp-calendar tfoot a, .twitter_author a, .twitter_author a:hover, .widget_meta ul li a:hover, .widget_pages ul li a:hover, .widget_archive ul li a:hover, .widget_nav_menu ul li a:hover, .widget_categories ul li a:hover, .widget_recent_entries ul li a:hover, .widget_recent_comments ul li a:hover, .navbar-inverse .nav-collapse .nav li.active > a, .navbar-inverse .nav-collapse .nav li.active > a:hover, .navbar-inverse .nav-collapse .nav li.active > a:focus, .navbar-inverse .nav-collapse .dropdown-menu a:hover, .post_title.link_title a:hover, .post-link h3 a:hover, .tags_wrap a:hover, .widget_text a, .twitter_wrap a:hover',
                'type' => 'option',
                'value' => '#d25555',
                'label' => 'Primary Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 5,
            ),
            
            array(
                'id' => $theme_name.'secondary_color',
                'selector' => 'body, a, .dropdown-menu > li > a, ul.nav ul a, .vertical_tabs_content .read_more, .recent_comments_widget ul li a, .recent_posts_widget ul li a, #wp-calendar tbody, #wp-calendar tbody a, .twitter_wrap > a, .widget_meta ul li a, .widget_pages ul li a, .widget_archive ul li a, .widget_nav_menu ul li a, .widget_categories ul li a, .widget_recent_entries ul li a, .widget_recent_comments ul li a, .post_title.link_title a, .post-link h3 a, .widget_text a:hover, .back h3 a:hover, .vertical_tabs_content > h3 > a:hover, .post_title.red a:hover',
                'type' => 'option',
                'value' => '#5d5d5d',
                'label' => 'Secondary Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 6,
            ),

            array(
                'id' => $theme_name.'tertiary_color',
                'selector' => '.site_heading, .header_contact, .header_contact a, .page_description, .page_description a, .by, .by > a, .by ul li a, .vertical_tabs_content .by, .team_member span',
                'type' => 'option',
                'value' => '#7f7f7f',
                'label' => 'Tertiary Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 7,
            ), 
            
        ),
    ),
    
);

/*************************************************************/
/************   PASTE ARRAY HERE    **************************/
/*************************************************************/
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