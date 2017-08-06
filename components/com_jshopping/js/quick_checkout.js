var qc_isset_ajax_request = null;
var qc_ajaxRequest = null;

jQuery(document).ready(function(){
    bind_change_payment();
    bind_change_address();
    bind_change_shipping();
});

bind_change_payment = function(){
    jQuery('form[name="quickCheckout"] input[name="payment_method"]').unbind('change');
	jQuery('form[name="quickCheckout"] input[name="payment_method"]').on("change", function(){
        data = new Object();
        data.type = 'payment';
        data.payment_method = jQuery(this).val();
        data.params = new Array();
        jQuery('form[name="quickCheckout"] [name^="params"]').each(function(){
            param = new Object();
            param.name = jQuery(this).attr('name');
            param.value = jQuery(this).val();
            data.params.push(param);
        });
        
        qc_ajax_request(qc_ajax_link, 'json', data, qc_afterRefresh);
    });
}

bind_change_shipping = function(){
    jQuery('form[name="quickCheckout"] input[name="sh_pr_method_id"]').unbind('change');
	jQuery('form[name="quickCheckout"] input[name="sh_pr_method_id"]').on("change", function(){
        data = new Object();
        data.type = 'shipping';
        data.sh_pr_method_id = jQuery(this).val();
        data.params = new Array();
        jQuery('form[name="quickCheckout"] [name^="params"]').each(function(){
            param = new Object();
            param.name = jQuery(this).attr('name');
            param.value = jQuery(this).val();
            data.params.push(param);
        });
        
        qc_ajax_request(qc_ajax_link, 'json', data, qc_afterRefresh);
    });
}

bind_change_address = function(){
    jQuery('div#qc_address input, div#qc_address select').unbind('change');
	jQuery('div#qc_address').on("change", "input, select", function(){
        data = new Object();
        data.type = 'address';
        jQuery('div#qc_address input[type="text"], div#qc_address input[type="radio"]:checked, div#qc_address input[type="checkbox"], div#qc_address select').each(function(){
            data[this.name] = jQuery(this).val();
        });
        
        qc_ajax_request(qc_ajax_link, 'json', data, qc_afterRefresh);
    });
}

qc_afterRefresh = function(data){
    qc_isset_ajax_request = null;
    if (data.payments){
        jQuery('div#qc_payments_methods').html(data.payments);
        bind_change_payment();
    }
    if (data.shippings){
        jQuery('div#qc_shippings_methods').html(data.shippings);
        bind_change_shipping();
    }
    
    if (data.active_payment_class){
        jQuery('#qc_payment_method_class').val(data.active_payment_class);
    } else {
        jQuery('#qc_payment_method_class').val('');
    }
    
    if (data.active_sh_pr_method_id){
        jQuery('#qc_sh_pr_method_id').val(data.active_sh_pr_method_id);
    } else {
        jQuery('#qc_sh_pr_method_id').val('');
    }
    
    jQuery('#qc_error').hide();
    qc_update_cart_data(data);
    if (data.error){
        jQuery('#qc_error').html(data.error).show();
    }
}

qc_update_cart_data = function(data){
    if (data.discount.price != 0){
        jQuery('#qc_discount_row').show();
        jQuery('#qc_discount').text('-' + data.discount.formatprice);
    } else {
        jQuery('#qc_discount_row').hide();
    }
    
    if (data.summ_payment.price != 0){
        jQuery('#qc_summ_payment_row').show();
        jQuery('#qc_payment_price').text(data.summ_payment.formatprice);
        jQuery('#qc_payment_name').text(data.payment_name);
    } else {
        jQuery('#qc_summ_payment_row').hide();
    }
    
    if (data.free_discount.price != 0){
        jQuery('#qc_free_discount_row').show();
        jQuery('#qc_free_discount').text(data.free_discount.formatprice);
    } else {
        jQuery('#qc_free_discount_row').hide();
    }
    
    if (data.summ_delivery !== undefined){
        jQuery('#qc_shipping_price_row').show();
        jQuery('#qc_shipping_price').text(data.summ_delivery);
    } else {
        jQuery('#qc_shipping_price_row').hide();
    }
    
    if (data.summ_package !== undefined){
        jQuery('#qc_shipping_package_price_row').show();
        jQuery('#qc_shipping_package_price').text(data.summ_package);
    } else {
        jQuery('#qc_shipping_package_price_row').hide();
    }
    
    jQuery('#qc_total').text(data.fullsumm);
    
    if (data.tax_list !== undefined){
        for(var percent in data.tax_list){
            var value = data.tax_list[percent];
            jQuery('#qc_tax_' + percent).text(value);
        }
    }
    
    if (data.delivery_time){
        jQuery('#qc_delivery_time_block').show();
        jQuery('#qc_delivery_time').text(data.delivery_time);
    } else {
        jQuery('#qc_delivery_time_block').hide();
    }
    
    if (data.delivery_date){
        jQuery('#qc_delivery_date_block').show();
        jQuery('#qc_delivery_date').text(data.delivery_date);
    } else {
        jQuery('#qc_delivery_date_block').hide();
    }
    
    if (data.shipping_name){
        jQuery('#qc_active_shipping_block').show();
        jQuery('#qc_active_shipping_name').text(data.shipping_name);
    } else {
        jQuery('#qc_active_shipping_block').hide();
    }
    
    if (data.payment_name){
        jQuery('#qc_active_payment_block').show();
        jQuery('#qc_active_payment_name').text(data.payment_name);
    } else {
        jQuery('#qc_active_payment_block').hide();
    }
}

qc_ajax_request = function(url, dataType, data, callback){
    if (qc_isset_ajax_request){
        qc_ajaxRequest.abort();
    }
    
    qc_ajaxRequest = jQuery.ajax({
        url: url, 
        type: "post",
        dataType: dataType, 
        data : data, 
        cache: false,
        beforeSend: function() {},
        success: callback
    });
    
    qc_isset_ajax_request = 1;
}