<?php session_start(); ?>
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
        
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 9]>
   <script>
      document.createElement('nav');
   </script>
<![endif]-->


        <?php $favicon = get_theme_option(tk_theme_name.'_general_favicon'); if(empty($favicon)) { $favicon = get_template_directory_uri()."/style/img/favicon.ico"; }?>
        <link rel="shortcut icon" href="<?php echo $favicon;?>" />

        
    <?php
        $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');
        if( isset ($g_analitics) && $g_analitics != ''){
            echo $g_analitics;
        }
    ?>


    <?php
        wp_head(); 
        include('inc/change-colors.php');
     ?>

</head>

<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>

<div id="container">



    <!-- HEADER -->
    <div class="header left">
        
        <div class="top-header-border left"></div><!--/top-header-border-->
        
        <div class="bg-nav-header left">
            <div class="wrapper">

                <?php if(!is_front_page()){?>
                    <!--LOGO-->
                    <div class="logo2 left">
                   <?php
                        $logo = get_option(tk_theme_name.'_general_header_logo');
                        if(empty($logo)) {
                        $logo = get_template_directory_uri()."/style/img/logo2.png";
                     }?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                    </div>
                
                <?php }?>
                
            <!--MENU-->
                <nav <?php if(!is_front_page()){echo 'class="right"';}?>>
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

            </div><!--/wrapper-->            
        </div><!--/bg-nav-header-->
        
        
    </div><!--/header-->
    
    