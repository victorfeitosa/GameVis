<?php
/*

Template Name: Program

*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta($post->ID, $prefix.'sidebar_position', true);

?>

<!-- CONTENT -->
    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
           <?php  tk_get_left_sidebar($sidebar_position, 'Program Template'); ?>

           <div class="page-content left">
               <div class="program-content left">

                    <div class="shortcodes left">

                    <?php
                    $args=array(
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'taxonomy' => 'program'
                    );
                    $categories=get_categories($args);
                    foreach($categories as $category) {
                        $paged = get_theme_option(tk_theme_name.'_general_program_per_page');
                        $check_posts = array('post_type' => 'pt_program', 'post_status' => 'publish', 'tax_query' => array(array('taxonomy' => 'program','field' => 'term_id', 'terms' => $category->term_id)), 'order' => 'ASC', 'posts_per_page' => $paged );
                        $check_cat = new WP_Query();
                        $check_cat->query($check_posts);

                        if (!empty($check_cat->posts)) {?>
                    <div class="bg-program left">
                        <div class="bg-program-top left">
                            <div class = "program-bg-title left"><?php echo $category->name;?></div>
                        </div><!-- /bg-program-top -->
                        <div class="bg-program-center left">

                                    <?php
                                    $post_counter = 1;
                                    while($check_cat->have_posts()) : $check_cat->the_post();?>
                                <div class="program-one left">
                                <div class="program-title left">
                                       <span><?php echo get_post_meta($post->ID, $prefix.'program_time', true); ?></span>
                                       <div class="headline"><?php the_title(); ?></div>
                                </div><!-- /program-bg -->
                                            <?php the_content()?>
                            </div><!-- /program-one -->
                                        <?php $post_counter++;
                            endwhile;?>
                                        </div>
                                        <div class="bg-program-down left"></div><!-- /bg-program-down -->

                                    </div><!-- /bg-program-center -->

                                            <?php }?>
                        <?php }?>

                    </div><!-- /bg-program -->

              </div><!--/program-content-->
           </div><!-- program content -->

             <?php  tk_get_right_sidebar($sidebar_position, 'Program Template'); ?>

        </div><!--/wrapper-->
    </div><!--/content-->
<div class="bg-down-container left"></div>



<?php get_footer(); ?>
