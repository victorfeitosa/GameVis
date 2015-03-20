<?php

/* Aqua Tabs Block */
if(!class_exists('AQ_Allslider_Block')) {
    class AQ_Allslider_Block extends AQ_Block {

        function __construct() {
            $block_options = array(
                'name' => 'Post Slider',
                'size' => 'col-sm-6',
            );

            //create the widget
            parent::__construct('AQ_Allslider_Block', $block_options);

        }

        function form($instance) {

            $args = array('show_ui' => true, '_builtin' => false);

            $tk_post_types = get_post_types($args);
            $tk_post_types['post'] = 'post';

            $ct_team_val = 'ct_team';
            $ct_client_val = 'ct_client';
            $ct_gallery_val = 'ct_gallery';


            $get_column_number = array(3 => '3', 4 => '4', 6 => '6') ;

            $defaults = array(
                'post_types' => 'post',
                'categories'    => '',
                'post_number'  => '6',
                'column_number' => '',
                'ct_team' => '',
                'ct_client' => '',
                'ct_gallery' => '',
                'ct_post' => '',
                'headline_color' => '',
                'post_headline_color' => '',
                'text_color' => '',
                'module_headline' => '',
            );

            if(($key = array_search('page', $tk_post_types)) !== false) {
                unset($tk_post_types[$key]);
            }

            $instance = wp_parse_args($instance, $defaults);
            extract($instance);
            ?>
            <div class="description cf">


                <div class="description description-post-type description-<?php echo $block_id; ?>">
                    <label for="<?php echo $this->get_field_id('module_headline'); ?>">
                        <?php _e('Module Headline', 'tkingdom'); ?>
                        <?php echo aq_field_input('module_headline', $block_id, $module_headline); ?>
                    </label>
                </div><!-- description -->

                <div class="description description-post-type description-<?php echo $block_id; ?>">
                    <label for="<?php echo $this->get_field_id('post_types'); ?>">
                        <?php _e('Select Post Type', 'tkingdom'); ?>
                        <?php echo aq_posttype_select('post_types', $block_id, $tk_post_types, $post_types); ?>
                    </label>
                </div><!-- description -->

                <div class="description ct-post-description no-show no-show-<?php echo $block_id; ?>  description-post-<?php echo $block_id; ?>">
                    <label for="<?php echo $this->get_field_id('ct_post'); ?>">
                        <?php _e('Select Post Categories', 'tkingdom'); ?>
                        <?php echo aq_category_select('ct_post', $block_id, 'category', $ct_post); ?>
                    </label>
                </div><!-- description -->

                <!-- Magma hide additional fields
                <div class="description ct-team-description no-show no-show-<?php // echo $block_id; ?> description-team-<?php // echo $block_id; ?>">
                    <label for="<?php // echo $this->get_field_id('ct_team'); ?>">
                        <?php // _e('Team Categories', 'tkingdom'); ?>
                        <?php // echo aq_category_select('ct_team', $block_id, $ct_team_val, $ct_team); ?>
                    </label>
                </div>

                <div class="description ct-client-description no-show no-show-<?php // echo $block_id; ?> description-client-<?php // echo $block_id; ?>">
                    <label for="<?php // echo $this->get_field_id('ct_client'); ?>">
                        <?php // _e('Client Categories', 'tkingdom'); ?>
                        <?php // echo aq_category_select('ct_client', $block_id, $ct_client_val, $ct_client); ?>
                    </label>
                </div>

                <div class="description ct-gallery-description no-show no-show-<?php // echo $block_id; ?> description-gallery-<?php // echo $block_id; ?>">
                    <label for="<?php // echo $this->get_field_id('ct_gallery'); ?>">
                        <?php // _e('Gallery Categories', 'tkingdom'); ?>
                        <?php // echo aq_category_select('ct_gallery', $block_id, $ct_gallery_val, $ct_gallery); ?>
                    </label>
                </div>
                -->

                <div class="description">
                    <label for="<?php echo $this->get_field_id('post_number') ?>">
                        <?php _e('Select Post Number', 'tkingdom')?><br/>
                        <?php echo aq_field_input('post_number', $block_id, $post_number ); ?>
                    </label>
                </div><!-- description -->

                <div class="description">
                    <label for="<?php echo $this->get_field_id('column_number') ?>">
                        <?php _e('Column Number', 'tkingdom')?><br/>
                        <?php echo aq_field_select('column_number', $block_id, $get_column_number, $column_number ); ?>
                    </label>
                </div><!-- description -->

                <div class="description color-shower color-shower-<?php echo $block_id; ?> headline-color-<?php echo $block_id; ?>">
                    <label for="<?php echo $this->get_field_id('headline_color') ?>">
                        <?php _e('Pick a headline color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('headline_color', $block_id, $headline_color, $defaults['headline_color']) ?>
                    </label>
                </div>

                <div class="description color-shower color-shower-<?php echo $block_id; ?> post-headline-color-<?php echo $block_id; ?> <?php echo $block_id;?>-noshow">
                    <label for="<?php echo $this->get_field_id('post_headline_color') ?>">
                        <?php _e('Pick a post headline color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('post_headline_color', $block_id, $post_headline_color, $defaults['post_headline_color']) ?>
                    </label>
                </div>

                <div class="description color-shower color-shower-<?php echo $block_id; ?> text-color-<?php echo $block_id; ?> <?php echo $block_id; ?>-noshow">
                    <label for="<?php echo $this->get_field_id('text_color') ?>">
                        <?php _e('Pick a text color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('text_color', $block_id, $text_color, $defaults['text_color']) ?>
                    </label>
                </div>



                 <script type="text/javascript">

                        jQuery(document).ready(function($){
                        /* Magma hide additional fields
                          var getPostType = jQuery('#<?php echo $block_id; ?>_post_types').find(':selected').val();
                            if(getPostType == 'ct_team' ) {
                                jQuery('.description-team-<?php echo $block_id; ?>').css('display', 'block');
                                jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                                jQuery('.no-show-<?php echo $block_id; ?>, .column-number-<?php echo $block_id; ?>').css('display', 'none');
                            } else if (getPostType == 'ct_gallery' ) {
                                jQuery('.description-gallery-<?php echo $block_id; ?>').css('display', 'block');
                                jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                                jQuery('.no-show-<?php echo $block_id; ?>, .text-color-<?php echo $block_id; ?>').css('display', 'none');
                            } else if (getPostType == 'ct_client' ) {
                                jQuery('.description-client-<?php echo $block_id; ?>').css('display', 'block');
                                jQuery('.color-shower-<?php echo $block_id; ?>, .description-client-<?php echo $block_id; ?>').css('display', 'block');
                                jQuery('.no-show-<?php echo $block_id; ?>, .column-number-<?php echo $block_id; ?>, .post-headline-color-<?php echo $block_id; ?>, .text-color-<?php echo $block_id; ?>').css('display', 'none');
                            } else if (getPostType == 'post' ) {
                        */
                                jQuery('.description-post-<?php echo $block_id; ?>').css('display', 'block');
                                jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                                jQuery('.column-number-<?php echo $block_id; ?>, .no-show-<?php echo $block_id; ?>').css('display', 'block'); // replace block with none to change fields on tax change
                         /* } Magma hide additional fields */
                        });

                        jQuery("#<?php echo $block_id; ?>_post_types").change(function() {
                        /*   Magma hide additional fields
                            var getPostType =  jQuery(this).find("option:selected").val();
                            if(getPostType == 'ct_team' ) {
                                jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                                jQuery('.no-show-<?php echo $block_id; ?>, .column-number-<?php echo $block_id; ?>').css('display', 'none');
                                jQuery('.description-team-<?php echo $block_id; ?>').css('display', 'block');
                            } else if (getPostType == 'ct_gallery' ) {
                                jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                                jQuery('.no-show-<?php echo $block_id; ?>, .text-color-<?php echo $block_id; ?>').css('display', 'none');
                                jQuery('.description-gallery-<?php echo $block_id; ?>').css('display', 'block');
                            } else if (getPostType == 'ct_client' ) {
                                jQuery('.color-shower-<?php echo $block_id; ?>, .description-client-<?php echo $block_id; ?>').css('display', 'block');
                                jQuery('.no-show-<?php echo $block_id; ?>, .column-number-<?php echo $block_id; ?>, .post-headline-color-<?php echo $block_id; ?>, .text-color-<?php echo $block_id; ?>').css('display', 'none');
                                jQuery('.description-client-<?php echo $block_id; ?>').css('display', 'block');
                            } else if (getPostType == 'post' ) {
                        */
                                jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                                jQuery('.column-number-<?php echo $block_id; ?>, .no-show-<?php echo $block_id; ?>').css('display', 'block'); // replace block with none to change fields on tax change
                                jQuery('.description-post-<?php echo $block_id; ?>').css('display', 'block');
                         /* } Magma hide additional fields */
                        });
                </script>



                <div class="clear"></div>
            </div>

        <?php
        }

        function block($instance) {
            extract($instance);

                                        //checks selected post type
                                        switch($post_types) {
                                            case 'ct_gallery': ?>


                                           <?php
                                           //checks column numbers in slider and passes to flexslider code
                                           switch($column_number){
                                              case 3:
                                                  $size_class = 'posts-3';
                                                  $right_margin = 30;
                                              break;

                                              case 4:
                                                  $size_class = 'posts-4';
                                                  $right_margin = 20;
                                              break;

                                              case 6:
                                                  $size_class = 'posts-6';
                                                  $right_margin = 12;
                                              break;
                                           }
                                          ?>


                                            <script type="text/javascript">

                                                jQuery(document).ready(function($){

                                                    // Flexslider check grid size on resize event
                                                    jQuery(window).resize(function() {


                                                       var sliderWidth = jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                       //checks number of slider columns and sets width for slider
                                                       if(jQuery('.posts-6-<?php echo $block_id; ?><?php echo $template_id; ?>').hasClass('posts-6')) {

                                                       // Flexslider 4 colums
                                                       var sliderWidth = jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').width();
                                                           if(sliderWidth < 650) {
                                                               var minusWidth = '12';
                                                             } else if (sliderWidth < 900){
                                                               var minusWidth = '24';
                                                             } else {
                                                               var minusWidth = '61';
                                                             }
                                                       } else if(jQuery('.posts-4-<?php echo $block_id; ?><?php echo $template_id; ?>').hasClass('posts-4')) {
                                                        if(sliderWidth < 650) {
                                                            var minusWidth = '21';
                                                          } else if (sliderWidth < 900){
                                                            var minusWidth = '40';
                                                          } else {
                                                            var minusWidth = '61';
                                                          }
                                                    } else if(jQuery('.posts-3-<?php echo $block_id; ?><?php echo $template_id; ?>').hasClass('posts-3')) {
                                                        if(sliderWidth < 650) {
                                                            var minusWidth = '32';
                                                          } else if (sliderWidth < 900){
                                                            var minusWidth = '60';
                                                          } else {
                                                            var minusWidth = '61';
                                                          }
                                                    };

                                                       var getFlexslider = jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').html();

                                                       jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').remove();
                                                       jQuery('.nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> .flex-direction-nav').remove();
                                                       jQuery('.flexslider-part4').append('<div class="flexslider flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>">'+getFlexslider+'</div>');


                                                       var sliderWidth = jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                       if(sliderWidth < 418) {
                                                           var itemWidthCalc = (sliderWidth);
                                                       } else if(sliderWidth < 650) {
                                                           var itemWidthCalc = (sliderWidth - minusWidth) / 2;
                                                       } else if (sliderWidth < 900){
                                                           var itemWidthCalc = (sliderWidth - minusWidth) / 3;
                                                       } else {
                                                           var itemWidthCalc = (sliderWidth - minusWidth) / <?php echo $column_number; ?>;
                                                       }

                                                       jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                           animation: "slide",
                                                           animationLoop: true,
                                                           itemWidth: itemWidthCalc,
                                                           itemMargin:  <?php echo $right_margin; ?>,
                                                           controlNav: false,
                                                           slideshow: false,
                                                           move: 1,
                                                           minItems: 1,
                                                           prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                           nextText: "<i class='fa fa-chevron-right'></i>",
                                                           controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>"
                                                       });

                                                    });

                                                    // Flexslider 4 colums
                                                    var sliderWidth = jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').width();
                                                    if(jQuery('.posts-6-<?php echo $block_id; ?><?php echo $template_id; ?>').hasClass('posts-6')) {

                                                        //checks number of slider columns and sets width for slider
                                                        if(sliderWidth < 650) {
                                                            var minusWidth = '12';
                                                          } else if (sliderWidth < 900){
                                                            var minusWidth = '24';
                                                          } else {
                                                            var minusWidth = '61';
                                                          }

                                                    } else if(jQuery('.posts-4-<?php echo $block_id; ?><?php echo $template_id; ?>').hasClass('posts-4')) {
                                                        if(sliderWidth < 650) {
                                                            var minusWidth = '21';
                                                          } else if (sliderWidth < 900){
                                                            var minusWidth = '40';
                                                          } else {
                                                            var minusWidth = '61';
                                                          }
                                                    } else if(jQuery('.posts-3-<?php echo $block_id; ?><?php echo $template_id; ?>').hasClass('posts-3')) {
                                                        if(sliderWidth < 650) {
                                                            var minusWidth = '32';
                                                          } else if (sliderWidth < 900){
                                                            var minusWidth = '60';
                                                          } else {
                                                            var minusWidth = '61';
                                                          }
                                                    };


                                                      if(sliderWidth < 418) {
                                                          var itemWidthCalc = (sliderWidth);
                                                      } else if(sliderWidth < 650) {
                                                          var itemWidthCalc = (sliderWidth - minusWidth) / 2;
                                                      } else if (sliderWidth < 900){
                                                          var itemWidthCalc = (sliderWidth - minusWidth) / 3;
                                                      } else {
                                                          var itemWidthCalc = (sliderWidth - minusWidth) / <?php echo $column_number; ?>;
                                                      }

                                                      jQuery('.flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                          animation: "slide",
                                                          animationLoop: true,
                                                          itemWidth: itemWidthCalc,
                                                          itemMargin:  <?php echo $right_margin; ?>,
                                                          controlNav: false,
                                                          slideshow: false,
                                                          move: 1,
                                                          minItems: 1,
                                                          prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                          nextText: "<i class='fa fa-chevron-right'></i>",
                                                          controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>",
                                                          start: function (slider) {
                                                                jQuery('.flexslider-part4').animate({
                                                                    opacity: 1
                                                                }, 1000);
                                                          }
                                                      });
                                                    });

                                            </script>


                                                <style type="text/css">
                                                    .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                                                        color: <?php echo $headline_color; ?>;
                                                    }

                                                    .shortcodes .block-wrap-<?php echo $block_id; ?> .flexslider h6  a {
                                                        color: <?php echo $post_headline_color; ?>;
                                                    }

                                                    .shortcodes .block-wrap-<?php echo $block_id; ?> .flexslider p {
                                                        color: <?php echo $text_color; ?>;
                                                    }
                                                </style>


                                                <div class="row block-wrap-<?php echo $block_id; ?><?php echo $template_id; ?> <?php echo $size_class; ?> <?php echo $size_class; ?>-<?php echo $block_id; ?><?php echo $template_id; ?> gallery-slider img-posts-wrapper">

                                                        <?php if(!empty($module_headline)){ ?>
                                                            <h2><?php echo htmlspecialchars_decode($module_headline); ?></h2>
                                                        <?php } ?>

                                                            <?php if(!empty($module_headline)) {
                                                                $noborder = '';
                                                            } else {
                                                                $noborder = 'no-border-show';
                                                            } ?>

                                                                <div class="nav-arrow-devider <?php if(empty($module_headline)) { echo $noborder; } ?> clearfix">
                                                            <nav class="nav-arrows pull-right nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>"></nav>
                                                        </div>

                                                        <div class="flexslider-part4">
                                                            <div class="flexslider flexslider-4_<?php echo $block_id; ?><?php echo $template_id; ?> flexslider-4">
                                                                <ul class="slides">


                                                                    <?php

                                                                        $cat_id = get_term_by( 'name', $ct_gallery, 'ct_gallery', ARRAY_A );

                                                                        if(!empty($cat_id)){
                                                                            $args = array(
                                                                                'post_status' => 'publish',
                                                                                'posts_per_page' =>$post_number,
                                                                                'post_type' => 'gallery',
                                                                                'meta_key' => '_thumbnail_id',
                                                                                'tax_query' => array(
                                                                                    array(
                                                                                            'taxonomy' => 'ct_gallery',
                                                                                            'field' => 'id',
                                                                                            'terms' => $cat_id['term_id']
                                                                                    )
                                                                            ));
                                                                        } else {
                                                                            $args = array(
                                                                                'post_status' => 'publish',
                                                                                'posts_per_page' =>$post_number,
                                                                                'post_type' => 'gallery',
                                                                                'meta_key' => '_thumbnail_id',
                                                                            );
                                                                        }

                                                                        // The Query
                                                                        $the_query = new WP_Query($args);

                                                                        if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();
                                                                        $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $the_query->post->ID ), 'full');

                                                                    ?>

                                                                        <li>
                                                                            <div class="img-post">
                                                                                <figure>
                                                                                    <?php if(has_post_thumbnail()){ ?>
                                                                                    <?php the_post_thumbnail('pb_gallery'); ?>
                                                                                    <?php } ?>
                                                                                </figure>

                                                                                <div class="post">
                                                                                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                                                                    <div class="meta-data">
                                                                                        <ul class="categories clearfix">
                                                                                            <?php echo get_the_term_list($the_query->post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null); ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>

                                                                    <?php endwhile; endif; ?>



                                                                </ul>
                                                            </div><!-- flexslider -->
                                                        </div>

                                                </div><!-- img-posts-wrapper -->



                                            <?php break;

                                            case 'ct_team': ?>


                                           <?php
                                           //checks column numbers in slider and passes to flexslider code
                                           switch($column_number){
                                              case 3:
                                                  $size_class = 'posts-3';
                                                  $right_margin = 20;
                                              break;

                                              case 4:
                                                  $size_class = 'posts-4';
                                                  $right_margin = 20;
                                              break;

                                              case 6:
                                                  $size_class = 'posts-6';
                                                  $right_margin = 12;
                                              break;
                                           }
                                            ?>


                                            <script type="text/javascript">

                                              // Flexslider check grid size on resize event
                                                    jQuery(window).resize(function() {

                                                        var getFlexslider = jQuery('.flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>').html();

                                                        jQuery('.flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>').remove();
                                                        jQuery('.nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> .flex-direction-nav').remove();
                                                        jQuery('.flexslider-part5<?php echo $block_id; ?><?php echo $template_id; ?>').append('<div class="flexslider flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>">'+getFlexslider+'</div>');

                                                        var sliderWidth = jQuery('.flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                        if(sliderWidth < 418) {
                                                            var itemWidthCalc = (sliderWidth);
                                                        } else if(sliderWidth < 650) {
                                                            var itemWidthCalc = (sliderWidth - 20) / 2;
                                                        } else if (sliderWidth < 900){
                                                            var itemWidthCalc = (sliderWidth - 40) / 3;
                                                        } else {
                                                            var itemWidthCalc = (sliderWidth - 60) / <?php echo $column_number; ?>;
                                                        }

                                                        jQuery('.flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                            animation: "slide",
                                                            animationLoop: false,
                                                            itemWidth: itemWidthCalc,
                                                            itemMargin: <?php echo $right_margin; ?>,
                                                            controlNav: false,
                                                            slideshow: false,
                                                            move: 1,
                                                            prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                            nextText: "<i class='fa fa-chevron-right'></i>",
                                                            controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>"
                                                        });

                                                    });

                                                // Flexslider circle-img post
                                                jQuery(document).ready(function($){
                                                    var sliderWidth = jQuery('.flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                      if(sliderWidth < 418) {
                                                          var itemWidthCalc = (sliderWidth);
                                                      } else if(sliderWidth < 650) {
                                                          var itemWidthCalc = (sliderWidth - 20) / 2;
                                                      } else if (sliderWidth < 900){
                                                          var itemWidthCalc = (sliderWidth - 40) / 3;
                                                      } else {
                                                          var itemWidthCalc = (sliderWidth - 60) / <?php echo $column_number; ?>;
                                                      }

                                                      jQuery('.flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                          animation: "slide",
                                                          animationLoop: false,
                                                          itemWidth: itemWidthCalc,
                                                          itemMargin: <?php echo $right_margin; ?>,
                                                          controlNav: false,
                                                          slideshow: false,
                                                          directionNav: true,
                                                          move: 1,
                                                          prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                          nextText: "<i class='fa fa-chevron-right'></i>",
                                                          controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>",
                                                          start: function (slider) {
                                                                jQuery('.flexslider-part5<?php echo $block_id; ?><?php echo $template_id; ?>').animate({
                                                                    opacity: 1
                                                                }, 1000);
                                                          }
                                                      });
                                                });
                                            </script>

                                            <style type="text/css">
                                                .shortcodes .block-wrap-<?php echo $block_id; ?><?php echo $template_id; ?> h2 {
                                                    color: <?php echo $headline_color; ?>;
                                                }

                                                .shortcodes .block-wrap-<?php echo $block_id; ?><?php echo $template_id; ?> .flexslider h6 {
                                                    color: <?php echo $post_headline_color; ?>;
                                                }

                                                .shortcodes .block-wrap-<?php echo $block_id; ?><?php echo $template_id; ?> .flexslider p {
                                                    color: <?php echo $text_color; ?>;
                                                }
                                            </style>



                                                <div class="row block-wrap-<?php echo $block_id; ?><?php echo $template_id; ?> team-members <?php echo $size_class; ?> fourths circle-img">

                                                        <?php if(!empty($module_headline)){ ?>
                                                            <h2><?php echo htmlspecialchars_decode($module_headline); ?></h2>
                                                        <?php } ?>

                                                            <?php if(!empty($module_headline)) {
                                                                $noborder = '';
                                                            } else {
                                                                $noborder = 'no-border-show';
                                                            } ?>

                                                                <div class="nav-arrow-devider <?php if(empty($module_headline)) { echo $noborder; } ?> clearfix">
                                                            <nav class="nav-arrows nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> pull-right"></nav>
                                                        </div>


                                                        <div class="flexslider-part5<?php echo $block_id; ?><?php echo $template_id; ?>">
                                                            <div class="flexslider flexslider-5 flexslider-5_<?php echo $block_id; ?><?php echo $template_id; ?>">
                                                                <ul class="slides">

                                                                    <?php

                                                                        $cat_id = get_term_by( 'name', $ct_team, 'ct_team', ARRAY_A );
                                                                        if(!empty($cat_id)){
                                                                            $args = array(
                                                                                'post_status' => 'publish',
                                                                                'post_type' => 'team-members',
                                                                                'posts_per_page' =>$post_number,
                                                                                'tax_query' => array(
                                                                                    array(
                                                                                            'taxonomy' => 'ct_team',
                                                                                            'field' => 'id',
                                                                                            'terms' => $cat_id['term_id']
                                                                                    )
                                                                            ));
                                                                        } else {
                                                                            $args = array(
                                                                                'post_status' => 'publish',
                                                                                'posts_per_page' =>$post_number,
                                                                                'post_type' => 'team-members',
                                                                            );
                                                                        }

                                                                        // The Query
                                                                        $the_query = new WP_Query($args);

                                                                        if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();

                                                                        $post_category = wp_get_post_terms( $the_query->post->ID );
                                                                        $facebook_ico = get_post_meta($the_query->post->ID, 'tk_member_facebook', true);
                                                                        $twitter_ico = get_post_meta($the_query->post->ID, 'tk_member_twitter', true);
                                                                        $google_ico = get_post_meta($the_query->post->ID, 'tk_member_google', true);
                                                                        $linkedin_ico = get_post_meta($the_query->post->ID, 'tk_member_linkedin', true);
                                                                        $pinterest_ico = get_post_meta($the_query->post->ID, 'tk_member_pinterest', true);
                                                                        $dribbble_ico = get_post_meta($the_query->post->ID, 'tk_member_dribbble', true);
                                                                        $mail_ico = get_post_meta($the_query->post->ID, 'tk_member_mail', true);
                                                                        $job_title = get_post_meta($the_query->post->ID, 'tk_member_position', true);
                                                                    ?>


                                                                    <li>
                                                                        <?php if(has_post_thumbnail()){ ?>
                                                                            <figure>
                                                                                <?php the_post_thumbnail('our-team'); ?>
                                                                            </figure>
                                                                        <?php } ?>

                                                                        <div class="profile-info">
                                                                            <h6><?php the_title(); ?>
                                                                                <?php if(!empty($job_title)){ ?><span><?php echo $job_title; ?></span><?php } ?>
                                                                            </h6>

                                                                            <?php if(!empty($facebook_ico) || !empty($twitter_ico) || !empty($google_ico) || !empty($linkedin_ico) || !empty($pinterest_ico) || !empty($dribbble_ico) || !empty($mail_ico)){ ?>
                                                                                <ul class="soc-icon">
                                                                                    <?php if(!empty($facebook_ico)) { ?><a href="http://www.facebook.com/<?php echo $facebook_ico; ?>"><li class="facebook"><i class="fa fa-facebook"></i></li></a><?php } ?>
                                                                                    <?php if(!empty($twitter_ico)) { ?><a href="http://www.twitter.com/<?php echo $twitter_ico; ?>"><li class="twitter"><i class="fa fa-twitter"></i></li></a><?php } ?>
                                                                                    <?php if(!empty($google_ico)) { ?><a href="http://plus.google.com/<?php echo $google_ico; ?>"><li class="google-plus"><i class="fa fa-google-plus"></i></li></a><?php } ?>
                                                                                    <?php if(!empty($linkedin_ico)) { ?><a href="<?php echo $linkedin_ico; ?>"><li class="linkedin"><i class="fa fa-linkedin"></i></li></a><?php } ?>
                                                                                    <?php if(!empty($pinterest_ico)) { ?><a href="http://www.pinterest.com//<?php echo $pinterest_ico; ?>"><li class="pinterest"><i class="fa fa-pinterest"></i></li></a><?php } ?>
                                                                                    <?php if(!empty($dribbble_ico)) { ?><a href="http://dribbble.com/<?php echo $dribbble_ico; ?>"><li class="dribble"><i class="fa fa-dribbble"></i></li></a><?php } ?>
                                                                                    <?php if(!empty($mail_ico)) { ?><a href="mailto:<?php echo $mail_ico; ?>"><li class="email"><i class="fa fa-envelope"></i></li></a><?php } ?>
                                                                                </ul>
                                                                            <?php } ?>

                                                                            <?php the_excerpt(); ?>
                                                                        </div>
                                                                    </li>
                                                                    <?php endwhile; endif; ?>

                                                                </ul>
                                                            </div><!-- flexslider -->
                                                        </div><!-- flexslider-part5 -->


                                                </div><!-- fourths -->


                                            <?php  break;

                                              case 'ct_client': ?>


                                            <script type="text/javascript">

                                            jQuery(document).ready(function($){
                                                  // Flexslider check grid size on resize event
                                                jQuery(window).resize(function() {

                                                    var getFlexslider = jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').html();

                                                    jQuery('.nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> .flex-direction-nav').remove();
                                                    jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').remove();
                                                    jQuery('.flexslider-part6').append('<div class="flexslider flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>">'+getFlexslider+'</div>');

                                                    var sliderWidth = jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                    if(sliderWidth < 418) {
                                                    var itemWidthCalc = (sliderWidth);
                                                    } else if(sliderWidth < 650) {
                                                        var itemWidthCalc = (sliderWidth - 20) / 2;
                                                    } else if (sliderWidth < 700){
                                                        var itemWidthCalc = (sliderWidth - 40) / 3;
                                                    } else if (sliderWidth < 800){
                                                        var itemWidthCalc = (sliderWidth - 60) / 4;
                                                    } else {
                                                        var itemWidthCalc = (sliderWidth - 100) / 6;
                                                    }



                                                    jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                        animation: "slide",
                                                        animationLoop: false,
                                                        itemWidth: itemWidthCalc,
                                                        itemMargin: 20,
                                                        controlNav: false,
                                                        slideshow: false,
                                                        move: 1,
                                                        minItems: 1,
                                                        prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                        nextText: "<i class='fa fa-chevron-right'></i>",
                                                        controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>"
                                                    });

                                                });

                                                var getFlexslider = jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').html();

                                                // Flexslider partners

                                                var sliderWidth = jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                  if(sliderWidth < 418) {
                                                      var itemWidthCalc = (sliderWidth);
                                                  } else if(sliderWidth < 650) {
                                                      var itemWidthCalc = (sliderWidth - 20) / 2;
                                                  } else if (sliderWidth < 700){
                                                      var itemWidthCalc = (sliderWidth - 40) / 3;
                                                  } else if (sliderWidth < 800){
                                                      var itemWidthCalc = (sliderWidth - 60) / 4;
                                                  } else {
                                                      var itemWidthCalc = (sliderWidth - 100) / 6;
                                                  }
                                                  jQuery('.flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                      animation: "slide",
                                                      animationLoop: false,
                                                      itemWidth: itemWidthCalc,
                                                      itemMargin: 20,
                                                      controlNav: false,
                                                      slideshow: false,
                                                      move: 1,
                                                      minItems: 1,
                                                      prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                      nextText: "<i class='fa fa-chevron-right'></i>",
                                                      controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>",
                                                      start: function (slider) {
                                                        jQuery('.flexslider-part6').animate({
                                                            opacity: 1
                                                        }, 1000);
                                                     }
                                                  });
                                                });
                                            </script>

                                            <style type="text/css">
                                                .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                                                    color: <?php echo $headline_color; ?>;
                                                }

                                                .shortcodes .block-wrap-<?php echo $block_id; ?> .flexslider h6 {
                                                    color: <?php echo $post_headline_color; ?>;
                                                }

                                                .shortcodes .block-wrap-<?php echo $block_id; ?> .flexslider p {
                                                    color: <?php echo $text_color; ?>;
                                                }
                                            </style>


                                            <div class="row block-wrap-<?php echo $block_id; ?> partners">

                                                    <?php if(!empty($module_headline)){ ?>
                                                        <h2><?php echo htmlspecialchars_decode($module_headline); ?></h2>
                                                    <?php } ?>
                                                            <?php if(!empty($module_headline)) {
                                                                $noborder = '';
                                                            } else {
                                                                $noborder = 'no-border-show';
                                                            } ?>

                                                                <div class="nav-arrow-devider <?php if(empty($module_headline)) { echo $noborder; } ?> clearfix">
                                                                    <nav class="nav-arrows nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> pull-right"></nav>
                                                                </div>

                                                                <div class="flexslider-part6">
                                                                    <div class="flexslider flexslider-6_<?php echo $block_id; ?><?php echo $template_id; ?> flexslider-6">
                                                                        <ul class="slides">

                                                                            <?php

                                                                            $cat_id = get_term_by( 'name', $ct_client, 'ct_client', ARRAY_A );

                                                                                    if(!empty($cat_id)){
                                                                                        $args = array(
                                                                                            'post_status' => 'publish',
                                                                                            'post_type' => 'client',
                                                                                            'posts_per_page' =>$post_number,
                                                                                            'meta_key' => '_thumbnail_id',
                                                                                            'tax_query' => array(
                                                                                                array(
                                                                                                        'taxonomy' => 'ct_client',
                                                                                                        'field' => 'id',
                                                                                                        'terms' => $cat_id['term_id']
                                                                                                )
                                                                                        ));
                                                                                    } else {
                                                                                        $args = array(
                                                                                            'post_status' => 'publish',
                                                                                            'posts_per_page' =>$post_number,
                                                                                            'post_type' => 'client',
                                                                                            'meta_key' => '_thumbnail_id',
                                                                                        );
                                                                                    }

                                                                                    // The Query
                                                                                    $the_query = new WP_Query($args);
                                                                                    if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();

                                                                                    $partner_link = get_post_meta($the_query->post->ID, 'tk_client_link', true);

                                                                                    ?>
                                                                                        <li>
                                                                                            <?php if(!empty($partner_link)){ ?>
                                                                                                <a href="<?php echo $partner_link; ?>">
                                                                                            <?php } ?>
                                                                                                <?php the_post_thumbnail('pb_gallery'); ?>
                                                                                            <?php if(!empty($partner_link)){ ?>
                                                                                                </a>
                                                                                            <?php } ?>
                                                                                        </li>

                                                                            <?php endwhile; endif; ?>

                                                                        </ul>
                                                                    </div><!-- flexslider -->
                                                                </div>

                                            </div><!-- partners -->



                                              <?php  break;

                                              case 'post': ?>

                                        <?php
                                           //checks column numbers in slider and passes to flexslider code
                                           switch($column_number){
                                              case 3:
                                                  $size_class = 'posts-3';
                                                  $right_margin = 20;
                                              break;

                                              case 4:
                                                  $size_class = 'posts-4';
                                                  $right_margin = 15;
                                              break;

                                              case 6:
                                                  $size_class = 'posts-6';
                                                  $right_margin = 10;
                                              break;
                                           }
                                            ?>

                                            <script type="text/javascript">
                                              // Flexslider check grid size on resize event
                                                /*jQuery(window).resize(function() {

                                                    var getFlexslider = jQuery('.flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>').html();

                                                    jQuery('.nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> .flex-direction-nav').remove();
                                                    jQuery('.flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>').remove();
                                                    jQuery('.flexslider-part3 <?php echo $block_id; ?><?php echo $template_id; ?>').append('<div class="flexslider flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>">'+getFlexslider+'</div>');


                                                    var sliderWidth = jQuery('.flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                      if(sliderWidth < 500) {
                                                          var itemWidthCalc = (sliderWidth);
                                                      } else if(sliderWidth < 900) {
                                                          var itemWidthCalc = (sliderWidth - 20) / 2;
                                                      } else {
                                                          var itemWidthCalc = (sliderWidth - 60) / <?php echo $column_number; ?>;
                                                      }

                                                      jQuery('.flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                          animation: "slide",
                                                          animationLoop: false,
                                                          itemWidth: itemWidthCalc,
                                                          itemMargin: <?php echo $right_margin ?>,
                                                          controlNav: false,
                                                          slideshow: false,
                                                          move: 1,
                                                          minItems: 1,
                                                          prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                          nextText: "<i class='fa fa-chevron-right'></i>",
                                                          controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>"
                                                      });
                                                });*/

                                                jQuery(document).ready(function(){
                                                  var slideCol = jQuery('#full-width-sly > ul > li');
                                                    var slideWidth = jQuery('#full-width-sly').width();

                                                    if(slideWidth < 500) {
                                                        slideCol.width(slideWidth);
                                                    } else if(slideWidth < 900) {
                                                        slideCol.width(slideWidth / 2 - 20 + (20 / 2)).css('margin-right', 20);
                                                    } else {
                                                        <?php if($column_number == '3') { ?>
                                                          slideCol.width(slideWidth / 3 - 15 + (15 / 3)).css('margin-right', 15);
                                                        <?php }elseif($column_number == '6'){ ?>
                                                          slideCol.width(slideWidth / 6 - 12 + (12 / 6)).css('margin-right', 12);
                                                        <?php }else{ ?>
                                                          slideCol.width(slideWidth / 4 - 20 + (20 / 4)).css('margin-right', 20);
                                                        <?php } ?>
                                                    }
                                                  });

                                                  jQuery(window).load(function(){

                                                    //SLY SLIDER

                                                    jQuery('#full-width-sly').sly({
                                                        horizontal: 1,
                                                        itemNav: 'basic',
                                                        itemSelector: '#full-width-sly .slides li',
                                                        smart: 1,
                                                        activateOn: 'click',
                                                        mouseDragging: 1,
                                                        touchDragging: 1,
                                                        releaseSwing: 1,
                                                        startAt: 0,
                                                        activatePageOn: 'click',
                                                        speed: 600,
                                                        elasticBounds: 1,
                                                        easing: 'easeOutExpo',
                                                        keyboardNavBy: 'pages',
                                                        prevPage: '.nav-arrows-wrapper .prev',
                                                        nextPage: '.nav-arrows-wrapper .next'
                                                    });


                                                    // Flexslider 3 colums

                                                   /* var sliderWidth = jQuery('.flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>').width();

                                                      if(sliderWidth < 500) {
                                                          var itemWidthCalc = (sliderWidth);
                                                      } else if(sliderWidth < 900) {
                                                          var itemWidthCalc = (sliderWidth - 20) / 2;
                                                      } else {
                                                          var itemWidthCalc = (sliderWidth - 60) / <?php echo $column_number; ?>;
                                                      }

                                                      jQuery('.flexslider-3_<?php echo $block_id; ?><?php echo $template_id; ?>').flexslider({
                                                          animation: "slide",
                                                          animationLoop: false,
                                                          itemWidth: itemWidthCalc,
                                                          itemMargin: <?php echo $right_margin ?>,
                                                          controlNav: false,
                                                          slideshow: false,
                                                          move: 1,
                                                          minItems: 1,
                                                          prevText: "<i class='fa fa-chevron-left'></i>",           //String: Set the text for the "previous" directionNav item
                                                          nextText: "<i class='fa fa-chevron-right'></i>",
                                                          controlsContainer: ".nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?>",
                                                          start: function (slider) {
                                                                jQuery('.flexslider-part3<?php echo $block_id; ?><?php echo $template_id; ?>').animate({
                                                                    opacity: 1
                                                                }, 1000);
                                                          }
                                                      });*/
                                                  });
                                                </script>

                                            <style type="text/css">
                                                .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                                                    color: <?php echo $headline_color; ?>;
                                                }

                                                .shortcodes .aq-block-aq_allslider_block .block-wrap-<?php echo $block_id; ?> .flexslider-3 .img-post .post h6 a {
                                                    color: <?php echo $post_headline_color; ?>;
                                                }

                                                .shortcodes .aq-block-aq_allslider_block .block-wrap-<?php echo $block_id; ?> .flexslider-3 .img-post .post p {
                                                    color: <?php echo $text_color; ?>;
                                                }
                                            </style>



                                                <div class="img-posts-wrapper block-wrap-<?php echo $block_id; ?> <?php echo $size_class; ?> thirds">

                                                        <?php if(!empty($module_headline)){ ?>
                                                            <h2><?php echo htmlspecialchars_decode($module_headline); ?></h2>
                                                        <?php } ?>

                                                            <?php if(!empty($module_headline)) {
                                                                $noborder = '';
                                                            } else {
                                                                $noborder = 'no-border-show';
                                                            } ?>



                                                            <!-- class="flexslider-part3<?php //echo $block_id; ?><?php //echo $template_id; ?> -->
                                                            <!-- class="flexslider flexslider-3_<?php //echo $block_id; ?><?php //echo $template_id; ?> flexslider-3 -->

                                                            <div id="full-width-sly-wrapper" class="sly-wrapper">
                                                              <!-- nav-arrow-devider <?php //if(empty($module_headline)) { //echo $noborder; } ?> clearfix -->
                                                                <div class="nav-arrows-wrapper">
                                                                    <!-- <nav class="nav-arrows nav-arrows<?php //echo $block_id; ?><?php //echo $template_id; ?> pull-right"></nav> -->

                                                                    <a href="#" class="nav-arrows prev"><i class="fa fa-chevron-left"></i></a>
                                                                    <a href="#" class="nav-arrows next"><i class="fa fa-chevron-right"></i></a>
                                                                </div>
                                                                <div id="full-width-sly" class="sly">
                                                                    <ul class="slides">

                                                                <?php

                                                                    $cat_id = get_term_by( 'name', $ct_post, 'category', ARRAY_A );

                                                                    if(!empty($cat_id)){
                                                                        $args = array(
                                                                            'post_status' => 'publish',
                                                                            'post_type' => 'post',
                                                                            'posts_per_page' =>$post_number,
                                                                            'post_type' => 'post',
                                                                            'cat' => $cat_id['term_id']
                                                                        );
                                                                    } else {
                                                                        $args = array(
                                                                            'post_status' => 'publish',
                                                                            'post_type' => 'post',
                                                                            'posts_per_page' =>$post_number
                                                                        );
                                                                    }

                                                                    // The Query
                                                                    $the_query = new WP_Query($args);
                                                                    if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();
                                                                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $the_query->post->ID ), 'full');
                                                                        ?>

                                                                        <li>
                                                                            <div class="img-post">

                                                                                <?php if(has_post_thumbnail()){ ?>
                                                                                    <figure>

                                                                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pb_gallery'); ?></a>

                                                                                    </figure>
                                                                                <?php } else { ?>

                                                                                <div class="no-image-spacing"></div>

                                                                                <?php } ?>

                                                                                <div class="post">
                                                                                    <h6><a href="<?php the_permalink(); ?>">
                                                                                        <?php
                                                                                        global $post;
                                                                                        $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                                                                                        if($video_link) { ?><i class="fa fa-youtube-play"></i><?php } ?>
                                                                                        <?php the_title(); ?></a></h6>
                                                                                        <p>



                                                                                            <?php if(function_exists('the_excerpt_length')){
                                                                                                if($size_class == 'posts-6') {
                                                                                                    the_excerpt_length(75);
                                                                                                }elseif($size_class == 'posts-4'){
                                                                                                    the_excerpt_length(100);
                                                                                                }else{
                                                                                                    the_excerpt_length(135);
                                                                                                }
                                                                                             } else {
                                                                                                the_excerpt();
                                                                                            } ?>
                                                                                        </p>
                                                                                    <div class="date"><?php the_time(get_option('date_format')); ?></div>
                                                                                    <div class="meta-data">
                                                                                        <span>IN</span>
                                                                                        <?php echo get_the_category_list(','); ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <?php endwhile; endif; ?>

                                                                    </ul>
                                                                </div><!-- flexslider -->
                                                            </div>

                                                    </div><!-- thirds -->

                                                <?php
                                                break;
                                        }


        }


        function update($new_instance, $old_instance) {
            $new_instance = aq_recursive_sanitize($new_instance);
            return $new_instance;
        }
    }
}
