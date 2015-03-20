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
  var target2 = document.getElementById('portfolio-loader2');
  var spinner2 = new Spinner(opts).spin(target2);
})


jQuery(document).ready(function(){
    var container = jQuery('.portfolio-images');
    jQuery(container).imagesLoaded(function(){
        jQuery('.portfolio-loader').attr('style', 'display:none');
        jQuery(container).show().animate({opacity:1},1000);
        jQuery('.add-holder').show();
        jQuery(container).isotope({
            itemSelector: '.portfolio-images-one',
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
        jQuery('.portfolio-single').attr('style', 'display:block');
    })
    
    jQuery('#filters a').click(function(){
        var selector = jQuery(this).attr('data-filter');
        jQuery(container).isotope({ filter: selector });
        
        return false;
    });




    //MENU
    jQuery("ul.sf-menu").superfish();
    
    jQuery('.breadcrumbs-content ul li:last').attr('style', 'background:none');
    
    jQuery('.tagcloud .widget-tags-button:last').attr('style', 'background: none; padding: 0; margin-right: 0');
    
    jQuery('.stay-tuned ul li a:last').attr('style', 'margin: 0');






    // FLEXSLIDER
    
    jQuery(window).load(function() {
            jQuery('.flexslider').flexslider();
    });



    // PREVENT EMPTY SEARCH
    
    jQuery('.submit-search-form').click(function(e){
        e.preventDefault();
        var search_val = jQuery('.search-input', this).val();
        if(search_val != ""){
            jQuery(this).submit();
        }
    });





    //PANEL SLIDER

    var getcookie = getCookie('panel');
    if(getcookie == null){setCookie('panel', 'on', 0)}
    if (getcookie == 'off'){
        jQuery('#panel').attr('style', 'display:none')
        jQuery('.btn-slide').addClass('active')
    }

    jQuery(".btn-slide").live('click', function(){
        var test = getCookie('panel');
        if(test == 'on'){
            jQuery("#panel").animate({height: 'hide'}, {duration: 'slow' });
            jQuery(this).addClass("active");
            setCookie('panel', 'off', 0)
            return false;
        }

        if(test == 'off'){
            jQuery("#panel").animate({height: 'show'}, {duration: 'slow' });
            jQuery(this).removeClass("active");
            setCookie('panel', 'on', 0)
            return false;
        }

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
    jQuery('.portfolio-images-one').hover(function(){
       jQuery('.portfolio-hover',this).stop().animate({opacity:1},500);
    },function(){
       jQuery('.portfolio-hover',this).stop().animate({opacity:0},300);
    });
    
    jQuery('.blog-images-content').hover(function(){
       jQuery('.blog-images-hover',this).stop().animate({opacity:1},500);
    },function(){
       jQuery('.blog-images-hover',this).stop().animate({opacity:0},300);
    });

    
});


jQuery(function() {

    jQuery("<select />").appendTo(".menu-icon-content nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo(".menu-icon-content nav select");

    // Populate dropdown with menu items
    jQuery(".menu-icon-content nav a").each(function() {
    var el = jQuery(this);
    jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo(".menu-icon-content nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery(".menu-icon-content nav select").change(function() {
    window.location = jQuery(this).find("option:selected").val();
    });

});


/*
jQuery(function() {


    jQuery("<select />").appendTo(".nav-help-header nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo(".nav-help-header nav select");

    // Populate dropdown with menu items
    jQuery(".nav-help-header nav a").each(function() {
    var el = $(this);
    jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo(".nav-help-header nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery(".nav-help-header nav select").change(function() {
    window.location = $(this).find("option:selected").val();
    });

});

*/

jQuery(function() {


    jQuery("<select />").appendTo(".portfolio-home-category nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo(".portfolio-home-category nav select");

    // Populate dropdown with menu items
    jQuery(".portfolio-home-category nav a").each(function() {
    var el = jQuery(this);
    jQuery("<option />", {
       "data-filter"   : el.attr("data-filter"),
       "text"    : el.text()
    }).appendTo(".portfolio-home-category nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery(".portfolio-home-category select").change(function() {
        var container = jQuery('.portfolio-images');
        var selector = jQuery(this).find("option:selected").attr('data-filter');
        jQuery(container).isotope({ filter: selector });
        return false;
    });

});

function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function deleteCookie(name) {
    setCookie(name,"",-1);
}