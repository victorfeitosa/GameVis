<?php 
add_action( 'init', 'post_types_adding' );

function post_types_adding() {

    
    

    /**************************************************************/
    /************SIDEBAR POST TYPE****************************/
    /*************************************************************/

  $labels = array(
    'name' => __('Sidebars', tk_theme_name),
    'singular_name' => __('Sidebars', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Sidebar', tk_theme_name),
    'edit_item' => __('Edit Sidebar', tk_theme_name),
    'new_item' => __('New Sidebar', tk_theme_name),
    'all_items' => __('All Sidebars', tk_theme_name),
    'view_item' => __('View this Sidebar', tk_theme_name),
    'search_items' => __('Search Sidebars', tk_theme_name),
    'not_found' =>  __('No Sidebars', tk_theme_name),
    'not_found_in_trash' => __('No Sidebars in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Sidebars', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'show_ui' => false, 
    'show_in_nav_menus' => false, 
    'show_in_menu' => false, 
    'show_in_admin_bar' => false, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'sidebars'),
    'hierarchical' => false,
    'menu_position' => null,   
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
);
  register_post_type('sidebars',$args);
  
  flush_rewrite_rules();
  
          /*************************************************************/
        /************SPONSORS POST TYPE****************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Sponsors', 'eventor'),
    'singular_name' => __('Sponsors', 'eventor'),
    'add_new' => __('Add New', 'eventor'),
    'add_new_item' => __('Add New Sponsor', 'eventor'),
    'edit_item' => __('Edit Sponsor', 'eventor'),
    'new_item' => __('New Sponsor', 'eventor'),
    'all_items' => __('All Sponsor', 'eventor'),
    'view_item' => __('View this Sponsor', 'eventor'),
    'search_items' => __('Search Sponsors', 'eventor'),
    'not_found' =>  __('No Sponsors', 'eventor'),
    'not_found_in_trash' => __('No Sponsors in Trash', 'eventor'),
    'parent_item_colon' => '',
    'menu_name' => __('Sponsors', 'eventor'),

  );
  $args = array(
    'exclude_from_search' => false,
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'our-sponsors'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/thumb-up.png',
    'supports' => array('title', 'thumbnail' ),
    'taxonomies' => array('category'),
);
  register_post_type('pt_sponsors',$args);
  
  flush_rewrite_rules();

    /**************************************************************/
    /************ADVERTISEMENT POST TYPE**********************/
    /*************************************************************/

  $labels = array(
    'name' => __('Advertising', tk_theme_name),
    'singular_name' => __('Advertisement', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Ad', tk_theme_name),
    'edit_item' => __('Edit Ad', tk_theme_name),
    'new_item' => __('New Ad', tk_theme_name),
    'all_items' => __('All Ads', tk_theme_name),
    'view_item' => __('View this Ad', tk_theme_name),
    'search_items' => __('Search Ads', tk_theme_name),
    'not_found' =>  __('No Ads', tk_theme_name),
    'not_found_in_trash' => __('No Ads in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Advertising', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'advertisement'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/advert.png',
    'supports' => array('title', 'thumbnail'),
);
  register_post_type('advertisement',$args);
  
  flush_rewrite_rules();
   

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
    'rewrite' => array('slug' => 'gallery'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/gallery.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
);
  register_post_type('gallery',$args);
  
  flush_rewrite_rules();
  
   /**************************************************************/
    /************SPEAKERS POST TYPE**************************/
    /*************************************************************/

  $labels = array(
    'name' => __('Speakers', tk_theme_name),
    'singular_name' => __('Speakers', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Speaker', tk_theme_name),
    'edit_item' => __('Edit Speaker', tk_theme_name),
    'new_item' => __('New Speaker', tk_theme_name),
    'all_items' => __('All Speakers', tk_theme_name),
    'view_item' => __('View this Speaker', tk_theme_name),
    'search_items' => __('Search Speakers', tk_theme_name),
    'not_found' =>  __('No Speakers', tk_theme_name),
    'not_found_in_trash' => __('No Speakers in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Speakers', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'speaker-lineup'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/microphone_plus.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
      'taxonomies' => array('ct_speakers'),
);
  register_post_type('speaker',$args);
  
  flush_rewrite_rules();
  
        /**************************************************************/
        /************SLIDER POST TYPE********************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Slides', tk_theme_name),
    'singular_name' => __('Slides', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Slide', tk_theme_name),
    'edit_item' => __('Edit Slide', tk_theme_name),
    'new_item' => __('New Slide', tk_theme_name),
    'all_items' => __('All Slides', tk_theme_name),
    'view_item' => __('View this Slide', tk_theme_name),
    'search_items' => __('Search Slides', tk_theme_name),
    'not_found' =>  __('No Slides', tk_theme_name),
    'not_found_in_trash' => __('No Slides in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Slides', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'slider'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/slider.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
);
  register_post_type('slider',$args);

  flush_rewrite_rules();  
  
        /*************************************************************/
        /************PROGRAM POST TYPE****************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Program', tk_theme_name),
    'singular_name' => __('Program', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Program Item', tk_theme_name),
    'edit_item' => __('Edit Program Item', tk_theme_name),
    'new_item' => __('New Program Item', tk_theme_name),
    'all_items' => __('All Program Items', tk_theme_name),
    'view_item' => __('View this Program Item', tk_theme_name),
    'search_items' => __('Search Program Items', tk_theme_name),
    'not_found' =>  __('No Program Items', tk_theme_name),
    'not_found_in_trash' => __('No Program Items in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Program', tk_theme_name),

  );
  $args = array(
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
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/clipboard-list.png',
    'supports' => array('title', 'editor', 'custom-post-format' ),
    'taxonomies' => array('ct_program'),
);
  register_post_type('pt_program',$args);

  flush_rewrite_rules();
  
}



?>