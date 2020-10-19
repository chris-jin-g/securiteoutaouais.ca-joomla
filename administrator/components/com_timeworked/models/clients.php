<?php
/**
 * TimeWorked Clients model
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

class TimeWorkedModelClients extends JModelList
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('company', 'contact_person', 'number_of_projects', 'number_of_people', 'total_hours', 'latest_activity');
		}

		parent::__construct($config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$layout = JFactory::getApplication()->input->get('layout');

		if ($layout)
		{
			$this->context .= '.' . $layout;
		}

		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		parent::populateState('company', 'asc');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.company');
		$id .= ':' . $this->getState('filter.contact_person');

		return parent::getStoreId($id);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getListQuery()
	{
		$query = $this->_db->getQuery(true)
			->select(
				$this->_db->qn(
					array(
						'clients.id', 'clients.company', 'clients.short_name', 'clients.published', 'clients.color', 'clients.contact_person',
						'clients.phone', 'clients.set_background_color'
					)
				)
			)
			->select(
				array(
					'(' . $this->_db->getQuery(true)
						->select('COUNT(*)')
						->from($this->_db->qn('#__tw_projects'))
						->where($this->_db->qn('clientid') . '=' . $this->_db->qn('clients.id')) . ') AS ' . $this->_db->qn('number_of_projects'),
					'(' . $this->_db->getQuery(true)
						->select('COUNT(DISTINCT ' . $this->_db->qn('users_have_projects.userid') . ')')
						->from($this->_db->qn('#__tw_projects', 'projects'))
						->leftJoin(
							$this->_db->qn('#__tw_users_have_projects', 'users_have_projects') . ' ON ' .
							$this->_db->qn('users_have_projects.projectid') . ' = ' . $this->_db->qn('projects.id')
						)
						->where($this->_db->qn('projects.clientid') . '=' . $this->_db->qn('clients.id')) . ') AS ' . $this->_db->qn('number_of_people'),
					'(' . $this->_db->getQuery(true)
						->select(
							'CONCAT(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 3600,' .
							'":",LPAD(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 60 MOD 60, 2, "0"))'
						)
						->from($this->_db->qn('#__tw_work_log', 'worklog'))
						->leftJoin($this->_db->qn('#__tw_projects', 'projects') . ' ON ' . $this->_db->qn('worklog.projectid') . ' = ' . $this->_db->qn('projects.id'))
						->where($this->_db->qn('projects.clientid') . '=' . $this->_db->qn('clients.id')) . ') AS ' . $this->_db->qn('total_hours'),
					'(' . $this->_db->getQuery(true)
						->select('GREATEST(MAX(' . $this->_db->qn('worklog.created') . '), MAX(' . $this->_db->qn('worklog.modified') . '))')
						->from($this->_db->qn('#__tw_work_log', 'worklog'))
						->leftJoin($this->_db->qn('#__tw_projects', 'projects') . ' ON ' . $this->_db->qn('worklog.projectid') . ' = ' . $this->_db->qn('projects.id'))
						->where($this->_db->qn('projects.clientid') . '=' . $this->_db->qn('clients.id')) . ') AS ' . $this->_db->qn('latest_activity'),
				)
			)
			->from($this->_db->quoteName('#__tw_clients', 'clients'));

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $this->_db->quote('%' . $this->_db->escape($search, true) . '%');
			$query->where(
				array(
					$this->_db->quoteName('company') . ' LIKE ' . $search,
					$this->_db->quoteName('contact_person') . ' LIKE ' . $search,
					$this->_db->quoteName('email') . ' LIKE ' . $search,
					$this->_db->quoteName('skype') . ' LIKE ' . $search,
					$this->_db->quoteName('phone') . ' LIKE ' . $search,
					$this->_db->quoteName('address') . ' LIKE ' . $search,
					$this->_db->quoteName('notes') . ' LIKE ' . $search,
					$this->_db->quoteName('phone') . ' LIKE ' . $search,
				),
				'OR'
			);
		}

		$query->order(
			$this->_db->escape($this->getState('list.ordering', 'clients.company')) . ' ' . $this->_db->escape($this->getState('list.direction', 'ASC'))
		);

		return $query;
	}
}
