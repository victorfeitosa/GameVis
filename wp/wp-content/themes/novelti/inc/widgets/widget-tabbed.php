<?php
/*---------------------------------------------------------------------------------*/
/* Ad widget */
/*---------------------------------------------------------------------------------*/
class App_tabbed extends WP_Widget {

   function App_tabbed() {
	   $widget_ops = array('description' => 'Widget with three tabs, Recent posts, Popular posts and Tags or Categories' );
       parent::WP_Widget(false, __(tk_theme_name.' - Tabbed Widgets', tk_theme_name),$widget_ops);
   }

   function widget($args, $instance) {
        extract( $args );
       $unique_id = $args['widget_id'];
       $popularPosts = $instance['populars-number'];
       $recentsPosts = $instance['recents-number'];
       $taxonomySelect = $instance['taxonomy-select'];
       $prefix = 'tk_';
       
       echo $before_widget;

?>

                    <div id="tabs-sidebar" class="widget-tabs">
                        <ul>
                            <li><a href="#tabs-1"><?php _e('Popular', tk_theme_name); ?></a></li>
                            <li><a href="#tabs-2"><?php _e('Recent', tk_theme_name); ?></a></li>
                            <li><a href="#tabs-3"><?php if($taxonomySelect == 'categories') { ?><?php _e('Categories', tk_theme_name); } else { _e('Tags', tk_theme_name); } ?></a></li>
                        </ul>
                        <div id="tabs-1">
                            <div class="sidebar_widget_holder">
                                

                                <?php 
                                    global $post;
                                    $args=array('post_status' => 'publish',  'meta_key'=>'post_views_count', 'orderby' => 'meta_value_num' , 'order' =>'DESC', 'ignore_sticky_posts' => 1, 'posts_per_page' => $popularPosts);

                                    //The Query
                                    query_posts($args);

                                    //The Loop
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();                                    
                                    $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                    $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                ?>
                                
                                <div class="app_recent_post">
                                    <?php if(has_post_thumbnail()){
                                        $fullwidth = ''; ?>
                                        <div class="app_recent_img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('widget-posts'); ?></a></div><!--/app_recent_img-->
                                    <?php } elseif(!empty($video_link)) { $fullwidth = '';  ?>
                                        
                                        <div class="app_recent_img">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo get_video_image($video_link, $post->ID); ?>
                                            </a>
                                        </div>
                                        
                                    <?php
                                        
                                    } elseif(count($slide_images) > 1){
                                           $fullwidth = ''; ?>
                                            <div class="app_recent_img">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo tk_get_thumb(50, 50, $slide_images[0]);  ?>" alt="<?php the_title(); ?>"/>
                                                </a>
                                            </div>
                                        <?php
                                    } else {
                                        $fullwidth = 'app_recent_box_fullwidth';
                                    } ?>
                                    
                                    <div class="app_recent_box <?php echo $fullwidth;  ?>">
                                        <div class="app_recent_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div><!--/app_recent_cont-->
                                        <div class="app_recent_date"><span><?php echo getPostViews(get_the_ID()); ?></span></div><!--/app_recent_date-->
                                    </div><!--/app_recent_box-->
                                </div><!--/app_recent_post-->
                                <?php endwhile; endif; ?>


                            </div><!--/sidebar_widget_holder-->
                        </div>
                        
                        <div id="tabs-2">
                            <div class="sidebar_widget_holder">
                                

                                <?php 
                                    $args=array('post_status' => 'publish', 'ignore_sticky_posts' => 1, 'posts_per_page' => $recentsPosts);

                                    //The Query
                                    query_posts($args);

                                    //The Loop
                                    if ( have_posts() ) : while ( have_posts() ) : the_post();                       
                                    $video_link = get_post_meta($post->ID, $prefix . 'video_link', true);
                                    $slide_images = get_post_meta($post->ID, $prefix . 'repeatable', true);
                                ?>
                                
                                <div class="app_recent_post">
                                    <?php if(has_post_thumbnail()){ 
                                        $fullwidth_rec = '';
                                    ?>
                                        <div class="app_recent_img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('widget-posts'); ?></a></div><!--/app_recent_img-->
                                    <?php } elseif(!empty($video_link)) { $fullwidth_rec = '';  ?>                                        
                                        <div class="app_recent_img">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php echo get_video_image($video_link, $post->ID); ?>
                                            </a>
                                        </div>
                                        
                                    <?php
                                        $fullwidth_rec = '';
                                    } elseif(!empty($slide_images[0])){
                                           $fullwidth_rec = ''; ?>
                                            <div class="app_recent_img">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo tk_get_thumb(50, 50, $slide_images[0]);  ?>" alt="<?php the_title(); ?>"/>
                                                </a>
                                            </div>
                                        <?php
                                    } else {
                                        $fullwidth_rec = 'app_recent_box_fullwidth';
                                    } ?>
                                    
                                    <div class="app_recent_box <?php echo $fullwidth_rec;  ?>">
                                        <div class="app_recent_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div><!--/app_recent_cont-->
                                        <div class="app_recent_date"><span><?php echo getPostViews(get_the_ID()); ?></span></div><!--/app_recent_date-->
                                    </div><!--/app_recent_box-->
                                </div><!--/app_recent_post-->
                                <?php endwhile; endif; ?>
                            </div><!--/sidebar_widget_holder-->
                        </div>
                        
                        <div id="tabs-3">                            
                            <div class="sidebar_widget_holder tag-padding">
                                <?php if ($taxonomySelect == 'tags') { ?>
                                  <div class="tagcloud">
                                      <?php wp_tag_cloud(); ?>
                                  </div>
                                <?php }else{ ?>
                                  <div class="tabed-categories">
                                      <?php 
                                      $args = array(
                                        'orderby'            => 'name',
                                        'order'              => 'ASC',
                                        'style'              => 'list',
                                        'show_count'         => 0,
                                        'hide_empty'         => 1,
                                        'use_desc_for_title' => 1,
                                        'child_of'           => 0,
                                        'hierarchical'       => 1,
                                        'title_li'           => __( '' ),
                                        'show_option_none'   => __( 'No categories' ),
                                        'number'             => null,
                                        'echo'               => 1,
                                        'depth'              => 1,
                                        'current_category'   => 0,
                                        'pad_counts'         => 0,
                                        'taxonomy'           => 'category',
                                        'walker'             => null
                                      );
                                      wp_list_categories( $args ); ?> 
                                  </div>
                                <?php } ?>
                            </div><!--/tag-->
                        </div>
                    </div>









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

 
            if(isset($instance['populars-number'])){
                $popularsNumber = esc_attr($instance['populars-number']);
            }else{
                $popularsNumber = '';
            }
            
            if(isset($instance['recents-number'])){
                $recentsNumber = esc_attr($instance['recents-number']);
            }else{
                $recentsNumber = '';
            }
            
            if(isset($instance['taxonomy-select'])){
                $taxonomySelect = esc_attr($instance['taxonomy-select']);
            }else{
                $taxonomySelect = '';
            }
           

       ?>


       <p>
         <label for="<?php echo $this->get_field_id('populars-number'); ?>"><?php _e('Number of popular posts:', tk_theme_name); ?></label>
         <input type="text" name="<?php echo $this->get_field_name('populars-number'); ?>"  value="<?php echo $popularsNumber; ?>" class="" size="3" id="<?php echo $this->get_field_id('populars-number'); ?>" />
       </p>
    
       <p>
         <label for="<?php echo $this->get_field_id('recents-number'); ?>"><?php _e('Number of recent posts:', tk_theme_name); ?></label>
         <input type="text" name="<?php echo $this->get_field_name('recents-number'); ?>"  value="<?php echo $recentsNumber; ?>" class="" size="3" id="<?php echo $this->get_field_id('recents-number'); ?>" />
       </p>
       
        <p>
         <label for="<?php echo $this->get_field_id('taxonomy-select'); ?>"><?php _e('Taxonomy Select:', tk_theme_name); ?></label>
         <select name="<?php echo $this->get_field_name('taxonomy-select'); ?>" id="<?php echo $this->get_field_name('taxonomy-select'); ?>">
             <option value="tags" <?php if($taxonomySelect == 'tags') {?>selected<?php } ?>>Tags</option>
             <option value="categories" <?php if($taxonomySelect == 'categories') {?>selected<?php } ?>>Categories</option>             
         </select>
        </p>
       

      <?php
    }

}
register_widget('App_tabbed');
?>