<div class="row author-single">
    <div class="col-xs-2">
        <?php echo get_avatar(get_the_author_meta('ID'), '73'); ?>
    </div>
    <?php 
        $user_twitter = get_the_author_meta('twitter'); 
        $user_facebook = get_the_author_meta('facebook'); 
        $user_googleplus = get_the_author_meta('googleplus'); 
        $user_dribbble = get_the_author_meta('dribbble'); 
        $user_pinterest = get_the_author_meta('pinterest'); 
        $user_behance = get_the_author_meta('behance'); 
        $user_youtube = get_the_author_meta('youtube'); 
        $user_instagram = get_the_author_meta('instagram'); 
        $user_rssfeed = get_the_author_meta('rssfeed'); 
        $user_vimeo = get_the_author_meta('vimeo'); 
        ?>
    <div class="col-xs-10">
        <h3><?php the_author_posts_link();?></h3>
        <p><?php echo get_the_author_meta('description'); ?></p>
        <?php if( $user_twitter || $user_facebook || $user_googleplus || $user_dribbble || $user_pinterest || $user_behance || $user_youtube || $user_instagram || $user_rssfeed || $user_vimeo) { ?>
        <ul class="soc-icon">
            <?php if (!empty($user_dribbble)) { ?>
                <li><a href="http://www.dribbble.com/<?php echo $user_dribbble; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-dribbble.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_twitter)) { ?>
                <li><a href="http://twitter.com/<?php echo $user_twitter; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-t.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_facebook)) { ?>
                <li><a href="http://facebook.com/<?php echo $user_facebook; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-fb.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_googleplus)) { ?>
                <li><a href="http://plus.google.com/<?php echo $user_googleplus; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-g+.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_pinterest)) { ?>
                <li><a href="http://pinterest.com/<?php echo $user_pinterest; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-p.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_behance)) { ?>
                <li><a href="http://www.behance.net/<?php echo $user_behance; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-be.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_youtube)) { ?>
                <li><a href="http://www.youtube.com/<?php echo $user_youtube; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-yt.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_instagram)) { ?>
                <li><a href="http://www.instagram.com/<?php echo $user_instagram; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-instagram.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_rssfeed)) { ?>
                <li><a href="<?php echo $user_rssfeed; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-feed.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
            <?php if (!empty($user_vimeo)) { ?>
                <li><a href="http://www.vimeo.com/<?php echo $user_vimeo; ?>"><img src="<?php echo get_template_directory_uri().'/theme-images/soc-icon-vimeo.jpg'?>" alt="Image" title="Image" /></a></li>
            <?php } ?>
        </ul>
        <?php } ?>
    </div>
</div>  