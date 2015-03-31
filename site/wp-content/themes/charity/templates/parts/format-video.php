<div <?php if(get_post_type() == 'gallery'){post_class('span2');}else{post_class();}; ?>>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
        <div class="block images-single-blog">
            <?php if($video_link){?>
                <div class="top-content-image">
                    <?php if($video_link){tk_video_player($video_link);}?>
                </div>
            <?php }?>
            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
        </div>

        <div class="shortcodes">
            <?php the_content(); ?>
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

        <?php get_template_part( '/templates/parts/entry', 'social' ); ?>

        <?php
        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Our Causes page               */
        /*                                                          */
        /************************************************************/
    }elseif(get_post_type() == 'services'){
        $services_donation = get_post_meta($post->ID, 'tk_services_donation', true);
        $services_amount = get_post_meta($post->ID, 'tk_services_collected', true);
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
        <div class="block">
            <?php if($video_link){?>
                <div class="top-content-image">
                    <?php tk_video_player($video_link);?>
                </div>
            <?php }?>

            <div class="top-content-text clear">
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
                <?php the_excerpt()?>
                <a href="<?php the_permalink()?>"><?php _e('Read More', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>

        <?php
        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Gallery page                  */
        /*                                                          */
        /************************************************************/
    }elseif(get_post_type() == 'gallery'){
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);  
        //passes variable from page builder to see if the file is included via page builder or theme
        global $gallery_builder;
        if($gallery_builder=='yes') {
            if(!empty($video_link)){  ?> 
        <div class="gallery-images-one-builder">
            <?php the_post_thumbnail('gallery-images'); ?>
            <div class="gallery-hover">
                <div class="gallery-hover-wrap">
                    <div class="gallery-hover-icon get-video-icon">
                        <a href="<?php echo $video_link; ?>" class="<?php if(strpos($video_link, 'youtube')){echo 'youtube';}elseif(strpos($video_link, 'vimeo')){echo 'vimeo';}?>"> </a>
                    </div>
                </div><!-- gallery-hover -->
            </div><!-- gallery-hover-wrap -->
        </div><!-- video-wrap -->
        <?php }else{ // if has image set?>
                <img src="<?php echo get_template_directory_uri().'/img/no-image.jpg';?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"/>
            <?php }// if not :-)
        } else {        
        if($video_link){
            ?>
            <div class="gallery-video">
                <?php tk_video_player($video_link);?>
            </div>
        <?php }else{?>
            <a href="<?php the_permalink()?>" class="screenshot" rel="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>">
                <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="<?php echo get_the_title($post->ID); ?>" title="<?php echo get_the_title($post->ID); ?>"/>
            </a>
        <?php } //($video_link)
        } //($gallery_builder=='yes')
        ?>

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
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
        <div class="block">
            <div class="top-content-image <?php if(!$video_link){echo 'events-title-no-image';}?>">
                <a href="<?php the_permalink()?>">
                    <ul class="countdown-<?php echo $post->ID?>"></ul>
                    <?php if($video_link){tk_video_player($video_link);}?>
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
    }else{
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
        <div class="block blog-post">
            <?php if($video_link){?>
                <div class="top-content-image">
                    <?php tk_video_player($video_link);?>
                </div>
            <?php }?>

            <div class="top-content-text">
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                <h3><a href="<?php the_permalink(); ?>" class="post-headlines"><?php the_title()?></a></h3>
                <p><?php the_excerpt_length(340);?></p>
                <a href="<?php the_permalink()?>" title="<?php the_title();?>"><?php _e('Continue Reading', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->