<?php 
/*

Template Name: Testimonials

*/
get_header();
$prefix = 'tk_';
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$heading_background = get_post_meta($post->ID, $prefix.'background_color', true);
$heading_title_color = get_post_meta($post->ID, $prefix.'headline_color', true);
?>

        <!-- Page Headline -->
        <div class="title-pages left">
                <div class="title-pages-image left" style="<?php if(has_post_thumbnail()){echo 'background:url('.$title_bg_image[0].')';} else { echo 'background:#'.$heading_background; } ?>"></div>
                <div class="wrapper">
                    <span style="<?php echo 'color:#'.$heading_title_color; ?>"><?php the_title()?></span>
                    <?php
                    $page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
                    if ($page_headline !== "") { ?>
                    <p style="<?php echo 'color:#'.$heading_title_color; ?>"><?php echo $page_headline ?></p>
                    <?php } /*-- /page headline --*/?>
                </div>
        </div><!--/title-pages-->
        <div class="bottom-slider-red"></div><!--/bottom-slider-red-->

        
    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">


                <div class="content-left <?php if($sidebar_postition == 'right'){echo 'left';}elseif($sidebar_postition == 'left'){echo 'right';}elseif($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">

                    <div class="shortcodes left"> 
                        <?php
                        wp_reset_query();
                        if (have_posts()) : while (have_posts()) : the_post();
                                the_content();
                            endwhile;
                        else:
                        endif;
                        wp_reset_query();
                        ?>
                    </div><!-- /shortcodes -->      
                    
                    <div class="page-testimonials left">

                        <?php

                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                            $args=array('post_status' => 'publish', 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1, 'post_type' => 'testimonials', 'paged' => $paged);

                            //The Query
                            query_posts($args);

                            //The Loop
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                            $name_user = get_post_meta($post->ID, $prefix.'name', true);
                            $avatar = get_avatar( $email_avatar, 74);

                        ?>

                        <div class="home-testimonials-one left">
                            <?php if(isset($avatar)){ ?>
                            <div class="home-testimonials-one-image left"><?php echo $avatar; ?></div><!--/home-testimonials-one-image-->
                            <?php } ?>
                            <div class="home-testimonials-one-title right">
                                <span><?php the_title();?></span>
                                <p><?php echo $name_user;?></p>
                            </div><!--/home-testimonials-one-title-->
                            <div class="home-testimonials-one-text left">
                                <p><?php the_content();?></p>
                            </div><!--/home-testimonials-one-text-->
                        </div><!--/home-testimonials-one-->
                            

                        <?php endwhile; endif; ?>

                    </div><!--/page-testimonials-->


                    <!--PAGINATION-->
                    <div class="pagination left">
                        <?php
                            global $wp_query;

                            $big = 999999999; // need an unlikely integer

                            $pageing =  paginate_links( array(
                                    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                    'format' => '?paged=%#%',
                                    'current' => max( 1, get_query_var('paged') ),
                                    'total' => $wp_query->max_num_pages
                            ) );
                            echo $pageing;
                        ?>
                    </div><!--/pagination-->

                </div><!--/content-left-->

                <!-- Sidebar -->
                <?php if($sidebar_postition == 'right'){
                    tk_get_sidebar('Right', $sidebar_select);
                }elseif($sidebar_postition == 'left'){
                    tk_get_sidebar('Left', $sidebar_select);
                }
                ?>

            </div><!-- /content-full -->
        </div><!--/wrapper-->        
    </div><!--/content-->

<?php get_footer(); ?>
