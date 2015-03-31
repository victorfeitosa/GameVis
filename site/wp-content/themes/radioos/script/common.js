jQuery(function(){
    var opts = {
    lines: 9, // The number of lines to draw
    length: 6, // The length of each line
    width: 2, // The line thickness
    radius: 5, // The radius of the inner circle
    corners: 0.4, // Corner roundness (0..1)
    rotate: 0, // The rotation offset
    color: '#FFF', // #rgb or #rrggbb
    speed: 1, // Rounds per second
    trail: 60, // Afterglow percentage
    shadow: true, // Whether to render a shadow
    hwaccel: false, // Whether to use hardware acceleration
    className: 'spinner', // The CSS class to assign to the spinner
    zIndex: 2e9, // The z-index (defaults to 2000000000)
    top: 'auto', // Top position relative to parent in px
    left: 'auto' // Left position relative to parent in px
  };
  var target = document.getElementById('portfolio-loader');
  var spinner = new Spinner(opts).spin(target);
})

jQuery(document).ready(function($){

    jQuery('.portfolio-images').imagesLoaded(function(){
        jQuery('.portfolio-images').attr('style', 'display:block');
        jQuery('.portfolio-loader').attr('style', 'display:none');

    })

    //MENU
    $('ul.sf-menu').superfish({
        delay:       1000,
        animation:   {opacity:'show',height:'show'}
    });

    //LOAD ISOTOPE
    var container = jQuery('.home-portfolio');
    jQuery(container).imagesLoaded(function(){
        jQuery('.ajax_holder').attr('style', 'display:block');
        jQuery(container).show().animate({opacity:1},1000);
        jQuery(container).isotope({
            itemSelector : '.home-portfolio-one',
            isAnimated: true,
            animationEngine : 'jquery',
            animationOptions: {
                duration: 800,
                easing: 'easeInOutCubic',
                queue: false
            },
        getSortData : {
          category : function( $elem ) {
            return $elem.attr('data-category');
          }
        }
        });
    });

    // PIRO BOX
    jQuery().piroBox({
        my_speed: 300, //animation speed
        bg_alpha: 0.5, //background opacity
        slideShow : 'true', // true == slideshow on, false == slideshow off
        slideSpeed : 3, //slideshow
        close_all : '.piro_close' // add class .piro_overlay(with comma)if you want overlay click close piroBox
    });

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

});


jQuery(function($) {

    jQuery("<select />").appendTo("nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo("nav select");

    // Populate dropdown with menu items
    jQuery("nav a").each(function() {
    var el = $(this);
    jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo("nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery("nav select").change(function() {
    window.location = $(this).find("option:selected").val();
    });

});