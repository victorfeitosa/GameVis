<?php
/*---------------------------------------------------------------------------------*/
/* Advert widget */
/*---------------------------------------------------------------------------------*/
class App_Advert extends WP_Widget {

   function App_Advert() {
	   $widget_ops = array('description' => 'This widget will load images from Advertising page.' );
       parent::WP_Widget(false, __(tk_theme_name.' - Advertising widget', tk_theme_name),$widget_ops);
   }

   function widget($args, $instance) {
    extract( $args );
	   $title = $instance['title'];
		$unique_id = $args['widget_id'];?>

		<?php echo $before_widget; ?>
		<?php if ($title) { echo $before_title . $title . $after_title; } ?>

        

                         <div class="advertising_widgets left">

                             <?php 
                                 global $wpdb;
                                $adverts = $wpdb->get_results( "SELECT * FROM  " .$wpdb->prefix. "advertising WHERE 1" );
                                foreach($adverts as $advert) {
                                                            
                             ?>

                            <div class="advertising_images left"><a target="_blank" href="<?php echo $advert->link ?>"><img src="<?php echo $advert->imagelink ?>"  /></a></div>
                            <?php } ?>
                        </div>

                        <?php echo $after_widget; ?>

	<?php
   }

   function update($new_instance, $old_instance) {
       return $new_instance;
   }

   function form($instance) {

       if(isset($instance['title']))
          $title = esc_attr($instance['title']);


       ?>
       <p>
	   	 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',tk_theme_name); ?></label>
	       <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
       </p>

      <?php
   }

}
register_widget('App_Advert');
?>