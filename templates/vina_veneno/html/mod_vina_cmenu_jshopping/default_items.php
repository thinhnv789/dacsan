<?php
/*
# ------------------------------------------------------------------------
# Vina Category Menu for JoomShopping for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum:    http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;
?>
<?php
foreach($categories as $item) :
	$link   = modVinaCMenuJShoppingHelper::replaceMenuItemId($item->category_link, $menuItemId);
	$child  = $category->getSubCategories($item->category_id, $fieldSort, $ordering, 1);
	$active = modVinaCMenuJShoppingHelper::getActiveState($item->category_id);
?>
<li class="menu-item<?php echo (count($child)) ? ' has-sub' : ''; echo $active; ?>">
	<?php if(count($child)) : ?>
	<a href="<?php echo $link; ?>" title="<?php echo $item->name; ?>">
		<span class="catTitle <?php echo (($params->get('moduleStyle') == 'filetree') ? ' folder' : ''); ?>">
			<?php echo $item->name; ?>
			<?php if($count) : ?>(<?php echo $helper->countProductsinCategory($item->category_id); ?>)<?php endif; ?>
		</span>
	</a>
	<ul class="sub-menu">
		<?php
			$temp 		= $categories;
			$categories = $child;
			require JModuleHelper::getLayoutPath('mod_vina_cmenu_jshopping', 'default_items');
			$categories = $temp;
		?>
	</ul>
	<?php else: ?>
	<a href="<?php echo $link; ?>" title="<?php echo $item->name; ?>">
		<span class="catTitle <?php echo (($params->get('moduleStyle') == 'filetree') ? ' file' : ''); ?>">
			<?php echo $item->name; ?>
			<?php if($count) : ?>(<?php echo $helper->countProductsinCategory($item->category_id); ?>)<?php endif; ?>
		</span>
	</a>
	<?php endif; ?>
</li>
<?php endforeach; ?>