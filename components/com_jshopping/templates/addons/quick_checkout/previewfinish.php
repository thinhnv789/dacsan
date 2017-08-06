<div class="jshop">
<?php print $this->_tmp_ext_html_previewfinish_start?>
<table class = "jshop" align="center" style="width:auto;margin-left:auto;margin-right:auto;">
    <tr>
        <td>
           <?php print _JSHOP_ADD_INFO ?><br />
           <textarea class = "inputbox" id = "order_add_info" name = "order_add_info"></textarea>
        </td>       
    </tr>
    <?php if ($this->jshopConfig->display_agb){?>
    <tr>
        <td>
            <div class="row_agb">            
            <input type = "checkbox" name="agb" id="agb" />        
            <a class = "policy" href="#" onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=agb&tmpl=component', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;"><?php print _JSHOP_AGB;?></a>
            <?php print _JSHOP_AND;?>
            <a class = "policy" href="#" onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=return_policy&tmpl=component&cart=1', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;"><?php print _JSHOP_RETURN_POLICY?></a>
            <?php print _JSHOP_CONFIRM;?>        
            </div>
        </td>
    </tr>
    <?php }?>
    <?php if($this->no_return){?>
     <tr>
        <td>
            <div class="row_no_return">            
            <input type = "checkbox" name="no_return" id="no_return" />        
            <?php print _JSHOP_NO_RETURN_DESCRIPTION;?>     
            </div>
        </td>
     </tr>     
     <?php }?>
     <?php print $this->_tmp_ext_html_previewfinish_agb?>
</table>
<?php print $this->_tmp_ext_html_previewfinish_end?>
</div>