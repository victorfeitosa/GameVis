<?php
get_header();

$prefix = 'tk_';
?>

<!-- CONTENT STARTS -->
<section>
    <div class="container home-container">

        <!-- Page Content -->
        <div class="row-fluid">
            
            <!-- Main Content -->
            <div id="content" class="span12">
                
                <article class="blog_post blog_listing">  
                    <?php
                        // The Loop
                        if (have_posts()): while (have_posts()) : the_post();


                        //Get Post Loop
                        get_template_part('page-templates/_part_loop');

                        endwhile; 
                        endif; 
                    ?>
                </article>

                <div class="clear"></div>
            </div><!-- #content -->

        </div><!-- row-fluid -->

<?php get_footer(); ?>