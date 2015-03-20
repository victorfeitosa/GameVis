<?php
global $tabs2;
$theme_name = 'legalized_';
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
                'selector' => 'a:hover, .red, .header_contact a:hover, .navbar-inverse .brand, .navbar-inverse .nav > li > a:hover, .navbar-inverse .brand, .navbar-inverse .nav > li > a:focus, .navbar-inverse .brand, .navbar-inverse .nav > li > a:active, .navbar-inverse .nav > li.current-menu-ancestor > a, .navbar-inverse .nav .active > a, .navbar-inverse .nav .active > a:hover, .navbar-inverse .nav .active > a:focus, .navbar-inverse .nav li.dropdown.open > .dropdown-toggle, .navbar-inverse .nav li.dropdown.active > .dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active > .dropdown-toggle, .dropdown-menu > li:hover >a, ul.nav > li:hover > a, ul.nav li:hover > a, h1.hero_heading span, .ca-menu .ca-item, .ca-menu .ca-item:hover .ca-main, .vertical_tabs_content > h3, .vertical_tabs_content > h3 > a, .by > a:hover, .by ul li a:hover, .vertical_tabs_content .read_more:hover, .front h3, .back h3, .front h3 a, .back h3 a, #contact input.error, #comment input.error, .team_member h3, .team_member h3 a, .post_title a:hover, .post_title.red a, .comments a:hover, .page-404 a, .tagcloud a:hover, #wp-calendar tfoot a, .twitter_author a, .twitter_author a:hover, .widget_rss ul li a:hover, .widget_meta ul li a:hover, .widget_pages ul li a:hover, .widget_archive ul li a:hover, .widget_nav_menu ul li a:hover, .widget_categories ul li a:hover, .widget_recent_entries ul li a:hover, .widget_recent_comments ul li a:hover, .navbar-inverse .nav-collapse .nav li.active > a, .navbar-inverse .nav-collapse .nav li.active > a:hover, .navbar-inverse .nav-collapse .nav li.active > a:focus, .navbar-inverse .nav-collapse .dropdown-menu a:hover, .post_title.link_title a:hover, .post-link h3 a:hover, .tags_wrap a:hover, .widget_text a, .twitter_wrap a:hover',
                'type' => 'option',
                'value' => '#d25555',
                'label' => 'Primary Color',
                'desc' => '',
                'options' => 'color',
                'priority' => 5,
            ),
            
            array(
                'id' => $theme_name.'secondary_color',
                'selector' => 'body, a, .dropdown-menu > li > a, ul.nav ul a, .vertical_tabs_content .read_more, .recent_comments_widget ul li a, .recent_posts_widget ul li a, #wp-calendar tbody, #wp-calendar tbody a, .twitter_wrap > a, .widget_rss ul li a, .widget_meta ul li a, .widget_pages ul li a, .widget_archive ul li a, .widget_nav_menu ul li a, .widget_categories ul li a, .widget_recent_entries ul li a, .widget_recent_comments ul li a, .post_title.link_title a, .post-link h3 a, .widget_text a:hover, .back h3 a:hover, .vertical_tabs_content > h3 > a:hover, .post_title.red a:hover',
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
    wp_enqueue_script('mytheme-themecustomizer', get_template_directory_uri() . '/inc/live-style.php', array('jquery', 'customize-preview'), '', true);
    wp_localize_script('mytheme-themecustomizer', 'mytheme-pho-themecustomizer', $tabs2);
}
?>