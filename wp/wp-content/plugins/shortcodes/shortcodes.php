<?php
/************************************************************/
/*                                                          */
/*   Functions for adding shortcodes                        */
/*                                                          */
/************************************************************/

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

/************************************************************/
/*                                                          */
/*   Insert required row div to work with columns           */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_row' ) ) {
    function tk_shortcode_row($atts, $content = null) {
        extract(shortcode_atts(array(
            'position' => '',
        ), $atts));

        return '<div class="row">' . do_shortcode($content) . '</div>';
    }
    add_shortcode('row', 'tk_shortcode_row');
} // if

/************************************************************/
/*                                                          */
/*   Enable <hr> tag for WP TinyMCE                         */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_enable_more_buttons' ) ) {
    function tk_enable_more_buttons($buttons) {
        $buttons[] = 'hr';
        return $buttons;
    }
    add_filter("mce_buttons", "tk_enable_more_buttons");
} // if

/************************************************************/
/*                                                          */
/*   Insert One Half Column Shortcode                       */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_one_half' ) ) {
    function tk_shortcode_one_half( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'position'     	 => '',
        ), $atts));
        return '<div class="col-xs-6"><p>' . do_shortcode($content) . '</p></div>';
    }
    add_shortcode('one_half', 'tk_shortcode_one_half');
} // if

/************************************************************/
/*                                                          */
/*   Insert One Third Column Shortcode                      */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_one_third' ) ) {
    function tk_shortcode_one_third( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'position'     	 => '',
        ), $atts));

        return '<div class="col-xs-4"><p>' . do_shortcode($content) . '</p></div>';
    }
    add_shortcode('one_third', 'tk_shortcode_one_third');
} // if

/************************************************************/
/*                                                          */
/*   Insert One Fourth Column Shortcode                     */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_one_fourth' ) ) {
    function tk_shortcode_one_fourth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'position'     	 => '',
        ), $atts));
        return '<div class="col-xs-3"><p>' . do_shortcode($content) . '</p></div>';
    }
    add_shortcode('one_fourth', 'tk_shortcode_one_fourth');
} // if

/************************************************************/
/*                                                          */
/*   Insert One Sixth Column Shortcode                      */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_one_sixth' ) ) {
    function tk_shortcode_one_sixth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'position'     	 => '',
        ), $atts));
        return '<div class="col-xs-2"><p>' . do_shortcode($content) . '</p></div>';
    }
    add_shortcode('one_sixth', 'tk_shortcode_one_sixth');
}

/************************************************************/
/*                                                          */
/*    Fullwidth section         */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_fullwidth_section' ) ) {
    function tk_fullwidth_section( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'bgcolor'     	 => '',        
            'pattern'     	 => '',        
            'repeat'     	 => '',        
        ), $atts));        
        
        //gets background image and passes it into css
        if(!empty($pattern)) {
            $background_image = 'background-image: url('.$pattern.');';
        }  else {
            $background_image = '';
        }      
        
        //gets background repeat and passes it into css
        if(!empty($repeat)) {
            $background_position = 'background-repeat:'.$repeat.';';            
        } else {
            $background_position = '';
        }
        
        //gets background color and passes it into css
        if(!empty($bgcolor)) {
            $fullwidth_stlye = 'background-color:'.$bgcolor.';';
        } else {
            $fullwidth_stlye = '';
        }
        
        return '<div style="'.$background_image.' '.$background_position.' '.$fullwidth_stlye.' background-position: center;" class="shortcodes-fullwidth"><p>' . do_shortcode($content) . '</p></div>';
    }
    add_shortcode('fullwidth', 'tk_fullwidth_section');
} // if

/************************************************************/
/*                                                          */
/*   Insert Button Shortcode                                */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_button' ) ) {
    function tk_shortcode_button( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'url'     	 => '#',
            'button_style'   => '',
            'new_tab'   => '',
            'button_size'   => ''
        ), $atts));
        return '<a href="'.$url.'" class="btn '.$button_style.' '.$button_size.'" target="'.$new_tab.'">' . do_shortcode($content) . '</a>';
    }
    add_shortcode('button', 'tk_shortcode_button');
} // if

