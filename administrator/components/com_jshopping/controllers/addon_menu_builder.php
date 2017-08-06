<?php
/**
* @version      4.1.0 28.02.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2012 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerAddon_menu_builder extends JControllerLegacy{
    function __construct( $config = array() ){
		error_reporting(error_reporting() & ~E_NOTICE);
        parent::__construct( $config );
        checkAccessController("addon_menu_builder");
		$this->registerTask( 'add',   'edit' );
        $this->registerTask( 'apply', 'save' );
        addSubmenu("menu_builder");
		
		$language = JFactory::getLanguage();
		$language->load('com_menus', JPATH_ADMINISTRATOR, $language->getTag(), true);
		$language->load('com_jshopping_addon_menu_builder', JPATH_ADMINISTRATOR, $language->getTag(), true);
		
		define('ANY_LEVEL', -1);
		define('ANY_MENUTYPE', '');
		define('ANY_PUBLISHING', '*');
		define('ANY_LANGUAGE', -1);
		define('PUBLISHED', 1);
		define('UNPUBLISHED', 0);
		define('TRASHED', -2);
		define('ORDERING_FIRST', -1);
		define('ORDERING_LAST', -2);
    }

    function display($cachable = false, $urlparams = false){
        jimport('joomla.html.pagination');
		$mainframe =  JFactory::getApplication();
		$context = 'jshoping.list.admin.menu_builder';
        $limit = $mainframe->getUserStateFromRequest($context.'limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
        $limitstart = $mainframe->getUserStateFromRequest($context.'limitstart', 'limitstart', 0, 'int' );
		
		if (isset($_GET['start']) && $_GET['start']==='1'){
            $mainframe->setUserState( $context.'menutype', ANY_MENUTYPE);
            $mainframe->setUserState( $context.'published', '');
			$mainframe->setUserState( $context.'language', ANY_LANGUAGE);
        }
		$menutype = $mainframe->getUserStateFromRequest( $context.'menutype', 'filter_menutype', ANY_MENUTYPE);
        $published = $mainframe->getUserStateFromRequest( $context.'published', 'filter_published', '');
        $language = $mainframe->getUserStateFromRequest( $context.'language', 'filter_language', ANY_LANGUAGE);
        
		$menu_model = $this->getModel('addon_menu_builder');
		
		$filter = array();
		$filter['menutype'] = $menu_model->getMenuLocationSelect($menutype, 'selectbox input-large', 'filter_menutype', true, '- '.JText::_('COM_MENUS_ITEM_FIELD_ASSIGNED_LABEL').' -');
		$filter['published'] = $menu_model->getStatusSelect($published, 'selectbox input-medium', 'filter_published', true, '- '.JText::_('JSTATUS').' -');
		$filter['language'] = $menu_model->getLanguageSelect($language, 'selectbox input-medium', 'filter_language', true, '- '._JSHOP_LANGUAGE_NAME.' -');
		
		$total = $menu_model->getCountAllItems($published, $menutype, $language);
        $pagination = new JPagination($total, $limitstart, $limit);
		$rows = $menu_model->getAllItems($pagination->limitstart, $pagination->limit, ANY_LEVEL, $published, $menutype, $language);
		
		$view= $this->getView('addon_menu_builder_list', 'html');
		$view->setLayout('list');
		$view->assign('rows', $rows);
		$view->assign('filter', $filter);
		$view->assign('pagination', $pagination);
		$view->display(); 
    }
	
	function edit() {
		$id = JRequest::getInt('id', 0);
		$edit = ($id)?($edit = 1):($edit = 0);
		$menu_model = $this->getModel('addon_menu_builder');
		
		$menu_item = $menu_model->getMenuItem($id);
		
		$view= $this->getView('addon_menu_builder_edit', 'html');
		$view->setLayout('edit');
		$view->assign('item', $menu_item);
		$view->assign('edit', $edit);
		$view->display(); 
	}
	
	function save() {
		$id = JRequest::getInt('id', 0);
		$data = JRequest::get('post');
		
		$menu_model = $this->getModel('addon_menu_builder');
		$menu_model->updateParamsForMenu($data);
		
		$text = '';
		if (($id = $menu_model->saveMenuItem($id, $data)) !== false) {
			$text .= JText::_('COM_MENUS_MENU_ITEM_SAVE_SUCCESS');
		} else {
			$this->edit();
			return 0;
		}
		
		if ($this->getTask()=='apply'){
			$this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder&task=edit&id='.$id, $text);
		} else {
			$this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder', $text);
		}
	}
	
	function remove() {
		$db = JFactory::getDBO();
		$text = '';
		$cid = JRequest::getVar('cid');
		$table = JTable::getInstance('Menu', 'JTable');
		foreach ($cid as $v) {
			if ($table->delete($v)) {
				$text .= 'ID '.$v.': '.JText::_("COM_JSHOP_MENU_BUILDER_DELETE_OK").'<br/>';
			} else {
				$text .= 'ID '.$v.': '.JText::_("COM_JSHOP_MENU_BUILDER_DELETE_ERROR").'<br/>';
			}
		}
		$this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder', $text);
	}
	
	function trash() {
		$this->_publishProduct(-2);
        $this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder');
	}
	
	function publish(){
        $this->_publishProduct(1);
        $this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder');
    }
    
    function unpublish(){
        $this->_publishProduct(0);
        $this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder');
    }    
    
    function _publishProduct($flag) {
        $jshopConfig = JSFactory::getConfig();
        $db = JFactory::getDBO();
        $cid = JRequest::getVar('cid');
        $user = JFactory::getUser();
		$table = JTable::getInstance('Menu', 'JTable');
		$table->publish($cid, $flag, $user->id);
		
		$count = count($cid);
		if ($flag == 1) {
			$ntext = ($count > 1) ? 'COM_MENUS_N_ITEMS_PUBLISHED' : 'COM_MENUS_N_ITEMS_PUBLISHED_1';
		} elseif ($flag == -2) {
			$ntext = JText::_("COM_JSHOP_MENU_BUILDER_TRASH_OK");
		} else {
			$ntext = ($count > 1) ? 'COM_MENUS_N_ITEMS_UNPUBLISHED' : 'COM_MENUS_N_ITEMS_UNPUBLISHED_1';
		}
		$this->setMessage(sprintf(JText::_($ntext), $count));
    }
	
	function setDefault() {
		$this->_setDefault(1);
        $this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder');
	}
	
	function unsetDefault() {
		$this->_setDefault(0);
        $this->setRedirect('index.php?option=com_jshopping&controller=addon_menu_builder');
	}
	
	function _setDefault($value) {
		$cid = JRequest::getVar('cid', array(), '', 'array');
		if (empty($cid)) {
			JError::raiseWarning(500, JText::_('COM_MENUS_NO_ITEM_SELECTED'));
		} else {
			$menu_model = $this->getModel('addon_menu_builder');
			JArrayHelper::toInteger($cid);
			if (!$menu_model->setHome($cid, $value)) {
				JError::raiseWarning(500, JText::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'));
			} else {
				$ntext = ($value == 1) ? 'COM_MENUS_ITEMS_SET_HOME' : 'COM_MENUS_ITEMS_UNSET_HOME';
				$this->setMessage(JText::plural($ntext, count($cid)));
			}
		}
	}
	
	function getAjaxParams() {
		$id = JRequest::getVar('jshop_id');
		$menu_model = $this->getModel("addon_menu_builder");
		$item_obj = $menu_model->getJshoppingMenu($id);
		$result = array();
		if (is_object($item_obj) && ($item_obj->id)) {
			$result['html'] = $menu_model->getHtmlForItem($item_obj);
		}
		echo json_encode($result);
		die;
	}
}
?>