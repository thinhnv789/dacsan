<?php
/**
 * @version		$Id: helper.php 2012-06-25 16:44:59Z manearaluca $
 * @package		Joomla.Site
 * @subpackage	mod_raljoomshopsearch
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modRaljoomshopsearchHelper
{
 	function __construct( &$_db ){
        parent::__construct( '#__jshopping_manufacturers', 'manufacturer_id', $_db );
    }

	static function getAllManufacturers($publish = 0, $order = "ordering", $dir ="asc" ) {
		$lang = &JSFactory::getLang();
		$db =& JFactory::getDBO();
        if ($order=="id") $orderby = "manufacturer_id";
        if ($order=="name") $orderby = "name";
        if ($order=="ordering") $orderby = "ordering";
        if (!$orderby) $orderby = "ordering"; 
		$query_where = ($publish)?("WHERE manufacturer_publish = '1'"):("");
		$query = "SELECT manufacturer_id, manufacturer_url, manufacturer_logo, manufacturer_publish, `".$lang->get('name')."` as name, `".$lang->get('description')."` as description,  `".$lang->get('short_description')."` as short_description
				  FROM `#__jshopping_manufacturers` $query_where ORDER BY ".$orderby." ".$dir;
		$db->setQuery($query);
		$list = $db->loadObjectList();
		
		foreach ($list as $key => $value){
            $list[$key]->link = SEFLink('index.php?option=com_jshopping&controller=manufacturer&task=view&manufacturer_id='.$list[$key]->manufacturer_id);
        }		
		return $list;
	}
}
