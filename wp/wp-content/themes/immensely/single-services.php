<?php get_header(); ?>

<?php
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_post_meta($blog_id, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
$services_donation = get_post_meta($post->ID, 'tk_services_donation', true);
$services_amount = get_post_meta($post->ID, 'tk_services_collected', true);
$attachments  = get_post_meta($post->ID, 'tk_repeatable', true);
$video_link = get_post_meta($post->ID, 'tk_video_link', true);
?>
    <div class="row-fluid">
        <div class="container">

            <h1 class="title-divider" style="margin-top: 120px">
                <span>Our Causes</span>
                <small>At vero eos et accusam et justo duo dolores et ea rebum.</small>
            </h1>

            <div class="row-fluid">

                <div class="span8 our-causes-page causes-single-page">

                    <div class="block">
                        <?php if (get_post_format() == 'video') {?>
                            <?php if($video_link){?>
                                <div class="top-content-image">
                                    <?php tk_video_player($video_link);?>
                                </div>
                            <?php }?>
                        <?php } elseif (get_post_format() == 'gallery') {?>
                            <?php if(!empty ($attachments[0])){?>
                                <div class="top-content-image">
                                    <div class="flexslider">
                                        <ul class="slides">
                                            <?php
                                            foreach($attachments as $attach) {
                                                echo '<li><img src="'.$attach.'" alt="gallery_alt" title="gallery_title"/></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div><!-- flex slider -->
                                </div>
                            <?php }?>
                        <?php }else {?>
                            <?php if(has_post_thumbnail()){?>
                                <div class="top-content-image">
                                    <a href="<?php the_permalink()?>">
                                        <?php the_post_thumbnail();?>
                                    </a>
                                </div>
                            <?php }?>
                        <?php }?>
                        <div class="top-content-text">
                            <h3><?php the_title()?></h3>
                            <?php if(!empty($services_donation) || !empty($services_amout)){?>
                                <ul>
                                    <?php if($services_donation){?><li class="span4 make-donation"><a href='<?php echo $services_donation?>'><?php _e('Make Donation', 'tkingdom')?><i class="plas-wite10"></i></a></li><?php }?>
                                    <?php if($services_amount){?>
                                        <li class="span4"><p><?php _e('Collected money so far:', 'tkingdom')?></p></li>
                                        <li class="span4"><span><?php echo $services_amount?></span></li>
                                    <?php }?>
                                </ul>
                            <?php }?>
                            <?php
                            //The Loop
                            if (have_posts()) : while (have_posts()) : the_post();
                                the_content();
                            endwhile;
                            endif;
                            ?>
                        </div>
                    </div>
                    <!--COMMENTS-->
                    <?php if (comments_open()) : ?>
                        <?php comments_template(); // Get wp-comments.php template  ?>
                    <?php endif; ?>
                </div>

                <div class="span4" id="sidebar">
                    <div class="span11 pull-right">
                        <!-- Sidebar -->
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