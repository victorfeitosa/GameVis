<?php 
$ad_post = get_option('ad-post-' . $post->ID);
$prefix="tk_";
$custom_banner = get_post_meta($ad_post, $prefix.'custom_banner_code', true);
$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($ad_post), 'full' ); 
tk_add_banner_view($ad_post);
?>
<div class="home-content-ad left">
    
    <?php if(!empty($custom_banner)) { 
        echo $custom_banner;        
    } else { ?>        
        <a href="<?php site_url(); ?>?banner_id=<?php echo $ad_post; ?>">
            <img src="<?php echo $image_src[0]; ?>" title="<?php the_title($ad_post)?>" alt="<?php the_title($ad_post)?>"/>
        </a>
    <?php } ?>
    
</div>