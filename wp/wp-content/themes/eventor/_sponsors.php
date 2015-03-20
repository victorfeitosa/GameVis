<?php
/*

Template Name: Sponsors

*/
get_header();
$prefix = 'tk_';
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
?>

<!------ CONTENT ------>
    <div class="content left">
        <div class="wrapper">

            <div class="bg-title-page left">
                <div class="bg-title-page-center left">
                    <div class="title-page-content left">
                        <h1><?php the_title()?></h1>
                        <?php if ($page_headline !== '') { ?>
                         <span><?php echo '| ' . $page_headline ?></span>
                         <?php } ?>
                    </div><!--/title-page-conten-->
                </div><!--/bg-title-page-center-->
                <div class="bg-title-page-down left"><img src="<?php echo get_template_directory_uri() ?>/style/img/bg-title-page-down.png" alt="img" title="img" /></div>
            </div><!--/bg-title-page-->

            <div class="blog-holder left">

                
            <?php //Page Content
                if(!empty($post->post_content)) { ?>
                    <div class="gallery-text left">
                        <div class="shortcodes bottom-margin">
                            <?php
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                                the_content();
                            endwhile; endif;
                            ?>
                        </div><!--/contact-text-->
                    </div><!--/gallery-text-->
                <?php } ?>
                
                
                
                                        <?php
                        $args=array(
                                'orderby' => 'name',
                                'order' => 'ASC'
                        );
                        $categories=get_categories($args);
                        foreach($categories as $category) {
                            $check_posts = array('post_type' => 'pt_sponsors', 'post_status' => 'publish', 'cat' => $category->cat_ID, 'posts_per_page' => 100);
                            $check_cat = new WP_Query();
                            $check_cat->query($check_posts);
                            if (!empty($check_cat->posts)) {?>
                        <div class="speakers-row left">
                            <h3><?php echo $category->name;?></h3>
                            <div class="sponsors-row left">
                                    <?php
                                    $post_counter = 1;
                                    while($check_cat->have_posts()) : $check_cat->the_post();
                                    $sponsor_link = get_post_meta($post->ID, 'tk_sponsor_link', true);
                                    ?>
                                        <div class="sponsors-one left">
                                            
                                            <?php the_post_thumbnail('sponsor'); ?>
                                          
                                            <div class="sponsor-title">
                                                <img class="sponsor-corner" src="<?php echo get_template_directory_uri(); ?>/style/img/corner.png" alt="corner" />
                                                <?php if(!empty($sponsor_link)){ ?>
                                                    <a href="<?php echo $sponsor_link; ?>"><?php the_title(); ?></a>      
                                                <?php } else { ?>
                                                    <p><?php the_title(); ?></p>
                                                <?php } ?>
                                            </div><!-- sponsor-title -->
                                        </div><!-- /sponsors-one -->
                                    <?php $post_counter++;  endwhile;?>
                            </div><!-- /sponsors-row -->
                        </div>
                            <?php } }?>


            </div><!-- /blog-holder -->

        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>
