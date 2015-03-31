jQuery(document).ready(function(){

    jQuery('.header-categories .children').attr('style', 'display:none');
    //MENU
    jQuery("ul.sf-menu").superfish();

        jQuery('.sf-menu li:last').attr('style', 'margon-right:0; padding-right:0; background:none');

        jQuery('.recent-news-home').each(function(){
            jQuery('.nature-home-one:last', this).attr('style', 'padding-bottom:0; border:none');
        })


 
        jQuery('.header-categories li').each(function(){
            jQuery(this)
            .mouseenter(function(){jQuery(this).children(".children").attr('style', 'display:block')
            })
            .mouseleave(function(){jQuery(this).children(".children").attr('style', 'display:none')})
        })


/*
                jQuery(".cat-item").hover(function(){
                        jQuery(this).find('ul:first').css({display: "block", opacity: 0}).stop().animate({ opacity: 1 }, 200); //Slides down when hover the UL
                        jQuery(this).children('a').addClass("hovered"); //Adds a hovered class, so you can see the menu path you are following
                },function() {
                        jQuery(this).find('ul:first').css({display: "none"}); //Slides up on mouseleave
                        jQuery(this).children('a').removeClass("hovered"); //removes the hovered class.
                });
*/



        jQuery(window).load(function() {
                jQuery('.flexslider').flexslider();
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
    jQuery('.recent-news-one-images').hover(function(){
        jQuery('span',this).css('display','block');
    },function(){
        jQuery('span',this).css('display','none');
    });

    jQuery('.nature-home-one-images').hover(function(){
        jQuery('span',this).css('display','block');
    },function(){
        jQuery('span',this).css('display','none');
    });

    jQuery('.category-post-first-img').hover(function(){
        jQuery('span',this).css('display','block');
    },function(){
        jQuery('span',this).css('display','none');
    });

    jQuery('.category-post-one-img').hover(function(){
        jQuery('span',this).css('display','block');
    },function(){
        jQuery('span',this).css('display','none');
    });


});




jQuery(function() {


    jQuery("<select />").appendTo(".header-categories nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo(".header-categories nav select");

    // Populate dropdown with menu items
    jQuery(".header-categories nav a").each(function() {
    var el = jQuery(this);
    jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo(".header-categories nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery(".header-categories nav select").change(function() {
    window.location = jQuery(this).find("option:selected").val();
    });

});



jQuery(function() {


    jQuery("<select />").appendTo(".menu-header nav");

    // Create default option "Go to..."
    jQuery("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo(".menu-header nav select");

    // Populate dropdown with menu items
    jQuery(".menu-header nav a").each(function() {
    var el = jQuery(this);
    jQuery("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo(".menu-header nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    jQuery(".menu-header nav select").change(function() {
    window.location = jQuery(this).find("option:selected").val();
    });


});