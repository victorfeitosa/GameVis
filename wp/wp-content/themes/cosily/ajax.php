<?php

require( '../../../wp-load.php' );

global $wpdb;

$prefix = 'tk_';
$reservations_page = get_option('id_reservations_page');

$currency_position = get_theme_option(tk_theme_name.'_reservations_currency_side');
$currency_sing = get_theme_option(tk_theme_name.'_reservations_currency');

if(!empty($_POST['single_room_id'])){
    $single_arrival_date = $_POST['single_arrival_date'];
    $single_departure_date = $_POST['single_departure_date'];
    $single_room_id = $_POST['single_room_id'];
    
    //conferting date to match the database 
    $single_arrival_date  = explode('/', $single_arrival_date);
    $single_departure_date  = explode('/', $single_departure_date);

    $single_arrival_date = $single_arrival_date['2'].'-'.$single_arrival_date['0'].'-'.$single_arrival_date['1'];
    $single_departure_date = $single_departure_date['2'].'-'.$single_departure_date['0'].'-'.$single_departure_date['1'];
    
    $single_room_search = $wpdb->get_results( "SELECT DISTINCT p.ID FROM ".$wpdb->prefix."posts p, ".$wpdb->prefix."cosily_rooms b WHERE  b.post_id = p.ID AND b.post_id = ".$single_room_id." AND post_type = 'rooms'
                                            AND
                                                 (('".$single_arrival_date."' BETWEEN b.arrival_date AND b.departure_date)
                                            OR
                                            ('".$single_departure_date."' BETWEEN b.arrival_date AND b.departure_date))");

    
    
    if(!empty($single_room_search)) {
        echo '<a class="search-rooms-single">'.__("Check Availability", tk_theme_name).'</a><p class="no-free-rooms red">Room is taken for that date. Please try another one.</p>';

    } else { ?>        
            <a href="<?php echo get_permalink($reservations_page); ?>?reservation_page=confirmation&arrival_date=<?php echo urlencode($single_arrival_date); ?>&departure_date=<?php echo urlencode($single_departure_date); ?>&room_id=<?php echo $single_room_id; ?>"><?php _e('Book Now', tk_theme_name); ?></a>
        
            <?php }
    
}


if(!empty($_POST['arrival_date'])) {

$arrival_date = $_POST['arrival_date'];
$departure_date = $_POST['departure_date'];
$guests = $_POST['guests'];

$check_screen = $_POST['check_screen'];
    
if(!empty($_POST['room_id'])){
    $tk_room_id = $_POST['room_id'];
}

$arrival_date  = explode('/', $arrival_date);
$departure_date  = explode('/', $departure_date);

//conferting date to match the database 
$arrival_date = $arrival_date['2'].'-'.$arrival_date['0'].'-'.$arrival_date['1'];
$departure_date = $departure_date['2'].'-'.$departure_date['0'].'-'.$departure_date['1'];
        
//gets all the taken rooms
$exclude_posts = $wpdb->get_results( "SELECT DISTINCT p.ID FROM ".$wpdb->prefix."posts p, ".$wpdb->prefix."cosily_rooms b WHERE p.ID = b.post_id  AND post_type = 'rooms'
                                            AND
                                                 (('".$departure_date."' BETWEEN b.arrival_date AND b.departure_date)
                                            OR
                                            ('".$arrival_date."' BETWEEN b.arrival_date AND b.departure_date))");

$exclude_id = '';
foreach($exclude_posts as $exclude_single) {
    $exclude_id .= $exclude_single->ID.', ';
}

if(empty($exclude_id)) {
    $exclude_id = '0';
}

//trims last comma
$exclude_id = rtrim($exclude_id, ', ');            

//gets all the taken rooms and takes them out of query
$get_search_result = $wpdb->get_results("SELECT DISTINCT * FROM " . $wpdb->prefix . "posts WHERE ID NOT IN ($exclude_id) AND post_type = 'rooms'");
                        $format = get_post_format();



        $i = 1;
        foreach($get_search_result as $single_room){
        $price_per_night = get_post_meta($single_room->ID, $prefix.'room_price_adult', true);
        $number_beds = get_post_meta($single_room->ID, $prefix.'number_beds', true);
        $post_thubmnail = get_the_post_thumbnail($single_room->ID, 'rooms');
        $room_policy = get_post_meta($single_room->ID, $prefix.'room_policy', true);        
        $room_description = get_post_meta($single_room->ID, $prefix.'room_description', true);     
        $format = get_post_format($single_room->ID);
        $video_link = get_post_meta($single_room -> ID, $prefix.'video_link', true);
        $slide_images = get_post_meta($single_room->ID, $prefix . 'repeatable', true);
        if($number_beds == $guests) {
    ?>
    
       <div class="content-tabs-room left">
            <div class="home-latest-news-one left">
                
                <?php if($format == 'gallery') { ?>
                    <div class="home-latest-news-one-image left">
                          <div style="width:auto; height: 173px; background-image:url(<?php tk_get_thumb(271, 173, $slide_images[0])?>)"></div>
                    </div>
                <?php } elseif($format == 'video') { ?>
                   <div class="home-latest-news-one-image left">
                        <?php get_video_image($video_link, $single_room -> ID); ?>
                   </div>
                <?php } else { ?>
                    <?php if(!empty($post_thubmnail)){ ?>
                        <div class="home-latest-news-one-image left">
                            <?php echo tk_get_thumb(271, 173, $post_thubmnail);?>
                        </div><!-- home-latest-news-one-image -->
                    <?php } //!empty($post_thubmnail) ?>
                <?php } ?>
                    
                <div class="home-latest-news-one-text-content <?php if(empty($post_thubmnail) && $format ==""){ echo 'fullwidth'; } ?> right">
                    <div class="room-tab-title left">
                        <span><?php echo $single_room->post_title; ?></span>
                    </div><!-- room-tab-title -->

                    <div class="room-only-content left">
                        
                        <div class="room-only-content-right left">
                            <span><?php if($currency_position=='left') { echo $currency_sing; }  echo $price_per_night;  if($currency_position=='right') { echo $currency_sing; } ?></span>
                            <p>/  <?php _e('Per Night', tk_theme_name); ?></p>
                            <a href="<?php echo get_permalink($reservations_page); ?>?reservation_page=confirmation&arrival_date=<?php echo urlencode($arrival_date); ?>&departure_date=<?php echo urlencode($departure_date); ?>&room_id=<?php echo $single_room->ID; ?>"><?php _e('Book Now', tk_theme_name); ?></a>
                        </div><!-- room-only-content-right -->
                        
                        <!-- shortened content -->
                            <?php 
                                if(!empty($room_description)){
                                    echo '<p>'.$room_description.'</p>';
                                }
                            ?>
                        
                    </div><!-- room-only-content -->

                    <div class="tab-text-down left"> 
                        <a target="_blank" href="<?php echo get_permalink($single_room -> ID); ?>"><?php _e('More about this room', tk_theme_name); ?></a>
                        <?php if(!empty($room_policy)){ ?>
                            <a class="fancybox" href="#text-room-fancy"><?php _e('Policies', tk_theme_name); ?></a>
                            <div id="text-room-fancy">
                                <p><?php echo $room_policy; ?></p>
                            </div><!-- text-room-fancy -->
                        <?php } ?>
                        
                    </div><!-- tabs-text-down -->
                    
                </div> <!-- home-latest-news-one-text-content -->
                                
            </div><!-- home-latest-news-one -->
           

        </div> <!-- content-tabs-room -->
        <?php         
                   $i++; } //$number_beds == $guests                   
            } // foreach($get_search_result as $single_room) 
            
            if($i == 1) {
                echo '<p class="no-free-rooms red">There are no rooms available.</p>';
            }
        } //!empty($arrival_date))
?>