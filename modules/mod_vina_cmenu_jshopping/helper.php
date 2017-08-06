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
defined('_JEXEC') or die('Restricted access');

class modVinaCMenuJShoppingHelper
{
	public static function countProductsinCategory($cid)
	{
		$db = JFactory::getDBO();
		
		$cid = modVinaCMenuJShoppingHelper::getChildCategory($cid, array($cid));
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
			$cid = modVinaCMenuJShoppingHelper::getChildCategory($id, $cid);
		}
		
		return $cid;
	}
	
	public static function replaceMenuItemId($link, $itemId) {
		
		if(empty($itemId)) return $link;
		
		$link = explode("Itemid=", $link);
		$link = (count($link) == 2) ? $link[0] . "Itemid=" . $itemId : $link[0] . "&Itemid=" . $itemId;
		
		return $link;
	}
	
	public static function getActiveState($cid) {
		$child  = modVinaCMenuJShoppingHelper::getChildCategory($cid);
		$active = JRequest::getVar('category_id');
		return (in_array($active, $child) || $active == $cid) ? ' active' : '';
	}
	
	public static function isHomePage() {
		$app  = JFactory::getApplication();
		$menu = $app->getMenu();
		if($menu->getActive() == $menu->getDefault()) {
			return ' active';
		}
	}
	
	public static function getCopyrightText($module)
	{
		echo '<div id="vina-copyright'.$module->id.'">© Free <a href="http://vinagecko.com/joomla-modules" title="Free Joomla! 3 Modules">Joomla! 3 Modules</a>- by <a href="http://vinagecko.com/" title="Beautiful Joomla! 3 Templates and Powerful Joomla! 3 Modules, Plugins.">VinaGecko.com</a></div>';
	}
}