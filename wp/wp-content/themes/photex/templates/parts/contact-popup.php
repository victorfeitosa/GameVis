<?php
$mail_success_msg = get_option(wp_get_theme()->name.'_contact_message_successful');
$mail_error_msg = get_option(wp_get_theme()->name.'_contact_message_unsuccessful');
$captcha_option = get_theme_option(wp_get_theme()->name.'_contact_disable_captcha');
?>

<div class="md-modal md-effect-2" id="modal-2">
  <div class="md-content">
    <h2 class="comment-reply-title"><?php _e('Don\'t hesitate to contact me.', 'tkingdom')?></h2>
    <div>
      <form id="popup_form">
          <fieldset>
              <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Name', 'tkingdom'); ?>" name="contactname" id="contactname" tabindex="1" />
              <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('E-mail', 'tkingdom'); ?>" name="email" id="contactemail" tabindex="2" />
              <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="message" id="contactmessage" tabindex="3" rows="5"><?php _e('Message', 'tkingdom'); ?></textarea>
              <div id="contact-error">
              </div><!-- contact-error -->
              <a href="#" class="close">x</a>
              <span id="send_contact" class="btn pull-right roboto-bold cta" type="submit"><?php _e('Send Message', 'tkingdom'); ?></span>
              <i class="icon-user"></i>
              <i class="icon-envelope"></i>
              <i class="icon-message"></i>
          </fieldset>
      
      
      </form>   
    </div><!-- /div -->
  </div><!-- /md-content -->      
</div><!-- /md-modal -->