<?php
$prefix = 'tk_';

$meta_boxes = array(
// POST TYPE ADVERTISEMENT

    array(
        'id' => 'advertisement_meta_box_link',
        'title' => __('Advertisement Link', tk_theme_name()),
        'pages' => array('advertisement'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Advertisement Link', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'advertisement_link',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Custom Banner Code', tk_theme_name()),
                'desc' => 'If code is set it will be shown instead of advert selected above',
                'id' => $prefix . 'custom_banner_code',
                'type' => 'plaintextarea',
                'std' => '',
                'options' => array(
                    'rows' => '3',
                    'cols' => '13'
                )
            )
        )
    ),
    array(
        'id' => 'advertisement_meta_box',
        'title' => __('Advertisement', tk_theme_name()),
        'pages' => array('advertisement'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Banner Stats', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'banner_stats',
                'type' => 'annotated_timeline',
                'std' => ''
            )
        )
    ),
// POST TYPE POST
    array(
        'id' => 'post_meta1',
        'title' => __('VIdeo Link', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('VIdeo Link', tk_theme_name()),
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
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'label' => 'Repeatable',
                'name' => 'Slider Fields',
                'desc' => '',
                'id' => $prefix . 'repeatable',
                'type' => 'repeatable'
            )
        )
    ),
    array(
        'id' => 'post_meta7',
        'title' => __('Page Settings', tk_theme_name()),
        'pages' => array('page'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Select sidebar', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'sidebar',
                'type' => 'select-sidebar',
                'std' => '',
                'options' => ''
            ),
            array(
                'name' => __('Page Subheadline', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'subheadline',
                'type' => 'plaintextarea',
                'std' => '',
                'options' => array(
                    'rows' => '3',
                    'cols' => '15'
                )
            )
        )
    ),
    array(
        'id' => 'post_meta14',
        'title' => __('Rating', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Enable post Rating', tk_theme_name()),
                'desc' => __('Check this if you want to enable rating system on this post. ', tk_theme_name()),
                'id' => $prefix . 'enable_rating',
                'type' => 'checkbox',
                'std' => ''
            ),
            array(
                'name' => __('Rating Position', tk_theme_name()),
                'desc' => __('Chose position of your rating system.', tk_theme_name()),
                'id' => $prefix . 'rating_position',
                'type' => 'select',
                'options' => array('Top Left', 'Top Right')
            ),
            array(
                'name' => __('Rating type', tk_theme_name()),
                'desc' => __('Chose visual apperance of rating system.', tk_theme_name()),
                'id' => $prefix . 'rating_type',
                'type' => 'select',
                'options' => array('Number', 'Stars')
            ),
            array(
                'name' => __('Post Rating', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'post_rating',
                'type' => 'rating',
                'std' => ''
            ),
            array(
                'name' => __('Total Score Label', tk_theme_name()),
                'desc' => __('', tk_theme_name()),
                'id' => $prefix . 'rating_total',
                'type' => 'plaintextarea',
                'std' => '',
                'options' => array(
                    'rows' => '5',
                    'cols' => '100'
                ),
            ),
            array(
                'name' => __('Enable Reader Post Rating', tk_theme_name()),
                'desc' => __('Check this if you want to enable users/readers to rate this post. ', tk_theme_name()),
                'id' => $prefix . 'reader_rating',
                'type' => 'checkbox',
                'std' => ''
            ),
        )
    ),
    
        array(
        'id' => 'post_meta15',
        'title' => __('Sidebar Settings', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Select sidebar', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'sidebar',
                'type' => 'select-sidebar',
                'std' => '',
                'options' => ''
            )
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

            if ($field['type'] != 'annotated_timeline') {
                echo '<tr>',
                '<th style="width:25%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
            } else {
                
            }

            switch ($field['type']) {

                case 'annotated_timeline' :
                    if (isset($_GET['post'])) {
                        echo '<tr><td><div class="period_selector">',
                        '<a id="selector_seven_days" href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 7)">Last 7 Days</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 30)">Last 30 Days</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 365)">Last Year</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 0)">All Time</a>',
                        '</div><div class="banner-chart" style="width:100%; height:300px"></div></td></tr>';'<script></script>';
                    }
                    //'<div id="banner-chart" style="width:300px;height:150px"></div>',
                    break;

                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                    '<br />', $field['desc'];
                    break;

                case 'plaintextarea':
                    echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '"  rows="' . $field['options']['rows'] . '" cols="' . $field['options']['cols'] . '">' . $meta . '</textarea>';
                    break;

                case 'textarea':

                    wp_editor($meta ? $meta : $field['std'], $field['id'], $settings = array('media_buttons' => false, 'textarea_rows' => '5'));

                    break;

                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', ' value="' . $option . '">', $option, '</option>';
                    }
                    echo '</select></br>';
                    echo '<span class="description">' . $field['desc'] . '</span>';
                    break;


                    case 'select-sidebar':
                    global $wp_registered_sidebars;                     
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    $i = 1;
                    
                    if(get_post_type() == 'post') { 
                        echo '<option value="none">None</option>';
                    }
                    
                    
                    foreach ($wp_registered_sidebars as $sidebar) {                        
                            if($sidebar['name'] !== 'Footer Widget '.$i){
                                
                                echo '<option', $meta == $sidebar['name'] ? ' selected="selected"' : '', ' value="' . $sidebar['name'] . '">', $sidebar['name'], '</option>';
                            }
                        $i++;
                    }
                    echo '</select></br>';
                    echo '<span class="description">' . $field['desc'] . '</span>';
                    break;


                case 'category':
                    if ($field['taxonomy'] == '') {
                        $field['taxonomy'] = 'category';
                    }
                    $args = array(
                        'show_option_all' => __('All Categories', tk_theme_name),
                        'selected' => $meta,
                        'echo' => 1,
                        'taxonomy' => $field['taxonomy'],
                        'name' => $field['id']);
                    wp_dropdown_categories($args);
                    break;

                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;

                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> <span class="description">' . $field['desc'] . '</span>';
                    break;

                case 'imageupload':
                    echo '<input type="text"  class="upload-url"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                    '<input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                            </label>
                            ';
                    break;

                /*
                 * Page sidebar option
                 * 
                 *             array(
                  'name' => __('Sidebar Position', tk_theme_name()),
                  'desc' => '',
                  'id' => $prefix . 'sidebar_position',
                  'type' => 'sidebar'
                  )
                 * 
                 */

                case 'sidebar':
                    echo '<div class="" style="clear:both">';
                    echo '<style>
                                .sidebar-position-holder { float: left; margin: 0 10px 10px 0px; }
                                .sidebar-position-holder img { background: #fff; border: 1px solid #ccc; cursor: pointer; padding: 2px; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; }
                                .sidebar-position-holder img.sidebar-position-holder-selected,
                                .sidebar-position-holder img:hover { border-color: #464646; -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.05); box-shadow:0 1px 3px rgba(0,0,0,0.05); }
                                .sidebar-position-holder img{width:40px;height:41px}
                            </style>';
                    echo '<div class="sidebar-position-holder ' . ( $meta == 'right' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                    echo '<input type="radio" name="', $field['id'], '" value="right"', $meta == "right" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                    echo '<img src="' . get_template_directory_uri() . '/style/img/sidebar-right.png' . '" alt="" title="' . $field['name'] . '" class="sidebar-position-image ' . ( $meta == 'right' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                    echo '</div>';
                    echo '<div class="sidebar-position-holder ' . ( $meta == 'left' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                    echo '<input type="radio" name="', $field['id'], '" value="left"', $meta == "left" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                    echo '<img src="' . get_template_directory_uri() . '/style/img/sidebar-left.png' . '" alt="" title="' . $field['name'] . '" class="sidebar-position-image ' . ( $meta == 'left' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                    echo '</div>';
                    echo '<div class="sidebar-position-holder ' . ( $meta == 'fullwidth' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                    echo '<input type="radio" name="', $field['id'], '" value="fullwidth"', $meta == "fullwidth" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                    echo '<img src="' . get_template_directory_uri() . '/style/img/no-sidebar.png' . '" alt="" title="' . $field['name'] . '" class="sidebar-position-image ' . ( $meta == 'fullwidth' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                    echo '</div>';
                    echo '</div>';
                    if (isset($_GET['post'])) {
                        $current_template = get_post_meta($_GET['post'], '_wp_page_template', true);
                    } else {
                        $current_template = 'default';
                    }
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            var current_template = '<?php echo $current_template ?>';
                                                                    
                            if(current_template == '_gallery.php'){
                                jQuery('#post_meta8').attr('style', 'display:none');
                                jQuery('#post_meta13').attr('style', 'display:none');
                            }else if(current_template == '_team.php'){
                                jQuery('#post_meta8').attr('style', 'display:none');
                                jQuery('#post_meta13').attr('style', 'display:none');
                            }else if(current_template == '_projects.php'){
                                jQuery('#post_meta8').attr('style', 'display:none');
                                jQuery('#post_meta13').attr('style', 'display:block');
                            }else{
                                jQuery('#post_meta8').attr('style', 'display:block');
                                jQuery('#post_meta13').attr('style', 'display:none');
                            }

                            jQuery("#page_template").change(function() {
                                var page_template = jQuery(this).find("option:selected").val();
                                                                        
                                if(page_template == '_gallery.php'){
                                    jQuery('#post_meta8').attr('style', 'display:none');
                                    jQuery('#post_meta13').attr('style', 'display:none');
                                }else if(page_template == '_team.php'){
                                    jQuery('#post_meta8').attr('style', 'display:none');
                                    jQuery('#post_meta13').attr('style', 'display:none');
                                }else if(page_template == '_projects.php'){
                                    jQuery('#post_meta8').attr('style', 'display:none');
                                    jQuery('#post_meta13').attr('style', 'display:block');
                                }else{
                                    jQuery('#post_meta8').attr('style', 'display:block');
                                    jQuery('#post_meta13').attr('style', 'display:none');
                                }
                            });
                                                                    
                            jQuery('.sidebar-position-holder').live('click', function(){
                                jQuery('.sidebar-position-holder-selected').removeClass('sidebar-position-holder-selected');
                                jQuery('img', this).addClass('sidebar-position-holder-selected');
                            })
                        })
                    </script>
                    <?php
                    break;


                // REPEATABLE IMAGES
                case 'repeatable':
                    echo '<ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
                    $i = 0;
                    if ($meta) {
                        foreach ($meta as $row) {
                            if ($i == 0) {
                                $display = 'style="display:none"';
                            } else {
                                $display = '';
                            }
                            echo '<li><span class="sort hndle"><img  src="' . get_template_directory_uri() . '/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '"  id="' . $field['id'] . '" value="' . $row . '" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check' . $i . '" rel="' . $i . '" style="display:none;" href="#">-</a></li>';
                            $i++;
                        }
                    } else {
                        echo '<li><span class="sort hndle"><img  src="' . get_template_directory_uri() . '/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '"  size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check' . $i . '" rel="' . $i . '" style="display:none;" href="#">-</a></li>';
                    }
                    echo '</ul>
                        <span class="description">' . $field['desc'] . '</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another meta box';
                    break;

                // REPEATABLE RATING
                case 'rating':
                    echo '<ul id="' . $field['id'] . '-repeatable" class="custom_repeatable">';
                    $i = 0;
                    $criteria = get_post_meta($post->ID, 'criteria-' . $field['id'], true);
                    $rating = get_post_meta($post->ID, 'rating-' . $field['id'], true);
                    if ($meta) {
                        foreach ($meta as $row) {
                            if ($i == 0) {
                                $display = 'style="display:none"';
                            } else {
                                $display = '';
                            }
                            echo '<li>
                                        ' . __('Rating Criteria: ', tk_theme_name) . '<input type="text"  class="upload-url"  name="criteria-' . $field['id'] . '[' . $i . ']" id="criteria-' . $field['id'] . '"  value="' . $criteria[$i] . '" size="30" style="width:40%" />
                                        
                                        <input type="text"  class="upload-url"  name="rating-' . $field['id'] . '[' . $i . ']" id="rating-' . $field['id'] . '"  value="' . $rating[$i] . '" size="30" style="width:20%" />
                                        
                                        <input type="hidden"  class="upload-url"  name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '"  id="' . $field['id'] . '" value="' . $i . '"  />
                                        <a class="repeatable-remove button check' . $i . '" rel="' . $i . '" style="display:none;" href="#">-</a></li>
                                        <span class="description" style="margin-left:90px;margin-right:305px;">' . __('Title of this criteria', tk_theme_name) . '</span><span class="description">' . __('Rate this criteria from 0 to 20', tk_theme_name) . '</span>';

                            $i++;
                        }
                    } else {
                        echo '<li>
                                        ' . __('Rating Criteria: ', tk_theme_name) . '<input type="text"  class="upload-url"  name="criteria-' . $field['id'] . '[' . $i . ']" id="criteria-' . $field['id'] . '"  size="30" style="width:40%" />
                                        <input type="text"  class="upload-url"  name="rating-' . $field['id'] . '[' . $i . ']" id="rating-' . $field['id'] . '"  size="30" style="width:20%" />
                                        <input type="hidden"  class="upload-url"  name="' . $field['id'] . '[' . $i . ']" id="' . $field['id'] . '"  />
                                        <a class="repeatable-remove button check' . $i . '" rel="' . $i . '" style="display:none;" href="#">-</a></li>
                                        <span class="description" style="margin-left:90px;margin-right:305px;">' . __('Title of this criteria', tk_theme_name) . '</span><span class="description">' . __('Rate this criteria from 0 to 20', tk_theme_name) . '</span>';
                    }
                    echo '</ul>
                        <span class="description">' . $field['desc'] . '</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another criteria';
                    break;


                // COLOR PICKER
                case 'colorpicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="color" value="', $meta ? $meta : $field['std'], '" size="30"/>
                            <input type="button" value="Reset" style="margin-left:15px" name="button' . $field['id'] . '" id="button_' . $field['id'] . '"/>',
                    '<br />', $field['desc'];
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('#button_<?php echo $field['id'] ?>').live('click', function(){
                                jQuery('#<?php echo $field['id'] ?>').val('<?php echo $field['std'] ?>');
                            })
                        })
                    </script>
                    <?php
                    break;

                case 'datepicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="admin-datepicker" value="', $meta ? $meta : $field['std'], '" size="30"/>',
                    '<br />', $field['desc'];
                    ?>
                    <?php
                    break;
            }
            echo '<td>',
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
            if ($field['type'] == 'rating') {
                $old = get_post_meta($post_id, $field['id'], true);
                $old_criteria = get_post_meta($post_id, 'criteria-' . $field['id'], true);
                $old_rating = get_post_meta($post_id, 'rating-' . $field['id'], true);
                @$new = $_POST[$field['id']];
                @$new_criteria = $_POST['criteria-' . $field['id']];
                @$new_rating = $_POST['rating-' . $field['id']];
                if ($new && $new != $old && $new_criteria && $new_criteria != $old_criteria && $new_rating && $new_rating != $old_rating) {
                    update_post_meta($post_id, $field['id'], $new);
                    update_post_meta($post_id, 'criteria-' . $field['id'], $new_criteria);
                    update_post_meta($post_id, 'rating-' . $field['id'], $new_rating);
                } elseif ('' == $new && $old && '' == $new_criteria && $old_criteria && '' == $new_rating && $old_rating) {
                    delete_post_meta($post_id, $field['id'], $old);
                    delete_post_meta($post_id, 'criteria-' . $field['id'], $old_criteria);
                    delete_post_meta($post_id, 'rating-' . $field['id'], $old_rating);
                }
            } else {
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

}


?>