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

    //LOAD ISOTOPE
    var container = jQuery('.gallery-images-content');
    jQuery(container).imagesLoaded(function(){
        jQuery('.portfolio-loader').attr('style', 'display:none');
        jQuery(container).show().animate({opacity:1},1000);
        jQuery('.gallery-images-content').show();
        jQuery(container).isotope({
            layoutMode : 'fitRows' ,
            itemSelector: '.gallery-images-one',
            isAnimated: true,
            animationEngine : 'jquery',
            animationOptions: {
                duration: 800,
                easing: 'easeOutCubic',
                queue: false
            }
        });
    });

    jQuery('.gallery-filter ul a').click(function(){
        var selector = jQuery(this).attr('data-filter');
        jQuery(container).isotope({filter: selector});
        return false;
    });

    jQuery(container).imagesLoaded(function(){
        jQuery('#portfolio-loader').attr('style', 'display:none');
        jQuery('.gallery-images-one img').attr('style', 'display:inline-block');
    });

    jQuery(container).imagesLoaded(function(){
        jQuery('#portfolio-loader').attr('style', 'display:none');
        jQuery('.blog-images img').attr('style', 'display:inline-block');
    });


    jQuery('.gallery-filter a').each(function(){
        jQuery(this).click(function(){
           jQuery('.gallery-filter a').each(function(){
             jQuery(this).removeClass('active-project');
       });
            jQuery(this).addClass('active-project');
        });
    });



});



