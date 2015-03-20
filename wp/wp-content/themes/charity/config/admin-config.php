<?php


/********************************************************************************************************/
/*                                                                                                      */
/*   Configuration array for Google fonts                                                               */
/*                                                                                                      */
/********************************************************************************************************/
$tabs = array(

    /********************************************************************************************************/
    /*                                                                                                      */
    /*   GENERAL OPTIONS                                                                                    */
    /*                                                                                                      */
    /********************************************************************************************************/
    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'general',
        'name' => 'General Options',
        'fields' => array(
            // Favicon options
            array(
                'id' => 'favicon',
                'name' => 'favicon',
                'type' => 'file',
                'value' => get_template_directory_uri() . "/theme-images/favicon.ico",
                'label' => 'Favicon',
                'desc' => 'File format: ICO, dimenstions: 16x16',
            ),
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                ),
                'value' => '',
            ),
            // Header logo options
            array(
                'id' => 'header_logo',
                'name' => 'header_logo',
                'type' => 'file',
                'value' => get_template_directory_uri() . "/theme-images/logo.png",
                'label' => 'Header Logo',
                'desc' => 'JPEG, GIF or PNG image, 176×27 recommended up to 500KB',
            ),           
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                ),
                'value' => '',
            ),
            // Navigation search box
            array(
                'id' => 'navigation_search',
                'name' => 'navigation_search',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'Disable Navigation Search Box'
                ),
                'label' => 'Disable Navigation Search Box',
                'desc' => '',
                'value' => '',
            ),

            array(
                'id' => 'slider_type',
                'name' => 'slider_type',
                'type' => 'select',
                'value' => array(
                    array('None', 'none'), // ARRAY ('TITLE', 'VALUE')
                    array('Slit Slider', 'slit'), // ARRAY ('TITLE', 'VALUE')
                    array('Revolution Slider', 'revolution'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Chose Slider Type',
                'desc' => '<strong>Important: Revolution slider is available only if plugin is installed.</strong>',
            ),
            array(
                'id' => 'slider_id',
                'name' => 'slider_id',
                'type' => 'text',
                'value' => '',
                'label' => 'Slider ID or ALIAS',
                'desc' => '<strong>Important: Only available for Revolution Slider.</strong></br> When you configure your Revolution Slider from Revolution Panel, insert here ID or ALIAS you received there.',
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
                ),
                'value' => '',
            ),
            // Google analitics code
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
                ),
                'value' => '',
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
                ),
                'value' => '',
            ),
            // Footer newsletter
            array(
                'id' => 'footer_newsletter',
                'name' => 'footer_newsletter',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'Disable Footer Newsletter'
                ),
                'label' => 'Disable Footer Newsletter',
                'desc' => 'Check this box if you want to disable newsletter area above footer widgets',
                'value' => '',
            ),
            array(
                'id' => 'footer_newsletter_title',
                'name' => 'footer_newsletter_title',
                'type' => 'text',
                'value' => '',
                'label' => 'Footer Newsletter Title',
                'desc' => '',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'footer_newsletter_text',
                'name' => 'footer_newsletter_text',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Footer Newsletter Text',
                'desc' => '',
                'options' => array(
                    'rows' => '5',
                    'cols' => '100'
                )
            ),
            array(
                'id' => 'footer_newsletter_service',
                'name' => 'footer_newsletter_service',
                'type' => 'select',
                'value' => array(
                    array('MadMimi', 'madmimi'), // ARRAY ('TITLE', 'VALUE')
                    array('MailChimp', 'mailchimp'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Footer Newsletter Service',
                'desc' => 'Select service for your footer newsletter area',
            ),
            array(
                'id' => 'footer_newsletter_madmimi_user',
                'name' => 'footer_newsletter_madmimi_user',
                'type' => 'text',
                'value' => '',
                'label' => 'MadMimi Unique Number',
                'desc' => 'Insert your MadMimi unique number.Click <a href="https://madmimi.com/signups" target="_blank"> here </a> or you can find this number when you log in into your MadMimi account, under WEBFORM click on SHARE and you will get link like this http://mad.ly/signups/<strong>XXXXX</strong>/join. Insert this number in the box above.',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'footer_newsletter_mailchimp_key',
                'name' => 'footer_newsletter_mailchimp_key',
                'type' => 'text',
                'value' => '',
                'label' => 'MailChimp API Key',
                'desc' => 'Grab and insert an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">here</a>',
                'options' => array(
                    'size' => '100'
                )
            ),
            array(
                'id' => 'footer_newsletter_mailchimp_list',
                'name' => 'footer_newsletter_mailchimp_list',
                'type' => 'text',
                'value' => '',
                'label' => 'MailChimp API List',
                'desc' => 'Grab your Lists Unique Id by going to <a href="http://admin.mailchimp.com/lists/" target="_blank">here</a> Click the "settings" link for the list - the Unique Id is at the bottom of that page.',
                'options' => array(
                    'size' => '10'
                )
            ),
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                ),
                'value' => '',
            ),
            // Footer copyright
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

    /********************************************************************************************************/
    /*                                                                                                      */
    /*   GALLERY PAGE OPTIONS                                                                               */
    /*                                                                                                      */
    /********************************************************************************************************/
    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'gallery',
        'name' => 'Gallery Page',
        'fields' => array(
            array(
                'id' => 'gallery_orderby',
                'name' => 'gallery_orderby',
                'type' => 'select',
                'value' => array(
                    array('Sort by Number of Items in Category', 'count'), // ARRAY ('TITLE', 'VALUE')
                    array('Sort by SLUG (Alphabetically)', 'slug'), // ARRAY ('TITLE', 'VALUE')
                    array('Sort by Category ID', 'term_id'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Reorder Categories in Gallery Filter',
                'desc' => 'Select how to sort categories in gallery Filter.',
            ),
            array(
                'id' => 'gallery_order',
                'name' => 'gallery_order',
                'type' => 'select',
                'value' => array(
                    array('Sort Ascending', 'ASC'), // ARRAY ('TITLE', 'VALUE')
                    array('Sort Descending', 'DESC'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Sort Categories in Gallery Filter Ascending or Descending',
                'desc' => 'Select how to sort categories in gallery Filter.',
            ),
        ),
    ),

    /********************************************************************************************************/
    /*                                                                                                      */
    /*   SOCIAL OPTIONS                                                                                     */
    /*                                                                                                      */
    /********************************************************************************************************/
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
                ),
                'value' => '',
            ),
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
                'id' => 'flickr',
                'name' => 'flickr',
                'type' => 'text',
                'value' => '',
                'label' => 'Flickr account',
                'desc' => 'Enter Flickr account ID or leave empty if you dont wish to use Flickr',
                'options' => array(
                    'size' => '80'
                )
            ),
            array(
                'id' => 'instagram',
                'name' => 'instagram',
                'type' => 'text',
                'value' => '',
                'label' => 'Instagram account',
                'desc' => 'Enter Instagram account (e.g. themeskingdom) or leave empty if you dont wish to use Instagram',
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
                ),
                'value' => '',
            ),
            array(
                'id' => 'social_label',
                'name' => 'social_label',
                'type' => 'label',
                'label' => 'Single Page Social Icons',
                'value' => '',
            ),
            array(
                'id' => 'social_share_blog',
                'name' => 'social_share_blog',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked social share buttons will be disabled in a single blog post.'
                ),
                'label' => 'Disable Blog Post Share buttons',
                'desc' => '',
                'value' => '',
            ),
            array(
                'id' => 'social_share_events',
                'name' => 'social_share_events',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked social share buttons will be disabled in a single events post.'
                ),
                'label' => 'Disable Events Post Share buttons',
                'desc' => '',
                'value' => '',
            ),
            
            array(
                'id' => 'social_share_causes',
                'name' => 'social_share_causes',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked social share buttons will be disabled in a single causes post.'
                ),
                'label' => 'Disable Causes Post Share buttons',
                'desc' => '',
                'value' => '',
            ),
            
            array(
                'id' => 'use_facebook',
                'name' => 'use_facebook',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked Facebook share button and counter will be disabled in a single post.'
                ),
                'label' => 'Disable Facebook Share',
                'desc' => '',
                'value' => '',
            ),
            array(
                'id' => 'use_twitter',
                'name' => 'use_twitter',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked Twitter share button and counter will be disabled in a single post.'
                ),
                'label' => 'Disable Twitter Share',
                'desc' => '',
                'value' => '',
            ),
            array(
                'id' => 'use_google',
                'name' => 'use_google',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked Google+ share button and counter will be disabled in a single post.'
                ),
                'label' => 'Disable Google+ Share',
                'desc' => '',
                'value' => '',
            ),
            array(
                'id' => 'use_linkedin',
                'name' => 'use_linkedin',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked LinkedIn share button and counter will be disabled in a single post.'
                ),
                'label' => 'Disable LinkedIn Share',
                'desc' => '',
                'value' => '',
            ),
            array(
                'id' => 'use_pinterest',
                'name' => 'use_pinterest',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked Pinterest share button and counter will be disabled in a single post.'
                ),
                'label' => 'Disable Pinterest Share',
                'desc' => '',
                'value' => '',
            ),
            array(
                'id' => 'use_stumbleupon',
                'name' => 'use_stumbleupon',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked Stumbleupon share button and counter will be disabled in a single post.'
                ),
                'label' => 'Disable Stumbleupon Share',
                'desc' => '',
                'value' => '',
            ),
        ),
    ),

    /********************************************************************************************************/
    /*                                                                                                      */
    /*   WIDGET AREAS                                                                                       */
    /*                                                                                                      */
    /********************************************************************************************************/
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

    /********************************************************************************************************/
    /*                                                                                                      */
    /*   CONTACT OPTIONS                                                                                    */
    /*                                                                                                      */
    /********************************************************************************************************/
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
                'value' => 'E-mail from ' . wp_get_theme()->name . ' Theme',
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
                'options' => array(
                    'yes' => 'Disable Captcha'
                ),
                'label' => 'Disable Captcha on Contact Page',
                'desc' => 'Check this box if you want to disable captcha on your Contact page.',
                'value' => '',
            ),
            array(
                'id' => 'box_1_hr',
                'name' => 'box_1_hr',
                'type' => 'hr',
                'options' => array(
                    'width' => '100%',
                    'color' => '#DFDFDF'
                ),
                'value' => '',
            ),
            array(
                'id' => 'show_map',
                'name' => 'show_map',
                'type' => 'checkbox',
                'options' => array(
                    'yes' => 'If checked map will be removed'
                ),
                'label' => 'Remove  Map',
                'desc' => '',
                'value' => '',
            ),
            // use large map in header
            array(
                'id' => 'header_map',
                'name' => 'header_map',
                'type' => 'select',
                'value' => array(
                    array('Use contact map in content of page', 'content'), // ARRAY ('TITLE', 'VALUE')
                    array('Use contact map in header of page', 'header'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Contact Us Map Position',
                'desc' => 'Select where to show map on contact page. If use in header option is selected main slider wont be shown on contact page. <br/>Google map will be shown instead.',
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


    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'custom_style',
        'name' => 'Custom CSS',
        'fields' => array(
            array(
                'id' => 'custom_css',
                'name' => 'custom_css',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Custom CSS',
                'desc' => 'Modify the visual style of your website by adding custom style.',
                'options' => array(
                    'rows' => '20',
                    'cols' => '100'
                )
            ),

        ),
    ),
);
?>