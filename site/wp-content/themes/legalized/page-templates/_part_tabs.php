<?php

$prefix = 'tk_';

$post_id = $post->ID;

// Enable Single Work Post
$enable_single = get_theme_option(tk_theme_name.'_work_work_single');

// Get tab's selected post type
$get_post_type_fist = get_option('col_1-'.$post->ID);
$get_post_type_second= get_option('col_2-'.$post->ID);
$get_post_type_third = get_option('col_3-'.$post->ID);


// Get first Tab title
if ($get_post_type_fist == 'work') {
    $first_tab_title = get_option('sub_work_title_first_tab-'.$post->ID);
} elseif ($get_post_type_fist == 'news') {
    $first_tab_title = get_option('sub_news_title_first_tab-'.$post->ID);
} elseif ($get_post_type_fist == 'testimonials') {
    $first_tab_title = get_option('sub_testimonial_title_first_tab-'.$post->ID);
} elseif ($get_post_type_fist == 'content') {
    $first_tab_title = get_option('sub_content_title_first_tab-'.$post->ID);
}


// Get second tab title
if ($get_post_type_second == 'work') {
    $second_tab_title = get_option('sub_work_title_second_tab-'.$post->ID);
} elseif ($get_post_type_second == 'news') {
    $second_tab_title = get_option('sub_news_title_second_tab-'.$post->ID);
} elseif ($get_post_type_second == 'testimonials') {
    $second_tab_title = get_option('sub_testimonial_title_second_tab-'.$post->ID);
} elseif ($get_post_type_second == 'content') {
    $second_tab_title = get_option('sub_content_title_second_tab-'.$post->ID);
}


// Get third tab title
if ($get_post_type_third == 'work') {
    $third_tab_title = get_option('sub_work_title_third_tab-'.$post->ID);
} elseif ($get_post_type_third == 'news') {
    $third_tab_title = get_option('sub_news_title_third_tab-'.$post->ID);
} elseif ($get_post_type_third == 'testimonials') {
    $third_tab_title = get_option('sub_testimonial_title_third_tab-'.$post->ID);
} elseif ($get_post_type_third == 'content') {
    $third_tab_title = get_option('sub_content_title_third_tab-'.$post->ID);
}


?>

<div class="row-fluid part_home">
    <div class="tabbable tabs-left">


        <ul class="nav nav-tabs vertical_tabs">
            <?php 
                if ($get_post_type_fist !== 'select') {
                    echo '<li class="active"><a href="#tab1" data-toggle="tab" class="rounded first_tab">'.$first_tab_title.'</a></li>';
                } 
                if($get_post_type_second !== 'select') {
                    echo '<li class=""><a href="#tab2" data-toggle="tab" class="rounded second_tab">'.$second_tab_title.'</a></li>';
                } 
                if($get_post_type_third !== 'select') {
                    echo '<li class=""><a href="#tab3" data-toggle="tab" class="rounded third_tab">'.$third_tab_title.'</a></li>';
                }
            ?> 
        </ul>



        <!-- Tab content -->
        <div class="tab-content">


<?php
//////////////////////////////
//                          //
//      FIRST TAB           //
//                          //
//////////////////////////////
?>    

<!-- WORK FIRST TAB -->
<?php if ($get_post_type_fist == 'work') { ?>


        <div class="tab-pane fade active in" id="tab1">
            <div class="row-fluid">
                <?php
                    $work_post_cat = get_option('sub_work_category_first_tab-'.$post->ID);

                    if ($work_post_cat == '0') {
                        $operator = 'ALL';
                    } else {
                        $operator = 'IN';
                    }

                    $args1 = array('post_status' => 'publish', 'post_type' => 'work', 'posts_per_page' => 2, 'tax_query' => array(array('taxonomy' => 'ct_work', 'field' => 'term_id', 'terms' => $work_post_cat,  'operator' => $operator )));

                    //The Query
                    query_posts($args1);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                <div class="span6">
                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                        <div class="<?php if (has_post_thumbnail()) { echo 'flipper'; } ?>">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="front rounded">
                                    <?php if (has_post_thumbnail()) { the_post_thumbnail('work-3-column'); } ?>
                                </div>
                            <?php } ?>
                            <div class="back rounded <?php if (!has_post_thumbnail()) { echo 'fixed'; } ?>">
                                <?php if($enable_single == 'yes'){ ?>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php } else { ?>
                                    <h3><?php the_title(); ?></h3>
                                <?php } ?>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-small.png" alt="separator" />
                                    </div>
                                </div>
                               <?php the_excerpt_length(100); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>  
        </div><!-- /tab-pane -->    


