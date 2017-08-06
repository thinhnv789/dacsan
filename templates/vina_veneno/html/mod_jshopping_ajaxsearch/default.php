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
	
?>
<div class="jshop_ajaxsearch">
	<form name="searchForm" method="post" action="<?php print SEFLink("index.php?option=com_jshopping&controller=search&task=result", 1);?>" onsubmit="return isEmptyValue(jQuery('#jshop_search').val());" autocomplete="off">
		<input type="hidden" name="setsearchdata" value="1"/>
		<input type="hidden" name="search_type" value="<?php print $params->get('searchtype');?>"/>
		<input type="hidden" name="category_id" id="ajaxcategory_id" value="<?php print $category_id?>"/>
		<input type="hidden" name="include_subcat" value="<?php print $include_subcat?>"/>
		<input type="text" class="inputbox" onkeyup="ajaxSearch();" placeholder="Tìm kiếm sản phẩm" onfocus="ajaxSearch();" name="search" id="jshop_search" value="<?php print htmlspecialchars($search, ENT_QUOTES)?>" tìm kiếm />
		<?php if($show_cat_filer):?>
			<?php echo JHTML::_('select.genericlist', $categories_select, 'acategory_id', 'class = "inputbox"', 'category_id', 'name', $category_id, 'show_categories_filter');?>
		<?php endif;?>
		<button class="button btn btn-primary" onclick="this.form.search.focus();"><i class="icon-search"></i></button>
		<?php if($adv_search){?>
			<br/><a href="<?php print $adv_search_link?>"><?php print _JSHOP_ADVANCED_SEARCH?></a>
		<?php }?>
	</form>
	<div id="search-result"></div>
</div>
<script type="text/javascript">
	var ajaxlink = "<?php print SEFLink("index.php?option=com_jshopping&controller=ajaxsearch&ajax=1", 1, 1);?>";
	var displaycount = "<?php print $params->get('displaycount');?>";
	var searchtype = "<?php print $params->get('searchtype');?>";
</script>