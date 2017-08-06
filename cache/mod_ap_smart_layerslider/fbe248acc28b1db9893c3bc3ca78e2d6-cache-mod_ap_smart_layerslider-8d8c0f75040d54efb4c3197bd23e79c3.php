<?php die("Access Denied"); ?>#x#a:2:{s:6:"output";a:3:{s:4:"body";s:0:"";s:4:"head";a:1:{s:11:"styleSheets";a:1:{s:63:"/modules/mod_ap_smart_layerslider/tmpl/themes/style1/style1.css";a:3:{s:4:"mime";s:8:"text/css";s:5:"media";N;s:7:"attribs";a:0:{}}}}s:13:"mime_encoding";s:9:"text/html";}s:6:"result";s:3128:"<div class="module ">	
	<div class="mod-wrapper clearfix">		
				<div class="mod-content clearfix">	
			<div class="mod-inner clearfix">
				
<div class="ap_alert row-fluid">
    <div align="center" class="span12">
        <div class="alert alert-block fade in">
          <button type="button" class="close" data-dismiss="alert" style="font-size:24px;">&times;</button>
            <div id="message" style="text-align:center;margin:0 auto;padding:12px 0 0;line-height:24px;">
                <h4 style="vertical-align:middle;font-size:150%;line-height:30px;margin-left:10px;">
                <span class="label label-important" style="font-size:14px;margin:2px 10px 0;padding:5px 10px;line-height:110%;vertical-align:top">
                <i style="margin-right:8px;" class="fa fa-info-circle"></i>Important!</span>
                 
                No images in this folder
                 
                </h4><br/>
                <p>
                 
                Empty folder. Make sure you put some images in <b>this</b> folder in "AP Smart LayerSlider" module admin.
                  
                </p>
            </div>
        </div>
    </div>  
</div>

	

<script type="text/javascript">
;(function($){
 $(document).ready(function() {
	$('#ap-smart-layerslider-mod_308').sliderPro({		
		width: 860,
		height: 345,
		forceSize:'none',
		visibleSize:'auto',
		slideDistance: 10,
		responsive:true,
		imageScaleMode:'cover',
		autoHeight:true,
		autoScaleLayers:true,
		waitForLayers:false,
	
		orientation:'horizontal',
		loop:true,
	
		shuffle:true,
			
				fade:true,
		fadeOutPreviousSlide:true,
		fadeDuration:500,
				autoplay:true,
		autoplayDelay:4000,
		autoplayOnHover:'pause',
				reachVideoAction:'none',
		leaveVideoAction:'pauseVideo',
		playVideoAction:'stopAutoplay',
		pauseVideoAction:'none',
		endVideoAction:'none',
											
				
		arrows:true,
		buttons:true,
		breakpoints: {
			480: {
				thumbnailWidth: 120,
				thumbnailHeight: 50
			}
		}
	});
	// removes all description that is not wrapped with .sp-layer
	 $("#ap-smart-layerslider-mod_308 .ap-layer").not(".sp-layer").contents().filter(function() {
		return this.nodeType == 3;
	 }).remove();
	 $("#ap-smart-layerslider-mod_308 .ap-layer").children().not(".sp-layer").remove();
  });})(jQuery);
</script>
<style type="text/css">
  #ap-smart-layerslider-mod_308 .sp-arrow{font-size:30px;width:42px;}
	
.sp-horizontal .sp-arrow {margin-top:-20px;}
.sp-vertical .sp-arrow {margin-left:-20px;}
#ap-smart-layerslider-mod_308 .sp-arrow{background:rgba(196,12,78,1);width:rgba(196,12,78,1)}
#ap-smart-layerslider-mod_308 .sp-arrow{color:rgba(94,18,153,0.5);}
 
 
 
#ap-smart-layerslider-mod_308 .sp-button{border-color:rgba(204,0,1,1);}
#ap-smart-layerslider-mod_308 .sp-selected-button{background-color:rgba(204,0,1,1);} 
#ap-smart-layerslider-mod_308 .sp-full-screen-button:before{color:#000000;}
@media (max-width: 979px) {
#ap-smart-layerslider-mod_308 .sp-arrow{font-size:25px;width:35px;}	
}
</style>

			</div>
		</div>
	</div>
</div>
<div class="gap"></div>
";}