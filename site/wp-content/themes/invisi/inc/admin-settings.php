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
                'desc' => 'JPEG, GIF or PNG image, 300x95px recommended, up to 500KB',
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
                'id' => 'cat_label',
                'name' => 'cat_label',
                'type' => 'label',
                'value' => '',
                'label' => 'Chose Categories For Category Navigation',
                'desc' => '',
                'options' => array(
                    'size' => '100'
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
                'id' => 'advertisement',
                'name' => 'advertisement',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Disable Advertisement Banner On Your Home page',
                ),
                'label' => 'Disable Advertisement Banner',
                'desc' => 'Check this box if you want to disable advertisement banner on home page.',
            ),
            
            array(
                'id' => 'banner_title',
                'name' => 'banner_title',
                'type' => 'text',
                'value' => '',
                'label' => 'Header Advertisement Title',
                'desc' => 'Insert Title For Your Advertisement Banner',
                'options' => array(
                    'size' => '100'
                )
            ), 
            
           array(
                'id' => 'add_banner',
                'name' => 'add_banner',
                'type' => 'file',
                'value' => get_template_directory_uri()."/style/img//baner468x60.jpg",
                'label' => 'Header Advertisement Banner',
                'desc' => 'JPEG, GIF or PNG image, 468x60px recommended, up to 500KB',
            ),
            
            array(
                'id' => 'banner_link',
                'name' => 'banner_link',
                'type' => 'text',
                'value' => 'http://www.themeskingdom.com',
                'label' => 'Header Advertisement Link',
                'desc' => 'Insert Link For Your Advertisement Banner',
                'options' => array(
                    'size' => '100'
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
                'id' => 'slider_category',
                'name' => 'slider_category',
                'type' => 'category',
                'value' => '',
                'label' => 'Slider category',
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
                'id' => 'recent_posts',
                'name' => 'recent_posts',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Disable Recent post section on your Home page',
                ),
                'label' => 'Disable Home Page Recent Posts',
                'desc' => 'Check this box if you want to disable recent posts from home page.',
            ),
            
            array(
                'id' => 'recent_number',
                'name' => 'recent_number',
                'type' => 'text',
                'value' => '2',
                'label' => 'Number of recent posts',
                'desc' => 'Insert how many recent posts you want to show in on Home page',
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
                'id' => 'categories',
                'name' => 'categories',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Disable Categories post section on your Home page',
                ),
                'label' => 'Disable Home Page Categories Posts',
                'desc' => 'Check this box if you want to disable categories posts from home page.',
            ),

            array(
                'id' => 'cat_label',
                'name' => 'cat_label',
                'type' => 'label',
                'value' => '',
                'label' => 'Show Posts From Category',
                'desc' => '',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'number_of_posts',
                'name' => 'number_of_posts',
                'type' => 'text',
                'value' => '4',
                'label' => 'Number of posts',
                'desc' => 'Insert how many posts you want to show in categories',
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
                'id' => 'header_color',
                'name' => 'header_color',
                'type' => 'colorpicker',
                'value' => '464646',
                'label' => 'Header background color',
                'desc' => 'Set header background color',
            ),

            array(
                'id' => 'header_nav_color',
                'name' => 'header_nav_color',
                'type' => 'colorpicker',
                'value' => '2F2F2F',
                'label' => 'Header Navigation Color',
                'desc' => 'Set header navigation color',
            ),

            array(
                'id' => 'category_nav_color',
                'name' => 'category_nav_color',
                'type' => 'colorpicker',
                'value' => 'F95625',
                'label' => 'Category Navigation Color',
                'desc' => 'Set category navigation color',
            ),

            array(
                'id' => 'body_color',
                'name' => 'body_color',
                'type' => 'colorpicker',
                'value' => 'DADBD5',
                'label' => 'Body background color',
                'desc' => 'Set body background color',
            ),

            array(
                'id' => 'footer_color',
                'name' => 'footer_color',
                'type' => 'colorpicker',
                'value' => 'F2F2F2',
                'label' => 'Footer and Sidebar background color',
                'desc' => 'Set footer and sidebar background color',
            ),

            array(
                'id' => 'copyright_color',
                'name' => 'copyright_color',
                'type' => 'colorpicker',
                'value' => '2F2F2F',
                'label' => 'Copyright background color',
                'desc' => 'Set copyright background color',
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
                'value' => '727272',
                'label' => 'Navigation Color',
                'desc' => 'Set navigation color for your site',
            ),

            array(
                'id' => 'navigation_hover',
                'name' => 'navigation_hover',
                'type' => 'colorpicker',
                'value' => 'F95625',
                'label' => 'Navigation Hover (Mouse over) Color',
                'desc' => 'Set color for navigation links on your site when they are hovered (mouse over)',
            ),
            
            array(
                'id' => 'category_navigation_color',
                'name' => 'category_navigation_color',
                'type' => 'colorpicker',
                'value' => 'FFF',
                'label' => 'Category Navigation Color',
                'desc' => 'Set category navigation color for your site',
            ),

            array(
                'id' => 'category_navigation_hover',
                'name' => 'category_navigation_hover',
                'type' => 'colorpicker',
                'value' => '464646',
                'label' => 'Category Navigation Hover (Mouse over) Color',
                'desc' => 'Set category color for navigation links on your site when they are hovered (mouse over)',
            ),
            
            array(
                'id' => 'title_color',
                'name' => 'title_color',
                'type' => 'colorpicker',
                'value' => '464646',
                'label' => 'Title and Paragraph Color',
                'desc' => 'Set color for post titles, post paragraph, sidebar text color',
            ),  
            
            array(
                'id' => 'link_color',
                'name' => 'link_color',
                'type' => 'colorpicker',
                'value' => 'FF5926',
                'label' => 'Link Color',
                'desc' => 'Set hover color for links on your site',
            ),
            
            array(
                'id' => 'copyright',
                'name' => 'copyright',
                'type' => 'colorpicker',
                'value' => 'DADBD5',
                'label' => 'Copyright Color',
                'desc' => 'Set color for copyright text on your site',
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
                    'HYBRID',
                    'ROADMAP',
                    'SATELLITE',
                    'TERRAIN'
                ),
                'label' => 'Google Map type',
                'desc' => 'Select map type you want to use.',
            ),


        ),
    ),
        
);

array_splice($tabs[1]['fields'], 12, 0, $new_array);
array_splice($tabs[0]['fields'], 5, 0, $new_array);

?>