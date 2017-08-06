<?php
/*
# ------------------------------------------------------------------------
# Vina Product Carousel for JShopping for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum: http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

class JFormFieldLabels extends JFormField
{
	public $type ='Labels';

	protected function getInput()
	{
		require_once (JPATH_SITE.'/modules/mod_vina_carousel_jshopping/elements.php');  
		$tmp 		= new stdClass();
		$tmp->id 	= "";
		$tmp->name 	= JText::_('JALL');
		$element_1  = array($tmp);
		$productLabel 		= JTable::getInstance('productLabel', 'jshop');
		$listLabels 		= $productLabel->getListLabels();
		$elementes_select 	= array_merge($element_1 , $listLabels); 
		$ctrl  	= $this->name ;  
		$value  = empty($this->value) ? '' : $this->value; 

		return JHTML::_('select.genericlist', $elementes_select, $ctrl, 'class="inputbox"', 'id', 'name', $value );
	}
}