<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Accordion_Block')) {
	class AQ_Accordion_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Accordion',
				'size' => 'col-sm-6',
			);

			//create the widget
			parent::__construct('AQ_Accordion_Block', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));

		}

        function form($instance) {

            $defaults = array(
                'tabs' => array(
                    1 => array(
                        'title' => __('New Tab', 'tkingdom'),
                        'content' => '',
                    )
                ),
                'type'	=> 'tab',
                'bg_color'	=> '',
                'text_color'	=> '',
                'border_color'	=> '#e1e1e1',
                'tab_opacity'	=> '',
                'heading_color'	=> '',
            );

            $instance = wp_parse_args($instance, $defaults);
            extract($instance);



            ?>
            <div class="description cf">
                <ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
                    <?php
                    $tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
                    $count = 1;
                    foreach($tabs as $tab) {
                        $this->tab($tab, $count);
                        $count++;
                    }
                    ?>
                </ul>
                <div class="description ">
                    <label for="<?php echo $this->get_field_id('bg_color') ?>">
                        <?php _e('Pick a background color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('bg_color', $block_id, $bg_color, $defaults['bg_color']) ?>
                    </label>
                </div>

                <div class="description ">
                    <label for="<?php echo $this->get_field_id('border_color') ?>">
                        <?php _e('Pick a heading color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('heading_color', $block_id, $heading_color, $defaults['heading_color']) ?>
                    </label>
                </div>

                <div class="description ">
                    <label for="<?php echo $this->get_field_id('text_color') ?>">
                        <?php _e('Pick a text color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('text_color', $block_id, $text_color, $defaults['text_color']) ?>
                    </label>

                </div>
                <div class="description ">
                    <label for="<?php echo $this->get_field_id('border_color') ?>">
                        <?php _e('Pick a border color', 'tkingdom')?><br/>
                        <?php echo aq_field_color_picker('border_color', $block_id, $border_color, $defaults['border_color']) ?>
                    </label>
                </div>
                <div class="description ">
                    <label for="<?php echo $this->get_field_id('tab_opacity') ?>">
                        <?php _e('Opacity', 'tkingdom')?><br/>
                        <?php echo aq_field_input('tab_opacity', $block_id, $tab_opacity, 'mini', 'text') ?> % (0 - 100)
                    </label>
                </div>
                <div class="clear"></div>
                <p></p>
                <a href="#" rel="tab" class="aq-sortable-add-new button"><?php _e('Add New', 'tkingdom')?></a>
                <p></p>
            </div>

        <?php
        }

        function tab($tab = array(), $count = 0) {

            ?>
            <li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">

                <div class="sortable-head cf">
                    <div class="sortable-title">
                        <strong><?php echo $tab['title'] ?></strong>
                    </div>
                    <div class="sortable-handle">
                        <a href="#"><?php _e('Open / Close', 'tkingdom')?></a>
                    </div>
                </div>
                <div class="sortable-body">
                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
                            <?php _e('Tab Title', 'tkingdom')?><br/>
                            <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
                        </label>
                    </p>
                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
                            <?php _e('Tab Content', 'tkingdom')?><br/>
                            <textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $tab['content'] ?></textarea>
                        </label>
                    </p>
                    <p class="tab-desc description"><a href="#" class="sortable-delete"><?php _e('Delete', 'tkingdom')?></a></p>
                </div>

            </li>
        <?php
        }

		function block($instance) {
			extract($instance);

			wp_enqueue_script('jquery-ui-tabs');
            if($border_color == ''){$border_color = 'none';}else{$border_color = '1px solid '.$border_color;}

            if($bg_color == '') {$bg_color = "#fff";}
            $bg_color_rgb = tk_hex2rgb($bg_color);
            if($tab_opacity == '') { $tab_opacity = 100; }


            $tk_tab_opacity = $tab_opacity/100;
            $tk_rand = rand(1,1000);

			$output = '';

				$count = count($tabs);
				$i = 1;

				$output .= '<div id="aq_block_accordion_wrapper_'.$tk_rand.'" class="aq_block_accordion_wrapper margin-bottom-builder">';

				foreach( $tabs as $tab ){

					$open = $i == 1 ? 'open' : '';

					$child = '';
					if($i == 1) $child = 'first-child';
					if($i == $count) $child = 'last-child';
					$i++;

					$output  .= '
					<style>
                        #aq_block_accordion_wrapper_'.$tk_rand.' .aq_block_accordion .tab-head {border-bottom:'.$border_color.';}
                            .aq_block_accordion .tab-body {border-bottom:'.$border_color.';}
					</style>
					<div class="aq_block_accordion '.$child.'" style="background:rgba('.$bg_color_rgb[0].','.$bg_color_rgb[1].','.$bg_color_rgb[2].','.$tk_tab_opacity.');color:'.$text_color.';">';

						$output .= '<h5 class="tab-head" style="color: '.$heading_color.'">'. do_shortcode(htmlspecialchars_decode($tab['title'])) .'</h5>';
						$output .= '<i class="icon-arrow-down"></i>';
						$output .= '<div class="tab-body '.$open.' cf">';
							$output .= '<p style="color:'.$text_color.';">'.do_shortcode(htmlspecialchars_decode($tab['content'])).'</p>';
						$output .= '</div>';
					$output .= '</div>';
				}

				$output .= '</div>';

			echo $output;

		}

		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');

			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			//default key/value for the tab
			$tab = array(
                                                            'title' => __('New Tab', 'tkingdom'),
                                                            'content' => ''
			);

			if($count) {
				$this->tab($tab, $count);
			} else {
				die(-1);
			}

			die();
		}

		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
