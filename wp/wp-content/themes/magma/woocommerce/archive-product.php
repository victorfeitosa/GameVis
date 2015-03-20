<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop');
$sidebar_postition = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_page_sidebar');
$slider_type = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_page_slider');
$title_bg_image = get_option(wp_get_theme()->name . '_woocommerce_shop_banner_image');
?>

    <?php if($slider_type == 'revolution' || $slider_type == 'slit') { ?>
        <?php get_template_part('/templates/parts/header', 'slider'); ?>
    <?php } //check if slider is turned on?>




    <div class="block bg-content">
        <div class="container">
        	<div class="row">
            <div class="white-bg">
            	<div class="content-with-sidebar shortcodes <?php if($sidebar_postition == 'fullwidth'){echo 'col-xs-12';}elseif($sidebar_postition == 'left'){echo 'col-xs-8 pull-right';}else{echo 'col-xs-8';}?>">

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="title-divider"><span><?php woocommerce_page_title(); ?></span></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>

                </div>
                <?php if($sidebar_postition != 'fullwidth'){?>
                                <!-- Sidebar Left -->
                                <?php

                                if ($sidebar_postition == 'left'){
                                    echo '<div class="col-xs-4 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                                    tk_get_sidebar('Left', 'Woocommerce Shop');
                                    echo '</div></div>';
                                }
                                ?>
                                <!-- Sidebar Right -->
                                <?php
                                if ($sidebar_postition == 'right'){
                                    echo '<div class="col-xs-4 pull-right" id="sidebar" ><div class="sidebar-content">';
                                    tk_get_sidebar('Right', 'Woocommerce Shop');
                                    echo '</div></div>';
                                }
                                ?>
                                <!--/sidebar-->
                <?php } ?>
            </div>
        </div>
        </div>
</div>
<?php get_footer('shop'); ?>