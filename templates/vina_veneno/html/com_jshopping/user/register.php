<?php 
/**
* @version      4.3.2 18.08.2013
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/
defined('_JEXEC') or die('Restricted access');
?>
<?php
$config_fields = $this->config_fields;
include(dirname(__FILE__)."/register.js.php");
?>
<div class="jshop account-create">
    <?php if (!isset($hideheaderh1)) : ?>
	<div class="vina-title">		
		<h1 class="header">
			<span><?php print _JSHOP_REGISTRATION;?></span>
		</h1>		
	</div>
    <?php endif; ?>
    
<form action = "<?php print SEFLink('index.php?option=com_jshopping&controller=user&task=registersave',1,0, $this->config->use_ssl)?>" class = "form-validate form-horizontal" method = "post" name = "loginForm" onsubmit = "return validateRegistrationForm('<?php print $this->urlcheckdata?>', this.name)" autocomplete="off">
    <?php echo $this->_tmpl_register_html_1?>
	<div class="fieldset">
		<h2 class="legend"><?php echo JText::_('VINA_REGISTER_INFO') ?></h2>
		<ul class="form-list">
			<?php if ($config_fields['title']['display']) : ?>
			<li>
				<label class="required"><?php if ($config_fields['title']['require']) : ?><em>*</em><?php endif; ?><?php print _JSHOP_REG_TITLE?></label>
				<div class="input-box">
					<?php print $this->select_titles ?>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['f_name']['display'] || $config_fields['l_name']['display']) : ?>
			<li class="fields">
				<div class="customer-name">
					<div class="field name-firstname">
						<label class="required">
							<?php if ($config_fields['f_name']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_F_NAME ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "f_name" id = "f_name" value = "" class = "inputbox" />
						</div>
					</div>
					<div class="field name-lastname">
						<label class="required">
							<?php if ($config_fields['l_name']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_L_NAME ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "l_name" id = "l_name" value = "" class = "inputbox" />
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['m_name']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['m_name']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_M_NAME ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "m_name" id = "m_name" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['firma_name']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['firma_name']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_FIRMA_NAME ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "firma_name" id = "firma_name" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['client_type']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['client_type']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_CLIENT_TYPE ?>
				</label>
				<div class="input-box">
					<?php print $this->select_client_types;?>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['firma_code']['display']) : ?>
			<li id = 'tr_field_firma_code' <?php if ($config_fields['client_type']['display']) : ?>style="display:none;"<?php endif; ?>>
				<label class="required">
					<?php if ($config_fields['firma_code']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_FIRMA_CODE ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "firma_code" id = "firma_code" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['tax_number']['display']) : ?>
			<li id = 'tr_field_tax_number' <?php if ($config_fields['client_type']['display']) : ?>style="display:none;"<?php endif; ?>>
				<label class="required">
					<?php if ($config_fields['tax_number']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_VAT_NUMBER ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "tax_number" id = "tax_number" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['email']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['email']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_EMAIL ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "email" id = "email" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['email2']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['email2']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_EMAIL2 ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "email2" id = "email2" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['birthday']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['birthday']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_BIRTHDAY?>
				</label>
				<div class="input-box">
					<?php echo JHTML::_('calendar', '', 'birthday', 'birthday', $this->config->field_birthday_format, array('class'=>'input', 'size'=>'25', 'maxlength'=>'19'));?>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['birthday']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['birthday']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_BIRTHDAY?>
				</label>
				<div class="input-box">
					<?php echo JHTML::_('calendar', '', 'birthday', 'birthday', $this->config->field_birthday_format, array('class'=>'input', 'size'=>'25', 'maxlength'=>'19'));?>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['home']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['home']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_HOME ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "home" id = "home" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['apartment']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['apartment']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_APARTMENT ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "apartment" id = "apartment" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['street']['display']) : ?>
			<li class="fields">
				<div class="customer-name">
					<div class="field">
						<label class="required">
							<?php if ($config_fields['street']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_STREET_NR ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "street" id = "street" value = "" class = "inputbox" />
							<?php if ($config_fields['street_nr']['display']){?>
							<input type="text" name="street_nr" id="street_nr" value="" class="input" />
							<?php }?>
						</div>
					</div>
					<div class="field">
						<label class="required">
							<?php if ($config_fields['zip']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_ZIP ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "zip" id = "zip" value = "" class = "inputbox" />
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['country']['display'] || $config_fields['state']['display']) : ?>
			<li class="fields">
				<div class="customer-name">
					<div class="field">
						<label class="required">
							<?php if ($config_fields['city']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_CITY ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "city" id = "city" value = "" class = "inputbox" />
						</div>
					</div>
					<div class="field">
						<label class="required">
							<?php if ($config_fields['state']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_STATE ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "state" id = "state" value = "" class = "inputbox" />
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['city']['display'] || $config_fields['phone']['display']) : ?>
			<li class="fields">
				<div class="customer-name">
					<div class="field">
						<label class="required">
							<?php if ($config_fields['country']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_COUNTRY ?>
						</label>
						<div class="input-box">
							<?php print $this->select_countries ?>
						</div>
					</div>
					<div class="field">
						<label class="required">
							<?php if ($config_fields['phone']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_TELEFON ?>
						</label>
						<div class="input-box">
							<input type = "text" name = "phone" id = "phone" value = "" class = "inputbox" />
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['mobil_phone']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['mobil_phone']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_MOBIL_PHONE ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "mobil_phone" id = "mobil_phone" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['fax']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['fax']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_FAX ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "fax" id = "fax" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['ext_field_1']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['ext_field_1']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_EXT_FIELD_1 ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "ext_field_1" id = "ext_field_1" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['ext_field_2']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['ext_field_2']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_EXT_FIELD_2 ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "ext_field_2" id = "ext_field_2" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['ext_field_3']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['ext_field_3']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_EXT_FIELD_3 ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "ext_field_3" id = "ext_field_3" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="fieldset">
        <h2 class="legend"><?php echo JText::_('VINA_LOGIN_INFO') ?></h2>
        <ul class="form-list">
			<?php if ($config_fields['u_name']['display']) : ?>
			<li>
				<label class="required">
					<?php if ($config_fields['u_name']['require']) : ?><em>*</em><?php endif; ?>
					<?php print _JSHOP_USERNAME ?>
				</label>
				<div class="input-box">
					<input type = "text" name = "u_name" id = "u_name" value = "" class = "inputbox" />
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['password']['display'] || $config_fields['password_2']['display']) : ?>
			<li class="fields">
				<div class="customer-name">
					<div class="field">
						<label class="required">
							<?php if ($config_fields['password']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_PASSWORD ?>
						</label>
						<div class="input-box">
							<input type = "password" name = "password" id = "password" value = "" class = "inputbox" />
						</div>
					</div>
					<div class="field">
						<label class="required">
							<?php if ($config_fields['password_2']['require']) : ?><em>*</em><?php endif; ?>
							<?php print _JSHOP_PASSWORD_2 ?>
						</label>
						<div class="input-box">
							<input type = "password" name = "password_2" id = "password_2" value = "" class = "inputbox" />
						</div>
					</div>
				</div>
			</li>
			<?php endif; ?>
			<?php if ($config_fields['privacy_statement']['display']) : ?>
			<li>
				<label class="required">
					<a class="privacy_statement" href="#" onclick="window.open('<?php print SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=privacy_statement&tmpl=component', 1);?>','window','width=800, height=600, scrollbars=yes, status=no, toolbar=no, menubar=no, resizable=yes, location=no');return false;">
						<?php if ($config_fields['privacy_statement']['require']) : ?><em>*</em><?php endif; ?>
						<?php print _JSHOP_PRIVACY_STATEMENT?>
					</a>
				</label>
				<div class="input-box">
					<input type="checkbox" name="privacy_statement" id="privacy_statement" value="1" />
				</div>
			</li>
			<?php endif; ?>
		</ul>
	</div>
    <?php echo $this->_tmpl_register_html_2?>
    <?php echo $this->_tmpl_register_html_3?>
    <?php echo $this->_tmpl_register_html_4?>
    <?php echo $this->_tmpl_register_html_5?>
    <?php echo $this->_tmpl_register_html_6?>
    <?php echo JHtml::_('form.token');?>
	<div class="buttons-set">
		<p class="required pull-right">* <?php print _JSHOP_REQUIRED?></p>
        <button type="submit" title="Submit" class="vina-button"><span><span><?php print _JSHOP_SEND_REGISTRATION ?></span></span></button>
    </div>
</form>
</div>