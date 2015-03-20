<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_AllPostTypes_Block')) {
	class AQ_AllPostTypes_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'All Post Types',
				'size' => 'col-sm-6',
			);

			//create the widget
			parent::__construct('AQ_AllPostTypes_Block', $block_options);

		}

        function form($instance) {

            $args = array('show_ui' => true, '_builtin' => false);

            $tk_post_types = get_post_types($args);
            $tk_post_types['post'] = 'post';

            $ct_team_val = 'ct_team';
            $ct_client_val = 'ct_client';
            $ct_gallery_val = 'ct_gallery';


            $get_column_number = array(3 => '3', 4 => '4', 6 => '6') ;

            $get_post_look = array(1 => 'Large', 2 => 'Small'); //magma-only

            $defaults = array(
                'post_types' => 'post',
                'categories'	=> '',
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
                'ignore_sticky_posts'=> 1,
                'post_look' => '', //magma-only
            );

            if(($key = array_search('page', $tk_post_types)) !== false) {
                unset($tk_post_types[$key]);
            }

            $instance = wp_parse_args($instance, $defaults);
            extract($instance);

            if($block_id ==  'aq_block___i__') {
                       $rand_num = rand();
            }

            ?>
           <input type="hidden" class="get_id" value="<?php echo $block_id; ?>" />

          <div class="description cf">


            <input type="hidden" val="adasdasdasd" id="store-value" />

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

            <div class="description description-post-look description-<?php echo $block_id; ?>">
                <label for="<?php echo $this->get_field_id('post_look'); ?>">
                    <?php _e('Select Post Look', 'tkingdom'); ?>
                    <?php echo aq_field_select('post_look', $block_id, $get_post_look, $post_look ); ?>
                </label>
            </div><!-- description -->

            <div class="description ct-post-description no-show no-show-<?php echo $block_id; ?>  description-post-<?php echo $block_id; ?>">
                <label for="<?php echo $this->get_field_id('ct_post'); ?>">
                    <?php _e('Select Post Categories', 'tkingdom'); ?>
                    <?php echo aq_category_select('ct_post', $block_id, 'category', $ct_post); ?>
                </label>
            </div><!-- description -->

            <div class="description ct-team-description no-show no-show-<?php echo $block_id; ?> description-team-<?php echo $block_id; ?>">
                <label for="<?php echo $this->get_field_id('ct_team'); ?>">
                    <?php _e('Team Categories', 'tkingdom'); ?>
                    <?php echo aq_category_select('ct_team', $block_id, $ct_team_val, $ct_team); ?>
                </label>
            </div><!-- description -->

            <div class="description ct-client-description no-show no-show-<?php echo $block_id; ?> description-client-<?php echo $block_id; ?>">
                <label for="<?php echo $this->get_field_id('ct_client'); ?>">
                    <?php _e('Client Categories', 'tkingdom'); ?>
                    <?php echo aq_category_select('ct_client', $block_id, $ct_client_val, $ct_client); ?>
                </label>
            </div><!-- description -->

            <div class="description ct-gallery-description no-show no-show-<?php echo $block_id; ?> description-gallery-<?php echo $block_id; ?>">
                <label for="<?php echo $this->get_field_id('ct_gallery'); ?>">
                    <?php _e('Gallery Categories', 'tkingdom'); ?>
                    <?php echo aq_category_select('ct_gallery', $block_id, $ct_gallery_val, $ct_gallery); ?>
                </label>
            </div><!-- description -->

            <div class="description">
                <label for="<?php echo $this->get_field_id('post_number') ?>">
                    <?php _e('Select Post Number', 'tkingdom')?><br/>
                    <?php echo aq_field_input('post_number', $block_id, $post_number ); ?>
                </label>
            </div><!-- description -->

            <div class="description no-show  column-number-<?php echo $block_id; ?>">
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

            <div class="description color-shower color-shower-<?php echo $block_id; ?> text-color-<?php echo $block_id; ?> <?php echo $block_id; ?>-noshow ">
                <label for="<?php echo $this->get_field_id('text_color') ?>">
                    <?php _e('Pick a text color', 'tkingdom')?><br/>
                    <?php echo aq_field_color_picker('text_color', $block_id, $text_color, $defaults['text_color']) ?>
                </label>
            </div>



          <script type="text/javascript">

            jQuery(document).ready(function($){
              var getPostType = jQuery('#<?php echo $block_id; ?>_post_types').find(':selected').val();

                if(getPostType == 'ct_team' ) {
                    jQuery('.no-show-<?php echo $block_id; ?>, .column-number-<?php echo $block_id; ?>').css('display', 'none');
                    jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                    jQuery('.description-team-<?php echo $block_id; ?>').css('display', 'block');
                } else if (getPostType == 'ct_gallery' ) {
                    jQuery('.no-show-<?php echo $block_id; ?>').css('display', 'none');
                    jQuery('.<?php echo $block_id; ?>-noshow,  .column-number-<?php echo $block_id; ?>').css('display', 'block');
                    jQuery('.description-gallery-<?php echo $block_id; ?>').css('display', 'block');
                    jQuery('.text-color-<?php echo $block_id; ?>').css('display', 'none');
                } else if (getPostType == 'ct_client' ) {
                    jQuery('.no-show-<?php echo $block_id; ?>').css('display', 'none');
                    jQuery('.<?php echo $block_id; ?>-noshow, .column-number-<?php echo $block_id; ?>').css('display', 'none');
                    jQuery('.description-client-<?php echo $block_id; ?>').css('display', 'block');
                } else if (getPostType == 'post' ) {
                    jQuery('.no-show-<?php echo $block_id; ?>').css('display', 'none');
                    jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                    jQuery('.column-number-<?php echo $block_id; ?>, .no-show-<?php echo $block_id; ?>').css('display', 'none');
                    jQuery('.description-post-<?php echo $block_id; ?>').css('display', 'block');
                }
            });

             jQuery("#<?php echo $block_id; ?>_post_types").change(function() {
              var getPostType =  jQuery(this).find("option:selected").val();
              if(getPostType == 'ct_team' ) {
                  jQuery('.no-show-<?php echo $block_id; ?>, .column-number-<?php echo $block_id; ?>').css('display', 'none');
                  jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                  jQuery('.description-team-<?php echo $block_id; ?>').css('display', 'block');
              } else if (getPostType == 'ct_gallery' ) {
                  jQuery('.no-show-<?php echo $block_id; ?>').css('display', 'none');
                  jQuery('.<?php echo $block_id; ?>-noshow,  .column-number-<?php echo $block_id; ?>').css('display', 'block');
                  jQuery('.description-gallery-<?php echo $block_id; ?>').css('display', 'block');
                  jQuery('.text-color-<?php echo $block_id; ?>').css('display', 'none');
              } else if (getPostType == 'ct_client' ) {
                  jQuery('.no-show-<?php echo $block_id; ?>').css('display', 'none');
                  jQuery('.<?php echo $block_id; ?>-noshow, .column-number-<?php echo $block_id; ?>').css('display', 'none');
                  jQuery('.description-client-<?php echo $block_id; ?>').css('display', 'block');
              } else if (getPostType == 'post' ) {
                  jQuery('.no-show-<?php echo $block_id; ?>').css('display', 'none');
                  jQuery('.<?php echo $block_id; ?>-noshow').css('display', 'block');
                  jQuery('.column-number-<?php echo $block_id; ?>, .no-show-<?php echo $block_id; ?>').css('display', 'none');
                  jQuery('.description-post-<?php echo $block_id; ?>').css('display', 'block');
                }
            });
          </script>



              <div class="clear"></div>
          </div>

        <?php
        }

		function block($instance) {
          extract($instance);



      switch ($size) {
        case 'col-sm-1':
           $characters_num = '40';
        break;

        case 'col-sm-2':
           $characters_num = '60';
        break;

        case 'col-sm-3':
            $characters_num = '110';
        break;

        case 'col-sm-4':
            $characters_num = '150';
        break;

        case 'col-sm-5':
            $characters_num = '190';
        break;

        case 'col-sm-6':
            $characters_num = '230';
        break;

        case 'col-sm-7':
            $characters_num = '180';
        break;

        case 'col-sm-8':
            $characters_num = '210';
        break;

        case 'col-sm-9':
            $characters_num = '250';
        break;

        case 'col-sm-10':
            $characters_num = '280';
        break;

        case 'col-sm-11':
            $characters_num = '300';
        break;

        case 'col-sm-12':
            $characters_num = '340';
        break;
      }

      //checks selected post type
      switch($post_types) {
        case 'ct_gallery':

          switch ($column_number){
           case 3:
               $span_size = 'col-sm-4';
           break;

           case 4:
               $span_size = 'col-sm-3';
           break;

           case 6:
               $span_size = 'col-sm-2';
           break;

        } ?>

          <style type="text/css">
              .block-wrap-<?php echo $block_id; ?> .img-post .post h6 {
                  color: <?php echo $post_headline_color; ?>;
              }

              .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                  color: <?php echo $headline_color; ?>;
              }
          </style>

          <div class="row block-wrap-<?php echo $block_id; ?> page-builder-gallery  gallery-posts img-posts-wrapper">

            <?php if(!empty($module_headline)){ ?>
                <h2><?php echo htmlspecialchars_decode($module_headline); ?></h2>
            <?php } ?>

                <div class="gallery-wrapper col-num<?php echo $column_number; ?> clearfix">
                  <div class="gallery-images-content">
                    <?php
                    $cat_id = get_term_by( 'name', $ct_gallery, 'ct_gallery', ARRAY_A );
                    $enable_single = get_theme_option(wp_get_theme()->name . '_gallery_gallery_single');

                    if(isset($cat_id['term_id'])){
                        $args=array('tax_query' => array(
                            array(
                                'taxonomy' => 'ct_gallery',
                                'field' => 'id',
                                'terms' => $cat_id['term_id']
                        )),
                        'post_type' => 'gallery',
                        'post_status' => 'publish',
                        'ignore_sticky_posts'=> 1,
                        'posts_per_page' => $post_number);
                    } else {
                        $args=array('post_type' => 'gallery', 'post_status' => 'publish', 'ignore_sticky_posts'=> 1, 'posts_per_page' => $post_number);
                    }
                    //The Query

                    $the_query = new WP_Query( $args );

                    //The Loop
                    if ($the_query->have_posts() ) : while ( $the_query->have_posts() ) :  $the_query->the_post();

                        $post_category = wp_get_post_terms( $the_query->post->ID, 'ct_gallery' );
                        $format = get_post_format();
                        $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $the_query->post->ID ), 'pb_gallery');
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $the_query->post->ID ), 'pb_gallery');


                        if($format == 'gallery'){
                            $random_name = generateRandomString();
                            $slide_images = get_post_meta($the_query->post->ID, 'tk_repeatable', true); ?>
                            <div class="<?php echo $span_size; ?> img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                              <figure>
                                <?php if(!empty($slide_images[0])){?>
                                    <img src="<?php echo tk_get_thumb(700, 514, $slide_images[0]); ?>" />
                                <?php  }else{ // if has image set?>
                                    <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                                <?php }// if not :-)?>
                                <?php foreach(array_slice($slide_images, 0) as $the_image) { ?>
                                <div class="post-opt-wrapper">
                                        <div class="post-options <?php if($enable_single == 'no') { echo 'no-single'; } ?>">
                                            <a href="<?php echo $the_image; ?>" class="fancybox" rel="<?php echo $random_name ?>"><i class="gallery-hover-dots gallery-page"></i></a>
                                            <?php if($enable_single == 'yes') { ?><a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a><?php } ?>
                                        </div>
                                </div>
                                <?php } ?>
                              </figure>

                              <div class="post">
                                <?php if($enable_single == 'yes') { ?><h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6><?php } else { ?><h6><?php the_title(); ?></h6><?php } ?>
                                <div class="meta-data">
                                  <ul class="categories clearfix gallery-categories">
                                      <?php echo strip_tags(get_the_term_list($the_query->post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null)); ?>
                                  </ul>
                                </div>
                              </div>
                            </div><!--/gallery-images-one-->

                        <?php }elseif($format == 'video'){
                          $video_link = get_post_meta($the_query->post->ID, 'tk_video_link', true);
                          $pos_youtube = strpos($video_link, 'youtube');
                          ?>
                          <div class="<?php echo $span_size; ?> img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?> video-project">
                              <figure>
                                <?php if(!empty($image)){?>
                                  <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                <?php  }else{ // if has image set?>
                                    <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>" alt="gallery_alt" title="gallery_title"/>
                                <?php }// if not :-)?>
                                <div class="post-opt-wrapper">
                                  <div class="post-options <?php if($enable_single == 'no') { echo 'no-single'; } ?>">
                                      <a class="<?php if (!empty($pos_youtube)){echo 'youtube';}else{echo 'vimeo';}?>" href="<?php echo $video_link; ?>" title="<?php echo the_title() ?>"><i class="fa fa-play gallery-page"></i></a>
                                      <?php if($enable_single == 'yes') { ?><a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a><?php } ?>
                                  </div>
                                </div>
                              </figure>
                              <div class="post">
                                <?php if($enable_single == 'yes') { ?><h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6><?php } else { ?><h6><?php the_title(); ?></h6><?php } ?>
                                <div class="meta-data">
                                  <ul class="categories clearfix gallery-categories">
                                    <?php echo strip_tags(get_the_term_list($the_query->post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null)); ?>
                                  </ul>
                                </div>
                              </div>
                          </div><!--/gallery-images-one-->
                        <?php }else{ ?>
                            <div class="<?php echo $span_size; ?> img-post <?php foreach($post_category as $post_cat){echo 'class-'.$post_cat->term_id.' ';}?>">
                              <figure>
                                <?php if(!empty($image)){?>
                                <img src="<?php echo $image[0]; ?>" alt="<?php echo the_title() ?>" title="<?php echo the_title() ?>" />
                                <?php  }else{ // if has image set?>
                                    <img src="<?php echo get_template_directory_uri().'/theme-images/no-image.jpg';?>"/>
                                <?php }// if not :-)?>
                                <div class="post-opt-wrapper">
                                  <div class="post-options <?php if($enable_single == 'no') { echo 'no-single'; } ?>">
                                      <a href="<?php echo $image_full[0]; ?>" class="fancybox" title="<?php echo the_title() ?>"><i class="fa fa-plus"></i></a>
                                      <?php if($enable_single == 'yes') { ?><a href="<?php the_permalink()?>"><i class="fa fa-level-up"></i></a><?php } ?>
                                  </div>
                                </div>
                              </figure>
                              <div class="post">
                                <?php if($enable_single == 'yes') { ?><h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6><?php } else { ?><h6><?php the_title(); ?></h6><?php } ?>
                                <div class="meta-data">
                                  <ul class="categories clearfix gallery-categories">
                                    <?php echo strip_tags(get_the_term_list($the_query->post->ID, 'ct_gallery', null, ' <span class="gallery-category-divider">&#9679;</span> ', null)); ?>
                                  </ul>
                                </div>
                              </div>
                            </div><!--/gallery-images-one-->
                        <?php } // if  checking format type ?>

                    <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>

                  </div><!--/gallery-images-content-->
                </div>




                <script type="text/javascript">

                  jQuery(function(){
                    var opts = {
                      lines: 9, // The number of lines to draw
                      length: 6, // The length of each line
                      width: 2, // The line thickness
                      radius: 5, // The radius of the inner circle
                      corners: 0.4, // Corner roundness (0..1)
                      rotate: 0, // The rotation offset
                      color: '#FFF', // #rgb or #rrggbb
                      speed: 1, // Rounds per second
                      trail: 60, // Afterglow percentage
                      shadow: true, // Whether to render a shadow
                      hwaccel: false, // Whether to use hardware acceleration
                      className: 'spinner', // The CSS class to assign to the spinner
                      zIndex: 2e9, // The z-index (defaults to 2000000000)
                      top: 'auto', // Top position relative to parent in px
                      left: 'auto' // Left position relative to parent in px
                    };
                    var target = document.getElementById('portfolio-loader');
                    var spinner = new Spinner(opts).spin(target);
                    var target2 = document.getElementById('portfolio-loader2');
                    var spinner2 = new Spinner(opts).spin(target2);
                  })

                  jQuery(document).ready(function(){

                    //LOAD ISOTOPE
                    var container = jQuery('.gallery-images-content');
                    jQuery(container).imagesLoaded(function(){
                      jQuery('.portfolio-loader').attr('style', 'display:none');
                      jQuery(container).show().animate({opacity:1},1000);
                      jQuery('.gallery-images-content').show();
                      jQuery(container).isotope({
                        layoutMode:'fitRows',
                        itemSelector:'.img-post',
                        isAnimated:true,
                        animationEngine:'jquery',
                        animationOptions:{
                        duration:800,
                        easing:'easeOutCubic',
                        queue:false
                          }
                        });
                      });

                      jQuery('.gallery-single-images').imagesLoaded(function(){
                          jQuery('.portfolio-loader2').attr('style', 'display:none');
                          jQuery('.gallery-single-images').attr('style', 'display:inline-block');
                      });


                      jQuery('.img-post').hover(function(){
                        jQuery('.gallery-hover',this).stop().animate({opacity:1},300);
                        jQuery('.gallery-hover a',this).stop().animate({opacity:1},300);
                        jQuery('.gallery-hover-title',this).stop().animate({top: '22%'},300);
                        jQuery('.gallery-hover-icon',this).stop().animate({bottom: '<?php if($enable_single == 'yes'){echo '22%';}else{echo '40%';}?>'},300);
                      },function(){
                          jQuery('.gallery-hover',this).stop().animate({opacity:0},300);
                          jQuery('.gallery-hover a',this).stop().animate({opacity:0},300);
                          jQuery('.gallery-hover-title',this).stop().animate({top: '-5%'},500);
                          jQuery('.gallery-hover-icon',this).stop().animate({bottom: '-5%'},500);
                      });


                  })

              </script>


            </div><!-- img-posts-wrapper -->



              <?php break;

              case 'ct_team': ?>


                <style type="text/css">
                  .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                    color: <?php echo $headline_color; ?>;
                  }

                  .shortcodes .block-wrap-<?php echo $block_id; ?>  h6 a {
                    color: <?php echo $post_headline_color; ?>;
                  }

                  .shortcodes .block-wrap-<?php echo $block_id; ?>  p {
                    color: <?php echo $text_color; ?>;
                  }
                </style>


                <div class="row block-wrap-<?php echo $block_id; ?> partners">

                    <?php if(!empty($module_headline)){?>
                      <div class="title-holder margin-bottom-45">
                        <h2 class="title-divider">
                          <span><?php echo htmlspecialchars_decode($module_headline)?></span>
                        </h2>
                      </div>
                    <?php }?>
                    <div class="clear"></div>
                    <?php

                    $category = '';
                    $prefix = 'tk_';

                    $cat_id = get_term_by( 'name', $ct_team, 'ct_team', ARRAY_A );
                    if(empty($cat_id)){
                        $args = array('post_status' => 'publish', 'post_type' => 'team-members', 'posts_per_page' => $post_number, 'ignore_sticky_posts'=> 1 );
                    }else{
                        $args = array(
                            'tax_query' => array(
                                    array(
                                        'taxonomy' => 'ct_team',
                                        'field' => 'id',
                                        'terms' => $cat_id['term_id']
                                )),
                            'post_status' => 'publish',
                            'post_type' => 'team-members',
                            'posts_per_page' => $post_number,
                            'ignore_sticky_posts' => 1 );
                    }
                        // The Query

                        $the_query = new WP_Query($args);
                        if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();

                            $facebook_ico = get_post_meta($the_query->post->ID, 'tk_member_facebook', true);
                            $twitter_ico = get_post_meta($the_query->post->ID, 'tk_member_twitter', true);
                            $google_ico = get_post_meta($the_query->post->ID, 'tk_member_google', true);
                            $linkedin_ico = get_post_meta($the_query->post->ID, 'tk_member_linkedin', true);
                            $pinterest_ico = get_post_meta($the_query->post->ID, 'tk_member_pinterest', true);
                            $dribbble_ico = get_post_meta($the_query->post->ID, 'tk_member_dribbble', true);
                            $mail_ico = get_post_meta($the_query->post->ID, 'tk_member_mail', true);
                            $job_title = get_post_meta($the_query->post->ID, 'tk_member_position', true);

                        ?>
                            <div class="news-wrap team-wrap margin-bottom-builder left">

                              <div class="col-sm-12 margin-left-0">
                                <div class="img-post team-style">

                                    <?php if(has_post_thumbnail()){
                                          $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($the_query -> post->ID), 'blog-slider' );
                                          $post_thumbnail_src = $post_thumbnail['0']; ?>
                                       <figure>
                                           <?php the_post_thumbnail('our-team'); ?>
                                       </figure>
                                     <?php
                                     $img_class = '';
                                        } else {
                                           $img_class = 'set-fullwidth';
                                       } ?>

                                       <div class="post <?php echo $img_class; ?>">

                                         <div class="profile-info">
                                            <h6><?php the_title(); ?></h6>

                                            <?php if(!empty($job_title)){ ?>
                                                <span><?php echo $job_title; ?></span>
                                            <?php } ?>

                                            <?php /*---SOCIAL ICONS---*/
                                                if ($facebook_ico != '' || $twitter_ico != '' || $google_ico != '' || $linkedin_ico != '' || $pinterest_ico != '' || $dribbble_ico != '' || $mail_ico != '') {
                                                        ?>
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


                                         <?php the_content(); ?>
                                         </div><!-- profile-info -->

                                       </div><!-- post -->
                                     </div>
                                   </div>

                            </div><!-- news-wrap -->
                        <div class="clear"></div>
                        <?php endwhile; endif; ?>
                  </div>
              <?php  break;

                case 'ct_client': ?>


              <style type="text/css">
                  .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                      color: <?php echo $headline_color; ?>;
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

                <?php if($module_headline){ ?>
                    <div class="nav-arrow-devider <?php if(empty($module_headline)) { echo $noborder; } ?> clearfix">
                        <nav class="nav-arrows nav-arrows<?php echo $block_id; ?><?php echo $template_id; ?> pull-right"></nav>
                    </div>
                <?php } ?>
                <ul class="clients-fixed">

                <?php

                $cat_id = get_term_by( 'name', $ct_client, 'ct_client', ARRAY_A );

                  if(!empty($cat_id)){
                      $args = array(
                          'post_status' => 'publish',
                          'post_type' => 'client',
                          'posts_per_page' =>$post_number,
                          'meta_key' => '_thumbnail_id',
                          'ignore_sticky_posts'=> 1,
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
                          'ignore_sticky_posts'=> 1,
                          'meta_key' => '_thumbnail_id',
                      );
                  }

                  // The Query
                  $the_query = new WP_Query($args);
                  if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();

                  $partner_link = get_post_meta($the_query->post->ID, 'tk_client_link', true);

                  ?>
                      <li class="col-sm-2">

                          <?php if(!empty($partner_link)){ ?>
                              <a href="<?php echo $partner_link; ?>" rel="tooltip" data-toggle="tooltip" data-original-title="<?php the_title(); ?>">
                          <?php } ?>
                              <?php the_post_thumbnail('gallery-3-images'); ?>
                          <?php if(!empty($partner_link)){ ?>
                              </a>
                          <?php } ?>
                      </li>

                  <?php endwhile; endif; ?>

                </ul>
              </div><!-- partners -->


              <script type="text/javascript">
                  jQuery(document).ready(function($){
                      $(function(){
                          $('[rel="tooltip"]').tooltip();
                       });
                   });
              </script>


              <?php  break;

              case 'post':
                $cat_id = get_term_by( 'name', $ct_post, 'category', ARRAY_A );
                $prefix = "tk_";
                global $post, $more;
                if (!$post_headline_color) {
                  $post_headline_color = '#000';
                }
                ?>

              <style type="text/css">
                  .shortcodes .block-wrap-<?php echo $block_id; ?> h2 {
                      color: <?php echo $headline_color; ?>;
                  }

                  #container .container .block-wrap-<?php echo $block_id; ?> .rating li strong a,
                  #container .container .block-wrap-<?php echo $block_id; ?> .rating li strong span,
                  #container .container .block-wrap-<?php echo $block_id; ?> .rating li a,
                  #container .container .block-wrap-<?php echo $block_id; ?> .rating li span,
                  .block-wrap-<?php echo $block_id; ?> .small-type-date, .shortcodes .block-wrap-<?php echo $block_id; ?>  h6 a {
                      color: <?php echo $post_headline_color; ?>;
                  }

                  #container .container .block-wrap-<?php echo $block_id; ?> .rating li strong span {
                      opacity: 0.7;
                      filter: alpha(opacity=70);
                  }

                  .shortcodes .block-wrap-<?php echo $block_id; ?>  p {
                      color: <?php echo $text_color; ?>;
                  }
              </style>

              <div class="row block-wrap-<?php echo $block_id; ?>">

                <?php if($size == 'col-sm-7' || $size == 'col-sm-8' || $size == 'col-sm-9' || $size == 'col-sm-10' || $size == 'col-sm-11' || $size == 'col-sm-12') {
                    $background_color = "post-background";
                }  else {
                    $background_color = "";
                }?>


                <?php if(!empty($module_headline)){?>
                  <div class="title-holder margin-bottom-45">
                    <h2 class="title-divider">
                      <span><?php echo htmlspecialchars_decode($module_headline);?></span>
                    </h2>
                  </div>
                <?php } ?>
                <div class="clear"></div>
                <?php

                if($cat_id == ''){
                    $args = array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_number, 'ignore_sticky_posts'=> 1 );
                }else{
                    $args = array('cat' => $cat_id['term_id'], 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_number, 'ignore_sticky_posts' => 1 );
                }
                    // The Query

                    $the_query = new WP_Query($args);
                    $count = $the_query->post_count;
                    $i = 0;
                    if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <?php
                        $attachments  = get_post_meta($the_query->post->ID, 'tk_repeatable', true);
                        $video_link = get_post_meta($the_query->post->ID, 'tk_video_link', true);
                        ?>

                        <div class="news-wrap margin-bottom-builder left <?php echo $the_query->current_post + 1 === $the_query->post_count ? 'last_post' : '' ?>">
                            <?php if (get_post_format() == 'quote') {
                                    $quote_text = get_post_meta($the_query->post->ID, $prefix.'quote', true);
                                    $quote_author = get_post_meta($the_query->post->ID, $prefix.'quote_author', true);
                                ?>
                                <div class="col-sm-12 margin-left-0">
                                    <div class="img-post builder-quote-post <?php echo $background_color; ?>">
                                        <div class="quote-post-big">
                                            <div class="post-big">
                                                <blockquote>
                                                    <p><?php echo $quote_text; ?></p><small><?php echo $quote_author; ?></small>
                                                </blockquote>
                                            </div>
                                        </div>
                                        <div class="post">
                                            <div class="meta-data date page-builder-date"><span class="meta-date"><?php the_time('F j, Y'); ?></span></div>
                                            <div class="meta-data builder-categories">
                                                <ul class="categories clearfix meta-data">
                                                    <?php echo get_the_category_list(' <span class="gallery-category-divider">&#9679;</span> ', $the_query -> post->ID); ?>
                                                </ul>
                                            </div>
                                                <a href="<?php the_permalink(); ?>" class="meta-data button-small <?php if($instance['size'] == 'col-sm-2' || $instance['size'] == 'col-sm-3') { echo 'pull-left'; }else{echo 'pull-right';} ?>"><?php _e('read more', 'tkingdom'); ?></a>
                                        </div>


                                    </div>
                                </div>
                            <?php }elseif (get_post_format() == 'link') {
                                    $link_text = get_post_meta($the_query->post->ID , $prefix.'link_text', true);
                                    $link_url = get_post_meta($the_query->post->ID , $prefix.'link_url', true);
                                ?>

                                <div class="col-sm-12 margin-left-0">
                                    <div class="img-post builder-quote-post <?php echo $background_color; ?>">
                                        <div class="link-post-big">
                                            <div class="post-big">
                                                <div class="link">
                                                    <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a><small><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="post">
                                            <div class="meta-data date page-builder-date"><span class="meta-date"><?php the_time('F j, Y'); ?></span></div>
                                            <div class="meta-data builder-categories">
                                                <ul class="categories clearfix meta-data">
                                                    <?php echo get_the_category_list(' <span class="gallery-category-divider">&#9679;</span> ', $the_query -> post->ID); ?>
                                                </ul>
                                            </div>
                                                <a href="<?php the_permalink(); ?>" class="meta-data button-small <?php if($instance['size'] == 'col-sm-2' || $instance['size'] == 'col-sm-3') { echo 'pull-left'; }else{echo 'pull-right';} ?>"><?php _e('read more', 'tkingdom'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } elseif (get_post_format() == 'video') {?>

                            <?php switch ($post_look){ //magma-only
                               case 1:
                                   $post_size = 'large_type';
                               break;

                               case 2:
                                   $post_size = 'small_type';
                               break;
                            } //magma-only?>


                            <div class="col-sm-12 margin-left-0 <?php echo $post_size; ?>">
                              <div class="img-post <?php echo $background_color; ?> <?php if(!has_post_thumbnail()) { echo 'no-image-padding'; }?>">

                                  <?php if(has_post_thumbnail()){
                                              $img_class = '';
                                            if($post_size == 'small_type') {
                                              $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($the_query -> post->ID), 'pb_allpostssmall' );
                                            } else {
                                              $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($the_query -> post->ID), 'pb_allposts' );
                                            }
                                              $post_thumbnail_src = $post_thumbnail['0']; ?>
                                           <figure>
                                            <?php if($post_size == 'small_type') { ?>
                                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pb_allpostssmall'); ?></a>
                                                 <?php }else{ ?>
                                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pb_allposts'); ?></a>
                                                 <?php } ?>

                                               <div class="post-opt-wrapper">
                                                   <div class="post-options">
                                                       <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox" title="<?php the_title()?>"><i class="fa fa-plus"></i></a>
                                                       <a href="<?php the_permalink(); ?>"><i class="fa fa-level-up"></i></a>
                                                   </div>
                                               </div>
                                             <?php
                                              /*
                                               * RATING SYSTEM MAGMA
                                               */
                                              $i = 0;
                                              $overal_rating = 0;
                                              $check_rating = get_post_meta($the_query -> post ->ID, 'tk_enable_rating', true);
                                              $check_user_rating = get_post_meta($the_query -> post ->ID, 'tk_reader_rating', true);
                                              if ($check_rating == 'on') {
                                                  $post_rating = get_post_meta($the_query -> post ->ID, 'tk_post_rating', true);
                                                  $total_label = get_post_meta($the_query -> post ->ID, 'tk_rating_total', true);
                                                  $post_rating_criteria = get_post_meta($the_query -> post ->ID, 'criteria-tk_post_rating', true);
                                                  $post_rating_rate = get_post_meta($the_query -> post ->ID, 'rating-tk_post_rating', true);

                                                  ?>
                                                    <?php foreach ($post_rating as $one_criteria) { ?>
                                                            <?php $post_rating_criteria[$i] ?>
                                                            <?php $post_rating_rate[$i]; ?>
                                                    <?php
                                                    $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                    $i++;
                                                    } ?>
                                            <p class="pb-rating-value"><?php echo round($overal_rating / $i, 1); ?></p>
                                            <?php } //RATING SISTEM MAGMA END?>
                                           </figure>
                                     <?php } else {
                                       $img_class = 'set-fullwidth';
                                            /*
                                             * RATING SYSTEM MAGMA
                                             */
                                            $i = 0;
                                            $overal_rating = 0;
                                            $check_rating = get_post_meta($the_query -> post ->ID, 'tk_enable_rating', true);
                                            $check_user_rating = get_post_meta($the_query -> post ->ID, 'tk_reader_rating', true);
                                            if ($check_rating == 'on') {
                                                $post_rating = get_post_meta($the_query -> post ->ID, 'tk_post_rating', true);
                                                $total_label = get_post_meta($the_query -> post ->ID, 'tk_rating_total', true);
                                                $post_rating_criteria = get_post_meta($the_query -> post ->ID, 'criteria-tk_post_rating', true);
                                                $post_rating_rate = get_post_meta($the_query -> post ->ID, 'rating-tk_post_rating', true);

                                                ?>
                                                  <?php foreach ($post_rating as $one_criteria) { ?>
                                                          <?php $post_rating_criteria[$i] ?>
                                                          <?php $post_rating_rate[$i]; ?>
                                                  <?php
                                                  $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                  $i++;
                                                  } ?>
                                          <p class="pb-rating-value-no-img"><?php echo round($overal_rating / $i, 1); ?></p>
                                          <?php } //RATING SISTEM MAGMA END?>
                                      <?php } ?>
                                     <div class="post <?php echo $img_class;?>">
                                         <h6><a href="<?php the_permalink(); ?>">
                                          <?php
                                          $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                                          if($video_link) { ?><i class="fa fa-youtube-play"></i><?php } ?>
                                          <?php the_title(); ?></a></h6>
                                         <p>
                                            <?php
                                            if( $post->post_excerpt ) {
                                                the_excerpt();
                                            } else {
                                                global $more; $more = 0;
                                                the_content('More...');
                                            }
                                            ?>
                                         </p>

                                        <div class="meta-data">
                                           <?php if ($post_size == 'small_type' && !has_post_thumbnail()) {
                                            /*
                                             * RATING SYSTEM MAGMA
                                             */
                                            $i = 0;
                                            $overal_rating = 0;
                                            $check_rating = get_post_meta($the_query -> post ->ID, 'tk_enable_rating', true);
                                            $check_user_rating = get_post_meta($the_query -> post ->ID, 'tk_reader_rating', true);
                                            if ($check_rating == 'on') {
                                                $post_rating = get_post_meta($the_query -> post ->ID, 'tk_post_rating', true);
                                                $total_label = get_post_meta($the_query -> post ->ID, 'tk_rating_total', true);
                                                $post_rating_criteria = get_post_meta($the_query -> post ->ID, 'criteria-tk_post_rating', true);
                                                $post_rating_rate = get_post_meta($the_query -> post ->ID, 'rating-tk_post_rating', true);

                                                ?>
                                                  <?php foreach ($post_rating as $one_criteria) { ?>
                                                          <?php $post_rating_criteria[$i] ?>
                                                          <?php $post_rating_rate[$i]; ?>
                                                  <?php
                                                  $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                  $i++;
                                                  } ?>
                                              <p class="pb-rating-value-small-no-image"><?php echo round($overal_rating / $i, 1); ?></p>
                                              <?php } //RATING SISTEM MAGMA END
                                            }?>

                                              <?php if($post_size !== 'small_type') { ?>
                                                  <ul class="rating">
                                                     <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                                                  </ul>
                                              <?php } ?>

                                              <?php if($post_size == 'small_type') { ?>
                                                  <div class="small-type-date"><?php the_time('d M, y'); ?></div>
                                              <?php } ?>
                                         </div>

                                     </div>
                                   </div>
                                 </div>

                            <?php } elseif (get_post_format() == 'gallery') {?>

                              <div class="col-sm-12 margin-left-0">
                                <div class="img-post <?php echo $background_color; ?>">
                                    <?php if(!empty ($attachments[0])){?>
                                       <div class="flexslider-part8">
                                           <figure class="flexslider flexslider-8">
                                               <ul class="slides">

                                                   <?php
                                                   if(function_exists('tk_get_thumb')){
                                                        foreach($attachments as $attach) {
                                                            echo '<li><img src="'.tk_get_thumb(1170, 658, $attach).'" alt="'.get_the_title().'" title="'.get_the_title().'"/></li>';
                                                         }
                                                   }
                                                   ?>

                                               </ul>
                                           </figure><!-- flex slider -->
                                       </div>
                                    <?php } ?>

                                      <div class="post">
                                           <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                            <p>
                                              <?php
                                              if( $post->post_excerpt ) {
                                                  the_excerpt();
                                              } else {
                                                  global $more; $more = 0;
                                                  the_content('More...');
                                              }
                                              ?>
                                            </p>
                                           <div class="meta-data date page-builder-date"><span class="meta-date"><?php the_time('F j, Y'); ?></span></div>
                                           <div class="meta-data">
                                             <ul class="categories clearfix meta-data">
                                              <?php echo get_the_category_list(' <span class="gallery-category-divider">&#9679;</span> ', $the_query -> post->ID); ?>
                                             </ul>
                                           </div>
                                       </div>
                                    </div>
                                  </div>

                              <?php } else { ?>

                                <?php switch ($post_look){ //magma-only
                                   case 1:
                                       $post_size = 'large_type';
                                   break;

                                   case 2:
                                       $post_size = 'small_type';
                                   break;
                                } //magma-only?>


                                <div class="col-sm-12 margin-left-0 <?php echo $post_size; ?>">
                                    <div class="img-post <?php echo $background_color; ?> <?php if(!has_post_thumbnail()) { echo 'no-image-padding'; }?>">

                                        <?php if(has_post_thumbnail()){
                                          $img_class = '';
                                        if($post_size == 'small_type') {
                                          $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($the_query -> post->ID), 'pb_allpostssmall' );
                                        } else {
                                          $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($the_query -> post->ID), 'pb_allposts' );
                                        }
                                          $post_thumbnail_src = $post_thumbnail['0']; ?>
                                       <figure>
                                        <?php if($post_size == 'small_type') { ?>
                                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pb_allpostssmall'); ?></a>
                                             <?php }else{ ?>
                                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pb_allposts'); ?></a>
                                             <?php } ?>

                                           <div class="post-opt-wrapper">
                                               <div class="post-options">
                                                   <a href="<?php echo $post_thumbnail_src;?>" class="blog-fancybox fancybox" title="<?php the_title()?>"><i class="fa fa-plus"></i></a>
                                                   <a href="<?php the_permalink(); ?>"><i class="fa fa-level-up"></i></a>
                                               </div>
                                           </div>
                                         <?php
                                          /*
                                           * RATING SYSTEM MAGMA
                                           */
                                          $i = 0;
                                          $overal_rating = 0;
                                          $check_rating = get_post_meta($the_query -> post ->ID, 'tk_enable_rating', true);
                                          $check_user_rating = get_post_meta($the_query -> post ->ID, 'tk_reader_rating', true);
                                          if ($check_rating == 'on') {
                                              $post_rating = get_post_meta($the_query -> post ->ID, 'tk_post_rating', true);
                                              $total_label = get_post_meta($the_query -> post ->ID, 'tk_rating_total', true);
                                              $post_rating_criteria = get_post_meta($the_query -> post ->ID, 'criteria-tk_post_rating', true);
                                              $post_rating_rate = get_post_meta($the_query -> post ->ID, 'rating-tk_post_rating', true);

                                              ?>
                                                <?php foreach ($post_rating as $one_criteria) { ?>
                                                        <?php $post_rating_criteria[$i] ?>
                                                        <?php $post_rating_rate[$i]; ?>
                                                <?php
                                                $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                $i++;
                                                } ?>
                                        <p class="pb-rating-value"><?php echo round($overal_rating / $i, 1); ?></p>
                                        <?php }  //RATING SISTEM MAGMA END?>
                                       </figure>
                                           <?php } else {
                                               $img_class = 'set-fullwidth';
                                                /*
                                                 * RATING SYSTEM MAGMA
                                                 */
                                                $i = 0;
                                                $overal_rating = 0;
                                                $check_rating = get_post_meta($the_query -> post ->ID, 'tk_enable_rating', true);
                                                $check_user_rating = get_post_meta($the_query -> post ->ID, 'tk_reader_rating', true);
                                                if ($check_rating == 'on') {
                                                    $post_rating = get_post_meta($the_query -> post ->ID, 'tk_post_rating', true);
                                                    $total_label = get_post_meta($the_query -> post ->ID, 'tk_rating_total', true);
                                                    $post_rating_criteria = get_post_meta($the_query -> post ->ID, 'criteria-tk_post_rating', true);
                                                    $post_rating_rate = get_post_meta($the_query -> post ->ID, 'rating-tk_post_rating', true);

                                                    ?>
                                                      <?php foreach ($post_rating as $one_criteria) { ?>
                                                              <?php $post_rating_criteria[$i] ?>
                                                              <?php $post_rating_rate[$i]; ?>
                                                      <?php
                                                      $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                      $i++;
                                                      } ?>
                                                  <p class="pb-rating-value-no-img"><?php echo round($overal_rating / $i, 1); ?></p>
                                                  <?php } //RATING SISTEM MAGMA END?>
                                              <?php } ?>
                                             <div class="post <?php echo $img_class;?>">
                                                 <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                                 <p>
                                                  <?php
                                                  if( $post->post_excerpt ) {
                                                      the_excerpt();
                                                  } else {
                                                    global $more; $more = 0;
                                                      the_content('More...');
                                                  }
                                                  ?>
                                                 </p>

                                                <div class="meta-data">
                                                   <?php if ($post_size == 'small_type' && !has_post_thumbnail()) {
                                                    /*
                                                     * RATING SYSTEM MAGMA
                                                     */
                                                    $i = 0;
                                                    $overal_rating = 0;
                                                    $check_rating = get_post_meta($the_query -> post ->ID, 'tk_enable_rating', true);
                                                    $check_user_rating = get_post_meta($the_query -> post ->ID, 'tk_reader_rating', true);
                                                    if ($check_rating == 'on') {
                                                        $post_rating = get_post_meta($the_query -> post ->ID, 'tk_post_rating', true);
                                                        $total_label = get_post_meta($the_query -> post ->ID, 'tk_rating_total', true);
                                                        $post_rating_criteria = get_post_meta($the_query -> post ->ID, 'criteria-tk_post_rating', true);
                                                        $post_rating_rate = get_post_meta($the_query -> post ->ID, 'rating-tk_post_rating', true);

                                                        ?>
                                                          <?php foreach ($post_rating as $one_criteria) { ?>
                                                                  <?php $post_rating_criteria[$i] ?>
                                                                  <?php $post_rating_rate[$i]; ?>
                                                          <?php
                                                          $overal_rating = $overal_rating + $post_rating_rate[$i];
                                                          $i++;
                                                          } ?>
                                                      <p class="pb-rating-value-small-no-image"><?php echo round($overal_rating / $i, 1); ?></p>
                                                      <?php } //RATING SISTEM MAGMA END
                                                    } ?>

                                                    <?php if($post_size !== 'small_type') { ?>
                                                       <ul class="rating">
                                                          <?php get_template_part( '/templates/parts/entry', 'meta' ); ?>
                                                       </ul>
                                                    <?php } ?>

                                                    <?php if($post_size == 'small_type') { ?>
                                                       <div class="small-type-date"><?php the_time('d M, y'); ?></div>
                                                    <?php } ?>

                                                </div>
                                             </div>
                                         </div>
                                     </div>
                                    <?php } ?>
                            </div><!-- news-wrap -->
                          <div class="clear"></div>

                  <?php $i++; endwhile; endif; ?>


              </div><!-- block-wrap -->


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
