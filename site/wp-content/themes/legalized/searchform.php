<form method="get" id="search" action="<?php echo home_url()  ?>/">
    <input type="text" name="s" class="search_field rounded" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
    <input type="submit" id="search_btn" class="rounded" value="Search" />
</form>