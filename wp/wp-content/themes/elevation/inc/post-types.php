<?php

add_action( 'init', 'post_types_adding' );

function post_types_adding() {

        /*************************************************************/
        /************PROJECTS POST TYPE***************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Projects', tk_theme_name),
    'singular_name' => __('Projects', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Project', tk_theme_name),
    'edit_item' => __('Edit Project', tk_theme_name),
    'new_item' => __('New Project', tk_theme_name),
    'all_items' => __('All Projects', tk_theme_name),
    'view_item' => __('View this Project', tk_theme_name),
    'search_items' => __('Search Projects', tk_theme_name),
    'not_found' =>  __('No Projects', tk_theme_name),
    'not_found_in_trash' => __('No Projects in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Projects', tk_theme_name),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'our-projects'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri().'/style/img/portfolio.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
    'taxonomies' => array('ct_projects', 'post_tag'),
);
  register_post_type('pt_projects',$args);

  flush_rewrite_rules();


} ?>