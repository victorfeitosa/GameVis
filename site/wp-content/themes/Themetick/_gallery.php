<?php
/*

Template Name: Gallery

*/
get_header();
?>


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="gallery-content left">

                      <div class="gallery-filter left">

                        <?php
                          global $wpdb;
                          $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'pt_gallery' AND post_status = 'publish'");
                          if(!empty ($post_type_ids )){
                            $post_type_cats = wp_get_object_terms( $post_type_ids, 'gallery' ,array('fields' => 'ids') );


                            if($post_type_cats){
                              $post_type_cats = array_unique($post_type_cats);
                              $allcat = implode(',',$post_type_cats);
                            }
                          }
                          $include_category = null;
                        ?>


                    <span><?php _e('Filter:', 'Themetick') ?></span>


                            <ul id="filters">
                                    <li class="paragraphp cat_cell cat_cell_active" rev="<?php echo $allcat?>">
                                            <a href="#" data-filter="*"><?php _e('All', 'Themetick')?></a>
                                    </li>


                              <?php
                            if(!empty ($post_type_ids )){
                                 $cat_count = count($post_type_cats);
                                 $cat_counter = 1;
                                 foreach ($post_type_cats as $category_list) {
                                    $cat = 	$category_list.",";
                                    $include_category = $include_category.$cat;
                                    $cat_name = get_term($category_list, 'gallery');
                                ?>


                                    <li rev="<?php echo $category_list?>"  class="cat_cell">
                                            <a href="#" data-filter="<?php echo '.class-'.$category_list?>" ><?php echo $cat_name->name?></a>
                                    </li>


                                <?php } }?>
                            </ul>

                </div> <!-- gallery filter -->

                <div class="portfolio-content portfolio-img-loaded left"  rev="2">
               <div class="speaker-show">


                   <?php
                        $id_array = explode(',', $allcat);
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args=array( 'tax_query' => array(array('taxonomy' => 'gallery','field' => 'term_id', 'terms' => $id_array)),  'post_type' => 'pt_gallery',  'paged' => $paged, 'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>1000);

                        //The Query
                        $the_query = new WP_Query( $args );

                        $i=1;

                        

                        //The Loop
                        if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                        $image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        $job_position = get_post_meta($post->ID, 'tk_job_position', true);
                        $post_category = wp_get_post_terms( $post->ID, 'gallery');
                        $isotop_cat ='';
                        foreach ($post_category as $cat_id) {
                            $isotop_cat .= ' class-'.$cat_id->term_id;
                        }
                        if($i == 4) {
                            $nomargin = 'nomargin';
                        } else {
                            $nomargin = ' ';
                        }

                    ?>

                        <div class="speakers-one gallery-height left <?php echo $isotop_cat.' '.$nomargin;?>">
                            <div class="galery-one left <?php echo $nomargin; ?>"><a href="<?php echo $image_url; ?>" class="pirobox" title="<?php the_title(); ?>"><?php the_post_thumbnail('gallery', array('class' => "load-image", "alt" => get_the_title(), "title" => get_the_title())); ?></a></div><!--/galery-one-->
                        </div><!--/speakers-one-->

                   <?php endwhile; endif; ?>

                                <div class="portfolio-loader"></div>

				
               </div>

                </div><!-- portfolio-content -->
              </div><!--/gallery-content-->
        </div><!--/wrapper-->
    </div><!--/content-->



<?php get_footer(); ?>



