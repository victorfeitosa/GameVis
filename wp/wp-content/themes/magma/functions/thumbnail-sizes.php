<?php
/************************************************************/
/*                                                          */
/*   Add support for Featured Image option                  */
/*   add_image_size( '71-width-71-height', 71 , 71, true)   */
/*   add_image_size('300-width-unlimited-height', 300, 9999)*/
/*                                                          */
/************************************************************/
add_theme_support('post-thumbnails');
add_image_size( 'slider', 474 , 474, true);
add_image_size( 'pb_gallery', 494 , 365, true);
add_image_size( 'pb_allposts', 982 , 9999);
add_image_size( 'pb_allpostssmall', 80, 60, true);
add_image_size( 'banner_wide', 468, 60, true);
add_image_size( 'blog-archive-one-col', 468, 9999);
add_image_size( 'widget-thumbnail', 68, 68, true);
add_image_size( 'full-width-image', 1140, 999999);
add_image_size( 'widget-advert', 250 , 250, true);
add_image_size( 'widget-advert-small', 125 , 125, true);
?>