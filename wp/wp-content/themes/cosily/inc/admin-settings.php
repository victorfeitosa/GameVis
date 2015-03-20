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
                'desc' => 'JPEG, GIF or PNG image, 154x67px recommended up to 500KB',
            ),
            
            array(
                'id' => 'logo_margin_top',
                'name' => 'logo_margin_top',
                'type' => 'text',
                'value' => '5',
                'label' => 'Top margin of the logo',
                'desc' => 'Set the top margin of the logo in pixels, default value is 5',
                'options' => array(
                    'size' => '5'
                )
            ),
            
            array(
                'id' => 'logo_margin_left',
                'name' => 'logo_margin_left',
                'type' => 'text',
                'value' => '0',
                'label' => 'Left margin of the logo',
                'desc' => 'Set the left margin of the logo in pixels, default value is 0',
                'options' => array(
                    'size' => '5'
                )
            ),
            array(
                'id' => 'logo_margin_bottom',
                'name' => 'logo_margin_bottom',
                'type' => 'text',
                'value' => '40',
                'label' => 'Bottom margin of the logo',
                'desc' => 'Set the bottom margin of the logo in pixels, default value is 40',
                'options' => array(
                    'size' => '5'
                )
            ),
            array(
                'id' => 'menu_margin_top',
                'name' => 'menu_margin_top',
                'type' => 'text',
                'value' => '0',
                'label' => 'Top margin of the menu',
                'desc' => 'Set the top margin of the menu in pixels, default value is 0',
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
                'id' => 'header_telephone',
                'name' => 'header_telephone',
                'type' => 'text',
                'value' => '',
                'label' => 'Header Telephone Number',
                'desc' => 'Text which appears in header section, it will appear with telephone icon.',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'header_email',
                'name' => 'header_email',
                'type' => 'text',
                'value' => '',
                'label' => 'Header E-Mail',
                'desc' => 'Text which appears in header section, it will appear with envelope icon.',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'header_address',
                'name' => 'header_address',
                'type' => 'text',
                'value' => '',
                'label' => 'Header Address',
                'desc' => 'Text which appears in header section, it will appear with marker icon.',
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
                'value' => 'Copyright Information Goes Here &copy; 2013. All Rights Reserved.',
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
        'id' => 'home_slider',
        'name' => 'Home Slider',
        
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
        ),
    ),
    
  /*     * ********************************************************** */
    /*     * **********HOME PAGE OPTIONS*************************** */
    /*     * ********************************************************** */

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'home_builder',
        'name' => 'Home Builder',
        'fields' => array(
            array(
                'label' => 'Home Page Builder',
                'name' => 'page_builder',
                'type' => 'page_builder',
                'description' => __('Page builder allows you to create unique homepage in just few clicks. </br>Simply add and drag-and-drop elements on desired position.', tk_theme_name()),
                'value' => '',
                'options' => array(
                    // One Column Block
                    'one_column' => array(
                        'id' => 'one_column',
                        'name' => 'one_column',
                        'value' => '',
                        'type' => 'columns',
                        'label' => 'One Column',
                        'desc' => 'Insert One Column section',
                        'cols' => '1',
                        'fields' => array(
                            array(
                                'id' => 'col_1',
                                'name' => 'col_1',
                                'type' => 'select',
                                'value' => array(
                                    array('Select', 'select', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Rooms', 'rooms', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_rooms_title',
                                                    'name' => 'sub_rooms_title',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_rooms_number',
                                                    'name' => 'sub_rooms_number',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of Rooms Posts',
                                                    'desc' => 'Insert number of rooms posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),

                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Latest News', 'news', array(
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_news_title',
                                                    'name' => 'sub_news_title',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_number',
                                                    'name' => 'sub_news_number',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of News Posts',
                                                    'desc' => 'Insert number of news posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_category',
                                                    'name' => 'sub_news_category',
                                                    'type' => 'category',
                                                    'label' => 'Select News Category',
                                                    'desc' => 'Select category for news section.',
                                                    'taxonomy' => 'category',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Testimonials', 'testimonials', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_testimonial_title',
                                                    'name' => 'sub_testimonial_title',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),                                                
                                                array(
                                                    'id' => 'sub_testimonial',
                                                    'name' => 'sub_testimonial',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'testimonials',
                                                    'label' => 'Pick Featured Testimonial',
                                                    'desc' => 'Select Featured Testimonial, in this case only this selected testimonial will be shown in this section.',
                                                ),
                                                array(
                                                    'id' => 'sub_check_testimonials',
                                                    'name' => 'sub_check_testimonials',
                                                    'type' => 'checkbox',
                                                    'value' => array(
                                                        'yes',
                                                    ),
                                                    'caption' => array(
                                                        'Use Random Posts',
                                                    ),
                                                    'label' => 'Or',
                                                    'desc' => 'Check this box if you want to show one random testimonial in this section.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Gallery', 'gallery', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_gallery_title',
                                                    'name' => 'sub_gallery_title',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),     
                                                array(
                                                    'id' => 'sub_gallery_number',
                                                    'name' => 'sub_gallery_number',
                                                    'type' => 'text',
                                                    'value' => '10',
                                                    'label' => 'Number of images',
                                                    'desc' => 'Insert number of images to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Ad Banner', 'adbanner', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_bulder_banner',
                                                    'name' => 'sub_bulder_banner',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'advertisement',
                                                    'label' => 'Pick Banner',
                                                    'desc' => 'Select your section Advertising Banner.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Page Content', 'content', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_page_content',
                                                    'name' => 'sub_page_content',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'page',
                                                    'label' => 'Pick Page',
                                                    'desc' => 'Select page to use content.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                ),
                                'label' => 'Select Option',
                                'desc' => 'Type of posts to be shown on left side of this section.',
                                'subfields' => array(
                                )
                            ),
                        )
                    ),
                    // Two Columns Block
                    'two_columns' => array(
                        'id' => 'two_columns',
                        'name' => 'two_columns',
                        'value' => '',
                        'type' => 'columns',
                        'label' => 'Two Columns',
                        'desc' => 'Insert Two Column section',
                        'cols' => '2',
                        'fields' => array(
                            array(
                                'id' => 'col_1',
                                'name' => 'col_1',
                                'type' => 'select',
                                'value' => array(
                                    array('Select', 'select', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Rooms', 'rooms', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_rooms_title_left',
                                                    'name' => 'sub_rooms_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_rooms_number_left',
                                                    'name' => 'sub_rooms_number_left',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of Rooms Posts',
                                                    'desc' => 'Insert number of rooms posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),

                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Latest News', 'news', array(
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_news_title_left',
                                                    'name' => 'sub_news_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_number_left',
                                                    'name' => 'sub_news_number_left',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of News Posts',
                                                    'desc' => 'Insert number of news posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_category_left',
                                                    'name' => 'sub_news_category_left',
                                                    'type' => 'category',
                                                    'label' => 'Select News Category',
                                                    'desc' => 'Select category for news section.',
                                                    'taxonomy' => 'category',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Testimonials', 'testimonials', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_testimonial_title_left',
                                                    'name' => 'sub_testimonial_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),     
                                                array(
                                                    'id' => 'sub_testimonial_left',
                                                    'name' => 'sub_testimonial_left',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'testimonials',
                                                    'label' => 'Pick Featured Testimonial',
                                                    'desc' => 'Select Featured Testimonial, in this case only this selected testimonial will be shown in this section.',
                                                ),
                                                array(
                                                    'id' => 'sub_check_testimonials_left',
                                                    'name' => 'sub_check_testimonials_left',
                                                    'type' => 'checkbox',
                                                    'value' => array(
                                                        'yes',
                                                    ),
                                                    'caption' => array(
                                                        'Use Random Posts',
                                                    ),
                                                    'label' => 'Or',
                                                    'desc' => 'Check this box if you want to show one random testimonial in this section.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Gallery', 'gallery', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_gallery_title_left',
                                                    'name' => 'sub_gallery_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),   
                                                array(
                                                    'id' => 'sub_gallery_number_left',
                                                    'name' => 'sub_gallery_number_left',
                                                    'type' => 'text',
                                                    'value' => '10',
                                                    'label' => 'Number of gallery items',
                                                    'desc' => 'Insert number of gallery items to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Ad Banner', 'adbanner', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_bulder_banner_left',
                                                    'name' => 'sub_bulder_banner_left',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'advertisement',
                                                    'label' => 'Pick Banner',
                                                    'desc' => 'Select your section Advertising Banner.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Page Content', 'content', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_page_content_left',
                                                    'name' => 'sub_page_content_left',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'page',
                                                    'label' => 'Pick Page',
                                                    'desc' => 'Select page to use content.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                ),
                                'label' => 'Left Column',
                                'desc' => 'Type of posts to be shown on left side of this section.',
                                'subfields' => array(
                                )
                            ),
                            array(
                                'id' => 'col_2',
                                'name' => 'col_2',
                                'type' => 'select',
                                'value' => array(
                                    array('Select', 'select', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')

                                    array('Rooms', 'rooms', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_rooms_title_right',
                                                    'name' => 'sub_rooms_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_rooms_number_right',
                                                    'name' => 'sub_rooms_number_right',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of Rooms Posts',
                                                    'desc' => 'Insert number of rooms posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),

                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Latest News', 'news', array(
                                            'subfields' => array(
                                                
                                                array(
                                                    'id' => 'sub_news_title_right',
                                                    'name' => 'sub_news_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_news_number_right',
                                                    'name' => 'sub_news_number_right',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of News Posts',
                                                    'desc' => 'Insert number of news posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_category_right',
                                                    'name' => 'sub_news_category_right',
                                                    'type' => 'category',
                                                    'label' => 'Select News Category',
                                                    'desc' => 'Select category for news section.',
                                                    'taxonomy' => 'category',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Testimonials', 'testimonials', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_testimonial_title_right',
                                                    'name' => 'sub_testimonial_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),   
                                                array(
                                                    'id' => 'sub_testimonial_right',
                                                    'name' => 'sub_testimonial_right',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'testimonials',
                                                    'label' => 'Pick Featured Testimonial',
                                                    'desc' => 'Select Featured Testimonial, in this case only this selected testimonial will be shown in this section.',
                                                ),
                                                array(
                                                    'id' => 'sub_check_testimonials_right',
                                                    'name' => 'sub_check_testimonials_right',
                                                    'type' => 'checkbox',
                                                    'value' => array(
                                                        'yes',
                                                    ),
                                                    'caption' => array(
                                                        'Use Random Posts',
                                                    ),
                                                    'label' => 'Or',
                                                    'desc' => 'Check this box if you want to show one random testimonial in this section.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Gallery', 'gallery', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_gallery_title_right',
                                                    'name' => 'sub_gallery_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),   
                                                array(
                                                    'id' => 'sub_gallery_number_right',
                                                    'name' => 'sub_gallery_number_right',
                                                    'type' => 'text',
                                                    'value' => '10',
                                                    'label' => 'Number of gallery items',
                                                    'desc' => 'Insert number of gallery items to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Ad Banner', 'adbanner', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_bulder_banner_right',
                                                    'name' => 'sub_bulder_banner_right',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'advertisement',
                                                    'label' => 'Pick Banner',
                                                    'desc' => 'Select your section Advertising Banner.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Page Content', 'content', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_page_content_right',
                                                    'name' => 'sub_page_content_right',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'page',
                                                    'label' => 'Pick Page',
                                                    'desc' => 'Select page to use content.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                ),
                                'label' => 'Right Column',
                                'desc' => 'Type of posts to be shown on right side of this section.',
                            ),
                        )
                    ),
                    // Three Columns Block
                    'three_columns' => array(
                        'id' => 'three_columns',
                        'name' => 'three_columns',
                        'value' => '',
                        'type' => 'columns',
                        'label' => 'Three Columns',
                        'desc' => 'Insert Three Column section',
                        'cols' => '3',
                        'fields' => array(
                            array(
                                'id' => 'col_1',
                                'name' => 'col_1',
                                'type' => 'select',
                                'value' => array(
                                    array('Select', 'select', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Rooms', 'rooms', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_rooms_title_left',
                                                    'name' => 'sub_rooms_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_rooms_number_left',
                                                    'name' => 'sub_rooms_number_left',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of Rooms Posts',
                                                    'desc' => 'Insert number of rooms posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),

                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    
                                    array('Latest News', 'news', array(
                                            'subfields' => array(
                                                
                                                array(
                                                    'id' => 'sub_news_title_left',
                                                    'name' => 'sub_news_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),                                                                                                
                                                array(
                                                    'id' => 'sub_news_number_left',
                                                    'name' => 'sub_news_number_left',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of News Posts',
                                                    'desc' => 'Insert number of news posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_category_left',
                                                    'name' => 'sub_news_category_left',
                                                    'type' => 'category',
                                                    'label' => 'Select News Category',
                                                    'desc' => 'Select category for news section.',
                                                    'taxonomy' => 'category',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Testimonials', 'testimonials', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_testimonial_title_left',
                                                    'name' => 'sub_testimonial_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),   
                                                array(
                                                    'id' => 'sub_testimonial_left',
                                                    'name' => 'sub_testimonial_left',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'testimonials',
                                                    'label' => 'Pick Featured Testimonial',
                                                    'desc' => 'Select Featured Testimonial, in this case only this selected testimonial will be shown in this section.',
                                                ),
                                                array(
                                                    'id' => 'sub_check_testimonials_left',
                                                    'name' => 'sub_check_testimonials_left',
                                                    'type' => 'checkbox',
                                                    'value' => array(
                                                        'yes',
                                                    ),
                                                    'caption' => array(
                                                        'Use Random Posts',
                                                    ),
                                                    'label' => 'Or',
                                                    'desc' => 'Check this box if you want to show one random testimonial in this section.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Gallery', 'gallery', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_gallery_title_left',
                                                    'name' => 'sub_gallery_title_left',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),   
                                                array(
                                                    'id' => 'sub_gallery_number_left',
                                                    'name' => 'sub_gallery_number_left',
                                                    'type' => 'text',
                                                    'value' => '10',
                                                    'label' => 'Number of gallery items',
                                                    'desc' => 'Insert number of gallery items to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Ad Banner', 'adbanner', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_bulder_banner_left',
                                                    'name' => 'sub_bulder_banner_left',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'advertisement',
                                                    'label' => 'Pick Banner',
                                                    'desc' => 'Select your section Advertising Banner.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Page Content', 'content', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_page_content_left',
                                                    'name' => 'sub_page_content_left',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'page',
                                                    'label' => 'Pick Page',
                                                    'desc' => 'Select page to use content.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                ),
                                'label' => 'Left Column',
                                'desc' => 'Type of posts to be shown on left side of this section.',
                                'subfields' => array(
                                )
                            ),
                            array(
                                'id' => 'col_2',
                                'name' => 'col_2',
                                'type' => 'select',
                                'value' => array(
                                    array('Select', 'select', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Rooms', 'rooms', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_rooms_title_center',
                                                    'name' => 'sub_rooms_title_center',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_rooms_number_center',
                                                    'name' => 'sub_rooms_number_center',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of Rooms Posts',
                                                    'desc' => 'Insert number of rooms posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),

                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')

                                    array('Latest News', 'news', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_news_title_center',
                                                    'name' => 'sub_news_title_center',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_number_center',
                                                    'name' => 'sub_news_number_center',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of News Posts',
                                                    'desc' => 'Insert number of news posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_category_center',
                                                    'name' => 'sub_news_category_center',
                                                    'type' => 'category',
                                                    'label' => 'Select News Category',
                                                    'desc' => 'Select category for news section.',
                                                    'taxonomy' => 'category',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Testimonials', 'testimonials', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_testimonial_title_center',
                                                    'name' => 'sub_testimonial_title_center',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),  
                                                array(
                                                    'id' => 'sub_testimonial_center',
                                                    'name' => 'sub_testimonial_center',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'testimonials',
                                                    'label' => 'Pick Featured Testimonial',
                                                    'desc' => 'Select Featured Testimonial, in this case only this selected testimonial will be shown in this section.',
                                                ),
                                                array(
                                                    'id' => 'sub_check_testimonials_center',
                                                    'name' => 'sub_check_testimonials_center',
                                                    'type' => 'checkbox',
                                                    'value' => array(
                                                        'yes',
                                                    ),
                                                    'caption' => array(
                                                        'Use Random Posts',
                                                    ),
                                                    'label' => 'Or',
                                                    'desc' => 'Check this box if you want to show one random testimonial in this section.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Gallery', 'gallery', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_gallery_title_center',
                                                    'name' => 'sub_gallery_title_center',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),  
                                                array(
                                                    'id' => 'sub_gallery_number_center',
                                                    'name' => 'sub_gallery_number_center',
                                                    'type' => 'text',
                                                    'value' => '10',
                                                    'label' => 'Number of images',
                                                    'desc' => 'Insert number of gallery items to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Ad Banner', 'adbanner', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_bulder_banner_center',
                                                    'name' => 'sub_bulder_banner_center',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'advertisement',
                                                    'label' => 'Pick Banner',
                                                    'desc' => 'Select your section Advertising Banner.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Page Content', 'content', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_page_content_center',
                                                    'name' => 'sub_page_content_center',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'page',
                                                    'label' => 'Pick Page',
                                                    'desc' => 'Select page to use content.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                ),
                                'label' => 'Center Column',
                                'desc' => 'Type of posts to be shown on right side of this section.',
                            ),
                            array(
                                'id' => 'col_3',
                                'name' => 'col_3',
                                'type' => 'select',
                                'value' => array(
                                    array('Select', 'select', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Rooms', 'rooms', array(// ARRAY ('TITLE', 'VALUE', ARRAY(SUBFIELDS FOR BUILDER))
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_rooms_title_right',
                                                    'name' => 'sub_rooms_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                
                                                array(
                                                    'id' => 'sub_rooms_number_right',
                                                    'name' => 'sub_rooms_number_right',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of Rooms Posts',
                                                    'desc' => 'Insert number of rooms posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),

                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    
                                    array('Latest News', 'news', array(
                                            'subfields' => array(                                                
                                                array(
                                                    'id' => 'sub_news_title_right',
                                                    'name' => 'sub_news_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_number_right',
                                                    'name' => 'sub_news_number_right',
                                                    'type' => 'text',
                                                    'value' => '5',
                                                    'label' => 'Number of News Posts',
                                                    'desc' => 'Insert number of news posts to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                                array(
                                                    'id' => 'sub_news_category_right',
                                                    'name' => 'sub_news_category_right',
                                                    'type' => 'category',
                                                    'label' => 'Select News Category',
                                                    'desc' => 'Select category for news section.',
                                                    'taxonomy' => 'category',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Testimonials', 'testimonials', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_testimonial_title_right',
                                                    'name' => 'sub_testimonial_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),  
                                                array(
                                                    'id' => 'sub_testimonial_right',
                                                    'name' => 'sub_testimonial_right',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'testimonials',
                                                    'label' => 'Pick Featured Testimonial',
                                                    'desc' => 'Select Featured Testimonial, in this case only this selected testimonial will be shown in this section.',
                                                ),
                                                array(
                                                    'id' => 'sub_check_testimonials_right',
                                                    'name' => 'sub_check_testimonials_right',
                                                    'type' => 'checkbox',
                                                    'value' => array(
                                                        'yes',
                                                    ),
                                                    'caption' => array(
                                                        'Use Random Posts',
                                                    ),
                                                    'label' => 'Or',
                                                    'desc' => 'Check this box if you want to show one random testimonial in this section.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Gallery', 'gallery', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_gallery_title_right',
                                                    'name' => 'sub_gallery_title_right',
                                                    'type' => 'text',
                                                    'value' => '',
                                                    'label' => 'Column Title',
                                                    'desc' => 'Set title for this column',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),  
                                                array(
                                                    'id' => 'sub_gallery_number_right',
                                                    'name' => 'sub_gallery_number_right',
                                                    'type' => 'text',
                                                    'value' => '10',
                                                    'label' => 'Number of images',
                                                    'desc' => 'Insert number of gallery items to show in this section.',
                                                    'options' => array(
                                                        'size' => '10'
                                                    )
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Ad Banner', 'adbanner', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_bulder_banner_right',
                                                    'name' => 'sub_bulder_banner_right',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'advertisement',
                                                    'label' => 'Pick Banner',
                                                    'desc' => 'Select your section Advertising Banner.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                    array('Page Content', 'content', array(
                                            'subfields' => array(
                                                array(
                                                    'id' => 'sub_page_content_right',
                                                    'name' => 'sub_page_content_right',
                                                    'type' => 'posts',
                                                    'value' => '',
                                                    'post_type' => 'page',
                                                    'label' => 'Pick Page',
                                                    'desc' => 'Select page to use content.',
                                                ),
                                            )
                                    )), // ARRAY ('TITLE', 'VALUE')
                                ),
                                'label' => 'Right Column',
                                'desc' => 'Type of posts to be shown on right side of this section.',
                            ),
                        )
                    ),       
                ),
            ),
        ),
    ),


        /*************************************************************/
        /************GALLERY PAGE OPTIONS*************************/
        /************************************************************/

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
                    array( 'Sort Ascending', 'ASC'), // ARRAY ('TITLE', 'VALUE')
                    array( 'Sort Descending', 'DESC'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Sort Categories in Gallery Filter Ascending or Descending',
                'desc' => 'Select how to sort categories in gallery Filter.',
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
                'desc' => 'Enter Flickr account (e.g. themeskingdom) or leave empty if you dont wish to use Flickr',
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
        /************RESERVATION OPTIONS******************************/
        /*************************************************************/

    array(
        'pg' => array(
            'slug' => 'theme-settings',
            'menu_title' => 'Theme Settings',
            'page_title' => 'Theme Settings'
        ),
        'id' => 'reservations',
        'name' => 'Reservations Options',
        'fields' => array(

            array(
                'id' => 'hide_reservations',
                'name' => 'hide_reservations',
                'type' => 'checkbox',
                'value' => array(
                    'yes',
                ),
                'caption' => array(
                    'Check this box if you want to hide reservations',
                ),
                'label' => 'Hide Reservations',
                'desc' => '',
            ),
            
            array(
                'id' => 'room_taxes',
                'name' => 'room_taxes',
                'type' => 'text',
                'value' => '0',
                'label' => 'Room Taxes',
                'desc' => 'Set room taxes that will be applied to all rooms in percentages ( % )',
                'options' => array(
                    'size' => '100'
                )
            ),

            array(
                'id' => 'currency',
                'name' => 'currency',
                'type' => 'text',
                'value' => '',
                'label' => 'Set Currency Sign',
                'desc' => 'Set your currency sign that will be shown next to the price',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'currency_side',
                'name' => 'currency_side',
                'type' => 'select',
                'value' => array(
                    array('Left', 'left'), // ARRAY ('TITLE', 'VALUE')
                    array('Right', 'right'), // ARRAY ('TITLE', 'VALUE')
                ),
                'label' => 'Currency Sign Position',
                'desc' => 'Set your currency sign position, should it be left or right from the price',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'terms',
                'name' => 'terms',
                'type' => 'textarea',
                'value' => '',
                'label' => 'Room Terms and Conditions',
                'desc' => 'It will show up before last step of reservation.',
                'options' => array(
                    'rows' => '5',
                    'cols' => '80'
                )
            ),
            
            array(
                'id' => 'title_error',
                'name' => 'title_error',
                'type' => 'text',
                'value' => 'Please select your title',
                'label' => 'Title error for your reservations form',
                'desc' => 'Set the error message for empty "Title" field  ',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'email_error',
                'name' => 'email_error',
                'type' => 'text',
                'value' => 'Please enter your e-mail',
                'label' => 'E-mail error',
                'desc' => 'E-mail error for your reservations form that will be displayed when e-mail field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'first_name_error',
                'name' => 'first_name_error',
                'type' => 'text',
                'value' => 'Please enter your first name',
                'label' => 'First name error',
                'desc' => 'First name error for your reservations form that will be displayed when "First Name" field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'last_name_error',
                'name' => 'last_name_error',
                'type' => 'text',
                'value' => 'Please enter your last name',
                'label' => 'Last name error',
                'desc' => 'Last name error for your reservations form that will be displayed when "Last Name" field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'phone_error',
                'name' => 'phone_error',
                'type' => 'text',
                'value' => 'Please enter your phone number',
                'label' => 'Phone error',
                'desc' => 'Phone error for your reservations form that will be displayed when "Phone" field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'address_error',
                'name' => 'address_error',
                'type' => 'text',
                'value' => 'Please enter your address',
                'label' => 'Address error',
                'desc' => 'Address error for your reservations form that will be displayed when "Address" field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'country_error',
                'name' => 'country_error',
                'type' => 'text',
                'value' => 'Please enter your country',
                'label' => 'Country error',
                'desc' => 'Country error for your reservations form that will be displayed when "Country" field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'city_error',
                'name' => 'city_error',
                'type' => 'text',
                'value' => 'Please enter your city',
                'label' => 'City error',
                'desc' => 'City error for your reservations form that will be displayed when "City" field is empty',
                'options' => array(
                    'size' => '100'
                )
            ),
            
            array(
                'id' => 'postal_error',
                'name' => 'postal_error',
                'type' => 'text',
                'value' => 'Please enter your postal code',
                'label' => 'Postal code error',
                'desc' => 'Postal code error for your reservations form that will be displayed when "Postal code" field is empty',
                'options' => array(
                    'size' => '100'
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
    
        
        /*************************************************************/
        /************GENERAL OPTIONS*******************************/
        /*************************************************************/

    array(
        'pg' => array(
            'slug' => 'room-options',
            'menu_title' => 'Room Reservations',
            'page_title' => 'Room Reservations'
        ),
        'id' => 'room_reservations',
        'name' => 'Room Reservations',
        'fields' => array(

                array(
                    'id' => 'room_reservations_table',
                    'name' => 'room_reservations_table',
                    'type' => 'include',
                    'process' => 'self',
                    'value' => 'room-options.php'
                )
        
        ),
        
    ),
    
    array(
        'pg' => array(
            'slug' => 'room-options',
            'menu_title' => 'Room Reservations',
            'page_title' => 'Room Reservations'
        ),
        'id' => 'new_reservation',
        'name' => 'Add Reservations',
        'fields' => array(

                array(
                    'id' => 'reservation_table',
                    'name' => 'reservation_table',
                    'type' => 'include',
                    'process' => 'self',
                    'value' => 'new-reservation.php'
                )
        
        ),
        
    ),
    
);



?>