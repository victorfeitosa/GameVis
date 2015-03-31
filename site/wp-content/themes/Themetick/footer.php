<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>


    <!-- FOOTER -->
    <div class="footer left">
        <div class="wrapper">
            <div class="footer-content left">
                <?php
                    $use_footer = get_theme_option(tk_theme_name.'_general_use_footer');
                    if($use_footer !== 'yes') {
                ?>
                <div class="footer-others left">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                        <?php endif; ?>
                </div><!--/footer-others-->


                <div class="footer-others left">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                        <?php endif; ?>
                </div><!--/footer-others-->


                <div class="footer-others left" style="margin: 0 !important;">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                        <?php endif; ?>
                </div><!--/footer-others-->
                
                <?php } ?>
                
                   <?php
                        $footer_logo = get_theme_option(tk_theme_name.'_general_footer_logo');
                        if(empty($footer_logo)) {
                        $footer_logo = get_template_directory_uri()."/style/img/footer-logo.png";
                     }?>


                <div class="footer-copyright left <?php if ($use_footer == 'Yes') { echo "noborder"; }?> ">

                    <div class="footer-logo">
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo $footer_logo; ?>" alt='logo' /></a>
                    </div>
                    <div class="copyright-text">
                    <?php
                        $copyright = get_theme_option(tk_theme_name.'_general_footer_copy'); ?>
                    <span>
                        <?php  echo $copyright; ?>
                    </span>
                    </div>
                    <div class="scroll-top">
                        <p id="back-top">To the Top
                            <a href="#top"><span></span></a>
                        </p>
                    </div><!--/scroll-top-->
                </div><!--/footer-copyright-->



            </div><!--/footer-content-->
        </div><!--/wrapper-->
    </div><!--/footer-->



</div><!--/container-->
<?php wp_footer(); ?>
</body>
</html>