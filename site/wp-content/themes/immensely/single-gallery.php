<?php get_header(); ?>

<?php
$prefix = 'tk_';
$gallery_id = get_option('id_gallery_page');
$gallery_4_id = get_option('id_gallery4_page');
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $gallery_id ), 'full');
$title_bg4_image = wp_get_attachment_image_src( get_post_thumbnail_id( $gallery_4_id ), 'full');
$prev_post = get_previous_post();
$next_post = get_next_post();
$check_id = get_post($gallery_id);
?>

<div class="our-work fullwidth page single-gallery-post" id="content">

    <div class="banner banner-background" 
         <?php if(!empty($check_id)) { ?>
         style="<?php if(has_post_thumbnail($gallery_id)){echo 'background:url('.$title_bg_image[0].') no-repeat center';} ?>"
         <?php } else {?>
         style="<?php if(has_post_thumbnail($gallery_4_id)){echo 'background:url('.$title_bg4_image[0].') no-repeat center';} ?>"
         <?php } ?>
         >
        <div class="row-fluid">
            <div class="container clearfix BeanFadeDown">
                <h3><?php 
                if(!empty($check_id)) {
                    echo get_the_title($gallery_id);
                } else {
                    echo get_the_title($gallery_4_id);
                }
                    ?></h3>
                <div class="nav-arrow-devider pull-right">
                <nav class="nav-arrows">
                    <?php if(!empty($next_post)){?><a href="<?php echo $next_post->guid; ?>"><span class="nav-arrow" id="prev-1"><i class="fa fa-chevron-left"></i></span></a><?php } ?>
                    <a href="<?php if(!empty($check_id)) { echo get_permalink($gallery_id); } else { echo get_permalink($gallery_4_id); } ?>"><span class="nav-arrow"><i class="fa fa-th-large"></i></span></a>
                    <?php if(!empty($prev_post)){?><a href="<?php echo $prev_post->guid; ?>"><span class="nav-arrow" id="next-1"><i class="fa fa-chevron-right"></i></span></a><?php } ?>
                </nav>
            </div>
            </div>
        </div>
    </div>
        
    <div class="row-fluid">
        <div class="container">
            
            <?php
            //The Loop
            if (have_posts()): while (have_posts()): the_post();
            $format = get_post_format();
            $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
            ?>  

                <div class="work-presentation img-post-big">
                    <?php if($format == 'video') { ?>
                        <div class="video scalable-wrapper">
                            <div class="scalable-element">
                                <?php tk_video_player($video_link);?>
                            </div>
                        </div>
                    
                    <?php } elseif($format == 'gallery') { ?>
                        <div class="flexslider-part8">
                            <figure class="flexslider flexslider-8">
                                <ul class="slides">
                                    <?php
                                    $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
                                    foreach($attachments as $attach) { 
                                        echo '<li><img src="'.tk_get_thumb(1170, 658, $attach).'" alt="gallery_alt" title="gallery_title"/></li>';
                                     }
                                    ?>
                                </ul>
                            </figure><!-- flex slider -->
                        </div>
                    
                    <?php } else { ?>
                        <figure class="work-img">
                            <?php the_post_thumbnail('blog');?>
                        </figure>
                    <?php } ?>
                    
                        <div class="block single-soc-share">
                            <?php get_template_part( '/templates/parts/entry', 'social' ); ?>
                        </div><!--/single-soc-share-->
                </div>

                <article>
                    <h4><?php the_title(); ?></h4>
                    <div class="shortcodes">
                        <?php the_content(); ?>
                    </div>
                </article>

            
            <?php endwhile; endif; ?>

        </div>
    </div>

