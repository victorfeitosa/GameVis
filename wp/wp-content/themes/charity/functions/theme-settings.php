<?php
/********************************************************************************************************/
/*                                                                                                      */
/*   If is in administation run theme install                                                           */
/*                                                                                                      */
/********************************************************************************************************/
if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {
    tk_theme_install();
}


/********************************************************************************************************/
/*                                                                                                      */
/*   Populate initial data                                                                              */
/*                                                                                                      */
/********************************************************************************************************/
function tk_populate_initial_theme_settings_data() {
    require(get_template_directory().'/config/admin-config.php');
    $i = 0;
    $last_val = '';
    $tab_name = '';
    foreach ($tabs as $tab) {
        foreach ($tab as $tab1) {
            if (!is_array($tab1)) {
                if (ctype_lower($tab1)) {
                    $tab_name = $tab1;
                } // if
            } // check if tab1 is array
            foreach ((array) $tab1 as $tab2) {
                if (isset($tab2['name']) && isset($tab2['value']) && isset($tab2['type'])) {
                    if (!empty($tab2['value']) && $tab2['type'] != 'select') {
                        if (get_option(wp_get_theme()->name . '_' . $tab2['name']) == false) {
                            update_option(wp_get_theme()->name . '_' . $tab_name . '_' . $tab2['name'], $tab2['value']);
                        } // if have name
                    } // if have value, type
                } // if have name, valua and type
            } // foreach tab1
        } // foreach tab
    } // foreach tabs
} // function populate initial data

/********************************************************************************************************/
/*                                                                                                      */
/*   Update options for each field from configuration                                                   */
/*                                                                                                      */
/********************************************************************************************************/
function populate_theme_options() {
    GLOBAL $tabs, $wp_version;
    $pages = @get_all_pages();
        if(!empty($tabs)){
        foreach ($tabs as $r1) {
            foreach ($r1 as $r2) {
                if (count($r2) > 0) {
                    foreach ((array) $r2 as $r3) {
                        if (@$r3['value'] != '' && strlen($r3['name']) != 1 && $r3['type'] != 'select' && $r3['type'] != 'radio' && $r3['type'] != 'checkbox') {
                            update_option(wp_get_theme()->name . '_' . $r1['id'] . '_' . $r3['name'], $r3['value']);
                        } // if value, name, type is set
                    } // foreach 3rd level of array tabs
                } // foreach 2nd level of array tabs
            } // foreach fields inside tabs
        } // foreach tabs
    } // function populate theme options
} //if(!empty($tabs))

/********************************************************************************************************/
/*                                                                                                      */
/*   Call update options of fields                                                                      */
/*                                                                                                      */
/********************************************************************************************************/
function tk_theme_install() {
    global $wpdb;
    populate_theme_options(); //populate options from file
}

/********************************************************************************************************/
/*                                                                                                      */
/*   Function that replace native WP get_option                                                         */
/*                                                                                                      */
/********************************************************************************************************/
function get_theme_option($option_name) {
    GLOBAL $tabs;
    $option_value = get_option($option_name);
    if (is_array($option_value)) {
        if (count($option_value) > 2) {
            return stripslashes_deep($option_value);
        } else {
            return (stripslashes($option_value['0']));
        } // if have more than two items in array
    } else {
        if ($option_value != '') {
            return (stripslashes($option_value));
        } // if is not empty string
    } // if is array option_value
} // function get_theme_option

/********************************************************************************************************/
/*                                                                                                      */
/*   Getting first tab in theme panel                                                                   */
/*                                                                                                      */
/********************************************************************************************************/
function get_first_tab() {
    GLOBAL $tabs;
    require(get_template_directory().'/config/admin-config.php');
    $i = 0;
    foreach ($tabs as $tab) {
        if ($tab['pg']['slug'] == $_GET['page']) {
            if ($i == 0) {
                return $tab['id'];
            } // if counter is 0
        } // if tab slug and page are same
    } // foreach tabs
} // function get_first_tab

