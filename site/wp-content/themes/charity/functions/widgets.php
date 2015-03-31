<?php
/************************************************************/
/*                                                          */
/*   Facebook Widget                                        */
/*                                                          */
/************************************************************/
class App_Facebook extends WP_Widget {

    function App_Facebook() {
        $widget_ops = array('description' => 'Facebook, Add facebook box' );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Facebook', 'tkingdom'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $unique_id = $args['widget_id'];
        $url = $instance['url'];
        if(empty($url)) {
            $url = 'http://www.facebook.com/platform';
        }



        if($args['id'] == 'sidebar-1' || $args['id'] == 'sidebar-2' || $args['id'] == 'sidebar-3' ||  $args['id'] == 'sidebar-4'){
            $fb_width = 273;
            $fb_height = 250;
        } else {
            $fb_width = 240;
            $fb_height = 250;
        }


        echo $before_widget; ?>

        <div class="facebook-widget">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $url; ?>&amp;width=<?php echo $fb_width; ?>&amp;height=<?php echo $fb_height; ?>&amp;colorscheme=light&amp;show_border=false&amp;stream=false&amp;header=false&amp;connections=10&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:<?php echo $fb_height; ?>px;" allowTransparency="true"></iframe>
        </div><!--  facebook widget-->
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


        if (isset($instance['url'])) {
            $url = esc_attr($instance['url']);
        } else {
            $url = '';
        }


        ?>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Facebook link:', 'tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('url'); ?>"  value="<?php echo $url; ?>" class="widefat" id="<?php echo $this->get_field_id('url'); ?>" />
        </p>

    <?php
    }


}
register_widget('App_Facebook');


/************************************************************/
/*                                                          */
/*   Advertising Widget                                     */
/*                                                          */
/************************************************************/
class App_Ad extends WP_Widget {
    function App_Ad() {
        $widget_ops = array('description' => 'Advertising widget with big images' );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Advertising Widget', 'tkingdom'),$widget_ops);
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
                <option <?php if($width_select == 'fullwidth') { echo 'selected';} ?> value="fullwidth"><?php _e('Fullwidth', 'tkingdom'); ?></option>
                <option <?php if($width_select == 'halfwidth') { echo 'selected';} ?> value="halfwidth"><?php _e('Halfwidth', 'tkingdom'); ?></option>
            </select>
        </div><!-- widgets-advert-order -->
    <?php
    }
}
register_widget('App_Ad');

/************************************************************/
/*                                                          */
/*   Newsletter Widget                                      */
/*                                                          */
/************************************************************/

class App_Newsletter extends WP_Widget {

