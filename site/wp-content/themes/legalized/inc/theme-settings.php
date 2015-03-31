<?php
if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {
    tk_theme_install();
}

function tk_populate_initial_theme_settings_data() {

    require_once('admin-settings.php');
    $i = 0;
    $last_val = '';
    $tab_name = '';

    foreach ($tabs as $tab) {

        foreach ($tab as $tab1) {

            if (!is_array($tab1)) {
                if (ctype_lower($tab1)) {
                    $tab_name = $tab1;
                }
            }
            foreach ((array) $tab1 as $tab2) {
                if (isset($tab2['name']) && isset($tab2['value']) && isset($tab2['type'])) {
                    if (!empty($tab2['value']) && $tab2['type'] != 'select') {
                        if (get_option(tk_theme_name() . '_' . $tab2['name']) == false) {
                            update_option(tk_theme_name() . '_' . $tab_name . '_' . $tab2['name'], $tab2['value']);
                        }
                    }
                }
            }
        }
    }
}

if (isset($_GET['tab'])) {


    if ($_GET['tab'] == 'home_builder') {
        foreach ($_POST as $var => $value) {
            if (!preg_match("/post_order_/i", $var)) {
                update_option($var, $value);
            } else {
                $post_id = str_replace('post_order_', '', $var);
                update_post_meta($post_id, 'tk_box_order', $value);
            } // if
        } // foreach
    } // if
}

function populate_theme_options() {

    GLOBAL $tabs, $wp_version;
    $pages = @get_all_pages();
    foreach ($tabs as $r1) {
        foreach ($r1 as $r2) {
            if (count($r2) > 0) {
                foreach ((array) $r2 as $r3) {
                    if(isset($r3['name'])){$r3name = $r3['name'];}else{$r3name = '';}
                    if(isset($r3['value'])){$r3value = $r3['value'];}else{$r3value = '';}
                    if(isset($r3['type'])){$r3type = $r3['type'];}else{$r3type = '';}
                    if (@$r3value != '' && $r3name != 1 && $r3type != 'select' && $r3type != 'radio' && $r3type != 'checkbox') {
                        update_option(wp_get_theme() . '_' . $r1['id'] . '_' . $r3['name'], $r3['value']);
                    }
                }
            }
        }
    }
}

function tk_theme_install() {
    global $wpdb;
    populate_theme_options(); //populate options from file
}

function get_theme_option($option_name) {
    GLOBAL $tabs;
    $option_value = get_option($option_name);

    if (is_array($option_value)) {
        if (count($option_value) > 2) {
            return stripslashes_deep($option_value);
        } else {
            return (stripslashes($option_value['0']));
        }
    } else {
        if ($option_value != '') {
            return (stripslashes($option_value));
        }
    }
}

function my_general_admin_scripts() {
    wp_enqueue_script('jquery-ui-datepicker');
}

// Function to insert some style to administration
function admincss() {
    wp_register_style('admin-style', get_template_directory_uri() . '/inc/admin.css');
    wp_enqueue_style('admin-style');
}

add_action('admin_enqueue_scripts', 'admincss');

function my_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
}

