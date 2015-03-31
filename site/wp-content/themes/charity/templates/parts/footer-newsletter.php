<?php
// Variables
$footer_newsletter_title = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_title');
$footer_newsletter_text = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_text');
$footer_newsletter_service = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_service');
$footer_newsletter_madmimi_user = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_madmimi_user');
$footer_newsletter_mailchimp_key = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_mailchimp_key');
$footer_newsletter_mailchimp_list = get_theme_option(wp_get_theme()->name .'_general_footer_newsletter_mailchimp_list');
?>
<div class="row-fluid footer-top">
    <div class="container">
        <h1><img src="<?php echo get_template_directory_uri()?>/img/newsleter-footer-title.png"><?php echo $footer_newsletter_title?></h1>

        <div class="row-fluid">
            <div class="span6">
                <p><?php if (!empty($footer_newsletter_text)) { ?><p><?php echo $footer_newsletter_text ?></p><?php } ?></p>
            </div>
            <div class="span6">
                <?php if ($footer_newsletter_service == 'madmimi') { ?>
                    <form action="https://madmimi.com/signups/subscribe/<?php echo $footer_newsletter_madmimi_user?>" method="post" id="newsleter-form-footer" target="_blank" onsubmit="return MadMimiNewsletter()">
                        <input id="signup_email" name="signup[email]" type="text" placeholder="" data-invalid-message="This field is invalid" class="required newsletter_email input-newsletter">
                        <input id="webform_submit_button" value="" type="submit" class="submit newsletter_button btn submit-newsletter" data-default-text="" data-submitting-text="" data-invalid-text="">
                        <div class="mimi_field_feedback tk_newsletter_response"></div><span class="mimi_funk"></span>
                    </form>
                <?php } elseif ($footer_newsletter_service == 'mailchimp') { ?>
                    <div id="newsleter-form-footer">
                        <form id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <input type="text" name="email" id="email"  class="required newsletter_email input-newsletter" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
                            <input type="hidden" name="_mailchimp_key" id="_mailchimp_key" value="<?php echo $footer_newsletter_mailchimp_key ?>"/>
                            <input type="hidden" name="_mailchimp_list" id="_mailchimp_list" value="<?php echo $footer_newsletter_mailchimp_list ?>"/>
                            <input type="submit" src="" name="submit" value="" class="submit newsletter_button btn submit-newsletter" alt="Submit" />
                            <input type="text" style="display: none" value="<?php echo get_template_directory_uri() . '/script/mailchimp/inc/store-address.php' ?>" name="hidden_path" class="hidden_path">
                            <div class="clear"></div>
                            <label for="email" id="address-label">
                                    <span id="response">
                                        <?php get_template_part('/script/mailchimp/inc/store-address.php');
                                        if (isset($_GET['submit'])) {
                                            echo storeAddress();
                                        } ?>
                                    </span>
                            </label>
                        </form>
                    </div>
                    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/script/mailchimp/js/mailing-list.js'; ?>"></script>
                <?php } ?>
            </div>
        </div>
    </div>
</div>