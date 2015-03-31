jQuery(function() {
    "use strict";
    var opts = {
        lines: 7, // The number of lines to draw
        length: 9, // The length of each line
        width: 2, // The line thickness
        radius: 0, // The radius of the inner circle
        corners: 1.0, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        color: '#797979', // #rgb or #rrggbb
        speed: 1, // Rounds per second
        trail: 67, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: 'auto', // Top position relative to parent in px
        left: 'auto' // Left position relative to parent in px
    };

    var target1 = document.getElementById('work-slider');
    var spinner1 = new Spinner(opts).spin(target1);
});
jQuery(window).load(function($){
    jQuery('.slider-content').imagesLoaded(function(){
        jQuery('.work-slider').attr('style', 'display:none');
        jQuery('.slider-content').attr('style', 'opacity:1');
    });
})


jQuery(document).ready(function($){

    //MENU   
    jQuery('ul.sf-menu').superfish({ delay: 200 });

    //HORIZONTAL SLIDER
    jQuery('[data-jcarousel]').each(function() {
            var el = $(this);
            el.jcarousel(el.data());
    });

    jQuery('[data-jcarousel-control]').each(function() {
            var el = $(this);
            el.jcarouselControl(el.data());
    });
	


        jQuery('.blog-images').imagesLoaded(function(){
            jQuery('.preloader-image').attr('style', 'display:none');
            jQuery('.blog-images').attr('style', 'opacity:1');
        });
        
        jQuery('.blog-gallery').imagesLoaded(function(){
            jQuery('.preloader-image').attr('style', 'display:none');
            jQuery('.blog-gallery').attr('style', 'opacity:1');
        });

    // TABS
    jQuery( ".tabs" ).tabs({ tabTemplate: '<li><a href="#{href}">#{label}</a></li>' });
    
    var template_dir = template_dir_variables.get_template_dir;
    
            var count = 2;
            jQuery("#room_number").change(function(){               
                var getCount = jQuery('#tabs >ul >li').size();
                var room_number = jQuery('#room_number').val();
                
                //check for room number that is selected and creates that many tabs
                if(room_number > getCount) {
                    var createTabs = room_number - getCount;                                        
                    for(var i = 0; i < createTabs; i++) {
                        jQuery('#tabs').append('<div id="tabs-' + count + '"></div>');                
                        jQuery('#tabs').tabs("add", template_dir+'/ajax.php', 'Room '+count);
                        count++;                        
                    }                    
                }                
                
                //removes the tabs when lower value is selected
                if(room_number < getCount) {
                    var createTabs = getCount - room_number;                    
                    for(var i = 0; i < createTabs; i++) {
                        jQuery('#tabs').tabs('remove', room_number+1);
                        count--;
                    }                     
                }                
                
            });

   


    // toggle box
    jQuery(".toggle-holder").click(function(){
        if ($("h6",this).hasClass('active-togle-img')){
            $("h6",this).removeClass('active-togle-img');
        } else if ($("h6",this).hasClass('') || $("h6",this).hasClass('no-active-togle-img')){
            $("h6",this).addClass('active-togle-img');
        }
        $("p",this).slideToggle("slow");
        $("p",this).removeClass("no-active-togle"); 
    });

    // Gallery Video
   jQuery(".youtube").click(function() {
        $.fancybox({
            'padding' : 0,
            'autoScale' : false,
            'transitionIn': 'elastic',
            'transitionOut' : 'elastic',
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
            'transitionIn': 'elastic',
            'transitionOut'	: 'elastic',
            'title':  this.title,
            'width': 520,
            'height': 300,
            'href': this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
            'type': 'swf'
        });
        return false;
    });
    
    //fancybox for text
    jQuery(".fancytext").fancybox({
        openEffect  : 'none',
        closeEffect : 'none'
    });

    jQuery(".fancyboxtest").click(function() {
            
            //Contact page map  
                jQuery.fancybox({
                    'autoScale': true,
                    'transitionIn': 'elastic',
                    'transitionOut': 'elastic',
                    'speedIn': 500,
                    'speedOut': 300,
                    'autoDimensions': true,
                    'centerOnScroll': true,
                    'href' : '#map_fancy'                 
            });
            google.maps.event.trigger(mapa, 'resize');
            jQuery("#map_fancy").attr('style', 'position:relative; opacity:1; z-index:10;');
            
            
     });


                
        jQuery('#tabs .tab-text-down').on('a', function(){
            jQuery.fancybox({
                'autoScale': true,
                'transitionIn': 'elastic',
                'transitionOut': 'elastic',
                'speedIn': 500,
                'speedOut': 300,
                'autoDimensions': true,
                'centerOnScroll': true,
                'href' : '#text-room-fancy'
            });
        });
        
        
        jQuery(".button-header-contact a").click(function(){
            jQuery(".header-contact-content").slideToggle("slow");
        });
        
        
        jQuery(function() {
			
            var Page = (function() {

                    var $navArrows = jQuery( '#nav-arrows' ),
                            $nav = jQuery( '#nav-dots > span' ),
                            slitslider = jQuery( '#slider' ).slitslider( {
                                    onBeforeChange : function( slide, pos ) {

                                            $nav.removeClass( 'nav-dot-current' );
                                            $nav.eq( pos ).addClass( 'nav-dot-current' );

                                    }
                            } ),

                            init = function() {

                                    initEvents();

                            },
                            initEvents = function() {

                                    // add navigation events
                                    $navArrows.children( ':last' ).on( 'click', function() {

                                            slitslider.next();
                                            return false;

                                    } );

                                    $navArrows.children( ':first' ).on( 'click', function() {

                                            slitslider.previous();
                                            return false;

                                    } );

                                    $nav.each( function( i ) {

                                            jQuery( this ).on( 'click', function( event ) {

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

            Page.init();

    });

    //AUDIO
    jQuery("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
                jQuery(this).jPlayer("setMedia", {
                        m4a:"http://www.jplayer.org/audio/m4a/TSP-01-Cro_magnon_man.m4a",
                        oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
                });
        },
        swfPath: "js",
        supplied: "m4a, oga",
        wmode: "window"
    });


    // FANCYBOX
    jQuery('.fancybox').fancybox();

    
    //Sub menu borders
    jQuery(".sf-menu ul li:first-child").before('<li class="sub-menu-top"></li>');
    jQuery(".sf-menu ul li:last-child").after('<li class="sub-menu-bottom"></li>');
    
});


    // FLEXSLIDER
    jQuery(window).load(function() {
            jQuery('.flexslider').flexslider({
                controlNav: true,
                slideshow: false,
                controlsContainer: ".flex-container"
            });
    });

jQuery('.datepicker').datepicker();


jQuery(function() {


    jQuery("<select />").appendTo(".nav nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo("nav select");

    // Populate dropdown with menu items
    jQuery(".nav nav a").each(function() {
    var el = jQuery(this);
    jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo(".nav nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery(".nav nav select").change(function() {
    window.location = jQuery(this).find("option:selected").val();
    });
    
    
    
});