function my_admin_styles() {
    wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_general_admin_scripts');


if (isset($_GET['page']) && isset($_GET['page'])) {
    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles', 'my_admin_styles');
}
add_action('admin_head', 'includeScript');

function get_first_tab() {
    GLOBAL $tabs;
    require_once('admin-settings.php');
    $i = 0;
    foreach ($tabs as $tab) {
        if ($tab['pg']['slug'] == $_GET['page']) {
            if ($i == 0) {
                return $tab['id'];
            }
        }
    }
}

function get_all_pages() {
    GLOBAL $tabs;
    $pages = array();
    require_once('admin-settings.php');
    $i = 0;
    $last_val = '';
    foreach ((array) $tabs as $tab) {
        if(isset($tab['pg'])) {
            if ($last_val != $tab['pg']) {
                $pages[] = $tab['pg'];
                $last_val = $tab['pg'];
            }
        }
    }
    return $pages;
}

function includeScript() {
    ?>
    <script type='text/javascript'>

        this.screenshotPreview = function(){

            xOffset = 10;
            yOffset = 30;

            jQuery(".page-builder-holder .one-style").hover(function(e){

                    var getRel = jQuery(this).attr('rel');
                    jQuery("body").append("<div id='screenshot'>"+ getRel +"</div>");
                    jQuery("#screenshot")
                        .css("top",(e.pageY - xOffset) + "px")
                        .css("left",(e.pageX + yOffset) + "px")
                        .fadeIn("fast");
                },
                function(){
                    jQuery("#screenshot").remove();
                });
            jQuery(".page-builder-holder .one-style").mousemove(function(e){
                jQuery("#screenshot")
                    .css("top",(e.pageY - xOffset) + "px")
                    .css("left",(e.pageX + yOffset) + "px");
            });
        };

        jQuery('#screenshot').blur(function() {
            jQuery("#screenshot").remove();
        });


        jQuery(document).ready(function() {

            var formfield;
            jQuery('.st_upload_button').click(function() {
                formfield ='checker';
                targetfield = jQuery(this).prev('.upload-url');
                post_id = '';
                tb_show('', 'media-upload.php?post_id='+post_id+'&type=image&amp;TB_iframe=true');
                return false;
            });

            window.original_send_to_editor = window.send_to_editor;
            window.send_to_editor = function(html){

                if (formfield) {
                    imgurl = jQuery(html).attr('href');
                    jQuery(targetfield).val(imgurl);
                    formfield = null;
                    tb_remove();
                }

                else {
                    window.original_send_to_editor(html);
                    formfield = null;
                }
            }

            var n = jQuery('.custom_repeatable li').length;
            if(n>1) { jQuery('.custom_repeatable li .repeatable-remove').attr('style', 'display:inline');}

            jQuery('.repeatable-add').click(function() {

                field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
                fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
                jQuery('.upload-url', field).val('').attr('name', function(index, name) {
                    return name.replace(/(\d+)/, function(fullMatch, n) {
                        return Number(n) + 1;
                    });
                })

                field.insertAfter(fieldLocation, jQuery(this).closest('td'))
                var n = jQuery('.custom_repeatable li').length;
                if(n>1) { jQuery('.custom_repeatable li .repeatable-remove').attr('style', 'display:inline');}

                return false;
            });
            var relval = '';
            jQuery('.repeatable-remove').click(function(){

                jQuery(this).parent().remove();
                relval = jQuery(this).attr('rel');
                var n = jQuery('.custom_repeatable li').length;
                if(n=='1') { jQuery('.custom_repeatable li:first-child .repeatable-remove').attr('style', 'display:none');}
                return false;

            });


            <?php

            function check_is_admin_post() {
                $current_page = basename($_SERVER['REQUEST_URI'], ".php");
                if (preg_match("/post-new/i", $current_page) || isset($_GET['post'])) {
                    return true;
                } else {
                    return false;
                }
            }

            if (check_is_admin_post()) {
                ?>
            jQuery('.custom_repeatable').sortable({
                opacity: 0.6,
                revert: true,
                cursor: 'move',
                handle: '.sort'
            });
            <?php } ?>


            screenshotPreview();
            jQuery('.admin-datepicker').datepicker();


        });


    </script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/script/jscolor/jscolor.js'; ?>"></script>

<?php
}

add_action('admin_menu', 'tk_settings_page_init');
$tabs = '';

function tk_settings_page_init() {
    global $wp_version;
    $tk_theme_name = get_option('tk_theme_name');
    $pages = @get_all_pages();
    if (version_compare($wp_version, '3.4', '>=')) {
        $theme_data = wp_get_theme(TEMPLATEPATH . '/style.css');
    } else {
        $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
    }
    $settings_page = '';
    for ($i = 0; $i <= count($pages) - 1; $i++) {
        if ($i == 0) {
            $settings_page .= add_menu_page($pages[$i]['slug'], ucfirst(tk_theme_name), 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        } else {
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        }
    }
}

if (@$_POST["ilc-settings-submit"] == 'Y') {
    if (@$_GET['tab'] == '') {
        $tab = get_first_tab();
    } else {
        $tab = @$_GET['tab'];
    }
    $required_error = 0;

    if ($tab == 'room_options') {
        foreach ($_POST as $var => $value) {
            if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options                    
                if ($_GET['tab'] == 'room_options') {
                    $check_result = $wpdb->get_results("SELECT * FROM `wp_rooms` WHERE room_options = '$value';");
                    var_dump($check_result);
                    if (empty($check_result)) {
                        $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "rooms (room_options) VALUES(%s);", $value));
                        $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
                        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
                    } else {
                        $url_parameters = isset($tab) ? 'same_name=true&tab=' . $tab : 'error=true';
                        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
                    }
                }
            }
        }
    } else {
        foreach ($_POST as $var => $value) {
            if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options
                if (@$_POST[$var . '_required'] == 'yes') {
                    if ($_POST[$var] == '') {
                        $required_error++;
                    }
                }
            }
        }

        if ($required_error == 0) {
            tk_save_theme_settings();
            $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
        } else {
            $url_parameters = isset($tab) ? 'error=true&tab=' . $tab : 'error=true';
        }
        wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
    }
}