<!-- NEWS FIRST TAB -->
<?php } elseif ($get_post_type_fist == 'news') { ?>


        <div class="tab-pane fade active in" id="tab1">
            <div class="row-fluid">
                <?php
                    $news_post_cat = get_option('sub_news_category_first_tab-'.$post->ID);

                    if ($news_post_cat == '0') {
                        $args2 = array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => 2);
                    } else {
                        $args2 = array('post_status' => 'publish', 'post_type' => 'post', 'cat' => $news_post_cat, 'posts_per_page' => 2);
                    }

                    // The Query
                    query_posts($args2);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();

                    $format = get_post_format();

                    $post_day = get_the_date('d');
                    $post_month = get_the_date('M');
                    $post_year = get_the_date('Y');
                ?> 

                <div class="span6 home-tabs-news">
                    <div class="vertical_tabs_content tabs_home">
                        <div class="tab_date rounded"><span><?php echo $post_day; ?></span><?php echo $post_month; ?><br><?php echo $post_year; ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="by"><?php the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', tk_theme_name) ?></a></span>
                        <div class="clear"></div>
                        <p><?php the_excerpt_length(120); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read_more"><?php _e('Read more', tk_theme_name); ?></a>
                    </div>
                </div>
                
                <?php endwhile; endif; wp_reset_postdata();?> 
                
            </div> 
        </div><!-- /tab-pane -->


<!-- TESTIMONIALS FIRST TAB -->                        
<?php } elseif ($get_post_type_fist == 'testimonials') { ?>


        <div class="tab-pane fade active in" id="tab1">
            <div class="row-fluid">
                <?php
                    $testimonial_post_first_tab = get_option('sub_testimonial_first_tab-'.$post_id);
                    $random_post = get_option('sub_check_testimonials_first_tab-'. $post_id);

                    if($random_post[0] == 'yes'){
                        $args3 = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                    } else {
                        $args3 = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post_first_tab);
                    }

                    //The Query
                    query_posts($args3);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                    $name_user = get_post_meta($post->ID, $prefix.'job_position', true);
                    $avatar = get_avatar( $email_avatar, 72);
                ?>

                <div class="span12">
                    <div class="vertical_tabs_content tab_testimonial rounded">
                        <?php if ($email_avatar) {
                            if(isset($avatar)){ ?>
                                <div class="gravatar rounded"><?php echo $avatar; ?></div>
                        <?php } } ?>
                        <h3><?php the_title();?></h3>
                        <span class="by"><?php echo $name_user; ?></span>
                        <div class="clear"></div>
                        <div class="row-fluid">
                            <div class="span12">
                                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-medium.png" alt="separator" />
                            </div>
                        </div>
                        <?php the_content();?>
                    </div>
                </div>

                <?php endwhile; endif; wp_reset_postdata();?>  

            </div>
        </div><!-- /tab-pane --> 



<!-- PAGE CONTENT FIRST TAB -->                        
<?php } elseif ($get_post_type_fist == 'content') { ?>

        <div class="tab-pane fade active in" id="tab1">
            <div class="row-fluid">

                <?php 
                    global $more;    // Declare global $more (before the loop).

                    $page_content_id = get_option('sub_page_content_first_tab-'.$post_id);

                    $args3a = array('post_status' => 'publish', 'post_type' => 'page', 'posts_per_page' =>1, 'p' => $page_content_id);

                    //The Query
                    query_posts($args3a);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $more = 0;
                        the_content("Read more");

                    endwhile; endif; wp_reset_postdata();?> 

            </div>
        </div><!-- /tab-pane -->  

<?php } ?>



<?php
//////////////////////////////
//                          //
//      SECOND TAB          //
//                          //
//////////////////////////////
?> 
<!-- WORK SECOND TAB -->
<?php if ($get_post_type_second == 'work') { ?>

        <div class="tab-pane fade" id="tab2">
            <div class="row-fluid">
                <?php
                    $work_post_cat = get_option('sub_work_category_second_tab-'.$post->ID);

                    if ($work_post_cat == '0') {
                        $operator = 'ALL';
                    } else {
                        $operator = 'IN';
                    }

                    $args4 = array('post_status' => 'publish', 'post_type' => 'work', 'posts_per_page' => 2, 'tax_query' => array(array('taxonomy' => 'ct_work', 'field' => 'term_id', 'terms' => $work_post_cat,  'operator' => $operator )));

                    //The Query
                    query_posts($args4);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();  
                ?>
                <div class="span6">
                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                        <div class="<?php if (has_post_thumbnail()) { echo 'flipper'; } ?>">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="front rounded">
                                    <?php if (has_post_thumbnail()) { the_post_thumbnail('work-3-column'); } ?>
                                </div>
                            <?php } ?>
                            <div class="back rounded <?php if (!has_post_thumbnail()) { echo 'fixed'; } ?>">
                                <?php if($enable_single == 'yes'){ ?>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php } else { ?>
                                    <h3><?php the_title(); ?></h3>
                                <?php } ?>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-small.png" alt="separator" />
                                    </div>
                                </div>
                               <?php the_excerpt_length(100); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>  
        </div><!-- /tab-pane -->    


