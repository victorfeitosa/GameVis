<?php 
add_action( 'init', 'post_types_adding' );

function post_types_adding() {

        /**************************************************************/
        /************GALLERY POST TYPE********************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Gallery', tk_theme_name),
    'singular_name' => __('Gallery', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Gallery Item', tk_theme_name),
    'edit_item' => __('Edit Gallery Item', tk_theme_name),
    'new_item' => __('New Gallery Item', tk_theme_name),
    'all_items' => __('All Gallery Items', tk_theme_name),
    'view_item' => __('View this Gallery Item', tk_theme_name),
    'search_items' => __('Search Gallery Items', tk_theme_name),
    'not_found' =>  __('No Gallery Items', tk_theme_name),
    'not_found_in_trash' => __('No Gallery Items in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Gallery', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'pt-gallery'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/gallery.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
);
  register_post_type('gallery',$args);

  flush_rewrite_rules();


  


}

?>