<?php
get_header();
$prefix = 'tk_';
$cur_cat_id = get_cat_id( single_cat_title("",false) );
$cur_category = get_cat_name( $cur_cat_id );
$category_color = get_option('category_'.$cur_cat_id);
$category_display = get_option("category_display_$cur_cat_id");
$post_id = $cur_cat_id;
?>

<!-- CONTENT -->
<div class="content left category-page">
    <div class="wrapper">
        <div class="content-full left">

            <div class="content-left left">

                <div class="category-content left">
                    <div class="design-home-title-top left" style="border-right: 10px solid #<?php echo $category_color['color']?>;"><?php echo $cur_category?></div><!--/design-home-title-top-->
                    <div class="menu-content right">
                        <nav>
                            <ul class="sf-menu">

                                <li><a><img src="<?php echo get_template_directory_uri()?>/style/img/menu-content-img.png" alt="img" title="img" /></a>
                                    <ul class="sub-menu">
                                        <?php $args = array(
                                                'orderby'            => 'name',
                                                'order'              => 'ASC',
                                                'style'              => 'list',
                                                'title_li'           => __( '', tk_theme_name ),
                                                'show_option_none'   => __('', tk_theme_name),
                                                'number'             => null,
                                                'echo'               => 1,
                                                'taxonomy'           => 'category',
                                        ); 
                                        wp_list_categories( $args );
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div><!--/menu-content-->
                </div><!--/category-content-->

            <?php 
                // GET STICKY POST
                get_template_part('_part_sticky_post');
            ?>
                
            <?php 
            //Check the look of category page

            if($category_display == false || $category_display == 'one-column'){?>
                <div class="design-home left">
                    <div class="design-home-images left" style="width:100%;margin:0">
                        <?php
                        wp_reset_postdata();
                        $i = 1;
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args=array('cat' => $cur_cat_id, 'post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'post__not_in' => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 1);

                        //The Query
                        query_posts($args);

                        //The Loop
                        if (have_posts()) : while (have_posts()) : the_post();
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'one-column-side');
                                $format = get_post_format();
                                $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                                $post_title = get_the_title();
                                $post_category = wp_get_post_categories( $post->ID );

                                // GET POST LOOP
                                get_template_part('_part_one_column_loop');
                
                                $i++;
                                wp_reset_postdata();
                            endwhile;
                        endif;
                        ?>
                    </div><!--/design-home-images-->
                </div><!--/design-home-->
                
            <?php }elseif($category_display != FALSE && $category_display == 'two-columns'){?>
                <div class="design-home left">
                    <div class="design-home-images left">
                        <?php
                        wp_reset_postdata();
                        $i = 1;
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args=array('cat' => $cur_cat_id, 'post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'post__not_in' => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 1);

                        //The Query
                        query_posts($args);

                        //The Loop
                        if (have_posts()) : while (have_posts()) : the_post();
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'two-columns-top');
                                $format = get_post_format();
                                $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                $check_rating = get_post_meta($post->ID, $prefix.'enable_rating', true);
                                $post_title = get_the_title();
                                $post_category = wp_get_post_categories( $post->ID );
                                $category_color = get_option('category_'.$post_category[0]);

                                // GET POST LOOP
                                get_template_part('_part_two_column_loop');
                                
                                $i++;
                                wp_reset_postdata();
                            endwhile;
                        endif;
                        ?>
                    </div><!--/design-home-images-->
                </div><!--/design-home-->
                
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        var container = jQuery('.design-home-images');
                        jQuery(container).imagesLoaded(function(){
                            jQuery(container).isotope({
                                layoutMode:'fitRows',
                                itemSelector:'.design-home-images-one',
                                isAnimated:true,
                                animationEngine:'jquery',
                                animationOptions:{
                                    duration:800,
                                    easing:'easeOutCubic',
                                    queue:false
                                }
                            });
                        });
                    });
                </script>

            <?php }?>

                <div class="pagination left">
                    <?php
                    global $wp_query;
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $wp_query->max_num_pages
                    ));
                    ?>
                </div><!--/pagination-->

            </div><!--/content-left-->

        <?php
            $category = get_category( get_query_var( 'cat' ) );
            $cat_id = $category->cat_ID;
            $cat_option = get_option('sidebar_' . $cat_id);
            /* include sidebar */
            tk_get_sidebar('Right', $cat_option['sidebar']);
            ?>

        </div><!--/content-full-->
    </div><!--/wrapper-->
</div><!--/content-->

<?php get_footer(); ?>