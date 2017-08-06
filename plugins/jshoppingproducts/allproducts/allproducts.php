<?php
defined('_JEXEC') or die();    

class plgJshoppingProductsAllproducts extends JPlugin{
    
    public function onJSFactoryGetTable(&$type, &$prefix, &$config){
        if (strtolower($type)=='category'){
            $type = 'category_subcat';
        }
    }
}