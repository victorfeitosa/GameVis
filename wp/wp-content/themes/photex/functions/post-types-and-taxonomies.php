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
    /*   GALLERY POST TYPE                                      */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Gallery', 'tkingdom'),
        'singular_name' => __('Gallery', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Gallery Item', 'tkingdom'),
        'edit_item' => __('Edit Gallery Item', 'tkingdom'),
        'new_item' => __('New Gallery Item', 'tkingdom'),
        'all_items' => __('All Gallery Items', 'tkingdom'),
        'view_item' => __('View this Gallery Item', 'tkingdom'),
        'search_items' => __('Search Gallery Items', 'tkingdom'),
        'not_found' =>  __('No Gallery Items', 'tkingdom'),
        'not_found_in_trash' => __('No Gallery Items in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Gallery', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'photo-gallery'),
        'hierarchical' => false,
        'menu_position' => null,
        'has_archive' => true,
        'menu_icon' => get_template_directory_uri().'/theme-images/gallery-icon.png',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'post-formats', 'comments' ),
        'taxonomies' => array('ct_gallery'),
    ); // end $args
    register_post_type('gallery',$args);

    
    /************************************************************/
    /*                                                          */
    /*   Remove rewrite rules and then recreate rewrite rules   */
    /*                                                          */
    /************************************************************/
    flush_rewrite_rules();
}

function add_custom_taxonomies() {

// GALLERY TAXONOMY
    register_taxonomy('ct_gallery', 'gallery', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Gallery Categories', 'taxonomy general name', 'tkingdom' ),
            'singular_name' => _x( 'Gallery Categories', 'taxonomy singular name', 'tkingdom' ),
            'search_items' => __( 'Search Gallery Categories', 'tkingdom' ),
            'all_items' => __( 'All Gallery Categories', 'tkingdom' ),
            'parent_item' => __( 'Parent Gallery Category', 'tkingdom' ),
            'parent_item_colon' => __( 'Parent Gallery Category', 'tkingdom' ),
            'edit_item' => __( 'Edit Gallery Category', 'tkingdom' ),
            'update_item' => __( 'Update Gallery Category', 'tkingdom' ),
            'add_new_item' => __( 'Add New Gallery Category', 'tkingdom' ),
            'new_item_name' => __( 'New Gallery Category', 'tkingdom' ),
            'menu_name' => __( 'Gallery Categories', 'tkingdom' ), ),
        'rewrite' => array( 'slug' => 'gallery-category',
            'with_front' => false, 'hierarchical' => true ),
    ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );
?>