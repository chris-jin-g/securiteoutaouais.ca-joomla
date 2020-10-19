<?php

//Used in J Framework only
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.form');
jimport('joomla.html.html');
jimport('joomla.form.formfield');//import the necessary class definition for formfield

class JFormFieldmenujs extends JFormField {
	protected $type = 'Menu'; //the form field type
	protected function getInput() {
		$options = array();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)->select("a.id, a.title, a.menutype")->from("#__menu_types AS a");//->where("a.menutype = ".$db->quote("mainmenu"));
		// Get the options.
		$db->setQuery($query);
		try {
			$options = $db->loadObjectList();
		} catch(RuntimeException $e) {
			JError::raiseWarning(500, $e->getMessage());
		}
		$result = array();
		foreach($options as $menu) {
    	$result[] = (object)array("value" => $menu->menutype, "label" => $menu->title);//"{value:\"".$item->value."\",label:\"".$item->text."\"},";
    }
		return $result;
	}
}