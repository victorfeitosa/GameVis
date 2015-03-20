<div <?php post_class(); ?>>
    <?php
    $prefix = "tk_";
    
    //get post meta boxes
    $link_text = get_post_meta($post->ID, $prefix.'link_text', true);
    $link_url = get_post_meta($post->ID, $prefix.'link_url', true);  
    
    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
        <div class="block images-single-blog">
            <?php if(has_post_thumbnail()){
                $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                $post_thumbnail_src = $post_thumbnail['0'];
                ?>
                <div class="top-content-image">
                    <?php the_post_thumbnail()?>
                    <div class="images-hover-blog">
                        <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox"
                           data-fancybox-group="gallery"
                           title="<?php the_title()?>"></a>
                        <a href="<?php the_permalink()?>" class="blog-link"></a>
                    </div>
                </div>
            <?php }?>
            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
        </div>
    
        <div class="row-fluid margin-bottom-25">
        <div class="span2">
            <img src="<?php echo get_template_directory_uri()?>/img/link-post.jpg">
        </div>
        <div class="span10">
            <h3><a href="<?php  echo $link_url; ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h3>                        
            <div class="link-post">
                <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
            </div><!-- link-post -->                      
        </div><!-- row-fluid -->
    

        <div class="shortcodes">
            <?php the_content(); ?>
        </div>
        
            <!-- post-pagination -->
            <div class="post-pagination">
                    <?php wp_link_pages(); ?>
            </div><!-- post-pagination -->

        <!-- TAGS -->
            <?php $check_tags = get_the_tags();
                if(!empty($check_tags)) {
                    the_tags('<div class="block blog-tag clear"><img src="'.get_template_directory_uri().'/img/tag-widget.png"><span class="tags">Tags: </span>', ', ', '</div>'); 
                } else { ?>
                    <div class="post-border"></div>
               <?php }  ?>
        <!-- TAGS -->

        <?php get_template_part( '/templates/parts/entry', 'social' ); ?>
        </div><!-- row-fluid -->
    <?php }else{ ?>
        <div class="block blog-post">
            <div class="top-content-text">
                <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                <div class="row-fluid">
                    <div class="span2">
                        <img src="<?php echo get_template_directory_uri()?>/img/link-post.jpg">
                    </div>
                    <div class="span10">
                        <h3><a href="<?php  echo $link_url; ?>" title="<?php the_title();?>" class="post-headlines"><?php the_title(); ?></a></h3>                        
                        <div class="link-post">
                            <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
                        </div><!-- link-post -->                      
                    </div><!-- row-fluid -->
                </div>
            </div>
        </div>
    <?php } // close if is single?>
</div><!-- /.post_class -->