<div <?php post_class(); ?>>
    <?php
    $quote_text = get_post_meta($post->ID, 'tk_quote', true);
    $quote_author = get_post_meta($post->ID, 'tk_quote_author', true); 
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
        <figure class="clearfix">
          <div class="shout clearfix quote">
            <blockquote class="quote-single">
              <i class="icon-quotes-left"></i><?php echo $quote_text; ?><small class="roboto-bold-italic"><?php echo $quote_author; ?></small>
            </blockquote>
          </div>
        </figure>
        <div class="post-author">
          <figure>
            <?php echo get_avatar($post->post_author, 32); ?>
          </figure>
          <span class="roboto-bold-italic"><?php echo get_the_author(); ?></span>
        </div>
        <h1>
          <?php echo get_the_title(); ?>
          <?php if(is_sticky()){ ?><span class="sticky featured-banner"><?php _e('Featured Post', 'tkingdom') ?></span><?php } ?>
        </h1>
        <div class="post-meta">
          <ul>
            <li>
              <strong><?php _e('Category:', 'tkingdom'); ?></strong><?php echo get_the_category_list(', ', $post->ID); ?>
            </li>
            <li>
              <strong><?php _e('Date:', 'tkingdom'); ?></strong><time><?php echo get_the_date(); ?></time>
            </li>
            <li class="meta-comments"><a href="<?php comments_link(); ?>" class="roboto-bold"><?php echo get_comments_number(); ?></a></li>
          </ul>
        </div>
        <div class="shortcodes">
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        </div>
    <?php }else{
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Blog page                   */
    /*                                                          */
    /************************************************************/
      ?>
     <div class="post-author">
        <figure>
          <?php echo get_avatar($post->post_author, 32); ?>
        </figure>
        <span class="roboto-bold-italic"><?php echo get_the_author(); ?></span>
      </div>
      <div class="shout clearfix quote">
        <blockquote><i class="icon-quotes-left"></i><?php echo $quote_text; ?><small class="roboto-bold-italic"><?php echo $quote_author; ?></small></blockquote>
      </div>
      <div class="post-meta clearfix">
        <ul>
          <li>
            <strong><?php _e('Category:', 'tkingdom'); ?></strong><?php echo get_the_category_list(', ', $post->ID); ?>
          </li>
          <li>
            <strong><?php _e('Date:', 'tkingdom'); ?></strong><time><?php echo get_the_date(); ?></time>
          </li>
          <li class="meta-comments"><a href="<?php comments_link(); ?>" class="roboto-bold"><?php echo get_comments_number(); ?></a></li>
        </ul>
        <a href="<?php echo get_permalink($post->ID); ?>" data-hover="<?php _e('Read More', 'tkingdom'); ?>" class="btn-sm roboto-bold"><span class="secondary-color-btn"><?php _e('Read More', 'tkingdom'); ?></span></a>
      </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->