<?php 

get_header();

$prefix = 'tk_';

$sidebar_postition = get_theme_option(tk_theme_name. '_general_archive_sidebar');
if($sidebar_postition == ''){$sidebar_postition = 'right';}

/* Content padding */
if ($sidebar_postition == 'right'){
    $padding = 'style="padding-right:20px;"';
}else if($sidebar_postition == 'left'){
    $padding = 'style="padding-left:20px;"';
}else{
    $padding = '';
}

?>


<!-- CONTENT STARTS -->
<section>
    <div class="container">

        <!-- Archive Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <h1 class="page_title"><?php _e('Archive', tk_theme_name) ?></h1>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" />
                </div>
            </div>
            <br>

            <!-- Page Content -->
            <div class="row-fluid">



                <!-- Main Content -->
                <div id="content" class="<?php if($sidebar_postition == 'right'){echo 'span8 pull-left';}elseif($sidebar_postition == 'left'){echo 'span8 pull-right';}elseif($sidebar_postition == 'fullwidth'){echo 'span12';}?>">
                    
                    <article class="blog_post blog_listing" <?php echo $padding; ?>> 
                        <?php
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();
                            $format = get_post_format();
                            $categories = wp_get_post_categories($post -> ID);
                            $count = count($categories);
                            $i = 1;

                            //Get post loop
                            get_template_part('page-templates/_part_loop');

                            endwhile; 
                            endif; 
                        ?>
                    </article>

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

                </div><!-- /content-->
                


                <!-- Sidebar Left -->
                <?php 
                    if ($sidebar_postition == 'left'){
                        echo '<div id="sidebar" class="span4 pull-left" style="margin-left:0px;">';
                            dynamic_sidebar('Archive/Search');
                        echo '</div>';
                    }
                ?>


                <!-- Sidebar Right -->
                <?php 
                    if ($sidebar_postition == 'right'){
                        echo '<div id="sidebar" class="span4 pull-right">';
                            dynamic_sidebar('Archive/Search');
                        echo '</div>';
                    }
                ?>


            </div><!-- row-fluid -->

<?php get_footer(); ?>
