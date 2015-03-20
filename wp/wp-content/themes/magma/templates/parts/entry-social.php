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
    $stumbleupon_share = get_theme_option(wp_get_theme()->name . '_social_use_stumbleupon');

    if ($facebook_share != 'yes' || $twitter_share != 'yes' || $google_share != 'yes' || $linkedin_share != 'yes' || $pinterest_share != 'yes' || $stumbleupon_share != 'yes') {
        ?>
        <div class="shares-content">
             <?php
                if (substr(get_permalink(), -1) == '/') {
                    $thepermalink = substr(get_permalink(), 0, -1);
                } else {
                    $thepermalink = get_permalink();
                }
                $total_score = 0;
                if ($facebook_share != 'yes') {
                    $total_score = $total_score + get_likes($thepermalink);
                }
                if ($twitter_share != 'yes') {
                    $total_score = $total_score + get_tweets($thepermalink);
                }
                if ($google_share != 'yes') {
                    $total_score = $total_score + get_plusones($thepermalink);
                }
                if ($pinterest_share != 'yes') {
                    $total_score = $total_score + get_pinit($thepermalink);
                }
            ?>
            <span><?php echo $total_score ?> <?php _e('Shares', 'tkingdom'); ?> /</span>
            <ul>
                <?php if ($facebook_share != 'yes') { ?>
                <li class="share-fb">
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                        <strong></strong>
                        <p>Share <?php echo get_likes($thepermalink); ?></p>
                    </a>
                </li>
                <?php } ?>
                
                <?php if ($twitter_share != 'yes') { ?>
                <li class="share-twitter">
                    <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>">
                        <strong></strong>
                        <p>Share <?php echo get_tweets(get_permalink()); ?></p>
                    </a>
                </li>
                <?php } ?>

                <?php if ($google_share != 'yes') { ?>
                    <li class="share-google">
                        <a target="_blank" href="https://plus.google.com/share?url=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                            <strong></strong>
                            <p>Share <?php echo get_plusones($thepermalink); ?></p>
                        </a>
                    </li>
                <?php } ?>

                <?php if ($pinterest_share != 'yes') { ?>
                    <?php $pin_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                    <li class="share-pinterest">
                        <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $thepermalink; ?>&media=<?php echo $pin_image[0]; ?>&description=<?php the_title(); ?>">
                            <strong></strong>
                            <p>Share <?php echo get_pinit($thepermalink); ?></p>
                        </a>
                    </li>
                <?php } ?>
            </ul>


            <div class="clear"></div>
        </div><!--/social_sharing -->
    <?php } ?>

<?php } //Enable Social Share ?>