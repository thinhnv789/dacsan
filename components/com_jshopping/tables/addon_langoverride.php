<?php
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.model');

class jshopAddon_langoverride extends JTableAvto{
    
    function __construct( &$_db ){
        parent::__construct('#__jshopping_langoverride', 'id', $_db );
    }
    
    public function getLangoverrideList()
    {
        $db = JFactory::getDBO(); 
        
        $query = "SELECT * FROM  #__jshopping_langoverride";
        $db->setQuery($query);
        
        return $db->loadAssocList();        
    }
}
?>