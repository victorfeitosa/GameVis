
    <!-- FOOTER -->
    <div class="footer left">
        <div class="wrapper">
            
            <div class="footer_box">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                <?php endif; ?>  
            </div><!--footer_box-->        

            <div class="footer_box">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                <?php endif; ?>  
            </div><!--footer_box-->

            <div class="footer_box">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                <?php endif; ?>  
            </div><!--/footer_box-->
                
            <div class="footer_box">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 4')) : ?>
                <?php endif; ?>  
            </div><!--/footer_box-->
            
        </div><!--/wrapper-->
        
        
        <div class="footer-copyright left">
        <div class="wrapper">
            <div class="footer-copyright-left left">
                <div class="footer-menu left">
                    <nav>
                        <?php
                        /*                     * *****FOOTER NAVIGATION****** */

                        if (function_exists('has_nav_menu') && has_nav_menu('footer')) {
                            $nav_menu = array('title_li' => '', 'theme_location' => 'footer', 'menu_class' => 'sf-menu', 'container'       => '', 'depth'           => 1);
                            wp_nav_menu($nav_menu);
                        }  // if function exists?>
                    </nav>
                </div><!--/footer-logo--> 
                <?php
                /*             * *****COPYRIGHT****** */

                $copyright = get_theme_option(tk_theme_name . '_general_footer_copy');
                if (empty($copyright)) {
                    $copyright = "Copyright Information Goes Here © 2013. All Rights Reserved.";
                }
                ?>
                <div class="footer-copyright-text"><p><?php echo $copyright ?></p></div><!--/footer-copyright-text-->
            </div><!--/footer-copyright-left-->

            <?php
            /*             * *****FOOTER SOCIAL ICONS****** */

            $twitter_acc = get_theme_option(tk_theme_name . '_social_twitter');
            $facebook_acc = get_theme_option(tk_theme_name . '_social_facebook');
            $rss_acc = get_theme_option(tk_theme_name . '_social_rss_url');
            $google_acc = get_theme_option(tk_theme_name . '_social_google_plus');
            $linkedin_acc = get_theme_option(tk_theme_name . '_social_linkedin');
            $pinterest_acc = get_theme_option(tk_theme_name . '_social_pinterest');
            if (!empty($twitter_acc) || !empty($facebook_acc) || !empty($rss_acc) || !empty($google_acc) || !empty($linkedin_acc) || !empty($pinterest_acc) || !empty($dribbble_acc)) {
                ?>
                <div class="soc-ikons right">
                    <ul>
                        <?php
                        if ($twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $linkedin_acc != '' || $pinterest_acc != '' || $dribbble_acc != '') {
                            ?>
                            <?php if (!empty($twitter_acc)) { ?>
                                <li><div class="soc-ikons-2 left"><a href="http://twitter.com/<?php echo $twitter_acc; ?>" ></a></div></li>
                            <?php } ?>

                            <?php if (!empty($facebook_acc)) { ?>
                                <li><div class="soc-ikons-1 left"><a href="http://facebook.com/<?php echo $facebook_acc; ?>" ></a></div></li>
                            <?php } ?>

                            <?php if (!empty($google_acc)) { ?>
                                <li><div class="soc-ikons-3 left"><a href="https://plus.google.com/<?php echo $google_acc; ?>"></a></div></li>
                            <?php } ?>

                            <?php if (($rss_acc != '')) { ?>
                                <li><div class="soc-ikons-6 left"><a href="<?php echo $rss_acc; ?>"></a></div></li>
                            <?php } ?>

                            <?php if (!empty($linkedin_acc)) { ?>
                                <li><div class="soc-ikons-4 left"><a href="<?php echo $linkedin_acc; ?>"></a></div></li>
                            <?php } ?>

                            <?php if (!empty($pinterest_acc)) { ?>
                                <li><div class="soc-ikons-5 left"><a href="http://pinterest.com/<?php echo $pinterest_acc; ?>"></a></div></li>
                            <?php } ?>

                        <?php } // if check one by one?>   
                    </ul>              
                </div>
            <?php } // if check whole social box?>   

        </div><!--/wrapper-->
    </div><!--/footer-copyright-->
        
        
        
        
        
        
    </div><!--/footer-->

    
    

</div><!--/container-->

<?php wp_footer();?>
</body>
</html>