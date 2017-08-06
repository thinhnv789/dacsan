<?php
defined('JPATH_BASE') or die;
JFormHelper::loadFieldClass('list');
class JFormFieldBackupVersions extends JFormFieldList
{
    protected $type = 'BackupVersions';

    public function setup(SimpleXMLElement $element, $value, $group = null)
    {
        if($value == '__current')
        {
            $value = JModelLegacy::getInstance('backup', 'JshoppingModel')->getCurrentVersion();
        }
        return parent::setup($element, $value, $group);
    }

    protected function getOptions()
    {            
        $options = parent::getOptions();
        $model = JModelLegacy::getInstance('backup', 'JshoppingModel');
        foreach($model->getVersions() as $key)
        {
            $value = $key;
            if($key == $model->getCurrentVersion())
            {
                $value = $key.' ('.JText::_('JSHOPPING_ADDON_BACKUP_CURRENT').')';
            }
            $options[$key] =  $value;
        }
        return $options;
    }
}