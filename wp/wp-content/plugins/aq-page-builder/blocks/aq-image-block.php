<?php
/** Image / Video block **/

if(!class_exists('AQ_Image_Block')) {
    class AQ_Image_Block extends AQ_Block {

        //set and create block
        function __construct() {
            $block_options = array(
                'name' => 'Image / Video',
                'size' => 'col-sm-6',
            );

            //create the block
            parent::__construct('aq_image_block', $block_options);
        }

        function form($instance) {

            $defaults = array(
                'link_title' => '',
                'link_url' => '',
                'link_text' => '#'
            );

            $instance = wp_parse_args($instance, $defaults);
            extract($instance);
            ?>

            <p class="description">
                <label for="<?php echo $this->get_field_id('link_url') ?>">
                    Image or Video URL<br/>
                    <?php echo aq_field_input('link_url', $block_id, $link_url) ?>
                </label>
            </p>
            <p class="description">
                <label for="<?php echo $this->get_field_id('link_text') ?>">
                    Image URL<br/>
                    <?php echo aq_field_input('link_text', $block_id, $link_text) ?>
                </label>
            </p>
        <?php

        }

        function block($instance) {
            extract($instance);
            $key_str1 = 'youtube';
            $key_str2 = 'vimeo';

            $pos_youtube = strpos($link_url, $key_str1);
            $pos_vimeo = strpos($link_url, $key_str2);
            if (!empty($pos_youtube) || !empty($pos_vimeo)) {?>
                <div class="margin-bottom-builder">
                    <?php tk_video_player($link_url);?>
                </div>
            <?php }else{?>
                <div class="margin-bottom-25">

                   <?php  if(!empty($link_text)){ ?>
                    <a href="<?php echo $link_text?>">
                        <img src="<?php echo $link_url?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="aligncenter"/>
                    </a>
                   <?php }else { ?>
                       <img src="<?php echo $link_url?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="aligncenter"/>
                   <?php } ?>

                </div>
            <?php }?>
        <?php
        }

    }
}