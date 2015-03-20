<?php
$prefix = 'tk_';
$blog_id = get_option('id_blog_page');
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog_id ), 'full');
$sidebar_selected = get_post_meta($post->ID, 'tk_sidebar', true);
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
$disable_banner = get_post_meta($blog_id, 'tk_disable_title', true);
?>

<?php if($disable_banner == '') { ?>
    <div class="blog-single sidebar <?php if($sidebar_postition == 'left') { echo 'left' ;} else { echo 'right' ;}?> page" id="content">    

        <div class="banner banner-background" style="<?php if(has_post_thumbnail($blog_id)){echo 'background:url('.$title_bg_image[0].') no-repeat center';} ?>">
            <div class="row-fluid">
                <div class="container">
                    <h3 class="BeanFadeDown"><?php echo get_the_title($blog_id)?></h3>
                    <div class="pull-right BeanFadeDown">
                        <?php 
                            if ( function_exists('yoast_breadcrumb') ) { //Yoast SEO plugin breadcrumbs 
                                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                                } else {
                                    get_template_part('/templates/parts/content', 'breadcrumbs'); 
                                }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php } else {?>
    <div class="no-banner-spacing"></div>
<?php } ?>    

        <div class="container">
            <div class="row-fluid">
                <div class="shortcodes <?php if($sidebar_postition == 'fullwidth') { echo '';} elseif($sidebar_postition == 'left') {echo 'span9 pull-right clearfix';} else {echo 'span9';}?>">
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
                    <?php endif; ?>
                    <!--COMMENTS-->
                    <?php if (comments_open()) : ?>
                        <?php comments_template(); // Get wp-comments.php template  ?>
                    <?php endif; ?>
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