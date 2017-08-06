<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controlleradmin');
class JshoppingControllerBackups extends JControllerAdmin
{
    protected $default_view = 'backups';

    public function __construct($config = array())
    {
        parent::__construct($config);
        addSubmenu('backup');
    }

    public function display($cachable = false, $urlparams = false)
    {
        return JControllerLegacy::display($cachable, $urlparams);
    }

    public function delete()
    {
        extract(__(get_defined_vars(), 'Before'));
        $redirect = JRoute::_('index.php?option=com_jshopping&controller=backups', false);
        if($this->getModel()->delete(JRequest::getVar('cid', array(), '', 'array')))
        {
            $this->setRedirect($redirect, JText::_('JSHOPPING_ADDON_BACKUP_DELETE_SUCCESS'));
        }
        else
        {
            $this->setRedirect($redirect);
        }
        extract(__(get_defined_vars(), 'After'));
    }

    public function getModel($name = 'Backup', $prefix = 'JshoppingModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}