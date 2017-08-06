<?php
defined('_JEXEC') or die('Restricted access');

class plgJshoppingCheckoutQuick_Checkout extends JPlugin{

    public function __construct(&$subject, $config = array()) {
        parent::__construct($subject, $config);
        $addon = JSFactory::getTable('addon', 'jshop');
        $addon->loadAlias('quick_checkout');
        $this->addon_params = $addon->getParams();        
    }
    
    public function onBeforeAddProductToCart(&$cart, &$product_id, &$quantity, &$attr_id, &$freeattributes, &$updateqty, &$errors, &$displayErrorMessage, &$additional_fields, &$usetriggers){
        if ($this->addon_params['hidebasket']){
            $cart->products = array();
        }
    }
    
    public function onJshopCartGetUrlListBefore(&$object, &$vars){
        if ($this->addon_params['hidebasket']){
            $vars['url'] = $this->getCheckoutUrl(0);            
        }
    }
    
    public function onBeforeDisplayCartView(&$view){        
        $view->href_checkout = $this->getCheckoutUrl();        
    }
    
    private function getCheckoutUrl($sef = 1){
        $jshopConfig = JSFactory::getConfig();
        if ($jshopConfig->shop_user_guest==1){
            $url = 'index.php?option=com_jshopping&controller=qcheckout&check_login=1';
        }else{
            $url = 'index.php?option=com_jshopping&controller=qcheckout';
        }
        if ($sef){
            $url = SEFLink($url, 1, 0, $jshopConfig->use_ssl);
        }
        return $url;
    }
    
}