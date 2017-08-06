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
<div class="jshop list_product">
<?php foreach ($this->rows as $k=>$product) : ?>
    <?php if ($k % $this->count_product_to_row == 0) : ?>
        <div class = "row-fluid">
    <?php endif; ?>
    
    <div class = "span<?php echo (($this->count_product_to_row > 0) ? 12 / $this->count_product_to_row : '1'); ?> block_item">
        <?php include(dirname(__FILE__)."/".$product->template_block_product);?>
    </div>
            
    <?php if ($k % $this->count_product_to_row == $this->count_product_to_row - 1) : ?>
        <div class = "clearfix"></div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php if ($k % $this->count_product_to_row != $this->count_product_to_row - 1) : ?>
    <div class = "clearfix"></div>
    </div>
<?php endif; ?>
</div>