<div <?php post_class(); ?>>
    <?php
            $link_url = get_post_meta($post->ID, 'tk_link_url', true);
            $link_text = get_post_meta($post->ID, 'tk_link_text', true);
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
<div class="blog-single sidebar right page" id="content">
    
    <div class="row-fluid">
                    <div class="img-post-big">

                            <div class="link-post-big">
                                    <div class="link">
                                        <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a><small><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></small>
                                    </div>
                            </div>
                        
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
    <?php 
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in Blog page                     */
    /*                                                          */
    /************************************************************/
    }else{?>
        <div class="block">
            <div class="link-post-big">
                <div class="post-big">
                    <div class="link">
                        <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a><small><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></small>
                    </div>
                    <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                </div>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->