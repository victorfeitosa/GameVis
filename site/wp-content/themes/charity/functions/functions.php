<?php
/********************************************************************************************************/
/*                                                                                                      */
/*   Add support for Featured Image option                                                              */
/*                                                                                                      */
/********************************************************************************************************/

    /********************************************************************************************************/
    /*                                                                                                      */
    /*   Navigation Walker for Twitter Bootstrap navigation for WordPress                                   */
    /*                                                                                                      */
    /********************************************************************************************************/
    /**
     * Class Name: twitter_bootstrap_nav_walker
     * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
     * Description: A custom Wordpress nav walker to implement the Twitter Bootstrap 2 (https://github.com/twitter/bootstrap/) dropdown navigation using the Wordpress built in menu manager.
     * Version: 1.2.2
     * Author: Edward McIntyre - @twittem
     * Licence: WTFPL 2.0 (http://sam.zoy.org/wtfpl/COPYING)
     */

    class twitter_bootstrap_nav_walker extends Walker_Nav_Menu {
        /**
         * @see Walker::start_lvl()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int $depth Depth of page. Used for padding.
         */
        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat( "\t", $depth );
            if ($args->has_children && $depth === 1) {
                $class_names = ' second_level';
            }else{
                $class_names = '';
            }
            $output	   .= "\n$indent<ul class=\"dropdown-menu $class_names\">\n";
        }

        /**
         * @see Walker::start_el()
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param int $current_page Menu item ID.
         * @param object $args
         */
        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0) {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            if (strcasecmp($item->title, 'divider')) {
                $class_names = $value = '';
                $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                $classes[] = ($item->current) ? 'active' : '';
                $classes[] = 'menu-item-' . $item->ID;
                $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
                if ($args->has_children && $depth > 0) {
                    $class_names .= ' dropdown';
                } else if($args->has_children && $depth === 0) {
                    //  $class_names .= ' dropdown';
                    $class_names .= ' dropdown';
                }
                $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
                $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
                $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
                $output .= $indent . '<li' . $id . $value . $class_names .'>';
                $attributes  = ! empty( $item->title ) ? ' title="'  . esc_attr( $item->title ) .'"' : '';
                $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                $attributes .= ($args->has_children) 	    ? '  data-hover="dropdown" data-delay="0" data-close-others="false" class="dropdown-toggle"' : '';
                $item_output = $args->before;
                $item_output .= '<a'. $attributes .'>';
                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
                $item_output .= ($args->has_children && $depth == 0) ? ' <b class="caret"><div class="plus-up"></div><div class="plus-hor"></div></b></a>' : '</a>';
                $item_output .= $args->after;
                $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            } else {
                $output .= $indent . '<li class="divider">';
            }
        }

        /**
         * Traverse elements to create list from elements.
         *
         * Display one element if the element doesn't have any children otherwise,
         * display the element and its children. Will only traverse up to the max
         * depth and no ignore elements under that depth.
         *
         * This method shouldn't be called directly, use the walk() method instead.
         *
         * @see Walker::start_el()
         * @since 2.5.0
         *
         * @param object $element Data object
         * @param array $children_elements List of elements to continue traversing.
         * @param int $max_depth Max depth to traverse.
         * @param int $depth Depth of current element.
         * @param array $args
         * @param string $output Passed by reference. Used to append additional content.
         * @return null Null on failure with no changes to parameters.
         */
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
            if ( !$element ) {
                return;
            }
            $id_field = $this->db_fields['id'];
            //display this element
            if ( is_array( $args[0] ) )
                $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
            else if ( is_object( $args[0] ) )
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            $cb_args = array_merge( array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);
            $id = $element->$id_field;
            // descend only when the depth is right and there are childrens for this element
            if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
                foreach( $children_elements[ $id ] as $child ){
                    if ( !isset($newlevel) ) {
                        $newlevel = true;
                        //start the child delimiter
                        $cb_args = array_merge( array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }
                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
                }
                unset( $children_elements[ $id ] );
            }
            if ( isset($newlevel) && $newlevel ){
                //end the child delimiter
                $cb_args = array_merge( array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }
            //end this element
            $cb_args = array_merge( array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }
    }

/********************************************************************************************************/
/*                                                                                                      */
/*   Paging function                                                                                    */
/*   Example from http://codex.wordpress.org/Function_Reference/paginate_links                          */
/*                                                                                                      */
/********************************************************************************************************/
if ( ! function_exists( 'tk_pageing' ) ) {
    function tk_pageing($custom_query){
        global $wp_query;
        if(isset($custom_query)){}else{$custom_query = $wp_query;}
        $big = 999999999; // need an unlikely integer
        $pageing =  paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $custom_query->max_num_pages,
            'prev_text'    => __('Previous'),
            'next_text'    => __('Next'),
        ) );
        echo $pageing;
    } // pageing function
} // if


/********************************************************************************************************/
/*                                                                                                      */
/*   SOCIAL SHARE COUNTERS                                                                              */
/*                                                                                                      */
/********************************************************************************************************/

// Facebook Share Counter
function get_likes($url) {
    $get_link = wp_remote_get('http://graph.facebook.com/' . $url, array('timeout' => 60));
    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $facebook_count = json_decode($get_link['body'], true);
        if (!isset($facebook_count['shares']) or $facebook_count['shares'] == '') {
            return 0;
        } else {
            return $facebook_count['shares'];
        }
    }
}

// Twitter Share Counter
function get_tweets($url) {
    $get_link = wp_remote_get('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $twitter_count = json_decode($get_link['body'], true);
        return intval($twitter_count['count']);
    }
}

// Google plus Share Counter
function get_plusones($url) {
    $args = array(
        'method' => 'POST',
        'headers' => array(
            'Content-Type' => 'application/json'
        ),
        'timeout' => 30,
        'redirection' => 1,
        'body' => json_encode(array(
            'method' => 'pos.plusones.get',
            'id' => 'p',
            'method' => 'pos.plusones.get',
            'jsonrpc' => '2.0',
            'key' => 'p',
            'apiVersion' => 'v1',
            'params' => array(
                'nolog' => true,
                'id' => $url,
                'source' => 'widget',
                'userId' => '@viewer',
                'groupId' => '@self'
            )
        )),
        'sslverify' => false
    );

    $json_string = wp_remote_post("https://clients6.google.com/rpc", $args);

    if (is_wp_error($json_string)) {
        return "0";
    } else {
        $json = json_decode($json_string['body'], true);
        return intval($json['result']['metadata']['globalCounts']['count']);
    }
}

// Stumbleupon Share Counter
function get_stumbleupon($url) {

    $get_link = wp_remote_get('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url);
    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $stumbleupon_count = json_decode($get_link['body'], true);

        if(isset($stumbleupon_count['result']['views'])){
            if ($stumbleupon_count['result']['views'] == '') {
                return 0;
            } else {
                return intval($stumbleupon_count['result']['views']);
            }
        } else {
            return 0;
        }
    }
}

