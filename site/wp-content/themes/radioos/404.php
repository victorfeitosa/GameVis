<?php

get_header(); ?>


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

                <?php get_template_part( 'inc/category_navigation' );?>
            
            <div class="content-right">        
                <div class="bg-pages-right right">


                    <div class="title-pages left">
                        <span><?php _e("404 - Error", tk_theme_name)?></span>
                        <p></p>
                    </div><!--/title-pages-->


                    <div class="pages-404 left">
                        <span><?php _e("Looks like the page you were looking for does not exist. Sorry about that.", tk_theme_name)?></span>
                        <span><?php _e("Check the web address for typos, or go to", tk_theme_name)?><a href="<?php echo home_url()?>"><?php _e("Home page", tk_theme_name)?></a></span>
                    </div><!--/pages-404-->


                </div><!--/bg-pages-right-->
            </div><!--/content-right-->

        </div><!--/wrapper-->
    </div><!--/content-->

    
<?php get_footer(); ?>
