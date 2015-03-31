<div <?php if(get_post_type() == 'gallery'){post_class('span2');}else{post_class();}; ?>>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){
        $prefix = 'tk_';
        $sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
        $disable_author = get_post_meta($post->ID, 'tk_disable_author', true);
        ?>
<div class="blog-single sidebar right page" id="content">
    
            <div class="row-fluid">
                
                    <div class="img-post-big">
                        
                        <?php
                        $check_image_single = get_the_post_thumbnail();
                        if(!empty($check_image_single)) { ?>
                            <figure>
                                <?php the_post_thumbnail('blog'); ?>
                            </figure>
                        <?php } ?>
                        
                        <div class="post-big">
                            <?php  if(is_sticky()) { ?><li class="sticky featured-post button-small"><i class="fa fa-star"></i><?php _e('Featured Post', 'tkingdom') ?></li><?php } ?>
                            <h4><?php the_title()?></h4>
                            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                                
                            <div class="shortcodes">
                               <?php the_content('Continue Reading'); ?>
                            </div>
                            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                            <!-- TAGS -->
                            <div class="block tag-widget clear">
                                <?php the_tags('<h6 class="tags">Tags</h6>', ''); ?>
                            </div>
                            <!-- TAGS -->
                        </div>
                    </div>

                    <div class="block single-soc-share">
                        <?php get_template_part( '/templates/parts/entry', 'social' ); ?>
                    </div><!--/single-soc-share-->

                    
                    <?php if ($disable_author != 'on') { ?>
                        <?php get_template_part( '/templates/parts/entry', 'author' ); ?>
                    <?php }?>

        </div>
</div>
    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Team page                     */
    /*                                                          */
    /************************************************************/
    }elseif(get_post_type() == 'team-members'){
        $facebook_ico = get_post_meta($post->ID, 'tk_member_facebook', true);
        $twitter_ico = get_post_meta($post->ID, 'tk_member_twitter', true);
        $google_ico = get_post_meta($post->ID, 'tk_member_google', true);
        $linkedin_ico = get_post_meta($post->ID, 'tk_member_linkedin', true);
        $pinterest_ico = get_post_meta($post->ID, 'tk_member_pinterest', true);
        $dribbble_ico = get_post_meta($post->ID, 'tk_member_dribbble', true);
        $mail_ico = get_post_meta($post->ID, 'tk_member_mail', true);
        $job_title = get_post_meta($post->ID, 'tk_member_position', true);
            ?>
        
        <div class="span3">
            <figure>
                <?php the_post_thumbnail('our-team'); ?>
            </figure>
            <div class="profile-info">
                <h6><?php the_title(); ?></h6>
                <span><?php echo $job_title; ?></span>

                 <?php /*---SOCIAL ICONS---*/
                    if ($facebook_ico != '' || $twitter_ico != '' || $google_ico != '' || $linkedin_ico != '' || $pinterest_ico != '' || $dribbble_ico != '' || $mail_ico != '') {
                        ?>
                <ul class="soc-icon">
                    <?php if(!empty($facebook_ico)) { ?><a href="http://www.facebook.com/<?php echo $facebook_ico; ?>"><li class="facebook"><i class="fa fa-facebook"></i></li></a><?php } ?>
                    <?php if(!empty($twitter_ico)) { ?><a href="http://www.twitter.com/<?php echo $twitter_ico; ?>"><li class="twitter"><i class="fa fa-twitter"></i></li></a><?php } ?>
                    <?php if(!empty($google_ico)) { ?><a href="http://plus.google.com/<?php echo $google_ico; ?>"><li class="google-plus"><i class="fa fa-google-plus"></i></li></a><?php } ?>
                    <?php if(!empty($linkedin_ico)) { ?><a href="<?php echo $linkedin_ico; ?>"><li class="linkedin"><i class="fa fa-linkedin"></i></li></a><?php } ?>
                    <?php if(!empty($pinterest_ico)) { ?><a href="http://www.pinterest.com//<?php echo $pinterest_ico; ?>"><li class="pinterest"><i class="fa fa-pinterest"></i></li></a><?php } ?>
                    <?php if(!empty($dribbble_ico)) { ?><a href="http://dribbble.com/<?php echo $dribbble_ico; ?>"><li class="dribble"><i class="fa fa-dribbble"></i></li></a><?php } ?>
                    <?php if(!empty($mail_ico)) { ?><a href="mailto:<?php echo $mail_ico; ?>"><li class="email"><i class="fa fa-envelope"></i></li></a><?php } ?>
                </ul>
                <?php } ?>

                <p><?php the_content('Continue Reading'); ?></p>
            </div>
        </div>


    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Gallery page                  */
    /*                                                          */
    /************************************************************/
    }elseif(get_post_type() == 'gallery'){
        $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        $post_thumbnail_src = $post_thumbnail['0'];
        if(has_post_thumbnail()){
        ?>
            <a href="<?php the_permalink()?>" class="screenshot" rel="<?php echo $post_thumbnail_src;?>">
                <?php the_post_thumbnail('gallery-images');?>
            </a>
        <?php }else{?>
            <a href="<?php the_permalink()?>" class="screenshot" rel="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>">
                <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
            </a>
        <?php }?>
    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Events page                   */
    /*                                                          */
    /************************************************************/
    }elseif(get_post_type() == 'events'){
        $event_date = explode('-', get_post_meta($post->ID, 'tk_event_date', true));
        $event_time = explode(':', get_post_meta($post->ID, 'tk_event_time', true));
        $event_address = get_post_meta($post->ID, 'tk_event_address', true);
        $event_duration = get_post_meta($post->ID, 'tk_event_duration', true);
        ?>
        <div class="block">
            <div class="top-content-image <?php if(!has_post_thumbnail()){echo 'events-title-no-image';}?>">
                <a href="<?php the_permalink()?>">
                    <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                        <div class="date-box">
                            <span><?php echo $event_date[0]?></span>
                            <p><?php echo $event_date[1]?>, <?php echo $event_date[2]?></p>
                        </div>
                    <?php }?>
                    <ul class="countdown-<?php echo $post->ID?>"></ul>
                    <?php if(has_post_thumbnail()){the_post_thumbnail();}?>
                    <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                $('.countdown-<?php echo $post->ID?>').countdown({until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', compact: true, timezone:0});
                            });
                        </script>
                    <?php }?>
                </a>
            </div>
            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
        </div>
    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Blog page                     */
    /*                                                          */
    /************************************************************/
    }else{?>
        <div class="img-post-big">
        <?php if(has_post_thumbnail()){
           $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'events' );
           $post_thumbnail_src = $post_thumbnail['0']; ?>
                <figure>
                    <?php the_post_thumbnail('blog')?>
                    <div class="post-opt-wrapper">
                        <div class="post-options">
                            <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox" title="<?php the_title()?>"><i class="fa fa-plus"></i></a>
                            <a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a>
                        </div>
                    </div>
                </figure>
                <?php }?>
            
                <div class="post-big">
                    <?php  if(is_sticky()) { ?><li class="sticky featured-post button-small"><i class="fa fa-star"></i><?php _e('Featured Post', 'tkingdom') ?></li><?php } ?>
                    <h4><a href="<?php the_permalink()?>"><?php the_title()?></a></h4>
                    <p><?php the_excerpt()?></p>
                    <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                </div>
            </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->