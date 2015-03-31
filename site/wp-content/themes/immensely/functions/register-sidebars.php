<?php
/************************************************************/
/*                                                          */
/*   Adds support for sidebars and registers new ones       */
/*                                                          */
/************************************************************/
if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 1',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 2',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 3',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Footer Widget 4',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Default',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => '404',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Archive/Search',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Woocommerce Shop',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

if (function_exists('register_sidebar')) {
    register_sidebar(array(
            'name' => 'Woocommerce Single',
            'before_widget' => '<div class="block">',
            'after_widget' => '</div>',
            'before_title' => '<h6>',
            'after_title' => '</h6>')
    );
}

$results = $wpdb->get_results("SELECT * FROM  ".$wpdb->prefix."posts WHERE post_type = 'sidebars' AND post_status = 'publish'");
foreach ($results as $one_col) {

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
                'name' => $one_col->post_title,
                'before_widget' => '<div class="block">',
                'after_widget' => '</div>',
                'before_title' => '<h6>',
                'after_title' => '</h6>')
        );
    }
}
?>