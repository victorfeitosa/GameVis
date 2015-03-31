<div <?php if(get_post_type() == 'gallery'){ if(is_front_page()){post_class('span2');} else {post_class('span2');}  }else{post_class();}; ?>>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){ ?>
            <div class="block images-single-blog">
                <?php if(has_post_thumbnail()){
                    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    $post_thumbnail_src = $post_thumbnail['0'];
                    ?>
                    <div class="top-content-image">
                        <?php the_post_thumbnail('home-events')?>
                        <div class="images-hover-blog">
                            <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox"
                               data-fancybox-group="gallery"
                               title="<?php the_title()?>"></a>
                            <a href="<?php the_permalink()?>" class="blog-link"></a>
                        </div><!-- images-hover-blog -->
                    </div>
                <?php }?>
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
            </div>

            <div class="shortcodes">
               <?php 
                    the_content();                     
               ?>
            </div>
            
            <!-- post-pagination -->
            <div class="post-pagination">
                    <?php wp_link_pages(); ?>
            </div><!-- post-pagination -->
            
        <!-- TAGS -->
            <?php $check_tags = get_the_tags();
                if(!empty($check_tags)) {
                    the_tags('<div class="block blog-tag clear"><img src="'.get_template_directory_uri().'/img/tag-widget.png"><span class="tags">Tags: </span>', ', ', '</div>'); 
                } else { ?>
                    <div class="post-border"></div>
               <?php }  ?>
        <!-- TAGS -->

            <?php  get_template_part( '/templates/parts/entry', 'social' ); ?>

    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Our Causes page               */
    /*                                                          */
    /************************************************************/
    }elseif(get_post_type() == 'services'){
        $services_donation = get_post_meta($post->ID, 'tk_services_donation', true);
        $services_amount = get_post_meta($post->ID, 'tk_services_collected', true);
        ?>
        <div class="block">
            <?php if(has_post_thumbnail()){
                $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                $post_thumbnail_src = $post_thumbnail['0'];
                ?>
            <div class="top-content-image">
                
                    <?php the_post_thumbnail('home-events');?>
                    <div class="images-hover-blog">
                        <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox"
                           data-fancybox-group="gallery"
                           title="<?php the_title()?>"></a>
                        <a href="<?php the_permalink()?>" class="blog-link"></a>
                    </div>
                
            </div>
            <?php }?>

            <div class="top-content-text">
                <h3><a href="<?php the_permalink(); ?>" class="post-headlines"><?php the_title()?></a></h3>
                <?php if(!empty($services_donation) || !empty($services_amount)){?>
                    <ul>
                        <?php if($services_donation){?><li class="span4 make-donation"><a href='<?php echo $services_donation?>'><?php _e('Make Donation', 'tkingdom')?><i class="plas-wite10"></i></a></li><?php }?>
                        <?php if($services_amount){?>
                            <li class="span4"><p><?php _e('Collected money so far:', 'tkingdom')?></p></li>
                            <li class="span4"><span><?php echo $services_amount?></span></li>
                        <?php }?>
                    </ul>
                <?php }?>
                <div class="clear"></div>
                <?php the_excerpt() ?>
                <a href="<?php the_permalink()?>"><?php _e('Read More', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>

    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Team page                     */
    /*                                                          */
    /************************************************************/
    }elseif(get_post_type() == 'team-members'){
        $member_phone = get_post_meta($post->ID, 'tk_member_phone', true);
        $member_email = get_post_meta($post->ID, 'tk_member_email', true);
        $member_other = get_post_meta($post->ID, 'tk_member_other', true);
            ?>
            <div class="row-fluid">
                <?php if(has_post_thumbnail()){?>
                    <div class="span4">
                        <a href="<?php the_permalink()?>">
                            <?php the_post_thumbnail();?>
                            <div class="images-hover-eys"><p></p></div>
                        </a>
                    </div>
                <?php }?>

                <div class="<?php if(has_post_thumbnail()){echo 'span8';}else{echo 'span12';}?>">
                    <div class="top-content-text">
                        <ul>
                            <li><h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3></li>
                            <li><p><?php the_excerpt()?></p></li>
                            <?php if($member_phone){?><li><h5><?php _e('PHONE:', 'tkingdom')?></h5><span><?php echo $member_phone?></span></li><?php }?>
                            <?php if($member_email){?><li><h5><?php _e('Email:', 'tkingdom')?></h5><a href="mailto:<?php echo $member_email?>?Subject=Contact%20from%20website"><?php echo $member_email?></a></li><?php }?>
                            <?php if($member_other){?><li><h5><?php _e('OTHER:', 'tkingdom')?></h5><span><?php echo $member_other?></span></li><?php }?>
                        </ul>
                    </div>
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
        
        <div class="gallery-images-one-builder">            
            <?php the_post_thumbnail('gallery-images');?>           
            <div class="gallery-hover">
                <div class="gallery-hover-wrap">
                    <div class="gallery-hover-icon get-standard-image">
                        <a class="fancybox" href="<?php echo $post_thumbnail_src;?>"></a>
                    </div><!--/gallery-hover-icon-->
                </div><!-- gallery-hover-wrap -->
            </div><!--/gallery-hover-->
        </div><!-- gallery-images-one -->
        
        <?php }else{?>
            <a href="<?php the_permalink()?>" rel="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>">
                <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"/>
            </a>
        <?php }?>
    <?php
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Events page                   */
    /*                                                          */
    /************************************************************/
    }elseif(get_post_type() == 'events'){
        $main_event_date = get_post_meta($post->ID, 'tk_event_datetime', true);
        $datedate = date('d-m-Y', $main_event_date);
        $datetime = date('H:i:s', $main_event_date);
        $event_date = explode('-', $datedate);
        $event_time = explode(':', $datetime);
        $event_address = get_post_meta($post->ID, 'tk_event_address', true);
        $event_duration = get_post_meta($post->ID, 'tk_event_duration', true);
        ?>
        <div class="block">
            <div class="top-content-image <?php if(!has_post_thumbnail()){echo 'events-title-no-image';}?>">
                <a href="<?php the_permalink()?>">
                    <ul class="countdown-<?php echo $post->ID?>"></ul>
                    <?php if(has_post_thumbnail()){the_post_thumbnail('home-events');}?>
                    <?php 
                        if(count($event_date) > 1 && count($event_time) > 1){ 
                        $date = new DateTime($event_date[2].'-'.$event_date[1].'-'.$event_date[0]);
                    ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function($){ 
                                $('.countdown-<?php echo $post->ID?>').countdown({alwaysExpire: true, expiryText: ' ', until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', compact: true, timezone: new Date().getTimezoneOffset()/60 * -1});
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
        <div class="block blog-post">
            <?php if(has_post_thumbnail()){
                    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                    $post_thumbnail_src = $post_thumbnail['0'];
            ?>
            <div class="top-content-image">
                <?php the_post_thumbnail('home-events')?>
                <div class="images-hover-blog">
                    <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox"
                       data-fancybox-group="gallery"
                       title="<?php the_title()?>"></a>
                    <a href="<?php the_permalink()?>" class="blog-link"></a>
                </div>
            </div>
            <?php }?>

            <div class="top-content-text">
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                <h3><a href="<?php the_permalink(); ?>" class="post-headlines"><?php the_title(); ?></a></h3>
                <p><?php the_excerpt_length(340);?></p>
                <a href="<?php the_permalink()?>" title="<?php the_title();?>"><?php _e('Continue Reading', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->