<?php
require( '../../../wp-load.php' );

$shortcode = array(

    //BUTTON
    'button' => array(
        'params' => array(
            'url' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Button URL', 'tkingdom'),
                'desc' => __('Add the button\'s url eg http://example.com', 'tkingdom'),
                'options' => array(
                    'width' => '98px'
                )
            ),
            'new_tab' => array(
                'type' => 'select',
                'label' => __('Where to open link', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'options' => array(
                    '' => __('Open In Same Window', 'tkingdom'),
                    '_blank' => __('Open In New Tab', 'tkingdom')
                )
            ),
            'button_style' => array(
                'type' => 'select',
                'label' => __('Button\'s Style', 'tkingdom'),
                'desc' => __('Select the button\'s style, ie the buttons colour', 'tkingdom'),
                'options' => array(
                    'default' => 'Grey',
                    'btn-warning' => 'Yellow',
                    'btn-inverse' => 'Black',
                    'btn-primary' => 'Dark Blue',
                    'btn-info' => 'Light Blue',
                    'btn-danger' => 'Red',
                    'btn-success' => 'Green'
                )
            ),
            'button_size' => array(
                'std' => 'last',
                'type' => 'select',
                'label' => __('Button Size', 'tkingdom'),
                'desc' => __('Chose the size of buttons', 'tkingdom'),
                'options' => array(
                    '' => 'Default',
                    'btn-large' => 'Large',
                    'btn-small' => 'Small',
                    'btn-mini' => 'Mini',
                )
            ),
            'content' => array(
                'std' => 'Button Text',
                'type' => 'text',
                'label' => __('Button\'s Text', 'tkingdom'),
                'desc' => __('Add the button\'s text', 'tkingdom'),
                'options' => array(
                    'width' => '98px'
                )
            )
        ),
        'shortcode' => '[button url="{{url}}" new_tab="{{new_tab}}" button_style="{{button_style}}" button_size="{{button_size}}"] {{content}} [/button]',
    ),

    //COLUMNS
    'columns' => array(
        'params' => array(
            'column' => array(
                'type' => 'select',
                'label' => __('Column Type', 'tkingdom'),
                'desc' => __('Select the type of the column.', 'tkingdom'),
                'options' => array(
                    'one_half' => 'One Half',
                    'one_third' => 'One Third',
                    'one_fourth' => 'One Fourth',
                    'one_sixth' => 'One Sixth',
                )
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('Column Content', 'tkingdom'),
                'desc' => __('Add the column content.', 'tkingdom'),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            ),
        ),
        'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
    ),
    
        
    //FULLWIDTH SECTION
    'fullwidth' => array(
        'params' => array(

            'backgroundcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('Add Content', 'tkingdom'),
                'desc' => __('shortcodes, text, etc...', 'tkingdom'),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            ),
            
            'image-background' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Image Url', 'tkingdom'),
                'desc' => __('Place image url', 'tkingdom'),
                'options' => array(
                    'width' => '65%'
                )
            ),
            
            'background-repeat' => array(
                'type' => 'select',
                'label' => __('Background Image Repeat', 'tkingdom'),
                'desc' => __('Select if image would repeat i stay fixed and centered', 'tkingdom'),
                'options' => array(
                    'repeat' => 'Repeat',
                    'no-repeat' => 'No Repeat (centered)'
                )
            ),
            
        ),
        'shortcode' => '[fullwidth repeat="{{background-repeat}}" pattern="{{image-background}}" bgcolor="{{backgroundcolor}}"] {{content}} [/fullwidth] ',
    ),
    
    
    //TOGGLE
    'toggle' => array(
        'params' => array(
            'title' => array(
                'type' => 'text',
                'label' => __('Toggle Title', 'tkingdom'),
                'desc' => '',
                'std' => 'Title',
                'options' => array(
                    'width' => '100%'
                )
            ),
            'content' => array(
                'std' => 'Content',
                'type' => 'textarea',
                'label' => __('Toggle Content', 'tkingdom'),
                'desc' => __('Add the toggle content.', 'tkingdom'),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            ),
            'bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'bordercolor' => array(
                'type' => 'colorpicker',
                'label' => __('Border Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'opacity' => array(
                'type' => 'text',
                'label' => __('Toggle Opacity', 'tkingdom'),
                'desc' => __('% (0 - 100)', 'tkingdom'),
                'std' => __('', 'tkingdom'),
                'options' => array(
                    'width' => '20%'
                )
            ),
        ),
        'shortcode' => '[toggle title="{{title}}" bgcolor="{{bgcolor}}" textcolor="{{textcolor}}" bordercolor="{{bordercolor}}" opacity="{{opacity}}"] {{content}} [/toggle]',
        'popup_title' => __('Insert Toggle Content Shortcode', 'tkingdom')
    ),

    //TABBED SHORTCODE
    'tabbed' => array(
        'params' => array(
            'tabs_bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'tabs_textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'tabs_bordercolor' => array(
                'type' => 'colorpicker',
                'label' => __('Border Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'tabs_opacity' => array(
                'type' => 'text',
                'label' => __('Toggle Opacity', 'tkingdom'),
                'desc' => __('% (0 - 100)', 'tkingdom'),
                'std' => __('', 'tkingdom'),
                'options' => array(
                    'width' => '20%'
                )
            ),
            'repeatable' => array(
                'type' => 'repeatable',
                'params' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Tabbed Title', 'tkingdom'),
                        'desc' => '',
                        'std' => 'Title',
                        'options' => array(
                            'width' => '100%'
                        )
                    ),
                    'content' => array(
                        'std' => 'Content',
                        'type' => 'textarea',
                        'label' => __('Tabbed Content', 'tkingdom'),
                        'desc' => __('Add the tabbed content.', 'tkingdom'),
                        'options' => array(
                            'rows' => '10',
                            'width' => '100%'
                        )
                    ),
                ),
                'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
            ),
        ),
        'shortcode' => '[tabs tabs="{{tabs}}" tabs_bgcolor="{{tabs_bgcolor}}" tabs_textcolor="{{tabs_textcolor}}" tabs_bordercolor="{{tabs_bordercolor}}" tabs_opacity="{{tabs_opacity}}"] {{child_shortcode}} [/tabs]',
        'popup_title' => __('Insert Tabbed Content Shortcode', 'tkingdom'),
    ),

    //ACCORDION SHORTCODE
    'accordion' => array(
        'params' => array(
            'title' => array(),
            'tabs_bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'tabs_textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'tabs_bordercolor' => array(
                'type' => 'colorpicker',
                'label' => __('Border Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'tabs_opacity' => array(
                'type' => 'text',
                'label' => __('Toggle Opacity', 'tkingdom'),
                'desc' => __('% (0 - 100)', 'tkingdom'),
                'std' => __('', 'tkingdom'),
                'options' => array(
                    'width' => '20%'
                )
            ),
            'repeatable' => array(
                'type' => 'repeatable',
                'params' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Accordion Title', 'tkingdom'),
                        'desc' => '',
                        'std' => 'Title',
                        'options' => array(
                            'width' => '100%'
                        )
                    ),
                    'content' => array(
                        'std' => 'Content',
                        'type' => 'textarea',
                        'label' => __('Accordion Content', 'tkingdom'),
                        'desc' => __('Add the content.', 'tkingdom'),
                        'options' => array(
                            'rows' => '10',
                            'width' => '100%'
                        )
                    ),
                ),
                'shortcode' => '[accordion title="{{title}}"] {{content}} [/accordion]',
            )
        ),
        'shortcode' => '[accordions tabs_bgcolor="{{tabs_bgcolor}}" tabs_textcolor="{{tabs_textcolor}}" tabs_bordercolor="{{tabs_bordercolor}}" tabs_opacity="{{tabs_opacity}}"] {{child_shortcode}} [/accordions]',
        'popup_title' => __('Insert Tabbed Content Shortcode', 'tkingdom'),
    ),

    // DROPCAP
    'dropcap' => array(
        'params' => array(
            'style' => array(
                'type' => 'select',
                'label' => __('Type of dropcap', 'tkingdom'),
                'desc' => __('Select the dropcap type', 'tkingdom'),
                'options' => array(
                    'background' => 'With Background',
                    'no-background' => 'Without Background'
                )
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('', 'tkingdom'),
                'desc' => __('Insert starting letter to use as dropcap.', 'tkingdom'),
                'options' => array(
                    'rows' => '1',
                    'width' => '10%'
                )
            )
        ),
        'shortcode' => '[dropcap style="{{style}}"] {{content}} [/dropcap]',
    ),

    // PROGRESS BAR
    'progressbar' => array(
        'params' => array(
            /*
            'style' => array(
                'type' => 'select',
                'label' => __('Type of progress bar', 'tkingdom'),
                'desc' => __('Select the progress bar type', 'tkingdom'),
                'options' => array(
                    'background' => 'With Background',
                    'no-background' => 'Without Background'
                )
            ),
            */
            'bar_percentage' => array(
                'type' => 'text',
                'label' => __('Progress Bar Percentage', 'tkingdom'),
                'desc' => __('% (0 - 100)', 'tkingdom'),
                'std' => __('', 'tkingdom'),
                'options' => array(
                    'width' => '20%'
                )
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __('', 'tkingdom'),
                'desc' => __('Insert text to explain progress bar.', 'tkingdom'),
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            )
        ),
        'shortcode' => '[progressbar bar_percentage="{{bar_percentage}}"] {{content}} [/progressbar]',
    ),

    // INFO BOX
    'infobox' => array(
        'params' => array(
            /*
            'bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            'textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
                'value' => '',
            ),
            */
            'style' => array(
                'type' => 'select',
                'label' => __('Message Box Style', 'tkingdom'),
                'desc' => __('Select the type of the message box.', 'tkingdom'),
                'options' => array(
                    'alert-error' => 'Error Message',
                    'alert-success' => 'Success Message',
                    'alert-block' => 'Warning Message',
                    'alert-info' => 'Information Message',
                )
            ),
            'content' => array(
                'std' => 'Insert yor text',
                'type' => 'textarea',
                'label' => __('Insert yor text', 'tkingdom'),
                'desc' => __('Insert starting letter to use as dropcap.', 'tkingdom'),
                'value' => '',
                'options' => array(
                    'rows' => '10',
                    'width' => '100%'
                )
            )
        ),
        'shortcode' => '[infobox bgcolor="{{bgcolor}}" textcolor="{{textcolor}} style="{{style}}"] {{content}} [/infobox]',
    ),

    //PRICETABLE SHORTCODE
    'pricing' => array(
        'params' => array(
            'column' => array(
                'type' => 'select',
                'label' => __('Column Type', 'tkingdom'),
                'desc' => __('Select the type of the column.', 'tkingdom'),
                'options' => array(
                    'col-xs-12' => 'Full Width',
                    'col-xs-6' => 'One Half',
                    'col-xs-4' => 'One Third',
                    'col-xs-3' => 'One Fourth',
                )
            ),
            'title' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Table Title', 'tkingdom'),
                'desc' => __('Price table title.', 'tkingdom'),
                'options' => array(
                    'width' => '100%'
                )
            ),
            'subtitle' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Table Subtitle', 'tkingdom'),
                'desc' => __('Price table subtitle.', 'tkingdom'),
                'options' => array(
                    'width' => '100%'
                )
            ),
            'bgcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Background Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
            ),
            'textcolor' => array(
                'type' => 'colorpicker',
                'label' => __('Text Color', 'tkingdom'),
                'desc' => __('', 'tkingdom'),
            ),
            'usebutton' => array(
                'type' => 'select',
                'label' => __('Use Button', 'tkingdom'),
                'desc' => __('Chose if you want to use Button inside Price Table', 'tkingdom'),
                'options' => array(
                    'yes' => 'Use Button',
                    'no' => 'Don\'t use Button',
                )
            ),
            'url' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Button URL', 'tkingdom'),
                'desc' => __('Add the button\'s url eg http://example.com', 'tkingdom'),
                'options' => array(
                    'width' => '98px'
                )
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Button\'s Style', 'tkingdom'),
                'desc' => __('Select the button\'s style, ie the buttons colour', 'tkingdom'),
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
                'label' => __('Button\'s Text', 'tkingdom'),
                'desc' => __('Add the button\'s text', 'tkingdom'),
                 'options' => array(
                    'width' => '98px'
                )
            ),
            'repeatable' => array(
                'type' => 'repeatable',
                'params' => array(
                    'title' => array(
                        'type' => 'text',
                        'label' => __('Price Row Text', 'tkingdom'),
                        'desc' => '',
                        'std' => '',
                        'options' => array(
                            'width' => '100%'
                        )
                    ),
                    'content' => array(
                        'std' => '',
                        'type' => 'text',
                        'label' => __('Price Row Price', 'tkingdom'),
                        'desc' => '',
                        'options' => array(
                            'rows' => '10',
                            'width' => '100%'
                        )
                    ),
                    'url' => array(
                        'type' => 'text',
                        'label' => __('Price Row Link', 'tkingdom'),
                        'desc' => '',
                        'std' => '',
                        'options' => array(
                            'width' => '100%'
                        )
                    ),
                ),
                'shortcode' => '[price title="{{title}}" url="{{url}}"] {{content}} [/price]',
            )
        ),
        'shortcode' => '[pricing column="{{column}}" title="{{title}}" subtitle="{{subtitle}}" url="{{url}}" style="{{style}}" usebutton="{{usebutton}}" buttontext="{{buttontext}}" bgcolor="{{bgcolor}}" textcolor="{{textcolor}}"] {{child_shortcode}} [/pricing]',
        'popup_title' => __('Insert Tabbed Content Shortcode', 'tkingdom'),

    ),
    
        //Icon
    'icons' => array( 
        'params' => array(
          
                'image' => array(
                    'type'=>'icons', 
                    'label' => __('Icon', 'tkingdom'),
                    'values'=> array(
                      'icon-glass' => 'fa-glass',
                      'icon-music' => 'fa-music',
                      'icon-search' => 'fa-search',
                      'icon-envelope' => 'fa-envelope-o',
                      'icon-heart' => 'fa-heart',
                      'icon-star' => 'fa-star',
                      'icon-star' => 'fa-star',
                      'icon-star-o' => 'fa-star-o',
                      'icon-user' => 'fa-user',
                      'icon-film' => 'fa-film',
                      'icon-th-large' => 'fa-th-large',
                      'icon-th' => 'fa-th',
                      'icon-th-list' => 'fa-th-list',
                      'icon-check' => 'fa-check',
                      'icon-times' => 'fa-times',
                      'icon-search-plus' => 'fa-search-plus',
                      'icon-search-minus' => 'fa-search-minus',
                      'icon-power-off' => 'fa-power-off',
                      'icon-signal' => 'fa-signal',
                      'icon-gear' => 'fa-gear',
                      'icon-cog' => 'fa-cog fa-spin',
                      'icon-trash-o' => 'fa-trash-o',
                      'icon-home' => 'fa-home',
                      'icon-file-o' => 'fa-file-o',
                      'icon-clock-o' => 'fa-clock-o',
                      'icon-road' => 'fa-road',
                      'icon-download' => 'fa-download',
                      'icon-arrow-circle-o-down' => 'fa-arrow-circle-o-down',
                      'icon-arrow-circle-o-up' => 'fa-arrow-circle-o-up',
                      'icon-inbox' => 'fa-inbox',
                      'icon-play-circle-o' => 'fa-play-circle-o',
                      'icon-rotate-right' => 'fa-rotate-right',
                      'icon-refresh' => 'fa-refresh fa-spin',
                      'icon-list-alt' => 'fa-list-alt',
                      'icon-lock' => 'fa-lock',
                      'icon-flag' => 'fa-flag',
                      'icon-headphones' => 'fa-headphones',
                      'icon-volume-off' => 'fa-volume-off',
                      'icon-volume-down' => 'fa-volume-down',
                      'icon-volume-up' => 'fa-volume-up',
                      'icon-qrcode' => 'fa-qrcode',
                      'icon-barcode' => 'fa-barcode',
                      'icon-tag' => 'fa-tag',
                      'icon-tags' => 'fa-tags',
                      'icon-book' => 'fa-book',
                      'icon-bookmark' => 'fa-bookmark',
                      'icon-print' => 'fa-print',
                      'icon-camera' => 'fa-camera',
                      'icon-font' => 'fa-font',
                      'icon-bold' => 'fa-bold',
                      'icon-italic' => 'fa-italic',
                      'icon-text-height' => 'fa-text-height',
                      'icon-text-width' => 'fa-text-width',
                      'icon-align-left' => 'fa-align-left',
                      'icon-align-center' => 'fa-align-center',
                      'icon-align-right' => 'fa-align-right',
                      'icon-align-justify' => 'fa-align-justify',
                      'icon-list' => 'fa-list',
                      'icon-outdent' => 'fa-outdent',
                      'icon-indent' => 'fa-indent',
                      'icon-video-camera' => 'fa-video-camera',
                      'icon-picture-o' => 'fa-picture-o',
                      'icon-pencil' => 'fa-pencil',
                      'icon-map-marker' => 'fa-map-marker',
                      'icon-adjust' => 'fa-adjust',
                      'icon-tint' => 'fa-tint',
                      'icon-edit' => 'fa-edit',
                      'icon-share-square-o' => 'fa-share-square-o',
                      'icon-check-square-o' => 'fa-check-square-o',
                      'icon-arrows' => 'fa-arrows',
                      'icon-step-backward' => 'fa-step-backward',
                      'icon-fast-backward' => 'fa-fast-backward',
                      'icon-backward' => 'fa-backward',
                      'icon-play' => 'fa-play',
                      'icon-pause' => 'fa-pause',
                      'icon-stop' => 'fa-stop',
                      'icon-forward' => 'fa-forward',
                      'icon-fast-forward' => 'fa-fast-forward',
                      'icon-step-forward' => 'fa-step-forward',
                      'icon-eject' => 'fa-eject',
                      'icon-chevron-left' => 'fa-chevron-left',
                      'icon-chevron-right' => 'fa-chevron-right',
                      'icon-plus-circle' => 'fa-plus-circle',
                      'icon-minus-circle' => 'fa-minus-circle',
                      'icon-times-circle' => 'fa-times-circle',
                      'icon-check-circle' => 'fa-check-circle',
                      'icon-question-circle' => 'fa-question-circle',
                      'icon-info-circle' => 'fa-info-circle',
                      'icon-crosshairs' => 'fa-crosshairs',
                      'icon-times-circle-o' => 'fa-times-circle-o',
                      'icon-check-circle-o' => 'fa-check-circle-o',
                      'icon-ban' => 'fa-ban',
                      'icon-arrow-left' => 'fa-arrow-left',
                      'icon-arrow-left' => 'fa-arrow-left',
                      'icon-arrow-right' => 'fa-arrow-right',
                      'icon-arrow-up' => 'fa-arrow-up',
                      'icon-arrow-down' => 'fa-arrow-down',
                      'icon-share' => 'fa-share',
                      'icon-expand' => 'fa-expand',
                      'icon-compress' => 'fa-compress',
                      'icon-plus' => 'fa-plus',
                      'icon-minus' => 'fa-minus',
                      'icon-asterisk' => 'fa-asterisk',
                      'icon-exclamation-circle' => 'fa-exclamation-circle',
                      'icon-gift' => 'fa-gift',
                      'icon-leaf' => 'fa-leaf',
                      'icon-fire' => 'fa-fire',
                      'icon-eye' => 'fa-eye',
                      'icon-eye-slash' => 'fa-eye-slash',
                      'icon-warning' => 'fa-warning',
                      'icon-plane' => 'fa-plane',
                      'icon-calendar' => 'fa-calendar',
                      'icon-random' => 'fa-random',
                      'icon-comment' => 'fa-comment',
                      'icon-magnet' => 'fa-magnet',
                      'icon-chevron-up' => 'fa-chevron-up',
                      'icon-chevron-down' => 'fa-chevron-down',
                      'icon-retweet' => 'fa-retweet',
                      'icon-shopping-cart' => 'fa-shopping-cart',
                      'icon-folder' => 'fa-folder',
                      'icon-folder-open' => 'fa-folder-open',
                      'icon-arrows-v' => 'fa-arrows-v',
                      'icon-arrows-h' => 'fa-arrows-h',
                      'icon-bar-chart-o' => 'fa-bar-chart-o',
                      'icon-twitter-square' => 'fa-twitter-square',
                      'icon-facebook-square' => 'fa-facebook-square',
                      'icon-camera-retro' => 'fa-camera-retro',
                      'icon-key' => 'fa-key',
                      'icon-gears' => 'fa-gears',
                      'icon-comments' => 'fa-comments',
                      'icon-thumbs-o-up' => 'fa-thumbs-o-up',
                      'icon-thumbs-o-down' => 'fa-thumbs-o-down',
                      'icon-heart-o' => 'fa-heart-o',
                      'icon-sign-out' => 'fa-sign-out',
                      'icon-linkedin-square' => 'fa-linkedin-square',
                      'icon-thumb-tack' => 'fa-thumb-tack',
                      'icon-external-link' => 'fa-external-link',
                      'icon-sign-in' => 'fa-sign-in',
                      'icon-trophy' => 'fa-trophy',
                      'icon-github-square' => 'fa-github-square',
                      'icon-upload' => 'fa-upload',
                      'icon-lemon-o' => 'fa-lemon-o ',
                      'icon-phone' => 'fa-phone',
                      'icon-square-o' => 'fa-square-o',
                      'icon-bookmark-o' => 'fa-bookmark-o',
                      'icon-phone-square' => 'fa-phone-square',
                      'icon-twitter' => 'fa-twitter',
                      'icon-facebook' => 'fa-facebook',
                      'icon-github' => 'fa-github',
                      'icon-unlock' => 'fa-unlock',
                      'icon-credit-card' => 'fa-credit-card',
                      'icon-rss' => 'fa-rss',
                      'icon-hdd-o' => 'fa-hdd-o',
                      'icon-bullhorn' => 'fa-bullhorn',
                      'icon-bell' => 'fa-bell',
                      'icon-certificate' => 'fa-certificate',
                      'icon-hand-o-right' => 'fa-hand-o-right',
                      'icon-hand-o-left' => 'fa-hand-o-left',
                      'icon-hand-o-up' => 'fa-hand-o-up',
                      'icon-hand-o-down' => 'fa-hand-o-down',
                      'icon-arrow-circle-left' => 'fa-arrow-circle-left',
                      'icon-arrow-circle-right' => 'fa-arrow-circle-right',
                      'icon-arrow-circle-up' => 'fa-arrow-circle-up',
                      'icon-arrow-circle-down' => 'fa-arrow-circle-down',
                      'icon-globe' => 'fa-globe',
                      'icon-wrench' => 'fa-wrench',
                      'icon-tasks' => 'fa-tasks',
                      'icon-filter' => 'fa-filter',
                      'icon-briefcase' => 'fa-briefcase',
                      'icon-arrows-alt' => 'fa-arrows-alt',
                      'icon-group' => 'fa-group',
                      'icon-link' => 'fa-link',
                      'icon-cloud' => 'fa-cloud',
                      'icon-flask' => 'fa-flask',
                      'icon-cut' => 'fa-cut',
                      'icon-files-o' => 'fa-files-o',
                      'icon-paperclip' => 'fa-paperclip',
                      'icon-save' => 'fa-save',
                      'icon-bars' => 'fa-bars',
                      'icon-list-ul' => 'fa-list-ul',
                      'icon-list-ol' => 'fa-list-ol',
                      'icon-strikethrough' => 'fa-strikethrough',
                      'icon-underline' => 'fa-underline',
                      'icon-table' => 'fa-table',
                      'icon-magic' => 'fa-magic',
                      'icon-truck' => 'fa-truck',
                      'icon-pinterest' => 'fa-pinterest',
                      'icon-pinterest-square' => 'fa-pinterest-square',
                      'icon-google-plus-square' => 'fa-google-plus-square',
                      'icon-google-plus' => 'fa-google-plus',
                      'icon-money' => 'fa-money',
                      'icon-caret-down' => 'fa-caret-down',
                      'icon-caret-up' => 'fa-caret-up',
                      'icon-caret-left' => 'fa-caret-left',
                      'icon-caret-right' => 'fa-caret-right',
                      'icon-columns' => 'fa-columns',
                      'icon-sort' => 'fa-sort',
                      'icon-sort-asc' => 'fa-sort-asc',
                      'icon-sort-desc' => 'fa-sort-desc',
                      'icon-envelope' => 'fa-envelope',
                      'icon-linkedin' => 'fa-linkedin',
                      'icon-undo' => 'fa-undo',
                      'icon-gavel' => 'fa-gavel',
                      'icon-tachometer' => 'fa-tachometer',
                      'icon-comment-o' => 'fa-comment-o',
                      'icon-comments-o' => 'fa-comments-o',
                      'icon-bolt' => 'fa-bolt',
                      'icon-sitemap' => 'fa-sitemap',
                      'icon-umbrella' => 'fa-umbrella',
                      'icon-clipboard' => 'fa-clipboard',
                      'icon-lightbulb-o' => 'fa-lightbulb-o',
                      'icon-exchange' => 'fa-exchange',
                      'icon-cloud-download' => 'fa-cloud-download',
                      'icon-cloud-upload' => 'fa-cloud-upload',
                      'icon-user-md' => 'fa-user-md',
                      'icon-stethoscope' => 'fa-stethoscope',
                      'icon-suitcase' => 'fa-suitcase',
                      'icon-bell-o' => 'fa-bell-o',
                      'icon-coffee' => 'fa-coffee',
                      'icon-cutlery' => 'fa-cutlery',
                      'icon-file-text-o' => 'fa-file-text-o',
                      'icon-building-o' => 'fa-building-o',
                      'icon-hospital-o' => 'fa-hospital-o',
                      'icon-ambulance' => 'fa-ambulance',
                      'icon-medkit' => 'fa-medkit',
                      'icon-fighter-jet' => 'fa-fighter-jet',
                      'icon-beer' => 'fa-beer',
                      'icon-h-square' => 'fa-h-square',
                      'icon-plus-square' => 'fa-plus-square',
                      'icon-angle-double-left' => 'fa-angle-double-left',
                      'icon-angle-double-right' => 'fa-angle-double-right',
                      'icon-angle-double-up' => 'fa-angle-double-up',
                      'icon-angle-double-down' => 'fa-angle-double-down',
                      'icon-angle-left' => 'fa-angle-left',
                      'icon-angle-right' => 'fa-angle-right',
                      'icon-angle-up' => 'fa-angle-up',
                      'icon-angle-down' => 'fa-angle-down',
                      'icon-desktop' => 'fa-desktop',
                      'icon-laptop' => 'fa-laptop',
                      'icon-tablet' => 'fa-tablet',
                      'icon-mobile-phone' => 'fa-mobile-phone',
                      'icon-circle-o' => 'fa-circle-o',
                      'icon-quote-left' => 'fa-quote-left',
                      'icon-quote-right' => 'fa-quote-right',
                      'icon-spinner' => 'fa-spinner fa-spin',
                      'icon-circle' => 'fa-circle',
                      'icon-reply' => 'fa-reply',
                      'icon-github-alt' => 'fa-github-alt',
                      'icon-folder-o' => 'fa-folder-o',
                      'icon-folder-open-o' => 'fa-folder-open-o',
                      'icon-smile-o' => 'fa-smile-o',
                      'icon-frown-o' => 'fa-frown-o',
                      'icon-meh-o' => 'fa-meh-o',
                      'icon-gamepad' => 'fa-gamepad',
                      'icon-keyboard-o' => 'fa-keyboard-o',
                      'icon-flag-o' => 'fa-flag-o',
                      'icon-flag-checkered' => 'fa-flag-checkered',
                      'icon-terminal' => 'fa-terminal',
                      'icon-code' => 'fa-code',
                      'icon-reply-all' => 'fa-reply-all',
                      'icon-star-half-o' => 'fa-star-half-o',
                      'icon-location-arrow' => 'fa-location-arrow',
                      'icon-crop' => 'fa-crop',
                      'icon-code-fork' => 'fa-code-fork',
                      'icon-unlink' => 'fa-unlink',
                      'icon-question' => 'fa-question',
                      'icon-info' => 'fa-info',
                      'icon-exclamation' => 'fa-exclamation',
                      'icon-superscript' => 'fa-superscript',
                      'icon-subscript' => 'fa-subscript',
                      'icon-eraser' => 'fa-eraser',
                      'icon-puzzle-piece' => 'fa-puzzle-piece',
                      'icon-microphone' => 'fa-microphone',
                      'icon-microphone-slash' => 'fa-microphone-slash',
                      'icon-shield' => 'fa-shield',
                      'icon-calendar-o' => 'fa-calendar-o',
                      'icon-fire-extinguisher' => 'fa-fire-extinguisher',
                      'icon-rocket' => 'fa-rocket',
                      'icon-maxcdn' => 'fa-maxcdn',
                      'icon-chevron-circle-left' => 'fa-chevron-circle-left',
                      'icon-chevron-circle-right' => 'fa-chevron-circle-right',
                      'icon-chevron-circle-up' => 'fa-chevron-circle-up',
                      'icon-chevron-circle-down' => 'fa-chevron-circle-down',
                      'icon-html5' => 'fa-html5',
                      'icon-css3' => 'fa-css3',
                      'icon-anchor' => 'fa-anchor',
                      'icon-unlock-alt' => 'fa-unlock-alt',
                      'icon-bullseye' => 'fa-bullseye',
                      'icon-ellipsis-h' => 'fa-ellipsis-h',
                      'icon-ellipsis-v' => 'fa-ellipsis-v',
                      'icon-rss-square' => 'fa-rss-square',
                      'icon-play-circle' => 'fa-play-circle',
                      'icon-ticket' => 'fa-ticket',
                      'icon-minus-square' => 'fa-minus-square',
                      'icon-minus-square-o' => 'fa-minus-square-o',
                      'icon-level-up' => 'fa-level-up',
                      'icon-level-down' => 'fa-level-down',
                      'icon-check-square' => 'fa-check-square',
                      'icon-pencil-square' => 'fa-pencil-square',
                      'icon-external-link-square' => 'fa-external-link-square',
                      'icon-share-square' => 'fa-share-square',
                      'icon-compass' => 'fa-compass',
                      'icon-toggle-down' => 'fa-toggle-down',
                      'icon-toggle-up' => 'fa-toggle-up',
                      'icon-toggle-right' => 'fa-toggle-right',
                      'icon-toggle-left' => 'fa-toggle-left',
                      'icon-euro' => 'fa-euro',
                      'icon-gbp' => 'fa-gbp',
                      'icon-dollar' => 'fa-dollar',
                      'icon-rupee' => 'fa-rupee',
                      'icon-cny' => 'fa-cny',
                      'icon-ruble' => 'fa-ruble',
                      'icon-won' => 'fa-won',
                      'icon-bitcoin' => 'fa-bitcoin',
                      'icon-file' => 'fa-file',
                      'icon-file-text' => 'fa-file-text',
                      'icon-sort-alpha-asc' => 'fa-sort-alpha-asc',
                      'icon-sort-alpha-desc' => 'fa-sort-alpha-desc',
                      'icon-sort-amount-asc' => 'fa-sort-amount-asc',
                      'icon-sort-amount-desc' => 'fa-sort-amount-desc',
                      'icon-sort-numeric-asc' => 'fa-sort-numeric-asc',
                      'icon-sort-numeric-desc' => 'fa-sort-numeric-desc',
                      'icon-thumbs-up' => 'fa-thumbs-up',
                      'icon-thumbs-down' => 'fa-thumbs-down',
                      'icon-youtube-square' => 'fa-youtube-square',
                      'icon-youtube' => 'fa-youtube',
                      'icon-xing' => 'fa-xing',
                      'icon-xing-square' => 'fa-xing-square',
                      'icon-youtube-play' => 'fa-youtube-play',
                      'icon-dropbox' => 'fa-dropbox',
                      'icon-stack-overflow' => 'fa-stack-overflow',
                      'icon-instagram' => 'fa-instagram',
                      'icon-flickr' => 'fa-flickr',
                      'icon-adn' => 'fa-adn',
                      'icon-bitbucket' => 'fa-bitbucket',
                      'icon-bitbucket-square' => 'fa-bitbucket-square',
                      'icon-tumblr' => 'fa-tumblr',
                      'icon-tumblr-square' => 'fa-tumblr-square',
                      'icon-long-arrow-down' => 'fa-long-arrow-down',
                      'icon-long-arrow-up' => 'fa-long-arrow-up',
                      'icon-long-arrow-left' => 'fa-long-arrow-left',
                      'icon-long-arrow-right' => 'fa-long-arrow-right',
                      'icon-apple' => 'fa-apple',
                      'icon-windows' => 'fa-windows',
                      'icon-android' => 'fa-android',
                      'icon-linux' => 'fa-linux',
                      'icon-dribbble' => 'fa-dribbble',
                      'icon-skype' => 'fa-skype',
                      'icon-foursquare' => 'fa-foursquare',
                      'icon-trello' => 'fa-trello',
                      'icon-female' => 'fa-female',
                      'icon-male' => 'fa-male',
                      'icon-gittip' => 'fa-gittip',
                      'icon-sun-o' => 'fa-sun-o',
                      'icon-moon-o' => 'fa-moon-o',
                      'icon-archive' => 'fa-archive',
                      'icon-bug' => 'fa-bug',
                      'icon-vk' => 'fa-vk',
                      'icon-weibo' => 'fa-weibo',
                      'icon-renren' => 'fa-renren',
                      'icon-pagelines' => 'fa-pagelines',
                      'icon-stack-exchange' => 'fa-stack-exchange',
                      'icon-arrow-circle-o-right' => 'fa-arrow-circle-o-right',
                      'icon-arrow-circle-o-left' => 'fa-arrow-circle-o-left',
                      'icon-dot-circle-o' => 'fa-dot-circle-o',
                      'icon-wheelchair' => 'fa-wheelchair',
                      'icon-vimeo-square' => 'fa-vimeo-square',
                      'icon-turkish-lira' => 'fa-turkish-lira',
                      'icon-plus-square-o' => 'fa-plus-square-o'
                    )
                    
                ),
                'size' => array(
                    'type' => 'select',
                    'label' => __('Icon Size', 'tkingdom'),
                    'options' => array(
                        'none'=>'Select Icon Size',
                        'tiny' => 'Tiny',
                        'extra-small' => 'Extra Small',
                        'small' => 'Small',
                        'medium' => 'Medium',
                        'large' => 'Large',
                        'extra-large' => 'Extra Large',
                    )
                ),
                'url' => array(
                    'std' => '',
                    'type' => 'text',
                    'label' => __('Icon URL', 'tkingdom'),
                    'desc' => 'example: http://www.themeskingdom.com',
                    'options' => array(
                        'width' => '98px'
                    )
                ),

             ),
        'shortcode' => '[icon size="{{size}}" image="{{image}}" url="{{url}}" ]',
        'popup_title' => __('Insert Icon Shortcode', 'tkingdom'),
        )

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
                    
                case 'icons':

                    $output = $row_start;
                    $output .= '<input id="' . $key . '" name="' . $key . '" type="hidden"  class="icon-value popup-input" />' . "\n";
                    $output .= '<div class="icon-option">';
                    $values = $shortcode[$popup]['params']['image']['values'];
                    foreach( $values as $value ){
                        $output .= '<div class="ico-holder"><i class="fa '.$value.'" rel = "'.$value.'" ></i></div>';
                    }
                    $output .= '</div>';
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function($){
                            jQuery( '.icon-option i' ).click(function() {
                                jQuery('.icon-value').val(jQuery(this).attr("class"));
                            });
                                         
                            jQuery('.ico-holder').click(function() { 
                                jQuery('.ico-holder').removeClass('active'); 
                                jQuery(this).addClass('active'); 
                            });
                        })
                        

                    </script>
                    <?php
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
