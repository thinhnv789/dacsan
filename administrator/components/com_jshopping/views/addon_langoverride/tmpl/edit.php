<?php 
JHTML::_('behavior.modal', 'a.modal');
JHTML::_('behavior.modal', 'a.modal-button');
jimport('joomla.html.pane');

if(class_exists('JHtmlSidebar') && count(JHtmlSidebar::getEntries()))
	$sidebar = JHtmlSidebar::render();
?>
<?php if ($sidebar){?>
<div id="j-sidebar-container" class="span2">
    <?php echo $sidebar; ?>
</div>
<div id="j-main-container" class="span10 jshop_edit">
<?php }else{?>
<div id="j-main-container" class="jshop_edit">
<?php }?>
<?php displaySubmenuOptions();?>
<form action = "index.php?option=com_jshopping&controller=addon_langoverride" method = "post" enctype="multipart/form-data" name = "adminForm" id= "adminForm">

<div class="col100">
<fieldset class="adminform">
    <?php if ( version_compare(JVERSION, '3.0.0', '<') ) {
        $pane = JPane::getInstance('Tabs');
        echo $pane->startPane('catPane');
    } ?>	
	<?php if ( version_compare(JVERSION, '3.0.0', '>=')){?>
	<ul class="nav nav-tabs">
		<?php $i=0; foreach($this->languages as $lang) {
		$i++;
		$name_pane = $lang->name;
		$name_pane.=" (".$lang->lang.")".'<img class = "tab_image" border = "0" src = "'.JURI::root().'/administrator/components/com_jshopping/images/flags/'.$lang->lang.'.gif" />';
		?>
	   <li <?php if ($i==1){?>class="active"<?php }?>>
		   <a href="#panelang<?php print $lang->language?>" data-toggle="tab"><?php echo $name_pane; ?></a>
	   </li>
	   <?php } ?>
   </ul>
   <div id="editdata-document" class="tab-content">
   <?php } ?>
   
   <?php
   $i=0;
   foreach($this->languages as $lang){
       $i++;
       $name = "title_".$lang->language;
       $description = "value_".$lang->language;
       
       $name_pane = $lang->name; 
       $name_pane.=" (".$lang->lang.")".'<img class = "tab_image" border = "0" src = "' . JURI::root() . '/administrator/components/com_jshopping/images/flags/' . $lang->lang . '.gif" />';
       
       if ( version_compare(JVERSION, '3.0.0', '<') ) {
            echo $pane->startPanel($name_pane, $lang->lang.'-page');
            echo '<div id="panelang'.$lang->language.'">';
       } else { ?>       
       <div id="panelang<?php print $lang->language?>" class="tab-pane <?php if ($i==1) print 'active'?>">
       <?php } ?>
            <div class="col100">
             <table class="lang-list-item" class="admintable" width = "50%" >    
                 <?php $k=0; foreach($this->langoverlist as $langol) { $k++; ?>
                    <tr id="" class="lang-item-tr<?php echo $k; ?>">
                      <td class="key" width="20%">
                        <input type = "text" class = "inputbox" name = "<?php print $name?>[]" value = "<?php echo $langol["$name"]; ?>" style="width:300px;"/>
                      </td>
                      <td class="key" width="50%">
                        <input  type = "text" class = "inputbox" name = "<?php print $description?>[]" value = "<?php echo $langol["$description"]; ?>" style="width:600px;"/>
                      </td>
                      <td class="key" width="30%">
                          <a class="delete-lang-item icon-unpublish" href="#">&nbsp;<?php echo _DELETE; ?></a> 
                      </td>
                    </tr>   
                <?php } ?>
             </table>
            </div>
        <?php if ( version_compare(JVERSION, '3.0.0', '>=') ) {
            echo "</div>";
        } else { ?>
         </div>      
         <div class="clr"></div>      
         <?php echo $pane->endPanel();
		}
    }?>
	<?php if ( version_compare(JVERSION, '3.0.0', '<') ) {
        echo $pane->endPane(); 
	}else{
		print '<div>';
	}
	?>
</fieldset>
</div>
<div class="clr"></div>

<div style="margin-top:10px;;"> 
    <a id="add-lang-item" class="icon-new" href="#">&nbsp;<?php echo _ADD; ?></a>
</div>

<table style="display:none;">
    <tr id="lang-item-tr" class="lang-item-tr">
      <td class="key">
        <input type="text" class="inputbox name" style="width:300px;" />
      </td>
      <td class="key">
        <input type="text" class="inputbox desc" style="width:600px;" />
      </td>
      <td class="key">
          <a class="delete-lang-item icon-unpublish" href="#">&nbsp;<?php echo _DELETE; ?></a> 
      </td>
    </tr>
</table>

<input type = "hidden" name = "task" value = "" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
</form>
</div>

<script type="text/javascript">
    jQuery(document).ready(function()
    {
        var languages = new Array();
        <?php $i=-1; foreach($this->languages as $lang){ $i++; ?>
            languages[<?php echo $i; ?>] = "<?php echo $lang->language; ?>";
        <?php } ?>
            
        var counter_item_tr = 0;
        jQuery("#add-lang-item").click(function()
        {
            counter_item_tr++;
            var lang_item_tr_class = "lang-item-tr-add-" + counter_item_tr;

            for(var i=0; i<languages.length; i++) 
            {
                var lan_tr = jQuery("#lang-item-tr").clone(true);
                lan_tr.attr("id", "");
                lan_tr.attr("class", lang_item_tr_class);
                lan_tr.children().children(".name").attr("name", "title_" + languages[i] + "[]");
                lan_tr.children().children(".desc").attr("name", "value_" + languages[i] + "[]");

                jQuery("#panelang" + languages[i] + " .lang-list-item").append(lan_tr);
            }
        });

        jQuery(".delete-lang-item").click(function()
        {
            var attr_class = jQuery(this).parent().parent().attr("class");
            jQuery("." + attr_class).remove();
        });
    });
</script>