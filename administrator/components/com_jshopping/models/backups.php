<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modellist');
class JshoppingModelBackups extends JModelList
{
    public function getItems()
    {
        extract(__(get_defined_vars(), 'Before'));
        $backup_model = JModelLegacy::getInstance('backup', 'JshoppingModel');
        $items = array();
        foreach($this->getBackupFiles() as $id => $backup_file_path)
        {
            $item = new stdClass();
            $item->filename = pathinfo($backup_file_path, PATHINFO_BASENAME);
            $item->link = $backup_model->getBackupsURL().$item->filename;
            $item->created = filectime($backup_file_path);
            $item->size = filesize($backup_file_path);
            $items[] = $item;
        }
        @usort($items, array($this, 'compareItems'));
        $items = array_slice($items, $this->getStart(), $this->getState('list.limit'));
        extract(__(get_defined_vars(), 'After'));
        return $items;
    }

    public function getTotal()
    {
        $total = count($this->getBackupFiles());
        extract(__(get_defined_vars()));
        return $total;
    }

    protected function getBackupFiles()
    {
        $backup_model = JModelLegacy::getInstance('backup', 'JshoppingModel');
        $backup_files = JFolder::files($backup_model->getBackupsPath(), '\.zip$', false, true);
        extract(__(get_defined_vars()));
        return $backup_files;
    }

    protected function compareItems($item1, $item2)
    {
        extract(__(get_defined_vars(), 'Before'));
        $result = 0;
        if($item1->created < $item2->created)
        {
            $result = 1;
        }
        elseif($item1->created > $item2->created)
        {
            $result = -1;
        }
        extract(__(get_defined_vars(), 'After'));
        return $result;
    }
}