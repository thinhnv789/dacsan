<div id = "qc_error" style="<?php echo (empty($this->qc_error)) ? 'display: none;' : '';?>"><?php echo (!empty($this->qc_error)) ? $this->qc_error : '';?></div>
<?php if (!empty($this->qc_error)) $this->session->clear('qc_error'); ?>

<?php print $this->small_cart; ?>
<br />
<table class="jshop">
<?php if (!$this->jshopConfig->without_shipping){?>  
  <tr>
    <td>
        <div class="delivery_time" id = "qc_delivery_time_block" style="text-align: right; <?php echo (!$this->delivery_time) ? 'display: none;' : '' ?>"><strong><?php print _JSHOP_DELIVERY_TIME?></strong>: <span id = "qc_delivery_time"><?php print $this->delivery_time?></span></div>
        <div class="delivery_date" id = "qc_delivery_date_block" style="text-align: right; <?php echo (!$this->delivery_date) ? 'display: none;' : '' ?>"><strong><?php print _JSHOP_DELIVERY_DATE?></strong>: <span id = "qc_delivery_date"><?php print $this->delivery_date?></span></div>
    </td>
  </tr>
<?php } ?>
    <tr>
        <td>
            <?php if ($this->jshopConfig->hide_payment_step) : ?>
                <div id = "qc_active_payment_block" style="text-align: right; <?php echo (!$this->active_payment) ? ' display: none;' : '' ?>"><strong><?php print _JSHOP_FINISH_PAYMENT_METHOD; ?></strong>: <span id = "qc_active_payment_name"><?php print $this->active_payment_name?></span></div>
            <?php endif; ?>
            <?php if ($this->jshopConfig->hide_shipping_step) : ?>
                <div id = "qc_active_shipping_block" style="text-align: right; <?php echo (!$this->active_shipping) ? ' display: none;' : '' ?>"><strong><?php print _JSHOP_FINISH_SHIPPING_METHOD; ?></strong>: <span id = "qc_active_shipping_name"><?php print $this->active_shipping_name?></span></div>
            <?php endif; ?>
        </td>
    </tr>
</table>
<script type="text/javascript">
    var qc_ajax_link = '<?php echo SEFLink('index.php?option=com_jshopping&controller=qcheckout&task=ajaxRefresh',0,1); ?>';
    function quickCheckoutCheckFormData(){
        var error = false;
        if (!validateCheckoutAdressForm('<?php print $this->live_path ?>', 'quickCheckout')){
            error = true;
        }
        <?php if ($this->jshopConfig->display_agb) : ?>
            if (!checkAGB()) {
                error = true;
            }
        <?php endif; ?>
        <?php if ($this->no_return) : ?>
            if (!checkNoReturn()) {
                error = true;
            }
        <?php endif; ?>
        <?php if (!$this->jshopConfig->hide_shipping_step && !$this->jshopConfig->without_shipping) : ?>
            if (!validateShippingMethods()){
                error = true;
            }
        <?php endif; ?>
        <?php if (!$this->jshopConfig->hide_payment_step && !$this->jshopConfig->without_payment) : ?>
            if (!error){
                if (!checkPaymentForm()){
                    error = true;
                }
            }
        <?php endif; ?>

        if (!error) $_('payment_form').submit();
    }
</script>
<?php 
    $config_fields = $this->config_fields;
    include(JPATH_COMPONENT_SITE."/templates/".$this->jshopConfig->template."/checkout/adress.js.php");
?>
<form action = "<?php print $this->action ?>" method = "post" id = "payment_form" name = "quickCheckout">
    <fieldset class = "quick_checkout">
        <legend><?php echo _JSHOP_CHECKOUT_ADDRESS; ?></legend>
        <div id = "qc_address">
            <?php require_once 'address.php'; ?>
        </div>
    </fieldset>
    
    <?php if ($this->jshopConfig->step_4_3) : ?>
        <?php if ($this->delivery_step) : ?>
            <fieldset class = "quick_checkout">
                <legend><?php echo _JSHOP_CHECKOUT_SHIPPING; ?></legend>
                <div id = "qc_shippings_methods">
                    <?php require_once 'shippings.php'; ?>
                </div>
            </fieldset>
        <?php elseif (!$this->delivery_step && isset($this->active_sh_pr_method_id)) : ?>
            <input type = "hidden" name = "sh_pr_method_id" value = "<?php echo $this->active_sh_pr_method_id; ?>" id = "qc_sh_pr_method_id" />
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($this->payment_step) : ?>
        <fieldset class = "quick_checkout">
            <legend><?php echo _JSHOP_CHECKOUT_PAYMENT; ?></legend>
            <div id = "qc_payments_methods">
                <?php require_once 'payments.php'; ?>
            </div>
        </fieldset>
    <?php elseif (!$this->payment_step && isset($this->active_payment_class)) : ?>
        <input type = "hidden" name = "payment_method" value = "<?php echo $this->active_payment_class; ?>" id = "qc_payment_method_class" />
    <?php endif; ?>
        
    <?php if (!$this->jshopConfig->step_4_3) : ?>
        <?php if ($this->delivery_step) : ?>
            <fieldset class = "quick_checkout">
                <legend><?php echo _JSHOP_CHECKOUT_SHIPPING; ?></legend>
                <div id = "qc_shippings_methods">
                    <?php require_once 'shippings.php'; ?>
                </div>
            </fieldset>
        <?php elseif (!$this->delivery_step && isset($this->active_sh_pr_method_id)) : ?>
            <input type = "hidden" name = "sh_pr_method_id" value = "<?php echo $this->active_sh_pr_method_id; ?>" id = "qc_sh_pr_method_id" />
        <?php endif; ?>
    <?php endif; ?>
        
    <?php require_once 'previewfinish.php'; ?>
    <div style="margin-top: 5px; text-align: center;"><input type = "button" name = "save" value = "<?php print _JSHOP_ORDER_FINISH ?>" class = "button" onclick = "quickCheckoutCheckFormData();" /></div>
</form>
