<?php
$tabs = '';

function tk_populate_initial_theme_settings_data() {
    require_once('admin-settings.php');
    $i = 0;
    $last_val = '';
    $tab_name = '';
    
    if(!empty($tabs)){
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
}

if (isset($_GET['tab'])) {
    if ($_GET['tab'] == 'home') {
        foreach ($_POST as $var => $value) {
            if (!preg_match("/post_order_/i", $var)) {
                update_option($var, $value);
            } else {
                $post_id = str_replace('post_order_', '', $var);
                update_post_meta($post_id, 'tk_box_order', $value);
            }
        } // foreach
    } // if
}
if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {
    tk_theme_install();
}

function tk_theme_install() {
    global $wpdb;
    //populate_theme_options(); //populate options from file
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
    wp_register_script('jscolor', get_template_directory_uri() . '/script/jscolor/jscolor.js');
    wp_enqueue_script('jscolor');
    wp_enqueue_script('jquery-ui-datepicker');
}

function my_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
}

function my_admin_styles() {
    wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_general_admin_scripts');

function admincss() {
    wp_register_style('admin-style', get_template_directory_uri() . '/inc/admin.css');
    wp_enqueue_style('admin-style');
}

add_action('admin_enqueue_scripts', 'admincss');


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
        if ($last_val != $tab['pg']) {
            $pages[] = $tab['pg'];
            $last_val = $tab['pg'];
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
                var getRev = jQuery(this).attr('rev');
                
                jQuery("body").append("<div id='screenshot'><img src="+getRev+" alt='preview'/><br />"+ getRel +"</div>");
                jQuery("#screenshot")
                .css("top",(e.pageY - xOffset) + "px")
                .css("left",(e.pageX + yOffset) + "px")
                .fadeIn("fast", function() {
        // Animation complete
      });
            },
            function(){
                this.title = this.t;
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
            if(n>2) { jQuery('.custom_repeatable li .repeatable-remove').attr('style', 'display:inline');}
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
                if(n>2) { jQuery('.custom_repeatable li .repeatable-remove').attr('style', 'display:inline');}
                return false;
            });
            var relval = '';
            jQuery('.repeatable-remove').click(function(){
                jQuery(this).parent().remove();
                relval = jQuery(this).attr('rel');       
                var n = jQuery('.custom_repeatable li').length;
                if(n>'1') { jQuery('.custom_repeatable li:first-child .repeatable-remove').attr('style', 'display:none');}
                return false;
            });
                                                                
                                                                



    <?php

    function check_is_admin_post() {
        global $typenow;
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


    <?php
}

add_action('admin_menu', 'tk_settings_page_init');

