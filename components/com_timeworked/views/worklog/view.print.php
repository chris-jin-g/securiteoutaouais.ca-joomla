<?php
/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;

JLoader::import('views.worklog.general', JPATH_COMPONENT_SITE);

/**
 * View class for print a work log
 */
class TimeWorkedViewWorkLog extends TimeWorkedViewWorkLogGeneral
{

	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = 'print')
	{
		TimeWorkedHelper::setDocument(JText::_('COM_TIMEWORKED_WORK_LOG'), $this->baseurl);

		parent::display($tpl);
	}
}
