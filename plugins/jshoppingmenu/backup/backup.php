<?php
defined('_JEXEC') or die('Restricted access');
class plgJshoppingMenuBackup extends JPlugin
{
    public function __construct(&$subject, $config = array())
    {
        $this->adminaccess = JFactory::getUser()->authorise('core.admin', 'com_jshopping');
        JHtml::_('behavior.modal');
        parent::__construct($subject, $config);
    }

    public function onBeforeAdminMainPanelIcoDisplay(&$menu)
    {
        $menu['backup'] = array(JText::_('JSHOPPING_ADDON_BACKUP_BACKUPS'), 'index.php?option=com_jshopping&controller=backups', 'backup/icon-48-backup.png', $this->adminaccess);
    }

    public function onBeforeAdminMenuDisplay(&$menu, &$vName)
    {
        $menu['backup'] = array(JText::_('JSHOPPING_ADDON_BACKUP_BACKUPS'), 'index.php?option=com_jshopping&controller=backups', $vName == 'backup', $this->adminaccess);
    }
}