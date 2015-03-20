<?php
/* Aqua Tabs Block */
if(!class_exists('AQ_Testimonial_Block')) {
	class AQ_Testimonial_Block extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Testimonial',
				'size' => 'col-sm-12',
			);

			//create the widget
			parent::__construct('AQ_Testimonial_Block', $block_options);

			//add ajax functions
			add_action('wp_ajax_aq_block_testimonial_add_new', array($this, 'add_tab'));

		}

        function form($instance) {

            $defaults = array(
                'tabs' => array(
                    1 => array(
                        'title' => __('New Tab', 'tkingdom'),
                        'content' => '',
                        'name' => '',

                    )
                ),
                'type'	=> 'tab',
                 'text_color' => '',
                 'name_color' => '',
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
                <div class="clear"></div>
                <p></p>
                <a href="#" rel="testimonial" class="aq-sortable-add-new button"><?php _e('Add New', 'tkingdom')?></a>
                <p></p>
            </div>

            <div class="description ">
                <label for="<?php echo $this->get_field_id('text_color') ?>">
                    <?php _e('Pick a text color', 'tkingdom')?><br/>
                    <?php echo aq_field_color_picker('text_color', $block_id, $text_color, $defaults['text_color']) ?>
                </label>
            </div>

            <div class="description ">
                <label for="<?php echo $this->get_field_id('name_color') ?>">
                    <?php _e('Pick a color for name', 'tkingdom')?><br/>
                    <?php echo aq_field_color_picker('name_color', $block_id, $name_color, $defaults['name_color']) ?>
                </label>
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
                            <?php _e('User E-mail (used to show gravatar)', 'tkingdom')?><br/>
                            <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
                        </label>
                    </p>

                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-name">
                            <?php _e('Users Name', 'tkingdom')?><br/>
                            <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][name]" value="<?php echo $tab['name'] ?>" />
                        </label>
                    </p>

                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
                            <?php _e('Testimonial content', 'tkingdom')?><br/>
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
                                                          wp_enqueue_script('flexslider-7', get_template_directory_uri().'/script/flexslider/jquery.flexslider.js', false, false, true );

                                                      $tk_rand = rand(1,1000);
			$output = '';
                                                      $count = count($tabs);
                                                      $i = 1;
                                                   ?>

                                                   <style type="text/css">
                                                       <?php if(!empty($text_color)) { ?>
                                                          .<?php echo $block_id.$template_id;  ?>  .flexslider-part7  blockquote p {
                                                                color: <?php echo $text_color ?>;
                                                            }
                                                       <?php } ?>

                                                        <?php if(!empty($name_color)) { ?>
                                                          .<?php echo $block_id.$template_id;  ?>  .flexslider-part7  blockquote small {
                                                                color: <?php echo $name_color ?>;
                                                            }
                                                       <?php } ?>
                                                   </style>

                                                    <div class="row comment-full-width aq_block_testimonial_wrapper  <?php echo $block_id.$template_id; ?> margin-bottom-builder" id="aq_block_testimonial_wrapper<?php echo'_'.$tk_rand; ?>">
                                                            <div class="flexslider-part7">
                                                                <div class="flexslider flexslider-7">
                                                                    <ul class="slides">

                                                                        <?php foreach( $tabs as $tab ) {
                                                                            $open = $i == 1 ? 'open' : 'close';
                                                                            $i++; ?>
                                                                                <li>
                                                                                    <center><figure><?php echo get_avatar($tab['title'], $size = '79'); ?></figure></center>
                                                                                    <blockquote>
                                                                                            <?php echo wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))); ?>
                                                                                            <?php echo '<small>'.htmlspecialchars_decode($tab['name']).'</small>'; ?>
                                                                                    </blockquote>
                                                                                </li>

                                                                        <?php } ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                    </div><!-- comment-full-width -->

                                        <script>
                                            // Flexslider comments
                                            jQuery(document).ready(function(){
                                                var sliderWidth = jQuery('.flexslider-7').width();
                                                var itemWidthCalc = (sliderWidth);

                                                  jQuery('.flexslider-7').flexslider({
                                                      animation: "slide",
                                                      animationLoop: false,
                                                      itemWidth: itemWidthCalc,
                                                      controlNav: true,
                                                      directionNav: false,
                                                      slideshow: false,
                                                      move: 1,
                                                      smoothHeight: true,
                                                      minItems: 1
                                                  });
                                              });
                                        </script>


<?php

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
                                                                        'name' => '',
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