var $i = jQuery.noConflict();

$i(document).ready(function(){

    // Working links for iPad, iPhone

    $i(function () {

        IS_IPAD = navigator.userAgent.match(/iPad/i) != null;
        IS_IPHONE = (navigator.userAgent.match(/iPhone/i) != null) || (navigator.userAgent.match(/iPod/i) != null);

        if (IS_IPAD || IS_IPHONE) {

            $i('a').on('click touchend', function() {
                var link = $i(this).attr('href');
                window.open(link,'_self'); // opens in new window as requested

                return false; // prevent anchor click
            });
        }
    });

    // niceScroll

    $i('html, .navbar .container-fluid, .md-content textarea').niceScroll({
        cursorcolor:'#000',
        cursorborder: 0,
        cursorborderradius: 3,
        cursoropacitymin: 0.3
    });

    // Navbar slide

    var navbar = $i('.navbar');
    var navbarClose = $i('.navbar-slide.close-nav');
    var navbarOpen = $i('.navbar-slide.open-nav');
    var prevSlideFull = $i('.full-width-sly-wrapper .prev');

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

    var modalTrigger = $i('.md-trigger');
    var modal = $i('.md-modal');
    var modalForm = $i('.md-content > div');
    var modalClose = $i('.md-content .close');

    modalForm.click(function(e){
        e.stopPropagation();
    });

    modalTrigger.click(function(e){
        e.preventDefault();
        e.stopPropagation();
        modal.toggleClass('md-show');
    });

    $i(window).click(function(){
        modal.removeClass('md-show');
    });

    modalClose.click(function(){
        modal.removeClass('md-show');
    });

    // Home Full Width slider

    var viewPortWidth = $i(window).outerWidth();
    var viewPortHeight = $i(window).height();
    var fullWidthSlide = $i('#full-width-sly li');
    var fullWidthSlideHeight = $i('#full-width-sly');

    fullWidthSlide.width(viewPortWidth);
    fullWidthSlideHeight.height(viewPortHeight);

    var slyCounter = $i('.full-width-sly-wrapper .pages');
    var sliderCount = $i('.full-width-sly-wrapper .pages li').length +1;
    $i('.full-width-sly-wrapper .pages li:last-child').append( '<span>'  + sliderCount + '</span>');

    // Blog post slider

    var blogSliderIe = $i('.ie8 .post-slider');
    var blogSliderWidth = $i('.post-slider').width();
    var blogSliderItemWidth = $i('.post-slider li').width(blogSliderWidth);

    var heights = $i('.ie8 .post-slider li').map(function ()
    {
        return $i(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    blogSliderIe.height(maxHeight);

    // Post-data

    var postDataP = $i('.full-width-sly-wrapper .slide-data .post-data p');
    var postDataParHeight = $i('.full-width-sly-wrapper .slide-data .post-data p').height();
    postDataP.css('margin-top', (-postDataParHeight / 2));

    var postName = $i('.full-width-sly-wrapper .slide-data .post-name');
    postName.css('height', (postDataParHeight + 30));

    var postDataLikes = $i('.full-width-sly-wrapper .slide-data .likes');
    var postNameHeight = postName.height();

    postDataLikes.css('height', postNameHeight)

    if($i(window).width() > 767){
        var slideCounterWrap = $i('.full-width-sly-wrapper .slide-data .pages-wrapp');
        slideCounterWrap.css('height', postNameHeight);
    }

    // Like on click

    var likeLink = $i( '.likes a' );
    var likeIcon = $i( '.likes .icon-heart' );

    likeLink.click(function(e){
        e.preventDefault();
        $i(this).addClass('liked');
    });

    // Filter for gallery masonry

    $i('#filters a').on('click touchend', function(e){
      e.preventDefault();
      var selector = $i(this).attr('data-filter');
      $i('.gallery-masonry').isotope({ filter: selector });
      return false;
    });

    var $optionSets = $i('.nav-categories'),
    $optionLinks = $optionSets.find('a');

    $optionLinks.on('click touchend', function(e){
      e.preventDefault();
      var $this = $i(this);
      // don't proceed if already selected
      if ( $this.hasClass('selected') ) {
        return false;
      }
      var $optionSet = $this.parents('.nav-categories');
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');

      return false;
    });

    var filterTrigger = $i('a.filter-trigger');

    filterTrigger.on('click touchend', function(e){
        e.preventDefault()
        $i(this).parent().find('li').toggleClass('open');
    });

    // Fancybox

    $i('.fancybox').fancybox({
        padding: 0,
        helpers : {
            media : {}
        }
    });

    // Image hover options on touch devices

    var imageOptions = $i('.img-options');

    $i(imageOptions).on('click touchend', function() {
        $i('.img-options').removeClass('active');
        $i(this).toggleClass('active');
    });

    // Add class to parent menu item li and icon on link

    var parent_menu_item = $i('li.menu-item-has-children');
    parent_menu_item.addClass('dropdown');
    var menu_link_item = $i('.menu-item > a');
    var menu_link_sub_item = $i('.dropdown > a');
    menu_link_sub_item.append('<i class="icon-drop-d"></i>');
    menu_link_item.wrapInner( "<strong></strong>" );

    menu_link_item.each(function(){
        var menu_item_title = $i(this).attr('title');
        if(menu_item_title !== undefined){ $i(this).append('<span>'+menu_item_title+'</span>'); }
    });

    // Remove add to cart button on click in Shop archive

    var cartButton = $i('.add_to_cart_button');

    cartButton.click(function(){
        $i(this).css('left', '130%');
    });

}); // End Document Ready

$i(window).load(function(){
    // Preloader

    $i('.loader').fadeOut(); // will first fade out the loading animation
    $i('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $i('body').delay(350).css({'overflow':'visible'});

    // Home Full Width slider

    var options = {
        horizontal: 1,
        itemNav: 'forceCentered',
        activateMiddle: 1,
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
        keyboardNavBy: 'items' }


    //Populate post excerpt
    $i('#full-width-sly').sly(options, {
        moveEnd: function(){
            //Initialize post-like.js
            var theme_url = $i('#theme_url').data('theme_url');
            var post_js_script = theme_url+'/script/post-like.js';
            $i.getScript(post_js_script);
        },
        active: function() {
            var current_post = $i('.slidee > li.active');
            post_id = current_post.data("post_id");

            //Pause vimeo player if not active
            var viframe = $i('.vimeo-video')[0];

            if(viframe){
                var vplayer = Froogaloop(viframe);
                vplayer.api('pause');
            }


            //Show arrows if video
            var numbers_nav =  $i('.full-width-sly-wrapper .slide-data .pages-wrapp .pages');
            var arrows_nav  = $i('.full-width-sly-wrapper .prev, .full-width-sly-wrapper .next');

            var numbers_nav_hover =  $i('.full-width-sly-wrapper .slide-data .pages-wrapp:hover .pages');
            var arrows_nav_hover =  $i('.full-width-sly-wrapper .slide-data .pages-wrapp:hover a');

            if(current_post.find('.vimeo-video').length > 0 || $i('.slidee > li').find('#youtube-player').length > 0){
                numbers_nav.css('opacity', '0');
                arrows_nav.css('opacity', '1');
            }
            else{
                numbers_nav_hover.css('opacity', '1');
                arrows_nav_hover.css('opacity', '0');
            }


            //Stop Youtube video
            if($i('.slidee > li').find('#youtube-player').length > 0){
                $i('#youtube-player')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
            }


            //Set post_id for like
            $i('a.verticalize').attr('data-post_id', post_id);

            //Get post title
            jQuery.ajax({
                type: "post",
                url: ajax_var.url,
                dataType: 'json',
                data: "action=get_home_title&nonce="+ajax_var.nonce+"&post_id="+post_id,
                beforeSend: function(){
                    $i('.post-name > p > a').removeClass('active');
                    $i('.verticalize-container.likes a').removeClass('active');
                },
                success: function(data){
                    var title_container = $i('.post-name > p');
                    var likes_container = $i('.verticalize-container.likes');
                    var response_title = data[0];
                    var response_likes = data[1];

                    title_container.hide();
                    title_container.html(response_title);
                    title_container.fadeIn('fast');

                    likes_container.hide();
                    likes_container.html(response_likes);
                    likes_container.fadeIn('fast');
                }
            });

            return false;
        }
    });


    var slyCounter = $i('.full-width-sly-wrapper .pages');
    var sliderCount = $i('.full-width-sly-wrapper .pages li').length;
    $i('.full-width-sly-wrapper .pages').append( '<span>' + sliderCount + '</span>');


    //Blog post slider

    $i('.post-slider').sly({
        horizontal: 1,
        itemNav: 'forceCentered',
        activateMiddle: 1,
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

    var blogSliderNav = $i('.post-slider .pages');
    var blogSliderNavWidth = $i('.post-slider .pages').width();

    blogSliderNav.css('margin-left', - blogSliderNavWidth / 2);

    var blogSliderActiveHeight = $i('.post-slider li.active').height();
    $i('.post-slider').height(blogSliderActiveHeight);

    $i('.post-slider').sly('on', 'load move', function () {
        var blogSliderActiveHeight = $i('.post-slider li.active').height();
        $i('.post-slider').height(blogSliderActiveHeight);
    });

    // Portfolio slider

    $i('.portfolio-slider').sly({
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

    var viewport = $i(window).width();
    var portfolioSliderWidth = $i('.portfolio-slider').width();
    var portfolioSliderSlide = $i('.portfolio-slider li');
    var portfolioSliderSlideWidth = $i('.portfolio-slider li').width();
    var portfolioSliderImg = $i('.portfolio-slider li img');

    if(portfolioSliderSlideWidth > viewport){
        portfolioSliderSlide.css('max-width', portfolioSliderWidth);
        portfolioSliderImg.css('max-width', 'initial');
    }

});

////////////////////
//  CONTACT FORM
///////////////////

//Popup send  email
$i('#send_contact').click(function(){
    var sender_name    = document.getElementById('contactname');
    var sender_email   = document.getElementById('contactemail');
    var sender_message = document.getElementById('contactmessage');
    var error = 0;

    if(check_field(sender_message,js_variables.message_error_message,"Message")==false){
        error = 1;
    }
    if(validate_email(sender_email,js_variables.email_error_message,"E-mail")==false){
        $i('#contactemail').focus();
        error = 1;
    }
    if(check_field(sender_name,js_variables.name_error_message,"Name")==false){
        error = 1;
    }

    if(error == 0){
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data:{
                action: 'send_mail_popup',
                nonce: ajax_var.nonce,
                sender_name: sender_name.value,
                sender_email: sender_email.value,
                sender_message: sender_message.value
            },
            beforeSend:function(){
                $i("#contact-error").empty();
                $i("#contact-error").append('Sending...');
            },
            success: function(data){
                $i("#contact-error").empty();
                $i("#contact-error").append(data);
                setTimeout(function(){
                    $i('.md-modal').removeClass('md-show');
                    $i('#popup_form').each(function(){
                      this.reset();
                    });
                    $i("#contact-error").empty();
                },2000);

            }
        });
        return false;
    }
});


//Validation
function validate_email(field,alerttxt){
    with (field){
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2){
            jQuery('#contact-error').empty().append(alerttxt);
            return false;
        }else {
            return true;
        }
    }
}


function check_field(field,alerttxt,checktext){
    with (field){
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

function checkForm(thisform){
    with (thisform)
    {
        var error = 0;

        var contactmessage = document.getElementById('contactmessage');
        if(check_field(contactmessage, js_variables.message_error_message,"Message")==false){
            error = 1;
        }

        var email = document.getElementById('contactemail');
        if (validate_email(email, 'Please enter your email')==false){
            email.focus();
            error = 1;
        }

        var contactname = document.getElementById('contactname');
        if(check_field(contactname,js_variables.name_error_message,"Name")==false){
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

$i(window).resize(function(){
    var fullWidthSlide = $i('#full-width-sly li');
    var fullWidthSlideHeight = $i('#full-width-sly .slidee');
    var viewPortWidth = $i(window).outerWidth();
    var viewPortHeight = $i(window).height();

    fullWidthSlide.width(viewPortWidth);
    fullWidthSlideHeight.height(viewPortHeight);

    // Blog post slider

    var blogSliderWidth = $i('.post-slider').width();
    var blogSliderItemWidth = $i('.post-slider li').width(blogSliderWidth);

    $i('#full-width-sly').sly('reload');
    $i('.post-slider').sly('reload');
    $i('.portfolio-slide').sly('reload');
});
