<?php
/**
 * @version		$Id: mod_raljoomshopsearch.php 2012-06-25 16:44:59Z manearaluca $
 * @package		Joomla.Site
 * @subpackage	mod_raljoomshopsearch
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS.'jshopping.php')){
    JError::raiseError(500,"Please install component \"joomshopping\"");
} 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."factory.php"); 
require_once (JPATH_SITE.DS.'components'.DS.'com_jshopping'.DS."lib".DS."functions.php");  


//load language files
JFactory::getLanguage()->load('com_jshopping');
JSFactory::loadLanguageFile();

$iNameral = $params->get('nameral');
$iCategoriesral = $params->get('categoriesral');
$iManufacturesral = $params->get('manufacturesral');
$iPricefromral = $params->get('pricefromral');
$iPricetoral = $params->get('pricetoral');
$iDatefromral = $params->get('datefromral');
$iDatetoral = $params->get('datetoral');





$document = &JFactory::getDocument();
$document->addScript(JURI::base().'components/com_jshopping/js/functions.js');
$document->addScript(JURI::base().'modules/mod_raljoomshopsearch/assets/mod_raljoomshopsearch.js');


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$jshopConfig = &JSFactory::getConfig();
    	JHTML::_('behavior.calendar');
        $mainframe =& JFactory::getApplication();
        $params = $mainframe->getParams();
        $Itemid = JRequest::getInt('Itemid');
        
        
    	 
        if ($params->get('show_page_heading') && $params->get('page_title')){
            $header = $params->get('page_title');
        }
        
        $seo = &JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("search");        
        if (getThisURLMainPageShop()){
            appendPathWay(_JSHOP_SEARCH);
            if ($seodata->title==""){
                $seodata->title = _JSHOP_SEARCH;
            }
        }else{
            if ($seodata->title==""){
                $seodata->title = $params->get('page_title');
            }
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $context = "jshoping.search.front";
        
        if ($jshopConfig->admin_show_product_extra_field){
            $urlsearchcaracters = SEFLink("index.php?option=com_jshopping&controller=search&task=get_html_characteristics&ajax=1",0,1);
            $change_cat_val = "onchange='updateSearchCharacteristic(\"".$urlsearchcaracters."\",this.value);'";
        }else{
            $change_cat_val = "";
        }
		$categories = buildTreeCategory(1);		
        $first = JHTML::_('select.option', 0, _JSHOP_SEARCH_ALL_CATEGORIES, 'category_id', 'name' );
		array_unshift($categories, $first);		
        $list_categories = JHTML::_('select.genericlist', $categories, 'category_id', 'class = "inputbox" size = "1" '.$change_cat_val, 'category_id', 'name' );
		
        $first = JHTML::_('select.option', 0, _JSHOP_SEARCH_ALL_MANUFACTURERS, 'manufacturer_id', 'name');
        $_manufacturers = &JTable::getInstance('manufacturer', 'jshop');
		$manufacturers = jshopManufacturer::getAllManufacturers(1);
		array_unshift($manufacturers, $first);		
        $list_manufacturers = JHTML::_('select.genericlist', $manufacturers, 'manufacturer_id', 'class = "inputbox" size = "1"','manufacturer_id','name' );
        
        if ($jshopConfig->admin_show_product_extra_field){
            $characteristic_fields = &JSFactory::getAllProductExtraField();
            $characteristic_fieldvalues = &JSFactory::getAllProductExtraFieldValueDetail();
            $characteristic_displayfields = &JSFactory::getDisplayFilterExtraFieldForCategory($category_id);
        }
        
        
        $sAction = SEFLink("index.php?option=com_jshopping&controller=search&task=result");

require JModuleHelper::getLayoutPath('mod_raljoomshopsearch', $params->get('layout', 'default'));