// Linkedin Share Counter
function get_linkedin($url) {
    $get_link = wp_remote_get('http://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json');
    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $linkedin_count = json_decode($get_link['body'], true);
        if ($linkedin_count['count'] == '') {
            return 0;
        } else {
            return intval($linkedin_count['count']);
        }
    }
}

// Pinterest Share Counter
function get_pinit($url) {
    $get_link = wp_remote_get('http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=' . $url);

    $temp_json = str_replace("receiveCount(", "", $get_link['body']);
    $temp_json = substr($temp_json, 0, -1);

    if (is_wp_error($get_link)) {
        return "0";
    } else {
        $pinit_count = json_decode($temp_json, true);
        if ($pinit_count['count'] == '') {
            return 0;
        } else {
            return intval($pinit_count['count']);
        }
    }
}

/* get twitter followers on home page */

function tk_get_twitter_followers() {

    $twitter_user = get_theme_option(tk_theme_name . '_social_twitter');

    $json = wp_remote_get('https://api.twitter.com/1/users/show.json?screen_name=' . $twitter_user . '&include_entities=true', array('timeout' => 60));

    if (is_wp_error($json)) {
        return "0.";
    } else {
        if (is_wp_error($json))
            return "0";
        $twitter_date = json_decode($json['body'], true);
        return intval($twitter_date['followers_count']);
    }
}

/* get facebook page likes on home page */

function tk_get_facebook_likes() {

    $facebook_user = get_theme_option(tk_theme_name . '_social_facebook');
    $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));

    if (is_wp_error($json)) {
        return "0.";
    } else {
        $json = wp_remote_get("http://graph.facebook.com/" . $facebook_user, array('timeout' => 30));
        if (is_wp_error($json))
            return "0";
        $fbData = json_decode($json['body'], true);
        return intval($fbData['likes']);
    }
}

/* get googe plus circled count */

function gplus_count() {
    $google_plus_count = '';

    $gplus_username = get_theme_option(tk_theme_name() . '_social_google_plus');
    $gplus_api = get_theme_option(tk_theme_name() . '_social_google_plus_api');

    $get_link = wp_remote_get("https://www.googleapis.com/plus/v1/people/" . $gplus_username . "?key=" . $gplus_api, array('timeout' => 30));

    if (is_wp_error($get_link)) {
        return "0.";
    } else {
        $google_plus_count = json_decode($get_link['body'], true);
        return intval($google_plus_count['plusOneCount']);
    }
}


/********************************************************************************************************/
/*                                                                                                      */
/*   Get thumbnail for gallery                                                                          */
/*                                                                                                      */
/********************************************************************************************************/

/*
 * $height -> height of new image
 * $width -> width of new image
 * $src -> url of image you want to get thumb from
 */
function tk_get_thumb($width, $height, $src)
{
    $size = getimagesize($src);
    if($width >= $size[0] || $height >= $size[1]){
        return $src;
    }else {
        if(strpos($src, '.jpg')){
            $new_src = explode('.jpg', $src);
            $new_src = $new_src[0].'-'.$width.'x'.$height.'.jpg';
            return $new_src;
        }elseif(strpos($src, '.jpeg')){
            $new_src = explode('.jpeg', $src);
            $new_src = $new_src[0].'-'.$width.'x'.$height.'.jpeg';
            return $new_src;
        }elseif(strpos($src, '.gif')){
            $new_src = explode('.gif', $src);
            $new_src = $new_src[0].'-'.$width.'x'.$height.'.gif';
            return $new_src;
        }elseif(strpos($src, '.png')){
            $new_src = explode('.png', $src);
            $new_src = $new_src[0].'-'.$width.'x'.$height.'.png';
            return $new_src;
        }
    }
}


/********************************************************************************************************/
/*                                                                                                      */
/*   Add Custom Fonts                                                                                   */
/*                                                                                                      */
/********************************************************************************************************/
add_action('admin_enqueue_scripts', 'tk_enqueue_google_fonts_in_admin');

