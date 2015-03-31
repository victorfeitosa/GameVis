<?php get_header();
$prev_post = get_previous_post();
$next_post = get_next_post();

$format = get_post_format();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
$video_link = get_post_meta($post->ID, $prefix.'video_link', true);

$gallery_id = get_option('id_gallery_page');

?>

        <!-- CONTENT -->
        <div class="content front-page right">
            <div class="blog-wrap">
                <div class="blog-one">


                    
                    <div class="title-page nomargin left">
                        <h1><?php echo get_the_title($gallery_id); ?></h1>
                    </div><!--/title-page-->


                    
                    <div class="gallery-single left">
                    <?php if($format=='') { ?>
                     <div class="gallery-single-images left"><?php the_post_thumbnail('gallery-single'); ?></div><!--/gallery-single-images-->
                     <?php }elseif($format=='video') { ?>
                         <div class="gallery-single-images left"> <?php tk_video_player($video_link); ?></div><!--/gallery-single-images-->
                     <?php } else {
                           $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                      ?>



                  <div class="gallery-single-images left">
                       <div class="flexslider">
                        <ul class="slides">
                            <?php foreach($slide_images as $the_image) { ?>
                                <li>
                                    <img src="<?php tk_get_thumb(942, 357, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                </li>
                            <?php } ?>
                        </ul>
                    </div><!--/flexslider-->
                  </div><!--/gallery-single-images-->
               <?php } ?>



              <div class="gallery-single-title left"><?php the_title(); ?></div><!--/gallery-single-title-->
              <div class="gallery-single-text shortcodes left">
                  <?php
                      if ( have_posts() ) : while ( have_posts() ) : the_post();
                      the_content();
                  ?>
              </div><!--/gallery-single-text-->



            <!-- SHARE BUTTONS -->
            <?php $show_share = get_theme_option(tk_theme_name.('_general_show_shares'));?>
            <?php if($show_share) { ?>
              <div class="gallery-share left">
                  
                      <div class="gallery-facebook left">
                      <?php
                          if(substr(get_permalink(), -1) == '/') {
                                $thepermalink = substr(get_permalink(), 0, -1);
                            } else {
                                $thepermalink = get_permalink();
                            }
                        ?>
                           <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                                  <span>
                                    <?php
                                        echo get_likes($thepermalink);
                                      ?>
                                  </span>
                          </a>
                      </div><!--/gallery-facebook-->
                  </a>

                  <div class="gallery-twitter left">
                      <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>" class="twitter-share-button">
                          <span>
                              <?php
                                  echo get_tweets(get_permalink());
                               ?>
                          </span>
                      </a>
                      <span> <?php echo $share_num['count']; ?></span></div><!--/gallery-twitter-->
              </div><!--/gallery-share-->
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
                  <div class="gallery-single-next left">
                      <a href="<?php echo $next_post->guid; ?>">
                        <?php _e('Next Post', tk_theme_name); ?>
                      </a>

                      <p>
                          <a href="<?php echo $next_post->guid; ?>">
                              <?php echo $next_post->post_title; ?>
                          </a>
                      </p>
                      
                  </div><!--/gallery-single-next-->

                  <?php }
                      endwhile; endif;
                  ?>



              </div><!--/gallery-single-pagination-->
            </div><!--/gallery-single-->
                </div>
         </div><!-- blog-wrap -->        
        </div><!--/content-->
    </div><!--/wrapper-->



<?php get_footer(); ?>