<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgJshoppingAddon_langoverride extends JPlugin {
    
	function __construct(& $subject, $config){
		parent::__construct($subject, $config);
	}
	
	function onLoadMultiLangTableField(&$value)
    {
        $f = array();
        $f[] = array("title", "varchar(255) NOT NULL");
        $f[] = array("value", "text NOT NULL");
        $value->tableFields["langoverride"] = $f;
	}
}
?>