<?php
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$enable_slider = get_post_meta($wp_query->post->ID, 'tk_enable_slider', true);
$disable_title = get_post_meta($wp_query->post->ID, 'tk_page_title', true);
?>


            <div class="block bg-content">

                    <?php 
                    if(is_front_page()) {
                    get_template_part('/templates/parts/entry', 'slider'); 
                    } ?>


                <div class="container">
                    <div class="row">
                        <div class="sc-fullwidth-holder">
                            <div class="white-bg">

                                <div class="content-with-sidebar shortcodes <?php if($sidebar_postition == 'fullwidth'){echo 'col-xs-12';}elseif($sidebar_postition == 'left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?>">
                                
                                <?php if(!$disable_title) { ?>
                                    <h1 class="title-divider"><span><?php echo the_title(); ?></span></h1>
                                <?php } ?>

                                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <?php the_content(); ?>
                                    <?php endwhile; ?>
                                    <?php endif;?>

                                </div><!--/col-xs-8-->




                                        <!-- Sidebar Left -->
                                        <?php

                                        if ($sidebar_postition == 'left'){
                                            echo '<div class="col-xs-4 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                                            tk_get_sidebar('Left', $sidebar_selected);
                                            echo '</div></div>';
                                        }
                                        ?>
                                        <!-- Sidebar Right -->
                                        <?php
                                        if ($sidebar_postition == 'right'){
                                            echo '<div class="col-xs-4 pull-right" id="sidebar" ><div class="sidebar-content">';
                                            tk_get_sidebar('Right', $sidebar_selected);
                                            echo '</div></div>';
                                        }
                                        ?>
                                        <!--/sidebar-->


                            </div><!--/row-fluid-->
                        </div>
                    </div>
                </div><!--/container-->