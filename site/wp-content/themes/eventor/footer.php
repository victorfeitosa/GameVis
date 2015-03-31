    <!-- FOOTER -->
    <div class="footer left">
        <div class="border-header left"></div>
            <div class="wrapper">
                
                        <!-- Footer Widget 1 -->
                        <div class="footer-others left">
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                            <?php endif; ?>  
                        </div><!--footer_box-->

                        <!-- Footer Widget 2 -->
                        <div class="footer-others left">
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                            <?php endif; ?> 
                        </div><!--footer_box-->        

                        <!-- Footer Widget 3 -->
                        <div class="footer-others left">
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                            <?php endif; ?>
                        </div><!--footer_box-->
                        
                        <!-- Footer Widget 4 -->
                        <div class="footer-others left">
                            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 4')) : ?>
                            <?php endif; ?>
                        </div><!--footer_box-->
                        
            </div><!--/wrapper-->

            <div class="footer-copy left">
                <div class="wrapper">
                        <div class="footer-copyright left">  


                                <?php
                                /* * *****COPYRIGHT****** */
                                $copyright = get_theme_option(tk_theme_name . '_general_footer_copy');
                                if (empty($copyright)) {
                                    $copyright = "Copyright Information Goes Here &copy; 2013. All Rights Reserved.";
                                }
                                ?>
                                <div class="footer-copy-content left">
                                    
                                        <?php /*Footer Logo*/
                                            $logo = get_theme_option(tk_theme_name . '_general_footer_logo');
                                            if(empty($logo)) {
                                                $logo = get_template_directory_uri() . "/style/img/footer-logo.png";
                                            }
                                        ?>
                                    <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>"   alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                                    
                                    <span><?php echo $copyright?></span>
                                    
                                    <div class="scroll-top">
                                        <div class="scroll-to-top-button"><?php _e('To the Top', tk_theme_name) ?></div>

                                        <p id="back-top">
                                            <a href="#top"><span></span><span class="soc-icon-bg"></span></a>
                                        </p>
                                    </div><!--/scroll-top-->
                                </div><!--/footer-copyright-text-->


                        </div><!--/footer-copyright-->
                </div><!--/wrapper-->
            </div>
        
    </div><!--/footer-->



</div><!--/container-->

<?php wp_footer();?>
</body>
</html>