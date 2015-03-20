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
    /************ROOMS POST TYPE****************************/
    /*************************************************************/

  $labels = array(
    'name' => __('Rooms', tk_theme_name),
    'singular_name' => __('Room', tk_theme_name),
    'add_new' => __('Add New', tk_theme_name),
    'add_new_item' => __('Add New Room', tk_theme_name),
    'edit_item' => __('Edit Room', tk_theme_name),
    'new_item' => __('New Room', tk_theme_name),
    'all_items' => __('All Rooms', tk_theme_name),
    'view_item' => __('View this Room', tk_theme_name),
    'search_items' => __('Search Rooms', tk_theme_name),
    'not_found' =>  __('No Rooms', tk_theme_name),
    'not_found_in_trash' => __('No Rooms in Trash', tk_theme_name),
    'parent_item_colon' => '',
    'menu_name' => __('Rooms', tk_theme_name),

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_nav_menus' => true, 
    'show_in_menu' => true, 
    'show_in_admin_bar' => true, 
    'query_var' => true,
    'capability_type' => 'post',
    'rewrite' => array('slug' => 'pt-rooms'),
    'hierarchical' => false,
    'menu_position' => null,   
    'menu_icon' => get_template_directory_uri().'/style/img/rooms.png',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt' ),
);
  register_post_type('rooms',$args);

  flush_rewrite_rules();

    

    /**************************************************************/
    /************ADVERTISEMENT POST TYPE**********************/
    /*************************************************************/

  $labels = array(
    'name' => __('Advertisement', tk_theme_name),
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
    'menu_name' => __('Advertisement', tk_theme_name),

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
    'supports' => array('title', 'thumbnail', 'custom-post-format' ),
);
  register_post_type('gallery',$args);

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
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
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