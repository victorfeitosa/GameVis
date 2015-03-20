jQuery(document).ready(function ($) {

    /** Tabs & Toggles
     -------------------------------*/
    // Tabs
    if(jQuery().tabs) {
        $(".tk_sc_block_tabs").tabs({
            show: true
        });
    }

    // Toggles
    $('.tk_sc_block_toggle .tab-head, .tk_sc_block_toggle i').each( function() {
        var toggle = $(this).parent();

        $(this).click(function() {
            toggle.toggleClass('opened').find('.tab-body').animate({height: 'toggle'}, 400);
            return false;
        });

    });

    // Accordion
    $(document).on('click', '.tk_sc_block_accordion_wrapper .tab-head, .tk_sc_block_accordion_wrapper i', function() {
        var $clicked = $(this);

        $clicked.addClass('clicked');

        $clicked.parents('.tk_sc_block_accordion_wrapper').find('.tab-body').each(function(i, el) {
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