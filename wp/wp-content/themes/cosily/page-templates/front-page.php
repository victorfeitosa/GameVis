<?php
/*
 Template Name: Front Page Template
 */
 
get_header();

$prefix = 'tk_';
$hide_reservations = get_theme_option(tk_theme_name.'_reservations_hide_reservations');
?>

        <?php
            /*******SLIDER******/
            $check_slider = get_theme_option(tk_theme_name.'_home_slider_select_slider');
            $slider_alias = get_theme_option(tk_theme_name.'_home_slider_slider_id');
            $slider_height = get_theme_option(tk_theme_name.('_home_slider_slider_height'));
        ?>

    <?php 
    if(isset($check_slider)){
        if ($check_slider == 'revolution') {?>
        <?php if (function_exists('putRevSlider')) { ?>
            <div class="slider-home left">
                <?php  putRevSlider($slider_alias);?>
                <div class="bottom-slider-red rev-slider-border <?php if(!empty($hide_reservations)) { echo 'bot-slider-margin'; } ?>"></div><!--/bottom-slider-red-->
            </div><!--/home-slider-->
        <?php } ?>
            
    <?php } elseif ($check_slider == 'slitslider') { ?>

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

                    $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');

                     ?>

                    <style type="text/css">                    
                        .sl-slide-horizontal  .inner<?php echo $post->ID ?> {
                            background:url('<?php echo $image_full[0]; ?>') center no-repeat, url('<?php echo $pattern_upload; ?>') center repeat, #<?php echo $background_color; ?>;          
                        }

                        .inner<?php echo $post->ID ?>  h2,   .inner<?php echo $post->ID ?>  h2 a {
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
                                                         
                                    <div class="slider-text-wrapper">
                                        <div class="bg-img bg-img-1"></div>
                                        <?php if(!empty($slider_link)){ ?>
                                            <h2><a target="_blank" href="<?php echo $slider_link; ?>"><?php the_title(); ?></a></h2>
                                        <?php } else { ?>
                                            <h2><?php the_title(); ?></h2>
                                        <?php } ?>
                                        <blockquote><?php the_content(); ?></blockquote>
                                    </div><!-- slider-text-wrapper -->
                                                              
                            </div>
                        </div>

                    <?php $i++; endwhile; endif; ?>



                </div><!-- /sl-slider -->
                
                <?php if($i > 1){ ?>
                    <nav id="nav-arrows" class="nav-arrows">
                        <span class="nav-arrow-prev"><?php _e('Previous', tk_theme_name); ?></span>
                        <span class="nav-arrow-next"><?php _e('Next', tk_theme_name); ?></span>
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
                <?php } ?>
                
                
            </div><!-- /slider-wrapper -->




            <div class="bottom-slider-red <?php if(!empty($hide_reservations)) { echo 'bot-slider-margin'; } ?>"></div><!--/bottom-slider-red-->
        </div><!--/slider-content-->
    <?php } ?>
<?php } ?>


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">

            
            <?php 
                
                if(empty($hide_reservations)){  ?>            
                    <div class="home-call-action left">                
                        <form name="home_form" action="" method="POST">
                            <div class="home-call-action-select left">                   

                                <?php $reservations_page = get_option('id_reservations_page'); ?>

                                        <div class="home-action-select left">
                                            <input name="arrival_date" class="arrival_date datepicker" id="arrival_date" value="<?php _e('Arrival Date', tk_theme_name); ?>">
                                        </div>

                                        <div class="home-action-select left">
                                            <input name="departure_date" class="departure_date datepicker" id="departure_date" value="<?php _e('Departure Date', tk_theme_name); ?>" />
                                        </div>

                                        <div class="home-action-select left">
                                            <select name="guests" class="guests">
                                                <option value=""><?php _e('Guests', tk_theme_name); ?></option>                                    
                                                <?php
                                                    global $wpdb;
                                                    $querystr = $wpdb->prepare("SELECT `meta_value` FROM  `".$wpdb->prefix."postmeta` WHERE  `meta_key` =  %s ORDER BY `meta_value`", $prefix."number_beds");
                                                    $page_posts = $wpdb->get_col($querystr);
                                                    $page_posts = array_unique($page_posts);                
                                                    foreach ($page_posts as $bed_num) { ?>                                    
                                                        <option value="<?php echo $bed_num; ?>"><?php echo $bed_num; ?></option>
                                                    <?php } ?>                                    
                                            </select>
                                        </div> 

                                <div class="home-action-shadow home-shadow left"></div>
                            </div><!--/home-call-action-select-->
                            <div class="home-call-action-buttom right"><a class="search-rooms-home"><p><?php _e('Search', tk_theme_name); ?></p></a></div><!--/home-call-action-buttom-->
                        </form>         
                        <div class="error-book-search"></div>
                        
                    </div><!--/home-call-action-->
                <?php } ?>  
            
                
                          
                <div class="booking1-content left">
          
                    <script type="text/javascript">                                                
                        // ajax for querying available rooms                        
                        jQuery('.search-rooms-home').click(function(){
                            
                            var arrival_date = jQuery('.arrival_date').val();
                            var departure_date = jQuery('.departure_date').val();
                            var guests = jQuery('.guests').val();                                                        
                            var get_screen = 1;
                            
                            if(arrival_date == 'Arrival Date' || departure_date == 'Departure Date' || guests == 'Guests') {
                                jQuery('.error-book-search').html('<p class="red">Please fill in all the fields</p>');
                            }
                            
                            if(arrival_date && departure_date && guests){
                            jQuery.ajax({
                                type:"POST",
                                url: "<?php echo get_template_directory_uri(); ?>/ajax.php", // our PHP handler file
                                context: document.body,
                                data: { arrival_date: arrival_date, departure_date: departure_date, guests: guests, check_screen: get_screen},
                                success:function(results){                            
                                    jQuery('.error-book-search').remove();
                                    jQuery('.booking1-content').html(results);                                    
                                    jQuery('.room-only-content-right a').click(function(){
                                        var get_screen = 2;                                       
                                    
                                        var room_id = jQuery(this).attr('rel');                                    
                                        jQuery.ajax({
                                            type:"POST",
                                            url: "<?php echo get_template_directory_uri(); ?>/ajax.php", // our PHP handler file
                                            context: document.body,
                                            data: { arrival_date: arrival_date, departure_date: departure_date, guests: guests, room_id: room_id, check_screen: get_screen},
                                            success:function(results){                                                
                                                jQuery('.booking1-content').html(results);
                                            } //success:function(results){             
                                        }); //jQuery.ajax({
                                                                                
                                    }); //jQuery('.room-only-content-right a').click(function()
                                } //success:function(results)
                            }); //jQuery.ajax
                            } //if(arrival_date && departure_date)
                        }); //jQuery('.datepicker, .guests').change(function()

                    </script>
                </div><!--/booking1-content-->

                
                <?php
                    $show_home_content = get_theme_option(tk_theme_name . '_home_use_home_content');                    
                    if ($show_home_content == 'yes') { ?>
                    <div class="home-headline left">
                        <div class="home-page-content no-margin left">
                            <div class="shortcodes" style="margin:0">
                                <?php wp_reset_query();
                                query_posts('page_id=' . get_theme_option(tk_theme_name . '_home_home_content'));
                                if (have_posts()) : while (have_posts()) : the_post();
                                        the_content();
                                    endwhile;
                                else:
                                endif;
                                wp_reset_query(); ?>
                            </div><!--/wrapper-->
                        </div><!--/wrapper-->
                    </div><!--/home-headline-->
                <?php } ?>
          

            
            
            
        <div class="bg-content left">

            <?php
                $args = array(
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'post_type' => 'page_builder',
                    'order' => 'ASC',
                    'meta_key' => 'tk_box_order',
                    'orderby' => 'meta_value_num',
                );
                //The Query
                $the_query = new WP_Query($args);

                //The Loop
                if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                
                        $block_type = get_the_title($post->ID);
                        
                        if ($block_type == 'one_column') {
                            // call part                            
                            get_template_part('/page-templates/_part_onecolumn');
                            
                        } elseif ($block_type == 'two_columns') {
                            // call part                          
                             get_template_part('/page-templates/_part_twocolumns');
                             
                        } elseif ($block_type == 'three_columns') {
                            // call part                           
                            get_template_part('/page-templates/_part_threecolumns');
                            
                        } elseif ($block_type == 'gallery') {
                            // call part                            
                            get_template_part('/page-templates/_part_gallery');
                        }
                        ?>

                        <?php
                        wp_reset_query();
                    endwhile;
                endif;
                ?>


            </div>            
        </div><!--/wrapper-->
    </div><!--/content-->

<?php get_footer(); ?>