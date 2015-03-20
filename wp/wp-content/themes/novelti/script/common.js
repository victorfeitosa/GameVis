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

    var target1 = document.getElementById('main-slider');
    var spinner1 = new Spinner(opts).spin(target1);
    var target2 = document.getElementById('work-slider');
    var spinner2 = new Spinner(opts).spin(target2);
});

jQuery(document).ready(function(){
    "use strict";
   // TABS

    jQuery( ".widget-tabs" ).tabs();

    jQuery('.header-big-menu .sub-menu').each(function(){
        var color = jQuery(this).parent().css("background-color");
        jQuery(this).css('background-color', color);
    });

    // Wait for images to be loaded and then show rating
    jQuery('.content').imagesLoaded(function(){
        jQuery('.stars-rater').show();
    });
    
    
    jQuery('.flexslider').imagesLoaded(function(){
        jQuery('.main-slider').attr('style', 'display:none');
        jQuery('.flexslider').attr('style', 'display:inline-block');
    });
    
    jQuery('.single-content .design-home-images-one .design-home-images-one-img').imagesLoaded(function(){
        jQuery('.work-slider').attr('style', 'display:none');
        jQuery('.design-home-images-one-img').attr('style', 'display:block');
    });




    /*header search opener*/


    jQuery('.header-search-form-wrap .opener').toggle(function() {
        jQuery('.header-search-form-wrap').stop().animate({
            width:"247px"
        });        
        jQuery('.header-search-form-wrap .opener').addClass('closebutton');
    }, function() {
        jQuery('.header-search-form-wrap').stop().animate({
            width:"50px"
        });
        jQuery('.header-search-form-wrap .opener').removeClass('closebutton');
    });    



    // toggle box
    jQuery(".toggle-holder ul li").click(function(){
        if (jQuery(this, "h6").hasClass('active-togle-img')){
            jQuery(this, "h6").removeClass('active-togle-img');
            jQuery(this, "h6").addClass('no-active-togle-img');
        } else if (jQuery("h6", this).hasClass('') || jQuery("h6", this).hasClass('no-active-togle-img')){       
            jQuery(this, "h6").addClass('active-togle-img');
            jQuery(this, "h6").removeClass('no-active-togle-img');          
        }
        jQuery("p",this).slideToggle("slow");
        jQuery("p",this).removeClass("no-active-togle");
    });

    /*
 jQuery('.stars-rater .star').rating({cancel: 'Cancel', cancelValue: '0'}); 
 jQuery('.rating-cancel').attr('style', 'display:none'); 
*/

    // PREVENT EMPTY SEARCH
    
    jQuery('.submit-search-form').click(function(e){
        e.preventDefault();
        var search_val = jQuery('.search-input', this).val();
        if(search_val !== ""){
            jQuery(this).submit();
        }
    });

    //MENU 
    jQuery('ul.sf-menu').superfish({
        animation:   {
            opacity:'show'
        }
    });

    jQuery('.footer_box:first').attr('style', 'margin-left:0;');
    jQuery('.single-posts-one:first').attr('style', 'margin-left:0;');
    jQuery('.nav .sf-menu li:first').attr('style', 'border-top:none!important;');
    


    jQuery('.slider-fans-content .flexslider').hover(function(){
        if (jQuery('.text-slider-two').hasClass('open-activ') || jQuery('.text-slider-three').hasClass('open-activ-a')) {
            return;}
        setTimeout(function(){ jQuery('.text-slider-two').addClass('open-activ'); },5);     
        setTimeout(function(){ jQuery('.text-slider-three').addClass('open-activ-a'); },300);
    },function(){
        if (jQuery('.text-slider-two').hasClass('open-activ') && jQuery('.text-slider-three').hasClass('open-activ-a')){            
            setTimeout(function(){ jQuery('.text-slider-three').removeClass('open-activ-a'); },5);     
            setTimeout(function(){ jQuery('.text-slider-two').removeClass('open-activ'); },300);   
        } else {
            setTimeout(function(){
               if (jQuery('.text-slider-two').hasClass('open-activ') && jQuery('.text-slider-three').hasClass('open-activ-a')){
                    setTimeout(function(){ jQuery('.text-slider-three').removeClass('open-activ-a'); },5);     
                    setTimeout(function(){ jQuery('.text-slider-two').removeClass('open-activ'); },300);   
               } 
            }, 320);
        }
    });
    
    

    // nav
    jQuery(".big-button-menu").click(function(){
        jQuery(".header-big-menu nav").slideToggle("slow");
        jQuery(".header-big-menu nav").removeClass("big-active-nav"); 
    });
    
    jQuery(".button-menu a").click(function(){
        jQuery(".nav nav").slideToggle("slow");
        jQuery(".nav nav").removeClass("active-nav"); 
    });


  
  
    // 'toggle box
    jQuery(".toggle-holder").click(function(){       
        if (jQuery("h6",this).hasClass('active-togle-img')){
            jQuery("h6",this).removeClass('active-togle-img');
            jQuery(this).toggleClass( "toggle-height-min", 2000 );           
        } else if (jQuery("h6",this).hasClass('') || jQuery("h6",this).hasClass('no-active-togle-img')){
            jQuery("h6",this).addClass('active-togle-img');
            jQuery(this).toggleClass( "toggle-height-min", 2000 );
        }
    });


    // START FANCYBOX

    jQuery(".fancybox").fancybox({
        helpers:  {
            title:  null
        }
    });

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

    // HOVER-IMAGES
    jQuery('.home-recent-work-images a').hover(function(){
        jQuery('img',this).stop().animate({
            opacity:0.3
        },500);
    },function(){
        jQuery('img',this).stop().animate({
            opacity:1
        },300);
    });


    jQuery('.blog-images a').hover(function(){
        jQuery('img',this).stop().animate({
            opacity:0.3
        },500);
    },function(){
        jQuery('img',this).stop().animate({
            opacity:1
        },300);
    });

    jQuery('.gallery-fullwith-image a').hover(function(){
        jQuery('img',this).stop().animate({
            opacity:0.3
        },500);
    },function(){
        jQuery('img',this).stop().animate({
            opacity:1
        },300);
    });

    jQuery('.gallery-home a').hover(function(){
        jQuery('img',this).stop().animate({
            opacity:0.3
        },500);
    },function(){
        jQuery('img',this).stop().animate({
            opacity:1
        },300);
    });
});


