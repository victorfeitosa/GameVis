<?php
/* ******FOOTER WIDGETS****** */
$check_footer1 = is_active_sidebar('sidebar-1');
$check_footer2 = is_active_sidebar('sidebar-2');
$check_footer3 = is_active_sidebar('sidebar-3');
if ($check_footer1 == true || $check_footer2 == true || $check_footer3 == true) {
    ?>
        <div class="col-xs-4 footer-widgets">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
            <?php endif; ?>
        </div><!-- .col-xs-4 -->
        <div class="col-xs-4 footer-widgets">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
            <?php endif; ?>
        </div><!-- .col-xs-4 -->
        <div class="col-xs-4 footer-widgets" style="margin-right: 0">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
            <?php endif; ?>
        </div><!-- .col-xs-4 -->
<?php } ?>