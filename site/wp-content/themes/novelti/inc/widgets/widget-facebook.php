<?php
/*---------------------------------------------------------------------------------*/
/* Ad widget */
/*---------------------------------------------------------------------------------*/
class App_Facebook extends WP_Widget {

   function App_Facebook() {
	   $widget_ops = array('description' => 'Facebook, Add facebook box' );
       parent::WP_Widget(false, __(tk_theme_name.' - Facebook', tk_theme_name),$widget_ops);
   }

   function widget($args, $instance) {
        extract( $args );
        $unique_id = $args['widget_id'];
       $url = $instance['url'];
       if(empty($url)) {
           $url = 'http://www.facebook.com/platform';
       }       
       
       
       
       if($args['id'] == 'sidebar-1' || $args['id'] == 'sidebar-2' || $args['id'] == 'sidebar-3' ||  $args['id'] == 'sidebar-4'){

           $fb_width = 273;
           $border_color = "#363940";
           $fb_height = 300;
           $color_scheme = "dark";
       } else {
           $fb_width = 240;
           $fb_height = 325;
           $border_color = "#fff";
           $color_scheme = "light";
       }
       
       
        echo $before_widget; ?>

        <div class="facebook-widget">
            <div class="fb-like-box" data-href="<?php echo $url; ?>" data-height="<?php echo $fb_height; ?>" data-width="<?php echo $fb_width; ?>" data-border-color="<?php echo $border_color; ?>" data-show-faces="true" data-colorscheme="<?php echo $color_scheme; ?>" data-stream="false" data-header="false"></div>
        </div><!--  facebook widget-->
        <?php echo $after_widget; ?>
        <?php }

   function update($new_instance, $old_instance) {
       return $new_instance;
   }

   function form($instance) {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        wp_enqueue_style('thickbox');

        
            if (isset($instance['url'])) {
                $url = esc_attr($instance['url']);
            } else {
                $url = '';
            }


       ?>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Facebook link:', tk_theme_name); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('url'); ?>"  value="<?php echo $url; ?>" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" />
        </p>

      <?php
    }


}
register_widget('App_Facebook');
?>