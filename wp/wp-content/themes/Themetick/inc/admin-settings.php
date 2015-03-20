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
                'desc' => 'JPEG, GIF or PNG image, 192x31px recommended, up to 500KB',
            ),

            array(
                'id' => 'footer_logo',
                'name' => 'footer_logo',
                'type' => 'file',
                'value' => get_template_directory_uri()."/style/img/footer-logo.png",
                'label' => 'Footer Logo',
                'desc' => 'JPEG, GIF or PNG image, 192x31px recommended, up to 500KB',
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
                'id' => 'use_footer',
                'name' => 'use_footer',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Disable Footer Widgets',
                ),
                'label' => 'Disable Footer Widgets',
                'desc' => 'When this option is checked 3 widget areas in footer wont be shown.',
            ),

            array(
                'id' => 'footer_copy',
                'name' => 'footer_copy',
                'type' => 'text',
                'value' => 'Copyright Information Goes Here &copy; 2012. All Rights Reserved.',
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
                'id' => 'enable_slider',
                'name' => 'enable_slider',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Enable Slider',
                ),
                'label' => 'Slider',
                'desc' => 'Enable slider on home page',
            ),

            array(
                'id' => 'slider_autoplay',
                'name' => 'auto_play',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Auto Play',
                ),
                'label' => '',
                'desc' => '',
            ),

            array(
                'id' => 'show_slider',
                'name' => 'show_slider',
                'type' => 'text',
                'value' => '2000',
                'label' => 'Time to show the slider',
                'desc' => 'In milliseconds.',
                'options' => array(
                    'size' => '5'
                )

            ),


            array(
                'id' => 'slider_dalay',
                'name' => 'slider_delay',
                'type' => 'text',
                'value' => '5000',
                'label' => 'Slider delay',
                'desc' => 'In milliseconds.',
                'options' => array(
                    'size' => '5'
                )

            ),

            array(
                'id' => 'animation_time',
                'name' => 'animation_time',
                'type' => 'text',
                'value' => '200',
                'label' => 'Slider animation time',
                'desc' => 'In milliseconds.',
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
                'desc' => 'only content from this page will be shown on Home Page.',

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
                'id' => 'datepicker_hour',
                'name' => 'datepicker_hour',
                'type' => 'select',
                'value' => array(

                    array('00', '00'), // ARRAY ('TITLE', 'VALUE')
                    array('01', '01'),
                    array('02', '02'),
                    array('03', '03'),
                    array('04', '04'),
                    array('05', '05'),
                    array('06', '06'),
                    array('07', '07'),
                    array('08', '08'),
                    array('09', '09'),
                    array('10', '10'),
                    array('11', '11'),
                    array('12', '12'),
                    array('13', '13'),
                    array('14', '14'),
                    array('15', '15'),
                    array('16', '16'),
                    array('17', '17'),
                    array('18', '16'),
                    array('19', '19'),
                    array('20', '20'),
                    array('21', '21'),
                    array('22', '22'),
                    array('23', '23'),



                ),
                'label' => 'Time of event - Hour',
                'desc' => 'Select at what time event starts (hours)',
            ),

            array(
                'id' => 'datepicker_min',
                'name' => 'datepicker_min',
                'type' => 'select',
                'value' => array(

                    array('00', '00'), // ARRAY ('TITLE', 'VALUE')
                    array('01', '01'),
                    array('02', '02'),
                    array('03', '03'),
                    array('04', '04'),
                    array('05', '05'),
                    array('06', '06'),
                    array('07', '07'),
                    array('08', '08'),
                    array('09', '09'),
                    array('10', '10'),
                    array('11', '11'),
                    array('12', '12'),
                    array('13', '13'),
                    array('14', '14'),
                    array('15', '15'),
                    array('16', '16'),
                    array('17', '17'),
                    array('18', '16'),
                    array('19', '19'),
                    array('20', '20'),
                    array('21', '21'),
                    array('22', '22'),
                    array('23', '23'),
                    array('24', '24'),
                    array('25', '25'),
                    array('26', '26'),
                    array('27', '27'),
                    array('28', '28'),
                    array('29', '29'),
                    array('30', '30'),
                    array('31', '31'),
                    array('32', '32'),
                    array('33', '33'),
                    array('34', '34'),
                    array('35', '35'),
                    array('36', '36'),
                    array('37', '37'),
                    array('38', '38'),
                    array('39', '39'),
                    array('40', '40'),
                    array('41', '41'),
                    array('42', '42'),
                    array('43', '43'),
                    array('44', '44'),
                    array('45', '45'),
                    array('46', '46'),
                    array('47', '47'),
                    array('48', '48'),
                    array('49', '49'),
                    array('50', '50'),
                    array('51', '51'),
                    array('52', '52'),
                    array('53', '53'),
                    array('54', '54'),
                    array('55', '55'),
                    array('56', '56'),
                    array('57', '57'),
                    array('58', '58'),
                    array('59', '59'),
                 ),
                'label' => 'Time of event - Minutes',
                'desc' => 'Select at what time event starts (minutes)',
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
                'id' => 'program_category',
                'name' => 'program_category',
                'type' => 'taxonomy',
                'label' => 'Choose Category for Home page Program section',
                'desc' => '',
                'taxonomy' => 'program',
            ),

          array(
                'id' => 'speakers_category',
                'name' => 'speakers_category',
                'type' => 'taxonomy',
                'label' => 'Choose Category for Home page Speakers section',
                'desc' => '',
                'taxonomy' => 'speakers',
            ),

            array(
                'id' => 'speakers_per_page',
                'name' => 'speakers_per_page',
                'type' => 'select',
                'value' => array (
                    array('1', '1'),
                    array('2', '2'),
                    array('3', '3'),
                    array('4', '4'),
                    array('5', '5'),
                    array('6', '6'),
                    array('7', '7'),
                    array('8', '8'),
                    array('9', '9'),
                    array('10', '10'),
                   
                ),
                'label' => 'Speakers on home page',
                'desc' => 'Insert how many speakers per page to show on home page slider',
                'options' => array(
                    'size' => '5'
                )
            ),

            array(
                'id' => 'program_per_page',
                'name' => 'program_per_page',
                'type' => 'select',
                'value' => array (
                    array('1', '1'),
                    array('2', '2'),
                    array('3', '3'),
                    array('4', '4'),
                    array('5', '5'),
                    array('6', '6'),
                    array('7', '7'),
                    array('8', '8'),
                    array('9', '9'),
                    array('10', '10'),
                ),
                'label' => 'Program on home page',
                'desc' => 'Insert how many programs per page to show on home page slider',
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
                    'Use Partners Horizontal Slider',
                ),
                'label' => '',
                'desc' => '',
            ),

            array(
                'id' => 'horizontal_slider_category',
                'name' => 'horizontal_slider_category',
                'type' => 'taxonomy',
                'taxonomy' => 'partners',
                'label' => 'Choose what Partner posts to show in horizontal slider',
                'desc' => '',
            ),

        ),
    ),
        /*************************************************************/
        /************COLOR OPTIONS*********************************/
        /*************************************************************/

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'colors',
        'name' => 'Colors',

        'fields' => array(


           array(
                'id' => 'body_bg_img',
                'name' => 'body_bg_img',
                'type' => 'file',
                'value' => ''.get_template_directory_uri().'/style/img/pattern.png',
                'label' => 'Body Background Image',
                'desc' => '',
                'clear' =>'' //if "YES" then clear button will appear
            ),

                        array(
                'id' => 'body_img_position',
                'name' => 'body_img_position',
                'type' => 'select',
                'value' => array(
                    array('Left', 'left top'), // ARRAY ('TITLE', 'VALUE')
                    array('Center', 'center top'), // ARRAY ('TITLE', 'VALUE')
                    array('Right', 'right top'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Image Position',
                'desc' => '',
            ),

            array(
                'id' => 'body_img_repeat',
                'name' => 'body_img_repeat',
                'type' => 'select',
                'value' => array(
                    array('Tile', 'repeat'), // ARRAY ('TITLE', 'VALUE')
                    array('No Repeat', 'no-repeat'), // ARRAY ('TITLE', 'VALUE')
                    array('Tile Horizontally', 'repeat-x'), // ARRAY ('TITLE', 'VALUE')
                    array('Tile Vertically', 'repeat-y'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Image Repeat',
                'desc' => '',
            ),

            array(
                'id' => 'body_img_attachment',
                'name' => 'body_img_attachment',
                'type' => 'select',
                'value' => array(
                    array('Scroll', 'scroll'), // ARRAY ('TITLE', 'VALUE')
                    array('Fixed', 'fixed'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Image Attachment',
                'desc' => '',
            ),


            array(
                'id' => 'body_color',
                'name' => 'body_color',
                'type' => 'colorpicker',
                'value' => 'F6F4EF',
                'label' => 'Body background color',
                'desc' => 'Set body background color',
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
                'id' => 'link_color',
                'name' => 'link_color',
                'type' => 'colorpicker',
                'value' => '272323',
                'label' => 'Link Color',
                'desc' => 'Set color for all links on your site',
            ),

            array(
                'id' => 'hover_color',
                'name' => 'hover_color',
                'type' => 'colorpicker',
                'value' => 'FF6825',
                'label' => 'Hover (Mouse over) Color',
                'desc' => 'Set color for all links on your site when they are hovered (mouse over)',
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
                'id' => 'titles_color',
                'name' => 'titles_color',
                'type' => 'colorpicker',
                'value' => '272323',
                'label' => 'Titles and Headings Color',
                'desc' => 'Set color for Titles and Headings',
            ),

            array(
                'id' => 'paragraph_color',
                'name' => 'paragraph_color',
                'type' => 'colorpicker',
                'value' => '555147',
                'label' => 'Paragraph Color',
                'desc' => 'Set color paragraphs on your site (NOTE: this is the most common color on site)',
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
                'id' => 'call_to_action_title_color',
                'name' => 'call_to_action_title_color',
                'type' => 'colorpicker',
                'value' => '272323',
                'label' => 'Call To Action Title Color',
                'desc' => 'Set color for Call To Action Title',
            ),

            array(
                'id' => 'call_to_action_undertitle_color',
                'name' => 'call_to_action_undertitle_color',
                'type' => 'colorpicker',
                'value' => 'F78249',
                'label' => 'Call To Action Undertitle Color',
                'desc' => 'Set color for Call To Action Undertitle',
            ),


            array(
                'id' => 'button_color',
                'name' => 'button_color',
                'type' => 'select',
                'desc' => 'Set color of a button near the countdown.',
                'value' => array(
                   array('Default', 'Default'), // ARRAY ('TITLE', 'VALUE')
                   array('Black', 'Black'), // ARRAY ('TITLE', 'VALUE')
                   array('Silver', 'Silver'), // ARRAY ('TITLE', 'VALUE')
                   array('Blue', 'Blue'), // ARRAY ('TITLE', 'VALUE')
                   array('Red', 'Red'), // ARRAY ('TITLE', 'VALUE')
                   array('Green', 'Green'), // ARRAY ('TITLE', 'VALUE')
                   array('Yellow', 'Yellow'), // ARRAY ('TITLE', 'VALUE')
                   array('Brown', 'Brown'), // ARRAY ('TITLE', 'VALUE')

                ),
                'label' =>__('Choose Button Color', 'booker'),
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
                'id' => 'button_test',
                'name' => 'button_test',
                'type' => 'button',
                'value' => 'Reset Colors',
                'label' => 'Reset Colors',
                'desc' => 'Reset Theme to default colors',
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
                'id' => 'enable_rss',
                'name' => 'enable_rss',
                'type' => 'checkbox',
                'value' => array(
                    'yes'

                ),
                'caption' => array(
                    'Enable RSS'
                ),
                'label' => 'RSS',
                'desc' => 'Enable RSS Feed',

            ),

            array(
                'id' => 'rss_url',
                'name' => 'rss_url',
                'type' => 'text',
                'value' => '',
                'label' => 'RSS Feed URL',
                'desc' => 'if empty, default WordPress url will be used',
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
                'desc' => 'Leave this box empty if you dont want to use Google+',
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
                'desc' => 'Leave this box empty if you dont want to use Facebook',
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
                'desc' => 'Leave this box empty if you dont want to use Twitter',
                'options' => array(
                    'size' => '80'
                )
            ),

            array(
                'id' => 'linkedin',
                'name' => 'linkedin',
                'type' => 'text',
                'value' => '',
                'label' => 'LinkedIn Account',
                'desc' => 'Leave this box empty if you dont want to use LinkedIn',
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
                'label' => 'Subject for your contact form',
                'desc' => 'This will be subject when you receive e-mail from your site',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'subject_error_message',
                'name' => 'subject_error_message',
                'type' => 'text',
                'value' => 'Please insert message subject!',
                'label' => 'Subject error message',
                'desc' => 'Edit error and success messages for contact form',
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
                'desc' => 'Edit error and success messages for contact form',
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
                'desc' => 'Edit error and success messages for contact form',
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
                'desc' => 'Edit error and success messages for contact form',
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
                'desc' => 'Edit error and success messages for contact form',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'message_unsuccessful',
                'name' => 'message_unsuccessful',
                'type' => 'text',
                'value' => 'Some error occured!',
                'label' => 'Message on successful e-mail send',
                'desc' => 'Edit error and success messages for contact form',
                'options' => array(
                    'size' => '100'
                )
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