<div class="top_rating_products jshop">
<?php 
	$i = 0;
	$row_product = 4;	
?>
<?php 
if (count($rows) > 0)
 foreach($rows as $product){
	$jshop_product = JTable::getInstance('product', 'jshop');
	$jshop_product->product_id = $product->product_id;
	$images = $jshop_product->getImages();
	
?>
<?php if($i%$row_product == 0) print '<div class="row-fluid">';?>
	 <div class="block_item span<?php echo 12/$row_product; ?>">
		<div class="item_inner">
			<?php /*------------ Image Block ---------------*/?>
			<?php if ($show_image && $product->image){// option modul  show_image ?>
				<div class="image">
					<div class="image_block">
						<?php print $product->_tmp_var_image_block;?>
						<?php if($product->label_id && $show_image_label){?>		
							<div class="product_label">
							<?php if($product->_label_image){?>
								<img src="<?php print $product->_label_image?>" alt="<?php print htmlspecialchars($product->_label_name)?>" />
							<?php }else{?>
								<span class="label_name"><?php print $product->_label_name;?></span>
							<?php }?>						 
							</div>
						<?php } ?>
						<a class="images" href="<?php print $product->product_link?>">
							<?php if(isset($images[1])) {
								$image_second = $jshopConfig->image_product_live_path.'/'.$images[1]->image_thumb; ?>
								<img class="jshop_img first-image" src="<?php print $product->image ? $product->image : $noimage;?>" alt="<?php print htmlspecialchars($product->name);?>" />
								<img class="jshop_img second-image" src = "<?php print $image_second ?>" alt="" />
							<?php } else{ ?>
								<img class="jshop_img single-image" src="<?php print $product->image ? $product->image : $noimage;?>" alt="<?php print htmlspecialchars($product->name);?>" />
							<?php } ?>
							
						</a>
					</div>
				</div>
			<?php } ?>
			<div class="vina_content">
				<?php /*------------ Title Block ---------------*/?>				
					<div class="name">
						<a href="<?php print $product->product_link?>"><?php print $product->name?></a>
						<?php if ($jshopConfig->product_list_show_product_code){?><span class="jshop_code_prod">(<?php print _JSHOP_EAN?>: <span><?php print $product->product_ean;?></span>)</span><?php }?>
					</div>
				
				<?php /*------------ Description Block ---------------*/?>
				<?php if($short_description){	// option modul short_description ?>		
					<div class="description">
						<?php print $product->short_description?>
					</div>
				<?php } ?>
				
				<?php /*------------ Price + Old Price + Default Price Block ---------------*/?>
				<?php if($display_price || $product_old_price ) { ?>
					<div class="vina_price">				
						<?php // Price Block ?>
						<?php if($display_price){?>
							<?php if ($product->_display_price){// option modul display_price?>
								<div class = "jshop_price">
							<?php if ($jshopConfig->product_list_show_price_description) print _JSHOP_PRICE.": ";?>
							<?php if ($product->show_price_from) print _JSHOP_FROM." ";?>
								<span><?php print formatprice($product->product_price);?></span>
								</div>
							<?php }?>
							<?php print $product->_tmp_var_bottom_price;?>
						<?php }?>
						
						<?php // Old Price Block?>
						<?php if( $product_old_price){?>
							<?php if ($product->product_old_price > 0){// option modul product_old_price?>
								<div class="old_price"><?php if ($jshopConfig->product_list_show_price_description) print _JSHOP_OLD_PRICE.": ";?><span><?php print formatprice($product->product_old_price)?></span></div>
							<?php }?>
							<?php print $product->_tmp_var_bottom_old_price;?>
						<?php }?>
						
						<?php // Default Price Block ?>
						<?php if ($product->product_price_default > 0 && $jshopConfig->product_list_show_price_default && $product_price_default){ // option modul product_price_default?>
								<div class="default_price"><?php print _JSHOP_DEFAULT_PRICE.": ";?><span><?php print formatprice($product->product_price_default)?></span></div>
						<?php }?>
					</div>
				<?php }?>
							
				<?php /*------------ Review Block ---------------*/?>
				<?php if($allow_review){	// option modul allow_review ?>
					<div class="review_mark">
						<?php print showMarkStar($product->average_rating);?>
					</div>
					<!--<div class="count_commentar">
						<?php print sprintf(_JSHOP_X_COMENTAR, $product->reviews_count);?>
					</div> -->
				<?php } ?>	

				<?php print $product->_tmp_var_bottom_foto;?>
				
				<?php /*------------ Manufacturer Name Block ---------------*/?>
				<?php if ($product->manufacturer->name && $manufacturer_name){// option modul manufacturer_name ?>
					<div class="manufacturer_name"><?php print _JSHOP_MANUFACTURER;?>: <span><?php print $product->manufacturer->name?></span></div>
				<?php }?>
				
				<?php /*------------ Availability Block ---------------*/?>
				<?php if ($product->product_quantity <=0 && !$jshopConfig->hide_text_product_not_available && $product_quantity){// option modul product_quantity?>
					<div class="not_available"><?php print _JSHOP_PRODUCT_NOT_AVAILABLE;?></div>
				<?php }?>

				<?php /*------------ Tax info Block ---------------*/?>
				<?php if ($jshopConfig->show_tax_in_product && $product->tax > 0 && $show_tax_product){// option modul show_tax_product?>
					<span class="taxinfo"><?php print productTaxInfo($product->tax);?></span>
				<?php }?>
				
				<?php /*------------ Plus Shipping Info Block ---------------*/?>
				<?php if ($jshopConfig->show_plus_shipping_in_product && $show_plus_shipping_in_product){?>
					<span class="plusshippinginfo"><?php print sprintf(_JSHOP_PLUS_SHIPPING, $shippinginfo);?></span>
				<?php }?>
				
				<?php /*------------ Basic Price Info Block ---------------*/?>
				<?php if ($product->basic_price_info['price_show'] && $basic_price_info){// option modul basic_price_info?>
					<div class="base_price"><?php print _JSHOP_BASIC_PRICE?>: <?php if ($product->show_price_from) print _JSHOP_FROM;?> <span><?php print formatprice($product->basic_price_info['basic_price'])?> / <?php print $product->basic_price_info['name'];?></span></div>
				<?php }?>

				<?php /*------------ Product Weight Block ---------------*/?>
				<?php if ($jshopConfig->product_list_show_weight && $product->product_weight > 0 && $product_weight){// option modul product_weight?>
					<div class="productweight"><?php print _JSHOP_WEIGHT?>: <span><?php print formatweight($product->product_weight)?></span></div>
				<?php }?>
				
				<?php /*------------ Delivery Time Block ---------------*/?>
				<?php if ($product->delivery_time != '' && $delivery_time){// option modul delivery_time?>
					<div class="deliverytime"><?php print _JSHOP_DELIVERY_TIME?>: <span><?php print $product->delivery_time?></span></div>
				<?php }?>

				<?php /*------------ Extra Field Block ---------------*/?>
				<?php if (is_array($product->extra_field) && $extra_field){// option modul extra_field?>
					<div class="extra_fields">
						<?php foreach($product->extra_field as $extra_field){?>
							<div><?php print $extra_field['name'];?>: <?php print $extra_field['value']; ?></div>
						<?php }?>
					</div>
				<?php }?>
				
				<?php /*------------ Vendor Block ---------------*/?>
				<?php if ($product->vendor && $vendor){// option modul vendor?>
					<div class="vendorinfo"><?php print _JSHOP_VENDOR?>: <a href="<?php print $product->vendor->products?>"><?php print $product->vendor->shop_name?></a></div>
				<?php }?>
				
				<?php /*------------ Qty Stock Block ---------------*/?>
				<?php if ($jshopConfig->product_list_show_qty_stock && $product_list_qty_stock){// option modul product_list_qty_stock?>
					<div class="qty_in_stock"><?php print _JSHOP_QTY_IN_STOCK?>: <span><?php print sprintQtyInStock($product->qty_in_stock)?></span></div>
				<?php }?>
			</div>
			<?php /*------------ Button buy + Button Detail + Button Wishlist ---------------*/?>
			<?php if($show_button){?>
				<?php print $product->_tmp_var_top_buttons;?>
				<div class="buttons vina_bottons">
					<?php if ($product->buy_link && $show_button_buy){?>
						<a class="button_buy" href="<?php print $product->buy_link?>" title="<?php print JText::_('JSHOP_ADD_TO_CART'); ?>"><i style="display: inline-block;" class="icon-shopping-cart"></i><?php //print JText::_('JSHOP_ADD_TO_CART'); ?></a>
					<?php }?>
					<?php if ($show_button_detal){?>
						<a class="button_detail" href="<?php print $product->product_link?>" title="<?php print JText::_('JSHOP_VIEW_DETAIL'); ?>" ><i style="display: inline-block;" class="icon-eye-open"></i><?php //print JText::_('JSHOP_VIEW_DETAIL'); ?></a>
					<?php }?>
					<a class="button_wishlist" href = "<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=add&category_id='.$product->category_id.'&product_id='.$product->product_id.'&to=wishlist', 1);?>" title="<?php print JText::_('JSHOP_ADD_TO_WISHLIST'); ?>"><i style="display: inline-block;" class="icon-heart"></i><?php //print JText::_('JSHOP_ADD_TO_WISHLIST'); ?></a>
					<?php print $product->_tmp_var_buttons;?>
				</div>					
				<?php 	print $product->_tmp_var_bottom_buttons;?>
			<?php }?>
		</div>
	</div>		
	<?php print $product->_tmp_var_end?>
	<?php if(($i+1)%$row_product == 0) print '</div>'; $i++;?>
<?php } ?>
<?php if($i%$row_product != 0) print '</div>';?>
</div> 