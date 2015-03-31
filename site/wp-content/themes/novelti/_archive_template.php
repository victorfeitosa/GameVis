<?php 
/*

Template Name: Archive

*/
get_header();
$subheadline = get_post_meta($post->ID, $prefix.'subheadline', true);
$prefix = 'tk_';
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);                       
?>
     




    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">

            
                <div class="content-left left">
                
                    <div class="title-on-page left">
                        <h1><?php the_title(); ?></h1>
                         <?php if($subheadline) { ?><p><?php echo $subheadline; ?></p><?php } ?>
                    </div>

                   
                    <?php if($post->post_content) { ?>                    
                        <div class="shortcodes left">
                            <?php
                                /* Run the loop to output the page.
                                                         * If you want to overload this in a child theme then include a file
                                                         * called loop-page.php and that will be used instead.
                                */
                                //get_template_part( 'loop', 'page' );
                                wp_reset_query();
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                        the_content();
                                        echo $post->ID.'---';
                                    endwhile;
                                else:
                                endif;
                                wp_reset_query();
                                ?>
                        </div><!--/contact-text-->                        
                    <?php } ?>
                    
                    
                    <!--  lists out last 30 posts-->
                    <div class="archive-list left">                        
                        <h3><?php _e('Last 30 Posts:', tk_theme_name); ?></h3>                        
                        <ul>
                            <?php
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                                $args=array('post_status' => 'publish', 'paged' => $paged, 'posts_per_page' =>30);

                                //The Query
                                query_posts($args);

                                //The Loop
                                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                    
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>                    
                                <?php
                                    endwhile; endif;                    
                                ?>
                        </ul>
                    </div><!-- archive list -->
                    
                    
                    
                    
                    <!--lists out months-->
                    <div class="archive-list left">                        
                        <h3><?php _e('Archives by Month:', tk_theme_name); ?></h3>                        
                         <ul>
                            <?php 
                                $args = array('type'=>'monthly');
                                wp_get_archives($args);                         
                            ?>          
                        </ul>
                    </div><!-- archive list -->
                    
                    
                    
                    <!--lists out months-->
                    <div class="archive-list left">                        
                        <h3><?php _e('Archives by Subject:', tk_theme_name); ?></h3>                        
                         <ul>
                            <?php 
                                $args = array('type'=>'monthly');
                                wp_list_categories('title_li=');      
                            ?>          
                        </ul>
                    </div><!-- archive list -->
                    
                </div><!--/content-left-->

                            <?php                                 
                                tk_get_sidebar('Right', $sidebar_select);               
                            ?>

            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->




<?php get_footer(); ?>
