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


<!--[if IE 8]>
<link rel="stylesheet" href="style/ie8.css" media="screen, projection" type="text/css" >
<![endif]-->

<!--[if IE 9]>
<link rel="stylesheet" href="style/ie9.css" media="screen, projection" type="text/css" >
<![endif]-->


<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->
    
        <!-- Favicon -->
        <?php $favicon = get_theme_option(tk_theme_name.'_general_favicon'); if(empty($favicon)) { $favicon = get_template_directory_uri()."/style/img/favicon.ico"; }?>
        <link rel="shortcut icon" href="<?php echo $favicon;?>" />

    <!-- Google Analitics -->    
    <?php
        $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');
        if( isset ($g_analitics) && $g_analitics != ''){
            echo $g_analitics;
        }
    ?>


<?php wp_head();?>
</head>
<body <?php body_class(); ?> >
<?php if ( ! isset( $content_width ) ) $content_width = 980; ?>
    
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113020565471594";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>    

<div id="container">



    <!-- HEADER -->
    <div class="header left">
        <div class="border-header left"></div><!--/border-header-->
    	<div class="wrapper">

            <!--LOGO-->
            <?php
            $logo = get_option(tk_theme_name . '_general_header_logo');
            if (empty($logo)) {
                $logo = get_template_directory_uri() . "/style/img/logo.png";
            }
            ?>
            
            <div class="logo left">
                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo ?>" alt="<?php bloginfo('name') ?>" title="<?php bloginfo('name') ?>" /></a>
                <span><?php echo get_bloginfo ( 'description' ); ?></span>
            </div><!--/logo-->

            <!--SOCIAL ICONS-->
            <div class="links-header right">
                
                      <?php /*---SOCIAL ICONS---*/
                        $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                        $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                        $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                        $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');

                        if ($twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '') {
                            ?>
                
                <ul>
                     <li><span><?php _e('Stay tuned', 'eventor') ?></span></li>
                        <?php if (!empty($twitter_acc)) { ?>
                            <li>
                                <a href="http://twitter.com/<?php echo $twitter_acc; ?>" class="icon-header-1"></a>
                                <div class="soc-icon-bg"></div>
                            </li>
                        <?php } ?>

                        <?php if (!empty($facebook_acc)) { ?>
                            <li>
                                <a href="http://facebook.com/<?php echo $facebook_acc; ?>" class="icon-header-2"></a>
                                <div class="soc-icon-bg"></div>
                            </li>
                        <?php } ?>

                        <?php if (($rss_acc != '')) { ?>
                        <li>
                            <a href="<?php echo $rss_acc; ?>" class="icon-header-3"></a>
                            <div class="soc-icon-bg"></div>
                        </li>
                        <?php } ?>

                        <?php if (!empty($google_acc)) { ?>
                            <li>
                                <a href="http://plus.google.com/<?php echo $google_acc; ?>" class="icon-header-4"></a>
                                <div class="soc-icon-bg"></div>
                            </li>
                        <?php } ?>
                </ul>
                        <?php } // if check one by one?>

            </div><!--/links-header-->
        </div><!--/wrapper-->


        <!--MENU-->
        <div class="nav left">
            
            <div class="wrapper">
                <div class="button-menu"><a href="#"></a></div><!--/button-menu-->
            </div><!--/wrapper-->
            
            <nav>
            <div class="wrapper">
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
            </div><!--/wrapper-->
            </nav>

        </div><!--/nav-->
    </div><!--/header-->