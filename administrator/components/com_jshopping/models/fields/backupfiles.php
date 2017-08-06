<?php
defined('JPATH_BASE') or die;
JFormHelper::loadFieldClass('list');
class JFormFieldBackupFiles extends JFormFieldList
{
    protected $type = 'BackupFiles';

    protected function getOptions()
    {            
        $options = parent::getOptions();
        $model = JModelLegacy::getInstance('backup', 'JshoppingModel');
        foreach($model->getFilePaths() as $key => $relative_path)
        {
            $key = 'JSHOPPING_ADDON_BACKUP_FILES_'.strtoupper($key);
            $options[$relative_path] = JFactory::getLanguage()->hasKey($key) ? JText::_($key) : $relative_path;
        }
        return $options;
    }
}