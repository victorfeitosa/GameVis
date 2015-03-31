<?php
$disable_slider = get_theme_option(wp_get_theme()->name . '_home_disable_slider');

if($disable_slider != 'yes') { ?>
    <div class="block slider-page">
        <div id="example10" class="showbiz-container fullwidth nopaddings ">
            <!--    THE PORTFOLIO ENTRIES   -->
            <div class="showbiz sb-modern-skin">
                <!-- THE OVERFLOW HOLDER CONTAINER, DONT REMOVE IT !! -->
                <div class="overflowholder">
                    <!-- LIST OF THE ENTRIES -->
                    <ul><?php 
                    $num_of_slides = get_theme_option(wp_get_theme()->name . '_home_num_of_slides');
                    query_posts('posts_per_page='.$num_of_slides.'&meta_key=tk_slider_post&ignore_sticky_posts=1');
                     ?>

                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post(); ?>
                                
                                <!-- AN ENTRY HERE WITH PREDEFINED MEDIA SKIN-->
                                <li class="sb-modern-skin">
                                    

                                    <!-- THE MEDIA HOLDER -->
                                    <div class="mediaholder">
                                        <div class="mediaholder_innerwrap">
                                            <?php if(has_post_thumbnail()) {
                                            $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider' );
                                            $post_thumbnail_src = $post_thumbnail['0']; ?>
                                            <img alt="<?php the_title()?>" src="<?php echo $post_thumbnail_src; ?>">
                                            <?php } ?>
                                        </div>
                                    </div><!-- END OF MEDIA HOLDER -->

                                    <div class="darkhover"></div>

                                    <div class="detailholder">
                                        <div class="showbiz-title"><a href="<?php the_permalink(); ?>">
                                            <?php 
                                            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                                            if($video_link) { ?><i class="fa fa-youtube-play"></i><?php } ?>
                                            <?php the_title()?></a>
                                        </div>
                                        <div class="excerpt">
                                            <div class="divide20"></div>
                                            <div class="sb-post-details leftfloat"><span class="rm15"><?php echo get_the_category_list( ', ' ); ?></span></div>
                                            <div class="sb-readmore rightfloat"><a href="<?php the_permalink()?>"><?php _e('READ MORE', 'tkingdom'); ?></a></div>
                                        </div>
                                        <!-- THE POST INFOS AND READ MORE BUTTON -->
                                        <div class="sb-clear"></div><!-- END OF POST INFOS AND READ MORE BUTTON -->
                                    </div>

                                </li><!-- END OF ENTRY -->


                            <?php endwhile; ?>
                        <?php endif;?>

                        <?php wp_reset_query(); ?>

                    </ul>
                    <div class="sbclear"></div>
                </div> <!-- END OF OVERFLOWHOLDER -->
                <div class="sbclear"></div>
            </div>
        </div><!-- END OF DEMO -->
    </div>
<?php } ?>