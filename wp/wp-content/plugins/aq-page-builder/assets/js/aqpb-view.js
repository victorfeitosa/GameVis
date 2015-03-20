/**
 * AQPB View JS
 * Front-end js for Aqua Page Builder blocks
 */

/** Fire up jQuery - let's dance! */

jQuery(document).ready(function ($) {

    /** Tabs & Toggles
     -------------------------------*/
    // Tabs
    if(jQuery().tabs) {
        $(".aq_block_tabs").tabs({
            show: true
        });
    }

    // Toggles
    $('.aq_block_toggle .tab-head, .aq_block_toggle i').each( function() {
        var toggle = $(this).parent();

        $(this).click(function() {
            toggle.toggleClass('opened').find('.tab-body').animate({height: 'toggle'});
            return false;
        });

    });

    // Accordion
    $(document).on('click', '.aq_block_accordion_wrapper .tab-head, .aq_block_accordion_wrapper .arrow', function() {
        var $clicked = $(this);

        $clicked.addClass('clicked');

        $clicked.parents('.aq_block_accordion_wrapper').find('.tab-body').each(function(i, el) {
            if($(el).is(':visible') && ( $(el).prev().hasClass('clicked') || $(el).prev().prev().hasClass('clicked') ) == false ) {
                $(el).slideUp();
            }
        });

        $clicked.parent().children('.tab-body').slideToggle();

        $clicked.removeClass('clicked');

        return false;
    });

    $('.tk-shortcode-tabs').each(function () {
        jQuery('.tab-content .tab-pane:first-child', this).addClass('active');
        jQuery('.nav-tabs a', this).click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    })
});