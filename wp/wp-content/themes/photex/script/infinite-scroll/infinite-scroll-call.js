var $i = jQuery.noConflict();

$i(document).ready(function(){

    // Isotope
    var $container = $i('.gallery-masonry').isotope({
        animationEngine: 'best-available',
        layoutMode: 'sloppyMasonry',
        itemSelector : '.gallery-item',
        sortBy : 'original-order'
    });

    $container.imagesLoaded( function() {
        $container.isotope('reLayout');
    });

    // Infinite-Scroll
    var viewPortWidth = $i(window).outerWidth();
    var viewPortHeight = $i(window).height();
    var theme_url = $i('#theme_url').data('theme_url');
    var loading_img_url = theme_url+'/theme-images/loading.gif';
    var post_js_script = theme_url+'/script/post-like.js';

    if(viewPortWidth > 767){
        $i('.gallery-masonry').infinitescroll({
            navSelector  : '.pagination',    // selector for the paged navigation
            nextSelector : '.pagination .next',  // selector for the NEXT link (to page 2)
            itemSelector : '.gallery-item',     // selector for all items you'll retrieve
            bufferPx     : -100,
            loading: {
                finishedMsg: 'No more posts to load.',
                img: loading_img_url
            }
        },
            // call Isotope as a callback
            function( newElements ) {
                var $newElems = $i( newElements ).hide();
                var imageOptions = $i('.img-options');
                $newElems.imagesLoaded( function() {
                    $newElems.fadeIn(); // fade in when ready
                    $container.isotope( 'appended', $newElems );
                });

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

                        $i(imageOptions).on('click touchend', function() {
                            $i('.img-options').removeClass('active');
                            $i(this).toggleClass('active');
                        });
                    }
                });

                $i.getScript(post_js_script);

            }
        );
    }

});