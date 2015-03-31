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
            $fb_width = 90;
            $fb_height = 289;
        } else {
            $fb_width = 90;
            $fb_height = 289;
        }


        echo $before_widget; ?>

        <div class="facebook-widget">
            <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $url; ?>&amp;width=<?php echo $fb_width; ?>&amp;height=<?php echo $fb_height; ?>&amp;colorscheme=light&amp;show_border=false&amp;stream=false&amp;header=false&amp;connections=12&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $fb_width; ?>%; height:<?php echo $fb_height; ?>px;" allowTransparency="true"></iframe>
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
                        <div class="newsletter">
                            <input id="signup_email" name="signup[email]" type="text" placeholder="" data-invalid-message="This field is invalid" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" class="required newsletter_email input-newsletter" value="Enter your email...">
                            <input id="webform_submit_button" value="" type="submit" class="submit newsletter_button btn submit-newsletter" data-default-text="" data-submitting-text="" data-invalid-text="">
                            <div class="mimi_field_feedback tk_newsletter_response"></div><span class="mimi_funk"></span>
                        </div>
                    </form>
                <?php } elseif ($newsletter_service == 'MailChimp') { ?>
                    <form id="signup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="newsletter">
                                <input type="text" name="email" id="email"  class="input-newsletter" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="Enter your email..."/>
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
                        </div>
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
            <label for="<?php echo $this->get_field_id('newsletter_text'); ?>" class="nwsltr-txt-holder"><?php _e('Newsletter Text:', 'tkingdom'); ?></label>
            <textarea name="<?php echo $this->get_field_name('newsletter_text'); ?>" id="<?php echo $this->get_field_id('newsletter_text'); ?>" cols="31" rows="5"><?php echo $newsletter_text; ?></textarea>
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
/*   Recent Posts Widget                                    */
/*                                                          */
/************************************************************/

class App_Recent_Posts extends WP_Widget {

function App_Recent_Posts() {
        $widget_ops = array( "classname" => "widget_posts_lists", "description" => "Displays the Recent posts" );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Recent Posts', 'tkingdom'),$widget_ops);
        $this-> alt_option_name = "widget_recent_posts";

        add_action( "save_post", array( &$this, "flush_widget_cache" ) );
        add_action( "deleted_post", array( &$this, "flush_widget_cache" ) );
        add_action( "switch_theme", array( &$this, "flush_widget_cache" ) );
    }


    function widget( $args, $instance ) {

        $cache = wp_cache_get( "App_Recent_Posts", "widget" );

        if ( !is_array( $cache ) )
            $cache = array();

        if ( isset( $cache[$args['widget_id']] ) ) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract( $args );


        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base );
        if ( !$posts_number = (int) $instance['posts_number'] )
            $posts_number = 10;
        else if ( $posts_number < 1 )
                $posts_number = 1;
            else if ( $posts_number > 15 )
                    $posts_number = 15;

            $disable_time = $instance["disable_time"] ? "1" : "0";
        



        $query = array( 'showposts' => $posts_number, 'nopaging' => 0, 'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
        if ( !empty( $instance["cats"] ) ) {
            $query["cat"] = implode( ",", $instance["cats"] );
        }

        $recent = new WP_Query( $query );

        if ( $recent-> have_posts() ) :

            echo $before_widget;

        if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul class="tk-latest-posts-widget">

        <?php

        while ( $recent-> have_posts() ) : $recent -> the_post();

        global $post;
         ?>

        <li>
            <?php 
            if ( has_post_thumbnail() ) :
            ?>
            <?php   $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );    
                    $image_src  = the_post_thumbnail('widget-thumbnail');
             ?>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="<?php if(!has_post_thumbnail()) {echo 'full-link';} ?> post-list-title"><?php the_title(); ?></a>
            <?php if($disable_time == true) {  ?>
            <time <?php if(!has_post_thumbnail()) {echo 'class="full-time"';} ?> datetime="<?php the_time(get_option('date_format')); ?>"><?php the_time(get_option('date_format')); ?></time>
            <?php } ?>

        </li>
        
        <?php endwhile;  ?>

        </ul>
        <?php
        echo $after_widget;

        wp_reset_query();


        endif;


        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set( 'App_Recent_Posts', $cache, 'widget' );
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance["title"] = strip_tags( $new_instance["title"] );
        $instance["posts_number"] = (int) $new_instance["posts_number"];
        $instance["disable_time"] = !empty( $new_instance["disable_time"] ) ? 1 : 0;
        $instance["cats"] = $new_instance["cats"];

        $this-> flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset( $alloptions['App_Recent_Posts'] ) )
            delete_option( 'App_Recent_Posts' );

        return $instance;
    }



    function flush_widget_cache() {
        wp_cache_delete( 'App_Recent_Posts', 'widget' );
    }





    function form( $instance ) {

        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

        $disable_time = isset( $instance["disable_time"] ) ? (bool) $instance["disable_time"] : true;
        $cats = isset( $instance['cats'] ) ? $instance['cats'] : array();

        if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
            $posts_number = 3;

        $categories = get_categories( 'orderby=name&hide_empty=0' );


?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">Number of posts:</label>
        <input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" class="widefat" /></p>

        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_time' ); ?>" name="<?php echo $this->get_field_name( 'disable_time' ); ?>"<?php checked( $disable_time ); ?> />
        <label for="<?php echo $this->get_field_id( 'disable_time' ); ?>">Show Date</label></p>

    
            <label for="<?php echo $this->get_field_id( 'cat' ); ?>">Select which categories to show<br/><i>Hold control key for multiple choices</i></label>
            <select style="height:15em" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" class="widefat" multiple="multiple">
                <?php foreach ( $categories as $category ):?>
                <option value="<?php echo $category->term_id;?>"<?php echo in_array( $category->term_id, $cats )? ' selected="selected"':'';?>><?php echo $category->name;?></option>
                <?php endforeach;?>
            </select>
        </p>

<?php }
}
register_widget('App_Recent_Posts');

