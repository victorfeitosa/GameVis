<?php

require( '../../../../../wp-load.php' );

$shortcode = array(
    
    //BUTTON
    'button' => array(
        'params' => array(
            'url' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Button URL', tk_theme_name),
                'desc' => __('Add the button\'s url eg http://example.com', tk_theme_name),
                'options' => array(
                    'width' => '98px'
                )
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Button\'s Style', tk_theme_name),
                'desc' => __('Select the button\'s style, ie the buttons colour', tk_theme_name),
                'options' => array(
                    'yellow' => 'Yellow',
                    'black' => 'Black',
                    'blue' => 'Blue',
                    'red' => 'Red',
                    'green' => 'Green',
                    'grey' => 'Grey',
                    'brown' => 'Brown'
                )
            ),
            'content' => array(
                'std' => 'Button Text',
                'type' => 'text',
                'label' => __('Button\'s Text', tk_theme_name),
                'desc' => __('Add the button\'s text', tk_theme_name),
                'options' => array(
                    'width' => '98px'
                )
            )
        ),
        'shortcode' => '[button url="{{url}}" style="{{style}}"] {{content}} [/button]',
    ),
    
    // LIST
    'list' => array(
        'params' => array(
            'style' => array(
                'type' => 'select',
                'label' => __('Type of list', tk_theme_name),
                'desc' => __('Select the list type', tk_theme_name),
                'options' => array(
                    'list-img4' => 'Plus',
                    'list-img3' => 'Arrow',
                    'list-img5' => 'Heart',
                    'list-img1' => 'Check',
                    'list-img2' => 'Star'
                )
            ),
            'content' => array(
                'std' => 'List Text',
                'type' => 'textarea',
                'label' => __('List Text', tk_theme_name),
                'desc' => __('Add the list text', tk_theme_name),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            )
        ),
        'shortcode' => '[list style="{{style}}"] {{content}} [/list]',
    ),
    
    //COLUMNS
    'columns' => array(
        'params' => array(
            'column' => array(
                'type' => 'select',
                'label' => __('Column Type', tk_theme_name),
                'desc' => __('Select the type of the column.', tk_theme_name),
                'options' => array(
                    'one_half' => 'One Half',
                    'one_third' => 'One Third',
                    'one_fourth' => 'One Fourth',
                )
            ),
            'position' => array(
                'std' => 'last',
                'type' => 'select',
                'label' => __('Last Column', tk_theme_name),
                'desc' => __('Pick if column is last.', tk_theme_name),
                'options' => array(
                    '' => 'Regular Column',
                    'last' => 'Last Column',
                )
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('Column Content', tk_theme_name),
                'desc' => __('Add the column content.', tk_theme_name),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            ),
        ),
        'shortcode' => '[{{column}} position="{{position}}"] {{content}} [/{{column}}] ',
    ),
    
    //TOGGLE
    'toggle' => array(
        'params' => array(
            'title' => array(
                'type' => 'text',
                'label' => __('Toggle Title', tk_theme_name),
                'desc' => '',
                'std' => 'Title',
                'options' => array(
                    'width' => '100%'
                )
            ),
            'content' => array(
                'std' => 'Content',
                'type' => 'textarea',
                'label' => __('Toggle Content', tk_theme_name),
                'desc' => __('Add the toggle content.', tk_theme_name),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            ),
        'position' => array(
                'std' => 'open',
                'type' => 'select',
                'label' => __('Default Value', tk_theme_name),
                'desc' => __('Chose to show either open or closed toggle content.', tk_theme_name),
                'options' => array(
                    '' => 'Open Content',
                    'closed' => 'Closed Content',
                )
            )
        ),
        'shortcode' => '[toggle title="{{title}}" value="{{position}}"] {{content}} [/toggle]',
        'popup_title' => __('Insert Toggle Content Shortcode', tk_theme_name)
    ),

    //TABBED SHORTCODE
    'tabbed' => array(
        'params' => array(
            'title' => array(),
            'repeatable' => array(
                'type' => 'repeatable',
                'params' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Tabbed Title', tk_theme_name),
                        'desc' => '',
                        'std' => 'Title',
                        'options' => array(
                            'width' => '100%'
                        )
                    ),
                    'content' => array(
                        'std' => 'Content',
                        'type' => 'textarea',
                        'label' => __('Tabbed Content', tk_theme_name),
                        'desc' => __('Add the tabbed content.', tk_theme_name),
                        'options' => array(
                            'rows' => '10',
                            'width' => '100%'
                        )
                    ),
                ),
                'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
            )
        ),
        'shortcode' => '[tabs tabs="{{tabs}}"] {{child_shortcode}} [/tabs]',
        'popup_title' => __('Insert Tabbed Content Shortcode', tk_theme_name),
    ),

    // DROPCAP
    'dropcap' => array(
        'params' => array(
            'style' => array(
                'type' => 'select',
                'label' => __('Type of dropcap', tk_theme_name),
                'desc' => __('Select the dropcap type', tk_theme_name),
                'options' => array(
                    'background' => 'With Background',
                    'no-background' => 'Without Background'
                )
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('', tk_theme_name),
                'desc' => __('Insert starting letter to use as dropcap.', tk_theme_name),
                'options' => array(
                    'rows' => '1',
                    'width' => '10%'
                )
            )
        ),
        'shortcode' => '[dropcap style="{{style}}"] {{content}} [/dropcap]',
    ),

    // INFO BOX
    'infobox' => array(
        'params' => array(
            'bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', tk_theme_name),
                'desc' => __('', tk_theme_name),
                'value' => '',
            ),
            'textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', tk_theme_name),
                'desc' => __('', tk_theme_name),
                'value' => '',
            ),
            'content' => array(
                'std' => 'Insert yor text',
                'type' => 'textarea',
                'label' => __('Insert yor text', tk_theme_name),
                'desc' => __('Insert starting letter to use as dropcap.', tk_theme_name),
                'value' => '',
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            )
        ),
        'shortcode' => '[infobox bgcolor="{{bgcolor}}" textcolor="{{textcolor}}"] {{content}} [/infobox]',
    ),

    // CALL TO ACTION
    'calltoaction' => array(
        'params' => array(
            'usebutton' => array(
                'type' => 'select',
                'label' => __('Use Button', tk_theme_name),
                'desc' => __('Chose if you want to use Button inside Call To Action', tk_theme_name),
                'options' => array(
                    'yes' => 'Use Button',
                    'no' => 'Don\'t use Button',
                )
            ),
            'url' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Button URL', tk_theme_name),
                'desc' => __('Add the button\'s url eg http://example.com', tk_theme_name),
                'options' => array(
                    'width' => '98px'
                )
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Button\'s Style', tk_theme_name),
                'desc' => __('Select the button\'s style, ie the buttons color', tk_theme_name),
                'options' => array(
                    'yellow' => 'Yellow',
                    'black' => 'Black',
                    'blue' => 'Blue',
                    'red' => 'Red',
                    'green' => 'Green',
                    'grey' => 'Grey',
                    'brown' => 'Brown'
                )
            ),
            'buttontext' => array(
                'std' => 'Button Text',
                'type' => 'text',
                'label' => __('Button\'s Text', tk_theme_name),
                'desc' => __('Add the button\'s text', tk_theme_name),
                'options' => array(
                    'width' => '98px'
                )
            ),
            'content' => array(
                'std' => 'Call To Action Text',
                'type' => 'textarea',
                'label' => __('Call To Action Text', tk_theme_name),
                'desc' => __('Add Call To Action Text', tk_theme_name),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            )
        ),
        'shortcode' => '[calltoaction url="{{url}}" style="{{style}}" usebutton="{{usebutton}}" buttontext="{{buttontext}}"] {{content}} [/calltoaction]',
    ),

    //PRICETABLE SHORTCODE
    'pricing' => array(
        'params' => array(
            'column' => array(
                'type' => 'select',
                'label' => __('Column Type', tk_theme_name),
                'desc' => __('Select the type of the column.', tk_theme_name),
                'options' => array(
                    'full-width' => 'Full Width',
                    'half-width' => 'One Half',
                    'third-width' => 'One Third',
                    'pricing-table-quarter' => 'One Fourth',
                )
            ),
            'position' => array(
                'std' => 'last',
                'type' => 'select',
                'label' => __('Last Column', tk_theme_name),
                'desc' => __('Pick if column is last.', tk_theme_name),
                'options' => array(
                    '' => 'Regular Column',
                    'last' => 'Last Column',
                )
            ),
            'title' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Table Title', tk_theme_name),
                'desc' => __('Price table title.', tk_theme_name),
                'options' => array(
                    'width' => '100%'
                )
            ),
            'subtitle' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Table Subtitle', tk_theme_name),
                'desc' => __('Price table subtitle.', tk_theme_name),
                'options' => array(
                    'width' => '100%'
                )
            ),
            'bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', tk_theme_name),
                'desc' => __('', tk_theme_name),
            ),
            'textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', tk_theme_name),
                'desc' => __('', tk_theme_name),
            ),
            'usebutton' => array(
                'type' => 'select',
                'label' => __('Use Button', tk_theme_name),
                'desc' => __('Chose if you want to use Button inside Price Table', tk_theme_name),
                'options' => array(
                    'yes' => 'Use Button',
                    'no' => 'Don\'t use Button',
                )
            ),
            'url' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Button URL', tk_theme_name),
                'desc' => __('Add the button\'s url eg http://example.com', tk_theme_name),
                'options' => array(
                    'width' => '98px'
                )
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Button\'s Style', tk_theme_name),
                'desc' => __('Select the button\'s style, ie the buttons colour', tk_theme_name),
                'options' => array(
                    'yellow' => 'Yellow',
                    'black' => 'Black',
                    'blue' => 'Blue',
                    'red' => 'Red',
                    'green' => 'Green',
                    'grey' => 'Grey',
                    'brown' => 'Brown'
                )
            ),
            'buttontext' => array(
                'std' => 'Button Text',
                'type' => 'text',
                'label' => __('Button\'s Text', tk_theme_name),
                'desc' => __('Add the button\'s text', tk_theme_name),
                 'options' => array(
                    'width' => '98px'
                )
            ),
            'repeatable' => array(
                'type' => 'repeatable',
                'params' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Price Row Text', tk_theme_name),
                        'desc' => '',
                        'std' => '',
                        'options' => array(
                            'width' => '100%'
                        )
                    ),
                    'content' => array(
                        'std' => '',
                        'type' => 'text',
                        'label' => __('Price Row Price', tk_theme_name),
                        'desc' => __('Add the price to the element.', tk_theme_name),
                        'options' => array(
                            'rows' => '10',
                            'width' => '100%'
                        )
                    ),
                ),
                'shortcode' => '[price title="{{title}}"] {{content}} [/price]',
            )
        ),
        'shortcode' => '[pricing column="{{column}}" position="{{position}}" title="{{title}}" subtitle="{{subtitle}}" url="{{url}}" style="{{style}}" usebutton="{{usebutton}}" buttontext="{{buttontext}}" bgcolor="{{bgcolor}}" textcolor="{{textcolor}}"] {{child_shortcode}} [/pricing]',
        'popup_title' => __('Insert Tabbed Content Shortcode', tk_theme_name),

    ),

);

