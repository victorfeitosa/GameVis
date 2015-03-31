/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

//Update site title color in real time...
	wp.customize( 'body_color', function( value ) {

		value.bind( function( newval ) {
			$('body').css('background-color', newval );
		} );
	} );

        wp.customize( 'headline_colors', function( value ) {

		value.bind( function( newval ) {
			$('.shortcodes h1, .shortcodes h2, .shortcodes h3, .shortcodes h4, .shortcodes h5, .shortcodes h6, .title-page h1, .form h2').css('color', newval );
		} );
	} );


        wp.customize( 'paragraph_colors', function( value ) {
		value.bind( function( newval ) {
			$('.shortcodes p, .shortcodes, .shortcodes a, .shortcodes ol li, .shortcodes ul li, .shortcodes blockquote p, .pagination .page-numbers').css('color', newval );
                        $('.shortcodes blockquote p').css('border-left-color', newval );
		} );
	} );

        wp.customize( 'footer_background', function( value ) {
		value.bind( function( newval ) {
			$('.footer').css('background-color', newval );
		} );
	} );
        
        wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( newval ) {
			$('.footer ul li, .footer .newsletter span, .box-twitter-center span, .footer_box #wp-calendar caption, .footer_box #recentcomments li, .rss-date, .footer .twitter-links, \n\
                        .rssSummary, .footer_box cite, .footer-text, .textwidget, .textwidget p, .footer_box_holder .post-date, .footer_box #calendar_wrap th, .footer_box #wp-calendar tr td').css('color', newval );
		} );
	} );

        wp.customize( 'footer_headlines_color', function( value ) {
		value.bind( function( newval ) {
			$('.footer_box h2').css('color', newval );
		} );
	} );

        wp.customize( 'footer_link_color', function( value ) {
		value.bind( function( newval ) {
			$('.footer_box li a, .footer-text a, .footer_box tfoot a, .footer_box tbody a, .footer_box .box-twitter-center a, .footer_box .twittime, .footer_box_holder .rsswidget,  .footer_box .sub-menu li a, .footer_box .recentcomments a').css('color', newval );
		} );
	} );

        wp.customize( 'footer_border_color', function( value ) {
		value.bind( function( newval ) {
			$('body .footer').attr('style','border-top: 4px solid '+newval );
                        $('.slide a').css('background-color', newval);
		} );
	} );

            wp.customize( 'header_background_pattern', function( value ) {
             
		value.bind( function( newval ) {                   
                        $('body .header').attr('style', 'background-image:url('+newval+')');			
		} );
	} );





} )( jQuery );

