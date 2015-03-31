<?php

/************************************************************/
/*                                                          */
/*   Flickr Widget                                        */
/*                                                          */
/************************************************************/
class App_Flickr extends WP_Widget {

    function App_Flickr() {
        $widget_ops = array('description' => 'Flickr, Add Flickr phot stream box' );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Flickr Photo Stream', 'tkingdom'),$widget_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );

        $cur_arg = array(
            'title'     => $instance['title'],
            'type'      => empty( $instance['type'] ) ? 'user' : $instance['type'],
            'flickr_id' => $instance['flickr_id'],
            'count'     => (int) $instance['count'],
            'display'   => empty( $instance['display'] ) ? 'latest' : $instance['display'],
            'size'      => 's',
        );
        
        extract($cur_arg);
    
        echo $before_widget;
        
        if($title)
            echo $before_title . $title . $after_title;

        echo "<div class='tk-flickr-wrap'>";
    
        //If the widget have an ID, we can continue
        if(!empty( $instance['flickr_id'])){
            if (false === ($value = get_transient( 'cache_flick_box'))) {
                $flickr_box = "<script type='text/javascript' src='http://www.flickr.com/badge_code_v2.gne?count=$count&amp;display=$display&amp;size=$size&amp;layout=x&amp;source=$type&amp;$type=$flickr_id'></script>";
                set_transient( 'cache_flick_box', $flickr_box, 60 * 60 * 2);
            }
            echo get_transient('cache_flick_box');
            
        }else{
            echo '<p>'.__('Please provide an Flickr ID', 'tkingdom').'</p>';
        }
        echo '</div>';
        
        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['type']       = strip_tags($new_instance['type']);
        $instance['flickr_id']  = strip_tags($new_instance['flickr_id']);
        $instance['count']      = (int) $new_instance['count'];
        $instance['display']    = strip_tags($new_instance['display']);
        $instance['title']      = strip_tags($new_instance['title']);
        
        return $instance;
    }


        function form($instance) {
        // Set up the default form values.
        $defaults = array(
            'title'      => esc_attr__( 'Flickr Widget', 'tkingdom' ),
            'type'       => 'user',
            'flickr_id'  => '', // 71865026@N00
            'count'      => 9,
            'display'    => 'display',
            'size'       => 's'
        );

        /* Merge the user-selected arguments with the defaults. */
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        $types = array( 
            'user'  => esc_attr__('user', 'tkingdom'), 
            'group' => esc_attr__('group', 'tkingdom')
        );
        $displays = array( 
            'latest' => esc_attr__('latest', 'tkingdom'),
            'random' => esc_attr__('random', 'tkingdom')
        );

        ?>
        
        <div>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'tkingdom'); ?></label><br />
                <small><?php _e( 'Give the widget title, or leave it empty for no title.', 'tkingdom' ); ?></small>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type', 'tkingdom' ); ?></label><br />
                <small><?php _e( 'The type of images from user or group.', 'tkingdom' ); ?></small>
                <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
                    <?php foreach ( $types as $k => $v ) { ?>
                        <option value="<?php echo esc_attr( $k ); ?>" <?php selected( $instance['type'], $k ); ?>><?php echo esc_html( $v ); ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID', 'tkingdom'); ?></label>
                <input id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr( $instance['flickr_id'] ); ?>" /><br />
                <small><?php _e( 'Put the flickr ID here, go to <a href="http://goo.gl/PM6rZ" target="_blank">Flickr NSID Lookup</a> if you don\'t know your ID. Example: 71865026@N00', 'tkingdom' ); ?></small>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number', 'tkingdom'); ?></label><br />
                <small><?php _e( 'Number of images shown from 1 to 10', 'tkingdom' ); ?></small>
                <input class="column-last" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" size="3" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display Method', 'tkingdom'); ?></label><br />
                <small><?php _e( 'Get the image from recent or use random function.', 'tkingdom' ); ?></small>
                <select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
                    <?php foreach ( $displays as $k => $v ) { ?>
                        <option value="<?php echo esc_attr( $k ); ?>" <?php selected( $instance['display'], $k ); ?>><?php echo esc_html( $v ); ?></option>
                    <?php } ?>
                </select>
            </p>
        </div>

        <?php
    }



}
register_widget('App_Flickr');


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
            $fb_width = 86;
            $fb_height = 100;
        } else {
            $fb_width = 86;
            $fb_height = 100;
        }


        echo $before_widget; ?>

        <div class="facebook-widget">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $url; ?>&amp;width=<?php echo $fb_width; ?>&amp;height=<?php echo $fb_height; ?>&amp;colorscheme=light&amp;show_border=false&amp;stream=false&amp;header=false&amp;connections=12&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $fb_width; ?>%; height:<?php echo $fb_height; ?>%;" allowTransparency="true"></iframe>
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
            <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Facebook link:', wp_get_theme()->name); ?></label>
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
        $advert_margin = $instance['advert-margin'];
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
                        <div class="fullwidth-banner left" style="margin-bottom: <?php echo $advert_margin; ?>px">
                            <a target="_blank" href="<?php echo site_url(); ?>?banner_id=<?php echo $advert_select; ?>">
                                <img src="<?php echo $image_src[0]; ?>"  />
                            </a>
                        </div><!-- halfwidth-banner -->
                    <?php } else { ?>
                        <div class="halfwidth-banner left" style="margin-bottom: <?php echo $advert_margin; ?>px">
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
        if (isset($instance['advert-margin'])) {
            $advert_margin = esc_attr($instance['advert-margin']);
        } else {
            $advert_margin = '';
        }
        ?>
        <div  class="widgets-advert-order">
            <select name="<?php echo $this->get_field_name('advert-select'); ?>" id="<?php echo $this->get_field_name('advert-select'); ?>" style="width: 60%;">
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
            <span style="margin-top: 10px; float: left"><p style="float: left; margin-top: 4px;">Bottom margin</p><input type="text" name="<?php echo $this->get_field_name('advert-margin'); ?>" value="<?php echo $advert_margin; ?>" id="<?php echo $this->get_field_name('advert-margin'); ?>" autocomplete="off" style="width: 15%; float: left; margin: 0 10px;"/><p style="float: left; margin-top: 4px;">px</p></span>
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
                        <input id="webform_submit_button" value="SUBSCRIBE" type="submit" class="submit newsletter_button btn submit-newsletter" data-default-text="" data-submitting-text="" data-invalid-text="">
                        <div class="mimi_field_feedback tk_newsletter_response"></div><span class="mimi_funk"></span>
                    </form>
                <?php } elseif ($newsletter_service == 'MailChimp') { ?>
                    <form id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <input type="text" name="email" id="email"  class="input-newsletter" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
                            <input type="hidden" name="_mailchimp_key" id="_mailchimp_key" value="<?php echo $mailchimp_key ?>"/>
                            <input type="hidden" name="_mailchimp_list" id="_mailchimp_list" value="<?php echo $mailchimp_list ?>"/>
                            <input type="submit" src="" name="submit" value="SUBSCRIBE" class="btn submit-newsletter" alt="Submit" />
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
?>