// Function to delete post from SIDEBAR post type
if (isset($_GET['widgetID'])) {
    $postid = $_GET['widgetID'];
    wp_delete_post($postid);
}

// Function to add post from PAGEBUILDER post type
if (isset($_GET['addBlock'])) {
    $page_builder_post = array(
        'post_title' => $_GET['blockTitle'],
        //'post_content'    => $_GET['blockContent'], enable it back only if I need this
        'post_status' => 'publish',
        'post_type' => 'page_builder'
    );

    wp_redirect(site_url() . '/wp-admin/admin.php?page=theme-settings&tab=' . $_GET['tab']);
    ob_end_clean();
    $post_id = wp_insert_post($page_builder_post);
    update_post_meta($post_id, 'tk_box_order', 999);
}

// Function to delete post from PAGEBUILDER post type
if (isset($_GET['blockID'])) {
    $postid = $_GET['blockID'];
    wp_delete_post($postid);
}

function tk_save_theme_settings() {
    global $pagenow;


    $tk_theme_name = get_option('tk_theme_name');
    if (@$_GET['tab'] == '') {
        $tab = get_first_tab();
    } else {
        $tab = @$_GET['tab'];
    }

    if ($pagenow == 'admin.php' && isset($_GET['page'])) {


        if (isset($tab)) {

            // Check if tab is sidebar or home page and use custom post insert
            if ($tab == 'sidebars' || $tab == 'home_builder') {
                if ($_POST && $tab == 'sidebars') {
                    $widget_post = array(
                        'post_title' => $_POST['widget_area'],
                        'post_status' => 'publish',
                        'post_type' => 'sidebars'
                    );
                    wp_insert_post($widget_post);
                } elseif (isset($_POST['page_builder']) && $_POST && $tab == 'home_builder') {
                    $page_builder_post = array(
                        'post_title' => $_POST['page_builder'],
                        'post_status' => 'publish',
                        'post_type' => 'page_builder'
                    );
                    wp_insert_post($page_builder_post);
                }
            } else {
                foreach ($_POST as $var => $value) {
                    if ($var != '_wpnonce' && $var != '_wp_http_referer' && $var != 'Submit' && $var != 'ilc-settings-submit' && !preg_match("/_required/i", $var)) {//$_POST variables which we don't want to save as options
                        update_option($tk_theme_name . '_' . $tab . '_' . $var, $value);
                    }
                }
            }
        }
    }
}

/*
 * START
 * FUNCTIONS FOR BLOCK TYPES
 */

//  TEXT
function tk_block_text($r3, $tab, $dev, $required, $required_hidden_field, $post_id = '') {


    if ($post_id != '') {
        $post_id = '-' . $post_id;
    }
    if (isset($r3['options']['size'])) {
        $size = 'size = "' . $r3['options']['size'] . '"';
    } else {
        $size = '';
    }
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name'] . $post_id) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name'] . $post_id);
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
//  LABEL
function tk_block_label($r3, $dev, $required) {
    echo '<tr>
            <th><label>' . $required . '' . $r3['label'] . '</label></th>
        </tr>';
}

