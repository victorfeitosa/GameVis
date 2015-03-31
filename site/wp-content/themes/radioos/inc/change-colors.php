        
<?php

        /*************************************************************/
        /************COLOR SCHEME**********************************/
        /*************************************************************/

            //Body style
            $body_bg_image = get_theme_option(tk_theme_name.'_colors_body_bg_img');
            $body_image_position = get_theme_option(tk_theme_name.'_colors_body_img_position');
            $body_image_repeat = get_theme_option(tk_theme_name.'_colors_body_img_repeat');
            $body_image_attachment = get_theme_option(tk_theme_name.'_colors_body_img_attachment');
            $body_color = get_theme_option(tk_theme_name.'_colors_body_color');
        ?>                
                    
<style type="text/css">

    /*BODY*/
    body{
        background-color: <?php echo '#'.$body_color?>;
        background-attachment: <?php echo $body_image_attachment?>;
        background-image: url(<?php echo $body_bg_image?>);
        background-position: <?php echo $body_image_position?>;
        background-repeat: <?php echo $body_image_repeat?>}
</style>                      
             