<?php
global $tabs2;
$theme_name = 'immensely_';
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
    $wp_customize->remove_section('colors');
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