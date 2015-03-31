<?php get_header();

$prefix = 'tk_';
$speaker_title = get_option('title_speakers_page');
$author = get_userdata( $post->post_author );
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
?>


    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php echo $speaker_title; ?></h1>
                        <?php if ($page_headline !== '') { ?>
                        <span><?php echo '| ' . $page_headline ?></span>
                        <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->



            <div class="blog-holder left">

                <div class="blog-content full left">

                    <?php //Speaker contact info
                    $member_title = get_post_meta($post->ID, $prefix.'title_info', true);

                    $facebook = get_post_meta($post->ID, $prefix.'facebook_info', true);
                    $linkedin = get_post_meta($post->ID, $prefix.'linkedin_info', true);
                    $twitter = get_post_meta($post->ID, $prefix.'twitter_info', true);
                    $google_plus = get_post_meta($post->ID, $prefix.'google_info', true);
                    $email = get_post_meta($post->ID, $prefix.'email_info', true);
                    $speaker_url = get_post_meta($post->ID, $prefix.'speaker_url', true);
                    $speaker_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'speakers');
                    ?>
                    
                    
                    <div class="speakers-single left">
                        <div class="single-speaker-left left">
                            
                            
                            <div class="speakers-single-img left">
                                <?php if(!empty($speaker_image)) { ?>
                                <?php the_post_thumbnail('speaker-single'); ?>
                                <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri() ?>/style/img/default-speaker.png" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"  />
                                <?php } ?>
                            </div><!--speakers-single-img-->
                            
                            <div class="speaker-title-wrap left">
                                <h6><?php the_title(); ?></h6>
                                <span><?php echo $member_title;?></span>
                            </div><!-- speaker-title-wrap -->
                            
                            <?php if(!empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($google_plus) || !empty($email) || !empty($speaker_url)) { ?>
                            <div class="speakers-folow left">
                            <?php if(!empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($google_plus) || !empty($email)) { ?>
                                <ul>
                                    <li class="follow-link"><?php _e('Follow:', tk_theme_name) ?></li>
                                    <?php if($facebook) { ?><li><div class="speakers-folow-facebook left"><a href="http://facebook.com/<?php echo $facebook; ?>"></a></div></li><?php } ?>
                                    <?php if($twitter) { ?><li><div class="speakers-folow-twitter left"><a href="http://twitter.com/<?php echo $twitter; ?>"></a></div></li><?php } ?>
                                    <?php if($linkedin) { ?><li><div class="speakers-folow-linkedin left"><a href="<?php echo $linkedin; ?>"></a></div></li><?php } ?>
                                    <?php if($google_plus) { ?><li><div class="speakers-folow-googleplus left"><a href="https://plus.google.com/<?php echo $google_plus; ?>"></a></div></li><?php } ?>
                                    <?php if($email) { ?><li><div class="speakers-folow-email left"><a href="mailto:<?php echo $email; ?>"></a></div></li><?php } ?>
                                </ul>
                            <?php } //check social end ?>
                            <?php if(!empty($speaker_url)) {?>      
                                <ul>
                                    <li><?php _e('Site:', tk_theme_name) ?></li>
                                    <li><a href="<?php echo $speaker_url?>"><?php echo $speaker_url?></a></li>
                                </ul>
                            <?php } //check url end?>
                            </div><!--speakers-folow-->
                            <?php } //check social and url ?>
                        </div><!--/single-speaker-left-->
                        
                        <div class="single-speaker-right right">
                            <div class="speakers-single-text shortcodes left">
                                    <?php
                                        wp_reset_query();
                                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                                                the_content();
                                            endwhile;
                                        else:
                                        endif;
                                        wp_reset_query();
                                        ?>

                            </div><!--speakers-single-text-->
                        </div><!--/speaker-single-right-->
                    </div><!--speakers-single-->

                </div><!--blog-content-->

            </div><!-- /blog-holder -->

        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>