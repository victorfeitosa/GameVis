<?php

function tk_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; 
    ?>

        <div <?php comment_class(); ?>>
            <div  id="comment-<?php echo comment_ID();?>"></div>
            <div class="comment-start-one left">
                <div class="comment-images"><?php echo get_avatar($comment,$size='35' ); ?></div><!--/comment-images-->
                <div class="comment-start-title right">
                    <span><?php echo $comment->comment_author ?></span>
                    <p><?php echo comment_date( get_option( 'date_format' ).' '.get_option( 'time_format' ), $comment->comment_ID ); ?> <?php if ($comment->comment_approved == '0') : ?><?php _e('- Your comment is awaiting moderation.', tk_theme_name) ?><?php endif; ?> <?php edit_comment_link(__(' - Edit - ', tk_theme_name),'  ','') ?> <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
                </div><!--/comment-start-title-->
                <div class="comment-start-text left">
                    <?php comment_text() ?>
                </div><!--/comment-start-text-->
            </div><!--/comment-start-one-->
        </div><!--/comment-start-one-->

<?php } ?>
        
<!-- COMMENTS LIST -->
<div class="comments-holder">
        <?php wp_list_comments('type=comment&callback=tk_comments'); ?>
</div>

<!-- COMMENTS PAGINATION -->
 <div class="comments-pagination">
  <?php paginate_comments_links(); ?> 
 </div>

<!-- COMMENT FORM -->
<?php comment_form(); ?>
            