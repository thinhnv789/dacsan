<?php die("Access Denied"); ?>#x#a:2:{s:6:"output";a:3:{s:4:"body";s:0:"";s:4:"head";a:0:{}s:13:"mime_encoding";s:9:"text/html";}s:6:"result";s:1024:"<div class="module ">	
	<div class="mod-wrapper clearfix">		
				<div class="mod-content clearfix">	
			<div class="mod-inner clearfix">
					<script type="text/javascript">
		jQuery(function($) {
			$('.sp_simple_youtube_responsive').each(function(){
				var $that = $(this);
				$('#sp-simple-youtube304').css({
					'width': $(this).width(),
					'height': ( $(this).data('height')*$(this).width() ) / $(this).data('width')
				});

				$(window).resize(function(){
					$('#sp-simple-youtube304').css({
						'width': $that.width(),
						'height': ( $that.data('height')*$that.width() ) / $that.data('width')
					});
				});
			});
		});
	</script>
	
	<div class="sp_simple_youtube sp_simple_youtube_responsive" data-width="300" data-height="200">
					<iframe title="Simple youtube module by JoomShaper.com" id="sp-simple-youtube304" src="http://www.youtube.com/embed/A4r2LKh6ga8?wmode=transparent" frameborder="0"></iframe>
			</div>

			</div>
		</div>
	</div>
</div>
<div class="gap"></div>
";}