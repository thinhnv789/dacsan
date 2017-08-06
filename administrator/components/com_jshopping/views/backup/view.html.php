<?php
defined('_JEXEC') or die;
class JshoppingViewBackup extends JViewLegacy
{
    protected $form;
    protected $state;
    
    public function display($tpl = null)
    {
        $this->state = $this->get('State');
        $this->form = $this->get('Form');
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        JRequest::setVar('hidemainmenu', true);
        JToolBarHelper::title(JText::_('JSHOPPING_ADDON_BACKUP_MAKE'), 'backup');
        JToolBarHelper::save('save', 'JSHOPPING_ADDON_BACKUP_SAVE');
        JToolBarHelper::cancel('cancel', 'JSHOPPING_ADDON_BACKUP_CLOSE');
    }
}