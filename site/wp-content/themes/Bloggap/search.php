<?php get_header();
$prefix = 'tk_';
?>

        <!-- CONTENT -->
        <div class="content front-page right">

                <?php
                    $show_fullcontent = get_theme_option(tk_theme_name.('_general_show_fullcontent'));

                    $c = 1;

                     //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $format = get_post_format();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                    $image_blog = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog');

                    $categories = get_the_category();
                    $cat_count = count($categories);

                    $undertitle = get_post_meta($post->ID, $prefix.'undertitle', true);
                    $post_color = get_post_meta($post->ID, $prefix.'color', true);
                    $headline_color = get_post_meta($post->ID, $prefix.'headline', true);
                    $headline_hover_color = get_post_meta($post->ID, $prefix.'headline_hover', true);
                    $undertitle_color = get_post_meta($post->ID, $prefix.'undertitle_color', true);
                    $paragraph = get_post_meta($post->ID, $prefix.'paragraph', true);
                    $readmore = get_post_meta($post->ID, $prefix.'readmore', true);
                    $readmore_hover = get_post_meta($post->ID, $prefix.'readmore_hover', true);
                ?>


            <!-- POST COLORS -->
            <style type="text/css">
                .single-color<?php echo $c; ?> {
                    background-color:#<?php echo $post_color ?>;
                }

                .single-color<?php echo $c; ?> .blog-title a {
                    color:#<?php echo $headline_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-title a:hover {
                    color:#<?php echo $headline_hover_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-title p {
                    color:#<?php echo $undertitle_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-text p, .single-color<?php echo $c; ?> .shortcodes ol li, .shortcodes ul li {
                    color:#<?php echo $paragraph; ?>;
                }

                .single-color<?php echo $c; ?> .blog-read-more a, .single-color<?php echo $c; ?> .shortcodes .more-link {
                    color:#<?php echo $readmore; ?>;
                }

                .single-color<?php echo $c; ?> .blog-read-more a:hover, .single-color<?php echo $c; ?> .shortcodes .more-link:hover {
                    color:#<?php echo $readmore_hover; ?>;
                }
            </style>


            <div class="blog-wrap single-color<?php echo $c; ?> magicpixel ">
            <!--Post Standard-->
            <div class="blog-one left">

                <div class="background-color"></div>
                <?php if ($format == 'image') { ?>
                    <?php if(has_post_thumbnail()) { ?>
                        <div class="blog-images <?php  if($format =='image'){ ?>image-margin<?php } ?> left">
                            <a href="<?php echo $image[0]; ?>" class="fancybox"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/></a>
                            <?php if($format =='image') {?>
                                <div class="gallery-hover">
                                    <a href="<?php echo $image[0]; ?>" class="fancybox" title="<?php the_title(); ?>"></a>
                                </div>
                            <?php } ?>
                        </div><!-- blog-images -->
                    <?php } ?>
                <?php } ?>



               <?php  if($format !=='image'){ ?>
                <?php if($format !== 'aside') { ?>
                        <div class="blog-category left">
                            <ul>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-1.png" alt="" /></li>
                                <?php
                                    $i = 1;
                                    foreach($categories as $cats) {
                                    $cat_link = get_category_link($cats->term_id);

                                    if($cat_count !== $i) {
                                        $comma =', ';
                                    } else {
                                        $comma = '';
                                    }
                                        ?>

                                    <li><a href="<?php echo $cat_link; ?>"><?php echo $cats->name; ?><?php echo $comma; ?></a></li>
                                <?php $i++; } ?>

                            </ul>
                            <ul>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-2.png" alt="images" title="images"  /></li>
                                <li><span><?php the_time(get_option('date_format')); ?></span></li>
                            </ul>
                            <ul>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-3.png" alt="images" title="images"  /></li>
                                <li><a href="<?php echo comments_link(); ?>"><?php comments_number( __('No Comments'), __('One Comment'), __('% Comments') ); ?>.</a></li>
                            </ul>
                            <ul>
                                <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-4.png" alt="images" title="images"  /></li>
                                <li><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></li>
                            </ul>
                        </div><!--/blog-category-->
                     <?php } ?>

                    <?php if($format !== 'aside') { ?>
                    <div class="blog-title left">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php if($undertitle){ ?><p><?php echo $undertitle; ?></p><?php } ?>
                    </div><!--/blog-title-->
                    <?php } ?>


                <div class="blog-text shortcodes left">
                    <?php if($show_fullcontent == 'yes') { ?>
                        <?php the_content( 'Read More'); ?>
                    <?php } else { ?>
                        <p><?php the_excerpt_length(3000); ?></p>
                    <?php } ?>
                </div><!--/blog-text-->


                    <?php if($show_fullcontent !== 'yes') { ?>
                        <div class="blog-read-more left"><a href="<?php the_permalink(); ?>"><?php _e('Read more...', tk_theme_name); ?></a></div><!--/blog-read-more-->
                    <?php } ?>
                <?php } ?>

            </div><!--/blog-one-->
            <div class="clear"></div>
            </div><!-- blog-wrap -->

            <?php $c++; endwhile; else : ?>
                <div class="blog-wrap">
                    <div class="blog-one">
                        <h2 class="center">
                            <?php _e("No posts found. Try a different search?", tk_theme_name)?>
                        </h2>
                    </div>
                </div>
            <?php endif; ?>




            <!-- PAGINATION -->
            <div class="blog-one">
                <div class="pagination right">
                    <?php
                        global $wp_query;
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages
                        ));
                    ?>
                </div><!--/pagination-->
            </div>


            
        </div><!--/content-->
    </div><!--/wrapper-->




<?php get_footer(); ?>