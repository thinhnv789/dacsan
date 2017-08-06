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
?>
<style type="text/css">
#vina-carousel-jshopping<?php echo $module->id; ?> {
	width: <?php echo $moduleWidth; ?>;
	height: <?php echo $moduleHeight; ?>;
	margin: <?php echo $moduleMargin; ?>;
	padding: <?php echo $modulePadding; ?>;
	<?php echo ($bgImage != '') ? "background: url({$bgImage}) repeat scroll 0 0;" : ''; ?>
	<?php echo ($isBgColor) ? "background-color: {$bgColor};" : '';?>
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
			$pid   	= $item->product_id;
			$cid   	= $item->category_id;
			$image 	= ($item->product_name_image) ? $item->product_name_image : $noimage;
			$image 	= $jshopConfig->image_product_live_path . '/' . $image;
			$image 	= ($resizeImage) ? $timthumb . "&src=" . $image : $image;
			$title 	= $item->name;
			$intro 	= $item->short_description;
			$price 	= formatprice($item->product_price);
			$oprice = formatprice($item->product_old_price);
			$link  	= $item->product_link;
			$buy   	= JRoute::_("index.php?option=com_jshopping&controller=cart&task=add&category_id=$cid&product_id=$pid");
			$label 	= $item->_label_image;
			$rate  	= $item->average_rating;
			$count 	= $item->reviews_count;
	?>
	<div class="item">
		<!-- Image Block -->
		<?php if($showImage) : ?>
		<div class="image-block">
			<a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
				<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
				<?php if($showLabel && $item->label_id): ?>
				<div class="plabel">
					<?php if($label): ?>
						<img src="<?php print $label; ?>" alt="<?php print htmlspecialchars($item->_label_name); ?>" />
					<?php else : ?>
						<span class="label-name"><?php print $item->_label_name;?></span>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</a>
		</div>
		<?php endif; ?>
		
		<!-- Text Block -->
		<?php if($showTitle || $showIntro || $showPrice) : ?>
		<div class="text-block">
			<!-- Title Block -->
			<?php if($showTitle) :?>
			<h3 class="title">
				<a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
			</h3>
			<?php endif; ?>
			
			<?php if($showRateReview): ?>
			<div class="info">
				<span class="pull-left"><?php print showMarkStar($rate); ?></span>
				<span class="pull-right"><?php print sprintf(_JSHOP_X_COMENTAR, $count);?></span>
			</div>
			<?php endif; ?>
			
			<!-- Intro text Block -->
			<?php if($showIntro && !empty($intro)) : ?>
			<div class="introtext"><?php echo $intro; ?></div>
			<?php endif; ?>
			
			<!-- Price/add to cart Block -->
			<?php if($showPrice) : ?>
			<div class="price-block">
				<strong><?php echo JTEXT::_('Price'); ?>:</strong> <span><?php if($item->product_old_price > 0): ?><i><?php echo $oprice; ?></i> <?php endif; ?><?php echo $price; ?></span>
				
				<a class="addtocart pull-right" href="<?php echo $buy; ?>" title="<?php echo $title; ?>">
					<?php echo JText::_('VINA_ADD2CART'); ?>
				</a>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
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