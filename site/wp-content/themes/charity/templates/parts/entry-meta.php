<?php if(get_post_type() == 'events'){
    $main_event_date = get_post_meta($post->ID, 'tk_event_datetime', true);
    $datedate = date('d-m-Y', $main_event_date);
    $datetime = date('H:i:s', $main_event_date);
    $event_date = explode('-', $datedate);
    $event_time = explode(':', $datetime);

    $event_address = get_post_meta($post->ID, 'tk_event_address', true);
    $event_duration = get_post_meta($post->ID, 'tk_event_duration', true);    
    
    ?>

        <?php if(!is_single()){?><h3><a href="<?php the_permalink(); ?>" class="post-headlines"><?php the_title(); ?></a></h3><?php }?>
        <?php if(!is_single()){?><?php the_excerpt()?><?php }?>
        <?php if(!empty($event_date) || !empty($event_address) || !empty($event_duration)){ ?>
        
            <div class="top-content-text event-margin">
                <ul>
                    <?php if(!empty($event_address)){?><li><img class="li-icon-margin" src="<?php echo get_template_directory_uri()?>/img/location-icon.png"><span><?php echo $event_address?></span></li><?php }?>
                    <?php if(!empty($event_duration)){?><li><img class="li-icon-margin" src="<?php echo get_template_directory_uri()?>/img/time-icon.png"><p><?php echo $event_duration?></p></li><?php }?>
                    <?php if($event_date){?>
                        <li><?php if(get_post_type() == 'events'){ ?><img src="<?php echo get_template_directory_uri()?>/img/date-icon.png"><?php } else { ?><img src="<?php echo get_template_directory_uri()?>/img/calendar-icon.png"> <?php }?>    
                            <p><?php echo $datedate; ?></p>
                        </li>
                    <?php }?>
                </ul>
                <?php if(!is_single()){?><a href="<?php the_permalink()?>"><?php _e('Read More', 'tkingdom')?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a><?php }?>
            </div>

    <?php } ?>

<?php }else{ ?>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="span2"><p><?php the_time('d'); ?></p><span><?php the_time('M')?> <?php  the_time('y'); ?></span></td>
                    <?php if(is_sticky()) { ?><td><img src="<?php echo get_template_directory_uri(); ?>/img/star.png" /><p><?php _e('Featured Post'); ?></p></td><?php } ?>
                    <td><img src="<?php echo get_template_directory_uri()?>/img/user-icon.png"><p><?php the_author_posts_link();?></p></td>
                    <?php echo get_the_term_list($post->ID, 'ct_gallery','<td><img src='.get_template_directory_uri().'/img/charity-icon.png><p>', ', ', '</p></td>'); ?>
                    <td><img src="<?php echo get_template_directory_uri()?>/img/comments-icon-smal.png"><p><a href="<?php comments_link();?>"><?php comments_number( '0', '1', '%' ); ?></a></p></td>
                </tr>
                </tbody>
            </table>        
<?php }?>