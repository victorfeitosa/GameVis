<?php get_header();
$prefix = 'tk_';
$author = get_userdata( $post->post_author );
$post_type = get_post_type();
$video_link = get_post_meta($post->ID, 'tk_video_link', true);
$slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=113020565471594";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><!-- check -->


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">


            <div class="bg-content left">
                <div class="bg-content-center">
                    
                        
                    <div class="content-pages-left">

                        <div class="blog-one left">
                            <div class="blog-date-user-comment left">
                                <div class="blog-date left"><?php echo get_the_date()?></div><!--/blog-date-->
                                <div class="blog-user left"><a href="<?php echo get_author_posts_url( $author -> ID ); ?>"><?php echo $author->display_name?></a></div><!--/blog-user-->
                                <div class="blog-comment left"><?php comments_number( '0', '1', '%' ); ?> <?php _e('comments', tk_theme_name) ?></div><!--/blog-comment-->
                            </div><!--/blog-date-user-comment-->                            
                            <div class="blog-title left"><?php the_title()?></div><!--/blog-title-->
                             <?php
                                    $images = '';
                                    if(!empty($slide_images)){
                                        foreach($slide_images as $slide) {

                                        if($slide != ''){
                                        $images .= '<li><a href='.get_permalink().'><img src="'.tk_get_thumb_new(625, 360, $slide).'"/></a></li>';
                                        }
                                    }
                            }?>

                            <?php if($video_link || has_post_thumbnail() || $images != ''){?>
                            <div class="blog-images left">
                                
                                <div class="blog-images-content left">

                                    <?php

                                    if($video_link) { ?>
                                            <?php tk_video_player($video_link);?>
                                                 <?php } elseif(!empty($images)) { ?>

                                                    <?php if($images != ''){?>
                                                            <div class="flexslider">
                                                                <ul class="slides">
                                                                    <?php echo $images;?>
                                                                </ul>
                                                            </div><!-- flex slider -->
                                                     <?php
                                                }
                                             }
                                            elseif (has_post_thumbnail()) { ?>
                                                 <?php
                                                 tk_thumbnail($post->ID, 'blog'); ?>
                                                <a href="<?php the_permalink(); ?>"><span></span></a>
                                    <?php } ?>
                                    
                                </div><!--/blog-images-content-->
                                <div class="border-down-blog"></div><!--/border-down-blog-->
                            </div><!--/blog-images-->                            
                            <?php } ?>     

                            <div class="blog-text left">
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
                            </div><!--/blog-text-->

                        </div><!--/blog-one-->
                        

                    <div class="share-this left">
                        <span><?php _e('Share this:', tk_theme_name) ?></span>

                            <div class="share-this-content left">
                                <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                            </div>
                            
                            <div class="share-this-content left">
                                <a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                                
                            <div class="share-this-content left">
                                <g:plusone size="medium" annotation="inline" width="120"></g:plusone>
                            </div>
                        
                            <script type="text/javascript">
                              (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                              })();
                            </script>
                            
                            <div class="share-this-content left">
                                <a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink($post->ID)?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) )?>" class="pin-it-button" count-layout="vertical"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                            </div>
                    </div><!--/post-share-->
                        
                      <!--COMMENTS-->
                    <div class="comment-start left">

                        <?php if ( comments_open() ) : ?>

                            <?php comments_template(); // Get wp-comments.php template ?>

                        <?php endif; ?>

                    </div><!--/comment-start-->
                        
                        
                    </div><!--/content-pages-left-->
                    
                    
                    <div class="border-content-right left"></div><!--/border-content-right-->
                    
                    

                <!--SIDBAR-->

                <?php tk_get_right_sidebar('Right', 'Blog Template')?>
                    
                    
                    
                </div><!--/bg-content-center-->
            </div><!--/bg-content-->
            
            
            <div class="border-down-content left"></div><!--/border-down-content-->


        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>