<?php defined('_JEXEC') or die?>
<script type="text/javascript">
    Joomla._submitform = Joomla.submitform;
    Joomla.submitform = function(task, form){
        form = $('adminForm');
        if(task == 'add')form.controller.value = 'backup';
        Joomla._submitform(task, form);
    };
</script>

<?php
	$classMain = '';
	if(class_exists('JHtmlSidebar') && count(JHtmlSidebar::getEntries()))
		$sidebar = JHtmlSidebar::render();
	if($sidebar): $classMain = ' class="span10 jshop_edit"';
?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $sidebar; ?>
	</div>
<?php endif; ?>
<div id="j-main-container"<?php echo $classMain;?>>

<form action="<?php echo JRoute::_('index.php?option=com_jshopping')?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist table table-striped">
		<thead>
			<tr>
				<th class="center" width="16"><input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" /></th>
                <th class="left"><?php echo JText::_('JSHOPPING_ADDON_BACKUP_FILENAME')?></th>
                <th class="center" width="80"><?php echo JText::_('JSHOPPING_ADDON_BACKUP_SIZE')?></th>
				<th class="center" width="200"><?php echo JText::_('JSHOPPING_ADDON_BACKUP_CREATED')?></th>
			</tr>
		</thead>
		<tbody>
		    <?php foreach ($this->items as $i => $item){?>
			    <tr class="row<?php echo $i % 2?>">
				    <td class="center"><?php echo JHtml::_('grid.id', $i, $item->filename)?></td>
                    <td class="left"><a href="<?php echo $item->link?>"><?php echo $item->filename?></a></td>
                    <td class="center"><?php echo JHtml::_('number.bytes', $item->size)?></td>
				    <td class="center"><?php echo strftime('%d.%m.%Y %H:%M:%S', $item->created)?></td>
			    </tr>
		    <?php }?>
		</tbody>
        <tfoot><tr><td colspan="4"><?php echo $this->pagination->getListFooter()?></td></tr></tfoot>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="controller" value="backups" />
		<?php echo JHtml::_('form.token')?>
	</div>
</form>
</div>