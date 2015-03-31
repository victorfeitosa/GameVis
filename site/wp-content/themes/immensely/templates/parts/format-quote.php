<div <?php post_class(); ?>>
    <?php
    $quote_text = get_post_meta($post->ID, 'tk_quote', true);
    $quote_author = get_post_meta($post->ID, 'tk_quote_author', true); 
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
        <div class="blog-single sidebar right page" id="content">

            <div class="row-fluid">
                <div class="container">

                    <div class="row-fluid">

                        <div class="span9">

                            <div class="quote-post-big">

                                    <blockquote class="quote-single">
                                        <p><?php echo $quote_text; ?></p><small><?php echo $quote_author; ?></small>
                                    </blockquote>

                                <div class="post-big">
                                    <?php  if(is_sticky()) { ?><li class="sticky featured-post button-small"><i class="fa fa-star"></i><?php _e('Featured Post', 'tkingdom') ?></li><?php } ?>
                                    <h4><?php the_title()?></h4>
                                    <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>

                                    <div class="shortcodes">
                                       <?php the_content(); ?>
                                    </div>

                                    <!-- TAGS -->
                                    <div class="block tag-widget clear">
                                        <?php the_tags('<h6 class="tags">Tags</h6>', ''); ?>
                                    </div>
                                    <!-- TAGS -->
                                </div>
                            </div>

                            <div class="block single-soc-share">
                                <?php get_template_part( '/templates/parts/entry', 'social' ); ?>
                            </div><!--/single-soc-share-->

                            <?php if ($disable_author != 'on') { ?>
                                <?php get_template_part( '/templates/parts/entry', 'author' ); ?>
                            <?php }?>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    <?php }else{
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Blog page                   */
    /*                                                          */
    /************************************************************/
                ?>
        <div class="quote-post-big">
            <div class="post-big">
                <blockquote>
                    <p><?php echo $quote_text; ?></p><small><?php echo $quote_author; ?></small>
                </blockquote>
                    <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->



