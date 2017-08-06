<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerAddon_langoverride extends JControllerLegacy{
    
    function __construct( $config = array() )
    {
        parent::__construct( $config );
        
        $this->registerTask( 'apply', 'save' );
        checkAccessController("addon_langoverride");
        JSFactory::loadExtAdminLanguageFile('addon_langoverride');
        addSubmenu("other");
    }
	
	function display($cachable = false, $urlparams = false) {
        $langovertb = JTable::getInstance('addon_langoverride', 'jshop');
        $langoverlist = $langovertb->getLangoverrideList();	
        
        $_lang = $this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        $multilang = count($languages)>1;
        
		$view = $this->getView("addon_langoverride", 'html');
        $view->setLayout("edit");
        $view->assign('languages', $languages);
        $view->assign('langoverlist', $langoverlist);
        $view->assign('multilang', $multilang);
        $view->displayEdit();
	}
	
	function save()
    {
        $db = JFactory::getDBO(); 
        $post = JRequest::get("post");
        
        $_lang = $this->getModel("languages");
        $languages = $_lang->getAllLanguages(1);
        
        $query = "DELETE FROM #__jshopping_langoverride";
        $db->setQuery($query);
        $db->query();
        
        $field_name1 = "title_";
        $field_name2 = "value_";

        $first_lang = $languages[0]->language;
        $count_rows = count($post[$field_name1.$first_lang]);
        
        $data = array();
        for($i=0; $i<$count_rows; $i++)
        {
            foreach($languages as $lang)
            {
                $langtag = $lang->language;
                
                $data[$field_name1.$langtag] = $post[$field_name1.$langtag][$i];
                $data[$field_name2.$langtag] = $post[$field_name2.$langtag][$i];
            }
            
            $langovertb = JTable::getInstance('addon_langoverride', 'jshop');
            
            if (!$langovertb->save($data))
            {
                JError::raiseWarning("", _JSHOP_ERROR_BIND);
                $this->setRedirect("index.php?option=com_jshopping&controller=addon_langoverride");
                return 0;
            }
        }
        
        jimport('joomla.filesystem.file');
        
        foreach($languages as $lang)
        {
            $data = "<?php \n";
            for($i=0; $i<$count_rows; $i++)
            {
                $langtag = $lang->language;
                $data .= "define('".$post[$field_name1.$langtag][$i]."', '".$post[$field_name2.$langtag][$i]."'); \n";
            }
            $data .= " ?>";
            
            $file = JPATH_ROOT."/components/com_jshopping/lang/override/".$langtag.".php";
            JFile::write($file, $data); 
        }
        
        $this->setRedirect("index.php?option=com_jshopping&controller=addon_langoverride");
	}
}
?>