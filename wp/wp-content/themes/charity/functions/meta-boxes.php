<?php
/************************************************************/
/*                                                          */
/*   Functions for adding meta boxes to posts and pages     */
/*                                                          */
/************************************************************/

/************************************************************/
/*                                                          */
/*   Load configuration file                                */
/*                                                          */
/************************************************************/
require(get_template_directory().'/config/meta-box-config.php');

foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}

class My_meta_box {

    protected $_meta_box;

    /************************************************************/
    /*                                                          */
    /*   Create metabox                                         */
    /*                                                          */
    /************************************************************/
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));
        add_action('save_post', array(&$this, 'save'));
    } // end __construct

    /************************************************************/
    /*                                                          */
    /*   Add metabox function                                   */
    /*                                                          */
    /************************************************************/
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    } // close add

    /************************************************************/
    /*                                                          */
    /*   Add metabox function                                   */
    /*                                                          */
    /************************************************************/
    function show() {
        global $post;
        echo '<input type="hidden" name="tk_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
        echo '<table class="form-table">';
        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
            if ($field['type'] != 'annotated_timeline') {
                echo '<tr>',
                '<th style="width:25%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
            } // if field is not timeline

            switch ($field['type']) {

                /************************************************************/
                /*                                                          */
                /*   Timeline for adds                                      */
                /*                                                          */
                /************************************************************/
                case 'annotated_timeline' :
                    if (isset($_GET['post'])) {
                        echo '<tr><td><div class="period_selector">',
                            '<a id="selector_seven_days" href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 7)">Last 7 Days</a>',
                            '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 30)">Last 30 Days</a>',
                            '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 365)">Last Year</a>',
                            '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 0)">All Time</a>',
                        '</div><div class="banner-chart" style="width:100%; height:300px"></div></td></tr>';'<script></script>';
                    } // if isset post
                    break;

                /************************************************************/
                /*                                                          */
                /*   Standard Text Field                                    */
                /*                                                          */
                /************************************************************/
                case 'text': 
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? htmlentities($meta) : $field['std'], '" size="30" style="width:97%" />',
                    '<br />', $field['desc'];
                    break;

                /************************************************************/
                /*                                                          */
                /*   Standard Textarea                                      */
                /*                                                          */
                /************************************************************/
                case 'textarea':
                    echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '"  rows="' . $field['options']['rows'] . '" cols="' . $field['options']['cols'] . '">'.htmlentities($meta).'</textarea>';
                    break;

                /************************************************************/
                /*                                                          */
                /*   WordPress Editor - not working that good               */
                /*                                                          */
                /************************************************************/
                case 'wptextarea':
                    wp_editor( $meta ? $meta : $field['std'], $field['id'], $settings = array('media_buttons' => false, 'textarea_rows' => '5'  ) );
                    break;

                /************************************************************/
                /*                                                          */
                /*   Select option Field                                    */
                /*                                                          */
                /************************************************************/
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option => $key) {
                        echo '<option', $meta == $key ? ' selected="selected"' : '', ' value="'.$key.'">', $option, '</option>';
                    }
                    echo '</select></br>';
                    echo '<span class="description">'.$field['desc'].'</span>';
                    break;

                /************************************************************/
                /*                                                          */
                /*   Category select                                        */
                /*                                                          */
                /************************************************************/
                case 'category':
                    if($field['taxonomy'] == ''){$field['taxonomy'] = 'category';}
                    $args = array(
                        'selected' => $meta,
                        'echo' => 1,
                        'taxonomy' => $field['taxonomy'],
                        'name' => $field['id']);
                    wp_dropdown_categories($args);
                    echo '<span class="description">'.$field['desc'].'</span>';
                    break;

                /************************************************************/
                /*                                                          */
                /*   Radio select                                           */
                /*                                                          */
                /************************************************************/
                case 'radio':
                    foreach ($field['options'] as $option => $key) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $key, '"', $meta == $key ? ' checked="checked"' : '', ' style="margin:-1px 5px 0 0" />', $option;
                        echo '</br>';
                    }
                    break;

                /************************************************************/
                /*                                                          */
                /*   Checkbox                                               */
                /*                                                          */
                /************************************************************/
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    echo '<span class="description"> ' . $field['desc'] . '</span>';
                    break;

                /************************************************************/
                /*                                                          */
                /*   Sidebar dropdown picker - type of sidebar              */
                /*                                                          */
                /************************************************************/
                case 'select-sidebar':
                    global $wp_registered_sidebars;                    
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    $i = 1;                    
                    foreach ($wp_registered_sidebars as $sidebar) { 
                        if($sidebar['name'] !== 'Footer Widget '.$i && $sidebar['name'] !==''){                            
                            echo '<option', $meta == $sidebar['name'] ? ' selected="selected"' : '', ' value="' . $sidebar['name'] . '">', $sidebar['name'],  '</option>';
                        }
                        $i++;
                    }
                    echo '</select></br>';
                    echo '<span class="description">' . $field['desc'] . '</span>';
                    break;

                /************************************************************/
                /*                                                          */
                /*   File uploader - image                                  */
                /*                                                          */
                /************************************************************/
                case 'imageupload':
                    echo '<input type="text"  class="upload-url"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? htmlentities($meta) : $field['std'], '" size="30"  />'.
                    '<input id="st_upload_button" style="margin-left:15px;" class="st_upload_button" type="button" name="upload_button" value="Upload" /></label>';
                    break;

                /************************************************************/
                /*                                                          */
                /*   Sidebar icon picker - position of sidebar              */
                /*                                                          */
                /************************************************************/
                case 'sidebar':
                    if($meta == 'right' || $meta == ''){
                        $meta = 'right';
                    }
                    echo '<div class="" style="clear:both">';
                    echo '<div class="sidebar-position-holder ' . ( $meta == 'right' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                    echo '<input type="radio" name="', $field['id'], '" value="right"', $meta == "right" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                    echo '<img src="' . get_template_directory_uri().'/theme-images/sidebar-right-icon.png' . '" alt="" title="' . $field['name'] .'" class="sidebar-position-image ' . ( $meta == 'right' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                    echo '</div>';
                    echo '<div class="sidebar-position-holder ' . ( $meta == 'left' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                    echo '<input type="radio" name="', $field['id'], '" value="left"', $meta == "left" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                    echo '<img src="' . get_template_directory_uri().'/theme-images/sidebar-left-icon.png' . '" alt="" title="' . $field['name'] .'" class="sidebar-position-image ' . ( $meta == 'left' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                    echo '</div>';
                    echo '<div class="sidebar-position-holder ' . ( $meta == 'fullwidth' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                    echo '<input type="radio" name="', $field['id'], '" value="fullwidth"', $meta == "fullwidth" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                    echo '<img src="' . get_template_directory_uri().'/theme-images/nosidebar-icon.png' . '" alt="" title="' . $field['name'] .'" class="sidebar-position-image ' . ( $meta == 'fullwidth' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                    echo '</div>';
                    echo '</div>';
                    if(isset($_GET['post'])){
                        $current_template = get_post_meta( $_GET['post'], '_wp_page_template', true );
                    }else{
                        $current_template = 'default';
                    }
                    if(isset($_GET['post_type'])){
                        $current_post_type = $_GET['post_type'];
                    }else{
                        $current_post_type = '';
                    }
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            var current_template = '<?php echo $current_template?>';
                            var current_post_type = '<?php echo $current_post_type?>';
                            <?php if($current_post_type == 'gallery'){?>
                                jQuery('#sidebar_position_meta').attr('style', 'display:none');
                            <?php }?>

                            <?php foreach($field['templates'] as $templates => $key){?>
                                if(current_template == '<?php echo $templates?>'){
                                        jQuery('#post_meta8').attr('style', 'display:none');
                                        jQuery('#post_meta13').attr('style', 'display:none');
                                    }else if(current_template == '_gallery_4_columns.php'){
                                        jQuery('#post_meta8').attr('style', 'display:none');
                                        jQuery('#post_meta13').attr('style', 'display:none');
                                    }else if(current_template == '_team-members.php'){
                                        jQuery('#post_meta8').attr('style', 'display:none');
                                        jQuery('#post_meta13').attr('style', 'display:none');
                                    }else if(current_template == '_reservations.php'){
                                        jQuery('#post_meta8').attr('style', 'display:none');
                                        jQuery('#post_meta13').attr('style', 'display:block');
                                    }else{
                                        jQuery('#post_meta8').attr('style', 'display:block');
                                        jQuery('#post_meta13').attr('style', 'display:none');
                                    }
                            <?php } // end foreach disable icons for templates ?>

                            jQuery("#page_template").change(function() {
                                var page_template = jQuery(this).find("option:selected").val();
                                if(page_template == '_gallery_3_columns.php'){
                                    jQuery('#post_meta8').attr('style', 'display:none');
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

                /************************************************************/
                /*                                                          */
                /*   Repeatable Image Selector                              */
                /*                                                          */
                /************************************************************/
                case 'repeatable':
                    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
                    $i = 0;
                    if ($meta) {
                        foreach($meta as $row) {  if($i==0) {$display = 'style="display:none"';} else { $display='';}
                            echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/theme-images/drag-icon.png" style="position: relative;top: 3px;"/></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" value="'.htmlentities($row).'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                            $i++;
                        }
                    } else {
                        echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/theme-images/drag-icon.png" style="position: relative;top: 3px;"/></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                    }
                    echo '</ul>
                        <span class="description">'.$field['desc'].'</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another meta box';
                    break;


                /************************************************************/
                /*                                                          */
                /*   Color Picker                                           */
                /*                                                          */
                /************************************************************/
                case 'colorpicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="color" value="', $meta ? $meta : $field['std'], '" size="30"/>
                        <br />', $field['desc'];?>
                    
                    <script type="text/javascript">    
                        jQuery(document).ready(function($){ 
                            $('#<?php echo $field['id']; ?>').wpColorPicker();
                        });    
                    </script>
                    
                    <?php break;

                /************************************************************/
                /*                                                          */
                /*   Date Picker                                            */
                /*                                                          */
                /************************************************************/
                case 'datepicker':
                    echo '
                    <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="admin-datepicker" value="', $meta ? $meta : $field['std'], '" size="30"/>',
                    '<br />', $field['desc'];
                    break;
                /************************************************************/
                /*                                                          */
                /*   DateTime Picker Field                                    */
                /*                                                          */
                /************************************************************/
                case 'datetime': 
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? date('Y-m-d H:i:s', htmlentities($meta)) : $field['std'], '" size="30" style="width:97%" />',
                    '<br />', $field['desc'];
                    break;                    

            } // end switch for meta box types
            echo     '</td></tr>';
        } // end foreach metabox
        echo '</table>';
    }

    /************************************************************/
    /*                                                          */
    /*   Save value from each metabox created                   */
    /*                                                          */
    /************************************************************/
    function save($post_id) {
        // verify nonce
        if(!empty($_POST['tk_meta_box_nonce'])){
            if (!wp_verify_nonce($_POST['tk_meta_box_nonce'], basename(__FILE__))) {
                return $post_id;
            } // if nonce check

            // check autosave
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return $post_id;
            } // if doing autosave

            // check permissions
            if ('page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id)) {
                    return $post_id;
                }
            } elseif (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            } // if page

            // update option for each meta box
            foreach ($this->_meta_box['fields'] as $field) {
                $old = get_post_meta($post_id, $field['id'], true);
                @$new = $_POST[$field['id']];

                if($field['type'] == 'datetime') {    
                    if ($new && $new != $old) {      
                        $datetime = strtotime($new);   
                        update_post_meta($post_id, $field['id'], $datetime);
                    } elseif ('' == $new && $old) {
                        $datetimeold = strtotime($old);   
                        delete_post_meta($post_id, $field['id'], $datetimeold);
                    } // if value is different
                }else{

                    if ($new && $new != $old) {                    
                        update_post_meta($post_id, $field['id'], $new);
                    } elseif ('' == $new && $old) {
                        delete_post_meta($post_id, $field['id'], $old);
                    } // if value is different
                }
            } // foreach
        } // if not empty nonce
    } // function save metabox
} // end Class MetaBox

?>