<!-- FOOTER -->

<footer>

    <?php
    /************************************************************/
    /*                                                          */
    /*   Get Footer Newsletter                                  */
    /*                                                          */
    /************************************************************/
    $footer_newsletter = get_theme_option(wp_get_theme()->name . '_general_footer_newsletter');
    if($footer_newsletter != 'yes'){
        get_template_part('templates/parts/footer-newsletter');
    }
    ?>

    <div class="row-fluid footer-widgets">
        <div class="container">
            <div class="row-fluid">
                <?php
                /************************************************************/
                /*                                                          */
                /*   Get Footer Sidebars and Widgets                        */
                /*                                                          */
                /************************************************************/
                get_template_part('templates/parts/footer-widgets');
                ?>
            </div>
        </div>
    </div>

    <div class="row-fluid footer-copyright">
        <div class="container">
            <?php
            /************************************************************/
            /*                                                          */
            /*   Get Copyright                                          */
            /*                                                          */
            /************************************************************/
            $copyright = get_theme_option(wp_get_theme()->name . '_general_footer_copy');
            if (empty($copyright)) {
                $copyright =  __("&copy; Copyright Information Goes Here &copy; 2013. All Rights Reserved.", 'tkingdom');
            }
            ?>
            <p><?php echo $copyright?></p>
                <?php /*---SOCIAL ICONS---*/
                $twitter_acc = get_theme_option(wp_get_theme()->name.'_social_twitter');
                $facebook_acc = get_theme_option(wp_get_theme()->name.'_social_facebook');
                $google_acc = get_theme_option(wp_get_theme()->name.'_social_google_plus');
                $linkedin_acc = get_theme_option(wp_get_theme()->name.'_social_linkedin');
                $flickr_acc = get_theme_option(wp_get_theme()->name.'_social_flickr');
                $instagram_acc = get_theme_option(wp_get_theme()->name.'_social_instagram');
                $rss_acc = get_theme_option(wp_get_theme()->name.'_social_rss_url');

                
                if ($twitter_acc != '' || $facebook_acc != '' || $google_acc != '' || $linkedin_acc != '') {
                    ?>
                    <ul class="pull-right soc-icon">
                        <?php if (!empty($twitter_acc)) { ?>
                            <li><a class="social_twitter" href="http://twitter.com/<?php echo $twitter_acc; ?>" ><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-t.jpg"></a></li>
                        <?php } ?>
                        <?php if (!empty($facebook_acc)) { ?>
                            <li><a class="social_facebook" href="http://facebook.com/<?php echo $facebook_acc; ?>" ><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-fb.jpg"></a></li>
                        <?php } ?>
                        <?php if (!empty($linkedin_acc)) { ?>
                            <li><a class="social_linkedin" href="<?php echo $linkedin_acc; ?>"><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-in.jpg"></a></li>
                        <?php } ?>
                        <?php if (!empty($google_acc)) { ?>
                            <li><a class="social_google_plus" href="http://plus.google.com/<?php echo $google_acc; ?>"><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-g+.jpg"></a></li>
                        <?php } ?>
                        <?php if (!empty($flickr_acc)) { ?>
                            <li><a class="social_linkedin" href="http://www.flickr.com/people/<?php echo $flickr_acc; ?>"><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-flickr.jpg"></a></li>
                        <?php } ?>
                        <?php if (!empty($instagram_acc)) { ?>
                            <li><a class="social_linkedin" href="http://instagram.com/<?php echo $instagram_acc; ?>"><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-instagram.jpg"></a></li>
                        <?php } ?>
                        <?php if (!empty($rss_acc)) { ?>
                            <li><a class="social_linkedin" href="<?php echo $rss_acc; ?>"><img src="<?php echo get_template_directory_uri()?>/img/soc-icon-rss.jpg"></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
        </div>
    </div>

</footer>

</div> <!-- close container from header -->
<?php wp_footer(); ?>
</body>
</html>