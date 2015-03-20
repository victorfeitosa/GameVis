<?php

$prefix = 'tk_';

$meta_boxes = array(

    // POST TYPE POST, SLIDE
    array(
        'id' => 'post_meta',
        'title' => __('Video', 'Themetick'),
        'pages' => array('pt_slides', 'post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Video Link', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'video_link',
                'type' => 'text',
                'std' => ''
            )

        )
    ),



    array(
        'id' => 'post_meta2',
        'title' => __('Slider', 'Themetick'),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(


        array(
            'label' => 'Slider',
            'desc'  => '',
            'id'    => $prefix.'repeatable',
            'type'  => 'repeatable'
        )
        )
    ),

    // POST TYPE SPONSOR
    array(
        'id' => 'post_meta',
        'title' => __('Post Details', 'Themetick'),
        'pages' => array('pt_partners'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Partners Link', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'sponsor_link',
                'type' => 'text',
                'std' => ''
            )

        )
    ),


        // POST TYPE PROGRAM
    array(
        'id' => 'program_meta',
        'title' => __('Post Details', 'Themetick'),
        'pages' => array('pt_program'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Time, example: 11-12:30', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'program_time',
                'type' => 'text',
                'std' => ''
            )

        )
    ),

    // POST TYPE SPEAKERS
    array(
        'id' => 'speaker_meta',
        'title' => __('Speaker Informations', 'Themetick'),
        'pages' => array('pt_speakers'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Job position', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'job_position',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Twitter username', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'speaker_twitter',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Facebook username', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'speaker_facebook',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('LinkedIn Public Profile Link', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'speaker_linkedin',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Google Plus Link', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'speaker_gplus',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('E-Mail Address', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'speaker_email',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Speaker URL', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'speaker_url',
                'type' => 'text',
                'std' => ''
            )

        )
    ),

    array(
        'id' => 'page_meta_box',
        'title' => __('Page Settings', 'Themetick'),
        'pages' => array('page'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Sidebar position', 'Themetick'),
                'desc' => '',
                'id' => $prefix . 'sidebar_position',
                'type' => 'select',
                'options' => array(
                    'right' => 'Right',
                    'left' => 'Left',
                )
            )

        )
    )

);




foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}


class My_meta_box {

    protected $_meta_box;

    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));

        add_action('save_post', array(&$this, 'save'));
    }

    /// Add meta box for multiple post types
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }





    // Callback function to show fields in meta box
    function show() {
        global $post;

        // Use nonce for verification
        echo '<input type="hidden" name="tk_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

        echo '<table class="form-table">';

        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);

            echo '<tr>',
                    '<th style="width:25%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                    '<td>';
            switch ($field['type']) {

                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<br />', $field['desc'];
                    break;

                case 'textarea':

                    wp_editor( $meta ? $meta : $field['std'], $field['id'], $settings = array('media_buttons' => false, 'textarea_rows' => '5'  ) );

                    break;

                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    echo '</select>';
                    break;

                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    break;

                // repeatable
                case 'repeatable':
                    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
                    $i = 0;
                    if ($meta) {
                        foreach($meta as $row) {  if($i==0) {$display = 'style="display:none"';} else { $display='';}
                            echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" value="'.$row.'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                            $i++;
                        }
                    } else {
                        echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" value="'.$row.'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                    }
                    echo '</ul>
                        <span class="description">'.$field['desc'].'</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another slider image';
                break;

                case 'imageupload':
                      echo '<input type="text"  class="upload-url"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                            </label>
                            ';
                    break;  
 }

            echo     '<td>',
                '</tr>';
        }

        echo '</table>';
    }

    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if (!wp_verify_nonce(@$_POST['tk_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }

        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            @$new = $_POST[$field['id']];

            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
}

?>
