<?php
$install_data = JApplicationHelper::parseXMLInstallFile(JPATH_ROOT.'/administrator/components/com_jshopping/jshopping.xml');
$path = $extractdir.'/'.$install_data['version'].'.sql';
if(file_exists($path))
{
    $db = JFactory::getDBO();
    foreach($db->splitSql(file_get_contents($path)) as $query)
    {
        if(trim($query) == '')continue;
        $db->setQuery($query);
        if(!$db->query())JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
    }
    JFile::delete(JPATH_ROOT.'/'.$install_data['version'].'.sql');
}
else
{
    JFactory::getApplication()->enqueueMessage('Version '.$install_data['version'].' is not supported!', 'warning');
}