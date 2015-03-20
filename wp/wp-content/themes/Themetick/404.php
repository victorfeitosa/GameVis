<?php

get_header(); ?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            
         <?php tk_get_left_sidebar('Left', 'Blog')?>
            <div class="page-content right">

                <div class="page-404 right">
                    <h1><?php _e("404 Error", 'Themetick'); ?></h1>
                    <p><?php _e("Looks like the page you were looking for does not exist. Sorry about that.", 'Themetick'); ?></p>
                    <span><?php _e('Check the web address for typos, or go to', 'Themetick') ?><a href="<?php echo bloginfo('homeurl') ?>"><?php _e('HOME PAGE', 'Themetick') ?></a></span>
                </div><!--/page-404-->

            </div><!--/page-content-->


        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>