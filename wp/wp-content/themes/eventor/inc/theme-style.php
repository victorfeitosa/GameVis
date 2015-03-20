<?php
global $tabs2;
$theme_name = 'eventor_';
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
                'id' => $theme_name.'body_color',
                'selector' => 'body',
                'type' => 'option',
                'value' => '#E3E3E3',
                'label' => 'Choose Body Color',
                'desc' => '',
                'options' => 'background-color',
                'priority' => 1,
            ),
            
            array(
                'id' => $theme_name.'header_color',
                'selector' => '.header',
                'type' => 'option',
                'value' => '#2F3236',
                'label' => 'Choose Header Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 2,
            ),
            array(
                'id' => $theme_name.'menu_color',
                'selector' => '.nav ul li a:link, .nav ul li a:visited',
                'type' => 'option',
                'value' => '#999999',
                'label' => 'Choose Menu Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 3,
            ),
            array(
                'id' => $theme_name.'menu_hover_color',
                'selector' => '.nav ul li a:hover, .nav ul li.active a, .sf-menu .sub-menu a:hover, .nav nav .sf-menu li.current-menu-item a',
                'type' => 'option',
                'value' => '#ff6825',
                'label' => 'Choose Menu Hover Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 4,
            ),
            
            array(
                'id' => $theme_name.'slider_background',
                'selector' => '.slider-home',
                'type' => 'option',
                'value' => '#fff',
                'label' => 'Choose Slider Background Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 5,
            ),
            
            array(
                'id' => $theme_name.'call_to_action_color',
                'selector' => '.home-ticket-box-center',
                'type' => 'option',
                'value' => '#2F3236',
                'label' => 'Choose Call to action Background Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 6,
            ),
            
            array(
                'id' => $theme_name.'call_to_action_title',
                'selector' => '.call-to-action-title',
                'type' => 'option',
                'value' => '#ffffff',
                'label' => 'Call To Action Title Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 7,
            ),
            
            array(
                'id' => $theme_name.'call_to_action_undertitle',
                'selector' => '.home-ticket-box-center span',
                'type' => 'option',
                'value' => '#ff6825',
                'label' => 'Call To Action Undertitle Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 8,
            ),
            array(
                'id' => $theme_name.'call_to_action_text',
                'selector' => '.home-ticket-box-center p',
                'type' => 'option',
                'value' => '#ffffff',
                'label' => 'Call To Action Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 9,
            ),
            
            array(
                'id' => $theme_name.'theme_colors',
                'selector' => '.shortcodes p, .home-speaker-excerpt, .blog-one-text, .sidebar_widget_holder ul li a, .sidebar_widget_holder .textwidget p, .sidebar_widget_holder ul li, .comment-start-text p, .comment-start-text a:hover, .sidebar_widget_holder .textwidget, .sidebar_widget_holder .newsletter span, .sidebar_widget_holder tbody, .blog-categories ul li span, .tabs .tab div, .call-to-action-shortcode .home-call-action-text p, .shortcodes, .shortcodes ol li, .speakers-text p, .home-ticket-box-center a:hover, .home-post-one-text a:hover, .sticky, .textwidget a:hover, .shortcodes ul li, .speakers-text a:hover',
                'type' => 'option',
                'value' => '#666666',
                'label' => 'Theme Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 10,
            ),
            
            array(
                'id' => $theme_name.'theme_color_hover',
                'selector' => '.home-ticket-box-center a, .home-post-center-content h5 a, .home-post-one-text a, .footer-copy-content span a, .blog-categories ul li a:hover, .post-link-down a, .blog-one-title a:hover, .sidebar_widget_holder ul li a:hover, .sidebar_widget_holder li.recentcomments, .textwidget a, .sidebar_widget_holder ul li a:hover, .title-page-content span, .sidebar_widget_holder tfoot a:hover, .sidebar_widget_holder .post-date, .sidebar_widget_holder .rss-date, .home-post-one-button a:hover, .sidebar_widget_holder h3 .rsswidget:hover, .pagination span, .pagination a:hover, .sidebar_widget_holder .current-menu-item a, .sidebar_widget_holder .tag-center:hover, .comment-start-title a, .comment-start-text a, .form input.search-submit-button:hover, .sidebar_widget_holder #s input.search-submit-button:hover, .toggle-holder span, .tabs .ui-state-active a, .tabs .ui-state-active a:link, .tabs .ui-state-active a:visited, .tabs .ui-state-default a, .tabs .ui-state-default a:link, .tabs .ui-state-default a:visited, .speakers-text a, .speakers-filter a.active, .speakers-filter a:hover, .speakers-single-text h6',
                'type' => 'option',
                'value' => '#ff6825',
                'label' => 'Secondary Theme Color/Hover',
                'desc' => '',
                'options' => 'color, background',
                'priority' => 11,
            ),
            
            array(
                'id' => $theme_name.'title_and_headings',
                'selector' => 'h1, h2, h3, h4, h5, .sidebar_widget_holder h3 .rsswidget, .blog-one-title, .blog-one-title a, .sidebar_widget_holder #wp-calendar caption, .sidebar_widget_holder thead, .sidebar_widget_holder tfoot a',
                'type' => 'option',
                'value' => '#313438',
                'label' => 'Headings and Titles color',
                'desc' => '',
                'options' => 'color',
                'priority' => 12,
            ),
          
            array(
                'id' => $theme_name.'footer_title_color',
                'selector' => '.footer_widget_holder h2, .footer_widget_holder h2 a.rsswidget',
                'type' => 'option',
                'value' => '#F6F6F6',
                'label' => 'Footer Widget Title Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 14,
            ),
            
            array(
                'id' => $theme_name.'footer_widgets_color',
                'selector' => '.footer',
                'type' => 'option',
                'value' => '#2F3236',
                'label' => 'Footer Color',
                'desc' => '',
                'options' => 'background',
                'priority' => 13,
            ),
            
            array(
                'id' => $theme_name.'footer_paragraph_color',
                'selector' => '.footer_widget_holder .textwidget, .footer_widget_holder .textwidget p, .footer_widget_holder .box-twitter-center span, .footer_widget_holder .rsswidget, .footer_widget_holder .rssSummary, .footer_widget_holder cite, .footer_widget_holder .newsletter span, .footer_widget_holder .recentcomments a, .footer_widget_holder li a, .footer_widget_holder li, .footer_widget_holder .box-twitter-center a:hover, .footer_widget_holder .textwidget a:hover',
                'type' => 'option',
                'value' => '#999999',
                'label' => 'Footer Widget Text Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 15,
            ),
            
            array(
                'id' => $theme_name.'footer_link_hover_color',
                'selector' => '.footer_widget_holder .box-twitter-center a, .footer_widget_holder .tagcloud .tag-center:hover, .footer_widget_holder .twitter_ul span.twitter-links, .footer_widget_holder .rss-date, .footer_widget_holder .twitter_ul span.twitter-links, .footer_widget_holder li a:hover, .footer_widget_holder .recentcomments a:hover, .footer_widget_holder #recentcomments li, .footer_widget_holder .textwidget a, .footer_widget_holder .post-date, .footer-copy-content span a:hover',
                'type' => 'option',
                'value' => '#ff6825',
                'label' => 'Footer Link Hover Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 16,
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
                                        'label' => $one_setting['label'],
                                        'section' => $one_tab['id'],
                                        'settings' => $one_setting['id'],
                                        'priority' => $one_setting['priority'],
                            ))
                    );
                }

                
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