<?php
get_header();

$prefix = 'tk_';

/* Get full image size */
$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');

?>

<!-- CONTENT STARTS -->
<section>
    <div class="container">

            <!-- Attachment Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <h1 class="page_title"><?php the_title()?></h1>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" alt="separator" />
                </div>
            </div>
            <br>


            <!-- Page Content -->
            <div class="blog-images">
                <a href="<?php echo $image_full[0]?>" class="fancybox" title="<?php the_title()?>" alt="<?php the_title()?>">
                    <img src="<?php echo $image_full[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"/>
                </a>
            </div><!--/blog-images-->

<?php get_footer(); ?>