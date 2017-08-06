<?php
/*
# ------------------------------------------------------------------------
# Vina Product Carousel for JShopping for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum: http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$doc = JFactory::getDocument();
$doc->addScript('modules/mod_vina_carousel_jshopping/assets/js/owl.carousel.js', 'text/javascript');
$doc->addStyleSheet('modules/mod_vina_carousel_jshopping/assets/css/owl.carousel.css');
$doc->addStyleSheet('modules/mod_vina_carousel_jshopping/assets/css/owl.theme.css');
$timthumb = JURI::base() . 'modules/mod_vina_carousel_jshopping/libs/timthumb.php?a=c&amp;q=99&amp;z=0&amp;w='.$imageWidth.'&amp;h='.$imageHeight;
?>
<style type="text/css" scoped="">
#vina-carousel-jshopping<?php echo $module->id; ?> {
	width: <?php echo $moduleWidth; ?>;
	height: <?php echo $moduleHeight; ?>;
	margin: <?php echo $moduleMargin; ?>;
	padding: <?php echo $modulePadding; ?>;
	<?php echo ($bgImage != '') ? 'background: url('.$bgImage.') repeat scroll 0 0;' : ''; ?>
	<?php echo ($isBgColor) ? 'background-color:' . $bgColor : '';?>
	overflow: hidden;
}
#vina-carousel-jshopping<?php echo $module->id; ?> .item {
	<?php echo ($isItemBgColor) ? "background-color: {$itemBgColor};" : ""; ?>;
	color: <?php echo $itemTextColor; ?>;
	padding: <?php echo $itemPadding; ?>;
	margin: <?php echo $itemMargin; ?>;
}
#vina-carousel-jshopping<?php echo $module->id; ?> .item a {
	color: <?php echo $itemLinkColor; ?>;
}
</style>
<div id="vina-carousel-jshopping<?php echo $module->id; ?>" class="vina-carousel-jshopping owl-carousel">
	<?php 
		foreach($items as $key => $item) :
			$pid   = $item->product_id;
			$cid   = $item->category_id;
			$image = ($item->product_name_image) ? $item->product_name_image : $noimage;
			$image = $jshopConfig->image_product_live_path . '/' . $image;
			$image = ($resizeImage) ? $timthumb . "&amp;src=" . $image : $image;
			$title = $item->name;
			$intro = $item->short_description;
			$price = formatprice($item->product_price);
			$old_price = formatprice($item->product_old_price);
			$link  = $item->product_link;
			$review_mark = showMarkStar($item->average_rating);
			$buy   = JRoute::_("index.php?option=com_jshopping&controller=cart&task=add&category_id=$cid&product_id=$pid");
			$wishlist   = JRoute::_("index.php?option=com_jshopping&controller=cart&task=add&category_id=$cid&product_id=$pid&to=wishlist");
			$jshop_product = JTable::getInstance('product', 'jshop');
			$jshop_product->product_id = $pid;
			$images = $jshop_product->getImages();
			if(isset($images[1])) {
				$image_second = $images[1]->image_thumb;			
				$image_second = $jshopConfig->image_product_live_path.'/'.$image_second;
				$image_second = ($resizeImage) ? $timthumb . "&amp;src=" . $image_second : $image_second;				
			}
	?>
	<div class="item block_item">
		<div class="item_inner">
			<div class="item_content">
				<!-- Image Block -->
				<?php if($showImage) : ?>
				<div class="image">
					<div class="image_block">
						<?php if($item->label_id){?>		
							<div class="product_label">
							<?php if($item->_label_image){?>
								<img src="<?php print $item->_label_image?>" alt="<?php print htmlspecialchars($item->_label_name)?>" />
							<?php }else{?>
									<span class="label_name"><?php print $item->_label_name;?></span>
							<?php }?>						 
							</div>
						<?php }?>
						<a class="images" href="<?php echo $link; ?>" title="<?php echo $title; ?>">
							<?php if(isset($images[1])) { ?>
								<img class="jshop_img first-image" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
								<img class="jshop_img second-image" src = "<?php print $image_second; ?>" alt="" />
							<?php } else{ ?>
								<img class="jshop_img single-image" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
							<?php } ?>
						</a>
					</div>
				</div>
				<?php endif; ?>
				
				<!-- Text Block -->
				<?php if($showTitle || $showIntro || $showPrice) : ?>
				<div class="vina_content text-block">
					<!-- Title Block -->
					<?php if($showTitle) :?>
						<h3 class="name title">
							<a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
						</h3>
					<?php endif; ?>
					
					<!-- Price and Old Price -->
					<div class="vina_price">
						<?php if($showPrice) : ?>
							<p class="jshop_price price-block">
								<?php if ($jshopConfig->product_list_show_price_description) echo JTEXT::_('Price').": "; ?> <span><?php echo $price; ?></span>				
							</p>					
						<?php endif; ?>
						<?php if( $old_price){?>
							<?php if ($old_price > 0){// option modul product_old_price?>
								<p class="old_price"><?php if ($jshopConfig->product_list_show_price_description) print _JSHOP_OLD_PRICE.": ";?><span><?php print $old_price; ?></span></p>
							<?php }?>					
						<?php }?>
					</div>													
					<!-- Review Mark -->
															
						
					<!-- Intro text Block -->
					<?php if($showIntro && !empty($intro)) : ?>
						<div class="introtext"><?php echo $intro; ?></div>
					<?php endif; ?>									
				</div>
				
				<!-- Button Wishlist + Buy + View Detail -->					
				<?php if($showPrice){?>				
							
				<?php }?>			
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#vina-carousel-jshopping<?php echo $module->id; ?>").owlCarousel({
		items : 			<?php echo $itemsVisible; ?>,
        itemsDesktop : 		<?php echo $itemsDesktop; ?>,
        itemsDesktopSmall : <?php echo $itemsDesktopSmall; ?>,
        itemsTablet : 		<?php echo $itemsTablet; ?>,
        itemsTabletSmall : 	<?php echo $itemsTabletSmall; ?>,
        itemsMobile : 		<?php echo $itemsMobile; ?>,
        singleItem : 		<?php echo ($singleItem) ? 'true' : 'false'; ?>,
        itemsScaleUp : 		<?php echo ($itemsScaleUp) ? 'true' : 'false'; ?>,

        slideSpeed : 		<?php echo $slideSpeed; ?>,
        paginationSpeed : 	<?php echo $paginationSpeed; ?>,
        rewindSpeed : 		<?php echo $rewindSpeed; ?>,

        autoPlay : 		<?php echo ($autoPlay) ? 'true' : 'false'; ?>,
        stopOnHover : 	<?php echo ($stopOnHover) ? 'true' : 'false'; ?>,

        navigation : 	<?php echo ($navigation) ? 'true' : 'false'; ?>,
        rewindNav : 	<?php echo ($rewindNav) ? 'true' : 'false'; ?>,
        scrollPerPage : <?php echo ($scrollPerPage) ? 'true' : 'false'; ?>,

        pagination : 		<?php echo ($pagination) ? 'true' : 'false'; ?>,
        paginationNumbers : <?php echo ($paginationNumbers) ? 'true' : 'false'; ?>,

        responsive : 	<?php echo ($responsive) ? 'true' : 'false'; ?>,
        autoHeight : 	<?php echo ($autoHeight) ? 'true' : 'false'; ?>,
        mouseDrag : 	<?php echo ($mouseDrag) ? 'true' : 'false'; ?>,
        touchDrag : 	<?php echo ($touchDrag) ? 'true' : 'false'; ?>,
	});
}); 
</script>