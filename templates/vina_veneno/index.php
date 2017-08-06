<?php
/**
 * @package Helix Framework
 * Template Name - Shaper Helix
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');   
JHtml::_('formbehavior.chosen', 'select#id_currency');
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
    <head>
       <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,700,300&amp;subset=vietnamese,latin,latin-ext" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     
        <jdoc:include type="head" />
        <?php
			$style  = array('gallery.css');
			$script = array('jquery.isotope.min.js','jquery.touchSwipe.min.js','jquery.flexslider-min.js','template.js');
			
			if($this->helix->Param('scroll_effect')) {
				$script[] = 'wow.js';
				$style[]  = 'animate.css';
			}

			$this->helix->Header()
            ->setLessVariables(array(
                    'preset'=>$this->helix->Preset(),
                    'header_color'=> $this->helix->PresetParam('_header'),
                    'bg_color'=> $this->helix->PresetParam('_bg'),
                    'text_color'=> $this->helix->PresetParam('_text'),
                    'link_color'=> $this->helix->PresetParam('_link')
                ))
            ->addLess('master', 'template')
			->addJs($script)
			->addCss($style)
            ->addLess( 'presets',  'presets/'.$this->helix->Preset() );
        ?>
    </head>
        <body <?php echo $this->helix->bodyClass('bg hfeed clearfix'); ?>>
		<div class="row-offcanvas row-offcanvas-left">
			<div>
				<div class="body-innerwrapper">
				<!--[if lt IE 8]>
				<div class="chromeframe alert alert-danger" style="text-align:center">You are using an <strong>outdated</strong> browser. Please <a target="_blank" href="http://browsehappy.com/">upgrade your browser</a> or <a target="_blank" href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</div>
				<![endif]-->
				<?php
					$this->helix->layout();
					$this->helix->footer();
				?>
				<jdoc:include type="modules" name="debug" />
				</div>
			</div>
			<div class="hidden-desktop sp-mobile-menu nav-collapse collapse sidebar-offcanvas">
				<p class="close-menu"><?php echo JText::_('VINA_CLOSE_MENU'); ?></p>
				<button type="button" class="hidden-desktop btn btn-primary vina-menu-small" data-toggle="offcanvas">
					<i class="icon-remove"></i>
				</button>
				<?php
					$mobilemenu = $this->helix->loadMobileMenu();
					echo $mobilemenu->showMenu(); 
				?>   
			</div>
		</div>
		<?php if($this->helix->Param('scroll_effect')) : ?>
		<script type="text/javascript">
			Array.prototype.random = function (length) {
				return this[Math.floor((Math.random()*length))];
			}
			
			var effects      = ['fadeInDown', 'pulse', 'bounceIn', 'fadeIn', 'flipInX'];
			var scrollEffect = "<?php echo $this->helix->Param('effect'); ?>";
			<?php if($this->helix->Param('effect') == 'random') echo 'scrollEffect = effects.random(effects.length);'; ?>
			
			var wow = new WOW(
			{
				boxClass:     'row-fluid',      // animated element css class (default is wow)
				animateClass:  scrollEffect +' animated', // animation css class (default is animated)
				offset:       0,          // distance to the element when triggering the animation (default is 0)
				mobile:       false        // trigger animations on mobile devices (true is default)
			});
			wow.init();
		</script>
		<?php endif; ?>
    </body>	
  <script lang="javascript">(function() {var pname = ( (document.title !='')? document.title : document.querySelector('h1').innerHTML );var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async=1; ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=e82a1979e368d101b8cd3a49078128be&data=eyJzc29faWQiOjQ3NDU2MjcsImhhc2giOiI0OTI5YTM0MjA2NDMyOTNjZTQzYzY2ODM0NjgwN2M5YiJ9&pname='+pname;var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script>
</html>
<style>
#floating-phone { display: none; position: fixed; left: 10px; bottom: 10px; height: 50px; width: 50px; background: #46C11E url(http://callnowbutton.com/phone/callbutton01.png) center / 30px no-repeat; z-index: 99; color: #FFF; font-size: 35px; line-height: 55px; text- align: center; border-radius: 50%; -webkit-box-shadow: 0 2px 5px rgba(0,0,0,.5); -moz-box-shadow: 0 2px 5px rgba(0,0,0,.5); box-shadow: 0 2px 5px rgba(0,0,0,.5); }
@media (max-width: 650px) { #floating-phone { display: block; } }
</style>

<a href="tel:0942691366" title="Gọi 0942691366" onclick="_gaq.push(['_trackEvent', 'Contact', 'Call Now Button', 'Phone']);" id="floating-phone"><i class="uk-icon-phone"></i>
</a>