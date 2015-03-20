<?php 
get_header();
$prefix = 'tk_';
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="title-category-portfolio left">
                <div class="title-portfolio left"><?php the_title()?></div><!--/title-portfolio-->
            </div><!--/title-category-portfolio-->

            <div class="pages-content left">

                        <?php
                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                        ?>   

                        <div class="blog-one left">
                            <div class="blog-left left">
                                <div class="blog-images left">
                                    <?php echo get_avatar($post->post_author,$size='87',$default='<path_to_url>' ); ?>
                                    <span><?php comments_number( '0', '1', '%' ); ?></span>
                                </div><!-- /blog-images--> 
                                <div class="blog-data right">
                                    <div class="blog-published left">
                                        <ul>
                                            <li><span><?php _e('Published: ', tk_theme_name) ?></span></li>
                                            <li><p><?php echo get_the_date()?></p></li>
                                        </ul>
                                    </div><!-- /blog-published--> 
                                    <div class="blog-author left">
                                        <ul>
                                            <li><span><?php _e('Author: ', tk_theme_name) ?></span></li>
                                            <li><a href="<?php echo get_author_posts_url( $post->post_author );?>"><?php the_author_meta('nickname', $post->post_author)?></a></li>
                                        </ul>
                                    </div><!-- /blog-author--> 
                                    <div class="blog-category left">
                                        <span><?php _e('Category: ', tk_theme_name) ?></span>
                                        <ul>
                                            <?php echo get_the_category_list( ', ', $post->ID ); ?>
                                        </ul>
                                    </div><!-- /blog-category--> 
                                </div><!-- /blog-data--> 

                            </div><!-- /blog-left-->          
                            <div class="blog-right right">
                                <a  class="blog-single-title" href="<?php the_permalink()?>"><?php the_title()?></a>
                                <?php if (has_post_thumbnail()) { ?>
                                    <a href="<?php echo $image[0]; ?>" class="pirobox" title="<?php echo the_title() ?>">
                                        <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                    </a>
                                <?php } ?>
                                <p><?php the_excerpt()?></p>
                            </div><!-- /blog-right-->     
                        </div><!-- /blog-one-->      
                        
                        <?php endwhile; ?>
                        <?php else: ?>
                        <?php endif; ?>
            
                    <!--PAGINATION-->
                    <div class="pagination left tk-pagination">
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
                        
            </div><!-- /pages-content-->

        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>
