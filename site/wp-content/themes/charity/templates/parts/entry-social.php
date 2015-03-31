<?php //Enable Social Share

$post_type = get_post_type();
if($post_type == 'post') {
    $social_share = get_theme_option(wp_get_theme()->name . '_social_social_share_blog');
} elseif($post_type == 'events') {
    $social_share = get_theme_option(wp_get_theme()->name . '_social_social_share_events');
} elseif($post_type == 'services') {
    $social_share = get_theme_option(wp_get_theme()->name . '_social_social_share_causes');
}

if ($social_share !== 'yes') {
    ?>

    <!-- Social Share Buttons -->
    <?php
    $facebook_share = get_theme_option(wp_get_theme()->name . '_social_use_facebook');
    $twitter_share = get_theme_option(wp_get_theme()->name . '_social_use_twitter');
    $google_share = get_theme_option(wp_get_theme()->name . '_social_use_google');
    $linkedin_share = get_theme_option(wp_get_theme()->name . '_social_use_linkedin');
    $pinterest_share = get_theme_option(wp_get_theme()->name . '_social_use_pinterest');
    $stumbleupon_share = get_theme_option(wp_get_theme()->name . '_social_use_stumbleupon');
    $thepermalink = get_permalink();

    if ($facebook_share != 'yes' || $twitter_share != 'yes' || $google_share != 'yes' || $linkedin_share != 'yes' || $pinterest_share != 'yes' || $stumbleupon_share != 'yes') {
        ?>
        <div class="block single-soc-share">

            <?php if ($facebook_share != 'yes') { ?>
                <div class="pull-left single-soc-share-link-fb">
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                        <span><?php echo get_likes($thepermalink); ?></span>
                        <p><?php _e('Facebook', 'tkingdom') ?></p>
                    </a>
                </div><!--/single-soc-share-link-fb-->
            <?php } ?>

            <?php if ($twitter_share != 'yes') { ?>
                <div class="pull-left single-soc-share-link-twitter">
                    <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>" class="twitter-share-button">
                        <span><?php echo get_tweets(get_permalink()); ?></span>
                        <p><?php _e('Twitter', 'tkingdom') ?></p>
                    </a>
                </div><!--/single-soc-share-link-twitter-->
            <?php } ?>

            <?php if ($google_share != 'yes') { ?>
                <div class="pull-left single-soc-share-link-google">
                    <a target="_blank" href="https://plus.google.com/share?url=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                        <span><?php echo get_plusones($thepermalink); ?></span>
                        <p><?php _e('Google+', 'tkingdom') ?></p>
                    </a>
                </div><!--/single-soc-share-link-google-->
            <?php } ?>

            <?php if ($linkedin_share != 'yes') { ?>
                <div class="pull-left single-soc-share-link-linkedin">
                    <a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>">
                        <span><?php echo get_linkedin($thepermalink); ?></span>
                        <p><?php _e('LinkedIn', 'tkingdom') ?></p>
                    </a>
                </div><!--/single-soc-share-link-linkedin-->
            <?php } ?>

            <?php if ($pinterest_share != 'yes') { ?>
                <?php $pin_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                <div class="pull-left single-soc-share-link-pinterest">
                    <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $thepermalink; ?>&media=<?php echo $pin_image[0]; ?>&description=<?php the_title(); ?>">
                        <span><?php echo get_pinit($thepermalink); ?></span>
                        <p><?php _e('Pinterest', 'tkingdom') ?></p>
                    </a>
                </div><!--/single-soc-share-link-pinterest-->
            <?php } ?>

            <?php if ($stumbleupon_share != 'yes') { ?>
                <div class="pull-left single-soc-share-link-stumbleupon">
                    <a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>">
                        <span><?php echo get_stumbleupon($thepermalink); ?></span>
                        <p><?php _e('Stumbleupon', 'tkingdom') ?></p>
                    </a>
                </div><!--/single-soc-share-link-stumbleupon-->
            <?php } ?>

            <div class="clear"></div>
        </div><!--/social_sharing -->
    <?php } ?>

<?php } //Enable Social Share ?>