/********************************************************************************************************/
/*                                                                                                      */
/*   Creating pages array from config file                                                              */
/*                                                                                                      */
/********************************************************************************************************/
function get_all_pages() {
    require(get_template_directory().'/config/admin-config.php');
    $pages = array();
    $i = 0;
    $last_val = '';
    foreach ((array) $tabs as $tab) {
        if ($last_val != $tab['pg']) {
            $pages[] = $tab['pg'];
            $last_val = $tab['pg'];
        }
    }
    return $pages;
}
add_action('admin_menu', 'tk_settings_page_init');
$tabs = '';

/********************************************************************************************************/
/*                                                                                                      */
/*   Creating pages array from config file                                                              */
/*                                                                                                      */
/********************************************************************************************************/
function tk_settings_page_init() {
    $pages = get_all_pages();
    $theme_data = wp_get_theme(get_template_directory() . '/style.css');
    $settings_page = '';
    for ($i = 0; $i <= count($pages) - 1; $i++) {
        if ($i == 0) {
            $settings_page .= add_menu_page($pages[$i]['slug'], wp_get_theme()->name, 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        } else {
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        }
    }
}

/********************************************************************************************************/
/*                                                                                                      */
/*   If Update Settings is clicked                                                                      */
/*                                                                                                      */
/********************************************************************************************************/
if (@$_POST["ilc-settings-submit"] == 'Y') {
    if (@$_GET['tab'] == '') {
        $tab = get_first_tab();
    } else {
        $tab = @$_GET['tab'];
    }
    $required_error = 0;
    foreach ($_POST as $var => $value) {
        if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options
            if (@$_POST[$var . '_required'] == 'yes') {
                if ($_POST[$var] == '') {
                    $required_error++;
                }
            }
        }
    }
    /********************************************************************************************************/
    /*                                                                                                      */
    /*   Creating pages array from config file                                                              */
    /*                                                                                                      */
    /********************************************************************************************************/
    if ($required_error == 0) {
        tk_save_theme_settings();
        $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
    } else {
        $url_parameters = isset($tab) ? 'error=true&tab=' . $tab : 'error=true';
    }
    wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
}


/********************************************************************************************************/
/*                                                                                                      */
/*   Update options                                                                                     */
/*                                                                                                      */
/********************************************************************************************************/

if (isset($_GET['widgetID'])) {
    $postid = $_GET['widgetID'];
    wp_delete_post($postid);
}

/********************************************************************************************************/
/*                                                                                                      */
/*   Update options                                                                                     */
/*                                                                                                      */
/********************************************************************************************************/
function tk_save_theme_settings() {
    global $pagenow;
    if (@$_GET['tab'] == '') {
        $tab = get_first_tab();
    } else {
        $tab = @$_GET['tab'];
    }
    if ($pagenow == 'admin.php' && isset($_GET['page'])) {
        if (isset($tab)) {

            // Check if tab is sidebar or home page and use custom post insert
            if ($tab == 'sidebars' ) {
                if ($_POST && $tab == 'sidebars') {
                    $widget_post = array(
                        'post_title' => $_POST['widget_area'],
                        'post_status' => 'publish',
                        'post_type' => 'sidebars'
                    );
                    wp_insert_post($widget_post);
                }
            } else {
                foreach ($_POST as $var => $value) {
                    if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options
                        update_option(wp_get_theme()->name . '_' . $tab . '_' . $var, $value);
                    }
                }
            }
        }
    }
}

/********************************************************************************************************/
/*                                                                                                      */
/*   Functions for every block type we use                                                              */
/*                                                                                                      */
/********************************************************************************************************/

/********************************************************************************************************/
/*                                                                                                      */
/*   Standard Text Input
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'text',
            'value' => 'default_value_for_field',
            'label' => __('Name of the Field', 'tkingdom'),
            'desc' => __('Short description of the Field', 'tkingdom'),
            'options' => array(
                'size' => 'set size for this input'
            )
        ),
/********************************************************************************************************/
function tk_block_text($r3, $tab, $dev, $required, $required_hidden_field, $post_id = '') {
    if ($post_id != '') {
        $post_id = '-' . $post_id;
    }
    if (isset($r3['options']['size'])) {
        $size = 'size = "' . $r3['options']['size'] . '"';
    } else {
        $size = '';
    }
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name'] . $post_id) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name'] . $post_id);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>
                    <input id="' . $r3['id'] . $post_id . '" name="' . $r3['name'] . $post_id . '" type="' . $r3['type'] . '" value="' . htmlspecialchars(stripslashes($val)) . '" ' . @$r3['options']['readonly'] . ' ' . $size . ' />
                    <span class="description"><br />' . $r3['desc'] . '</span>
                    ' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_text

