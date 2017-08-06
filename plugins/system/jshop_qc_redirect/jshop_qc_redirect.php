<?php
defined('_JEXEC') or die('Restricted access');

class plgSystemJshop_QC_Redirect extends JPlugin{

    public function __construct(&$subject, $config = array()) {
        parent::__construct($subject, $config);
        
    }
    
    public function onAfterRoute(){
        $app = JFactory::getApplication();

        if ($app->getName() != 'site') {
                return true;
        }
        
        $plugin = JPluginHelper::getPlugin('jshoppingcheckout', 'quick_checkout');
        
        if (isset($plugin->name) && !empty($plugin->name)){
            if (!class_exists('JSFactory')){
                require_once(JPATH_ROOT."/components/com_jshopping/lib/factory.php");
            }
			if (!JRequest::getInt('no_lang')){
				JSFactory::loadLanguageFile();
			}
            $jshopConfig = JSFactory::getConfig();
            $router = $app->getRouter();
            $item = $app->getMenu()->getItem($router->getVar('Itemid'));            
            
            $option = $router->getVar('option'); 
            $controller = $router->getVar('controller'); 
            $task = $router->getVar('task'); 
            
            if (empty($option) && isset($item->query['option'])){
                $option = $item->query['option']; 
            }
            
            if (empty($controller) && isset($item->query['controller'])){
                $controller = $item->query['controller']; 
            }
            
            if (empty($task) && isset($item->query['task'])){
                $task = $item->query['task']; 
            }
            
            if ($option == 'com_jshopping' && $controller == 'checkout' && 
                    (empty($task) || $task == 'step2' || $task == 'step3' || $task == 'step4' || $task == 'step5' 
                    || $task == 'display' || $task == 'step2save' || $task == 'step3save' || $task == 'step4save' || $task == 'step5save')){
                
                $app->redirect(SEFLink('index.php?option=com_jshopping&controller=qcheckout',1,1,$jshopConfig->use_ssl));
                return 0;
            }
        }
    }
}