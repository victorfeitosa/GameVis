<form method="get" id="searchform" action="<?php echo home_url()  ?>/">
    <div class="header-search right">
	<input type="text" name="s" class="header-search-input" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="<?php _e('Enter search keyword', tk_theme_name)?>"/>
        <input type="submit" id="searchsubmit" class="header-search-button" value="" />
    </div>
</form>
