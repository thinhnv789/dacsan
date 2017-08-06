<?php
/**
* @version		1.6.2
* @author		MAXXmarketing GmbH
* @copyright	Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
*/

defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class JshoppingControllerAjaxsearch extends JControllerLegacy{

	function display($cachable = false, $urlparams = false){
		$db = JFactory::getDBO();
		$lang = JSFactory::getLang();
		$word = JRequest::getVar('name');
		$catid = JRequest::getInt('catid');
		$search_type = JRequest::getVar('searchtype');
		$displaycount = JRequest::getInt('displaycount');

		$module = JModuleHelper::getModule('jshopping_ajaxsearch');
		$moduleParams = new JRegistry();
		$moduleParams->loadString($module->params);
		$moreResults = $moduleParams->get('more_results', 0);
		JFactory::getLanguage()->load('mod_jshopping_ajaxsearch', JPATH_SITE, $lang->lang, true);
		$include_subcat = $moduleParams->get('include_subcat', 0);

		jimport('joomla.version');
		$version = new JVersion();
		$versjoom = isset($version->RELEASE) ? intval($version->RELEASE) : 0;

		$prod_image_field = "prod.product_thumb_image";
		if ( $versjoom >= 3 ) {
			$prod_image_field = "prod.image";
		}

		$query_catid = " ";

		if ($catid != 0){
			if ($include_subcat){
				$_category = JSFactory::getTable('category', 'jshop');
				$all_categories = $_category->getAllCategories();
				$cat_search[] = $catid;
				searchChildCategories($catid, $all_categories, $cat_search);
				$categorys = array();
				foreach($cat_search as $key=>$value){
					$categorys[] = $value;
				}
				if (count($categorys)){
					$query_catid = " AND cat.category_id in (".implode(',', $categorys).") ";
				}
			}else{
				$query_catid = " AND cat.category_id = '".$catid."' ";
			}
		}

		if ($search_type=="exact"){
			$word = addcslashes($db->escape($word), "_%");
			$where_search = "LOWER(prod.`".$lang->get('name')."`) LIKE '%" . $word . "%' OR LOWER(prod.`".$lang->get('short_description')."`) LIKE '%" . $word . "%' OR LOWER(prod.`".$lang->get('description')."`) LIKE '%" . $word . "%' OR prod.product_ean LIKE '%" . $word . "%'";
		}else{
			$words = explode(" ", $word);
			$search_word = array();

			foreach($words as $word){
				$word = addcslashes($db->escape($word), "_%");
				$search_word[] = "(LOWER(prod.`".$lang->get('name')."`) LIKE '%" . $word . "%' OR LOWER(prod.`".$lang->get('short_description')."`) LIKE '%" . $word . "%' OR LOWER(prod.`".$lang->get('description')."`) LIKE '%" . $word . "%' OR prod.product_ean LIKE '%" . $word . "%')";
			}

			if ($search_type=="any"){
				$where_search = implode(" OR ", $search_word);
			}else{
				$where_search = implode(" AND ", $search_word);
			}
		}

		if (JSFactory::getConfig()->hide_product_not_avaible_stock)
			$where_search .= ' AND prod.product_quantity > 0';

		$limit = " LIMIT ".($displaycount+1);

		$query = "SELECT prod.`".$lang->get('name')."` as name, tocat.category_id, prod.product_id, $prod_image_field, prod.product_price, prod.currency_id, prod.product_tax_id as tax_id, prod.min_price, prod.different_prices
				  FROM `#__jshopping_products` as prod
				  LEFT JOIN `#__jshopping_products_to_categories` as tocat on tocat.product_id = prod.product_id
				  LEFT JOIN `#__jshopping_categories` AS cat ON tocat.category_id = cat.category_id
				  WHERE prod.product_publish = '1' ".$query_catid." AND cat.category_publish='1' AND (".$where_search.") GROUP BY prod.product_id ".$limit;
		$db->setQuery($query);
		$rows = $db->loadObjectList();

		if (count($rows)>$displaycount){
			$rows = array_slice($rows, 0, $displaycount);
		}else{
			$moreResults = 0;
		}

		if (count($rows)){
			$rows = listProductUpdateData($rows);
			addLinkToProducts($rows, 0, 1);

			$moreResultsLink = SEFLink("index.php?option=com_jshopping&controller=search&task=result&setsearchdata=1&search_type=".$search_type."&category_id=".JRequest::getInt('catid')."&search=".JRequest::getVar('name')."&include_subcat=".$include_subcat, 1);

			$view_name = "ajaxsearch";
			$view_config = array("template_path"=>JPATH_COMPONENT."/templates/addons/".$view_name);
			$view = $this->getView($view_name, getDocumentType(), '', $view_config);
			$view->setLayout("ajaxsearch");
			$view->assign('rows', $rows);
			$view->assign('moreResults', $moreResults);
			$view->assign('moreResultsLink', $moreResultsLink);
			$view->display();
		}
		die;
	}
}