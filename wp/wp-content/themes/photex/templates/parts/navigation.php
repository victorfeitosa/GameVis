<!-- HEADER -->
  <nav class="navbar navbar-default hidden-navbar" role="navigation">

    <button type="button" class="navbar-slide primary-color-btn hamburger-into-x close-nav">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
    </button>
    <button type="button" class="navbar-slide primary-color-btn open-nav">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
    </button>

    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->

      <div class="navbar-header">
        <h1>
            <?php
            $logo = get_option(wp_get_theme()->name . '_general_header_logo');
            if (empty($logo)) {
                $logo = get_template_directory_uri() . "/theme-images/logo.png";
            } else {
                $logo = get_option(wp_get_theme()->name . '_general_header_logo');
            }
            ?>
          <a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
        </h1>
      </div>

      <!-- Primary navigation -->
        
        <?php if (has_nav_menu('primary')) { 
            wp_nav_menu( array(
                'theme_location'  => 'primary',
                'menu'            => '',
                'menu_id'         => 'navigation',
                'depth'           => 0,
                'container'       => 'div',
                'container_class' => 'navbar-collapse',
                'menu_class'      => 'nav navbar-nav',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'walker'          => new replace_submenu_class()
                )
        ); } ?>

      <!-- Primary navigation end -->


      <!-- Social icons -->

        <?php
                /*---SOCIAL ICONS---*/
                $twitter_acc = get_theme_option(wp_get_theme()->name.'_social_twitter');
                $facebook_acc = get_theme_option(wp_get_theme()->name.'_social_facebook');
                $google_acc = get_theme_option(wp_get_theme()->name.'_social_google_plus');
                $linkedin_acc = get_theme_option(wp_get_theme()->name.'_social_linkedin');
                $pinterest_acc = get_theme_option(wp_get_theme()->name.'_social_pinterest');
                $instagram_acc = get_theme_option(wp_get_theme()->name.'_social_instagram');
                $vimeo_acc = get_theme_option(wp_get_theme()->name.'_social_vimeo');
                $flickr_acc = get_theme_option(wp_get_theme()->name.'_social_flickr');
                $behance_acc = get_theme_option(wp_get_theme()->name.'_social_behance');
                $dribbble_acc = get_theme_option(wp_get_theme()->name.'_social_dribbble');
                $rss_acc = get_theme_option(wp_get_theme()->name.'_social_rss_url');

                if ($twitter_acc != '' || 
                    $facebook_acc != '' || 
                    $rss_acc != '' || 
                    $google_acc != '' || 
                    $linkedin_acc != '' || 
                    $pinterest_acc != '' || 
                    $behance_acc != '' || 
                    $dribbble_acc != '' || 
                    $vimeo_acc != '' || 
                    $flickr_acc != '' || 
                    $instagram_acc != '') {
                    ?>
                    <ul class="social">
                        <?php if (!empty($twitter_acc)) { ?>
                            <li><a href="http://twitter.com/<?php echo $twitter_acc; ?>" ><i class="icon-twitter"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($google_acc)) { ?>
                            <li><a href="http://plus.google.com/<?php echo $google_acc; ?>"><i class="icon-google"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($facebook_acc)) { ?>
                            <li><a href="http://facebook.com/<?php echo $facebook_acc; ?>" ><i class="icon-facebook"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($pinterest_acc)) { ?>
                            <li><a href="http://pinterest.com/<?php echo $pinterest_acc; ?>"><i class="icon-pin"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($linkedin_acc)) { ?>
                           <li><a href="<?php echo $linkedin_acc; ?>"><i class="icon-in"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($behance_acc)) { ?>
                            <li><a href="http://www.behance.com/<?php echo $behance_acc; ?>"><i class="icon-be"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($vimeo_acc)) { ?>
                            <li><a href="http://www.vimeo.com/<?php echo $vimeo_acc; ?>"><i class="icon-vimeo"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($flickr_acc)) { ?>
                            <li><a href="http://www.flickr.com/<?php echo $flickr_acc; ?>"><i class="icon-flikr"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($instagram_acc)) { ?>
                            <li><a href="http://www.instagram.com/<?php echo $instagram_acc; ?>"><i class="icon-instagram"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($dribbble_acc)) { ?>
                            <li><a href="http://www.dribbble.com/<?php echo $dribbble_acc; ?>"><i class="icon-dribbble"></i></a></li>
                        <?php } ?>

                        <?php if (!empty($rss_acc)) { ?>
                            <li><a href="<?php echo $rss_acc; ?>"><i class="icon-rss"></i></a></li>
                        <?php } ?>
                    </ul>
        <?php } ?>

      <!-- Socail icons end -->

      <footer>
        
        <?php

            /************************************************************/
            /*                                                          */
            /*   Get Copyright                                          */
            /*                                                          */
            /************************************************************/
            $copyright = get_theme_option(wp_get_theme()->name . '_general_footer_copy');
            if (empty($copyright)) {
                $copyright =  __("&copy; COPYRIGHT 2014 Handcrafted with<br>love by ThemesKingdom", 'tkingdom');
            }
            ?>
            <p><?php echo $copyright?></p>

      </footer>

    </div><!-- /.container-fluid -->

  </nav>