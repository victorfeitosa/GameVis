<?php get_header();
$prefix = 'tk_';
$blog_title = get_option('title_blog_page');
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            
            <div class="title-category-portfolio left">
                <div class="title-portfolio left"><?php echo $blog_title?></div><!--/title-portfolio-->
            </div><!--/title-category-portfolio-->


            <div class="pages-content left">

                                
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
                        <span class="blog-single-title"><?php the_title()?></span>
                        <?php if (has_post_thumbnail()) { ?>
                            <a href="<?php echo $image[0]; ?>" class="pirobox" title="<?php echo the_title() ?>">
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                            </a>
                        <?php } ?>
                        
                        <div class="shortcodes left">
                            <?php
                                wp_reset_query();
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                        the_content();
                                    endwhile;
                                else:
                                endif;
                                wp_reset_query();
                                ?>
                        </div><!--/post-single-text-->
                    </div><!-- /blog-right-->     
                </div><!-- /blog-one-->          
                
                
                    <!--COMMENTS-->
                  <div class="comment-start right">

                      <?php if ( comments_open() ) : ?>

                          <?php comments_template(); // Get wp-comments.php template ?>

                      <?php endif; ?>

                  </div><!--/comment-start-->
                
                
            </div><!-- /pages-content-->
            

        </div><!--/wrapper-->
    </div><!--/content-->


    
<?php get_footer(); ?>