function tk_settings_page_init() {
    global $wp_version;
    $tk_theme_name = get_option('tk_theme_name');
    $pages = @get_all_pages();
    $theme_data = wp_get_theme(TEMPLATEPATH . '/style.css');
    $settings_page = '';
    for ($i = 0; $i <= count($pages) - 1; $i++) {
        if ($i == 0) {
            $settings_page .= add_menu_page($pages[$i]['slug'], ucfirst(tk_theme_name), 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        } else {
            $settings_page .= add_submenu_page($pages[0]['slug'], $pages[$i]['page_title'], $pages[$i]['menu_title'], 'edit_theme_options', $pages[$i]['slug'], 'tk_settings_page');
        }
    }
    $settings_page .= add_submenu_page(@$pages[0]['slug'], 'Help', 'Help', 'edit_theme_options', 'tk_help_redirect', 'tk_theme_help');
}

add_action('init', 'tk_theme_help_redirect');

function tk_theme_help_redirect() {
    if (isset($_GET['page']) && $_GET['page'] == 'tk_help_redirect') {
        wp_redirect('http://www.themeskingdom.com/docs/' . strtolower(tk_theme_name()) . '/');
        exit;
    }
}

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

    if ($required_error == 0) {
        tk_save_theme_settings();
        $url_parameters = isset($tab) ? 'updated=true&tab=' . $tab : 'updated=true';
    } else {
        $url_parameters = isset($tab) ? 'error=true&tab=' . $tab : 'error=true';
    }
    wp_redirect(admin_url('admin.php?page=' . $_GET['page'] . '&' . $url_parameters));
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
            if ($tab == 'sidebars' || $tab == 'home') {
                if ($_POST && $tab == 'sidebars') {
                    $widget_post = array(
                        'post_title' => $_POST['widget_area'],
                        'post_status' => 'publish',
                        'post_type' => 'sidebars'
                    );

                    wp_insert_post($widget_post);
                } elseif (isset($_POST['page_builder']) && $_POST && $tab == 'home') {
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

                    if ($tab != 'home') {
                        echo '<table class="form-table">';
                    }



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

                                            if ($r3['type'] == 'text') {//TYPE: TEXT
                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "' . $r3['options']['size'] . '"';
                                                } else {
                                                    $size = '';
                                                }
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }


                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                                                                        <td>
                                                                            <input id="' . $r3['id'] . '" name="' . $r3['name'] . '" type="' . $r3['type'] . '" value="' . htmlspecialchars(stripslashes($val)) . '" ' . @$r3['options']['readonly'] . ' ' . $size . ' />
                                                                            <span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'label') {//TYPE: LABEL
                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "' . $r3['options']['size'] . '"';
                                                } else {
                                                    $size = '';
                                                }
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }


                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'colorpicker') {//TYPE: COLORPICKER
                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "' . $r3['options']['size'] . '"';
                                                } else {
                                                    $size = '';
                                                }


                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
                                                ?>

                                                <script type="text/javascript">
                                                    jQuery(document).ready(function(){
                                                        jQuery('#button_<?php echo $r3['id'] ?>').live('click', function(){
                                                            jQuery('#<?php echo $r3['id'] ?>').val('<?php echo $r3['value'] ?>');
                                                        })
                                                    })
                                                </script>

                                                <?php
                                            }

                                            if ($r3['type'] == 'datepicker') {//TYPE: DATEPICKER
                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "' . $r3['options']['size'] . '"';
                                                } else {
                                                    $size = '';
                                                }


                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'hidden') {//TYPE: HIDDEN
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'password') {//TYPE: PASSWORD
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'radio') {//TYPE: RADIO
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'checkbox') {//TYPE: CHECKBOX
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                    @$val_database = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'select') {//TYPE: SELECT
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                echo '<tr>
                                                                        <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                                                                        <td>
                                                                            <select name="' . $r3['name'] . '" id="' . $r3['id'] . '">';

                                                for ($i = 0; $i < (count($r3['value'])); $i++) {
                                                    if ($r3['value'][$i][1] == $val) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    echo '<option value="' . $r3['value'][$i][1] . '" ' . $selected . '>' . $r3['value'][$i][0] . '</option>';
                                                }


                                                echo '</select>
                                                                            <span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }


                                            //TYPE: STYLE CHANGER
                                            if ($r3['type'] == 'stylechanger') {
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                ?>
                                                <div class="option-section" style="max-width: 960px;">

                                                    <?php
                                                    foreach ($r3['styles'] as $styleobject) {
                                                        if ($styleobject == $val) {
                                                            $checked = 'checked="checked"';
                                                        } else {
                                                            $checked = '';
                                                        }
                                                        ?>
                                                        <div class="one-style" style="display: inline-block;margin: 50px 12px 10px 12px">
                                                            <input type="radio" name="<?php echo $r3['name']; ?>" style="display: inline-block;position: relative;left: 50%;top: -170px;" value="<?php echo $styleobject; ?>"  class="style-radio" <?php echo $checked ?> >
                                                            <div class="style-preview" style="background-image:url(<?php echo get_template_directory_uri() ?>/style/stylechanger/<?php echo $styleobject ?>.png);background-position: center center;width: 150px;height: 150px;display: inline-block;border:1px solid #DFDFDF"></div>
                                                        </div>
                                                    <?php } ?>
                                                    <label class="option-description"><?php echo $r3['description'] ?></label>
                                                </div>
                                                <?php
                                            }


                                            if ($r3['type'] == 'textarea') {//TYPE: TEXTAREA
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'file') {//TYPE: FILE
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {

                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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


                                            if ($r3['type'] == 'file_image') {//TYPE: FILE IMAGE
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {

                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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

                                            if ($r3['type'] == 'hr') {//TYPE: HR (horizontal line)
                                                echo '<tr valign="top">
                                                        <td colspan="2"><hr class="hr2" style="background-color: ' . @$r3['options']['color'] . ';color: ' . @$r3['options']['color'] . ';width: ' . @$r3['options']['width'] . ';height: 1px;border: 0 none;"></td>
                                                      </tr>';
                                            }

                                            if ($r3['type'] == 'button') {//TYPE: button (custom button)
                                                echo '<tr valign="top">
                                                        <td colspan="2" style="margin-left:0;padding-left:0"><input type="button" class="button-secondary" value="' . $r3['value'] . '" name="' . $r3['name'] . '" id="' . $r3['id'] . '"/></td>
                                                      </tr>';
                                            }

                                            if ($r3['type'] == 'pages') {//TYPE: dropdown Pages
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
                                                '<span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            /*                                             * ********************************* */
                                            /*                                             * *****DROP DOWN POSTS********* */
                                            /*                                             * ********************************* */
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

                                            if ($r3['type'] == 'posts') {
                                                global $wpdb;
                                                $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '" . $r3['post_type'] . "'");
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                if (!isset($selected)) {
                                                    $selected = '';
                                                }
                                                echo '<tr>
                                                            <th><label>' . $required . '' . $r3['label'] . '</label>' . $dev . '</th>
                                                            <td><select name="' . $r3['name'] . '">';
                                                echo '<option value="none"' . $selected . '>None</option>';
                                                foreach ($posts as $post) {
                                                    if ($val == $post->ID) {
                                                        $selected = 'selected';
                                                    } else {
                                                        $selected = '';
                                                    };

                                                    echo '<option value="' . $post->ID . '"' . $selected . '>' . $post->post_title . '</option>';
                                                }
                                                '</select><span class="description"><br />' . $r3['desc'] . '</span>
                                                                </td>
                                                        </tr>';
                                            }

                                            if ($r3['type'] == 'category') {//TYPE: dropdown Categories
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
                                                    'name' => $r3['name']);
                                                wp_dropdown_categories($args);
                                                '<span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'author') {//TYPE: dropdown Authors
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
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
                                                '<span class="description"><br />' . $r3['desc'] . '</span>
                                                                            ' . $required_hidden_field . '
                                                                        </td>
                                                                    </tr>';
                                            }

                                            if ($r3['type'] == 'widgetareas') {//TYPE: SIDEBARS
                                                global $post;


                                                if (isset($r3['options']['size'])) {
                                                    $size = 'size = "' . $r3['options']['size'] . '"';
                                                } else {
                                                    $size = '';
                                                }
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }

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
                                                        ?>



                                                        <tr class="class-<?php echo $post->ID; ?>">

                                                            <th></th>
                                                            <td>
                                                                <div class="widget tk-widget-admin">

                                                                    <h4><?php the_title(); ?></h4>                            
                                                                    <a href="admin.php?page=theme-settings&tab=sidebars&widgetID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" /></a>
                                                                </div>

                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $i++;
                                                    endwhile;
                                                endif;
                                            }

                                            /*
                                             * PAGEBUILDER WORKING STATE
                                             */
                                            if ($r3['type'] == 'page_builder') {//TYPE: PAGE BUILDER
                                                global $post;
                                                if (get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']) != '') {
                                                    $val = get_option($tk_theme_name . '_' . $tab . '_' . $r3['name']);
                                                } else {
                                                    $val = $r3['value'];
                                                }
                                                ?>
                                                <h2 style="margin-left:25px"><?php _e('Page builder allows you to create unique homepage in just few clicks. </br>Simply add and drag-and-drop elements on desired position.', tk_theme_name) ?></h2>

                                                <div class="option-section page-builder-holder">

                                                    <?php
                                                    $i = 0;
                                                    foreach ($r3['options'] as $key => $one_block) {
                                                        if ($i == 0) {
                                                            $checked = 'checked="checked"';
                                                        } else {
                                                            $checked = '';
                                                        }
                                                        $i++;


                                                        switch ($one_block) {
                                                            case 'Flex Slider':
                                                                $info_text = 'Flex slider: Full content width slider';
                                                                $img_link = get_template_directory_uri()."/style/img/1_page_builder_prev.jpg";
                                                                break;
                                                            case 'Caruousel Slider':
                                                                $info_text = 'Carousel slider: Featured posts rotating slider';
                                                                $img_link = get_template_directory_uri()."/style/img/2_page_builder_prev.jpg";
                                                                break;
                                                            case 'Ad Banner':
                                                                $info_text = 'Banners: Horizontal banner';
                                                                $img_link = get_template_directory_uri()."/style/img/3_page_builder_prev.jpg";
                                                                break;
                                                            case 'Page Content':
                                                                $info_text = 'Page content: Content that is displayed on specific pages';
                                                                $img_link = get_template_directory_uri()."/style/img/4_page_builder_prev.jpg";
                                                                break;
                                                            case 'Full Width Post Type 1':
                                                                $info_text = 'Full width single post 1: Single post on full width page with featured image';
                                                                $img_link = get_template_directory_uri()."/style/img/5_page_builder_prev.jpg";
                                                                break;
                                                            case 'Full Width Post Type 2':
                                                                $info_text = 'Full width single post 2: Single post with featured image on the left';
                                                                $img_link = get_template_directory_uri()."/style/img/6_page_builder_prev.jpg";
                                                                break;
                                                            case 'Two Columns From One Category Type 1':
                                                                $info_text = 'Two columns for one category type 1: Shortened posts from one category with featured images';
                                                                $img_link = get_template_directory_uri()."/style/img/7_page_builder_prev.jpg";
                                                                break;
                                                            case 'Two Columns From Two Categories Type 1':
                                                                $info_text = 'Two columns for two category types 1: Shortened posts from two categories with featured images';
                                                                $img_link = get_template_directory_uri()."/style/img/8_page_builder_prev.jpg";
                                                                break;
                                                            case 'Two Columns From One Category Type 2':
                                                                $info_text = 'Two columns for one category type  2: Posts title from one category with featured images';
                                                                $img_link = get_template_directory_uri()."/style/img/9_page_builder_prev.jpg";
                                                                break;
                                                            case 'Two Columns From Two Categories Type 2':
                                                                $info_text = 'Two columns for two category types 2: Posts title from two categories with featured images';
                                                                $img_link = get_template_directory_uri()."/style/img/10_page_builder_prev.jpg";
                                                                break;
                                                        }
                                                        ?>

                                                        <div class="one-style" rel="<?php echo $info_text; ?>" rev="<?php echo $img_link; ?>" style="display: inline-block;margin: 30px 20px 10px 20px;width:122px;height:122px;">
                                                            <a class="add_block_link" href="admin.php?page=theme-settings&tab=home&addBlock=1&blockTitle=<?php echo $one_block; ?>"  style="background-image:url(<?php echo get_template_directory_uri() ?>/style/pagebuilder/add_block.png);"></a>
                                                            <div class="style-preview" style="background-image:url(<?php echo get_template_directory_uri() ?>/style/pagebuilder/<?php echo $key ?>.png);background-repeat:no-repeat;background-position: top;width: 122px;height: 120px;float: left;"></div>
                                                        </div>
                                                    <?php } // end foreach options     ?>

                                                    <label class="option-description"><?php echo $r3['description'] ?></label>
                                                </div>

                                                <?php
                                                if ($tab == 'home') {
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
                                                /*
                                                  if (count(query_posts($args)) == 0) {
                                                  wp_reset_query();
                                                  $args = array(
                                                  'post_status' => 'publish',
                                                  'posts_per_page' => -1,
                                                  'post_type' => 'page_builder',
                                                  'order' => 'ASC',
                                                  );
                                                  } */
                                                query_posts($args);


                                                //The Loop
                                                if (have_posts()) : while (have_posts()) : the_post();
                                                        $block_type = get_the_title($post->ID);
                                                        /*
                                                         * FLEX SLIDER
                                                         */
                                                        ?>
                                                        <?php
                                                        if ($block_type == 'Flex Slider') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <?php
                                                                    /*
                                                                     * Category select
                                                                     */
                                                                    $flex_selected_category = get_option('flex-slider-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Please select Category for Flex Slider', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'show_option_all' => __('All Categories', tk_theme_name),
                                                                        'selected' => $flex_selected_category,
                                                                        'echo' => 1,
                                                                        'taxonomy' => 'category',
                                                                        'name' => 'flex-slider-' . $post->ID);
                                                                    wp_dropdown_categories($args);
                                                                    ?>
                                                                    <?php
                                                                    /*
                                                                     * Number of posts
                                                                     */
                                                                    $flex_post_number = get_option('flex-post-number-' . $post->ID);
                                                                    if ($flex_post_number == '') {
                                                                        $flex_post_number = 10;
                                                                    }
                                                                    ?> 
                                                                    <div class="margin-bot-10"></div>
                                                                    <p><?php _e('Enter Number of Post to show in Flex Slider', tk_theme_name) ?></p>
                                                                    <input id="flex-post-number-<?php echo $post->ID ?>" name="flex-post-number-<?php echo $post->ID ?>" type="text" value="<?php echo $flex_post_number ?>"/>
                                                                    <?php
                                                                    /*
                                                                     * Pause Time
                                                                     */
                                                                    $flex_pause_time = get_option('flex-pause-time-' . $post->ID);
                                                                    if ($flex_pause_time == '') {
                                                                        $flex_pause_time = 7000;
                                                                    }
                                                                    ?> 
                                                                    <div class="margin-bot-10"></div>
                                                                    <p><?php _e('Slider pause time', tk_theme_name) ?></p>
                                                                    <input id="flex-pause-time-<?php echo $post->ID ?>" name="flex-pause-time-<?php echo $post->ID ?>" type="text" value="<?php echo $flex_pause_time ?>"/>
                                                                    <?php
                                                                    /*
                                                                     * Animation Time
                                                                     */
                                                                    $flex_animation_time = get_option('flex-animation-time-' . $post->ID);
                                                                    if ($flex_animation_time == '') {
                                                                        $flex_animation_time = 600;
                                                                    }
                                                                    ?> 
                                                                    <div class="margin-bot-10"></div>
                                                                    <p><?php _e('Slider animation time', tk_theme_name) ?></p>
                                                                    <input id="flex-animation-time-<?php echo $post->ID ?>" name="flex-animation-time-<?php echo $post->ID ?>" type="text" value="<?php echo $flex_animation_time ?>"/>
                                                                    <?php
                                                                    /*
                                                                     * Select easing effect
                                                                     */
                                                                    $flex_easing = get_option('flex-easing-' . $post->ID);
                                                                    ?>
                                                                    <div class="margin-bot-10"></div>
                                                                    <p><?php _e('Chose slider easing effect', tk_theme_name) ?></p>
                                                                    <select name="flex-easing-<?php echo $post->ID ?>" id="flex-easing-<?php echo $post->ID ?>">
                                                                        <option value="linear" <?php
                                                if ($flex_easing == 'linear') {
                                                    echo 'selected';
                                                }
                                                                    ?>>linear</option>
                                                                        <option value="easeInCirc" <?php
                                                if ($flex_easing == 'easeInCirc') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInCirc</option>
                                                                        <option value="easeOutCirc" <?php
                                                if ($flex_easing == 'easeOutCirc') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutCirc</option>
                                                                        <option value="easeInCubic" <?php
                                                if ($flex_easing == 'easeInCubic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInCubic</option>
                                                                        <option value="easeOutCubic" <?php
                                                if ($flex_easing == 'easeOutCubic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutCubic</option>
                                                                        <option value="easeInOutCubic" <?php
                                                if ($flex_easing == 'easeInOutCubic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutCubic</option>
                                                                        <option value="easeInElastic" <?php
                                                if ($flex_easing == 'easeInElastic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInElastic</option>
                                                                        <option value="easeOutElastic" <?php
                                                if ($flex_easing == 'easeOutElastic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutElastic</option>
                                                                        <option value="easeInOutElastic" <?php
                                                if ($flex_easing == 'easeInOutElastic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutElastic</option>
                                                                        <option value="easeInBack" <?php
                                                if ($flex_easing == 'easeInBack') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInBack</option>
                                                                        <option value="easeOutBack" <?php
                                                if ($flex_easing == 'easeOutBack') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutBack</option>
                                                                        <option value="easeInOutBack" <?php
                                                if ($flex_easing == 'easeInOutBack') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutBack</option>
                                                                        <option value="easeInBounce" <?php
                                                if ($flex_easing == 'easeInBounce') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInBounce</option>
                                                                        <option value="easeOutBounce" <?php
                                                if ($flex_easing == 'easeOutBounce') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutBounce</option>
                                                                        <option value="easeInOutBounce" <?php
                                                if ($flex_easing == 'easeInOutBounce') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutBounce</option>
                                                                    </select>
                                                                    <?php
                                                                    /*
                                                                     * Select slider effect
                                                                     */
                                                                    $flex_effect = get_option('flex-effect-' . $post->ID);
                                                                    ?>
                                                                    <div class="margin-bot-10"></div>
                                                                    <p><?php _e('Chose Flex Slider Effect', tk_theme_name) ?></p>
                                                                    <select name="flex-effect-<?php echo $post->ID ?>" id="flex-effect-<?php echo $post->ID ?>" style="margin-bottom: 20px">
                                                                        <option value="slide" <?php
                                                if ($flex_effect == 'slide') {
                                                    echo 'selected';
                                                }
                                                                    ?>>slide</option>
                                                                        <option value="fade" <?php
                                                if ($flex_effect == 'fade') {
                                                    echo 'selected';
                                                }
                                                                    ?>>fade</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            /*
                                                             * CAROUSEL SLIDER
                                                             */
                                                        } elseif ($block_type == 'Caruousel Slider') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        


                                                                    <?php
                                                                    /*
                                                                     * Category select
                                                                     */
                                                                    $carousel_selected_category = get_option('carousel-slider-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Please select Category for Carousel Slider', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'show_option_all' => __('All Categories', tk_theme_name),
                                                                        'selected' => $carousel_selected_category,
                                                                        'echo' => 1,
                                                                        'taxonomy' => 'category',
                                                                        'name' => 'carousel-slider-' . $post->ID);
                                                                    wp_dropdown_categories($args);
                                                                    ?>
                                                                    <?php
                                                                    /*
                                                                     * Number of posts
                                                                     */
                                                                    $carousel_post_number = get_option('carousel-post-number-' . $post->ID);
                                                                    if ($carousel_post_number == '') {
                                                                        $carousel_post_number = 10;
                                                                    }
                                                                    ?> 
                                                                    <p><?php _e('Enter Number of Post to show in Carousel Slider', tk_theme_name) ?></p>
                                                                    <input id="carousel-post-number-<?php echo $post->ID ?>" name="carousel-post-number-<?php echo $post->ID ?>" type="text" value="<?php echo $carousel_post_number ?>"/>
                                                                    <?php
                                                                    /*
                                                                     * Animation Time
                                                                     */
                                                                    $carousel_animation_time = get_option('carousel-animation-time-' . $post->ID);
                                                                    if ($carousel_animation_time == '') {
                                                                        $carousel_animation_time = 600;
                                                                    }
                                                                    ?> 
                                                                    <p><?php _e('Slider animation time', tk_theme_name) ?></p>
                                                                    <input id="carousel-animation-time-<?php echo $post->ID ?>" name="carousel-animation-time-<?php echo $post->ID ?>" type="text" value="<?php echo $carousel_animation_time ?>"/>
                                                                    <?php
                                                                    /*
                                                                     * Select easing effect
                                                                     */
                                                                    $carousel_easing = get_option('carousel-easing-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Chose slider easing effect', tk_theme_name) ?></p>
                                                                    <select name="carousel-easing-<?php echo $post->ID ?>" id="carousel-easing-<?php echo $post->ID ?>"  style="margin-bottom: 20px">
                                                                        <option value="linear" <?php
                                                if ($carousel_easing == 'linear') {
                                                    echo 'selected';
                                                }
                                                                    ?>>linear</option>
                                                                        <option value="easeInCirc" <?php
                                                if ($carousel_easing == 'easeInCirc') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInCirc</option>
                                                                        <option value="easeOutCirc" <?php
                                                if ($carousel_easing == 'easeOutCirc') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutCirc</option>
                                                                        <option value="easeInCubic" <?php
                                                if ($carousel_easing == 'easeInCubic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInCubic</option>
                                                                        <option value="easeOutCubic" <?php
                                                if ($carousel_easing == 'easeOutCubic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutCubic</option>
                                                                        <option value="easeInOutCubic" <?php
                                                if ($carousel_easing == 'easeInOutCubic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutCubic</option>
                                                                        <option value="easeInElastic" <?php
                                                if ($carousel_easing == 'easeInElastic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInElastic</option>
                                                                        <option value="easeOutElastic" <?php
                                                if ($carousel_easing == 'easeOutElastic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutElastic</option>
                                                                        <option value="easeInOutElastic" <?php
                                                if ($carousel_easing == 'easeInOutElastic') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutElastic</option>
                                                                        <option value="easeInBack" <?php
                                                if ($carousel_easing == 'easeInBack') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInBack</option>
                                                                        <option value="easeOutBack" <?php
                                                if ($carousel_easing == 'easeOutBack') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutBack</option>
                                                                        <option value="easeInOutBack" <?php
                                                if ($carousel_easing == 'easeInOutBack') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutBack</option>
                                                                        <option value="easeInBounce" <?php
                                                if ($carousel_easing == 'easeInBounce') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInBounce</option>
                                                                        <option value="easeOutBounce" <?php
                                                if ($carousel_easing == 'easeOutBounce') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeOutBounce</option>
                                                                        <option value="easeInOutBounce" <?php
                                                if ($carousel_easing == 'easeInOutBounce') {
                                                    echo 'selected';
                                                }
                                                                    ?>>easeInOutBounce</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            /*
                                                             * Ad Banner
                                                             */
                                                        } elseif ($block_type == 'Ad Banner') {
                                                            ?>

                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        


                                                                    <?php
                                                                    /*
                                                                     * Post select
                                                                     */
                                                                    $ad_post = get_option('ad-post-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Please select Ad', tk_theme_name) ?></p>
                                                                    <?php
                                                                    global $wpdb;
                                                                    $posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'advertisement'");
                                                                    ?>
                                                                    <select name="ad-post-<?php echo $post->ID ?>" style="margin-bottom: 20px">
                                                                        <?php
                                                                        foreach ($posts as $post) {
                                                                            if ($ad_post == $post->ID) {
                                                                                $selected = 'selected';
                                                                            } else {
                                                                                $selected = '';
                                                                            };
                                                                            ?>
                                                                            <option value="<?php echo $post->ID ?>" <?php echo $selected ?>><?php echo $post->post_title ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * Page Content
                                                             */
                                                        } elseif ($block_type == 'Page Content') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        


                                                                    <?php
                                                                    /*
                                                                     * Post select
                                                                     */
                                                                    $page_content = get_option('page-content-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Select from which page to show content', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'selected' => $page_content,
                                                                        'echo' => 1,
                                                                        'name' => 'page-content-' . $post->ID);
                                                                    wp_dropdown_pages($args);
                                                                    ?>

                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * one_cat_top
                                                             */
                                                        } elseif ($block_type == 'Full Width Post Type 1') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <?php
                                                                    /*
                                                                     * Category select
                                                                     */
                                                                    $one_cat_top = get_option('one_cat_top-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'show_option_all' => __('All Categories', tk_theme_name),
                                                                        'selected' => $one_cat_top,
                                                                        'echo' => 1,
                                                                        'taxonomy' => 'category',
                                                                        'name' => 'one_cat_top-' . $post->ID);
                                                                    wp_dropdown_categories($args);
                                                                    ?>
                                                                    <?php
                                                                    /*
                                                                     * Number of posts
                                                                     */
                                                                    $one_cat_top_number = get_option('one_cat_top-number-' . $post->ID);
                                                                    if ($one_cat_top_number == '') {
                                                                        $one_cat_top_number = 10;
                                                                    }
                                                                    ?> 
                                                                    <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                    <input id="one_cat_top-number-<?php echo $post->ID ?>" name="one_cat_top-number-<?php echo $post->ID ?>" type="text" value="<?php echo $one_cat_top_number ?>"/>

                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * one_cat_side
                                                             */
                                                        } elseif ($block_type == 'Full Width Post Type 2') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <?php
                                                                    /*
                                                                     * Category select
                                                                     */
                                                                    $one_cat_side = get_option('one_cat_side-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'show_option_all' => __('All Categories', tk_theme_name),
                                                                        'selected' => $one_cat_side,
                                                                        'echo' => 1,
                                                                        'taxonomy' => 'category',
                                                                        'name' => 'one_cat_side-' . $post->ID);
                                                                    wp_dropdown_categories($args);
                                                                    ?>
                                                                    <?php
                                                                    /*
                                                                     * Number of posts
                                                                     */
                                                                    $one_cat_side_number = get_option('one_cat_side-number-' . $post->ID);
                                                                    if ($one_cat_side_number == '') {
                                                                        $one_cat_side_number = 10;
                                                                    }
                                                                    ?> 
                                                                    <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                    <input id="one_cat_side-number-<?php echo $post->ID ?>" name="one_cat_side-number-<?php echo $post->ID ?>" type="text" value="<?php echo $one_cat_side_number ?>"/>

                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * two_col_top_one_cat
                                                             */
                                                        } elseif ($block_type == 'Two Columns From One Category Type 1') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <?php
                                                                    /*
                                                                     * Category select
                                                                     */
                                                                    $two_col_top_one_cat = get_option('two_col_top_one_cat-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'show_option_all' => __('All Categories', tk_theme_name),
                                                                        'selected' => $two_col_top_one_cat,
                                                                        'echo' => 1,
                                                                        'taxonomy' => 'category',
                                                                        'name' => 'two_col_top_one_cat-' . $post->ID);
                                                                    wp_dropdown_categories($args);
                                                                    ?>
                                                                    <?php
                                                                    /*
                                                                     * Number of posts
                                                                     */
                                                                    $two_col_top_one_cat_number = get_option('two_col_top_one_cat-number-' . $post->ID);
                                                                    if ($two_col_top_one_cat_number == '') {
                                                                        $two_col_top_one_cat_number = 10;
                                                                    }
                                                                    ?> 
                                                                    <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                    <input id="two_col_top_one_cat-number-<?php echo $post->ID ?>" name="two_col_top_one_cat-number-<?php echo $post->ID ?>" type="text" value="<?php echo $two_col_top_one_cat_number ?>"/>

                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * two_col_top_two_cat
                                                             */
                                                        } elseif ($block_type == 'Two Columns From Two Categories Type 1') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <div style="width:45%;margin-right: 1%;float: left;display: block">
                                                                        <?php
                                                                        /*
                                                                         * Category select
                                                                         */
                                                                        $two_col_top_two_cat_left = get_option('two_col_top_two_cat_left-' . $post->ID);
                                                                        ?>
                                                                        <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                        <?php
                                                                        $args = array(
                                                                            'show_option_all' => __('All Categories', tk_theme_name),
                                                                            'selected' => $two_col_top_two_cat_left,
                                                                            'echo' => 1,
                                                                            'taxonomy' => 'category',
                                                                            'name' => 'two_col_top_two_cat_left-' . $post->ID);
                                                                        wp_dropdown_categories($args);
                                                                        ?>
                                                                        <?php
                                                                        /*
                                                                         * Number of posts
                                                                         */
                                                                        $two_col_top_two_cat_left_number = get_option('two_col_top_two_cat_left-number-' . $post->ID);
                                                                        if ($two_col_top_two_cat_left_number == '') {
                                                                            $two_col_top_two_cat_left_number = 10;
                                                                        }
                                                                        ?> 
                                                                        <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                        <input id="two_col_top_two_cat_left-number-<?php echo $post->ID ?>" name="two_col_top_two_cat_left-number-<?php echo $post->ID ?>" type="text" value="<?php echo $two_col_top_two_cat_left_number ?>"/>
                                                                    </div>
                                                                    <div style="width:45%;margin-right: 1%;float: left;display: block">
                                                                        <?php
                                                                        /*
                                                                         * Category select
                                                                         */
                                                                        $two_col_top_two_cat_right = get_option('two_col_top_two_cat_right-' . $post->ID);
                                                                        ?>
                                                                        <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                        <?php
                                                                        $args = array(
                                                                            'show_option_all' => __('All Categories', tk_theme_name),
                                                                            'selected' => $two_col_top_two_cat_right,
                                                                            'echo' => 1,
                                                                            'taxonomy' => 'category',
                                                                            'name' => 'two_col_top_two_cat_right-' . $post->ID);
                                                                        wp_dropdown_categories($args);
                                                                        ?>
                                                                        <?php
                                                                        /*
                                                                         * Number of posts
                                                                         */
                                                                        $two_col_top_two_cat_right_number = get_option('two_col_top_two_cat_right-number-' . $post->ID);
                                                                        if ($two_col_top_two_cat_right_number == '') {
                                                                            $two_col_top_two_cat_right_number = 10;
                                                                        }
                                                                        ?> 
                                                                        <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                        <input id="two_col_top_two_cat_right-number-<?php echo $post->ID ?>" name="two_col_top_two_cat_right-number-<?php echo $post->ID ?>" type="text" value="<?php echo $two_col_top_two_cat_right_number ?>"/>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * two_col_side_one_cat
                                                             */
                                                        } elseif ($block_type == 'Two Columns From One Category Type 2') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <?php
                                                                    /*
                                                                     * Category select
                                                                     *
                                                                     */
                                                                    $two_col_side_one_cat = get_option('two_col_side_one_cat-' . $post->ID);
                                                                    ?>
                                                                    <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                    <?php
                                                                    $args = array(
                                                                        'show_option_all' => __('All Categories', tk_theme_name),
                                                                        'selected' => $two_col_side_one_cat,
                                                                        'echo' => 1,
                                                                        'taxonomy' => 'category',
                                                                        'name' => 'two_col_side_one_cat-' . $post->ID);
                                                                    wp_dropdown_categories($args);
                                                                    ?>
                                                                    <?php
                                                                    /*
                                                                     * Number of posts
                                                                     */
                                                                    $two_col_side_one_cat_number = get_option('two_col_side_one_cat-number-' . $post->ID);
                                                                    if ($two_col_side_one_cat_number == '') {
                                                                        $two_col_side_one_cat_number = 10;
                                                                    }
                                                                    ?> 
                                                                    <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                    <input id="two_col_side_one_cat-number-<?php echo $post->ID ?>" name="two_col_side_one_cat-number-<?php echo $post->ID ?>" type="text" value="<?php echo $two_col_side_one_cat_number ?>"/>

                                                                </div>
                                                            </div>

                                                            <?php
                                                            /*
                                                             * two_col_side_two_cat
                                                             */
                                                        } elseif ($block_type == 'Two Columns From Two Categories Type 2') {
                                                            ?>
                                                            <div class="group">
                                                                <h3><?php the_title(); ?></h3> 

                                                                <div class="widget blocks">
                                                                    <input type="hidden" name="post_order_<?php echo $post->ID; ?>" id="post_order_<?php echo $post->ID; ?>" class="post_order" value="" />
                                                                    <a href="admin.php?page=theme-settings&tab=home&blockID=<?php echo $post->ID; ?>"><img src="<?php echo get_template_directory_uri(); ?>/style/img/widget-delete.png" class="delete-block"/></a>                                                                        

                                                                    <div style="width:45%;margin-right: 1%;float: left;display: block">
                                                                        <?php
                                                                        /*
                                                                         * Category select
                                                                         */
                                                                        $two_col_side_two_cat_left = get_option('two_col_side_two_cat_left-' . $post->ID);
                                                                        ?>
                                                                        <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                        <?php
                                                                        $args = array(
                                                                            'show_option_all' => __('All Categories', tk_theme_name),
                                                                            'selected' => $two_col_side_two_cat_left,
                                                                            'echo' => 1,
                                                                            'taxonomy' => 'category',
                                                                            'name' => 'two_col_side_two_cat_left-' . $post->ID);
                                                                        wp_dropdown_categories($args);
                                                                        ?>
                                                                        <?php
                                                                        /*
                                                                         * Number of posts
                                                                         */
                                                                        $two_col_side_two_cat_left_number = get_option('two_col_side_two_cat_left-number-' . $post->ID);
                                                                        if ($two_col_side_two_cat_left_number == '') {
                                                                            $two_col_side_two_cat_left_number = 10;
                                                                        }
                                                                        ?> 
                                                                        <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                        <input id="two_col_side_two_cat_left-number-<?php echo $post->ID ?>" name="two_col_side_two_cat_left-number-<?php echo $post->ID ?>" type="text" value="<?php echo $two_col_side_two_cat_left_number ?>"/>
                                                                    </div>
                                                                    <div style="width:45%;margin-right: 1%;float: left;display: block">
                                                                        <?php
                                                                        /*
                                                                         * Category select
                                                                         */
                                                                        $two_col_side_two_cat_right = get_option('two_col_side_two_cat_right-' . $post->ID);
                                                                        ?>
                                                                        <p><?php _e('Select Category', tk_theme_name) ?></p>
                                                                        <?php
                                                                        $args = array(
                                                                            'show_option_all' => __('All Categories', tk_theme_name),
                                                                            'selected' => $two_col_side_two_cat_right,
                                                                            'echo' => 1,
                                                                            'taxonomy' => 'category',
                                                                            'name' => 'two_col_side_two_cat_right-' . $post->ID);
                                                                        wp_dropdown_categories($args);
                                                                        ?>
                                                                        <?php
                                                                        /*
                                                                         * Number of posts
                                                                         */
                                                                        $two_col_side_two_cat_right_number = get_option('two_col_side_two_cat_right-number-' . $post->ID);
                                                                        if ($two_col_side_two_cat_right_number == '') {
                                                                            $two_col_side_two_cat_right_number = 10;
                                                                        }
                                                                        ?> 
                                                                        <p><?php _e('Enter Number of Post to show', tk_theme_name) ?></p>
                                                                        <input id="two_col_side_two_cat_right-number-<?php echo $post->ID ?>" name="two_col_side_two_cat_right-number-<?php echo $post->ID ?>" type="text" value="<?php echo $two_col_side_two_cat_right_number ?>"/>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                        <?php
                                                    endwhile;
                                                endif;
                                            }
                                            /*
                                             * PAGEBUILDER WORKING STATE
                                             */
                                        }
                                    }
                                }
                                $row_items++;
                            }
                        }
                    }
                    ?>
                    <script>                                           
                        jQuery(function() {
                            jQuery( "#accordion" )
                            .accordion({
                                header: "> div > h3"
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
                    if ($tab != 'home') {
                        echo '</table>';
                    } else {
                        echo '</div>';
                    }
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
