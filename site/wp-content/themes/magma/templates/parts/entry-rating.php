<?php
/*
 * RATING SYSTEM
 */
$i = 0;
$overal_rating = 0;
$check_rating = get_post_meta($post->ID, 'tk_enable_rating', true);
$check_user_rating = get_post_meta($post->ID, 'tk_reader_rating', true);
if ($check_rating == 'on') {
    $post_rating = get_post_meta($post->ID, 'tk_post_rating', true);
    $total_label = get_post_meta($post->ID, 'tk_rating_total', true);
    $post_rating_criteria = get_post_meta($post->ID, 'criteria-tk_post_rating', true);
    $post_rating_rate = get_post_meta($post->ID, 'rating-tk_post_rating', true);
    $i = 0;
    $overal_rating = 0;
    ?>
    <div class="single-review">

        

        <div class="block single-review-down">
            <?php foreach ($post_rating as $one_criteria) { ?>
                <strong>
                    <div class="rating-grey-bar stretchRight" style="width:<?php echo $post_rating_rate[$i]; ?>0%"></div>
                    <p><?php echo $post_rating_criteria[$i] ?></p>
                    <span><?php echo $post_rating_rate[$i]; ?></span>
                </strong><!--/single-rating-one-->  
            <?php 
            $overal_rating = $overal_rating + $post_rating_rate[$i];
            $i++;
            } ?>


            <?php
            if ($check_user_rating == 'on') {
                global $wpdb;
                $userip = $_SERVER['REMOTE_ADDR'];
                $tablename = $wpdb->prefix . "user_rating";
                $queryrate = $wpdb->get_row("SELECT AVG(userrate) as average, COUNT(*) as cnt FROM $tablename WHERE postid = '$id'");
                $queryip = $wpdb->get_row("SELECT * FROM $tablename WHERE postid = '$id' AND userip = '$userip'");
                $round = round($queryrate->average, 0);
                $vote_count = $queryrate->cnt;
                ?>
                <div class="single-rating-one left">
                    <div class="push-rating"></div>
                    <input type="hidden" class="old_rate" total="<?php echo $round ?>" ratenumber="<?php echo $vote_count ?>" />
                    <div class="stars-rater right">
                        <p class="single-user-rate"><?php _e('User Rating: ', 'tkingdom'); ?> (<?php echo $vote_count ?><?php _e(' votes)', 'tkingdom'); ?></p>
                        <?php
                        if ($queryip != null) {
                            tk_rating(10, 4, 'no', $round, 'custom-user-rating');
                        } else {
                            tk_rating(10, 4, 'yes', $round, 'custom-user-rating');
                        }
                        ?>
                        <p class="single-user-rate right-part"><?php echo $round ?></p>
                    </div><!--/stars-rater-->
                </div><!--/single-rating-one-->

            <?php } ?>
        </div><!--/single-review-down-->
        
        <div class="block single-review-top">
            <span><?php echo round($overal_rating / $i, 1); ?></span>
            <p><?php echo $total_label ?></p>
        </div><!--/single-rating-one-score-num-->

    </div><!--/single-review-->
<?php } ?>