jQuery(document).ready(function(){

     //MENU
    jQuery("ul.sf-menu").superfish();

    jQuery('.home-posts-post-links .home-storie-one:last').attr('style', 'padding: 0; border:none');
    jQuery('.widget-categories ul li:last').attr('style', 'padding: 0; border:none; margin-right: 0');
    jQuery('.sub-menu li a:last').attr('style', 'border:none!important');
    jQuery('.sf-sub-indicator').parent().attr('style', 'border:none!important');
    jQuery('.sidebar_widget_holder .app_recent_title:last').attr('style', 'border:none; padding: 0');
    jQuery('.sidebar_widget_holder .app_recent_comments:last').attr('style', 'border:none; padding: 0; margin: 0');


    // HOVER-IMAGES
    jQuery('.post-home').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.7},500);
       jQuery('.hover-post-home',this).css('display','block');
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
       jQuery('.hover-post-home',this).css('display','none');
    });


    jQuery('.home-storie-img a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.7},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });


    jQuery('.home-authors-img a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.7},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });


    jQuery('.sidebar_widget_holder .baner-widget a').hover(function(){
       jQuery('img',this).stop().animate({opacity:0.7},500);
    },function(){
       jQuery('img',this).stop().animate({opacity:1},300);
    });

        jQuery('.footer-left ul li a').hover(function(){
           jQuery('div',this).stop().animate({top: '-16px'},300);
        },function(){
           jQuery('div',this).stop().animate({top: '0'},300);
        });

});


$(function() {


    $("<select />").appendTo("nav");

    // Create default option "Go to..."
    $("<option />", {
     "selected": "selected",
     "value"   : "",
     "text"    : "Go to..."
    }).appendTo("nav select");

    // Populate dropdown with menu items
    $("nav a").each(function() {
    var el = $(this);
    $("<option />", {
       "value"   : el.attr("href"),
       "text"    : el.text()
    }).appendTo("nav select");
    });

       // To make dropdown actually work
       // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    $("nav select").change(function() {
    window.location = $(this).find("option:selected").val();
    });

});