/********************************************************************************************************/
/*                                                                                                      */
/*   Label
        array(
            'type' => 'label',
            'label' => __('Some text for Label', 'tkingdom'),
        ),
/********************************************************************************************************/
function tk_block_label($r3, $dev, $required) {
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label></th>
            </tr>';
}
// end function tk_block_label

/********************************************************************************************************/
/*                                                                                                      */
/*   Colorpicker
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'colorpicker',
            'value' => 'default_value_for_field',
            'label' => __('Name of the Field', 'tkingdom'),
        ),
/********************************************************************************************************/
function tk_block_colorpicker($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>
                <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="text" value="' . $val . '" class="colorpicker"/>
                <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery( "#'.$r3['id'].'" ).wpColorPicker();
                })
                </script>
                </td>
            </tr>';

}
// end function tk_block_colorpicker

/********************************************************************************************************/
/*                                                                                                      */
/*   Datepicker
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'datepicker',
            'value' => 'default_value_for_field',
            'label' => __('Name of the Field', 'tkingdom'),
            'desc' => __('Short description of the Field', 'tkingdom'),
            'options' => array(
                'size' => 'set size for this input'
            )
        ),
/********************************************************************************************************/
function tk_block_datepicker($r3, $tab, $dev, $required, $required_hidden_field) {
    if (isset($r3['options']['size'])) {
        $size = 'size = "' . $r3['options']['size'] . '"';
    } else {
        $size = '';
    }
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>
                    <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="text" value="' . $val . '" class="admin-datepicker" ' . $size . ' />
                    <span class="description">' . $r3['desc'] . '</span>
                    ' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_datepicker

/********************************************************************************************************/
/*                                                                                                      */
/*   Hidden
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'hidden',
            'value' => 'default_value_for_field',
        ),
/********************************************************************************************************/
function tk_block_hidden($r3, $tab, $dev, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>' . $dev . '
                <td>
                    <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="' . $r3['type'] . '" value="' . stripslashes($val) . '" />
                        ' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_hidden

/********************************************************************************************************/
/*                                                                                                      */
/*   Password
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'password',
            'value' => 'default_value_for_field',
            'label' => __('Name of the Field', 'tkingdom'),
            'desc' => __('Short description of the Field', 'tkingdom'),
        ),
/********************************************************************************************************/
function tk_block_password($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>
                    <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="' . $r3['type'] . '" value="' . $val . '" />
                    <span class="description">' . $r3['desc'] . '</span>
                        ' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_password

/********************************************************************************************************/
/*                                                                                                      */
/*   Radio button
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'radio',
            'value' => 'default_value_for_field',
            'label' => __('Name of the Field', 'tkingdom'),
            'desc' => __('Short description of the Field', 'tkingdom'),
            'options' => array(
                'value1' => 'Caption 1',
                'value2' => 'Caption 2',
                'value3' => 'Caption 3'
            )
        ),
/********************************************************************************************************/
function tk_block_radio($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                    <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                    <td>';
    foreach($r3['options'] as $radio_value => $radio_caption){
        if ($radio_value == $val) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '" value="' . $radio_value . '" ' . $checked . ' /> ' . $radio_caption . '<br />';
    }
    echo '
                    <span class="description">' . $r3['desc'] . '</span>
                        ' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_radio

/********************************************************************************************************/
/*                                                                                                      */
/*   Checkbox
        array(
            'id' => 'id_for_the_input',
            'name' =>  'name_for_the_input',
            'type' => 'checkbox',
            'value' => '',
            'label' => __('Name of the Field', 'tkingdom'),
            'desc' => __('Short description of the Field', 'tkingdom'),
            'options' => array(
                'yes' => 'If checked Google+ share button and counter will be disabled in a single post.'
            ),
        ),
/********************************************************************************************************/
function tk_block_checkbox($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_theme_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                    <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                    <td>';
    foreach($r3['options'] as $check_value => $check_caption){
        if ($check_value == $val) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '[]" value="' . $check_value . '" ' . $checked . ' /> ' . $check_caption . '<br />';
    }
    echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '[]" value="" style="display:none;" checked />';
    echo '
                    <span class="description">' . $r3['desc'] . '</span>
                        ' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_checkbox

//  SELECT
function tk_block_select($r3, $tab, $dev, $required, $required_hidden_field, $class = '') {
    if($class !== ''){
        $select_class = 'class="'.$class.'"';
    }else{
        $select_class = 'class=""';
    }
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>
                    <select '.$select_class.' name="' . $r3['name'] . '" id="' . $r3['id'] . '">';
    for ($i = 0; $i < (count($r3['value'])); $i++) {
        if ($r3['value'][$i][1] == $val) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }
        echo '<option value="' . $r3['value'][$i][1] . '" ' . $selected . '>' . $r3['value'][$i][0] . '</option>';
    }
    echo '</select>
                <span class="description '.$class.'"><br />' . $r3['desc'] . '</span>
                ' . $required_hidden_field . '
            </td>
        </tr>';
}
// end function tk_block_select

//  STYLECHANGER
function tk_block_stylechanger($r3, $tab) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<div class="option-section" style="max-width: 960px;">';

    foreach ($r3['styles'] as $styleobject) {
        if ($styleobject == $val) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        };
        echo '<div class="one-style" style="display: inline-block;margin: 50px 12px 10px 12px">
                    <input type="radio" name="' . $r3['name'] . '" style="display: inline-block;position: relative;left: 50%;top: -170px;" value="' . $styleobject . '"  class="style-radio" ' . $checked . '>
                    <div class="style-preview" style="background-image:url(' . get_template_directory_uri() . '/style/stylechanger/' . $styleobject . '.png);background-position: center center;width: 150px;height: 150px;display: inline-block;border:1px solid #DFDFDF"></div>
                </div>';
    }
    echo '<label class="option-description">' . $r3['description'] . '</label>
        </div>';
}
// end function tk_block_stylechanger

//  TEXTAREA
function tk_block_textarea($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
            <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
            <td>
                <textarea name="' . $r3['name'] . '" id="' . $r3['id'] . '" rows="' . @$r3['options']['rows'] . '" cols="' . @$r3['options']['cols'] . '">' . stripslashes($val) . '</textarea><br />
                <span class="description">' . $r3['desc'] . '</span>
                    ' . $required_hidden_field . '
            </td>
        </tr>';
}
// end function tk_block_textarea

//  WIDGETAREAS
function tk_block_widgetareas($r3, $dev, $required, $required_hidden_field) {
    global $post;
    $i = '';
    echo '<tr>
            <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
            <td>
                <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="text" value="" ' . @$r3['options']['readonly'] . ' size ="60" />
                <span class="description"><br />' . $r3['desc'] . '</span>
                ' . $required_hidden_field . '
            </td>
        </tr>';
    $args = array('post_status' => 'publish', 'posts_per_page' => -1, 'post_type' => 'sidebars');
    //The Query
    query_posts($args);
    //The Loop
    if (have_posts()) : while (have_posts()) : the_post();
        echo '
            <tr class="class-' . $post->ID . '">
                <th></th>
                <td>
                    <div class="widget tk-widget-admin">
                        <h4>' . get_the_title() . '</h4>
                        <a href="admin.php?page=theme-settings&tab=sidebars&widgetID=' . $post->ID . '"><img src="' . get_template_directory_uri() . '/theme-images/widget-delete.png" /></a>
                    </div>
                </td>
            </tr>';
        $i++;
    endwhile;
    endif;
}
// end function tk_block_widgetareas

//  FILE
function tk_block_file($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    if (!empty($r3['clear']) && $r3['clear'] == 'yes') {
        $clear = '<input type="button" value="Clear" style="margin-left:15px" name="clear' . $r3['id'] . '" id="clear' . $r3['id'] . '"/>';
    } else {
        $clear = '';
    }
    echo '<tr valign="top">
            <th scope="row">' . $required . '' . $r3['label'] . ' ' . $dev . '</th>
            <td><label for="' . $r3['id'] . '">
            <input class="upload-url" id="' . $r3['id'] . '" type="text" size="36" name="' . $r3['name'] . '" value="' . $val . '" />
            <input class="st_upload_button" id="' . $r3['id'] . '_button" type="button" value="Upload" />' . $clear . '
            <br /><span class="description">' . $r3['desc'] . '</span>
            </label></td>
            ' . $required_hidden_field . '
          </tr>';
}
// end function tk_block_file

//  FILE IMAGE
function tk_block_file_image($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {

        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr valign="top">
                <th scope="row">' . $required . '' . $r3['label'] . ' ' . $dev . '</th>
                <td><label for="' . $r3['id'] . '">

                <input class="upload-url" id="' . $r3['id'] . '" type="text" size="36" name="' . $r3['name'] . '" value="' . $val . '" />
                <input class="st_upload_button" id="' . $r3['id'] . '_button" type="button" value="Upload" />';
    if ($val != '') {
        echo '<img src="' . $val . '" width="30" height="30" />';
    }
    echo '<br /><span class="description">' . $r3['desc'] . '</span>
                </label></td>
                ' . $required_hidden_field . '
          </tr>';
}
// end function tk_block_file_image

//  HR TAG
function tk_block_hr($r3) {
    echo '<tr valign="top">
            <td colspan="2"><hr class="hr2" style="background-color: ' . @$r3['options']['color'] . ';color: ' . @$r3['options']['color'] . ';width: ' . @$r3['options']['width'] . ';height: 1px;border: 0 none;"></td>
          </tr>';
}
// end function tk_block_hr

//  CUSTOM BUTTON
function tk_block_custom_button($r3) {
    echo '<tr valign="top">
            <td colspan="2" style="margin-left:0;padding-left:0"><input type="button" class="button-secondary" value="' . $r3['value'] . '" name="' . $r3['name'] . '" id="' . $r3['id'] . '"/></td>
          </tr>';
}
// end function tk_block_custom_button

//  DROPDOWN PAGES
function tk_block_pages($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>';
    $args = array(
        'selected' => $val,
        'echo' => 1,
        'name' => $r3['name']);
    wp_dropdown_pages($args);
    echo '<span class="description"><br />' . $r3['desc'] . '</span>' . $required_hidden_field . '
                </td>
            </tr>';
}
// end function tk_block_pages

function tk_block_posts($r3, $tab, $dev, $required) {
    global $wpdb;
    $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '" . $r3['post_type'] . "'");
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td><select name="' . $r3['name'] . '">';
    foreach ($posts as $post) {
        if ($val == $post->ID) {
            $selected = 'selected';
        } else {
            $selected = '';
        };
        echo '<option value="' . $post->ID . '"' . $selected . '>' . $post->post_title . '</option>';
    }
    echo '</select><span class="description"><br />' . $r3['desc'] . '</span>
                </td>
        </tr>';
}
// end function tk_block_posts

//  DROPDOWN CATEGORIES
function tk_block_categories($r3, $tab, $dev, $required = '', $required_hidden_field = '', $post_id = '') {

    if (isset($post_id)) {
        $prefix = '-' . $post_id;
    } else {
        $prefix = '';
    }

    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name'] . $prefix) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name'] . $prefix);
    } else {
        $val = $r3['value'];
    }
    if (empty($r3['taxonomy'])) {
        $r3['taxonomy'] = 'category';
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>';
    $args = array(
        'show_option_all' => __('All Categories', wp_get_theme()->name),
        'selected' => $val,
        'echo' => 1,
        'taxonomy' => $r3['taxonomy'],
        'name' => $r3['name'] . $prefix);
    wp_dropdown_categories($args);
    echo '<span class="description"><br />' . $r3['desc'] . '</span>
                ' . $required_hidden_field . '
            </td>
        </tr>';
}
// end function tk_block_categories

//  DROPDOWN AUTHORS
function tk_block_authors($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(wp_get_theme()->name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>';
    $args = array(
        'selected' => $val,
        'name' => $r3['name']);
    wp_dropdown_users($args);
    echo '<span class="description"><br />' . $r3['desc'] . '</span>
                ' . $required_hidden_field . '
            </td>
        </tr>';
}
// end function tk_block_authors

//  FONT PREVIEW
function tk_block_font_preview($r3, $tab, $dev, $required, $required_hidden_field) {
    echo '<tr>
            <th></th>
            <td><label class="'.$r3['name'].' font-preview">' . $required . '' . $r3['value'] . '</label>' . $dev . '</td>
          </tr>';
    $exploded_name = explode('_', $r3['name']);
    $main_id = $exploded_name[0].'_'.$exploded_name[1];
    $style_id = $exploded_name[0].'_'.$exploded_name[1].'_style';
    echo '<script type="text/javascript">
                jQuery(document).ready(function($){
                    $.mynamespace = {};
                    $("#'.$main_id.'").on("change", function(){
                    $.mynamespace.selected_font = jQuery(this).find("option:selected").html();
                        jQuery(".'.$r3['name'].'").attr("style", "font-family: "+$.mynamespace.selected_font+"");
                    });
                    $("#'.$style_id.'").on("change", function(){
                    if($.mynamespace.selected_font == undefined){$.mynamespace.selected_font = ""};
                    var selected_style = jQuery(this).find("option:selected").val();
                        if(selected_style == "regular"){
                            jQuery(".'.$r3['name'].'").attr("style", "font-weight: normal;font-style: normal;font-family: "+$.mynamespace.selected_font+"");
                        }
                        if(selected_style == "bold"){
                            jQuery(".'.$r3['name'].'").attr("style", "font-weight: bold;font-style: normal;font-family: "+$.mynamespace.selected_font+"");
                        }
                        if(selected_style == "italic"){
                            jQuery(".'.$r3['name'].'").attr("style", "font-style: italic;font-weight: normal;font-family: "+$.mynamespace.selected_font+"");
                        }
                        if(selected_style == "bolditalic"){
                            jQuery(".'.$r3['name'].'").attr("style", "font-weight: bold;font-style: italic;font-family: "+$.mynamespace.selected_font+"");
                        }
                    });
                })
            </script>';
}
// end function tk_block_font_preview

function tk_admin_tabs($current) {
    GLOBAL $tabs;
    if ($current == '') {
        $current = get_first_tab();
    }
    require(get_template_directory().'/config/admin-config.php');
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    $i = 0;
    foreach ($tabs as $tab) {
        if ($tab['pg']['slug'] == $_GET['page']) {
            if ($i == 0) {
                $i++;
            }
            $class = ( $tab['id'] == $current ) ? ' nav-tab-active' : '';
            echo '<a class="nav-tab' . $class . '"  href="?page=' . $_GET['page'] . '&tab=', $tab['id'], '">', $tab['name'], '</a>';
        }
    }
    echo '</h2>';
}

function tk_settings_page($par) {
    global $pagenow, $wp_version;

    $settings = get_option("tk_theme_settings");
    $theme_data = wp_get_theme(get_template_directory() . '/style.css');
    ?>

    <div class="wrap">
        <h2><?php
            $pages = @get_all_pages();
            for ($i = 0; $i <= count($pages) - 1; $i++) {
                if ($pages[$i]['slug'] == $_GET['page']) {
                    echo $pages[$i]['page_title'];
                }
            }
            ?></h2>

        <?php
        if ('true' == esc_attr(@$_GET['error']))
            echo '<div class="error" ><p>All fields marked with (*) are required.</p></div>';
        if ('true' == esc_attr(@$_GET['updated']))
            echo '<div class="updated" ><p>Theme Settings updated.</p></div>';

        if (isset($_GET['tab']))
            tk_admin_tabs($_GET['tab']); else
            tk_admin_tabs(get_first_tab());
        ?>

        <div id="poststuff">
            <form method="post" action="<?php admin_url('admin.php?page=' . $_GET['page']); ?>">
                <p class="submit" style="clear: both;">
                    <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                    <input type="hidden" name="ilc-settings-submit" value="Y" />
                </p>
                <?php
                wp_nonce_field("ilc-settings-page");
                if ($pagenow == 'admin.php' && isset($_GET['page'])) {
                    if (isset($_GET['tab']))
                        $tab = $_GET['tab'];
                    else
                        $tab = get_first_tab();

                    echo '<table class="form-table">';


                    GLOBAL $tabs;
                    foreach ($tabs as $r1) {
                        if ($r1['id'] == $tab) {
                            $row_items = 1;
                            foreach ($r1 as $r2) {

                                if ($row_items == 4) {
                                    if (count($r2) > 0) {

                                        foreach ($r2 as $r3) {

                                            if (@$r3['options']['required'] == 'yes') {
                                                $required = '* ';
                                                $required_hidden_field = '<input type="hidden" name="' . $r3['name'] . '_required" value="yes">';
                                            } else {
                                                $required = '';
                                                $required_hidden_field = '<input type="hidden" name="' . $r3['name'] . '_required" value="no">';
                                            }

                                            if (isset($_GET['dev'])) {
                                                $dev = '<br /><font color="red">' . wp_get_theme()->name . '_' . $tab . '_' . $r3['name'] . '</font>';
                                            } else {
                                                $dev = '';
                                            }

                                            // call block text function
                                            if ($r3['type'] == 'text') {
                                                tk_block_text($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block label function
                                            if ($r3['type'] == 'label') {
                                                tk_block_label($r3, $tab, $dev, $required);
                                            }

                                            // call block label function
                                            if ($r3['type'] == 'colorpicker') {
                                                tk_block_colorpicker($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block label function
                                            if ($r3['type'] == 'datepicker') {
                                                tk_block_datepicker($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block hidden function
                                            if ($r3['type'] == 'hidden') {
                                                tk_block_hidden($r3, $tab, $dev, $required_hidden_field);
                                            }

                                            // call block password function
                                            if ($r3['type'] == 'password') {
                                                tk_block_password($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block radio function
                                            if ($r3['type'] == 'radio') {
                                                tk_block_radio($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block checkbox function
                                            if ($r3['type'] == 'checkbox') {
                                                tk_block_checkbox($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block font preview function
                                            if ($r3['type'] == 'font_preview') {
                                                tk_block_font_preview($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block select function
                                            if ($r3['type'] == 'select') {
                                                if (isset($r3['class'])) {
                                                    tk_block_select($r3, $tab, $dev, $required, $required_hidden_field, $r3['class']);
                                                } else {
                                                    tk_block_select($r3, $tab, $dev, $required, $required_hidden_field);
                                                }
                                            }

                                            // call block stylechanger function
                                            if ($r3['type'] == 'stylechanger') {
                                                tk_block_stylechanger($r3, $tab);
                                            }

                                            // call block textarea function
                                            if ($r3['type'] == 'textarea') {
                                                tk_block_textarea($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block widgetareas function
                                            if ($r3['type'] == 'widgetareas') {
                                                tk_block_widgetareas($r3, $dev, $required, $required_hidden_field);
                                            }

                                            // call block file function
                                            if ($r3['type'] == 'file') {
                                                tk_block_file($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block file function
                                            if ($r3['type'] == 'file_image') {
                                                tk_block_file_image($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block hr function
                                            if ($r3['type'] == 'hr') {
                                                tk_block_hr($r3);
                                            }

                                            // call block button function
                                            if ($r3['type'] == 'button') {
                                                tk_block_custom_button($r3);
                                            }

                                            // call block pages function
                                            if ($r3['type'] == 'pages') {
                                                tk_block_pages($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block pages function
                                            if ($r3['type'] == 'posts') {
                                                tk_block_posts($r3, $tab, $dev, $required);
                                            }

                                            // call block category function
                                            if ($r3['type'] == 'category') {
                                                tk_block_categories($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            // call block author function
                                            if ($r3['type'] == 'author') {
                                                tk_block_authors($r3, $tab, $dev, $required, $required_hidden_field);
                                            }

                                            if ($r3['type'] == 'include') {//TYPE: include
                                                include($r3['value']);
                                            } // include

                                        }
                                    }
                                }
                                $row_items++;
                            }
                        }
                    }
                    ?>

                    <?php
                    echo '</table>';
                }
                ?>
                <p class="submit" style="clear: both;">
                    <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                    <input type="hidden" name="ilc-settings-submit" value="Y" />
                </p>
            </form>
        </div>
    </div>

<?php } ?>