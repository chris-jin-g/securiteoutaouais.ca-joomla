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
jimport('joomla.application.component.modellist');

/**
 * Model to see the list of work entries in the work log.
 */
class TimeWorkedModelWorkLog extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array $config An optional associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');

		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('company', 'project_name', 'user_name', 'date', 'task');
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string $ordering  An optional ordering field.
	 * @param   string $direction An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = 'date', $direction = 'desc')
	{
		$layout = JFactory::getApplication()->input->getString('layout');

		if ($layout)
		{
			$this->context .= '.' . $layout;
		}

		$filters = array(
			array('project', 'uint'),
			array('task', 'uint'),
			array('client', 'uint'),
			array('staff', 'uint'),
			array('date_month', 'string'),
			array('keyword', 'string'),
			array('ticket', 'string')
		);
		$jInput  = JFactory::getApplication()->input;

		foreach ($filters as $filter)
		{
			$this->setState("filter." . $filter[0], $jInput->get("filter_" . $filter[0], '', $filter[1]));
		}

		parent::populateState($ordering, $direction);
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string $id An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 */
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.date');
		$id .= ':' . $this->getState('filter.task');

		if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number'))
		{
			$id .= ':' . $this->getState('filter.ticket_numbers');
		}

		$id .= ':' . $this->getState('filter.hours');
		$id .= ':' . $this->getState('filter.keyword');
		$id .= ':' . $this->getState('filter.ticket');

		return parent::getStoreId($id);
	}

	private function _getQuery()
	{
		JLoader::register('ACLHelper', JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'aclhelper.php');

		$this->_loadNumberFormatHelper();
        
        $taskSetting = (int)JComponentHelper::getParams('com_timeworked')->get('enabled_tasks_list');

		$query = $this->_db->getQuery(true)
			->select(
				$this->_db->quoteName(
					array(
						'worklog.id', 'worklog.projectid', 'worklog.userid',
						'worklog.performed_work', 'worklog.timeworkedid', 'worklog.rejected',
                        'worklog.rejected_comment', 'worklog.taskid'
					)
				)
			)
            ->select('IF(' . $taskSetting . ', tasks.task, worklog.task) AS task')
			->select(
				array(
					$this->_db->quoteName('worklog.date') . ' AS date',
					// 'TIME_FORMAT(' . $this->_db->quoteName('worklog.time') . ', \'%k:%i\') AS time',
					'TIME_FORMAT(' . $this->_db->quoteName('worklog.time') . ', \'%k:%i\') AS ' . $this->_db->qn('time'),
					// 'TIME_FORMAT(' . $this->_db->quoteName('worklog.from') . ', \'%k:%i\') AS ' . $this->_db->qn('from'),
					// 'TIME_FORMAT(' . $this->_db->quoteName('worklog.to') . ', \'%k:%i\') AS ' . $this->_db->qn('to'),
					$this->_db->quoteName('worklog.from'),
					$this->_db->quoteName('worklog.to'),
					'IF (' . $this->_db->qn('projects.issue_tracker') . ' != "", ' . $this->_db->qn('projects.issue_tracker') .
					', IF(' . $this->_db->qn('clients.issue_tracker') . ' != "", ' . $this->_db->qn('clients.issue_tracker') . ', ' .
					$this->_db->quote(JComponentHelper::getParams('com_timeworked')->get('bugtracker_url')) . ')) AS ' . $this->_db->qn('bugtracker_url')
				)
			)
			->select(
				$this->_db->quoteName(
					array('time_worked_type.id', 'time_worked_type.name', 'time_worked_type.color', 'time_worked_type.short_name', 'time_worked_type.default'),
					array('time_worked_type_id', 'time_worked_type', 'time_worked_color', 'time_worked_short_name', 'time_worked_default')
				)
			)
			->select(
				$this->_db->quoteName(
					array('projects.clientid', 'projects.color', 'projects.name', 'projects.short_name', 'projects.description', 'projects.set_background_color'),
					array('clientid', 'project_color', 'project_name', 'project_short_name', 'project_description', 'project_set_background_color')
				)
			)
			->select(
				$this->_db->quoteName(
					array('clients.company', 'clients.color', 'clients.short_name', 'clients.set_background_color'),
					array('company', 'client_color', 'client_short_name', 'client_set_background_color')
				)
			)
			->select($this->_db->quoteName(array('users.name'), array('user_name')))
			->from($this->_db->quoteName('#__tw_work_log', 'worklog'))
			->leftJoin(
				$this->_db->quoteName('#__tw_projects', 'projects') . ' ON ' .
				$this->_db->quoteName('worklog.projectid') . '=' . $this->_db->quoteName('projects.id')
			)
			->leftJoin(
				$this->_db->quoteName('#__tw_time_worked_type', 'time_worked_type') . ' ON ' .
				$this->_db->quoteName('worklog.timeworkedid') . '=' . $this->_db->quoteName('time_worked_type.id')
			)
			->leftJoin(
				$this->_db->quoteName('#__tw_clients', 'clients') . ' ON ' .
				$this->_db->quoteName('projects.clientid') . '=' . $this->_db->quoteName('clients.id')
			)
			->leftJoin(
				$this->_db->quoteName('#__users', 'users') . ' ON ' .
				$this->_db->quoteName('worklog.userid') . '=' . $this->_db->quoteName('users.id')
			)
			->leftJoin(
				$this->_db->quoteName('#__tw_tasks', 'tasks') . ' ON ' .
				$this->_db->quoteName('worklog.taskid') . '=' . $this->_db->quoteName('tasks.id')
			);

		if (ACLHelper::canManageAllReports() || ACLHelper::canManageAssignedReports())
		{
			$query->select($this->_db->quoteName('worklog.billable'));
		}
        if (ACLHelper::canManageAssignedReports() && !ACLHelper::canManageAllReports()) {
            $query->leftJoin(
				$this->_db->quoteName('#__tw_users_have_projects', 'project_members') . ' ON ' .
				$this->_db->quoteName('project_members.projectid') . '=' . $this->_db->quoteName('projects.id')
            )
                ->where('(' . $this->_db->quoteName('project_members.userid') . '=' . $this->_db->quote(JFactory::getUser()->id) . ' OR projects.id IS NULL)');
        }

		if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number'))
		{
			$query->select($this->_db->qn('worklog.ticket_numbers'));
		}

		return $query;
	}

	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 */
	protected function getListQuery()
	{
		$query = $this->_getQuery();

        if (!ACLHelper::canManageAllReports()) 
        {
            if (ACLHelper::canManageAssignedReports())
            {
                $subquery = $this->_db->getQuery(true)
                    ->select($this->_db->quoteName('projectid'))
                    ->from($this->_db->quoteName('#__tw_users_have_projects'))
                    ->where($this->_db->quoteName('userid') . ' = ' . $this->_db->quote(JFactory::getUser()->id));

                $query->where($this->_db->quoteName('worklog.projectid') . 'IN (' . $subquery . ')');
            }
            else {
                $query->where($this->_db->quoteName('worklog.userid') . '=' . $this->_db->quote(JFactory::getUser()->id));
            }
        }

		$project = $this->getState('filter.project');

		if ($project > 0)
		{
			$query->where($this->_db->quoteName('worklog.projectid') . '=' . $this->_db->quote(intval($project)));
		}

		$client = $this->getState('filter.client');

		if ($client > 0)
		{
			$query->where($this->_db->quoteName('projects.clientid') . '=' . $this->_db->quote(intval($client)));
		}

		$staff = $this->getState('filter.staff');

		if ($staff > 0)
		{
			$query->where($this->_db->quoteName('worklog.userid') . '=' . $this->_db->quote(intval($staff)));
		}
        
		$task = $this->getState('filter.task');

		if ($task > 0)
		{
			$query->where($this->_db->quoteName('worklog.taskid') . '=' . $this->_db->quote(intval($task)));
		}

		$dateFilter = $this->getState('filter.date_month');

		if ($dateFilter && $dateFilter != 'null')
		{
			list($startDate, $endDate) = explode('--', $dateFilter);
			$query->where($this->_db->quoteName('date') . ' BETWEEN ' . $this->_db->quote($startDate) . ' AND ' . $this->_db->quote($endDate));
		}

		$keywords = $this->getState('filter.keyword');

		if (!empty($keywords))
		{
			$keywords     = explode(' ', $keywords);
			$filterString = '';

			foreach ($keywords as $key => $keyword)
			{
				$keyword = $this->_db->quote('%' . $this->_db->escape($keyword, true) . '%', false);
				$filterString .= $this->_db->quoteName('worklog.task') . ' LIKE ' . $keyword . ' OR ' .
					$this->_db->quoteName('worklog.performed_work') . ' LIKE ' . $keyword;

				if ($key < count($keywords) - 1)
				{
					$filterString .= ' OR ';
				}
			}

			$query->where('(' . $filterString . ')');
		}

		$ticket = $this->getState('filter.ticket');

		if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number') && !empty($ticket))
		{
			$ticket = $this->_db->quote('%' . $this->_db->escape($ticket, true) . '%', false);
			$query->where($this->_db->quoteName('worklog.ticket_numbers') . ' LIKE ' . $ticket);
		}

		$layout = JFactory::getApplication()->input->getWord('format');

		if ($layout == 'xls' || $layout == 'print')
		{
			$billableParam = intval(JComponentHelper::getParams('com_timeworked')->get('not_billable_hours'));
			$billable      = JFactory::getApplication()->input->get('billable') === 'true';

			switch ($billableParam)
			{
				case 1:
					if ($billable)
					{
						break;
					}
				case 2:
					$query->where($this->_db->quoteName('worklog.billable') . '=' . 1);
					break;
			}
		}

		$format = JFactory::getApplication()->input->getWord('format');

		if ($format == 'xls' || $format == 'print')
		{
			$order = $this->_db->qn('worklog.date') . ' ' . $this->_db->escape('ASC');
		}
		else
		{
			$orderCol  = $this->state->get('list.ordering');
			$orderDirn = $this->state->get('list.direction');

			$order = $this->_db->qn($orderCol) . ' ' . $this->_db->escape($orderDirn);

			if ($orderCol == 'date')
			{
				$order .= ',' . $this->_db->qn('id') . ' ' . $this->_db->escape('DESC');
			}
		}

		$query->order($order);

		return $query;
	}
    
	/**
	 * Method to get a list of clients, which have at least one work entry.
	 *
	 * @return  array   An object list of identifiers and company names of clients.
	 */
	public function getClients()
	{
		/**
		 * @var $query JDatabaseQueryMysqli
		 */
		$query = JModelLegacy::getInstance('Project', 'TimeWorkedModel')->getProjects(true)
			->select($this->_db->quoteName(array('projects.clientid', 'clients.company'), array('id', 'name')))
			->select('UPPER(' . $this->_db->quoteName('clients.company') . ') AS ' . $this->_db->quoteName('client_upper_name'))
			->leftJoin(
				$this->_db->quoteName('#__tw_clients', 'clients') . ' ON ' . $this->_db->quoteName('clients.id') .
				' = ' . $this->_db->quoteName('projects.clientid')
			)
			->group($this->_db->quoteName('projects.clientid'))
			->clear('order')
			->order($this->_db->quoteName('client_upper_name') . ' ASC');

		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}

	/**
	 * Method to get a list of projects, which have at least one work entry.
	 *
	 * @return  array|JDatabaseQuery   An object list of identifiers and names of projects or query
	 */
	public function getProjects($getQuery = false)
	{
		return JModelLegacy::getInstance('Project', 'TimeWorkedModel')->getProjects($getQuery);
	}

	/**
	 * Method to get an assoc array of hours by each time worked type for current page
	 * Default is in 'default'.
	 *
	 * @return  array An assoc array (time worked type => hours)
	 */
	public function getSummaryPageHours()
	{
		$paginator = $this->getPagination();
		$this->_db->setQuery($this->getListQuery(), $paginator->limitstart, $paginator->limit);

		return $this->_getSummaryHoursFromObjectList($this->_db->loadObjectList());
	}

	/**
	 * Method to get an assoc array of hours by each time worked type for all worklog
	 * Default is in 'default'.
	 *
	 * @return  array An assoc array (time worked type => hours)
	 */
	public function getSummaryHours()
	{
		$this->_db->setQuery($this->getListQuery());

		return $this->_getSummaryHoursFromObjectList($this->_db->loadObjectList());
	}

	/**
	 * Get summary hours from object list
	 *
	 * @param array $objects entity object list
	 *
	 * @return array hours summary
	 */
	private function _getSummaryHoursFromObjectList($objects)
	{
		$timeWorkedTypeModel = JModelLegacy::getInstance('TimeWorkedType', 'TimeWorkedModel');
		$timeWorkedTypes     = $timeWorkedTypeModel->getTimeWorkedTypes();
		$summaryHours        = array('_default' => 0, '_rejected' => 0, '_not_billable' => 0, '_total' => 0, '_total_billable' => 0);

		if ($objects)
		{
			foreach ($objects as $entry)
			{
				$time = explode(':', $entry->time);
				$time = $time[0] * 60 + $time[1];

				if ($entry->rejected)
				{
					$summaryHours['_rejected'] += $time;
				}
                else 
                {
                    if (!$entry->time_worked_default && !empty($timeWorkedTypes[$entry->time_worked_type_id]))
                    {
                        $timeWorked = $timeWorkedTypes[$entry->time_worked_type_id];

                        if (empty($summaryHours[$timeWorked->name]))
                        {
                            $summaryHours[$timeWorked->name] = 0;
                        }

                        $summaryHours[$timeWorked->name] += $time;
                    }
                    else
                    {
                        $summaryHours['_default'] += $time;
                    }

                    $summaryHours['_total'] += $time;
                    
                    if (isset($entry->billable) && !$entry->billable)
                    {
                        $summaryHours['_not_billable'] += $time;
                    }
                    else 
                    {
                        $summaryHours['_total_billable'] += $time;
                    }
                }
            }
		}

		if ($summaryHours['_rejected'] == 0)
		{
			unset($summaryHours['_rejected']);
		}

		foreach ($summaryHours as &$item)
		{
			$item = str_pad(intval($item / 60), 2, '0', STR_PAD_LEFT) . ':' . str_pad(intval($item % 60), 2, '0', STR_PAD_LEFT);
		}

		return $summaryHours;
	}

	/**
	 * Get events to frontend calendar
	 *
	 * @return array with all user logged items
	 */
	public function getEvents()
	{
		$this->_loadDateFormatHelper();
		$this->_loadNumberFormatHelper();

		$query = $this->getListQuery()
			->select(
				'CONCAT(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 3600,' .
				'":",LPAD(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 60 MOD 60, 2, "0")) AS ' . $this->_db->qn('summary')
			)
            ->select('SUM(rejected) AS ' . $this->_db->qn('rejected'))
			->group($this->_db->quoteName('date'));

		$this->_db->setQuery($query);

		$events = array();

		foreach ($this->_db->loadObjectList() as $item)
		{
			$events[] = array(
				'date'  => DateFormatterHelper::toMySQLFormat((int) strtotime($item->date)),
				'title' => $item->summary,
                'has_rejected' => $item->rejected > 0
			);
		}

		return $events;
	}

	public function getItem($id)
	{
		$query = $this->_getQuery()->where($this->_db->quoteName('worklog.id') . '=' . $this->_db->quote($id));
		$this->_db->setQuery($query);

		return $this->_db->loadAssoc();
	}

	private function _loadDateFormatHelper()
	{
		JLoader::register('DateFormatterHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'dateformatterhelper.php');
	}

	private function _loadNumberFormatHelper()
	{
		JLoader::register('NumberFormatterHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'numberformatterhelper.php');
	}

	public function getTableItems($id)
	{
		if ($id)
		{
			$this->_db->setQuery($this->getListQuery());
			$position = -1;

			foreach ($this->_db->loadAssocList() as $key => $value)
			{
				if ($value['id'] == $id)
				{
					$position = $key;
					break;
				}
			}

			$start = 0;

			if ($position >= 0)
			{
				$limit = $this->getState('list.limit');

				if ($limit)
				{
					$start = floor($position / $limit) * $limit;
				}
			}

			$this->setState('list.start', $start);
		}

        return $this->getItems();
    }
    
    public function getItems() {
        $items = parent::getItems();
        
        if (count($items)) {
            foreach ($items as &$item) {
                $item->date = strtotime($item->date);
            }
        }
        
        return $items;
    }

	/**
	 * Method to get a JPagination object for the data set.
	 *
	 * @return  JPagination  A JPagination object for the data set.
	 */
	public function getPagination()
	{
		$store = $this->getStoreId('getPagination');

		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		$limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
		$page  = new Pagination($this->getTotal(), $this->getStart(), $limit);

		$this->cache[$store] = $page;

		return $this->cache[$store];
	}

	public function isDisplayedAll()
	{
		return ($this->getPagination()->limit) ? $this->getTotal() <= $this->getPagination()->limit : true;
	}

	public function getDatePeriods($clientid = 0, $projectid = 0)
	{
		$query = $this->_db->getQuery(true)
			->select('MIN(' . $this->_db->quoteName('date') . ') AS min')
			->select('MAX(' . $this->_db->quoteName('date') . ') AS max')
			->from($this->_db->quoteName('#__tw_work_log', 'worklog'));

		if (($clientid && $projectid) || (!$clientid && $projectid))
		{
			$query->where($this->_db->quoteName('projectid') . '=' . $this->_db->quote($projectid));
		}
		elseif ($clientid)
		{
			$query->leftJoin($this->_db->quoteName('#__tw_projects', 'projects') . ' ON '
				. $this->_db->quoteName('worklog.projectid') . ' = ' . $this->_db->quoteName('projects.id'))
				->where($this->_db->quoteName('projects.clientid') . '=' . $clientid);
		}

		$this->_db->setQuery($query);
		$values = $this->_db->loadObject();

		$min = $this->dateFormat($values->min);
		$max = $this->dateFormat($values->max, false);

		$result = array();

		while ($this->dateFormat($min, false) != $this->dateFormat($max, false, true))
		{
			$timestamp = strtotime($min);
			$result[]  = array(
				'id'   => $min . '--' . $this->dateFormat($min, false),
				'name' => JText::_(strtoupper(date('F', $timestamp))) . ' ' . date('Y', $timestamp)
			);

			$min = $this->dateFormat($min, true, true);
		}
        $result = array_reverse($result);

		return $result;
	}

	private function dateFormat($date, $first = true, $next = false)
	{
		return date_create($date)->modify(($first ? 'first' : 'last') . ' day of ' . ($next ? 'next' : 'this') . ' month')->format('Y-m-d');
	}

	public function getIsNotBillableHours()
	{
		$query = $this->getListQuery()
			->where($this->_db->quoteName('worklog.billable') . '=' . $this->_db->quote(0))
			->group($this->_db->quoteName('worklog.billable'));

		$this->_db->setQuery($query);

		return !is_null($this->_db->loadResult());
	}

	public function setRejected($ids, $userid, $comment)
	{
		$idsString = '';
		$i         = 0;
		$count     = count($ids);

		foreach ($ids as $id)
		{
			$idsString .= $this->_db->q($id);

			if ($count != ++$i)
			{
				$idsString .= ', ';
			}
		}

		$query = $this->_db->getQuery(true)
			->update($this->_db->qn('#__tw_work_log'))
			->set(
				array(
					$this->_db->qn('rejected') . ' = ' . $this->_db->q('1'),
					$this->_db->qn('rejected_comment') . ' = ' . $this->_db->q($comment),
				)
			)
			->where(
				array(
					$this->_db->qn('id') . ' IN (' . $idsString . ')',
					$this->_db->qn('userid') . '=' . $this->_db->q($userid)
				)
			);

		$this->_db->setQuery($query);

		return $this->_db->execute();
	}

	/**
	 * @param JUser $user
	 */
	public function sendEmail($ids, $user, $comment)
	{
		$idsString = '';
		$i         = 0;
		$count     = count($ids);

		foreach ($ids as $id)
		{
			$idsString .= $this->_db->q($id);

			if ($count != ++$i)
			{
				$idsString .= ', ';
			}
		}

		$query = $this->_getQuery()->where($this->_db->qn('worklog.id') . ' IN (' . $idsString . ')');
		$this->_db->setQuery($query);
		$items = $this->_db->loadObjectList();

		$body = JText::sprintf('COM_TIMEWORKED_REJECTED_EMAIL_HEADER', $user->get('name'));

		foreach ($items as $item)
		{
			$body .= "- " . (empty($item->client_short_name) ? $item->company : $item->client_short_name) . " / " .
				(empty($item->project_short_name) ? $item->project_name : $item->project_short_name) . " / " .
				$item->user_name . " / " . DateFormatterHelper::format((int) $item->date) . " / " . $item->task . " / ";

			if (JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number'))
			{
				$body .= $item->performed_work . " / " . $item->ticket_numbers . " / " . $item->time . " hours\r\n";
			}
		}

		if ($comment)
		{
			$body .= JText::sprintf('COM_TIMEWORKED_REJECTED_EMAIL_COMMENT', $comment);
		}

		$config = JFactory::getConfig();
		$mailer = JFactory::getMailer();
		$mailer->setSender(
			array(
				$config->get('config.mailfrom'),
				$config->get('config.fromname')
			)
		);
		$mailer->addRecipient($user->get('email'), $user->get('name'));
		$mailer->isHtml(false);
		$mailer->setBody($body);
		$mailer->setSubject(JText::_('COM_TIMEWORKED_REJECTED_EMAIL_SUBJECT'));

		return $mailer->Send();
	}
    
    public function getStatByEmployee($userId = false)
    {
        $prevMonth = date('Y-m-d', mktime(0, 0, 0, date('n') - 1, 1));
        $tillDate = date('Y-m-d', mktime(0, 0, 0, date('n') + 1, 1));
        
        $query = $this->_db->getQuery(true)
            ->select(array(
                'TIME_TO_SEC(' . $this->_db->quoteName('worklog.time') . ') AS time',
                $this->_db->quoteName('users.name'),
                $this->_db->quoteName('users.id'),
                $this->_db->quoteName('users.block'),
                $this->_db->quoteName('timetype.short_name', 'timetype'),
                $this->_db->quoteName('timetype.name', 'timename'),
                $this->_db->quoteName('timetype.color'),
                $this->_db->quoteName('timetype.default'),
                $this->_db->quoteName('worklog.billable'),
                $this->_db->quoteName('worklog.rejected'),
                $this->_db->quoteName('worklog.date'),
                )
            )
            ->from($this->_db->quoteName('#__users', 'users'))
            ->leftJoin(
                $this->_db->quoteName('#__tw_work_log') .' AS worklog ON ' .
                $this->_db->quoteName('worklog.userid') . '=' . $this->_db->quoteName('users.id')
            )
            ->leftJoin(
                $this->_db->quoteName('#__tw_time_worked_type') . ' AS timetype ON ' .
                $this->_db->quoteName('timetype.id') . '=' . $this->_db->quoteName('worklog.timeworkedid')
            )
            ->where($this->_db->quoteName('worklog.date') . '>=' . $this->_db->q($prevMonth))
            ->where($this->_db->quoteName('worklog.date') . '<' . $this->_db->q($tillDate))
            ->order('users.name');
        
        if ($userId) {
            $query->where($this->_db->quoteName('users.id') . '=' . (int)$userId);
        }
        
        $this->_db->setQuery($query);
		$res = $this->_db->loadObjectList();
        
        return $this->_mapStatData($res);
    }
    
    public function getStatByProject($userId = false, $own = true)
    {
        $prevMonth = date('Y-m-d', mktime(0, 0, 0, date('n') - 1, 1));
        $tillDate = date('Y-m-d', mktime(0, 0, 0, date('n') + 1, 1));
        
        $query = $this->_db->getQuery(true)
            ->select(array(
                'TIME_TO_SEC(' . $this->_db->quoteName('worklog.time') . ') AS time',
                $this->_db->quoteName('projects.name'),
                $this->_db->quoteName('projects.id'),
                $this->_db->quoteName('projects.published'),
                $this->_db->quoteName('timetype.short_name', 'timetype'),
                $this->_db->quoteName('timetype.name', 'timename'),
                $this->_db->quoteName('timetype.color'),
                $this->_db->quoteName('timetype.default'),
                $this->_db->quoteName('worklog.billable'),
                $this->_db->quoteName('worklog.rejected'),
                $this->_db->quoteName('worklog.date'),
                )
            )
            ->from($this->_db->quoteName('#__tw_projects', 'projects'))
            ->leftJoin(
                $this->_db->quoteName('#__tw_work_log', 'worklog') . ' ON ' .
                $this->_db->quoteName('worklog.projectid') . '=' . $this->_db->quoteName('projects.id')
            )
            ->leftJoin(
                $this->_db->quoteName('#__tw_time_worked_type') . ' AS timetype ON ' .
                $this->_db->quoteName('timetype.id') . '=' . $this->_db->quoteName('worklog.timeworkedid')
            )
            ->where($this->_db->quoteName('worklog.date') . '>=' . $this->_db->q($prevMonth))
            ->where($this->_db->quoteName('worklog.date') . '<' . $this->_db->q($tillDate))
            ->order('projects.name');

        if ($userId) {
            $query->innerJoin(
                $this->_db->quoteName('#__tw_users_have_projects', 'user2project') . 'ON ' .
                $this->_db->quoteName('user2project.projectid') . '=' . $this->_db->quoteName('projects.id')
            )
            ->where($this->_db->quoteName('user2project.userid') . '=' . (int)$userId);
            if ($own) {
                $query->where($this->_db->quoteName('worklog.userid') . '=' . (int)$userId);
            }
        }
        
        $this->_db->setQuery($query);
		$res = $this->_db->loadObjectList();
        
        return $this->_mapStatData($res);
    }
    
    protected function _mapStatData($res)
    {
        $output = array('data' => array(), 'ttypes' => array());
        if (count($res)) {
            $today     = date('Y-m-d');
            $yesterday = date('Y-m-d', time() - 86400);
            $thisWeek  = date('Y-m-d', time() - (date('N') - 1) * 86400);
            $prevWeek  = date('Y-m-d', time() - (date('N') + 6) * 86400);
            $thisMonth = date('Y-m-d', mktime(0, 0, 0, date('n'), 1));
            
            foreach ($res as $row) {
                if (!isset($output['data'][$row->id])) {
                    $output['data'][$row->id] = array(
                        'name' => $row->name,
                        'today' => array(
                            'sum' => 0,
                            'rejected' => 0,
                            'not_billable' => 0,
                            'types' => array(),
                        ),
                        'yesterday' => array(
                            'sum' => 0,
                            'rejected' => 0,
                            'not_billable' => 0,
                            'types' => array(),
                        ),
                        'thisWeek' => array(
                            'sum' => 0,
                            'rejected' => 0,
                            'not_billable' => 0,
                            'types' => array(),
                        ),
                        'prevWeek' => array(
                            'sum' => 0,
                            'rejected' => 0,
                            'not_billable' => 0,
                            'types' => array(),
                        ),
                        'thisMonth' => array(
                            'sum' => 0,
                            'rejected' => 0,
                            'not_billable' => 0,
                            'types' => array(),
                        ),
                        'prevMonth' => array(
                            'sum' => 0,
                            'rejected' => 0,
                            'not_billable' => 0,
                            'types' => array(),
                        ),
                    );
                }
                $ttype = !empty($row->timetype) ? $row->timetype : $row->timename;
                if (!isset($output['ttypes'][$ttype])) {
                    $output['ttypes'][$ttype] = array(
                        'name' => $row->timename,
                        'color' => $row->color,
                    );
                }
                
                $sumTime = array('t' => 0, 'y' => 0, 'w1' => 0, 'w2' => 0, 'm1' => 0, 'm2' => 0);
                if ($row->date === $today) {
                    $sumTime['t'] = $row->time;
                    $sumTime['w1'] = $row->time;
                    $sumTime['m1'] = $row->time;
                } elseif ($row->date === $yesterday) {
                    $sumTime['y'] = $row->time;
                    $sumTime['w1'] = $row->time;
                    $sumTime['m1'] = $row->time;
                } else {
                    if ($row->date < $thisMonth) {
                        $sumTime['m2'] = $row->time;
                    } else {
                        $sumTime['m1'] = $row->time;
                    }
                    if ($row->date >= $prevWeek && $row->date < $thisWeek) {
                        $sumTime['w2'] = $row->time;
                    } elseif ($row->date >= $thisWeek) {
                        $sumTime['w1'] = $row->time;
                    }
                }
                
                if (!$row->rejected) {
                    $output['data'][$row->id]['today']['sum']     += $sumTime['t'];
                    $output['data'][$row->id]['yesterday']['sum'] += $sumTime['y'];
                    $output['data'][$row->id]['thisWeek']['sum']  += $sumTime['w1'];
                    $output['data'][$row->id]['prevWeek']['sum']  += $sumTime['w2'];
                    $output['data'][$row->id]['thisMonth']['sum'] += $sumTime['m1'];
                    $output['data'][$row->id]['prevMonth']['sum'] += $sumTime['m2'];
                    
                    if (!$row->default) {
                        if (!isset($output['data'][$row->id]['today']['types'][$ttype])) {
                            $output['data'][$row->id]['today']['types'][$ttype]     += 0;
                            $output['data'][$row->id]['yesterday']['types'][$ttype] += 0;
                            $output['data'][$row->id]['thisWeek']['types'][$ttype]  += 0;
                            $output['data'][$row->id]['prevWeek']['types'][$ttype]  += 0;
                            $output['data'][$row->id]['thisMonth']['types'][$ttype] += 0;
                            $output['data'][$row->id]['prevMonth']['types'][$ttype] += 0;
                        }
                        $output['data'][$row->id]['today']['types'][$ttype]     += $sumTime['t'];
                        $output['data'][$row->id]['yesterday']['types'][$ttype] += $sumTime['y'];
                        $output['data'][$row->id]['thisWeek']['types'][$ttype]  += $sumTime['w1'];
                        $output['data'][$row->id]['prevWeek']['types'][$ttype]  += $sumTime['w2'];
                        $output['data'][$row->id]['thisMonth']['types'][$ttype] += $sumTime['m1'];
                        $output['data'][$row->id]['prevMonth']['types'][$ttype] += $sumTime['m2'];
                    }
                    if (!$row->billable) {
                        $output['data'][$row->id]['today']['not_billable']     += $sumTime['t'];
                        $output['data'][$row->id]['yesterday']['not_billable'] += $sumTime['y'];
                        $output['data'][$row->id]['thisWeek']['not_billable']  += $sumTime['w1'];
                        $output['data'][$row->id]['prevWeek']['not_billable']  += $sumTime['w2'];
                        $output['data'][$row->id]['thisMonth']['not_billable'] += $sumTime['m1'];
                        $output['data'][$row->id]['prevMonth']['not_billable'] += $sumTime['m2'];
                    }
                } else {
                    $output['data'][$row->id]['today']['rejected']     += $sumTime['t'];
                    $output['data'][$row->id]['yesterday']['rejected'] += $sumTime['y'];
                    $output['data'][$row->id]['thisWeek']['rejected']  += $sumTime['w1'];
                    $output['data'][$row->id]['prevWeek']['rejected']  += $sumTime['w2'];
                    $output['data'][$row->id]['thisMonth']['rejected'] += $sumTime['m1'];
                    $output['data'][$row->id]['prevMonth']['rejected'] += $sumTime['m2'];
                }
                
            }
        }
        
        return $output;
        
    }
    
    public function getGraphData($date = false, $userId = false, $own = true)
    {
        if (!$date)
        {
            // get data for the last month
            $date = mktime(date('H'),date('i'),date('s'),date('m') - 1);
            
        }
        $formattedDate = date('Y-m-d', $date);
        
        $query = $this->_db->getQuery(true)
            ->select(array(
                'SUM( TIME_TO_SEC(' . $this->_db->quoteName('worklog.time') . ') ) AS time',
                $this->_db->quoteName('worklog.date'),
                $this->_db->quoteName('projects.id'),
                $this->_db->quoteName('projects.name'),
                $this->_db->quoteName('projects.color'),
            ))
            ->from($this->_db->quoteName('#__tw_work_log', 'worklog'))
            ->innerJoin(
                $this->_db->quoteName('#__tw_projects', 'projects') . ' ON ' .
                $this->_db->quoteName('projects.id') . '=' . $this->_db->quoteName('worklog.projectid')
            )
            ->where($this->_db->quoteName('worklog.rejected') . ' != 1')
            ->where($this->_db->quoteName('worklog.date') . ' > ' . $this->_db->quote($formattedDate))
            ->order(array($this->_db->quoteName('projects.name'), $this->_db->quoteName('worklog.date')))
            ->group(array($this->_db->quoteName('worklog.date'), $this->_db->quoteName('projects.id')));
        
        if ($userId) {
            if (!$own) {
                $query->innerJoin(
                    $this->_db->quoteName('#__tw_users_have_projects', 'user2project') . 'ON ' .
                    $this->_db->quoteName('user2project.projectid') . '=' . $this->_db->quoteName('projects.id')
                )
                ->where($this->_db->quoteName('user2project.userid') . '=' . (int)$userId);
            } else {
                $query->where($this->_db->quoteName('worklog.userid') . '=' . (int)$userId);
            }
        }
        
        $this->_db->setQuery($query);
		$res = $this->_db->loadObjectList();

        $output = array();
        $emptyData = array();
        $days = round( (time() - $date) / 86400 );
        for ($i = 0; $i < $days; $i ++) {
            $emptyData[] = array($i, 0);
        }
        foreach ($res as $row) 
        {
            if (!isset($output[$row->id])) {
                $output[$row->id] = array(
                    'color' => $row->color,
                    'data' => $emptyData,
                    'name' => $row->name,
                );
            }
            $dt = explode('-', $row->date);
            $ts = mktime(date('H'), date('i'), date('s'), $dt[1], $dt[2], $dt[0]);
            $x  = $days - round( (time() - $ts) / 86400 ) - 1;
            $output[$row->id]['data'][$x] = array($x, (int)$row->time);
        }
        // clear empty intervals
        foreach($output as &$proj) {
            $trimmed = false;
            while (!$trimmed && count($proj['data'])) {
                if (isset($proj['data'][1]) && $proj['data'][1][1] > 0) {
                    $trimmed = true;
                } else {
                    array_splice($proj['data'], 0, 1);
                }
            }
            $cnt = count($proj['data']);
            for ($i = 1; $i < $cnt - 1; $i ++) {
                if (!$proj['data'][$i][1] && !$proj['data'][$i-1][1] && !$proj['data'][$i+1][1]) {
                    array_splice($proj['data'], $i, 1);
                    $cnt --;
                    $i --;
                }
            }
        }
        
        return array_values($output);
    }
}
