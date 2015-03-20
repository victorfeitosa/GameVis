<?php
/*

Template Name: Portfolio

*/
get_header();
?>
    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">


            <div class="portfolio-content left">

                            <?php
                              global $wpdb;
                              $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'pt_portfolio' AND post_status = 'publish'");
                              if(!empty ($post_type_ids )){
                                $post_type_cats = wp_get_object_terms( $post_type_ids, 'category',array('fields' => 'ids') );
                                if($post_type_cats){
                                  $post_type_cats = array_unique($post_type_cats);
                                  $allcat = implode(',',$post_type_cats);
                                }
                              }
                              $include_category = null;
                            ?>

                        <div class="simplePagerNav left" style="margin-bottom: 40px">

                            <ul style="text-align:left">
                                <li style="color:black;font-size: 13px;font-family: 'Helvetica';font-weight: bold;vertical-align: top;margin-top: 9px"><?php _e('Filter :', tk_theme_name)?></li>
                                <li class="paragraphp cat_cell_active cat_cell" rev="<?php echo $allcat?>" style="margin-left:5px"><a href="#"><?php _e('All', tk_theme_name)?></a></li>
                                <?php
                                if(!empty ($post_type_ids )) {
                                    foreach ($post_type_cats as $category_list) {
                                        $cat = 	$category_list.",";
                                        $include_category = $include_category.$cat;
                                        $cat_name = get_cat_name($category_list)
                                                ?>

                                <li rev="<?php echo $category_list?>" class="cat_cell"><a href="#"><?php echo $cat_name?></a></li>

                                        <?php } } ?>
                            </ul>

                        </div><!--/portfolio-filter-->

                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                    jQuery('.cat_cell_active').click();
                            });
                        </script>

                        <script type="text/javascript">
                            jQuery('.cat_cell').live('click',
                            function () {
                                var id = jQuery(this).attr('rev');
                                jQuery('.cat_cell').removeClass('cat_cell_active');
                                jQuery(this).addClass('cat_cell_active');
                                jQuery('.ajax_holder').animate({opacity:0},500,function(){
                                    jQuery('.portfolio-loader').show().animate({opacity:0},0).animate({opacity:1},500,function(){
                                        var randomnumber=Math.floor(Math.random()*100000000);
                                        var postAjaxURL = "<?php echo get_template_directory_uri() ?>/_portfolioajax.php?id="+id;
                                        
                                            jQuery('.ajax_holder').load(postAjaxURL, {rand: randomnumber},function(){
                                                jQuery('.portfolio-loader').animate({opacity:0},500).hide();
                                            });
                                    });
                                });
                                return false;
                            });
                        </script>
                        

                                <div class="portfolio-loader"></div>

				<div class="ajax_holder" style="width:100%"></div><!--AJAX Holder-->

    </div><!--/content-->


<?php
            $trending = get_theme_option(tk_theme_name.'_home_disable_trending');
            if($trending !== 'yes') {
                ?>
                <?php
                /*************************************************************/
                /************MOSTLY VIEWED POSTS*****************************/
                /*************************************************************/


                ?>

            <div class="home-stories left">
                <div class="home-stories-content left">
                    <div class="home-stories-title left"><span><?php _e("Trending stories", tk_theme_name)?></span></div><!--/home-stories-title-->

                        <?php
                        wp_reset_postdata();
                        $query = array(
                                'post_type' => 'post',
                                'meta_key' => 'post_stats',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'posts_per_page' => '4'
                        );
                        $the_query = new WP_Query( $query );
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            $post_views = get_post_meta($post->ID, 'post_stats', true);
                            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'small-image');
                            ?>

                    <div class="home-storie-one left">
                        <div class="home-storie-img left"><a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() )?>" class="pirobox" title="<?php the_title(); ?>"><img src="<?php echo $img_src[0]?>" title="<?php the_title()?>" alt="<?php the_title()?>" /></a></div><!--/home-storie-img-->
                        <div class="home-storie-text left">
                            <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            <p><?php echo $post_views?></p>
                        </div><!--/home-storie-text-->
                    </div><!--/home-storie-one-->

                        <?php
                        endwhile;
                        // Reset Post Data
                        wp_reset_postdata();
                        ?>

                </div><!--/home-stories-content-->
            </div><!--/home-stories-->
                <?php }?>



        </div><!--/bg-content-one-->
    </div><!--/content-->

<?php get_footer(); ?>



