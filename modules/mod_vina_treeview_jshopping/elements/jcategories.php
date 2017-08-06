<?php
/*
# ------------------------------------------------------------------------
# Vina Vina Treeview for JoomShopping for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum:    http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

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

JFormHelper::loadFieldClass('list');

class JFormFieldjCategories extends JFormFieldList
{
    protected $type = 'jcategories';
	
	protected function getOptions()
	{
		$options = array();
		$options[] = JHtml::_('select.option', '0', 'Root');
		
		$options = $this->getChildCategories(0, $options);
		
		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;
	}
	
	protected function getChildCategories($pid = 0, $options = array(), $level = 0)
	{
		$category 	= JTable::getInstance('category', 'jshop');        
		$categories = $category->getSubCategories($pid, 'id', 'asc', 1);
		
		$prefix = "|-";
		for($i = 0; $i < $level; $i++) $prefix .= "-";
		
		foreach($categories as $item) {	
			$options[] = JHtml::_('select.option', $item->category_id, $prefix . ' ' . $item->name);
			$child 	   = $category->getSubCategories($item->category_id, 'id', 'asc', 1);
			
			if(count($child)) {
				$level = $level + 1;
				$options = $this->getChildCategories($item->category_id, $options, $level ++);
			}
		}
		
		return $options;
	}
}