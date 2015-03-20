<?php
/** Team block **/

if(!class_exists('AQ_Slider_Block')) {
    class AQ_Slider_Block extends AQ_Block {

        //set and create block
        function __construct() {
            $block_options = array(
                'name' => 'Revolution Slider',
                'size' => 'col-sm-12',
            );

            //create the block
            parent::__construct('aq_slider_block', $block_options);
        }

        function form($instance) {

            $defaults = array(
                'slider_id' => '',
            );

            $instance = wp_parse_args($instance, $defaults);
            extract($instance);

            ?>

            <p class="description">
                <label for="<?php echo $this->get_field_id('slider_id') ?>">
                    Insert alias or ID if Revolution Slider selected<br/>
                    <?php echo aq_field_input('slider_id', $block_id, $slider_id) ?>
                </label>
            </p>
        <?php

        }

        function block($instance) {
            extract($instance);?>
                    <div class="full-width">
                        <div class="demo-2">
                            <?php
                            if (function_exists('putRevSlider')) {
                                putRevSlider($slider_id);
                            }
                            ?>
                        </div>
                    </div>

        <?php
        }

    }
} ?>