if ( ! function_exists( 'tk_enqueue_google_fonts_in_admin' ) ) {
    function tk_enqueue_google_fonts_in_admin() {
        global $wpdb;
        $google_fonts =
            array(
                array('name' => "Select", 'variant' => ''),
                array('name' => "Cantarell", 'variant' => ':r,b,i,bi'),
                array('name' => "Cardo", 'variant' => ''),
                array('name' => "Crimson Text", 'variant' => ''),
                array('name' => "Droid Sans", 'variant' => ':r,b'),
                array('name' => "Droid Sans Mono", 'variant' => ''),
                array('name' => "Droid Serif", 'variant' => ':r,b,i,bi'),
                array('name' => "IM Fell DW Pica", 'variant' => ':r,i'),
                array('name' => "Inconsolata", 'variant' => ''),
                array('name' => "Josefin Sans", 'variant' => ':400,400italic,700,700italic'),
                array('name' => "Josefin Slab", 'variant' => ':r,b,i,bi'),
                array('name' => "Lobster", 'variant' => ''),
                array('name' => "Molengo", 'variant' => ''),
                array('name' => "Nobile", 'variant' => ':r,b,i,bi'),
                array('name' => "OFL Sorts Mill Goudy TT", 'variant' => ':r,i'),
                array('name' => "Old Standard TT", 'variant' => ':r,b,i'),
                array('name' => "Reenie Beanie", 'variant' => ''),
                array('name' => "Tangerine", 'variant' => ':r,b'),
                array('name' => "Vollkorn", 'variant' => ':r,b'),
                array('name' => "Yanone Kaffeesatz", 'variant' => ':r,b'),
                array('name' => "Cuprum", 'variant' => ''),
                array('name' => "Neucha", 'variant' => ''),
                array('name' => "Neuton", 'variant' => ''),
                array('name' => "PT Sans", 'variant' => ':r,b,i,bi'),
                array('name' => "PT Sans Caption", 'variant' => ':r,b'),
                array('name' => "PT Sans Narrow", 'variant' => ':r,b'),
                array('name' => "Philosopher", 'variant' => ''),
                array('name' => "Allerta", 'variant' => ''),
                array('name' => "Allerta Stencil", 'variant' => ''),
                array('name' => "Arimo", 'variant' => ':r,b,i,bi'),
                array('name' => "Arvo", 'variant' => ':r,b,i,bi'),
                array('name' => "Bentham", 'variant' => ''),
                array('name' => "Coda", 'variant' => ':800'),
                array('name' => "Cousine", 'variant' => ''),
                array('name' => "Covered By Your Grace", 'variant' => ''),
                array('name' => "Geo", 'variant' => ''),
                array('name' => "Just Me Again Down Here", 'variant' => ''),
                array('name' => "Puritan", 'variant' => ':r,b,i,bi'),
                array('name' => "Raleway", 'variant' => ':100'),
                array('name' => "Tinos", 'variant' => ':r,b,i,bi'),
                array('name' => "UnifrakturCook", 'variant' => ':bold'),
                array('name' => "UnifrakturMaguntia", 'variant' => ''),
                array('name' => "Mountains of Christmas", 'variant' => ''),
                array('name' => "Lato", 'variant' => ':400,700,400italic'),
                array('name' => "Orbitron", 'variant' => ':r,b,i,bi'),
                array('name' => "Allan", 'variant' => ':bold'),
                array('name' => "Anonymous Pro", 'variant' => ':r,b,i,bi'),
                array('name' => "Copse", 'variant' => ''),
                array('name' => "Kenia", 'variant' => ''),
                array('name' => "Ubuntu", 'variant' => ':r,b,i,bi'),
                array('name' => "Vibur", 'variant' => ''),
                array('name' => "Sniglet", 'variant' => ':800'),
                array('name' => "Syncopate", 'variant' => ''),
                array('name' => "Cabin", 'variant' => ':400,400italic,700,700italic,'),
                array('name' => "Merriweather", 'variant' => ''),
                array('name' => "Maiden Orange", 'variant' => ''),
                array('name' => "Just Another Hand", 'variant' => ''),
                array('name' => "Kristi", 'variant' => ''),
                array('name' => "Corben", 'variant' => ':b'),
                array('name' => "Gruppo", 'variant' => ''),
                array('name' => "Buda", 'variant' => ':light'),
                array('name' => "Lekton", 'variant' => ''),
                array('name' => "Luckiest Guy", 'variant' => ''),
                array('name' => "Crushed", 'variant' => ''),
                array('name' => "Chewy", 'variant' => ''),
                array('name' => "Coming Soon", 'variant' => ''),
                array('name' => "Crafty Girls", 'variant' => ''),
                array('name' => "Fontdiner Swanky", 'variant' => ''),
                array('name' => "Permanent Marker", 'variant' => ''),
                array('name' => "Rock Salt", 'variant' => ''),
                array('name' => "Sunshiney", 'variant' => ''),
                array('name' => "Unkempt", 'variant' => ''),
                array('name' => "Calligraffitti", 'variant' => ''),
                array('name' => "Cherry Cream Soda", 'variant' => ''),
                array('name' => "Homemade Apple", 'variant' => ''),
                array('name' => "Irish Growler", 'variant' => ''),
                array('name' => "Kranky", 'variant' => ''),
                array('name' => "Schoolbell", 'variant' => ''),
                array('name' => "Slackey", 'variant' => ''),
                array('name' => "Walter Turncoat", 'variant' => ''),
                array('name' => "Radley", 'variant' => ''),
                array('name' => "Meddon", 'variant' => ''),
                array('name' => "Kreon", 'variant' => ':r,b'),
                array('name' => "Dancing Script", 'variant' => ''),
                array('name' => "Goudy Bookletter 1911", 'variant' => ''),
                array('name' => "PT Serif Caption", 'variant' => ':r,i'),
                array('name' => "PT Serif", 'variant' => ':r,b,i,bi'),
                array('name' => "Astloch", 'variant' => ':b'),
                array('name' => "Bevan", 'variant' => ''),
                array('name' => "Anton", 'variant' => ''),
                array('name' => "Expletus Sans", 'variant' => ':b'),
                array('name' => "VT323", 'variant' => ''),
                array('name' => "Pacifico", 'variant' => ''),
                array('name' => "Candal", 'variant' => ''),
                array('name' => "Architects Daughter", 'variant' => ''),
                array('name' => "Indie Flower", 'variant' => ''),
                array('name' => "League Script", 'variant' => ''),
                array('name' => "Quattrocento", 'variant' => ''),
                array('name' => "Amaranth", 'variant' => ''),
                array('name' => "Irish Grover", 'variant' => ''),
                array('name' => "Oswald", 'variant' => ':400,300,700'),
                array('name' => "EB Garamond", 'variant' => ''),
                array('name' => "Nova Round", 'variant' => ''),
                array('name' => "Nova Slim", 'variant' => ''),
                array('name' => "Nova Script", 'variant' => ''),
                array('name' => "Nova Cut", 'variant' => ''),
                array('name' => "Nova Mono", 'variant' => ''),
                array('name' => "Nova Oval", 'variant' => ''),
                array('name' => "Nova Flat", 'variant' => ''),
                array('name' => "Terminal Dosis Light", 'variant' => ''),
                array('name' => "Michroma", 'variant' => ''),
                array('name' => "Miltonian", 'variant' => ''),
                array('name' => "Miltonian Tattoo", 'variant' => ''),
                array('name' => "Annie Use Your Telescope", 'variant' => ''),
                array('name' => "Dawning of a New Day", 'variant' => ''),
                array('name' => "Sue Ellen Francisco", 'variant' => ''),
                array('name' => "Waiting for the Sunrise", 'variant' => ''),
                array('name' => "Special Elite", 'variant' => ''),
                array('name' => "Quattrocento Sans", 'variant' => ''),
                array('name' => "Smythe", 'variant' => ''),
                array('name' => "The Girl Next Door", 'variant' => ''),
                array('name' => "Aclonica", 'variant' => ''),
                array('name' => "News Cycle", 'variant' => ''),
                array('name' => "Damion", 'variant' => ''),
                array('name' => "Wallpoet", 'variant' => ''),
                array('name' => "Over the Rainbow", 'variant' => ''),
                array('name' => "MedievalSharp", 'variant' => ''),
                array('name' => "Six Caps", 'variant' => ''),
                array('name' => "Swanky and Moo Moo", 'variant' => ''),
                array('name' => "Bigshot One", 'variant' => ''),
                array('name' => "Francois One", 'variant' => ''),
                array('name' => "Sigmar One", 'variant' => ''),
                array('name' => "Carter One", 'variant' => ''),
                array('name' => "Holtwood One SC", 'variant' => ''),
                array('name' => "Paytone One", 'variant' => ''),
                array('name' => "Monofett", 'variant' => ''),
                array('name' => "Rokkitt", 'variant' => ':400,700'),
                array('name' => "Megrim", 'variant' => ''),
                array('name' => "Judson", 'variant' => ':r,ri,b'),
                array('name' => "Didact Gothic", 'variant' => ''),
                array('name' => "Play", 'variant' => ':r,b'),
                array('name' => "Ultra", 'variant' => ''),
                array('name' => "Metrophobic", 'variant' => ''),
                array('name' => "Mako", 'variant' => ''),
                array('name' => "Shanti", 'variant' => ''),
                array('name' => "Caudex", 'variant' => ':r,b,i,bi'),
                array('name' => "Jura", 'variant' => ''),
                array('name' => "Ruslan Display", 'variant' => ''),
                array('name' => "Brawler", 'variant' => ''),
                array('name' => "Nunito", 'variant' => ''),
                array('name' => "Wire One", 'variant' => ''),
                array('name' => "Podkova", 'variant' => ''),
                array('name' => "Muli", 'variant' => ''),
                array('name' => "Maven Pro", 'variant' => ':400,500,700'),
                array('name' => "Tenor Sans", 'variant' => ''),
                array('name' => "Limelight", 'variant' => ''),
                array('name' => "Playfair Display", 'variant' => ''),
                array('name' => "Artifika", 'variant' => ''),
                array('name' => "Lora", 'variant' => ''),
                array('name' => "Kameron", 'variant' => ':r,b'),
                array('name' => "Cedarville Cursive", 'variant' => ''),
                array('name' => "Zeyada", 'variant' => ''),
                array('name' => "La Belle Aurore", 'variant' => ''),
                array('name' => "Shadows Into Light", 'variant' => ''),
                array('name' => "Lobster Two", 'variant' => ':r,b,i,bi'),
                array('name' => "Nixie One", 'variant' => ''),
                array('name' => "Redressed", 'variant' => ''),
                array('name' => "Bangers", 'variant' => ''),
                array('name' => "Open Sans Condensed", 'variant' => ':300italic,400italic,700italic,400,300,700'),
                array('name' => "Open Sans", 'variant' => ':r,i,b,bi'),
                array('name' => "Varela", 'variant' => ''),
                array('name' => "Goblin One", 'variant' => ''),
                array('name' => "Asset", 'variant' => ''),
                array('name' => "Gravitas One", 'variant' => ''),
                array('name' => "Hammersmith One", 'variant' => ''),
                array('name' => "Stardos Stencil", 'variant' => ''),
                array('name' => "Love Ya Like A Sister", 'variant' => ''),
                array('name' => "Loved by the King", 'variant' => ''),
                array('name' => "Bowlby One SC", 'variant' => ''),
                array('name' => "Forum", 'variant' => ''),
                array('name' => "Patrick Hand", 'variant' => ''),
                array('name' => "Varela Round", 'variant' => ''),
                array('name' => "Yeseva One", 'variant' => ''),
                array('name' => "Give You Glory", 'variant' => ''),
                array('name' => "Modern Antiqua", 'variant' => ''),
                array('name' => "Bowlby One", 'variant' => ''),
                array('name' => "Tienne", 'variant' => ''),
                array('name' => "Istok Web", 'variant' => ':r,b,i,bi'),
                array('name' => "Yellowtail", 'variant' => ''),
                array('name' => "Pompiere", 'variant' => ''),
                array('name' => "Unna", 'variant' => ''),
                array('name' => "Rosario", 'variant' => ''),
                array('name' => "Leckerli One", 'variant' => ''),
                array('name' => "Snippet", 'variant' => ''),
                array('name' => "Ovo", 'variant' => ''),
                array('name' => "IM Fell English", 'variant' => ':r,i'),
                array('name' => "IM Fell English SC", 'variant' => ''),
                array('name' => "Gloria Hallelujah", 'variant' => ''),
                array('name' => "Kelly Slab", 'variant' => ''),
                array('name' => "Black Ops One", 'variant' => ''),
                array('name' => "Carme", 'variant' => ''),
                array('name' => "Aubrey", 'variant' => ''),
                array('name' => "Federo", 'variant' => ''),
                array('name' => "Delius", 'variant' => ''),
                array('name' => "Rochester", 'variant' => ''),
                array('name' => "Rationale", 'variant' => ''),
                array('name' => "Abel", 'variant' => ''),
                array('name' => "Marvel", 'variant' => ':r,b,i,bi'),
                array('name' => "Actor", 'variant' => ''),
                array('name' => "Delius Swash Caps", 'variant' => ''),
                array('name' => "Smokum", 'variant' => ''),
                array('name' => "Tulpen One", 'variant' => ''),
                array('name' => "Coustard", 'variant' => ':r,b'),
                array('name' => "Andika", 'variant' => ''),
                array('name' => "Alice", 'variant' => ''),
                array('name' => "Questrial", 'variant' => ''),
                array('name' => "Comfortaa", 'variant' => ':r,b'),
                array('name' => "Geostar", 'variant' => ''),
                array('name' => "Geostar Fill", 'variant' => ''),
                array('name' => "Volkhov", 'variant' => ''),
                array('name' => "Voltaire", 'variant' => ''),
                array('name' => "Montez", 'variant' => ''),
                array('name' => "Short Stack", 'variant' => ''),
                array('name' => "Vidaloka", 'variant' => ''),
                array('name' => "Aldrich", 'variant' => ''),
                array('name' => "Numans", 'variant' => ''),
                array('name' => "Days One", 'variant' => ''),
                array('name' => "Gentium Book Basic", 'variant' => ''),
                array('name' => "Monoton", 'variant' => ''),
                array('name' => "Alike", 'variant' => ''),
                array('name' => "Delius Unicase", 'variant' => ''),
                array('name' => "Abril Fatface", 'variant' => ''),
                array('name' => "Dorsa", 'variant' => ''),
                array('name' => "Antic", 'variant' => ''),
                array('name' => "Passero One", 'variant' => ''),
                array('name' => "Fanwood Text", 'variant' => ''),
                array('name' => "Prociono", 'variant' => ''),
                array('name' => "Merienda One", 'variant' => ''),
                array('name' => "Changa One", 'variant' => ''),
                array('name' => "Julee", 'variant' => ''),
                array('name' => "Prata", 'variant' => ''),
                array('name' => "Adamina", 'variant' => ''),
                array('name' => "Sorts Mill Goudy", 'variant' => ''),
                array('name' => "Terminal Dosis", 'variant' => ''),
                array('name' => "Sansita One", 'variant' => ''),
                array('name' => "Chivo", 'variant' => ''),
                array('name' => "Spinnaker", 'variant' => ''),
                array('name' => "Poller One", 'variant' => ''),
                array('name' => "Alike Angular", 'variant' => ''),
                array('name' => "Gochi Hand", 'variant' => ''),
                array('name' => "Poly", 'variant' => ''),
                array('name' => "Andada", 'variant' => ''),
                array('name' => "Federant", 'variant' => ''),
                array('name' => "Ubuntu Condensed", 'variant' => ''),
                array('name' => "Ubuntu Mono", 'variant' => ''),
                array('name' => "Sancreek", 'variant' => ''),
                array('name' => "Coda", 'variant' => ''),
                array('name' => "Rancho", 'variant' => ''),
                array('name' => "Satisfy", 'variant' => ''),
                array('name' => "Pinyon Script", 'variant' => ''),
                array('name' => "Vast Shadow", 'variant' => ''),
                array('name' => "Marck Script", 'variant' => ''),
                array('name' => "Salsa", 'variant' => ''),
                array('name' => "Amatic SC", 'variant' => ''),
                array('name' => "Quicksand", 'variant' => ''),
                array('name' => "Linden Hill", 'variant' => ''),
                array('name' => "Corben", 'variant' => ''),
                array('name' => "Creepster Caps", 'variant' => ''),
                array('name' => "Butcherman Caps", 'variant' => ''),
                array('name' => "Eater Caps", 'variant' => ''),
                array('name' => "Nosifer Caps", 'variant' => ''),
                array('name' => "Atomic Age", 'variant' => ''),
                array('name' => "Contrail One", 'variant' => ''),
                array('name' => "Jockey One", 'variant' => ''),
                array('name' => "Cabin Sketch", 'variant' => ':r,b'),
                array('name' => "Cabin Condensed", 'variant' => ':r,b'),
                array('name' => "Fjord One", 'variant' => ''),
                array('name' => "Rametto One", 'variant' => ''),
                array('name' => "Mate", 'variant' => ':r,i'),
                array('name' => "Mate SC", 'variant' => ''),
                array('name' => "Arapey", 'variant' => ':r,i'),
                array('name' => "Supermercado One", 'variant' => ''),
                array('name' => "Petrona", 'variant' => ''),
                array('name' => "Lancelot", 'variant' => ''),
                array('name' => "Convergence", 'variant' => ''),
                array('name' => "Cutive", 'variant' => ''),
                array('name' => "Karla", 'variant' => ':400,400italic,700,700italic'),
                array('name' => "Bitter", 'variant' => ':r,i,b'),
                array('name' => "Asap", 'variant' => ':400,700,400italic,700italic'),
                array('name' => "Bree Serif", 'variant' => '')
            );

        $font_count = 1;
        $font_output = '';
        $transh = 1;

        foreach ($google_fonts as $font) {
            $font_output .= $font['name'] . '' . $font['variant'] . '|';
            $font_count++;

            if ($font_count == 20) {
                tk_font_output_helper($font_output, 'google_font_' . $transh);
                $font_output = '';
                $font_count = 1;
                $transh++;
            }
        }
    } // function
} // if function exists



