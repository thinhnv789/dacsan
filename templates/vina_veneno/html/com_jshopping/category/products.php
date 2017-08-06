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
<?php if ($this->display_list_products){?>
<div class="jshop_list_product">    
<?php
    include(dirname(__FILE__)."/../".$this->template_block_form_filter);
    if (count($this->rows)){
        include(dirname(__FILE__)."/../".$this->template_block_list_product);
    }
?>
	<?php if ($this->display_pagination){ ?>
		<div class="row-fluid block_sorting_count_to_page">
			<div class="span12 box_pagination pagination_bottom">
				<?php
					include(dirname(__FILE__)."/../".$this->template_block_pagination);		
				?>
			</div>
		</div>
	<?php } ?>
</div>
<?php }?>