<?php
 /*
  * RELATED POSTS
  */

        $backup = $post; 
        $current = $post->ID; //current page ID
        $post_cats = get_the_terms($post->ID, 'ct_gallery');
        foreach ($post_cats as $post_cat);

        global $post;

        $args = array(
            'post_status' => 'publish', 
            'post_type' => 'gallery', 
            'posts_per_page' => 4, 
            'order' => 'DESC', 
            'orderby' => 'ID', 
            'exclude' => $current, 
            'tax_query' => array(
        array(
                                'taxonomy' => 'ct_gallery',
                                'field' => 'id',
                                'terms' => $post_cat -> term_id
        )
            )
        );

        $myposts = get_posts($args);

        $check = count($myposts);
        
        $disable_related = get_theme_option(wp_get_theme()->name . '_gallery_disable_related');
        if ($disable_related != 'yes' && $check > 1) {
            ?>   
    
    
          <div class="related-work">
            <div class="row-fluid">

                <?php if ($check > 1 ) { ?>
                
                <h2><?php _e('Related Work', wp_get_theme()->name) ?></h2>
            <?php } ?>
                <div class="container">            
                        
                        <?php   
        foreach($myposts as $post) :
            setup_postdata($post);
    ?>
                        <div class="span3 img-post">
                            <?php 
                            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                            $pos_youtube = strpos($video_link, 'youtube');
                            if(has_post_format( 'video' )) {?>
                                    <figure>
                                            <?php the_post_thumbnail('related-posts'); ?>                                    
                                        <div class="post-opt-wrapper">
                                            <div class="post-options">
                                                <a class="<?php if (!empty($pos_youtube)){echo 'youtube';}else{echo 'vimeo';}?>" href="<?php echo $video_link; ?>" title="<?php echo the_title() ?>"><i class="fa fa-play gallery-page"></i></a>
                                                <a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a>
                                            </div>
                                        </div>
                                    </figure>
                                    <div class="post">
                                        <h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6>
                                        <div class="meta-data">
                                            <ul class="categories clearfix">
                                                <?php echo get_the_term_list($post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null); ?>
                                            </ul>
                                        </div>
                                    </div>
                            
                            <?php } elseif(has_post_format( 'gallery' )) {
                                $random_name = generateRandomString();
                                $slide_images = get_post_meta($post->ID, 'tk_repeatable', true);
                                 ?>
                                    <figure>
                                        <?php if(!empty($slide_images[0])){?>
                                            <img src="<?php echo tk_get_thumb(268, 212, $slide_images[0]); ?>" />
                                        <?php  }else{ // if has image set?>
                                            <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                                        <?php }// if not :-)?>                       
                                        <?php foreach(array_slice($slide_images, 0) as $the_image) { ?>
                                        <div class="post-opt-wrapper">
                                                <div class="post-options">
                                                    <a href="<?php echo $the_image; ?>" class="fancybox" rel="<?php echo $random_name ?>"><i class="gallery-hover-dots gallery-page"></i></a>
                                                    <a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a>
                                                </div>
                                        </div>
                                        <?php } ?>
                                    </figure>
                                
                                    <div class="post">
                                        <h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6>
                                        <div class="meta-data">
                                            <ul class="categories clearfix">
                                                <?php echo get_the_term_list($post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null); ?>
                                            </ul>
                                        </div>
                                    </div>                            
                            
                            <?php } else { 
                                $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                                ?>
                                <figure>
                                    <?php the_post_thumbnail('related-posts'); ?>
                                    <div class="post-opt-wrapper">
                                        <div class="post-options">
                                            <a href="<?php echo $image_full[0]; ?>" class="fancybox" title="<?php echo the_title() ?>"><i class="fa fa-plus"></i></a>
                                            <a href="<?php the_permalink() ?>"><i class="fa fa-level-up"></i></a>
                                        </div>
                                    </div>
                                </figure>
                                <div class="post">
                                    <h6><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h6>
                                    <div class="meta-data">
                                        <ul class="categories clearfix">
                                            <?php echo get_the_term_list($post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null); ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <?php endforeach; ?>
                    <?php
    $post = $backup; 
    wp_reset_query();
?>
                </div>
            </div>
          </div>
        <?php } ?>    

            
</div><!-- work -->


<?php get_footer(); ?>