/************************************************************/
/*                                                          */
/*   Rated Posts Widget                                     */
/*                                                          */
/************************************************************/

class App_Rated_Posts extends WP_Widget {

    function App_Rated_Posts() {
        $widget_ops = array('description' => 'Display posts by rating. You can customise the number of posts, widget title and rating type to show in the sidebar' );
        parent::WP_Widget(false, __(wp_get_theme()->name.' - Rated Posts', 'tkingdom'),$widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $limit       = $instance['limit'];
        $rating_type = $instance['rating_type'];
        $title       = $instance['title'];

        //Get rated posts
        $queryrates = tk_get_all_rated_posts($limit);

        ?>

            <div class="latest-reciews-widget">
                <h3><?php echo $title; ?></h3>

        <?php

            if(!empty($queryrates)){ ?>
                <ul>
            <?php
                $nbr_posts = 0;
                foreach ($queryrates as $rated_post) {
                    $post_id = $rated_post->ID;

                    /* OVERAL RATING SYSTEM */
                    $i = 0;
                    $overal_rating = 0;
                    $post_rating = get_post_meta($post_id, 'tk_post_rating', true);
                    $post_rating_rate = get_post_meta($post_id, 'rating-tk_post_rating', true);

                    foreach ($post_rating as $one_criteria) {
                        $overal_rating = $overal_rating + $post_rating_rate[$i];
                        $i++;
                    }

                    $overal_rating_display = round($overal_rating / $i, 1);

                    /* Create Top Rated Posts */
                    $top_rated[$nbr_posts] = array(
                        'postid' => $post_id,
                        'overal' => $overal_rating_display
                    );

                    if ($overal_rating_display > 0) { ?>

                    <?php if($rating_type == 'latest') : ?>
                        <li>
                            <p><?php echo $overal_rating_display; ?></p>
                            <a href="<?php echo get_permalink($post_id); ?>"><?php echo $rated_post->post_title; ?></a>
                        </li>
                    <?php endif; ?>

                    <?php
                        $nbr_posts++;
                    }
                }

                     //Display Top Rated Posts if selected
                     if($rating_type == 'top') :
                        //Obtain a list of columns
                        foreach($top_rated as $key => $row) {
                            $postid[$key] = $row['postid'];
                            $overal[$key] = $row['overal'];
                        }

                        //Sort the data with overal rating descending
                        array_multisort($overal, SORT_DESC, $top_rated);

                         foreach($top_rated as $top_rate){
                            $post_id = $top_rate['postid'];
                            $top_rated_post = get_post($post_id);
                         ?>
                            <li>
                                <p><?php echo $top_rate['overal']; ?></p>
                                <a href="<?php echo get_permalink($post_id); ?>"><?php echo $top_rated_post->post_title; ?></a>
                            </li>
                    <?php
                        }
                     endif;
                    ?>
                </ul>


                <?php if($nbr_posts == 0) : ?> <h4><?php _e('There are no rated posts to display!', 'tkingdom'); ?></h4> <?php endif; ?>

            <?php } else{ ?>
                <h4><?php _e('There are no rated posts to display!', 'tkingdom'); ?></h4>
            <?php } ?>
        </div>

    <?php
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {

        if(isset($instance['title'])){
            $title = esc_attr($instance['title']);
        }else{
            $title = '';
        }

        if(isset($instance['limit'])){
            $limit = esc_attr($instance['limit']);
        }else{
            $limit = 3;
        }

        if(isset($instance['rating_type'])){
            $rating_type = esc_attr($instance['rating_type']);
        }else{
            $rating_type = 'top';
        }
    ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tkingdom'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number of posts to show:','tkingdom'); ?></label>
            <input type="number" name="<?php echo $this->get_field_name('limit'); ?>"  value="<?php echo $limit; ?>" class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('rating_type'); ?>"><?php _e('Which posts to show:','tkingdom'); ?></label><br />
            <input type="radio" name="<?php echo $this->get_field_name('rating_type'); ?>" value="top" <?php if($rating_type == 'top') echo 'checked' ?> /> Top rated
            <input type="radio" name="<?php echo $this->get_field_name('rating_type'); ?>" value="latest" <?php if($rating_type == 'latest') echo 'checked' ?> /> Recently rated
        </p>

    <?php
    }

}
register_widget('App_Rated_Posts');

?>