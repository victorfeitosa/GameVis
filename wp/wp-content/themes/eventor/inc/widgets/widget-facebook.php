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
           $fb_width = 180;
           $fb_height = 285;
       } else {
           $fb_width = 180;
           $fb_height = 285;
       }
       
       
        echo $before_widget; ?>

        <div class="facebook-widget">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $url; ?>&amp;width=<?php echo $fb_width; ?>&amp;height=<?php echo $fb_height; ?>&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $fb_width; ?>px; height:<?php echo $fb_height; ?>px;" allowTransparency="true"></iframe>
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