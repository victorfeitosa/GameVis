<?php get_header(); ?>

<div class="block bg-content">

    <div class="container">
        <div class="row">
            <div class="sc-fullwidth-holder">
                <div class="white-bg">
                    <div class="content-with-sidebar shortcodes col-xs-8">
                        <h1 class="title-divider"><span><?php _e('Looks like the page you were looking for does not exist. Sorry about that.', 'tkingdom')?></span></h1>
                        <p><?php _e('Check the web address for typos, or go to', 'tkingdom')?> <a href="<?php echo home_url() ?>"><?php _e('Home Page', 'tkingdom')?></a></p>
                    </div><!--/col-xs-8-->

                    <!-- Sidebar Right -->
                    <?php
                        echo '<div class="col-xs-4 pull-right" id="sidebar" ><div class="sidebar-content">';
                        tk_get_sidebar('Right', '404');
                        echo '</div></div>';
                    ?>
                    <!--/sidebar-->
                </div><!--/row-fluid-->
            </div>
        </div>
    </div><!--/container-->
</div>    

<?php get_footer(); ?>