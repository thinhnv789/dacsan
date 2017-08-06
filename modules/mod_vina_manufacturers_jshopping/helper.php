<?php
/*
# ------------------------------------------------------------------------
# Vina Camera Image Slider for Joomla 3
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

class modVinaManufacturersJShoppingHelper
{
	public static function loadManufacturers($params)
	{
		$order 		= $params->get('sort', 'id');
		$direction 	= $params->get('ordering', 'asc');
				
		$manufacturer = JTable::getInstance('manufacturer', 'jshop');    
		$list = $manufacturer->getAllManufacturers(1, $order, $direction);
		
		foreach($list as $key => $value) {
			$list[$key]->link = SEFLink('index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id='.$list[$key]->manufacturer_id, 2);
		}
		
		return $list;
	}
}