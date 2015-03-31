<?php get_header();
$prefix = 'tk_';

    $c = 1;
     if ( have_posts() ) : while ( have_posts() ) : the_post();
    $format = get_post_format();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');

    $categories = get_the_category();
    $cat_count = count($categories);

    $undertitle = get_post_meta($post->ID, $prefix.'undertitle', true);
    $post_color = get_post_meta($post->ID, $prefix.'color', true);
    $headline_color = get_post_meta($post->ID, $prefix.'headline', true);
    $headline_hover_color = get_post_meta($post->ID, $prefix.'headline_hover', true);
    $undertitle_color = get_post_meta($post->ID, $prefix.'undertitle_color', true);
    $paragraph = get_post_meta($post->ID, $prefix.'paragraph', true);
    $readmore = get_post_meta($post->ID, $prefix.'readmore', true);
    $readmore_hover = get_post_meta($post->ID, $prefix.'readmore_hover', true);
?>




            <!-- POST COLORS -->
            <style type="text/css">
                body {
                    background-color:#<?php echo $post_color ?>;
                }

                .single-color<?php echo $c; ?> .blog-title a, .single-color<?php echo $c; ?> .single-title, .thecomments h2, .comment-start-title span {
                    color:#<?php echo $headline_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-title a:hover,  .gallery-single-prev p a:hover, .gallery-single-next p a:hover, .gallery-single-prev a, .gallery-single-next a {
                    color:#<?php echo $headline_hover_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-title p {
                    color:#<?php echo $undertitle_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-text p, .shortcodes ol li, .shortcodes ul li,  .gallery-single-prev p a, .gallery-single-next p a, .comment-start-title p, .comment-start-text p, .comment-start-title a {
                    color:#<?php echo $paragraph; ?>;
                }
                
                .single-color<?php echo $c; ?> .blog-read-more a, .more-link {
                    color:#<?php echo $readmore; ?>;
                }

                .single-color<?php echo $c; ?> .blog-read-more a:hover, .more-link:hover, .comment-start-title a:hover {
                    color:#<?php echo $readmore_hover; ?>;
                }
            </style>



        <!-- CONTENT -->
        <div class="content front-page  right">
        <div class="blog-wrap single-color<?php echo $c; ?> ">
            <!--Post Standard-->
            <div class="blog-one left">

                <?php if($format =='' || $format =='image') { ?>

                <?php if(has_post_thumbnail()) { ?>
                    <div class="blog-images left"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/></div><!--/blog-images-->
                <?php } ?>


                <?php } elseif($format =='video') {
                    $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                    if($video_link){
                    ?>
                    <div class="blog-video left"><?php echo tk_video_player($video_link); ?></div><!--/blog-video-->
                <?php } ?>


                 <!--AUDIOT POST TYPE -->
                <?php } elseif ($format =='audio') {  ?>
                            <div class="blog-player left">
                                <?php tk_jplayer($post->ID); ?>
                                            <div id="jquery_jplayer_<?php echo $post->ID?>" class="jp-jplayer"></div>
                                            <div id="jp_container_<?php echo $post->ID?>" class="jp-audio">
                                                <div class="jp-type-single">
                                                    <div class="jp-gui jp-interface" id="jp_interface_<?php echo $post->ID; ?>">
                                                <ul class="jp-controls">
                                                    <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                                    <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                                    <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                                    <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                                </ul>
                                                <div class="jp-progress">
                                                    <div class="jp-seek-bar">
                                                        <div class="jp-play-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="jp-volume-bar">
                                                    <div class="jp-volume-bar-value"></div>
                                                </div>
                                            </div><!--/jp-gui jp-interface-->
                                        </div><!--/jp-type-single-->
                                    </div><!--/jp-audio-->
                                </div><!--/blog-player-->



                          <!-- QUOTE POST TYPE -->
                          <?php } elseif($format == 'quote'){
                                $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
                                $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true);
                                if(!empty($quote_text)  || !empty($quote_author)) {
                            ?>

                         <div class="post-quote left">
                            <img src="<?php echo get_template_directory_uri(); ?>/style/img/post-quote.png" alt="quote icon" />
                            <span><?php echo $quote_text; ?></span>
                            <p><?php echo $quote_author; ?></p>
                        </div><!--/post-quote-->



                     <?php } ?>


                <!-- LINK POST TYPES -->
                <?php
                     } elseif($format == 'link'){
                        $link_text = get_post_meta($post->ID, $prefix.'link_text', true);
                        $link_url = get_post_meta($post->ID, $prefix.'link_url', true);
                ?>
                <div class="blog-link left">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-link-image.png" alt="link icon" />
                    <div class="post-link-top right"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></div><!--/post-link-top-->
                    <div class="post-link-down right"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></div><!--/post-link-down-->
                </div><!--/blog-link-->



                <!-- GALLERY POST TYPE -->
            <?php
                 } elseif($format == 'gallery') {
                $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
            ?>
                <div class="blog-gallery left">
                     <div class="flexslider">
                        <ul class="slides">
                            <?php foreach($slide_images as $the_image) { ?>
                                <li>
                                    <img src="<?php echo $the_image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                </li>
                            <?php } ?>
                        </ul>
                    </div><!--/flexslider-->
                </div><!--/blog-gallery-->
                <?php } ?>



               <?php  if($format !=='image'){ ?>
               <?php if($format !== 'aside') { ?>
                   <div class="blog-category left">
                        <ul>
                                 <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-1.png" alt="" /></li>
                                <?php
                                    $i = 1;
                                    foreach($categories as $cats) {
                                    $cat_link = get_category_link($cats->term_id);

                                    if($cat_count !== $i) {
                                        $comma =', ';
                                    } else {
                                        $comma = '';
                                    }
                                        ?>

                                    <li><a href="<?php echo $cat_link; ?>"><?php echo $cats->name; ?><?php echo $comma; ?></a></li>
                                <?php $i++; } ?>
                        </ul>

                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-2.png" alt="images" title="images"  /></li>
                            <li><span><?php the_time(); ?></span></li>
                        </ul>

                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-3.png" alt="images" title="images"  /></li>
                            <li><span><?php comments_number( __('No Comments'), __('One Comment'), __('% Comments') ); ?>.</span></li>
                        </ul>

                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-4.png" alt="images" title="images"  /></li>
                            <li><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></li>
                        </ul>

                    </div><!--/blog-category-->
                <?php } ?>


                <div class="blog-title left">
                    <h1 class="single-title"><?php the_title(); ?></h1>
                    <?php if($undertitle) { ?><p><?php echo $undertitle; ?></p><?php } ?>
                </div><!--/blog-title-->

                <div class="blog-text shortcodes left">
                     <?php the_content(); ?>
                </div><!--/blog-text-->

                <?php } ?>

            </div><!--/blog-one-->
        </div><!-- blog-wrap -->

        
        <div class="blog-one">


            <!-- SHARE BUTTONS -->
            <?php $show_share = get_theme_option(tk_theme_name.('_general_show_shares'));?>
            <?php if($show_share) { ?>
              <div class="gallery-share left">
                  <div class="gallery-facebook left">
                              <?php
                               $thepermalink = get_permalink();
                              ?>
                       <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                            <span>
                                <?php echo get_likes($thepermalink); ?>
                            </span>
                        </a>
                  </div><!--/gallery-facebook-->

                  <div class="gallery-twitter left">
                      <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>" class="twitter-share-button">
                        <span>
                            <?php echo get_tweets(get_permalink()); ?>
                        </span>
                    </a>                   
              </div><!--/gallery-share-->
              </div>
              <?php } ?>



            <div class="gallery-single-pagination left">
                  <?php
                    $prev_post = get_previous_post();
                    $next_post =  get_next_post();
                  ?>
                  <?php if(isset($prev_post->guid)) { ?>
                      <div class="gallery-single-prev left">
                          <a href="<?php echo $prev_post->guid; ?>">
                            <?php _e('Previous Post', tk_theme_name); ?>
                          </a>
                          <p>
                              <a href="<?php echo $prev_post->guid; ?>">
                                  <?php echo $prev_post->post_title; ?>
                              </a>
                          </p>
                      </div><!--/gallery-single-prev-->
                  <?php } ?>


                  <?php if(isset($next_post->guid)) { ?>
                      <div class="gallery-single-next right">
                          <a href="<?php echo $next_post->guid; ?>">
                            <?php _e('Next Post', tk_theme_name); ?>
                          </a>
                          <p>
                              <a href="<?php echo $next_post->guid; ?>">
                                  <?php echo $next_post->post_title; ?>
                              </a>
                          </p>
                      </div><!--/gallery-single-next-->
                  <?php }  ?>


            </div><!--/gallery-single-pagination-->
            <?php $c++;  endwhile; endif; ?>

            <!--COMMENTS-->
            <?php if ( comments_open() ) : ?>
                <?php comments_template(); // Get wp-comments.php template ?>
            <?php endif; ?>
          
        </div> <!-- blog-one -->
        </div><!--/content-->
    </div><!--/wrapper-->


<?php get_footer(); ?>