<?php
global $tabs2;
$theme_name = 'cosily_';
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
                'selector' => '.footer_box ul li, .footer_box ul li a, .footer_box .recentcomments a, .footer_box .box-twitter-center span, .footer_box .box-twitter-center a, .footer_box .rss-date',
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