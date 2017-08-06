<?php

	defined('_JEXEC') or die('Restricted access');
	$db = JFactory::getDbo();
	
	$db->setQuery("DELETE FROM `#__extensions` WHERE element = 'addon_langoverride' AND folder = 'jshopping' AND `type` = 'plugin'");
	$db->query();
    $db->setQuery("DELETE FROM `#__extensions` WHERE element = 'addon_langoverride' AND folder = 'jshoppingmenu' AND `type` = 'plugin'");
	$db->query();
	
	$db->setQuery('DROP TABLE IF EXISTS `#__jshopping_langoverride`');
	$db->query();
	
	jimport('joomla.filesystem.folder');
	foreach(array(
		'plugins/jshopping/addon_langoverride/',
		'plugins/jshoppingmenu/addon_langoverride/',
		'administrator/components/com_jshopping/views/addon_langoverride/',
        'administrator/components/com_jshopping/lang/addon_langoverride/',
		'components/com_jshopping/addons/addon_langoverride/',
		'components/com_jshopping/lang/override/',
	) as $folder){JFolder::delete(JPATH_ROOT.'/'.$folder);}
	
	jimport('joomla.filesystem.file');
	foreach(array(
		'administrator/components/com_jshopping/controllers/addon_langoverride.php',
        'components/com_jshopping/tables/addon_langoverride.php'
	) as $file){JFile::delete(JPATH_ROOT.'/'.$file);}
?>