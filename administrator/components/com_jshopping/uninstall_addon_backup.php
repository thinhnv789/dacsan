<?php
    defined('_JEXEC') or die('Restricted access');
    $db->setQuery("DELETE FROM `#__extensions` WHERE element='backup' AND folder IN ('jshoppingmenu','system')");
    $db->query();
    jimport('joomla.filesystem.folder');
    foreach(array(
        'plugins/system/backup',
        'plugins/jshoppingmenu/backup',
		'administrator/components/com_jshopping/images/backup',
		'administrator/components/com_jshopping/views/backup',
		'administrator/components/com_jshopping/views/backups',
		'administrator/components/com_jshopping/addons/addon_backup',
    ) as $folder){JFolder::delete(JPATH_ROOT.'/'.$folder);}    
    jimport('joomla.filesystem.file');
    foreach(array(
        'administrator/language/en-GB/en-GB.com_jshopping.addon_backup.ini',
        'administrator/language/ua-UA/ua-UA.com_jshopping.addon_backup.ini',
        'administrator/components/com_jshopping/controllers/backup.php',
        'administrator/components/com_jshopping/controllers/backups.php',
        'administrator/components/com_jshopping/models/backup.php',
        'administrator/components/com_jshopping/models/backups.php',
        'administrator/components/com_jshopping/uninstall_addon_backup.php',
        'administrator/components/com_jshopping/models/fields/backupversions.php',
        'administrator/components/com_jshopping/models/fields/backupfiles.php',
        'administrator/components/com_jshopping/models/forms/backup.xml',
        'administrator/components/com_jshopping/css/backup.css'
    ) as $file){JFile::delete(JPATH_ROOT.'/'.$file);}
?>