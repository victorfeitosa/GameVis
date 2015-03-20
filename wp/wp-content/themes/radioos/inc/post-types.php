<?php 
add_action( 'init', 'post_types_adding' );

function post_types_adding() {

        /**************************************************************/
        /************PROJECTS POST TYPE********************************/
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
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'project'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/portfolio.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
);
  register_post_type('projects',$args);

  flush_rewrite_rules();

}

?>