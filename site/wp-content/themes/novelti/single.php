<?php
get_header();
$prefix = 'tk_';
$rating_position = get_post_meta($post->ID, $prefix . 'rating_position', true);
$post_category = wp_get_post_categories($post->ID);
$category_color = get_option('category_' . $post_category[0]);
$selected_category = get_the_category_by_ID($post_category[0]);
?>

<!-- CONTENT -->
<div class="content left">
    <div class="wrapper">
        <div class="content-full left">

            <div class="content-left left">

                <?php
                //The Loop
                if (have_posts()) : while (have_posts()) : the_post();
                        $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                        $the_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        $category_list = get_the_category();
                        $category_count = count($category_list);
                        $format = get_post_format();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                        setPostViews(get_the_ID());
                        
                        ?>

                        <div class="single-top-title left">
                            <div class="design-home-title-top left" style="border-right: 10px solid #<?php echo $category_color['color'] ?>;">
                                <span class="title-1"><?php echo $selected_category ?></span>
                                <div class="category-keys-nav right"></div>
                            </div><!--/design-home-title-top-->

                            <div class="nav-arrows right">
                                <div class="nav-arrows-prev left"><a href="<?php
                if (!empty($next_post)) {
                    echo get_permalink($next_post->ID);
                } else {
                    echo '';
                }
                        ?>" <?php
                                                             if ($next_post == '') {
                                                                 echo 'style="opacity: 1;filter: alpha(opacity= 100);"';
                                                             }
                        ?>></a>
                                </div><!--/nav-arrows-prev-->
                                <div class="nav-arrows-next right"><a href="<?php
                                                             if (!empty($prev_post)) {
                                                                 echo get_permalink($prev_post->ID);
                                                             } else {
                                                                 echo '';
                                                             }
                        ?>" <?php
                                                              if ($prev_post == '') {
                                                                  echo 'style="opacity: 1;filter: alpha(opacity= 100);"';
                                                              }
                        ?>></a>
                                </div><!--/nav-arrows-next-->
                            </div><!--/nav-arrows-->

                        </div><!--/single-top-title-->

                        <div class="single-content left">
                            <div class="design-home-images-one left">
                                <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                                    <div id="work-slider" class="work-slider"></div>
                                    <div class="design-home-images-one-img left single-page">
                                        <?php if ($format == 'image' || $format == '') { ?>
                                            <?php if (has_post_thumbnail()) { ?>
                                                <?php the_post_thumbnail('full'); ?>
                                            <?php } ?>
                                        <?php } elseif ($format == 'video') {
                                            ?>
                                            <?php if ($video_link) { ?>
                                                <div class="blog-video left">
                                                    <?php tk_video_player($video_link); ?>
                                                </div><!--/blog-video-->
                                            <?php } ?>
                                        <?php } elseif ($format == 'gallery') {
                                            ?>
                                            <script type="text/javascript">
                                                jQuery(document).ready(function($) {
                                                    jQuery('.flexslider').flexslider({
                                                        pauseOnHover: true,
                                                        slideshow: true,
                                                        useCSS: false
                                                    });

                                                    jQuery('.flex-control-nav').attr('style', 'background-color: #<?php echo $category_color['color'] ?>');

                                                });
                                            </script>
                                            <div class="flexslider">
                                                <ul class="slides">
                                                    <?php foreach ($slide_images as $the_image) { ?>
                                                        <li>
                                                            <img src="<?php echo $the_image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div><!--/flexslider-->
                                        <?php } ?>    
                                    </div><!--/design-home-images-one-img-->
                                <?php } ?>
                                <div class="design-home-images-one-title left margin-top-20"><span><?php the_title() ?></span></div><!--/design-home-images-one-title-->                                
                                <div class="design-home-images-one-category left" style="background: #<?php echo $category_color['color'] ?>;">
                                    <ul>
                                        <li><p><?php echo get_the_date() ?></p></li>
                                        <li><p>/</p></li>
                                        <li><p><?php _e('By:', tk_theme_name) ?></p><?php the_author_posts_link(); ?></li>
                                        <li><p>/</p></li>
                                        <li><a href="<?php the_permalink() ?>"><?php comments_number('0', '1', '%'); ?><?php _e(' Comments', tk_theme_name) ?></a></li>
                                        <li><p>/</p></li>
                                        <li><?php echo get_the_category_list(', ', $post->ID); ?></li>
                                    </ul>
                                </div><!--/design-home-images-one-category-->
                                <div class="design-home-images-one-text left">
                                    <?php
                                    /*
                                     * RATING SYSTEM
                                     */
                                    $check_rating = get_post_meta($post->ID, $prefix . 'enable_rating', true);
                                    $check_user_rating = get_post_meta($post->ID, $prefix . 'reader_rating', true);
                                    if ($check_rating == 'on' && $rating_position == 'Top Left' || $rating_position == 'Top Right') {
                                        $rating_type = get_post_meta($post->ID, $prefix . 'rating_type', true);
                                        $post_rating = get_post_meta($post->ID, $prefix . 'post_rating', true);
                                        $total_label = get_post_meta($post->ID, $prefix . 'rating_total', true);
                                        $post_rating_criteria = get_post_meta($post->ID, 'criteria-' . $prefix . 'post_rating', true);
                                        $post_rating_rate = get_post_meta($post->ID, 'rating-' . $prefix . 'post_rating', true);
                                        $i = 0;
                                        $overal_rating = 0;
                                        ?>
                                        <div class="single-rating-content" <?php
                                            if ($rating_position == 'Top Left') {
                                                echo 'style="float: left; margin-right:30px;"';
                                            } elseif ($rating_position == 'Top Right') {
                                                echo 'style="float: right; margin-left:30px;"';
                                            }
                                        ?>>
                                                 <?php foreach ($post_rating as $one_criteria) { ?>
                                                <div class="single-rating-one left">
                                                    <p><?php echo $post_rating_criteria[$i] ?></p>

                                                    <span class="right">
                                                        <span class="star-rating-background">
                                                            <span class="star-rating-mask" style="width:<?php echo $post_rating_rate[$i] ?>%;"></span>
                                                        </span>
                                                    </span>

                                                    <div class="stars-rater right">
                                                        <?php
                                                        if ($rating_type == 'Stars') {
                                                            tk_rating(20, 4, 'no', $post_rating_rate[$i], sanitize_title($post_rating_criteria[$i]));
                                                        } else {
                                                            echo '<span>' . $post_rating_rate[$i] . '</span>';
                                                        }
                                                        ?>
                                                    </div><!--/stars-rater-->
                                                </div><!--/single-rating-one-->  
                                                <?php
                                                $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                $i++;
                                            }
                                            ?>


                                            <div class="single-rating-one-score left">
                                                <div class="single-rating-one-score-text left">
                                                    <p><?php echo $total_label ?></p>
                                                </div><!--/single-rating-one-score-text-->
                                                <div class="single-rating-one-score-num right" style="background: #<?php echo $category_color['color'] ?>;">
                                                    <span><?php echo round($overal_rating / $i, 1); ?></span>
                                                </div><!--/single-rating-one-score-num-->
                                            </div><!--/single-rating-one-score-->

                                            <?php
                                            if ($check_user_rating == 'on') {
                                                global $wpdb;
                                                $userip = $_SERVER['REMOTE_ADDR'];
                                                $tablename = $wpdb->prefix . "user_rating";
                                                $queryrate = $wpdb->get_row("SELECT AVG(userrate) as average, COUNT(*) as cnt FROM $tablename WHERE postid = '$id'");
                                                $queryip = $wpdb->get_row("SELECT * FROM $tablename WHERE postid = '$id' AND userip = '$userip'");
                                                $round = round($queryrate->average, 0);
                                                $vote_count = $queryrate->cnt;
                                                ?>
                                                <div class="single-rating-one left">
                                                    <p class="single-user-rate"><?php _e('User Rating: ', tk_theme_name); ?><?php echo $round ?> (<?php echo $vote_count ?><?php _e(' votes)', tk_theme_name); ?></p>
                                                    <input type="hidden" class="old_rate" total="<?php echo $round ?>" ratenumber="<?php echo $vote_count ?>" />
                                                    <div class="stars-rater right">
                                                        <?php
                                                        if ($queryip != null) {
                                                            tk_rating(20, 4, 'no', $round, 'custom-user-rating');
                                                        } else {
                                                            tk_rating(20, 4, 'yes', $round, 'custom-user-rating');
                                                        }
                                                        ?>
                                                    </div><!--/stars-rater-->
                                                </div><!--/single-rating-one-->

                                            <?php } ?>

                                        </div><!--/single-rating-content-->

                                    <?php } elseif($check_user_rating == 'on') { ?>
                                        <div class="single-rating-content" <?php
                                            if ($rating_position == 'Top Left') {
                                                echo 'style="float: left; margin-right:30px;"';
                                            } elseif ($rating_position == 'Top Right') {
                                                echo 'style="float: right; margin-left:30px;"';
                                            }
                                        ?>>

                                            <?php
                                            if ($check_user_rating == 'on') {
                                                global $wpdb;
                                                $userip = $_SERVER['REMOTE_ADDR'];
                                                $tablename = $wpdb->prefix . "user_rating";
                                                $queryrate = $wpdb->get_row("SELECT AVG(userrate) as average, COUNT(*) as cnt FROM $tablename WHERE postid = '$id'");
                                                $queryip = $wpdb->get_row("SELECT * FROM $tablename WHERE postid = '$id' AND userip = '$userip'");
                                                $round = round($queryrate->average, 0);
                                                $vote_count = $queryrate->cnt;
                                                ?>
                                                <div class="single-rating-one left">
                                                    <p class="single-user-rate"><?php _e('User Rating: ', tk_theme_name); ?><?php echo $round ?> (<?php echo $vote_count ?><?php _e(' votes)', tk_theme_name); ?></p>
                                                    <input type="hidden" class="old_rate" total="<?php echo $round ?>" ratenumber="<?php echo $vote_count ?>" />
                                                    <div class="stars-rater right">
                                                        <?php
                                                        if ($queryip != null) {
                                                            tk_rating(20, 4, 'no', $round, 'custom-user-rating');
                                                        } else {
                                                            tk_rating(20, 4, 'yes', $round, 'custom-user-rating');
                                                        }
                                                        ?>
                                                    </div><!--/stars-rater-->
                                                </div><!--/single-rating-one-->

                                            <?php } ?>

                                        </div><!--/single-rating-content-->

                                    <?php } ?>

                                    <div class="shortcodes">      
                                        <?php
                                        // PAGE CONTENT
                                        the_content();
                                        ?>
                                    </div>

                                </div><!--/design-home-images-one-text-->

                            </div><!--/design-home-images-one-->

                            <?php
                            $facebook_share = get_theme_option(tk_theme_name . '_general_use_facebook');
                            $twitter_share = get_theme_option(tk_theme_name . '_general_use_twitter');
                            $google_share = get_theme_option(tk_theme_name . '_general_use_google');
                            $linkedin_share = get_theme_option(tk_theme_name . '_general_use_linkedin');
                            $pinterest_share = get_theme_option(tk_theme_name . '_general_use_pinterest');
                            $stumbleupon_share = get_theme_option(tk_theme_name . '_general_use_stumbleupon');
                            if ($facebook_share != 'yes' || $twitter_share != 'yes' || $google_share != 'yes' || $linkedin_share != 'yes' || $pinterest_share != 'yes' || $stumbleupon_share != 'yes') {
                                ?>
                                <div class="single-soc-share left">
                                    <?php
                                    if (substr(get_permalink(), -1) == '/') {
                                        $thepermalink = substr(get_permalink(), 0, -1);
                                    } else {
                                        $thepermalink = get_permalink();
                                    }
                                    $total_score = 0;
                                    if ($facebook_share != 'yes') {
                                        $total_score = $total_score + get_likes($thepermalink);
                                    }
                                    if ($twitter_share != 'yes') {
                                        $total_score = $total_score + get_tweets($thepermalink);
                                    }
                                    if ($google_share != 'yes') {
                                        $total_score = $total_score + get_plusones($thepermalink);
                                    }
                                    if ($linkedin_share != 'yes') {
                                        $total_score = $total_score + get_linkedin($thepermalink);
                                    }
                                    if ($pinterest_share != 'yes') {
                                        $total_score = $total_score + get_pinit($thepermalink);
                                    }
                                    if ($stumbleupon_share != 'yes') {
                                        $total_score = $total_score + get_stumbleupon($thepermalink);
                                    }
                                    ?>

                                    <div class="single-soc-share-text left">
                                        <span><?php echo $total_score ?></span>
                                        <p><?php _e('Shares', tk_theme_name) ?></p>
                                    </div><!--/single-soc-share-text-->
                                    <div class="single-soc-share-link left">

                                        <?php if ($facebook_share != 'yes') { ?>
                                            <div class="single-soc-share-link-fb left">
                                                <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                                                    <span>
                                                        <?php echo get_likes($thepermalink); ?>
                                                    </span>
                                                    <p><?php _e('Facebook', tk_theme_name) ?></p>
                                                </a>
                                            </div><!--/single-soc-share-link-fb-->
                                        <?php } ?>       

                                        <?php if ($twitter_share != 'yes') { ?> 
                                            <div class="single-soc-share-link-twitter left">
                                                <a target="_blank" href="https://twitter.com/share?url=<?php echo $thepermalink; ?>&text=<?php the_title(); ?>">
                                                    <span>
                                                        <?php echo get_tweets(get_permalink()); ?>
                                                    </span>
                                                    <p><?php _e('Twitter', tk_theme_name) ?></p>
                                                </a>       
                                            </div><!--/single-soc-share-link-twitter-->
                                        <?php } ?>

                                        <?php if ($google_share != 'yes') { ?> 
                                            <div class="single-soc-share-link-google left">
                                                <a target="_blank" href="https://plus.google.com/share?url=<?php echo $thepermalink; ?>&t=<?php the_title(); ?>">
                                                    <span>
                                                        <?php echo get_plusones($thepermalink); ?>
                                                    </span>
                                                    <p><?php _e('Google+', tk_theme_name) ?></p>
                                                </a>
                                            </div><!--/single-soc-share-link-google-->
                                        <?php } ?>

                                        <?php if ($linkedin_share != 'yes') { ?> 
                                            <div class="single-soc-share-link-linkedin left">
                                                <a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>">
                                                    <span>
                                                        <?php echo get_linkedin($thepermalink); ?>
                                                    </span>
                                                    <p><?php _e('LinkedIn', tk_theme_name) ?></p>
                                                </a>
                                            </div><!--/single-soc-share-link-linkedin-->
                                        <?php } ?> 

                                        <?php if ($pinterest_share != 'yes') { ?> 
                                            <div class="single-soc-share-link-pinterest left">
                                                <?php $pin_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                                <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $thepermalink; ?>&media=<?php echo $pin_image[0]; ?>&description=<?php the_title(); ?>">
                                                    <span>
                                                        <?php echo get_pinit($thepermalink); ?>
                                                    </span>
                                                    <p><?php _e('Pinterest', tk_theme_name) ?></p>
                                                </a>
                                            </div><!--/single-soc-share-link-pinterest-->
                                        <?php } ?>    

                                        <?php if ($stumbleupon_share != 'yes') { ?> 
                                            <div class="single-soc-share-link-stumbleupon left">
                                                <a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo $thepermalink; ?>&title=<?php the_title(); ?>">
                                                    <span>
                                                        <?php echo get_stumbleupon($thepermalink); ?>
                                                    </span>
                                                    <p><?php _e('Stumbleupon', tk_theme_name) ?></p>
                                                </a>
                                            </div><!--/single-soc-share-link-stumbleupon-->
                                        <?php } ?>    

                                    </div><!--/single-soc-share-link-->
                                </div><!--/single-soc-share-->
                            <?php } ?>

                            <?php if (has_tag()) { ?>
                                <!-- TAGS -->
                                <div class="single-tag" style="display:inline-block;">
                                    <?php the_tags('<span class="tags"  style="background-color: #' . $category_color['color'] . '">Tags: </span>', '', ''); ?>
                                </div>
                            <?php } ?>

                            <?php
                            /*
                             * Author Bio
                             */


                            $disable_author = get_theme_option(tk_theme_name . '_general_disable_author');
                            if ($disable_author != 'yes') {
                                ?> 
                                <div class="single-autor left">
                                    <?php echo get_avatar(get_the_author_meta('ID'), '81') ?>
                                    <span><?php the_author_posts_link(); ?></span>
                                    <p><?php echo get_the_author_meta('description') ?></p>
                                </div><!--/single-autor-->
                            <?php } ?>

                            <?php
                        endwhile;
                    endif;
                    ?>

                    <?php
                            /*
                             * RELATED POSTS
                             */
                    
                    
                    $disable_related = get_theme_option(tk_theme_name . '_general_disable_related');
                    if ($disable_related != 'yes') {
                        ?>   
                        <?php
                        wp_reset_postdata();
                        $related_option = get_theme_option(tk_theme_name . '_general_chose_related');
                        if ($related_option) {
                            
                        } else {
                            $related_option = 'cat';
                        }
                        if ($related_option == 'tag') {
                            $post_tags = wp_get_post_tags($post->ID);
                            $tag_array = array();
                            foreach ($post_tags as $one_tag) {
                                $tag_array[] = $one_tag->term_id;
                            }
                            $query = array(
                                'post_type' => 'post',
                                'tag__in' => $tag_array,
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => 4,
                                'ignore_sticky_posts' => 1
                            );
                        } elseif ($related_option == 'cat') {
                            $post_cats = wp_get_post_categories($post->ID);
                            $cat_array = '';
                            foreach ($post_cats as $one_cat) {
                                $cat_array .= $one_cat;
                            }
                            $query = array(
                                'post_type' => 'post',
                                'cat' => $cat_array,
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => 4,
                                'ignore_sticky_posts' => 1
                            );
                        }
                        $the_query = new WP_Query($query);
                        ?>
                        <div class="single-posts-content left">
                            <?php if ($the_query->found_posts != 0) { ?>
                                <div class="design-home-title-top left" style="border-right: 10px solid #<?php echo $category_color['color'] ?>;"><?php _e('Related Posts', tk_theme_name) ?></div><!--/design-home-title-top-->
                            <?php } ?>
                            <div class="single-posts-content-posts left">
                                <?php
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                    $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                    ?>
                                    <div class="single-posts-one left">
                                        <a href="<?php the_permalink() ?>">
                                            <?php if ($video_link != '' || count($slide_images) > 1 || has_post_thumbnail()) { ?>
                                                <div class="single-posts-one-images left related-image">
                                                    <?php if (has_post_thumbnail()) { ?>
                                                        <?php the_post_thumbnail('related-posts'); ?>
                                                    <?php } elseif ($video_link) { ?>
                                                        <?php get_video_image($video_link, $post->ID); ?>
                                                    <?php } elseif (count($slide_images) > 1) { ?>
                                                        <img src="<?php tk_get_thumb(195, 103, $slide_images[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                    <?php } ?>
                                                    <div class="design-home-images-one-img-hover"><p></p></div>
                                                </div>
                                            <?php }else{ ?>
                                                <img src="<?php echo get_template_directory_uri() ?>/style/img/no_195.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  style="margin-bottom:15px"/>
                                                <div class="design-home-images-one-img-hover related-image"><p></p></div>
                                            <?php } ?>
                                            <span><?php the_title() ?></span>
                                        </a>
                                    </div><!--/single-posts-one-->
                                    <?php
                                endwhile;
                                // Reset Post Data
                                wp_reset_postdata();
                                ?>   
                            </div>
                        </div><!--/single-posts-content-->
                    <?php } ?>

                    <!--COMMENTS-->
                    
                    <?php if (comments_open()) : ?>
                        <?php comments_template(); // Get wp-comments.php template   ?>
                    <?php endif; ?>

                </div><!--/single-content-->

            </div><!--/content-left-->



            <?php
            $sidebar_select = get_post_meta($post->ID, $prefix . 'sidebar', true);            

            if ($sidebar_select == 'none') {
                $get_categories = wp_get_post_categories($post->ID);
                $sidebar_select = get_option('sidebar_' . $get_categories[0]);
                $sidebar_select = $sidebar_select['sidebar'];
            }


            tk_get_sidebar('Right', $sidebar_select);
            ?>

        </div><!--/content-full-->
    </div><!--/wrapper-->
</div><!--/content-->

<?php get_footer(); ?>