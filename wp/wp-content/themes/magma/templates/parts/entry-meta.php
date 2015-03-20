<li>
    <span><?php the_time('d M, y'); ?></span>
</li>
<li>
    <strong>
        <span><?php _e('by', 'tkingdom'); ?></span>
        <?php the_author_posts_link();?>
    </strong>
</li>
<li>
    <strong>
        <span><?php _e('in', 'tkingdom'); ?> </span> <?php echo get_the_category_list( ', ' ); ?>
    </strong>
</li>
<li>
    <a href="<?php comments_link();?>">
        <img src="<?php echo get_template_directory_uri().'/theme-images/comment.png'; ?>"/>
        <?php echo get_comments_number(); ?>
    </a>
</li>
<li class="vote-count">
    <?php $vote_count = get_post_meta($post->ID, "votes_count", true); if ( tk_has_voted($post->ID) ) { ?>
    <a href="#" class="liked">
        <img src="<?php echo get_template_directory_uri().'/theme-images/like.png'; ?>" class="like"/>
        <img src="<?php echo get_template_directory_uri().'/theme-images/like-0.png'; ?>" class="like-0"/>
        <span class="number count_<?php echo $post->ID ?>"><?php if ($vote_count == '') { echo '0'; } else { echo $vote_count; }; ?></span>
    </a>
    <?php } else { ?>
    <a href="#" data-post_id="<?php echo $post->ID; ?>">
        <img src="<?php echo get_template_directory_uri().'/theme-images/like.png'; ?>" class="like"/>
        <img src="<?php echo get_template_directory_uri().'/theme-images/like-0.png'; ?>" class="like-0"/>
        <span class="number count_<?php echo $post->ID ?>"><?php if ($vote_count == '') { echo '0'; } else { echo $vote_count; }; ?></span>
    </a>
    <?php } ?>
</li>