/********************************************************************************************************/
/*                                                                                                                                                          */
/*   Enque WordPress default color picker                                                                                            */
/*                                                                                                                                                          */
/********************************************************************************************************/

if ( ! function_exists( 'tk_enqueue_google_fonts_in_admin' ) ) {

    add_action( 'admin_enqueue_scripts', 'tk_enqueue_color_picker' );
    function tk_enqueue_color_picker( $hook_suffix ) {
        // first check that $hook_suffix is appropriate for your admin page
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
 }


if ( ! function_exists( 'tk_font_output_helper' ) ) {
    function tk_font_output_helper($output_font_string, $identifier) {
        wp_register_style($identifier, 'http://fonts.googleapis.com/css?family=' . $output_font_string);
        wp_enqueue_style($identifier);
    } // function
} // if
add_action('wp_enqueue_scripts', 'tk_enqueue_google_fonts');

if ( ! function_exists( 'tk_enqueue_google_fonts' ) ) {
    function tk_enqueue_google_fonts() {
        global $wpdb;

        $fonts = $wpdb->get_results("SELECT DISTINCT(option_value) FROM " . $wpdb->prefix . "options WHERE option_value LIKE 'tk_font_%'", ARRAY_A);
        $from_replaces = array('tk_font_', ' ');
        $to_replaces = array('', '+');
        $font_output = '';

        foreach ($fonts as $font) {
            $font_output .= str_replace($from_replaces, $to_replaces, $font['option_value']) . '|';
        }

        if(empty($font_output) || $font_output == 'Select|') {
            $font_output = 'Arvo';
        }

        wp_register_style('google_fonts', 'http://fonts.googleapis.com/css?family=' . $font_output);
        wp_enqueue_style('google_fonts');
    } // function
} // if

if ( ! function_exists( 'tk_get_font_name' ) ) {
    function tk_get_font_name($font_option) {
        $font_name = str_replace('tk_font_', '', $font_option);
        $font_name = str_replace(substr(strrchr($font_name, ":"), 0), '', $font_name);
        return $font_name;
    } // function
} // if


// Filter to add pagebuilder shortcode from post meta after regular content
if ( ! function_exists( 'add_post_content' ) ) {
    function add_post_content($content) {
        global $post;

        $tk_meta_builder = get_post_meta($post->ID, 'tk_page_builder_id', true);
        $content .= $tk_meta_builder;

        return $content;
    } // function
    add_filter('the_content', 'add_post_content');
} // if

// function to change from hex to rgb
if ( ! function_exists( 'tk_hex2rgb' ) ) {
    function tk_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    } // function
} // if

