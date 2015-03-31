<?php
require( '../../../../wp-load.php' );
$theme_name = 'charity_';

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
                'selector' => 'h1, h2, h3, h4, h5, h6, .top-content-text p a,  .top-content-text a, .top-content-text ul li span, #sidebar .block .twitter_ul li a, #sidebar .block .post-date, .breadcrumb li a, h1.title-divider .bread-bullet, .page-404 .container a, .blog-page table.table td p, a.link-post, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover,  .navbar-inverse .nav a:hover,  .navbar-inverse .nav .active > a:focus',
                'type' => 'option',
                'value' => '#00acee',
                'label' => 'Choose Theme Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 1,
            ),
            
            array(
                'id' => $theme_name.'theme_hover_color',
                'selector' => '',
                'type' => 'option',
                'value' => '#000',
                'label' => 'Choose Theme Hover Color',
                'desc' => '',
                'options' => 'color',
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
                jQuery('.image-relative .home-meta-ul li, .gallery-filter .active, .contact-form input.btn, .plus-up, .plus-hor, .top-content-image ul li, .blog-page table.table td.span2, .pagination .current, .blog-player, .home-audio-player').css('background-color', newval );
            });
         });
         
        wp.customize( '<?php echo $theme_name.'theme_color'?>', function( value ) {
            value.bind( function( newval ) {
                jQuery('.navbar-inverse .navbar-inner').css('border-color', newval );
            });
         });
         
        wp.customize( '<?php echo $theme_name.'theme_hover_color'?>', function( value ) {
            value.bind( function( newval ) {
                jQuery('.top-content-text p a, .top-content-text h3 a,  .top-content-text a,  #sidebar .block .twitter_ul li a, .footer-widgets ul li a, .top-content-text h3 a, .navbar .nav > li > a, .breadcrumb li a, .page-404 .container a, a.link-post, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a,  .navbar-inverse .nav a, .top-content-text p a,  .top-content-text a, #sidebar .block .twitter_ul li a, .breadcrumb li a, .page-404 .container a, a.link-post, .navbar-inverse .nav .active > a').hover(
                    function() { 
                        $(this).attr('style', 'color:'+newval+'!important');
                });        
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