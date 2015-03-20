<?php
$sidebar_position = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<?php if(has_post_thumbnail()) {
    the_post_thumbnail();
} ?>

<div id="main-wrapper">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
        <div class="row">
            <div class="shortcodes <?php if($sidebar_position == 'fullwidth'){echo 'col-xs-12 ';}elseif($sidebar_position == 'left'){echo 'col-md-9 pull-right';}else{echo 'col-md-9';}?>">
                <h1 class="page-title"><?php the_title(); ?></h1>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php endif;?>
            </div>


            <?php if($sidebar_position != 'fullwidth'){?>
                <!-- Sidebar Left -->
                <?php

                if ($sidebar_position == 'left'){
                    echo '<div class="col-md-3 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                    tk_get_sidebar('Left', $sidebar_selected);
                    echo '</div></div>';
                }
                ?>
                <!-- Sidebar Right -->
                <?php
                if ($sidebar_position == 'right'){
                    echo '<div class="col-md-3 pull-right" id="sidebar" ><div class="sidebar-content">';
                    tk_get_sidebar('Right', $sidebar_selected);
                    echo '</div></div>';
                }
                ?>
                <!--/sidebar-->
            <?php } ?>
        </div>
    </div>
</div>