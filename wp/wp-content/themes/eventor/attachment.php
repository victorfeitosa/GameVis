<?php
get_header();
$prefix = 'tk_';
$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            
                        <!-- Page Headline-->
            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php the_title(); ?></h1>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->
            
            <div class="blog-holder left">

                <div class="bg-content left">
                    <div class="wrapper-content">

                        <div class="blog-images left"><a href="<?php echo $image_full[0]?>" class="fancybox" title="<?php the_title()?>" alt="<?php the_title()?>"><img class="attachment-image" src="<?php echo $image_full[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"/></a></div><!--/blog-images-->

                    </div><!--/wrapper-content-->
                </div><!--/bg-content-->

            </div><!--/blog-holder-->
        </div><!--/wrapper-->
    </div><!--/content-->



<?php get_footer(); ?>