<!-- NEWS SECOND TAB -->
<?php } elseif ($get_post_type_second == 'news') { ?>


        <div class="tab-pane fade" id="tab2">
            <div class="row-fluid">
                <?php
                    $news_post_cat = get_option('sub_news_category_second_tab-'.$post->ID);

                    if ($news_post_cat == '0') {
                        $args5 = array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => 2);
                    } else {
                        $args5 = array('post_status' => 'publish', 'post_type' => 'post', 'cat' => $news_post_cat, 'posts_per_page' => 2);
                    }

                    // The Query
                    query_posts ($args5);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                    $format = get_post_format();

                    $post_day = get_the_date('d');
                    $post_month = get_the_date('M');
                    $post_year = get_the_date('Y');
                ?> 

                <div class="span6 home-tabs-news">
                    <div class="vertical_tabs_content tabs_home">
                        <div class="tab_date rounded"><span><?php echo $post_day; ?></span><?php echo $post_month; ?><br><?php echo $post_year; ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="by"><?php the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', tk_theme_name) ?></a></span>
                        <div class="clear"></div>
                        <p><?php the_excerpt_length(120); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read_more"><?php _e('Read more', tk_theme_name); ?></a>
                    </div>
                </div>
                
                <?php endwhile; endif; wp_reset_postdata();?> 
                
            </div> 
        </div><!-- /tab-pane -->


<!-- TESTIMONIALS SECOND TAB -->                        
<?php } elseif ($get_post_type_second == 'testimonials') { ?>


        <div class="tab-pane fade" id="tab2">
            <div class="row-fluid">
                <?php
                    $testimonial_post_second_tab = get_option('sub_testimonial_second_tab-'.$post_id);
                    $random_post = get_option('sub_check_testimonials_second_tab-'. $post_id);

                    if($random_post[0] == 'yes'){
                        $args6 = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                    } else {
                        $args6 = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post_second_tab);
                    }

                    //The Query
                    query_posts($args6);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                    $name_user = get_post_meta($post->ID, $prefix.'job_position', true);
                    $avatar = get_avatar( $email_avatar, 72);
                ?>

                <div class="span12">
                    <div class="vertical_tabs_content tab_testimonial rounded">
                        <?php if ($email_avatar) {
                            if(isset($avatar)){ ?>
                                <div class="gravatar rounded"><?php echo $avatar; ?></div>
                        <?php } } ?>
                        <h3><?php the_title();?></h3>
                        <span class="by"><?php echo $name_user; ?></span>
                        <div class="clear"></div>
                        <div class="row-fluid">
                            <div class="span12">
                                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-medium.png" alt="separator" />
                            </div>
                        </div>
                        <?php the_content();?>
                    </div>
                </div>

                <?php endwhile; endif; wp_reset_postdata();?>  

            </div>
        </div><!-- /tab-pane -->  



<!-- PAGE CONTENT SECOND TAB -->                        
<?php } elseif ($get_post_type_second == 'content') { ?>

        <div class="tab-pane fade" id="tab2">
            <div class="row-fluid">

                <?php 
                    global $more;    // Declare global $more (before the loop).

                    $page_content_id = get_option('sub_page_content_second_tab-'.$post_id);

                    $args3b = array('post_status' => 'publish', 'post_type' => 'page', 'posts_per_page' =>1, 'p' => $page_content_id);

                    //The Query
                    query_posts($args3b);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $more = 0;
                        the_content("Read more");

                    endwhile; endif; wp_reset_postdata();?> 

            </div>
        </div><!-- /tab-pane -->  

<?php } ?>


<?php
//////////////////////////////
//                          //
//      THIRD TAB           //
//                          //
//////////////////////////////
?> 

