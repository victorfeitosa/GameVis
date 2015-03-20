<?php
$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_large_map = get_theme_option(wp_get_theme()->name.'_contact_header_map');
$show_map = get_theme_option(wp_get_theme()->name.'_contact_show_map');
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
if($use_latest_news == 'on'){
?>
    <?php
    // check for slider, map and latest news and add css class
    if($use_slider !== 'on'){$css_class = 'no-slider';}else{$css_class = '';}
    if($template_name == 'templates/template-contact.php' && ($show_map != 'yes' && $use_large_map != 'content' )){$css_class = '';}
    ?>

    <div class="row-fluid news-home <?php echo $css_class?>">
        <div class="container overflow-hide">
            <div class="span2">
                <span><?php _e('LATEST NEWS:', 'tkingdom')?></span>
            </div>
            <div class="span10">
                <ul id="webticker" >
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args = array('post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => '-1');
                    // The Query
                    $the_query = new WP_Query($args);

                    $counter = 1;
                    if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();
                        ?>
                        <li id="item<?php echo $counter?>">
                            <a href="<?php the_permalink()?>"><?php the_title()?><i class="plas10"><div class="plus-up"></div><div class="plus-hor"></div></i></a>
                        </li>
                    <?php $counter++;endwhile; ?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>
<?php  }
wp_reset_query();?>