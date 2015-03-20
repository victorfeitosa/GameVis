<?php
/**
 * Provides a notification everytime the theme is updated
 * Original code courtesy of João Araújo of Unisphere Design - http://themeforest.net/user/unisphere
 */

function update_notifier_menu() {
    $notifier_data = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
    if($notifier_data == ''){
        $theme_data = wp_get_theme();
        $tk_exploded_data = explode(' ', $notifier_data);
        $tk_new_version = $tk_exploded_data[1];

        if(version_compare($theme_data['Version'], $tk_new_version) == -1) {
            add_dashboard_page( $theme_data['Name'] . 'Theme Updates', $theme_data['Name'] . '<span class="update-plugins count-1"><span class="update-count">'.$tk_new_version.'</span></span>', 'administrator', strtolower($theme_data['Name']) . '-updates', 'update_notifier');
        }
    } // if chagelog is available
}
add_action('admin_menu', 'update_notifier_menu');

function update_notifier() {
    $notifier_data = get_latest_theme_version(21600); // This tells the function to cache the remote call for 21600 seconds (6 hours)
    $theme_data = wp_get_theme();
    $tk_exploded_data = explode(' ', $notifier_data);
    $tk_new_version = $tk_exploded_data[1];
    ?>

    <style>
        .update-nag {display: none;}
        #instructions {max-width: 1200px;}
        h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
    </style>

    <div class="wrap">

        <div id="icon-tools" class="icon32"></div>
        <h2><?php echo $theme_data['Name']; _e('Theme Updates', 'tkingdom')?> </h2>
        <div id="message" class="updated below-h2"><p><strong><?php _e('There is a new version of the', 'tkingdom')?> <?php echo $theme_data['Name']; ?> <?php _e('theme available.', 'tkingdom')?></strong> <?php _e('You have version', 'tkingdom')?> <?php echo $theme_data['Version']; ?> <?php _e('installed. Update to version', 'tkingdom')?> <?php echo $tk_new_version ?>.</p></div>

        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd; max-width: 320px;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />

        <div id="instructions" style="max-width: 1200px;">
            <h3><?php _e('Update Download and Instructions', 'tkingdom')?></h3>
            <p><strong><?php _e('Update Download and Instructions', 'tkingdom')?></strong> <?php _e('make a', 'tkingdom')?> <strong><?php _e('backup', 'tkingdom')?></strong> <?php _e('of the Theme inside your WordPress installation folder', 'tkingdom')?> <strong>/wp-content/themes/<?php echo strtolower($theme_data['Name']); ?>/</strong></p>
            <p><?php _e('To update the Theme, login to your account, head over to your', 'tkingdom')?> <strong><?php _e('downloads', 'tkingdom')?></strong> <?php _e('section and re-download the theme like you did when you bought it.', 'tkingdom')?></p>
            <p><?php _e('Extract the zip\'s contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the', 'tkingdom')?> <strong>/wp-content/themes/<?php echo strtolower($theme_data['Name']); ?>/</strong> <?php _e('folder overwriting the old ones (this is why it\'s important to backup any changes you\'ve made to the theme files).', 'tkingdom')?></p>
            <p><?php _e('If you didn\'t make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.', 'tkingdom')?></p>
        </div>

        <div class="clear"></div>

        <h3 class="title"><?php _e('Changelog', 'tkingdom')?></h3>
        <?php
        $clean_notifier = str_replace('<!---->', '</br>', $notifier_data);
        echo $clean_notifier;
        ?>

    </div>

<?php }

// This function retrieves a remote xml file on my server to see if there's a new update 
// For performance reasons this function caches the xml content in the database for XX seconds ($interval variable)
function get_latest_theme_version($interval) {
    // remote xml file location
    $theme_data = wp_get_theme();
    $tk_theme_name = strtolower($theme_data['Name']);
    $notifier_file_url = 'http://www.themeskingdom.com/versioning.php?url=&xml='.$tk_theme_name;


    $db_cache_field = 'contempo-notifier-cache';
    $db_cache_field_last_updated = 'contempo-notifier-last-updated';
    $last = get_option( $db_cache_field_last_updated );
    $now = time();
    // check the cache
    if ( !$last || (( $now - $last ) > $interval) ) {
        // cache doesn't exist, or is old, so refresh it

        $notifier_file = wp_remote_get($notifier_file_url);
        $cache = $notifier_file['body'];

        if ($cache) {
            // we got good results
            update_option( $db_cache_field, $cache );
            update_option( $db_cache_field_last_updated, time() );
        }
        // read from the cache file
        $notifier_data = get_option( $db_cache_field );
    }
    else {
        // cache file is fresh enough, so read from it
        $notifier_data = get_option( $db_cache_field );
    }
    return $notifier_data;
}

?>