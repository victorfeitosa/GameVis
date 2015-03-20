<?php get_header(); ?>


    <div id="main-wrapper">
      <div class="home masonry" id="masonry">
        <div class="row">
            <article class="gallery-masonry isotope">
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
            </article>
        </div> <!-- /.row -->


        <!-- GALLERY CATEGORY FILTER -->
        <nav class="filter-wrapper">
          <span class="archive-cat-name roboto-bold">
                <?php printf( __( 'Gallery Archives: %s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?>
          </span>
        </nav>
      </div>  <!-- /.home .masonry -->
    </div>  <!-- /#main-wrapper -->

    <!-- Pass theme url to infinite scroll for loading.gif img -->
    <input type="hidden" id="theme_url" data-theme_url="<?php echo get_template_directory_uri(); ?>" />

    <!-- Add infinite scroll JS -->
    <?php tk_infinite_scroll(); ?>


<?php get_footer(); ?>