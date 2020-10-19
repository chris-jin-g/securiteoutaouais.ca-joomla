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

class TimeWorkedViewWorkLog extends TimeWorkedViewWorkLogGeneral
{

	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = null)
	{
		$this->loadHelper('DateRangeListHelper');
		$this->loadHelper('formhelper');

		$jinput = JFactory::getApplication()->input;

		$this->control             = $this->workentryModel->getFormGroupId();
		$this->form                = FormHelper::getWorkentryForm();
		$this->postFormData        = JFactory::getApplication()->input->post->getArray(array($this->control => $this->workentryModel->getFormFields()));
		$this->events              = $this->get('Events');
		$this->precision           = JComponentHelper::getParams('com_timeworked')->get('decimal_point');
		$this->display_all         = $this->worklogModel->isDisplayedAll();
		$this->billableNeedConfirm = JComponentHelper::getParams('com_timeworked')->get('not_billable_hours') == 1;
		$this->billableOnList      = $this->worklogModel->getIsNotBillableHours();
		$this->total               = $this->get('SummaryPageHours');

		$this->projects = JModelLegacy::getInstance('Project', 'TimeWorkedModel')->getProjectsByClientId($jinput->getInt('filter_client'));
		$this->clients  = $this->get('Clients');
		$this->staff    = JModelLegacy::getInstance('Users', 'TimeWorkedModel')
			->getUsers($jinput->getInt('filter_client'), $jinput->getInt('filter_project'));
		$this->months   = DateRangeListHelper::getMonthList(
			$this->worklogModel->getDatePeriods($jinput->getInt('filter_client'), $jinput->getInt('filter_project'))
		);
        $this->tasks    = JModelLegacy::getInstance('Task', 'TimeWorkedModel')->getTasksByProjectId($jinput->getInt('filter_project'));
		$this->summaryPageHours = $this->get('SummaryPageHours');

		TimeWorkedHelper::setDocument(JText::_('COM_TIMEWORKED_WORK_LOG'), $this->baseurl);

		parent::display($tpl);
	}
}
