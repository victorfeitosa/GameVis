<?php
/** A simple text block **/
class AQ_Text_Block extends AQ_Block {

	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Heading / Text',
			'size' => 'col-sm-6',
		);

		//create the block
		parent::__construct('aq_text_block', $block_options);
	}

	function form($instance) {

		$defaults = array(
                                                    'text' => '',
                                                    'title' => '',
                                                    'heading' => '',
                                                    'type' => '',
                                                    'heading_color' => '',
                                                    'text_color' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);


                                    $type_options = array(
                                            'h1' => 'Heading 1',
                                            'h2' => 'Heading 2',
                                            'h3' => 'Heading 3',
                                            'h4' => 'Heading 4',
                                            'h5' => 'Heading 5',
                                            'h6' => 'Heading 6'
                                    );

                                    $align_options = array(
                                            'left' => 'Left',
                                            'center' => 'Center',
                                            'right' => 'Right',
                                    );


		?>

                                    <p class="description">
                                        <label for="<?php echo $this->get_field_id('title') ?>">
                                            Title<br/>
                                            <?php echo aq_field_input('title', $block_id, $title) ?>
                                        </label>
                                    </p>

                                    <p class="description">
                                        <label for="<?php echo $this->get_field_id('heading_type') ?>">
                                            <?php _e('Heading type', 'tkingdom')?><br/>
                                            <?php echo aq_field_select('heading', $block_id, $type_options, $heading); ?>
                                        </label>
                                    </p>

		<p class="description">
                                        <label for="<?php echo $this->get_field_id('text') ?>">
                                            Content
                                             <?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
                                        </label>
		</p>

                                    <p class="description">
                                        <label for="<?php echo $this->get_field_id('align_type') ?>">
                                            <?php _e('Alignment options', 'tkingdom')?><br/>
                                            <?php echo aq_field_select('type', $block_id, $align_options, $type) ?>
                                        </label>
                                    </p>

                                    <div class="description ">
                                        <label for="<?php echo $this->get_field_id('border_color') ?>">
                                            <?php _e('Heading Color', 'tkingdom')?><br/>
                                            <?php echo aq_field_color_picker('heading_color', $block_id, $heading_color, $defaults['heading_color']) ?>
                                        </label>
                                    </div>

                                    <div class="description ">
                                        <label for="<?php echo $this->get_field_id('border_color') ?>">
                                            <?php _e('Text Color', 'tkingdom')?><br/>
                                            <?php echo aq_field_color_picker('text_color', $block_id, $text_color, $defaults['text_color']) ?>
                                        </label>
                                    </div>

		<?php
	}

	function block($instance) {
		extract($instance);


                                    echo '<style>
                                    .'.$block_id.$template_id.' '.$heading.' {
                                        color: '.$heading_color.';
                                    }
                                    .'.$block_id.$template_id.' p {
                                         color: '.$text_color.';
                                    }
                                    </style>';

                                    echo '<div class="'.$block_id.$template_id.'" style="text-align:'.$type.'">';
		if($title) echo '<'.$heading.' class="aq-block-title '.$block_id.$template_id.'" style="color: '.$heading_color.'">'.do_shortcode(htmlspecialchars_decode($title)).'</'.$heading.'>';
		echo wpautop(do_shortcode(htmlspecialchars_decode($text))).'</div>';
	}

}