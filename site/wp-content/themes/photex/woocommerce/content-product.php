<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_page_sidebar');

$sidebar_postition_single = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_single_sidebar');
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	if($sidebar_postition == 'fullwidth') {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}else{
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
	}

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<?php

if (is_single()) {

if($sidebar_postition_single == 'fullwidth') {
	$classes[] = 'col-lg-3 col-md-4 col-sm-6';
} else {
	$classes[] = 'col-md-4 col-sm-6';
} } else {

if($sidebar_postition == 'fullwidth') {
	$classes[] = 'col-lg-3 col-md-4 col-sm-6';
} else {
	$classes[] = 'col-md-4 col-sm-6';
} } ?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<h3><?php the_title(); ?></h3>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>