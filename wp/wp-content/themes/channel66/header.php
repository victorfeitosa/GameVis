<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

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



<?php

        /*************************************************************/
        /*Test user agent and load css for it***************************/
        /*************************************************************/


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
                <script src="./script/respond/respond.src.js"></script>
            <?php
        }

        if (strpos($browser, 'MSIE 9.0')) {
            ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/ie9.css" type="text/css" />
            <?php
        }

        if (strpos($browser, 'Chrome')) {

            if(!empty($win)) {
                if($win == 'Windows') { ?>
                    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/win-chrome.css" type="text/css" />
                <?php
                }
            }
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
        /************LOAD SCRIPTS***********************************/
        /*************************************************************/


            wp_deregister_script('jquery');
            wp_register_script('jquery', get_template_directory_uri().'/script/jquery/jquery-1.7.2.min.js');
            wp_enqueue_script('jquery');
            wp_enqueue_script('superfish', get_template_directory_uri().'/script/menu/superfish.js' );
            wp_enqueue_script('ajaxpager', get_template_directory_uri() . '/script/quickpager/quickpager.jquery.js');
            wp_enqueue_script('my-commons', get_template_directory_uri().'/script/common.js' );
            wp_enqueue_script('pirobox', get_template_directory_uri().'/script/pirobox/js/pirobox.js' );
            wp_enqueue_script('contact', get_template_directory_uri().'/script/contact/contact.js' );
            wp_enqueue_script('easing', get_template_directory_uri().'/script/easing/jquery.easing.1.3.js' );
            wp_enqueue_script('elastic', get_template_directory_uri().'/script/elastic/jquery.elastic.source.js' );
            wp_enqueue_script('jscolor', get_template_directory_uri().'/script/jscolor/jscolor.js' );
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

        $title_color = get_post_meta($post->ID, 'tk_color', true);
        ?>
        <style type="text/css">
            .title-page {
                background-color: #<?php echo $title_color?>!important;
            }
        </style>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113020565471594";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><!-- check -->


<div id="container">

    <?php
    $disable_category = get_theme_option(tk_theme_name.'_home_disable_category_nav');
    if($disable_category !== 'yes') {
    ?>


    <!-- HEADER -->
    <div class="header left">

        <div class="header-category left">
            <div class="wrapper">
                    <div class="header-category-nav left">
                        <ul>
                        <?php
                        $all_cat = get_categories();
                        foreach ($all_cat as $one_cat){
                            query_posts(array('cat' => $one_cat->cat_ID, 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 1, 'ignore_sticky_posts'=> 1));
                            if ( have_posts() ){?>
                            <li><a href="<?php echo get_category_link( $one_cat->cat_ID );?>" title="<?php echo  $one_cat->name ;?>"><?php echo  $one_cat->name ;?></a></li>
                            <?php };
                        }
                        wp_reset_query();
                        ?>
                        </ul>
                    </div><!--/header-category-nav-->

                        <?php get_search_form();?>
                    
            </div><!--/wrapper-->
        </div><!--/header-category-->

        <?php }?>

<?php

        /*************************************************************/
        /************HEADER FOR FRONT PAGE***********************/
        /*************************************************************/

if(is_front_page()){?>

    	<div class="wrapper">
            <div class="header-post-nav-content left">

            <!--LOGO-->
            <div class="logo left">
           <?php
                $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                if(empty($logo)) {
                $logo = get_template_directory_uri()."/style/img/logo.png";
             }?>

                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
            </div>

            
                <?php
                $args=array('post_status' => 'publish', 'posts_per_page' => 1, 'ignore_sticky_posts'=> 1);

                //The Query
                query_posts($args);
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large-image');
                ?>

                    <div class="first-post-home left">
                        <?php if(has_post_thumbnail()) {?>
                                    <img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" />
                        <?php }?>
                        <div class="first-post-home-text left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/first-post-home-text-->
                    </div><!--/first-post-home-->

                <?php  endwhile;?>
                <?php else: ?>
                <?php endif; ?>

                    <!--MENU-->
                    <nav>

                        <!--MENU-->
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

                <?php
                wp_reset_postdata();
                $the_query = new WP_Query( array( 'posts_per_page' => 1, 'offset' => 1 ) );
                while ( $the_query->have_posts() ) : $the_query->the_post();
                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium-image');
                ?>

                <div class="post-home header-post-home blog-post-none left">
                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>" class="pirobox" title="<?php the_title(); ?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a>
                    <div class="hover-post-home">
                        <span><?php the_title()?></span>
                        <a href="<?php the_permalink()?>"></a>
                    </div><!--/hover-post-home-->
                </div><!--/fpost-home-->
                <?php
                endwhile;

                // Reset Post Data
                wp_reset_postdata();
                ?>

            </div><!--header-post-nav-content-->
        </div><!--/wrapper-->
    <?php


        /*************************************************************/
        /************HEADER FOR SINGLE PAGE***********************/
        /*************************************************************/

    }elseif(is_single()){?>

        
<div class="wrapper">
            <div class="header-post-nav-content left">

            <!--LOGO-->
            <div class="logo left">
           <?php
                $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                if(empty($logo)) {
                $logo = get_template_directory_uri()."/style/img/logo.png";
             }?>

                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
            </div>

                    <div class="first-post-home left">
                        <?php if(has_post_thumbnail()) {
                            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large-image');
                            ?>
                                    <img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" />
                        <?php }?>
                        <div class="first-post-home-text left"><a href="<?php the_permalink()?>"><?php the_title()?></a></div><!--/first-post-home-text-->
                    </div><!--/first-post-home-->

                    <!--MENU-->
                    <nav>

                        <!--MENU-->
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

                <?php
                $prev_post = get_previous_post();
                if(!empty ($prev_post)){
                    $prev_post = get_previous_post();
                }else{
                    $prev_post = query_posts( array( 'posts_per_page' => 1 ));
                    $prev_post = $prev_post[0];
                }
                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'medium-image');
                ?>
                <div class="post-home header-post-home blog-post-none left">
                    <a href="<?php echo get_permalink($prev_post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a>
                    <div class="hover-post-home">
                        <span><?php echo get_the_title($prev_post->ID)?></span>
                        <a href="<?php echo get_permalink($prev_post->ID)?>"></a>
                    </div><!--/hover-post-home-->
                </div><!--/fpost-home-->

            </div><!--header-post-nav-content-->
        </div><!--/wrapper-->

    <?php


        /*************************************************************/
        /************HEADER FOR AUTHOR PAGE**********************/
        /*************************************************************/


    }elseif(is_author()){
        $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
        $author_firstname = get_the_author_meta( 'user_firstname', $curauth->ID );
        $author_lastname = get_the_author_meta( 'user_lastname', $curauth->ID );
        ?>

    	<div class="wrapper">
            <div class="header-post-nav-content left">


                <!--LOGO-->
                <div class="logo left">
               <?php
                    $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                    if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }?>

                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
                </div>

                <div class="title-page left"><h1><?php echo $author_firstname?> <?php echo $author_lastname?></h1></div><!--/title-page-->

                    <!--MENU-->
                    <nav>

                        <!--MENU-->
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


            </div><!--header-post-nav-content-->
        </div><!--/wrapper-->

    <?php


        /*************************************************************/
        /************HEADER FOR ARCHIVE PAGE**********************/
        /*************************************************************/

    }elseif(is_archive()){
        @$cats = get_the_category($post->ID);
        ?>

    	<div class="wrapper">
            <div class="header-post-nav-content left">


                <!--LOGO-->
                <div class="logo left">
               <?php
                    $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                    if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }?>

                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
                </div>

                <div class="title-page left"><h1><?php echo @$cats[0]->name;?></h1></div><!--/title-page-->

                    <!--MENU-->
                    <nav>

                        <!--MENU-->
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


            </div><!--header-post-nav-content-->
        </div><!--/wrapper-->
    <?php


        /*************************************************************/
        /************HEADER FOR SEARCH PAGE**********************/
        /*************************************************************/

    }elseif(is_search()){
        ?>

    	<div class="wrapper">
            <div class="header-post-nav-content left">


                <!--LOGO-->
                <div class="logo left">
               <?php
                    $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                    if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }?>

                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
                </div>

                <div class="title-page left"><h1><?php _e("Search Result", tk_theme_name)?></h1></div><!--/title-page-->

                    <!--MENU-->
                    <nav>

                        <!--MENU-->
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


            </div><!--header-post-nav-content-->
        </div><!--/wrapper-->


    <?php


        /*************************************************************/
        /************HEADER FOR OTHER PAGES**********************/
        /*************************************************************/

    }else{?>

    	<div class="wrapper">
            <div class="header-post-nav-content left">


                <!--LOGO-->
                <div class="logo left">
               <?php
                    $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                    if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }?>

                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='logo' /></a>
                </div>

                <div class="title-page left"><h1><?php the_title();?></h1></div><!--/title-page-->

                    <!--MENU-->
                    <nav>

                        <!--MENU-->
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


            </div><!--header-post-nav-content-->
        </div><!--/wrapper-->

    <?php }?>
    </div><!--/header-->
