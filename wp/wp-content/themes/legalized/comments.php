<?php

function tk_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; 
?>

    <li <?php comment_class(); ?>>
        <div  id="comment-<?php echo comment_ID();?>"></div>
        <div class="gravatar"><?php echo get_avatar($comment,$size='35' ); ?><!-- <img src="images/gravatar-default.png" /> --></div>
        <h4 class="red"><?php echo $comment->comment_author ?></h4>
        <span class="comment_time"><?php echo comment_date( get_option( 'date_format' ).' '.get_option( 'time_format' ), $comment->comment_ID ); ?> <?php if ($comment->comment_approved == '0') : ?><?php _e('- Your comment is awaiting moderation.', tk_theme_name) ?><?php endif; ?> <?php edit_comment_link(__(' · Edit ', tk_theme_name),'  ','') ?> · <a class="reply" href="#"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a></span><br><br>
        <?php comment_text() ?>
    </li>

<?php } ?>
        
        <a id="comment" name="comment"></a>
        <div class="comments">

            <?php if (get_comments_number() == '0') {?>
                <h3><?php _e('No comments so far!', tk_theme_name);?></h3>
            <?php } else {?>
                <h3><?php _e('Comments', tk_theme_name)?> <span class="comment_count rounded"><?php comments_number( '0', '1', '0%' ); ?></span></h3>
            <?php }?>

            <ul>            
                <!-- COMMENTS LIST -->
                <?php wp_list_comments('type=comment&callback=tk_comments'); ?>
            </ul>

<?php if ( comments_open() ) : ?>

            <!-- TODO: check the HTML and CSS when user is not logged in -->
            <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                <div class="comment-title">
                    <?php _e('You must be', tk_theme_name)?> 
                    <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', tk_theme_name) ?></a> 
                    <?php _e('to post a comment.', tk_theme_name) ?>
                </div>
            <?php else : ?>

        </div><!-- /.comments -->

<!-- COMMENT FORM -->
        <a id="respond" name="respond"></a>

        <div class="row-fluid">
            <div class="span12">
                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-blog.png" alt="separator" />
            </div>
        </div>
        <div class="form" style="margin-top: 20px">

            <h3><?php if(isset($_GET['replytocom'])){ _e('Leave a Reply', tk_theme_name);}else{ _e('Leave a Comment', tk_theme_name);}?></h3>

            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="comment" onSubmit="return checkForm(this);">
                <?php if ( !$user_ID ){?>
                    <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="author" id="contactname" value="<?php if($req) echo _e('Name (required)', tk_theme_name); ?>"  placeholder="Name*" />
                    <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="email" id="contactemail" value="<?php if($req) echo _e('E-mail (required)', tk_theme_name); ?>" placeholder="Email*" />
                <?php } ?>
                    <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="comment" id="contactmessage" placeholder="Message*" rows="10"><?php  _e('Message', tk_theme_name); ?></textarea>
                    <div id="contact-error"></div>

                    <input class="btn form_btn"  type="submit" name="submit-comment" value="<?php _e('Send a Message', tk_theme_name)?>" />

                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID); ?>
            </form>
            
        </div>

        <?php endif; ?>

<?php else : ?>
            
    <div class="comment-title left"><?php _e('Comments are closed', tk_theme_name)?></div>

<?php endif; ?>