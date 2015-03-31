<?php
/************************************************************************************************************************/
/*                                                                                                                      */
/*   Configuration array for post and page metaboxes
        Creating MetaBox:
            array(
                'id' => 'id_of_metabox',
                'name' => __('Name of Field', 'tkingdom'),
                'pages' => array('post', 'page', 'some_custom_post_type'),      // supports multiple post types
                'context' => 'side',                                            // The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side')
                'priority' => 'high',                                           // The priority within the context where the boxes should show ('high', 'core', 'default' or 'low')
                'fields' => array(
                                                                                // all available fields are explained below
                )
            ),
        Available fields:
        Text field - name, description, id and name, type of field, default value:
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'text',
                'std' => 'default value for field'
            ),
        Textarea field - name, description, id and name, type of field, default value, number of rows and columns
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'textarea',
                'std' => 'default value for field'
                'options' => array(
                    'rows' => '3',
                    'cols' => '18'
                )
            ),
        WP Editor field -

        Select field - name, description, id and name, type of field, options array with text and value
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'select',
                'options' => array(
                    'Text to show in option' => 'value_one',
                    'Some other option text' => 'value_two'
                )
            ),
        Select Category field - name, description, id and name, type of field, taxonomy if empty category is used
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'category',
                'taxonomy' => 'custom_taxonomy'
            ),
        Radio field - name, description, id and name, type of field, name and text of buttons
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'radio',
                'options' => array(
                    'Text to show in option' => 'value_one',
                    'Some other option text' => 'value_two'
                )
            ),
        Checkbox field - name, description, id and name, type of field, name and text of buttons
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'checkbox',
            ),
        Select Sidebar field - name, description, id and name, type of field
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'select-sidebar',
            ),
        Upload Image field - name, description, id and name, type of field
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'imageupload',
                'std' => 'default value for field'
            ),
        Select Sidebar Position field - name, description, id and name, type of field
            array(
                'name' => __('Name of Field', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'id_of_field',
                'type' => 'sidebar',
                'templates' => array('templates/template-full-width.php', 'templates/template_blog.php' ),

            ),


/*                                                                                                                      */
/************************************************************************************************************************/


