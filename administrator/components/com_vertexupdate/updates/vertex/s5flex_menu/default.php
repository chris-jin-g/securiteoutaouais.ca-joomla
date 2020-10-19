<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

//set the default S5scion menu params
/*$template_params->_raw = $template_params->_raw."
startLevel=0
showAllChildren=1
window_open=
show_whitespace=0
menu_images=1
menu_images_align=2
menu_images_link=1
expand_menu=1
activate_parent=1
full_active_id=1
menu_style=
";*/

$menu_params = array();
$menu_params['showAllChildren'] = 1;
$menu_params['expand_menu'] = 1;
$menu_params['startLevel'] = 0;
$menu_params['window_open'] = "";
$menu_params['show_whitespace'] = 0;
$menu_params['menu_images'] = 1;
$menu_params['menu_images_align'] = 2;
$menu_params['menu_images_link'] = 1;
$menu_params['activate_parent'] = 1;
$menu_params['full_active_id'] = 1;
$menu_params['menu_style'] = "";
$menu_params['s5_maxdepth'] = $s5_maxdepth;

if($s5_maxdepth > 0){
    $menu_params['endLevel'] = $s5_maxdepth;
}else{
	$menu_params['endLevel'] = 0;
}

if($s5_menu_type_language_switch == 'enabled'){
	$db = JFactory::getDBO();
	$lang = JFactory::getLanguage();
	$query = " SELECT menutype  FROM  #__menu WHERE language = '".$lang->getTag()."' AND home = 1";
	$db->setQuery($query);
	if($lang_menu = $db->loadResult()){
		$s5_menu_type = $lang_menu;
	}	
}

if ( !defined( 'DS')) define('DS', DIRECTORY_SEPARATOR);
require_once (JPATH_THEMES.DS.$app->getTemplate().DS."vertex/s5flex_menu".DS."module_helper.php");
require_once (JPATH_THEMES.DS.$app->getTemplate().DS."vertex/s5flex_menu".DS."helpers.php");
//S5modMainMenuHelper::S5render($template_params,'modS5MainMenuXMLCallback');
S5modMainMenuHelper::S5buildXML($menu_params, $s5_menu_type, $version->RELEASE);

?>