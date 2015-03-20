<?php get_header();?>

    <div class="row-fluid page-404">
        <div class="container title-404">
            <h2><?php _e('40', 'tkingdom')?></h2>
            <h1><?php _e('404', 'tkingdom')?></h1>
            <h2><?php _e('04', 'tkingdom')?></h2>
        </div>
        <div class="container text-404">
            <hr>
            <span><?php _e('The page you are looking for does not exist', 'tkingdom')?></span>
            <hr>
            <p><?php _e('Go to', 'tkingdom')?><a href="<?php echo home_url() ?>"><?php _e('Home Page', 'tkingdom')?></a></p>
        </div>
    </div>
<?php get_footer(); ?>

