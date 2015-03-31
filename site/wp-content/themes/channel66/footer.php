<?php wp_footer();?>

    <!-- FOOTER -->
    <div class="footer left">
        <div class="wrapper">

            <div class="footer-others left">

                <!--WIDGET AREA 1-->
                <div class="footer-widgets-column left">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                    <?php endif; ?>
                </div><!--footer_box-->

                <!--WIDGET AREA 2-->
                <div class="footer-widgets-column left">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                    <?php endif; ?>
                </div><!--footer_box-->

                <!--WIDGET AREA 3-->
                <div class="footer-widgets-column left">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                    <?php endif; ?>
                </div><!--footer_box-->

                <!--WIDGET AREA 4-->
                <div class="footer-widgets-column left" style="margin-right: 0">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 4')) : ?>
                    <?php endif; ?>
                </div><!--footer_box-->


            </div><!--/footer-others-->

           <?php
                $copyright = get_theme_option(tk_theme_name.'_general_footer_copy');
                if(empty($copyright)) {
                $copyright = "Copyright Information Goes Here © 2012. All Rights Reserved.";
             }?>
            <div class="footer-copyright left">


                <!--SOCIAL ICONS-->
              <?php
                $enable_rss = get_theme_option(tk_theme_name.'_social_enable_rss');
                $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
                $pinterest_acc = get_theme_option(tk_theme_name.'_social_pinterest');
                if( $enable_rss == true || @$enable_rss[0] == '' || $twitter_acc == '' || $facebook_acc == '' || $facebook_acc == '' || $rss_acc == '' || $google_acc == '' ){
                ?>
            <div class="footer-left left">
                <ul>
                    <?php if(!empty($twitter_acc)){ ?><li><a href="http://twitter.com/<?php echo $twitter_acc; ?>"><div class="footer-copy-icon1 left"></div></a></li><?php } ?>
                    <?php if(!empty($facebook_acc)){ ?><li><a href="http://facebook.com/<?php echo $facebook_acc; ?>"><div class="footer-copy-icon2 left"></div></a></li><?php } ?>
                    <?php if(!empty($google_acc)){ ?><li><a href="https://plus.google.com/<?php echo $google_acc; ?>"><div class="footer-copy-icon3 left"></div></a></li><?php } ?>
                    <?php if ($enable_rss == false || @$enable_rss[0] == ''){}else{ if(!empty($rss_acc )){ ?><li><a href="<?php echo $rss_acc; ?>"><div class="footer-copy-icon4 left"></div></a></li><?php } else { ?><li><a href="<?php echo get_bloginfo('rss2_url'); ?>"><div class="footer-copy-icon4 left"></div></a></li><?php } }?>
                    <?php if(!empty($pinterest_acc)){ ?><li><a href="http://pinterest.com/<?php echo $pinterest_acc; ?>"><div class="footer-copy-icon5 left"></div></a></li><?php } ?>
                </ul>
            </div><!--/footer-left-->
            <?php }?>


                <?php echo $copyright?>
            </div><!--/footer-copyright-->



        </div><!--/wrapper-->
    </div><!--/footer-->



</div><!--/container-->

<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
</body>
</html>