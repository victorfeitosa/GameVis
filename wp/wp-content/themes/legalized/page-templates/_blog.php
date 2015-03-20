<?php
/*

Template Name: Blog

*/
get_header();

$prefix = 'tk_';

/* Sidebar position */
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}

/* Content padding */
if ($sidebar_postition == 'right'){
    $padding = 'style="padding-right:20px;"';
}else if($sidebar_postition == 'left'){
    $padding = 'style="padding-left:20px;"';
}else{
    $padding = '';
}

/* Selected sidebar */
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);

/* Blog Page subtitle */
$page_headline = get_post_meta($post -> ID, $prefix . 'headline', true);

?>



<!-- CONTENT STARTS -->
<section>
    <div class="container">


        <!-- Page Title -->
        <div class="row-fluid">
            <div class="span12">
                <h1 class="page_title"><?php the_title(); ?></h1>
                <?php if ($page_headline !== '') { ?>
                    <h2 class="page_description"><?php echo $page_headline ?></h2>
                <?php } ?>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" alt="separator" />
            </div>
        </div>
        <br>



        <!-- Page Content -->
        <div class="row-fluid">


            
            <!-- Main Content -->
            <div id="content" class="<?php if($sidebar_postition == 'right'){echo 'span8 pull-left';}elseif($sidebar_postition == 'left'){echo 'span8 pull-right';}elseif($sidebar_postition == 'fullwidth'){echo 'span12';}?>">
                
                <article class="blog_post blog_listing" <?php echo $padding; ?>>  
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

                        endwhile; 
                        endif; 
                    ?>
                </article>

                <!--PAGINATION-->
                <div class="pagination">
                    <?php
                        global $wp_query;

                        $big = 999999999; // need an unlikely integer

                        $pageing =  paginate_links( array(
                                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                'format' => '?paged=%#%',
                                'prev_text'    => __('Prev', tk_theme_name),
                                'next_text'    => __('Next', tk_theme_name),
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages
                        ) );
                        echo $pageing;
                    ?>
                </div><!--/pagination-->
                <div class="clear"></div>
            </div><!-- #content -->



            <!-- Sidebar Left -->
            <?php 
                if ($sidebar_postition == 'left'){
                    echo '<div class="span4 pull-left" style="margin-left:0px;">';
                        tk_get_sidebar('Left', $sidebar_select);
                    echo '</div>';
                }
            ?>


            <!-- Sidebar Right -->
            <?php 
                if ($sidebar_postition == 'right'){
                    echo '<div class="span4 pull-right">';
                        tk_get_sidebar('Right', $sidebar_select);
                    echo '</div>';
                }
            ?>
            
        </div><!-- row-fluid -->


<?php get_footer(); ?>