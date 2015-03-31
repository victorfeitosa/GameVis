<?php get_header(); ?>


<div class="error-404 page" id="content">

    <div class="banner banner-background">
        <div class="row-fluid">
            <div class="container">
                <h3><?php _e('404 - Error', 'tkingdom')?></h3>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?php echo home_url() ?>">Home</a><span class="divider fourofour"> <i class="fa fa-circle"></i></span></li>
                    <li class="active">404 - Error</li>
                </ul>
            </div>
        </div>
    </div>
        
    <div class="row-fluid">
        <div class="container">

            <div class="span9">
                <article>
                    <p><?php _e('Looks like the page you were looking for does not exist. Sorry about that.', 'tkingdom')?></p>
                    <aside><?php _e('Check the web address for typos, or go to', 'tkingdom')?> <a href="<?php echo home_url() ?>"><?php _e('Home Page', 'tkingdom')?></a></aside>
                </article>
            </div>

                <div class="span3" id="sidebar" >
                            <div class="span11 pull-right">
                        <?php tk_get_sidebar('Right', '404'); ?>
                    </div><!--/sidebar-->
                </div>
        </div>
    </div>
    
</div><!-- 404 -->


<?php get_footer(); ?>