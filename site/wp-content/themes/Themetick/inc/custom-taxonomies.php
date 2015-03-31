<?php

function add_custom_taxonomies() {

// POST TYPE POST, SPEAKERS
    register_taxonomy('speakers', 'pt_speakers', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Speaker Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Speaker Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Speakers Categories', tk_theme_name() ),
        'all_items' => __( 'All Speaker Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Speaker Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Speaker Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Speaker Category', tk_theme_name() ),
        'update_item' => __( 'Update Speaker Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Speaker Categories', tk_theme_name() ),
        'new_item_name' => __( 'New Speaker Category', tk_theme_name() ),
        'menu_name' => __( 'Speaker Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'locations',
        'with_front' => false, 'hierarchical' => true ),
    ));

// POST TYPE POST, PROGRAM
    register_taxonomy('program', 'pt_program', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Program Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Program Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Program Categories',tk_theme_name() ),
        'all_items' => __( 'All Program Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Program Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Program Category',tk_theme_name() ),
        'edit_item' => __( 'Edit Program Category', tk_theme_name()),
        'update_item' => __( 'Update Program Category', tk_theme_name()),
        'add_new_item' => __( 'Add New Program Categories', tk_theme_name() ),
        'new_item_name' => __( 'New Program Category', tk_theme_name() ),
        'menu_name' => __( 'Program Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'locations',
        'with_front' => false, 'hierarchical' => true ),
    ));

// POST TYPE POST, GALLERY
    register_taxonomy('gallery', 'pt_gallery', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Gallery Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Gallery Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Gallery Categories', tk_theme_name() ),
        'all_items' => __( 'All Gallery Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Gallery Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Gallery Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Gallery Category', tk_theme_name() ),
        'update_item' => __( 'Update Gallery Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Gallery Categories', tk_theme_name() ),
        'new_item_name' => __( 'New Gallery Category', tk_theme_name() ),
        'menu_name' => __( 'Gallery Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'locations',
        'with_front' => false, 'hierarchical' => true ),
    ));

// POST TYPE POST, PARTNERS
    register_taxonomy('partners', 'pt_partners', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Partners Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Partners Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Partners Categories', tk_theme_name() ),
        'all_items' => __( 'All Partners Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Partners Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Partners Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Partners Category', tk_theme_name() ),
        'update_item' => __( 'Update Partners Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Partners Categories', tk_theme_name() ),
        'new_item_name' => __( 'New Partners Category', tk_theme_name() ),
        'menu_name' => __( 'Partners Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'locations',
        'with_front' => false, 'hierarchical' => true ),
    ));

}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>