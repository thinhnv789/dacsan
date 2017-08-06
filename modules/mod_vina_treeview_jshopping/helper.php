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
defined('_JEXEC') or die('Restricted access');

class modVinaTreeViewjShoppingHelper
{
	public static function countProductsinCategory($cid)
	{
		$db = JFactory::getDBO();
		
		$cid = modVinaTreeViewjShoppingHelper::getChildCategory($cid, array($cid));
		$cid = implode(", ", $cid);
		
		$query = "SELECT COUNT(*) FROM #__jshopping_products_to_categories WHERE category_id IN ($cid)";
		$db->setQuery($query);
		$count = $db->loadResult();
		
		return $count;
	}
	
	public static function getChildCategory($pid, $cid = array())
	{
		$category 	= JTable::getInstance('category', 'jshop');        
		$categories = $category->getSubCategories($pid);
		
		if(count($categories))
		foreach($categories as $item) {
			$id = $item->category_id;
			$cid[] = $id;
			$cid = modVinaTreeViewjShoppingHelper::getChildCategory($id, $cid);
		}
		
		return $cid;
	}
}