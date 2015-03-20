<?php 
/*

Template Name: Team Members

*/
get_header(); 

$prefix = 'tk_';

/* Page subtitle */
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);

/* Team member featured image */
$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

?>



<!-- CONTENT STARTS -->
<section>
    <div class="container">


            <!-- Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <h1 class="page_title"><?php the_title(); ?></h1>
                    <?php if ($page_headline !== "") { ?>
                        <h2 class="page_description"><?php echo $page_headline ?></h2>
                    <?php } ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" />
                </div>
            </div>
            <br>



            <div id="content">

                <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content();
                    endwhile; endif; wp_reset_query();
                ?> 

                

                <?php                         
                    $args = array('post_type' => 'team-members', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => -1);
                    
                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $post_category = wp_get_post_terms( $post->ID, 'ct_members' );
                    $format = get_post_format();
                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'team');
                    $tk_member_title = get_post_meta($post->ID, $prefix.'title_info', true);
                    $tk_member_flickr = get_post_meta($post->ID, $prefix.'flickr', true);
                    $tk_member_instagram = get_post_meta($post->ID, $prefix.'instagram', true);
                    $tk_member_twitter = get_post_meta($post->ID, $prefix.'twitter', true);
                    $tk_member_facebook = get_post_meta($post->ID, $prefix.'facebook', true);
                    $tk_member_linkedIn = get_post_meta($post->ID, $prefix.'linkedIn', true);                            
                    $featured_right = get_post_meta($post->ID, $prefix.'featured_right', true);    
                ?>

                <div class="row-fluid">


                    <div class="span8 team_member_info <?php if(empty($featured_right)) { echo 'pull-right'; }else{ echo 'pull-left'; }?>">
                        <div class="our-team-page-one-title left">
                            <a id="<?php echo $post->post_title; ?>"></a>
                        </div><!--/our-team-page-one-ttitle-->

                        <?php the_content(); ?>

                        <?php if(!empty($tk_member_flickr) || !empty($tk_member_instagram) || !empty($tk_member_twitter) || !empty($tk_member_facebook) || !empty($tk_member_linkedIn)){ ?>
                            <div class="meet_me_wrap rounded pull-left">
                                <span class="red pull-left small"><?php echo __('Meet me here:', tk_theme_name); ?></span>
                                <ul class="social pull-left rounded">
                                    <?php if(!empty($tk_member_flickr)){ ?><li><a href="<?php echo $tk_member_flickr; ?>" class="social_flickr dark"></a></li><?php } ?>
                                    <?php if(!empty($tk_member_instagram)){ ?><li><a href="<?php echo $tk_member_instagram; ?>" class="social_instagram dark"></a></li><?php } ?>
                                    <?php if(!empty($tk_member_twitter)){ ?><li><a href="<?php echo $tk_member_twitter; ?>" class="social_twitter dark"></a></li><?php } ?>
                                    <?php if(!empty($tk_member_facebook)){ ?><li><a href="<?php echo $tk_member_facebook; ?>" class="social_facebook dark"></a></li><?php } ?>
                                    <?php if(!empty($tk_member_linkedIn)){ ?><li><a href="<?php echo $tk_member_linkedIn; ?>" class="social_linkedin dark"></a></li><?php } ?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>

                    </div><!--/team_member_info-->


                    <!-- Team member img right -->
                    <?php if(empty($featured_right)) { ?>
                        <div class="span4 team_member pull-left" style="margin-left:0;">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="team-images">
                                    <a href="<?php echo $image[0]; ?>" class="fancybox"><?php the_post_thumbnail(); ?></a>
                                    <div class="team_img_hover rounded"><a class="fancybox img_plus" href="<?php echo $image[0]; ?>"></a></div>
                                </div>
                            <?php } ?>
                            <h3><?php the_title(); ?></h3>
                            <span class="member_title"><?php if(!empty($tk_member_title)){ echo $tk_member_title; } ?></span>
                        </div><!--/span4 team_member-->
                    <?php } ?>


                    <!-- Team member img left -->
                    <?php if(!empty($featured_right)) { ?>
                        <div class="span4 team_member pull-right">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="team-images">
                                    <a href="<?php echo $image[0]; ?>" class="fancybox"><?php the_post_thumbnail(); ?></a>
                                    <div class="team_img_hover rounded"><a class="fancybox img_plus" href="<?php echo $image[0]; ?>"></a></div>
                                </div>
                            <?php } ?>
                            <h3><?php the_title(); ?></h3>
                            <span class="member_title"><?php if(!empty($tk_member_title)){ echo $tk_member_title; } ?></span>
                        </div><!--/span4 team_member-->
                    <?php } ?>

                </div><!--/row-fluid -->



                <div class="row-fluid">
                    <div class="span12">
                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" class="separator" />
                    </div>
                </div>



            <?php endwhile; endif; wp_reset_query(); ?>


        </div><!--/content -->


<?php get_footer(); ?>