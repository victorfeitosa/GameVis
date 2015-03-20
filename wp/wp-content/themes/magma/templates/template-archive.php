<?php
/*

Template Name: Archive Page

*/
get_header();
$sidebar_postition = get_post_meta($wp_query->post->ID, 'tk_sidebar_position', true);
$sidebar_selected = get_post_meta($wp_query->post->ID, 'tk_sidebar', true);
$disable_banner = get_post_meta($wp_query->post->ID, 'tk_disable_title', true);
$slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);

?>

    <div class="block bg-content">
                <div class="container">
                  <div class="row">
                        <div class="white-bg">
                            
                            <div class="<?php if($sidebar_postition == 'fullwidth'){echo 'col-xs-12';}elseif($sidebar_postition == 'left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?> content-with-sidebar shortcodes">

                                <h1 class="title-divider">
                                    <span><?php the_title(); ?></span>
                                </h1>
                                
                                <div class="shortcodes">
                                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                        <?php the_content(); ?>
                                    <?php endwhile; ?>
                                    <?php endif;?>
                                </div>
                                
                                <!-- ARCHIVES -->

                                    <!-- Last 30 archives -->
                                    <div class="block archive-page">
                                        <ul>
                                           <li class="archive-title"><h4><?php _e('Last 30 Posts', 'tkingdom'); ?>:</h4></li>
                                            <?php wp_get_archives('type=postbypost&limit=30'); ?>
                                        </ul>

                                        <ul>
                                            <li class="archive-title"><h4><?php _e('Archives by Month', 'tkingdom'); ?>:</h4></li>
                                            <?php wp_get_archives(); ?>
                                        </ul>

                                        <ul>
                                            <li class="archive-title"><h4><?php _e('Archives by Subject', 'tkingdom'); ?>:</h4></li>
                                            <?php wp_list_categories('title_li='); ?>
                                        </ul>                                        
                                    </div> <!-- /Last 30 archives -->

                            </div><!--/col-xs-8-->




                                    <!-- Sidebar -->
                                    <?php
                                    
                                    if($disable_banner == 'on') {
                                        $add_margin = 'add_margin';
                                    } else {
                                        $add_margin = '';
                                    }
                                    
                                    if ($sidebar_postition == 'left'){
                                        echo '<div class="col-xs-4 '.$add_margin.' pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                                        tk_get_sidebar('Left', $sidebar_selected);
                                        echo '</div></div>';
                                    }
                                    ?>
                                    <!-- Sidebar Right -->
                                    <?php
                                    if ($sidebar_postition == 'right'){
                                        echo '<div class="col-xs-4 '.$add_margin.' pull-right" id="sidebar" ><div class="sidebar-content">';
                                        tk_get_sidebar('Right', $sidebar_selected);
                                        echo '</div></div>';
                                    }
                                    ?>
                                <!--/sidebar-->

                        </div>

                </div><!--/container-->
            </div>

<?php get_footer(); ?>