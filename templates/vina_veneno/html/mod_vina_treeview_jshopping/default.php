<?php
/*
# ------------------------------------------------------------------------
# Module: Vina Treeview for JoomShopping
# ------------------------------------------------------------------------
# Copyright (C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://VinaGecko.com
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addScript(JURI::base() . 'modules/mod_vina_treeview_jshopping/assets/js/jquery.cookie.js');
$document->addScript(JURI::base() . 'modules/mod_vina_treeview_jshopping/assets/js/jquery.treeview.js');
$document->addStyleSheet(JURI::base() . 'modules/mod_vina_treeview_jshopping/assets/css/jquery.treeview.css');
?>
<div id="vina-treeview-jshopping<?php echo $module->id; ?>" class="vina-treeview-jshopping">
	<?php if($params->get('showControl', 1)) { ?>
	<div id="vina-treeview-treecontrol<?php echo $module->id; ?>" class="treecontrol">
        <a href="#" title="<?php echo JTEXT::_('Collapse the entire tree below'); ?>"><?php echo JTEXT::_('Collapse All'); ?></a> | 
        <a href="#" title="<?php echo JTEXT::_('Expand the entire tree below'); ?>"><?php echo JTEXT::_('Expand All'); ?></a> | 
        <a href="#" title="<?php echo JTEXT::_('Toggle the tree below, opening closed branches, closing open branches'); ?>"><?php echo JTEXT::_('Toggle All'); ?></a>
    </div>
	<?php } ?>
	
	<ul class="level0 <?php echo $params->get('moduleStyle', ''); ?>">
		<?php require JModuleHelper::getLayoutPath('mod_vina_treeview_jshopping', 'default_items'); ?>
	</ul>
</div>
<script type="text/javascript">
jQuery("#vina-treeview-jshopping<?php echo $module->id; ?> ul").treeview({
	animated: 	"<?php echo $params->get('animated', 1); ?>",
	persist: 	"<?php echo $params->get('persist', 'cookie'); ?>",
	collapsed: 	<?php echo $params->get('collapsed', 1) ? "true" : "false"; ?>,
	unique:		<?php echo $params->get('unique', 1) ? "true" : "false"; ?>,
	<?php if($params->get('showControl', 1)) { ?>
	control: "#vina-treeview-treecontrol<?php echo $module->id; ?>",
	<?php } ?>
});
</script>