jQuery(function() {
    "use strict";
    jQuery("<select />").appendTo(".menu-content nav");
    jQuery("<option />", {
        "selected": "selected",
        "value"   : "",
        "text"    : "Go to..."
    }).appendTo(".menu-content nav select");

    jQuery(".menu-content nav a").each(function() {
        var el = jQuery(this);
        jQuery("<option />", {
            "value"   : el.attr("href"),
            "text"    : el.text()
        }).appendTo(".menu-content nav select");
    });

    jQuery(".menu-content nav select").change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });
});



jQuery(function() {
    "use strict";
    jQuery("<select />").appendTo(".footer-menu nav");

    jQuery("<option />", {
        "selected": "selected",
        "value"   : "",
        "text"    : "Go to..."
    }).appendTo(".footer-menu nav select");

    jQuery(".footer-menu nav a").each(function() {
        var el = jQuery(this);
        jQuery("<option />", {
            "value"   : el.attr("href"),
            "text"    : el.text()
        }).appendTo(".footer-menu nav select");
    });

    jQuery(".footer-menu nav select").change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });


 

});




(function(jQuery) {
    jQuery.fn.animateNumber = function(value, speed, update_interval) {
        var ele = jQuery(this),
        num = 0;//parseInt(ele.html()),
        up = value > num,
        num_interval = Math.abs(num - value) / speed;

        var loop = function() {
            num = up ? Math.ceil(num + num_interval) : Math.floor(num - num_interval);
            if ( (up && num > value) || (!up && num < value) ) {
                num = value;
                clearInterval(animation)
            }
            ele.html(num);
        }
        var animation = setInterval(loop, update_interval);
    }
})(jQuery)

function validate_email(field)
{
    with (field)
    {
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2)
        {jQuery('#comment-message').empty().append('Please insert your email');return false;}
        else {return true;}
    }
}
    
function checkForm() {
    var errors = 0;
    if(jQuery('#postcomment').val() == 'Message'){
        jQuery('#comment-message').html('Please insert your message');
        errors++;jQuery('#comment').focus();
    }

    var email_object = jQuery('#comment-email');
    if(email_object.length > 0){
        var email = document.getElementById('comment-email');
        if (validate_email(email) == false)
        {errors++;jQuery('#comment-email').focus();}
    }
    
    var contact_object = jQuery('#author');
    if(contact_object.length > 0){
        if(jQuery('#author').val() == 'Name (required)'){
            jQuery('#comment-message').html('Please insert your name');
            errors++;jQuery('#author').focus();
        };
    }
    
    if(errors == 0){
        return true;
    }else{
        return false;
    }
}