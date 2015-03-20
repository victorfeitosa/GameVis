<?php
/*

Template Name: Services

*/
get_header();

$prefix = 'tk_';

$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);


/* Service page sidebar */
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}


/* Selected sidebar */
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);

?>




<!-- CONTENT STARTS -->
<section>
    <div class="container">

            <!-- Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <?php if (is_front_page()) { ?>
                        <h1 class="hero_heading"><?php echo $page_headline ?></h1>
                    <?php } else { ?>
                        <h1 class="page_title"><?php the_title(); ?></h1>
                        <?php if ($page_headline !== '') { ?>
                            <h2 class="page_description"><?php echo $page_headline ?></h2>
                        <?php } ?>
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
                       
                    <div>   

                        <?php 
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                            the_content();
                            endwhile; endif; wp_reset_query();
                        ?> 

                        <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                            $args = array('post_status' => 'publish', 'post_type' => 'services', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();

                            $categories = wp_get_post_categories($post -> ID);
                            $count = count($categories);
                            $i = 1;
                                                                  
                            $tk_background_color = get_post_meta($post->ID, $prefix.'background_color', true);
                            $tk_headline_color = get_post_meta($post->ID, $prefix.'headline_color', true);
                            $tk_text_color = get_post_meta($post->ID, $prefix.'text_color', true);    
                            
                            /* Service small featured image */
                            $featured_service_img = get_post_meta($post->ID, $prefix.'featured_service', true);
                        ?>

                        <article class="service_wrap service-<?php echo $post->ID; ?> rounded" style="padding: 30px; background: #<?php echo $tk_background_color;?>; color: #<?php echo $tk_headline_color; ?>; margin-bottom: 40px;">
                            <?php if ($featured_service_img !== '') { ?>
                                <img class="service_small_featured" src="<?php echo $featured_service_img; ?>" width="86" />
                            <?php } ?>
                            <h2 <?php if ($featured_service_img == '') { echo 'style="margin-top: 0;"'; } ?>><a href="<?php the_permalink(); ?>" style="color: #<?php echo $tk_headline_color ; ?>;"><?php the_title(); ?></a></h2>
                            <div class="clear"></div>
                            <p style="color: #<?php echo $tk_text_color; ?>;"><?php the_excerpt_length(109); ?></p>
                            <a class="read_more" href="<?php the_permalink(); ?>" style="color: #<?php echo $tk_headline_color ; ?>;"><?php _e('Read More', tk_theme_name); ?></a>     
                        </article>

                        <?php endwhile; endif; ?>


                        <!--PAGINATION-->
                        <div class="pagination">
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

                        <?php wp_reset_query(); ?>

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