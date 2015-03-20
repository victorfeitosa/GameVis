<?php
/*
Plugin Name: ThemesKingdom Shortcodes
Plugin URI: http://www.themeskingdom.com/shortcodes
Description: Simple shortcodes that enables more functionality to the default WordPress editor.
Version: 1.0
Author: ThemesKingdom
Author URI: http://www.themeskingdom.com
License: Copyright (c) 2013 Themes Kingdom. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
*/

// Define paths
if(!defined('TK_SHORTCODE_DIR')) define( 'TK_SHORTCODE_DIR', plugin_dir_path(__FILE__) );
if(!defined('TK_SHORTCODE_URL')) define( 'TK_SHORTCODE_URL', plugin_dir_url(__FILE__) );
if(!defined('TK_WP_PATH')) define( 'TK_WP_PATH', ABSPATH );

    //require(TK_SHORTCODE_DIR . 'view-shortcodes.php');

    add_action('admin_init', 'tk_shortcode_header');
    function tk_shortcode_header()
    {
            wp_enqueue_script( 'jquery-livequery', TK_SHORTCODE_URL . 'js/jquery.livequery.js' );
            wp_enqueue_script( 'base64', TK_SHORTCODE_URL . 'js/base64.js' );
            wp_enqueue_script( 'popup', TK_SHORTCODE_URL . 'js/popup.js' );
            wp_enqueue_script( 'appendo', TK_SHORTCODE_URL . 'js/jquery.appendo.js' );
                        
            //wp_enqueue_script( 'bootstrap', TK_SHORTCODE_URL . 'js/bootstrap.min.js' );
            wp_register_style('tk-icons', TK_SHORTCODE_URL . 'css/icons.css');
            wp_enqueue_style('tk-icons');
            
            wp_register_style('tk-fa-icons', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');
            wp_enqueue_style('tk-fa-icons');
            
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );
    }

    add_action('init', 'tk_shortcode_add_button');
	function tk_shortcode_add_button()
	{
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', 'tk_shortcode_add_plugin' );
			add_filter( 'mce_buttons', 'tk_shortcode_mce_button' );
		}
	}
	function tk_shortcode_add_plugin( $plugin_array )
	{
		$plugin_array['shortcodes'] = TK_SHORTCODE_URL . 'plugin.js';
		return $plugin_array;
	}
	function tk_shortcode_mce_button( $buttons )
	{
		array_push( $buttons, "|", 'tk_button' );
		return $buttons;
	}

    /************************************************************/
    /*                                                          */
    /*   Add shortcode style                                    */
    /*                                                          */
    /************************************************************/
    function tk_shortcode_style() {
        wp_register_style('tk-shortcodes', TK_SHORTCODE_URL . 'css/tk-shortcodes.css');
        wp_enqueue_style('tk-shortcodes');

        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('sk-add-scripts', TK_SHORTCODE_URL.'js/tk-all-scripts.js', false, false, true );
        wp_enqueue_script('sk-call-scripts', TK_SHORTCODE_URL.'js/tk_shortcodes.js', false, false, true );

    }
    add_action( 'wp_enqueue_scripts', 'tk_shortcode_style' );

require(TK_SHORTCODE_DIR . '/shortcodes.php');

?>
