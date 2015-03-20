<?php wp_footer();?>

    <!-- FOOTER -->
    <div class="footer left">
        <div class="wrapper">
            
            <div class="slide">
                <a href="#" class="btn-slide">
                    <div class="bg-show right"><span><?php _e('Show Footer', tk_theme_name)?></span></div><!--/bg-show-->
                    <div class="bg-hide right"><span><?php _e('Hide Footer', tk_theme_name)?></span></div><!--/bg-hide-->
                </a>
            </div><!--/slide-->
            
            <div id="panel">
                <div class="panel-content left" style="width: 100%">


                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                    <div class="footer_box"  style="margin-right: 0;">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 4')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                </div><!--/panel-content-->
            </div><!--/panel-->
            
            <div class="footer-border left"></div><!--/footer-border-->
            
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
                        <a href="#top" style="padding-right: 5px">
                            <?php _e('- To the Top', tk_theme_name)?>
                            <span></span>
                        </a>
                    </p>
                </div><!--/scroll-top-->
            </div><!--/wrapper-->
        </div><!--/copyrigt-footer-->
            
            
        </div><!--/wrapper-->
    </div><!--/footer-->

</div><!--/container-->

</body>
</html>