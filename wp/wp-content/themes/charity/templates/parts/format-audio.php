<div <?php post_class(); ?>>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
        <div class="block images-single-blog">
            <div class="row-fluid blog-player">
                <?php tk_jplayer($post->ID); ?>
                <div id="jquery_jplayer_<?php echo $post->ID ?>" class="jp-jplayer"></div>
                <div id="jp_container_<?php echo $post->ID ?>" class="jp-audio">
                    <div class="jp-type-single">
                        <div class="jp-gui jp-interface" id="jp_interface_<?php echo $post->ID; ?>">
                            <ul class="jp-controls">
                                <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                            </ul>
                            <div class="jp-progress">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div><!--/jp-gui jp-interface-->
                    </div><!--/jp-type-single-->
                </div><!--/jp-audio-->
                
            <div class="row-fluid blog-audio-info">
                <a href="<?php the_permalink()?>"><?php the_title()?></a>
            </div>
                
            </div>

            <!--/blog-player-->
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

    <?php }else{?>
        <div class="block blog-post">
            <div class="top-content-text">                
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
            </div>

            <?php // check if link to audio file exists
            $audio_link = get_post_meta($post->ID, 'tk_audio_link', true);
            if($audio_link){?>
                <div class="row-fluid blog-player">
                    <?php tk_jplayer($post->ID); ?>
                    <div id="jquery_jplayer_<?php echo $post->ID ?>" class="jp-jplayer"></div>
                    <div id="jp_container_<?php echo $post->ID ?>" class="jp-audio">
                        <div class="jp-type-single">
                            <div class="jp-gui jp-interface" id="jp_interface_<?php echo $post->ID; ?>">
                                <ul class="jp-controls">
                                    <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                    <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                    <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                    <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                </ul>
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div><!--/jp-gui jp-interface-->
                        </div><!--/jp-type-single-->
                    </div><!--/jp-audio-->
                    <!--/blog-player-->
                    <div class="row-fluid blog-audio-info">
                        <a href="<?php the_permalink()?>" class="post-headlines"><?php the_title()?></a>
                    </div>
                </div>
            <?php }?>

            <div class="top-content-text clearfix">
                <p><?php the_excerpt_length(340);?></p>
                <a href="<?php the_permalink()?>" title="<?php the_title();?>"><?php _e('Continue Reading', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->