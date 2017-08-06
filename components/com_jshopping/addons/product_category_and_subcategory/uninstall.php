<?php
	defined('_JEXEC') or die('Restricted access');
	jimport('joomla.filesystem.folder');
	$db = JFactory::getDbo();	
	foreach(array(
		"DELETE FROM #__extensions WHERE element = 'allproducts' AND type = 'plugin'"
	) as $_q){
        $db->setQuery($_q)->execute();
    }
	
	foreach(array(
		"plugins/jshoppingproducts/allproducts/"
	) as $folder){
        JFolder::delete(JPATH_ROOT."/$folder");
    }