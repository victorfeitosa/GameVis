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

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_page_sidebar');
if ( empty( $woocommerce_loop['columns'] ) )
    if ($sidebar_postition == 'fullwidth') {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 ); 
    } else {
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
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

 <?php if ( !empty( $product_gallery ) ) { ?>
        <div class="product-loop-thumb">
            <?php if ($product->is_on_sale()) : ?>

                    <?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'woocommerce' ).'</span>', $post, $product); ?>

            <?php endif; ?>
                <?php
                    $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tk_shop_catalog', true );	

                            $gallery = explode( ',', $product_gallery ); ?>

                                <div class="flexslider-part8">
                                    <figure class="flexslider flexslider-8">
                                        <ul class="slides">
                                            <?php if (has_post_thumbnail()) { echo '<li>'.get_the_post_thumbnail( $post->ID, 'tk_shop_catalog').'</li>';} ?>

                                            <?php
                                                foreach($gallery as $product_image_id) {
                                                    $image_src_hover_array = wp_get_attachment_image_src( $product_image_id, 'tk_shop_catalog', true );
                                                    echo '<li><img src="'.$image_src_hover_array[0].'" alt="shop_alt" title="shop_title"/></li>';
                                                }
                                            ?>
                                        </ul>
                                    </figure><!-- flex slider -->
                                </div>

     </div>
<?php }  else { ?>

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		} ?>

		<h3 class="tk-shop-title-link"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>