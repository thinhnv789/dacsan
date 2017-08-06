<?php
/*
# ------------------------------------------------------------------------
# Vina Manufacturers Carousel for JShopping for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum:    http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/
defined('_JEXEC') or die('Restricted access');
$doc = JFactory::getDocument();
$doc->addScript('modules/mod_vina_manufacturers_jshopping/assets/js/jquery.carouFredSel.min.js', 'text/javascript');
$doc->addScript('modules/mod_vina_manufacturers_jshopping/assets/js/jquery.mousewheel.min.js', 'text/javascript');
$doc->addScript('modules/mod_vina_manufacturers_jshopping/assets/js/jquery.touchSwipe.min.js', 'text/javascript');
$doc->addScript('modules/mod_vina_manufacturers_jshopping/assets/js/jquery.transit.min.js', 'text/javascript');
$doc->addScript('modules/mod_vina_manufacturers_jshopping/assets/js/jquery.ba-throttle-debounce.min.js', 'text/javascript');
$doc->addStyleSheet('modules/mod_vina_manufacturers_jshopping/assets/css/carouFredSel.css');
?>
<style type="text/css" scoped>
#vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?> {
	max-width: <?php echo $moduleWidth; ?>;
	height: <?php echo $moduleHeight; ?>;
	margin: <?php echo $moduleMargin; ?>;
	padding: <?php echo $modulePadding; ?>;
	<?php echo ($bgImage != '') ? "background: url({$bgImage}) repeat scroll 0 0;" : ''; ?>
	<?php echo ($isBgColor) ? "background-color: {$bgColor};" : '';?>
}
#vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?> li {
	margin: <?php echo $itemMargin; ?>;
}
#vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?> .vina-caption,
#vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?> .vina-caption a {
	background: <?php echo $captionBgColor; ?>;
	color:<?php echo $captionColor; ?>;
}
#vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?> .vina-pager > a > span {
	color: <?php echo $textPagination; ?>;
	background-color: <?php echo $bgPagination; ?>;
}
#vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?> .vina-pager a.selected > span{
	color: <?php echo $textPaginationA; ?>;
	background-color: <?php echo $bgPaginationA; ?>;
}
</style>
<div id="vina-manufacturers-jshopping-wrapper<?php echo $module->id; ?>" class="vina-manufacturers-jshopping">
	<ul id="vina-manufacturers-jshopping<?php echo $module->id; ?>">
		<?php foreach($list as $curr): ?>
		<li class="item">
			<!-- Image Block -->
			<?php if($showImage): ?>
				<?php if($linkOnImage): ?>
				<a href="<?php echo $curr->link; ?>" title="<?php echo $curr->name; ?>">
					<img src="<?php print $jshopConfig->image_manufs_live_path . "/" . $curr->manufacturer_logo; ?>" alt="<?php echo $curr->name; ?>" />
				</a>
				<?php else: ?>
				<img src="<?php print $jshopConfig->image_manufs_live_path . "/" . $curr->manufacturer_logo; ?>" alt="<?php echo $curr->name; ?>" />
				<?php endif; ?>
			<?php endif; ?>
			
			<!-- Caption Block -->
			<?php if($showName): ?>
			<div class="vina-caption">
				<?php if($linkOnName): ?>
				<a href="<?php echo $curr->link; ?>" title="<?php echo $curr->name; ?>"><?php echo $curr->name; ?></a>
				<?php else: ?>
				<?php echo $curr->name; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="clearfix"></div>
	
	<!-- Arrow Navigation Block -->
	<?php if($navigation): ?>
	<div id="vina-prev<?php echo $module->id; ?>" class="vina-prev">Prev</div>
	<div id="vina-next<?php echo $module->id; ?>" class="vina-next">Next</div>
	<?php endif; ?>
	
	<!-- Pagination Block -->
	<?php if($pagination): ?>
	<div id="vina-pager<?php echo $module->id; ?>" class="vina-pager"></div>
	<?php endif; ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function ($) {
	$(window).load(function(){
		$('#vina-manufacturers-jshopping<?php echo $module->id; ?>').carouFredSel({
			width: 		"100%",
			items: 		<?php echo $noItems; ?>,
			circular: 	<?php echo $circular ? 'true' : 'false'; ?>,
			infinite: 	<?php echo $infinite ? 'true' : 'false'; ?>,
			auto: 		<?php echo $auto ? 'true' : 'false'; ?>,
			mousewheel: <?php echo $mousewheel ? 'true' : 'false'; ?>,
			direction: 	"<?php echo $direction; ?>",
			align: 		"<?php echo $align; ?>",
			prev: 		'#vina-prev<?php echo $module->id; ?>',
			next: 		'#vina-next<?php echo $module->id; ?>',
			pagination: "#vina-pager<?php echo $module->id; ?>",
			swipe: {
				onMouse: <?php echo $mouseSwipe ? 'true' : 'false'; ?>,
				onTouch: <?php echo $touchSwipe ? 'true' : 'false'; ?>
			},
			scroll: {
				items           : <?php echo $scrollItems; ?>,
				fx				: "<?php echo $fx; ?>",
				easing          : "<?php echo $easing; ?>",
				duration        : <?php echo $duration; ?>,                         
				pauseOnHover    : <?php echo $pauseOnHover ? 'true' : 'false'; ?>
			}  
		});
	});
});
</script>