function create_shortcode($popup) {
    global $shortcode;

    if (isset($shortcode) && is_array($shortcode)) {
        $shortcode_param = $shortcode[$popup]['params'];
        $shortcode_code = $shortcode[$popup]['shortcode'];
        if(isset($shortcode[$popup]['params']['repeatable'])){
            $shortcode_repeatable = $shortcode[$popup]['params']['repeatable'];
        }


        $shortcode_output = print_shortcode("\n" . '<div id="old-shortcode" class="hidden">' . $shortcode_code . '</div>');
        $shortcode_output = print_shortcode("\n" . '<div id="shortcode-popup" class="hidden">' . $popup . '</div>');


        foreach ($shortcode_param as $key => $param) {
            $key = 'shortcode_' . $key;

            if(empty($param['label'])){$param['label'] = '';}
            if(empty($param['desc'])){$param['desc'] = '';}
            if(empty($param['type'])){$param['type'] = '';}

            $row_start = '<tbody style="display:inline-block;width:100%;">' . "\n";
            $row_start .= '<tr style="height:40px;">' . "\n";
            $row_start .= '<th class="label" style="vertical-align:top;width: 98px;padding-top:10px"><span class="alignleft">' . $param['label'] . '</span></th>' . "\n";
            $row_start .= '<td class="field">' . "\n";

            $row_end = '<span>' . $param['desc'] . '</span>' . "\n";
            $row_end .= '</td>' . "\n";
            $row_end .= '</tr>' . "\n";
            $row_end .= '</tbody>' . "\n";

            switch ($param['type']) {
                case 'text' :

                    if(!isset($param['options']['width'])){$param['options']['width'] = '98px';}

                    $output = $row_start;
                    $output .= '<input type="text" class="popup-input" style="width:'.$param['options']['width'].'" name="' . $key . '" id="' . $key . '" value="' . $param['std'] . '" />' . "\n";
                    $output .= $row_end;

                    print_shortcode($output);

                    break;

                case 'textarea' :
               
                    if(!isset($param['options']['rows'])){$param['options']['rows'] = '10';}
                    if(!isset($param['options']['width'])){$param['options']['width'] = '100%';}
                    
                    $output = $row_start;
                    $output .= '<textarea rows="'.$param['options']['rows'].'" style="width:'.$param['options']['width'].'" name="' . $key . '" id="' . $key . '" class="popup-input">' . $param['std'] . '</textarea>' . "\n";
                    $output .= $row_end;

                    print_shortcode($output);

                    break;

                case 'select' :

                    $output = $row_start;
                    $output .= '<select name="' . $key . '" id="' . $key . '" class="popup-input">' . "\n";

                    foreach ($param['options'] as $value => $option) {
                        $output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
                    }

                    $output .= '</select>' . "\n";
                    $output .= $row_end;

                    print_shortcode($output);

                    break;

                case 'colorpicker' :

                    $output = $row_start;
                    $output .= '<input id="' . $key . '" name="' . $key . '" type="text"  class="colorpicker popup-input" />' . "\n";

                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery( '#<?php echo $key;?>' ).wpColorPicker();
                        })
                    </script>
                    <?php
                    $output .= $row_end;

                    print_shortcode($output);

                    break;

                case 'repeatable' :

                    // set child shortcode
                    $repeatable_param = $shortcode_repeatable['params'];
                    $repeatable_shortcode = $shortcode_repeatable['shortcode'];

                    // popup parent form row start
                    $prow_start  = '<tbody>' . "\n";
                    $prow_start .= '<tr class="form-row has-child">' . "\n";
                    $prow_start .= '<td style="width:100%">' . "\n";
                    $prow_start .= '<div class="child-clone-rows">' . "\n";

                    // for js use
                    $prow_start .= '<div id="_tz_cshortcode" class="hidden">' . $repeatable_shortcode . '</div>' . "\n";

                    // start the default row
                    $prow_start .= '<div class="child-clone-row">' . "\n";
                    $prow_start .= '<ul class="child-clone-row-form">' . "\n";

                    // add $prow_start to output
                    print_shortcode($prow_start);

                    foreach( $repeatable_param as $one_row => $repeatable_key )
                    {

                        // popup form row start
                        $crow_start  = '<li class="child-clone-row-form-row">' . "\n";
                        $crow_start .= '<div class="child-clone-row-label">' . "\n";
                        $crow_start .= '<label>' . $repeatable_key['label'] . '</label>' . "\n";
                        $crow_start .= '</div>' . "\n";
                        $crow_start .= '<div class="child-clone-row-field">' . "\n";

                        // popup form row end
                        $crow_end	  = '<span class="child-clone-row-desc">' . $repeatable_key['desc'] . '</span>' . "\n";
                        $crow_end   .= '</div>' . "\n";
                        $crow_end   .= '</li>' . "\n";

                        switch( $repeatable_key['type'] )
                        {
                            case 'text' :

                                if(!isset($repeatable_key['options']['width'])){$repeatable_key['options']['width'] = '98px';}

                                $output = $crow_start;
                                $output .= '<input type="text" class="repeated-popup-input tz-cinput" style="width:'.$repeatable_key['options']['width'].'" name="' . $one_row . '" id="' . $one_row . '" value="' . $repeatable_key['std'] . '" />' . "\n";
                                $output .= $crow_end;

                                print_shortcode($output);

                                break;

                            case 'textarea' :

                                if(!isset($repeatable_key['options']['rows'])){$repeatable_key['options']['rows'] = '10';}
                                if(!isset($repeatable_key['options']['width'])){$repeatable_key['options']['width'] = '100%';}

                                $output = $crow_start;
                                $output .= '<textarea rows="'.$repeatable_key['options']['rows'].'" style="width:'.$repeatable_key['options']['width'].'" name="' . $one_row . '" id="' . $one_row . '" class="tz-cinput repeated-popup-input">' . $repeatable_key['std'] . '</textarea>' . "\n";
                                $output .= $crow_end;

                                print_shortcode($output);

                                break;

                            case 'select' :

                                $output = $crow_start;
                                $output .= '<select name="' . $one_row . '" id="' . $one_row . '" class="repeated-popup-input tz-cinput">' . "\n";

                                foreach ($repeatable_key['options'] as $value => $option) {
                                    $output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
                                }

                                $output .= '</select>' . "\n";
                                $output .= $crow_end;

                                print_shortcode($output);

                                break;
                        }
                    }

                    // popup parent form row end
                    $prow_end    = '</ul>' . "\n";		// end .child-clone-row-form
                    $prow_end   .= '<a href="#" class="child-clone-row-remove">Remove</a>' . "\n";
                    $prow_end   .= '</div>' . "\n";		// end .child-clone-row


                    $prow_end   .= '</div>' . "\n";		// end .child-clone-rows
                    $prow_end   .= '</td>' . "\n";
                    $prow_end   .= '</tr>' . "\n";
                    $prow_end   .= '</tbody>' . "\n";

                    // add $prow_end to output
                    print_shortcode($prow_end);

                break;
            }

        } // end foreach param
    }
}

function print_shortcode($output) {
    global $shortcode_output;
    $shortcode_output = $shortcode_output . "\n" . $output;
}

?>
