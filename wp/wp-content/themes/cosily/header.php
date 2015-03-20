<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
    
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
                <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
                
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
          <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,700' rel='stylesheet' type='text/css'/>
          <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'/>
          <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700' rel='stylesheet' type='text/css'/>


        <?php $favicon = get_theme_option(tk_theme_name.'_general_favicon'); if(empty($favicon)) { $favicon = get_template_directory_uri()."/style/img/favicon.ico"; }?>
        <link rel="shortcut icon" href="<?php echo $favicon;?>" />

        
    <?php
        $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');
        if( isset ($g_analitics) && $g_analitics != ''){
            echo $g_analitics;
        }
    ?>


<?php wp_head();?>
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
}(document, 'script', 'facebook-jssdk'));</script>

<div id="container">
    <!-- HEADER -->
    <div class="header left">
        <?php /*header contact information*/
            $header_telephone = get_theme_option(tk_theme_name.'_general_header_telephone');
            $header_email = get_theme_option(tk_theme_name.'_general_header_email');
            $header_address= get_theme_option(tk_theme_name.'_general_header_address');
        ?>

        <div class="bg-top-bar left">
            <div class="wrapper">
                
                <?php if(!empty($header_telephone) || !empty($header_email) || !empty($header_address)) { ?>
                
                <div class="header-contact left">
                    <div class="button-header-contact left"><a href="#">Contact</a></div>
                    
                    <div class="header-contact-content left">
                        
                        <?php if(isset($header_telephone)){?>
                        <div class="header-tel left">
                            <img src="<?php echo get_template_directory_uri()?>/style/img/header-tel.png" alt="img" title="img" />
                            <span><?php echo $header_telephone ?></span>
                        </div><!--/header-tel-->
                        <?php } ?>

                        
                        <?php if(isset($header_email)){?>
                        <div class="header-mail left">
                            <img src="<?php echo get_template_directory_uri()?>/style/img/header-mail.png" alt="img" title="img" />
                            <span><?php echo $header_email ?></span>
                        </div><!--/header-mail-->
                        <?php } ?>

                        <?php if(isset($header_address)) { ?>
                        <div class="header-address left">
                            <img src="<?php echo get_template_directory_uri() ?>/style/img/header-address.png" alt="img" title="img" />
                            <span><?php echo $header_address ?></span>
                        </div><!--/header-address-->
                        <?php } ?>

                    </div>
                </div>

                <?php } ?>
                
                
                <div class="soc-icons right">
                    <ul>
                        <?php /*---SOCIAL ICONS---*/
                            $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                            $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                            $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                            $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
                            $linkedin_acc = get_theme_option(tk_theme_name.'_social_linkedin');
                            $instagram_acc = get_theme_option(tk_theme_name . '_social_instagram');
                            $flickr_acc = get_theme_option(tk_theme_name . '_social_flickr');
                        
                            if ($twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $linkedin_acc != '' || $instagram_acc != '' || $flickr_acc != '') {
                                ?>

                                    <?php if (!empty($flickr_acc)) { ?>
                                          <li><div class="soc-icon-1 left"><a href="http://flickr.com/<?php echo $flickr_acc; ?>" ></a></div></li>
                                    <?php } ?>

                                    <?php if (!empty($instagram_acc)) { ?>
                                         <li><div class="soc-icon-2 left"><a href="http://instagram.com/<?php echo $instagram_acc; ?>" ></a></div></li>
                                    <?php } ?>

                                    <?php if (!empty($twitter_acc)) { ?>
                                        <li><div class="soc-icon-3 leftt"><a href="http://twitter.com/<?php echo $twitter_acc; ?>" ></a></div></li>
                                    <?php } ?>

                                    <?php if (!empty($facebook_acc)) { ?>
                                        <li><div class="soc-icon-4 left"><a href="http://facebook.com/<?php echo $facebook_acc; ?>" ></a></div></li>
                                    <?php } ?>

                                    <?php if (($rss_acc != '')) { ?>
                                    <li><div class="soc-icon-5 left"><a href="<?php echo $rss_acc; ?>"></a></div></li>
                                    <?php } ?>

                                    <?php if (!empty($linkedin_acc)) { ?>
                                        <li><div class="soc-icon-6 left"><a href="<?php echo $linkedin_acc; ?>"></a></div></li>
                                    <?php } ?>

                                    <?php if (!empty($google_acc)) { ?>
                                        <li><div class="soc-icon-7 left"><a href="https://plus.google.com/<?php echo $google_acc; ?>"></a></div></li>
                                    <?php } ?>
                                <?php } // if check one by one?>
                    </ul>
                </div><!--/soc-icons-->
            </div><!--/wrapper-->
        </div><!--/bg-top-bar-->

        
        

        <div class="menu-logo-content left">
            <div class="wrapper">

               <?php     
                if (has_nav_menu('secondary')) {
                    $logo_margin_top = get_option(tk_theme_name . '_general_logo_margin_top');
                    $logo_margin_left = get_option(tk_theme_name . '_general_logo_margin_left');
                    $logo_margin_bottom = get_option(tk_theme_name . '_general_logo_margin_bottom');
                    $menu_margin_top = get_option(tk_theme_name . '_general_menu_margin_top');
               ?>
                
                                <!--MENU-->
                <div class="nav nav1 left" style="margin-top:<?php echo $menu_margin_top?>px">
                    <nav>
                        <?php
                        if (function_exists('has_nav_menu') && has_nav_menu('primary')) {
                            $nav_menu = array('title_li' => '', 'theme_location' => 'primary', 'menu_class' => 'sf-menu');
                            wp_nav_menu($nav_menu);
                        } else {
                            ?>
                            <ul class="sf-menu">
                                <?php
                                $pageargs = array(
                                    'depth' => 3,
                                    'title_li' => '',
                                    'echo' => 1,
                                    'authors' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'walker' => '');
                                wp_list_pages($pageargs);
                                ?>
                            </ul>
                        <?php }  // if function exists?>
                    </nav>
                </div><!--/nav-->




                <!--LOGO-->
                <?php
                    $logo = get_option(tk_theme_name . '_general_header_logo');
                    if (empty($logo)) {
                    $logo = get_template_directory_uri() . "/style/img/logo.png";
                    }
                    ?>
                <div class="logo left">
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>" style="margin-top:<?php echo $logo_margin_top ?>px;margin-left:<?php echo $logo_margin_left ?>px;margin-bottom:<?php echo $logo_margin_bottom ?>px"/></a>
                </div><!--/logo-->


                <!--MENU-->
                <div class="nav nav2 right" style="margin-top:<?php echo $menu_margin_top?>px">
                    <nav>
                        <?php
                        if (function_exists('has_nav_menu') && has_nav_menu('secondary')) {
                            $nav_menu = array('title_li' => '', 'theme_location' => 'secondary', 'menu_class' => 'sf-menu');
                            wp_nav_menu($nav_menu);
                        } else {
                            ?>
                            <ul class="sf-menu">
                                <?php
                                $pageargs = array(
                                    'depth' => 3,
                                    'title_li' => '',
                                    'echo' => 1,
                                    'authors' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'walker' => '');
                                wp_list_pages($pageargs);
                                ?>
                            </ul>
                        <?php }  // if function exists?>
                    </nav>
                </div><!--/nav-->
                
                <?php } else { ?>
                

                <!--LOGO-->
                <div class="logo left">
                    <?php
                    $logo = get_option(tk_theme_name . '_general_header_logo');
                    $logo_margin_top = get_option(tk_theme_name . '_general_logo_margin_top');
                    $logo_margin_left = get_option(tk_theme_name . '_general_logo_margin_left');
                    $logo_margin_bottom = get_option(tk_theme_name . '_general_logo_margin_bottom');
                    $menu_margin_top = get_option(tk_theme_name . '_general_menu_margin_top');
                    
                    if (empty($logo)) {
                        $logo = get_template_directory_uri() . "/style/img/logo.png";
                    }
                    ?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>" style="margin-top:<?php echo $logo_margin_top ?>px;margin-left:<?php echo $logo_margin_left ?>px;margin-bottom:<?php echo $logo_margin_bottom ?>px"/></a>
                </div><!--/logo-->


                <!--MENU-->
                <div class="nav nav2 left" style="margin-top:<?php echo $menu_margin_top?>px">
                    <nav>
                        <?php
                        if (function_exists('has_nav_menu') && has_nav_menu('primary')) {
                            $nav_menu = array('title_li' => '', 'theme_location' => 'primary', 'menu_class' => 'sf-menu');
                            wp_nav_menu($nav_menu);
                        } else {
                            ?>
                            <ul class="sf-menu">
                                <?php
                                $pageargs = array(
                                    'depth' => 3,
                                    'title_li' => '',
                                    'echo' => 1,
                                    'authors' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'walker' => '');
                                wp_list_pages($pageargs);
                                ?>
                            </ul>
                        <?php }  // if function exists?>
                    </nav>
                </div><!--/nav-->
              <?php } ?>
            </div><!--/wrapper-->
        </div><!--/menu-logo-content-->
    </div><!--/header-->