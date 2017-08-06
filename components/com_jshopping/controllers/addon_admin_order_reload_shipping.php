<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerAddon_admin_order_reload_shipping extends JControllerLegacy{
    
	function view(){
		$country = JRequest::getInt('country', 0);
		$d_country = JRequest::getInt('d_country', 0);
		$currency_id = JRequest::getInt('currency_id', 0);
		$display_price = JRequest::getInt('display_price', 0);
		$payment_method_id = JRequest::getInt('payment_method_id', 0);
		$shipping_method_id = JRequest::getInt('shipping_method_id', 0);
		$tax_number = JRequest::getInt('tax_number', 0);
		$client_type = JRequest::getInt('client_type', 0);
		
		$id_country = ($d_country)?$d_country:$country;
		
		$jshopConfig = JSFactory::getConfig();
		$shippingmethod = JTable::getInstance('shippingMethod', 'jshop');
		$shippings = $shippingmethod->getAllShippingMethodsCountry($id_country, $payment_method_id);
		$prices = array();
		
		foreach($shippings as $data){
			if($data->shipping_id == $shipping_method_id){
				$prices['shipping'] = $data->shipping_stand_price;
				$prices['shipping_tax_id'] = $data->shipping_tax_id;
				$prices['package'] = $data->package_stand_price;
				$prices['package_tax_id'] = $data->package_tax_id;
			}
		}
		
		$this->user = new stdClass();
		$this->user->country = $country;
		$this->user->d_country = $d_country;
		$this->user->client_type = $client_type;
		$this->user->tax_number = $tax_number;
			
		$allTaxes = $this->_getAllTaxes();
		
		$prices['shipping'] = getPriceFromCurrency($prices['shipping'], $currency_id);
		$prices['package'] = getPriceFromCurrency($prices['package'], $currency_id);

		$prices['shipping'] = $this->getPriceCalcParamsTax($prices['shipping'], $prices['shipping_tax_id'],$display_price);
		$prices['package_tax_id'] = $this->getPriceCalcParamsTax($prices['package'], $prices['package'],$display_price);
		
		print json_encode($prices);
		die;
	}
	
	function _getAllTaxes(){
		$country = $this->user->country;
		$d_country = $this->user->d_country;
		$client_type = $this->user->client_type;
		$tax_number = $this->user->tax_number!="";
        $jshopConfig = JSFactory::getConfig();
        $_tax = JTable::getInstance('tax', 'jshop');            
        $rows = JSFactory::getAllTaxesOriginal();
        if ($jshopConfig->use_extend_tax_rule){
            $country_id = 0;
            $country_id = $country;
            if ($jshopConfig->tax_on_delivery_address && $d_country){
                $country_id = $d_country;
            }
            $client_type = $client_type;
            $enter_tax_id = $tax_number!="";
            if (!$country_id){
                $country_id = $country;
                if ($jshopConfig->tax_on_delivery_address && $d_country){
                    $country_id = $d_country;
                }
                $client_type = $client_type;
                $enter_tax_id = $tax_number!="";
            }
            if ($country_id){
                $_rowsext = $_tax->getExtTaxes();
                foreach($_rowsext as $v){
                    if (in_array($country_id, $v->countries)){
                        if ($jshopConfig->ext_tax_rule_for==1){
                            if ($enter_tax_id){
                                $rows[$v->tax_id] = $v->firma_tax;
                            }else{
                                $rows[$v->tax_id] = $v->tax;
                            }    
                        }else{
                            if ($client_type==2){
                                $rows[$v->tax_id] = $v->firma_tax;
                            }else{
                                $rows[$v->tax_id] = $v->tax;
                            }
                        }
                    }
                }
                unset($_rowsext);
            }
        }
		return $rows;
    }
	
	function getPriceCalcParamsTax($price, $tax_id,$display_price_front_current = 0){
		$jshopConfig = JSFactory::getConfig();
    
		$taxes = $this->_getAllTaxes();
		if ($tax_id){
			$tax = $taxes[$tax_id];
		}else{
			$taxlist = array_values($taxes);
			$tax = $taxlist[0];
		}    
    
		if ($jshopConfig->display_price_admin == 1 && $display_price_front_current == 0){
			$price = $price * (1 + $tax / 100);
		}
		if ($jshopConfig->display_price_admin == 0 && $display_price_front_current == 1){
			$price = $price / (1 + $tax / 100);
		}   
	return $price;
	}
}
?>