    function App_Newsletter() {
        $widget_ops = array('description' => 'Newsletter Widget support 2 newsletter services MadMimi and MailChimp');
        parent::WP_Widget(false, $name = __(wp_get_theme()->name . ' - Newsletter', 'tkingdom'), $widget_ops);
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
            <div class="newsleter-widget">
                <?php if (!empty($newsletter_text)) { ?><p><?php echo $newsletter_text ?></p><?php } ?>
                <div id="newsleter-form-footer">

                <?php if ($newsletter_service == 'MadMimi') { ?>
                    <form action="https://madmimi.com/signups/subscribe/<?php echo $madmimi_signup?>" method="post" id="mad_mimi_signup_form" target="_blank" onsubmit="return MadMimiNewsletter()">
                        <input id="signup_email" name="signup[email]" type="text" placeholder="" data-invalid-message="This field is invalid" class="required newsletter_email input-newsletter">
                        <input id="webform_submit_button" value="" type="submit" class="submit newsletter_button btn submit-newsletter" data-default-text="" data-submitting-text="" data-invalid-text="">
                        <div class="mimi_field_feedback tk_newsletter_response"></div><span class="mimi_funk"></span>
                    </form>
                <?php } elseif ($newsletter_service == 'MailChimp') { ?>
                    <form id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <input type="text" name="email" id="email"  class="input-newsletter" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
                            <input type="hidden" name="_mailchimp_key" id="_mailchimp_key" value="<?php echo $mailchimp_key ?>"/>
                            <input type="hidden" name="_mailchimp_list" id="_mailchimp_list" value="<?php echo $mailchimp_list ?>"/>
                            <input type="submit" src="" name="submit" value="" class="btn submit-newsletter" alt="Submit" />
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
                    <script type="text/javascript" src="<?php echo get_template_directory_uri() . '/script/mailchimp/js/mailing-list.js'; ?>"></script>
                <?php } ?>

                </div>
            </div>

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
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('newsletter_text'); ?>"><?php _e('Newsletter Text:', 'tkingdom'); ?></label>
            <textarea name="<?php echo $this->get_field_name('newsletter_text'); ?>" id="<?php echo $this->get_field_id('newsletter_text'); ?>" cols="30" rows="5"><?php echo $newsletter_text; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('service'); ?>"><?php _e('Chose Service:', 'tkingdom'); ?></label><br/>
            <input type="radio" name="<?php echo $this->get_field_name('service'); ?>" value="MadMimi" <?php if (empty($newsletter_service) || $newsletter_service == 'MadMimi') {
                echo 'checked';
            } ?>>  MadMimi<br/>
            <input type="radio" name="<?php echo $this->get_field_name('service'); ?>" value="MailChimp" <?php if ($newsletter_service == 'MailChimp') {
                echo 'checked';
            } ?>>  MailChimp<br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_key'); ?>"><?php _e('MailChimp API Key:', 'tkingdom'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('mailchimp_key'); ?>"  value="<?php echo $mailchimp_key; ?>" class="" size="28" id="<?php echo $this->get_field_id('mailchimp_key'); ?>" /><br/>
            <span class="description">Grab and insert an API Key from <a href="http://admin.mailchimp.com/account/api/" target="_blank">here</a></span><br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mailchimp_list'); ?>"><?php _e('MailChimp API List:', 'tkingdom'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('mailchimp_list'); ?>"  value="<?php echo $mailchimp_list; ?>" class="" size="28" id="<?php echo $this->get_field_id('mailchimp_list'); ?>" /><br/>
            <span class="description"><?php _e('Grab your Lists Unique Id by going to ', 'tkingdom'); ?><a href="http://admin.mailchimp.com/lists/" target="_blank"><?php _e('here', 'tkingdom'); ?></a>.<?php _e(' Click the "settings" link for the list - the Unique Id is at the bottom of that page.', 'tkingdom'); ?></span><br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('madmimi_user'); ?>"><?php _e('MadMimi Unique Number:', 'tkingdom'); ?></label><br/>
            <input type="text" name="<?php echo $this->get_field_name('madmimi_user'); ?>"  value="<?php echo $madmimi_username; ?>" class="" size="28" id="<?php echo $this->get_field_id('madmimi_user'); ?>" /><br/>
            <span class="description"><?php _e('Insert your MadMimi unique number.Click ', 'tkingdom') ?><a href="https://madmimi.com/signups" target="_blank"><?php _e('here', 'tkingdom'); ?></a><?php _e(' or you can find this number when you log in into your MadMimi account, under WEBFORM click on SHARE and you will get link like this http://mad.ly/signups/<strong>XXXXX</strong>/join. Insert this number here.', 'tkingdom'); ?></span><br/>
        </p>

    <?php
    }

}

register_widget('App_Newsletter');

/************************************************************/
/*                                                          */
/*   Twitter Widget                                         */
/*                                                          */
/************************************************************/

class App_Twitter extends WP_Widget {

