<?php get_header();
$prefix = 'tk_';
?>

    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">


            <div id="fakeholder" style="visibility:hidden;display: none;"></div>

            <div class="home-portfolio left">
                
                
                <div class="home-portfolio-one logo-home-help left">         
                    
                    <!--LOGO-->
                    <div class="logo left">
                   <?php
                        $logo2 = get_option(tk_theme_name.'_general_home_logo');
                        if(empty($logo2)) {
                        $logo2 = get_template_directory_uri()."/style/img/logo.png";
                     }?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo2; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                    </div>
          
                    <?php get_template_part( 'inc/category_navigation' );?> 
                         
                </div><!--/home-portfolio-one-->   
                
                <?php 
                        $args=array('post_type' => 'projects',  'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>1);

                        //The Query
                        query_posts($args);

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

                
                <div class="home-portfolio-one logo-home left">     
                    
                    <!--LOGO-->
                    <div class="logo left">
                   <?php
                        $logo2 = get_option(tk_theme_name.'_general_home_logo');
                        if(empty($logo2)) {
                        $logo2 = get_template_directory_uri()."/style/img/logo.png";
                     }?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo2; ?>" alt='<?php bloginfo('name') ?>' title="<?php bloginfo('name') ?>"/></a>
                    </div>
                    
                    <?php get_template_part( 'inc/category_navigation' );?> 
                          
                </div><!--/home-portfolio-one-->   
                
                <?php 
                        $args2=array('post_type' => 'projects',  'post_status' => 'publish', 'ignore_sticky_posts'=> 1,  'posts_per_page' => 4, 'offset' => 1);

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
                
                
                <?php get_template_part( 'inc/postformats/home-loadmore' );?>
                
                
            </div><!--/home-portfolio-->
            
            

        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>