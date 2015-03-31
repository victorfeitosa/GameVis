jQuery(document).ready(function($){

    //PRELOAD FEATURED IMAGES
    var opts = {
          lines: 15, // The number of lines to draw
          length: 0, // The length of each line
          width: 2, // The line thickness
          radius: 11, // The radius of the inner circle
          corners: 1, // Corner roundness (0..1)
          rotate: 22, // The rotation offset
          direction: 1, // 1: clockwise, -1: counterclockwise
          color: '#000', // #rgb or #rrggbb or array of colors
          speed: 1, // Rounds per second
          trail: 63, // Afterglow percentage
          shadow: false, // Whether to render a shadow
          hwaccel: true, // Whether to use hardware acceleration
          className: 'spinner', // The CSS class to assign to the spinner
          zIndex: 2e9, // The z-index (defaults to 2000000000)
          top: 200, // Top position relative to parent in px
          left: 'auto' // Left position relative to parent in px
    };
    var target = document.getElementById('preload-image');
    var spinner = new Spinner(opts).spin(target);

    jQuery(window).load(function($){
        jQuery('.single-featured-image').imagesLoaded(function(){
            jQuery('#preload-image').attr('style', 'display:none');
            jQuery('.single-featured-image').attr('style', 'opacity:1');
        });
    })


    //CONTENT
    $('#container .dropdown-menu').each(function( index ) {
        jQuery("li:first a",this).attr('style', 'border: none;');
    });
    $('#container .container .rating').each(function( index ) {
        jQuery("li:first",this).attr('style', 'margin-left: 0;');
    });
    $('.category-widget ul').each(function( index ) {
        jQuery("li:last",this).attr('style', 'border: none; padding-bottom: 0;');
    });



    // DROPDOWN
    $('.dropdown').hover(function() {
        $(this).addClass('open');
    }, function() {
        $(this).removeClass('open');
    });


    $('.dropdown-submenu').hover(function() {
        $(this).addClass('open');
    }, function() {
        $(this).removeClass('open');
    });

    // CLOSE CATEGORY IN HEADER
    $(".st-menu a.close-search").click(function() {
        $(".search-header .details-search").attr('style', 'height: 0;');
        $(".st-container").removeClass("st-menu-open");
    });


    // HOME SLIDER
    jQuery('#example10').showbizpro({
        dragAndScroll: "on",
        visibleElementsArray: [3, 3, 2, 1],
        carousel: "off",
        entrySizeOffset: 0,
        allEntryAtOnce: "off",
        ytMarkup: "<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1'></iframe>",
        vimeoMarkup: "<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
        rewindFromEnd: "off",
        autoPlay: "off",
        delay: 2000,
        speed: 250
    });


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
            'transitionOut' : 'elastic',
            'title':  this.title,
            'width': 520,
            'height': 300,
            'href': this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
            'type': 'swf'
        });
        return false;
    });


    // ALERT HEADER
    $(".alert").alert();



    // INFO ON LINK PORTFOLIO
    $('[rel=tooltip]').tooltip();



    // TAB
    $('#myTab a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
    });



    // MARGIN FOR HEADER
    jQuery(window).resize(function(){
        resize1();
    });

    function resize1(){  }

    var headerAlertHeight = $('#container .header-alert').outerHeight(true);
    if (headerAlertHeight > 0) {
        jQuery('.header-black').attr("style", "margin-top:" + headerAlertHeight + "px");
    }
    $("#container .alert button").click(function() {
        jQuery('.header-black').attr("style", "margin-top: 0px");
    });


    // ADD TEXT IN SLIDER FOR SINGLE
    $('.posts-single .flex-direction-nav li').each(function( index ) {
        jQuery("a.prev:first",this).append( "<h6></h6>" );
    });

    $('.posts-single .flex-direction-nav li').each(function( index ) {
        jQuery("a.prev:first",this).append( "<span>PREVIOUS POST</span>" );
    });

    $('.posts-single .flex-direction-nav li').each(function( index ) {
        jQuery("a.next:last",this).append( "<span>Next POST</span>" );
    });

    $('.posts-single .flex-direction-nav li').each(function( index ) {
        jQuery("a.next:last",this).append( "<h6></h6>" );
    });

    // Slide product button on hover in shop

    $("ul.products li.product > a").hover(function() {
        $(this).siblings(".products .product > a").addClass("slide");
    }, function() {
        $(this).siblings(".products .product > a").removeClass("slide");
    });

    $("ul.products li.product > a").mouseenter(function() {
        $(this).siblings("ul.products li.product .added_to_cart").removeClass("slide");
    });

    $("ul.products li.product > a").mouseleave(function() {
        $(this).siblings("ul.products li.product .added_to_cart").addClass("slide");
    });

     //Opening search bar

     var searchBar = $('.details-search');
     var openSearch = $('.navbar-form');

     openSearch.click(function(){
        searchBar.show();
        return false
     });

     // Closing search bar

     $(document).click(function(){
        searchBar.hide();
     });

    // Isotope

    var $container = $('.half-width-posts');
    var $masonryItem = $('.half-width-posts .col-xs-6, .half-width-posts .pagination');

    $container.imagesLoaded( function(){
        $container.isotope({
          animationEngine: 'best-available',
          itemSelector : $masonryItem,
          sortBy : 'original-order'
        });
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


jQuery(window).load(function($) {
    var heightSidebar = jQuery('#sidebar').outerHeight(true);
    var heightContentLeft = jQuery('.content-with-sidebar').outerHeight(true);

    if (heightSidebar < heightContentLeft) {
        jQuery('#sidebar').attr("style", "height:" + heightContentLeft + "px");
    }
});