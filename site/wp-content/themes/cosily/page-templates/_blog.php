<?php 
/*

Template Name: Blog

*/
get_header();
$prefix = 'tk_';
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);

/*--Page Headline--*/
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
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

                            <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                            $args = array('post_status' => 'publish', 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();
                            $format = get_post_format();
                            $categories = wp_get_post_categories($post -> ID);
                            $count = count($categories);
                            $i = 1;
                            
                            //Get Post Loop
                            get_template_part('page-templates/_part_loop');
                            
                            endwhile; endif; ?>

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
                        
                    </div><!-- /content-left -->
                
                    <!-- Sidebar -->
                    <?php                     
                    if($sidebar_postition == 'right'){
                        tk_get_sidebar('Right', $sidebar_select);
                    }elseif($sidebar_postition == 'left'){
                        tk_get_sidebar('Left', $sidebar_select);
                    }
                    ?>
                    
            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->
    
    <?php get_footer(); ?>