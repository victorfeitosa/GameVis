    <!-- FOOTER -->
    <div class="footer left">
        <div class="wrapper">            
            
            <?php 
            $call_to_action = get_theme_option(tk_theme_name.'_general_call_to_action');
            if(!empty($call_to_action)){
            ?>
            
            <div class="bg-home-text left">
                <div class="home-text-content left">
                    <?php echo $call_to_action?>
                </div><!--/home-text-content-->
            </div><!--/bg-home-text-->
            <?php }?>
            
            <div class="footer-widgets left">
                
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
                        
                        <!--COPYRIGHT-->
                        <div class="copyright left">
                            <div class="scroll-top"><p id="back-top"><a href="#top"><span></span></a></p></div><!--/scroll-top-->
                                <div class="footer-links left">
                                        <ul><li><span></span></li>
                                <?php
                                $twitter_acc = get_theme_option(tk_theme_name.'_social_twitter');
                                $facebook_acc = get_theme_option(tk_theme_name.'_social_facebook');
                                $rss_acc = get_theme_option(tk_theme_name.'_social_rss_url');
                                $google_acc = get_theme_option(tk_theme_name.'_social_google_plus');
                                $linkedin_acc = get_theme_option(tk_theme_name.'_social_linkedin');
                                if( $twitter_acc != '' || $facebook_acc != '' || $rss_acc != '' || $google_acc != '' || $linkedin_acc != '' ){
                                ?>
                                            
                                            <?php if(!empty($twitter_acc)){ ?><li><a href="http://twitter.com/<?php echo $twitter_acc; ?>" ><div class="footer-icon1 left"></div></a></li><?php } ?>
                                            <?php if(!empty($facebook_acc)){ ?><li><a href="http://facebook.com/<?php echo $facebook_acc; ?>" ><div class="footer-icon2 left"></div></a></li><?php } ?>
                                            <?php if(!empty($google_acc)){ ?><li><a href="https://plus.google.com/<?php echo $google_acc; ?>"><div class="footer-icon4 left"></div></a></li><?php } ?>
                                            <?php  if(($rss_acc != '' )){ ?><li><a href="<?php echo $rss_acc; ?>"><div class="footer-icon5 left"></div></a></li><?php }?>
                                            <?php if(!empty($linkedin_acc)){ ?><li><a href="<?php echo $linkedin_acc; ?>"><div class="footer-icon3 left"></div></a></li><?php } ?>
                                <?php }?>   
                                        </ul>
                                </div><!--/stay-tuned-->

                                <?php
                                $copyright = get_theme_option(tk_theme_name . '_general_footer_copy');
                                if (empty($copyright)) {
                                    $copyright = "Copyright Information Goes Here © 2012. All Rights Reserved.";
                                }
                                ?>               
                            <div class="footer-copyright left"><?php echo $copyright?></div><!--footer-copyright-->
                        </div><!--copyright-->
                        
                    </div><!--footer_box-->

            </div><!--/footer-widgets-->
        </div><!--/wrapper-->
    </div><!--/footer-->

</div><!--/container-->

<?php wp_footer();?>
</body>
</html>