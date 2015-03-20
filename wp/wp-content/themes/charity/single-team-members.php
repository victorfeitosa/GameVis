<?php get_header(); ?>

<?php
$prefix = 'tk_';
$tk_page_id = get_option('id_team_page');
$page_headline = get_post_meta($wp_query->post->ID, 'tk_headline', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$member_phone = get_post_meta($wp_query->post->ID, 'tk_member_phone', true);
$member_email = get_post_meta($wp_query->post->ID, 'tk_member_email', true);
$member_other = get_post_meta($wp_query->post->ID, 'tk_member_other', true);
$disable_title = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

?>

    <div class="row-fluid shortcodes-margin margin-bottom-80">
        <div class="container">

        <?php if(empty($disable_title)){?>
            <h1 class="title-divider">
                <span><?php the_title()?></span>
                <?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?>
            </h1>
        <?php } ?>

            <div class="row-fluid">
            <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'left'){echo 'right span8';}elseif($sidebar_postition == 'right'){echo 'left span8';}?> director-single-page">
                <div class="block home-directors">
                    <div class="row-fluid">
                        <?php if(has_post_thumbnail($wp_query->post->ID)){?>
                            <div class="span4">
                                    <?php echo get_the_post_thumbnail($wp_query->post->ID, 'full');?>   
                            </div>
                        <?php }?>

                        <div class="<?php if(has_post_thumbnail($wp_query->post->ID)){echo 'span8';}else{echo 'span12';}?>">
                            <div class="top-content-text">
                                <ul>
                                    <li><h3><?php echo get_the_title($wp_query->post->ID)?></h3></li>
                                    <li>
                                        <?php
                                        //The Loop
                                        if (have_posts()) : while (have_posts()) : the_post();
                                            the_content();
                                        endwhile;
                                        endif;
                                        ?>
                                    </li>
                                    <?php if($member_phone){?><li><h5><?php _e('PHONE:', 'tkingdom')?></h5><span><?php echo $member_phone?></span></li><?php }?>
                                    <?php if($member_email){?><li><h5><?php _e('Email:', 'tkingdom')?></h5><a href="mailto:<?php echo $member_email?>?Subject=Contact%20from%20website"><?php echo $member_email?></a></li><?php }?>
                                    <?php if($member_other){?><li><h5><?php _e('OTHER:', 'tkingdom')?></h5><span><?php echo $member_other?></span></li><?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--COMMENTS-->
                <?php if (comments_open()) : ?>
                    <?php comments_template(); // Get wp-comments.php template  ?>
                <?php endif; ?>

            </div>

            <?php if($sidebar_postition != 'fullwidth'){?>
                <div class="span4 <?php if($sidebar_postition == 'right'){echo 'sidebar-right';}elseif($sidebar_postition == 'left'){echo 'sidebar-left';}?>" id="sidebar">
                    <!-- Sidebar Left -->
                    <?php
                    if ($sidebar_postition == 'left'){
                        echo '<div class="span11 pull-left" style="margin-left:0px;">';
                        tk_get_sidebar('Left', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!-- Sidebar Right -->
                    <?php
                    if ($sidebar_postition == 'right'){
                        echo '<div class="span11 pull-right">';
                        tk_get_sidebar('Right', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!--/sidebar-->
                </div>
            <?php }?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>