<?php
global $tabs2;
$theme_name = 'magma_';
$tabs2 = array(
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

/* * ********************************************************** */
/* * ***************THEME CUSTOMIZER*********************** */
/* * ********************************************************** */


add_action('admin_menu', 'add_customizer');
function add_customizer() {
   // add_theme_page('Customize', 'Customize', 'edit_theme_options', 'customize.php');
}

add_action('customize_register', 'theme_customize');
function theme_customize($wp_customize) {
    global $tabs2;
    
    foreach ($tabs2 as $one_tab) {
        
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
    global $tabs2;
    wp_enqueue_script('mytheme-themecustomizer', get_template_directory_uri() . '/functions/live-style.php', array('jquery', 'customize-preview'), '', true);
    wp_localize_script('mytheme-themecustomizer', 'mytheme-pho-themecustomizer', $tabs2);
}
?>