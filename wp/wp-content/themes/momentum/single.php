<?php get_header();
$prefix = 'tk_';
$author = get_userdata( $post->post_author );
$post_type = get_post_type();
$video_link = get_post_meta($post->ID, 'tk_video_link', true);

$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if(empty($sidebar_position)) { $sidebar_position = 'Right'; }

$attachments  = get_post_meta($post->ID, $prefix.'repeatable', true);
$blog_name = get_option('title_blog_page');
?>

<!-- CONTENT -->
    <div class="content-two left">
        <div class="wrapper">

            <div class="bg-content left">

                <div class="title-page left">
                    <div class="title-breadcrambs left">
                        <span><?php if($post_type == 'pt_slides'){_e('Featured', tk_theme_name);}else{echo $blog_name;}?></span>
                                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

                    </div>

                    <div class="blog-singe-nav right">
                        <?php
                        $next_post = get_next_post();
                        $prev_post = get_previous_post();

                        $image1 = get_post_meta($post->ID, 'tk_image_3');
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large');

                        ?>
                        <a class="blog-singe-nav-prev" <?php if(!empty($prev_post)){?>href="<?php echo $prev_post->guid; ?>"<?php }else echo 'href="#" style="background-color:#cecece"'?>><?php _e('Prev', tk_theme_name); ?></a>
                        <a class="blog-singe-nav-next" <?php if(!empty($next_post)){?>href="<?php echo $next_post->guid; ?>"<?php }else echo 'href="#" style="background-color:#cecece"'?>><?php _e('Next', tk_theme_name); ?></a>

                    </div><!--/blog-singe-nav-->
                </div><!--/title-page-->

                    <div class="content-left left">

                        <div class="blog-one left no-border">

                        <?php if($video_link) {?>
                          <div class="blog-one-images left">
                                <?php tk_video_player($video_link);?>
                          </div>
                    <?php }  elseif (has_post_thumbnail()) {?>

                                    <div class="blog-one-images left">
                                        <?php tk_thumbnail($post->ID, 'blog');?>
                                    </div><!--/blog-one-images-->

                        <?php  } elseif(!empty ($attachments[0])){?>

                        <div class="blog-one-slider">
                            <div class="flexslider">
                                <ul class="slides">
                                    <?php
                                       foreach($attachments as $attach) {
                                       echo '<li><img src="'.$attach.'" alt="img" title="',$image->post_title.'"/></li>';
                                       }
                                    ?>
                                </ul>
                            </div><!-- flex slider -->
                        </div>

                    <?php }  ?>

                            <div class="blog-one-text-date-content left">
                                <div class="blog-one-date left">
                                        <?php if($video_link) { ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-images-video.png" />
                                        <?php } else { if(!empty($attachments)) {   ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-images-date.png" />
                                        <?php } elseif (has_post_thumbnail()) { ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-images-date.png" />
                                        <?php } else { ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-images-none.png" />
                                        <?php } } ?>
                                    <span><?php the_time('d'); ?></span>
                                    <p><?php the_time('M').'&nbsp;'.the_time('y'); ?></p>
                                </div><!--/blog-one-date-->

                                <div class="blog-one-text-content right">
                                    <div class="blog-one-title left"><?php the_title(); ?></div><!--/blog-one-title-->
                                    <div class="blog-one-text shortcodes left">
                                  <?php
                                        wp_reset_query();
                                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                                                the_content();
                                            endwhile;
                                        else:
                                        endif;
                                        wp_reset_query();
                                    ?>
                                    </div><!--/blog-one-text-->
                                    <div class="blog-one-comment-category left">
                                        <div>

                                            <?php
                                            $allcats = get_the_category();
                                            $count = count($allcats);

                                            $i=1;
                                            foreach($allcats as $eachcat) {

                                                if($i!==$count) {
                                                    $separator = '<p>-</p>';
                                                } else {
                                                    $separator='';
                                                }
                                                $catlink = get_category_link($eachcat->cat_ID);
                                                echo '<a href="'.$catlink.'">'.$eachcat ->cat_name.'</a>'.$separator.'';

                                                $i++;
                                            }

                                            ?>

                                        </div>
                                    </div><!--/blog-one-comment-category-->
                                </div><!--/blog-one-text-content-->
                            </div><!--/blog-one-text-date-content-->


                     </div><!--/blog-one-images-->

                            <!--COMMENTS-->

                                    <?php if ( comments_open() ) : ?>

                                        <?php comments_template(); // Get wp-comments.php template ?>

                                    <?php endif; ?>


                     </div><!--/blog-one-->
                    <?php tk_get_right_sidebar('Right', 'Blog Template'); ?>
                   
                </div><!--/content-left-->
  
                    <div class="silver-big-fake right"></div><!--/silver-big-fake-->
            <div class="content-border left"></div><!--/content-border-->

            </div><!--/bg-content-->


    </div><!--/content-two-->



<?php get_footer(); ?>