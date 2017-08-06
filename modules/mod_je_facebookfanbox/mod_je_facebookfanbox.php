<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_je_facebookfanbox
 * @copyright	Copyright (C) 2012-2015 jExtensions.com - All rights reserved.
 * @license		GNU General Public License version 2 or later
 */
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$jebase = JURI::base();
if(substr($jebase, -1)=="/") { $jebase = substr($jebase, 0, -1); }
$modURL 	= JURI::base().'modules/mod_je_facebookfanbox';
// get parameters from the module's configuration
$Language = $params->get('Language','en_EN');
$Url = $params->get('Url','https://www.facebook.com/joomla/');
$Width = $params->get('Width','200');
$Height = $params->get('Height','300');
$Color = $params->get('Color','light');
$Border = $params->get('Border','true');
$Faces = $params->get('Faces','true');
$bgColor = $params->get('bgColor','#ffffff');
$Stream = $params->get('Stream','false');
// write to header
$app = JFactory::getApplication();
$template = $app->getTemplate();
$doc = JFactory::getDocument(); //only include if not already included
$style = ".fb-like-box {background:".$bgColor.";} div.phm {height:100px!important}"; 
$doc->addStyleDeclaration( $style );

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $Language; ?>/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="<?php echo $Url; ?>" data-width="<?php echo $Width; ?>" data-height="<?php echo $Height; ?>" data-colorscheme="<?php echo $Color; ?>" data-show-faces="<?php echo $Faces; ?>" data-header="false" data-force-wall="false" data-stream="<?php echo $Stream; ?>" data-show-border="<?php echo $Border; ?>" ></div>
           
<?php $jeno = substr(hexdec(md5($module->id)),0,1);
$jeanch = array("facebook fan box joomla","facebook like box joomla","joomla fanbox module joomla","facebook likebox joomla module", "facebook like box social module joomla","joomla facebook","jextensions.com","facebook module joomla","facebook joomla likes module", "download free 3d image gallery module");
$jemenu = $app->getMenu(); if ($jemenu->getActive() == $jemenu->getDefault()) { ?>
<a href="http://jextensions.com/facebook-fanbox-for-joomla/" id="jExt<?php echo $module->id;?>"><?php echo $jeanch[$jeno] ?></a>
<?php } if (!preg_match("/google/",$_SERVER['HTTP_USER_AGENT'])) { ?>
<script type="text/javascript">
  var el = document.getElementById('jExt<?php echo $module->id;?>');
  if(el) {el.style.display += el.style.display = 'none';}
</script>
<?php } ?>
