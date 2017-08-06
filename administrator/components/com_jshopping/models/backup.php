<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.modeladmin');
class JshoppingModelBackup extends JModelAdmin{

    protected $versions = array(
        '3.16.1',
        '3.16.2',
        '3.16.3',
        '3.16.4',
        '3.17.0',
        '3.17.1',
        '3.18.0',
        '3.18.1',
        '3.18.2',
        '3.18.3',
        '3.18.4',
        '3.18.5',
		/*--- 05-02-2015 ---*/
		'3.19.0',
		'3.19.1',
		'3.19.2',
		'3.20.0',
		'3.20.1',
		/*--- 16-07-2015 ---*/ 
		'3.20.2',
        
        '4.4.1',
        '4.4.2',
        '4.4.3',
        '4.5.0',
        '4.6.0',
        '4.6.1',
		/*--- 05-02-2015 ---*/
		'4.7.0',
		'4.7.1',
		'4.8.0',
		'4.8.1',
		'4.9.0',
		'4.9.1',
		/*--- 16-07-2015 ---*/ 
		'4.9.2',
		'4.10.0',
		'4.10.1',
		'4.10.2',
		'4.10.3',
		/*--- 26-08-2015 ---*/
		'4.10.4'
    );
    
    protected $upgrades = array(
        '3.16.1' => '4.4.1',
        '3.16.2' => '4.4.1',
        '3.16.3' => '4.4.2',
        '3.16.4' => '4.4.2',
        '3.17.0' => '4.5.0',
        '3.17.1' => '4.5.0',
        '3.18.0' => '4.6.0',
        '3.18.1' => '4.6.0',
        '3.18.2' => '4.6.1',
        '3.18.3' => '4.6.1',
        '3.18.4' => '4.6.1',
        '3.18.5' => '4.6.1',
		/*--- 05-02-2015 ---*/
		'3.19.0' => '4.6.1',
		'3.19.1' => '4.7.0',
		'3.19.2' => '4.7.1',
		'3.20.0' => '4.8.0',
		'3.20.1' => '4.8.1',
		/*--- 16-07-2015 ---*/ 
		'3.20.2' => '4.8.1',
        
        '4.4.1' => '3.16.2',
        '4.4.2' => '3.16.4',
        '4.4.3' => '3.16.4',
        '4.5.0' => '3.17.1',
        '4.6.0' => '3.18.1',
        '4.6.1' => '3.18.5',
		/*--- 05-02-2015 ---*/
		'4.7.0' => '3.19.1',
		'4.7.1' => '3.19.2',
		'4.8.0' => '3.20.0',
		'4.8.1' => '3.20.1',
		'4.9.0' => '3.20.1',
		'4.9.1' => '3.20.1',
		/*--- 16-07-2015 ---*/ 
		'4.9.2' => '3.20.2',
		'4.10.0' => '3.20.2',
		'4.10.1' => '3.20.2',
		'4.10.2' => '3.20.2',
		'4.10.3' => '3.20.2',
		/*--- 26-08-2015 ---*/
		'4.10.4' => '3.20.2'		
    );

    protected $jshopping_tables = array(
        '#__jshopping_addons',
        '#__jshopping_attr',
		'#__jshopping_attr_groups',
        '#__jshopping_attr_values',
        '#__jshopping_cart_temp',
        '#__jshopping_categories',
        '#__jshopping_config',
        '#__jshopping_config_display_prices',
        '#__jshopping_config_main_page',
        '#__jshopping_config_seo',
        '#__jshopping_config_statictext',
        '#__jshopping_countries', 
        '#__jshopping_coupons',
        '#__jshopping_currencies',
        '#__jshopping_delivery_times',
        '#__jshopping_free_attr',
        '#__jshopping_import_export',
        '#__jshopping_languages',
        '#__jshopping_manufacturers',
        '#__jshopping_order_history',
        '#__jshopping_order_item',
        '#__jshopping_orders',
        '#__jshopping_order_status',
        '#__jshopping_payment_method',
        '#__jshopping_product_labels',
        '#__jshopping_products',
        '#__jshopping_products_attr',
        '#__jshopping_products_attr2',
        '#__jshopping_products_extra_field_groups',
        '#__jshopping_products_extra_fields',
        '#__jshopping_products_extra_field_values',
        '#__jshopping_products_files',
        '#__jshopping_products_free_attr',
        '#__jshopping_products_images',
        '#__jshopping_products_prices',
        '#__jshopping_products_relations',
        '#__jshopping_products_reviews',
        '#__jshopping_products_to_categories',
        '#__jshopping_products_videos',
        '#__jshopping_shipping_ext_calc',
        '#__jshopping_shipping_method',
        '#__jshopping_shipping_method_price',
        '#__jshopping_shipping_method_price_countries',
        '#__jshopping_shipping_method_price_weight',
        '#__jshopping_taxes',
        '#__jshopping_taxes_ext',
        '#__jshopping_unit', 
        '#__jshopping_usergroups',
        '#__jshopping_users',
        '#__jshopping_vendors',
        '#__jshopping_products_option'
    );

