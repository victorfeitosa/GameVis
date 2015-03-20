<?php
/** Events block **/

if(!class_exists('AQ_Title_Block')) {
    class AQ_Title_Block extends AQ_Block {

        //set and create block
        function __construct() {
            $block_options = array(
                'name' => 'Title',
                'size' => 'col-sm-6',
            );

            //create the block
            parent::__construct('aq_title_block', $block_options);
        }

        function form($instance) {

            $defaults = array(
                'link_title' => '',
                'link_url' => '',
                'link_text' => '',
                'title_color' => '',
                'link_color' => ''
            );


            $instance = wp_parse_args($instance, $defaults);
            extract($instance);
            ?>

            <p class="description">
                <label for="<?php echo $this->get_field_id('link_title') ?>">
                    Title<br/>
                    <?php echo aq_field_input('link_title', $block_id, $link_title) ?>
                </label>
            </p>
            <p class="description">
                <label for="<?php echo $this->get_field_id('link_url') ?>">
                    Custom Link<br/>
                    <?php echo aq_field_input('link_url', $block_id, $link_url) ?>
                </label>
            </p>
            <p class="description">
                <label for="<?php echo $this->get_field_id('link_text') ?>">
                    Custom Link Text<br/>
                    <?php echo aq_field_input('link_text', $block_id, $link_text) ?>
                </label>
            </p>

            <div class="description ">
                <label for="<?php echo $this->get_field_id('title_color') ?>">
                    <?php _e('Pick a title color', 'tkingdom')?><br/>
                    <?php echo aq_field_color_picker('title_color', $block_id, $title_color, $defaults['title_color']) ?>
                </label>
            </div>

            <div class="description ">
                <label for="<?php echo $this->get_field_id('link_color') ?>">
                    <?php _e('Pick a link color', 'tkingdom')?><br/>
                    <?php echo aq_field_color_picker('link_color', $block_id, $link_color, $defaults['link_color']) ?>
                </label>
            </div>

        <?php

        }

        function block($instance) {
            extract($instance);

            if($title_color == '') { $title_color = "#222"; }
            if($link_color == '') { $link_color = "#222"; }

            ?>
            <div class="row margin-0">

                <style type="text/css">
                    <?php if(!empty($title_color)){ ?>
                        .<?php
                            echo $block_id ?> h2 {
                                color: <?php echo $title_color; ?>
                        }
                    <?php } ?>

                    <?php if(!empty($link_color)){ ?>
                        .<?php echo $block_id ?> a {
                            color: <?php echo $link_color; ?>
                        }
                    <?php } ?>
                </style>

                <?php if(!empty($link_title)){?>
                    <div class="title-holder <?php echo $block_id; ?>">
                        <h2 class="title-divider">
                             <?php echo $link_title?>
                             <?php if(!empty($link_text)){ ?><a href="<?php echo $link_url?>" class="pull-right"><?php echo $link_text?><i class="plas10"></i></a> <?php } ?>
                        </h2>
                    </div>
                <?php }?>
            </div>
        <?php
        }

    }
}