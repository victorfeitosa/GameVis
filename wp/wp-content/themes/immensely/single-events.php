<?php get_header(); ?>

<?php
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_post_meta($blog_id, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
?>
<div class="row-fluid">
    <div class="container">
        <h1 class="title-divider" style="margin-top: 120px">
            <span>Post</span>
            <small>At vero eos et accusam et justo duo dolores et ea rebum.</small>
        </h1>
        <div class="row-fluid">
            <div class="span8 events-page event-single-page">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post();
                        $event_date = explode('-', get_post_meta($post->ID, 'tk_event_date', true));
                        $event_time = explode(':', get_post_meta($post->ID, 'tk_event_time', true));
                        $event_address = get_post_meta($post->ID, 'tk_event_address', true);
                        $event_duration = get_post_meta($post->ID, 'tk_event_duration', true);
                        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                        $attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
                        ?>
                        <div class="block images-single-blog">
                            <?php if (get_post_format() == 'video') {?>
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
                            <?php } elseif (get_post_format() == 'gallery') {?>
                                <div class="top-content-image <?php if(empty($attachments[0])){echo 'events-title-no-image';}?>">
                                    <a href="<?php the_permalink()?>">
                                        <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                                            <div class="date-box">
                                                <span><?php echo $event_date[0]?></span>
                                                <p><?php echo $event_date[1]?>, <?php echo $event_date[2]?></p>
                                            </div>
                                        <?php }?>
                                        <ul class="countdown-<?php echo $post->ID?>"></ul>
                                        <?php if(!empty ($attachments[0])){?>
                                            <img src="<?php echo tk_get_thumb(770, 398, $attachments[0])?>" alt="gallery_alt" title="gallery_title"/>
                                        <?php }?>
                                        <?php if(count($event_date) > 1 && count($event_time) > 1){?>
                                            <script type="text/javascript">
                                                jQuery(document).ready(function($){
                                                    $('.countdown-<?php echo $post->ID?>').countdown({until: new Date(<?php echo $event_date[2]?>, <?php echo $event_date[1]?>-1, <?php echo $event_date[0]?>, <?php echo $event_time[0]?>, <?php echo $event_time[1]?>, 00), layout: '<li><span>{dn}</span> <p><?php _e('days', 'tkingdom')?></p></li> <li><span>{hnn}</span> <p><?php _e('hours', 'tkingdom')?></p></li> <li><span>{mnn}</span> <p><?php _e('minutes', 'tkingdom')?></p></li> <li><span>{snn}</span> <p><?php _e('seconds', 'tkingdom')?></p></li>', compact: true, timezone:0});
                                                });
                                            </script>
                                        <?php }?>
                                    </a>
                                </div>
                            <?php } else{?>

                                <?php if(has_post_thumbnail()){
                                    $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                                    $post_thumbnail_src = $post_thumbnail['0'];
                                    ?>
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
                                <?php }?>
                            <?php } // endif check post format?>

                            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                        </div>

                        <div class="shortcodes">
                            <?php the_content(); ?>
                        </div>

                        <div class="social-divider"></div>
                        <?php get_template_part( '/templates/parts/entry', 'social' ); ?>

                    <?php endwhile; ?>

                <?php endif; ?>
                <!--COMMENTS-->
                <?php if (comments_open()) : ?>
                    <?php comments_template(); // Get wp-comments.php template  ?>
                <?php endif; ?>

            </div>

            <div class="span4" id="sidebar">
                <div class="span11 pull-right">
                    <?php if($sidebar_postition == 'right'){
                        tk_get_sidebar('Right', 'Blog');
                    }elseif($sidebar_postition == 'left'){
                        tk_get_sidebar('Left', 'Blog');
                    }
                    ?>
                </div>
                <!--/sidebar-->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>