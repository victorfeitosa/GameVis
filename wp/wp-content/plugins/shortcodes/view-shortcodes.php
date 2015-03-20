<?php
/********************************************************************************************************/
/*                                                                                                      */
/*   Adding administration page for Shortcodes                                                          */
/*                                                                                                      */
/********************************************************************************************************/
// create custom plugin settings menu
add_action('admin_menu', 'tk_create_shortcodes');

function tk_create_shortcodes()
{
    //create new submenu for options
    add_submenu_page('plugins', 'Shortcode Options', 'Shortcode Options', 'administrator', 'shortcodes-settings', 'tk_shortcodes_option_form');
}

//update options from form
global $pagenow;
if ($pagenow == 'admin.php' && isset($_POST['shortcodes-look'])) {
    update_option('shortcodes-look', $_POST['shortcodes-look']);
}

/*
 * function that enables option for shortcode style
 */
function tk_shortcodes_option_form()
{
    $selected_option = get_option('shortcodes-look');
    ?>
    <div class="wrap">
        <h2><?php _e('Shortcode Options', 'tkingdom')?></h2>

        <form method="post" action="<?php admin_url('admin.php?page=shortcodes-settings'); ?>">
            <table class="form-table">

                <tr valign="top">
                    <th scope="row"><?php _e('Shortcode Style', 'tkingdom')?></th>
                    <td>
                        <select id="shortcodes-look" name="shortcodes-look">
                            <option value="flat" <?php if($selected_option == 'flat'){echo 'selected';}?>><?php _e('Flat', 'tkingdom')?></option>
                            <option value="fancy" <?php if($selected_option == 'fancy'){echo 'selected';}?>><?php _e('Fancy', 'tkingdom')?></option>
                        </select>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>
    </div>
<?php } ?>