<!-- WORK THIRD TAB -->
<?php if ($get_post_type_third == 'work') { ?>


        <div class="tab-pane fade" id="tab3">
            <div class="row-fluid">
                <?php
                    $work_post_cat = get_option('sub_work_category_third_tab-'.$post_id);

                    if ($work_post_cat == '0') {
                        $operator = 'ALL';
                    } else {
                        $operator = 'IN';
                    }

                    $args7 = array('post_status' => 'publish', 'post_type' => 'work', 'posts_per_page' => 2, 'tax_query' => array(array('taxonomy' => 'ct_work', 'field' => 'term_id', 'terms' => $work_post_cat,  'operator' => $operator )));

                    //The Query
                    query_posts($args7);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();

                ?>
                <div class="span6">
                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                        <div class="<?php if (has_post_thumbnail()) { echo 'flipper'; } ?>">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="front rounded">
                                    <?php if (has_post_thumbnail()) { the_post_thumbnail('work-3-column'); } ?>
                                </div>
                            <?php } ?>
                            <div class="back rounded <?php if (!has_post_thumbnail()) { echo 'fixed'; } ?>">
                                <?php if($enable_single == 'yes'){ ?>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php } else { ?>
                                    <h3><?php the_title(); ?></h3>
                                <?php } ?>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-small.png"  alt="separator"/>
                                    </div>
                                </div>
                               <?php the_excerpt_length(100); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>  
        </div><!-- /tab-pane --> 


<!-- NEWS THIRD TAB -->
<?php } elseif ($get_post_type_third == 'news') { ?>


        <div class="tab-pane fade" id="tab3">
            <div class="row-fluid">
                <?php
                    $news_post_cat = get_option('sub_news_category_third_tab-'.$post->ID);

                    if ($news_post_cat == '0') {
                        $args8 = array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => 2);
                    } else {
                        $args8 = array('post_status' => 'publish', 'post_type' => 'post', 'cat' => $news_post_cat, 'posts_per_page' => 2);
                    }

                    // The Query
                    query_posts ($args8);
                    // The Loop
                    if (have_posts()): while (have_posts()) : the_post();
                    $format = get_post_format();

                    $post_day = get_the_date('d');
                    $post_month = get_the_date('M');
                    $post_year = get_the_date('Y');
                ?> 

                <div class="span6 home-tabs-news">
                    <div class="vertical_tabs_content tabs_home">
                        <div class="tab_date rounded"><span><?php echo $post_day; ?></span><?php echo $post_month; ?><br><?php echo $post_year; ?></div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <span class="by"><?php the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', tk_theme_name) ?></a></span>
                        <div class="clear"></div>
                        <p><?php the_excerpt_length(120); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read_more"><?php _e('Read more', tk_theme_name); ?></a>
                    </div>
                </div>
                
                <?php endwhile; endif; wp_reset_postdata();?> 
                
            </div> 
        </div><!-- /tab-pane -->


<!-- TESTIMONIALS THIRD TAB -->                        
<?php } elseif ($get_post_type_third == 'testimonials') { ?>


        <div class="tab-pane fade" id="tab3">
            <div class="row-fluid">
                <?php
                    $testimonial_post_third_tab = get_option('sub_testimonial_third_tab-'.$post_id);
                    $random_post = get_option('sub_check_testimonials_third_tab-'. $post_id);

                    if($random_post[0] == 'yes'){
                        $args9 = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                    } else {
                        $args9 = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post_third_tab);
                    }

                    //The Query
                    query_posts($args9);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                    $name_user = get_post_meta($post->ID, $prefix.'job_position', true);
                    $avatar = get_avatar( $email_avatar, 72);
                ?>

                <div class="span12">
                    <div class="vertical_tabs_content tab_testimonial rounded">
                        <?php if ($email_avatar) {
                            if(isset($avatar)){ ?>
                                <div class="gravatar rounded"><?php echo $avatar; ?></div>
                        <?php } } ?>
                        <h3><?php the_title();?></h3>
                        <span class="by"><?php echo $name_user; ?></span>
                        <div class="clear"></div>
                        <div class="row-fluid">
                            <div class="span12">
                                <img src="<?php echo get_template_directory_uri(); ?>/style/images/separator-medium.png" alt="separator" />
                            </div>
                        </div>
                        <?php the_content();?>
                    </div>
                </div>

                <?php endwhile; endif; wp_reset_postdata();?>  

            </div>
        </div><!-- /tab-pane -->    


<!-- PAGE CONTENT THIRD TAB -->                        
<?php } elseif ($get_post_type_third == 'content') { ?>

        <div class="tab-pane fade" id="tab3">
            <div class="row-fluid">

                <?php 
                    global $more;    // Declare global $more (before the loop).

                    $page_content_id = get_option('sub_page_content_third_tab-'.$post_id);

                    $args3b = array('post_status' => 'publish', 'post_type' => 'page', 'posts_per_page' =>1, 'p' => $page_content_id);

                    //The Query
                    query_posts($args3b);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        $more = 0;
                        the_content("Read more");

                    endwhile; endif; wp_reset_postdata();?> 

            </div>
        </div><!-- /tab-pane -->  

<?php } ?>




        </div><!-- tab-content -->

    </div><!-- tabs-left -->
</div><!-- /row-fluid -->
<br>