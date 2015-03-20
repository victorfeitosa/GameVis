<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
                
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

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>

        <link href='http://fonts.googleapis.com/css?family=Asap:bold%20700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>

        <!--[if IE 8]>
        <link href="<?php echo get_template_directory_uri(); ?>/style/ie8-media.css" media="screen and (min-width: 250px;)" rel="stylesheet"/>
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
    /*gets css for color change*/
    get_template_part('/inc/change-colors');
    wp_head();
?>
</head>

<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>

    

<div id="container">
    <div class="wrapper <?php if(is_front_page() || is_archive() || is_search() || is_single()) { ?>wrap-full<?php } ?>">

        <!-- HEADER -->
        <div class="header left">

               <?php
                    $logo = get_theme_option(tk_theme_name.'_general_header_logo');
                    if(empty($logo)) {
                    $logo = get_template_directory_uri()."/style/img/logo.png";
                 }?>



            <div class="scrollhider">
                 <div class="scroll">
                        <!--LOGO-->
                        <div class="logo left"><a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="logo" /></a><span><?php echo get_bloginfo('description'); ?></span></div><!--/logo-->

                        <!--MENU-->
                        <div class="button-menu"><a href="#"></a></div><!--/button-menu-->
                            <div class="nav active-nav right">
                                <?php
                                if ( function_exists('has_nav_menu') && has_nav_menu('primary') ) {
                                    $nav_menu = array('title_li'=> '', 'theme_location' => 'primary',   'menu_class'      => 'sf-menu');
                                    wp_nav_menu($nav_menu);
                                } else {
                                    $pageargs = array(
                                        'depth'        => 3,
                                        'title_li'     => '',
                                        'echo'         => 1,
                                        'authors'      => '',
                                        'link_before'  => '',
                                        'link_after'   => '',
                                        'walker' => '' );
                                    ?>

                                        <ul>
                                            <?php
                                                wp_list_pages($pageargs);
                                            ?>
                                        </ul>

                                     <?php } ?>
                    </div><!--/nav-->
              </div><!-- scroll -->
            </div><!-- scroll-hider -->
       
      

          <?php
            $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
            $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
            $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
            $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
            $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
            $linkedin = get_theme_option(tk_theme_name.'_social_linkedin');
            $pinterest = get_theme_option(tk_theme_name.'_social_pinterest');
            $emailaddress =  get_option('admin_email');
            if( $enable_rss == true || !empty ($twitter_acc)  || !empty ($facebook_acc) || !empty($facebook_acc) || !empty($rss_acc) || !empty($google_acc) || !empty($pinterest)){
            ?>

            <div class="soc-ikons">
                <ul>
                    <?php if($facebook_acc) { ?>
                        <li><div class="soc-ikons-1 left"><a href="http://facebook.com/<?php echo $facebook_acc; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($twitter_acc){ ?>
                        <li><div class="soc-ikons-2 left"><a href="http://twitter.com/<?php echo $twitter_acc; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($google_acc){  ?>
                        <li><div class="soc-ikons-3 left"><a href="http://plus.google.com/<?php echo $google_acc; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($linkedin) { ?>
                        <li><div class="soc-ikons-4 left"><a href="<?php echo $linkedin; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($pinterest) { ?>
                        <li><div class="soc-ikons-5 left"><a href="http://pinterest.com/<?php echo $pinterest; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($rss_acc) { ?>
                        <li><div class="soc-ikons-6 left"><a href="<?php echo $rss_acc; ?>"></a></div></li>
                    <?php } ?>
                </ul>
            </div>

            <?php } ?>

        </div><!--/header-->