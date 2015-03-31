<?php
/*         * *****STICKY POST****** */
global $prefix, $check_rating, $category_color, $post_id, $post, $wpdb;
$check_user_rating = get_post_meta($post->ID, $prefix . 'reader_rating', true);
if($check_rating == 'on'){
    $rating_type = get_post_meta($post->ID, $prefix.'rating_type', true);
    $post_rate = get_post_meta($post->ID, 'rating-'.$prefix.'post_rating', true);
    $average_rate = array_sum($post_rate) / count($post_rate);
    if($rating_type == 'Stars'){
    ?>
    <div class="stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
        <?php tk_rating(20, 4, 'no', round($average_rate), 'post-'.$post->ID.$post_id);?>
    </div><!--/stars-rater-->
    <?php }else{?>
    <div class="home-photoghy-num-content stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
        <span style="padding:4px 5px 4px 0"><?php _e('rating ', tk_theme_name);?></span>
        <span style="padding:4px 0px 4px 0"><?php echo round($average_rate);?></span>
    </div>
    <?php }?>
<?php }elseif($check_user_rating == 'on'){
    $rating_type = get_post_meta($post->ID, $prefix.'rating_type', true);
    $tablename = $wpdb->prefix . "user_rating";
    $queryrate = $wpdb->get_row("SELECT AVG(userrate) as average, COUNT(*) as cnt FROM $tablename WHERE postid = '$post->ID'");
    $round = round($queryrate->average, 0);
    if($rating_type == 'Stars'){
    ?>
    <div class="stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
        <?php tk_rating(20, 4, 'no', $round, 'post-'.$post->ID.$post_id);?>
    </div><!--/stars-rater-->
    <?php }else{?>
    <div class="home-photoghy-num-content stars-rater left" style="background-color: #<?php echo $category_color['color'] ?>">
        <span style="padding:4px 5px 4px 0"><?php _e('rating ', tk_theme_name);?></span>
        <span style="padding:4px 0px 4px 0"><?php echo $round;?></span>
    </div>
    <?php }?>
    
<?php } // check if is only user rating selected?>
    
<div class="clear"></div>