/********************************************************************************************************/
/*                                                                                                      */
/*   VIDEO PLAYER                                                                                       */
/*                                                                                                      */
/********************************************************************************************************/
function tk_video_player($url) {

    if (!empty($url)) {
        $key_str1 = 'youtube';
        $key_str2 = 'vimeo';

        $pos_youtube = strpos($url, $key_str1);
        $pos_vimeo = strpos($url, $key_str2);
        if (!empty($pos_youtube)) {
            $url = str_replace('watch?v=', '', $url);
            $url = explode('&', $url);
            $url = $url[0];
            $url = str_replace('http://www.youtube.com/', '', $url);
            ?>
            <div class="tk-video-holder tk-video-holder-youtube">
                <iframe src="http://www.youtube.com/embed/<?php echo $url; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
        <?php
        }
        if (!empty($pos_vimeo)) {
            $url = explode('.com/', $url);
            ?>

            <div class="tk-video-holder tk-video-holder-vimeo">
                <iframe src="http://player.vimeo.com/video/<?php echo $url[1]; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>
        <?php
        }
        if (empty($pos_vimeo) && empty($pos_youtube)) {

            echo "Video only allowes vimeo and youtube!";
        }
    }
}

/********************************************************************************************************/
/*                                                                                                      */
/*   AUDIO PLAYER                                                                                       */
/*                                                                                                      */
/********************************************************************************************************/
function tk_jplayer($postid) {
    $audio_link = get_post_meta($postid, 'tk_audio_link', true);
    ?>
    <script type="text/javascript">

        jQuery(document).ready(function(){

            if(jQuery().jPlayer) {
                jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
                    ready: function () {
                        jQuery(this).jPlayer("setMedia", {
                            mp3: "<?php echo $audio_link; ?>",
                            end: ""
                        });
                    },
                    swfPath: "<?php echo get_template_directory_uri(); ?>/script/player",
                    cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
                    supplied: "mp3, all",
                    swfPath: "<?php echo get_template_directory_uri() ?>/script/jplayer/js"
                });

            }
        });
    </script>
<?php
}

