<?php //Enable Social Share
$post_type = get_post_type();
if($post_type == 'post') {
    $social_share = get_theme_option(wp_get_theme()->name . '_social_social_share_blog');
} elseif($post_type == 'gallery') {
    $social_share = get_theme_option(wp_get_theme()->name . '_social_social_share_gallery');
}   
    if ($social_share != 'yes') {
    ?>

    <!-- Social Share Buttons -->
    <?php
    $facebook_share = get_theme_option(wp_get_theme()->name . '_social_use_facebook');
    $twitter_share = get_theme_option(wp_get_theme()->name . '_social_use_twitter');
    $google_share = get_theme_option(wp_get_theme()->name . '_social_use_google');
    $linkedin_share = get_theme_option(wp_get_theme()->name . '_social_use_linkedin');
    $pinterest_share = get_theme_option(wp_get_theme()->name . '_social_use_pinterest');
    $thepermalink = get_permalink();

    // <ul class="social">

        //<li><a href="#"><i class="icon-dribbble"></i></a></li>
        //<li><a href="#"><i class="icon-be"></i></a></li>
        //<li><a href="#"><i class="icon-instagram"></i></a></li>
        //     <li><a href="#"><i class="icon-flikr"></i></a></li>
        //     <li><a href="#"><i class="icon-vimeo"></i></a></li>
        //     <li><a href="#"><i class="icon-rss"></i></a></li>

    // </ul>

    if ($facebook_share != 'yes' || $twitter_share != 'yes' || $google_share != 'yes' || $linkedin_share != 'yes' || $pinterest_share != 'yes') {
        ?>
        <ul class="social">

            <?php if ($facebook_share != 'yes') { ?>
                <li>
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                        <i class="icon-facebook"></i>
                    </a>
                </li><!--/single-soc-share-link-fb-->
            <?php } ?>

            <?php if ($twitter_share != 'yes') { ?>
                <li>
                    <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>">
                        <i class="icon-twitter"></i>
                    </a>
                </li><!--/single-soc-share-link-twitter-->
            <?php } ?>

            <?php  if ($google_share != 'yes') { ?>
                <li>
                    <a target="_blank" href="https://plus.google.com/share?url=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                        <i class="icon-google"></i>
                    </a>
                </li><!--/single-soc-share-link-google-->
            <?php } ?>

            <?php if ($linkedin_share != 'yes') { ?>
                <li>
                    <a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>">
                        <i class="icon-in"></i>
                    </a>
                </li><!--/single-soc-share-link-linkedin-->
            <?php } ?>

            <?php if ($pinterest_share != 'yes') { ?>
                <?php $pin_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                <li>
                    <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $thepermalink; ?>&media=<?php echo $pin_image[0]; ?>&description=<?php the_title(); ?>">
                        <i class="icon-pin"></i>
                    </a>
                </li><!--/single-soc-share-link-pinterest-->
            <?php } ?>

            <!-- <div class="clear"></div> -->
        </ul><!--/social_sharing -->
    <?php } ?>

<?php } //Enable Social Share ?>