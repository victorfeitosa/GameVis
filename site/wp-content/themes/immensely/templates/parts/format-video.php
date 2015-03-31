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
            <div class="blog-single sidebar right page" id="content">

                <div class="row-fluid">

                                <div class="video-post-big">
                           
                                    
                                    <?php tk_video_player($video_link);?>

                                    <div class="post-big">
                                        <?php  if(is_sticky()) { ?><li class="sticky featured-post button-small"><i class="fa fa-star"></i><?php _e('Featured Post', 'tkingdom') ?></li><?php } ?>
                                        <h4><?php the_title()?></h4>
                                        <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>

                                        <div class="shortcodes">
                                           <?php the_content(); ?>
                                        </div>

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
        /*   If this type is shown in Gallery page                  */
        /*                                                          */
        /************************************************************/
    }elseif(get_post_type() == 'gallery'){
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        if($video_link){
            ?>
            <div class="gallery-video">
                <?php tk_video_player($video_link);?>
            </div>
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
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
        <div class="block">
            <div class="top-content-image <?php if(!$video_link){echo 'events-title-no-image';}?>">
                <a href="<?php the_permalink()?>">
                    <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                        <div class="date-box">
                            <span><?php echo $event_date[0]?></span>
                            <p><?php echo $event_date[1]?>, <?php echo $event_date[2]?></p>
                        </div>
                    <?php }?>
                    <ul class="countdown-<?php echo $post->ID?>"></ul>
                    <?php if($video_link){tk_video_player($video_link);}?>
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
    }else{
        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
        ?>
            <div class="video-post-big">
                        <?php tk_video_player($video_link);?>

                <div class="post-big">
                    <?php  if(is_sticky()) { ?><li class="sticky featured-post button-small"><i class="fa fa-star"></i><?php _e('Featured Post', 'tkingdom') ?></li><?php } ?>
                    <h4><a href="<?php the_permalink()?>"><?php the_title()?></a></h4>
                    <p><?php the_excerpt()?></p>
                    <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                </div>
            </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->