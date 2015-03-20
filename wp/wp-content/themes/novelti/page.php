<?php
get_header();
$prefix = 'tk_';
$subheadline = get_post_meta($post->ID, $prefix.'subheadline', true);
$sidebar_postition = get_post_meta($post->ID, $prefix . 'sidebar_position', true);
if ($sidebar_postition == '') {
    $sidebar_postition = 'right';
}

?>
       <div class="content left">
            <div class="wrapper">
                <div class="content-full  left">


                <!-- CONTENT -->
                            <div class='content-left content-margin left'>
                            <div class="title-on-page left">
                                <h1><?php the_title(); ?></h1>
                                <?php if($subheadline) { ?><p><?php echo $subheadline; ?></p><?php } ?>
                            </div>

                                <div class="shortcodes left"> 
                                    <?php
                                     if ( have_posts() ) : while ( have_posts() ) : the_post();
                                        the_content();
                                    endwhile; endif;
                                    ?>
                                </div>
                            </div><!-- cotent-left -->


                            <?php                 
                                $sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);                       
                                tk_get_sidebar('Right', $sidebar_select);               
                            ?>

                        </div><!--/content-full-->


                    </div><!--/wrapper-->
    </div><!--/content-->









<?php get_footer(); ?>