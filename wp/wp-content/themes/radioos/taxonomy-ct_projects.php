<?php get_header();
$prefix = 'tk_';
global $wp_query;
$cat_obj = $wp_query->get_queried_object();
$term_id = $cat_obj->term_id;
$projects_title =  get_option('title_projects_page');
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="title-category-portfolio left">
                <div class="title-portfolio left"><?php echo $projects_title?></div><!--/title-portfolio-->
                <div class="category-portfolio right">
                    <?php get_template_part( 'inc/category_navigation' );?>
                </div><!--/category-portfolio-->
            </div><!--/title-category-portfolio-->

            <div id="fakeholder" style="visibility:hidden;display: none;"></div>
            <div class="home-portfolio left">  
                
            <?php 
                wp_reset_query();
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $tax_arg = array('tax_query' => array(array('taxonomy' => 'ct_projects', 'field' => 'id', 'terms' => $term_id)),'post_type' => 'projects', 'post_status' => 'publish', 'posts_per_page' => get_option('posts_per_page'), 'paged' => $paged);

                //The Query
                $the_query = new WP_Query( $tax_arg );

                //The Loop
                while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
                
                <div class="home-portfolio-one left">
                    <?php if (has_post_thumbnail()) { ?>
                        <?php the_post_thumbnail('project') ?>
                    <?php } ?>
                    <div class="home-portfolio-hover">                        
                        <div class="project-hider">
                            <div class="home-portfolio-title left"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></div><!--/home-portfolio-title--> 
                            <div class="home-portfolio-text left"><?php the_excerpt() ?></div><!--/home-portfolio-text--> 
                        </div>
                        <div class="home-portfolio-link left"><a href="<?php echo the_permalink() ?>"></a></div><!--/home-portfolio-link--> 
                    </div><!--/home-portfolio-one--> 
                </div><!--/home-portfolio-one-->
                
                <?php endwhile; ?>
                
                <?php get_template_part( 'inc/postformats/loadmore' );?>
                
            </div><!--/home-portfolio-->

        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>