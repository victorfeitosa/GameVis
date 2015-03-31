<?php get_header();
$prefix = 'tk_';
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
$prev_post = get_previous_post();
$next_post = get_next_post();
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">


            <div class="portfolio-single-title left">
                <span><?php the_title()?></span>
                <ul>
                    <?php echo get_the_term_list( $post->ID, 'ct_projects','' ,', ' ); ?>
                </ul>
            </div><!--/portfolio-single-title-->
            <div class="portfolio-loader" id="portfolio-loader"></div>

            <div class="portfolio-single left">
                <div class="portfolio-images">
                        <?php if (has_post_thumbnail()) { ?>
                            <a href="<?php echo $image[0]; ?>" class="pirobox" title="<?php echo the_title() ?>">
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                            </a>
                        <?php } ?>
                </div><!--/portfolio-images-->
            </div><!--/portfolio-single-->
            
            <div class="portfolio-single-text left">
                        <div class="shortcodes left">
                            <?php
                                wp_reset_query();
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                        the_content();
                                    endwhile;
                                else:
                                endif;
                                wp_reset_query();
                                ?>
                        </div><!--/post-single-text-->
            </div><!--/portfolio-single-text-->
            
            <div class="prev-next left">
                <?php if(!empty($next_post)){?><div class="bg-prev-next"><div class="prev-content left"><a href="<?php echo $next_post->guid; ?>"></a></div></div><?php }?>
                <?php if(!empty($prev_post)){?><div class="bg-prev-next"><div class="next-content left"><a href="<?php echo $prev_post->guid; ?>"></a></div></div><?php }?>
            </div><!--/prev-next-->
            
            

        </div><!--/wrapper-->
    </div><!--/content-->

    
<?php get_footer(); ?>