<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' );
$sidebar_position = get_theme_option(wp_get_theme()->name . '_woocommerce_woo_single_sidebar');
$position_left = get_theme_option(wp_get_theme()->name . '_general_content_alignment');
?>

<div id="main-wrapper">
    <div class="container <?php if($position_left == 'yes'){ echo 'left-aligned'; } ?>">
        <div class="row">
            <div class="shortcodes <?php if($sidebar_position == 'fullwidth'){echo 'col-md-12';}elseif($sidebar_position == 'left'){echo 'col-md-9 pull-right';}else{echo 'col-md-9';}?>">


	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

            </div>
            <?php if($sidebar_position != 'fullwidth'){?>
                <!-- Sidebar Left -->
                <?php

                if ($sidebar_position == 'left'){
                    echo '<div class="col-md-3 pull-left" id="sidebar" style="margin-left:0px;"><div class="sidebar-content">';
                    tk_get_sidebar('Left', 'Woocommerce Single');
                    echo '</div></div>';
                }
                ?>
                <!-- Sidebar Right -->
                <?php
                if ($sidebar_position == 'right'){
                    echo '<div class="col-md-3 pull-right" id="sidebar" ><div class="sidebar-content">';
                    tk_get_sidebar('Right', 'Woocommerce Single');
                    echo '</div></div>';
                }
                ?>
                <!--/sidebar-->
             <?php } ?> 
        </div>
    </div>
</div>
<?php get_footer( 'shop' ); ?>