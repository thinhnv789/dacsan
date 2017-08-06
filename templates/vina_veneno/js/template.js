/**
 * @package sample data Jshopping
 * @author VinaGecko.com http://VinaGecko.com
 * @copyright Copyright (C) 2014 www.VinaGecko.com
 * @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
*/

spnoConflict(function($){   
    //tooltip
    $('.hasTip').tooltip({
        html: true
    });
	$('.video-info i').click(function () {
		$('.video-play').slideToggle(500);
	});
});
jQuery(document).ready(function($){

	var galleryBlock = $("ul.gallery");
	
	/* Off-Canvas Menu Block */
	$sidebaroffcanvas = $(".sidebar-offcanvas");
	$sidebaroffcanvas.height($(window).height());
	
	galleryBlock.parents('.row-fluid').addClass('visiable-gallery');
	
	$sidebaroffcanvas = $(".sidebar-offcanvas");
	$sidebaroffcanvas.height($(window).height());
	
	
	$('[data-toggle=offcanvas]').click(function () {
		$('.row-offcanvas').toggleClass('active');
	});	
	
	/*Page My Projects*/
	$("#my_projects .projects a").on("click", function(e){
	  e.preventDefault();
	  var projects=$(this).parents(".projects"),
		  projects_height = projects.height(),
		  details= projects.find(".details"), 
		  details_height=details.height(),
		  new_height=details_height+40; 
		  
		  vina_projects = projects.parents(".vina_projects"),		
		  vina_projects.toggleClass("active").siblings().find(".projects").removeClass("current");;
		
		projects.toggleClass("current").animate({
		paddingBottom: new_height,
		marginBottom: '20'
	  }, { duration: 200, queue: false }).siblings().removeClass("current");
	  $("#my_projects .projects:not(.current)").animate({
		paddingBottom: '0',
		marginBottom: '0'
	  }, { duration: 200, queue: false }).find(".details").slideUp(200);
	  $(".current").find(".details").slideDown(200);


	});
	
	// Related products
	var $window = $(window),
		flexslider;	
	function getGridSize() {	
		return (window.innerWidth < 768) ? 1 :			  
			   (window.innerWidth < 900) ? 3 : 4;
	}
	$('.flexslider_related').flexslider({
		slideshow: true,
		animating: true,
		animation: "slide",
		slideshowSpeed: 5000,
		controlNav: false,
		animationLoop: true,
		itemWidth: 190,
		itemMargin: 16,
		minItems: getGridSize(), // use function to pull in initial value
		maxItems: getGridSize() // use function to pull in initial value
	});
	
	// Mini Cart
	$('#jshop_module_cart').hover(function(){		
		$('.top-cart-content').slideToggle( "200" );		
	});
	
	// Link account Layout 3
	$('.module.account').hover(function(){		
		$('.module.account .mod-content').slideToggle( "400" );		
	});
	
	//Tooltips	
	$('.link_social a, .buttons a').tooltip();
	
	//Goto Top
	$(window).scroll(function(event) {	
		if ($(this).scrollTop() > 300) {
			$('.sp-totop').fadeIn();
			$('.sp-totop').css({"visibility": "visible"});
		} else {
			$('.sp-totop').fadeOut();
		}
	});

	$('.sp-totop').click(function(){
		$('html').animate({
			scrollTop: 0
		}, 500);
	});
	
	$(window).resize(function(){
		var gridSize = getGridSize();
		$(this).load();
	});
});