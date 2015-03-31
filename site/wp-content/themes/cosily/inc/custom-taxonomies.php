<?php

function add_custom_taxonomies() {

// POST TYPE POST
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

// POST TYPE PROJECT
    register_taxonomy('ct_rooms', 'rooms', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Room Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Room Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Room Categories', tk_theme_name() ),
        'all_items' => __( 'All Rooms Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Room Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Room Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Room Category', tk_theme_name() ),
        'update_item' => __( 'Update Room Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Room Category', tk_theme_name() ),
        'new_item_name' => __( 'New Room Category', tk_theme_name() ),
        'menu_name' => __( 'Room Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'room-category',
        'with_front' => false, 'hierarchical' => true ),
    ));

}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>