    protected $file_paths = array(
        'demo_products' => 'components/com_jshopping/files/demo_products',
        'files_products' => 'components/com_jshopping/files/files_products',
        'img_attributes' => 'components/com_jshopping/files/img_attributes',
        'img_categories' => 'components/com_jshopping/files/img_categories',
        'img_labels' => 'components/com_jshopping/files/img_labels',
        'img_manufs' => 'components/com_jshopping/files/img_manufs',
        'img_products' => 'components/com_jshopping/files/img_products',
        'img_vendors' => 'components/com_jshopping/files/img_vendors',
        'importexport' => 'components/com_jshopping/files/importexport',
        'pdf_orders' => 'components/com_jshopping/files/pdf_orders',
        'video_products' => 'components/com_jshopping/files/video_products'
    );

    protected $version;
    protected $files;
    protected $db;

    public function __construct($config = array())
    {
        extract(__(get_defined_vars(), 'Before'));
        JPluginHelper::importPlugin('jshoppingbackup');
        if(!in_array($this->getCurrentVersion(), $this->versions))
        {
            $this->versions[] = $this->getCurrentVersion();
            @usort($this->versions, 'version_compare');
        }
        parent::__construct($config);
        extract(__(get_defined_vars(), 'After'));
    }

    public function save($data)
    {
        extract(__(get_defined_vars(), 'Before'));
        @set_time_limit(ini_get('max_execution_time'));
        $this->version = $data['version'];
        $this->files = $data['files'];
        $this->db = $data['db'];
        $this->createBackupFolder();        
        if ($this->db){
            $this->saveDB();
        }        
        $this->saveFiles();
        $this->saveBackupZIPArchive();
        extract(__(get_defined_vars(), 'After'));
    }

    protected function createBackupFolder()
    {
        extract(__(get_defined_vars(), 'Before'));
        JFolder::create($this->getBackupPath());
        extract(__(get_defined_vars(), 'After'));
    }

    protected function saveDB()
    {
        extract(__(get_defined_vars(), 'Before'));
        $this->createTemporaryTables();
        $this->convertDB();
        $this->dropTemporaryTables();
        $this->copyUpdateScript();
        extract(__(get_defined_vars(), 'After'));
    }

    protected function copyUpdateScript()
    {
        extract(__(get_defined_vars(), 'Before'));
        JFile::copy(JPATH_ROOT.'/administrator/components/com_jshopping/addons/addon_backup/update.php', $this->getBackupPath().'/update.php');
        extract(__(get_defined_vars(), 'After'));
    }

    protected function saveFiles()
    {
        extract(__(get_defined_vars(), 'Before'));
        foreach($this->file_paths as $relative_path)
        {
            if(in_array($relative_path, $this->files))
            {
                $path = JPATH_ROOT.'/'.$relative_path;
                if(file_exists($path))
                {
                    $new_path = $this->getBackupPath().'/'.$relative_path;
                    if(is_dir($path))
                    {
                        JFolder::copy($path, $new_path);
                    }                
                    else
                    {
                        JFile::copy($path, $new_path);
                    }
                }
            }
        }
        extract(__(get_defined_vars(), 'After'));
    }

    public function getVersions()
    {
        $versions = $this->versions;
        extract(__(get_defined_vars()));
        return $versions;
    }

    protected function saveTables()
    {
        extract(__(get_defined_vars(), 'Before'));
        foreach($this->_db->getTableList() as $table_name)
        {            
            if(strpos($table_name, '_'.$this->_db->getPrefix()) === 0)
            {
                $this->saveTable($table_name);
            }
        }
        extract(__(get_defined_vars(), 'After'));
    }

    protected function saveTable($table_name)
    {
        extract(__(get_defined_vars(), 'Before'));
        if(!is_null($table_name))
        {
            $this->saveTableDrop($table_name);
            $this->saveTableCreate($table_name);
            $this->saveTableRows($table_name);
        }
        extract(__(get_defined_vars(), 'After'));
    }