    function App_Twitter() {
        $widget_ops = array('description' => 'Twitter Stream Widget display tweets from a any Twitter account in the sidebar of your blog. You can customise the number of updates shown in the sidebar' );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Twitter Stream', 'tkingdom'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = $instance['title'];
        $limit = $instance['limit']; if (!$limit) $limit = 5;
        $unique_id = $args['widget_id'];?>

        <?php echo $before_widget; ?>
        <?php if ($title) echo $before_title . $title . $after_title; ?>

        <?php echo twitter_script($unique_id,$limit); //Javascript output function ?>
        <?php echo $after_widget; ?>


    <?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {

        if(isset($instance['title'])){
            $title = esc_attr($instance['title']);
        }else{
            $title = '';
        }

        if(isset($instance['limit'])){
            $limit = esc_attr($instance['limit']);
        }else{
            $limit = '';
        }


        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number of tweets:','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id('limit'); ?>" />
        </p>


        <p><b><?php _e('Twitter will not work unless you have set up Twitter authentication at ', 'tkingdom'); ?><a target='_blank' href='<?php echo site_url(); ?>/wp-admin/admin.php?page=theme-settings&tab=social'><?php _e('theme administration', 'tkingdom'); ?></a></b></p>

    <?php
    }

}
register_widget('App_Twitter');


/************************************************************/
/*                                                          */
/*   Donate Widget                                         */
/*                                                          */
/************************************************************/

class App_Donate extends WP_Widget {

    function App_Donate() {
        $widget_ops = array('description' => 'Donate Widget is simple solution to link your cause or action to your website.' );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Donate Widget', 'tkingdom'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = $instance['title'];
        $donate_text = $instance['donate_text']; if (!$donate_text) $donate_text = '';
        $donate_curent = $instance['donate_curent']; if (!$donate_curent) $donate_curent = '';
        $donate_target = $instance['donate_target']; if (!$donate_target) $donate_target = '';
        $donate_url = $instance['donate_url']; if (!$donate_url) $donate_url = '';
?>

        <?php echo $before_widget; ?>
        <?php if ($title) echo $before_title . $title . $after_title; ?>

        <div class="donate-widget">
            <?php if($donate_text){?><p><?php echo $donate_text; ?></p><?php }?>
            <table class="table table-bordered"r>
                <tbody>
                <tr>
                    <td class="first"><?php _e('Donated', 'tkingdom')?></td>
                    <td><?php _e('Target', 'tkingdom')?></td>
                </tr>
                <tr>
                    <td class="first"><?php echo $donate_curent?></td>
                    <td><?php echo $donate_target?></td>
                </tr>
                </tbody>
            </table>
            <a href="<?php echo $donate_url?>" target="_blank"><button class="btn btn-success" type="button"><p><?php _e('Donate Here', 'tkingdom')?></p></button></a>
        </div>

        <?php echo $after_widget; ?>

    <?php
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {

        if(isset($instance['title'])){
            $title = esc_attr($instance['title']);
        }else{
            $title = '';
        }

        if(isset($instance['donate_text'])){
            $donate_text = esc_attr($instance['donate_text']);
        }else{
            $donate_text = '';
        }

        if(isset($instance['donate_curent'])){
            $donate_curent = esc_attr($instance['donate_curent']);
        }else{
            $donate_curent = '';
        }

        if(isset($instance['donate_target'])){
            $donate_target = esc_attr($instance['donate_target']);
        }else{
            $donate_target = '';
        }

        if(isset($instance['donate_url'])){
            $donate_url = esc_attr($instance['donate_url']);
        }else{
            $donate_url = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('donate_text'); ?>"><?php _e('Widget Text','tkingdom'); ?></label>
            <textarea name="<?php echo $this->get_field_name('donate_text'); ?>" id="<?php echo $this->get_field_id('donate_text'); ?>" cols="29" rows="5"><?php echo $donate_text; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('donate_curent'); ?>"><?php _e('Current amount of donations','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('donate_curent'); ?>"  value="<?php echo $donate_curent; ?>" class="widefat" id="<?php echo $this->get_field_id('donate_curent'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('donate_target'); ?>"><?php _e('Target amount of donations','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('donate_target'); ?>"  value="<?php echo $donate_target; ?>" class="widefat" id="<?php echo $this->get_field_id('donate_target'); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('donate_url'); ?>"><?php _e('Donate URL','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('donate_url'); ?>"  value="<?php echo $donate_url; ?>" class="widefat" id="<?php echo $this->get_field_id('donate_url'); ?>" />
        </p>



    <?php
    }

}
register_widget('App_Donate');
?>