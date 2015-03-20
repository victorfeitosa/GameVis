<?php
     /*************************************************************/
    /*****************THEME CUSTOMIZER************************/
    /*************************************************************/


add_action ('admin_menu', 'themedemo_admin');
function themedemo_admin() {
    // add the Customize link to the admin menu
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}

add_action('customize_register', 'theme_customize');
function theme_customize($wp_customize) {



$wp_customize->add_section( 'site_colors', array(
    'title'          => 'Site Colors',
    'priority'       => 35,
));


$wp_customize->add_setting( 'body_color', array(
        'default'        => 'FFF',
        'type'  => 'option'
));

$wp_customize->add_setting( 'headline_colors', array(
        'default'        => '515050',
        'type'  => 'option'
));

$wp_customize->add_setting( 'paragraph_colors', array(
        'default'        => '555555',
        'type'  => 'option'
));

$wp_customize->add_setting( 'footer_background', array(
        'default'        => '494949',
        'type'  => 'option'
));

$wp_customize->add_setting( 'footer_text_color', array(
        'default'        => '494949',
        'type'  => 'option'
));

$wp_customize->add_setting( 'footer_headlines_color', array(
        'default'        => 'fff',
        'type'  => 'option'
));

$wp_customize->add_setting( 'footer_link_color', array(
        'default'        => 'd8d8d8',
        'type'  => 'option'
));

$wp_customize->add_setting( 'footer_border_color', array(
        'default'        => '#3ba3d4',
        'type'  => 'option'
));

$wp_customize->add_setting( 'header_background_pattern', array(
        'default'        => get_template_directory_uri().'/style/img/pat1.png',
        'type'  => 'option'
));


    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'body_color',
	array(
		'label'      => __( 'Background Color', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'body_color',
	))
);
    

    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'headline_colors',
	array(
		'label'      => __( 'Headline Colors', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'headline_colors',

	))
);

        $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'paragraph_colors',
	array(
		'label'      => __( 'Paragraph Colors', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'paragraph_colors',

	))
);

    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'footer_background',
	array(
		'label'      => __( 'Footer Background', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'footer_background',

	))
);

    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'footer_headlines_color',
	array(
		'label'      => __( 'Footer Headlines', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'footer_headlines_color',

	))
);

    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'footer_text_color',
	array(
		'label'      => __( 'Footer Text Color', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'footer_text_color',

	))
);

    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'footer_text_color',
	array(
		'label'      => __( 'Footer Link Color', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'footer_link_color',

	))
);

    $wp_customize->add_control(
	new WP_Customize_Color_Control(
	$wp_customize,
	'footer_border_color',
	array(
		'label'      => __( 'Footer Border Color', tk_theme_name()),
		'section'    => 'site_colors',
		'settings'   => 'footer_border_color',

	))
);

    $wp_customize->add_control( 'header_background_pattern', array(
        'label'   => 'Select Pattern',
        'section' => 'site_colors',
        'type'    => 'select',
        'choices'    => array(
            get_template_directory_uri().'/style/img/pat1.png' => 'Pattern 1',
            get_template_directory_uri().'/style/img/pat2.png'  => 'Pattern 2',
            get_template_directory_uri().'/style/img/pat3.png'  => 'Pattern 3',
            get_template_directory_uri().'/style/img/pat4.png'  => 'Pattern 4',
            get_template_directory_uri().'/style/img/pat5.png'  => 'Pattern 5',
            get_template_directory_uri().'/style/img/pat6.png'  => 'Pattern 6',
            get_template_directory_uri().'/style/img/pat7.png'  => 'Pattern 7',
            get_template_directory_uri().'/style/img/pat8.png'  => 'Pattern 8',       
            ),
) );

  


    $wp_customize->get_setting( 'body_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'headline_colors' )->transport = 'postMessage';
    $wp_customize->get_setting( 'paragraph_colors' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_background' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_headlines_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_border_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_background_pattern' )->transport = 'postMessage';
 


     $wp_customize->remove_section( 'title_tagline');
     $wp_customize->remove_section( 'colors');
     $wp_customize->remove_section( 'static_front_page');


}

add_action( 'customize_preview_init' , 'live_preview' );

   function live_preview()   {
      wp_enqueue_script(
           'mytheme-themecustomizer', //Give the script an ID
           get_template_directory_uri().'/inc/theme-customizer.js', //Define it's JS file
           array( 'jquery','customize-preview' ), //Define dependencies
           '', //Define a version (optional)
           true //Specify whether to put in footer (leave this true)
      );
   }






?>