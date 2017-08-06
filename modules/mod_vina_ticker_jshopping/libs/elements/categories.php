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

class JFormFieldCategories extends JFormField
{
	public $type = 'categories';

	protected function getInput()
	{
		require_once (JPATH_SITE.'/modules/mod_vina_ticker_jshopping/elements.php'); 
		$tmp = new stdClass();  
		$tmp->category_id = "";
		$tmp->name = JText::_('JALL');
		$categories_1  = array($tmp);
		$categories_select =array_merge($categories_1 , buildTreeCategory(0)); 
		$ctrl  =  $this->name ;   
		$ctrl .= '[]'; 
		$value        = empty($this->value) ? '' : $this->value;    
		return JHTML::_('select.genericlist', $categories_select,$ctrl,'class="inputbox" id = "category_ordering" multiple="multiple"','category_id','name', $value );
	}
}