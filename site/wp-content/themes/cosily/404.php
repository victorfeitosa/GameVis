<?php get_header(); 
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_post_meta($blog_id, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
?>

        <!-- Page Headline -->
        <div class="title-pages left">
                <div class="title-pages-image left"></div>
                <div class="wrapper">
                    <span><?php _e('404 - Error', tk_theme_name) ?></span>
                    <p><?php _e('Page not found', tk_theme_name) ?></p>
                </div>
        </div><!--/title-pages-->
        <div class="bottom-slider-red"></div><!--/bottom-slider-red-->


<!-- CONTENT -->
<div class="content-full left">
    <div class="wrapper">

        <div class="content-left left">

            <div class="page-404 left">
                <div class="text-404 left"><p><?php _e("Looks like the page you were looking for does not exist. Sorry about that.", tk_theme_name); ?></p></div><!--/text-404-->
                <div class="link-404 left"><span><?php _e("Check the web address for typos, or go to", tk_theme_name) ?>  <a href="<?php echo home_url() ?>"><?php _e("HOME PAGE", tk_theme_name) ?></a></span></div><!--/link-404-->
            </div><!--/page-404-->

        </div><!--/content-left-->

                <?php tk_get_sidebar('Right', '404 Sidebar'); ?>

    </div><!--/wrapper-->
</div><!--/content-->

<?php get_footer(); ?>