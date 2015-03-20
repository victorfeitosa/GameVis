    <!-- FOOTER -->
    <div class="footer left">
        <div class="scroll-top"><p id="back-top"><a href="#top"><span></span></a></p></div><!--/scroll-top-->
        <div class="wrapper">


            <div class="footer-content right">
                <div class="slide"><a href="#" class="btn-slide"></a></div><!--/slide-->
                <div id="panel">
                    <div class="panel-content left">
                        <div class="footer-widgets left">

                        <?php
                            $check_footer1 = is_active_sidebar('sidebar-1');
                            $check_footer2 = is_active_sidebar('sidebar-2');
                            $check_footer3 = is_active_sidebar('sidebar-3');
                            if($check_footer1 == true || $check_footer2 == true || $check_footer3 == true){
                        ?>

                            <div class="footer_box">
                                <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                                <?php endif; ?>
                            </div><!--footer_box-->



                            <div class="footer_box">
                                <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                                <?php endif; ?>
                            </div><!--footer_box-->



                            <div class="footer_box" style="margin-right: 0;">
                                <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                                <?php endif; ?>
                            </div><!--/footer_box-->



                    <?php } ?>

                        </div><!--/footer-widgets-->
                        <?php
                            $footer_logo = get_option(tk_theme_name . '_general_footer_logo');
                            if (empty($footer_logo)) {
                                $footer_logo = get_template_directory_uri() . "/style/img/footer-logo.png";
                            }

                            $copyright = get_theme_option(tk_theme_name . '_general_footer_copy');
                            if (empty($copyright)) {
                                $copyright = "Copyright Information Goes Here © 2013. All Rights Reserved.";
                            }
                        ?>



                        <div class="footer-copyright left">
                            <div class="footer-logo left"><a href="index.php"><img src="<?php echo $footer_logo; ?>" alt="footer logo" /></a></div><!--/footer-logo-->
                            <div class="footer-text left"><?php echo $copyright; ?></a></div><!--/footer-text-->
                        </div><!--/footet-copyright-->
                    </div><!--/panel-content-->


           <!-- SOCIAL ICONS for smaller resolutions -->
          <?php
            $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
            $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
            $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
            $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
            $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
            $linkedin = get_theme_option(tk_theme_name.'_social_linkedin');
            $pinterest = get_theme_option(tk_theme_name.'_social_pinterest');
            $emailaddress =  get_option('admin_email');
            if( $enable_rss == true || !empty ($twitter_acc)  || !empty ($facebook_acc) || !empty($facebook_acc) || !empty($rss_acc) || !empty($google_acc) || !empty($pinterest)){
            ?>
                    <div class="soc-ikons">
                        <ul>
                            <?php if($facebook_acc) { ?>
                                <li><div class="soc-ikons-1 left"><a href="<?php echo $facebook_acc; ?>"></a></div></li>
                            <?php } ?>

                            <?php if($twitter_acc){ ?>
                                <li><div class="soc-ikons-2 left"><a href="<?php echo $twitter_acc; ?>"></a></div></li>
                            <?php } ?>

                            <?php if($google_acc){  ?>
                                <li><div class="soc-ikons-3 left"><a href="<?php echo $google_acc; ?>"></a></div></li>
                            <?php } ?>

                            <?php if($linkedin) { ?>
                                <li><div class="soc-ikons-4 left"><a href="#"></a></div></li>
                            <?php } ?>

                            <?php if($pinterest) { ?>
                                <li><div class="soc-ikons-5 left"><a href="<?php echo $pinterest; ?>"></a></div></li>
                            <?php } ?>

                            <?php if($rss_acc) { ?>
                                <li><div class="soc-ikons-6 left"><a href="<?php echo $rss_acc; ?>"></a></div></li>
                            <?php } ?>
                        </ul>
                    </div>                    
            <?php } ?>



                </div><!--/panel-->
            </div><!--/footer-content-->
        </div><!--/wrapper-->
    </div><!--/footer-->
</div><!--/container-->




          <?php
            $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
            $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
            $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
            $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
            $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
            $linkedin = get_theme_option(tk_theme_name.'_social_linkedin');
            $pinterest = get_theme_option(tk_theme_name.'_social_pinterest');
            $emailaddress =  get_option('admin_email');
            if( $enable_rss == true || !empty ($twitter_acc)  || !empty ($facebook_acc) || !empty($facebook_acc) || !empty($rss_acc) || !empty($google_acc) || !empty($pinterest)){
            ?>

            <div class="soc-ikons fixed-icons">
                <ul>
                    <?php if($facebook_acc) { ?>
                        <li><div class="soc-ikons-1 left"><a href="http://facebook.com/<?php echo $facebook_acc; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($twitter_acc){ ?>
                        <li><div class="soc-ikons-2 left"><a href="http://twitter.com/<?php echo $twitter_acc; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($google_acc){  ?>
                        <li><div class="soc-ikons-3 left"><a href="http://plus.google.com/<?php echo $google_acc; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($linkedin) { ?>
                        <li><div class="soc-ikons-4 left"><a href="<?php echo $linkedin; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($pinterest) { ?>
                        <li><div class="soc-ikons-5 left"><a href="http://pinterest.com/<?php echo $pinterest; ?>"></a></div></li>
                    <?php } ?>

                    <?php if($rss_acc) { ?>
                        <li><div class="soc-ikons-6 left"><a href="<?php echo $rss_acc; ?>"></a></div></li>
                    <?php } ?>
                </ul>
            </div>

            <?php } ?>



<?php wp_footer();?>
</body>
</html>