/********************************************************************************************************/
/*                                                                                                      */
/*   GET VIDEO IMAGE                                                                                    */
/*   $url of vimeo/youtube video                                                                        */
/*   $post_id ID from post                                                                              */
/*   $img_quality chose quality of image Quality attributes 1-small 2-medium 3-large                    */
/*                                                                                                      */
/********************************************************************************************************/
function get_video_image($url, $post_ID, $img_quality) {

    if (!empty($url)) {
        $key_str1 = 'youtube';
        $key_str2 = 'vimeo';

        $pos_youtube = strpos($url, $key_str1);
        $pos_vimeo = strpos($url, $key_str2);
        if (!empty($pos_youtube)) {
            $url = str_replace('watch?v=', '', $url);
            $url = explode('&', $url);
            $url = $url[0];
            $url = str_replace('http://www.youtube.com/', '', $url);
            if(empty($img_quality)){$img_quality = 2;}
            ?>
            <img src="http://img.youtube.com/vi/<?php echo $url; ?>/0.jpg" title="<?php echo get_the_title($post_ID) ?>" alt="<?php echo get_the_title($post_ID) ?>" />
        <?php
        }
        if (!empty($pos_vimeo)) {
            $url = explode('.com/', $url);
            $data = @file_get_contents("http://vimeo.com/api/v2/video/" . $url[1] . ".json");
            if ($data) {
                $data = file_get_contents("http://vimeo.com/api/v2/video/" . $url[1] . ".json");
            } else {
                curl_setopt($ch = curl_init(), CURLOPT_URL, "http://vimeo.com/api/v2/video/" . $url[1] . ".json");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $response = curl_exec($ch);
                curl_close($ch);
                $data = $response;
            }
            $data = json_decode($data);
            ?>
            <img src="<?php echo $data[0]->thumbnail_large; ?>" title="<?php echo get_the_title($post_ID) ?>" alt="<?php echo get_the_title($post_ID) ?>" />
        <?php
        }
        if (empty($pos_vimeo) && empty($pos_youtube)) {

            echo "Video only allowes vimeo and youtube!";
        }
    }
}

/********************************************************************************************************/
/*                                                                                                      */
/*   GET SIDEBAR                                                                                        */
/*                                                                                                      */
/********************************************************************************************************/
function tk_get_sidebar($sidebar_position, $sidebar_name) {
    if ($sidebar_position == 'Right') {
        $sidebar_option = get_theme_option(wp_get_theme()->Name . '_general_custom_sidebars');
        if ($sidebar_option !== 'yes') { ?>            
            <div class="left span12">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                <?php endif; ?>
            </div><!--/#sidebar-->
        <?php
        }
    }elseif($sidebar_position == 'Left'){
        $sidebar_option = get_theme_option(wp_get_theme()->Name . '_general_custom_sidebars');?>
            <div class="left span12">
                <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar_name)) : ?>
                <?php endif; ?>
            </div><!--/#sidebar-->
        <?php        
    }
}


/********************************************************************************************************/
/*                                                                                                      */
/*   GALLERY FANCYBOX FILTER                                                                            */
/*                                                                                                      */
/********************************************************************************************************/
add_filter('wp_get_attachment_link', 'add_lighbox_rel');

function add_lighbox_rel($attachment_link) {
    if (strpos($attachment_link, 'a href') != false){
        $attachment_link = str_replace('a href', 'a class="fancybox" href', $attachment_link);
    }
    return $attachment_link;
}

/********************************************************************************************************/
/*                                                                                                      */
/*   Advertising Functions And Database                                                                 */
/*                                                                                                      */
/********************************************************************************************************/

add_action("switch_theme", "tk_create_tables"); //theme switch action
function tk_create_tables() {
    global $wpdb;

    /*
     * Create first table: user_rating
     */
    $table_name1 = $wpdb->prefix . "banner_stats";

    if ($wpdb->get_var("show tables like '$table_name1'") !== $table_name1) {
        $sql = "CREATE TABLE " . $table_name1 . " (
                stat_id bigint(20) NOT NULL AUTO_INCREMENT,
                banner_id bigint(20) NOT NULL,
                date date NOT NULL,
                clicks bigint(20) NOT NULL,
                views bigint(20) NOT NULL,
                PRIMARY KEY (stat_id),
                KEY banner_id (banner_id));";
        require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
        dbDelta($sql);
    }
}

function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if (empty($first_img)) { //Defines a default image
        $first_img = "/images/default.jpg";
    }
    return $first_img;
}

add_action('init', 'tk_check_for_banner_redirection', 0); //Awaiting for banner click redirections
add_action('init', 'tk_check_for_banner_stats', 0);

function tk_check_for_banner_stats() {
    global $wpdb;

    if (isset($_GET['banner_stat_id'])) {
        $banner_id = $_GET['banner_stat_id'];
        $period = $_GET['period'];
        $today = date("Y-m-d");
        $date = '';
        if ($period == 0) {
            $date = '2011-01-01';
        }

        if ($period == 7) {

            $date = strtotime(date("Y", strtotime($today)) . " -7 days");
            $date = date('Y-m-d', $date);
        }
        if ($period == 30) {
            $date = strtotime(date("Y", strtotime($today)) . " -30 days");
            $date = date('Y-m-d', $date);
        }
        if ($period == 365) {
            $date = strtotime(date("Y", strtotime($today)) . " -365 days");
            $date = date('Y-m-d', $date);
        }

        $pageposts = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "banner_stats WHERE banner_id = %d AND date BETWEEN '" . $date . "' AND '" . $today . "' ORDER BY date ASC", $banner_id), OBJECT);
        $views = '';
        $clicks = '';

        if (isset($_GET['data_type']) and $_GET['data_type'] == 'views') {
            foreach ($pageposts as $post) {
                $views .= "[" . (strtotime($post->date) * 1000) . "," . $post->views . "],";
            }
            $views = str_replace('],]', ']]', '[' . $views . ']');
            echo $views;
        }

        if (isset($_GET['data_type']) and $_GET['data_type'] == 'clicks') {
            foreach ($pageposts as $post) {
                $clicks .= "[" . (strtotime($post->date) * 1000) . "," . $post->clicks . "],";
            }
            $clicks = str_replace('],]', ']]', '[' . $clicks . ']');
            echo $clicks;
        }

        exit;
    }
}

function tk_check_for_banner_redirection() {//Save click for the banner and redirect to the banner URL
    if (isset($_GET['banner_id'])) {
        global $wpdb;
        tk_add_banner_click($_GET['banner_id']);
    }
}

function tk_add_banner_view($banner_id) {
    global $wpdb;
    global $post;
    if (!is_admin()) {
        $todays_date = date('Y-m-d');
        $insert_query = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "banner_stats SET views = (views + 1) WHERE banner_id = %d AND date = '" . $todays_date . "'", $banner_id));
        if (!$insert_query) {
            $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "banner_stats (banner_id, date, clicks, views) VALUES(%d, '" . $todays_date . "', 0, 1)", $banner_id));
        }
    }
}

