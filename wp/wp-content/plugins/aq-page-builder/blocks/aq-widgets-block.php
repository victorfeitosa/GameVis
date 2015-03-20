<?php
/* Registered Sidebars Blocks */
class AQ_Widgets_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'Widgets',
			'size' => 'col-sm-4',
		);

		parent::__construct('AQ_Widgets_Block', $block_options);
	}

	function form($instance) {


		//get all registered sidebars
		global $wp_registered_sidebars;
		$sidebar_options = array(); $default_sidebar = '';
		foreach ($wp_registered_sidebars as $registered_sidebar) {
			$default_sidebar = empty($default_sidebar) ? $registered_sidebar['id'] : $default_sidebar;
			$sidebar_options[$registered_sidebar['id']] = $registered_sidebar['name'];
		}

		$defaults = array(
			'sidebar' => $default_sidebar,
                                                      'title_color' => '',
                                                      'title' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		?>
		<p class="description half">
			<label for="<?php echo $block_id ?>_title">
				Title (optional)<br/>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description half last">
			<label for="">
				Choose widget area<br/>
				<?php echo aq_field_select('sidebar', $block_id, $sidebar_options, $sidebar); ?>
			</label>
		</p>
                                    <div class="description ">
                                        <label for="<?php echo $this->get_field_id('title_color') ?>">
                                            <?php _e('Pick a title color', 'tkingdom')?><br/>
                                            <?php echo aq_field_color_picker('title_color', $block_id, $title_color, $defaults['title_color']) ?>
                                        </label>
                                    </div>

		<?php
	}

	function block($instance) {
		extract($instance);

                if(!empty($title_color)){
                echo '<style type="text/css">
                            .'.$block_id.' {
                                color: '.$title_color.'
                            }
                        </style>';
                }

        echo '<div id="sidebar"><div class="sidebar-content">';
        if($title){  echo '<block class="'.$block_id.'"><h3>'.htmlspecialchars_decode($title).'</h3></block>'; }
            dynamic_sidebar($sidebar);
        echo '</div></div>';
	}

}