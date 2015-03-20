<?php

/* DISPLAYING POSTS IN GALLERY GRID INFO PAGE TEMPLATE */

$category_filter = "";
$post_categories = wp_get_post_terms( $post->ID, 'ct_gallery' );
foreach($post_categories as $post_category){
    $category_filter[] = $post_category->slug;
}

if(!empty($category_filter)) { $category_filter = implode(' ', $category_filter); }

?>
<section class="gallery-item col-lg-3 col-md-4 col-sm-6 isotope-item <?php echo $category_filter; ?>">
    <figure class="img-wrapper">
      <?php
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'gallery-grid', true);
        $thumb_url = $thumb_url_array[0];
        if(!$thumb_id){
            $thumb_url = get_template_directory_uri().'/theme-images/no-image.jpg';
            if('gallery' == get_post_format()){
                $slide_images = get_post_meta($post->ID, 'tk_repeatable', true);
                if(!empty($slide_images[0])){
                  $thumb_url = $slide_images[0];
                }
            }
        }
      ?>
      <img src="<?php echo $thumb_url; ?>" />
    </figure>
    <div class="img-meta">
      <a href="<?php echo get_permalink(); ?>"><p><?php echo get_the_title(); ?></p></a>
      <div class="btn-wrapper">
        <?php
          $terms = wp_get_post_terms($post->ID, 'ct_gallery');
          foreach ($terms as $term) {
            echo '<span class="tag"> '.$term->name.'</span>';
          }
        ?>
        <!-- Likes -->
        <div class="likes pull-right">
            <?php $vote_count = get_post_meta($post->ID, "votes_count", true); $liked = ""; if ( tk_has_voted($post->ID) ) { $liked = 'class="liked" '; } ?>
            <a href="#" data-post_id="<?php echo $post->ID; ?>" <?php echo $liked ?>>
                <i class="icon-heart"></i>
                <i class="icon-heart-full"></i>
                <span class="like-counter"><?php if ($vote_count == '') { echo '0'; } else { echo $vote_count; }; ?></span>
            </a>
        </div>
      </div>
    </div>
</section>