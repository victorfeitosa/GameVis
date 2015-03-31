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
        'supports' => array('title',  'thumbnail', 'post-formats' ),
    ); // end $args
    register_post_type('gallery',$args);

    /************************************************************/
    /*                                                          */
    /*   EVENTS POST TYPE                                      */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Events', 'tkingdom'),
        'singular_name' => __('Events', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Event', 'tkingdom'),
        'edit_item' => __('Edit Event', 'tkingdom'),
        'new_item' => __('New Event', 'tkingdom'),
        'all_items' => __('All Event', 'tkingdom'),
        'view_item' => __('View this Event', 'tkingdom'),
        'search_items' => __('Search Events', 'tkingdom'),
        'not_found' =>  __('No Events', 'tkingdom'),
        'not_found_in_trash' => __('No Events in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Events', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'our-events'),
        'hierarchical' => false,
        'menu_position' => null,
        'has_archive' => true,
        'menu_icon' => get_template_directory_uri().'/theme-images/events-icon.png',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'post-formats' ),
    ); // end $args
    register_post_type('events',$args);

    /************************************************************/
    /*                                                          */
    /*   TEAM POST TYPE                                         */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Team', 'tkingdom'),
        'singular_name' => __('Team', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Team Member', 'tkingdom'),
        'edit_item' => __('Edit Team Member', 'tkingdom'),
        'new_item' => __('New Team Member', 'tkingdom'),
        'all_items' => __('All Team Members', 'tkingdom'),
        'view_item' => __('View this Team Member', 'tkingdom'),
        'search_items' => __('Search Team Members', 'tkingdom'),
        'not_found' =>  __('No Team Members', 'tkingdom'),
        'not_found_in_trash' => __('No Team Members in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Team Members', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'our-team-members'),
        'hierarchical' => false,
        'menu_position' => null,
        'has_archive' => true,
        'menu_icon' => get_template_directory_uri().'/theme-images/team-icon.png',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
    ); // end $args
    register_post_type('team-members',$args);

    /************************************************************/
    /*                                                          */
    /*   SERVICES POST TYPE                                     */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Causes', 'tkingdom'),
        'singular_name' => __('Causes', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Cause', 'tkingdom'),
        'edit_item' => __('Edit Cause', 'tkingdom'),
        'new_item' => __('New Cause', 'tkingdom'),
        'all_items' => __('All Causes', 'tkingdom'),
        'view_item' => __('View this Cause', 'tkingdom'),
        'search_items' => __('Search Cause', 'tkingdom'),
        'not_found' =>  __('No Causes', 'tkingdom'),
        'not_found_in_trash' => __('No Causes in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Causes', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'ourcauses'),
        'hierarchical' => false,
        'menu_position' => null,
        'has_archive' => true,
        'menu_icon' => get_template_directory_uri().'/theme-images/services-icon.png',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'post-formats' ),
    ); // end $args
    register_post_type('services',$args);

    /************************************************************/
    /*                                                          */
    /*   SLIDER POST TYPE                                       */
    /*                                                          */
    /************************************************************/
    $labels = array(
        'name' => __('Slides', 'tkingdom'),
        'singular_name' => __('Slider', 'tkingdom'),
        'add_new' => __('Add New', 'tkingdom'),
        'add_new_item' => __('Add New Slide', 'tkingdom'),
        'edit_item' => __('Edit Slide', 'tkingdom'),
        'new_item' => __('New Slide', 'tkingdom'),
        'all_items' => __('All Slides', 'tkingdom'),
        'view_item' => __('View this Slide', 'tkingdom'),
        'search_items' => __('Search Slides', 'tkingdom'),
        'not_found' =>  __('No Slides', 'tkingdom'),
        'not_found_in_trash' => __('No Slides in Trash', 'tkingdom'),
        'parent_item_colon' => '',
        'menu_name' => __('Slides', 'tkingdom'),
    ); // end $labels
    $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'slider'),
        'hierarchical' => false,
        'menu_position' => null,
        'has_archive' => true,
        'menu_icon' => get_template_directory_uri().'/theme-images/slider-icon.png',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
    ); // end $args
    register_post_type('slider',$args);

    /************************************************************/
    /*                                                          */
    /*   Remove rewrite rules and then recreate rewrite rules   */
    /*                                                          */
    /************************************************************/
    flush_rewrite_rules();
}

function add_custom_taxonomies() {

// EVENTS TAXONOMY
    register_taxonomy('ct_events', 'events', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Events Categories', 'taxonomy general name', 'tkingdom' ),
            'singular_name' => _x( 'Events Categories', 'taxonomy singular name', 'tkingdom' ),
            'search_items' => __( 'Search Events Categories', 'tkingdom' ),
            'all_items' => __( 'All Events Categories', 'tkingdom' ),
            'parent_item' => __( 'Parent Events Category', 'tkingdom' ),
            'parent_item_colon' => __( 'Parent Events Category', 'tkingdom' ),
            'edit_item' => __( 'Edit Events Category', 'tkingdom' ),
            'update_item' => __( 'Update Events Category', 'tkingdom' ),
            'add_new_item' => __( 'Add New Events Category', 'tkingdom' ),
            'new_item_name' => __( 'New Events Category', 'tkingdom' ),
            'menu_name' => __( 'Events Categories', 'tkingdom' ), ),
        'rewrite' => array( 'slug' => 'events-category',
            'with_front' => false, 'hierarchical' => true ),
    ));

// SERVICES(CAUSES) TAXONOMY
    register_taxonomy('ct_services', 'services', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Causes Categories', 'taxonomy general name', 'tkingdom' ),
            'singular_name' => _x( 'Causes Categories', 'taxonomy singular name', 'tkingdom' ),
            'search_items' => __( 'Search Causes Categories', 'tkingdom' ),
            'all_items' => __( 'All Causes Categories', 'tkingdom' ),
            'parent_item' => __( 'Parent Causes Category', 'tkingdom' ),
            'parent_item_colon' => __( 'Parent Causes Category', 'tkingdom' ),
            'edit_item' => __( 'Edit Causes Category', 'tkingdom' ),
            'update_item' => __( 'Update Causes Category', 'tkingdom' ),
            'add_new_item' => __( 'Add New Causes Category', 'tkingdom' ),
            'new_item_name' => __( 'New Causes Category', 'tkingdom' ),
            'menu_name' => __( 'Causes Categories', 'tkingdom' ), ),
        'rewrite' => array( 'slug' => 'causes-category',
            'with_front' => false, 'hierarchical' => true ),
    ));


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


// TEAM(DIRECTORS) TAXONOMY
    register_taxonomy('ct_team', 'team-members', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Team Categories', 'taxonomy general name', 'tkingdom' ),
            'singular_name' => _x( 'Team Categories', 'taxonomy singular name', 'tkingdom' ),
            'search_items' => __( 'Search Team Categories', 'tkingdom' ),
            'all_items' => __( 'All Team Categories', 'tkingdom' ),
            'parent_item' => __( 'Parent Team Category', 'tkingdom' ),
            'parent_item_colon' => __( 'Parent Team Category', 'tkingdom' ),
            'edit_item' => __( 'Edit Team Category', 'tkingdom' ),
            'update_item' => __( 'Update Team Category', 'tkingdom' ),
            'add_new_item' => __( 'Add New Team Category', 'tkingdom' ),
            'new_item_name' => __( 'New Team Category', 'tkingdom' ),
            'menu_name' => __( 'Team Categories', 'tkingdom' ), ),
        'rewrite' => array( 'slug' => 'team-category',
            'with_front' => false, 'hierarchical' => true ),
    ));

}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>