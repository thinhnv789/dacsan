<?php
    defined('_JEXEC') or die;
    JHtml::_('behavior.tooltip');
    JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
    Joomla._submitform = Joomla.submitform;
    Joomla.submitform = function(task, form){
        if(!form)
        {
            form = $('adminForm');
        }
        if(document.formvalidator.isValid(form))
        {
            Joomla._submitform(task, form);
        }
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_jshopping&controller=backup')?>" method="post" name="adminForm" id="adminForm" class="form-validate">
    <div class="width-40 fltlft form-horizontal">
        <fieldset class="panelform">
            <?php foreach ($this->form->getFieldset() as $field){?>
                <div class="control-group">
                    <div class="control-label"><?php echo $field->label?></div>
                    <div class="controls"><?php echo $field->input?></div>
                </div>
            <?php }?>
        </fieldset>
        <input type="hidden" name="task" value="save" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
    <div class="clr"></div>
</form>