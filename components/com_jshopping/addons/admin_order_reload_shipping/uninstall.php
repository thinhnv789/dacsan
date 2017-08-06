<?php
	defined('_JEXEC') or die('Restricted access');
	$db = JFactory::getDbo();
	
	$name = "JoomShopping Addon order reload shiping";
	$element = "admin_order_reload_shipping";
	
	//delete plugin
	$db->setQuery("DELETE FROM `#__extensions` WHERE `element`='addon_".$element."' AND `folder`='jshoppingadmin' AND `type`='plugin'");
	$db->query();	
	
	//delete folder
	jimport('joomla.filesystem.folder');
	foreach(array(
		'plugins/jshoppingadmin/addon_'.$element.'/',
		'components/com_jshopping/addons/'.$element.'/'
	) as $folder){JFolder::delete(JPATH_ROOT.'/'.$folder);}
	// delete files
	jimport('joomla.filesystem.file');
	foreach(array(
		'administrator/components/com_jshopping/js/addon_'.$element.'.js',
		'components/com_jshopping/controllers/addon_'.$element.'.php'
	) as $file){JFile::delete(JPATH_ROOT.'/'.$file);}
?>