<?php get_header();
$prefix = 'tk_';
$tk_blog_id = get_option('id_blog_page');
$sidebar_position = get_post_meta($blog_id, $prefix.'sidebar_position', true);
if($sidebar_position == ''){$sidebar_position = 'right';}
?>

    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php _e('404 - Error', tk_theme_name)?></h1>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->


            <div class="shortcodes left">


                <div class="bg-page-404 left">
                    <div class="page-404-content left">
                        <h2><?php _e('Looks like the page you were looking for does not exist. Sorry about that.', tk_theme_name)?></h2>
                        <span><?php _e('Check the web address for typos, or go to', tk_theme_name)?> <a href="<?php echo home_url(); ?>"><?php _e('HOME PAGE', tk_theme_name)?></a></span>
                    </div><!--page-404-content-->
                </div><!-- /bg-page-404 -->



            </div><!-- /shortcodes -->

            <?php tk_get_sidebar('Right', '404 Sidebar'); ?>
            
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>