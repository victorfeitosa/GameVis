<?php
/* Advertisement Block
 *
 * Please see media block in cuvette
 */
if(!class_exists('AQ_Advertisement_Block')) {
	class AQ_Advertisement_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Advertisement',
				'size' => 'col-sm-12',
			);

			//create the block
			parent::__construct('aq_advertisement_block', $block_options);
		}

		function form($instance) {
			$defaults = array(
				'advertisement' => '',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			//Get all ads
			$args = array(
						'post_type'   => 'advertisement',
						'post_status' => 'publish'
			);

			$advertisement_posts = get_posts($args);

			if(!empty($advertisement_posts)){
				$advertisement_options = array();
				foreach($advertisement_posts as $row){
	   				$advertisement_options[$row->ID] = $row->post_title;
				}
			}
			else{
				$advertisement_options = array('none' => 'No published ads');
			}

		?>

			<p class="description">
                <label for="<?php echo $this->get_field_id('advertisement') ?>">
                    <?php _e('Choose which advertisement to display', 'tkingdom')?><br/>
                    <?php echo aq_field_select('advertisement', $block_id, $advertisement_options, $advertisement); ?>
                </label>
            </p>

        <?php


		}

		function block($instance) {
			extract($instance);

			$image = wp_get_attachment_image_src(get_post_thumbnail_id($advertisement), 'full');
			$post_title = get_the_title($advertisement);

			tk_add_banner_view($advertisement);

		?>

			<div class="baners">
	            <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $advertisement; ?>">
	                <img src="<?php echo $image[0]; ?>" alt="<?php echo $post_title ?>" title="<?php echo $post_title ?>" />
	            </a>
            </div>

		<?php

		}

	}
}
