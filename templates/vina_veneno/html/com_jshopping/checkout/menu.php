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
<div class="menu_checkout">	
	<h3 class="header">
		<span><?php echo JText::_('VINA_YOURCHECKOUT') ?></span>
	</h3>
</div>
<div class = "jshop" id = "jshop_menu_order">
  <ul>
    <?php foreach($this->steps as $k=>$step){?>
      <li class = "jshop_order_step <?php print $this->cssclass[$k]?>">
        <span class="item_menu_order"><?php print $step;?></span>
      </li>
    <?php }?>
  </ul>
</div>