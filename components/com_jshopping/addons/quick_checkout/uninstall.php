<?php
	defined('_JEXEC') or die('Restricted access');
	$db = JFactory::getDbo();
	
	$db->setQuery("DELETE FROM `#__extensions` WHERE `element` = 'quick_checkout' AND `folder` = 'jshoppingcheckout' AND `type` = 'plugin'");
	$db->query();
	
	$db->setQuery("DELETE FROM `#__extensions` WHERE `element` = 'jshop_qc_redirect' AND `folder` = 'system' AND `type` = 'plugin'");
	$db->query();
	
	$db->setQuery("DELETE FROM `#__extensions` WHERE `element` = 'quick_checkout' AND `folder` = 'jshoppingrouter' AND `type` = 'plugin'");
	$db->query();
	
	jimport('joomla.filesystem.folder');
	foreach(array(
		'components/com_jshopping/addons/quick_checkout/',
		'components/com_jshopping/templates/addons/quick_checkout/',
		'components/com_jshopping/templates/addons/quick_checkout_cart/',
		'components/com_jshopping/views/quick_checkout/',
		'components/com_jshopping/views/quick_checkout_cart/',
		'plugins/jshoppingcheckout/quick_checkout/',
		'plugins/jshoppingrouter/quick_checkout/',
		'plugins/system/jshop_qc_redirect/'
	) as $folder){JFolder::delete(JPATH_ROOT.'/'.$folder);}
	   
	jimport('joomla.filesystem.file');
	foreach(array(
		'components/com_jshopping/controllers/qcheckout.php',
		'components/com_jshopping/css/quick_checkout.css',
		'components/com_jshopping/js/quick_checkout.js'
	) as $file){JFile::delete(JPATH_ROOT.'/'.$file);}