<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgJshoppingAdminAddon_admin_order_reload_shipping extends JPlugin {

	function onBeforeEditOrders($view){
		$jshopConfig = JSFactory::getConfig();
		$document = JFactory::getDocument();
		$script = "var live_patch = '".JURI::root()."';";
		$document->addScriptDeclaration($script);
		$document->addScript($jshopConfig->live_admin_path.'js/addon_admin_order_reload_shipping.js');
	}
}
?>