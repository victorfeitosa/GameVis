<form method="get" id="searchform" class="submit-search-form" action="<?php echo home_url()  ?>/">
    <div id="s">
        <input type="text" name="s" class="search-input" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value=""/>
        <input type="submit" id="searchsubmit" class="search-submit-button" value="" />
    </div>
</form>
