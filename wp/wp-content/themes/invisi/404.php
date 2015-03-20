<?php

get_header(); ?>


    <!-- TITLE PAGE -->
    <div class="slider-content left">
        <div class="wrapper">
            <div class="bg-title-page left">
                <div class="title-page left"><?php _e("404 error", tk_theme_name)?></div><!--/title-page-->
            </div><!--/bg-title-page-->
        </div><!--/wrapper-->
    </div><!--/slider-content-->

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="bg-content left">
            
                <div class="content-left left">
                    
                    <div class="title-404 left"><?php _e("Looks like the page you were looking for does not exist. Sorry about that.", tk_theme_name)?>.</div><!--/title-404-->
                    <div class="text-404 left"><?php _e("Check the web address for typos, or go to", tk_theme_name)?><a href="<?php echo home_url()?>"><?php _e("Home page", tk_theme_name)?></a></div><!--/text-404-->
                    
                </div><!--/content-left-->

                <!--SIDBAR-->
                <?php tk_get_right_sidebar('Right', 'Sidebar Default/Home')?>
                
                <div class="silver-big-fake right"></div><!--/silver-big-fake-->

            </div><!--/bg-content-->
            
            <div class="help-content-down left"><div class="silver-big-fake right"></div></div><!--/help-content-down-->
            
        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>