<!-- HEADER TYPE THREE-->
<header class="header-style-2">

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php get_template_part('/templates/parts/navigation'); ?>
                <div class="content-search-category" style="margin:0">  <!-- obrisati style -->
                    <?php
                    //check if navigation search is enabled
                    $navigation_search = get_theme_option(wp_get_theme()->name . '_general_navigation_search');
                    if($navigation_search != 'yes'){
                    ?>
                    <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                        <div class="details-search collapse">
                            <input type="text" placeholder="Type and hit enter..." value="" name="s" id="s">
                        </div>
                        <div class="button-search">
                            <input type="hidden" id="searchsubmit" />
                        </div>
                    </form>

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
                    <?php }; }; ?>
                </div>
            </div>
        </div>
    </nav>



    <div class="container">

        <?php
        $logo = get_option(wp_get_theme()->name . '_general_header_logo');
        if (empty($logo)) {
            $logo = get_template_directory_uri() . "/theme-images/logo.png";
        } else {
            $logo = get_option(wp_get_theme()->name . '_general_header_logo');
        }
        ?>

        <a class="brand" href="<?php echo home_url() ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name') ?>" title="<?php bloginfo('name') ?>" /></a>
        

        <?php
        // HEADER BANNER
        $header_banner = get_option(wp_get_theme()->name . '_general_header_advert');
        $custom_banner =  get_post_meta($wp_query->post->ID,'custom_banner_code', true);
        if(!empty($custom_banner)){ ?>
            <div class="header-baner right">
                <?php 
                    tk_add_banner_view($header_banner);
                    echo $custom_banner; 
                ?>
            </div>
        <?php } else {
                    $ad_status = get_post_status($header_banner);
                    if ($header_banner && $header_banner != 'none') {
                        if($ad_status == 'publish'): //Checking if advertisement is published
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($header_banner), 'banner_wide');
                            $post_title = get_the_title($header_banner);
                            tk_add_banner_view($header_banner);
                            ?>
                            <div class="baners-header">
                                <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $header_banner; ?>">
                                    <img src="<?php echo $image[0]; ?>" alt="<?php echo $post_title ?>" title="<?php echo $post_title ?>" />
                                </a>
                            </div>
                    <?php endif; ?>
                <?php } 
        } ?>


    </div> 

    <nav class="navbar navbar-default category-header" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                
                    <?php if (has_nav_menu('secondary')) { 
                        wp_nav_menu( array(
                            'theme_location' => 'secondary',
                            'menu'       => '',
                            'depth'      => 0,
                            'container'  => false,
                            'menu_class' => 'nav navbar-nav',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker' => new twitter_bootstrap_nav_walker()
                            )
                    ); } ?>   
                
            </div>
        </div>
    </nav>

</header>