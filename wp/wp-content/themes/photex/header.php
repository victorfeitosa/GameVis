<!DOCTYPE html>
<!--[if IE 8]>    <html class="ie8"> <![endif]-->
<!--[if IE 9]>    <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html  class="no-js" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
  <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta charset="<?php bloginfo('charset'); ?>"/>

  <title>
        <?php
        global $page, $paged;

        wp_title('|', true, 'right');

        bloginfo('name');

        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() ))
            echo " | $site_description";

        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'tkingdom'), max($paged, $page));
        ?>
  </title>

  <link rel="profile" href="http://gmpg.org/xfn/11"/>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

  <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/script/html5.js" type="text/javascript"></script>
  <![endif]-->

  <?php
      // *** get custom favicon
      $favicon = get_option(wp_get_theme()->name . '_general_favicon'); if (empty($favicon)) {
      $favicon = get_template_directory_uri() . "/theme-images/favicon.ico";
  }?>
  <link rel="shortcut icon" href="<?php echo $favicon; ?>"/>

  <?php
  // *** get google analitics code
  $g_analitics = get_option(wp_get_theme()->name . '_general_google_analytics');
  if (isset ($g_analitics) && $g_analitics != '') {
      echo $g_analitics;
  }
  ?>

  <?php //Facebook OG Meta
    if ( is_singular()) {//if it is not a post or a page
    $tk_post_id = get_the_ID();   
      echo '<meta property="og:title" content="' . get_the_title($tk_post_id) . '"/>';
      echo '<meta property="og:type" content="article"/>';
      echo '<meta property="og:url" content="' . get_permalink($tk_post_id) . '"/>';
      echo '<meta property="og:site_name" content="' . get_bloginfo() . '"/>';
      if(!has_post_thumbnail( $tk_post_id )) { //the post does not have featured image, use a default image
              $default_image = get_option(wp_get_theme()->name . '_general_header_logo'); //replace this with a default image on your server or an image in your media library
              echo '<meta property="og:image" content="' . $default_image . '"/>';
      }
      else{
              $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $tk_post_id ), 'medium' );
              echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
      }
      echo "
      ";
    }
    ?>

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php if (!isset($content_width)) $content_width = 870; ?>

 <?php
    // *** get navigation ***
    get_template_part('templates/parts/navigation');
    ?>


<?php 
  get_template_part('/templates/parts/contact', 'popup'); 
?>


  <div class="md-overlay"></div>

  <aside class="main-button-holder">
    <a href="#" class="md-trigger btn primary-color-btn" data-modal="modal-5"><i class="icon-mail"></i></a>
    <?php //Woocommerce Shoping Cart
      $header_cart = get_theme_option(wp_get_theme()->name . '_woocommerce_header_cart');

      if ($header_cart != '') { ?>
          <div class="tk-header-cart-holder hide-under">
              <?php global $woocommerce; ?>
                      <div class="cart-menu-wrap">
                        <div class="cart-menu">
                          <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="cart-icon-wrap"><i class="icon-cart"></i> <div class="cart-wrap"><span><?php echo $woocommerce->cart->cart_contents_count; ?> </span></div> </div></a>
                        </div>
                      </div>

                      <?php
                              // Check for WooCommerce 2.0 and display the cart widget
                              if(version_compare(WOOCOMMERCE_VERSION, "2.0.0") >= 0) {
                                  the_widget('WC_Widget_Cart', 'title= ');
                              } else {
                                  the_widget('WooCommerce_Widget_Cart', 'title= ');
                              }
                      ?>
          </div>
      <?php } ?> 
  </aside>

  <div id="preloader">
    <div class="loader">&nbsp;</div>
  </div>