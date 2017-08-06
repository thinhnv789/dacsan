
<?php print $this->_tmp_product_html_body_image?>
<?php if(!count($this->images)){?>
    <img id="main_image" src="<?php print $this->image_product_path?>/<?php print $this->noimage?>" alt="<?php print htmlspecialchars($this->product->name)?>" />
<?php }?>

<?php foreach($this->images as $k=>$image){?>
<a class="lightbox" id="main_image_full_<?php print $image->image_id?>" href="<?php print $this->image_product_path?>/<?php print $image->image_name;?>" <?php if ($k!=0){?>style="display:none"<?php }?> title="<?php print htmlspecialchars($image->_title)?>">
    <div class="main_image thumbnail">		
		<img id = "main_image_<?php print $image->image_id?>" class="jshop_thumbnail_full" src = "<?php print $this->image_product_path?>/<?php print $image->image_name;?>" alt="<?php print htmlspecialchars($image->_title)?>" title="<?php print htmlspecialchars($image->_title)?>" data-zoom-image="<?php print $this->image_product_path?>/<?php print $image->image_full;?>" />
    </div>
	<div class="text_zoom">
		<img src="<?php print $this->path_to_image?>search.png" alt="zoom" />
		<span class="jshop_zoom"><?php print _JSHOP_ZOOM_IMAGE?></span>
	</div>
</a>
<?php }?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery(".zoomContainer").remove();
	jQuery('#list_product_image_middle').css('opacity', 0);
	jQuery("#list_product_image_middle > a").show();
	jQuery(".jshop_thumbnail_full").elevateZoom();
	jQuery("#list_product_image_middle > a").fadeOut();
	jQuery('#list_product_image_middle').children().first().fadeIn();
	setTimeout(function() {
		jQuery('#list_product_image_middle').css('opacity', 1);
	}, 500);
});
</script>