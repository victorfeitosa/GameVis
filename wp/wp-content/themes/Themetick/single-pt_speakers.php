<?php get_header();
$prefix = 'tk_';

$blog_title = get_option('title_blog_page');
$author = get_userdata( $post->post_author );
$job_position = get_post_meta($post->ID, $prefix.'job_position', true);
$speaker_twitter = get_post_meta($post->ID, $prefix.'speaker_twitter', true);
$speaker_facebook = get_post_meta($post->ID, $prefix.'speaker_facebook', true);
$speaker_linkedin = get_post_meta($post->ID, $prefix.'speaker_linkedin', true);
$speaker_gplus = get_post_meta($post->ID, $prefix.'speaker_gplus', true);
$speaker_mail = get_post_meta($post->ID, $prefix.'speaker_email', true);
$speaker_url = get_post_meta($post->ID, $prefix.'speaker_url', true);
$post_type = get_post_type();
$sidebar_position = get_post_meta(get_option('id_speakers_page'), $prefix.'sidebar_position', true);

?>






    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">



            <?php tk_get_left_sidebar($sidebar_position, 'Speakers Single Page'); ?>


            <div class="page-content left">

                <div class="speakers-single-content right">

                    <div class="speakers-single-data left">
                        <?php if(has_post_thumbnail()) {
                            $default_attr = array( 'alt' =>get_the_title(), 'title' =>get_the_title());
                            ?>
                            <div class="speakers-single-images left"><a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>"><?php the_post_thumbnail('singlespeaker', $default_attr); ?></a></div><!--/speakers-single-images-->
                        <?php } ?>
                            <div class="speakers-single-title <?php if(has_post_thumbnail()) { echo 'right'; } else {  echo 'left'; } ?>">
                            
                            <div class="speaker_name"><?php the_title(); ?></div>
                            <span><?php echo $job_position?></span>

                            <?php if(($speaker_twitter) || ($speaker_facebook) || ($speaker_linkedin) ||  ($speaker_gplus) || ($speaker_mail)) { ?>
                            <div class="bg-speakers-single-mail left">
                                <ul>
                                    <li><span>Follow :</span></li>
                                    <?php if($speaker_twitter) { ?><li><div class="follow-icon-1 left"><a href="http://twitter.com/<?php echo $speaker_twitter; ?>"></a></div></li><?php } ?>
                                    <?php if($speaker_facebook) { ?><li><div class="follow-icon-2 left"><a href="http://facebook.com/<?php echo $speaker_facebook; ?>"></a></div></li><?php } ?>
                                    <?php if($speaker_linkedin) { ?><li><div class="follow-icon-3 left"><a href="<?php echo $speaker_linkedin; ?>"></a></div></li><?php } ?>
                                    <?php if($speaker_gplus) { ?><li><div class="follow-icon-4 left"><a href="<?php echo $speaker_gplus; ?>"></a></div></li><?php } ?>
                                    <?php if($speaker_mail) { ?><li><div class="follow-icon-5 left"><a href="mailto:<?php echo $speaker_mail; ?>"></a></div></li><?php } ?>
                                </ul>
                            </div><!--/bg-speakers-single-mail-->
                            <?php } ?>


                            <?php if($speaker_url) { ?>
                            <div class="bg-speakers-single-mail left">
                                <ul>
                                    <li><span>Site :</span></li>
                                    <li><div class="mail-speakers left"><a href="<?php echo $speaker_url ?>"><?php echo $speaker_url ?></a></div></li>
                                </ul>
                            </div><!--/bg-speakers-single-mail-->
                            <?php } ?>


                        </div><!--/speakers-single-title-->
                    </div><!--/speakers-single-data-->


                    <div class="shortcodes speakers-single-text left">
                                <?php
                                    wp_reset_query();
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                                            the_content();
                                        endwhile;
                                    else:
                                    endif;
                                    wp_reset_query();
                                    ?>
                    </div><!--/speakers-single-text-->

                </div><!--/speakers-single-content-->

            </div><!--/page-content-->

<?php tk_get_right_sidebar($sidebar_position, 'Speakers Single Page'); ?>
        </div><!--/wrapper-->
    </div><!--/content-->











<?php get_footer(); ?>