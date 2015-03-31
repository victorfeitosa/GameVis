<?php
get_header();
$prefix = 'tk_';
$post_id = $post->ID;
$slider_height = get_theme_option(tk_theme_name.('_home_slider_height'));
?>


        <?php
            /*******SLIDER******/
            $check_slider = get_theme_option(tk_theme_name.'_home_select_slider');
            $slider_alias = get_theme_option(tk_theme_name.'_home_slider_id');
        ?>


    <?php if ($check_slider == 'revolution') {?>
        <?php if (function_exists('putRevSlider')) { ?>
            <div class="slider-home left">
                <?php  putRevSlider($slider_alias);?>
            </div><!--/home-slider-->
        <?php } ?>
            
    <?php } elseif ($check_slider == 'slitslider') { ?>

            </script>
            
            <div id="work-slider" class="work-slider"></div>
            <div class="slider-content left demo-2">
                
                <div id="slider" class="sl-slider-wrapper" style="height: <?php echo $slider_height?>px">

                        <div class="sl-slider">

                            <?php
                            $i = 0;
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                            $args = array('post_status' => 'publish', 'post_type' => 'slider', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                            // The Query
                            query_posts ($args);
                            // The Loop
                            if (have_posts()): while (have_posts()) : the_post();

                            $background_color = get_post_meta($post->ID, $prefix.'background_color', true);                
                            $slider_link = get_post_meta($post->ID, $prefix.'slider_link', true);
                            $slider_heading_color = get_post_meta($post->ID, $prefix.'slider_heading_color', true);
                            $slider_heading_hover_color = get_post_meta($post->ID, $prefix.'slider_heading_hover_color', true);
                            $slider_paragraph_color = get_post_meta($post->ID, $prefix.'slider_paragraph_color', true);
                            $pattern_upload = get_post_meta($post->ID, $prefix.'pattern_upload', true);

                            $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slitslide');
                            ?>

                            <style>                    
                                .sl-slide-horizontal  .inner<?php echo $post->ID ?> {
                                    background:url('<?php echo $image_full[0]; ?>') center no-repeat, url('<?php echo $pattern_upload; ?>') center repeat, #<?php echo $background_color; ?>;          
                                }

                                .sl-slide-horizontal .inner<?php echo $post->ID ?>  h2,   .inner<?php echo $post->ID ?>  h2 a {
                                    color:#<?php echo $slider_heading_color  ?>;
                                }

                                .inner<?php echo $post->ID ?>  h2 a:hover {
                                    color:#<?php echo $slider_heading_hover_color; ?>
                                }

                                .inner<?php echo $post->ID ?> p {
                                    color:#<?php echo $slider_paragraph_color  ?>;
                                }
                            </style>


                                <div class="sl-slide"  <?php if(!empty($background_color)) { ?>style="background-color:<?php echo $background_color; ?>;"<?php } ?>  data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                                    <div class="sl-slide-inner <?php echo 'inner'.$post->ID ?> slider-text-holder">
                                        <div class="bg-img bg-img-1"></div>
                                        <div class="slider-text-wrapper">
                                            <?php if(!empty($slider_link)){ ?>
                                                <h2><a target="_blank" href="<?php echo $slider_link; ?>"><?php the_title(); ?></a></h2>
                                            <?php } else { ?>
                                                <h2><?php the_title(); ?></h2>
                                            <?php } ?>
                                        <blockquote><?php the_content(); ?></blockquote>
                                        </div>
                                    </div>
                                </div>

                            <?php $i++; endwhile; endif; ?>



                        </div><!-- /sl-slider -->

                        <nav id="nav-arrows" class="nav-arrows">
                            <span class="nav-arrow-prev">Previous</span>
                            <span class="nav-arrow-next">Next</span>
                        </nav>

                        <nav id="nav-dots" class="nav-dots">                
                            <?php
                            $c = 1;
                            while($c <= $i){ ?>                
                                <?php if($c == 1) { ?>
                                    <span class="nav-dot-current"></span>
                                <?php } else { ?>
                                    <span></span>
                                <?php } ?>
                            <?php $c++; } ?>
                        </nav>
                    </div><!-- /slider-wrapper -->

                </div><!--/slider-content-->
    <?php } //Slit slider end?>
            
            

    <!-- CONTENT -->
    <div class="content left">
        <div class="border-white left"></div>
        <div class="wrapper">

            <?php
            $call_to_action_show = get_theme_option(tk_theme_name.'_home_use_call_to_action');
            $call_to_action_title = get_theme_option(tk_theme_name.'_home_call_to_action_title');
            $call_to_action_undertitle = get_theme_option(tk_theme_name.'_home_call_to_action_undertitle');
            $call_to_action_text = get_theme_option(tk_theme_name.'_home_call_to_action_text');
            $call_to_action_button = get_theme_option(tk_theme_name.'_home_call_to_action_button_text');
            $call_to_action_button_url = get_theme_option(tk_theme_name.'_home_call_to_action_button_url');
            $counter_date = get_theme_option(tk_theme_name.'_home_datepicker');
            $counter_date = explode('-', $counter_date);
            $counter_time = get_theme_option(tk_theme_name.'_home_timepicker');
            $counter_time = explode(':', $counter_time);
            
            $use_countdown = get_theme_option(tk_theme_name.'_home_use_countdown');

            if($call_to_action_show == 'yes') {
            ?>

                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        var time = new Date();
                        time = new Date(<?php echo $counter_date[2]; ?>,<?php echo $counter_date[1]; ?>-1,<?php echo $counter_date[0]; ?>,<?php echo $counter_time[0]; ?>,<?php echo $counter_time[1]; ?>);
                        jQuery('.jcounter').countdown({
                            until: time,
                            timeSeparator: " ",
                            compact: true,
                            layout: '{dnnn} {hnn} {mnn}',
                            description: '',
                            compactLabels: ['', '', '', '']
                        });
                    })
                </script>

            <div class="home-ticket-box left">
                <div class="home-ticket-box-center left">
                    <div class="home-ticket-box-left left">
                        <div class="call-to-action-title"><?php echo $call_to_action_title?></div>
                        <span><?php echo $call_to_action_undertitle?></span>
                        <div class="shortcodes"><p><?php echo nl2br($call_to_action_text)?></p></div>
                    </div><!--/home-ticket-box-left-->
                    <div class="home-ticket-box-right right">

                        <?php if($use_countdown == 'yes') {?>
                            <div class="counter-holder">
                                <div>
                                    <div class="counter-text"><?php _e('Days', tk_theme_name) ?></div>
                                    <div class="counter-text hours"><?php _e('Hours', tk_theme_name) ?></div>
                                    <div class="counter-text"><?php _e('Minutes', tk_theme_name) ?></div>
                                </div>

                                    <div class="counter-bg">
                                        <div class="jcounter"></div>
                                    </div>

                            </div>

                            <div class="clear"></div>
                        <?php }?>
                        
                        <a href="<?php echo $call_to_action_button_url?>">
                                <?php echo $call_to_action_button?>
                        </a>
                    </div><!--/home-ticket-box-right-->
                </div><!--/home-ticket-box-center-->
            </div><!--/home-ticket-box-->

        <?php }
            $show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');
                if($show_home_content == 'yes') {
        ?>

                <div class="shortcodes left">
                        <?php
                        /* Run the loop to output the page.
                                                 * If you want to overload this in a child theme then include a file
                                                 * called loop-page.php and that will be used instead.
                        */
                        wp_reset_query();
                        query_posts( 'page_id=' . get_theme_option(tk_theme_name.'_home_home_content') );
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                                the_content();
                            endwhile;
                        else:
                        endif;
                        wp_reset_query();
                        ?>
            </div><!--/wrapper-->

        <?php }?>

            </div><!--/wrapper-->

            <div class="wrapper">
 <?php

        /*************************************************************/
        /************PROGRAM AND SPEAKERS************************/
        /*************************************************************/

        $program_ID = get_option('id_program_page');
        $speakers_ID = get_option('id_speakers_page');
        $display_boxes_type = get_theme_option(tk_theme_name.'_home_display_boxes');
        if($display_boxes_type == 'program_and_speaker') {
        ?>

                <div class="bg-home-post left">
                <div class="bg-home-post-top left">
                    <span><?php _e('Program Schedule', tk_theme_name)?></span>
                    <a href="<?php echo get_permalink($program_ID)?>">
                        <div class="more-info-button"><?php _e('More Info', tk_theme_name) ?></div>
                    </a>
                </div><!--/bg-home-post-top-->
                <div class="bg-home-post-center left">
                    <div class="home-post-center-content left">

                <?php
                $program_category = get_theme_option(tk_theme_name.'_home_program_category');
                $program_paged = get_theme_option(tk_theme_name.'_home_program_per_page');
                if ($program_category == 0) {
                    $check_posts = array('post_type' => 'pt_program', 'post_status' => 'publish', 'cat' => $program_category, 'order' => 'ASC', 'posts_per_page' => $program_paged);    
                } else {    
                    $check_posts = array('post_type' => 'pt_program', 'post_status' => 'publish', 'order' => 'ASC', 'posts_per_page' => $program_paged, 'tax_query' => array(array('taxonomy' => 'ct_program', 'field' => 'term_id', 'terms' => $program_category)) );
                }
                    $check_cat = new WP_Query();
                    $check_cat->query($check_posts);
                    if (!empty($check_cat->posts)) {
                    $program_cat = get_the_term_list( $check_cat->posts[0]->ID, 'ct_program');
                    ?>

                    <h5><?php echo $program_cat; ?></h5>

                                <?php
                                $post_counter = 1;
                                while($check_cat->have_posts()) : $check_cat->the_post();
                                $post_hour = get_post_meta($post->ID, $prefix.'program_time-hour', true);
                                $post_minute = get_post_meta($post->ID, $prefix.'program_time-minute', true);
                                $post_time_ampm = get_post_meta($post->ID, $prefix.'program_time-ampm', true);
                                ?>

                        <span><?php echo $post_hour.':'.$post_minute;if($post_time_ampm != '24h'){echo ' '.$post_time_ampm;}?> <?php the_title()?></span>
                        <div class="shortcodes left">
                            <?php the_content()?>
                        </div>
                                    <?php endwhile;?>

                            <?php }?>


                    </div><!--/home-post-center-content-->

                </div><!--/bg-home-post-center-->
                <div class="bg-home-post-down left"><img src="<?php echo get_template_directory_uri(); ?>/style/img/bg-home-post-down.png" alt="img" title="img" /></div><!--/bg-home-post-down-->
            </div><!--/bg-home-post-->


            <div class="bg-home-post right">
                <div class="bg-home-post-top left">
                    <span><?php _e('Speaker Lineup', tk_theme_name) ?></span>
                    <a href="<?php echo get_permalink($speakers_ID)?>">
                        <div class="more-info-button"><?php _e('More Info', tk_theme_name) ?></div>
                    </a>
                </div><!--/bg-home-post-top-->

                <div class="bg-home-post-center left">
                    <div class="home-post-center-content left">

                <?php
                $speakers_number = get_theme_option(tk_theme_name.'_home_speakers_number');
                if(!isset ($speakers_number)){$speakers_number = 5;}
                $args=array('post_type' => 'speaker', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page'=>5, 'posts_per_page'=>$speakers_number);

                //The Query
                $the_query = new WP_Query( $args );

                $item_counter=0;

                //The Loop
                if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                $member_title = get_post_meta($post->ID, $prefix.'title_info', true);
                ?>
                        
                        <div class="home-post-one left">
                            <div class="home-post-one-img left">
                                <?php the_post_thumbnail('home_speaker'); ?>
                                <a href="<?php the_permalink()?>"><p></p></a>
                            </div><!--/home-post-one-img-->
                            <div class="home-post-one-text right">
                                <a href="<?php the_permalink()?>"><?php the_title() ?></a>
                                <?php if($member_title) { ?><p><?php echo $member_title; ?></p><?php } ?>
                                <div class="home-speaker-excerpt"><?php the_excerpt_length(95);?></div>
                                <div class="home-post-one-button left color"><a href="<?php the_permalink()?>"><?php _e('More Info', tk_theme_name) ?></a></div>
                            </div><!--/home-post-one-text-->
                        </div><!--/home-post-one-->

                        <?php
                    endwhile;
                    // Reset Post Data
                    wp_reset_postdata();
                    ?>

                <?php else: ?>
                <?php endif;?>


                    </div><!--/home-post-center-content-->
                </div><!--/bg-home-post-center-->
                <div class="bg-home-post-down left"><img src="<?php echo get_template_directory_uri(); ?>/style/img/bg-home-post-down.png" alt="img" title="img" /></div><!--/bg-home-post-down-->
            </div><!--/bg-home-post-->


<?php }elseif($display_boxes_type == 'program'){?>

            <div class="shortcodes left">
                    <div class="bg-program-top left">
                    <span><?php _e('Program Schedule', tk_theme_name) ?></span>
                    <a href="<?php echo get_permalink($program_ID)?>">
                            <div class="more-info-button full-program"><?php _e('More Info', tk_theme_name) ?></div>
                    </a>
                </div><!--/bg-home-post-top-->
                    <div class="bg-program-center left">
                    <div class="home-single-program left">

                <?php
                $program_category = get_theme_option(tk_theme_name.'_home_program_category');
                $program_paged = get_theme_option(tk_theme_name.'_home_program_per_page');
                if ($program_category == 0) {
                    $check_posts = array('post_type' => 'pt_program', 'post_status' => 'publish', 'cat' => $program_category, 'order' => 'ASC', 'posts_per_page' => $program_paged);    
                } else {    
                    $check_posts = array('post_type' => 'pt_program', 'post_status' => 'publish', 'order' => 'ASC', 'posts_per_page' => $program_paged, 'tax_query' => array(array('taxonomy' => 'ct_program', 'field' => 'term_id', 'terms' => $program_category)) );
                }
                    $check_cat = new WP_Query();
                    $check_cat->query($check_posts);
                    if (!empty($check_cat->posts)) {
                    $program_cat = get_the_term_list( $check_cat->posts[0]->ID, 'ct_program');
                    ?>
                            <h5><?php echo $program_cat ?></h5>
                            
                                <?php
                                $post_counter = 1;
                                while($check_cat->have_posts()) : $check_cat->the_post();
                                $post_hour = get_post_meta($post->ID, $prefix.'program_time-hour', true);
                                $post_minute = get_post_meta($post->ID, $prefix.'program_time-minute', true);
                                $post_time_ampm = get_post_meta($post->ID, $prefix.'program_time-ampm', true);
                                ?>

                        
                            <div class="program-bg left">
                                <div class="program-title left"><?php echo $post_hour.':'.$post_minute;if($post_time_ampm != '24h'){echo ' '.$post_time_ampm;}?> <?php the_title(); ?></div>
                            </div><!-- /program-bg -->
                              <?php the_content()?>
                            <?php endwhile;?>

                            <?php }?>

                    </div><!--/home-post-center-content-->

                </div><!--/bg-home-post-center-->
                <div class="bg-program-down left"><img src="<?php echo get_template_directory_uri(); ?>/style/img/bg-program-down.png" alt="img" title="img" /></div><!-- /bg-program-down -->
            </div><!--/bg-home-post-->



<?php } elseif($display_boxes_type == 'speakers') { ?>

            <div class="shortcodes left">
                    <div class="bg-program-top left">
                    <span><?php _e('Speaker Lineup', tk_theme_name) ?></span>
                    <a href="<?php echo get_permalink($speakers_ID)?>">
                        <div class="more-info-button full-program"><?php _e('More Info', tk_theme_name) ?></div>
                    </a>
                </div><!--/bg-home-post-top-->

            <div class="bg-program-center left">
                    <div class="home-single-program left">

                <?php
                $speakers_number = get_theme_option(tk_theme_name.'_home_speakers_number');
                if(!isset ($speakers_number)){$speakers_number = 5;}
                $args=array('post_type' => 'speaker', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page'=>5, 'posts_per_page'=>$speakers_number);

                //The Query
                $the_query = new WP_Query( $args );

                $item_counter=0;

                //The Loop
                if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                $member_title = get_post_meta($post->ID, $prefix.'title_info', true);
                ?>

                        <div class="home-post-one left">
                            <div class="home-post-one-img left">
                                <?php the_post_thumbnail('home_speaker'); ?>
                                <a href="<?php the_permalink()?>"><p></p></a>
                            </div><!--/home-post-one-img-->
                            <div class="home-post-one-text only-speakers right">
                                <a href="<?php the_permalink()?>"><?php the_title() ?></a>
                                <?php if($member_title) { ?><p><?php echo $member_title; ?></p><?php } ?>
                                <div class="home-speaker-excerpt"><?php the_excerpt_length(320);?></div>
                                <div class="home-post-one-button left"><a href="<?php the_permalink()?>"><?php _e('More Info', tk_theme_name) ?></a></div>
                            </div><!--/home-post-one-text-->
                        </div><!--/home-post-one-->
                        
                        <?php
                    endwhile;
                    // Reset Post Data
                    wp_reset_postdata();
                    ?>

                <?php else: ?>
                <?php endif;?>


                    </div><!--/home-post-center-content-->
                </div><!--/bg-home-post-center-->
                <div class="bg-program-down left"><img src="<?php echo get_template_directory_uri(); ?>/style/img/bg-program-down.png" alt="img" title="img" /></div><!-- /bg-program-down -->
            </div><!--/bg-home-post-->



<?php }?>


 <?php

        /*************************************************************/
        /************HORIZONTAL SLIDER*****************************/
        /*************************************************************/

        $use_horizontal_slider = get_theme_option(tk_theme_name.'_home_use_horizontal_slider');
        $horizontal_category = get_theme_option(tk_theme_name.'_home_horizontal_slider_category');
        $horizontal_slide_number = get_theme_option(tk_theme_name.'_home_horizontal_slider_number');
        $sponsors_title = get_option('id_sponsors_page');
        if($use_horizontal_slider == 'yes') {?>
        <div class="horizontal-slider left">
                <div id="imageline">
                    <?php if(!empty($sponsors_title)){ ?>
                    <h3><?php echo get_the_title($sponsors_title); ?></h3>
                    <?php } ?>
                    <ul class="jcarousel-skin-tango" id="mycarousel">

       <?php $check_posts = array('post_type' => 'pt_sponsors', 'post_status' => 'publish', 'cat' => $horizontal_category, 'posts_per_page'=>$horizontal_slide_number);
            $check_cat = new WP_Query();
            $check_cat->query($check_posts);
            if (!empty($check_cat->posts)) {
                while($check_cat->have_posts()) : $check_cat->the_post();
                $sponsor_link = get_post_meta($post->ID, 'tk_sponsor_link', true);
                $default_attr = array(
                    'id'	=> $sponsor_link,
                );
                ?>

                    <li>
                        <a href="<?php echo $sponsor_link; ?>">
                            <?php the_post_thumbnail('sponsor', $default_attr); ?>
                        </a>
                        <div class="sponsor-title">
                            <img class="sponsor-corner" src="<?php echo get_template_directory_uri(); ?>/style/img/corner.png" alt="corner" />
                            <?php if(!empty($sponsor_link)){ ?>
                                <a href="<?php echo $sponsor_link; ?>"><?php the_title(); ?></a>      
                            <?php } else { ?>
                                <p><?php the_title(); ?></p>
                            <?php } ?>
                        </div><!-- sponsor-title -->
                    </li>

            <?php endwhile;?>
            <?php  } ?>
                    </ul>
                </div>
            </div><!--/horizontal-slider-->
        <?php }?>


            </div><!--/wrapper-->


<?php get_footer(); ?>
