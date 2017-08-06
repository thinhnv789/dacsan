<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2014 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

//[Icon]

if(!function_exists('icon_sc')) {
	function icon_sc( $atts, $content="" ) {
	
		extract(shortcode_atts(array(
			   'name' => 'home',
			   'size' => '',
			   'color' => '',
			   'class' =>""
		 ), $atts));
		 
		 $options = 'style="';
		 $options .= ($size) ? 'font-size:'. (int) $size .'px;' : '';
		 $options .= ($color) ? 'color:'. $color . ';': '';
		 $options .='"';
		 
		return '<i ' . $options . ' class="icon-' . str_replace( 'icon-', '', $name ) . ' ' . $class . '"></i>' . $content;
	 
	}
		
	add_shortcode( 'icon', 'icon_sc' );
}

if(!function_exists('icon_sc_2')) {
	function icon_sc_2( $atts, $content="" ) {
	
		extract(shortcode_atts(array(
			   'name' => 'home',
			   'size' => '',
			   'color' => '',
			   'class' =>""
		 ), $atts));
		 
		 $options = 'style="';
		 $options .= ($size) ? 'font-size:'. (int) $size .'px;' : '';
		 $options .= ($color) ? 'color:'. $color . ';': '';
		 $options .='"';
		 
		return '<div><div><i ' . $options . ' class="icon-' . str_replace( 'icon-', '', $name ) . ' ' . $class . '"></i>' . $content.'</div></div>';
	 
	}
		
	add_shortcode( 'icon_2', 'icon_sc_2' );
}