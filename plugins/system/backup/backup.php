<?php
defined('_JEXEC') or die;
JFactory::getLanguage()->load('com_jshopping.addon_backup');
JFactory::getDocument()->addStyleSheet(JURI::root().'administrator/components/com_jshopping/css/backup.css');
function __($vars = array(), $name = '')
{
    list(,$caller) = debug_backtrace();
    JDispatcher::getInstance()->trigger('on'.ucfirst($caller['class']).ucfirst($caller['function']).ucfirst($name), array(&$caller['object'], &$vars));
    return $vars;
}