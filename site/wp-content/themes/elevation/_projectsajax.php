<?php
//loading wordpress functions
require( '../../../wp-load.php' );

                $id = $_GET['id'];
                $id_array = explode(',', $id);
                
                $paged = $_GET['paged'];
                $projects_paged = get_theme_option(tk_theme_name.'_home_projects_paged');
                if(empty($projects_paged)){$projects_paged = '-1';}
                
                $args=array('tax_query' => array(array('taxonomy' => 'ct_projects','field' => 'term_id', 'terms' => $id_array)), 'post_type' => 'pt_projects',  'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>$projects_paged, 'paged' => $paged);

                //The Query
                $the_query = new WP_Query( $args );

                //The Loop
                if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                $video_args = array(
                        'order' => 'ASC',
                        'orderby' => 'menu_order',
                        'post_type' => 'attachment',
                        'post_parent' => $post->ID,
                        'post_mime_type' => 'image',
                        'post_status' => null,
                        'numberposts' => -1,
                );
                $attachments = get_posts($video_args);
                $post_category = wp_get_post_terms( $post->ID, 'ct_projects' );
                $post_count = $the_query->post_count;
                ?>                                          
                                                
                    <div class="portfolio-images-one left class-<?php echo $post_category[0]->term_id?>">
                        <div><?php 
                       if($post_count < (int)$projects_paged ){echo 'manji';}else{echo 'veci';} 
                        ?></div>
                        
                        <?php if($video_link || !empty($attachments) || has_post_thumbnail()){?>
                            <?php
                                if($video_link) {
                                    get_video_image($video_link);
                                }elseif(has_post_thumbnail()){ 
                                     the_post_thumbnail('project-home', array('class' => "load-image")); ?>
                                <?php
                                }elseif (!empty($attachments)) {
                                ?>
                                    <?php
                                        $image_url_thumb = wp_get_attachment_image_src($attachments[0]->ID, 'project-home');
                                        ?>
                                        <img src="<?php echo $image_url_thumb[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                <?php }?>
                            <?php }?>   
                            <div class="portfolio-hover left">
                                <div class="portfolio-hover-title left"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div><!--/portfolio-hover-title-->
                                <div class="portfolio-hover-text left"><?php the_excerpt()?></div><!--/portfolio-hover-text-->
                                <div class="portfolio-hover-icon left"><a href="<?php the_permalink() ?>" style="<?php if($video_link){echo 'background: url('.get_template_directory_uri().'/style/img/video-ico.png) no-repeat left top;';}elseif(has_post_thumbnail()){echo 'background: url('.get_template_directory_uri().'/style/img/image-ico.png) no-repeat left top;';}elseif(!empty($attachments)){echo 'background: url('.get_template_directory_uri().'/style/img/slider-ico.png) no-repeat left top;';} ?>"></a></div><!--/portfolio-hover-icon-->
                            </div><!--/portfolio-hover-->
                            <div class="border-down-images left"></div><!--/border-down-images-->
                    </div><!--/portfolio-images-one-->
                    

                        <?php
                    endwhile;
                    // Reset Post Data
                    wp_reset_postdata();
                    ?>

                <?php else: ?>
                <?php endif;?>
                  <?php if($post_count < (int)$projects_paged ){echo '<div id = "last_ajax_post" ></div>';}?> 
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('.portfolio-images-one').hover(function(){
                                jQuery('.portfolio-hover',this).stop().animate({opacity:1},500);
                            },function(){
                                jQuery('.portfolio-hover',this).stop().animate({opacity:0},300);
                            });
                            
                        })
                    </script>