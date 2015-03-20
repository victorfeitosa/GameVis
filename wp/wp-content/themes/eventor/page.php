<?php
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_position == ''){$sidebar_position = 'right';}
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
?>

    <!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <!-- Page Headline-->
            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php the_title(); ?></h1>
                        <?php if ($page_headline !== '') { ?>
                        <span><?php echo '| ' . $page_headline ?></span>
                        <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->

            <!-- Page Content -->
            <div class="blog-holder left">
              <div class="blog-content <?php if($sidebar_position == 'right'){echo 'left';}elseif($sidebar_position == 'left'){echo 'right';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
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
                    
                </div><!-- /blog-holder -->

                <div class="<?php if($sidebar_position == 'right'){echo 'right';}elseif($sidebar_position == 'left'){echo 'left';}elseif($sidebar_position == 'fullwidth'){echo 'no-sidebar';}?>">
                <!-- Sidebar -->
                <?php                     

                if($sidebar_position == 'right'){
                    tk_get_sidebar('Right', $sidebar_select);
                }elseif($sidebar_position == 'left'){
                    tk_get_sidebar('Left', $sidebar_select);
                }
                ?>
                </div>
                            </div><!-- /blog-content -->

            
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>