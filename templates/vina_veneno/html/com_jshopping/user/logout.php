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
<div class="jshop account-logout">
	<div class="vina-title border-green-2">
		<div class="megamenu-title">
			<h1 class="header">
				<span><?php print _JSHOP_LOGOUT ?></span>
			</h1>
		</div>
	</div>
	<div class = "row-fluid">
		<div class = "span6 new-users">
			<div class="content">
				<h2><?php print _JSHOP_LOGOUT ?></h2>
				<p><?php echo JText::_('VINA_LOGOUT_DES') ?></p>
			</div>
			<div class="buttons-set">
				<button type="button" class="vina-button" title="<?php print _JSHOP_LOGOUT ?>" onclick="location.href='<?php print SEFLink("index.php?option=com_jshopping&controller=user&task=logout"); ?>'" ><span><span><?php print _JSHOP_LOGOUT ?></span></span></button>
			</div>
        </div>
	</div>
</div>