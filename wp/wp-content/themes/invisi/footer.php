<?php wp_footer();?>

    <!-- FOOTER -->
    <div class="footer left">
        <div class="footer-border-top"></div>
        <div class="wrapper">
            <div class="footer-others left">

                                  <!--TEXT WIDGET-->
                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                    
                    <!--TWITTER WIDGET-->
                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                    
                    <!--CATEGORIES-->
                    <div class="footer_box" style="margin-right: 0;">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                        <?php endif; ?>     
                    </div><!--footer_box-->      
                

            </div><!--/footer-others-->
        </div><!--/wrapper-->
        
        <?php
            $copyright = get_theme_option(tk_theme_name.'_general_footer_copy');
            if(empty($copyright)) {
            $copyright = "Copyright Information Goes Here © 2012. All Rights Reserved.";
         }?>
        <div class="copyrigt-footer left">
            <div class="wrapper">
                <div class="copyrigt-footer-text left"><?php echo $copyright?></div>

                <div class="scroll-top">
                    <p id="back-top">
                        <a href="#top">
                            To the Top
                            <span></span>
                        </a>
                    </p>
                </div><!--/scroll-top-->
            </div><!--/wrapper-->
        </div><!--/copyrigt-footer-->
        
    </div><!--/footer-->



</div><!--/container-->


</body>
</html>