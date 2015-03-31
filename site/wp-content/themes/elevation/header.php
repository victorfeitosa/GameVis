<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

    <title>
        <?php
        global $page, $paged;

        wp_title('|', true, 'right');

        bloginfo('name');

        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() ))
            echo " | $site_description";

        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', tk_theme_name), max($paged, $page));
        ?>
    </title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
                <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
        
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/menu/superfish.css"; ?>" type="text/css"/>
        <link rel="stylesheet" media="screen" href="<?php echo get_template_directory_uri() . "/script/pirobox/css/demo5/style.css"; ?>" type="text/css"/>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/style/font.css"; ?>" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/script/flexslider/flexslider.css"; ?>" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/script/scroll-button/scroll-button.css"; ?>" type="text/css" charset="utf-8" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri() . "/style/font.css"; ?>" type="text/css" charset="utf-8" />
        
<!--[if lt IE 9]>
   <script>
      document.createElement('nav');
   </script>
<![endif]-->


<?php

        /*************************************************************/
        /*Test user agent and load css for it***************************/
        /*************************************************************/

        $prefix = 'tk_';
        $ua = $_SERVER["HTTP_USER_AGENT"];

        // Macintosh
        $mac = strpos($ua, 'Macintosh') ? true : false;

        // Windows
        $win = strpos($ua, 'Windows') ? true : false;


        $browser = $_SERVER['HTTP_USER_AGENT'];

        if (strpos($browser, 'Safari')) {
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-safari.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'Firefox')) {
            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-firefox.css" type="text/css" />
                <?php
                }
            }
        }

        if (strpos($browser, 'MSIE 8.0')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie8.css" type="text/css" />
                <script src="<?php echo get_template_directory_uri()?>/script/respond/respond.src.js"></script>
            <?php
        }

        if (strpos($browser, 'MSIE 9.0')) {
            ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie9.css" type="text/css" />
            <?php
        }

        if (strpos($browser, 'Chrome')) {?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/chrome.css" type="text/css" />
                <?php
        }

        if (strpos($browser, 'pera')) {
            ?>
                <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/opera.css" type="text/css" />
            <?php
            if(!empty($win)) {
                if($win == Windows) { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-opera.css" type="text/css" />
                <?php
                }
            }
        }
