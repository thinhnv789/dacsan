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

error_reporting(error_reporting() & ~E_NOTICE);
if (!file_exists(JPATH_SITE.'/components/com_jshopping/jshopping.php')){
	JError::raiseError(500,"Please install component \"joomshopping\"");
}

require_once(JPATH_SITE.'/components/com_jshopping/lib/factory.php');
require_once(JPATH_SITE.'/components/com_jshopping/lib/functions.php');

JSFactory::loadCssFiles();
JSFactory::loadLanguageFile();
$jshopConfig = JSFactory::getConfig();

require_once dirname(__FILE__) . '/helper.php';

$items = modVinaTickerJShoppingHelper::getItems($params);

if(!count($items)) {
	echo 'No item found! Please check your config!';
	return;
}

// get params
$moduleclass_sfx 	= $params->get('moduleclass_sfx', '');
$noimage 		= "noimage.gif";
$showTitle 		= $params->get('showTitle', 1);
$showImage 		= $params->get('showImage', 1);
$resizeImage 	= $params->get('resizeImage', 1);
$imageWidth 	= $params->get('imageWidth', 250);
$imageHeight 	= $params->get('imageHeight', 200);
$showPrice 		= $params->get('showPrice', 1);
$showIntro 		= $params->get('showIntro', 1);
$showLabel		= $params->get('showLabel', 1);
$showRateReview	= $params->get('showRateReview', 1);

// Module Params
$moduleWidth	= $params->get('moduleWidth', '300px');
$moduleHeight	= $params->get('moduleHeight', 'auto');
$bgImage		 = $params->get('bgImage', NULL);
if($bgImage != '') {
	if(strpos($bgImage, 'http://') === FALSE) {
		$bgImage = JURI::base() . $bgImage;
	}
}
$isBgColor		= $params->get('isBgColor', 1);
$bgColor		= $params->get('bgColor', '#43609C');
$modulePadding	= $params->get('modulePadding', '10px');

$headerBlock	= $params->get('headerBlock', 1);
$headerText		= $params->get('headerText', '');
$headerColor	= $params->get('headerTextColor', '#FFFFFF');
$controlButtons	= $params->get('controlButtons', 1);

$isItemBgColor	= $params->get('isItemBgColor', 1);
$itemBgColor	= $params->get('itemBgColor', '#FFFFFF');
$itemPadding	= $params->get('itemPadding', '10px');
$itemTextColor	= $params->get('itemTextColor', '#141823');
$itemLinkColor	= $params->get('itemLinkColor', '#3B5998');

$direction		= $params->get('direction', 'up');
$easing			= $params->get('easing', 'jswing');
$speed			= $params->get('speed', 'slow');
$interval		= $params->get('interval', 5000);
$visible		= $params->get('visible', 2);
$mousePause		= $params->get('mousePause', 1);

$timthumb = JURI::base() . 'modules/mod_vina_ticker_jshopping/libs/timthumb.php?a=c&amp;q=99&amp;z=0&amp;w='.$imageWidth.'&amp;h='.$imageHeight;

// include layout
require(JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default')));