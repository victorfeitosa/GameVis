<?php

function add_custom_taxonomies() {

// POST TYPE  GALLERY
    register_taxonomy('ct_gallery', 'gallery', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Gallery Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Gallery Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Gallery Categories', tk_theme_name() ),
        'all_items' => __( 'All Gallery Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Gallery Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Gallery Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Gallery Category', tk_theme_name() ),
        'update_item' => __( 'Update Gallery Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Gallery Category', tk_theme_name() ),
        'new_item_name' => __( 'New Gallery Category', tk_theme_name() ),
        'menu_name' => __( 'Gallery Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'gallery-category',
        'with_front' => false, 'hierarchical' => true ),
    ));


    // POST TYPE MEMBERS
    register_taxonomy('ct_members', 'team-members', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Team Member Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Team Members Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Team Members Categories', tk_theme_name() ),
        'all_items' => __( 'All Team Members Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Team Members Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Team Members Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Team Members Category', tk_theme_name() ),
        'update_item' => __( 'Update Team Members Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Team Members Category', tk_theme_name() ),
        'new_item_name' => __( 'New Team Members Category', tk_theme_name() ),
        'menu_name' => __( 'Team Members Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'team-category',
        'with_front' => false, 'hierarchical' => true ),
    ));



    // POST TYPE  SERVICES
    register_taxonomy('ct_services', 'services', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Service Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Service Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Services Categories', tk_theme_name() ),
        'all_items' => __( 'All Services Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Service Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Service Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Service Category', tk_theme_name() ),
        'update_item' => __( 'Update Services Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Services Category', tk_theme_name() ),
        'new_item_name' => __( 'New Services Category', tk_theme_name() ),
        'menu_name' => __( 'Services Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'ctservices',
        'with_front' => false, 'hierarchical' => true ),
    ));



}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>