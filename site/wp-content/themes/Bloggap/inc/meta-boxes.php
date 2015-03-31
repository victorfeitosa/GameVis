<?php
//require_once (TEMPLATEPATH.'/functions.php');

$prefix = 'tk_';
$meta_boxes = array(

    // POST TYPE POST
    array(
        'id' => 'post_meta1',
        'title' => __('VIdeo Link', tk_theme_name()),
        'pages' => array('post', 'gallery'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Video Link', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'video_link',
                'type' => 'text',
                'std' => ''
            )

        )
    ),

    array(
        'id' => 'post_meta2',
        'title' => __('Slider Fields', tk_theme_name()),
        'pages' => array('post', 'gallery'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',    
        'fields' => array(

            array(
                'label' => 'Slider Field',
                'name' => 'Slider Field',
                'desc'  => '',
                'id'    => $prefix.'repeatable',
                'type'  => 'repeatable'
            )

        )
    ),
    
    array(
        'id' => 'post_meta3',
        'title' => __('Audio Link', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Audio Link', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'audio_link',
                'type' => 'text',
                'std' => ''
            )

        )
    ),
    
    array(
        'id' => 'post_meta4',
        'title' => __('Quote Text', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Quote Text', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'quote',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Quote Author', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'quote_author',
                'type' => 'text',
                'std' => ''
            )

        )
    ),
    
    array(
        'id' => 'post_meta5',
        'title' => __('Link', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Link Text', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'link_text',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Link Url', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'link_url',
                'type' => 'text',
                'std' => ''
            )

        )
    ),
    


    array(
        'id' => 'post_meta7',
        'title' => __('Event Date', tk_theme_name()),
        'pages' => array('events'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Date Of Event', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'event_date',
                'type' => 'datepicker',
                'std' => ''
            )
        )
    ),


    array(
        'id' => 'post_meta8',
        'title' => __('Testimonial', tk_theme_name()),
        'pages' => array('testimonials'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(


            array(
                'name' => __('Job Position', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'name',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('E-mail', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'email',
                'type' => 'text',
                'std' => ''
            )
        )
    ),

    array(
        'id' => 'post_meta9',
        'title' => __('Service Info', tk_theme_name()),
        'pages' => array('services'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(


            array(
                'name' => __('Services', tk_theme_name()),
                'desc' => 'Set info for service, it will be shown on home page.',
                'id' => $prefix . 'service_info',
                'type' => 'text',
                'std' => ''
            ),

        )
    ),

    array(
        'id' => 'post_meta10',
        'title' => __('Member Info', tk_theme_name()),
        'pages' => array('team-members'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(


            array(
                'name' => __('Team Member Title', tk_theme_name()),
                'desc' => 'Set title for team member, it will be shown on home page.',
                'id' => $prefix . 'title_info',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Facebook Account', tk_theme_name()),
                'desc' => 'Enter Facebook account (e.g. themeskingdom) or leave empty if you dont wish to use Facebook',
                'id' => $prefix . 'facebook_info',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Twitter account', tk_theme_name()),
                'desc' => 'Enter Twitter account (e.g. themeskingdom) or leave empty if you dont wish to use Twitter',
                'id' => $prefix . 'twitter_info',
                'type' => 'text',
                'std' => ''
            ),


            array(
                'name' => __('Linkedin account', tk_theme_name()),
                'desc' => 'Enter Linkedin account (e.g. http://www.linkedin.com/company/2687325) or leave empty if you dont wish to use Linkedin',
                'id' => $prefix . 'linkedin_info',
                'type' => 'text',
                'std' => ''
            ),


            array(
                'name' => __('Google+ Account', tk_theme_name()),
                'desc' => 'Enter Google+ account (e.g. 123456789012345678901) or leave empty if you dont wish to use Google+',
                'id' => $prefix . 'google_info',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('E-Mail', tk_theme_name()),
                'desc' => 'Enter the e-mail of the memeber or leave it empty if you do not wish to display e-mail.',
                'id' => $prefix . 'email_info',
                'type' => 'text',
                'std' => ''
            ),



        )
    ),



    array(
        'id' => 'post_meta11',
        'title' => __('Headline Text and color', tk_theme_name()),
        'pages' => array('post',), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Undertitle', tk_theme_name()),
                'desc' => 'Set text that goes under the title.',
                'id' => $prefix . 'undertitle',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Post Color', tk_theme_name()),
                'desc' => 'Set background color for the post.',
                'id' => $prefix . 'color',
                'type' => 'colorpicker',
                'std' => ''
            ),

            array(
                'name' => __('Headline Color', tk_theme_name()),
                'desc' => 'Set headline color for the post.',
                'id' => $prefix . 'headline',
                'type' => 'colorpicker',
                'std' => '494949'
            ),

            array(
                'name' => __('Headline Hover Color', tk_theme_name()),
                'desc' => 'Set headline hover color for the post.',
                'id' => $prefix . 'headline_hover',
                'type' => 'colorpicker',
                'std' => 'cbcbcb'
            ),

            array(
                'name' => __('Undertitle Color', tk_theme_name()),
                'desc' => 'Set undertitle color for the post.',
                'id' => $prefix . 'undertitle_color',
                'type' => 'colorpicker',
                'std' => '229fda'
            ),

            array(
                'name' => __('Paragraph Color', tk_theme_name()),
                'desc' => 'Set paragraph color for the post.',
                'id' => $prefix . 'paragraph',
                'type' => 'colorpicker',
                'std' => '555555'
            ),

            array(
                'name' => __('Read More Color', tk_theme_name()),
                'desc' => 'Set "read more" color for the post.',
                'id' => $prefix . 'readmore',
                'type' => 'colorpicker',
                'std' => '229fda'
            ),

            array(
                'name' => __('Read More Hover Color', tk_theme_name()),
                'desc' => 'Set "read more" hover color for the post.',
                'id' => $prefix . 'readmore_hover',
                'type' => 'colorpicker',
                'std' => 'acdef5',
             
            ),

        )
    ),




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

                case 'imageupload':
                      echo '<input type="text"  class="upload-url"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                            </label>
                            ';
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
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                    }
                    echo '</ul>
                        <span class="description">'.$field['desc'].'</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another meta box';
                break;



                case 'colorpicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="color" value="', $meta ? $meta : $field['std'], '" size="30"/>
                            <input type="button" value="Reset" style="margin-left:15px" name="button'.$field['id'].'" id="button_'.$field['id'].'"/>',
                        '<br />', $field['desc'];?>
                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                jQuery('#button_<?php echo $field['id']?>').live('click', function(){
                                    jQuery('#<?php echo $field['id']?>').val('<?php echo $field['std']?>');
                                })
                            })
                        </script>
                    <?php break;

                    case 'datepicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="admin-datepicker" value="', $meta ? $meta : $field['std'], '" size="30"/>',
                        '<br />', $field['desc']; ?>
                    <?php break;
                
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