<div <?php post_class(); ?>>
    <?php if(is_single()){?>
        <div class="row">
            <?php
            if(has_post_thumbnail()){ ?>
                <div class="span8">
                    <a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
            <?php }?>
        </div><!-- /.row -->

        <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
        <span><?php _e('Posted:', 'tkingdom') ?></span><p class="meta"><?php echo get_the_date()?></p>
        <span><?php _e('By:', 'tkingdom') ?></span><p class="meta"><?php the_author_posts_link();?></p>
        <span><?php _e('Categories:', 'tkingdom') ?></span><p class="meta"><?php echo get_the_category_list(', ', $post->ID); ?></p>
        <span><?php _e('Comments:', 'tkingdom') ?></span><p class="meta"><a href="<?php the_permalink()?>"><?php comments_number( '0', '1', '%' ); ?></a></p>
        <div class="row">
            <div class="span8">
                <?php the_content(); ?>
            </div><!-- .span6 or .span8 -->
        </div><!-- /.row -->
    <?php }else{?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
        <span><?php _e('Posted:', 'tkingdom') ?></span><p class="meta"><?php echo get_the_date()?></p>
        <span><?php _e('By:', 'tkingdom') ?></span><p class="meta"><?php the_author_posts_link();?></p>
        <span><?php _e('Categories:', 'tkingdom') ?></span><p class="meta"><?php echo get_the_category_list(', ', $post->ID); ?></p>
        <span><?php _e('Comments:', 'tkingdom') ?></span><p class="meta"><a href="<?php the_permalink()?>"><?php comments_number( '0', '1', '%' ); ?></a></p>
        <div class="row">
            <?php
            if(has_post_thumbnail()){ ?>
                <div class="span2">
                    <a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
            <?php }?>
            <div class="<?php if(has_post_thumbnail()){ echo 'span6';}else{echo 'span8';}?>">
                <?php the_excerpt(); ?>
            </div><!-- .span6 or .span8 -->
        </div><!-- /.row -->
    <?php } // close if is single?>
</div><!-- /.post_class -->