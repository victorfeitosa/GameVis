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
                    'silver' => 'Grey',
                    'black' => 'Black',
                    'yellow' => 'Yellow',
                    'blue' => 'Blue',
                    'red' => 'Red',
                    'green' => 'Green',
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
                    'list-img1' => 'Plus',
                    'list-img2' => 'Arrow',
                    'list-img3' => 'Dash',
                    'list-img4' => 'Check',
                    'list-img5' => 'Star'
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
    )
);

function create_shortcode($popup) {
    global $shortcode;

    if (isset($shortcode) && is_array($shortcode)) {
        $shortcode_param = $shortcode[$popup]['params'];
        $shortcode_code = $shortcode[$popup]['shortcode'];

        $shortcode_output = print_shortcode("\n" . '<div id="old-shortcode" class="hidden">' . $shortcode_code . '</div>');
        $shortcode_output = print_shortcode("\n" . '<div id="shortcode-popup" class="hidden">' . $popup . '</div>');


        foreach ($shortcode_param as $key => $param) {
            $key = 'shortcode_' . $key;

            $row_start = '<tbody>' . "\n";
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
            }
        }
    }
}

function print_shortcode($output) {
    global $shortcode_output;
    $shortcode_output = $shortcode_output . "\n" . $output;
}

?>