?>

        
<?php

        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/

            //Body style
            $body_bg_image = get_theme_option(tk_theme_name.'_colors_body_bg_img');
            $body_image_position = get_theme_option(tk_theme_name.'_colors_body_img_position');
            $body_image_repeat = get_theme_option(tk_theme_name.'_colors_body_img_repeat');
            $body_image_attachment = get_theme_option(tk_theme_name.'_colors_body_img_attachment');
            $body_color = get_theme_option(tk_theme_name.'_colors_body_color');

            //Header style
            $header_bg_image = get_theme_option(tk_theme_name.'_colors_header_bg_img');
            $header_image_position = get_theme_option(tk_theme_name.'_colors_header_img_position');
            $header_image_repeat = get_theme_option(tk_theme_name.'_colors_header_img_repeat');
            $header_image_attachment = get_theme_option(tk_theme_name.'_colors_header_img_attachment');
            $header_color = get_theme_option(tk_theme_name.'_colors_header_color');

            //Navigation colors
            $navigation_color = get_theme_option(tk_theme_name.'_colors_navigation_color');

            $title_color = get_theme_option(tk_theme_name.'_colors_title_color');
            $paragraph_color = get_theme_option(tk_theme_name.'_colors_paragraph_color');
            
            $link_color = get_theme_option(tk_theme_name.'_colors_link_color');
            $link_hover_color = get_theme_option(tk_theme_name.'_colors_link_hover_color');
            
            $footer_title_color = get_theme_option(tk_theme_name.'_colors_footer_title_color');
            $footer_paragraph_color = get_theme_option(tk_theme_name.'_colors_footer_paragraph_color');
            
            $copyright_color = get_theme_option(tk_theme_name.'_colors_copyright_color');
            

        ?>

                    <style type="text/css">
                        /*BODY*/
                        body{
                            background-color: <?php echo '#'.$body_color?>;
                            background-attachment: <?php echo $body_image_attachment?>;
                            background-image: url(<?php echo $body_bg_image?>);
                            background-position: <?php echo $body_image_position?>;
                            background-repeat: <?php echo $body_image_repeat?>}
                        
                        /*HEADER*/
                        .header{
                            background-color: <?php echo '#'.$header_color?>;
                            background-attachment: <?php echo $header_image_attachment?>;
                            background-image: url(<?php echo $header_bg_image?>);
                            background-position: <?php echo $header_image_position?>;
                            background-repeat: <?php echo $header_image_repeat?>}
                        
                        /*NAVIGATION*/
                        .nav-header nav ul li a:link, .nav-header nav ul li a:visited,
                        .nav-help-header nav ul li a:link, .nav-help-header nav ul li a:visited,
                        .stay-tuned ul li, .stay-tuned ul li, .stay-tuned ul li a,
                        .portfolio-home-category ul li a, .sub-menu li a, .title-page span,
                        .portfolio-single-title, .portfolio-single-text p, .logo span
                        {color:<?php echo '#'.$navigation_color?>}

                        /*TITLE*/
                        h1, h2, h3, h4, h5, h6, .sidebar_widget_holder h3,
                        .sidebar_widget_holder #wp-calendar caption, 
                        .sidebar_widget_holder #today, .sidebar_widget_holder thead, 
                        .recentcomments .url, .recentcomments,
                        .blog-title a, .title-form, .blog-title, .comment-start h2,
                        .share-this span, blockquote p,
                        .shortcodes h1, .shortcodes h2, .shortcodes h3, .shortcodes h4, .shortcodes h5, .shortcodes h6,
                        .sidebar_widget_holder h3 a
                        {color:<?php echo '#'.$title_color?>}

                        /*PARAGRAPH*/
                        p, .shortcodes ul li, .shortcodes ol li,
                        .blog-text p, .sidebar_widget_holder ul li a,
                        .sidebar_widget_holder .newsletter span,
                        .sidebar_widget_holder tbody, .sidebar_widget_holder .bg-widget-center span,
                        .sidebar_widget_holder .bg-widget-center a, .sidebar_widget_holder .twittime,
                        .sidebar_widget_holder ul li, .sidebar_widget_holder .tagcloud a, .footer_box .tagcloud a,
                        .sidebar_widget_holder .textwidget, .bg-input input, .form-textarea textarea,
                        #contact-error, #contact-success, .one-half, .one-third, .one-fourth, .sidebar_widget_holder tbody a:hover
                        {color:<?php echo '#'.$paragraph_color?>}

                        /*LINK COLOR*/
                        .textwidget a, .shortcodes a
                        {color:<?php echo '#'.$link_color?>}
                        
                        /*LINK HOVER*/
                        .nav-help-header nav ul li a:hover, .nav-help-header nav ul li.active a,
                        .nav-header nav ul li a:hover, .nav-header nav ul li.active a,
                        .stay-tuned ul li a:hover, .portfolio-home-category ul li a:hover,
                        .footer_box .bg-widget-center a:hover,.footer_box ul li a:hover,
                        .sidebar_widget_holder .tagcloud a:hover, .footer_box .tagcloud a:hover,
                        .footer_box .twitter_ul p, .sidebar_widget_holder .twitter_ul p,
                        .sidebar_widget_holder tbody a, .footer_box tbody a,
                        .sidebar_widget_holder .textwidget a:hover, .footer_box .textwidget a:hover,
                        .sidebar_widget_holder ul li a:hover, .sidebar_widget_holder .bg-widget-center a:hover,
                        .textwidget a:hover, .shortcodes a:hover, #back-top a:hover, #back-top a:hover span,
                        .breadcrumbs-content ul li a:hover, .breadcrumbs-content ul li, #add-items:hover
                        {color:<?php echo '#'.$link_hover_color?>}
                       
                        .sfHover > a{color:<?php echo '#'.$link_hover_color?>!important}
                        
                        /*FOOTER TITLE*/
                        .footer_box h2,  .footer_box #wp-calendar caption, .footer_box thead, .footer_box #today,
                        .recentcomments .url, .footer_box h2 a
                        {color:<?php echo '#'.$footer_title_color?>}

                        /*FOOTER PARAGRAPH*/
                        .footer_box .newsletter span, .footer_box .bg-widget-center span,
                        .footer_box ul li a, .footer_box ul li, .footer_box .bg-widget-center a, .footer_box .twittime,
                        .footer_box tbody, .footer_box .textwidget, .footer_box .tagcloud a, .footer_box tbody a:hover
                        {color:<?php echo '#'.$footer_paragraph_color?>}
                        
                        /*COPYRIGHT COLOR*/
                        .copyrigt-footer-text
                        {color:<?php echo '#'.$copyright_color?>}
                        
                        
                    </style>              
                    
                    
        <?php

        /*************************************************************/
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/


            wp_enqueue_script('jquery');
            wp_enqueue_script('superfish', get_template_directory_uri().'/script/menu/superfish.js' );
            wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js' );
            wp_enqueue_script('pirobox', get_template_directory_uri().'/script/pirobox/js/pirobox.js' );
            wp_enqueue_script('contact', get_template_directory_uri().'/script/contact/contact.js' );
            wp_enqueue_script('easing', get_template_directory_uri().'/script/easing/jquery.easing.1.3.js' );
            wp_enqueue_script('elastic', get_template_directory_uri().'/script/elastic/jquery.elastic.source.js' );
            wp_enqueue_script('jscolor', get_template_directory_uri().'/script/jscolor/jscolor.js' );
            wp_enqueue_script('flexslider', get_template_directory_uri().'/script/flexslider/jquery.flexslider.js' );
            wp_enqueue_script('scroll-button', get_template_directory_uri().'/script/scroll-button/scroll-button.js' );
            wp_enqueue_script('masonry', get_template_directory_uri().'/script/masonry/jquery.masonry.min.js' );
            wp_enqueue_script('isotope', get_template_directory_uri().'/script/isotope/jquery.isotope.min.js' );
            wp_enqueue_script('spiner', get_template_directory_uri().'/script/spiner/spin.min.js' );
            wp_enqueue_script('pinterest', 'http://assets.pinterest.com/js/pinit.js' );
            
            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        ?>

        <?php $favicon = get_theme_option(tk_theme_name.'_general_favicon'); if(empty($favicon)) { $favicon = get_template_directory_uri()."/style/img/favicon.ico"; }?>
        <link rel="shortcut icon" href="<?php echo $favicon;?>" />

        
        <?php

         $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');

         if( isset ($g_analitics) && $g_analitics != ''){
             echo $g_analitics;
         }

        ?>


