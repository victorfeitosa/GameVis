<?php
get_header();
$prefix = 'tk_';
?>

<?php 
// get main slider and followers
get_template_part('_part_main_slider');
?>

<!-- CONTENT -->
<div class="content left">
    <div class="wrapper">
        <div class="content-full left">

            <div class="content-left left">
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
                        if ($block_type == 'Flex Slider') {
                            // call part
                            get_template_part('_part_flex_slider');
                        } elseif ($block_type == 'Caruousel Slider') {
                            // call part
                            get_template_part('_part_carousel_slider');
                        } elseif ($block_type == 'Ad Banner') {
                            // call part
                            get_template_part('_part_ad_banner');
                        } elseif ($block_type == 'Page Content') {
                            // call part
                            get_template_part('_part_page_content');
                        } elseif ($block_type == 'Full Width Post Type 1') {
                            // call part
                            get_template_part('_part_one_cat_top');
                        } elseif ($block_type == 'Full Width Post Type 2') {
                            // call part
                            get_template_part('_part_one_cat_side');
                        } elseif ($block_type == 'Two Columns From One Category Type 1') {
                            // call part
                            get_template_part('_part_two_col_top_one_cat');
                        } elseif ($block_type == 'Two Columns From Two Categories Type 1') {
                            // call part
                            get_template_part('_part_two_col_top_two_cat');
                        } elseif ($block_type == 'Two Columns From One Category Type 2') {
                            // call part
                            get_template_part('_part_two_col_side_one_cat');
                        } elseif ($block_type == 'Two Columns From Two Categories Type 2') {
                            // call part
                            get_template_part('_part_two_col_side_two_cat');
                        }
                        ?>

                        <?php
                        wp_reset_query();
                    endwhile;
                endif;
                ?>
            </div><!--/content-left-->

                <?php
                /* include sidebar */
                tk_get_sidebar('Right', 'Home/Index');
                ?>

        </div><!--/content-full-->
    </div><!--/wrapper-->
</div><!--/content-->

<?php get_footer(); ?>