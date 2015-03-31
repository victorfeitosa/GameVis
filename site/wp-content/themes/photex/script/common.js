jQuery(document).ready(function($){


    // DJAX

    // var transition = function($newEl) {
    //     var $oldEl = $(this);
    //         $oldEl.slideUp('fast', function () {
    //             $newEl.hide();
    //             $oldEl.after($newEl);
    //             $newEl.slideDown('slow');
    //             $oldEl.remove();
    //         });
    // }

    // $('body').djax('.djaxable', ['.pdf','.doc','.eps','.png','.zip','admin','wp-','wp-admin','feed','#', '?lang=', '&lang=', '&add-to-cart=', '?add-to-cart=', '?remove_item'], transition);

    // niceScroll

    $('html, .navbar .container-fluid, .md-content textarea').niceScroll({
        cursorcolor:'#000',
        cursorborder: 0,
        cursorborderradius: 3,
        cursoropacitymin: 0.3
    });

    // Navbar slide

    var navbar = $('.navbar');
    var navbarClose = $('.navbar-slide.close-nav');
    var navbarOpen = $('.navbar-slide.open-nav');
    var prevSlideFull = $('.full-width-sly-wrapper .prev');

    navbarClose.click(function(){
        navbarOpen.show();
        navbar.removeClass('open-navbar');
        prevSlideFull.removeClass('open-navbar');
        navbar.addClass('hidden-navbar');
    });

    navbarOpen.click(function(){
        navbarClose.show();
        navbar.addClass('open-navbar');
        prevSlideFull.addClass('open-navbar');
        navbar.removeClass('hidden-navbar');
    });

    // Modal

    var modalTrigger = $('.md-trigger');
    var modal = $('.md-modal');
    var modalForm = $('.md-content > div');
    var modalClose = $('.md-content .close');

    modalForm.click(function(e){
        e.stopPropagation();
    });

    modalTrigger.click(function(e){
        e.preventDefault();
        e.stopPropagation();
        modal.toggleClass('md-show');
    });

    $(window).click(function(){
        modal.removeClass('md-show');
    });

    modalClose.click(function(){
        modal.removeClass('md-show');
    });

    // Home Full Width slider


    var viewPortWidth = $(window).outerWidth();
    var viewPortHeight = $(window).height();
    var fullWidthSlide = $('#full-width-sly li');
    var fullWidthSlideHeight = $('#full-width-sly');

    fullWidthSlide.width(viewPortWidth);
    fullWidthSlideHeight.height(viewPortHeight);

    var slyCounter = $('.full-width-sly-wrapper .pages');
    var sliderCount = $('.full-width-sly-wrapper .pages li').length +1;
    $('.full-width-sly-wrapper .pages li:last-child').append( '<span>'  + sliderCount + '</span>');

    //Portfolio slider

    if(viewPortWidth > 776){
        $('.portfolio-slider li').width(viewPortWidth / 2);
    }
    else{
        $('.portfolio-slider li').width(viewPortWidth);
    }

    // Blog post slider

    var blogSliderIe = $('.ie8 .post-slider');
    var blogSliderWidth = $('.post-slider').width();
    var blogSliderItemWidth = $('.post-slider li').width(blogSliderWidth);

    var heights = $('.ie8 .post-slider li').map(function ()
    {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    blogSliderIe.height(maxHeight);

    // Post-data

    var postDataP = $('.full-width-sly-wrapper .slide-data .post-data p');
    var postDataParHeight = $('.full-width-sly-wrapper .slide-data .post-data p').height();
    postDataP.css('margin-top', (-postDataParHeight / 2));

    var postName = $('.full-width-sly-wrapper .slide-data .post-name');
    postName.css('height', (postDataParHeight + 30));

    var postDataLikes = $('.full-width-sly-wrapper .slide-data .likes');
    var postNameHeight = postName.height();

    postDataLikes.css('height', postNameHeight)

    if($(window).width() > 767){
        var slideCounterWrap = $('.full-width-sly-wrapper .slide-data .pages-wrapp');
        slideCounterWrap.css('height', postNameHeight);
    }

    // Like on click

    var likeLink = $( '.likes a' );
    var likeIcon = $( '.likes .icon-heart' );

    likeLink.click(function(e){
        e.preventDefault();
        $(this).addClass('liked');
    });

    // Isotope

    var $container = $('.gallery-masonry');
    var $masonryItem = $('.gallery-item');

    $container.imagesLoaded( function(){
        $container.isotope({
          animationEngine: 'best-available',
          layoutMode: 'sloppyMasonry',
          itemSelector : $masonryItem,
          sortBy : 'original-order'
        });
    });

    $('#filters a').click(function(){
      var selector = $(this).attr('data-filter');
      $container.isotope({ filter: selector });
      return false;
    });

    var $optionSets = $('.nav-categories'),
    $optionLinks = $optionSets.find('a');

    $optionLinks.click(function(){
      var $this = $(this);
      // don't proceed if already selected
      if ( $this.hasClass('selected') ) {
        return false;
      }
      var $optionSet = $this.parents('.nav-categories');
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');

      return false;
    });

    // Fancybox

    $('.fancybox').fancybox({
        padding: 0,
        helpers : {
            media : {}
        }
    });

    // Masonry filter

    var filterTrigger = $('.filter-trigger');

    filterTrigger.click(function(){
        $(this).parent().find('li').toggleClass('open');
    });

    // Image hover options on touch devices

    var imageOptions = $('.img-options');

    imageOptions.click(function(){
        $(this).toggleClass('active');
    });

    $masonryItem.click(function(){
        $(this).toggleClass('active');
    });

}); // End Document Ready

$(window).load(function(){

    // Preloader

    $('.loader').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});

    // Home Full Width slider

    $('#full-width-sly').sly({
        horizontal: 1,
        itemNav: 'basic',
        itemSelector: '.full-width-sly-wrapper .slidee li',
        smart: 1,
        activateOn: 'click',
        prev: '.full-width-sly-wrapper .prev',
        next: '.full-width-sly-wrapper .next',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        pagesBar: '.pages',
        activatePageOn: 'click',
        speed: 600,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        keyboardNavBy: 'items'
      });

    var slyCounter = $('.full-width-sly-wrapper .pages');
    var sliderCount = $('.full-width-sly-wrapper .pages li').length;
    $('.full-width-sly-wrapper .pages').append( '<span>' + sliderCount + '</span>');

    //Blog post slider

    $('.post-slider').sly({
        horizontal: 1,
        itemNav: 'basic',
        itemSelector: '.post-slider .slidee li',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        pagesBar: '.pages',
        activatePageOn: 'click',
        speed: 600,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        keyboardNavBy: 'items'
      });

    var blogSliderNav = $('.post-slider .pages');
    var blogSliderNavWidth = $('.post-slider .pages').width();

    blogSliderNav.css('margin-left', - blogSliderNavWidth / 2);

    // Portfolio slider

    $('.portfolio-slider').sly({
        horizontal: 1,
        itemNav: 'basic',
        itemSelector: '.portfolio-slider .slidee li',
        smart: 1,
        activateOn: 'click',
        prev: '.portfolio-slider .prev',
        next: '.portfolio-slider .next',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        speed: 600,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        scrollBar: '#scrollbar',
        scrollBy: false,
        dragHandle: 1,
        dynamicHandle: 1,
        keyboardNavBy: 'items'
      });

});

// $(window).bind('djaxLoad', function(e, data) {
//     var footerHtml = $('#footer-wrapper').html();
//     var footerWrap = $('#footer-wrapper');
//     $('#footer').remove();
//     footerWrap.append(footerHtml);
// });

$(window).resize(function(){

    var fullWidthSlide = $('#full-width-sly li');
    var fullWidthSlideHeight = $('#full-width-sly .slidee');
    var viewPortWidth = $(window).outerWidth();
    var viewPortHeight = $(window).height();

    fullWidthSlide.width(viewPortWidth);
    fullWidthSlideHeight.height(viewPortHeight);

    //Portfolio slider

    if(viewPortWidth > 776){
        $('.portfolio-slider li').width(viewPortWidth / 2);
    }
    else{
        $('.portfolio-slider li').width(viewPortWidth);
    }

    // Blog post slider

    var blogSliderWidth = $('.post-slider').width();
    var blogSliderItemWidth = $('.post-slider li').width(blogSliderWidth);

    $('#full-width-sly').sly('reload');
    $('.post-slider').sly('reload');
    $('.portfolio-slide').sly('reload');


});


