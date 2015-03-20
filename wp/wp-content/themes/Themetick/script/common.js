jQuery(window).load(function() {
    jQuery('.flexslider').flexslider();
});


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


jQuery(document).ready(function(){
    var container = jQuery('.portfolio-content');
    jQuery(container).imagesLoaded(function(){
        jQuery('.portfolio-loader').attr('style', 'display:none');
        jQuery(container).show().animate({opacity:1},1000);
        jQuery('.add-holder').show();
        jQuery(container).isotope({
            itemSelector: '.speakers-one',
            isAnimated: true,
            animationEngine : 'jquery',
            animationOptions: {
                duration: 1000,
                easing: 'easeInOutBack',
                queue: false
            }
        });
    });

    jQuery('.portfolio-img-loaded').imagesLoaded(function(){
        jQuery('.portfolio-loader2').attr('style', 'display:none');
        jQuery('.speaker-show').attr('style', 'display:block');
    })

    jQuery('#filters a').click(function(){
        var selector = jQuery(this).attr('data-filter');       
        jQuery(container).isotope({ filter: selector });
        return false;
    });

jQuery('.cat_cell a').click(function() {
  jQuery('#filters li').removeClass('cat_cell_active');
  jQuery('#filters li a').removeClass('cat_cell_active');
  jQuery(this).addClass('cat_cell_active');
});

jQuery('.slider-home').mouseenter(function() {
 jQuery('.back').animate({
    opacity: 1,
    left: '-=60'
  }, 500, function() {
    // Animation complete.
  });

   jQuery('.forward').animate({
    opacity: 1,
    right: '-=60'
  }, 500, function() {
    // Animation complete.
  });
});

jQuery('.slider-home').mouseleave(function() {
 jQuery('.back').animate({
    opacity: 0,
    left: '+=60'
  }, 500, function() {
    // Animation complete.
  });

 jQuery('.forward').animate({
    opacity: 0,
    right: '+=60'
  }, 500, function() {
    // Animation complete.
  });

});


   
    jQuery(".nav .sub-menu  li:first-child").before('<li class="sub-menu-top"></li>');
    jQuery(".nav .sub-menu  li:last-child").after('<li class="sub-menu-bottom"></li>');

    //MENU
    jQuery("ul.sf-menu").superfish();

    jQuery('.sf-menu li:last').attr('style', 'padding-right: 0; background: none; margin-right: 0');
    jQuery('.stay-tuned ul li span').attr('style', 'opacity:0.3');
    jQuery('.box-text-home .box-text-one:last').attr('style', 'margin:0');
    jQuery('.ui-widget-header li:last').attr('style', 'margin-right: 0; padding-right: 0; background: none');
    jQuery('.bg-business-days ul:last').attr('style', 'margin: 0 0 0 2px');
    jQuery('#recentcomments li:last').attr('style', 'margin: 0; padding: 0; border:none');
    jQuery('.widget-categories ul li:last').attr('style', 'border: none; margin: 0; padding: 0');
    jQuery('.sidebar_widget_holder .app_recent_comments:last').attr('style', 'margin: 0; padding: 0; border:none');
    jQuery('.gallery-filter ul li:last').attr('style', 'margin-right: 0; padding-right: 0; background: none');
    jQuery('.gallery-content .speakers-row:last').attr('style', 'margin-bottom: 0; padding-bottom: 0; border:none');



        // Tabs
      jQuery('#tabs').tabs();

        //hover states on the static widgets
        jQuery('#dialog_link, ul#icons li').hover(
                function() { jQuery(this).addClass('ui-state-hover'); },
                function() { jQuery(this).removeClass('ui-state-hover'); }
       );




    // PIRO BOX
    jQuery().piroBox({
        my_speed: 300, //animation speed
        bg_alpha: 0.5, //background opacity
        slideShow : 'true', // true == slideshow on, false == slideshow off
        slideSpeed : 3, //slideshow
        close_all : '.piro_close' // add class .piro_overlay(with comma)if you want overlay click close piroBox
    });





    // HOVER-IMAGES
    jQuery('.galery-one a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });


    jQuery('.speakers-single-images a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });


    jQuery('.blog-bg-images a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });




    //HORIZONTAL SLIDER
    jQuery('#mycarousel').jcarousel({
        animation: 300,
        wrap: 'circular',
        scroll: 1,
        auto: 2
    });




    jQuery('.jcarousel-item').each(function(){
            var cont = jQuery(this).html();
            var link = jQuery(this).attr('rev');
            var title = jQuery('img',this).attr('rev');
            jQuery(this).html('<a href="'+link+'" title="'+title+'">'+cont+'<div class="image-preview-horizontal"></div></a>');
            jQuery('img',this).stop().animate({opacity:1},0);
    });


    jQuery('.jcarousel-prev-horizontal').each(function(){
            jQuery(this).html('<span></span>');
    });



    jQuery('.jcarousel-skin-tango .jcarousel-item a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });





    // hide #back-top first
    jQuery("#back-top").hide();

    // fade in #back-top
    jQuery(function () {
            jQuery(window).scroll(function () {
                    if (jQuery(this).scrollTop() > 100) {
                            jQuery('#back-top').fadeIn();
                    } else {
                            jQuery('#back-top').fadeOut();
                    }
            });

            // scroll body to 0px on click
            jQuery('#back-top a').click(function () {
                    jQuery('body,html').animate({
                            scrollTop: 0
                    }, 800);
                    return false;
            });
    });

    var tagfix = jQuery('.tagcloud a').html();
    jQuery('.tagcloud a').each(function(){
            var tagfix = jQuery(this).html();
            jQuery(this).html('').append('<div class="tags-button left"><div class="tag-left left"></div><div class="tag-center left">'+tagfix+'</div><div class="tag-right left"></div>');
    });


jQuery('.nav .sub-menu').each(function(){
     jQuery(this, 'li').eq(-2).css('background-color', 'red');
});

jQuery(".nav .sub-menu li:last").prev("li").addClass('test');


});
