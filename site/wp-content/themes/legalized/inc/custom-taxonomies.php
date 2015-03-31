<?php

function add_custom_taxonomies() {

// POST TYPE POST
    register_taxonomy('ct_work', 'work', array(
        'hierarchical' => true,
        'labels' => array( 'name' => _x( 'Work Categories', 'taxonomy general name', tk_theme_name() ),
        'singular_name' => _x( 'Work Categories', 'taxonomy singular name', tk_theme_name() ),
        'search_items' => __( 'Search Work Categories', tk_theme_name() ),
        'all_items' => __( 'All Work Categories', tk_theme_name() ),
        'parent_item' => __( 'Parent Work Category', tk_theme_name() ),
        'parent_item_colon' => __( 'Parent Work Category', tk_theme_name() ),
        'edit_item' => __( 'Edit Work Category', tk_theme_name() ),
        'update_item' => __( 'Update Work Category', tk_theme_name() ),
        'add_new_item' => __( 'Add New Work Category', tk_theme_name() ),
        'new_item_name' => __( 'New Work Category', tk_theme_name() ),
        'menu_name' => __( 'Work Categories', tk_theme_name() ), ),
        'rewrite' => array( 'slug' => 'work-category',
        'with_front' => false, 'hierarchical' => true ),
    ));


}
add_action( 'init', 'add_custom_taxonomies', 0 );

?>