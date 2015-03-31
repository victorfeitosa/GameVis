<?php

add_action( 'init', 'post_types_adding' );

function post_types_adding() {

        /*************************************************************/
        /************PORTFOLIO POST TYPE***************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Portfolio', tk_theme_name),
    'singular_name' => __('Portfolio', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Portfolio', tk_theme_name),
    'edit_item' => __('Edit Portfolio', tk_theme_name),
    'new_item' => __('New Portfolio', tk_theme_name),
    'all_items' => __('All Portfolios', tk_theme_name),
    'view_item' => __('View this Portfolio', tk_theme_name),
    'search_items' => __('Search Portfolios', tk_theme_name),
    'not_found' =>  __('No Portfolios', tk_theme_name),
    'not_found_in_trash' => __('No Portfolios in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Portfolio', tk_theme_name),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'portfolios'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri().'/style/img/portfolio.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
    'taxonomies' => array('category', 'post_tag'),
);
  register_post_type('pt_portfolio',$args);

  flush_rewrite_rules();

} ?>