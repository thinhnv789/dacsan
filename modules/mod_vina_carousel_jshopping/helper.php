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

// no direct access
defined('_JEXEC') or die('Restricted access');

class modVinaCarouselJShoppingHelper
{
/* Get Products */
	public static function getItems($params)
	{
		$moduleType = $params->get('moduleType', 2);
		$items		= array();
		
		switch($moduleType)
		{
			case "1":
				$items = modVinaCarouselJShoppingHelper::getBestSeller($params);
			break;
			case "3":
				$items = modVinaCarouselJShoppingHelper::getTopHits($params);
			break;
			case "4":
				$items = modVinaCarouselJShoppingHelper::getTopRating($params);
			break;
			case "5":
				$items = modVinaCarouselJShoppingHelper::getProductsLabel($params);
			break;
			default:
				$items = modVinaCarouselJShoppingHelper::getLatest($params);
			break;
		}
		
		return $items;
	}

/* Function get Products by Label */
	public static function getProductsLabel($params)
	{
		$product = JTable::getInstance('product', 'jshop');
		$catID   = $params->get('catids', NULL);
		$labelId = $params->get('label_id');
		$limit	 = $params->get('noProducts', 5);
		
		if(is_array($catID)) {    
			$catArr = array();
			foreach($catID as $key=>$curr){
			   if (intval($curr)) $catArr[$key] = intval($curr);
			}  
		}
		else {
			$catArr = array();
			if (intval($catID)) $catArr[] = intval($catID);
		}
		
		$items = $product->getProductLabel($labelId, $limit, $catArr);   
		foreach($items as $key=>$value){
			$items[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id=' . $value->category_id.'&product_id=' . $value->product_id ,1);
		}
		
		return $items;
	}
	
/* Function get Top Rating Products */
	public static function getTopRating($params)
	{
		$product = JTable::getInstance('product', 'jshop');
		$catID   = $params->get('catids', NULL);
		$limit	 = $params->get('noProducts', 5);
		
		if(is_array($catID)) {    
			$catArr = array();
			foreach($catID as $key=>$curr){
			   if (intval($curr)) $catArr[$key] = intval($curr);
			}  
		}
		else {
			$catArr = array();
			if (intval($catID)) $catArr[] = intval($catID);
		}
		
		$items = $product->getTopRatingProducts($limit, $catArr);   
		foreach($items as $key=>$value){
			$items[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id=' . $value->category_id.'&product_id=' . $value->product_id ,1);
		}
		
		return $items;
	}
	
/* Function get Top Hits Products */	
	public static function getTopHits($params)
	{
		$product = JTable::getInstance('product', 'jshop');
		$catID   = $params->get('catids', NULL);
		$limit	 = $params->get('noProducts', 5);
		
		if(is_array($catID)) {    
			$catArr = array();
			foreach($catID as $key=>$curr){
			   if (intval($curr)) $catArr[$key] = intval($curr);
			}  
		}
		else {
			$catArr = array();
			if (intval($catID)) $catArr[] = intval($catID);
		}
		
		$items = $product->getTopHitsProducts($limit, $catArr);
		
		foreach($items as $key=>$value){
			$items[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$value->category_id.'&product_id='.$value->product_id, 1);
		}
		
		return $items;
	}
	
/* Function get Latest Products */	
	public static function getLatest($params)
	{
		$product = JTable::getInstance('product', 'jshop');
		$catID   = $params->get('catids', NULL);
		$limit	 = $params->get('noProducts', 5);
		
		if(is_array($catID)) {    
			$catArr = array();
			foreach($catID as $key=>$curr){
			   if (intval($curr)) $catArr[$key] = intval($curr);
			}  
		}
		else {
			$catArr = array();
			if (intval($catID)) $catArr[] = intval($catID);
		}
		
		$items = $product->getLastProducts($limit, $catArr);
		
		foreach($items as $key=>$value){
			$items[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$value->category_id.'&product_id='.$value->product_id, 1);
		}
		
		return $items;
	}
	
/* Function get Best Seller Products */	
	public static function getBestSeller($params)
	{
		$product = JTable::getInstance('product', 'jshop');
		$catID   = $params->get('catids', NULL);
		$limit	 = $params->get('noProducts', 5);
		
		if(is_array($catID)) {    
			$catArr = array();
			foreach($catID as $key=>$curr){
			   if (intval($curr)) $catArr[$key] = intval($curr);
			}  
		}
		else {
			$catArr = array();
			if (intval($catID)) $catArr[] = intval($catID);
		}
		
		$items = $product->getBestSellers($limit, $catArr);
		
		foreach($items as $key=>$value){
			$items[$key]->product_link = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$value->category_id.'&product_id='.$value->product_id, 1);
		}
		
		return $items;
	}
}