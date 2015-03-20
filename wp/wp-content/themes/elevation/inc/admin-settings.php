<?php
$args = array(
	'orderby'            => 'name',
	'hide_empty'         => 1,
	'depth'              => 10,
);
$categories = get_categories($args);

$new_array = array();

foreach ($categories as $category_list ) {
    $array_to_add = array(
                'id' => 'cat_'.$category_list->term_id,
                'name' => 'cat_'.$category_list->term_id,
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    '',
                ),
                'label' => $category_list->cat_name,
                'desc' => '',
            );
    array_push($new_array, $array_to_add );
}

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
                'desc' => 'JPEG, GIF or PNG image, 230x30px recommended, up to 500KB',
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
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                )
            ),     
          
            array(
                'id' => 'one_nav',
                'name' => 'one_nav',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Use only one navigation menu',
                ),
                'label' => 'Use One Menu',
                'desc' => 'Check this box if you want to use only one navigation menu instead of two.',
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
                'id' => 'footer_copy',
                'name' => 'footer_copy',
                'type' => 'text',
                'value' => 'Copyright Information Goes Here © 2012. All Rights Reserved.',
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
                'id' => 'disable_home_projects',
                'name' => 'disable_home_projects',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Disable Home Projects',
                ),
                'label' => 'Disable Projects on Home Page',
                'desc' => 'Check this box if you want to disable projects on your Home page.',
            ),
            
            array(
                'id' => 'projects_orderby',
                'name' => 'projects_orderby',
                'type' => 'select',
                'value' => array(
                    array('Sort by name', 'name'), // ARRAY ('TITLE', 'VALUE')
                    array('Sort by slug', 'slug'), // ARRAY ('TITLE', 'VALUE')
                    array('Sort by count', 'count'), // ARRAY ('TITLE', 'VALUE')
                    array('Sort by ID', 'term_id'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Category Navigation - Order By',
                'desc' => 'Select how to sort category navigation by parameter.',
            ),

            array(
                'id' => 'projects_order',
                'name' => 'projects_order',
                'type' => 'select',
                'value' => array(
                    array('Ascending', 'ASC'), // ARRAY ('TITLE', 'VALUE')
                    array('Descending', 'DESC'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Category Navigation - Order',
                'desc' => 'Select how to sort category navigation by order (Ascending or Descending).',
            ),

            array(
                'id' => 'projects_paged',
                'name' => 'projects_paged',
                'type' => 'text',
                'value' => '',
                'label' => 'Number of Projects on Home Page',
                'desc' => 'Insert how many projects to show on Home page. Leve blank if you want to show all',
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
                'id' => 'use_call_to_action_image',
                'name' => 'use_call_to_action_image',
                'type' => 'file',
                'value' => '',
                'label' => 'Call To Action Image',
                'desc' => 'JPEG, GIF or PNG image, 125x144 recommended, up to 500KB',
            ),
            
            array(
                'id' => 'call_to_action_title',
                'name' => 'call_to_action_title',
                'type' => 'text',
                'value' => '',
                'label' => 'Call To Action Title',
                'desc' => 'Insert Title for Call To Action part of Home Page.',
                'options' => array(
                    'size' => '100'
                )

            ),

            array(
                'id' => 'call_to_action_text',
                'name' => 'call_to_action_text',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Call To Action Text',
                'desc' => 'Insert Text for Call To Action part of Home Page.',
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
                'label' => 'Call To Action Button Text',
                'desc' => 'Insert Text for Button in Call To Action part of Home Page.',
                'options' => array(
                    'size' => '20'
                )

            ),

            array(
                'id' => 'call_to_action_button_url',
                'name' => 'call_to_action_button_url',
                'type' => 'text',
                'value' => '',
                'label' => 'Call To Action URL',
                'desc' => 'Insert Url for Button in Call To Action part of Home Page ( http://www.themeskingdom.com ).',
                'options' => array(
                    'size' => '100'
                )

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
                'id' => 'header_bg_img',
                'name' => 'header_bg_img',
                'type' => 'file',
                'value' => '',
                'label' => 'Header Background Image',
                'desc' => '',
                'clear' =>'' //if "YES" then clear button will appear
            ),

            array(
                'id' => 'header_img_position',
                'name' => 'header_img_position',
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
                'id' => 'header_img_repeat',
                'name' => 'header_img_repeat',
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
                'id' => 'header_img_attachment',
                'name' => 'header_img_attachment',
                'type' => 'select',
                'value' => array(
                    array('Scroll', 'scroll'), // ARRAY ('TITLE', 'VALUE')
                    array('Fixed', 'fixed'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Image Attachment',
                'desc' => '',
            ),

            array(
                'id' => 'header_color',
                'name' => 'header_color',
                'type' => 'colorpicker',
                'value' => 'FFF',
                'label' => 'Header background color',
                'desc' => 'Set header background color',
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
                'id' => 'body_bg_img',
                'name' => 'body_bg_img',
                'type' => 'file',
                'value' => '',
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
                'value' => 'EFEFEF',
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
                'id' => 'navigation_color',
                'name' => 'navigation_color',
                'type' => 'colorpicker',
                'value' => 'FFFFFF',
                'label' => 'Navigation Color',
                'desc' => 'Set navigation color for your site',
            ),
               
            array(
                'id' => 'title_color',
                'name' => 'title_color',
                'type' => 'colorpicker',
                'value' => '000000',
                'label' => 'Title Color',
                'desc' => 'Set color for Headings, Blog Title, Sidebar Widget Title',
            ),
               
            array(
                'id' => 'paragraph_color',
                'name' => 'paragraph_color',
                'type' => 'colorpicker',
                'value' => '323232',
                'label' => 'Paragraph Color',
                'desc' => 'Set color for Content Paragraph, Blog Paragraph, Sidebar Widget Text',
            ),
               
            array(
                'id' => 'link_color',
                'name' => 'link_color',
                'type' => 'colorpicker',
                'value' => 'a1a1a1',
                'label' => 'Link Color',
                'desc' => 'Set color for links on your site',
            ),
               
            array(
                'id' => 'link_hover_color',
                'name' => 'link_hover_color',
                'type' => 'colorpicker',
                'value' => 'FFD500',
                'label' => 'Hover Color',
                'desc' => 'Set color for mouse over (hover) on your site',
            ),

               
            array(
                'id' => 'footer_title_color',
                'name' => 'footer_title_color',
                'type' => 'colorpicker',
                'value' => '000000',
                'label' => 'Footer Title Color',
                'desc' => 'Set color for Fotter Widget Title',
            ),
               
            array(
                'id' => 'footer_paragraph_color',
                'name' => 'footer_paragraph_color',
                'type' => 'colorpicker',
                'value' => '323232',
                'label' => 'Footer Paragraph Color',
                'desc' => 'Set color for Footer Widget Text',
            ),
               
            array(
                'id' => 'copyright_color',
                'name' => 'copyright_color',
                'type' => 'colorpicker',
                'value' => '323232',
                'label' => 'Copyright Color',
                'desc' => 'Set color for Copyright Text',
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
                'desc' => 'If empty, default WordPress url will be used',
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
                'desc' => 'Enter Twitter account (e.g. themeskingdom) or leave empty if you dont wish to use Twitter',
                'options' => array(
                    'size' => '80'
                )
            ),

            array(
                'id' => 'linked_in',
                'name' => 'linked_in',
                'type' => 'text',
                'value' => '',
                'label' => 'Linkedin account',
                'desc' => 'Enter Linkedin account (e.g. http://www.linkedin.com/company/2687325) or leave empty if you dont wish to use Linkedin',
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