<?php
/************************************************************/
/*                                                          */
/*   Use Bootstrap's media object for listing comments      */
/*                                                          */
/************************************************************/
class tk_Walker_Comment extends Walker_Comment {

    /************************************************************/
    /*                                                          */
    /*   Function for comment list start                        */
    /*                                                          */
    /************************************************************/
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>
        <ul <?php comment_class('media-list comment-child-'.$depth.' comment-' . get_comment_ID()); ?>>
        <?php
    } // close function end_lvl

    /************************************************************/
    /*                                                          */
    /*   Closing comment list                                   */
    /*                                                          */
    /************************************************************/
    function end_lvl(&$output, $depth = 0,  $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        echo '</ul>'; // this ul closes ul opened in start_lvl function
    } // close function end_lvl

    /************************************************************/
    /*                                                          */
    /*  Function for displaying comments                        */
    /*  Visual changes should be done here                      */
    /*                                                          */
    /************************************************************/
    function start_el(&$output, $comment, $depth = 0, $title='', $args = array(), $id = 0) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        if (!empty($args['callback'])) {
            call_user_func($args['callback'], $comment, $args, $depth);
            return;
        } // end if

        extract($args, EXTR_SKIP); ?>
        <?php if ($comment->comment_approved == '0') : ?>
            <div class="alert">
                <?php _e('Your comment is awaiting moderation.', 'tkingdom'); ?>
            </div> <!-- .alert -->
        <?php endif; ?>
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media row-fluid comment-' . get_comment_ID()); ?>>
            <?php echo get_avatar($comment, $size = '46'); ?>
            <div class="span11 media-body">

                <h5 class="media-heading"><?php echo get_comment_author_link(); ?></h5>
                <ul class="inline meta muted pull-right">
                    <li><time datetime="<?php echo comment_date('c'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s', 'tkingdom'), get_comment_date(),  get_comment_time()); ?></a></time></li>
                    <li><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => '4'))); ?></li>
                    <li><?php edit_comment_link(__('(Edit)', 'tkingdom'), '', ''); ?></li>
                </ul>
                <?php comment_text(); ?>
            </div>
            <div class="comment-border"></div>

    <?php
    } // function start_el

    function end_el(&$output, $comment, $depth = 0, $title= '', $args = array(), $id = 0) {
        if (!empty($args['end-callback'])) {
            call_user_func($args['end-callback'], $comment, $args, $depth);
            return;
        } // end if
        echo "</li>\n"; // closing .media-body div and li started in start_el function
    } // function end_el
} // close class

    /************************************************************/
    /*                                                          */
    /*   Adding some classes to get_avatar function             */
    /*                                                          */
    /************************************************************/
    function tk_get_avatar($avatar) {
        $avatar = str_replace("class='avatar", "class='avatar pull-left media-object", $avatar);
        return $avatar;
    }
    add_filter('get_avatar', 'tk_get_avatar');

    /************************************************************/
    /*                                                          */
    /*   Bump if !                                              */
    /*                                                          */
    /************************************************************/
    if (post_password_required()) {
        return;
    }

    /************************************************************/
    /*                                                          */
    /*  Call Class to show comments, displays, title,           */
    /*  comment count and paging of comments                    */
    /*                                                          */
    /************************************************************/
    if (have_comments()) : ?>
        <section id="comments">
            <h3><?php printf(_n('One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'tkingdom'), number_format_i18n(get_comments_number()), get_the_title()); ?></h3>

            <ol class="media-list">
                <?php wp_list_comments(array('walker' => new tk_Walker_Comment)); ?>
            </ol>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                <nav>
                    <ul class="pager">
                        <?php if (get_previous_comments_link()) : ?>
                            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'tkingdom')); ?></li>
                        <?php endif; ?>
                        <?php if (get_next_comments_link()) : ?>
                            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'tkingdom')); ?></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>

            <?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
                <div class="alert">
                    <?php _e('Comments are closed.', 'tkingdom'); ?>
                </div>
            <?php endif; ?>
        </section><!-- /#comments -->
    <?php endif; ?>

    <?php
    /************************************************************/
    /*                                                          */
    /*   If comments are closed inform about this               */
    /*                                                          */
    /************************************************************/
    if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
        <section id="comments">
            <div class="alert">
                <?php _e('Comments are closed.', 'tkingdom'); ?>
            </div>
        </section><!-- /#comments -->
    <?php endif; ?>

    <?php
    /************************************************************/
    /*                                                          */
    /*   If comments are open use this form                     */
    /*   You can change look of the form                        */
    /*                                                          */
    /************************************************************/
    if (comments_open()) : ?>
        <section id="respond">
            <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'tkingdom'), wp_login_url(get_permalink())); ?></p>
            <?php else : ?>
                <div class="comment-form">
                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform"  class="contact-form" onSubmit="return checkForm(this);">
                        <?php if (is_user_logged_in()) : ?>
                            <p>
                                <?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'tkingdom'), get_option('siteurl'), $user_identity); ?>
                                <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'tkingdom'); ?>"><?php _e('Log out &raquo;', 'tkingdom'); ?></a>
                            </p>
                        <?php else : ?>
                            <legend><?php _e('Leave a comment', 'tkingdom'); ?></legend>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="name-icon"></i></span>
                                    <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" class="text" name="author" id="contactname" size="22" <?php if ($req) echo 'aria-required="true"'; ?> value="<?php _e('Name', 'tkingdom')?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="email-icon"></i></span>
                                    <input type="email" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" class="text" name="email" id="contactemail" size="22" <?php if ($req) echo 'aria-required="true"'; ?>  value="<?php _e('Email', 'tkingdom')?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="control-group">
                            <div class="input-prepend texteria-holder">
                                <span class="add-on"><i class="message-icon"></i></span>
                                <textarea name="comment" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" id="contactmessage" class="input-xlarge" rows="5" aria-required="true"><?php _e('Message', 'tkingdom')?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button name="submit" class="btn" type="submit" id="submit" value="<?php _e('Submit Comment', 'tkingdom'); ?>"><?php _e('POST COMMENT', 'tkingdom')?></button>
                            </div>
                        </div>
                        <div id="contact-error"></div>

                        <?php comment_id_fields(); ?>            
                        <?php do_action('comment_form', $post->ID); ?>
                    </form>
                </div>
            <?php endif; ?>
        </section><!-- /#respond -->
    <?php endif; ?>
