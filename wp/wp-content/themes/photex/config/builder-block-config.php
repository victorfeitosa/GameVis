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


$prefix = 'tk_builder_';
$tk_builder_blocks = array(
    /************************************************************/
    /*                                                          */
    /*   Metaboxes for advertising options                      */
    /*                                                          */
    /************************************************************/
    array(
        'id' => 'block1',
        'title' => __('Builder Block 1', 'tkingdom'),
        'fields' => array(
            array(
                'name' => __('Advertisement Link', 'tkingdom'),
                'desc' => '',
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
        'id' => 'block2',
        'title' => __('Builder Block 2', 'tkingdom'),
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

);
?>