jQuery(document).ready(function($){


    // nav
    $(".button-menu a").click(function(){
        $(".nav").slideToggle("slow");
        $(".nav").removeClass("active-nav");
    });


    // HOVER-IMAGES
    jQuery('.gallery-images-one, .blog-images').hover(function(){
       jQuery('.gallery-hover',this).stop().animate({opacity:1},300);
       jQuery('.gallery-hover',this).css("display","block");
       jQuery('.gallery-hover-title',this).stop().animate({top: '20%'},300);
       jQuery('.gallery-hover-icon',this).stop().animate({bottom: '20%'},300);
    },function(){
       jQuery('.gallery-hover',this).stop().animate({opacity:0},300);
       jQuery('.gallery-hover-title',this).stop().animate({top: '-15%'},500);
       jQuery('.gallery-hover-icon',this).stop().animate({bottom: '-15%'},500);
       jQuery('.gallery-hover',this).fadeOut(300);
    });


   //PANEL SLIDER
    jQuery(".btn-slide").click(function(){
    var getclass = jQuery(this).attr('class').split(' ')[1];

        if(getclass !=='active') {
             jQuery('html, body').animate({
                        scrollTop: jQuery(".footer").offset().top
             }, 500);
        }
        
        jQuery("#panel").slideToggle("slow");
        jQuery(this).toggleClass("active"); return false;
    });


    // toggle box
    jQuery(".toggle-boxes ul li").click(function(){
        if (jQuery("h6",this).hasClass('active-togle-img')){
            jQuery("h6",this).removeClass('active-togle-img');
            jQuery("h6",this).addClass('no-active-togle-img');
        } else if (jQuery("h6",this).hasClass('') || jQuery("h6",this).hasClass('no-active-togle-img')){
            jQuery("h6",this).addClass('active-togle-img');
            jQuery("h6",this).removeClass('no-active-togle-img');          
        }
        jQuery("p",this).slideToggle("slow");
        jQuery("p",this).removeClass("no-active-togle");
    });



    jQuery(".fancybox").fancybox({
        helpers:  {
            title:  null
        }
    });

    jQuery(".video").click(function() {
        jQuery.fancybox({
                        'padding' : 0,
                        'autoScale' : false,
                        'transitionIn': 'none',
                        'transitionOut' : 'none',
                        'title' : this.title,
                        'width' : 680,
                        'height' : 495,
                        'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
                        'type': 'swf',
                        'swf': {
                            'wmode': 'transparent',
                            'allowfullscreen': 'true'
                            }
            });
            return false;
    });

    jQuery(".vimeo").click(function() {
        jQuery.fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut'	: 'none',
            'title':  this.title,
            'width': 520,
            'height': 300,
            'href': this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
            'type': 'swf'
        });
        return false;
    });


var windowheight = jQuery(window).height();
jQuery('.scroll').attr('style', 'max-height:'+ windowheight+'px');
jQuery('.content').attr('style', 'min-height:'+windowheight+'px;');
jQuery('.nav ul li').has('.sub-menu').addClass('has_children');
jQuery('.has_children').prepend('<div class="submenu-hover closed"></a>');
    
  var browserwidth =  jQuery(document).width();

  jQuery(window).resize(function() {
          if(browserwidth > 1013) {
              jQuery('.nav ul .closed').removeClass('closed');
          } else {
              jQuery('.nav ul .submenu-hover').addClass('closed');
          }
  });


    jQuery('.nav ul .closed').click(function() {
        jQuery(this).toggleClass("activedrop");
        jQuery(this).siblings('.sub-menu').slideToggle('slow', function() {
            // Animation complete.
        });
    });    
jQuery('.current-menu-item').parents('.sub-menu').attr('style', 'display:block;');

});



