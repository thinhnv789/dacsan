<?php
/**
 * @version		$Id: default.php 2012-06-25 16:44:59Z manearaluca $
 * @package		Joomla.Site
 * @subpackage	mod_raljoomshopsearch
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

?>




<div class="jshop raljssearch <?php echo $moduleclass_sfx;?>">
<!-- <h1><?php print _JSHOP_SEARCH ?></h1>-->
<form action = "<?php print $sAction;?>" name="form_ad_search" method = "post" onsubmit = "return validateFormAdvancedSearch('form_ad_search')">    
    <input type="hidden" name="setsearchdata" value="1">
    <table class = "jshop" cellpadding = "6" cellspacing="0">
    <?php if ($iNameral==1):?>
      <tr>
        <td>
          <input type = "text" name = "search" class = "inputbox" placeholder=" <?php print _JSHOP_SEARCH_TEXT?>"/>
        </td>
      </tr>
    <?php endif;?>
    
    <?php if ($iCategoriesral==1):?>
      <tr>
        <td> 
          <?php print $list_categories; ?><br />
          <input type = "checkbox" name = "include_subcat" id = "include_subcat" value = "1" />
          <label for = "include_subcat"><?php print _JSHOP_SEARCH_INCLUDE_SUBCAT ?></label>
        </td>
      </tr>
    <?php endif;?>  
    <?php if ($iManufacturesral==1):?>
      <tr>
        <td>
          <?php print $list_manufacturers; ?>
        </td>
      </tr>
      <?php endif;?>
      <?php if ($iPricefromral==1):?>
       <tr>
        <td>
          <input type = "text" class = "inputbox" name = "price_from" id = "price_from" placeholder="<?php print _JSHOP_SEARCH_PRICE_FROM ?> "/> <?php print $jshopConfig->currency_code?>
        </td>
      </tr>
      <?php endif;?>
      <?php if ($iPricetoral==1):?>
      <tr>
        <td>
          <input type = "text" class = "inputbox" name = "price_to" id = "price_to" placeholder="<?php print _JSHOP_SEARCH_PRICE_TO ?> "/> <?php print $jshopConfig->currency_code?>
        </td>
      </tr>
      <tr>
      <?php endif;?>
      <?php if ($iDatefromral==1):?>
        <td>
        <?php print _JSHOP_SEARCH_DATE_FROM ?>  <br />
    	    <?php echo JHTML::_('calendar','', 'date_from', 'date_from', '%Y-%m-%d', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19')); ?>
        </td>
      </tr>
      <?php endif;?>
      <?php if ($iDatetoral==1):?>
      <tr>
        <td>
        	 <?php print _JSHOP_SEARCH_DATE_TO ?>  
        	 <br />
    	    <?php echo JHTML::_('calendar','', 'date_to', 'date_to', '%Y-%m-%d', array('class'=>'inputbox', 'size'=>'25', 'maxlength'=>'19')); ?>
        </td>
      </tr>      
      <?php endif;?>
      <tr>
        <td id="list_characteristics"><?php print $characteristics;?></td>
      </tr>
    </table>
    <div style="padding:6px;">
    <input type = "submit" class="button" value = "<?php print _JSHOP_SEARCH ?>" />  
    </div>
    </form>
</div>
