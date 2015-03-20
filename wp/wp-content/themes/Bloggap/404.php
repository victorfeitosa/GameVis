<?php
get_header(); ?>
        <!-- CONTENT -->
        <div class="content right">
            <div class="title-page left"><h1><?php _e('404 - Error', tk_theme_name); ?></h1></div><!--/title-page-->
            <div class="page-404 left">
                <div class="text-404 left"><p><?php _e('Looks like the page you were looking for does not exist. Sorry about that.', tk_theme_name); ?></p></div><!--/text-404-->
                <div class="about-border left"></div><!--/about-border-->
                <div class="link-404 left"><span><?php _e('Check the web address for typos, or go to', tk_theme_name); ?> <a href="<?php echo home_url(); ?>"><?php _e('HOME PAGE', tk_theme_name); ?></a></span></div><!--/link-404-->
            </div><!--/page-404-->
        </div><!--/content-->
    </div><!--/wrapper-->    
<?php get_footer(); ?>
