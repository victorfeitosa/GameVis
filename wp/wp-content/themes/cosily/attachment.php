<?php
get_header();
$prefix = 'tk_';
$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
?>

    <!-- Page Headline -->
    <div class="title-pages left">
            <div class="wrapper">
                <span><?php the_title()?></span>
            </div>
    </div><!--/title-pages-->
    <div class="bottom-slider-red"></div><!--/bottom-slider-red-->

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="blog-images left" style="margin-top: 30px"><a href="<?php echo $image_full[0]?>" class="fancybox" title="<?php the_title()?>" alt="<?php the_title()?>"><img src="<?php echo $image_full[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"/></a></div><!--/blog-images-->

        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>