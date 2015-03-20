<?php
/** Notifications block **/

if(!class_exists('AQ_Buttons_Block')) {
	class AQ_Buttons_Block extends AQ_Block {

		//set and create block
		function __construct() {
			$block_options = array(
				'name' => __('Buttons', 'tkingdom'),
				'size' => 'col-sm-6',
			);

			//create the block
			parent::__construct('aq_buttons_block', $block_options);
		}

		function form($instance) {

			$defaults = array(
				'type' => '',
				'btnsize' => '',
				'newwindow' => '',
				'text' => 'Text',
                                                                        'btnalign' => '',
				'url' => '#'
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$type_options = array(
				'btn' => 'Gray',
				'btn-primary' => 'Blue',
				'btn-info' => 'Light Blue',
				'btn-success' => 'Green',
				'btn-warning' => 'Orange',
				'btn-danger' => 'Red',
				'btn-inverse' => 'Black'
			);

			$size_options = array(
				'btn' => 'Default',
				'btn-large' => 'Large',
				'btn-small' => 'Small',
				'btn-mini' => 'Mini'
			);

                                                    $button_align = array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right'
			);

			$newwindow_options = array(
				'' => 'Open In Same Window',
				'_blank' => 'Open In New Window'
		);

			?>
            <p class="description">
                <label for="<?php echo $this->get_field_id('type') ?>">
                    <?php _e('Button type', 'tkingdom')?><br/>
                    <?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
                </label>
            </p>

            <p class="description">
                <label for="<?php echo $this->get_field_id('btnalign') ?>">
                    <?php _e('Button align', 'tkingdom')?><br/>
                    <?php echo aq_field_select('btnalign', $block_id, $button_align, $btnalign) ?>
                </label>
            </p>

            <p class="description half">
                <label for="<?php echo $this->get_field_id('btnsize') ?>">
                    <?php _e('Button size', 'tkingdom')?><br/>
                    <?php echo aq_field_select('btnsize', $block_id, $size_options, $btnsize) ?>
                </label>
            </p>

            <p class="description half last">
                <label for="<?php echo $this->get_field_id('newwindow') ?>">
                    <?php _e('Open in new window', 'tkingdom')?><br/>
                    <?php echo aq_field_select('newwindow', $block_id, $newwindow_options, $newwindow) ?>
                </label>
            </p>

            <p class="description">
                    <label for="<?php echo $this->get_field_id('text') ?>">
                                                                <?php _e('Button text', 'tkingdom')?><br/>
                                                                <?php echo aq_field_input('text', $block_id, $text) ?>
                    </label>
            </p>

            <p class="description">
                    <label for="<?php echo $this->get_field_id('url') ?>">
                                                                <?php _e('Button link', 'tkingdom')?><br/>
                                                                <?php echo aq_field_input('url', $block_id, $url) ?>
                    </label>
            </p>
			<?php

		}

		function block($instance) {
			extract($instance);
                                                      $column_class = $first ? 'aq-first' : '';

			echo '<div class="row"><div class="col-sm-12" style="text-align:'.$btnalign.'"><a href="'.$url.'" class="btn '.$type.' '.$btnsize.' '.$column_class.'" target="'.$newwindow.'" type="button">'.$text.'</a></div></div>';
		}

	}
}