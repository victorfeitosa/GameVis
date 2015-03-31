<div <?php if(get_post_type() == 'gallery'){post_class('span2');}else{post_class();}; ?>>
<?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/

    if(is_single()){
        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
        ?>
        <div class="block images-single-blog">
            <?php if(!empty ($attachments[0])){?>
                <div class="top-content-image">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach($attachments as $attach) {
                                echo '<li><img src="'.$attach.'" alt="'.get_the_title($post->ID).'" title="'.get_the_title($post->ID).'"/></li>';
                            }
                            ?>
                        </ul>
                    </div><!-- flex slider -->
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

        <?php get_template_part( '/templates/parts/entry', 'social' );?>

        <?php
        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Our Causes page               */
        /*                                                          */
        /************************************************************/
    }elseif(get_post_type() == 'services'){
        $services_donation = get_post_meta($post->ID, 'tk_services_donation', true);
        $services_amount = get_post_meta($post->ID, 'tk_services_collected', true);
        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
        ?>
        <div class="block">
            <?php if(!empty ($attachments[0])){?>
                <div class="top-content-image">
                    <a href="<?php the_permalink()?>">
                        <img src="<?php echo tk_get_thumb(724, 318, $attachments[0])?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>="/>
                    </a>
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
                <?php the_excerpt()?>
                <a href="<?php the_permalink()?>"><?php _e('Read More', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>

        <?php
        /************************************************************/
        /*                                                                                      */
        /*   If this type is shown in Gallery page                           */
        /*                                                                                      */
        /************************************************************/
    }elseif(get_post_type() == 'gallery'){
        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
        if(!empty ($attachments[0])){
    ?>
            <a href="<?php the_permalink()?>" class="screenshot" rel="<?php echo $attachments[0]?>">
                <img src="<?php echo tk_get_thumb(724, 318, $attachments[0])?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
            </a>
        <?php }else{?>
            <a href="<?php the_permalink()?>" class="screenshot" rel="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>">
                <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
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
        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
        ?>
        <div class="block our-causes-page">
                            
                <div class="top-content-image event-gallery">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach($attachments as $attach) {
                                echo '<li><img src="'.$attach.'" alt="'.get_the_title().'" title="'.get_the_title().'"/></li>';
                            }
                            ?>
                        </ul>
                    </div><!-- flex slider -->  
                    
                    <a href="<?php the_permalink()?>">
                        <ul class="countdown-<?php echo $post->ID; ?> gallery-type" ></ul>                        
                        <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                            <script type="text/javascript">
                                jQuery(document).ready(function($){ 
                                    $('.countdown-<?php echo $post->ID?>').countdown({alwaysExpire: true, expiryText: ' ', until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', compact: true, timezone:new Date().getTimezoneOffset()/60 * -1});
                                });
                            </script>
                        <?php }?>
                    </a>
                    
                </div><!-- top-content-image -->
                
            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
        </div>
        <?php
        /************************************************************/
        /*                                                          */
        /*   If this type is shown in Blog page                     */
        /*                                                          */
        /************************************************************/
    }else{
        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
        ?>
        <div class="block blog-post">
            <?php if(!empty ($attachments[0])){?>
                <div class="top-content-image">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach($attachments as $attach) {                              
                                echo '<li><img src="'.tk_get_thumb(724, 318, $attach).'" alt="'.get_the_title().'" title="'.get_the_title().'"/></li>';
                            }
                            ?>
                        </ul>
                    </div><!-- flex slider -->
                </div>
            <?php } ?>

            <div class="top-content-text">
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                <h3><a href="<?php the_permalink(); ?>" class="post-headlines"><?php the_title(); ?></a></h3>
                <p><?php the_excerpt_length(340);?></p>
                <a href="<?php the_permalink()?>" title="<?php the_title();?>"><?php _e('Continue Reading', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->