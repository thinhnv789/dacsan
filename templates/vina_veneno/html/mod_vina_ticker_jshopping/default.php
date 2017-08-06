<?php
/*
# ------------------------------------------------------------------------
# Vina Product Ticker for JShopping for Joomla 3
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
$doc->addScript('modules/mod_vina_ticker_jshopping/assets/js/jquery.easing.min.js', 'text/javascript');
$doc->addScript('modules/mod_vina_ticker_jshopping/assets/js/jquery.easy-ticker.js', 'text/javascript');
$doc->addStyleSheet('modules/mod_vina_ticker_jshopping/assets/css/style.css');
$timthumb = JURI::base() . 'modules/mod_vina_ticker_jshopping/libs/timthumb.php?a=c&amp;q=99&amp;z=0&amp;w='.$imageWidth.'&amp;h='.$imageHeight;
?>
<div class="ticker_jshopping_tmpl">
<style type="text/css" scoped>
#vina-ticker-jshopping<?php echo $module->id; ?> {
	width: <?php echo $moduleWidth; ?>;
	padding: <?php echo $modulePadding; ?>;
	<?php echo ($bgImage != '') ? 'background: url('.$bgImage.') top center no-repeat;' : ''; ?>
	<?php echo ($isBgColor) ? 'background-color: ' . $bgColor : ''; ?>
}
#vina-ticker-jshopping<?php echo $module->id; ?> .vina-item {
	padding: <?php echo $itemPadding; ?>;
	color: <?php echo $itemTextColor; ?>;
	border-bottom: solid 1px <?php echo $bgColor; ?>;
	<?php echo ($isItemBgColor) ? 'background-color: ' . $itemBgColor : ''; ?>
}
#vina-ticker-jshopping<?php echo $module->id; ?> .vina-item a {
	color: <?php echo $itemLinkColor; ?>;
}
#vina-ticker-jshopping<?php echo $module->id; ?> .header-block {
	color: <?php echo $headerColor; ?>;
	margin-bottom: <?php echo $modulePadding; ?>;
}
</style>
<div id="vina-ticker-jshopping<?php echo $module->id; ?>" class="vina-ticker-jshopping">
<!-- Header Buttons Block -->
	<?php if($headerBlock) : ?>
	<div class="header-block">
		<div class="row-fluid">
			<?php if(!empty($headerText)) : ?>
			<div class="text-header">
				<h3 class="header"><span><?php echo $headerText; ?></span></h3>
			</div>
			<?php endif; ?>
			
			<?php if($controlButtons) : ?>			
			<div class="control-block">
				<span class="up">UP</span>
				<span class="toggle">TOGGLE</span>
				<span class="down">DOWN</span>
			</div>	
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

<!-- Items Block -->	
	<div class="vina-items-wrapper">
		<div class="vina-items">
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
					$link  = $item->product_link;
					$buy   = JRoute::_("index.php?option=com_jshopping&amp;controller=cart&task=add&amp;category_id=$cid&amp;product_id=$pid");
					$oprice = formatprice($item->product_old_price);
					$label 	= $item->_label_image;
					$rate  	= $item->average_rating;
					$count 	= $item->reviews_count;
			?>
			<div class="vina-item">
				<div class="row-fluid">
					<!-- Image Block -->
					<?php if($showImage) : ?>
					<div class="span<?php echo ($showTitle || $showIntro || $showPrice) ? 5 : 12; ?>">
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
					
					<?php if($showTitle || $showIntro || $showPrice) : ?>
					<div class="span<?php echo (!empty($image) && $showImage) ? 7 : 12; ?>">
						<div class="text-block">
							<!-- Title Block -->
							<?php if($showTitle) :?>
							<h4 class="title">
								<a href="<?php echo $link; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
							</h4>
							<?php endif; ?>
							
							<!-- Rate and Comment Block -->
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
							
							<!-- Readmore Block -->
							<?php if($showPrice) : ?>							
							<div class="vina_price price-block">
								<?php if ($jshopConfig->product_list_show_price_description) print '<span class="label_price">'.JTEXT::_('Price').': </span>'; ?>
								<p class="old_price">									
									<span><?php if($item->product_old_price > 0): ?><?php echo $oprice; ?> <?php endif; ?></span>
								</p>
								<p class="jshop_price">
									<span><?php echo $price; ?></span>
								</p>
							</div>
							<!--<div class="btn_addcart">
								<a class="addtocart pull-right" href="<?php echo $buy; ?>" title="<?php echo $title; ?>">
									<?php echo JText::_('VINA_ADD2CART'); ?>
								</a>
							</div> -->
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#vina-ticker-jshopping<?php echo $module->id; ?> .vina-items-wrapper').easyTicker({
		direction: 		'<?php echo $direction?>',
		easing: 		'<?php echo $easing?>',
		speed: 			'<?php echo $speed?>',
		interval: 		<?php echo $interval?>,
		height: 		'<?php echo $moduleHeight; ?>',
		visible: 		<?php echo $visible?>,
		mousePause: 	<?php echo $mousePause?>,
		
		<?php if($controlButtons) : ?>
		controls: {
			up: '#vina-ticker-jshopping<?php echo $module->id; ?> .up',
			down: '#vina-ticker-jshopping<?php echo $module->id; ?> .down',
			toggle: '#vina-ticker-jshopping<?php echo $module->id; ?> .toggle',
			playText: 'Play',
			stopText: 'Stop'
		},
		<?php endif; ?>
	});
});
</script>