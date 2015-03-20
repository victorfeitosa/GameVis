<?php
/************************************************************/
/*                                                          */
/*   Add support for Featured Image option                  */
/*   add_image_size( '71-width-71-height', 71 , 71, true)   */
/*   add_image_size('300-width-unlimited-height', 300, 9999)*/
/*                                                          */
/************************************************************/
add_theme_support('post-thumbnails');
add_image_size( 'events', 770 , 398, true);
add_image_size( 'home-events', 770 , 398, true);
add_image_size( 'home-events-full', 1170 , 605, true);
add_image_size( 'gallery-images', 420 , 420, true);
add_image_size( 'team-member', 715 , 9999, true);
add_image_size( 'blog-gallery', 724 , 318, true);
?>