// end function tk_block_label
//  COLORPICKER
function tk_block_colorpicker($r3, $tab, $dev, $required, $required_hidden_field) {
    if (isset($r3['options']['size'])) {
        $size = 'size = "' . $r3['options']['size'] . '"';
    } else {
        $size = '';
    }
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    if (!empty($r3['clear']) && $r3['clear'] == 'yes') {
        $clear = '<input type="button" value="Clear" style="margin-left:15px" name="clear' . $r3['id'] . '" id="clear' . $r3['id'] . '"/>';
    } else {
        $clear = '';
    }
    echo '<tr>
            <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
            <td>
                <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="text" value="' . $val . '" class="color" ' . $size . ' />
                <span class="description">' . $r3['desc'] . '</span><input type="button" value="Reset" style="margin-left:15px" name="button' . $r3['id'] . '" id="button_' . $r3['id'] . '"/>
                ' . $clear . $required_hidden_field . '
            </td>
        </tr>';
    echo '<script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#button_' . $r3['id'] . '").live("click", function(){
                        jQuery("#' . $r3['id'] . '").val("' . $r3['value'] . '");
                    })
                })
            </script>';
}

// end function tk_block_colorpicker
//  DATEPICKER
function tk_block_datepicker($r3, $tab, $dev, $required, $required_hidden_field) {
    if (isset($r3['options']['size'])) {
        $size = 'size = "' . $r3['options']['size'] . '"';
    } else {
        $size = '';
    }
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
//  HIDDEN
function tk_block_hidden($r3, $tab, $dev, $required_hidden_field) {
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
//  PASSWORD
function tk_block_password($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
//  RADIO
function tk_block_radio($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>';
    for ($i = 0; $i < (count($r3['value'])); $i++) {
        if ($r3['value'][$i] == $val) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '" value="' . $r3['value'][$i] . '" ' . $checked . ' /> ' . $r3['caption'][$i] . '<br />';
    }
    echo '
                <span class="description">' . $r3['desc'] . '</span>
                    ' . $required_hidden_field . '
            </td>
        </tr>';
}

// end function tk_block_radio
//  CHECKBOX
function tk_block_checkbox($r3, $tab, $dev, $required, $required_hidden_field) {
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
        @$val_database = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
    } else {
        $val = $r3['value'];
        @$val_database = array();
    }
    echo '<tr>
                <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                <td>';
    for ($i = 0; $i < (count($r3['value'])); $i++) {
        if (@in_array($r3['value'][$i], $val_database)) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        echo '<input type="' . $r3['type'] . '" name="' . $r3['name'] . '[]" value="' . $r3['value'][$i] . '" ' . $checked . ' /> ' . $r3['caption'][$i] . '<br />';
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
                        <a href="admin.php?page=theme-settings&tab=sidebars&widgetID=' . $post->ID . '"><img src="' . get_template_directory_uri() . '/style/img/widget-delete.png" /></a>
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {

        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
//  DROPDOWN POSTS
/*
  array(
  'id' => 'ID',
  'name' => 'NAME',
  'type' => 'posts',
  'value' => '',
  'post_type' => 'events', <-- Post type, post, page, custom post type
  'label' => 'LABEL',
  'desc' => 'DESCRIPTION',
  ),
 */
function tk_block_posts($r3, $tab, $dev, $required) {
    global $wpdb;
    $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '" . $r3['post_type'] . "'");
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name'] . $prefix) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name'] . $prefix);
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
        'show_option_all' => __('All Categories', tk_theme_name),
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
    if (get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
        $val = get_option(tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
                    $("#'.$main_id.'").change(function(){
                    $.mynamespace.selected_font = jQuery(this).find("option:selected").html();
                        jQuery(".'.$r3['name'].'").attr("style", "font-family: "+$.mynamespace.selected_font+"");
                    });
                    $("#'.$style_id.'").change(function(){
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
// end function tk_block_authors

//  ROOM OPTIONS
function tk_room_options($r3, $tab, $dev, $required, $required_hidden_field, $post_id = '') {

    if (!empty($_GET['same_name'])) {
        if ($_GET['same_name'] == true) {
            _e('This room option already exists', tk_theme_name);
        }
    }
    if ($post_id != '') {
        $post_id = '-' . $post_id;
    }
    if (isset($r3['options']['size'])) {
        $size = 'size = "' . $r3['options']['size'] . '"';
    } else {
        $size = '';
    }

    echo '<tr>
            <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
            <td>
                <input id="' . $r3['id'] . $post_id . '" name="' . $r3['name'] . $post_id . '" type="' . $r3['type'] . '" value="" ' . @$r3['options']['readonly'] . ' ' . $size . ' />
                <span class="description"><br />' . $r3['desc'] . '</span>
                ' . $required_hidden_field . '
            </td>
        </tr>';
}

// end function tk_block_text
//  BUILDER LABEL FIELD
function tk_builder_label($post_id, $build_block_fields) {
    echo '<label>' . $build_block_fields['label'] . '</label>';
}

// end function tk_block_label
//  BUILDER TEXT FIELD
function tk_builder_text($post_id, $build_block_fields) {
    $default_value = get_option($build_block_fields['id'] . '-' . $post_id);

    echo '<p>' . $build_block_fields['label'] . '</p>
            <input id="' . $build_block_fields['id'] . '-' . $post_id . '" name="' . $build_block_fields['id'] . '-' . $post_id . '" type="text" value="' . $default_value . '"/>';
    echo '<span class="margin-bot-10"></span>';
}

// end function tk_builder_text
//  BUILDER SELECT FIELD
function tk_builder_select($post_id, $build_block_fields) {
    $default_value = get_option($build_block_fields['id'] . '-' . $post_id);
    echo '<p>' . $build_block_fields['label'] . '</p>';
    echo '<select name="' . $build_block_fields['id'] . '-' . $post_id . '" id="' . $build_block_fields['id'] . '-' . $post_id . '" rel="' . $post_id . '">';
    for ($i = 0; $i < (count($build_block_fields['value'])); $i++) {
        if ($build_block_fields['value'][$i][1] == $default_value) {
            $selected = 'selected="selected"';
        } else {
            $selected = '';
        }
        echo '<option value="' . $build_block_fields['value'][$i][1] . '" ' . $selected . '>' . $build_block_fields['value'][$i][0] . '</option>';
    }
    echo '</select>';
    echo '<span class="margin-bot-10"></span>';
}

// end function tk_builder_select
//  BUILDER CATEGORY FIELD
function tk_builder_categories($post_id, $build_block_fields) {
    echo '<p>' . $build_block_fields['label'] . '</p>';
    if (get_option($build_block_fields['id'] . '-' . $post_id) != '') {
        $val = get_option($build_block_fields['id'] . '-' . $post_id);
    } else {
        if (!empty($build_block_fields['value'])) {
            $new_value = $build_block_fields['value'];
        } else {
            $new_value = '';
        }
        $val = $new_value;
    }
    if (empty($build_block_fields['taxonomy'])) {
        $build_block_fields['taxonomy'] = 'category';
    }
    $args = array(
        'show_option_all' => __('All Categories', tk_theme_name),
        'selected' => $val,
        'echo' => 1,
        'taxonomy' => $build_block_fields['taxonomy'],
        'name' => $build_block_fields['id'] . '-' . $post_id);
    wp_dropdown_categories($args);
    echo '<span class="margin-bot-10"></span>';
}

// end function tk_builder_categories
//  BUILDER POST FIELD
function tk_builder_posts($post_id, $build_block_fields) {
    
    $tk_blog_id = get_option('id_blog_page');
    $tk_contact_id = get_option('id_contact_page');
    $tk_services_id = get_option('id_services_page');
    $tk_team_id = get_option('id_team_page');
    $tk_testimonials_id = get_option('id_testimonials_page');
    $tk_work_id = get_option('id_work_page');
    $tk_work4_id = get_option('id_work4_page');

    global $wpdb;
    $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '" . $build_block_fields['post_type'] . "'");
        
    
    if (get_option($build_block_fields['id'] . '-' . $post_id) != '') {
        $val = get_option($build_block_fields['id'] . '-' . $post_id);
    } else {
        $val = $build_block_fields['value'];
    }
    echo '<p>' . $build_block_fields['label'] . '</p>';
    echo '<select name="' . $build_block_fields['id'] . '-' . $post_id . '">';
    foreach ($posts as $post) {
        if($post->ID == $tk_blog_id || $post->ID == $tk_contact_id || $post->ID == $tk_services_id || $post->ID == $tk_team_id || $post->ID == $tk_testimonials_id || $post->ID == $tk_work_id || $post->ID == $tk_work4_id){
            
        } else {
            if ($val == $post->ID) {
                $selected = 'selected';
            } else {
                $selected = '';
            };
            echo '<option value="' . $post->ID . '"' . $selected . '>' . $post->post_title . '</option>';
        }
    }
    echo '</select>';
    echo '<span class="margin-bot-10"></span>';

    
    
    
}

// end function tk_builder_posts
//  BUILDER CHECKBOX FIELD
function tk_builder_checkbox($post_id, $build_block_fields) {
    if (get_option($build_block_fields['id'] . '-' . $post_id) != '') {
        $val = get_option($build_block_fields['id'] . '-' . $post_id);
        @$val_database = get_option($build_block_fields['id'] . '-' . $post_id);
    } else {
        $val = $build_block_fields['value'];
        @$val_database = array();
    }
    echo '<p>' . $build_block_fields['label'] . '</p>';
    for ($i = 0; $i < (count($build_block_fields['value'])); $i++) {
        if (@in_array($build_block_fields['value'][$i], $val_database)) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }
        echo '<input type="' . $build_block_fields['type'] . '" name="' . $build_block_fields['id'] . '-' . $post_id . '[]" value="' . $build_block_fields['value'][$i] . '" ' . $checked . ' /> ' . $build_block_fields['caption'][$i] . '<br />';
    }
    echo '<input type="' . $build_block_fields['type'] . '" name="' . $build_block_fields['id'] . '-' . $post_id . '[]" value="" style="display:none;" checked />';
    echo '<span class="margin-bot-10"></span>';
}

// end function tk_builder_checkbox
//  BUILDER COLORPICKER FIELD
function tk_builder_colorpicker($post_id, $build_block_fields) {
    if (isset($build_block_fields['options']['size'])) {
        $size = 'size = "' . $build_block_fields['options']['size'] . '"';
    } else {
        $size = '';
    }

    if (get_option($build_block_fields['id'] . '-' . $post_id) != '') {
        $val = get_option($build_block_fields['id'] . '-' . $post_id);
    } else {
        $val = $build_block_fields['value'];
    }

    echo '<p>' . $build_block_fields['label'] . '</p>';
    echo '<input id="' . $build_block_fields['id'] . '-' . $post_id . '" name="' . $build_block_fields['id'] . '-' . $post_id . '" type="text" value="' . $val . '" class="color"  />';

    echo '<script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery("#button_' . $build_block_fields['id'] . '-' . $post_id . '").live("click", function(){
                            jQuery("#' . $build_block_fields['id'] . '-' . $post_id . '").val("' . $build_block_fields['value'] . '");
                        })
                    })
                </script>';
    echo '<span class="margin-bot-10"></span>';
}

// end function tk_builder_colorpicker
//  BUILDER COLUMNS FIELD
function tk_builder_columns($post_id, $build_block) {
    echo '<div style="width:100%">';
    $tk_column_width = round(93 / count($build_block['fields']));
    foreach ($build_block['fields'] as $build_block_fields) {
        echo '<div class="field-select tk_columns_'.count($build_block['fields']).'" style="width:' . $tk_column_width . '%; float:left;">';
        // call builder label block
        if ($build_block_fields['type'] == 'label') {
            tk_builder_label($post_id, $build_block_fields);
        }
        // call builder text block
        if ($build_block_fields['type'] == 'text') {
            tk_builder_text($post_id, $build_block_fields);
        }
        // call builder select block
        if ($build_block_fields['type'] == 'select') {
            tk_builder_select($post_id, $build_block_fields);
        }
        // call builder posts/pages block
        if ($build_block_fields['type'] == 'posts') {
            tk_builder_posts($post_id, $build_block_fields);
        }
        // call builder category block
        if ($build_block_fields['type'] == 'category') {
            tk_builder_categories($post_id, $build_block_fields);
        }
        // call builder checkbox block
        if ($build_block_fields['type'] == 'checkbox') {
            tk_builder_checkbox($post_id, $build_block_fields);
        }
        // call builder colorpicker block
        if ($build_block_fields['type'] == 'colorpicker') {
            tk_builder_colorpicker($post_id, $build_block_fields);
        }
        foreach ($build_block_fields['value'] as $build_block_value) {
            $default_value = get_option($build_block_fields['name'] . '-' . $post_id);
            $default_value = $default_value . '-' . $post_id;
            $check_value = $build_block_value[1] . '-' . $post_id;
            if ($default_value == $check_value) {
                $display = 'display:block';
            } else {
                $display = 'display:none';
            }
            echo '<div class="subfield-' . $build_block_value[1] . '-' . $post_id . '" style="' . $display . '">';
            foreach ($build_block_value[2]['subfields'] as $build_block_subfields) {
                // call builder text block
                if ($build_block_subfields['type'] == 'text') {
                    tk_builder_text($post_id, $build_block_subfields);
                }
                // call builder select block
                if ($build_block_subfields['type'] == 'select') {
                    tk_builder_select($post_id, $build_block_subfields);
                }
                // call builder category block
                if ($build_block_subfields['type'] == 'category') {
                    tk_builder_categories($post_id, $build_block_subfields);
                }
                // call builder posts block
                if ($build_block_subfields['type'] == 'posts') {
                    tk_builder_posts($post_id, $build_block_subfields);
                }
                // call builder checkbox block
                if ($build_block_subfields['type'] == 'checkbox') {
                    tk_builder_checkbox($post_id, $build_block_subfields);
                }
                // call builder colorpicker block
                if ($build_block_subfields['type'] == 'colorpicker') {
                    tk_builder_colorpicker($post_id, $build_block_subfields);
                }
            } // end foreach for blocks
            echo '</div>';
        } // end foreach all value
        echo '</div>';
    } // end foreach for blocks
    echo '</div>';
}

// end function tk_builder_colorpicker

function tk_admin_tabs($current) {
    GLOBAL $tabs;

    if ($current == '') {
        $current = get_first_tab();
    }

    require_once('admin-settings.php');

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
    if (version_compare($wp_version, '3.4', '>=')) {
        $theme_data = wp_get_theme(TEMPLATEPATH . '/style.css');
    } else {
        $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
    }
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
    <?php
    wp_nonce_field("ilc-settings-page");
    if ($pagenow == 'admin.php' && isset($_GET['page'])) {
        if (isset($_GET['tab']))
            $tab = $_GET['tab'];
        else
            $tab = get_first_tab();

        echo '<table class="form-table">';


        GLOBAL $tabs;
        $tk_theme_name = get_option('tk_theme_name');
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
            $dev = '<br /><font color="red">' . $tk_theme_name . '_' . $tab . '_' . $r3['name'] . '</font>';
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

        // call Room options function
        if ($r3['type'] == 'room_options') {
            tk_room_options($r3, $tab, $dev, $required, $required_hidden_field);
        }

        if ($r3['type'] == 'include') {//TYPE: include
            include($r3['value']);
        } // include


        /*
         * PAGEBUILDER BETTER ONE STATE
         */
    if ($r3['type'] == 'page_builder') {//TYPE: PAGE BUILDER
        global $post;
        if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
            $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
        } else {
            $val = $r3['value'];
        }
        ?>
        <h2 style="margin-left:25px"><?php echo $r3['description'] ?></h2>

        <div class="option-section page-builder-holder">

            <?php
            $i = 0;
            foreach ($r3['options'] as $key => $one_block) {
                ?>

                <div class="one-style" rel="<?php if (isset($one_block['desc'])) {
                    echo $one_block['desc'];
                } ?>" style="display: inline-block;margin: 30px 20px 10px 20px;width:122px;height:122px;">
                    <a class="add_block_link" href="admin.php?page=theme-settings&tab=home_builder&addBlock=1&blockTitle=<?php if (isset($one_block['id'])) {
                        echo $one_block['id'];
                    } ?>"  style="background-image:url(<?php echo get_template_directory_uri() ?>/style/pagebuilder/add_block.png);"></a>
                    <div class="style-preview" style="background-image:url(<?php echo get_template_directory_uri() ?>/style/pagebuilder/<?php echo $key ?>.png);background-repeat:no-repeat;background-position: top;width: 122px;height: 120px;float: left;"></div>
                </div>
            <?php } // end foreach options    ?>

        </div>

        <?php
        if ($tab == 'home_builder') {
            echo '<div id="accordion">';
        }
        $args = array(
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post_type' => 'page_builder',
            'order' => 'ASC',
            'meta_key' => 'tk_box_order',
            'orderby' => 'meta_value_num',
        );

        //The Query
        query_posts($args);

        //The Loop
        if (have_posts()) : while (have_posts()) : the_post();
            $block_type = get_the_title($post->ID);
            foreach ($r3['options'] as $build_block) {
                if ($block_type == $build_block['id']) {
                    echo '<div class="group">
                                                                <h3>' . $build_block['label'] . '</h3>
                                                                    <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_' . $post->ID . '" id="post_order_' . $post->ID . '" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home_builder&blockID=' . $post->ID . '"><img src="' . get_template_directory_uri() . '/style/img/widget-delete.png" class="delete-block"/></a>';

                    if ($build_block['type'] == 'columns') {
                        tk_builder_columns($post->ID, $build_block);
                    } else {
                        foreach ($build_block['fields'] as $build_block_fields) {
                            // call builder label block
                            if ($build_block_fields['type'] == 'label') {
                                tk_builder_label($post->ID, $build_block_fields);
                            }
                            // call builder text block
                            if ($build_block_fields['type'] == 'text') {
                                tk_builder_text($post->ID, $build_block_fields);
                            }
                            // call builder text block
                            if ($build_block_fields['type'] == 'category') {
                                tk_builder_categories($post->ID, $build_block_fields);
                            }
                            // call builder select block
                            if ($build_block_fields['type'] == 'select') {
                                tk_builder_select($post->ID, $build_block_fields);
                            }
                            // call builder posts block
                            if ($build_block_fields['type'] == 'posts') {
                                tk_builder_posts($post->ID, $build_block_fields);
                            }
                            // call builder checkbox block
                            if ($build_block_fields['type'] == 'checkbox') {
                                tk_builder_checkbox($post->ID, $build_block_fields);
                            }
                            // call builder colorpicker block
                            if ($build_block_fields['type'] == 'colorpicker') {
                                tk_builder_colorpicker($post->ID, $build_block_fields);
                            }
                        } // end foreach for blocks
                    } // end if check if it's columns
                    echo '</div>
                                                            </div>';
                } // end if block type same as option name
            } // end foreach for array options
        endwhile;
        endif;
    }
        /*
         * PAGEBUILDER BETTER ONE STATE
         */
    }
    }
    }
        $row_items++;
    }
    }
    }
        ?>
        <script type="text/javascript">
            jQuery(function($){
                /*
                 Select changer
                 */
                jQuery('.field-select').on('change', function() {
                    builder_post_id = jQuery('select', this).attr('rel');
                    builder_post_name = jQuery('select', this).val();
                    console.log(builder_post_id);
                    console.log(builder_post_name);

                    $('div', this).attr('style', 'display:none');
                    $(".subfield-"+builder_post_name+"-"+builder_post_id, this).attr('style', 'display:block');
                });
            });


            jQuery(function() {
                jQuery( "#accordion" )
                    .accordion({
                        header: "> div > h3",
                        heightStyle: "content"
                    })
                    .sortable({
                        axis: "y",
                        handle: "h3",
                        stop: function( event, ui ) {

                            // IE doesn't register the blur when sorting
                            // so trigger focusout handlers to remove .ui-state-focus
                            ui.item.children( "h3" ).triggerHandler( "focusout" );
                        },
                        update: function(event, ui) {

                            var current_order = 0;
                            if ( jQuery('.post_order')[0] ) {
                                jQuery(function () {
                                    jQuery(".post_order").each(function() {
                                        //var order_id = jQuery(this).parent().attr('id');
                                        jQuery(this).val(current_order);
                                        current_order++
                                    });
                                });
                            }

                        }
                    });
            });
        </script>
        <?php
        if ($tab != 'home_builder') {
            echo '</table>';
        } else {
            echo '</div>';
        };
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