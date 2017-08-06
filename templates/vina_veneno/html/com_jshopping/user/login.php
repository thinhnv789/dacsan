<?php 
/**
* @version      4.3.1 13.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<div class = "jshop account-login">
    <div class="vina-title">		
		<h1 class="header">
			<span><?php print _JSHOP_LOGIN ?></span>
		</h1>	
	</div>
    <?php if ($this->config->shop_user_guest && $this->show_pay_without_reg) : ?>
        <span class = "text_pay_without_reg"><?php print _JSHOP_ORDER_WITHOUT_REGISTER_CLICK?> <a href="<?php print SEFLink('index.php?option=com_jshopping&controller=checkout&task=step2',1,0, $this->config->use_ssl);?>"><?php print _JSHOP_HERE?></a></span>
    <?php endif; ?>
    
    <div class = "row-fluid">
		<div class = "span6 new-users">
			<div class="content">
				<h2><?php print _JSHOP_HAVE_NOT_ACCOUNT ?></h2>
				<p><?php echo JText::_('VINA_REGISTER_DES') ?></p>
			</div>
			<?php if (!$this->config->show_registerform_in_logintemplate){?>
			<div class="buttons-set">
				<button type="button" title="Create an Account" class="vina-button" onclick="window.location='<?php print $this->href_register ?>'"><span><span><?php print _JSHOP_REGISTRATION ?></span></span></button>
			</div>
			<?php }else{?>
				<?php $hideheaderh1 = 1; include(dirname(__FILE__)."/register.php"); ?>
			<?php }?>
        </div>
        <div class = "span6 login-users">
			<form method = "post" action="<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=loginsave', 1,0, $this->config->use_ssl)?>" name = "jlogin" class = "form-horizontal">
			<div class="content">
				<h2><?php print _JSHOP_HAVE_ACCOUNT ?></h2>
				<p><?php echo JText::_('VINA_LOGIN_DES') ?></p>
				<ul class="form-list">
					<li>
						<label class="required"><em>*</em><?php print _JSHOP_USERNAME ?>:</label>
						<div class="input-box">
							<input type = "text" name = "username" value = "" class = "inputbox" />
						</div>
					</li>
					<li>
						<label class="required"><em>*</em><?php print _JSHOP_PASSWORT ?>:</label>
						<div class="input-box">
							<input type = "password" name = "passwd" value = "" class = "inputbox" />
						</div>
					</li>
					<li>
						<input type = "checkbox" name = "remember" id = "remember_me" value = "yes" /> <label for = "remember_me"><?php print _JSHOP_REMEMBER_ME ?></label>
					</li>
                </ul>
             
			</div>
			<div class="buttons-set">
				<a href="<?php print $this->href_lost_pass ?>" class="pull-right"><?php print _JSHOP_LOST_PASSWORD ?></a>
				<button type="submit" class="vina-button" title="Login" name="send" id="send2"><span><span><?php print _JSHOP_LOGIN ?></span></span></button>
			</div>
			<input type = "hidden" name = "return" value = "<?php print $this->return ?>" />
			<?php echo JHtml::_('form.token');?>
			</form> 
        </div>        
    </div>
</div>    