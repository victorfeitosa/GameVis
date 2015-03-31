<?php 
    $prefix = 'tk_';
?>

            </div><!-- .container -->
        </section>
        <!-- CONTENT ENDS -->

        

            <!-- Div for styling purpose only -->
            <div class="blank_separator"></div>

        
        <!-- Pre Footer -->
        <?php
        // ONE TWEET
        $enable_twitter = get_theme_option(tk_theme_name . '_general_enable_home_twitter');
        if ($enable_twitter == 'yes') { ?>
            <?php twitter_script('home', 1); ?>                    
        <?php } // if Twitter  ?>
        
    
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row-fluid">
                    <!-- Footer Widget 1 -->
                    <div class="span4 footer_widget">
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                        <?php endif; ?> 
                    </div>

                    <!-- Footer Widget 2 -->
                    <div class="span4 footer_widget">
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                        <?php endif; ?> 
                    </div>       

                    <!-- Footer Widget 3 -->
                    <div class="span4 footer_widget">
                        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                        <?php endif; ?>
                    </div>
                </div>

                <br>
                <div class="row-fluid">
                    <div class="span12">
                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" alt="separator" />
                    </div>
                </div>

                <div class="row-fluid copyright_wrap">
                    <?php
                        // COPYRIGHT 
                        $copyright = get_theme_option(tk_theme_name . '_general_footer_copy');
                        if (empty($copyright)) {
                            $copyright =  __("&copy; Copyright 2013. Powered by WordPress. Legalized Theme by Themes Kingdom", tk_theme_name);
                        }
                    ?>
                    <div class="span8"><p><?php echo $copyright ; ?></p></div>
                    <div class="span4">
                        <div class="pull-right">
                            <?php /*---SOCIAL ICONS---*/
                                $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                                $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                                $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                                $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
                                $linkedin_acc = get_theme_option(tk_theme_name.'_social_linkedin');
                                $instagram_acc = get_theme_option(tk_theme_name . '_social_instagram');
                                $flickr_acc = get_theme_option(tk_theme_name . '_social_flickr');

                                if ($twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $linkedin_acc != '' || $instagram_acc != '' || $flickr_acc != '') {
                            ?>
                            <ul class="social pull-left rounded">

                                <?php if (!empty($flickr_acc)) { ?>
                                    <li><div class="soc-ikons-1 left"><a class="social_flickr" href="http://flickr.com/<?php echo $flickr_acc; ?>" ></a></div></li>
                                <?php } ?>

                                <?php if (!empty($instagram_acc)) { ?>
                                    <li><div class="soc-ikons-2 left"><a class="social_instagram" href="http://instagram.com/<?php echo $instagram_acc; ?>" ></a></div></li>
                                <?php } ?>

                                <?php if (!empty($twitter_acc)) { ?>
                                    <li><div class="soc-ikons-3 leftt"><a class="social_twitter" href="http://twitter.com/<?php echo $twitter_acc; ?>" ></a></div></li>
                                <?php } ?>

                                <?php if (!empty($facebook_acc)) { ?>
                                    <li><div class="soc-ikons-4 left"><a class="social_facebook" href="http://facebook.com/<?php echo $facebook_acc; ?>" ></a></div></li>
                                <?php } ?>

                                <?php if (($rss_acc != '')) { ?>
                                <li><div class="soc-ikons-5 left"><a class="social_rss" href="<?php echo $rss_acc; ?>"></a></div></li>
                                <?php } ?>

                                <?php if (!empty($linkedin_acc)) { ?>
                                    <li><div class="soc-ikons-6 left"><a class="social_linkedin" href="<?php echo $linkedin_acc; ?>"></a></div></li>
                                <?php } ?>
                                    
                                <?php if (!empty($google_acc)) { ?>
                                    <li><div class="soc-ikons-7 left"><a class="social_google_plus" href="http://plus.google.com/<?php echo $google_acc; ?>"></a></div></li>
                                <?php } ?>
                            </ul>
                            <?php } // if check one by one ?>

                            <div id="top" class="pull-left">
                                <a class="top_btn rounded" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /container -->
        </footer>
    
    </div><!-- container-fluid ends -->

<?php wp_footer();?>   
</body>
</html>