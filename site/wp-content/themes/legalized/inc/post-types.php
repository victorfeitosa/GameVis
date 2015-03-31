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
    'name' => __('Work', tk_theme_name),
    'singular_name' => __('Work', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Work Item', tk_theme_name),
    'edit_item' => __('Edit Work Item', tk_theme_name),
    'new_item' => __('New Work Item', tk_theme_name),
    'all_items' => __('All Work Items', tk_theme_name),
    'view_item' => __('View this Work Item', tk_theme_name),
    'search_items' => __('Search Work Items', tk_theme_name),
    'not_found' =>  __('No Work Items', tk_theme_name),
    'not_found_in_trash' => __('No Work Items in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Work', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'work'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/gallery.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'post-formats' ),
);
  register_post_type('work',$args);

  flush_rewrite_rules();


  
   /**************************************************************/
    /************TEAM POST TYPE**************************/
    /*************************************************************/

  $labels = array(
    'name' => __('Team', tk_theme_name),
    'singular_name' => __('Team', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Team Member', tk_theme_name),
    'edit_item' => __('Edit Team Member', tk_theme_name),
    'new_item' => __('New Team Member', tk_theme_name),
    'all_items' => __('All Team Members', tk_theme_name),
    'view_item' => __('View this Team Member', tk_theme_name),
    'search_items' => __('Search Team Members', tk_theme_name),
    'not_found' =>  __('No Team Members', tk_theme_name),
    'not_found_in_trash' => __('No Team Members in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Team Members', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'team-members'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/teams.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
);
  register_post_type('team-members',$args);

  flush_rewrite_rules();

  
    
   /**************************************************************/
    /************Services POST TYPE**************************/
    /*************************************************************/

  $labels = array(
    'name' => __('Services', tk_theme_name),
    'singular_name' => __('Services', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Service', tk_theme_name),
    'edit_item' => __('Edit Service', tk_theme_name),
    'new_item' => __('New Service', tk_theme_name),
    'all_items' => __('All Services', tk_theme_name),
    'view_item' => __('View this Service', tk_theme_name),
    'search_items' => __('Search Services', tk_theme_name),
    'not_found' =>  __('No Services', tk_theme_name),
    'not_found_in_trash' => __('No Services in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Services', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'pt-services'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/services.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'post-formats' ),
);
  register_post_type('services',$args);

  flush_rewrite_rules();

  
         /**************************************************************/
        /************TESTIMONIAL POST TYPE************************/
        /*************************************************************/

  $labels = array(
    'name' => __('Testimonials', tk_theme_name),
    'singular_name' => __('Testimonials', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Testimonial', tk_theme_name),
    'edit_item' => __('Edit Testimonial', tk_theme_name),
    'new_item' => __('New Testimonial', tk_theme_name),
    'all_items' => __('All Testimonials', tk_theme_name),
    'view_item' => __('View this Testimonial', tk_theme_name),
    'search_items' => __('Search Testimonials', tk_theme_name),
    'not_found' =>  __('No Testimonials', tk_theme_name),
    'not_found_in_trash' => __('No Testimonials in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Testimonials', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'pt-testimonials'),
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => get_template_directory_uri().'/style/img/testimonials.png',
    'supports' => array('title', 'editor', 'excerpt', 'custom-post-format' ),
);
  register_post_type('testimonials',$args);

  flush_rewrite_rules();



    /**************************************************************/
    /************PAGE BUILDER POST TYPE****************************/
    /*************************************************************/

    $labels = array(
        'name' => __('Page Builder', tk_theme_name),
        'singular_name' => __('Page Builder', tk_theme_name),
        'add_new' => __('Add New', tk_theme_name),
        'add_new_item' => __('Add New Page Builder', tk_theme_name),
        'edit_item' => __('Edit Page Builder', tk_theme_name),
        'new_item' => __('New Page Builder', tk_theme_name),
        'all_items' => __('All Page Builder', tk_theme_name),
        'view_item' => __('View this Page Builder', tk_theme_name),
        'search_items' => __('Search Page Builder', tk_theme_name),
        'not_found' =>  __('No Page Builder', tk_theme_name),
        'not_found_in_trash' => __('No Page Builder in Trash', tk_theme_name),
        'parent_item_colon' => '',
        'menu_name' => __('Page Builder', tk_theme_name),

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
        'rewrite' => array('slug' => 'page_builder'),
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-post-format' ),
    );
    register_post_type('page_builder',$args);

    flush_rewrite_rules();
}



?>