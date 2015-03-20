<?php
//loading wordpress functions
require( '../../../wp-load.php' );

                echo "<div class='post-home-content left'><ul class='pagingx'>";
                $id = $_GET['id'];
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                $args=array('cat'=>$id, 'post_type' => 'pt_portfolio',  'paged' => $paged, 'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>1000);

                //The Query
                $the_query = new WP_Query( $args );

                $item_counter = 0;
                $disable_title = get_theme_option(tk_theme_name.'_general_portfolio_images');

                //The Loop
                if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio');
                ?>
                    <div class="post-home left">
                        <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>" class="pirobox" title="<?php the_title(); ?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>"  class="zatest"/></a>
                        <div class="hover-post-home">
                            <span><?php the_title() ?></span>
                            <a href="<?php the_permalink()?>"></a>
                        </div><!--/hover-post-home-->
                    </div><!--/fpost-home-->


                        <?php
                    endwhile;
                    // Reset Post Data
                    wp_reset_postdata();
                    echo "</ul></div>";
                    ?>

                <?php else: ?>
                <?php endif;
                $numpages = get_theme_option(tk_theme_name.'_general_portfolio_per_page');
                ?>

        <?php
            $body_font = get_option('colors_body_font_color');
            $links_color = get_option('colors_links_color');
            $links_hover = get_option('colors_links_hover');
        ?>

                <script type="text/javascript">
                    //Ajax Pagination
                    jQuery("ul.pagingx").quickPager( {
                            pageSize: <?php echo $numpages?>
                    });

                </script>

                    
                      <script type="text/javascript">
                        jQuery(document).ready(function(){

                            // HOVER-IMAGES
                            jQuery('.post-home').hover(function(){
                               jQuery('img',this).stop().animate({opacity:0.7},500);
                               jQuery('.hover-post-home',this).css('display','block');
                            },function(){
                               jQuery('img',this).stop().animate({opacity:1},300);
                               jQuery('.hover-post-home',this).css('display','none');
                            });


                            jQuery('.home-storie-img a').hover(function(){
                               jQuery('img',this).stop().animate({opacity:0.7},500);
                            },function(){
                               jQuery('img',this).stop().animate({opacity:1},300);
                            });


                            jQuery('.home-authors-img a').hover(function(){
                               jQuery('img',this).stop().animate({opacity:0.7},500);
                            },function(){
                               jQuery('img',this).stop().animate({opacity:1},300);
                            });


                            jQuery('.sidebar_widget_holder .baner-widget a').hover(function(){
                               jQuery('img',this).stop().animate({opacity:0.7},500);
                            },function(){
                               jQuery('img',this).stop().animate({opacity:1},300);
                            });


                            jQuery('img.zatest:last').load(function() {
                                var test1 = jQuery('.ajax_holder').height();
                                var test2 = jQuery('.post-home-content').height();
                                var calculate;
                                if ( test1 > test2 ){
                                    calculate = test1 - test2;
                                    calculate = '-='+calculate;
                                }
                                if( test2 > test1 ){
                                    calculate = test2 - test1;
                                    calculate = '+='+calculate;
                                }
                                if (test1 == test2){
                                    calculate = 0;
                                    calculate = '+='+calculate;
                                }
                                jQuery('.ajax_holder').animate({
                                    opacity:1,
                                    height: calculate
                                },500);
                            });

                        })

                        </script>

                    <script type="text/javascript">
               
                </script>
