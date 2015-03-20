<?php
get_header();
?>

<script type="text/javascript">

    jQuery(document).ready(function(){
        // NIVO SLIDER
        jQuery('#slider-nivo').nivoSlider({
            effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
            slices:15,
            animSpeed:500, //Slide transition speed
            pauseTime:3000,
            startSlide:0, //Set starting Slide (0 index)
            directionNav:false, //Next & Prev
            directionNavHide:false, //Only show on hover
            height: 250,
            controlNav:true, //1,2,3...
            controlNavThumbs:false, //Use thumbnails for Control Nav
            controlNavThumbsFromRel:false, //Use image rel for thumbs
            controlNavThumbsSearch: '.jpg', //Replace this with...
            controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
            keyboardNav:true, //Use left & right arrows
            pauseOnHover:false, //Stop animation while hovering
            manualAdvance:false, //Force manual transitions
            captionOpacity:0.8, //Universal caption opacity
            beforeChange: function(){},
            afterChange: function(){},
            slideshowEnd: function(){}, //Triggers after all slides have been shown
            lastSlide: function(){}, //Triggers when last slide is shown
            afterLoad: function(){} //Triggers when slider has loaded
        });
     });

</script>



    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
                <?php
                    $show_slider = get_theme_option(tk_theme_name.'_home_show_slider');
                    if(empty($show_slider)) { $show_slider = 2000;}
                    $slider_show = get_theme_option(tk_theme_name.'_home_enable_slider');
                    $slider_auto = get_theme_option(tk_theme_name.'_home_auto_play');
                    $slider_speed = get_theme_option(tk_theme_name.'_home_slider_delay');
                    $slider_animation_time = get_theme_option(tk_theme_name.'_home_animation_time');
                    if(empty($slider_speed)) {$slider_speed = "5000";}
                    if(empty($slider_animation_time)) {$slider_animation_time = "200";}
                    if($slider_show == 'yes') {
            ?>

            <script type="text/javascript">
                jQuery(document).ready(function(){
                    setTimeout(function(){
                          jQuery('.slider-home').animate({
                            opacity: 1
                          }, 1000, function() {
                            // Animation complete.
                          });
                      },<?php echo $show_slider; ?>);
                });
            </script>


            <div class="slider-home left">
                <ul id="slider">

                        <?php
                            $args=array('post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'post_type' => 'pt_slides', 'posts_per_page' => -1);

                            //The Query
                            query_posts($args);

                            //The Loop
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                            $embed_code = wp_oembed_get($video_link, array('width'=>440));  ?>

                    <?php if($video_link) { ?>

                        <li>
                            <div class="slider-content shortcodes left">
                                <div class="text-slider left">
                                    <?php the_content(); ?>
                                </div><!--/ text-slider -->
                                <div class="images-slider right">
                                    <div class="slider-video right">
                                        <?php echo $embed_code; ?>
                                    </div><!-- slider-video -->
                                </div>
                            </div>
                        </li>

                    <?php } elseif (has_post_thumbnail()) { ?>

                       <div class="slider-content left">
                            <div class="images-full-slider right">
                                <div class="text-slider-images-full left">
                                    <div><span><?php the_title(); ?></span></div>
                                    <div><a href="<?php echo the_permalink(); ?>"><?php _e('More Info', 'Themetick'); ?></a></div>
                                </div><!--/ text-slider-images-full -->
                                <?php the_post_thumbnail('fullslider'); ?>
                            </div><!--/ images-full-slider -->
                        </div><!--/ slider-content -->

                    <?php  } else { ?>
                            <li>
                                <div class="slider-content left">

                                        <div class="text-slider-noimage shortcodes left">
                                            <?php the_content(); ?>
                                        </div><!--/ text-slider -->

                                </div><!--/ slider-content -->
                            </li>
                    <?php } ?>


                        <?php endwhile; endif; ?>


                </ul><!-- #slider -->





            <script type="text/javascript">
                jQuery(document).ready(function(){

                    // SLIDER
                    jQuery('#slider').anythingSlider({
                        resizeContents      : false,
                        expand              : false,
                        startStopped        : false,
                        buildArrows         : true,
                        buildStartStop      : false,
                        toggleArrows       :false,
                        delay                  : <?php echo $slider_speed?>,
                        animationTime     : <?php echo $slider_animation_time?>,
                        autoPlay            : <?php if ($slider_auto == 'yes'){echo 'true';}else{echo 'false';}?>,
                        onSlideComplete : function(slider){
                        },
                        onSlideBegin : function(slider) {
                            jQuery(".images-slider").fadeTo( 100, 0);
                            jQuery(".text-slider").fadeTo( 100, 0);
                        }
                        ,onSlideComplete : function(slider) {

                            window.setTimeout(function() {
                                jQuery(".activePage .images-slider").stop().animate({"opacity" : "1"}, "300");
                            }, 200);

                            window.setTimeout(function() {
                                jQuery(".activePage .text-slider").stop().animate({"opacity" : "1"}, "600");
                            }, 400);

                        }
                    });
                });
            </script>



            </div><!--/slider-home-->

<?php } ?>


    <?php
            $call_to_action_show = get_theme_option(tk_theme_name.'_home_use_call_to_action');
            $call_to_action_title = get_theme_option(tk_theme_name.'_home_call_to_action_title');
            $call_to_action_undertitle = get_theme_option(tk_theme_name.'_home_call_to_action_undertitle');
            $call_to_action_text = get_theme_option(tk_theme_name.'_home_call_to_action_text');
            $call_to_action_button = get_theme_option(tk_theme_name.'_home_call_to_action_button_text');
            $call_to_action_button_url = get_theme_option(tk_theme_name.'_home_call_to_action_button_url');
            $counter_date = get_theme_option(tk_theme_name.'_home_datepicker');
            $counter_date = explode('-', $counter_date);
            $counter_hour = get_theme_option(tk_theme_name.'_home_datepicker_hour');
            $counter_min = get_theme_option(tk_theme_name.'_home_datepicker_min');
            $use_countdown = get_theme_option(tk_theme_name.'_home_use_countdown');            
            if($call_to_action_show == 'yes') {
            ?>





            <div class="business-conference left">
                <div class="business-conference-title left">
                    <span><?php echo $call_to_action_title?></span>
                    <p><?php echo $call_to_action_undertitle?></p>
                </div><!--/business-conference-title-->

                <div class="business-days-button left">
                 <?php if($use_countdown == 'yes') {?>

                    <div class="business-days-content left">
                        <div class="bg-business-days left">
                           <script type="text/javascript">
                                jQuery(document).ready(function(){
                                    
                               function serverTime() {
                                   var time = null; 
                                   jQuery.ajax({
                                       url: document.URL + '?getServerTime', 
                                       async: true, 
                                       dataType: 'text', 
                                       success: function(text) {
                                           time = new Date(text);
                                       }, 
                                       error: function(http, message, exc) { 
                                           time = new Date();
                                       }
                                   });
                                   return time; 
                               }    
                                
                                var time = new Date();
                                time = new Date(<?php echo $counter_date[2]; ?>,<?php echo $counter_date[1]; ?>-1,<?php echo $counter_date[0]; ?>,<?php echo $counter_hour; ?>,<?php echo $counter_min; ?>);
                                    jQuery('.jcounter').countdown({
                                        until: time,
                                        timeSeparator: " ",
                                        compact: true,
                                        timezone: <?php echo get_option('gmt_offset'); ?>,
                                        layout: '{dnnn} {hnn} {mnn}',
                                        description: '',
                                        compactLabels: ['', '', '', '']
                                    });
                                })
                            </script>
                            <div class="jcounter"></div>
                        </div><!--/bg-business-days-->

                        <div class="days-hours-minutes left">
                            <div class="days-home-content left">Days</div><!--/days-home-content-->
                            <div class="hours-home-content left">Hours</div><!--/hours-home-content-->
                            <div class="minutes-home-content left">Minutes</div><!--/minutes-home-content-->
                        </div><!--/days-hours-minutes-->
                    </div><!--/business-days-content-->
                    <?php } ?>
                    <div class="business-button-content right" <?php if($use_countdown !== 'yes') { ?>style="margin:0 auto 0 auto; float:none;"<?php } ?> >
                        <a href="<?php echo $call_to_action_button_url?>">
                            <div>
                                <div class="business-button-left left"></div><!--/business-button-left-->
                                <div class="business-button-center left"><?php echo $call_to_action_button?></div><!--/business-button-center-->
                                <div class="business-button-right left"></div><!--/business-button-right-->
                            </div>
                        </a>
                    </div><!--/business-button-content-->
                </div><!--/business-days-button-->

            </div><!--/business-conference-->

            <?php }
                $show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');

                if($show_home_content == 'yes') {
        ?>


            <div class="shortcodes">

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
            </div><!-- shortcodes -->


<?php } ?>


                <div class="tabbet-content">
                    <div class="tabs-button-jq">
                        <div id="tabs">
                            <?php
                                $program_title = get_option('title_program_page');
                                $speakers = get_option('title_speakers_page');
                                $programcats = get_theme_option(tk_theme_name.'_home_program_category');
                                $speakerscats = get_theme_option(tk_theme_name.'_home_speakers_category');
                                $program_count = get_theme_option(tk_theme_name.'_home_program_per_page');
                                $speaker_count = get_theme_option(tk_theme_name.'_home_speakers_per_page');
                            ?>

                            <ul>
                                <li><a href="#tabs-1"><?php echo $program_title; ?></a></li>
                                <li><a href="#tabs-2"><?php echo $speakers; ?></a></li>
                            </ul>

                            <div id="tabs-1">
                                <div class="flexslider">
                                    <ul class="slides">

                                    <?php



                            $args=array( 'tax_query' => array(array('taxonomy' => 'program','field' => 'term_id', 'terms' => $programcats)), 'posts_per_page' =>$program_count, 'post_status' => 'publish',  'ignore_sticky_posts'=> 1,   'post_type' => 'pt_program');
                            $in=1;
                            //The Query
                            query_posts($args);

                            //The Loop
                            if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $post_meta = get_post_meta($post->ID, $prefix.'program_time', true);

                               ?>



                                        <li <?php if($in ==1) { ?>style="display:block;" <?php } else {} ?>>
                                            <div class="slide-holder shortcodes">
                                                <div class="header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                                <span>
                                                    <?php
                                                    $categories = get_the_terms( $post->ID, 'program' );
                                                    $i=1;
                                                    $arr_count =  count($categories);
                                                    foreach($categories as $category) {
                                                    if($arr_count == $i) {
                                                        $comma = '';
                                                    } else {
                                                        $comma=', ';
                                                    }
                                                    $i++;

                                                        echo $category->name.$comma.' ';} echo $post_meta; ?> </span>
                                                 <div class="shortcodes"><p><?php the_excerpt_length(350); ?></p></div>
                                            </div><!--/slide-holder-->
                                        </li>

                                        <?php $in++; endwhile; endif; ?>


                                    </ul>
                                </div><!--/flexslider-->
                            </div><!--/tabs-1-->

                            <div id="tabs-2">
                                <div class="flexslider">
                                    <ul class="slides">

                            <?php
                                $args=array('tax_query' => array(array('taxonomy' => 'speakers','field' => 'term_id', 'terms' => $speakerscats)), 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page'=>$speaker_count,  'post_type' => 'pt_speakers');
                                $in=1;
                                //The Query
                                query_posts($args);
                                //The Loop
                                if ( have_posts() ) : while ( have_posts() ) : the_post();

                            ?>

                                        <li <?php if($in ==1) { ?>style="display:block;" <?php } else {} ?>>
                                            <div class="slide-holder">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                <span>
                                                <?php
                                                $categories = get_the_terms( $post->ID, 'speakers' );
                                                $arr_count =  count($categories);
                                                 $i =1;
                                                foreach($categories as $category) {

                                                    if($arr_count == $i) {
                                                        $comma = '';
                                                    } else {
                                                        $comma=', ';
                                                    }
                                                    echo $category->name.$comma;

                                                    $i++;
                                                    } ?></span>
                                                <div class="shortcodes"><p><?php the_excerpt_length(350); ?></p></div>
                                            </div><!--/slide-holder-->
                                        </li>

                                <?php $in++; endwhile; endif;  ?>


                                    </ul>
                                </div><!--/flexslider-->
                            </div><!--/tabs-2-->

                        </div>
                    </div><!--/tabs-about-jq-->
                </div><!--tabbet-content-->


                <?php  $horizontal_slider = get_theme_option(tk_theme_name.'_home_use_horizontal_slider'); ?>


                <?php if($horizontal_slider) {
                        $horizonta_slider_category = get_theme_option(tk_theme_name.'_home_horizontal_slider_category');
                    ?>
                
                <!--HORIZONTAL SLIDER-->
                <?php $partnersname = get_option('title_partners_page'); ?>
                <div class="horizontal-slider left">
                    <div class="horizontal-help-div left"><span><?php echo $partnersname; ?></span></div><!--/horizontal-help-div-->
                    <div id="imageline">
                        <ul class="jcarousel-skin-tango" id="mycarousel">


                            <?php
                                $args=array('post_status' => 'publish', 'ignore_sticky_posts'=> 1,  'post_type' => 'pt_partners',  'tax_query' => array(array('taxonomy' => 'partners', 'field' => 'term_id', 'terms' => $horizonta_slider_category)), 'meta_key'=>'_thumbnail_id', 'posts_per_page' =>-1);

                                //The Query
                                query_posts($args);
                                //The Loop
                                if ( have_posts() ) : while ( have_posts() ) : the_post();
                                $partner_links = get_post_meta($post->ID, $prefix.'sponsor_link', true);

                            ?>
                            <li rev="<?php echo $partner_links; ?>" ><?php the_post_thumbnail('sponsors'); ?></li>
                            <?php endwhile; endif; ?>

                        </ul>
                    </div>
                </div><!--/horizontal-slider-->
                <?php } ?>


        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>