/************************************************************/
/*                                                          */
/*   Insert Progress Bar Shortcode                          */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_progress_bar' ) ) {
    function tk_shortcode_progress_bar( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'style'     	 => '#',
            'bar_percentage'   => ''
        ), $atts));
        return '
        <div class="block">
            <p>' . do_shortcode($content) . '</p>
            <div class="progress progress-striped active">
                <div class="bar" style="width: '.$bar_percentage.'%;"></div>
            </div>
        </div>';
    }
    add_shortcode('progressbar', 'tk_shortcode_progress_bar');
} // if


/************************************************************/
/*                                                          */
/*   Insert Icon Shortcode                          */
/*                                                          */
/************************************************************/

if ( !function_exists('tk_shortcode_icon') ) {
function tk_shortcode_icon($atts, $content = null) {
	extract(shortcode_atts(array(
                      'size' => 'large', 
                      'image' => 'icon-circle',
                      'url' => ''
                  ), $atts)); 
	
	if($size == 'extra-large') {
		$size_class = 'fa-5x';
	} 
	else if($size == 'large') {
		$size_class = 'fa-4x';
	}
	else if($size == 'medium') {
		$size_class = 'fa-3x';
	}
	else if($size == 'small') {
		$size_class = 'fa-2x';
	}
	else if($size == 'extra-small') {
		$size_class = 'fa-lg';
	}
	else {
		$size_class = ''; 
	}
	
                 
	($size == 'large') ? $border = '<i class="circle-border"></i>' : $border = ''; 
        if($url !="") { 
            return '<a class="icon-link" href=" '. $url . ' "><i class="'. $size_class . ' ' . $image . '">' . $border . '</i></a>'; 
        } else {
            return '<i class="'. $size_class . ' ' . $image . '">' . $border . '</i>';
        }
}
add_shortcode('icon', 'tk_shortcode_icon');
} //if

/************************************************************/
/*                                                          */
/*   Insert Toggle Shortcode                                */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_toggle' ) ) {
    function tk_shortcode_toggle( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title'   => 'Title',
            'bgcolor'   => '',
            'textcolor'   => '',
            'bordercolor'   => '',
            'opacity'   => '',
        ), $atts));
        $bg_color_rgb = tk_hex2rgb($bgcolor);
        $tk_opacity = $opacity/100;
        if($bordercolor != ''){$bordercolor = '1px solid '.$bordercolor;}
        return '
            <div class="tk_sc_block_toggle" style="border:'.$bordercolor.';background:transparent;">
                <h5 class="tab-head" style="background:rgba('.$bg_color_rgb[0].','.$bg_color_rgb[1].','.$bg_color_rgb[2].','.$tk_opacity.');color:'.$textcolor.';">'.$title.'</h5>
                <i class="icon-plus"></i>
                <i class="icon-minus"></i>
                <div class="tab-body close cf" style="background:rgba('.$bg_color_rgb[0].','.$bg_color_rgb[1].','.$bg_color_rgb[2].','.$tk_opacity.');">
                    <p style="color:'.$textcolor.';">'.do_shortcode($content).'</p>
                </div>
            </div>';
    }
    add_shortcode('toggle', 'tk_shortcode_toggle');
} // if

/************************************************************/
/*                                                          */
/*   Insert Tabbs Shortcode                                 */
/*                                                          */
/************************************************************/
class TK_Tabs_Shortcodes{
    private $bg_color_rgb, $tk_opacity, $tabs_textcolor, $tabs_bordercolor;

    function call_tk_tabs(){
        add_shortcode('tabs', array($this, 'tk_tabs'));
        add_shortcode('tab', array($this, 'tk_tabs_panes'));
    }

