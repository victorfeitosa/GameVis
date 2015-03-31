<div <?php post_class(); ?>>
    <?php

    /************************************************************/
    /*                                                          */
    /*   If this type is shown in single page                   */
    /*                                                          */
    /************************************************************/
    if(is_single()){?>
        <div class="block images-single-blog">
            <?php
            if(has_post_thumbnail()){ ?>
                <div class="span2">
                    <a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
            <?php }?>
            <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
        </div>

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

    <?php }else{?>
    <div class="block blog-post">
        <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
        <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
        <div class="row">
            <?php
            if(has_post_thumbnail()){ ?>
                <div class="span2">
                    <a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div>
            <?php }?>
            <div class="<?php if(has_post_thumbnail()){ echo 'span6';}else{echo 'span8';}?>">
                <p><?php the_excerpt_length(340);?></p>
            </div><!-- .span6 or .span8 -->
        </div><!-- /.row -->
    </div><!-- /.row -->
    <?php } // close if is single?>
</div><!-- /.post_class -->