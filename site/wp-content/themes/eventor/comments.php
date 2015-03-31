<?php global $sidebar_position; ?>

<div class="blog-categories <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
        <div class="bg-comment-comments left"><span><?php comments_number( '0', '1', '%' ); ?></span></div><!--bg-comment-comments-->
    </div><!--blog-categories-->

<?php

function tk_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; 
    ?>

        <div <?php comment_class(); ?>>
            <div  id="comment-<?php echo comment_ID();?>"></div>
            <div class="comment-start-one left">
                
                <div class="comment-images right"><?php echo get_avatar($comment,$size='40' ); ?></div><!--/comment-images-->
                <div class="comment-start-title left">
                    <span><?php echo $comment->comment_author ?></span>
                    <p><?php echo comment_date( get_option( 'date_format' ).' '.get_option( 'time_format' ), $comment->comment_ID ); ?> <?php if ($comment->comment_approved == '0') : ?><?php _e('- Your comment is awaiting moderation.', tk_theme_name) ?><?php endif; ?> <?php edit_comment_link(__(' - Edit - ', tk_theme_name),'  ','') ?> <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
                </div><!--/comment-start-title-->
                <div class="comment-start-text left">
                    <?php comment_text() ?>
                </div><!--/comment-start-text-->
            </div><!--/comment-start-one-->
        </div><!--/comment-start-one-->

<?php } ?>
        
        <a id="comment" name="comment"></a>
        <div class="comment-start <?php if($sidebar_position == 'right'){echo 'right';}elseif($sidebar_position == 'left'){echo 'left';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
            <div class="comment-title-images left">
                <?php if (get_comments_number() == '0') {?>
                    <span><?php _e('No comments so far!', tk_theme_name);?></span>
                <?php } ?>
            </div>

            <div class="comments-holder">            
            <!-- COMMENTS LIST -->
                    <?php wp_list_comments('type=comment&callback=tk_comments'); ?>
            </div>

<?php if ( comments_open() ) : ?>

        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <div class="comment-title left"><?php _e('You must be', tk_theme_name)?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', tk_theme_name) ?></a> <?php _e('to post a comment.', tk_theme_name) ?></div>
                <?php else : ?>
        </div><!-- /comment-start -->
<!-- COMMENT FORM -->
<div class="blog-content <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
    <div class="blog-one left">
        <div class="blog-categories <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
            <div class="bg-form-coment left"></div>
        </div><!--blog-categories-->
        <a id="respond" name="respond"></a>
        <div class="form form-single-margin <?php if($sidebar_position == 'right'){echo 'right';}elseif($sidebar_position == 'left'){echo 'left';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">

                <!--<a id="respond" name="respond"></a>-->

                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform contact-form" onSubmit="return checkForm(this);">
                    <?php if ( !$user_ID ){?>
                        <div class="form-input left">
                            <div class="bg-input left"><input class="contact_input_text" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="author" id="contactname" value="<?php if($req) echo _e('Name (required)', tk_theme_name); ?>"/><div class="down-border-form left"></div><!--/down-border-form--></div>
                            <div class="bg-input left"><input class="contact_input_text" type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="email" id="contactemail" value="<?php if($req) echo _e('E-mail (required)', tk_theme_name); ?>"/><div class="down-border-form left"></div><!--/down-border-form--></div>
                        </div>
                    <?php }?>
                        <div class="form-textarea"><textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="comment" id="contactmessage" ><?php  _e('Message', tk_theme_name); ?></textarea><div class="down-border-form left"></div></div>
                        <div id="contact-error"></div>

                        <div class="search-submit-button left">
                            <div class="tag-left left"></div>
                            <input class="search-submit-button"  type="submit" name="submit-comment" value="<?php _e('Post Comment', tk_theme_name)?>" />
                            <div class="tag-right left"></div>
                        </div>

                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </form>

            </div>
    </div><!-- /blog-one -->
</div><!-- /blog-content -->
        <?php endif; ?>

    <?php else : ?>
            
<div class="comment-title left"><?php _e('Comments are closed', tk_theme_name)?></div>

<?php endif; ?>