    function tk_tabs( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'tabs' => '',
            'tabs_bgcolor'   => '',
            'tabs_textcolor'   => '',
            'tabs_bordercolor'   => '',
            'tabs_opacity'   => '',
        ), $atts));
        $this->bg_color_rgb = tk_hex2rgb($tabs_bgcolor);
        if( $this->bg_color_rgb[0] == '' && $this->bg_color_rgb[1] == '' && $this->bg_color_rgb[2] == '') { $this->bg_color_rgb[0] = '#ffffff'; $this->bg_color_rgb[1] = '#ffffff'; $this->bg_color_rgb[2] = '#ffffff';}
        $this->tk_opacity = $tabs_opacity/100;
        if( $this->tk_opacity == '') { $this->tk_opacity = '100';}
        $this->tabs_textcolor = $tabs_textcolor;
        if($tabs_bordercolor != ''){$this->tabs_bordercolor = 'border: 1px solid '.$tabs_bordercolor;}
        $output = '';
        $output .= '<div class="block tk-shortcode-tabs"><ul class="nav nav-tabs tk_sc_block_tabs">';
        $tabs = trim($tabs, ",");
        $myTabs = explode(',', $tabs);
        $tab_counter = 1;
        foreach($myTabs as $tab) {
            if($tab_counter == 1){$echo_active = 'active';}else{$echo_active = '';}
            $create_href = sanitize_title($tab);
            $output .= '<li class="'.$echo_active.'"><a href="#' . $create_href . '" style="'.$this->tabs_bordercolor.';background:rgba('.$this->bg_color_rgb[0].','.$this->bg_color_rgb[1].','.$this->bg_color_rgb[2].','.$this->tk_opacity.');color:'.$this->tabs_textcolor.';"><h5 style="color:'.$this->tabs_textcolor.';">' . $tab . '</h5></a></li>';
            $tab_counter++;
        }
        $output .= '</ul>';
        $output .= '<div class="tab-content">';
        $myContent = do_shortcode($content);
        $output .= $myContent;
        $output .= '</div></div>';
        return $output;
    }

    // Insert panes for each tab title
    function tk_tabs_panes( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));
        $create_id = sanitize_title($title);
        $output = '<div id="' . $create_id . '" class="tab-pane" style="'.$this->tabs_bordercolor.';background:rgba('.$this->bg_color_rgb[0].','.$this->bg_color_rgb[1].','.$this->bg_color_rgb[2].','.$this->tk_opacity.');"><p style="color:'.$this->tabs_textcolor.';">' . do_shortcode($content) . '</p></div>';
        return $output;
    }
}
$tk_tabs_obj = new TK_Tabs_Shortcodes();
$tk_tabs_obj->call_tk_tabs();

/************************************************************/
/*                                                          */
/*   Insert Accordion Shortcode                             */
/*                                                          */
/************************************************************/
class TK_Accordion_Shortcodes{

    function call_tk_accordions(){
        add_shortcode('accordions', array($this, 'tk_accordion'));
        add_shortcode('accordion', array($this, 'tk_accordion_panes'));
    }

    function tk_accordion( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'accordions' => '',
            'tabs_bgcolor'   => '',
            'tabs_textcolor'   => '',
            'tabs_bordercolor'   => '',
            'tabs_opacity'   => '',
        ), $atts));
        $this->bg_color_rgb = tk_hex2rgb($tabs_bgcolor);
        $this->tk_opacity = $tabs_opacity/100;
        $this->tabs_textcolor = $tabs_textcolor;
        $this->tabs_bordercolor = $tabs_bordercolor;
        if($tabs_bordercolor != ''){$this->tabs_bordercolor = '1px solid '.$tabs_bordercolor;}else{$this->tabs_bordercolor = '1px solid #dfdfdf';}
        $output = '';
        $this->tk_unique_class = uniqid('tk_', false);
        $output .= '
        <style>
          

        </style>
        <div class="tk_sc_block_accordion_wrapper" style="background:rgba('.$this->bg_color_rgb[0].','.$this->bg_color_rgb[1].','.$this->bg_color_rgb[2].','.$this->tk_opacity.');">';
        $myContent = do_shortcode($content);
        $output .= $myContent;
        $output .= '</div>';
        return $output;
    }

    // Insert panes for each tab title
    function tk_accordion_panes( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title' => ''
        ), $atts));
        $output = '
            <div class="tk_sc_block_accordion '.$this->tk_unique_class.'" style="background:rgba('.$this->bg_color_rgb[0].','.$this->bg_color_rgb[1].','.$this->bg_color_rgb[2].','.$this->tk_opacity.');">
                <h5 class="tab-head" style="color:'.$this->tabs_textcolor.'; border-bottom: '.$this->tabs_bordercolor.'">'.$title.'</h5>
                <i class="icon-arrow-down"></i>
                <div class="tab-body cf" style="border-bottom:'.$this->tabs_bordercolor.';">
                    <p style="color:'.$this->tabs_textcolor.';">' . do_shortcode($content) . '</p>
                </div>
            </div>
            ';
        return $output;
    }
} // end class
$tk_accordion_obj = new TK_Accordion_Shortcodes();
$tk_accordion_obj->call_tk_accordions();

