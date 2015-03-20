<?php get_header();
$sidebar_position = get_theme_option(wp_get_theme()->name . '_general_archive_sidebar');
$cur_cat_id = get_cat_id( single_cat_title("",false) );
$cur_category = get_cat_name( $cur_cat_id );
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
$cat_option = get_option('sidebar_' . $cat_id);
$post_id = $cur_cat_id;
$position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<div id="main-wrapper">
  <div class="archive">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
        <div class="row">
            <div class="<?php if($sidebar_position == 'fullwidth'){echo '';}elseif($sidebar_position == 'left'){echo 'col-md-9 pull-right';}else{echo 'col-md-9';}?>">

                <h1 class="page-title"><?php echo single_cat_title( '', false ); ?></h1>


                        <?php

                            $sticky = get_option('sticky_posts');
                            // check if there are any
                            if (!empty($sticky)) {
                                // optional: sort the newest IDs first
                                rsort($sticky);
                                // override the query
                                $args = array(
                                    'cat' => $cat_id,
                                    'post__in' => $sticky
                                );
                            

                            $the_query = new WP_Query($args);
                            if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                        ?>

                        <?php
                            if (get_post_format()) {
                                $post_format = get_post_format();
                            } else {
                                $post_format = 'standard';
                            }
                            get_template_part('/templates/parts/format', $post_format); ?>
                        <?php endwhile; ?>
                        <?php endif;?>

                        <?php wp_reset_query(); ?>

                        <?php } //End if there are sticky posts ?>

                        <?php

                            //Show posts from category
                            $args = array( 
                                'cat' => $cat_id,
                                'post__not_in' => get_option('sticky_posts')
                            );

                            $the_query = new WP_Query($args);
                            if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                        ?>

                        <?php
                            if (get_post_format()) {
                                $post_format = get_post_format();
                            } else {
                                $post_format = 'standard';
                            }
                            get_template_part('/templates/parts/format', $post_format); ?>
                        <?php endwhile; ?>

                        <?php wp_reset_query(); ?>


                    <?php else : ?>
                        <h1><?php _e('No Results Found', 'tkingdom'); ?></h1>
                    <?php endif;?>

                    

                    <?php if($the_query->max_num_pages > 1) { ?>
                        <div class="pagination">
                            <?php tk_pageing($the_query)?>
                        </div>
                    <?php } ?>

            </div><!--/col-->

            <?php if($sidebar_position !== 'fullwidth'){?>
                <!-- Sidebar Left -->
                <?php

                if ($sidebar_position == 'left'){
                    echo '<div class="col-md-3 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                    tk_get_sidebar('Left', 'Archive/Search');
                    echo '</div></div>';
                }
                ?>
                <!-- Sidebar Right -->
                <?php
                if ($sidebar_position == 'right'){
                    echo '<div class="col-md-3 pull-right" id="sidebar" ><div class="sidebar-content">';
                    tk_get_sidebar('Right', 'Archive/Search');
                    echo '</div></div>';
                }
                ?>
                <!--/sidebar-->
            <?php } ?>           

        </div>
    </div><!--/row-fluid-->
  </div>
</div><!--/container-->

<?php get_footer(); ?>