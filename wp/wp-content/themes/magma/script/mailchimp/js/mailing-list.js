jQuery(document).ready(function() {	//Widget Newsletter form submit	jQuery('#signup').submit(function() {		jQuery('#response').html('Adding email address...');                var file_path = jQuery('.hidden_path').val();		jQuery.ajax({			url: file_path,			data: 'ajax=true&email=' + escape(jQuery('#email').val()) + '&_mailchimp_key=' + escape(jQuery('#_mailchimp_key').val()) + '&_mailchimp_list=' + escape(jQuery('#_mailchimp_list').val()),			success: function(msg) {				jQuery('#response').html(msg);			}		});		return false;	});	//Footer Newsletter form submit	jQuery('#signup_footer').submit(function() {		jQuery('#response_footer').html('Adding email address...');                var file_path = jQuery('.hidden_path').val();		jQuery.ajax({			url: file_path,			data: 'ajax=true&email=' + escape(jQuery('#email').val()) + '&_mailchimp_key=' + escape(jQuery('#_mailchimp_key').val()) + '&_mailchimp_list=' + escape(jQuery('#_mailchimp_list').val()),			success: function(msg) {				jQuery('#response_footer').html(msg);			}		});		return false;	});});