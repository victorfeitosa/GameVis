<?php

$prefix = 'tk_';
$meta_boxes = array(

    
    
    array(
        'id' => 'advertisement_meta_box_link',
        'title' => __('Advertisement Link', tk_theme_name()),
        'pages' => array('advertisement'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Advertisement Link', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'advertisement_link',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Custom Banner Code', tk_theme_name()),
                'desc' => 'If code is set it will be shown instead of advert selected above',
                'id' => $prefix . 'custom_banner_code',
                'type' => 'plaintextarea',
                'std' => '',
                'options' => array(
                    'rows' => '3',
                    'cols' => '18'
                )
            )
        )
    ),
    array(
        'id' => 'advertisement_meta_box',
        'title' => __('Advertisement', tk_theme_name()),
        'pages' => array('advertisement'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Banner Stats', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'banner_stats',
                'type' => 'annotated_timeline',
                'std' => ''
            )
        )
    ),
    
    
    
    // POST TYPE POST
    array(
        'id' => 'post_meta1',
        'title' => __('VIdeo Link', tk_theme_name()),
        'pages' => array('post', 'services'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('VIdeo Link', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'video_link',
                'type' => 'text',
                'std' => ''
            )

        )
    ),

    array(
        'id' => 'post_meta2',
        'title' => __('Slider Fields', tk_theme_name()),
        'pages' => array('post', 'services'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',    
        'fields' => array(

            array(
                'label' => 'Repeatable',
                'name' => 'Slider Fields',
                'desc'  => '',
                'id'    => $prefix.'repeatable',
                'type'  => 'repeatable'
            )

        )
    ),
    
    array(
        'id' => 'post_meta3',
        'title' => __('Audio Options', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Audio Link', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'audio_link',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Artist/Song Name', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'audio_text',
                'type' => 'text',
                'std' => ''
            )

        )
    ),
    
    array(
        'id' => 'post_meta4',
        'title' => __('Quote Text', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Quote Text', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'quote',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Quote Author', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'quote_author',
                'type' => 'text',
                'std' => ''
            )

        )
    ),
    
    array(
        'id' => 'post_meta5',
        'title' => __('Link', tk_theme_name()),
        'pages' => array('post'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Link Text', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'link_text',
                'type' => 'text',
                'std' => ''
            ),
            array(
                'name' => __('Link Url', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'link_url',
                'type' => 'text',
                'std' => ''
            )

        )
    ),
    
    array(
        'id' => 'post_meta7',
        'title' => __('Page Settings', tk_theme_name()),
        'pages' => array('page', 'work', 'services'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('SubHeadline', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'headline',
                'type' => 'plaintextarea',
                'std' => '',
                'options' => array(
                    'rows' => '3',
                    'cols' => '13'
                )
            )
        )
    ),

    array(
        'id' => 'post_meta8',
        'title' => __('Sidebar Position', tk_theme_name()),
        'pages' => array('post', 'page', 'work', 'services'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => __('Sidebar Position', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'sidebar_position',
                'type' => 'sidebar'
            ),
            array(
                'name' => __('Select sidebar', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'sidebar',
                'type' => 'select-sidebar',
                'std' => '',
                'options' => ''
            ),
        )
    ),
    
    
    
    array(
        'id' => 'post_meta9',
        'title' => __('Testimonial', tk_theme_name()),
        'pages' => array('testimonials'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(


            array(
                'name' => __('Job Position', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'job_position',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('E-mail', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'email',
                'type' => 'text',
                'std' => ''
            )
        )
    ),
    
        array(
        'id' => 'post_meta11',
        'title' => __('Team Member Info', tk_theme_name()),
        'pages' => array('team-members'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            
            array(
                'name' => __('Float Featured Image Right', tk_theme_name()),
                'desc' => 'If checked featured image will be set on the right side',
                'id' => $prefix . 'featured_right',
                'type' => 'checkbox'                
            ),
        
            
            array(
                'name' => __('Member Title', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'title_info',
                'type' => 'text',
                'std' => ''
            ),

            array(
                'name' => __('Flickr Account', tk_theme_name()),
                'desc' => 'Place a link to your Flickr account (i.e. http://www.flickr.com/photos/themeskingdom)',
                'id' => $prefix . 'flickr',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Instagram Account', tk_theme_name()),
                'desc' => 'Place a link to your Instagram account (i.e. http://instagram.com/themeskingdom)',
                'id' => $prefix . 'instagram',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Twitter Account', tk_theme_name()),
                'desc' => 'Place a link to your Twitter account (i.e. http://twitter.com/themeskingdom)',
                'id' => $prefix . 'twitter',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('Facebook Account', tk_theme_name()),
                'desc' => 'Place a link to your Facebook account (i.e. http://facebook.com/themeskingdom)',
                'id' => $prefix . 'facebook',
                'type' => 'text',
                'std' => ''
            ),
            
            array(
                'name' => __('LinkedIn Account', tk_theme_name()),
                'desc' => 'Place a link to your LinkedIn account (i.e. http://linkedin.com/pub/themes-kingdom/52/228/4b9)',
                'id' => $prefix . 'linkedIn',
                'type' => 'text',
                'std' => ''
            ),            
           )
        ),

            
        array(
        'id' => 'post_meta12',
        'title' => __('Services  Colors', tk_theme_name()),
        'pages' => array('services'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Background Color', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'background_color',
                'type' => 'colorpicker',
                'std' => 'D25555'
            ),   
            
            array(
                'name' => __('Background Hover Color', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'background_hover_color',
                'type' => 'colorpicker',
                'std' => 'ffffff'
            ),   
            
            
            array(
                'name' => __('Headline Color', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'headline_color',
                'type' => 'colorpicker',
                'std' => 'ffffff'
            ),
            array(
                'name' => __('Subheadline Color', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'sub_headline_color',
                'type' => 'colorpicker',
                'std' => 'ffffff'
            ),
            array(
                'name' => __('Text Color', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'text_color',
                'type' => 'colorpicker',
                'std' => '515151'
            ),
            array(
                'name' => __('Hover Color', tk_theme_name()),
                'desc' => 'Effect visible in Home Page builder parts. Please visit Home Page builder in theme settings.',
                'id' => $prefix . 'hover_color',
                'type' => 'colorpicker',
                'std' => '515151'
            ),
            array(
                'name' => __('Small featured image', tk_theme_name()),
                'desc' => 'If provided, image will be visible in Home Page builder parts. Also in Single Service Page title box.',
                'id' => $prefix . 'featured_service',
                'type' => 'imageupload'                
            ),
            /*array(
                'name' => __('Subheading ', tk_theme_name()),
                'desc' => 'Set the text that will display in Home Page builder parts.',
                'id' => $prefix . 'subheading_text',
                'type' => 'text',
                'std' => ''
            ), */

            
        )
    ),
    
    /*array(
        'id' => 'post_meta14',
        'title' => __('Subheading ', tk_theme_name()),
        'pages' => array('services'), // multiple post types
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => '',
                'desc' => 'Set the text that will display in Home Page builder parts.',
                'id' => $prefix . 'subheading_text',
                'type' => 'text',
                'std' => ''
            ),   


            
        )
    ),*/
      
      
      

        array(
        'id' => 'post_meta13',
        'title' => __('Partners link', tk_theme_name()),
        'pages' => array('partners'), // multiple post types
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(

            array(
                'name' => __('Partners Website', tk_theme_name()),
                'desc' => '',
                'id' => $prefix . 'partners_website',
                'type' => 'text',
                'std' => ''
            ),   

            
        )
    ),
      
    
);




foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}


class My_meta_box {

    protected $_meta_box;

    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));

        add_action('save_post', array(&$this, 'save'));
    }

    /// Add meta box for multiple post types
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }

    // Callback function to show fields in meta box
    function show() {
        global $post;

        // Use nonce for verification
        echo '<input type="hidden" name="tk_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

        echo '<table class="form-table">';

        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);

            if ($field['type'] != 'annotated_timeline') {
                echo '<tr>',
                '<th style="width:25%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
            } else {
                
            }

            switch ($field['type']) {

                case 'annotated_timeline' :
                    if (isset($_GET['post'])) {
                        echo '<tr><td><div class="period_selector">',
                        '<a id="selector_seven_days" href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 7)">Last 7 Days</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 30)">Last 30 Days</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 365)">Last Year</a>',
                        '<a href="javascript:updateChart(\'' . urlencode(site_url()) . '\', ' . $_GET['post'] . ', 0)">All Time</a>',
                        '</div><div class="banner-chart" style="width:100%; height:300px"></div></td></tr>';'<script></script>';
                    }
                    break;

                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" />',
                        '<br />';
                    echo '<span class="description">' . $field['desc'] . '</span>';
                    break;
                
                    case 'services_post':    
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';                        
                    global $wpdb;
                    
                    $get_services = $wpdb->get_results( "SELECT * FROM `" . $wpdb->prefix . "posts` WHERE post_type = 'services'" );                    
                    foreach ($get_services as $service) {
                        echo '<option', $meta == $service->ID ? ' selected="selected"' : '', ' value="'.$service->ID.'">', $service->post_title , '</option>';
                    }                    
                    echo '</select></br>';
                    echo '<span class="description">'.$field['desc'].'</span>';

                    break;

                case 'plaintextarea':
                    echo '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '"  rows="' . $field['options']['rows'] . '" cols="' . $field['options']['cols'] . '">'.$meta.'</textarea>';
                    break;

                case 'textarea':

                    wp_editor( $meta ? $meta : $field['std'], $field['id'], $settings = array('media_buttons' => false, 'textarea_rows' => '5'  ) );

                    break;

                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', ' value="'.$option.'">', $option, '</option>';
                    }
                    echo '</select></br>';
                    echo '<span class="description">'.$field['desc'].'</span>';
                    break;

                case 'category':
                    if($field['taxonomy'] == ''){$field['taxonomy'] = 'category';}
                    $args = array(
                        'selected' => $meta,
                        'echo' => 1,
                        'taxonomy' => $field['taxonomy'],
                        'name' => $field['id']);
                    wp_dropdown_categories($args);
                    break;

                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                    
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    echo '<span class="description"> ' . $field['desc'] . '</span>';
                    break;

                

                case 'select-sidebar':
                    global $wp_registered_sidebars;                     
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    $i = 1;
                    
                    if(get_post_type() == 'post' || get_post_type() == 'services' || get_post_type() == 'page' || get_post_type() == 'work') { 
                        echo '<option value="none">None</option>';
                    }

                    

                    foreach ($wp_registered_sidebars as $sidebar) {  

                        if($meta == '' && $sidebar['name'] == 'Default') {
                            $selected = ' selected="selected"';
                        }else{
                            $selected = '';
                        }

                        if($sidebar['name'] !== 'Footer Widget '.$i){
                            echo '<option', $meta == $sidebar['name'] ? ' selected="selected"' : $selected , ' value="' . $sidebar['name'] . '">', $sidebar['name'], '</option>';
                        }
                        $i++;

                    }

                    echo '</select></br>';
                    echo '<span class="description">' . $field['desc'] . '</span>';
                    break;

                
                
                case 'imageupload':
                      echo '<input type="text"  class="upload-url"  name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $meta, '" size="30"  />',
                        '<input id="st_upload_button" style="margin-left:15px;" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                            </label> 
                            ';
                        echo '<br><span class="description">' . $field['desc'] . '</span>';
                    break;

                case 'sidebar':
                    if($meta == 'right' || $meta == ''){
                        $meta = 'right';
                    }
                    echo '<div class="" style="clear:both">';
                    echo '<style>
                                .sidebar-position-holder { float: left; margin: 0 9px 10px 0px; }
                                .sidebar-position-holder img { background: #fff; border: 1px solid #ccc; cursor: pointer; padding: 2px; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; }
                                .sidebar-position-holder img.sidebar-position-holder-selected,
                                .sidebar-position-holder img:hover { border-color: #464646; -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.05); box-shadow:0 1px 3px rgba(0,0,0,0.05); }
                                .sidebar-position-holder img{width:40px;height:41px}
                            </style>';
                        echo '<div class="sidebar-position-holder ' . ( $meta == 'right' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                            echo '<input type="radio" name="', $field['id'], '" value="right"', $meta == "right" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                            echo '<img src="' . get_template_directory_uri().'/style/img/sidebar-right.png' . '" alt="" title="' . $field['name'] .'" class="sidebar-position-image ' . ( $meta == 'right' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                        echo '</div>';
                        echo '<div class="sidebar-position-holder ' . ( $meta == 'left' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                            echo '<input type="radio" name="', $field['id'], '" value="left"', $meta == "left" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                            echo '<img src="' . get_template_directory_uri().'/style/img/sidebar-left.png' . '" alt="" title="' . $field['name'] .'" class="sidebar-position-image ' . ( $meta == 'left' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                        echo '</div>';
                        echo '<div class="sidebar-position-holder ' . ( $meta == 'fullwidth' ? ' sidebar-position-holder-selected' : '' ) . '" style="position: relative;width: 40px;height: 41px;display: inline-block;">';
                            echo '<input type="radio" name="', $field['id'], '" value="fullwidth"', $meta == "fullwidth" ? ' checked="checked"' : '', ' style="position: absolute;opacity: 0;width: 40px;height: 41px;cursor:pointer;"/>';
                            echo '<img src="' . get_template_directory_uri().'/style/img/no-sidebar.png' . '" alt="" title="' . $field['name'] .'" class="sidebar-position-image ' . ( $meta == 'fullwidth' ? ' sidebar-position-holder-selected' : '' ) . '" />';
                        echo '</div>';
                    echo '</div>';
                    if(isset($_GET['post'])){
                        $current_template = get_post_meta( $_GET['post'], '_wp_page_template', true );
                    }else{
                        $current_template = 'default';
                    }
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            var current_template = '<?php echo $current_template?>';
                            
                            if(current_template == 'page-templates/_work_3_columns.php'){
                                jQuery('#post_meta8').attr('style', 'display:none');
                                jQuery('#post_meta13').attr('style', 'display:none');
                            }else if(current_template == 'page-templates/_work_4_columns.php'){
                                 jQuery('#post_meta8').attr('style', 'display:none');
                                 jQuery('#post_meta13').attr('style', 'display:none');
                            }else if(current_template == 'page-templates/_team-members.php'){
                                 jQuery('#post_meta8').attr('style', 'display:none');
                                 jQuery('#post_meta13').attr('style', 'display:none');
                            }else{
                                 jQuery('#post_meta8').attr('style', 'display:block');
                                 jQuery('#post_meta13').attr('style', 'display:none');
                             }

                        jQuery("#page_template").change(function() {
                            var page_template = jQuery(this).find("option:selected").val();
                            
                            if(page_template == 'page-templates/_work_3_columns.php'){
                                jQuery('#post_meta8').attr('style', 'display:none');
                                jQuery('#post_meta13').attr('style', 'display:none');
                            }else if(page_template == 'page-templates/_work_4_columns.php'){
                                 jQuery('#post_meta8').attr('style', 'display:none');
                                 jQuery('#post_meta13').attr('style', 'display:none');
                            }else if(page_template == 'page-templates/_team-members.php'){
                                 jQuery('#post_meta8').attr('style', 'display:none');
                                 jQuery('#post_meta13').attr('style', 'display:none');
                            }else{
                                 jQuery('#post_meta8').attr('style', 'display:block');
                                 jQuery('#post_meta13').attr('style', 'display:none');
                             }
                        });
                        
                        jQuery('.sidebar-position-holder').live('click', function(){
                            jQuery('.sidebar-position-holder-selected').removeClass('sidebar-position-holder-selected');
                            jQuery('img', this).addClass('sidebar-position-holder-selected');
                        })
                        })
                    </script>
                    <?php
                    break;


                // repeatable
                case 'repeatable':
                    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
                    $i = 0;
                    if ($meta) {
                        foreach($meta as $row) {  if($i==0) {$display = 'style="display:none"';} else { $display='';} 
                            echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" value="'.$row.'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                            $i++;
                        }
                    } else {                     
                        echo '<li><span class="sort hndle"><img  src="'.get_template_directory_uri().'/style/img/drag_arrow.png" /></span>
                                        <input type="text"  class="upload-url"  name="'.$field['id'].'['.$i.']" id="'.$field['id'].'"  id="'.$field['id'].'" size="30" style="width:87%" />
                                        <input id="st_upload_button" class="st_upload_button" type="button" name="upload_button" value="Upload" />
                                        <a class="repeatable-remove button check'.$i.'" rel="'.$i.'" style="display:none;" href="#">-</a></li>';
                    }
                    echo '</ul>
                        <span class="description">'.$field['desc'].'</span>';
                    echo '<a class="repeatable-add button" href="#">+</a> Click to add another meta box';
                break;



                case 'colorpicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="color" value="', $meta ? $meta : $field['std'], '" size="30"/>
                            <input type="button" value="Reset" style="margin-left:15px" name="button'.$field['id'].'" id="button_'.$field['id'].'"/>';
                    echo '<br><span class="description">' . $field['desc'] . '</span>';
                    ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function(){
                                jQuery('#button_<?php echo $field['id']?>').live('click', function(){
                                    jQuery('#<?php echo $field['id']?>').val('<?php echo $field['std']?>');
                                })
                            })
                        </script>
                    <?php break;

                    case 'datepicker':
                    echo '
                        <input id="' . $field['id'] . '" name="' . $field['id'] . '" type="text"  class="admin-datepicker" value="', $meta ? $meta : $field['std'], '" size="30"/>',
                        '<br />', $field['desc']; ?>
                    <?php break;
                
            }
            echo     '<td>',
                '</tr>';
        }

        echo '</table>';
    }

    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if (!wp_verify_nonce(@$_POST['tk_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }

        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            @$new = $_POST[$field['id']];

            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            } 
        }
    }
}

?>