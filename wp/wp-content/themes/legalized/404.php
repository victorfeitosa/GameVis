<?php 

get_header();

$prefix = 'tk_';

?>

<!-- CONTENT STARTS -->
<section>
    <div class="container">

        <!-- Archive Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <h1 class="page_title"><?php _e('404 - Error', tk_theme_name) ?></h1>
                    <h2 class="page_description"><?php _e('Page does not exist', tk_theme_name) ?></h2>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" />
                </div>
            </div>
            <br>


            <!-- Page Content -->
            <div class="row-fluid">

                <!-- Main Content -->
                <div id="content" class="span8">
                    <div class="page-404">
                        <h3><?php _e('Looks like the page you were looking for does not exist. Sorry about that.', tk_theme_name)?></h3>
                        <div class="row-fluid">
                            <div class="span12">
                                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-medium-long.png" />
                            </div>
                        </div>
                        <p><?php _e('Check the web address for typos, or go to', tk_theme_name)?> <a href="<?php echo home_url(); ?>"><?php _e('HOME PAGE', tk_theme_name)?></a></p>
                    </div><!--/page-404-->
                </div><!--/content -->


                <!-- Sidebar Right -->
                <?php 
                    echo '<div id="sidebar" class="span4 rounded">';
                        dynamic_sidebar('404 Sidebar');
                    echo '</div>';
                ?>

            </div><!-- row-fluid -->


<?php get_footer(); ?>