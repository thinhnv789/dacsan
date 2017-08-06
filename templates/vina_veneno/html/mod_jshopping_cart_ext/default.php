<div id = "jshop_module_cart">	
	<span class="jshop_quantity_products top-cart-title">                   
        <span class="my_cart"><?php print JText::_('VINA_MY_CART')?>:</span><span class="count_products_cart"> <?php print $cart->count_product; ?> <?php ($cart->count_product < 2) ? print 'item' : print 'items' ?></span>            
    </span>
	<div class="top-cart-content" style="display: none;">        
		<ol id="top-cart-sidebar" class="cart-products-list">
			<?php
				$cart = JModelLegacy::getInstance('cart', 'jshop');
				$cart->load();
				$cart->addLinkToProducts(1);
				$cart->setDisplayFreeAttributes();				
				$jshopConfig = JSFactory::getConfig(); 				
				$countprod = 0;
				$array_products = array();
				foreach($cart->products as $value){
					$array_products [$countprod] = $value; //var_dump($value);
			?> 				
					<li class="item <?php  if ( ($countprod + 2) % 2 > 0) { print 'odd'; } else { print 'even'; }  ?>">
						<a href="<?php print $array_products [$countprod]["href"];?>" title="<?php print $array_products [$countprod]["product_name"]; ?>" class="product-image">
							<img src="<?php print $jshopConfig->image_product_live_path;?>/<?php if ($array_products [$countprod]["thumb_image"]) print $array_products [$countprod]["thumb_image"]; else print $jshopConfig->no_image; ?>" width="50" height="50" alt="<?php print $array_products [$countprod]["product_name"]; ?>">
						</a>
						<div class="product-details">
							<a href="<?php print $array_products [$countprod]["href_delete"]; ?>" title="Remove This Item" onclick="return confirm('<?php print _JSHOP_CONFIRM_REMOVE?>')" class="btn-remove">Remove This Item</a>							
							<p class="product-name name"><a href="<?php print $array_products [$countprod]["href"];?>"><?php print $array_products [$countprod]["product_name"]; ?></a></p>
							<?php if ($show_count =='1') {?>
								<strong class="qtty"><?php print $array_products [$countprod]["quantity"]; ?></strong> x <span class="price summ"><?php print formatprice($array_products [$countprod]["price"]); ?></span>                    
							<?php }else {?>
								<strong class="qtty"></strong>
								<span class="price summ"><?php print formatprice($array_products [$countprod]["price"] * $array_products [$countprod]["quantity"]); ?></span>                    
							<?php }?>
						</div>
					</li>                                                            
					<?php $countprod++;	?>
			<?php } ?>
		</ol>
		<?php if( $cart->count_product == 0) { ?>
			<p class="empty"><?php print JText::_('VINA_YOUR_CART_HAVE_NO_ITEMS') ?></p>
		<?php } ?>
			<div id = "jshop_quantity_products" class="top-subtotal">
				<strong><?php print JText::_('SUM_TOTAL')?>:</strong>
				<span id = "jshop_summ_product" class="price">
					<?php print formatprice($cart->getSum(0,1))?>
				</span>
			</div>
		<?php if( $cart->count_product > 0) { ?>
			<div class="actions goto_cart">
				<a href = "<?php print SEFLink('index.php?option=com_jshopping&controller=cart&task=view', 1)?>"><?php print JText::_('GO_TO_CART')?></a>
			</div>
		<?php } ?>		
	</div>
</div>

