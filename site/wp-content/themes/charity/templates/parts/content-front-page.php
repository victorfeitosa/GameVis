<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
    <header class="entry-header">
        <?php if ( '' != get_the_post_thumbnail() ) : ?>
            <div class="featured-image">
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr( printf( __( 'Permanent Link to %s', 'tkingdom' ), the_title_attribute( 'echo=0' ) ) ); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </div>
        <?php endif; ?>

        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'tkingdom' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    </header><!-- .entry-header -->

    <div class="entry-summary clearfix">
        <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->