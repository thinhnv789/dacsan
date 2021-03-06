<?php
defined('_JEXEC') or die;
class JshoppingViewBackups extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('JSHOPPING_ADDON_BACKUP_BACKUPS'), 'backup');
		JToolBarHelper::addNew();
		JToolBarHelper::deleteList('JSHOPPING_ADDON_BACKUP_DELETE_QUESTION', 'delete');
	}
}