    protected function saveTableDrop($table_name)
    {
        extract(__(get_defined_vars(), 'Before'));
        $this->saveQuery("DROP TABLE IF EXISTS `".$table_name."`;");
        extract(__(get_defined_vars(), 'After'));
    }

    protected function saveTableCreate($table_name)
    {
        extract(__(get_defined_vars(), 'Before'));
        $table_create = $this->_db->getTableCreate($table_name);
        if(isset($table_create[$table_name]))
        {
            $this->saveQuery($table_create[$table_name].';');
        }
        extract(__(get_defined_vars(), 'After'));
    }

    protected function saveTableRows($table_name)
    {
        extract(__(get_defined_vars(), 'Before'));
        $limit = $this->getLimit();
        $offset = 0;
        $columns = array_keys($this->_db->getTableColumns($table_name));
        while(count($rows = $this->getTableRows($table_name, $columns, $offset, $limit)))
        {
            $this->saveQuery("INSERT INTO `".$table_name."`(`".implode("`,`", $columns)."`) VALUES");
            foreach($rows as $i => $row)
            {
                foreach($row as &$value)
                {
                    $value = $this->_db->escape($value);
                }
                $this->saveQuery("('".implode("','", array_values($row))."')".($i < count($rows)-1 ? ',' : ';'));
            }
            $offset += $limit;
        }
        extract(__(get_defined_vars(), 'After'));
    }

    protected function getTableRows($table_name, $columns, $offset, $limit)
    {
        extract(__(get_defined_vars(), 'Before'));
        $this->_db->setQuery("SELECT `".implode("`,`", $columns)."` FROM `".$table_name."` LIMIT ".$offset.",".$limit);
        $rows = $this->_db->loadAssocList();
        extract(__(get_defined_vars(), 'After'));
        return $rows;
    }

    protected function saveQuery($query)
    {
        extract(__(get_defined_vars(), 'Before'));
        file_put_contents($this->getBackupPath().'/'.$this->version.'.sql', str_replace('_'.$this->_db->getPrefix(), '#__', $query)."\n", FILE_APPEND);
        extract(__(get_defined_vars(), 'After'));
    }

    public function getBackupName()
    {                
        static $backup_name;
        if(is_null($backup_name)){
            $backup_name = 'backup_'.$this->version.'_'.date('YmdHis');            
        }
        extract(__(get_defined_vars()));
        return $backup_name;
    }

    public function getBackupPath()
    {
        $path = JPath::clean($this->getBackupsPath().'/'.$this->getBackupName());
        extract(__(get_defined_vars()));
        return $path;
    }

    public function getBackupURL()
    {
        $url = $this->getBackupsURL().$this->getBackupName();
        extract(__(get_defined_vars()));
        return $url;
    }

    protected function getLimit()
    {
        $limit = 100;
        extract(__(get_defined_vars()));
        return $limit;
    }

    protected function createTemporaryTables()
    {
        extract(__(get_defined_vars(), 'Before'));
        $this->dropTemporaryTables();
        foreach($this->_db->getTableList() as $table_name)
        {
            //if(in_array(str_replace($this->_db->getPrefix(), '#__', $table_name), $this->jshopping_tables))
			if(preg_match('/^'.preg_quote($this->_db->getPrefix()).'jshopping_.*$/is',$table_name))
            {
                $this->_db->setQuery("CREATE TABLE IF NOT EXISTS `_".$table_name."` LIKE `".$table_name."`");
                $this->_db->query();
                $this->_db->setQuery("INSERT INTO `_".$table_name."` SELECT * FROM `".$table_name."`");
                $this->_db->query();
				var_dump($this->_db->getPrefix(),$table_name);
            }
        }
        extract(__(get_defined_vars(), 'After'));
    }

    protected function dropTemporaryTables()
    {
        extract(__(get_defined_vars(), 'Before'));
        foreach($this->_db->getTableList() as $table_name)
        {
            if($table_name{0} === '_')
            {
                $this->_db->setQuery("DROP TABLE IF EXISTS `".$table_name."`");
                $this->_db->query();
            }
        }
        extract(__(get_defined_vars(), 'After'));
    }

