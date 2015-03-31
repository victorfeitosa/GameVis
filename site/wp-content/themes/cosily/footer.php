<!--FOOTER-->
    <div class="footer-red-border left"></div>


    <!-- FOOTER -->
    <div class="footer left">        
        <?php
            /* *****FOOTER WIDGETS****** */
        $check_footer1 = is_active_sidebar('sidebar-6');
        $check_footer2 = is_active_sidebar('sidebar-7');
        $check_footer3 = is_active_sidebar('sidebar-8');
        if ($check_footer1 == true || $check_footer2 == true || $check_footer3 == true) { }
        ?>
        
        <div class="wrapper">

            <div class="footer-widgets left">

                   
                <!--footer widget area one-->
                <div class="footer_box">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                    <?php endif; ?>  
                </div><!--footer_box-->
                
                <!--footer widget area two-->
                <div class="footer_box">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                    <?php endif; ?>  
                </div><!--footer_box-->        
                
                <!--footer widget area three-->
                <div class="footer_box">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                    <?php endif; ?> 
                </div><!--footer_box-->
                
                

            </div><!--/footer-widgets-->          
            
        </div><!--/wrapper-->

        
        
    <div class="footer-copyright left">
        <div class="wrapper">     
            <?php
            /* * *****COPYRIGHT****** */
            $copyright = get_theme_option(tk_theme_name . '_general_footer_copy');
            if (empty($copyright)) {
                $copyright = "Copyright Information Goes Here &copy; 2013. All Rights Reserved.";
            }
            ?>
            <div class="footer-copyright-text left"><?php echo $copyright?></div><!--/footer-copyright-text-->
            <div class="scroll-top"><p id="back-top"><a href="#top"><span></span></a></p></div><!--/scroll-top-->
        </div><!--/wrapper-->
    </div><!--/footer-copyright-->
        
        
    </div><!--/footer-->

</div><!--/container-->
<?php wp_footer();?>
</body>
</html>