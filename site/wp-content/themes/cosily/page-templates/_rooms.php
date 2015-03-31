<?php 
/*

Template Name: Rooms

*/
get_header();
$prefix = 'tk_';
$sidebar_postition = get_post_meta($post->ID, $prefix.'sidebar_position', true);

$currency_sing = get_theme_option(tk_theme_name.'_reservations_currency');
$currency_position = get_theme_option(tk_theme_name.'_reservations_currency_side');

if($sidebar_postition == ''){$sidebar_postition = 'right';}
$sidebar_select = get_post_meta($post->ID, $prefix.'sidebar', true);
?>

<?php
/*--Page Headline--*/
$title_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full');
$page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
$heading_background = get_post_meta($post->ID, $prefix.'background_color', true);
$heading_title_color = get_post_meta($post->ID, $prefix.'headline_color', true);
 ?>

        <!-- Page Headline -->
        <div class="title-pages left">
                <div class="title-pages-image left" style="<?php if(has_post_thumbnail()){echo 'background:url('.$title_bg_image[0].')';} else { echo 'background:#'.$heading_background; } ?>"></div>
                <div class="wrapper">
                    <span style="<?php echo 'color:#'.$heading_title_color; ?>"><?php the_title()?></span>
                    <?php
                    $page_headline = get_post_meta($post->ID, $prefix . 'headline', true);
                    if ($page_headline !== "") { ?>
                    <p style="<?php echo 'color:#'.$heading_title_color; ?>"><?php echo $page_headline ?></p>
                    <?php } /*-- /page headline --*/?>
                </div>
        </div><!--/title-pages-->
        <div class="bottom-slider-red"></div><!--/bottom-slider-red-->



    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">
            <div class="content-full left">


                <div class="page-rooms <?php if($sidebar_postition == 'right'){echo 'left';}elseif($sidebar_postition == 'left'){echo 'right';}elseif($sidebar_postition == 'fullwidth'){echo 'no-sidebar';}?>">

                    <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args = array('post_status' => 'publish', 'post_type' => 'rooms', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'));
                        
                        // The Query
                        query_posts ($args);
                        // The Loop
                        if (have_posts()): while (have_posts()) : the_post();           
                        $format = get_post_format();
                        $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');          
                        $video_link = get_post_meta($post -> ID, $prefix.'video_link', true);
                        $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                        $price_per_night = get_post_meta($post->ID, $prefix.'room_price_adult', true);
                    ?>
                    <div class="page-rooms-one <?php if( $format =="" && !has_post_thumbnail()) {?>page-rooms-one-no-image<?php } ?> left">
                        <?php if(has_post_thumbnail() || $format == "video" || $format =="gallery"){ ?>
                            <div class="page-rooms-one-image left">                                
                                <?php if(!empty($price_per_night)){ ?>
                                    <div class="room-night left">
                                        <h5><?php _e('From', tk_theme_name); ?> <?php if($currency_position=='left') { echo $currency_sing; }  echo $price_per_night;  if($currency_position=='right') { echo $currency_sing; } ?></h5>
                                        <h6><?php _e('/ Per Night', tk_theme_name); ?></h6>
                                    </div>
                                <?php } ?>
                                
                                
                                <?php if ($format == '') { ?>
                                <a href="<?php echo $image_full[0] ?>" class="fancybox">                               
                                    <?php the_post_thumbnail('rooms'); ?>                                
                                    <div class="horisontal-images-hover">
                                        <p></p>
                                    </div>
                                </a>    
                                
                                <?php } elseif ($format =='video') { ?>
                                <a href="<?php echo $video_link?>" class="fancybox <?php if(strpos($video_link, 'youtube')){echo 'youtube';}elseif(strpos($video_link, 'vimeo')){echo 'vimeo';}?>">
                                    <?php get_video_image($video_link, $post -> id); ?>
                                    <div class="horisontal-images-hover video">
                                        <p></p>
                                    </div>
                                </a> 
                                
                                <?php } elseif ($format =='gallery') { ?>
                                    <?php 
                                    $random_name = generateRandomString();
                                    
                                    if(!empty($slide_images)) { ?>
                                        <?php foreach(array_slice($slide_images, 1) as $the_image) {    ?>
                                            <a href="<?php echo $the_image?>" class="fancybox" rel="<?php echo $random_name ?>" style="display:none"></a>
                                        <?php } ?>
                                    <?php } ?>
                                <a href="<?php echo $slide_images[0]; ?>" class="fancybox" rel="<?php echo $random_name ?>">
                                    <img  src="<?php tk_get_thumb(271, 173, $slide_images[0])?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                    <div class="horisontal-images-hover gallery">
                                        <p></p>
                                    </div>
                                </a> 
                                <?php } ?>
                                
                                
                            </div><!--/page-rooms-one-image-->
                        <?php } ?>
                        <div class="page-rooms-one-text <?php if(!has_post_thumbnail()){ ?>room-fullwidth<?php } ?> right">
                            <span><a class="room-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                            <?php if( $format =="" && !has_post_thumbnail() && !empty($price_per_night)){ ?>                            
                                <div class="room-night left">
                                    <h5>From  $<?php echo $price_per_night; ?></h5>
                                    <h6>/ Per Night</h6>
                                </div>                            
                        <?php } ?>
                            
                            
                            <?php the_excerpt(); ?>
                            <a class="details" href="<?php the_permalink(); ?>"><?php _e('Details', tk_theme_name); ?></a>
                        </div><!--/page-rooms-one-text-->
                    </div><!--/page-rooms-one-->
                    
                    
                    <div class="about-border left"></div><!--/about-border-->

                    <?php endwhile; endif; ?>
                    
                    
                    
                    <!--PAGINATION-->
                    <div class="pagination right">
                            <?php
                                global $wp_query;

                                $big = 999999999; // need an unlikely integer

                                $pageing =  paginate_links( array(
                                        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                        'format' => '?paged=%#%',
                                        'current' => max( 1, get_query_var('paged') ),
                                        'total' => $wp_query->max_num_pages
                                ) );
                                echo $pageing;
                            ?>
                    </div><!--/pagination-->


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

    
    
    
    <?php get_footer(); ?>