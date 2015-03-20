<?php

global $prefix;

$post_id = $post->ID;

/* Get Team Page ID */
$get_team_id = get_option('id_team_page');

/* Get column */
$get_post_type = get_option('col_1-'.$post->ID);

/* Get selected Service */
$get_service = get_option('sub_services-'.$post->ID); 

// Enable Single Work Post
$enable_single = get_theme_option(tk_theme_name.'_work_work_single');

/* Titles */
$news_title = get_option('sub_news_title-'.$post->ID); 
$services_title = get_option('sub_services_title-'.$post->ID);
$team_title = get_option('sub_team_title-'.$post->ID);
$testimonials_title = get_option('sub_testimonial_title-'.$post->ID);
$work_title = get_option('sub_work_title-'.$post->ID); 
$banner_title = get_option('sub_bulder_banner_title-'.$post->ID); 
$page_content_title = get_option('sub_page_content_title-'.$post->ID); 

?>


<div class="row-fluid part_home">
    

<!-- SERVICES -->
<?php if($get_post_type == 'services') { ?>


        <div class="span12">

            <?php if(!empty($services_title)){ ?>
                <h3><?php echo $services_title; ?></h3>
                <div class="row-fluid">
                    <div class="span12 home-page-border"></div>
                </div>
            <?php } ?>
            
                
            <div class="row-fluid ca-menu one">             
                <?php
                    $args = array('post_type' => 'services', 'post_status' => 'publish', 'posts_per_page' => 1, 'p' => $get_service);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $featured_service_img = get_post_meta($post->ID, $prefix.'featured_service', true);
                    $tk_background_color = get_post_meta($post->ID, $prefix.'background_color', true);
                    $tk_background_hover_color = get_post_meta($post->ID, $prefix.'background_hover_color', true);
                    $tk_headline_color = get_post_meta($post->ID, $prefix.'headline_color', true);
                    $tk_text_color = get_post_meta($post->ID, $prefix.'text_color', true);   
                    $tk_hover_color = get_post_meta($post->ID, $prefix.'hover_color', true);  
                    $tk_subheadline_color = get_post_meta($post->ID, $prefix.'sub_headline_color', true);
                ?>

            <style type="text/css">
                .ca-menu.one .ca-item:hover a.more_link span, .ca-menu.one .ca-item:hover h1, .ca-menu.one .ca-item:hover p{color: #<?php echo $tk_hover_color; ?> !important;}

                .ca-menu .ca-item<?php echo $post->ID; ?>:hover { background-color:#<?php echo $tk_background_hover_color; ?>}
                .ca-menu .ca-item<?php echo $post->ID; ?> {background-color: #<?php echo $tk_background_color; ?>}
                .ca-item<?php echo $post->ID; ?> .ca-main {color: #<?php echo $tk_headline_color; ?>;}
                .ca-item<?php echo $post->ID; ?> .ca-sub {color: #<?php echo $tk_subheadline_color;?>}
                .ca-item<?php echo $post->ID; ?> .more_link {color: #<?php echo $tk_text_color; ?>;}
            </style>

                <div class="span12 ca-item ca-item<?php echo $post->ID; ?> rounded">
                    <a href="<?php the_permalink(); ?>">
                        <?php if(!empty($featured_service_img)) { ?>
                            <span class="ca-icon">
                                <img class="ca-main" src="<?php tk_get_thumb(86, 86, $featured_service_img ); ?>" alt="<?php the_title(); ?>"  title="<?php the_title(); ?>" />
                                <div class="clear"></div>
                            </span>
                        <?php } ?>
                        <div class="ca-content">
                            <h1 class="ca-main"><?php the_title(); ?></h1>
                            <p class="ca-sub"><?php the_excerpt_length(170); ?></p>
                            <a class="more_link" href="<?php the_permalink(); ?>"><span><?php echo __('Read More', tk_theme_name); ?></span></a>
                        </div>
                    </a>
                </div>
                <?php endwhile; endif; ?>
                
            </div>

        </div><!-- /span12 -->



<!-- NEWS -->
<?php } elseif ($get_post_type == 'news') { ?>
                

        <div class="span12 news">

            <script type="text/javascript"> 
                jQuery(window).load(function() {
                    jQuery('.flexslider-left<?php echo $post_id ?>').flexslider({
                        animation: "fade",
                        animationLoop: false,
                        controlNav: false,
                        slideshow: false,
                        prevText: "Prev",
                        nextText: "Next",  
                        controlsContainer: ".flexslider-part-left<?php echo $post_id; ?>"
                    });                          
                });                        
            </script>         
                    

            <?php if(!empty($news_title)){ ?>
                <h3 class="slider-titles"><?php echo $news_title; ?></h3>
            <?php } ?>
            <div class="row-fluid">
                <div class="span12 home-page-border"> </div>
            </div>
            
            

            <div class="flexslider-part wider flexslider-part-left<?php echo $post_id; ?>">
                <div class="flexslider flexslider-left<?php echo $post_id; ?>">
                    <ul class="slides">
                        <?php
                            $news_post_num = get_option('sub_news_number-'.$post->ID);
                            $news_post_cat = get_option('sub_news_category-'.$post->ID);

                            $args = array('post_status' => 'publish', 'post_type' => 'post',  'posts_per_page' => $news_post_num, 'cat' => $news_post_cat );
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();
                            $format = get_post_format();

                            $post_day = get_the_date('d');
                            $post_month = get_the_date('M');
                            $post_year = get_the_date('Y');
                        ?>                                
                        <li>
                            <div class="vertical_tabs_content">
                                <div class="tab_date rounded pull-left"><span><?php echo $post_day; ?></span><?php echo $post_month; ?><br><?php echo $post_year; ?></div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <span class="by"><?php the_author_posts_link(); ?> / <a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', tk_theme_name) ?></a></span>
                                <div class="clear"></div>
                                <p><?php the_excerpt_length(500); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read_more">Read more</a>
                            </div>
                        </li>               
                        <?php endwhile; endif; wp_reset_query();?>                        
                    </ul>
                </div><!-- flexslider -->
            </div>
        
        </div><!-- /span12 -->            
        <div class="clear"></div>

    


<!-- TESTIMONIALS -->
<?php } elseif ($get_post_type == 'testimonials'){ ?>

        
        <div class="span12">

            <?php if(!empty($testimonials_title)){ ?>
                <h3><?php echo $testimonials_title; ?></h3>
                <div class="row-fluid">
                    <div class="span12  home-page-border"></div>
                </div> 
            <?php } ?>           


            <?php
                $testimonial_post = get_option('sub_testimonial-'.$post_id);
                $random_post = get_option('sub_check_testimonials-'. $post_id);

                if($random_post[0] == 'yes'){
                    $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'orderby' => 'rand');
                } else {
                    $args = array('post_status' => 'publish', 'post_type' => 'testimonials', 'posts_per_page' =>1, 'p' => $testimonial_post);
                }

                //The Query
                query_posts($args);

                //The Loop
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                $email_avatar = get_post_meta($post->ID, $prefix.'email', true);
                $name_user = get_post_meta($post->ID, $prefix.'job_position', true);
                $avatar = get_avatar( $email_avatar, 72);

            ?>  

            <div class="row-fluid">
                <div class="span12 vertical_tabs_content tab_testimonial rounded">
                    <?php if ($email_avatar) {
                            if(isset($avatar)){ ?>
                                <div class="gravatar rounded"><?php echo $avatar; ?></div>
                    <?php } } ?>
                    <h3><?php the_title();?></h3>
                    <span class="by"><?php echo $name_user ?></span>
                    <div class="clear"></div>
                    <div class="row-fluid">
                        <div class="span12 home-page-border"></div>
                    </div>
                    <?php the_content();?>
                </div>
            </div>
            <br>
            <br>
            <?php endwhile; endif; ?>

        </div><!-- /span12 --> 


<!-- TEAM -->
<?php } elseif ($get_post_type == 'team') { ?>


        <div class="span12">

            <?php $team_number = get_option('sub_team_number-'.$post->ID);

            if(!empty($team_title)){ ?>
                <h3><?php echo $team_title; ?></h3>
            <?php } ?>
            <div class="row-fluid">
                <div class="span12 home-page-border"></div>
            </div>
            <br>
            


            <script type="text/javascript"> 
                jQuery(window).load(function() {  

                    var sliderWidth = jQuery('.flexslider<?php echo $post_id ?>').width();
                    
                    if(sliderWidth < 418) {
                        var itemWidthCalc = (sliderWidth);
                    } else if(sliderWidth < 500) {
                        var itemWidthCalc = (sliderWidth - 20) / 2;
                    } else if (sliderWidth < 700){
                        var itemWidthCalc = (sliderWidth - 40) / 3;
                    } else {
                        var itemWidthCalc = (sliderWidth - 60) / 4;
                    }                            
                      
                    jQuery('.flexslider<?php echo $post_id; ?>').flexslider({
                        animation: "slide",
                        animationLoop: false,
                        itemWidth: itemWidthCalc,
                        itemMargin: 20,
                        controlNav: false,
                        slideshow: false, 
                        controlsContainer: ".flexslider-part<?php echo $post_id; ?>",
                        minItems: 1
                    });  

                });
                    
                // check grid size on resize event
                jQuery(window).resize(function() {

                    var getFlexslider = jQuery('.flexslider<?php echo $post_id ?>').html();
                    
                    jQuery('.flexslider<?php echo $post_id ?>').remove();
                    jQuery('.flexslider-part<?php echo $post_id ?> .flex-direction-nav').remove();
                    jQuery('.flexslider-part<?php echo $post_id ?>').append('<div class="flexslider flexslider<?php echo $post_id; ?>">'+getFlexslider+'</div>');

                    var sliderWidth = jQuery('.flexslider<?php echo $post_id ?>').width();
                
                    if(sliderWidth < 418) {
                        var itemWidthCalc = (sliderWidth);
                    } else if(sliderWidth < 500) {
                        var itemWidthCalc = (sliderWidth - 20) / 2;
                    } else if (sliderWidth < 700){
                        var itemWidthCalc = (sliderWidth - 40) / 3;
                    } else {
                        var itemWidthCalc = (sliderWidth - 60) / 4;
                    }
                    
                    jQuery('.flexslider<?php echo $post_id; ?>').flexslider({
                        animation: "slide",
                        animationLoop: false,
                        itemWidth: itemWidthCalc,
                        itemMargin: 20,
                        slideshow: false, 
                        controlNav: false,
                        controlsContainer: ".flexslider-part<?php echo $post_id; ?>",
                        minItems: 1
                    });             
                      
                }); 
            </script>


            <div class="flexslider-part team-flexslider flexslider-part<?php echo $post->ID; ?>">
                <div class="flexslider flexslider<?php echo $post->ID; ?>">
                  <ul class="slides">
                   
                        <?php
                            $args = array('post_status' => 'publish', 'post_type' => 'team-members', 'posts_per_page' =>$team_number, 'meta_key'=>'_thumbnail_id');
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();
                            $tk_member_title = get_post_meta($post->ID, $prefix.'title_info', true);
                            $post_link = get_permalink($get_team_id).'#'.$post->post_title;    
                        ?>
                        <li>
                            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                <div class="<?php if (has_post_thumbnail()) { echo 'flipper'; } ?>">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="front rounded">
                                            <?php the_post_thumbnail('teammembers-slide'); ?>
                                        </div>
                                    <?php } ?>
                                    
                                    <div class="back rounded <?php if (!has_post_thumbnail()) { echo 'fixed'; } ?>">
                                        <div class="team-wrap">            
                                            <div class="team-cell">
                                                <h3><a href="<?php echo $post_link; ?>"><?php the_title(); ?></a></h3>
                                               <?php if(!empty($tk_member_title)){ ?><span class="member_title"><?php echo $tk_member_title; ?></span><?php } ?>
                                            </div><!-- team-cell -->
                                        </div><!--  team wrap-->
                                    </div><!-- back -->
                                </div><!-- flipper -->
                           </div>
                        </li>
                        <?php endwhile; endif; ?>

                    </ul>
                </div>
            </div><!-- flexslider-part -->

        </div><!-- /span12 -->
        <div class="clear"></div>



<!-- WORK -->
<?php } elseif ($get_post_type == 'work') { ?>


        <div class="span12 one_work">

            <?php $work_number = get_option('sub_work_number-'.$post->ID);

            if(!empty($work_title)){ ?>
                <h3><?php echo $work_title; ?></h3>
            <?php } ?>
            <div class="row-fluid">
                <div class="span12 home-page-border"></div>
            </div>
            <br>
            


            
            <script type="text/javascript"> 
                jQuery(window).load(function() {  

                    var sliderWidth = jQuery('.flexslider<?php echo $post_id ?>').width();
                    
                    if(sliderWidth < 418) {
                        var itemWidthCalc = (sliderWidth);
                    } else if(sliderWidth < 500) {
                        var itemWidthCalc = (sliderWidth - 20) / 2;
                    } else if (sliderWidth < 700){
                        var itemWidthCalc = (sliderWidth - 40) / 3;
                    } else {
                        var itemWidthCalc = (sliderWidth - 60) / 4;
                    }                            
                      
                    jQuery('.flexslider<?php echo $post_id; ?>').flexslider({
                        animation: "slide",
                        animationLoop: false,
                        itemWidth: itemWidthCalc,
                        itemMargin: 20,
                        controlNav: false,
                        slideshow: false, 
                        controlsContainer: ".flexslider-part<?php echo $post_id; ?>",
                        minItems: 1
                    });  

                });
                    
                // check grid size on resize event
                jQuery(window).resize(function() {

                    var getFlexslider = jQuery('.flexslider<?php echo $post_id ?>').html();
                    
                    jQuery('.flexslider<?php echo $post_id ?>').remove();
                    jQuery('.flexslider-part<?php echo $post_id ?> .flex-direction-nav').remove();
                    jQuery('.flexslider-part<?php echo $post_id ?>').append('<div class="flexslider flexslider<?php echo $post_id; ?>">'+getFlexslider+'</div>');

                    var sliderWidth = jQuery('.flexslider<?php echo $post_id ?>').width();
                
                    if(sliderWidth < 418) {
                        var itemWidthCalc = (sliderWidth);
                    } else if(sliderWidth < 500) {
                        var itemWidthCalc = (sliderWidth - 20) / 2;
                    } else if (sliderWidth < 700){
                        var itemWidthCalc = (sliderWidth - 40) / 3;
                    } else {
                        var itemWidthCalc = (sliderWidth - 60) / 4;
                    }
                    
                    jQuery('.flexslider<?php echo $post_id; ?>').flexslider({
                        animation: "slide",
                        animationLoop: false,
                        itemWidth: itemWidthCalc,
                        itemMargin: 20,
                        slideshow: false, 
                        controlNav: false,
                        controlsContainer: ".flexslider-part<?php echo $post_id; ?>",
                        minItems: 1
                    });             
                      
                }); 
            </script>

            
            
            

            <div class="flexslider-part team-flexslider  flexslider-part<?php echo $post->ID; ?>">
                <div class="flexslider flexslider<?php echo $post->ID; ?>">
                  <ul class="slides">
                   
                        <?php
                            $args = array('post_status' => 'publish', 'post_type' => 'work', 'posts_per_page' => $work_number);
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();                                 
                        ?>
                        <li>
                            <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                <div class="<?php if (has_post_thumbnail()) { echo 'flipper'; } ?>">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="front rounded">
                                            <?php the_post_thumbnail('teammembers-slide'); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="back rounded <?php if (!has_post_thumbnail()) { echo 'fixed'; } ?>">
                                        
                                            <div class="team-wrap">
                                                <div class="team-cell">
                                            <?php if($enable_single == 'yes'){ ?>
                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php } else { ?>
                                                <h3><?php the_title(); ?></h3>
                                            <?php } ?>
                                            
                                                <p class="member_title">                                                
                                                    <?php 
                                                    $work_categories = wp_get_post_terms($post->ID, 'ct_work');                                                 
                                                    $category_count = count($work_categories);

                                                        $i = 1;
                                                        foreach($work_categories as $single_cat) {                                                        
                                                            if($i == $category_count) {
                                                                $comma = '';
                                                            } else {
                                                                $comma = ', ';
                                                            }                                                        
                                                            echo $single_cat -> name.$comma;
                                                            $i++;
                                                        } 
                                                    ?>
                                                </p>
                                            </div><!-- cell-wrap -->
                                        </div><!-- team-wrap -->
                                </div>
                                </div>
                           </div>
                        </li>
                        <?php endwhile; endif; ?>

                    </ul>
                </div>
            </div><!-- flexslider-part -->

        </div><!-- /span12 -->
        <div class="clear"></div>


<!-- ADD BANER -->
<?php } elseif ($get_post_type == 'adbanner'){ ?>


        
        <?php if(!empty($banner_title)){ ?>
            <h3><?php echo $banner_title; ?></h3>
            <div class="row-fluid">
                <div class="span12 home-page-border"></div>
            </div>
            <br>
        <?php } ?>

        <div class="row-fluid">    
            <div class="span12 home-content-ad">
                <?php
                    $ad_post = get_option('sub_bulder_banner-' . $post->ID);               
                    $custom_banner = get_post_meta($ad_post, $prefix.'custom_banner_code', true);
                    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($ad_post), 'full' ); 

                    tk_add_banner_view($ad_post);
                ?>
                <div class="home-content-ad left">
                    <?php if(!empty($custom_banner)) { 
                        echo $custom_banner;        
                    } else { ?>        
                        <a href="<?php site_url(); ?>?banner_id=<?php echo $ad_post; ?>">
                            <img src="<?php echo $image_src[0]; ?>" title="<?php the_title($ad_post)?>" alt="<?php the_title($ad_post)?>"/>
                        </a>
                    <?php } ?>
                </div>
            </div><!-- /span12 -->
        </div>


<!-- CONTENT -->
<?php } elseif ($get_post_type == 'content') { ?>


        <div class="span12">

            <?php if(!empty($page_content_title)){ ?>
                <h3><?php echo $page_content_title; ?></h3>
                <div class="row-fluid">
                    <div class="span12 home-page-border"></div>
                </div>
                <br>
            <?php } ?>
        
            <?php $page_content = get_option('sub_page_content-'.$post_id); ?>

                <?php wp_reset_query();

                global $more;    // Declare global $more (before the loop).
                query_posts('page_id='.$page_content);
                if (have_posts()) : while (have_posts()) : the_post();
                        $more = 0;
                        the_content("Read more");
                    endwhile;
                else:
                endif;

            wp_reset_query(); ?>
        </div><!-- /span12 -->

<?php } ?>


</div><!-- /row-fluid -->