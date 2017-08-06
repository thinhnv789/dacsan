<script type = "text/javascript">
function isEmptyValue(value){
    var pattern = /\S/;
    return ret = (pattern.test(value)) ? (true) : (false);
}
</script>
<?php
	$text = "Tìm kiếm sản phẩm...";
	$on_text = 'onblur="if (this.value==\'\') this.value=\'' . $text . '\';" onfocus="if (this.value==\'' . $text . '\') this.value=\'\';"';
	$image = JURI::base().'templates/vina_erida/images/search.png' ;	
	$button = '<button class="button btn btn-primary" onclick="this.form.search.focus();"><i class="icon-search"></i></button>';
?>
<form name = "searchForm" method = "post" action="<?php print SEFLink("index.php?option=com_jshopping&controller=search&task=result", 1);?>" onsubmit = "return isEmptyValue(jQuery('#jshop_search').val())">
<input type="hidden" name="setsearchdata" value="1">
<input type = "hidden" name = "category_id" value = "<?php print $category_id?>" />
<input type = "hidden" name = "search_type" value = "<?php print $search_type;?>" />
<div class="vina_search">
	<input type = "text" class = "inputbox" name = "search" id = "jshop_search"  value = "<?php print $text; ?>" <?php print $on_text; ?> />		
	<?php if(file_exists($image)) { ?>
		<input class = "button" style="vertical-align: middle;" value="<?php echo $value; ?>" type = "image" value = "<?php print _JSHOP_GO?>" src="<?php print $image; ?>" />	
	<?php } else {
		print $button;
	} ?>
</div>
<?php if ($adv_search) {?>
<br /><a href = "<?php print $adv_search_link?>"><?php print _JSHOP_ADVANCED_SEARCH?></a>
<?php } ?>
</form>
