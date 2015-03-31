jQuery(document).ready(function($) {
    var shortcodes = {
    	loadVals: function()
    	{
    		var shortcode = $('#old-shortcode').text(),
    			transform_shortcode = shortcode;

    		$('.popup-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('shortcode_', ''),
    				re = new RegExp("{{"+id+"}}","g");

    			transform_shortcode = transform_shortcode.replace(re, input.val());
    		});
    		$('#new-shortcode').remove();
    		$('#popup-table').prepend('<div id="new-shortcode" class="hidden">' + transform_shortcode + '</div>');

    		shortcodes.updatePreview();
    	},
        colorChange: function(){
            var shortcode = $('#old-shortcode').text(),
                transform_shortcode = shortcode;

            $('.colorpicker').each(function() {
                var input = $(this),
                    id = input.attr('id'),
                    id = id.replace('shortcode_', ''),
                    re = new RegExp("{{"+id+"}}","g");
                transform_shortcode = transform_shortcode.replace(re, input.val());
            });

            $('#new-shortcode').remove();
            $('#popup-table').prepend('<div id="new-shortcode" class="hidden">' + transform_shortcode + '</div>');

            jQuery('#sk-preview').attr('style', 'height:280px');

            shortcodes.updatePreview();
        },
        cLoadVals: function()
        {
            var shortcode = $('#_tz_cshortcode').text(),
                pShortcode = '';
                child_shortcodes = '';
            var tab_counter = '';

            $('.child-clone-row').each(function() {
                var row = $(this),
                    rShortcode = shortcode;

                $('.tz-cinput', this).each(function() {
                    var input = $(this),
                        id = input.attr('id'),
                        id = id.replace('shortcode_', ''),
                    re = new RegExp("{{"+id+"}}","g");
                    rShortcode = rShortcode.replace(re, input.val());
                    if(id == 'title'){tab_counter = tab_counter + input.val() + ',';}

                });

                child_shortcodes = child_shortcodes + rShortcode + "\n";

            });

            // adds the filled-in shortcode as hidden input
            $('#_tz_cshortcodes').remove();
            $('.child-clone-rows').prepend('<div id="_tz_cshortcodes" class="hidden">' + child_shortcodes + '</div>');

            // add to parent shortcode
            this.loadVals();
            pShortcode = $('#new-shortcode').text().replace('{{child_shortcode}}', child_shortcodes).replace('{{tabs}}', tab_counter);

            // add updated parent shortcode
            $('#new-shortcode').remove();
            $('#popup-table').prepend('<div id="new-shortcode" class="hidden">' + pShortcode + '</div>');

            // updates preview
            shortcodes.updatePreview();
        },
        children: function()
        {
            // assign the cloning plugin
            $('.child-clone-rows').appendo({
                subSelect: '> div.child-clone-row:last-child',
                labelAdd: 'Add More',
                allowDelete: false,
                focusFirst: false
            });

            // remove button
            $('.child-clone-row-remove').live('click', function() {
                var	btn = $(this),
                    row = btn.parent();

                if( $('.child-clone-row').size() > 1 )
                {
                    row.remove();
                }
                else
                {
                    alert('You need a minimum of one row');
                }

                return false;
            });

            // assign jUI sortable
            $( ".child-clone-rows" ).sortable({
                placeholder: "sortable-placeholder",
                items: '.child-clone-row'

            });
        },
    	updatePreview: function()
    	{
    		if( $('#sk-preview').size() > 0 )
    		{
                    var shortcode = $('#new-shortcode').html()
	    			var iframe = $('#sk-preview')
	    			var iframeSrc = iframe.attr('src')
	    			var iframeSrc = iframeSrc.split('preview.php')
	    			var iframeSrc = iframeSrc[0] + 'preview.php'

	    		iframe.attr( 'src', iframeSrc + '?sc=' + base64_encode( shortcode ) );

	    		$('#sk-preview').height( $('#popup-window').outerHeight()-42 );
    		}
    	},
    	resizeTB: function()
    	{
			var tiny_ajax = $('#TB_ajaxContent')
			var tiny_window = $('#TB_window')
			var popup = $('#popup-window')

				tiny_ajax.css({
					padding: 0,
					height: popup.outerHeight()-15,
				});

                if(tiny_ajax.outerHeight() > 720){
                    var new_height = 720;
                }else{
                    new_height = tiny_ajax.outerHeight()
                }

				tiny_window.css({
					width: tiny_ajax.outerWidth(),
					height: (new_height + 30),
					marginLeft: -(tiny_ajax.outerWidth()/2),
					marginTop: -((new_height + 47)/2),
					top: '50%'
				});

    	},
    	load: function()
    	{
    		var shortcodes = this
    		var popup = $('#popup-window')
    		var form = $('#popup-form', popup)
    		var shortcode = $('#old-shortcode', form).text()
    		var popupType = $('#shortcode-popup', form).text()
    		var transform_shortcode = ''

    		shortcodes.children();
            shortcodes.cLoadVals();
            shortcodes.colorChange();

            // update on children value change
            $('.repeated-popup-input', form).live('change', function() {
                shortcodes.cLoadVals();
            });

            // update color for the picker
            $('.wp-picker-container', form).live('mouseover', function() {
                shortcodes.colorChange();
                shortcodes.loadVals();
            });

    		$(window).resize(function() { shortcodes.resizeTB() });

    		shortcodes.loadVals();

            if(popupType == 'infobox'){
                $('.popup-input', form).change(function() {
                    shortcodes.colorChange();
                    shortcodes.loadVals();
                });
            }else{
                $('.popup-input', form).change(function() {
                    shortcodes.loadVals();
                });
            }

    		$('.insert', form).click(function() {
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#new-shortcode', form).html());
					tb_remove();
				}
    		});

            shortcodes.resizeTB();

        }
	}

    $('#popup-window').livequery( function() { shortcodes.load(); } );
});