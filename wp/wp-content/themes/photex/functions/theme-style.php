<?php
global $tk_tabs2;
$theme_name = 'photex_';
$tk_tabs2 = array(
    /*     * ********************************************************** */
    /*     * **********STYLE SETTINGS******************************** */
    /*     * ********************************************************** */

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

/* * ********************************************************** */
/* * ***************THEME CUSTOMIZER*********************** */
/* * ********************************************************** */


add_action('admin_menu', 'add_customizer');
function add_customizer() {
   // add_theme_page('Customize', 'Customize', 'edit_theme_options', 'customize.php');
}

add_action('customize_register', 'theme_customize');
function theme_customize($wp_customize) {
    global $tk_tabs2;
    
    foreach ($tk_tabs2 as $one_tab) {
        
        // PANEL TITLE
        /*
                array(
                   'id' => 'site_colors',
                   'title' => 'Site Colors',
                   'priority' => 35,
                   'fields' => array(
                       array(
                        'id' => 
                        'selector' => 
                        'type' => 
                        'value' => 
                        'label' => 
                        'desc' => 
                        'options' => 
                       ),
                   ),
               ),
         */



            $wp_customize->add_section($one_tab['id'], array(
                'title' => $one_tab['title'],
                'priority' => $one_tab['priority'],
            ));
            
            foreach ($one_tab['fields'] as $one_setting){
                
                
                // ADDING SETTING TO PANNEL
                $wp_customize->add_setting( $one_setting['id'], array(
                        'default'        => $one_setting['value'],
                        'type'  => 'option'
                ));
        
                // ASSIGN CONTROL TO SETTING
                // THIS CAN BE RADIO, CHECKBOX, OPTION, ETC.

                if($one_setting['type'] == 'option'){
                    
                    /*
                     *             array(
                                        'id' => 'footer_color',
                                        'selector' => '.footer-widgets',
                                        'type' => 'option',
                                        'value' => 'fff',
                                        'label' => 'Chose Footer Color',
                                        'desc' => '',
                                        'options' => 'background-color'
                                    ),
                     */
                    
                    $wp_customize->add_control(
                            new WP_Customize_Color_Control(
                                    $wp_customize,
                                    $one_setting['id'],
                                    array(
                                        'label' => $one_setting['label'],
                                        'section' => $one_tab['id'],
                                        'settings' => $one_setting['id'],
                                        'priority' => $one_setting['priority'],
                            ))
                    );
                }
                
                /*
                 *             array(
                                    'id' => 'body_color',
                                    'selector' => 'body',
                                    'type' => 'select',
                                    'value' => 'fff',
                                    'label' => 'Chose Body Color',
                                    'desc' => '',
                                    'choices'    => array(
                                        get_template_directory_uri().'/style/img/pat1.png' => 'Pattern 1',
                                        get_template_directory_uri().'/style/img/pat2.png'  => 'Pattern 2',
                                        get_template_directory_uri().'/style/img/pat3.png'  => 'Pattern 3',
                                    )
                                ),
                 */
                
                if($one_setting['type'] == 'select'){
                    $wp_customize->add_control( $one_setting['id'], array(
                        'label'   => $one_setting['label'],
                        'section' => $one_tab['id'],
                        'type'    => 'select',
                        'choices'    => $one_setting['choices'],
                        'priority' => $one_setting['priority'],
                    ) );
                }
                
                /*
                 *             array(
                                    'id' => $theme_name.'site_appearance',
                                    'selector' => '#container',
                                    'type' => 'radio',
                                    'value' => '',
                                    'label' => 'Boxed or Full Width Sections',
                                    'desc' => 'You can chose your site either to be boxed (in this case site is also responsive) or full width sections.',
                                    'options' => '',
                                    'choices'    => array(
                                        'boxed' => 'Boxed Content',
                                        'full_width' => 'Full Width Sections',
                                    ),
                                ),   
                 */
                
                if($one_setting['type'] == 'radio'){
                    $wp_customize->add_control( $one_setting['id'], array(
                        'label'   => $one_setting['label'],
                        'section' => $one_tab['id'],
                        'type'    => 'select',
                        'choices'    => $one_setting['choices'],
                        'priority' => $one_setting['priority'],
                    ) );
                }
                
                
                
                // SEETING POSTMESSAGE TO EVERY PANNEL SETTING
                // THIS ALLOWES TO LIVE UPDATE LOOK OF THEME
                $wp_customize->get_setting($one_setting['id'])->transport = 'postMessage';

                
            }
            
    }
    $wp_customize->remove_section('title_tagline');
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section('nav');


}


add_action('customize_preview_init', 'live_preview');

function live_preview() {
    global $tk_tabs2;
    wp_enqueue_script('mytheme-themecustomizer', get_template_directory_uri() . '/functions/live-style.php', array('jquery', 'customize-preview'), '', true);
    wp_localize_script('mytheme-themecustomizer', 'mytheme-pho-themecustomizer', $tk_tabs2);
}
?>