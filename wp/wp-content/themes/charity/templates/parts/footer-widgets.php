<?php
/* ******FOOTER WIDGETS****** */
$check_footer1 = is_active_sidebar('sidebar-1');
$check_footer2 = is_active_sidebar('sidebar-2');
$check_footer3 = is_active_sidebar('sidebar-3');
$check_footer4 = is_active_sidebar('sidebar-4');
if ($check_footer1 == true || $check_footer2 == true || $check_footer3 == true || $check_footer4 == true) {
    ?>
    <div class="">
        <div class="span3">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
            <?php endif; ?>
        </div><!-- .span4 -->
        <div class="span3">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
            <?php endif; ?>
        </div><!-- .span4 -->
        <div class="span3">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
            <?php endif; ?>
        </div><!-- .span4 -->
        <div class="span3" style="margin-right: 0">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 4')) : ?>
            <?php endif; ?>
        </div><!-- .span4 -->
    </div><!-- .row -->
<?php } ?>