    <div class="meta">
        <div class="meta-data date"><?php _e('posted on', 'tkingdom'); ?> <span class="meta-date"><?php the_time('d ').', '.the_time('M ').', '.the_time('y'); ?></span></div>
        <div class="meta-data comments"><?php _e('comments', 'tkingdom'); ?> <a href="<?php comments_link();?>"><?php comments_number( '0', '1', '%' ); ?></a></div>
        <div class="meta-data author"><?php _e('by', 'tkingdom'); ?> <?php the_author_posts_link();?></div>
        <div class="meta-data meta-cats">
            <ul class="categories clearfix">
                <?php echo get_the_category_list(' <span class="gallery-category-divider">&#9679;</span> ', $post->ID); ?>
            </ul>
        </div>
        <div class="meta-read-more"><a href="<?php the_permalink(); ?>" class="meta-data button-small pull-right"><?php _e('read more', 'tkingdom'); ?></a></div>
    </div>