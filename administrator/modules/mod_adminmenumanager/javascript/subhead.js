// JavaScript Document

var JNC_jQuery = jQuery.noConflict();
JNC_jQuery(
	function($){		
		setTimeout( "fixsubheadermargin()" , 50);
	}
);

function fixsubheadermargin(){
	var JNC_jQuery = jQuery.noConflict();
	JNC_jQuery(".subhead").css("margin-top","0");
}

