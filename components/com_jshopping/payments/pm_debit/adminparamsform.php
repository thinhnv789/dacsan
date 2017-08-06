<?php
/**
 * @version      1.2.0 10.07.2014
 * @author       MAXXmarketing GmbH
 * @package      Jshopping
 * @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
 * @license      GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<div class="col100">
    <fieldset class="adminform">
        <table class="admintable" width = "100%" >
            <tr>
                <td style="width:250px;" class="key">
                    <?php echo _JSHOP_BIC_REQUIRED; ?>
                </td>
                <td>
                    <?php
                    print JHTML::_('select.booleanlist', 'pm_params[bic_required]', 'class = "inputbox" size = "1"', $params['bic_required']);
                    echo " " . JHTML::tooltip(_JSHOP_DEBIT_BIC_REQUIRED_DESCRIPTION);
                    ?>
                </td>
            </tr>
        </table>
    </fieldset>
</div>
<div class="clr"></div>

