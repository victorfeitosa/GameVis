var check_slide = js_variables.check_slit;
var check_gallery = js_variables.check_gallery;

if(check_slide == 'slit-on' || check_gallery == 1) {
    jQuery(function(){
        "use strict";
        var opts = {
            lines: 7, // The number of lines to draw
            length: 9, // The length of each line
            width: 2, // The line thickness
            radius: 0, // The radius of the inner circle
            corners: 1.0, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            color: '#8c8c8c', // #rgb or #rrggbb
            speed: 1, // Rounds per second
            trail: 67, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 'auto', // Top position relative to parent in px
            left: 'auto' // Left position relative to parent in px
        };

        var target1 = document.getElementById('sl-slider-loader');
        var spinner1 = new Spinner(opts).spin(target1);
    });
}

jQuery(document).ready(function($){

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

    // FLEXSLIDER
    jQuery('.flexslider').flexslider();

    // START FANCYBOX

    $(".fancybox").fancybox({
        helpers:  {
            title:  null
        }
    });

    $(".youtube").click(function() {
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

//checks to see if slit slider is enabled
if(check_slide == 'slide-on'){
    // slider home
    var Page = (function() {
        var $nav = $( '#nav-dots > span' ),
            slitslider = $( '#slider' ).slitslider( {
                onBeforeChange : function( slide, pos ) {

                    $nav.removeClass( 'nav-dot-current' );
                    $nav.eq( pos ).addClass( 'nav-dot-current' );

                }
            } ),
            init = function() {
                initEvents();
            },
            initEvents = function() {
                $nav.each( function( i ) {
                    $( this ).on( 'click', function( event ) {
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
}


    // slider text on home page
    $("#webticker").webTicker();

    $("#continue").click(function(){
        $("#webticker").webTicker('cont');
    });

    $("#update").click(function(){
        $("#webticker").webTicker('update','<li id="item1">First News Item Updated</li><li id="item3">Third News Item Updated</li><li id="item4">Fourth News Item Updated</li><li id="item9">Ninth News Item Updated</li><li id="itemnew1">This is New Item 1</li><li  id="itemnew2">This is New Item 2</li><li  id="itemnew3">This is New Item 3</li><li  id="itemnew4">This is New Item 4</li>','swap');
    });

    var contactMap = $('.contact-map2');
    var navbarHeight = $('.navbar').height();
    if($(window).width() > 980){

        contactMap.css('margin-top', navbarHeight);
    }
    else{
        contactMap.css('margin-top', 0);
    }


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

jQuery(window).resize(function(){

    var contactMap = $('.contact-map2');
    var navbarHeight = $('.navbar').height();

    if($(window).width() > 980){

        contactMap.css('margin-top', navbarHeight);
    }
    else{
        contactMap.css('margin-top', 0);
    }

});
