<?php
/*

Template Name: Partners

*/
get_header();
?>






    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="gallery-content left">

                <div class="partners-content left">
                     <div class="speakers-row left">

                    <?php
                    $args=array(
                            'orderby' => 'id',
                            'order' => 'DESC',
                            'taxonomy' => 'partners'
                    );
                    $categories=get_terms('partners', $args);
                    foreach($categories as $category) {
                        $paged = get_theme_option(tk_theme_name.'_general_program_per_page');
                        $check_posts = array('post_type' => 'pt_partners', 'post_status' => 'publish', 'tax_query' => array(array('taxonomy' => 'partners','field' => 'term_id', 'terms' => $category->term_id)), 'order' => 'ASC', 'posts_per_page' => $paged );
                        $check_cat = new WP_Query();
                        $check_cat->query($check_posts);


                        if (!empty($check_cat->posts)) {

                            ?>
                         <div class="speakers-row left">
                        <div class="partners-title left"><?php echo $category->name;?></div>




                                <?php
                                $item_counter=0;
                                while($check_cat->have_posts()) : $check_cat->the_post();
                                $partner_links = get_post_meta($post->ID, $prefix.'sponsor_link', true);

                                $default_attr = array( 'alt' =>get_the_title(), 'title' =>get_the_title());
                                ?>



                                         <div class="galery-one left"  <?php if ($item_counter % 4 == 3 && $item_counter !== 0) {echo 'style="margin-right: 0;"';}?>>
                                               <a href="<?php echo $partner_links; ?>" ><?php  the_post_thumbnail('partners', $default_attr); ?></a>
                                         </div><!-- galery-one -->

                                <?php
                                    $item_counter++;

                                    endwhile;

                                    wp_reset_postdata();?>
</div>


                                            <?php }?>
                        <?php }?>


                </div><!--/partners-content-->

            </div><!--/gallery-content-->
        </div><!--/wrapper-->
    </div><!--/content-->










<?php get_footer(); ?>



