<?php
/**
 * TimeWorked Work log model
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
jimport('joomla.application.component.modellist');

class TimeWorkedModelWorkLog extends JModelList
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('id', 'project_name', 'date', 'task', 'ticket_numbers', 'hours', 'user_name');
		}

		parent::__construct($config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$layout = JRequest::getVar('layout');

		if ($layout)
		{
			$this->context .= '.' . $layout;
		}

		$project = $this->getUserStateFromRequest($this->context . '.filter.project', 'filter_project', '');
		$this->setState('filter.project', $project);
		$staff = $this->getUserStateFromRequest($this->context . '.filter.staff', 'filter_staff', '');
		$this->setState('filter.staff', $staff);
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		parent::populateState('date', 'desc');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.date');
		$id .= ':' . $this->getState('filter.task');
		$id .= ':' . $this->getState('filter.ticket_numbers');
		$id .= ':' . $this->getState('filter.time');

		return parent::getStoreId($id);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getListQuery()
	{
        $taskSetting = (int)JComponentHelper::getParams('com_timeworked')->get('enabled_tasks_list');
		$query = $this->_db->getQuery(true)
			->select($this->_db->quoteName(array('worklog.id', 'worklog.date', 'worklog.ticket_numbers')))
            ->select('IF(' . $taskSetting . ', tasks.task, worklog.task) AS task')
			->select(
				array(
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
					array('projects.id', 'projects.name', 'users.id', 'users.name'),
					array('project_id', 'project_name', 'user_id', 'user_name')
				)
			)
			->from($this->_db->quoteName('#__tw_work_log', 'worklog'))
			->leftJoin(
				$this->_db->quoteName('#__tw_projects', 'projects') . ' ON ' . $this->_db->quoteName('worklog.projectid') .
				' = ' . $this->_db->quoteName('projects.id')
			)
			->leftJoin(
				$this->_db->quoteName('#__tw_clients', 'clients') . ' ON ' . $this->_db->quoteName('clients.id') .
				' = ' . $this->_db->quoteName('projects.clientid')
			)
			->leftJoin(
				$this->_db->quoteName('#__users', 'users') . ' ON ' . $this->_db->quoteName('worklog.userid') . ' = ' . $this->_db->quoteName('users.id')
			)
            ->leftJoin(
				$this->_db->quoteName('#__tw_tasks', 'tasks') . ' ON ' .
				$this->_db->quoteName('worklog.taskid') . '=' . $this->_db->quoteName('tasks.id')
			)
			->order($this->_db->quoteName($this->getState('list.ordering', 'date')) . ' ' . $this->_db->escape($this->getState('list.direction', 'desc')));

		$project = $this->getState('filter.project');

		if (is_numeric($project))
		{
			$query->where($this->_db->quoteName('worklog.projectid') . ' = ' . $this->_db->quote(intval($project)));
		}

		$staff = $this->getState('filter.staff');

		if (is_numeric($staff))
		{
			$query->where($this->_db->quoteName('worklog.userid') . ' = ' . $this->_db->quote(intval($staff)));
		}

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = '%' . $this->_db->escape($search, true) . '%';
			$query->where(
				array(
					$this->_db->quoteName('worklog.date') . ' LIKE ' . $this->_db->quote($search),
					$this->_db->quoteName('worklog.task') . ' LIKE ' . $this->_db->quote($search),
					$this->_db->quoteName('worklog.performed_work') . ' LIKE ' . $this->_db->quote($search),
					$this->_db->quoteName('worklog.ticket_numbers') . ' LIKE ' . $this->_db->quote($search),
					$this->_db->quoteName('projects.name') . ' LIKE ' . $this->_db->quote($search)
				),
				'OR'
			);
		}

		return $query;
	}

	/**
	 * Method to get a list of projects, which have at least one work entry.
	 *
	 * @return  array   An object list of identifiers and names of projects.
	 */
	public function getProjects()
	{
		$query = $this->_db->getQuery(true)
			->select(
				array(
					'DISTINCT(' . $this->_db->quoteName('p.id') . ')',
					$this->_db->quoteName('p.name')
				)
			)
			->from($this->_db->quoteName('#__tw_work_log', 'wl'))
			->leftJoin($this->_db->quoteName('#__tw_projects', 'p') . ' ON ' . $this->_db->quoteName('p.id') . ' = ' . $this->_db->quoteName('wl.projectid'))
			->order($this->_db->quoteName('p.name') . ' ASC')
			->where($this->_db->quoteName('p.id') . ' IS NOT NULL');
		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}

	/**
	 * Method to get a list of users, which work at least on one project.
	 *
	 * @return  array   An object list of identifiers and names of users.
	 */
	public function getStaff()
	{
		$query = $this->_db->getQuery(true)
			->select(
				array(
					'DISTINCT(' . $this->_db->quoteName('u.id') . ')',
					$this->_db->quoteName('u.name')
				)
			)
			->from($this->_db->quoteName('#__tw_work_log', 'wl'))
			->leftJoin($this->_db->qn('#__users', 'u') . ' ON ' . $this->_db->qn('u.id') . ' = ' . $this->_db->qn('wl.userid'))
			->order($this->_db->quoteName('u.name') . ' ASC')
			->where($this->_db->quoteName('u.id') . ' IS NOT NULL');
		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}
}