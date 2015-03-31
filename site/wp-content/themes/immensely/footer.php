
<!-- FOOTER -->
    <footer>
        
        <?php 
        $footer_twitter = get_theme_option(wp_get_theme()->name . '_social_footer_twitter');;
        if($footer_twitter == 'yes') { ?>
            <div class="row-fluid footer-top">
                <?php twitter_script('home', 1); ?>
            </div>
        <?php } ?>
        
<?php
/* ******FOOTER WIDGETS****** */
$check_footer1 = is_active_sidebar('sidebar-1');
$check_footer2 = is_active_sidebar('sidebar-2');
$check_footer3 = is_active_sidebar('sidebar-3');
$check_footer4 = is_active_sidebar('sidebar-4');
if ($check_footer1 == true || $check_footer2 == true || $check_footer3 == true || $check_footer4 == true) {
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
        
<?php } ?>        
        
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
                $pinterest_acc = get_theme_option(wp_get_theme()->name.'_social_pinterest');
                $rss_acc = get_theme_option(wp_get_theme()->name.'_social_rss_url');

                if ($twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $linkedin_acc != '' || $pinterest_acc != '') {
                    ?>
                    <ul class="pull-right soc-icon">
                        <?php if (!empty($twitter_acc)) { ?>
                            <a href="http://twitter.com/<?php echo $twitter_acc; ?>" ><li class="twitter"><i class="fa fa-twitter"></i></li></a>
                        <?php } ?>

                        <?php if (!empty($facebook_acc)) { ?>
                            <a href="http://facebook.com/<?php echo $facebook_acc; ?>" ><li class="facebook"><i class="fa fa-facebook"></i></li></a>
                        <?php } ?>
                            
                        <?php if (!empty($linkedin_acc)) { ?>
                           <a href="<?php echo $linkedin_acc; ?>"><li class="linkedin"><i class="fa fa-linkedin"></i></li></a>
                        <?php } ?>

                        <?php if (!empty($google_acc)) { ?>
                            <a href="http://plus.google.com/<?php echo $google_acc; ?>"><li class="google-plus"><i class="fa fa-google-plus"></i></li></a>
                        <?php } ?>
                            
                        <?php if (!empty($pinterest_acc)) { ?>
                            <a href="http://pinterest.com/<?php echo $pinterest_acc; ?>"><li class="pinterest"><i class="fa fa-pinterest"></i></li></a>
                        <?php } ?>
                            
                        <?php if (!empty($rss_acc)) { ?>
                            <a href="<?php echo $rss_acc; ?>"><li class="rss"><i class="fa fa-rss"></i></li></a>
                        <?php } ?>
                    </ul>
                <?php } ?>
        </div>
    </div>
        
    </footer>


<?php wp_footer(); ?>
</body>
</html>