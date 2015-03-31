<?php get_header();
$prefix = 'tk_';
$author = get_userdata( $post->post_author );
$post_type = get_post_type();
$video_link = get_post_meta($post->ID, 'tk_video_link', true);
$attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
?>

<?php

if(empty($video_link) && $attachments[0] == '' && !has_post_thumbnail()){?>
    <style>
        #sidebar {
            margin: 25px 25px 0 0!important;
        }
        .silver-big-fake{margin-top: 25px;}
        .content-post{
            margin: 0;
            padding: 0;
        }
    </style>
<?php }?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113020565471594";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><!-- check -->


<?php if($video_link || $attachments[0] != ''|| has_post_thumbnail()){?>
    <!-- SLIDER CONTENT -->
    <div class="slider-content left">
        <div class="wrapper">
            <div class="single-slider-fix">
            <div class="bg-slider-post left">
                <div class="slider-post-content left">
            <?php

                if($video_link) {
                    tk_video_player($video_link);
                }else{
                if($attachments[0] != ''){
                ?>
                    <div class="flexslider">
                        <ul class="slides">
                            <?php foreach ($attachments as $image) {?>
                            <li>
                                <div class="slider-images left">
                                    <img src="<?php echo tk_get_thumb_new(570, 398, $image); ?>" alt="img" title="<?php echo $image->post_title?>" />
                                </div>
                            </li><?php }?>
                        </ul>
                    </div>
                <?php }
                    elseif(has_post_thumbnail()){
                        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-image');
                        ?>
                    <a href="<?php echo get_permalink($post->ID)?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" style="float:left;width: 100%"/></a>
                <?php }} ?>

                </div><!--/slider-post-content-->
            </div><!--/bg-slider-post-->
            </div>
        </div><!--/wrapper-->
    </div><!--/slider-content-->
    
<?php }?>
    
    <!-- CONTENT -->
    <div class="content-post left">
        <div class="wrapper">
            <div class="bg-content left">

                <div class="content-left left">

                    <div class="post-text-content left">
                        <div class="post-title left"><?php the_title()?></div><!--/post-title-->
                        <div class="post-date left">
                            <span><?php echo get_the_date()?> / <?php echo get_the_category_list( ' / ', $post->ID ); ?></span>
                            <span><?php comments_number( '0', '1', '%' ); ?> <?php _e('COMMENTS', tk_theme_name) ?></span>
                            <span></span>
                        </div><!--/post-date-->
                        <div class="post-text left">
                        <div class="shortcodes left">
                            <?php
                                wp_reset_query();
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                        the_content();
                                    endwhile;
                                else:
                                endif;
                                wp_reset_query();
                                ?>
                        </div><!--/post-single-text-->
                        </div><!--/post-text-->
                    </div><!--/post-text-content-->

                    <div class="post-share left">
                        <span><?php _e('Share this:', tk_theme_name) ?></span>
                        <div class="post-share-js left">

                            <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                                                <a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                            <g:plusone size="medium" annotation="inline" width="120"></g:plusone>

                            <script type="text/javascript">
                              (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                              })();
                            </script>
                            <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID)?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) )?>" class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>

                        </div><!--/post-share-js-->
                    </div><!--/post-share-->

                    <div class="post-autor left">
                        <div class="title-home left"><?php _e('About the author', tk_theme_name) ?></div><!--/title-home-->
                        <div class="bg-post-autor left">
                            <div class="post-autor-images left"><?php echo get_avatar(get_the_author_meta('ID'), '80', get_template_directory_uri().'/style/img/autor.jpg')?></div><!--/post-autor-images-->

                            <div class="post-autor-text-content right">
                                <div class="post-autor-title left"><a href="<?php echo home_url().'/author/'.$author->user_nicename?>"><?php echo get_the_author_meta('display_name')?></a></div><!--/post-autor-title-->

                                <div class="post-autor-touch left">
                                    <ul>
                                      <?php
                                        $author_twitter = get_user_meta($author->ID, 'twitter', true);
                                        $author_facebook = get_user_meta($author->ID, 'facebook', true);
                                        $author_google = get_user_meta($author->ID, 'google', true);
                                        $author_linkedin = get_user_meta($author->ID, 'linkedin', true);
                                        $author_authorrss = get_user_meta($author->ID, 'rss', true);
                                        if( $author_authorrss !== '' || $author_linkedin !== '' || $author_google !== '' || $author_facebook !== '' || $author_twitter !== ''  ){
                                        ?>
                                            <li><span><?php _e('Get in touch', tk_theme_name) ?></span></li>
                                                <?php if(!empty($author_twitter)){ ?><li><a href="http://twitter.com/<?php echo $author_twitter; ?>" class="autor-tuned-1 left"></a></li><?php } ?>
                                                <?php if(!empty($author_facebook)){ ?><li><a href="http://facebook.com/<?php echo $author_facebook; ?>" class="autor-tuned-2 left"></a></li><?php } ?>
                                                <?php if(!empty($author_google)){ ?><li><a href="https://plus.google.com/<?php echo $author_google; ?>" class="autor-tuned-4 left"></a></li><?php } ?>
                                                <?php if(!empty($author_linkedin)){ ?><li><a href="<?php echo $author_linkedin; ?>" class="autor-tuned-3 left"></a></li><?php } ?>
                                                <?php if(!empty($author_authorrss)){ ?><li><a href="<?php echo $author_authorrss; ?>" class="autor-tuned-5 left"></a></li><?php } ?>
                                        <?php }?>
                                    </ul>
                                </div><!--/stay-tuned-->

                                <div class="post-autor-text left"><?php echo get_the_author_meta('description')?></div><!--/post-autor-text-->
                            </div><!--/post-autor-text-content-->

                            <div class="slider-more-info left">
                                <div class="silver-bg-more-info right">
                                    <a href="<?php echo home_url().'/author/'.$author->user_nicename?>">
                                        <div>
                                            <div class="button-left-16 left"></div>
                                            <div class="button-center-16 left"><?php _e('All articles', tk_theme_name) ?></div>
                                            <div class="button-right-16 left"></div>
                                        </div>
                                    </a>
                                </div><!--/silver-bg-more-info-->
                            </div><!--/slider-more-info-->

                        </div><!--/bg-post-autor-->
                    </div><!--/post-autor-->

                    <!--COMMENTS-->
                    <div class="comment-start left">

                        <?php if ( comments_open() ) : ?>

                            <?php comments_template(); // Get wp-comments.php template ?>

                        <?php endif; ?>

                    </div><!--/comment-start-->


                </div><!--/content-left-->

                <!--SIDBAR-->

                <?php tk_get_right_sidebar('Right', 'Category Template')?>

                <div class="silver-big-fake right"></div><!--/silver-big-fake-->

            </div><!--/bg-content-->

            <div class="help-content-down left"><div class="silver-big-fake right"></div></div><!--/help-content-down-->

        </div><!--/wrapper-->
    </div><!--/content-post-->

<?php get_footer(); ?>