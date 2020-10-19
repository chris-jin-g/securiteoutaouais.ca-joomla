<?php
//Error Reporting
$config = JFactory::getConfig();
$error_reporting_setting = $config->get( 'error_reporting' );
if ($error_reporting_setting == "none" || $error_reporting_setting == "default") {
error_reporting(0);
}

//Footer functions
jimport('joomla.utilities.date');
$app = JFactory::getApplication();
$option = $app->input->getCmd('option', '');
$layout = $app->input->getCmd('layout', '');

$date = new JDate();
$version = new JVersion();
if($version->RELEASE >= '3.0'){ $s5_cur_year = $date->format('Y'); }else{ $s5_cur_year = $date->toFormat('%Y');}
$s5_csite_name	= $app->getCfg('sitename');

//Checks for RTL languages
$lang = JFactory::getLanguage();
$s5_language_direction = $lang->isRTL();

//Checks if user is logged in
$user = JFactory::getUser();
$s5_user_id = $user->get('id');

//Defines the template core path and sets restricted access
function s5_restricted_access_call() {
defined( '_JEXEC' ) or die( 'Restricted index access' );
}

//Calls Joomla <head> calls
function s5_head_call() { ?>
<jdoc:include type="head" />
<?php }

//Calls the default lanaguage
function s5_language_call() {
$lang = JFactory::getLanguage();
?>
xml:lang="<?php echo $lang->getTag(); ?>" lang="<?php echo $lang->getTag(); ?>"
<?php }

//Calls mootools javascript
function s5_jslibrary_call() {
	$version = new JVersion();
	if($version->RELEASE <= '2.5'){JHTML::_('behavior.mootools');}
}

//Calls the component and article call
function s5_component_call() { ?>
<jdoc:include type="message" />
<jdoc:include type="component" />
<?php }

//Calls modules by name and style
function s5_module_call($name,$style) { ?>
<jdoc:include type="modules" name="<?php echo $name ?>" style="<?php echo $style ?>" />
<?php }

//Check to see if a module is published. For custom modules outside of module_calcs.php
function s5_check_module($name) {
	if (JModuleHelper::getModules($name)) {
	return $name;
	}
}

?>