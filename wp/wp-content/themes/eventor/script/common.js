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
/*preloader end*/

jQuery(document).ready(function(){




    jQuery('.sub-menu li a:last').attr('style', 'border:none');
    
    jQuery('.widget-categories ul li:last').attr('style', 'border-bottom:none; margin-bottom: 0; padding-bottom: 0;');
    jQuery('.sidebar_widget_holder .twitter_ul:last').attr('style', 'border-bottom:none; margin-bottom: 0; padding-bottom: 0;');
    jQuery('.sidebar_widget_holder .app_recent_title:last').attr('style', 'border-bottom:none; margin-bottom: 0; padding-bottom: 0;');
    jQuery('.sidebar_widget_holder .menu-container ul.menu li:last').attr('style', 'border-bottom:none; margin-bottom: 0; padding-bottom: 0;');
    jQuery('.footer_box .footer-categories li:last').attr('style', 'border-bottom:none;');
    jQuery('.footer_box .twitter_ul li:last').attr('style', 'border-bottom:none;');
    jQuery('.footer_box .menu-menu-container ul.menu li:last').attr('style', 'border-bottom:none; margin-bottom: 0; padding-bottom: 0;');
    jQuery('.footer-others:last').attr('style', 'margin-right: 0;');





    // HOVER-IMAGES
    jQuery('.home-posts-one-img a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });

    jQuery('.home-post-one-img a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });

    jQuery('.blog-one-images a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });

    jQuery('.speakers-img a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });

    jQuery('.sponsors-one a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.4},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });



    // nav    
    jQuery(".button-menu a").click(function(){
        jQuery(".nav nav").slideToggle("slow");
    });
    
    //MENU
    jQuery('ul.sf-menu').superfish({
        delay:       100,
        disableHI:   true, // this option fixes drop down problem with hoverIntent
        animation:   {
            opacity:'show',
            height:'show',
            speed:'fast'
        }
    });
    
    
        /*
    // FLEXSLIDER
    jQuery(window).load(function() {
            jQuery('.flexslider').flexslider();
    });
*/
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

    // FANCYBOX
    jQuery('.fancybox').fancybox();
	
    //AUDIO
    jQuery("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
            $(this).jPlayer("setMedia", {
                m4a:"http://www.jplayer.org/audio/m4a/TSP-01-Cro_magnon_man.m4a",
                oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
            });
        },
        swfPath: "js",
        supplied: "m4a, oga",
        wmode: "window"
    });

    // TABS
    jQuery( ".tabs").each(function(){
        jQuery(this).tabs();
    });

    jQuery(window).resize(function(){
        resize1();
    });
    
    setTimeout(resize1, 5);
    
    function resize1(){
        var widthWindow = jQuery(window).width();

        if(widthWindow<850){
            jQuery('.nav nav').addClass('dl-menuwrapper');
            jQuery('.sub-menu').addClass('dl-submenu');            
        } else {
            jQuery('.nav nav').removeClass('dl-menuwrapper');
            jQuery('.sub-menu').removeClass('dl-submenu');        
        }
    }

    //Tag Cloud style


        var tagfix = jQuery('.tagcloud a').html();
        jQuery('.tagcloud a').each(function(){
                var tagfix = jQuery(this).html();
                jQuery(this).html('').append('<div class="tags-button left"><div class="tag-left left"></div><div class="tag-center left">'+tagfix+'</div><div class="tag-right left"></div>');
        });


    //Slit slider
        jQuery(function($) {
			
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



    // toggle box
    jQuery(".toggle-holder").each(function(){
        if(jQuery('h6', this).hasClass('active-togle-img')){
            jQuery(this).addClass('toggle-height-min');
            jQuery("p",this).attr('style', 'display: none;');
        }
    })
    // 'toggle box
    jQuery(".toggle-holder").click(function(){
        if (jQuery("h6",this).hasClass('active-togle-img')){
            jQuery("h6",this).removeClass('active-togle-img');
            jQuery(this).toggleClass( "toggle-height-min" );
        } else {
            jQuery("h6",this).addClass('active-togle-img');
            jQuery(this).toggleClass( "toggle-height-min" );
        }
        jQuery("p",this).slideToggle();
    })


    jQuery( "#tabs-sidebar" ).tabs();

    //hover gallery
    jQuery(' #da-thumbs > li ').each( function() {
        jQuery(this).hoverdir();
    } );

    
       //HORIZONTAL SLIDER
    jQuery('#mycarousel').jcarousel({
        animation: 300,
        wrap: 'circular',
        scroll: 1
    });


    jQuery('.jcarousel-prev').each(function(){
            jQuery(this).html('<span>Prev</span><p>/</p>');
    });

    jQuery('.jcarousel-next').each(function(){
            jQuery(this).html('<span>Next</span>');
    });

});

/*Contact Form*/
    
                
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


function check_reservation_form(thisform)
{ 
    //alert(contact_variables.reservation_fullname_field+' = '+jQuery('#fullname').val()+' = '+document.getElementById('fullname').value);
    with (thisform)
    {
                                      
        var error = 0;
                               
        var tk_message = document.getElementById('additional-information');
        if(check_reservation_field(tk_message, contact_variables.all_fields_are_required, contact_variables.reservation_message_field)==false){
            error = 1;
        }
                               
        var tk_teammember = document.getElementById('select-team-member');
        if(check_reservation_field(tk_teammember, contact_variables.all_fields_are_required, contact_variables.reservation_appointment_field)==false){
            error = 1;
        }
                                
        var tk_services = document.getElementById('select-service');
        if(check_reservation_field(tk_services, contact_variables.all_fields_are_required, contact_variables.reservation_service_field)==false){
            error = 1;
        }
        var datereq = document.getElementById('date');
        if(check_reservation_field(datereq, contact_variables.all_fields_are_required, contact_variables.reservation_date_field)==false){
            error = 1;
        }
                                    
        var phone = document.getElementById('phone');
        if(check_reservation_field(phone, contact_variables.all_fields_are_required, contact_variables.reservation_phone_field)==false){
            error = 1;
        }
                                    
        var appoint_email = document.getElementById('email');
        if (validate_email(appoint_email, contact_variables.email_error_msg)==false)
        {
            email.focus();
            error = 1;
        }
                                    
        var fullname = document.getElementById('fullname');
        if(check_reservation_field(fullname, contact_variables.name_error_msg, contact_variables.reservation_fullname_field)==false){
            
            error = 1;
        }
                                        
        if(error == 0){
            var tk_message = document.getElementById('additional-information').value;
            var tk_teammember = document.getElementById('select-team-member').value;
            var tk_services = document.getElementById('select-service').value;
            var datereq = document.getElementById('date').value;
            var phone = document.getElementById('phone').value;
            var fullname = document.getElementById('fullname').value;
            var appoint_email = document.getElementById('email').value;

            return true;
        }
        return false;
        }
}
                                
function check_reservation_field(field,alerttxt,checktext){
    with (field)
    {
        var is_element_input = jQuery(field).is("input");
                                    
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
            if(is_element_input == true) { 
                jQuery(field).attr('style', 'border:1px solid #e27b67;');
            } else {
                jQuery(field).parent().attr('style', 'border:1px solid #e27b67;');
            }                                        
            return false;
        }else{ 
            if(is_element_input == true) { 
                jQuery(field).attr('style', 'border:1px solid #dfdfdf;');
            } else {
                jQuery(field).parent().attr('style', 'border:1px solid #dfdfdf;');
            }
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
        if(check_field(contactmessage, contact_variables.message_error_message,"Message")==false){
            error = 1;
        }

        var email = document.getElementById('contactemail');
        if (validate_email(email,contact_variables.email_error_message)==false)
        {
            email.focus();
            error = 1;
        }

        var contactname = document.getElementById('contactname');
        if(check_field(contactname,contact_variables.name_error_message,"Name (required)")==false){
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