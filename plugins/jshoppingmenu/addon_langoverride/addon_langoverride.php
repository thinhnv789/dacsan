<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgJshoppingMenuAddon_langoverride extends JPlugin {
	function __construct(& $subject, $config){
		parent::__construct($subject, $config);
		JSFactory::loadExtAdminLanguageFile('addon_langoverride');
	}
	
	function onBeforeAdminOptionPanelMenuDisplay(&$menu) {
		$menu['addon_langoverride'] = array(_LANGOVERRIDE, 'index.php?option=com_jshopping&controller=addon_langoverride', 'jshop_languages_b.png', 1);
	}
	
	function onBeforeAdminOptionPanelIcoDisplay(&$menu) {
		$menu['addon_langoverride'] = array(_LANGOVERRIDE, 'index.php?option=com_jshopping&controller=addon_langoverride', 'jshop_languages_b.png', 1);
	}
}
?>