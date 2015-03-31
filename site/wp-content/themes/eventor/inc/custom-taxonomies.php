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

// POST TYPE MEMBERS
    register_taxonomy('ct_speakers', 'speaker', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Speakers Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Speaker Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Speaker Categories', tk_theme_name() ),
        'all_items' => __( 'All Speaker Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Speakers Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Speakers Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Speakers Category', tk_theme_name() ),
        'update_item' => __( 'Update Speakers Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Speakers Category', tk_theme_name() ),
        'new_item_name' => __( 'New Speakers Category', tk_theme_name() ),
        'menu_name' => __( 'Speakers Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'speaker-category',
        'with_front' => false, 'hierarchical' => true ),
    ));    
    
// POST TYPE PROGRAM
    register_taxonomy('ct_program', 'pt_program', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Program Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Program Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Program Categories', tk_theme_name() ),
        'all_items' => __( 'All Program Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Program Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Program Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Program Category', tk_theme_name() ),
        'update_item' => __( 'Update Program Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Program Category', tk_theme_name() ),
        'new_item_name' => __( 'New Program Category', tk_theme_name() ),
        'menu_name' => __( 'Program Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'program-category',
        'with_front' => false, 'hierarchical' => true ),
    ));    
    
    

}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>