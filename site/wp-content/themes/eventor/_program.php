<?php
/*

Template Name: Program

*/
get_header();
$prefix = 'tk_';
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);
?>

<!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <!-- Page Headline-->
            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php the_title(); ?></h1>
                        <?php if ($page_headline !== '') { ?>
                        <span><?php echo '| ' . $page_headline ?></span>
                        <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->


                <?php //Page Content
                    if(!empty($post->post_content)) { ?>
                        <div class="blog-holder left">
                            <div class="shortcodes">
                                <?php
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                    the_content();
                                endwhile; endif;
                                ?>
                            </div><!--/contact-text-->
                        </div><!--/gallery-text-->
                <?php } ?>
            

            <div class="blog-holder left">
                <div class="shortcodes">


                <?php 
                $args=array(
                        'orderby' => 'id',
                        'order' => 'DESC',
                        'taxonomy' => 'ct_program',
                );
                $categories=get_categories($args);
                foreach($categories as $category) {
                    $check_posts = array('post_type' => 'pt_program', 'post_status' => 'publish', 'orderby' => 'meta_value', 'meta_key' => 'tk_program_time', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'ct_program', 'field' => 'term_id', 'terms' => $category -> term_id)));
                    $check_cat = new WP_Query();
                    $check_cat->query($check_posts);
                    if (!empty($check_cat->posts)) {?>
                <div class="bg-program left">
                    <div class="bg-program-top left">
                        <div class = "program-cat"><?php echo $category->name;?></div>
                    </div><!-- /bg-program-top -->
                    <div class="bg-program-center left">
                        <?php
                        $post_counter = 1;
                        while($check_cat->have_posts()) : $check_cat->the_post();
                        $post_hour = get_post_meta($post->ID, $prefix.'program_time-hour', true);
                        $post_minute = get_post_meta($post->ID, $prefix.'program_time-minute', true);
                        $post_time_ampm = get_post_meta($post->ID, $prefix.'program_time-ampm', true);
                        ?>
                        <div class="program-one left">
                            <div class="program-bg left">
                                <div class="program-title left"><?php echo $post_hour.':'.$post_minute;if($post_time_ampm != '24h'){echo ' '.$post_time_ampm;}?> <?php the_title()?></div>
                            </div><!-- /program-bg -->
                                        <?php the_content()?>
                        </div><!-- /program-one -->
                        
                                    <?php $post_counter++;
                        endwhile;?>
                                    </div>
                                    <div class="bg-program-down left"><img src="<?php echo get_template_directory_uri(); ?>/style/img/bg-program-down.png" alt="img" title="img" /></div><!-- /bg-program-down -->

                                </div><!-- /bg-program-center -->

                                        <?php }?>
                    <?php }?>
                </div><!-- /shortcodes -->
            </div><!-- /blog-holder -->

        
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
            
        </div><!--/wrapper-->
    </div><!--/content-->
<div class="bg-down-container left"></div>

<?php get_footer(); ?>