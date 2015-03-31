<?php
/************************************************************/
/*                                                          */
/*   Add support for Featured Image option                  */
/*   add_image_size( '71-width-71-height', 71 , 71, true)   */
/*   add_image_size('300-width-unlimited-height', 300, 9999)*/
/*                                                          */
/************************************************************/
add_theme_support('post-thumbnails');
add_image_size( 'blog', 1300, 999999, true);
add_image_size( 'gallery-grid', 767, 999999, true);
add_image_size( 'related-posts', 345 , 199, true);
add_image_size( 'widget-advert', 250 , 250, true);
add_image_size( 'widget-advert-small', 125 , 125, true);

add_image_size( 'tk_shop_catalog', 312, 371, true);
add_image_size( 'tk_shop_thumbnail', 163, 187, true);
add_image_size( 'tk_shop_single', 500, 575, true);
?>