$prefix = 'tk_';
$meta_boxes = array(
    /************************************************************/
    /*                                                          */
    /*   Metaboxes for advertising options                      */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'advertisement_meta_box_link',
        'title' => __('Advertisement Link', 'tkingdom'),
        'pages' => array('advertisement'),
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Advertisement Link', 'tkingdom'),
                'desc' => 'e.g. http://www.site.com',
                'id' => $prefix . 'advertisement_link',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Custom Banner Code', 'tkingdom'),
                'desc' => 'If code is set it will be shown instead of advert selected above',
                'id' => $prefix . 'custom_banner_code',
                'type' => 'textarea',
                'std' => '',
                'options' => array(
                    'rows' => '3',
                    'cols' => '18'
                )
            )
        )
    ),
    array(
        'id' => 'advertisement_meta_box',
        'title' => __('Advertisement', 'tkingdom'),
        'pages' => array('advertisement'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Banner Stats', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'banner_stats',
                'type' => 'annotated_timeline',
                'std' => ''
            )
        )
    ),
    /***************** end add metabox ***********************/


    /************************************************************/
    /*                                                          */
    /*   Metabox for enable/disable author box                  */
    /*                                                          */
    /************************************************************/

    /*array(
        'id' => 'author_box_meta',
        'title' => __('Author Box', 'tkingdom'),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Disable Author Box', 'tkingdom'),
                'desc' => __('Check this box if you want to disable page author box in single post', 'tkingdom'),
                'id' => $prefix . 'disable_author',
                'type' => 'checkbox',
            ),
        )
    ),*/


    /***************** end add metabox ***********************/


    /************************************************************/
    /*                                                          */
    /*   Metabox "Additional info" for gallery post type        */
    /*                                                          */
    /************************************************************/

    array(
        'id' => 'gallery_additional_info_meta',
        'title' => __('Additional info', 'tkingdom'),
        'pages' => array('gallery'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Add aditional info about this gallery item', 'tkingdom'),
                'desc' => '',
                'id' => $prefix.'additional_info',
                'type' => 'additional_info'
            )
        )
    ),


    /***************** end add metabox ***********************/


    /************************************************************/
    /*                                                          */
    /*   Metabox Layout for gallery single view                 */
    /*                                                          */
    /************************************************************/

    array(
        'id' => 'gallery_layout_box_meta',
        'title' => __('Layout', 'tkingdom'),
        'pages' => array('gallery'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Layout', 'tkingdom'),
                'desc' => __('Choose layout view', 'tkingdom'),
                'id'   => $prefix.'view_layout',
                'type' => 'radio',
                'std'  => 'full_layout',
                'options' => array(
                    array( 'name' => 'Full width layout', 'value' => 'full_layout' ),
                    array( 'name' => 'Column layout', 'value' => 'column_layout' ),
                )
            )
        )
    ),


    /***************** end add metabox ***********************/


    /************************************************************/
    /*                                                          */
    /*   Metabox Category checkbox for gallery page template    */
    /*                                                          */
    /************************************************************/

    array(
        'id' => 'gallery_categories_box_meta',
        'title' => __('Gallery categories', 'tkingdom'),
        'pages' => array('page'), // multiple post types
        'context' => 'side',
        'priority' => 'low',
        'fields' => array(
            array(
                'name' => __('Gallery categories', 'tkingdom'),
                'desc' => __('Choose categories to show on this page (Default is All)', 'tkingdom'),
                'id'   => $prefix.'gallery_categories',
                'type' => 'category-gallery',
                'std'  => ''
            )
        )
    ),


    /***************** end add metabox ***********************/


    /************************************************************/
    /*                                                          */
    /*   Metabox to align conetnt left on single gallery view   */
    /*                                                          */
    /************************************************************/

    /*array(
        'id' => 'content_position_box_meta',
        'title' => __('Content Align Left', 'tkingdom'),
        'pages' => array('gallery'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Content Align Left', 'tkingdom'),
                'desc' => __('Check this box if you want to align content to the left', 'tkingdom'),
                'id'   => $prefix.'position_left',
                'type' => 'checkbox'
            )
        )
    ),*/


    /***************** end add metabox ***********************/



    /************************************************************/
    /*                                                          */
    /*   Metabox for sidebar position also one can chose        */
    /*   different sidebar for every post/page                  */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'sidebar_position_meta',
        'title' => __('Sidebar Position', 'tkingdom'),
        'pages' => array('post', 'page'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Sidebar Position', 'tkingdom'),
                'desc' => __('Short description', 'tkingdom'),
                'id' => $prefix . 'sidebar_position',
                'type' => 'sidebar',
                'templates' => array(
                    'templates/template-full-width.php' => array('post_meta8'),
                    'templates/template_blog.php' => 'post_meta13'
                ),

            ),
            array(
                'name' => __('Select sidebar', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'sidebar',
                'type' => 'select-sidebar',
                'std' => '',
                'options' => ''
            ),
        )
    ),
    /***************** end add sidebar options ***********************/

        
    /************************************************************/
    /*                                                          */
    /*   Metaboxes for advertising options                      */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'client_meta_box_link',
        'title' => __('Client Link', 'tkingdom'),
        'pages' => array('client'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Client Link', 'tkingdom'),
                'desc' => 'e.g. http://www.site.com',
                'id' => $prefix . 'client_link',
                'type' => 'text',
                'std' => ''
            ),
        )
    ),
    
    /************************************************************/
    /*                                                          */
    /*   Configuration for post formats:                        */
    /*   video, audio, link and quote                           */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'post_format_gallery',
        'title' => __('Slider Fields', 'tkingdom'),
        'pages' => array('post', 'gallery', 'services', 'events'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'label' => 'Repeatable',
                'name' => 'Slider Fields',
                'desc'  => '',
                'id'    => $prefix.'repeatable',
                'type'  => 'repeatable'
            )
        )
    ),
    array(
        'id' => 'post_format_link',
        'title' => __('Link', 'tkingdom'),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Link Text', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'link_text',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Link Url', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'link_url',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    array(
        'id' => 'post_format_quote',
        'title' => __('Quote Text', 'tkingdom'),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Quote Text', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'quote',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Quote Author', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'quote_author',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    array(
        'id' => 'post_format_video',
        'title' => __('Video Link', 'tkingdom'),
        'pages' => array('post', 'gallery', 'services', 'events'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Video Link', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'video_link',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    array(
        'id' => 'post_format_audio',
        'title' => __('Audio Options', 'tkingdom'),
        'pages' => array('post'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Audio Link', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'audio_link',
                'type' => 'text',
                'std' => ''
            ),
        )
    ),
    /***************** end post formats ***********************/

    /************************************************************/
    /*                                                          */
    /*   Rest of metaboxes, for post types etc.                 */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'team_member_meta',
        'title' => __('Team Member Info', 'tkingdom'),
        'pages' => array('team-members'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Member Position', 'tkingdom'),
                'desc' => 'Enter team member position',
                'id' => $prefix . 'member_position',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Facebook Account', 'tkingdom'),
                'desc' => 'Enter team member facebook name (i.e. themeskingdom)',
                'id' => $prefix . 'member_facebook',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Twitter Account', 'tkingdom'),
                'desc' => 'Enter team member twitter name (i.e. themeskingdom)',
                'id' => $prefix . 'member_twitter',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Google Account', 'tkingdom'),
                'desc' => 'Enter team member google number (i.e. 123654987654)',
                'id' => $prefix . 'member_google',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('LinkedIn Account', 'tkingdom'),
                'desc' => 'Enter team member LinkedIn link (i.e. http://www.linkedin.com/public/profile)',
                'id' => $prefix . 'member_linkedin',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Pinterest Account', 'tkingdom'),
                'desc' => 'Enter team member pinterest account (i.e. themeskingdom)',
                'id' => $prefix . 'member_pinterest',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Dribbble Account', 'tkingdom'),
                'desc' => 'Enter team member Dribbble account (i.e. themeskingdom)',
                'id' => $prefix . 'member_dribbble',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('E-Mail', 'tkingdom'),
                'desc' => 'Enter team member e-mail (i.e. example@themeskingdom.com)',
                'id' => $prefix . 'member_mail',
                'type' => 'text',
                'std' => ''
            ),
        )
    ),

    array(
        'id' => 'services_meta',
        'title' => __('Services  Info', 'tkingdom'),
        'pages' => array('services'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Donation URL', 'tkingdom'),
                'desc' => 'Insert donation link',
                'id' => $prefix . 'services_donation',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Collected amount', 'tkingdom'),
                'desc' => 'Insert collected amount',
                'id' => $prefix . 'services_collected',
                'type' => 'text',
                'std' => ''
            ),
        )
    ),

    array(
        'id' => 'slider_meta',
        'title' => __('Slider Options', 'tkingdom'),
        'pages' => array('slider'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            
            array(
                'name' => __('Content', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_content',
                'type' => 'textarea',
                'std' => '',
                'options' => array(
                    'rows' => '5',
                    'cols' => '141'
                )
                
                
            ),
            
            array(
                'name' => __('Author', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'author_text',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Button Text', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'button_text',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Slider Link', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_link',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Background Color', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'background_color',
                'type' => 'colorpicker',
                'value' => '#fff',
                'std' => ''
            ),
            
            array(
                'name' => __('Slider Heading Color', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_heading_color',
                'type' => 'colorpicker',
                'value' =>'#fff',
                'std' => ''
            ),
            
            array(
                'name' => __('Slider Heading Hover Color', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_heading_hover_color',
                'type' => 'colorpicker',
                'value' =>'#fff',
                'std' => ''
            ),
            
            array(
                'name' => __('Slider Paragraph Color', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_paragraph_color',
                'type' => 'colorpicker',
                'value' =>'#fff',
                'std' => ''
            ),
            
            array(
                'name' => __('Slider Author Color', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_author_color',
                'type' => 'colorpicker',
                'value' =>'#fff',
                'std' => ''
            ),
            
            array(
                'name' => __('Slider Button Color', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'slider_button_color',
                'type' => 'colorpicker',
                'value' =>'#fff',
                'std' => ''
            ),
            
            array(
                'name' => __('Pattern Upload', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'pattern_upload',
                'type' => 'imageupload',
                'std' => ''
            ),
            
            array(
                'name' => __('Content Position', 'tkingdom'),
                'desc' => '',
                'id' => $prefix . 'content_position',
                'type' => 'select',
                'options' => array(
                    'Center' => 'value_one',
                    'Left' => 'value_two',
                    'Right' => 'value_three'
                )
            )
        )
    ),
    
    /***************** end some additional metaboxes ***********************/

    
);
?>