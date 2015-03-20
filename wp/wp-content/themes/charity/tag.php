<?php get_header();
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_general_search_sidebar');
$sidebar_selected = '';
?>

    <div class="row-fluid shortcodes-margin">
        <div class="container">
            <h1 class="title-divider">
                <span><?php _e('Archive', 'tkingdom'); ?></span>
                <p>
                    <?php
                    if ( is_category() ) {
                        printf( __( 'Category Archives: %s', 'tkingdom' ), '' . single_cat_title( '', false ) . '' );
                    } elseif ( is_tax() ) {
                        printf( __( 'Taxonomy Archive: %s', 'tkingdom' ), '' . single_term_title( '', false ) . '' );
                    } elseif ( is_tag() ) {
                        printf( __( 'Tag Archives: %s', 'tkingdom' ), '' . single_tag_title( '', false ) . '' );
                    } elseif ( is_author() ) {
                        the_post();
                        printf( __( 'Author Archives: %s', 'widely' ), '<a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' );
                        rewind_posts();
                    } elseif ( is_day() ) {
                        printf( __( 'Daily Archives: %s', 'tkingdom' ), '' . get_the_date() . '' );
                    } elseif ( is_month() ) {
                        printf( __( 'Monthly Archives: %s', 'tkingdom' ), '' . get_the_date( 'F Y' ) . '' );
                    } elseif ( is_year() ) {
                        printf( __( 'Yearly Archives: %s', 'tkingdom' ), '' . get_the_date( 'Y' ) . '' );
                    } else {
                        _e( 'Archives', 'tkingdom' );
                    }
                    ?>
                </p>
            </h1>

            <div class="row-fluid">
                <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'span12';}elseif($sidebar_postition == 'left'){echo 'right span8';}elseif($sidebar_postition == 'right'){echo 'left span8';}?> blog-page our-causes-page">
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
                        <h1><?php _e('No Results Found', 'tkingdom'); ?></h1>
                    <?php endif;?>
                    <?php if($wp_query->max_num_pages > 1){?>
                        <div class="pagination">
                                    <?php global $wp_query;
                                        if(isset($custom_query)){}else{$custom_query = $wp_query;}
                                        $big = 999999999; // need an unlikely integer
                                        $pageing =  paginate_links( array(
                                            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                            'format' => '?paged=%#%',
                                            'current' => max( 1, get_query_var('paged') ),
                                            'total' => $custom_query->max_num_pages,
                                            'prev_text'    => __('Previous'),
                                            'next_text'    => __('Next'),
                                        ) );
                                        echo $pageing;
                                        ?>
                            <hr>
                        </div>
                    <?php }?>
                </div>

                <?php if($sidebar_postition != 'fullwidth'){?>
                    <div class="span4 <?php if($sidebar_postition == 'right'){echo 'sidebar-right';}elseif($sidebar_postition == 'left'){echo 'sidebar-left';}?>" id="sidebar">
                        <!-- Sidebar Left -->
                        <?php
                        if ($sidebar_postition == 'left'){
                            echo '<div class="span11 pull-left" style="margin-left:0px;">';
                            tk_get_sidebar('Left', 'Archive/Search');
                            echo '</div>';
                        }
                        ?>
                        <!-- Sidebar Right -->
                        <?php
                        if ($sidebar_postition == 'right'){
                            echo '<div class="span11 pull-right">';
                            tk_get_sidebar('Right', 'Archive/Search');
                            echo '</div>';
                        }
                        ?>
                        <!--/sidebar-->
                    </div>
                <?php }?>

            </div>

        </div>
    </div>
<?php get_footer(); ?>