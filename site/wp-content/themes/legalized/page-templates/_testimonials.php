<?php 
/*

Template Name: Testimonials

*/
get_header();

$prefix = 'tk_';

/* Page subtitle */
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);

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

?>



<!-- CONTENT STARTS -->
<section>
    <div class="container">

        <!-- Page Title -->
        <div class="row-fluid">
            <div class="span12">
                <h1 class="page_title"><?php the_title(); ?></h1>
                <?php if ($page_headline !== "") { ?>
                    <h2 class="page_description"><?php echo $page_headline ?></h2>
                <?php } ?>
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

                <div <?php echo $padding; ?>> 

                    <?php 
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                        the_content();
                        endwhile; endif; wp_reset_query();
                    ?> 

                    <?php

                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args = array('post_status' => 'publish', 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1, 'post_type' => 'testimonials', 'paged' => $paged);

                        //The Query
                        query_posts($args);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                        $name_user = get_post_meta($post->ID, $prefix.'job_position', true);
                        $avatar = get_avatar( $email_avatar, 72);

                    ?>  


                    <div class="row-fluid">
                        <div class="span12 vertical_tabs_content tab_testimonial rounded">
                            <?php if ($email_avatar) {
                                    if(isset($avatar)){ ?>
                                        <div class="gravatar rounded"><?php echo $avatar; ?></div>
                            <?php } } ?>
                            <h3><?php the_title();?></h3>
                            <span class="by"><?php echo $name_user ?></span>
                            <div class="clear"></div>
                            <div class="row-fluid">
                                <div class="span12 testimonials_heading">                                   
                                </div>
                            </div>
                            <?php the_content();?>
                        </div>
                    </div>
                    <?php endwhile; endif; wp_reset_query(); ?>



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

                </div><!-- div with padding ends --> 


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
