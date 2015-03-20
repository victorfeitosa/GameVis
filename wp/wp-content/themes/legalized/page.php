<?php
get_header();

$prefix = 'tk_';

/* Page subtitle */
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);

/* Sidebar position */
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}

/* Content padding */
if ($sidebar_postition == 'right'){
    $padding = 'style="padding-right:20px;"';
}else if($sidebar_postition == 'left'){
    $padding = 'style="padding-left:20px;"';
}else{
    $padding = '';
}

/* Selected sidebar */
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);

?>


<!-- CONTENT STARTS -->
<section>
    <div class="container">

            <!-- Page Title -->
            <div class="row-fluid">
                <div class="span12">
                    <?php if (is_front_page()) { ?>
                        <h1 class="hero_heading"><?php echo $page_headline; ?></h1>
                    <?php } else { ?>
                        <h1 class="page_title"><?php the_title(); ?></h1>
                        <?php if ($page_headline !== '') { ?>
                            <h2 class="page_description"><?php echo $page_headline; ?></h2>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator.png" alt="separator" />
                </div>
            </div>
            <br>



            <!-- Page Content -->
            <div class="row-fluid">

                
                <!-- Main Content -->
                <div id="content" class="<?php if($sidebar_postition == 'right'){echo 'span8 pull-left';}elseif($sidebar_postition == 'left'){echo 'span8 pull-right';}elseif($sidebar_postition == 'fullwidth'){echo 'span12';}?>">
                        
                    <div class="page" <?php echo $padding; ?>>     
                        <?php
                            wp_reset_query();
                            if (have_posts()) : while (have_posts()) : the_post();
                                    the_content();
                                endwhile;
                            else:
                            endif;
                            wp_reset_query();
                        ?>
                    </div>

                </div><!-- #content -->

                

                <!-- Sidebar Left -->
                <?php 
                    if ($sidebar_postition == 'left'){
                        echo '<div class="span4 pull-left" style="margin-left:0px;">';
                            tk_get_sidebar('Left', $sidebar_select);
                        echo '</div>';
                    }
                ?>


                <!-- Sidebar Right -->
                <?php 
                    if ($sidebar_postition == 'right'){
                        echo '<div class="span4 pull-right">';
                            tk_get_sidebar('Right', $sidebar_select);
                        echo '</div>';
                    }
                ?>
                
            </div><!-- row-fluid -->



<?php get_footer(); ?>