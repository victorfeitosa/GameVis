<?php
global $tabs2;
$theme_name = 'novelti_';
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
                'id' => $theme_name.'nav_background_color',
                'selector' => '.nav',
                'type' => 'option',
                'value' => '#1f232a',
                'label' => 'Navigation Background Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 2,
            ),  
            
            array(
                'id' => $theme_name.'nav_color',
                'selector' => '.nav a',
                'type' => 'option',
                'value' => '#fff',
                'label' => 'Navigation Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),  
            
            
            array(
                'id' => $theme_name.'nav_color_hover',
                'selector' => '.nav .sub-menu a:hover',
                'type' => 'option',
                'value' => '#31559c',
                'label' => 'Navigation Hover Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),
            
            
            array(
                'id' => $theme_name.'header_background',
                'selector' => '.header',
                'type' => 'option',
                'value' => '#272c34',
                'label' => 'Header Background Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 2,
            ),  
            
            
            array(
                'id' => $theme_name.'footer_headline_color',
                'selector' => '.footer_widget_holder h2, .footer_widget_holder h2 .rsswidget',
                'type' => 'option',
                'value' => '#fff',
                'label' => 'Footer Headlines Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),
            
            
            array(
                'id' => $theme_name.'theme_color',
                'selector' => '.footer, .text-slider-one, .bg-slider-fans .flexslider .flex-direction-nav li a',
                'type' => 'option',
                'value' => '#30549a',
                'label' => 'Theme Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 2,
            ),
            
            array(
                'id' => $theme_name.'footer_text_color',
                'selector' => '.footer_box ul li a, .footer_box .textwidget p, .footer_box .textwidget, .footer_widget_holder h2, .footer_box .box-twitter-center span, .footer_box .box-twitter-center a,
                    .footer_box #recentcomments li, .footer_box #recentcomments li a, .footer_widget_holder .rss-date, .footer_widget_holder ul li .rssSummary, .footer_widget_holder ul li cite, .footer_widget_holder h2 .rsswidget, .footer_box #wp-calendar caption',
                'type' => 'option',
                'value' => '#d8d8d8',
                'label' => 'Footer Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 2,
            ),    
        ),
    ),
    
);

/* * ********************************************************** */
/* * ***************THEME CUSTOMIZER*********************** */
/* * ********************************************************** */


add_action('admin_menu', 'add_customizer');
function add_customizer() {
    add_theme_page('Customize', 'Customize', 'edit_theme_options', 'customize.php');
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
                                        'label' => __($one_setting['label'], tk_theme_name),
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
                        'label'   => __($one_setting['label'], tk_theme_name),
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
                        'label'   => __($one_setting['label'], tk_theme_name),
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
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('static_front_page');
    $wp_customize->remove_section('nav');
}


add_action('customize_preview_init', 'live_preview');

function live_preview() {
    global $tabs2;
    wp_enqueue_script('mytheme-themecustomizer', get_template_directory_uri() . '/inc/live-style.php', array('jquery', 'customize-preview'), '', true);
    wp_localize_script('mytheme-themecustomizer', 'mytheme-pho-themecustomizer', $tabs2);
}
?>