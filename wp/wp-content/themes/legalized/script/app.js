jQuery(document).ready(function($){

    // MAIN NAVIGATION - change the ID on small devices
    if ( $(window).width() < 979) {
       $('.nav-collapse [id*="menu-"]').attr("id","menu");
    }
    else {
       $('#menu').attr("id", "menu-main-navigation");
    }


    //SHORTCODES
    jQuery(function($){
        $('.shortcode_tabs').each(function(){
            $(this).find('li').first().addClass('active');
        });
        $('.shortcode_tab_content').each(function(){
            $(this).find('div.tab-pane').first().addClass('in active');
        })
    });
    
    // Audio Player
    $("#jquery_jplayer_1").jPlayer({
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
     

    jQuery('.select-services').change(function($){
        var getID =  $(".select-services").find('option:selected').attr('rel');

        if(getID == 0){
            $(".select-team-member option").removeAttr("disabled");
        } else {
            $(".select-team-member option").removeAttr("disabled");
            $(".select-team-member option:not([rel~="+getID+"])").attr({ disabled: 'disabled' });
        }

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
            'transitionOut' : 'elastic',
            'title':  this.title,
            'width': 520,
            'height': 300,
            'href': this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
            'type': 'swf'
        });
        return false;
    });

    // FANCYBOX
    jQuery('.fancybox').fancybox({
        'padding' : 5
    });
    
    
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

    //DROPDOWN MENU FOR IPAD
    var viewPortWidth = $(window).outerWidth();
    if (viewPortWidth > 979 && viewPortWidth < 1025) {
        var dropdownTrigger = $('.nav-collapse .menu-item li')
        var dropdown = $('.dropdown-menu')
        $(dropdownTrigger).on('click touchend', function() {
            $(this).find(dropdown).css({'opacity':'1','visibility':'visible','margin':'0', 'display':'block'})
        });     
     }

    //ISOTOPE
    jQuery(function($){
        var container = $('.work-single-content');
        $(container).imagesLoaded(function(){
            $(container).isotope({
                layoutMode:'fitRows',
                itemSelector:'.work-content-one',
                isAnimated:true,
                animationEngine:'jquery',
                animationOptions:{
                    duration:500,
                    easing:'easeOutCubic',
                    queue:false
                }
            });
        });

        $('.work-filter a').click(function(){
            var selector = $(this).attr('data-filter');
            $(container).isotope({ filter: selector });
            return false;
        });


        $('.work-filter a').each(function(){
            $(this).click(function(){
               $('.work-filter a').each(function(){
                 $(this).removeClass('active');
           });
                $(this).addClass('active');
            });
        });
    });
    
    //Isotope responsive filter
    jQuery(function($) {
        "use strict";
        $("<select />").appendTo(".work-filter");
            $("<option />", {
             "selected": "selected",
             "value"   : "",
             "text"    : "Go to..."
            }).appendTo(".work-filter select");
        $(".work-filter a").each(function() {
            var el = jQuery(this);
            $("<option />", {
               "value"   : el.attr("href"),
               "data-filter"   : el.attr("data-filter"),
               "text"    : el.text()
            }).appendTo(".work-filter select");
        });
        $(".work-filter select").change(function() {
            var container = $('.work-single-content');
            var selector = $(this).find("option:selected").attr('data-filter');
            $(container).isotope({ filter: selector });
            return false;
        });
    });

    //Back to top button
    jQuery(function($){
        $('#top a').click(function () {
                $('body,html').animate({
                        scrollTop: 0
                }, 800);
                return false;
        });
    });


    $('a.dropdown-toggle, .dropdown-menu a').on('touchstart', function(e) {
      e.stopPropagation();
    });

    $('a.dropdown-toggle, .dropdown-menu a').on('click', function(e) {
      e.stopPropagation();
    });


    // MAIN NAVIGATION - change the ID on small devices on resize
    jQuery(window).resize(function() {

        if ( jQuery(window).width() < 979) {
           jQuery('.nav-collapse [id*="menu-"]').attr("id","menu");
        }
        else {
           jQuery('#menu').attr("id", "menu-main-navigation");
        }

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
        if(check_field(contactname,contact_variables.name_error_message,"Name*")==false){
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



    jQuery(document).on('touchstart.dropdown.data-api', 'a.dropdown-toggle', function (event) {
        //event.preventDefault();
        //alert('Touch device!!');
    });
