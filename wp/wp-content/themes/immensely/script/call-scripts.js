this.screenshotPreview = function(){	
		
    xOffset = 10;
    yOffset = 30;
		
    $("a.screenshot").hover(function(e){
            this.t = this.title;
            this.title = "";
            var c = (this.t != "") ? "<br/>" + this.t : "";
            $("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");
            $("#screenshot")
                    .css("top",(e.pageY - xOffset) + "px")
                    .css("left",(e.pageX + yOffset) + "px")
                    .fadeIn("fast");
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


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
    jQuery('.fourths, .slider-content').imagesLoaded(function(){
        jQuery('.work-slider').attr('style', 'display:none');
        jQuery('.fourths, .slider-content').attr('style', 'opacity:1');
    });
})


this.screenshotPreview = function($){

    xOffset = 10;
    yOffset = 30;

    jQuery("a.screenshot").hover(function(e){
            this.t = this.title;
            this.title = "";
            var c = (this.t != "") ? "<br/>" + this.t : "";
            jQuery("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");
            jQuery("#screenshot")
                .css("top",(e.pageY - xOffset) + "px")
                .css("left",(e.pageX + yOffset) + "px")
                .fadeIn("fast");
        },
        function(){
            this.title = this.t;
            jQuery("#screenshot").remove();
        });
    jQuery("a.screenshot").mousemove(function(e){
        jQuery("#screenshot")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px");
    });
};
jQuery(document).ready(function($){
    
    var navbar = $('.navbar');
    var navbarHeight = $('.navbar').height() - 2;
        $('.fake-navbar').height(navbarHeight);    
    
    //hover slika
    
    var logoHeight = $('#container .navbar .brand').height();
    
    if($(window).width() > 980){
        $('.nav-collapse.collapse').height(logoHeight);
    }
    
    screenshotPreview();

    
    jQuery('.middle-content-left .block:last').attr('style', 'padding: 0; margin: 0; border: none;');
    //footer
    jQuery('.footer-widgets .span3 .text-widget p:last').attr('style', 'margin: 0;');
    jQuery('.blogroll-widget ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.twitter-widget ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.pages-widget ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.recent-posts-widget ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.recent-comments-widget ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    $('.footer-widgets .span3').each(function( index ) {
    jQuery(" .block:last",this).attr('style', 'background: none;');
    });
    //comment
    jQuery('#comments .media-list .media:last').attr('style', 'margin: 0;');
    // sidebar
    jQuery('.categories-widget-sidebar ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.twitter-widget-sidebar ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.recent-post-widget-sidebar ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');
    jQuery('.recent-comments-widget-sidebar ul li:last').attr('style', 'border: none; margin: 0; padding: 0;');


    //fancybox
    jQuery('.fancybox').fancybox();

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

    // slider home
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

 //Opening search bar
 var searchBar = $('.search-big');
 var openSearch = $('.search-header button');
 
 openSearch.click(function(){
    searchBar.show();
 });

 // Closing search bar
 var closeSearch = $('.search-big .close-search');
 
 closeSearch.click(function(){
    searchBar.hide();
 });

 // Resizable header on scroll
 if (navbar.hasClass('fixed')) {
    if(jQuery(window).width() > 980){
        $(function(){
         $('.navbar-inner').data('size','big');
        });

        $(window).scroll(function(){
         if($(document).scrollTop() > 30)
        {
           if($('.navbar-inner').data('size') == 'big')
           {
               $('.navbar-inner').data('size','small');
               $('.navbar-inner').stop().animate({
                   padding:'10px', height:'40px'
               },150);
               $('.navbar .brand img').stop().animate({
                   height:'37px'
               },150);
               $('.navbar .brand').stop().animate({
                   margin:'2px 0 0 0'
               },1);
               $('.collapse').stop().animate({
                   height:'40px'
               },1);
           }
        }
        else
         {
           if($('.navbar-inner').data('size') == 'small')
             {
               $('.navbar-inner').data('size','big');
               $('.navbar-inner').stop().animate({
                   padding:'25px 0', height:'100%'
               },150);
               $('.navbar .brand img').stop().animate({
                   height:'100%'
               },150);
               $('.navbar .brand').stop().animate({
                   margin:'0'
               },1);
               var navbarHeight = $('.brand').height();
               $('.collapse').stop().animate({
                   height:(navbarHeight)
               },1);
             }  
         }
        });
    }
}


    //tab home
    $('#myTab-home a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('#myTab-single-event a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });



// Flexslider comments

var sliderWidth = jQuery('.flexslider-7').width();
var itemWidthCalc = (sliderWidth);
    
  jQuery('.flexslider-7').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: itemWidthCalc,
      controlNav: true,
      directionNav: false,
      slideshow: false,
      move: 1,
      smoothHeight: true,
      minItems: 1
  });

// Flexslider comments

var sliderWidth = jQuery('.flexslider-8').width();
var itemWidthCalc = (sliderWidth);
    
  jQuery('.flexslider-8').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: itemWidthCalc,
      controlNav: true,
      directionNav: false,
      slideshow: false,
      move: 1,
      smoothHeight: true,
      minItems: 1
  });



});

    /*Header Cart*/
   jQuery('.tk-header-cart-holder ').hover( function(){
     jQuery('.widget_shopping_cart').css('display', 'block');
    },
    function(){
         jQuery('.widget_shopping_cart').css('display', 'none');
    });
    
    
  // Flexslider check grid size on resize event
  jQuery(window).resize(function() {

      var sliderWidth = jQuery('.flexslider-8').width();
      var itemWidthCalc = (sliderWidth); 
      
      jQuery('.flexslider-8').flexslider({
          animation: "slide",
          animationLoop: false,
          itemWidth: itemWidthCalc,
          controlNav: true,
          directionNav: false,
          slideshow: false,
          move: 1,
          smoothHeight: true,
          minItems: 1
      });             

});

////////////////////
//  CONTACT FORM
///////////////////
function validate_email(field,alerttxt)
{
    with (field)
    {
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2)
        {
            jQuery('#contact-error').empty().append(alerttxt);
            return false;
        }
        else {
            return true;
        }
    }
}


function check_field(field,alerttxt,checktext){
    with (field)
    {
        var checkfalse = 0;
        if(field.value == ""){
            jQuery('#contact-error').empty().append(alerttxt);
            field.focus();
            checkfalse=1;
        }

        if(field.value==checktext)
        {
            jQuery('#contact-error').empty().append(alerttxt);
            field.focus();
            checkfalse=1;
        }

        if(checkfalse==1){
            return false;
        }else{
            return true;
        }
    }
}

function checkForm(thisform)
{
    with (thisform)
    {
        var error = 0;

        var contactmessage = document.getElementById('contactmessage');
        if(check_field(contactmessage, js_variables.message_error_message,"Message")==false){
            error = 1;
        }

        var email = document.getElementById('contactemail');
        if (validate_email(email,js_variables.email_error_message)==false)
        {
            email.focus();
            error = 1;
        }

        var contactname = document.getElementById('contactname');
        if(check_field(contactname,js_variables.name_error_message,"Name*")==false){
            error = 1;
        }

        if(error == 0){
            var contactname = document.getElementById('contactname').value;
            var email = document.getElementById('contactemail').value;
            var contactmessage = document.getElementById('contactmessage').value;

            return true;
        }
        return false;
    }
}

jQuery(window).resize(function() {
 var logoHeight = jQuery('#container .navbar .brand').height();
    if(jQuery(window).width() > 980){
        jQuery('.nav-collapse.collapse').height(logoHeight);
    }
});