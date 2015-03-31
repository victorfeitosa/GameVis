<?php
/* --------------------------------------------------------------------------------- */
/* Newsletter widget */
/* --------------------------------------------------------------------------------- */

class App_Newsletter extends WP_Widget {

    function App_Newsletter() {
        $widget_ops = array('description' => 'Newsletter Widget support 2 newsletter services MadMimi and MailChimp');
        parent::WP_Widget(false, $name = __(tk_theme_name . ' - Newsletter', tk_theme_name), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = $instance['title'];
        $newsletter_service = $instance['service'];
        $mailchimp_key = $instance['mailchimp_key'];
        $mailchimp_list = $instance['mailchimp_list'];
        $newsletter_text = $instance['newsletter_text'];
        $madmimi_signup = $instance['madmimi_user'];
        ?>

        <?php echo $before_widget; ?>
        <?php if ($title) {
            echo $before_title . $title . $after_title;
        } ?>
        
        <?php if (!empty($newsletter_service)) { ?>
            <div class="bg-newsletter-top left"></div>
            <div class="newsletter left">
                <?php if (!empty($newsletter_text)) { ?><span><?php echo $newsletter_text ?></span><?php } ?>
                

                    <?php if ($newsletter_service == 'MadMimi') { ?>
                    <div class="bg-newsletter-input">
                        <form action="https://madmimi.com/signups/subscribe/<?php echo $madmimi_signup?>" method="post" id="mad_mimi_signup_form" target="_blank" onsubmit="return MadMimiNewsletter()">
                            <div class="mimi_field text email required" style="width:64%;margin-top: 0;">
                                <input id="signup_email" name="signup[email]" type="text" placeholder="" data-invalid-message="This field is invalid" class="required newsletter_email input-newsletter">
                                <div class="mimi_field_feedback tk_newsletter_response"></div><span class="mimi_funk"></span>
                            </div>
                            <div class="mimi_field action">
                                <div class="bg-sidebar-newsletter">
                                    <div class="newsletter-icon"></div>
                                    <input id="webform_submit_button" value="" type="submit" class="submit newsletter_button btn submit-newsletter" data-default-text="" data-submitting-text="" data-invalid-text="">
                                </div>
                            </div>
                        </form>
                        <div class="border-down-widget left" style="height:2px"></div>
                    </div>
                    <?php } elseif ($newsletter_service == 'MailChimp') { ?>
                                        
                <div class="bg-newsletter-input">

                        <form id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <div class="searchform-left left"></div>
                            <input type="text" name="email" id="email"  class="input-newsletter" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
                            <input type="hidden" name="_mailchimp_key" id="_mailchimp_key" value="<?php echo $mailchimp_key ?>"/>
                            <input type="hidden" name="_mailchimp_list" id="_mailchimp_list" value="<?php echo $mailchimp_list ?>"/>
                            
                            <div class="bg-sidebar-newsletter mailchimp-icon-hover">
                                <div class="newsletter-icon"></div>
                                <input type="submit" src="" name="submit" value="" class="submit newsletter_button btn submit-newsletter" alt="Submit" />
                            </div>
                            
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
            <div class="bg-newsletter-down left"></div>


            <?php echo $after_widget; ?>
            <?php
        }
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {

        if (isset($instance['title'])) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (isset($instance['service'])) {
            $newsletter_service = esc_attr($instance['service']);
        } else {
            $newsletter_service = '';
        }

        if (isset($instance['mailchimp_key'])) {
            $mailchimp_key = esc_attr($instance['mailchimp_key']);
        } else {
            $mailchimp_key = '';
        }

        if (isset($instance['mailchimp_list'])) {
            $mailchimp_list = esc_attr($instance['mailchimp_list']);
        } else {
            $mailchimp_list = '';
        }

        if (isset($instance['madmimi_user'])) {
            $madmimi_username = esc_attr($instance['madmimi_user']);
        } else {
            $madmimi_username = '';
        }

        if (isset($instance['newsletter_text'])) {
            $newsletter_text = esc_attr($instance['newsletter_text']);
        } else {
            $newsletter_text = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', tk_theme_name); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('newsletter_text'); ?>"><?php _e('Newsletter Text:', tk_theme_name); ?></label>
            <textarea name="<?php echo $this->get_field_name('newsletter_text'); ?>" id="<?php echo $this->get_field_id('newsletter_text'); ?>" cols="30" rows="5"><?php echo $newsletter_text; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('service'); ?>"><?php _e('Chose Service:', tk_theme_name); ?></label><br/>
            <input type="radio" name="<?php echo $this->get_field_name('service'); ?>" value="MadMimi" <?php if (empty($newsletter_service) || $newsletter_service == 'MadMimi') {
            echo 'checked';
        } ?>>  MadMimi<br/>
            <input type="radio" name="<?php echo $this->get_field_name('service'); ?>" value="MailChimp" <?php if ($newsletter_service == 'MailChimp') {
            echo 'checked';
        } ?>>  MailChimp<br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_key'); ?>"><?php _e('MailChimp API Key:', tk_theme_name); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('mailchimp_key'); ?>"  value="<?php echo $mailchimp_key; ?>" class="" size="28" id="<?php echo $this->get_field_id('mailchimp_key'); ?>" /><br/>
            <span class="description">Grab and insert an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">here</a></span><br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_list'); ?>"><?php _e('MailChimp API List:', tk_theme_name); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('mailchimp_list'); ?>"  value="<?php echo $mailchimp_list; ?>" class="" size="28" id="<?php echo $this->get_field_id('mailchimp_list'); ?>" /><br/>
            <span class="description"><?php _e('Grab your Lists Unique Id by going to ', tk_theme_name); ?><a href="http://admin.mailchimp.com/lists/" target="_blank"><?php _e('here', tk_theme_name); ?></a>.<?php _e(' Click the "settings" link for the list - the Unique Id is at the bottom of that page.', tk_theme_name); ?></span><br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('madmimi_user'); ?>"><?php _e('MadMimi Unique Number:', tk_theme_name); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('madmimi_user'); ?>"  value="<?php echo $madmimi_username; ?>" class="" size="28" id="<?php echo $this->get_field_id('madmimi_user'); ?>" /><br/>
            <span class="description"><?php _e('Insert your MadMimi unique number.Click ', tk_theme_name) ?><a href="https://madmimi.com/signups" target="_blank"><?php _e('here', tk_theme_name); ?></a><?php _e(' or you can find this number when you log in into your MadMimi account, under WEBFORM click on SHARE and you will get link like this http://mad.ly/signups/<strong>XXXXX</strong>/join. Insert this number here.', tk_theme_name); ?></span><br/>
        </p>

        <?php
    }

}

register_widget('App_Newsletter');
?>