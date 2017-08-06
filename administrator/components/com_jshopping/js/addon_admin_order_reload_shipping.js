// reload schipping
jQuery(document).ready(function() {
	jQuery('#shipping_method_id').prepend( jQuery('<option value="0">---</option>'));
	
	jQuery('#shipping_method_id').change(function(){
		data_order = {};
		data_order['country']=jQuery('select[name="country"]').val();
		data_order['d_country']=jQuery('select[name="d_country"]').val();
		data_order['currency_id']=jQuery('select[name="currency_id"]').val();
		data_order['display_price']=jQuery('select[name="display_price"]').val();
		data_order['client_type']=jQuery('select[name="client_type"]').val();
		data_order['tax_number']=jQuery('input[name="tax_number"]').val();
		data_order['payment_method_id']=jQuery('select[name="payment_method_id"]').val();
		data_order['shipping_method_id']=jQuery(this).val();
		if(!data_order['shipping_method_id'])return;
		jQuery.ajax({
			type: "POST",
			url: live_patch+"/index.php?option=com_jshopping&controller=addon_admin_order_reload_shipping&task=view",
			data: data_order,dataType : "json"
		}).done(function( _array ) {
			if(typeof(_array) == 'object'){
				jQuery('input[name="order_shipping"]').val(_array.shipping);
				jQuery('input[name="order_package"]').val(_array.package);	
				updateOrderTotalValue();
			}
		});
	});
})