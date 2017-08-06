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
require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php'); 
require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');        
   
$db = JFactory::getDBO();
$jshopConfig = JSFactory::getConfig();
$jshopConfig->cur_lang = $jshopConfig->frontend_lang;