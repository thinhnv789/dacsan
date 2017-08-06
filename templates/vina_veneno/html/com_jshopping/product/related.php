<?php 
/**
* @version      4.3.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<?php
$in_row = $this->config->product_count_related_in_row;
?>
<?php if (count($this->related_prod)){?>    
    <div class="related_header">
		<h3 class="header">
			<span><?php print _JSHOP_RELATED_PRODUCTS?></span>
		</h3>
	</div>
    <div class="jshop list_related">
		<div class = "flexslider_related carousel">
			<ul class="slides">
				<?php foreach($this->related_prod as $k=>$product) : ?> 					
					<li class="block_item jshop_related" >
						<?php include(dirname(__FILE__)."/../".$this->folder_list_products."/".$product->template_block_product);?>
					</li>									
				<?php endforeach; ?>				
			</ul>
		</div>
	</div> 
<?php }?>