<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>


<div id="container">
   
    
    <div class="header left">
        <div class="wrapper">

            <div class=" heade-logo-menu left">
    
            <!--LOGO-->
            <div class="logo left">
           <?php
                $logo = get_option(tk_theme_name.'_general_header_logo');
                if(empty($logo)) {
                $logo = get_template_directory_uri()."/style/img/logo.png";
             }?>

                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                <span><?php echo get_option('blogdescription')?></span>
            </div>
                
                <div class="menu-icon-content right">
                    
                    <!--MENU-->
                    <div class="nav-header left">
                        <nav>
                        <?php
                        if ( function_exists('has_nav_menu') && has_nav_menu('primary') ) {
                            $nav_menu = array('title_li'=> '', 'theme_location' => 'primary',   'menu_class'      => 'sf-menu');
                            wp_nav_menu($nav_menu);
                        } else { ?>
                            <ul class="sf-menu">
                                <?php
                                $pageargs = array(
                                        'depth'        => 3,
                                        'title_li'     => '',
                                        'echo'         => 1,
                                        'authors'      => '',
                                        'link_before'  => '',
                                        'link_after'   => '',
                                        'walker' => '' );
                                wp_list_pages($pageargs);?>
                            </ul>
                        <?php } ?>
                        </nav>
                    </div><!--/nav-header-->
                    
           <?php
                $one_nav = get_theme_option(tk_theme_name.'_general_one_nav');
                if($one_nav !== 'yes') {?>

                    <div class="nav-help-header left">
                        <nav>
                        <?php
                        if ( function_exists('has_nav_menu') && has_nav_menu('secondary') ) {
                            $nav_menu = array('title_li'=> '', 'theme_location' => 'secondary',   'menu_class'      => 'sf-menu');
                            wp_nav_menu($nav_menu);
                        } else { ?>
                            <ul class="sf-menu">
                                <?php
                                $pageargs = array(
                                        'depth'        => 3,
                                        'title_li'     => '',
                                        'echo'         => 1,
                                        'authors'      => '',
                                        'link_before'  => '',
                                        'link_after'   => '',
                                        'walker' => '' );
                                wp_list_pages($pageargs);?>
                            </ul>
                        <?php } ?>
                        </nav>
                    </div><!--/nav-help-header-->
            <?php }?>

              <?php
                $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
                $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
                $linkedin_acc = get_theme_option(tk_theme_name.'_social_linked_in');
                $admin_email = get_option('admin_email');
                if( $enable_rss == true || $enable_rss == '' || $twitter_acc == '' || $facebook_acc == '' || $facebook_acc == '' || $rss_acc == '' || $google_acc == '' || $linkedin_acc == '' ){
                ?>
                    
                    <div class="stay-tuned left">
                        <ul><li><?php _e('Stay tuned', tk_theme_name) ?></li></ul>
                        <ul style="margin-left: -7px;">
                            <?php if(!empty($twitter_acc)){ ?><li><a href="http://twitter.com/<?php echo $twitter_acc; ?>" class="stay-tuned-1 left">t</a></li><?php } ?>
                            <?php if(!empty($facebook_acc)){ ?><li><a href="http://facebook.com/<?php echo $facebook_acc; ?>" class="stay-tuned-2 left">f</a></li><?php } ?>
                            <?php if(!empty($linkedin_acc)){ ?><li><a href="<?php echo $linkedin_acc; ?>" class="stay-tuned-3 left">i</a></li><?php } ?>
                            <?php if(!empty($google_acc)){ ?><li><a href="https://plus.google.com/<?php echo $google_acc; ?>" class="stay-tuned-4 left">g</a></li><?php } ?>
                            <?php if ($enable_rss !== ''){?><li><a href="<?php echo get_bloginfo('rss2_url'); ?>" class="icon-header-3">r</a><div class="social-bg"></div></li><?php }else{ if(($rss_acc != '' )){ ?><li><a href="<?php echo $rss_acc; ?>" class="stay-tuned-5 left">r</a></li><?php }else{}}?>
                            <?php if(!empty($admin_email)){ ?><li><a href="mailto:<?php echo $admin_email; ?>" class="stay-tuned-6 left">m</a></li><?php } ?>
                        </ul>
                    </div><!--/stay-tuned-->
                    
                <?php }?>

                </div><!--/menu-icon-content--> 

            </div><!--/heade-logo-menu-->   
                
    <?php if(is_home() || is_page_template('_projects.php')){
        $disable_projects = get_theme_option(tk_theme_name.'_home_disable_home_projects');
        $projects_orderby = get_theme_option(tk_theme_name.'_home_projects_orderby');
        if(empty($projects_orderby)){$projects_orderby = 'slug';}
        $projects_order = get_theme_option(tk_theme_name.'_home_projects_order');
        if(empty($projects_order)){$projects_order = 'ASC';}
        $projects_paged = get_theme_option(tk_theme_name.'_home_projects_paged');
        if(empty($projects_paged) || is_page_template('_projects.php')){$projects_paged = '-1';}
        if($disable_projects == 'yes' && !is_page_template('_projects.php')){}else{
        ?>
            <div class="portfolio-home left">

                <div class="portfolio-home-category left">
                <nav>
                        <div class="yellow-content-47 left">
                            <div class="yellow-left47 left"></div>
                            <div class="yellow-center47 left"><?php _e('see', tk_theme_name)?></div>
                            <div class="yellow-right47 left"></div>
                        </div>
                        <?php
                          global $wpdb;
                          $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'pt_projects' AND post_status = 'publish'");
                          if(!empty ($post_type_ids )){
                            $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_projects',array('orderby' => $projects_orderby, 'order' => $projects_order, 'fields' => 'ids') );
                            if($post_type_cats){
                              $post_type_cats = array_unique($post_type_cats);
                              $allcat = implode(',',$post_type_cats);
                            }
                          }
                          $include_category = null;
                        ?>

                            <ul style="text-align:left" id="filters">
                                <li class="paragraphp cat_cell_active cat_cell" rev="<?php echo $allcat?>" style="margin-left:5px"><a href="#" data-filter="*"><?php _e('All &nbsp;&nbsp;&nbsp;-', tk_theme_name)?></a></li>
                              <?php
                            if(!empty ($post_type_ids )){
                                 $cat_count = count($post_type_cats);
                                 $cat_counter = 1;
                                 foreach ($post_type_cats as $category_list) {
                                    $cat = 	$category_list.",";
                                    $include_category = $include_category.$cat;
                                    $cat_name = get_term($category_list, 'ct_projects');
                                ?>
                                    <li rev="<?php echo $category_list?>" class="cat_cell"><a href="#" data-filter="<?php echo '.class-'.$category_list?>"><?php echo $cat_name->name?> <?php if($cat_count !== $cat_counter){echo '&nbsp;&nbsp;&nbsp;-';}?></a></li>
                                <?php $cat_counter++;} }?>
                            </ul>

                  </nav>         
                </div><!--/portfolio-home-category-->                


                        

                <div class="portfolio-loader" id="portfolio-loader"></div>
                            
                        <div class="ajax_holder" style="width:100%">
                            
                            <div class='portfolio-images left' rev="2">
                                <?php
                                          $id_array = explode(',', $allcat);
                                          $args=array('tax_query' => array(array('taxonomy' => 'ct_projects','field' => 'term_id', 'terms' => $id_array)), 'post_type' => 'pt_projects',  'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>$projects_paged);

                                          //The Query
                                          $the_query = new WP_Query( $args );

                                          //The Loop
                                          if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                                          $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                                          $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                                          $post_category = wp_get_post_terms( $post->ID, 'ct_projects' );
                                          ?>                                          


                                         <?php
                                            $images = '';
                                                    if(!empty($slide_images)){
                                                        if($slide_images[0] != ''){
                                                        $images = '<img src="'.tk_get_thumb_new(229, 171, $slide_images[0]).'"/>';
                                                        }
                                                    
                                            }  ?>

                                              <div class="portfolio-images-one left <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                                                  <?php if($video_link || $images != '' || has_post_thumbnail()){?>
                                                      <?php
                                                          if($video_link) {
                                                              get_video_image($video_link);
                                                          }elseif(has_post_thumbnail()){ 
                                                               the_post_thumbnail('project-home', array('class' => "load-image")); ?>
                                                          <?php
                                                          } elseif (!empty($images)) {
                                                          ?>
                                                              <?php
                                                                
                                                                  echo $images;
                                                                  ?>
                                                                  
                                                          <?php }?>
                                                      <?php }?>   
                                                      <div class="portfolio-hover left">
                                                          <div class="portfolio-hover-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/portfolio-hover-title-->
                                                          <div class="portfolio-hover-text left"><?php the_excerpt_length(55)?></div><!--/portfolio-hover-text-->
                                                          <div class="portfolio-hover-icon left"><a href="<?php the_permalink() ?>" style="<?php if($video_link){echo 'background: url('.get_template_directory_uri().'/style/img/video-ico.png) no-repeat;background-position:top';}elseif(has_post_thumbnail()){echo 'background: url('.get_template_directory_uri().'/style/img/image-ico.png) no-repeat;background-position:top';}elseif(!empty($images)){echo 'background: url('.get_template_directory_uri().'/style/img/slider-ico.png) no-repeat;background-position:top';} ?>"></a></div><!--/portfolio-hover-icon-->
                                                      </div><!--/portfolio-hover-->
                                                      <div class="border-down-images left"></div><!--/border-down-images-->
                                              </div><!--/portfolio-images-one-->


                                                  <?php
                                              endwhile;
                                              // Reset Post Data
                                              wp_reset_postdata();
                                              ?>

                                          <?php else: ?>
                                          <?php endif;?>
                            
                        </div><!--AJAX Holder-->

                
            </div><!--/portfolio-home-->
            

            
    <?php  }}elseif(is_search ()){?>
            
            <div class="title-page left">
                <span><?php _e('Search results:', tk_theme_name)?></span>
            </div><!--/title-page-->
            
    <?php }elseif(is_singular('pt_projects')){
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
        
        ?>
            <div class="portfolio-loader2" id="portfolio-loader2" style="height: 400px;display: inline-block;width: 100%"></div>

            <div class="portfolio-single left" style="display:none">

                <div class="portfolio-single-images left portfolio-img-loaded" id="portfolio-single-images">
                
                <?php
                            $images = '';
                                    if(!empty($slide_images)){
                                        foreach($slide_images as $slide) {

                                        if($slide != ''){
                                        $images .= '<li><img src="'.$slide.'" width="635"/></li>';
                                        }
                                    }
                            }  ?>

                                <?php if($video_link) {?>
                                        <?php tk_video_player($video_link);?>
                                        <div class="border-down-portfolio-single left"></div>
                                        <?php } elseif(!empty($images)) { ?>

                                                <div class="flexslider">
                                                    <ul class="slides portfolio-img-loaded">
                                                        <?php echo $images; ?>
                                                    </ul>
                                                </div><!-- flex slider -->
                                                <div class="border-down-portfolio-single left"></div>

                                                 <?php }  elseif (has_post_thumbnail()) {?>

                                                 <?php 
                                                 tk_thumbnail($post->ID, 'project-single'); ?>
                                                <a href="<?php the_permalink(); ?>"><span></span></a>
                                                <div class="border-down-portfolio-single left"></div>
                                                <?php } ?>



                </div><!--/portfolio-single-images--> 
                    
                <div class="portfolio-single-text-content right">
                    <div class="portfolio-single-nav left">
                        
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        $project_url = get_option('id_projects_page');
                        $disable_projects = get_theme_option(tk_theme_name.'_home_disable_home_projects');
                        ?>      
                        
                        <div class="portfolio-single-prev left"><a <?php if(!empty($prev_post)){?>href="<?php echo $prev_post->guid; ?>"<?php }else echo 'href="#" style="background-position: bottom;"'?>></a></div><!--/portfolio-single-prev--> 
                        <div class="portfolio-single-next left"><a <?php if(!empty($next_post)){?>href="<?php echo $next_post->guid; ?>"<?php }else echo 'href="#" style="background-position: bottom;"'?>></a></div><!--/portfolio-single-next--> 
                        
                        
                        <div class="portfolio-single-home left"><a href="<?php if($disable_projects == 'yes'){echo get_permalink($project_url);}else {echo home_url();}?>"></a></div><!--/portfolio-single-home--> 
                    </div><!--/portfolio-single-nav--> 
                    <div class="portfolio-single-title left"><?php the_title(); ?></div><!--/portfolio-single-title--> 
                    <div class="portfolio-single-text left">
                            <div class="shortcodes left">
                                <?php
                                    wp_reset_query();
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                        endwhile;
                                    else:
                                    endif;
                                    wp_reset_query();
                                    ?>
                            </div><!--/post-single-text-->
                    </div><!--/portfolio-single-text--> 
                </div><!--/portfolio-single-text-content--> 
                                  
            </div><!--/portfolio-single-->       
            
            
            
    <?php }else{
        $blog_name = get_option('title_blog_page');
        ?>
            
            <div class="title-page left">
                <span><?php if(is_archive()){}elseif(is_singular('post')){echo $blog_name;}else{the_title();}?></span>
                <div class="breadcrumbs-content">
                    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                </div><!--/breadcrumbs-content-->
            </div><!--/title-page-->
            
    <?php }?>

        </div><!--/heade-left-->   
        </div><!--/heade-logo-menu-->   
        </div><!--/heade-logo-menu-->   
