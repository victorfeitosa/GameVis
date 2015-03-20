<?php 

get_header(); 
$position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');

?>

<div id="main-wrapper">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
        <div class="row">
            <div class="shortcodes col-md-9">
                <h1 class="page-title"><?php _e('404 - Error', 'tkingdom')?></h1>
                <article>
                    <p><?php _e('Looks like the page you were looking for does not exist. Sorry about that.', 'tkingdom')?></p>
                    <p><?php _e('Check the web address for typos, or go to', 'tkingdom')?> <a href="<?php echo home_url() ?>"><?php _e('Home Page', 'tkingdom')?></a></p>
                </article>
            </div>
            <!-- Sidebar Right -->
            <?php
                echo '<div class="col-md-3 pull-right" id="sidebar" ><div class="sidebar-content">';
                tk_get_sidebar('Right', '404');
                echo '</div></div>';
            ?>
            <!--/sidebar-->
        </div>
    </div>
</div>

<?php get_footer(); ?>