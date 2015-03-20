<?php

$tabs = array(

        /*************************************************************/
        /************GENERAL OPTIONS*******************************/
        /*************************************************************/

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
                'value' => get_template_directory_uri()."/style/img/logo.png",
                'label' => 'Header Logo',
                'desc' => 'JPEG, GIF or PNG image, 225×45px recommended',
            ),

            array(
                'id' => 'header_margin_top',
                'name' => 'header_margin_top',
                'type' => 'text',
                'value' => '55',
                'label' => 'Top margin of the logo',
                'desc' => 'Set the top margin of the logo in pixels, default value is 55',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'header_margin_right',
                'name' => 'header_margin_right',
                'type' => 'text',
                'value' => '0',
                'label' => 'Right margin of the logo',
                'desc' => 'Set right margin of the logo in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'header_margin_bottom',
                'name' => 'header_margin_bottom',
                'type' => 'text',
                'value' => '0',
                'label' => 'Bottom margin of logo',
                'desc' => 'Set bottom margin of the logo in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'header_margin_left',
                'name' => 'header_margin_left',
                'type' => 'text',
                'value' => '0',
                'label' => 'Left margin of logo',
                'desc' => 'Set left margin of the logo in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'favicon',
                'name' => 'favicon',
                'type' => 'file',
                'value' => get_template_directory_uri()."/style/img/favicon.ico",
                'label' => 'Favicon',
                'desc' => 'File format: ICO, dimenstions: 16x16',

            ),

            array(
                'id' => 'header_advert',
                'name' => 'header_advert',
                'type' => 'posts',
                'value' => '',
                'post_type' => 'advertisement',
                'label' => 'Header Banner',
                'desc' => 'Select your Header Advertisement Banner.',
            ),
            
            array(
                'id' => 'banner_margin_top',
                'name' => 'banner_margin_top',
                'type' => 'text',
                'value' => '35',
                'label' => 'Top margin of the banner',
                'desc' => 'Set the top margin of the banner in pixels, default value is 35',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'banner_margin_right',
                'name' => 'banner_margin_right',
                'type' => 'text',
                'value' => '0',
                'label' => 'Right margin of the banner',
                'desc' => 'Set right margin of the banner in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'banner_margin_bottom',
                'name' => 'banner_margin_bottom',
                'type' => 'text',
                'value' => '0',
                'label' => 'Bottom margin of banner',
                'desc' => 'Set bottom margin of the banner in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'banner_margin_left',
                'name' => 'banner_margin_left',
                'type' => 'text',
                'value' => '0',
                'label' => 'Left margin of banner',
                'desc' => 'Set left margin of the banner in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),
            
           array(
                'id' => 'header_date_visible',
                'name' => 'header_date_visible',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Display header date',
                ),
                'label' => 'Header date',
                'desc' => 'Display date in header next to the top menu.',
            ),
            
            array(
                'id' => 'navigation_count',
                'name' => 'navigation_count',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked, count in the category navigation will be shown',
                ),
                'label' => 'Navigation Post Count',
                'desc' => 'Display post count in category navigation',
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
            'id' => 'box_1_hr',
            'name' => 'box_1_hr',
            'type' => 'hr',
            'options' => array(
                'width' => '100%',
                'color' => '#DFDFDF'
            )
        ),     
            
            array(
                'id' => 'use_facebook',
                'name' => 'use_facebook',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked Facebook share button and counter will be disabled in a single post.',
                ),
                'label' => 'Disable Facebook Share',
                'desc' => '',
            ),
            
            array(
                'id' => 'use_twitter',
                'name' => 'use_twitter',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked Twitter share button and counter will be disabled in a single post.',
                ),
                'label' => 'Disable Twitter Share',
                'desc' => '',
            ),
            
            array(
                'id' => 'use_google',
                'name' => 'use_google',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked Google+ share button and counter will be disabled in a single post.',
                ),
                'label' => 'Disable Google+ Share',
                'desc' => '',
            ),
            
            array(
                'id' => 'use_linkedin',
                'name' => 'use_linkedin',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked LinkedIn share button and counter will be disabled in a single post.',
                ),
                'label' => 'Disable LinkedIn Share',
                'desc' => '',
            ),
            
            array(
                'id' => 'use_pinterest',
                'name' => 'use_pinterest',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked Pinterest share button and counter will be disabled in a single post.',
                ),
                'label' => 'Disable Pinterest Share',
                'desc' => '',
            ),
            
            array(
                'id' => 'use_stumbleupon',
                'name' => 'use_stumbleupon',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If checked Stumbleupon share button and counter will be disabled in a single post.',
                ),
                'label' => 'Disable Stumbleupon Share',
                'desc' => '',
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
                'id' => 'disable_author',
                'name' => 'disable_author',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If this box is checked you will disable Author Info in single pages.',
                ),
                'label' => 'Disable Author Box',
                'desc' => '',
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
                'id' => 'disable_related',
                'name' => 'disable_related',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If this box is checked you will disable Related posts section in single pages.',
                ),
                'label' => 'Disable Related Posts',
                'desc' => '',
            ),

            array(
                'id' => 'chose_related',
                'name' => 'chose_related',
                'type' => 'select',
                'value' => array(
                    array('Chose Related by Tag', 'tag'), // ARRAY ('TITLE', 'VALUE')
                    array('Chose Related by Category', 'cat'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Chose Related posts by',
                'desc' => 'Select how to pick your related post. The random 4 posts from same Category or with the same Tag.',
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
                'id' => 'slider_fullwidth',
                'name' => 'slider_fullwidth',
                'type' => 'select',
                'value' => array(
                    array( 'Fullwidth Slider', 'fullwidth_slider'), // ARRAY ('TITLE', 'VALUE')
                    array( 'Halfwidth Slider / Social Icons', 'halfwidth_slider'), // ARRAY ('TITLE', 'VALUE')
                    array( 'None', 'none'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Slider Width',
                'desc' => 'Select slider width, with or without social icons ',
            ), 
            
            
            array(
                'id' => 'slider_category',
                'name' => 'slider_category',
                'type' => 'category',
                'label' => 'Slider Category',
                'desc' => 'Select slider width, with or without social icons ',
                'value' => '',
            ), 
            
            
            array(
                'id' => 'slides_number',
                'name' => 'slides_number',
                'type' => 'text',
                'value' => '10',
                'label' => 'Number Of Slides',
                'desc' => 'Write how many slides will be shown',
                'options' => array(
                    'size' => '20'
                )
            ),
            
            array(
                'id' => 'slider_pause_time',
                'name' => 'slider_pause_time',
                'type' => 'text',
                'value' => '4000',
                'label' => 'Pause Time',
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
                'label' => 'Animation Time',
                'desc' => 'This is animation time in miliseconds between two slides.',
                'options' => array(
                    'size' => '20'
                )
            ),
            
            array(
                'id' => 'slider_effect',
                'name' => 'slider_effect',
                'type' => 'select',
                'value' => array(
                    array('Slide', 'slide'), // ARRAY ('TITLE', 'VALUE')
                    array('Fade', 'fade'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Slider Effect',
                'desc' => 'Animation effect between two slides.',
            ),
            
            array(
                'id' => 'slider_fold',
                'name' => 'slider_fold',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If selected slider fold will be shown',
                ),
                'label' => 'Show Slider Fold',
                'desc' => 'Show or hide slider fold that is displaying comments and date',
            ),
            
            
            array(
                'id' => 'disable_blog_slider',
                'name' => 'disable_blog_slider',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'If this box is checked you will disable Main slider in Blog Templates.',
                ),
                'label' => 'Disable Slider in Blog Templates',
                'desc' => '',
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
                'desc' => 'Text which appears in a footer as the copyright text',
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

                    'label' => 'Home Page Builder',
                    'name' => 'page_builder',
                    'type' => 'page_builder',
                    'description' => '',
                    'value' => 'blue-1',
                    'options' => array(
                                    'flexSlider' => 'Flex Slider',
                                    'caruoselSlider' => 'Caruousel Slider',
                                    'ads' => 'Ad Banner',
                                    'content' => 'Page Content',
                                    'oneCatTop' => 'Full Width Post Type 1',
                                    'oneCatSide' => 'Full Width Post Type 2',
                                    'twoColTopOneCat' => 'Two Columns From One Category Type 1',
                                    'twoColTopTwoCat' => 'Two Columns From Two Categories Type 1',
                                    'twoColSideOneCat' => 'Two Columns From One Category Type 2',
                                    'twoColSideTwoCat' => 'Two Columns From Two Categories Type 2',
                    ),
            ),            
        ),
    ),
    

        /*************************************************************/
        /************SOCIAL OPTIONS*********************************/
        /*************************************************************/

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
                'desc' => 'Enter url of RSS feed you want to use. WordPress default URL is <a href="'.site_url().'/feed/">'.site_url().'/feed/</a>',
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
                'id' => 'google_plus_api',
                'name' => 'google_plus_api',
                'type' => 'text',
                'value' => '',
                'label' => 'Google Plus Api',
                'desc' => 'Get your google API code <a href="https://code.google.com/apis/console/">here</a>',
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
                'desc' => 'Enter Twitter account (e.g. themeskingdom) or leave empty if you dont wish to use Twitter',
                'options' => array(
                    'size' => '80'
                )
            ),

            array(
                'id' => 'linkedin',
                'name' => 'linkedin',
                'type' => 'text',
                'value' => '',
                'label' => 'Linkedin account',
                'desc' => 'Enter Linkedin account (e.g. http://www.linkedin.com/company/2687325) or leave empty if you dont wish to use Linkedin',
                'options' => array(
                    'size' => '80'
                )
            ),

            array(
                'id' => 'pinterest',
                'name' => 'pinterest',
                'type' => 'text',
                'value' => '',
                'label' => 'Pinterest account',
                'desc' => 'Enter Pinterest account (e.g. themeskingdom) or leave empty if you dont wish to use Pinterest',
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
                'value' => '',
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
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),
            
            array(
                'id' => 'use_social_home_animation',
                'name' => 'use_social_home_animation',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use animation',
                ),
                'label' => 'Social animation',
                'desc' => 'Use count animation on Followers / Fans / Subscribers Total number',
            ),
            
            array(
                'id' => 'social_home_animation_speed',
                'name' => 'social_home_animation_speed',
                'type' => 'text',
                'value' => '20',
                'label' => 'Count speed',
                'desc' => 'Social count animation speed',
                'options' => array(
                    'size' => '80'
                )
            ),
            
            array(
                'id' => 'social_home_update_interval',
                'name' => 'social_home_update_interval',
                'type' => 'text',
                'value' => '50',
                'label' => 'Count interval',
                'desc' => 'Social count animation update interval',
                'options' => array(
                    'size' => '80'
                )
            ),

        ),
    ),

    
    
        /*************************************************************/
        /*****************WIDGET AREAS****************************/
        /*************************************************************/

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

        /*************************************************************/
        /************CONTACT OPTIONS******************************/
        /*************************************************************/

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
                'value' => 'E-mail from '.tk_theme_name().' Theme',
                'label' => 'Subject for your contact form e-mail',
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
                'desc' => 'Enter an error message if a name is not entered in the contact form',
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
                'desc' => 'Enter an error message if an e-mail is not entered in the contact form',
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
                'desc' => 'Enter an error message if the message text is not entered in the contact form',
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
                'desc' => 'Enter a notification text for successfully sent message',
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
                'desc' => 'Enter a notification text for the unsuccessfully sent message',
                'options' => array(
                    'size' => '100'
                )
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
                'desc' => 'Set color of the google map, leave empty for default color',
            ),

            array(
                'id' => 'googlemap_x',
                'name' => 'googlemap_x',
                'type' => 'text',
                'value' => '',
                'label' => 'Google map X coordinate',
                'desc' => 'Insert a google map coordinate for your address',
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
                'desc' => 'Insert a google map coordinate for your address',
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
                'desc' => 'Insert a google map zoom factor',
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
                'desc' => 'Insert a marker title',
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
                'desc' => 'Select a map type you want to use',
            ),


        ),
    ),
        
);



?>