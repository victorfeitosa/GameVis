<?php
/************************************************************/
/*                                                          */
/*   Adds support for WordPress background change           */
/*                                                          */
/************************************************************/

add_action( 'init', 'post_types_adding' );

function post_types_adding() {

    /************************************************************/
    /*                                                          */
    /*   SIDEBAR POST TYPE                                      */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Sidebars', 'tkingdom'),
        'singular_name' => __('Sidebars', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Sidebar', 'tkingdom'),
        'edit_item' => __('Edit Sidebar', 'tkingdom'),
        'new_item' => __('New Sidebar', 'tkingdom'),
        'all_items' => __('All Sidebars', 'tkingdom'),
        'view_item' => __('View this Sidebar', 'tkingdom'),
        'search_items' => __('Search Sidebars', 'tkingdom'),
        'not_found' =>  __('No Sidebars', 'tkingdom'),
        'not_found_in_trash' => __('No Sidebars in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Sidebars', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_ui' => false,
        'show_in_nav_menus' => false,
        'show_in_menu' => false,
        'show_in_admin_bar' => false,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'sidebars'),
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
    ); // end $args
    register_post_type('sidebars',$args);

    /************************************************************/
    /*                                                          */
    /*   ADVERTISEMENT POST TYPE                                */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Advertising', 'tkingdom'),
        'singular_name' => __('Advertising', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Ad', 'tkingdom'),
        'edit_item' => __('Edit Ad', 'tkingdom'),
        'new_item' => __('New Ad', 'tkingdom'),
        'all_items' => __('All Ads', 'tkingdom'),
        'view_item' => __('View this Ad', 'tkingdom'),
        'search_items' => __('Search Ads', 'tkingdom'),
        'not_found' =>  __('No Ads', 'tkingdom'),
        'not_found_in_trash' => __('No Ads in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Advertising', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'advertisement'),
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => get_template_directory_uri().'/theme-images/advert-icon.png',
        'supports' => array('title', 'thumbnail'),
    ); // end $args
    register_post_type('advertisement',$args);


    /************************************************************/
    /*                                                          */
    /*   Remove rewrite rules and then recreate rewrite rules   */
    /*                                                          */
    /************************************************************/
    flush_rewrite_rules();
}

function add_custom_taxonomies() {

}
add_action( 'init', 'add_custom_taxonomies', 0 );
?>