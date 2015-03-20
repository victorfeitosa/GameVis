<?php
get_header();
$prefix = 'tk_';
$rooms_id = get_option('id_rooms_page');
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $rooms_id ), 'full');
$currency_position = get_theme_option(tk_theme_name.'_reservations_currency_side');
$currency_sing = get_theme_option(tk_theme_name.'_reservations_currency');
$price_per_night = get_post_meta($post->ID, $prefix.'room_price_adult', true);
$format = get_post_format();
$reservation_id = get_option('id_reservations_page');
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);
if($sidebar_postition == ''){$sidebar_postition = 'right';}
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);

$external_link = get_post_meta($post->ID, $prefix.'external_link', true);
$external_link_text = get_post_meta($post->ID, $prefix.'external_text', true);
?>



        <!-- Page Headline -->
        <div class="title-pages left">
            
             <div class="title-pages-image left">
                <?php if(has_post_thumbnail($rooms_id)) { ?>
                    <div class="title-pages-image left" style="<?php echo 'background:url('.$title_bg_image[0].')' ?>"></div>
                <?php } ?>
            </div>
            
            <div class="wrapper">
                <span><?php echo get_the_title($rooms_id)?></span>
                
                <?php
                $page_headline = get_post_meta($rooms_id, $prefix . 'headline', true);
                if ($page_headline !== "") { ?>
                <p><?php echo $page_headline ?></p>
                <?php } /*-- /page headline --*/?>
            </div>
        </div><!--/title-pages-->  
        <div class="bottom-slider-red"></div><!--/bottom-slider-red-->


    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">


                <div class="page-rooms single-room <?php if($sidebar_postition == 'right'){echo 'left';}elseif($sidebar_postition == 'left'){echo 'right';}elseif($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">

                    
                    <div class="room-single left">     
                                                    
                        <?php if(has_post_thumbnail() || $format == "gallery" || $format == "video") { ?>
                        <div class="blog-gallery left <?php if($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">                            
                            <?php 
                            if($format == 'gallery'){
                            $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);                            
                            ?>                            
                                <div class="flexslider">
                                    <ul class="slides">
                                        <?php foreach($slide_images as $one_slide){ ?>                                    
                                            <li>
                                                <?php if($sidebar_postition == 'fullwidth'){?>
                                                    <img src="<?php echo tk_get_thumb(1014, 490, $one_slide); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                                                <?php } else { ?>
                                                    <img src="<?php tk_get_thumb(620, 306, $one_slide); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                                <?php } ?>
                                            </li>
                                            
                                        <?php } ?>
                                    </ul>
                                </div><!--/flexslider-->
                            <?php } elseif ($format == "video"){
                                $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                                tk_video_player($video_link);
                            } elseif(has_post_thumbnail()) {?>    
                                <div class="preloader-image"></div>
                                <?php if($sidebar_postition == 'fullwidth'){?>
                                    <?php the_post_thumbnail('blog-full'); ?>            
                                <?php } else { ?>
                                    <?php the_post_thumbnail('blog'); ?>            
                                <?php } ?>
                                
                                    <div class="horisontal-images-hover">
                                        <p></p>
                                    </div>
                            <?php } ?>
                            
                        </div><!--/blog-gallery-->
                        <?php } ?>
                      
                        <div class="room-single-title left"><?php the_title(); ?></div><!--/room-single-title-->
                      
                        
                        <?php 
                        //checks to see if should hide reservations
                        $hide_reservations = get_theme_option(tk_theme_name.'_reservations_hide_reservations');       
                        if(empty($hide_reservations)){
                        ?>
                        
                        <div class="room-single-book-content left">
                            
                            <?php if($price_per_night !== "") {?>
                                <div class="room-single-book-night left">
                                    <span><?php _e('From ', tk_theme_name); ?><?php if($currency_position=='left') { echo $currency_sing; }  echo $price_per_night;  if($currency_position=='right') { echo $currency_sing; } ?></span>
                                    <p>/ <?php _e('Per Night', tk_theme_name); ?></p>
                                </div>
                            <?php } ?>
                                                      
                            <form method="GET" action="<?php echo get_permalink($reservation_id); ?>" name="room_form">
                                <div class="home-call-action right">
                                    <div class="red-action-room left"></div>
                                    <div class="home-call-action-select single-home-select single-room-width left">

                                            <div class="home-action-select single-action-select left">
                                                <input type="text/javascript" name="arrival_date" class="datepicker datepicker-home arrival" value="<?php _e('Arrival Date', tk_theme_name ); ?>"/>
                                            </div>

                                            <div class="home-action-select single-action-select last-select left">
                                                <input type="text/javascript" name="departure_date" class="datepicker datepicker-home departure" value="<?php _e('Departure Date', tk_theme_name); ?>"/>
                                            </div>

                                        <div class="home-action-shadow home-action-shadow-single left"></div>
                                    </div><!--/home-call-action-select-->
                                    <div class="home-call-action-buttom room-result-action room-result single-room-width right">
                                        <a class="search-rooms-single"><?php _e('Check Availability', tk_theme_name); ?></a>                                        
                                    </div><!--/home-call-action-buttom-->
                                   
                                   
                                </div><!--/home-call-action-->
                            </form>                          
                           
                        </div><!--/room-single-book-content-->
                        


                        <input type="hidden" value="<?php echo $post->ID ?>" class="hidden-id" />
                        

                            <script type="text/javascript">                                                
                            // ajax for querying available rooms                        
                            jQuery('.search-rooms-single').click(function(){                          
                                var arrival_date = jQuery('.arrival').val();
                                var departure_date = jQuery('.departure').val();
                                var get_room_id = jQuery('.hidden-id').val();

                                if(arrival_date !== 'Arrival Date' && departure_date !== 'Departure Date'){
                                jQuery.ajax({
                                    type:"POST",
                                    url: "<?php echo get_template_directory_uri(); ?>/ajax.php", // our PHP handler file
                                    context: document.body,
                                    data: { single_arrival_date: arrival_date, single_departure_date: departure_date, single_room_id: get_room_id},
                                    success:function(results){
                                        jQuery('.room-result').html(results);                                               
                                    } //success:function(results)
                                }); //jQuery.ajax
                                } //if(arrival_date && departure_date)
                            }); //jQuery('.datepicker, .guests').change(function()

                            </script>
                        <?php } ?>
                    
                         <?php if(!empty($external_link_text) && !empty($hide_reservations)){ ?>
                            <div class="room-single-book-content external-link-wrap left">
                                <div class="home-call-action right">
                                    <h6><a href="<?php echo $external_link; ?>"><?php echo $external_link_text; ?></a></h6>
                                     <div class="home-call-action-buttom room-link right"><a href="<?php echo $external_link; ?>" class="search-rooms"><?php _e('Book Now', tk_theme_name); ?></a></div><!--/home-call-action-buttom-->
                                </div><!--/home-call-action-->                                                              
                            </div><!--  room-single-book-content -->
                         <?php } ?>
                        
                            
                        

                        <div class="shortcodes left">
                            <?php
                                //The Loop
                                if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                                the_content();
                                endwhile; endif;
                            ?>
                            
                        </div><!--/room-single-text-->    
                        
                    </div><!--/room-single-->


                </div><!--/page-rooms-->

                    <!-- Sidebar -->
                    <?php                     
                                       
                    if($sidebar_postition == 'right'){
                        tk_get_sidebar('Right', $sidebar_select);
                    }elseif($sidebar_postition == 'left'){
                        tk_get_sidebar('Left', $sidebar_select);
                    }
                    ?>

            </div><!--/content-full-->
        </div><!--/wrapper-->
    </div><!--/content-->


    <script type="text/javascript">
    function submitform()
    {
      document.room_form.submit();
    }
    </script>

<?php get_footer(); ?>