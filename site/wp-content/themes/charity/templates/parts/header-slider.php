<?php

$use_slider = get_post_meta($wp_query->post->ID, 'tk_use_slider', true);
$use_latest_news = get_post_meta($wp_query->post->ID, 'tk_use_latest_news', true);
$slider_type = get_post_meta($wp_query->post->ID, 'tk_slider_type', true);
$slider_alias = get_post_meta($wp_query->post->ID, 'tk_slider_id', true);
$slider_height = get_theme_option(wp_get_theme()->name .'_general_slider_height');

if($use_slider == 'on'){
    if($slider_type == 'revolution'){
        ?>
        <div class="full-width">
            <div class="demo-2">
            <?php
                if (function_exists('putRevSlider')) {
                    putRevSlider($slider_alias);
                }
            ?>
            </div>
        </div>
<?php }else{?>
    <div class="full-width">
        <div class="demo-2">
            <div id="slider" class="sl-slider-wrapper" style="height: <?php echo $slider_height?>px">
                <div class="sl-slider">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args = array('post_status' => 'publish', 'post_type' => 'slider', 'posts_per_page' => '-1');
                    // The Query
                    $the_query = new WP_Query($args);

                    if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post();
                        $post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                        $post_thumbnail_src = $post_thumbnail['0'];

                        $background_color = get_post_meta($post->ID, 'tk_background_color', true);                
                        $slider_link = get_post_meta($post->ID, 'tk_slider_link', true);
                        $slider_heading_color = get_post_meta($post->ID, 'tk_slider_heading_color', true);
                        $slider_heading_hover_color = get_post_meta($post->ID, 'tk_slider_heading_hover_color', true);
                        $slider_paragraph_color = get_post_meta($post->ID, 'tk_slider_paragraph_color', true);
                        $pattern_upload = get_post_meta($post->ID, 'tk_pattern_upload', true);
                        
                        $image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');                    
                         ?>

                        <style type="text/css">                    
                            .sl-slide .inner<?php echo $post->ID ?> {
                                background:url('<?php echo $image_full[0]; ?>') center no-repeat <?php if(!empty($pattern_upload)){ ?>, url('<?php echo $pattern_upload; ?>') center repeat, <?php } ?> <?php echo $background_color; ?>;          
                            }

                            .sl-slide .inner<?php echo $post->ID ?>  h2,   .inner<?php echo $post->ID ?>  h2 a {
                                color:<?php echo $slider_heading_color  ?>;
                            }

                            .sl-slide .inner<?php echo $post->ID ?>  h2 a:hover {
                                color:<?php echo $slider_heading_hover_color; ?>
                            }

                           .sl-slide .inner<?php echo $post->ID ?> p {
                                color:<?php echo $slider_paragraph_color  ?>;
                            }
                        </style>
                        
                        <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                            
                            <?php if($slider_link) { ?><a href="<?php echo $slider_link; ?>"><?php } ?>
                                <div class="sl-slide-inner inner<?php echo $post->ID; ?>">                                
                                        <div class="bg-img"></div>
                                        <h2><?php the_title()?></h2>
                                        <blockquote><p><?php the_excerpt()?></p></blockquote>
                                </div>
                            <?php if($slider_link) { ?></a><?php } ?>
                            
                        </div>
                    <?php endwhile; ?>
                    <?php endif;?>
                </div><!-- /sl-slider -->

                <nav id="nav-dots" class="nav-dots">
                    <?php if ($the_query->have_posts()): while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <span></span>
                    <?php endwhile; ?>
                    <?php endif;?>
                </nav>

            </div><!-- /slider-wrapper -->
        </div>
    </div>
    <script type="text/javascript">
        jQuery(function($) {
            if(slit_slider_option.slider_autoplay == 'false'){
                var Page = (function() {
                    var $nav = $( '#nav-dots > span' ),
                        slitslider = $( '#slider' ).slitslider( {
                            speed : slit_slider_option.slider_animation_time,
                            // if true the item's slices will also animate the opacity value
                            optOpacity : false,
                            // amount (%) to translate both slices - adjust as necessary
                            translateFactor : 230,
                            // maximum possible angle
                            maxAngle : 25,
                            // maximum possible scale
                            maxScale : 2,
                            // slideshow on / off
                            autoplay : false,
                            // keyboard navigation
                            keyboard : true,
                            // time between transitions
                            interval : slit_slider_option.slider_pause_time,
                            onBeforeChange : function( slide, pos ) {

                                $nav.removeClass( 'nav-dot-current' );
                                $nav.eq( pos ).addClass( 'nav-dot-current' );

                            }
                        } ),
                        init = function() {
                            initEvents();
                        },
                        initEvents = function() {
                            $nav.each( function( i ) {
                                $( this ).on( 'click', function( event ) {
                                    var $dot = $( this );
                                    if( !slitslider.isActive() ) {
                                        $nav.removeClass( 'nav-dot-current' );
                                        $dot.addClass( 'nav-dot-current' );
                                    }
                                    slitslider.jump( i + 1 );
                                    return false;
                                } );
                            } );
                        };
                    return { init : init };
                })();
            }else{
                var Page = (function() {
                    var $nav = $( '#nav-dots > span' ),
                        slitslider = $( '#slider' ).slitslider( {
                            speed : slit_slider_option.slider_animation_time,
                            // if true the item's slices will also animate the opacity value
                            optOpacity : false,
                            // amount (%) to translate both slices - adjust as necessary
                            translateFactor : 230,
                            // maximum possible angle
                            maxAngle : 25,
                            // maximum possible scale
                            maxScale : 2,
                            // slideshow on / off
                            autoplay : true,
                            // keyboard navigation
                            keyboard : true,
                            // time between transitions
                            interval : slit_slider_option.slider_pause_time,
                            onBeforeChange : function( slide, pos ) {

                                $nav.removeClass( 'nav-dot-current' );
                                $nav.eq( pos ).addClass( 'nav-dot-current' );

                            }
                        } ),
                        init = function() {
                            initEvents();
                        },
                        initEvents = function() {
                            $nav.each( function( i ) {
                                $( this ).on( 'click', function( event ) {
                                    var $dot = $( this );
                                    if( !slitslider.isActive() ) {
                                        $nav.removeClass( 'nav-dot-current' );
                                        $dot.addClass( 'nav-dot-current' );
                                    }
                                    slitslider.jump( i + 1 );
                                    return false;
                                } );
                            } );
                        };
                    return { init : init };
                })();
            }
            Page.init();
        });
    </script>
<?php
    } // if slider type
}
?>