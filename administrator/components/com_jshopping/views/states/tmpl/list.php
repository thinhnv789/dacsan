<?php
displaySubmenuOptions();
$rows = $this->rows;
$pageNav = $this->pageNav;
$i = 0;
?>
<form action = "index.php?option=com_jshopping&controller=states" method = "post" id="adminForm" name = "adminForm">

<table class = "adminlist">
	<tr>
    <td align="right">
        <h3> <?php print $this->country_active;?>  </h3>
    </td>  
		<td align="right">
			<?php print _JSHOP_LIST_COUNTRY; ?>: <?php print $this->filter['countries'];?> &nbsp;
            <?php print _JSHOP_SHOW; ?>: <?php print $this->filter['publish'];?> 
		</td>
	</tr>
</table>

<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
      #
    </th>
    <th width = "20">
      <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
    </th>
    <th align = "left">
      <?php echo _JSHOP_STATE; ?>
    </th>
    <th align = "left">
      <?php echo _JSHOP_COUNTRY; ?>
    </th>
    <th colspan = "3" width = "40">
      <?php echo _JSHOP_ORDERING; ?>
      <?php echo JHtml::_('grid.order',  $rows, 'filesave.png', 'saveorder');?>
    </th>
    <th width = "50">
      <?php echo _JSHOP_PUBLISH; ?>
    </th>
    <th width="50">
    	<?php print _JSHOP_EDIT; ?>
    </th>
	<th width = "50">
      <?php print _JSHOP_ID;?>
    </th>
  </tr>
</thead>
<?php
 $count = count($rows);
 foreach($rows as $row){
  ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $pageNav->getRowOffset($i);?>
   </td>
   <td>
       <?php echo JHtml::_('grid.id', $i, $row->state_id);?>
   </td>
   <td style="text-align: left;">
     <a href = "index.php?option=com_jshopping&controller=states&task=edit&state_id=<?php echo $row->state_id; ?>"><?php echo $row->name;?></a>
   </td>
   <td style="text-align: left;">
     <?php echo $row->country;?>
   </td>
   <td align = "right" width = "20">
    <?php
      if ($i != 0) echo '<a href = "index.php?option=com_jshopping&controller=states&task=order&id=' . $row->state_id . '&order=up&number=' . $row->ordering . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
    ?>
   </td>
   <td align = "left" width = "20">
      <?php
        if ($i != $count - 1) echo '<a href = "index.php?option=com_jshopping&controller=states&task=order&id=' . $row->state_id . '&order=down&number=' . $row->ordering . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
      ?>
   </td>
   <td align = "center" width = "10">
    <input type="text" name="order[]" id = "ord<?php echo $row->state_id;?>" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?> class="text_area" style="text-align: center; width: 50px;" />    
   </td>
   <td align="center">
     <?php
       echo $published = ($row->state_publish) ? ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'unpublish\')"><img src="components/com_jshopping/images/tick.png" title = "'._JSHOP_PUBLISH.'" ></a>') : ('<a href = "javascript:void(0)" onclick = "return listItemTask(\'cb' . $i . '\', \'publish\')"><img title = "'._JSHOP_UNPUBLISH.'" src="components/com_jshopping/images/publish_x.png"></a>');
     ?>
   </td>
	<td align="center">
		<a href='index.php?option=com_jshopping&controller=states&task=edit&state_id=<?php print $row->state_id;?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
	</td>
	<td align="center">
     <?php echo $row->state_id;?>
   </td>
  </tr>
<?php
$i++;  
}
?>
<tfoot>
<tr>
	<td colspan="11"><?php echo $pageNav->getListFooter();?></td>
</tr>
</tfoot>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>