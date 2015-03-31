<?php
get_header();
$prefix = 'tk_';
$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
?>

<div class="content left">
        <div class="wrapper">
            <div class="content-full no-sidebar-background content-margin left">
                
                <div class="title-on-page left">
                    <h1><?php the_title()?></h1>
                    <div class="blog-images left"><a href="<?php echo $image_full[0]?>" class="fancybox" title="<?php the_title()?>" alt="<?php the_title()?>"><img style="width: 100%" src="<?php echo $image_full[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"/></a></div><!--/blog-images-->
            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div>
</div>
<?php get_footer(); ?>