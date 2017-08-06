<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');

class JshoppingViewAddon_langoverride extends JViewLegacy{

    function displayList($tpl = null){        
        parent::display($tpl);
	}
    
    function displayEdit($tpl = null){    
        JToolBarHelper::title(_LANGOVERRIDE, 'generic.png'); 
        JToolBarHelper::apply();
        parent::display($tpl);
    }
}
?>