function tk_add_banner_click($banner_id) {
    global $wpdb;
    $todays_date = date('Y-m-d');
    $insert_query = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "banner_stats SET clicks = (clicks + 1) WHERE banner_id = %d AND date = '" . $todays_date . "'", $banner_id));
    if (!$insert_query) {
        $wpdb->query($wpdb->prepare("INSERT INTO " . $wpdb->prefix . "banner_stats (banner_id, date, clicks, views) VALUES(%d, '" . $todays_date . "', 1, 0)", $banner_id));
    }
    wp_redirect(get_post_meta($banner_id, 'tk_advertisement_link', true));
    exit;
}

/********************************************************************************************************/
/*                                                                                                      */
/*   TWITTER SCRIPT                                                                                     */
/*                                                                                                      */
/********************************************************************************************************/
//gets twitter relative time
function twitter_time($get_twitter_time) {

    $base = strtotime("now");
    //get timestamp when tweet created
    $tweet_time = strtotime($get_twitter_time);
    //get difference
    $time_result = $base - $tweet_time;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;
    if(is_numeric($time_result) && $time_result > 0) {
        //if less then 3 seconds
        if($time_result < 3) return "right now";
        //if less then minute
        if($time_result < $minute) return floor($time_result) . " seconds ago";
        //if less then 2 minutes
        if($time_result < $minute * 2) return "about 1 minute ago";
        //if less then hour
        if($time_result < $hour) return floor($time_result / $minute) . " minutes ago";
        //if less then 2 hours
        if($time_result < $hour * 2) return "about 1 hour ago";
        //if less then day
        if($time_result < $day) return floor($time_result / $hour) . " hours ago";
        //if more then day, but less then 2 days
        if($time_result > $day && $time_result < $day * 2) return "yesterday";
        //if less then year
        if($time_result < $day * 365) return floor($time_result / $day) . " days ago";
        //else return more than a year
        return "over a year ago"; }
}

function twitter_script($unique_id, $limit) {

    require_once(get_template_directory().'/script/twitter/TwitterAPIExchange.php');

    /*GET TWITTER KEYS FROM ADMINISTRATION*/
    $twitter_consumer_key = get_theme_option(wp_get_theme()->name.'_social_twitter_consumer_key');
    $twitter_consumer_secret = get_theme_option(wp_get_theme()->name.'_social_twitter_consumer_secret');
    $twitter_access_token = get_theme_option(wp_get_theme()->name.'_social_twitter_access_token');
    $twitter_token_secret = get_theme_option(wp_get_theme()->name.'_social_twitter_token_secret');
    $twitter_username = get_theme_option(wp_get_theme()->name.'_social_twitter');


    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => $twitter_access_token,
        'oauth_access_token_secret' => $twitter_token_secret,
        'consumer_key' => $twitter_consumer_key,
        'consumer_secret' => $twitter_consumer_secret
    );

    /** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name='.$twitter_username;

    if(!empty($unique_id)) {
        $getfield .= "&count=".$limit;
    } else {
        $getfield .= "&count=1";
    }

    $requestMethod = 'GET';

    /** Perform the request and echo the response **/
    $twitter = new TwitterAPIExchange($settings);
    $twitter_results = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

    if($unique_id !== 'home') { ?>
        <ul class="twitter_ul">
    <?php }

    foreach($twitter_results as $single_tweet) {

        if(!empty($single_tweet->text)){
            //gets twitter content, time and name
            $twitter_status = $single_tweet->text;
            $twitter_time = $single_tweet->created_at;
            $twitter_name = $single_tweet->user->screen_name;

            $twitter_status = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\">\\2</a>", $twitter_status);
            $twitter_status = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\">\\2</a>", $twitter_status);
            $twitter_status = preg_replace("/@(\w+)/", "<a href=\"http://twitter.com/\\1\">@\\1</a>", $twitter_status);
            $twitter_status = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $twitter_status);

            //checks if it's single tweet on home or twitter widget
            if($unique_id == 'home'){
                ?>


                <section>
                    <div class="row-fluid">
                        <img src="<?php echo get_template_directory_uri(); ?>/style/images/shadow-divider.png" class="shadow_divider" />
                    </div>
                    <div class="container">
                        <div class="row-fluid twitter_wrap">
                            <div class="span9"><img class="twitter_img pull-left" src="<?php echo get_template_directory_uri(); ?>/style/images/twitter.png" /><p><?php echo $twitter_status; ?></p></div>
                            <div class="span3 twitter_author"><a href="https://twitter.com/<?php echo $twitter_name; ?>" target="_blank"><?php echo '@' . $twitter_name; ?></a></div>
                        </div>
                    </div>
                </section>


                <?php //use this if it's twitter widget

            } else { ?>

                <li>
                    <div class="box-twitter-center left">
                        <span><?php echo $twitter_status; ?></span>
                    </div>
                    <span class="twitter-links"><?php echo twitter_time($twitter_time); ?></span>
                    <div class="clear"></div>
                </li>

            <?php } //$unique_id == 'home' ?>
        <?php } //$single_tweet->text ?>
    <?php } ?>

    <?php if($unique_id !== 'home') { ?>
        </ul>
    <?php } ?>

<?php
}

/********************************************************************************************************/
/*                                                                                                      */
/*   TGM Plugin activation for some plugins                                                             */
/*                                                                                                      */
/********************************************************************************************************/
require_once get_template_directory() . '/functions/class-tgm-plugin-activation.php';

