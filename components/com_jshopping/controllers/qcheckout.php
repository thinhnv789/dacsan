<?php
/**
* @version      1.1.1 11.07.2014
* @author       MAXXmarketing GmbH
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      MAXXmarketing GmbH
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
include_once(JPATH_COMPONENT_SITE."/payments/payment.php");
include_once(JPATH_COMPONENT_SITE."/shippingform/shippingform.php");

class JshoppingControllerQCheckout extends JControllerLegacy{
    
    public function __construct($config = array()){
        parent::__construct($config);
        $document = JFactory::getDocument();
        $document->addCustomTag('<link type = "text/css" rel = "stylesheet" href = "'.JURI::root().'components/com_jshopping/css/quick_checkout.css" />');
        $document->addScript(JURI::root().'components/com_jshopping/js/quick_checkout.js', 'text/javascript');
    }

    private function checkoutStep3(&$dispatcher, &$jshopConfig, &$cart, &$view, &$adv_user){
        $dispatcher->trigger('onLoadCheckoutStep3', array());
        if ($jshopConfig->without_payment){
            $cart->setPaymentId(0);
            $cart->setPaymentParams("");
            $cart->setPaymentPrice(0);
            $view->assign('payment_step', 0);
        } else {
            $load_payments = $this->getPayments($adv_user, $jshopConfig, $cart);
            $paym = $load_payments['payments'];
            $active_payment = $load_payments['active_payment'];
            
            //$s_payment_method_id = $cart->getPaymentId();
            $post = array();
            //if ($active_payment != intval($s_payment_method_id) || !$active_payment){
                if (!$jshopConfig->hide_payment_step){
                    $this->_setPayment($post, $cart, $this->getPaymentClassForPaymentsArray($paym, $active_payment), null, $adv_user);
                }
            //}

            if ($jshopConfig->hide_payment_step){
                if (!$paym[0]->payment_class){
                    $this->setSessionError(_JSHOP_ERROR_PAYMENT);
                    $paym[0]->payment_class = '';
                }
                $this->_setPayment($post, $cart, $paym[0]->payment_class, null, $adv_user);
                $view->assign('payment_step', 0);
                $view->assign('active_payment', $paym[0]->payment_id);
                $view->assign('active_payment_name', $paym[0]->name);
                $view->assign('active_payment_class', $paym[0]->payment_class);
            } else {
                $view->assign('payment_step', 1);
                $view->assign('payment_methods', $paym);
                $view->assign('active_payment', $active_payment);
                $dispatcher->trigger('onBeforeDisplayCheckoutStep3View', array(&$view));
            }
        
        }
    }
    
    private function checkoutStep4(&$dispatcher, &$jshopConfig, &$cart, &$view, &$adv_user){
        $dispatcher->trigger('onLoadCheckoutStep4', array());
        if ($jshopConfig->without_shipping) {
            $cart->setShippingId(0);
            $cart->setShippingPrice(0);
            $cart->setPackagePrice(0);
            $view->assign('delivery_step', 0);
        } else {
            if ($adv_user->delivery_adress){
                $id_country = $adv_user->d_country;
            }else{
                $id_country = $adv_user->country;
            }
            if (!$id_country) $id_country = $jshopConfig->default_country;

            if (!$id_country){
                $this->setSessionError(_JSHOP_REGWARN_COUNTRY);
            }

            $load_shippings = $this->getShippings($adv_user, $id_country, $jshopConfig, $cart);
            $shippings = $load_shippings['shippings'];
            $active_shipping = $load_shippings['active_shipping'];

            //$sh_pr_method_id = $cart->getShippingPrId();
            
            //if ($active_shipping != intval($sh_pr_method_id) || !$active_shipping){
                if (!$jshopConfig->hide_shipping_step){
                    $this->_setShipping($cart, $adv_user, $id_country, $active_shipping, $jshopConfig, null);
                }
            //}
            
            if ($jshopConfig->hide_shipping_step){
                if (!$shippings[0]->sh_pr_method_id && ($jshopConfig->hide_payment_step || $jshopConfig->without_payment)){
                    $this->setSessionError(_JSHOP_ERROR_SHIPPING);
                }

                if (!$shippings[0]->sh_pr_method_id){
                    $shippings[0]->sh_pr_method_id = '';
                }
                
                $this->_setShipping($cart, $adv_user, $id_country, $active_shipping, $jshopConfig, null);
                $view->assign('delivery_step', 0);
                $view->assign('active_shipping', $shippings[0]->sh_pr_method_id);
                $view->assign('active_shipping_name', $shippings[0]->name);
                $view->assign('active_sh_pr_method_id', $shippings[0]->sh_pr_method_id);
            } else {
                $view->assign('delivery_step', 1);
                $view->assign('shipping_methods', $shippings);
                $view->assign('active_shipping', $active_shipping);
                $dispatcher->trigger('onBeforeDisplayCheckoutStep4View', array(&$view));
            }
        }
    }
    
    function display($cachable = false, $urlparams = false){
        $checkout = JModelLegacy::getInstance('checkout', 'jshop');
        $checkout->checkStep(2);
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onLoadCheckoutStep2', array());
        
        $session = JFactory::getSession();
        $jshopConfig = JSFactory::getConfig();
        $country = JTable::getInstance('country', 'jshop');
        
        $checkLogin = JRequest::getInt('check_login');
        if ($checkLogin){
            $session->set("show_pay_without_reg", 1);
            checkUserLogin();
        }

        appendPathWay(_JSHOP_CHECKOUT);
        $seo = JTable::getInstance("seo", "jshop");
        $seodata = $seo->loadData("checkout-address");
        if ($seodata->title==""){
            $seodata->title = _JSHOP_CHECKOUT;
        }
        setMetaData($seodata->title, $seodata->keyword, $seodata->description);
        
        $cart = JModelLegacy::getInstance('cart', 'jshop');
        $cart->load();
        $cart->getSum();

        $adv_user = JSFactory::getUser();

        //initialize view
        $view_name = "quick_checkout";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/addons/".$view_name);
        $view = $this->getView($view_name, getDocumentType(), '', $view_config);
        $view->assign('select', $jshopConfig->user_field_title);
        
        //address
        $tmp_fields = $jshopConfig->getListFieldsRegister();
        $config_fields = $tmp_fields['address'];
        $count_filed_delivery = $jshopConfig->getEnableDeliveryFiledRegistration('address');
        
        if ($config_fields['birthday']['display'] || $config_fields['d_birthday']['display']){
            JHTML::_('behavior.calendar');
        }
        
        if (!$adv_user->country) $adv_user->country = $jshopConfig->default_country;
        if (!$adv_user->d_country) $adv_user->d_country = $jshopConfig->default_country;
        
        $adv_user->birthday = getDisplayDate($adv_user->birthday, $jshopConfig->field_birthday_format);
        $adv_user->d_birthday = getDisplayDate($adv_user->d_birthday, $jshopConfig->field_birthday_format);

        $option_country[] = JHTML::_('select.option',  '0', _JSHOP_REG_SELECT, 'country_id', 'name' );
        $option_countryes = array_merge($option_country, $country->getAllCountries());
        $select_countries = JHTML::_('select.genericlist', $option_countryes, 'country', 'class = "inputbox" size = "1"','country_id', 'name', $adv_user->country );
        $select_d_countries = JHTML::_('select.genericlist', $option_countryes, 'd_country', 'class = "inputbox" size = "1"','country_id', 'name', $adv_user->d_country);

        foreach ($jshopConfig->user_field_title as $key => $value) {
            $option_title[] = JHTML::_('select.option', $key, $value, 'title_id', 'title_name');
        }
        $select_titles = JHTML::_('select.genericlist', $option_title, 'title', 'class = "inputbox"','title_id', 'title_name', $adv_user->title);            
        $select_d_titles = JHTML::_('select.genericlist', $option_title, 'd_title', 'class = "inputbox"','title_id', 'title_name', $adv_user->d_title);
        
        $client_types = array();
        foreach ($jshopConfig->user_field_client_type as $key => $value) {
            $client_types[] = JHTML::_('select.option', $key, $value, 'id', 'name' );
        }
        $select_client_types = JHTML::_('select.genericlist', $client_types,'client_type','class = "inputbox" onchange="showHideFieldFirm(this.value)"','id','name', $adv_user->client_type);
        filterHTMLSafe( $adv_user, ENT_QUOTES);
        
        $view->assign('select_countries', $select_countries);
        $view->assign('select_d_countries', $select_d_countries);
        $view->assign('select_titles', $select_titles);
        $view->assign('select_d_titles', $select_d_titles);
        $view->assign('select_client_types', $select_client_types);
        $view->assign('live_path', JURI::base());
        $view->assign('config_fields', $config_fields);
        $view->assign('count_filed_delivery', $count_filed_delivery);
        $view->assign('user', $adv_user);
        $view->assign('delivery_adress', $adv_user->delivery_adress);
        $dispatcher->trigger('onBeforeDisplayCheckoutStep2View', array(&$view));
        // end address
        
        if ($jshopConfig->step_4_3){
            //delivery method
            $this->checkoutStep4($dispatcher, $jshopConfig, $cart, $view, $adv_user);
            //payments
            $this->checkoutStep3($dispatcher, $jshopConfig, $cart, $view, $adv_user);
        } else {
            //payments
            $this->checkoutStep3($dispatcher, $jshopConfig, $cart, $view, $adv_user);
            //delivery method
            $this->checkoutStep4($dispatcher, $jshopConfig, $cart, $view, $adv_user);
        }
        
        $delivery = $this->getDeliveryTimeDate($cart, $jshopConfig);
        $small_cart = $this->_showSmallCart();
        
        //preview finish
        $dispatcher->trigger('onLoadCheckoutStep5', array() );
        $sh_method = null; $pm_method = null; $delivery_info = null;
        
        $no_return = 0;
        if ($jshopConfig->return_policy_for_product){
            $cart_products = array();
            foreach($cart->products as $products){
                $cart_products[] = $products['product_id'];
            }
            $cart_products = array_unique($cart_products);
            $_product_option = JTable::getInstance('productOption', 'jshop');
            $list_no_return = $_product_option->getProductOptionList($cart_products, 'no_return');
            $no_return = intval(in_array('1', $list_no_return));
        }
        if ($jshopConfig->no_return_all){
            $no_return = 1;
        }
        
        $dispatcher->trigger('onBeforeDisplayCheckoutStep5', array(&$sh_method, &$pm_method, &$delivery_info, &$cart, &$view));
        $view->assign('no_return', $no_return);
        $view->assign('delivery_time', $delivery['delivery_time']);
        $view->assign('delivery_date', $delivery['delivery_date']);
        
        //view
        $view->assign('small_cart', $small_cart);
        $view->assign('jshopConfig', $jshopConfig);
        $view->assign('action', SEFLink('index.php?option=com_jshopping&controller=qcheckout&task=save', 0, 0, $jshopConfig->use_ssl));
        $view->assign('qc_error', $session->get('qc_error'));
        $view->assign('session', $session);
        $dispatcher->trigger('onBeforeDisplayCheckoutStep5View', array(&$view));
        $view->display();
    }

    private function ajaxLoadPayments(&$jshopConfig, &$dispatcher, &$adv_user, &$cart, &$post, &$data){
        if (!$jshopConfig->without_payment){
            $dispatcher->trigger('onLoadCheckoutStep3', array());
            $payments = $this->getPayments($adv_user, $jshopConfig, $cart);

            if ($jshopConfig->hide_payment_step){
                if (!$payments['payments'][0]->payment_class){
                    $data['error'][] = _JSHOP_ERROR_PAYMENT;
                }
                $setPayment = $this->_setPayment($post, $cart, $payments['payments'][0]->payment_class, null, $adv_user, 1);
                $data['active_payment_class'] = $payments['payments'][0]->payment_class;
            } else {
                $view_name = "quick_checkout";
                $view_config = array("template_path"=>JPATH_COMPONENT."/templates/addons/".$view_name);
                $view = $this->getView($view_name, getDocumentType(), '', $view_config);
                $view->setLayout('payments');
                $view->assign('payment_methods', $payments['payments']);
                $view->assign('active_payment', $payments['active_payment']);

                $dispatcher->trigger('onBeforeDisplayCheckoutStep3View', array(&$view));
                $data['payments'] = $view->loadTemplate();
                unset($view);

                $setPayment = $this->_setPayment($post, $cart, $this->getPaymentClassForPaymentsArray($payments['payments'], $payments['active_payment']), null, $adv_user, 1);
            }

            if (count($setPayment) > 0 && $setPayment['error'] == 1){
                if (!in_array($setPayment['msg'], $data['error'])){
                    $data['error'][] = $setPayment['msg'];
                }
            }
        }
    }
    
    private function ajaxLoadShippings(&$jshopConfig, &$dispatcher, &$adv_user, &$data, &$cart){
        if (!$jshopConfig->without_shipping) {
            $dispatcher->trigger('onLoadCheckoutStep4', array());
            if ($adv_user->delivery_adress){
                $id_country = $adv_user->d_country;
            }else{
                $id_country = $adv_user->country;
            }
            if (!$id_country) $id_country = $jshopConfig->default_country;

            if (!$id_country){
                if (!in_array(_JSHOP_REGWARN_COUNTRY, $data['error'])){
                    $data['error'][] = _JSHOP_REGWARN_COUNTRY;
                }
            }

            $shippings = $this->getShippings($adv_user, $id_country, $jshopConfig, $cart);

            if ($jshopConfig->hide_shipping_step){
                if (!$shippings['shippings'][0]->sh_pr_method_id && ($jshopConfig->hide_payment_step || $jshopConfig->without_payment)){
                    $data['error'][] = _JSHOP_ERROR_SHIPPING;
                }

                $setShipping = $this->_setShipping($cart, $adv_user, $id_country, $shippings['shippings'][0]->sh_pr_method_id, $jshopConfig, null, 1);
                $data['active_sh_pr_method_id'] = $shippings['shippings'][0]->sh_pr_method_id;
            } else {
                $view_name = "quick_checkout";
                $view_config = array("template_path"=>JPATH_COMPONENT."/templates/addons/".$view_name);
                $view = $this->getView($view_name, getDocumentType(), '', $view_config);
                $view->setLayout('shippings');
                $view->assign('shipping_methods', $shippings['shippings']);
                $view->assign('active_shipping', $shippings['active_shipping']);
                $dispatcher->trigger('onBeforeDisplayCheckoutStep4View', array(&$view));
                $data['shippings'] = $view->loadTemplate();

                $setShipping = $this->_setShipping($cart, $adv_user, $id_country, $shippings['active_shipping'], $jshopConfig, null, 1);
            }
            
            if (count($setShipping) > 0 && $setShipping['error'] == 1){
                if (!in_array($setShipping['msg'], $data['error'])){
                    $data['error'][] = $setShipping['msg'];
                }
            }
        }
    }
    
    public function ajaxRefresh(){
        $jshopConfig = JSFactory::getConfig();
        $post = JRequest::get('post');
        $data = array();
        $adv_user = JSFactory::getUser();
        $cart = JModelLegacy::getInstance('cart', 'jshop');
        $cart->load();
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $data['error'] = array();
        if (isset($post['type']) && $post['type'] == 'address'){
            $dispatcher->trigger('onLoadCheckoutStep2save', array());
            $set_address = $this->_setAddress($cart, $adv_user, 1);
            if (count($set_address) > 0 && $set_address['error'] == 1){
                if (!in_array($set_address['msg'], $data['error'])){
                    $data['error'][] = $set_address['msg'];
                }
            }

            if ($jshopConfig->step_4_3){
                //get shippings
                $this->ajaxLoadShippings($jshopConfig, $dispatcher, $adv_user, $data, $cart);
                //get payments
                $this->ajaxLoadPayments($jshopConfig, $dispatcher, $adv_user, $cart, $post, $data);
            } else {
                //get payments
                $this->ajaxLoadPayments($jshopConfig, $dispatcher, $adv_user, $cart, $post, $data);
                //get shippings
                $this->ajaxLoadShippings($jshopConfig, $dispatcher, $adv_user, $data, $cart);
            }
            
            $delivery = $this->getDeliveryTimeDate($cart, $jshopConfig);
            $data['delivery_time'] = $delivery['delivery_time'];
            $data['delivery_date'] = $delivery['delivery_date'];
        } else if (isset($post['type']) && $post['type'] == 'payment'){
            $params = array();
            if (count($post['params']) > 0){
                foreach ($post['params'] as $param){
                    $index = $this->parseParamsName($param['name']);
                    $params[$index[1]][$index[2]] = $param['value'];
                }
            }

            $set_payment = $this->_setPayment($post, $cart, $post['payment_method'], $params, $adv_user, 1);
            if (count($set_payment) > 0 && $set_payment['error'] == 1){
                if (!in_array($set_payment['msg'], $data['error'])){
                    $data['error'][] = $set_payment['msg'];
                }
            }
            
            //get shippings
            $this->ajaxLoadShippings($jshopConfig, $dispatcher, $adv_user, $data, $cart);
            
            $delivery = $this->getDeliveryTimeDate($cart, $jshopConfig);
            $data['delivery_time'] = $delivery['delivery_time'];
            $data['delivery_date'] = $delivery['delivery_date'];
        } else if (isset($post['type']) && $post['type'] == 'shipping'){
            $params = array();
            if (count($post['params']) > 0){
                foreach ($post['params'] as $param){
                    $index = $this->parseParamsName($param['name']);
                    $params[$index[1]][$index[2]] = $param['value'];
                }
            }
            
            if ($adv_user->delivery_adress){
                $id_country = $adv_user->d_country;
            }else{
                $id_country = $adv_user->country;
            }
            if (!$id_country) $id_country = $jshopConfig->default_country;

            if (!$id_country){
                if (!in_array(_JSHOP_REGWARN_COUNTRY, $data['error'])){
                    $data['error'][] = _JSHOP_REGWARN_COUNTRY;
                }
            }
            
            $setShipping = $this->_setShipping($cart, $adv_user, $id_country, $post['sh_pr_method_id'], $jshopConfig, $params, 1);
            if (count($setShipping) > 0 && $setShipping['error'] == 1){
                if (!in_array($setShipping['msg'], $data['error'])){
                    $data['error'][] = $setShipping['msg'];
                }
            }
            
            //get payments
            $this->ajaxLoadPayments($jshopConfig, $dispatcher, $adv_user, $cart, $post, $data);            
            
            $delivery = $this->getDeliveryTimeDate($cart, $jshopConfig);
            $data['delivery_time'] = $delivery['delivery_time'];
            $data['delivery_date'] = $delivery['delivery_date'];
        }
        $this->getNewCartValues($data);
        
        if (count($data['error']) > 0){
            $data['error'] = implode('<br />', $data['error']);
        } else {
            unset($data['error']);
        }
        echo json_encode($data);
        die;
    }
    
    private function getPayments($adv_user, $jshopConfig, &$cart){
        $paymentmethod = JTable::getInstance('paymentmethod', 'jshop');
        $shipping_id = $cart->getShippingId();
        $all_payment_methods = $paymentmethod->getAllPaymentMethods(1, $shipping_id);
        $i = 0;
        $paym = array();

        foreach($all_payment_methods as $pm){
            $paym[$i] = new stdClass();
            $paymentmethod->load($pm->payment_id); 
            if ($pm->scriptname!=''){
                $scriptname = $pm->scriptname;    
            }else{
                $scriptname = $pm->payment_class;   
            }
            $paymentsysdata = $paymentmethod->getPaymentSystemData($scriptname);
            if ($paymentsysdata->paymentSystem){
                $paym[$i]->existentcheckform = 1;
                $paym[$i]->payment_system = $paymentsysdata->paymentSystem;
            }else{
                $paym[$i]->existentcheckform = 0;
            }

            $paym[$i]->name = $pm->name;
            $paym[$i]->payment_id = $pm->payment_id;
            $paym[$i]->payment_class = $pm->payment_class;
            $paym[$i]->scriptname = $pm->scriptname;
            $paym[$i]->payment_description = $pm->description;
            $paym[$i]->price_type = $pm->price_type;
            $paym[$i]->image = $pm->image;
            $paym[$i]->price_add_text = '';
            if ($pm->price_type==2){
                $paym[$i]->calculeprice = $pm->price;
                if ($paym[$i]->calculeprice!=0){
                    if ($paym[$i]->calculeprice>0){
                        $paym[$i]->price_add_text = '+'.$paym[$i]->calculeprice.'%';
                    }else{
                        $paym[$i]->price_add_text = $paym[$i]->calculeprice.'%';
                    }
                }
            }else{
                $paym[$i]->calculeprice = getPriceCalcParamsTax($pm->price * $jshopConfig->currency_value, $pm->tax_id, $cart->products);
                if ($paym[$i]->calculeprice!=0){
                    if ($paym[$i]->calculeprice>0){
                        $paym[$i]->price_add_text = '+'.formatprice($paym[$i]->calculeprice);
                    }else{
                        $paym[$i]->price_add_text = formatprice($paym[$i]->calculeprice);
                    }
                }
            }

            $s_payment_method_id = $cart->getPaymentId();
            if ($s_payment_method_id == $pm->payment_id){
                $params = $cart->getPaymentParams();
            }else{
                $params = array();
            }

            $parseString = new parseString($pm->payment_params);
            $pmconfig = $parseString->parseStringToParams();

            if ($paym[$i]->existentcheckform){
                $paym[$i]->form = $paymentmethod->loadPaymentForm($paym[$i]->payment_system, $params, $pmconfig);
            }else{
                $paym[$i]->form = "";
            }

            $i++;
        }

        $s_payment_method_id = $cart->getPaymentId();
        $active_payment = intval($s_payment_method_id);
        
        if (!$active_payment){
            $list_payment_id = array();
            foreach($paym as $v){
                $list_payment_id[] = $v->payment_id;
            }
            if (in_array($adv_user->payment_id, $list_payment_id)) $active_payment = $adv_user->payment_id;
        }

        $active_payment_old = $active_payment;
        if ($active_payment_old){
            $active_payment = 0;
            foreach($paym as $v){
                if ($v->payment_id == $active_payment_old){
                    $active_payment = $active_payment_old;
                    break;
                }
            }
        }
        
        if (!$active_payment){
            if (isset($paym[0])){
                $active_payment = $paym[0]->payment_id;
            }
        }
        
        return array('payments' => $paym, 'active_payment' => $active_payment);
    }
    
    private function getDeliveryTimeDate($cart, $jshopConfig){
        $sh_mt_pr = JTable::getInstance('shippingMethodPrice', 'jshop');
        $sh_mt_pr->load($cart->getShippingPrId());
        if ($jshopConfig->show_delivery_time_checkout && $cart->getShippingPrId()){
            $deliverytimes = JSFactory::getAllDeliveryTime();
            $delivery_time = $deliverytimes[$sh_mt_pr->delivery_times_id];
            if (!$delivery_time && $jshopConfig->delivery_order_depends_delivery_product){
                $delivery_time = $cart->getDelivery();
            }
        }else{
            $delivery_time = '';
        }

        if ($jshopConfig->show_delivery_date){
            $delivery_date = $cart->getDeliveryDate();
            if ($delivery_date){
                $delivery_date = formatdate($cart->getDeliveryDate());
            }
        }else{
            $delivery_date = '';
        }
        
        return array('delivery_time' => $delivery_time, 'delivery_date' => $delivery_date);
    }
    
    private function getShippings($adv_user, $id_country, $jshopConfig, &$cart){
        $shippingmethod = JTable::getInstance('shippingMethod', 'jshop');
        $shippingmethodprice = JTable::getInstance('shippingMethodPrice', 'jshop');
            
        if ($jshopConfig->show_delivery_time_checkout){
            $deliverytimes = JSFactory::getAllDeliveryTime();
        }
        if ($jshopConfig->show_delivery_date){
            $deliverytimedays = JSFactory::getAllDeliveryTimeDays();
        }
        
        $sh_pr_method_id = $cart->getShippingPrId();
        $active_shipping = intval($sh_pr_method_id);
        $payment_id = $cart->getPaymentId();
        $shippings = $shippingmethod->getAllShippingMethodsCountry($id_country, $payment_id);
        
        if (!count($shippings)) $shippings = array();
        foreach($shippings as $key => $value){
            $shippingmethodprice->load($value->sh_pr_method_id);
            if ($jshopConfig->show_list_price_shipping_weight){
                $shippings[$key]->shipping_price = $shippingmethodprice->getPricesWeight($value->sh_pr_method_id, $id_country, $cart);
            }
            $prices = $shippingmethodprice->calculateSum($cart);
            $shippings[$key]->calculeprice = $prices['shipping']+$prices['package'];
            $shippings[$key]->delivery = '';
            $shippings[$key]->delivery_date_f = '';
            if ($jshopConfig->show_delivery_time_checkout){
                $shippings[$key]->delivery = $deliverytimes[$value->delivery_times_id];
            }
            if ($jshopConfig->show_delivery_date){
                $day = $deliverytimedays[$value->delivery_times_id];
                if ($day){
                    $shippings[$key]->delivery_date = getCalculateDeliveryDay($day);
                    $shippings[$key]->delivery_date_f = formatdate($shippings[$key]->delivery_date);
                }
            }
            
            if ($value->sh_pr_method_id == $active_shipping){
                $params = $cart->getShippingParams();
            }else{
                $params = array();
            }
            
            $shippings[$key]->form = $shippingmethod->loadShippingForm($value->shipping_id, $value, $params);
        }        
        
        if (!$active_shipping){
            foreach($shippings as $v){
                if ($v->shipping_id == $adv_user->shipping_id){
                    $active_shipping = $v->sh_pr_method_id;
                    break;
                }
            }
        }
        
        $active_shipping_old = $active_shipping;
        if ($active_shipping_old){
            $active_shipping = 0;
            foreach($shippings as $v){
                if ($v->shipping_id == $active_shipping_old){
                    $active_shipping = $active_shipping_old;
                    break;
                }
            }
        }
        
        if (!$active_shipping){
            if (isset($shippings[0])){
                $active_shipping = $shippings[0]->sh_pr_method_id;
            }
        }
            
        return array('shippings' => $shippings, 'active_shipping' => $active_shipping);
    }
    
    private function parseParamsName($name){
        $name = str_replace('params', '', $name);
        $fields = explode('[', $name);
        $fields[1] = str_replace(']', '', $fields[1]);
        $fields[2] = str_replace(']', '', $fields[2]);
        unset($fields[0]);
        
        return $fields;
    }
    
    private function savePayment(&$jshopConfig, &$checkout, &$cart, &$adv_user){
        if ($jshopConfig->without_payment){
            $checkout->setMaxStep(4);
        } else {
            $checkout->checkStep(3);
            $payment_method = JRequest::getVar('payment_method');
            $params = JRequest::getVar('params');
            $post = JRequest::get('post');

            if (!$this->_setPayment($post, $cart, $payment_method, $params, $adv_user)){
                JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=qcheckout',0,1, $jshopConfig->use_ssl));
                return 0;
            }
            
            if ($jshopConfig->step_4_3){
                $checkout->setMaxStep(5);
            }else{
                $checkout->setMaxStep(4);
            }
        }
    }
    
    private function saveShipping(&$jshopConfig, &$checkout, &$adv_user, &$cart){
        if ($jshopConfig->without_shipping){
            $checkout->setMaxStep(5);
        } else {
            $checkout->checkStep(4);
            if ($adv_user->delivery_adress){
                $id_country = $adv_user->d_country;
            }else{
                $id_country = $adv_user->country;
            }
            if (!$id_country) $id_country = $jshopConfig->default_country;

            $sh_pr_method_id = JRequest::getInt('sh_pr_method_id');
            $params = JRequest::getVar('params');
            
            if (!$this->_setShipping($cart, $adv_user, $id_country, $sh_pr_method_id, $jshopConfig, $params)){
                JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=qcheckout',0,1, $jshopConfig->use_ssl));
                return 0;
            }

            if ($jshopConfig->step_4_3 && !$jshopConfig->without_payment){            
                $checkout->setMaxStep(3);
            }else{		
                $checkout->setMaxStep(5);
            }
        }
    }
    
    public function save(){
        $checkout = JModelLegacy::getInstance('checkout', 'jshop');
        $checkout->checkStep(2);
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onLoadCheckoutStep2save', array());
        
        $session = JFactory::getSession();
        $jshopConfig = JSFactory::getConfig();
        
        $cart = JModelLegacy::getInstance('cart', 'jshop');
        $cart->load();

        $adv_user = JSFactory::getUser();
        
        if (!$this->_setAddress($cart, $adv_user)){
            JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=qcheckout',0,1, $jshopConfig->use_ssl));
            return 0;
        }

        if ($jshopConfig->step_4_3){
            $checkout->setMaxStep(4);
            //save shipping
            $this->saveShipping($jshopConfig, $checkout, $adv_user, $cart);
            //save payment
            $this->savePayment($jshopConfig, $checkout, $cart, $adv_user);
        } else {
            $checkout->setMaxStep(3);
            //save payment
            $this->savePayment($jshopConfig, $checkout, $cart, $adv_user);
            //save shipping
            $this->saveShipping($jshopConfig, $checkout, $adv_user, $cart);
        }
         
        //save agb
        $checkout->checkStep(5);
        $checkagb = JRequest::getVar('agb');
        
        $dispatcher->trigger('onLoadStep5save', array(&$checkagb));
        if ($jshopConfig->check_php_agb && $checkagb!='on'){
            $this->setSessionError(_JSHOP_ERROR_AGB);
            JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=qcheckout',0,1,$jshopConfig->use_ssl));
            return 0;
        }

        if (!$cart->checkListProductsQtyInStore()){
            JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=cart&task=view',1,1));
            return 0;
        }
        
        if (!$session->get('checkcoupon')){
            if (!$cart->checkCoupon()){
                $cart->setRabatt(0,0,0);
                JError::raiseWarning("", _JSHOP_RABATT_NON_CORRECT);
                JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=cart&task=view',1,1));
                return 0;
            }
            $session->set('checkcoupon', 1);
        }
        
        $orderNumber = $jshopConfig->getNextOrderNumber();
        $jshopConfig->updateNextOrderNumber();

        $payment_method_id = $cart->getPaymentId();
        $pm_method = JTable::getInstance('paymentMethod', 'jshop');
        $pm_method->load($payment_method_id);
        $payment_method = $pm_method->payment_class;

        if ($jshopConfig->without_payment){
            $pm_method->payment_type = 1;
            $paymentSystemVerySimple = 1; 
        }else{
            $paymentsysdata = $pm_method->getPaymentSystemData();
            $payment_system = $paymentsysdata->paymentSystem;
            if ($paymentsysdata->paymentSystemVerySimple){
                $paymentSystemVerySimple = 1;
            }
            if ($paymentsysdata->paymentSystemError || $pm_method->payment_publish==0){
                $cart->setPaymentParams("");
                $this->setSessionError(_JSHOP_ERROR_PAYMENT);
                JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=qcheckout',0,1,$jshopConfig->use_ssl));
                return 0;
            }
        }

        $order = JTable::getInstance('order', 'jshop');
        $arr_property = $order->getListFieldCopyUserToOrder();
        foreach($adv_user as $key=>$value){
            if (in_array($key, $arr_property)){
                $order->$key = $value;
            }
        }

        $sh_mt_pr = JTable::getInstance('shippingMethodPrice', 'jshop');
        $sh_mt_pr->load($cart->getShippingPrId());

        $order->order_date = $order->order_m_date = date("Y-m-d H:i:s", time());
        $order->order_tax = $cart->getTax(1, 1, 1);
        $order->setTaxExt($cart->getTaxExt(1, 1, 1));
        $order->order_subtotal = $cart->getPriceProducts();
        $order->order_shipping = $cart->getShippingPrice();
        $order->order_payment = $cart->getPaymentPrice();
        $order->order_discount = $cart->getDiscountShow();
        $order->shipping_tax = $cart->getShippingPriceTaxPercent();
        $order->setShippingTaxExt($cart->getShippingTaxList());
        $order->payment_tax = $cart->getPaymentTaxPercent();
        $order->setPaymentTaxExt($cart->getPaymentTaxList());
        $order->order_package = $cart->getPackagePrice();
        $order->setPackageTaxExt($cart->getPackageTaxList());
        $order->order_total = $cart->getSum(1, 1, 1);
        $order->currency_exchange = $jshopConfig->currency_value;
        $order->vendor_type = $cart->getVendorType();
        $order->vendor_id = $cart->getVendorId();
        $order->order_status = $jshopConfig->default_status_order;
        $order->shipping_method_id = $cart->getShippingId();
        $order->payment_method_id = $cart->getPaymentId();
        $order->delivery_times_id = $sh_mt_pr->delivery_times_id;
        if ($jshopConfig->delivery_order_depends_delivery_product){
            $order->delivery_time = $cart->getDelivery();
        }
        if ($jshopConfig->show_delivery_date){
            $order->delivery_date = $cart->getDeliveryDate();
        }
        $order->coupon_id = $cart->getCouponId();

        $pm_params = $cart->getPaymentParams();

        if (is_array($pm_params) && !$paymentSystemVerySimple){
            $payment_system->setParams($pm_params);
            $payment_params_names = $payment_system->getDisplayNameParams();
            $order->payment_params = getTextNameArrayValue($payment_params_names, $pm_params);
            $order->setPaymentParamsData($pm_params);
        }
        
        $sh_params = $cart->getShippingParams();
        if (is_array($sh_params)){
            $sh_method = JSFactory::getTable('shippingMethod', 'jshop');
            $sh_method->load($cart->getShippingId());
            $shippingForm = $sh_method->getShippingForm();
            if ($shippingForm){
                $shipping_params_names = $shippingForm->getDisplayNameParams();            
                $order->shipping_params = getTextNameArrayValue($shipping_params_names, $sh_params);
            }
            $order->setShippingParamsData($sh_params);
        }        
        
        $order->ip_address = $_SERVER['REMOTE_ADDR'];
        $order->order_add_info = JRequest::getVar('order_add_info','');
        $order->currency_code = $jshopConfig->currency_code;
        $order->currency_code_iso = $jshopConfig->currency_code_iso;
        $order->order_number = $order->formatOrderNumber($orderNumber);
        $order->order_hash = md5(time().$order->order_total.$order->user_id);
        $order->file_hash = md5(time().$order->order_total.$order->user_id."hashfile");
        $order->display_price = $jshopConfig->display_price_front_current;
        $order->lang = $jshopConfig->getLang();
        
        if ($order->client_type){
            $order->client_type_name = $jshopConfig->user_field_client_type[$order->client_type];
        }else{
            $order->client_type_name = "";
        }
        
        if ($order->order_total==0){
            $pm_method->payment_type = 1;
            $jshopConfig->without_payment = 1;
            $order->order_status = $jshopConfig->payment_status_paid;
        }
        
        if ($pm_method->payment_type == 1){
            $order->order_created = 1; 
        }else {
            $order->order_created = 0;
        }
        
        if (!$adv_user->delivery_adress) $order->copyDeliveryData();
        
        $dispatcher->trigger('onBeforeCreateOrder', array(&$order, &$cart));

        $order->store();

        $dispatcher->trigger('onAfterCreateOrder', array(&$order));

        if ($cart->getCouponId()){
            $coupon = JTable::getInstance('coupon', 'jshop');
            $coupon->load($cart->getCouponId());
            if ($coupon->finished_after_used){
                $free_discount = $cart->getFreeDiscount();
                if ($free_discount > 0){
                    $coupon->coupon_value = $free_discount / $jshopConfig->currency_value;
                }else{
                    $coupon->used = $adv_user->user_id;
                }
                $coupon->store();
            }
        }

        $order->saveOrderItem($cart->products);

        $dispatcher->trigger('onAfterCreateOrderFull', array(&$order));
        
        $session->set("jshop_end_order_id", $order->order_id);

        $order_history = JTable::getInstance('orderHistory', 'jshop');
        $order_history->order_id = $order->order_id;
        $order_history->order_status_id = $order->order_status;
        $order_history->status_date_added = $order->order_date;
        $order_history->customer_notify = 1;
        $order_history->store();
        
        if ($pm_method->payment_type == 1){
            if ($jshopConfig->order_stock_removed_only_paid_status){
                $product_stock_removed = (in_array($order->order_status, $jshopConfig->payment_status_enable_download_sale_file));
            }else{
                $product_stock_removed = 1;
            }
            if ($product_stock_removed){
                $order->changeProductQTYinStock("-");
            }
            if ($jshopConfig->send_order_email){
                $checkout->sendOrderEmail($order->order_id);
            }
        }
        
        $dispatcher->trigger('onEndCheckoutStep5', array(&$order));

        $session->set("jshop_send_end_form", 0);
        
        if ($jshopConfig->without_payment){
            $checkout->setMaxStep(10);
            JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=checkout&task=finish',1,1,$jshopConfig->use_ssl));
            return 0;
        }
        
        $pmconfigs = $pm_method->getConfigs();
        
        $task = "step6";
        
        if (isset($pmconfigs['windowtype']) && $pmconfigs['windowtype']==2){
            $task = "step6iframe";
            $session->set("jsps_iframe_width", $pmconfigs['iframe_width']);
            $session->set("jsps_iframe_height", $pmconfigs['iframe_height']);
        }
        $checkout->setMaxStep(6);
        JFactory::getApplication()->redirect(SEFLink('index.php?option=com_jshopping&controller=checkout&task='.$task,1,1,$jshopConfig->use_ssl));
    }

    private function setSessionError($error){
        $session = JFactory::getSession();
        $sess = $session->get('qc_error');

        if (strpos($sess, $error) === FALSE){
            if (!empty($sess)){
                $sess .= '<br />';
            } else {
                $sess = '';
            }
        
            $session->set('qc_error', $sess.$error);
        }
    }
    
    private function getPaymentClassForPaymentsArray($payments, $payment_id){
        $payment_method = '';
        foreach ($payments as $payment){
            if ($payment->payment_id == $payment_id){
                $payment_method = $payment->payment_class;
                break;
            }
        }
        return $payment_method;
    }
    
    private function _setAddress(&$cart, $adv_user, $ajax = 0){
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $jshopConfig = JSFactory::getConfig();
        
        $post = JRequest::get('post');
        if (!count($post)){
            $ajax_return = array('error' => 1, 'msg' => _JSHOP_ERROR_DATA);
        } else {
            if ($post['birthday']) $post['birthday'] = getJsDateDB($post['birthday'], $jshopConfig->field_birthday_format);
            if ($post['d_birthday']) $post['d_birthday'] = getJsDateDB($post['d_birthday'], $jshopConfig->field_birthday_format);
            $address_fields = array('apartment', 'city', 'client_type', 'country', 'd_apartment', 'd_city', 'd_country', 'd_email', 'd_ext_field_1', 'd_ext_field_2', 'd_ext_field_3', 'd_f_name', 'd_fax', 'd_firma_name', 'd_home', 'd_l_name', 'd_mobil_phone', 'd_phone', 'd_state', 'd_street', 'd_title', 'd_zip', 'delivery_adress', 'email', 'ext_field_1', 'ext_field_2', 'ext_field_3', 'f_name', 'fax', 'firma_code', 'firma_name', 'home', 'l_name', 'mobil_phone', 'phone', 'privacy_statement', 'state', 'street', 'tax_number', 'title', 'type', 'zip', 'm_name', 'd_m_name', 'email2', 'street_nr', 'd_street_nr', 'birthday', 'd_birthday');
            foreach ($post as $key => $value){
                if (!in_array($key, $address_fields)){
                    unset($post[$key]);
                }
            }
        }

        unset($post['user_id']);
        unset($post['usergroup_id']);
        $post['lang'] = $jshopConfig->getLang();
        
        $user = JFactory::getUser();
        
        $adv_user->bind($post);
        if(!$adv_user->check("address")){
            $ajax_return = array('error' => 1, 'msg' => $adv_user->getError());
        }
        
        $dispatcher->trigger( 'onBeforeSaveCheckoutStep2', array(&$adv_user, &$user, &$cart) );
        
        if(!$adv_user->store()){
            $ajax_return = array('error' => 1, 'msg' => _JSHOP_REGWARN_ERROR_DATABASE);
        }

        if ($user->id && !$jshopConfig->not_update_user_joomla){
            $user = clone(JFactory::getUser());
            if ($adv_user->email){
                $user->email = $adv_user->email;
            }
            if ($adv_user->f_name || $adv_user->l_name){
                $user->name = $adv_user->f_name." ".$adv_user->l_name;
            }
            if ($adv_user->f_name || $adv_user->l_name || $adv_user->email){
                $user->save();
            }
        }
        
        if ($user->id){
            $adv_user0 = JSFactory::getUserShop();
            foreach($adv_user0 as $k=>$v){
                $adv_user0->$k = $adv_user->$k;
            }
        }
		
        setNextUpdatePrices();
        
        $dispatcher->trigger( 'onAfterSaveCheckoutStep2', array(&$adv_user, &$user, &$cart) );
        
        if ($ajax){
            return $ajax_return;
        } else {
            if (isset($ajax_return['error']) && $ajax_return['error'] == 1){
                $this->setSessionError($ajax_return['msg']);
                return 0;
            } else {
                return 1;
            }
        }
    }
    
    private function _setPayment(&$post, &$cart, $payment_method, $params, $adv_user, $ajax = 0){
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onBeforeSaveCheckoutStep3save', array(&$post) );

        $params_pm = $params[$payment_method];
        $paym_method = JTable::getInstance('paymentmethod', 'jshop');
        $paym_method->class = $payment_method;
        $payment_method_id = $paym_method->getId();
        $paym_method->load($payment_method_id);
        $pmconfigs = $paym_method->getConfigs();
        $paymentsysdata = $paym_method->getPaymentSystemData();
        $payment_system = $paymentsysdata->paymentSystem;
        $ajax_return = 1;
        if ($paymentsysdata->paymentSystemError || !$payment_method_id){
            $cart->setPaymentParams('');
            $ajax_return =  array('error' => 1, 'msg' => _JSHOP_ERROR_PAYMENT);
        }
        if ($payment_system){
            if (!$payment_system->checkPaymentInfo($params_pm, $pmconfigs)){
                $cart->setPaymentParams('');
                $ajax_return = array('error' => 1, 'msg' => $payment_system->getErrorMessage());
            }
        }

        $paym_method->setCart($cart);
        $cart->setPaymentId($payment_method_id);
        $price = $paym_method->getPrice();        
        $cart->setPaymentDatas($price, $paym_method);

        if (isset($params[$payment_method])){
            $cart->setPaymentParams($params_pm);
        } else {
            $cart->setPaymentParams('');
        }
        
        $adv_user->saveTypePayment($payment_method_id);
        
        $dispatcher->trigger('onAfterSaveCheckoutStep3save', array(&$adv_user, &$paym_method, &$cart));
         
        if ($ajax){
            return $ajax_return;
        } else {
            if (isset($ajax_return['error']) && $ajax_return['error'] == 1){
                $this->setSessionError($ajax_return['msg']);
                return 0;
            } else {
                return 1;
            }
        }
    }
    
    private function isCorectMethodForPayment($cart, $shipping_id){
        $shipping_method = JTable::getInstance('shippingmethod', 'jshop');
        $shipping_method->load($shipping_id);
        
        if ($shipping_method->payments==""){
            return 1;
        }
        $shipping_payments = $shipping_method->getPayments();        
        if (!in_array($cart->getPaymentId(), $shipping_payments)){
            return 0;
        }
        return 1;
    }
    
    private function _setShipping(&$cart, $adv_user, $id_country, $sh_pr_method_id, $jshopConfig, $params, $ajax = 0){
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger( 'onBeforeSaveCheckoutStep4save', array());
        
        $shipping_method_price = JTable::getInstance('shippingMethodPrice', 'jshop');
        $shipping_method_price->load($sh_pr_method_id);
        
        $sh_method = JTable::getInstance('shippingMethod', 'jshop');
        $sh_method->load($shipping_method_price->shipping_method_id);
        $params_sm = $params[$sh_method->shipping_id];

        $ajax_return = 1;
        if (!$shipping_method_price->sh_pr_method_id || !$shipping_method_price->isCorrectMethodForCountry($id_country) || !$sh_method->shipping_id || !$this->isCorectMethodForPayment($cart, $sh_method->shipping_id)){
            $ajax_return = array('error' => 1, 'msg' => _JSHOP_ERROR_SHIPPING);
        }

        if (isset($params[$sh_method->shipping_id])){
            $cart->setShippingParams($params_sm);
        } else {
            if (!$cart->getShippingId() || $cart->getShippingId() == $sh_method->shipping_id){
                $params_sm = $cart->getShippingParams();
            } else {
                $cart->setShippingParams('');
            }
        }
        
        $shippingForm = $sh_method->getShippingForm();
        
        if ($shippingForm && !$shippingForm->check($params_sm, $sh_method)){
            $ajax_return = array('error' => 1, 'msg' => $shippingForm->getErrorMessage());
        }
        
        $prices = $shipping_method_price->calculateSum($cart);
        $cart->setShippingId($sh_method->shipping_id);
        $cart->setShippingPrId($sh_pr_method_id);
        $cart->setShippingsDatas($prices, $shipping_method_price);
        
        if ($jshopConfig->show_delivery_date){
            $delivery_date = '';
            $deliverytimedays = JSFactory::getAllDeliveryTimeDays();
            $day = $deliverytimedays[$shipping_method_price->delivery_times_id];
            if ($day){
                $delivery_date = getCalculateDeliveryDay($day);
            }else{
                if ($jshopConfig->delivery_order_depends_delivery_product){
                    $day = $cart->getDeliveryDaysProducts();
                    if ($day){
                        $delivery_date = getCalculateDeliveryDay($day);                    
                    }
                }
            }

            $cart->setDeliveryDate($delivery_date);
        }

        //update payment price
        $payment_method_id = $cart->getPaymentId();
        if ($payment_method_id){
            $paym_method = JTable::getInstance('paymentmethod', 'jshop');
            $paym_method->load($payment_method_id);
            $cart->setDisplayItem(1, 1);
            $paym_method->setCart($cart);
            $price = $paym_method->getPrice();
            $cart->setPaymentDatas($price, $paym_method);            
        }

        $adv_user->saveTypeShipping($sh_method->shipping_id);
        
        $dispatcher->trigger('onAfterSaveCheckoutStep4', array(&$adv_user, &$sh_method, &$shipping_method_price, &$cart) );
        
        if ($ajax){
            return $ajax_return;
        } else {
            if (isset($ajax_return['error']) && $ajax_return['error'] == 1){
                $this->setSessionError($ajax_return['msg']);
                return 0;
            } else {
                return 1;
            }
        }
    }
    
    private function _showSmallCart(){
        $jshopConfig = JSFactory::getConfig();
        
        $cart = JModelLegacy::getInstance('cart', 'jshop');
        $cart->load();
        $cart->addLinkToProducts(0);
        $cart->setDisplayFreeAttributes();
        
        $cart->setDisplayItem(1, 1);
        $cart->updateDiscountData();
        
        $weight_product = $cart->getWeightProducts();
        if ($weight_product == 0 && $jshopConfig->hide_weight_in_cart_weight0){
            $jshopConfig->show_weight_order = 0;
        }
        
        JPluginHelper::importPlugin('jshoppingcheckout');
        $dispatcher = JDispatcher::getInstance();
        $dispatcher->trigger('onBeforeDisplaySmallCart', array(&$cart) );
                
        $view_name = "quick_checkout_cart";
        $view_config = array("template_path"=>JPATH_COMPONENT."/templates/addons/".$view_name);
        $view = $this->getView($view_name, getDocumentType(), '', $view_config);

        $view->assign('config', $jshopConfig);
        $view->assign('products', $cart->products);
        $view->assign('summ', $cart->getPriceProducts());
        $view->assign('image_product_path', $jshopConfig->image_product_live_path);
        $view->assign('no_image', $jshopConfig->noimage);
        $view->assign('discount', $cart->getDiscountShow());
        $view->assign('free_discount', $cart->getFreeDiscount());
        $deliverytimes = JSFactory::getAllDeliveryTime();
        $view->assign('deliverytimes', $deliverytimes);
        
        if (!$jshopConfig->without_shipping){
            //$sh_pr_method_id = $cart->getShippingPrId();
            //if ($sh_pr_method_id){
            //    $shipping_method_price = JTable::getInstance('shippingMethodPrice', 'jshop');
            //    $shipping_method_price->load($sh_pr_method_id);

            //    $prices = $shipping_method_price->calculateSum($cart);
            //    $cart->setShippingsDatas($prices, $shipping_method_price);
            //}
            
            $view->assign('summ_delivery', $cart->getShippingPrice());
            if ($cart->getPackagePrice()>0 || $jshopConfig->display_null_package_price){
                $view->assign('summ_package', $cart->getPackagePrice());
            }
            $view->assign('summ_payment', $cart->getPaymentPrice());
            $fullsumm = $cart->getSum(1,1,1);
            $tax_list = $cart->getTaxExt(1,1,1);
        }else{
            $view->assign('summ_payment', $cart->getPaymentPrice());
            $fullsumm = $cart->getSum(0,1,1);
            $tax_list = $cart->getTaxExt(0,1,1);
        }

        $lang = JSFactory::getLang();
        $name = $lang->get("name");
        $pm_method = JTable::getInstance('paymentMethod', 'jshop');
        $payment_method_id = $cart->getPaymentId();
        $pm_method->load($payment_method_id);
        $view->assign('payment_name', $pm_method->$name);
        
        $show_percent_tax = 0;
        if (count($tax_list)>1 || $jshopConfig->show_tax_in_product) $show_percent_tax = 1;
        if ($jshopConfig->hide_tax) $show_percent_tax = 0;
        $hide_subtotal = 0;
        
        if (($jshopConfig->hide_tax || count($tax_list)==0) && !$cart->rabatt_summ && $jshopConfig->without_shipping && $cart->getPaymentPrice()==0) $hide_subtotal = 1;
        
        $text_total = _JSHOP_ENDTOTAL;
        if (($jshopConfig->show_tax_in_product || $jshopConfig->show_tax_product_in_cart) && (count($tax_list)>0)){
            $text_total = _JSHOP_ENDTOTAL_INKL_TAX;
        }

        $view->assign('tax_list', $tax_list);
        $view->assign('fullsumm', $fullsumm);
        $view->assign('show_percent_tax', $show_percent_tax);
        $view->assign('hide_subtotal', $hide_subtotal);
        $view->assign('text_total', $text_total);
        $view->assign('weight', $weight_product);
        $dispatcher->trigger('onBeforeDisplayCheckoutCartView', array(&$view));
        
        return $view->loadTemplate();
    }
    
    private function getNewCartValues(&$cart_data){
        $jshopConfig = JSFactory::getConfig();
        
        $cart = JModelLegacy::getInstance('cart', 'jshop');
        $cart->load();
        
        $cart->updateDiscountData();

        $cart_data['discount'] = array('price' => $cart->getDiscountShow(), 'formatprice' => formatprice($cart->getDiscountShow()));
        $cart_data['free_discount'] = array('price' => $cart->getFreeDiscount(), 'formatprice' => formatprice($cart->getFreeDiscount()));

        
        if (!$jshopConfig->without_shipping){
            $cart_data['summ_delivery'] = formatprice($cart->getShippingPrice());
            if ($cart->getPackagePrice()>0 || $jshopConfig->display_null_package_price){
                $cart_data['summ_package'] = formatprice($cart->getPackagePrice());
            }
            $cart_data['summ_payment'] = array('price' => $cart->getPaymentPrice(), 'formatprice' => formatprice($cart->getPaymentPrice()));
            $fullsumm = $cart->getSum(1,1,1);
            $tax_list = $cart->getTaxExt(1,1,1);
        }else{
            $cart_data['summ_payment'] = array('price' => $cart->getPaymentPrice(), 'formatprice' => formatprice($cart->getPaymentPrice()));
            $fullsumm = $cart->getSum(0,1,1);
            $tax_list = $cart->getTaxExt(0,1,1);
        }

        $lang = JSFactory::getLang();
        $name = $lang->get("name");
        $pm_method = JTable::getInstance('paymentMethod', 'jshop');
        $payment_method_id = $cart->getPaymentId();
        $pm_method->load($payment_method_id);
        $cart_data['payment_name'] = $pm_method->$name;
        
        $show_percent_tax = 0;
        if (count($tax_list)>1 || $jshopConfig->show_tax_in_product) $show_percent_tax = 1;
        if ($jshopConfig->hide_tax) $show_percent_tax = 0;
        $hide_subtotal = 0;
        
        if (($jshopConfig->hide_tax || count($tax_list)==0) && !$cart->rabatt_summ && $jshopConfig->without_shipping && $cart->getPaymentPrice()==0) $hide_subtotal = 1;
        
        if (count($tax_list) > 0){
            $new_tax_list = array();
            foreach ($tax_list as $percent => $tax){
                $new_tax_list[formattax($percent)] = formatprice($tax);
            }
        }
        $cart_data['tax_list'] = $new_tax_list;
        $cart_data['fullsumm'] = formatprice($fullsumm);
        
        $sh_method = JTable::getInstance('shippingMethod', 'jshop');
        $sh_method->load($cart->getShippingPrId());
        $cart_data['shipping_name'] = $sh_method->$name;
    }
}