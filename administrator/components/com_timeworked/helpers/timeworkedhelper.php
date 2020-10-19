<?php
/**
 * Admin view helper
 *
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;

/**
 * Admin view helper
 */
class TimeWorkedHelper
{
	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @param   string $section  The section name.
	 * @param   int    $recordId The record ID.
	 *
	 * @return JObject
	 */
	public static function getActions($section, $recordId = 0)
	{
		$user   = JFactory::getUser();
		$result = new JObject;
		if (empty($recordId))
		{
			$assetName = 'com_timeworked';
		}
		else
		{
			$assetName = 'com_timeworked.' . $section . '.' . (int) $recordId;
		}
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit',
			'core.edit.own', 'core.delete'
		);
		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}

	/**
	 * Set head entries for output html document.
	 *
	 * @param   string $title Text for title.
	 */
	public static function setDocument()
	{
		$doc = JFactory::getDocument();
		$doc->addStyleSheet(JUri::root(true) . '/media/com_timeworked/styles/timeworked_admin.css');
		JHTML::_("behavior.framework");
		$doc->addScript(JUri::root(true) . '/media/com_timeworked/scripts/staff.js', '', true, true);
		$doc->addScript(JUri::root(true) . '/media/com_timeworked/scripts/changeColor.js');
		$doc->addScriptDeclaration("
			jQuery(document).ready(function() {
				jQuery('.change-color').changeColor();
			});
		");
        $basepath = JUri::base(true);
        $doc->addScriptDeclaration("var TW_BASE_PATH = '$basepath';");
	}
}
