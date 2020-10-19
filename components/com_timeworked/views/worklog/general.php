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

/**
 * General View class for display a work log
 */
class TimeWorkedViewWorkLogGeneral extends JViewLegacy
{
	public $state;
	public $isAdmin;
	public $canCreate;
	public $canEdit;
	public $canEditOwn;
	public $canDelete;
	public $canManageReports;
	public $pagination;
	public $time_worked_types;
	public $summaryHours;
	public $filterClient;
	public $filterProject;
	public $filterStaff;
	public $filterDate;
	public $worklog;
	public $enabledTicketNumber;

	/**
	 * @var TimeWorkedModelWorkEntry $workentryModel workentry model
	 */
	protected $workentryModel;

	/**
	 * @var TimeWorkedModelTimeWorkedType $timeWorkedTypeModel time worked type model
	 */
	protected $timeWorkedTypeModel;

	/**
	 * @var TimeWorkedModelWorkLog $worklogModel worklog model
	 */
	protected $worklogModel;

	function __construct($config = array())
	{
		parent::__construct($config);
		$this->worklogModel        = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');
		$this->workentryModel      = JModelLegacy::getInstance('WorkEntry', 'TimeWorkedModel');
		$this->timeWorkedTypeModel = JModelLegacy::getInstance('TimeWorkedType', 'TimeWorkedModel');

		$this->enabledTicketNumber = JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number');

		$this->loadHelper('ACLHelper');
		$this->loadHelper('TimeWorkedHelper');
		$this->addHelperPath(JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers');
		$this->loadHelper('DateFormatterHelper');
		$this->loadHelper('NumberFormatterHelper');

		$this->isAdmin          = ACLHelper::isAdmin();
		$this->canCreate        = ACLHelper::canCreate();
		$this->canEdit          = ACLHelper::canEdit();
		$this->canEditOwn       = ACLHelper::canEditOwn();
		$this->canDelete        = ACLHelper::canDelete();
		$this->canManageReports = ACLHelper::canManageAllReports() || ACLHelper::canManageAssignedReports();
	}

	/**
	 * Execute and display a template script.
	 *
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 */
	public function display($tpl = null)
	{
		$this->state        = $this->get('State');
		$this->summaryHours = $this->get('SummaryHours');

		if ($tpl == 'print' || $tpl == 'xls')
		{
			if (!JFactory::getUser()->id)
			{
				JFactory::getApplication()->redirect(JRoute::_('index.php?option=com_timeworked'));
				jexit();
			}

			$limit = $this->state->get('list.limit');
			$start = $this->state->get('list.start');
			$this->state->set('list.limit', 0);
			$this->state->set('list.start', 0);
			$this->worklog = $this->get('Items');
			$this->state->set('list.limit', $limit);
			$this->state->set('list.start', $start);
		}
		else
		{
			$this->worklog = $this->get('Items');
		}

		$this->pagination = $this->get('Pagination');

		$this->time_worked_types     = $this->get('TimeWorkedTypes');
		$this->defaultTimeWorkedType = $this->timeWorkedTypeModel->getDefaultTimeType();

		$this->filterClient  = $this->state->get('filter.client');
		$this->filterProject = $this->state->get('filter.project');
		$this->filterTask    = $this->state->get('filter.task');
		$this->filterStaff   = $this->state->get('filter.staff');
		$this->filterDate    = $this->state->get('filter.date_month');

		parent::display($tpl);
	}

	/**
	 * Get hours statistic with markup
	 *
	 * @param array $summaryHours hours array
	 *
	 * @return string formatted hours statistic
	 */
	public function summaryHoursDecorator($summaryHours)
	{
		$result = '<span class="total-hours">' . $summaryHours['_total'] . '</span> ' . JText::_('COM_TIMEWORKED_TOTAL_HOURS');

		foreach ($summaryHours as $name => $hours)
		{
			if ($name === '_default' || $name === '_total' || $name === '_total_billable')
			{
				continue;
			}

			if ($name === '_rejected')
			{
				$name = strtolower(JText::_('COM_TIMEWORKED_REJECTED'));
			}
            elseif ($name === '_not_billable')
            {
                $name = strtolower(JText::_('COM_TIMEWORKED_NOT_BILLABLE'));
                if ($hours === '00:00') {
                    continue;
                }
            }

			$overtimeArr[] = '<span class="total-overtime-' . $name . '">' . $hours . '</span> ' . $name;
		}

		if (!empty($overtimeArr))
		{
			$result .= ' (' . implode(' / ', $overtimeArr) . ')';
		}
        
		return $result;
	}

	/**
	 * Get formatted filter values for exported documents
	 *
	 * @param string $type  filter type
	 * @param string $value filter value
	 *
	 * @return null|string formatted filter value
	 */
	public function getFilterValue($type, $value)
	{
		$type = strtolower($type);

		if ($type == 'user')
		{
			$user = JFactory::getUser($value);

			if ($user)
			{
				return $user->name;
			}

			return null;
		}

		if ($type == 'date')
		{
			if ($value)
			{
				list($startDate, $endDate) = explode('--', $value);

				return DateFormatterHelper::format($startDate) . ' — ' . DateFormatterHelper::format($endDate);
			}

			return null;
		}

		$item = JModelLegacy::getInstance($type, 'TimeWorkedModel')->getItem($value);

		if ($item)
		{
			switch ($type)
			{
				case 'client':
					return $item->company;
				case 'project':
					return $item->name;
			}
		}

		return null;
	}

	/**
	 * Build report title
	 *
	 * @param boolean $filename report title for filename
	 *
	 * @return string report title
	 */
	public function buildTitle($filename = false)
	{
		$filterClientName  = $this->getFilterValue('Client', $this->filterClient);
		$filterProjectName = $this->getFilterValue('Project', $this->filterProject);
		$filterUserName    = $this->getFilterValue('User', $this->filterStaff);
		$filterDateName    = $this->getFilterValue('date', $this->filterDate);

		$reportTitle = '';

		if ($filterClientName)
		{
			if (empty($reportTitle))
			{
				$reportTitle = 'Report for ' . $filterClientName;
			}
			else
			{
				$reportTitle .= ' for ' . $filterClientName;
			}
		}

		if ($filterProjectName)
		{
			if (empty($reportTitle))
			{
				$reportTitle = 'Report for ' . $filterProjectName;
			}
			else
			{
				$reportTitle .= ' for ' . $filterProjectName;
			}
		}

		if ($filterUserName)
		{
			if (empty($reportTitle))
			{
				$reportTitle = 'Report of ' . $filterUserName;
			}
			else
			{
				$reportTitle .= ' of ' . $filterUserName;
			}
		}

		if ($filterDateName)
		{
			if (empty($reportTitle))
			{
				$reportTitle = 'Report for ' . $filterDateName;
			}
			else
			{
				$reportTitle .= ' for ' . $filterDateName;
			}
		}

		if (!$reportTitle)
		{
			$reportTitle = 'Full report';
		}

		if ($filename)
		{
			return str_replace('-—-', '-', str_replace(' ', '-', $reportTitle));
		}

		return $reportTitle;
	}
}
