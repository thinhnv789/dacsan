<div id = "jshop_module_wishlist">
<table style="width: 100%;" >
<tr>
    <td>
      <span id = "jshop_qty_products"><?php print $cart->count_product?></span>&nbsp;<?php print JText::_('PRODUCTS')?>
    </td>
    <td>-</td>
    <td>
      <span id = "jshop_sum_product"><?php print formatprice($cart->getSum(0,1))?></span>
    </td>
</tr>
<tr>
    <td colspan="3" style="align: right;">
      <a href = "<?php print SEFLink('index.php?option=com_jshopping&controller=wishlist&task=view', 1)?>"><?php print JText::_('GO_TO_WISHLIST')?></a>
    </td>
</tr>
</table>
</div>