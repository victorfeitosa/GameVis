                <!-- FOOTER -->

                <footer>

                   <div class="container">

                    <?php
                    /* ******FOOTER WIDGETS****** */
                    $check_footer1 = is_active_sidebar('sidebar-1');
                    $check_footer2 = is_active_sidebar('sidebar-2');
                    $check_footer3 = is_active_sidebar('sidebar-3');
                    if ($check_footer1 == true || $check_footer2 == true || $check_footer3 == true) {
                        ?>        
                        <div class="row">
                            <div class="white-bg">
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
                            
                    <?php } ?>
                        

                        <!-- FOOTER NEWSLETTER -->

                        <?php
                            // Theme Options Variables
                            $footer_newsletter_text = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_text');
                            $footer_newsletter_service = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_service');
                            $footer_newsletter_madmimi_user = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_madmimi_user');
                            $footer_newsletter_mailchimp_key = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_mailchimp_key');
                            $footer_newsletter_mailchimp_list = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_mailchimp_list');
                        ?>
                    <div class="row">
                        <div class="container footer-newsletter">
                            <div class="newsletter-icon">
                                <img src="<?php echo get_template_directory_uri().'/theme-images/footer-newsletter.png'; ?>" alt="image" title="image" />
                            </div>
                               <?php if ($footer_newsletter_service == 'madmimi') { ?>
                                    <form action="https://madmimi.com/signups/subscribe/<?php echo $footer_newsletter_madmimi_user?>" method="post" id="newsleter-form-footer" target="_blank" onsubmit="return MadMimiNewsletter()">
                                        <input id="signup_email" name="signup[email]" type="text"  placeholder="Sign Up for News..." data-invalid-message="This field is invalid" class="required newsletter_email input-newsletter">
                                        <input id="webform_submit_button" value="" type="submit" class="submit newsletter_button btn submit-newsletter" data-default-text="" data-submitting-text="" data-invalid-text="">
                                        <div class="mimi_field_feedback tk_newsletter_response"></div><span class="mimi_funk"></span>
                                    </form>
                                <?php } elseif ($footer_newsletter_service == 'mailchimp') { ?>
                                    <form id="signup_footer" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                        <input type="email" name="email" id="email"  class="input-newsletter" placeholder="Sign Up for News..." onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
                                        <input type="hidden" name="_mailchimp_key" id="_mailchimp_key" value="<?php echo $footer_newsletter_mailchimp_key ?>"/>
                                        <input type="hidden" name="_mailchimp_list" id="_mailchimp_list" value="<?php echo $footer_newsletter_mailchimp_list ?>"/>
                                        <input type="submit" src="" name="submit" value="" class="btn submit-newsletter" alt="Submit" />
                                        <input type="text" style="display: none" value="<?php echo get_template_directory_uri() . '/script/mailchimp/inc/store-address.php' ?>" name="hidden_path" class="hidden_path">
                                        <label for="email" id="address-label">
                                                <span id="response_footer">
                                                    <?php get_template_part('/script/mailchimp/inc/store-address.php');
                                                    if (isset($_GET['submit'])) {
                                                        echo storeAddress();
                                                    } ?>
                                                </span>
                                        </label>
                                    </form>
                                    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/script/mailchimp/js/mailing-list.js'; ?>"></script>
                                <?php } ?>
                        </div> <!-- /.container .footer-newsletter -->
                    </div>
                        <!-- /FOOTER NEWSLETTER -->


                    <div class="row">
                        <div class="footer-copyright">
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
                                    $dribbble_acc = get_theme_option(wp_get_theme()->name.'_social_dribbble');
                                    $pinterest_acc = get_theme_option(wp_get_theme()->name.'_social_pinterest');
                                    $linkedin_acc = get_theme_option(wp_get_theme()->name.'_social_linkedin');
                                    $behance_acc = get_theme_option(wp_get_theme()->name.'_social_behance');
                                    $youtube_acc = get_theme_option(wp_get_theme()->name.'_social_youtube');
                                    $instagram_acc = get_theme_option(wp_get_theme()->name.'_social_instagram');
                                    $vimeo_acc = get_theme_option(wp_get_theme()->name.'_social_vimeo');

                                    $rss_acc = get_theme_option(wp_get_theme()->name.'_social_rss_url');

                                    if ($linkedin_acc != '' || $twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $dribbble_acc != '' || $pinterest_acc != '' || $behance_acc != '' || $youtube_acc != '' || $instagram_acc != '' || $vimeo_acc != '') {
                                        ?>
                                        <ul class="soc-icon pull-right">
                                            <?php if (!empty($twitter_acc)) { ?>
                                                <li><a href="http://twitter.com/<?php echo $twitter_acc; ?>" ><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-t.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($facebook_acc)) { ?>
                                                <li><a href="http://facebook.com/<?php echo $facebook_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-fb.jpg'; ?>"/></a></li>
                                            <?php } ?>
                                                
                                            <?php if (!empty($dribbble_acc)) { ?>
                                                <li><a href="http://dribbble.com/<?php echo $dribbble_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-dribbble.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($linkedin_acc)) { ?>
                                                <li><a href="<?php echo $linkedin_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-li.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($google_acc)) { ?>
                                                <li><a href="http://plus.google.com/<?php echo $google_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-g+.jpg'; ?>"/></a></li>
                                            <?php } ?>
                                                
                                            <?php if (!empty($pinterest_acc)) { ?>
                                                <li><a href="http://pinterest.com/<?php echo $pinterest_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-p.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($behance_acc)) { ?>
                                                <li><a href="http://www.behance.net/<?php echo $behance_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-be.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($youtube_acc)) { ?>
                                                <li><a href="http://www.youtube.com/<?php echo $youtube_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-yt.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($instagram_acc)) { ?>
                                                <li><a href="http://www.instagram.com/<?php echo $instagram_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-instagram.jpg'; ?>"/></a></li>
                                            <?php } ?>

                                            <?php if (!empty($vimeo_acc)) { ?>
                                                <li><a href="http://www.vimeo.com/<?php echo $vimeo_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-vimeo.jpg'; ?>"/></a></li>
                                            <?php } ?>
                                                
                                            <?php if (!empty($rss_acc)) { ?>
                                                <li><a href="<?php echo $rss_acc; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-feed.jpg'; ?>"/></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                            </div>            
                        </div>
                      </div>
                    </div>

                </footer>
            </div>
            </div><!-- /#container .st-content -->
        </div><!-- /st-pusher -->
    


<?php wp_footer(); ?>
</div><!-- /st-container -->
</body>
</html>