<?php
/*         * *****HOME CONTENT****** */
$page_content = get_option('page-content-'.$post->ID);
?>
<div class="home-page-content left">
    <div class="shortcodes" style="margin:0">
        <?php wp_reset_query();
        query_posts('page_id='.$page_content);
        if (have_posts()) : while (have_posts()) : the_post();
                the_content();
            endwhile;
        else:
        endif;
        wp_reset_query(); ?>
    </div><!--/wrapper-->
</div><!--/wrapper-->