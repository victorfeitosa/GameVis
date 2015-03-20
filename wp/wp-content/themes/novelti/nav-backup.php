<?php
                            if (function_exists('has_nav_menu')) {
                                $locations = get_nav_menu_locations();
                                $menu_id = wp_get_nav_menu_object($locations['category']);
                                if (has_nav_menu('category')) {
                                    ?>
                                    <ul class="sf-menu">
                                        <?php
                                        $args = array(
                                            'order' => 'ASC',
                                            'orderby' => 'menu_order',
                                            'post_type' => 'nav_menu_item',
                                            'post_status' => 'publish',
                                            'output' => ARRAY_A,
                                            'output_key' => 'menu_order',
                                            'nopaging' => true,
                                            'update_post_term_cache' => false);
                                        $items = wp_get_nav_menu_items($menu_id->term_id, $args);
                                    }
                                  
                                    
                                    foreach ($items as $menu_category) {
                                        $one_category = get_category($menu_category->object_id);
                                        if ($one_category) {
                                            if ($menu_category->menu_item_parent == 0 ) {
                                                $category_color = get_option('category_' . $one_category->term_id);
                                                ?>
                                                <li style="background-color: #<?php echo $category_color['color'] ?>">
                                                    <a href="<?php echo get_category_link($one_category->term_id); ?>">
                                                        <p><?php echo $one_category->count ?></p>
                                                        <span><?php echo $one_category->name ?></span>
                                                    </a>
                                                <?php } ?>
                                                <?php
                                                $check_category = get_term_children($one_category->term_id, 'category');
                                                if (isset($check_category[0])) {
                                                    $args_sub = array('type' => 'post', 'child_of' => $one_category->term_id, 'parent' => $one_category->term_id, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0, 'hierarchical' => 0, 'exclude' => '', 'include' => '', 'number' => '', 'taxonomy' => 'category', 'pad_counts' => false);
                                                    $all_categories_sub = get_categories($args_sub);
                                                    ?>
                                                    <ul class="sub-menu" style="background-color: #<?php echo $category_color['color'] ?>">
                                                        <?php foreach ($all_categories_sub as $one_category_sub) { ?>
                                                            <li>
                                                                <a href="<?php echo get_category_link($one_category_sub->term_id); ?>">
                                                                    <span><?php echo $one_category_sub->name ?></span>
                                                                </a>
                                                                <?php
                                                                $check_category_sub = get_term_children($one_category_sub->term_id, 'category');
                                                                if (isset($check_category_sub[0])) {
                                                                    $args_sub_sub = array('type' => 'post', 'child_of' => $one_category_sub->term_id, 'parent' => $one_category_sub->term_id, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0, 'hierarchical' => 0, 'exclude' => '', 'include' => '', 'number' => '', 'taxonomy' => 'category', 'pad_counts' => false);
                                                                    $all_categories_sub_sub = get_categories($args_sub_sub);
                                                                    ?>
                                                                    <ul class="sub-menu" style="background-color: #<?php echo $category_color['color'] ?>">
                                                                        <?php foreach ($all_categories_sub_sub as $one_category_sub_sub) { ?>
                                                                            <li>
                                                                                <a href="<?php echo get_category_link($one_category_sub_sub->term_id); ?>">
                                                                                    <span><?php echo $one_category_sub_sub->name ?></span>
                                                                                </a>
                                                                            <?php } // end foreach categories ?>
                                                                        </li>
                                                                    </ul>
                                                                <?php }
                                                            }
                                                            ?>
                                                        </li>
                                                    </ul>
                                                <?php } ?>
                                            </li>           
                                    <?php } else { ?>
                                            <li style="background-color: #<?php echo $category_color['color'] ?>">
                                                <a href="<?php echo $menu_category->url; ?>">
                                                    <p></p>
                                                    <span><?php echo $menu_category->title ?></span>
                                                </a>
                                            </li>  
                                    <?php } ?>
                                <?php } ?>
                                </ul>
                            <?php
                            } elseif (has_nav_menu('primary')) {
                                $nav_menu = array('title_li' => '', 'theme_location' => 'primary', 'menu_class' => 'sf-menu');
                                wp_nav_menu($nav_menu);
                            }
                            ?>