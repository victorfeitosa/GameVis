<?php 
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
                'id' => 'body_color',
                'selector' => 'body',
                'type' => 'option',
                'value' => 'fff',
                'label' => 'Chose Body Color',
                'desc' => '',
                'options' => 'background'
            ),
            
            array(

            ),
            
            array(
                'id' => 'footer_color',
                'selector' => '.footer-widgets',
                'type' => 'option',
                'value' => 'fff',
                'label' => 'Chose Footer Color',
                'desc' => '',
                'options' => 'background-color'
            ),
            
        ),
    ),
    

);

    /*     * ********************************************************** */
    /*     * **********PASTE ARRAY HERE***************************** */
    /*     * ********************************************************** */
?>
( function( $ ) {
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
                $('<?php echo $one_setting['selector']?>').attr('style', '<?php echo $one_setting['options']?>:url('+newval+')');			
            } );
        } );
    <?php } // check if type is select?>
    
<?php } // foreach fields
} // foreach tabs?>
    
} )( jQuery );