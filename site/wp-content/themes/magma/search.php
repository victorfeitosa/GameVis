<?php get_header();
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_general_search_sidebar');
$category_layout = get_theme_option(wp_get_theme()->name . '_general_cat_page_layout');
?>
<div class="block bg-content">

    <div class="container">
      <div class="row">
        <div class="white-bg">

            <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'col-xs-12';}elseif($sidebar_postition == 'left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?> content-with-sidebar">

                <h1 class="title-divider">
                    <span><?php printf( __( 'Search Results for: %s', 'tkingdom' ), get_search_query() ); ?></span>

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
                    <?php if($category_layout !== 'cat_layout_one') { ?><div class="row"><?php } ?>
                    <div class="<?php if ( $category_layout == 'cat_layout_one' ) { echo 'full-width-posts'; } else { echo 'half-width-posts'; }; ?>">

                    <?php if (have_posts()) : ?> 
                        <?php while (have_posts()) : the_post(); ?>
                            <?php
                            if (get_post_format()) {
                                $post_format = get_post_format();
                            } else {
                                $post_format = 'standard';
                            }
                            get_template_part('/templates/parts/format', $post_format); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <h1><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tkingdom' ); ?></h1>
                    <?php endif;?>
                    <?php if($wp_query->max_num_pages > 1){?>
                        <ul class="pagination">
                            <?php tk_pageing($wp_query)?>
                        </ul>
                    <?php }?>

                    </div>

                </div>
                <?php if($category_layout !== 'cat_layout_one') { ?></div><?php } ?>
            </div><!--/col-xs-8-->


            <?php if($sidebar_postition != 'fullwidth'){?>
            <!-- Sidebar Left -->
            <?php
            if ($sidebar_postition == 'left'){
                echo '<div class="col-xs-4" id="sidebar"><div class="sidebar-content">';
                tk_get_sidebar('Left', 'Search/Tag/Author');
                echo '</div></div>';
            }
            ?>
            <!-- Sidebar Right -->
            <?php
            if ($sidebar_postition == 'right'){
                echo '<div class="col-xs-4" id="sidebar"><div class="sidebar-content">';
                tk_get_sidebar('Right', 'Search/Tag/Author');
                echo '</div></div>';
            }
            ?>
            <!--/sidebar-->
            <?php }?>


        </div><!--/row-fluid-->
      </div>
    </div><!--/container-->

<?php get_footer(); ?>