/************************************************************/
/*                                                          */
/*   Insert Price Table Shortcode                           */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcodes_price_table' ) ) {
    function tk_shortcodes_price_table($atts, $content = null) {
        extract(shortcode_atts(array(
                    'column' => '',
                    'title' => '',
                    'subtitle' => '',
                    'bgcolor' => '',
                    'textcolor' => '',
                    'usebutton' => '',
                    'url' => '',
                    'style' => '',
                    'buttontext' => ''
                        ), $atts));

        if ($usebutton == 'yes') {
            $button_output = '
                        <div class="color-buttons color-button-' . $style . ' pricing-button">
                            <h6><a class="price_btn" href="' . $url . '">' . $buttontext . '</a></h6>
                        </div>';
        } else {
            $button_output = '';
        }
        $output = '<div class="pricing-table-one ' . $column . '">
                        <div class="pricing-table-one-border">
                            <div class="pricing-table-one-top" style="background:' . $bgcolor . '">
                                <h4 style="color:' . $textcolor . '">' . $title . '</h4>
                                <p style="color:' . $textcolor . '">' . $subtitle . '</p>
                            </div>
                            ' . do_shortcode($content) . $button_output . '
                        </div>
                    </div>';


        return $output;
    }
}

add_shortcode('pricing', 'tk_shortcodes_price_table');

// One price for each price table
if ( ! function_exists( 'tk_shortcodes_one_price' ) ) {
        function tk_shortcodes_one_price( $atts, $content = null ) {
        extract(shortcode_atts(array(
                    'title' => '',
                    'url' => ''
                        ), $atts));

        $create_id = $title; //sanitize_title

        if ($url == '') {
            if (strlen($content) <= 3) {
                $output = '<div class="pricing-table-one-center pricing-table-white"><center><span>' . $create_id . '</span></center></div>';
            } else {
                $output = '<div class="pricing-table-one-center pricing-table-white"><span>' . $create_id . '</span><p>' . do_shortcode($content) . '</p></div>';
            }        
        } else {
            if (strlen($content) <= 3) {
                $output = '<div class="pricing-table-one-center pricing-table-white"><center><span><a href="' . $url . '">' . $create_id . '</a></span></center></div>';
            } else {
                $output = '<div class="pricing-table-one-center pricing-table-white"><span><a href="' . $url . '">' . $create_id . '</a></span><p><a href="' . $url . '">' . do_shortcode($content) . '</a></p></div>';
            }
        }

        return $output;
    }
}
add_shortcode('price', 'tk_shortcodes_one_price');

/************************************************************/
/*                                                          */
/*   Insert Infobox Shortcode                               */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_infobox' ) ) {
    function tk_shortcode_infobox( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'style'     	 => '',
        ), $atts));
        return '<div class="alert '.$style.' tk-infobox"><p>' . do_shortcode($content) . '</p></div>';
    }
    add_shortcode('infobox', 'tk_shortcode_infobox');
} // if

/************************************************************/
/*                                                          */
/*   Insert Dropcap Shortcode                               */
/*                                                          */
/************************************************************/
if ( ! function_exists( 'tk_shortcode_dropcap' ) ) {
    function tk_shortcode_dropcap( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'style'     	 => '',
        ), $atts));
        return '<span class="dropcap-'.$style.'">' . do_shortcode($content) . '</span>';
    }
    add_shortcode('dropcap', 'tk_shortcode_dropcap');
} // if
?>