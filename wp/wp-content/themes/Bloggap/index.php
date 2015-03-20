<?php get_header();
$prefix = 'tk_';
?>

        <!-- CONTENT -->
        <div class="content front-page right">

                <?php
                    $show_fullcontent = get_theme_option(tk_theme_name.('_general_show_fullcontent'));

                    $c = 1;
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                    $args=array('post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'ignore_sticky_posts'=> 1);

                    //The Query
                    query_posts($args);

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $format = get_post_format();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                    $image_blog = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog');
                   
                    $categories = get_the_category();
                    $cat_count = count($categories);

                    $undertitle = get_post_meta($post->ID, $prefix.'undertitle', true);
                    $post_color = get_post_meta($post->ID, $prefix.'color', true);
                    $headline_color = get_post_meta($post->ID, $prefix.'headline', true);
                    $headline_hover_color = get_post_meta($post->ID, $prefix.'headline_hover', true);
                    $undertitle_color = get_post_meta($post->ID, $prefix.'undertitle_color', true);
                    $paragraph = get_post_meta($post->ID, $prefix.'paragraph', true);
                    $readmore = get_post_meta($post->ID, $prefix.'readmore', true);
                    $readmore_hover = get_post_meta($post->ID, $prefix.'readmore_hover', true);
                ?>


           
            <!-- POST COLORS -->
            <style type="text/css">
                .single-color<?php echo $c; ?> {
                    background-color:#<?php echo $post_color ?>;
                }

                .single-color<?php echo $c; ?> .blog-title a {
                    color:#<?php echo $headline_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-title a:hover {
                    color:#<?php echo $headline_hover_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-title p {
                    color:#<?php echo $undertitle_color; ?>;
                }

                .single-color<?php echo $c; ?> .blog-text p, .single-color<?php echo $c; ?> .shortcodes ol li, .shortcodes ul li {
                    color:#<?php echo $paragraph; ?>;
                }

                .single-color<?php echo $c; ?> .blog-read-more a, .single-color<?php echo $c; ?> .shortcodes .more-link {
                    color:#<?php echo $readmore; ?>;
                }

                .single-color<?php echo $c; ?> .blog-read-more a:hover, .single-color<?php echo $c; ?> .shortcodes .more-link:hover {
                    color:#<?php echo $readmore_hover; ?>;
                }
            </style>



            <div class="blog-wrap single-color<?php echo $c; ?> magicpixel ">
            <!--Post Standard-->
            <div class="blog-one left">
                <div class="background-color"></div>
                <?php if($format =='' || $format =='') { ?>
                     <?php if(has_post_thumbnail()) { ?>
                        <div class="blog-images left">
                            <div class="topborder"></div>
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/></a>
                            <div class="gallery-hover">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
                            </div>
                        </div><!--/blog-images-->
                        
                    <?php } ?>


                <!-- IMAGE POST -->
                <?php } elseif ($format == 'image' || $format == '') {   ?>
                <?php if(has_post_thumbnail()) { ?>
                    <div class="blog-images <?php  if($format =='image' || $format == ''){ ?>image-margin<?php } ?> left">
                        <a href="<?php echo $image[0]; ?>" class="fancybox"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/></a>

                        <?php if($format =='image' || $format == '') {?>
                            <div class="gallery-hover">
                                <a href="<?php echo $image[0]; ?>" class="fancybox" title="<?php the_title(); ?>"></a>
                            </div>
                        <?php } ?>
                    </div><!-- blog-images -->                    
                <?php } ?>


                    <!--VIDEO POST TYPE-->
                <?php } elseif($format =='video') {
                    $video_link = get_post_meta($post->ID, $prefix.'video_link', true);
                    if($video_link){
                    ?>
                    <div class="blog-video left"><?php echo tk_video_player($video_link); ?></div><!--/blog-video-->
                <?php } ?>
                  
                
                
                
                <!--AUDIO POST TYPE-->
                <?php } elseif ($format =='audio') {  ?>
                        <div class="blog-text-content right  <?php if($sidebar_postition == 'fullwidth'){echo 'blog-fullwidth';}?>">
                            <div class="blog-player-content left">
                                <div class="blog-player left">
                                    <div class="home-latest-news-border-img left"></div>

                                            <?php tk_jplayer($post->ID); ?>
                                            <div id="jquery_jplayer_<?php echo $post->ID?>" class="jp-jplayer"></div>
                                            <div id="jp_container_<?php echo $post->ID?>" class="jp-audio">
                                                <div class="jp-type-single">
                                                    <div class="jp-gui jp-interface" id="jp_interface_<?php echo $post->ID; ?>">
                                                <ul class="jp-controls">
                                                    <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                                    <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                                    <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                                    <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                                </ul>
                                                <div class="jp-progress <?php if($sidebar_postition == 'fullwidth'){echo 'single-audio-fullwidth';}?>">
                                                    <div class="jp-seek-bar">
                                                        <div class="jp-play-bar"></div>
                                                    </div>
                                                </div>
                                                <div class="jp-volume-bar">
                                                    <div class="jp-volume-bar-value"></div>
                                                </div>
                                            </div><!--/jp-gui jp-interface-->
                                        </div><!--/jp-type-single-->
                                    </div><!--/jp-audio-->
                                </div><!--/blog-player-->                              
                            </div>
                        </div><!--/blog-text-content-->
                    
                   

                          <!-- QUOTE POST TYPE -->
                          <?php } elseif($format == 'quote'){
                                $quote_text = get_post_meta($post->ID, $prefix.'quote', true);
                                $quote_author = get_post_meta($post->ID, $prefix.'quote_author', true);
                                if(!empty($quote_text)  || !empty($quote_author)) {
                            ?>
                          <div class="post-quote left">
                            <img src="<?php echo get_template_directory_uri(); ?>/style/img/post-quote.png" alt="quote icon" />
                            <span><?php echo $quote_text; ?></span>
                            <p><?php echo $quote_author; ?></p>
                        </div><!--/post-quote-->

                     <?php } ?>


                    <!-- LINK POST FORMAT -->
                    <?php } elseif($format == 'link'){
                        $link_text = get_post_meta($post->ID, $prefix.'link_text', true);
                        $link_url = get_post_meta($post->ID, $prefix.'link_url', true);
                    ?>

                <div class="blog-link left">
                    <img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-link-image.png" alt="link icon" />
                    <div class="post-link-top right"><a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a></div><!--/post-link-top-->
                    <div class="post-link-down right"><a href="<?php echo $link_url; ?>"><?php echo $link_url; ?></a></div><!--/post-link-down-->
                </div><!--/blog-link-->



                <!-- GALLERY POST FORMAT -->
                <?php
                     } elseif($format == 'gallery') {
                    $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                ?>
                <div class="blog-gallery left">
                     <div class="flexslider">
                        <ul class="slides">
                            <?php foreach($slide_images as $the_image) { ?>
                                <li>
                                    <img src="<?php tk_get_thumb(942, 357, $the_image); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
                                </li>
                            <?php } ?>
                        </ul>
                    </div><!--/flexslider-->
                </div><!--/blog-gallery-->
                <?php } ?>



               <?php  if($format !=='image'){ ?>
                <?php if($format !== 'aside') { ?>
                    <div class="blog-category left">
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-1.png" alt="" /></li>
                            <?php
                                $i = 1;
                                foreach($categories as $cats) {
                                $cat_link = get_category_link($cats->term_id);

                                if($cat_count !== $i) {
                                    $comma =', ';
                                } else {
                                    $comma = '';
                                }
                                    ?>

                                <li><a href="<?php echo $cat_link; ?>"><?php echo $cats->name; ?><?php echo $comma; ?></a></li>
                            <?php $i++; } ?>

                        </ul>
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-2.png" alt="images" title="images"  /></li>
                            <li><span><?php the_time(get_option('date_format')); ?></span></li>
                        </ul>
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-3.png" alt="images" title="images"  /></li>
                            <li><a href="<?php echo comments_link().'/#respond' ?>"><?php comments_number( __('No Comments'), __('One Comment'), __('% Comments') ); ?>.</a></li>
                        </ul>
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/style/img/blog-icon-4.png" alt="images" title="images"  /></li>
                            <li><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></li>
                        </ul>
                    </div><!--/blog-category-->
                     <?php } ?>


                    <!-- ASIDE POST FORMAT -->
                    <?php if($format !== 'aside') { ?>
                    <div class="blog-title left">                        
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                        
                        <?php if($undertitle){ ?><p><?php echo $undertitle; ?></p><?php } ?>
                    </div><!--/blog-title-->
                    <?php } ?>


                <div class="blog-text shortcodes left">
                    <?php if($show_fullcontent == 'yes') { ?>
                        <?php the_content( 'Read More'); ?>
                    <?php } else { ?>
                        <p><?php the_excerpt_length(3000); ?></p>
                    <?php } ?>
                </div><!--/blog-text-->
                    <?php if($show_fullcontent !== 'yes') { ?>
                        <div class="blog-read-more left"><a href="<?php the_permalink(); ?>"><?php _e('Read more...', tk_theme_name); ?></a></div><!--/blog-read-more-->
                    <?php } ?>
                <?php } ?>

            </div><!--/blog-one-->
            <div class="clear"></div>
            </div><!-- blog-wrap -->

            <?php $c++; endwhile; endif; ?>




            <!-- PAGINATION -->
            <div class="blog-one">
                <div class="pagination right">
                    <?php
                        global $wp_query;

                        $big = 999999999; // need an unlikely integer

                        echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages
                        ));
                    ?>
                </div><!--/pagination-->
            </div>


            
        </div><!--/content-->
    </div><!--/wrapper-->



<?php get_footer(); ?>