<!-- HEADER TYPE ONE-->
<header>
    <div class="container">

        <nav class="navbar navbar-default" role="navigation">

            <?php
            $logo = get_option(wp_get_theme()->name . '_general_header_logo');
            if (empty($logo)) {
                $logo = get_template_directory_uri() . "/theme-images/logo.png";
            } else {
                $logo = get_option(wp_get_theme()->name . '_general_header_logo');
            }
            ?>

            <a class="brand" href="<?php echo home_url() ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name') ?>" title="<?php bloginfo('name') ?>" /></a>

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
                <div class="content-search-category">
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

                    <?php } ?>

                    <div class="main clearfix">
                        <div id="st-trigger-effects" class="column">
                            <button data-effect="st-effect-3"></button>
                        </div>
                    </div><!-- /main -->

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

                </div>


            </div><!-- /.navbar-collapse -->
        </nav>


    </div>       
</header>