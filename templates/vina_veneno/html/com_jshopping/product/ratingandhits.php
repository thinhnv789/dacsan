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
<?php if ($this->allow_review){?>
<div class="jshop_review">   
    <?php if ($this->allow_review){?>    
    <?php print showMarkStar($this->product->average_rating);?>                        
    <?php } ?>
</div>
<?php } ?>