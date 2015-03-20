<?php
/*---------------------------------------------------------------------------------*/
/* Ad widget */
/*---------------------------------------------------------------------------------*/
class App_Ad extends WP_Widget {

   function App_Ad() {
	   $widget_ops = array('description' => 'Advertising widget with big images' );
       parent::WP_Widget(false, __(tk_theme_name.' - Advertising Widget', tk_theme_name),$widget_ops);
   }

   function widget($args, $instance) {
       $tk = 'tk_';
       extract( $args );
       $unique_id = $args['widget_id'];
       $advert_select = $instance['advert-select'];
       $width_select = $instance['width-select'];
       $prefix = "tk_";
       
       
       if($args['id']== 'sidebar-1' || $args['id']== 'sidebar-2' || $args['id']== 'sidebar-3' || $args['id']== 'sidebar-4' ) {
           $footer_width = 'advert-footer-width';
       } else {
           $footer_width = '';
       }
       
        if($width_select == 'fullwidth') { 
            $fullwidth_class = 'fullwidth';
        } else {
            $fullwidth_class = '';
        }
        
     
        $custom_banner = get_post_meta($advert_select, $prefix.'custom_banner_code', true);
        
?>

<div class="advertisement-widget <?php echo $footer_width.' '.$fullwidth_class; ?>">
    <?php 
    
        if(!empty($custom_banner)) {
            tk_add_banner_view($advert_select);
            echo $custom_banner;
        } else {
            if (has_post_thumbnail($advert_select)){
                $advert_link = get_post_meta($advert_select, $tk.'advertisement_link', true);
                tk_add_banner_view($advert_select);
                
                if($width_select == 'fullwidth') { 
                           $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($advert_select), 'widget-advert' ); 
                        } else { 
                           $image_src = wp_get_attachment_image_src( get_post_thumbnail_id($advert_select), 'widget-advert-small' );
                       } 

                if($width_select == 'fullwidth') { ?>
                    <div class="fullwidth-banner left">
                        <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $advert_select; ?>">
                            <img src="<?php echo $image_src[0]; ?>"  />
                        </a>
                    </div><!-- halfwidth-banner -->
                <?php } else { ?>
                    
                    <div class="halfwidth-banner left"> 
                        <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $advert_select; ?>">
                            <img src="<?php echo $image_src[0]; ?>"  />
                        </a>
                      </div><!-- fullwidth-banner -->
                <?php } ?>
                        
            <?php 
        }}
    ?>
</div><!-- advertisiement-widget -->


<?php  ?>
<?php }

   function update($new_instance, $old_instance) {
       return $new_instance;
   }

   function form($instance) {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('my-upload');
        wp_enqueue_style('thickbox');

        if (isset($instance['width-select'])) {                 
            $width_select = esc_attr($instance['width-select']);
        } else {   
            $width_select ='';
        }            
        
        if (isset($instance['advert-select'])) {                 
            $advert_select = esc_attr($instance['advert-select']);
        } else {
            $advert_select = '';       
        }
          
       ?>



<!-- query of already saved advert posts -->
<div  class="widgets-advert-order">
        <select name="<?php echo $this->get_field_name('advert-select'); ?>" id="<?php echo $this->get_field_name('advert-select'); ?>">
            <?php
            $args=array('post_status' => 'publish', 'posts_per_page' => -1, 'post_type'=>'advertisement');

            //The Query
            query_posts($args);

            //The Loop
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <option <?php if($advert_select == get_the_ID()) { echo 'selected';} ?>   value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
            <?php endwhile; endif; ?>
        </select>

    
        <select name="<?php echo $this->get_field_name('width-select'); ?>" id="<?php echo $this->get_field_name('width-select'); ?>">
                <option <?php if($width_select == 'fullwidth') { echo 'selected';} ?> value="fullwidth"><?php _e('Fullwidth', tk_theme_name); ?></option>
                <option <?php if($width_select == 'halfwidth') { echo 'selected';} ?> value="halfwidth"><?php _e('Halfwidth', tk_theme_name); ?></option>       
        </select>   
    
</div><!-- widgets-advert-order -->

      <?php
    }
}
register_widget('App_Ad');?>