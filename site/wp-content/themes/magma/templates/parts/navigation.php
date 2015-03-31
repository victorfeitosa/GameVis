<?php if (has_nav_menu('primary')) { 
    wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu'       => '',
            'depth'      => 0,
            'container'  => false,
            'menu_class' => 'nav navbar-nav',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'walker' => new twitter_bootstrap_nav_walker()
            )
); } ?>