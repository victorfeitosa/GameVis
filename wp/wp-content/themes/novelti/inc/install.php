<?php
global $wpdb;

$create_table_query = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."banner_stats` (
  `stat_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `banner_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `clicks` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL,
  PRIMARY KEY (`stat_id`),
  KEY `banner_id` (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($create_table_query, true);

// Insert Table for Rating system
$create_rating_table = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."user_rating` (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    userip tinytext NOT NULL,
    userrate text NOT NULL,
    postid text NOT NULL,
    UNIQUE KEY id (id)
);";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($create_rating_table, true);

tk_populate_initial_theme_settings_data();
?>