if ( ! function_exists( 'register_slider_plugin' ) ) {
    add_action( 'tgmpa_register', 'register_slider_plugin' );
    function register_slider_plugin() {

        $plugins = array(
            array(
                'name'     				=> __('ThemesKingdom Shortcodes', 'tkingdom'), // The plugin name
                'slug'     				=> 'shortcodes', // The plugin slug (typically the folder name)
                'source'   				=> get_template_directory() . '/functions/plugins/shortcodes.zip', // The plugin source
                'required' 				=> false, // If false, the plugin is onl    y 'recommended' instead of required
                'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'     				=> __('Aqua Page Builder', 'tkingdom'), // The plugin name
                'slug'     				=> 'aq-page-builder', // The plugin slug (typically the folder name)
                'source'   				=> get_template_directory() . '/functions/plugins/aq-page-builder.zip', // The plugin source
                'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
                'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => 'Revolutions Slider', // The plugin name
                'slug'                  => 'revslider', // The plugin slug (typically the folder name)
                'source'   				=> get_template_directory() . '/functions/plugins/revslider.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
        );
        $config = array(
            'domain'       		=> 'tkingdom',         	        // Text domain - likely want to be the same as your theme.
            'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
            'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
            'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
            'menu'         		=> 'install-required-plugins', 	// Menu slug
            'has_notices'      	=> true,                       	// Show admin notices or not
            'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
            'message' 			=> '',							// Message to output right before the plugins table
            'strings'      		=> array(
                'page_title'                       			=> __( 'Install Required Plugins', 'tkingdom' ),
                'menu_title'                       			=> __( 'Install Plugins', 'tkingdom' ),
                'installing'                       			=> __( 'Installing Plugin: %s', 'tkingdom' ), // %1$s = plugin name
                'oops'                             			=> __( 'Something went wrong with the plugin API.', 'tkingdom' ),
                'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
                'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
                'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
                'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
                'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
                'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
                'return'                           			=> __( 'Return to Required Plugins Installer', 'tkingdom' ),
                'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'tkingdom' ),
                'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'tkingdom' ), // %1$s = dashboard link
                'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );
        tgmpa( $plugins, $config );
    } // function
} // if



/********************************************************************************************************/
/*                                                                                                      */
/*   Breadcrumbs Function                                                                               */
/*                                                                                                      */
/********************************************************************************************************/
function dimox_breadcrumbs() {

    $delimiter = '<span class="bread-bullet"> &bull; </span> ';
    $home = 'Home'; // text for the 'Home' link
    $before = '<li class="active">'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb

    if ( !is_home() && !is_front_page() || is_paged() ) {

        echo '<ul class="breadcrumb">';

        global $post;
        $homeLink = home_url();
        echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';

        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(is_wp_error( $cat_parents = get_category_parents($cat, TRUE, '' . $delimiter . '') ) ? '' : $cat_parents );
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                
                $tk_post_type = get_post_type();
               
                //checks to see what template does it use
                if($tk_post_type == 'services') {
                    
                    //checks to see if it's services template
                    $causes_page_id = get_option('id_services_page');                    
                    if(!empty($causes_page_id)){
                        echo '<a href="' . get_permalink($causes_page_id) . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                    } else {
                        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                    }         
                    
                } elseif($tk_post_type == 'events') {
                    
                    //checks to see if it's events template
                    $events_page_id = get_option('id_events_page');                    
                    if(!empty($events_page_id)){
                        echo '<a href="' . get_permalink($events_page_id) . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                    } else {
                        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                    }               
                    
                } elseif($tk_post_type == 'team-members') {
                    
                    //checks to see if it's team page
                    $team_page_id = get_option('id_team_page');                    
                    if(!empty($team_page_id)){
                        echo '<a href="' . get_permalink($team_page_id) . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                    } else {
                        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                    }        
                    
                } else {
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                }               
                echo $before . get_the_title() . $after;
                
            } else {
                
                $cat = get_the_category(); $cat = $cat[0];                
                $get_blog_id = get_option('id_blog_page');                
                if(!empty($get_blog_id)){
                    echo '<a href="'.  get_permalink($get_blog_id). '">' . get_the_title($get_blog_id) . '</a> ' . $delimiter . ' ';
                } else {
                    //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    echo is_wp_error( $cat_parents = get_category_parents($cat, TRUE, '' . $delimiter . '') ) ? '' : $cat_parents; 
                }                
                echo $before . get_the_title() . $after;
                
            }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];


            echo is_wp_error( $cat_parents = get_category_parents($cat, TRUE, '' . $delimiter . '') ) ? '' : $cat_parents; 
            //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {
            echo $before . get_the_title() . $after;


        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;

            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;

        } elseif ( is_tag() ) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;

        } elseif ( is_404() ) {
            echo $before . 'Error 404' . $after;
        }

        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo $delimiter .$before . __('Page') . ' ' . get_query_var('paged'). $after;
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</ul>';

    }
} // end dimox_breadcrumbs()





/********************************************************************************************************/
/*                                                                                                      */
/*   Saving ID and NAME from template                                                                   */
/*                                                                                                      */
/********************************************************************************************************/

// Blog Template
add_action ( 'publish_page', 'saveBlogId' );
function saveBlogId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );

    if($template_name == "templates/template_blog.php") {
        update_option('id_blog_page',$post_ID);
        update_option('title_blog_page',$the_title);
    }

    $oldblog = get_option('id_blog_page');
    if($post_ID == $oldblog) {
        if($template_name <> "templates/template_blog.php") {
            update_option('id_blog_page','');
        }
    }
}

// Team Template
add_action ( 'publish_page', 'saveTeamId' );
function saveTeamId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );

    if($template_name == "templates/template_team.php") {
            update_option('id_team_page',$post_ID);
        update_option('title_team_page',$the_title);
    }

    $oldteam = get_option('id_team_page');
    if($post_ID == $oldteam) {
        if($template_name <> "templates/template_team.php") {
            update_option('id_team_page','');
        }
    }
}
// Services Template
add_action ( 'publish_page', 'saveServicesId' );
function saveServicesId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );

    if($template_name == "templates/template_services.php") {
        update_option('id_services_page',$post_ID);
        update_option('title_services_page',$the_title);
    }

    $oldservices = get_option('id_services_page');
    if($post_ID == $oldservices) {
        if($template_name <> "templates/template_services.php") {
            update_option('id_services_page','');
        }
    }
}
// Events Template
add_action ( 'publish_page', 'saveEventsId' );
function saveEventsId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );

    if($template_name == "templates/template_events.php") {
        update_option('id_events_page',$post_ID);
        update_option('title_events_page',$the_title);
    }

    $oldevents = get_option('id_events_page');
    if($post_ID == $oldevents) {
        if($template_name <> "templates/template_events.php") {
            update_option('id_events_page','');
        }
    }
}
// Gallery Template
add_action ( 'publish_page', 'saveGalleryId' );
function saveGalleryId($post_ID) {
    global $wp_query;
    $the_title =  get_the_title($post_ID);
    $template_name = get_post_meta( $post_ID, '_wp_page_template', true );

    if($template_name == "templates/template_gallery.php") {
        update_option('id_gallery_page',$post_ID);
        update_option('title_gallery_page',$the_title);
    }

    $oldgallery = get_option('id_gallery_page');
    if($post_ID == $oldgallery) {
        if($template_name <> "templates/template_gallery.php") {
            update_option('id_gallery_page','');
        }
    }
}

/*************************************************************/
/************EXCERPT LENGTH*******************************/
/************************************************************/

    function the_excerpt_length($charlength) {
            $excerpt = get_the_excerpt();
            $charlength++;

            if ( strlen( $excerpt ) > $charlength ) {
                    $subex = substr( $excerpt, 0, $charlength - 5 );
                    $exwords = explode( ' ', $subex );
                    $excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
                    if ( $excut < 0 ) {
                            echo substr( $subex, 0, $excut );
                    } else {
                            echo $subex;
                    }
                    echo '...';
            } else {
                    echo $excerpt;
            }
    }
    
    
/*************************************************************/
/*******   LOAD FUNCTION FOR COLOR CHANGE  **********/
/*************************************************************/

function tk_change_color() {
    get_template_part('/functions/change-colors');
}
add_action('wp_head', 'tk_change_color', '99');

?>