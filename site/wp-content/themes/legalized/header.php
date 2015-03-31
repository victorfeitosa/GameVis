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


    <!-- Google Analytics code -->    
    <?php
        $g_analitics = get_theme_option(tk_theme_name.'_general_google_analytics');
        if( isset ($g_analitics) && $g_analitics != ''){
            echo $g_analitics;
        }
    ?>


<?php wp_head();?>
<!-- Custom CSS -->
<?php 
    $custom_css = get_theme_option(tk_theme_name.'_custom_style_custom_css');
    if(isset($custom_css) && $custom_css !== ''){
        echo '<style type="text/css">'.$custom_css.'</style>';
    } 
?>
</head>

<body <?php body_class(); ?>>
<?php if ( ! isset( $content_width ) ) $content_width = 940; ?>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113020565471594";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <?php
        $header_left_text = get_theme_option(tk_theme_name . '_general_header_left_text');
        $header_button_text = get_theme_option(tk_theme_name . '_general_header_button_text');
        $header_button_url = get_theme_option(tk_theme_name . '_general_header_button_url');
        $header_right_text = get_theme_option(tk_theme_name . '_general_header_right_text');
        
        $show_slider = get_theme_option(tk_theme_name.'_general_enable_slider');

        $logo = get_theme_option(tk_theme_name.'_general_header_logo');

        $logo_margin_top = get_option(tk_theme_name . '_general_header_margin_top');
        $logo_margin_bottom = get_option(tk_theme_name . '_general_header_margin_bottom');
        $logo_margin_left = get_option(tk_theme_name . '_general_header_margin_left'); 
    ?>


<div id="container">
    <div class="container-narrow">
        
        <!-- Pre Header/Top -->
        <header>
            <div class="top">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- Logo -->
                            <div class="logo" style="margin-top:<?php echo $logo_margin_top ?>px;margin-bottom:<?php echo $logo_margin_bottom ?>px;margin-left:<?php echo $logo_margin_left ?>px;">
                                <?php
                                    if (empty($logo)) {
                                        $logo = get_template_directory_uri() . "/style/images/logo.png";
                                    } else {
                                        $logo = get_option(tk_theme_name . '_general_header_logo');
                                    }
                                ?>
                                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                            </div>
                            <!-- Site description -->
                            <h2 class="site_heading"><?php bloginfo('description') ?></h2>
                            <!-- Contact -->
                            <?php 
                                $phone = get_option(tk_theme_name . '_general_header_contact_phone');
                                $email = get_option(tk_theme_name . '_general_header_contact_email');
                            ?>
                            <?php if (!empty($phone) || !empty($email)) { ?>
                                <div class="header_contact rounded">
                                    <?php if (!empty($phone)) { ?>
                                        <div class="phone"><img src="<?php echo get_template_directory_uri(); ?>/style/images/icon-phone.png" alt="phone icon" /><span><?php echo stripslashes($phone); ?></span></div>
                                    <?php } ?>
                                    <?php if (!empty($email)) { ?>
                                        <div class="email"><img src="<?php echo get_template_directory_uri(); ?>/style/images/icon-letter.png" alt="letter icon" /><span><a href="mailto:<?php echo $email; ?>"><?php echo stripslashes($email); ?></a></span></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div><!-- .top -->
            
            <?php if (function_exists('has_nav_menu') && has_nav_menu('primary')) { ?>
            <!-- Main Navigation -->
            <div class="menu_wrap">
                <div class="container">
                    <div class="navbar navbar-inverse navbar-relative-top">
                      <div class="navbar-inner">
                        <div class="container">
                          <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </a>
                          <div class="nav-collapse collapse navbar-responsive-collapse">
                 
                                <?php                   
                                
                                    wp_nav_menu( array(
                                        'menu'       => 'primary',
                                        'theme_location' => 'primary',
                                        'depth'      => 0,
                                        'container'  => false,
                                        'menu_class' => 'nav',
                                        'fallback_cb' => 'wp_page_menu',
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        //Process nav menu using our custom nav walker
                                        'walker' => new twitter_bootstrap_nav_walker()));                                       
                                ?>
                              
                          </div>
                        </div>
                      </div><!-- /navbar-inner -->
                    </div>
                </div>
            </div><!-- /menu_wrap -->      
            <?php } ?>

            <div class="row-fluid">
                <img src="<?php echo get_template_directory_uri();?>/style/images/shadow-divider.png" class="shadow_divider"  alt="divider"/>
            </div>
        </header>

    
