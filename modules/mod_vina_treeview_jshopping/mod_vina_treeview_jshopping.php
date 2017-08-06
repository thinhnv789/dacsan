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

error_reporting(error_reporting() & ~E_NOTICE);
if(!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')) {
	JError::raiseError(500,"Please install component \"joomshopping\"");
} 

require_once(dirname(__FILE__).'/helper.php');
$helper = new modVinaTreeViewjShoppingHelper;

require_once(JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
require_once(JPATH_SITE.'/components/com_jshopping/lib/jtableauto.php');
require_once(JPATH_SITE.'/components/com_jshopping/tables/config.php'); 
require_once(JPATH_SITE.'/components/com_jshopping/lib/functions.php');
require_once(JPATH_SITE.'/components/com_jshopping/lib/multilangfield.php');

JSFactory::loadCssFiles();

$lang = JFactory::getLanguage();

if(file_exists(JPATH_SITE.'/components/com_jshopping/lang/' . $lang->getTag() . '.php')) 
	require_once(JPATH_SITE.'/components/com_jshopping/lang/'.  $lang->getTag() . '.php'); 
else 
	require_once(JPATH_SITE.'/components/com_jshopping/lang/en-GB.php'); 

JTable::addIncludePath(JPATH_SITE.'/components/com_jshopping/tables'); 

$fieldSort 	= $params->get('sort', 'id');
$ordering	= $params->get('ordering', 'asc');
$root		= $params->get('root', 0);
$count		= $params->get('showCountItems', 1);

$category 	= JTable::getInstance('category', 'jshop');        
$categories = $category->getSubCategories($root, $fieldSort, $ordering, 1);

require(JModuleHelper::getLayoutPath('mod_vina_treeview_jshopping'));