<?php
/*
Template Name: Archives
*/
get_header();
$prefix = 'tk_';
$sidebar_position = get_post_meta(get_option('id_blog_page'), $prefix.'sidebar_position', true);

        if(isset($page_title)) {
            $archive_title = $page_title;
        }else {
            $archive_title = get_body_class();
        }
?>



    <!-- CONTENT -->
    <div class="content left">
        <div class="wrapper">



            <!--SIDBAR-->

           








            <div class="page-content left">


            <?php
               
                $args=array('post_status' => 'publish', 'ignore_sticky_posts'=> 1);

                //The Query
                query_posts($args);

                //The Loop
                while ( have_posts() ) : the_post();
                $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                $embed_code = wp_oembed_get($video_link, array('width'=>660));

                $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                $images = '';
                 if(!empty($slide_images)){
                     foreach($slide_images as $slide) {
                         if($slide != ''){
                         $images .= '<img src="'.tk_get_thumb_new(648, 330, $slide).'"/>';
                             }
                         }
                     }
            ?>


                <div class="blog-one left">
                    <div class="blog-title left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div><!--/blog-title-->
                    <div class="blog-comments-date left">
                        <div class="blog-comments left">Comments <?php comments_number( '0', '1', '%' ); ?></div><!--/blog-comments-->
                        <div class="blog-date left">-  <?php the_author_posts_link(); ?> on <?php echo get_the_date()?> in <?php echo get_the_category_list( '&#10;', $post->ID ); ?> </div><!--/blog-date-->
                    </div><!--/blog-comments-date-->

                      <?php if($video_link){?>
                                    <div class="blog-one-video left"><?php echo $embed_code;?></div><!--blog-one-video-->
                    <?php } elseif(!empty($images)) { ?>
                    <div class="blog-bg-images left">
                        <div id="slider-nivo">
                            <div id="slider-nivo<?php echo $i;?>" class="slider-nivo">
                                <?php echo $images; ?>
                            </div>
                        </div>
                    </div><!--/slider-wrapper-->

                        </div>
                    </div><!--/slider-wrapper-->

<?php
                    } elseif(has_post_thumbnail()){
                        $default_attr = array( 'alt' =>get_the_title(), 'title' =>get_the_title());
                        ?>
                        <div class="blog-bg-images left"><a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail('single', $default_attr); ?></a></div><!--/blog-bg-images-->
                    <?php } ?>

                    <div class="blog-text left"><?php the_excerpt(); ?></div><!--/blog-text-->
                    <div class="blog-read-more left"><a href="<?php echo the_permalink(); ?>">read more</a></div><!--/blog-read-more-->
                </div><!--/blog-one-->


                <?php endwhile;  ?>

            <div class="pagination">
                <?php
                global $wp_query;

                $big = 999999999; // need an unlikely integer

                $pageing =  paginate_links( array(
                        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                ) );
                $search_array = array('<span','</span>', '<a', '</a>');
                $replace_array = array(

                   '<div class="pag-wrap"><div class="pagination-left left"></div><span',
                   '</span><div class="pagination-right left"></div></div>',
                   '<div class="pag-wrap"><div class="pagin-button"><div class="pagination-left left"></div><a',
                   '</a><div class="pagination-right left"></div></div></div>',
                    );
               $pageing = str_replace($search_array, $replace_array, $pageing);
                echo $pageing;
                ?>
            </div>



            </div><!--/page-content-->

        <?php tk_get_right_sidebar('Right', 'Archive/Search')?>
        </div><!--/wrapper-->
    </div><!--/content-->


<?php get_footer(); ?>