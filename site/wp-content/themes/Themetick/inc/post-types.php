<?php

add_action( 'init', 'post_types_adding' );

        /*************************************************************/
        /************SLIDER POST TYPE*******************************/
        /*************************************************************/

function post_types_adding() {
   $labels = array(
    'name' => __('Slides', 'Themetick'),
    'singular_name' => __('Slides', 'Themetick'),
    'add_new' => __('Add New', 'Themetick'),
    'add_new_item' => __('Add New Slide', 'Themetick'),
    'edit_item' => __('Edit Slide', 'Themetick'),
    'new_item' => __('New Slide', 'Themetick'),
    'all_items' => __('All Slides', 'Themetick'),
    'view_item' => __('View this Slide', 'Themetick'),
    'search_items' => __('Search Slide', 'Themetick'),
    'not_found' =>  __('No Slides', 'Themetick'),
    'not_found_in_trash' => __('No Slides in Trash', 'Themetick'),
    'parent_item_colon' => '',
    'menu_name' => __('Slides', 'Themetick'),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'slides'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri() . '/style/img/slider.png',
    'supports' => array('title', 'editor', 'thumbnail' ),
  );
  register_post_type('pt_slides',$args);

        /*************************************************************/
        /************SPEAKERS POST TYPE****************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Speakers', 'Themetick'),
    'singular_name' => __('Speakers', 'Themetick'),
    'add_new' => __('Add New', 'Themetick'),
    'add_new_item' => __('Add New Speaker', 'Themetick'),
    'edit_item' => __('Edit Speaker', 'Themetick'),
    'new_item' => __('New Speaker', 'Themetick'),
    'all_items' => __('All Speakers', 'Themetick'),
    'view_item' => __('View this Speaker', 'Themetick'),
    'search_items' => __('Search Speakers', 'Themetick'),
    'not_found' =>  __('No Speakers', 'Themetick'),
    'not_found_in_trash' => __('No Speakers in Trash', 'Themetick'),
    'parent_item_colon' => '',
    'menu_name' => __('Speakers', 'Themetick'),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'speaker-lineup'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri().'/style/img/microphone_plus.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
    'taxonomies' => array('post_tag'),
);
  register_post_type('pt_speakers',$args);

        /*************************************************************/
        /************PROGRAM POST TYPE****************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Program', 'Themetick'),
    'singular_name' => __('Program', 'Themetick'),
    'add_new' => __('Add New', 'Themetick'),
    'add_new_item' => __('Add New Program Item', 'Themetick'),
    'edit_item' => __('Edit Program Item', 'Themetick'),
    'new_item' => __('New Program Item', 'Themetick'),
    'all_items' => __('All Program Items', 'Themetick'),
    'view_item' => __('View this Program Item', 'Themetick'),
    'search_items' => __('Search Program Items', 'Themetick'),
    'not_found' =>  __('No Program Items', 'Themetick'),
    'not_found_in_trash' => __('No Program Items in Trash', 'Themetick'),
    'parent_item_colon' => '',
    'menu_name' => __('Program', 'Themetick'),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'event-program'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri().'/style/img/clipboard-list.png',
    'supports' => array('title', 'editor' ),
    'taxonomies' => array('post_tag'),
);
  register_post_type('pt_program',$args);

  flush_rewrite_rules();


        /*************************************************************/
        /************GALLERY POST TYPE****************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Gallery', 'Themetick'),
    'singular_name' => __('Gallery', 'Themetick'),
    'add_new' => __('Add New', 'Themetick'),
    'add_new_item' => __('Add New Gallery Item', 'Themetick'),
    'edit_item' => __('Edit Gallery Item', 'Themetick'),
    'new_item' => __('New Gallery Item', 'Themetick'),
    'all_items' => __('All Gallery Items', 'Themetick'),
    'view_item' => __('View this Gallery Item', 'Themetick'),
    'search_items' => __('Search Gallery Items', 'Themetick'),
    'not_found' =>  __('No Gallery Items', 'Themetick'),
    'not_found_in_trash' => __('No Gallery Items in Trash', 'Themetick'),
    'parent_item_colon' => '',
    'menu_name' => __('Gallery', 'Themetick'),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'image-gallery'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri().'/style/img/portfolio.png',
    'supports' => array('title', 'thumbnail' ),
    'taxonomies' => array('post_tag'),
);
  register_post_type('pt_gallery',$args);

  flush_rewrite_rules();


          /*************************************************************/
        /************PARTNERS POST TYPE****************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Partners', 'Themetick'),
    'singular_name' => __('Partners', 'Themetick'),
    'add_new' => __('Add New', 'Themetick'),
    'add_new_item' => __('Add New Partner Item', 'Themetick'),
    'edit_item' => __('Edit Partner Item', 'Themetick'),
    'new_item' => __('New Partner Item', 'Themetick'),
    'all_items' => __('All Partner Items', 'Themetick'),
    'view_item' => __('View this Partner Item', 'Themetick'),
    'search_items' => __('Search Partner Items', 'Themetick'),
    'not_found' =>  __('No Partner Items', 'Themetick'),
    'not_found_in_trash' => __('No Partner Items in Trash', 'Themetick'),
    'parent_item_colon' => '',
    'menu_name' => __('Partners', 'Themetick'),

  );
  $args = array(
    'exclude_from_search' => true,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'image-partners'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 100,
    'menu_icon' => get_template_directory_uri().'/style/img/portfolio.png',
    'supports' => array('title', 'thumbnail' ),
    'taxonomies' => array('post_tag'),
);
  register_post_type('pt_partners',$args);

  flush_rewrite_rules();



} ?>