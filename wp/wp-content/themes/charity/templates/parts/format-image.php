<div <?php post_class(); ?>>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
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
                    </div>
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

        <?php get_template_part( '/templates/parts/entry', 'social' );

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
                    <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                        <script type="text/javascript">
                                jQuery(document).ready(function($){ 
                                    $('.countdown-<?php echo $post->ID?>').countdown({alwaysExpire: true, expiryText: ' ', until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', compact: true, timezone:new Date().getTimezoneOffset()/60 * -1});
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
                <h3><a href="<?php the_permalink(); ?>" class="post-headlines"><?php the_title()?></a></h3>
                <a href="<?php the_permalink()?>" title="<?php the_title();?>"><?php _e('Continue Reading', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->