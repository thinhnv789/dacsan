<?php
/**
* @version      4.16.0
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2016 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die();
include_once dirname(__FILE__).'/category.php';

class jshopCategory_subcat extends jshopCategory{

    protected $category_ids = 0;

    public function load($keys = null, $reset = true){        
        if ($keys){
            $this->category_ids = $this->getCategoryChildrenAnyNode((int)$keys);            
        }
        return parent::load($keys, $reset);
    }
	
    function getProducts($filters, $order = null, $orderby = null, $limitstart = 0, $limit = 0){
        $adv_query = ""; $adv_from = ""; $adv_result = $this->getBuildQueryListProductDefaultResult();
        $this->getBuildQueryListProduct("category", "list", $filters, $adv_query, $adv_from, $adv_result);
        $order_query = $this->getBuildQueryOrderListProduct($order, $orderby, $adv_from);

        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onBeforeQueryGetProductList', array("category", &$adv_result, &$adv_from, &$adv_query, &$order_query, &$filters) );

        $query = "SELECT $adv_result FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS pr_cat USING (product_id)
                  $adv_from
                  WHERE pr_cat.category_id IN (".$this->category_ids.") AND prod.product_publish=1 ".$adv_query."
				  GROUP BY prod.product_id ".$order_query;
        if ($limit){
            $this->_db->setQuery($query, $limitstart, $limit);
        }else{
            $this->_db->setQuery($query);
        }
        $products = $this->_db->loadObjectList();
        $products = listProductUpdateData($products);
        addLinkToProducts($products);
        return $products;
    }

    function getCountProducts($filters, $order = null, $orderby = null){        
        $adv_query = ""; $adv_from = ""; $adv_result = "COUNT(distinct prod.product_id)";
        $this->getBuildQueryListProduct("category", "count", $filters, $adv_query, $adv_from, $adv_result);

        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onBeforeQueryCountProductList', array("category", &$adv_result, &$adv_from, &$adv_query, &$filters) );

        $query = "SELECT $adv_result FROM `#__jshopping_products_to_categories` AS pr_cat
                  INNER JOIN `#__jshopping_products` AS prod ON pr_cat.product_id = prod.product_id
                  $adv_from 
                  WHERE pr_cat.category_id IN (".$this->category_ids.") AND prod.product_publish=1 ".$adv_query;
        $this->_db->setQuery($query);
        return $this->_db->loadResult();
    }
        
    function getManufacturers(){
        $jshopConfig = JSFactory::getConfig();
        $user = JFactory::getUser();
        $lang = JSFactory::getLang();
        $adv_query = "";
        $groups = implode(',', $user->getAuthorisedViewLevels());
        $adv_query .=' AND prod.access IN ('.$groups.')';
        if ($jshopConfig->hide_product_not_avaible_stock){
            $adv_query .= " AND prod.product_quantity > 0";
        }
        if ($jshopConfig->manufacturer_sorting==2){
            $order = 'name';
        }else{
            $order = 'man.ordering';
        }
        $query = "SELECT distinct man.manufacturer_id as id, man.`".$lang->get('name')."` as name FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)
                  LEFT JOIN `#__jshopping_manufacturers` as man on prod.product_manufacturer_id=man.manufacturer_id 
                  WHERE categ.category_id IN (".$this->category_ids.") AND prod.product_publish=1 AND prod.product_manufacturer_id!=0 ".$adv_query." "
                . "order by ".$order;
        $this->_db->setQuery($query);
        $list = $this->_db->loadObjectList();
        return $list;
    }    
    
    protected function getCategoryChildrenAnyNode($id){
        $db = JFactory::getDBO();
        if ($id==0){
            return NULL;
        }
        $ids = $id;
        $all_ids = Array();
        $all_ids[] = $ids;        
        do{
            $query = "SELECT category_id FROM #__jshopping_categories WHERE category_parent_id IN ($ids)";
            $db->setQuery($query);
            $cats = $db->loadObjectList();

            $arr_ids = Array();
            if ( count($cats) > 0 ){
                foreach ($cats as $c) {
                    $arr_ids[] = $c->category_id;   
                    $all_ids[] = $c->category_id;   
                }
            }
            $ids = implode(",", $arr_ids);
        }
        while ( count($cats) > 0 );
        
        $allCatChild = implode(",", $all_ids);
        return $allCatChild;
    }

}