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



error_reporting(error_reporting() & ~E_NOTICE);

if(!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')) {

	JError::raiseError(500,"Please install component \"joomshopping\"");

} 



require_once(dirname(__FILE__).'/helper.php');

$helper = new modVinaCMenuJShoppingHelper;



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

$showHomeMenu	= $params->get('showHomeMenu', 1);

$menuItemId		= $params->get('menuItemId', null);



$bgColor		= $params->get('bgColor', '#2b2f3a');

$mainWidth		= $params->get('mainWidth', 'auto');

$mainAlign		= $params->get('mainAlign', 'align-left');

$mainFontSize	= $params->get('mainFontSize', '14px');

$mainBackground	= $params->get('mainBackground', '#333333');

$mainTextColor	= $params->get('mainTextColor', '#7a8189');

$mainTextHover	= $params->get('mainTextHover', '#ffffff');



$subWidth			= $params->get('subWidth', '130px');

$subFontSize		= $params->get('subFontSize', '12px');

$subTextColor		= $params->get('subTextColor', '#9ea2a5');

$subTextHover		= $params->get('subTextHover', '#8c9195');

$subBackground		= $params->get('subBackground', '#ffffff');

$subBackgroundHover	= $params->get('subBackgroundHover', '#fba026');

$subBorder			= $params->get('subBorder', '#eeeeee');



$category 	= JTable::getInstance('category', 'jshop');        

$categories = $category->getSubCategories($root, $fieldSort, $ordering, 1);



require(JModuleHelper::getLayoutPath('mod_vina_cmenu_jshopping', $params->get('layout', 'default')));

