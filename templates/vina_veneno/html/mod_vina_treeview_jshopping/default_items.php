<?php
/*
# ------------------------------------------------------------------------
# Module: Vina Treeview for JoomShopping
# ------------------------------------------------------------------------
# Copyright (C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://VinaGecko.com
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;
?>
<?php
foreach($categories as $item) :
	$child = $category->getSubCategories($item->category_id, $fieldSort, $ordering, 1);
?>
<li>
	<?php if(count($child)) : ?>
	<a href="<?php echo $item->category_link; ?>" title="<?php echo $item->name; ?>">
		<span class="catTitle <?php echo (($params->get('moduleStyle') == 'filetree') ? ' folder' : ''); ?>">
			<?php echo $item->name; ?>
			<?php if($count) : ?>(<?php echo $helper->countProductsinCategory($item->category_id); ?>)<?php endif; ?>
		</span>
	</a>
	<ul class="sub-menu">
		<?php
			$temp 		= $categories;
			$categories = $child;
			require JModuleHelper::getLayoutPath('mod_vina_treeview_jshopping', 'default_items');
			$categories = $temp;
		?>
	</ul>
	<?php else: ?>
	<a href="<?php echo $item->category_link; ?>" title="<?php echo $item->name; ?>">
		<span class="catTitle <?php echo (($params->get('moduleStyle') == 'filetree') ? ' file' : ''); ?>">
			<?php echo $item->name; ?>
			<?php if($count) : ?>(<?php echo $helper->countProductsinCategory($item->category_id); ?>)<?php endif; ?>
		</span>
	</a>
	<?php endif; ?>
</li>
<?php endforeach; ?>