<?php
defined('_JEXEC') or die('Restricted access');

class plgJshoppingRouterQuick_Checkout extends JPlugin{

    public function __construct(&$subject, $config = array()) {
        parent::__construct($subject, $config);
        
    }
    
    public function onBeforeBuildRoute(&$query, &$segments){
        $db = JFactory::getDbo();
        $jshopConfig = JSFactory::getConfig();
        $current_lang = $jshopConfig->cur_lang;
        $user = JFactory::getUser();
        $groups = implode(',', $user->getAuthorisedViewLevels());
        
        $db->setQuery("SELECT id, link FROM #__menu WHERE `type` = 'component' AND published = 1 AND link like '%option=com_jshopping&controller=qcheckout%' AND client_id = 0 AND (language='*' OR language='".$current_lang."') AND access IN (".$groups.") LIMIT 1");
        $item = $db->loadObject();

        if (isset($query['controller']) && $query['controller'] == "qcheckout" && $item instanceof stdClass && isset($item->id) && $item->id){
            $query['Itemid'] = $item->id;
            unset($query['controller']);
        }
    }
    
    public function onBeforeParseRoute(&$vars, &$segments){
        $menu = JFactory::getApplication()->getMenu();    
        $menuItem = $menu->getActive();
        if (isset($menuItem->query['controller']) && $menuItem->query['controller'] == "qcheckout"){
            $segments[1] = $segments[0];
            $segments[0] = 'qcheckout';
        }
    }
}