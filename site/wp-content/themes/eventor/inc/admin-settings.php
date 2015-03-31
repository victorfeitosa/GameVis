<?php

$tabs = array(
    /*     * ********************************************************** */
    /*     * **********GENERAL OPTIONS****************************** */
    /*     * ********************************************************** */

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'general',
        'name' => 'General Options',
        'fields' => array(
            array(
                'id' => 'header_logo',
                'name' => 'header_logo',
                'type' => 'file',
                'value' => get_template_directory_uri() . "/style/img/logo.png",
                'label' => 'Header Logo',
                'desc' => 'JPEG, GIF or PNG image, 156x39 recommended up to 500KB',
            ),

            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),

            array(
                'id' => 'footer_logo',
                'name' => 'footer_logo',
                'type' => 'file',
                'value' => get_template_directory_uri() . "/style/img/footer-logo.png",
                'label' => 'Footer Logo',
                'desc' => 'JPEG, GIF or PNG image, 198x63px recommended, up to 500KB',
            ),
            array(
                'id' => 'favicon',
                'name' => 'favicon',
                'type' => 'file',
                'value' => get_template_directory_uri() . "/style/img/favicon.ico",
                'label' => 'Favicon',
                'desc' => 'File format: ICO, dimenstions: 16x16',
            ),
            array(
                'id' => 'google_analytics',
                'name' => 'google_analytics',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Google Analytics code',
                'desc' => '',
                'options' => array(
                    'rows' => '5',
                    'cols' => '80'
                )
            ),
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),
            array(
                'id' => 'custom_sidebars',
                'name' => 'custom_sidebars',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use different sidebars on page templates.',
                ),
                'label' => 'Custom Sidebars',
                'desc' => 'Check this box if you want to use custom sidebars on page templates, if unchecked the default sidebar will be used on every page.',
            ),
            array(
                'id' => 'archive_sidebar',
                'name' => 'archive_sidebar',
                'type' => 'select',
                'value' => array(
                    array('Sidebar Right', 'right'), // ARRAY ('TITLE', 'VALUE')
                    array('Sidebar Left', 'left'), // ARRAY ('TITLE', 'VALUE')
                    array('Fullwidth Page', 'fullwidth'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Archive Page Sidebar Position',
                'desc' => 'Select sidebar position for Archive Page',
            ),
            array(
                'id' => 'search_sidebar',
                'name' => 'search_sidebar',
                'type' => 'select',
                'value' => array(
                    array('Sidebar Right', 'right'), // ARRAY ('TITLE', 'VALUE')
                    array('Sidebar Left', 'left'), // ARRAY ('TITLE', 'VALUE')
                    array('Fullwidth Page', 'fullwidth'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Search Page Sidebar Position',
                'desc' => 'Select sidebar position for Search Page',
            ),
            
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),
            array(
                'id' => 'footer_copy',
                'name' => 'footer_copy',
                'type' => 'text',
                'value' => 'Copyright Information Goes Here 2013. All Rights Reserved.',
                'label' => 'Footer Copy Text',
                'desc' => 'Text which appears in footer as copyright text',
                'options' => array(
                    'size' => '100'
                )
            ),
        ),
    ),
    
/*************************************************************/
/************HOME PAGE OPTIONS****************************/
/*************************************************************/

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'home',
        'name' => 'Home Page',
        
        'fields' => array(
            array(
                'id' => 'select_slider',
                'name' => 'select_slider',
                'type' => 'select',
                'value' => array(
                    array('Disable Slider', 'none'), // ARRAY ('TITLE', 'VALUE')
                    array('Revolution', 'revolution'), // ARRAY ('TITLE', 'VALUE')
                    array('Slit Slider', 'slitslider'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Home Page Slider',
                'desc' => 'Choose slider for home page',
            ),
            array(
                'id' => 'slider_id',
                'name' => 'slider_id',
                'type' => 'text',
                'value' => '',
                'label' => 'Revolution Slider ALIAS',
                'desc' => 'When you configure your Revolution Slider from Revolution Panel, insert here ID or ALIAS you received there.',
                'options' => array(
                    'size' => '20'
                )
            ),
            array(
                'id' => 'slider_autoplay',
                'name' => 'slider_autoplay',
                'type' => 'select',
                'value' => array(
                    array('Enable', 'true'), // ARRAY ('TITLE', 'VALUE')
                    array('Disable', 'false'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Slit Slider Slideshow',
                'desc' => 'Enable or disable auto switching for slides',
            ),
            array(
                'id' => 'slider_pause_time',
                'name' => 'slider_pause_time',
                'type' => 'text',
                'value' => '4000',
                'label' => 'Slit Slider Pause Time',
                'desc' => 'This is delay time in miliseconds between two slides.',
                'options' => array(
                    'size' => '20'
                )
            ),
            array(
                'id' => 'slider_animation_time',
                'name' => 'slider_animation_time',
                'type' => 'text',
                'value' => '500',
                'label' => 'Slit Slider Animation Time',
                'desc' => 'This is animation time in miliseconds between two slides.',
                'options' => array(
                    'size' => '20'
                )
            ),
            array(
                'id' => 'slider_height',
                'name' => 'slider_height',
                'type' => 'text',
                'value' => '400',
                'label' => 'Slit Slider Height',
                'desc' => 'This is heigh of the slider in pixels',
                'options' => array(
                    'size' => '20'
                )
            ),
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),
            array(
                'id' => 'use_home_content',
                'name' => 'use_home_content',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use Home Content',
                ),
                'label' => '',
                'desc' => '',
            ),

            array(
                'id' => 'home_content',
                'name' => 'home_content',
                'type' => 'pages',
                'value' => '',
                'label' => 'Chose page to use on Home Content:',
                'desc' => 'Content from this page will be shown on Home Page.',

            ),

            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),

            array(
                'id' => 'use_call_to_action',
                'name' => 'use_call_to_action',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use Call To Action',
                ),
                'label' => '',
                'desc' => '',
            ),

            array(
                'id' => 'call_to_action_title',
                'name' => 'call_to_action_title',
                'type' => 'text',
                'value' => '',
                'label' => 'Insert Title for Call To Action part of Home Page.',
                'desc' => '',
                'options' => array(
                    'size' => '100'
                )

            ),

            array(
                'id' => 'call_to_action_undertitle',
                'name' => 'call_to_action_undertitle',
                'type' => 'text',
                'value' => '',
                'label' => 'Insert Undertitle for Call To Action part of Home Page.',
                'desc' => '',
                'options' => array(
                    'size' => '100'
                )

            ),

            array(
                'id' => 'call_to_action_text',
                'name' => 'call_to_action_text',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Insert Text for Call To Action part of Home Page.',
                'desc' => '',
                'options' => array(
                    'rows' => '5',
                    'cols' => '101'
                )
            ),

            array(
                'id' => 'call_to_action_button_text',
                'name' => 'call_to_action_button_text',
                'type' => 'text',
                'value' => '',
                'label' => 'Insert Text for Button in Call To Action part of Home Page.',
                'desc' => '',
                'options' => array(
                    'size' => '20'
                )

            ),

            array(
                'id' => 'call_to_action_button_url',
                'name' => 'call_to_action_button_url',
                'type' => 'text',
                'value' => '',
                'label' => 'Insert Url for Button in Call To Action part of Home Page.',
                'desc' => '',
                'options' => array(
                    'size' => '100'
                )

            ),

            array(
                'id' => 'use_countdown',
                'name' => 'use_countdown',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use countdown till your event starts.',
                ),
                'label' => '',
                'desc' => '',
            ),

            array(
                'id' => 'datepicker',
                'name' => 'datepicker',
                'type' => 'datepicker',
                'value' => '',
                'label' => 'Date of the event',
                'desc' => 'Use calendar and chose the day for your event'

            ),
            
            array(
                'id' => 'timepicker',
                'name' => 'timepicker',
                'type' => 'text',
                'value' => '',
                'label' => 'Time of the event',
                'desc' => 'Use picker to select time of your event'

            ),


            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),

            array(
                'id' => 'display_boxes',
                'name' => 'display_boxes',
                'type' => 'select',
                'value' => array(
                    array('Program and Speakers', 'program_and_speaker'), // ARRAY ('TITLE', 'VALUE')
                    array('Program', 'program'), // ARRAY ('TITLE', 'VALUE')
                    array('Speakers', 'speakers'), // ARRAY ('TITLE', 'VALUE')
                    array('None', 'none'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Display Boxes Program and Speakers',
                'desc' => 'Determines which boxes will be visible in "Program and Speakers" section on Home Page',
            ),
            
            array(
                'id' => 'program_category',
                'name' => 'program_category',
                'type' => 'category',
                'label' => 'Chose Category for Home page Program section',
                'desc' => '',
                'taxonomy' => 'ct_program',
            ),
            
            array(
                'id' => 'program_per_page',
                'name' => 'program_per_page',
                'type' => 'text',
                'value' => '5',
                'label' => 'Insert number of program posts to show on home page',
                'desc' => '',
                'options' => array(
                    'size' => '20'
                )
            ),

            array(
                'id' => 'speakers_number',
                'name' => 'speakers_number',
                'type' => 'text',
                'value' => '5',
                'label' => 'Insert how many speakers you want to show on Home page.',
                'desc' => '',
                'options' => array(
                    'size' => '5'
                )
            ),
            
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),

            array(
                'id' => 'use_horizontal_slider',
                'name' => 'use_horizontal_slider',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use Horizontal Slider',
                ),
                'label' => '',
                'desc' => '',
            ),

            array(
                'id' => 'horizontal_slider_category',
                'name' => 'horizontal_slider_category',
                'type' => 'category',
                'label' => 'Chose what Category to show in horizontal slider',
                'desc' => '',
            ),

            array(
                'id' => 'horizontal_slider_number',
                'name' => 'horizontal_slider_number',
                'type' => 'text',
                'value' => '',
                'label' => 'Insert how many post you want to show in horizontal slider.',
                'desc' => '',
                'options' => array(
                    'size' => '5'
                )

            ),

        ),
    ),
    
    
    /*     * ********************************************************** */
    /*     * **********SOCIAL OPTIONS******************************** */
    /*     * ********************************************************** */

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'social',
        'name' => 'Social',
        'fields' => array(
            array(
                'id' => 'rss_url',
                'name' => 'rss_url',
                'type' => 'text',
                'value' => '',
                'label' => 'RSS Feed URL',
                'desc' => 'Enter url of RSS feed you want to use. WordPress default is www.yoursite.com/feed/.',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'google_plus',
                'name' => 'google_plus',
                'type' => 'text',
                'value' => '',
                'label' => 'Google Plus account',
                'desc' => 'Enter Google+ account (e.g. 123456789012345678901) or leave empty if you dont wish to use Google+',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'facebook',
                'name' => 'facebook',
                'type' => 'text',
                'value' => '',
                'label' => 'Facebook account',
                'desc' => 'Enter Facebook account (e.g. themeskingdom) or leave empty if you dont wish to use Facebook',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'twitter',
                'name' => 'twitter',
                'type' => 'text',
                'value' => '',
                'label' => 'Twitter account',
                'desc' => 'Enter Twitter account (e.g. themeskingdom) or leave empty if you dont wish to use Twitter (twitter will not work unless you have set up Twitter authentication)',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),
            
             array(
                'id' => 'twitter_auth',
                'name' => 'twitter_auth',
                'type' => 'label',
                'label' => '<a target="_blank" href="http://www.themeskingdom.com/knowledge-base/how-to-setup-twitter/">How to setup Twitter authentication</a> ',
            ),
                        
            array(
                'id' => 'twitter_consumer_key',
                'name' => 'twitter_consumer_key',
                'type' => 'text',
                'value' => '',
                'label' => 'Consumer key',
                'desc' => 'Application consumer key',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'twitter_consumer_secret',
                'name' => 'twitter_consumer_secret',
                'type' => 'text',
                'value' => '',
                'label' => 'Consumer secret',
                'desc' => 'Application consumer secret',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'twitter_access_token',
                'name' => 'twitter_access_token',
                'type' => 'text',
                'value' => '',
                'label' => 'Access token',
                'desc' => 'Application access token',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'twitter_token_secret',
                'name' => 'twitter_token_secret',
                'type' => 'text',
                'value' => '',
                'label' => 'Access Token Secret',
                'desc' => 'Application access token secret',
                'options' => array(
                    'size' => '80'
                )
            ),
        ),
    ),
    /*     * ********************************************************** */
    /*     * ***************WIDGET AREAS*************************** */
    /*     * ********************************************************** */

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'sidebars',
        'name' => 'Sidebars',
        'fields' => array(
            array(
                'id' => 'widget_area',
                'name' => 'widget_area',
                'type' => 'widgetareas',
                'value' => '',
                'label' => 'Sidebars',
                'desc' => 'Enter name of a new sidebar that you can use on pages, categories and single page',
                'options' => array(
                    'size' => '80'
                )
            ),
        ),
    ),
    /*     * ********************************************************** */
    /*     * **********CONTACT OPTIONS***************************** */
    /*     * ********************************************************** */

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'contact',
        'name' => 'Contact',
        'fields' => array(
            array(
                'id' => 'contact_subject',
                'name' => 'contact_subject',
                'type' => 'text',
                'value' => 'E-mail from ' . tk_theme_name() . ' Theme',
                'label' => 'Subject for your contact form',
                'desc' => 'This will be subject when you receive e-mail from your site',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'name_error_message',
                'name' => 'name_error_message',
                'type' => 'text',
                'value' => 'Please insert your name!',
                'label' => 'Name error message',
                'desc' => 'Enter error message if name is not entered in contact form',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'email_error_message',
                'name' => 'email_error_message',
                'type' => 'text',
                'value' => 'Please insert your e-mail!',
                'label' => 'E-mail error message',
                'desc' => 'Enter error message if e-mail is not entered in contact form',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'message_error_message',
                'name' => 'message_error_message',
                'type' => 'text',
                'value' => 'Please insert your message!',
                'label' => 'Message text error message',
                'desc' => 'Enter error message if message text is not entered in contact form',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'message_successful',
                'name' => 'message_successful',
                'type' => 'text',
                'value' => 'Message sent!',
                'label' => 'Message on successful e-mail send',
                'desc' => 'Enter notification text for successfully sent message',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'message_unsuccessful',
                'name' => 'message_unsuccessful',
                'type' => 'text',
                'value' => 'Some error occured!',
                'label' => 'Message for error on e-mail send',
                'desc' => 'Enter notification text for unsuccessfully sent message',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'disable_captcha',
                'name' => 'disable_captcha',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Disable Captcha',
                ),
                'label' => 'Disable Captcha on Contact Page',
                'desc' => 'Check this box if you want to disable captcha on your Contact page.',
            ),
            array(
                'id' => 'show_map',
                'name' => 'show_map',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked map will be removed',
                ),
                'label' => 'Remove  Map',
                'desc' => '',
            ),
            array(
                'id' => 'default_map',
                'name' => 'default_map',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked map colors will be used',
                ),
                'label' => 'Default Map Color',
                'desc' => '',
            ),
            array(
                'id' => 'map_color',
                'name' => 'map_color',
                'type' => 'colorpicker',
                'value' => '',
                'label' => 'Google Map Color',
                'desc' => 'Set color of google map, leave empty for default color',
            ),
            array(
                'id' => 'googlemap_x',
                'name' => 'googlemap_x',
                'type' => 'text',
                'value' => '',
                'label' => 'Google map X coordinate',
                'desc' => 'Insert google map coordinate for your adress',
                'options' => array(
                    'size' => '5'
                )
            ),
            array(
                'id' => 'googlemap_y',
                'name' => 'googlemap_y',
                'type' => 'text',
                'value' => '',
                'label' => 'Google map Y coordinate',
                'desc' => 'Insert google map coordinate for your adress',
                'options' => array(
                    'size' => '5'
                )
            ),
            array(
                'id' => 'googlemap_zoom',
                'name' => 'googlemap_zoom',
                'type' => 'text',
                'value' => '15',
                'label' => 'Google map zoom factor',
                'desc' => 'Insert google map zoom factor',
                'options' => array(
                    'size' => '5'
                )
            ),
            array(
                'id' => 'marker_title',
                'name' => 'marker_title',
                'type' => 'text',
                'value' => 'Marker',
                'label' => 'Marker Title',
                'desc' => 'Insert marker title.',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'google_map_type',
                'name' => 'google_map_type',
                'type' => 'select',
                'value' => array(
                    array('HYBRID', 'HYBRID'), // ARRAY ('TITLE', 'VALUE')
                    array('ROADMAP', 'ROADMAP'), // ARRAY ('TITLE', 'VALUE')
                    array('SATELLITE', 'SATELLITE'), // ARRAY ('TITLE', 'VALUE')
                    array('TERRAIN', 'TERRAIN'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Google Map type',
                'desc' => 'Select map type you want to use.',
            ),
        ),
    ),
);
?>