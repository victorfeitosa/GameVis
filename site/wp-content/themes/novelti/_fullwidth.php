<?php 
/*

Template Name: Fullwidth

*/
get_header();
$prefix = 'tk_';
$subheadline = get_post_meta($post->ID, $prefix.'subheadline', true);
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full no-sidebar-background content-margin left">
                
                <div class="title-on-page left">
                    <h1><?php the_title(); ?></h1>
                    <?php if($subheadline) { ?><p><?php echo $subheadline; ?></p><?php } ?>
                </div>
            
                <div class="shortcodes left"> 
                    <?php
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                           the_content();
                       endwhile; endif;
                    ?>
                </div><!-- /shortcodes -->  


            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>