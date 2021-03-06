<?php get_header();
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_general_search_sidebar');
?>

<div id="content">

    <div class="banner banner-background">
        <div class="row-fluid">
            <div class="container">
                <h3><?php _e('Search', 'tkingdom'); ?></h3>
                <div class="pull-right">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo home_url(); ?>"><?php _e('Home', 'tkingdom'); ?></a></li>
                        <span class="divider"><i class="fa fa-circle"></i></span>
                        <li class="active"><?php printf( __('Search Results for: %s', 'tkingdom'),'' . get_search_query() . ''); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="container">
            

                <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'right' ){echo 'span9';}else{echo 'span9 pull-right';}?>">
                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        if (get_post_format()) {
                            $post_format = get_post_format();
                        } else {
                            $post_format = 'standard';
                        }
                        get_template_part('/templates/parts/format', $post_format); ?>
                    <?php endwhile; ?>
                    <?php else : ?>
                        <h1><?php _e('No Results Found', 'tkingdom'); ?></h1>
                    <?php endif;?>
                    <?php if($wp_query->max_num_pages > 1){?>
                        <div class="pagination pagination-right">
                            <?php tk_pageing($wp_query)?>
                        </div>
                    <?php }?>
                </div>

                <?php if($sidebar_postition != 'fullwidth'){?>
                        <!-- Sidebar Left -->
                        <?php
                        if ($sidebar_postition == 'left'){
                            echo '<div class="span3 pull-left" id="sidebar" style="margin-left: 0">';
                            tk_get_sidebar('Left', 'Archive/Search');
                            echo '</div>';
                        }
                        ?>
                        <!-- Sidebar Right -->
                        <?php
                        if ($sidebar_postition == 'right'){
                            echo '<div class="span3 pull-right" id="sidebar">';
                            tk_get_sidebar('Right', 'Archive/Search');
                            echo '</div>';
                        }
                        ?>
                        <!--/sidebar-->
                <?php }?>


        </div>
    </div>
</div>    
<?php get_footer(); ?>