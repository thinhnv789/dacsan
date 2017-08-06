<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controllerform');
class JshoppingControllerBackup extends JControllerForm
{
    protected $default_view = 'backup';

    public function __construct($config = array())
    {
        parent::__construct($config);
        addSubmenu('backup');
    }

    public function save($key = null, $urlVar = null)
    {
        extract(__(get_defined_vars(), 'Before'));
        $application = JFactory::getApplication();
        $model = JModelLegacy::getInstance('Backup', 'JshoppingModel');
        $data = JRequest::getVar('jform', array(), 'post', 'array');
        $model->save($data);
        $application->setUserState('com_jshopping.edit.backup.data', $data);
        if(count($errors = $model->getErrors()))
        {
            $application->enqueueMessage(implode("\n", $errors));
        }
        $this->setRedirect(JRoute::_('index.php?option=com_jshopping&controller=backups', false), JText::_('JSHOPPING_ADDON_BACKUP_SUCCESS'));
        extract(__(get_defined_vars(), 'After'));
    }

    public function getModel($name = 'Backup', $prefix = 'JshoppingModel', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function cancel($key = NULL)
    {
        $this->setRedirect(JRoute::_('index.php?option=com_jshopping&controller=backups', false));
    }

    protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
    {
        return parent::getRedirectToItemAppend($recordId, $urlVar).'&controller=backup';
    }
}