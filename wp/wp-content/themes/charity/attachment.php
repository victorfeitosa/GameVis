<?php get_header(); ?>

<?php
$tk_page_id = get_option('id_events_page');
$sidebar_postition = 'full';
$sidebar_selected = '';
$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
?>
    <div class="row-fluid">
        <div class="container">

            <h1 class="title-divider">
                <span><?php echo get_the_title($wp_query->post->ID)?></span>
                <?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?>
            </h1>

            <div class="row-fluid">
                <div class="span8 events-page event-single-page">
                    <div class="blog-images left"><a href="<?php echo $image_full[0]?>" class="fancybox" title="<?php the_title()?>" alt="<?php the_title()?>"><img src="<?php echo $image_full[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"/></a></div><!--/blog-images-->
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