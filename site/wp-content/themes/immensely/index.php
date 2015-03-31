<?php
get_header();
$blog_id = get_option('id_blog_page');
$sidebar_postition = get_post_meta($blog_id, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($blog_id, 'tk_sidebar', true);
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id($blog_id), 'full');
?>


<div class="blog <?php if($sidebar_postition == 'fullwidth'){echo 'fullwidth';}elseif($sidebar_postition == 'right' ){echo 'sidebar right';}else{echo 'sidebar left';}?> page" id="content">
    
    
    <div class="banner <?php if(!has_post_thumbnail($blog_id)){ echo 'banner-background'; } ?>" style="<?php if(has_post_thumbnail($blog_id)){echo 'background:url('.$title_bg_image[0].') no-repeat center';} ?>">
        <div class="row-fluid">
            <div class="container">
                <h3><?php echo get_the_title($blog_id)?></h3>
                <div class="pull-right"><?php get_template_part('/templates/parts/content', 'breadcrumbs'); ?></div>
            </div>
        </div>
    </div>
    
        <div class="row-fluid">
        <div class="container">
            
            
            <div class="row-fluid">
                <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'right' ){echo 'span9';}else{echo 'span9 pull-right';}?>">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args = array('post_status' => 'publish', 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                    // The Query
                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <?php
                        if (get_post_format()) {
                            $post_format = get_post_format();
                        } else {
                            $post_format = 'standard';
                        }
                        get_template_part('/templates/parts/format', $post_format); ?>
                    <?php endwhile; ?>
                    <?php endif;?>
                    <?php if($the_query->max_num_pages > 1){?>
                        <div class="pagination pagination-right">
                            <?php tk_pageing($the_query)?>
                        </div>
                    <?php }?>
                </div>
    
                <?php if($sidebar_postition != 'fullwidth'){?>
                    <!-- Sidebar Left -->
                    <?php
                    if ($sidebar_postition == 'left'){
                        echo '<div class="span3 pull-left" id="sidebar">';
                        tk_get_sidebar('Left', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!-- Sidebar Right -->
                    <?php
                    if ($sidebar_postition == 'right'){
                        echo '<div class="span3 pull-right" id="sidebar" >';
                        tk_get_sidebar('Right', $sidebar_selected);
                        echo '</div>';
                    }
                    ?>
                    <!--/sidebar-->
                <?php } ?>
            </div>
            
        </div>
    </div>
</div>
    
<?php get_footer(); ?>    