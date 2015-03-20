<?php if (!isset($_SESSION)) {@session_start();}

$number = rand(1, 99999);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$paged++;

        global $wpdb;
        $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'projects' AND post_status = 'publish'");
        if($post_type_ids){
          $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_projects',array('fields' => 'ids') );
        }

        $count_args=array('tax_query' => array(array('taxonomy' => 'ct_projects','field' => 'term_id', 'terms' => $post_type_cats)),  'post_type' => 'projects',  'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>-1);
        $post_count = new WP_Query($count_args);
        $remaining = ($post_count->post_count-(5*($paged-1)));
        if($remaining >= 0){
        ?>   

        <div class="home-portfolio-one home-loadmore load-more-content left load-more-content-<?php echo $number ?>" <?php if(is_home()){echo 'style="margin-top:0"';}?>><div class="bg-load-more left"><a class="add-posts-<?php echo $number ?>"></a></div></div><!--/load-more-content-->

        <?php }?>
        
<script type="text/javascript">
    jQuery(document).ready(function($){
        var container = jQuery('.home-portfolio');
        //LOAD MORE TRIGGER
        $('.add-posts-<?php if($remaining > 0){echo $number;}else{echo '0';} ?>').live('click', function(){
            $('.add-posts-<?php if($remaining > 0){echo $number;}else{echo '0';} ?>').removeClass('add-posts-<?php if($remaining > 0){echo $number;}else{echo '0';} ?>');
            jQuery(container).isotope( 'remove', $('.load-more-content-<?php echo $number ?>' ) );
            jQuery.ajax({
                type: "POST",
                url: "index.php",
                data: {homepaged:<?php echo $paged?>}
            }).done(function( msg ) {
                $newItems = $(msg);
                $('#fakeholder').html('');
                $('#fakeholder').append( $newItems );
                jQuery('#fakeholder').imagesLoaded(function(){
                    var newItems = jQuery('#fakeholder').html();
                    var container = jQuery('.home-portfolio');
                    $newItems = $(newItems);
                    $(container).isotope( 'insert', $newItems );

    // HOVER-IMAGES
    jQuery('.home-portfolio-one').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.12},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });
    
    jQuery('.home-portfolio-one').hover(function(){
       jQuery('div.home-portfolio-hover',this).stop().animate({opacity:1},500);
    },function(){
       jQuery('div.home-portfolio-hover',this).stop().animate({opacity:0},300);
    });
    
    jQuery('.footer-links ul li a').hover(function(){
        jQuery('div',this).stop().animate({top: '-26px'},300);
    },function(){
        jQuery('div',this).stop().animate({top: '0'},300);
    });
    
    jQuery('.scroll-top').hover(function(){
        jQuery('#back-top span',this).stop().animate({top: '-28px'},300);
    },function(){
        jQuery('#back-top span',this).stop().animate({top: '0'},300);
    });
    
    jQuery('.portfolio-images').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });
    
    jQuery('.prev-content').hover(function(){
        jQuery('a',this).stop().animate({left: '-62px'},300);
    },function(){
        jQuery('a',this).stop().animate({left: '0'},300);
    });
    
    jQuery('.next-content').hover(function(){
        jQuery('a',this).stop().animate({right: '-62px'},300);
    },function(){
        jQuery('a',this).stop().animate({right: '0'},300);
    });
    
    jQuery('.blog-right a.pirobox').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });
                })
            })
            return false;
        });

    })
</script>