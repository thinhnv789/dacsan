<?php
/**
* @version      1.1.1 06.10.2011
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class JshoppingControllerLangpackedit extends JControllerLegacy{
    
    function __construct( $config = array() ){
        JSFactory::loadExtLanguageFile('addon_lang_translator');
        parent::__construct( $config );
        $this->registerTask('apply', 'save');     
        addSubmenu("other");
    }

    function display($cachable = false, $urlparams = false){
        $langpath = JPATH_ROOT.'/components/com_jshopping/lang';
        $_folders = $this->getFiles();
        foreach ($_folders as $v) {
            if ($v['fullname'] == $langpath){
                $mainfile = $v['key'];
            }
        }
        $langfolder = JRequest::getVar('langfolder') ? JRequest::getVar('langfolder') : $mainfile;     
        $list_files = JHTML::_('select.genericlist', $_folders, 'langfile','onchange="window.location=\''.JUri::root().'administrator/index.php?option=com_jshopping&controller=langpackedit&langfolder=\'+this.options[this.selectedIndex].value"', 'key', 'name',$langfolder);
     
        $langs = array();
        $_langs_path = array();
        $files = JFolder::files($_folders[$langfolder]['fullname'], '\.php$');
        if (count($files)){
            foreach ($files as $v) {
                $_files[] = substr($v, 0, strpos($v, ".php"));
            }
        }
        if (count($_files)){
            foreach ($_files as $v) {
                if ($v == 'en-GB'){
                   array_unshift($langs, $v);
                   array_unshift($_langs_path, $_folders[$langfolder]['fullname'].'/'.$v.'.php');
                }else{
                   array_push($langs, $v);
                   array_push($_langs_path, $_folders[$langfolder]['fullname'].'/'.$v.'.php');
                }
            }
			
			$count_vars = 0;
            foreach ($_langs_path as $k => $v) {
                if (!file_exists($v)){
                    exit();                    
                }
                $_lang = file_get_contents($v);
                if ($k==0){
                  $_header = preg_match ("/\/\*\*(.*)\*\//si", $_lang, $matches);
                  if($_header) $header = $matches[0];
                  //$_constants = preg_match_all ("/define\(['\"](.*)['\"]\);/Usi", $lang, $matches);
                  $_constants = preg_match_all ("/define\(['\"](.*)['\"], */Usi", $_lang, $matches);
                  if($_constants)
                      $constants = $matches[1];
                } 
                    $_lang_constants = preg_match_all ("/define\(['\"](.*)['\"], */Usi", $_lang, $matches);
                    if($_lang_constants){
                        $lang_constants = $matches[1];
                        $_transl = preg_match_all ("/, *['\"](.*)['\"] *\)/Usi", $_lang, $matches);
                        foreach ($lang_constants as $key => $value) {
                          $translate[$langs[$k]][$value] = $matches[1][$key]; 
                        }     
						$count_vars += count($lang_constants);
                    }                           
            }
        }

        $view=$this->getView("langpackedit", 'html');
		$view->assign("count_vars",$count_vars);
        $view->assign("list_files",$list_files);
        $view->assign("translate",$translate);
        $view->assign("langs",$langs);
        $view->assign("header",$header);
        $view->assign("constants",$constants);
        $view->display();
    }
   
    function save(){
        $folders = $this->getFiles();
        $langfolder = JRequest::getVar('langfile');
        $langs = JRequest::getVar('lang');
        $fileheader = JRequest::getVar('fileheader');
        // get constant from en file
        $en_file = $folders[$langfolder]['fullname'].'/en-GB.php';
        if(JFile::exists($en_file)){
            $_lang = file_get_contents($en_file);
            $_constants = preg_match_all ("/define\(['\"](.*)['\"], */Usi", $_lang, $matches);
            $constants = $matches[1];
            
        }
        $files = JFolder::files($folders[$langfolder]['fullname'].'/', '\.php$');
        if (count($files)){
            foreach ($files as $v) {
                $_files[] = substr($v, 0, strpos($v, ".php"));
            }
        }
        if (count($langs)){
            foreach ($langs as $k => $v) {
               
			   if (in_array($k, $_files)){
					JFile::copy( $folders[$langfolder]['fullname'].'/'.$k.'.php', $folders[$langfolder]['fullname'].'/'.$k.'.last.bkp' );
					$_original_file = $folders[$langfolder]['fullname'].'/'.$k.'.original.bkp';
					//var_dump(JFile::exists($_original_file));
					if(!JFile::exists($_original_file)){
						JFile::copy( $folders[$langfolder]['fullname'].'/'.$k.'.php', $_original_file);
					}
				}
                $file = '<?php'.PHP_EOL.$fileheader.PHP_EOL.'defined(\'_JEXEC\') or die(\'Restricted access\');'.PHP_EOL.PHP_EOL;
                foreach ($v as $_k=>$_v) {
                    $file .= "define('".$constants[$_k]."', '".str_replace(array("\\","'"), array("\\\\","\'"), $_v)."');".PHP_EOL;
					//$file .= "define('".$constants[$_k]."', '".addslashes($_v)."');".PHP_EOL;
                }
                $file .='?>';
                JFile::write($folders[$langfolder]['fullname'].'/'.$k.'.php', $file);
            }
        }
		//die;
        $mainframe =& JFactory::getApplication();
        
        $mainframe->redirect("index.php?option=com_jshopping&controller=langpackedit&langfolder=".$langfolder, _JSHOP_COMPLETED);
    }	
    
    function getFiles(){
        $langpath = JPATH_ROOT.'/components/com_jshopping/lang';
        $adminlangpath = JPATH_ADMINISTRATOR.'/components/com_jshopping/lang';
        $folders = JFolder::listFolderTree( $langpath, '.' );
        $adminfolders = JFolder::listFolderTree( $adminlangpath, '.' );
        $_folders = array();
        $temp['name'] =_JSHOP_LANG_PACK_ADMIN;
        $temp['disable'] =true;        
        $_folders[] = $temp;
        $temp['fullname'] =$adminlangpath;
        $temp['name'] ='-- '._JSHOP_LANG_PACK_MAIN;
        $temp['disable'] =false;
        $_folders[] = $temp;
        foreach ($adminfolders as $v) {
            $v['name'] = '-- '.$v['name'];
           $_folders[] = $v; 
        }
        $temp['name'] =_JSHOP_LANG_PACK_SITE;
        $temp['disable'] =true;
        $_folders[] = $temp;
        $temp['fullname'] =$langpath;
        $temp['name'] ='-- '._JSHOP_LANG_PACK_MAIN;
        $temp['disable'] =false;
        $_folders[] = $temp;        
        foreach ($folders as $v) {
            if ($v['name']=='override') continue;
            $v['name'] = '-- '.$v['name'];
           $_folders[] = $v; 
        }
        foreach ($_folders as $k => &$v) {
           $v['key'] = $k; 
        }
        return $_folders;
    }
}
?>