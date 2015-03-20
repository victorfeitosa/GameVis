<!-- HEADER -->

<div class="fake-navbar">    
    <?php
        $logo = get_option(wp_get_theme()->name . '_general_header_logo');
        if (empty($logo)) {
            $logo = get_template_directory_uri() . "/theme-images/logo.png";
        } else {
            $logo = get_option(wp_get_theme()->name .'_general_header_logo');
        } ?>
    <img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/>
</div>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="brand" href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>

            <div class="nav-collapse collapse menu-wrap">
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

                $navigation_search = get_theme_option(wp_get_theme()->name . '_general_navigation_search');
                if($navigation_search != 'yes'){
                ?>
                    <div class="pull-right search-header">
                        <button type="submit" class="btn-hide" data-toggle="collapse" data-target=".details"></button>
                        <div class="details collapse">
                            <form action="<?php echo home_url( '/' )?>" method="get">
                                <input class="pan3" name="s" id="s" type="text" placeholder="<?php _e('Type and hit enter...', 'tkingdom')?>" value="<?php the_search_query(); ?>">
                            </form>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>