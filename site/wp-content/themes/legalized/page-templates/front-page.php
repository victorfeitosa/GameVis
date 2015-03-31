<?php
/*
 Template Name: Front Page Template
 */
 
get_header();

$prefix = 'tk_';
?>

    <?php 
        $hero_heading = get_theme_option(tk_theme_name.'_general_hero_heading');
        if(!empty($hero_heading)){ ?>
        <section>
            <div class="container">
                <h1 class="hero_heading"><?php echo $hero_heading; ?></h1>
            </div>
        </section>
    <?php } ?>


    <!-- SLIDER STARTS -->
    <?php
        $show_slider= get_theme_option(tk_theme_name.'_general_enable_slider');
        $slider_alias = get_theme_option(tk_theme_name.'_general_slider_id');
        if($show_slider == 'yes'){
    ?>

    <section>
        <div class="home-slider">
            <?php if (function_exists('putRevSlider')) { ?>
                <?php putRevSlider($slider_alias);?>
            <?php } ?>
        </div>
    </section>
    <?php } ?>
    <!-- SLIDER ends -->


<!-- CONTENT STARTS -->
<section>
    <div class="container">

        
                <?php
                    $args = array(
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'post_type' => 'page_builder',
                        'order' => 'ASC',
                        'meta_key' => 'tk_box_order',
                        'orderby' => 'meta_value_num',
                    );
                    //The Query
                    $the_query = new WP_Query($args);

                    //The Loop
                    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                    
                            $block_type = get_the_title($post->ID);
                            
                            if ($block_type == 'one_column') {
                                // call part
                                get_template_part('page-templates/_part_onecolumn');
                            } elseif ($block_type == 'two_columns') {
                                // call part
                                 get_template_part('page-templates/_part_twocolumns');
                            } elseif ($block_type == 'three_columns') {
                                // call part
                                get_template_part('page-templates/_part_threecolumns');
                            } elseif ($block_type == 'tabs') {
                                // call part
                                get_template_part('page-templates/_part_tabs');
                            }
                ?>

                <?php                    
                    endwhile;
                    endif;
                ?>

<?php get_footer(); ?>