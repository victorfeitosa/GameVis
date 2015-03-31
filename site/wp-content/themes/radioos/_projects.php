<?php 
/*

Template Name: Projects

*/
get_header(); 
$prefix = 'tk_';
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            <div class="title-category-portfolio left">
                <div class="title-portfolio left"><?php the_title()?></div><!--/title-portfolio-->
                <div class="category-portfolio right">
                    <?php get_template_part( 'inc/category_navigation' );?>
                </div><!--/category-portfolio-->
            </div><!--/title-category-portfolio-->

            <div id="fakeholder" style="visibility:hidden;display: none;"></div>
            <div class="home-portfolio left">  
                
                <?php 
                        $args2=array( 'post_type' => 'projects', 'post_status' => 'publish', 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1);

                        //The Query
                        query_posts($args2);

                        //The Loop
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
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
                <?php else: ?>
                <?php endif; ?>      
                
                <?php get_template_part( 'inc/postformats/loadmore' );?>
                
            </div><!--/home-portfolio-->
            
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>