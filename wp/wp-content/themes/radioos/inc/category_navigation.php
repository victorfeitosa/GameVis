<div class="home-category left">
    <?php 
    $projects_id =  get_option('id_projects_page');
    $projects_url = get_permalink($projects_id);
    $current_url = get_page_url();

    ?>
    <ul id="cat-nav">
        <li><a href="<?php echo $projects_url?>" <?php if($current_url == $projects_url){echo 'class="active-nav"';}?>><?php _e('All', tk_theme_name) ?></a></li>
                        <?php
                          global $wpdb;
                          $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'projects' AND post_status = 'publish'");
                          if(!empty ($post_type_ids )){
                            $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_projects',array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'ids') );
                            if($post_type_cats){
                              $post_type_cats = array_unique($post_type_cats);
                            }
                          }
                          $include_category = null;
                            if(!empty ($post_type_ids )){
                                 foreach ($post_type_cats as $category_list) {
                                    $cat = 	$category_list.",";
                                    $include_category = $include_category.$cat;
                                    $cat_name = get_term($category_list, 'ct_projects');
                                ?>
            <li>
                <a href="<?php echo get_term_link( $cat_name->slug, 'ct_projects' );?>" <?php if($current_url == get_term_link( $cat_name->slug, 'ct_projects' )){echo 'class="active-nav"';}?>><?php echo $cat_name->name ?></a>
            </li>
                        <?php } }?>
    </ul>
</div><!--/home-portfolio-one-->