    protected function convertDB()
    {
        extract(__(get_defined_vars(), 'Before'));
        $current_version = $this->getCurrentVersion();
		//$current_version = '3.20.1';
        $index = array_search($current_version, $this->versions);
        if ($index !== false){
            $end_version = $this->version;
            $upgrade = 0;
            if (intval($current_version)!=intval($this->version)){
                $upgrade = 1;
				//var_dump($end_version);
                $end_version = $this->upgrades[$this->version];
                $main_upgrade = intval($current_version).'-'.intval($this->version);                
            }
            
            $direction = version_compare($current_version, $end_version);
			//var_dump($current_version,$end_version);
            while($this->versions[$index] != $end_version){
                $from_version = $this->versions[$index];
                $index -= $direction;
                $to_version = $this->versions[$index];
                print $from_version.'-'.$to_version."<br>\n";
                $sql = JFile::read(JPATH_ROOT.'/administrator/components/com_jshopping/addons/addon_backup/sql/'.$from_version.'-'.$to_version.'.sql');
                foreach($this->_db->splitSql($sql) as $query){
                    $this->executeQuery($query);
                }
            }
            if ($upgrade){
                $sql = JFile::read(JPATH_ROOT.'/administrator/components/com_jshopping/addons/addon_backup/sql/'.$main_upgrade.'.sql');
                foreach($this->_db->splitSql($sql) as $query){
                    $this->executeQuery($query);
                }
            }
            
        }else{
            JFactory::getApplication()->enqueueMessage(JText::sprintf('JSHOPPING_ADDON_BACKUP_CANNOT_CONVERT_ERROR', $this->getCurrentVersion()), 'warning');
        }
        //die;
        $this->saveTables();
        extract(__(get_defined_vars(), 'After'));
    }

    protected function executeQuery($query)
    {
        extract(__(get_defined_vars(), 'Before'));
        $query = trim($query);        
        if($query != '' && substr($query, 0, 2) != '//')
        {            
            $this->_db->setQuery(str_replace('#__', '_'.$this->_db->getPrefix(), $query));
            if($result = $this->_db->query())
            {
                if(preg_match("/ALTER\s+TABLE\s*(\S+)\s*(\w+)\s+COLUMN\s*(\S+)\s*(.*?);/i", $query, $matches))
                {
                    $table = trim($matches[1], "'\"` ");
                    $action = trim($matches[2], "'\"` ");
                    $column = trim($matches[3], "'\"` ");
                    $signature = trim($matches[4], "'\"` ");
                    extract(__(get_defined_vars(), 'AlterTable'));
                }
            }
            else
            {
                JFactory::getApplication()->enqueueMessage($this->_db->getErrorMsg(), 'error');
            }
        }
        extract(__(get_defined_vars(), 'After'));
        return $result;
    }

    public function getCurrentVersion()
    {
        extract(JApplicationHelper::parseXMLInstallFile(JPATH_ROOT.'/administrator/components/com_jshopping/jshopping.xml'));
        extract(__(get_defined_vars()));
        return $version;
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_jshopping.backup', 'backup', array('control' => 'jform', 'load_data' => $loadData));
        if(empty($form))
        {
            return false;
        }
        return $form;
    }

    protected function loadFormData()
    {
        extract(__(get_defined_vars(), 'Before'));
        $data = JFactory::getApplication()->getUserState('com_jshopping.edit.backup.data', array());
        extract(__(get_defined_vars(), 'After'));
        return $data;
    }

    public function delete(&$filenames)
    {
        extract(__(get_defined_vars(), 'Before'));
        $result = true;
        foreach((array)$filenames as $filename)
        {
            if(!JFile::delete($this->getBackupsPath().'/'.$filename))
            {
                $result = false;
            }
        }
        extract(__(get_defined_vars(), 'After'));
        return $result;
    }

    protected function saveBackupZIPArchive()
    {
        extract(__(get_defined_vars(), 'Before'));
        $zip = new ZipArchive();
        if($zip->open($this->getBackupPath().'.zip', ZipArchive::CREATE) === true)
        {
            foreach(JFolder::files($this->getBackupPath(), '.', true, true) as $file_path)
            {
                $file_path = JPath::clean($file_path);
                $zip->addFile($file_path, str_replace($this->getBackupPath().DIRECTORY_SEPARATOR, '', $file_path));
            }
            $zip->close();            
        }
        JFolder::delete($this->getBackupPath());
        extract(__(get_defined_vars(), 'After'));
   }

   public function getBackupsPath()
   {
       $backups_path = JPath::clean(JPATH_ROOT.'/backups');
       extract(__(get_defined_vars()));
       return $backups_path;
   }

   public function getBackupsURL()
   {
       $backups_url = JURI::root().'/backups/';
       extract(__(get_defined_vars()));
       return $backups_url;
   }

   public function getFilePaths()
   {
       $file_paths = $this->file_paths;
       extract(__(get_defined_vars()));
       return $file_paths;
   }
}
