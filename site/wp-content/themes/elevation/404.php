<?php

get_header(); ?>


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="bg-content left">
                <div class="bg-content-center">
                    
                    <div class="content-pages-left">

                        <div class="title-404 left"><?php _e("Looks like the page you were looking for does not exist. Sorry about that.", tk_theme_name)?></div><!--/title-404-->
                        <div class="text-404 left"><?php _e("Check the web address for typos, or go to", tk_theme_name)?><a href="<?php echo home_url()?>"><?php _e("Home page", tk_theme_name)?></a></div><!--/text-404-->
                        
                    </div><!--/content-pages-left-->
                    
                    <div class="border-content-right left"></div><!--/border-content-right-->

                <!--SIDBAR-->
                <?php tk_get_right_sidebar('Right', 'Sidebar Default/Home')?>
                    
                </div><!--/bg-content-center-->
            </div><!--/bg-content-->
            
            <div class="border-down-content left"></div><!--/border-down-content-->

        </div><!--/wrapper-->
    </div><!--/content-->
    
    
<?php get_footer(); ?>
