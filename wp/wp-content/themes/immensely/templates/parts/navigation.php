<!-- HEADER -->

<?php $fixed_header = get_theme_option(wp_get_theme()->name . '_general_fixed_header'); ?>
<div class="fake-navbar <?php if($fixed_header) { echo 'fixed'; } ?>">    
    <?php
        $logo = get_option(wp_get_theme()->name . '_general_header_logo');
        if (empty($logo)) {
            $logo = get_template_directory_uri() . "/theme-images/logo.png";
        } else {
            $logo = get_option(wp_get_theme()->name .'_general_header_logo');
        } ?>
    <img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/>
</div>

    <div class="navbar navbar-inverse navbar-fixed-top <?php if($fixed_header) { echo 'fixed'; } ?>" id="fixedheader">
      <div class="navbar-inner">
        <div class="container">
          <div class="search-big">
            <form action="<?php echo home_url( '/' )?>" method="get">
                <input class="pan3" name="s" id="s" type="text" placeholder="<?php _e('Type and hit enter...', 'tkingdom')?>" value="<?php the_search_query(); ?>">
            </form>
            <i class="fa fa-times close-search"></i>
          </div>
            <?php
            $logo = get_option(wp_get_theme()->name . '_general_header_logo');
            if (empty($logo)) {
                $logo = get_template_directory_uri() . "/theme-images/logo.png";
            } else {
                $logo = get_option(wp_get_theme()->name . '_general_header_logo');
            }
            ?>
            <a class="brand" href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
            
            <div class="element-wrap">
                <button type="button" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                </button>

                <?php 
                    $header_cart = get_theme_option(wp_get_theme()->name . '_woocommerce_header_cart');

                    if ($header_cart != '') { ?>
                        <div class="tk-header-cart-holder hide-under">
                            <?php global $woocommerce; ?>
                                    <div class="cart-menu-wrap">
                                            <div class="cart-menu">
                                                    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="cart-icon-wrap"><i class="icon-shopping-cart"></i> <div class="cart-wrap"><span><?php echo $woocommerce->cart->cart_contents_count; ?> </span></div> </div></a>
                                            </div>
                                    </div>

                                    <?php
                                            // Check for WooCommerce 2.0 and display the cart widget
                                            if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
                                                    the_widget( 'WC_Widget_Cart', 'title= ' );
                                            } else {
                                                    the_widget( 'WooCommerce_Widget_Cart', 'title= ' );
                                            }
                                    ?>
                        </div>
                    <?php } ?> 

                    <div class="search-header secundary pull-right <?php if(!$header_cart) { echo 'search-margin'; } ?>">
                        <button type="submit" data-target=".details"></button>
                    </div>
            </div><!-- element-wrap -->
          
            
            
    <?php if (has_nav_menu('primary')) { ?>
          <div class="nav-collapse collapse verticalize-container">
            <div class="nav-padding verticalize">
                <?php
                wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu'       => '',
                        'depth'      => 0,
                        'container'  => false,
                        'menu_class' => 'nav',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'walker' => new twitter_bootstrap_nav_walker())
                );
                ?>
                <?php
                $navigation_search = get_theme_option(wp_get_theme()->name . '_general_navigation_search');
                if($navigation_search != 'yes'){
                ?>
              <div class="search-header">
                    <div class="header-divider"></div>
                    <button type="submit" class="btn-hide" data-toggle="collapse" data-target=".details"></button>
              </div>
             <?php }?>
            </div>
          </div><!--/.nav-collapse -->
    <?php } ?>          
          
        </div>
      </div>
        
        
        <?php 
        $header_cart = get_theme_option(wp_get_theme()->name . '_woocommerce_header_cart');
        
            if ($header_cart != '') { ?>
                <div class="tk-header-cart-holder hide-over">
                    <?php global $woocommerce; ?>
                            <div class="cart-menu-wrap">
                                    <div class="cart-menu">
                                            <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><div class="cart-icon-wrap"><i class="icon-shopping-cart"></i> <div class="cart-wrap"><span><?php echo $woocommerce->cart->cart_contents_count; ?> </span></div> </div></a>
                                    </div>
                            </div>

                            <?php
                                    // Check for WooCommerce 2.0 and display the cart widget
                                    if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
                                            the_widget( 'WC_Widget_Cart', 'title= ' );
                                    } else {
                                            the_widget( 'WooCommerce_Widget_Cart', 'title= ' );
                                    }
                            ?>
                </div>
            <?php } ?> 
        
        
    </div>