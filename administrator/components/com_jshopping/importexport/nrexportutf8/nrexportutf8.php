<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.filesystem.folder');

class IeNRExportUtf8 extends IeController{

    function view(){
        $jshopConfig = JSFactory::getConfig();
        $ie_id = JRequest::getInt("ie_id");
        $_importexport = JTable::getInstance('ImportExport', 'jshop');
        $_importexport->load($ie_id);
        $name = $_importexport->get('name');
        $ie_params_str = $_importexport->get('params');
        $ie_params = parseParamsToArray($ie_params_str);

        $files = JFolder::files($jshopConfig->importexport_path.$_importexport->get('alias'), '.csv');
        $count = count($files);

        JToolBarHelper::title(_JSHOP_EXPORT. ' "'.$name.'"', 'generic.png' );
        JToolBarHelper::custom("backtolistie", "back", 'browser.png', _JSHOP_BACK_TO.' "'._JSHOP_PANEL_IMPORT_EXPORT.'"', false );
        JToolBarHelper::spacer();
        JToolBarHelper::save("save", _JSHOP_EXPORT);

        include(dirname(__FILE__)."/list_csv.php");
    }

    function save(){
        $mainframe = JFactory::getApplication();

        include_once(JPATH_COMPONENT_SITE."/lib/csv.io.class.php");

        $ie_id = JRequest::getInt("ie_id");
        if (!$ie_id) $ie_id = $this->get('ie_id');

        $_importexport = JTable::getInstance('ImportExport', 'jshop');
        $_importexport->load($ie_id);
        $alias = $_importexport->get('alias');
        $_importexport->set('endstart', time());
        $params = JRequest::getVar("params");
        if (is_array($params)){
            $paramsstr = parseArrayToParams($params);
            $_importexport->set('params', $paramsstr);
        }
        $_importexport->store();

        $ie_params_str = $_importexport->get('params');
        $ie_params = parseParamsToArray($ie_params_str);

        $jshopConfig = JSFactory::getConfig();
        $lang = JSFactory::getLang();
        $db = JFactory::getDBO();

        $query = "SELECT
                    prod.product_id,
                    prod.product_ean,
                    prod.product_quantity,
                    prod.product_date_added,
                    prod.product_price,
                    tax.tax_value as tax,
                    prod.`".$lang->get('name')."` as name,
                    prod.`".$lang->get('short_description')."` as short_description,
                    prod.`".$lang->get('description')."` as description,
                    cat.`".$lang->get('name')."` as cat_name,
                    categ.category_id,
                    prod.product_manufacturer_id,
                    prod.`".$lang->get('meta_description')."` as meta_description,
                    prod.`".$lang->get('meta_keyword')."` as meta_keyword,
                    prod.product_publish,
                    prod.product_template,
                    prod.delivery_times_id
                  FROM `#__jshopping_products` AS prod
                  LEFT JOIN `#__jshopping_products_to_categories` AS categ USING (product_id)
                  LEFT JOIN `#__jshopping_categories` as cat on cat.category_id=categ.category_id
                  LEFT JOIN `#__jshopping_taxes` AS tax ON tax.tax_id = prod.product_tax_id
                  GROUP BY prod.product_id";
        $db->setQuery($query);
        $products = $db->loadObjectList();

        $data = array();
        $head = array("product_id","ean","qty","date","price","tax","category","name","short_description","description", "category_id", "product_manufacturer_id", "meta_description", "meta_keyword", "product_publish", "product_template", "delivery_times_id");
        $data[] = $head;

        foreach($products as $prod){
            $row = array();
            $row[] = $prod->product_id;
            $row[] = $prod->product_ean;
            $row[] = $prod->product_quantity;
            $row[] = $prod->product_date_added;
            $row[] = $prod->product_price;
            $row[] = $prod->tax;
            $row[] = ($prod->cat_name);
            $row[] = ($prod->name);
            $row[] = ($prod->short_description);
            $row[] = ($prod->description);
            $row[] = ($prod->category_id);
            $row[] = ($prod->product_manufacturer_id);
            $row[] = ($prod->meta_description);
            $row[] = ($prod->meta_keyword);
            $row[] = $prod->product_publish;
            $row[] = $prod->product_template;
            $row[] = $prod->delivery_times_id;
            $data[] = $row;
        }


        $filename = $jshopConfig->importexport_path.$alias."/".$ie_params['filename']."_".date("d-m-Y_H_i").".csv";

        $csv = new csv();
        $csv->write($filename, $data);

        if (!JRequest::getInt("noredirect")){
            $mainframe->redirect("index.php?option=com_jshopping&controller=importexport&task=view&ie_id=".$ie_id, _JSHOP_COMPLETED);
        }
    }

    function filedelete(){
        $mainframe = JFactory::getApplication();
        $jshopConfig = JSFactory::getConfig();
        $ie_id = JRequest::getInt("ie_id");
        $_importexport = JTable::getInstance('ImportExport', 'jshop');
        $_importexport->load($ie_id);
        $alias = $_importexport->get('alias');
        $file = JRequest::getVar("file");
        $filename = $jshopConfig->importexport_path.$alias."/".$file;
        @unlink($filename);
        $mainframe->redirect("index.php?option=com_jshopping&controller=importexport&task=view&ie_id=".$ie_id);
    }

}
?>