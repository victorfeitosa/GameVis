<?php get_header();
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_general_archive_sidebar');
$category_layout = get_theme_option(wp_get_theme()->name . '_general_cat_page_layout');
$cur_cat_id = get_cat_id( single_cat_title("",false) );
$cur_category = get_cat_name( $cur_cat_id );
$category = get_category( get_query_var( 'cat' ) );
$cat_id = $category->cat_ID;
$cat_option = get_option('sidebar_' . $cat_id);
$category_display = get_option("category_display_$cur_cat_id");
if(!isset($category_display) && empty($category_display)) {
    $category_display = 'cat_layout_one';
}
$category_layout_sb = get_option("category_layout_$cur_cat_id");
if(!isset($category_layout_sb) && empty($category_layout_sb)) {
    $category_layout_sb = 'sidebar-right';
}
$post_id = $cur_cat_id;
?>

<div class="block bg-content">

                <div class="container">
                  <div class="row">
                    <div class="white-bg">

                        <div class="<?php if($category_layout_sb == 'fullwidth'){echo 'col-xs-12';}elseif($category_layout_sb == 'sidebar-left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?> content-with-sidebar">

                            <h1 class="title-divider">
                                <span><?php echo single_cat_title( '', false ); ?></span>


                                <nav class="navbar navbar-default pull-right" role="navigation">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-category">
                                        <img src="<?php echo get_template_directory_uri().'/theme-images/dropdown-img.png' ?>" />
                                    </button>

                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-category">
                                        <ul class="nav navbar-nav">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo get_template_directory_uri().'/theme-images/dropdown-img.png' ?>" /></a>
                                                <ul class="dropdown-menu">
                                                <?php $args = array(
                                                    'style'              => 'list',
                                                    'show_count'         => 1,
                                                    'hide_empty'         => 1,
                                                    'title_li'           => '',
                                                ); ?>
                                                <?php wp_list_categories($args); ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </h1>


                            <div class="block category-page">
                                <?php if($category_display !== 'cat_layout_one') { ?><div class="row"><?php } ?>
                                <div class="<?php if ( $category_display == 'cat_layout_one' ) { echo 'full-width-posts'; } else { echo 'half-width-posts'; }; ?>">

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

                                

                                <?php if($wp_query->max_num_pages > 1){?>
                                    <ul class="pagination">
                                        <?php tk_pageing($wp_query)?>
                                    </ul>
                                <?php }?>

                                </div>
                            <?php if($category_display !== 'cat_layout_one') { ?></div><?php } ?>
                            </div>

                        </div><!--/col-xs-8-->


                        <!-- Sidebar Left -->
                        <?php
                        if (!isset($cat_option['sidebar']) && empty($cat_option['sidebar'])) {
                            $cat_option['sidebar'] = 'Default';
                        }
                        if ($category_layout_sb == 'sidebar-left'){
                            echo '<div class="col-xs-4 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                            tk_get_sidebar('Left', $cat_option['sidebar']);
                            echo '</div></div>';
                        }
                        ?>
                        <!-- Sidebar Right -->
                        <?php
                        if (!isset($cat_option['sidebar']) && empty($cat_option['sidebar'])) {
                            $cat_option['sidebar'] = 'Default';
                        }                        
                        if ($category_layout_sb == 'sidebar-right'){
                            echo '<div class="col-xs-4 pull-right" id="sidebar" ><div class="sidebar-content">';
                            tk_get_sidebar('Right', $cat_option['sidebar']);
                            echo '</div></div>';
                        }
                        ?>
                        <!--/sidebar-->


                    </div><!--/row-fluid-->
                  </div>
                </div><!--/container-->

<?php get_footer(); ?>