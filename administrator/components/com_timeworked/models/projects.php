<?php
/**
 * TimeWorked Projects model
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

class TimeWorkedModelProjects extends JModelList
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('name', 'description', 'company', 'number_of_people', 'total_hours', 'latest_activity');
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

		$company = $this->getUserStateFromRequest($this->context . '.filter.company', 'filter_company', '', 'int');
		$this->setState('filter.company', $company);
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		parent::populateState('name', 'asc');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.name');
		$id .= ':' . $this->getState('filter.clientid');
		$id .= ':' . $this->getState('filter.company');

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
						'projects.id', 'projects.name', 'projects.short_name', 'projects.published', 'projects.color', 'projects.description',
						'projects.clientid', 'projects.set_background_color', 'clients.company'
					)
				)
			)
            ->select($this->_db->qn('clients.published', 'client_published'))
			->select(
				array(
					'(' . $this->_db->getQuery(true)
						->select('COUNT(DISTINCT ' . $this->_db->qn('userid') . ')')
						->from($this->_db->qn('#__tw_users_have_projects'))
						->where($this->_db->qn('projects.id') . '=' . $this->_db->qn('projectid')) . ') AS ' . $this->_db->qn('number_of_people'),
					'(' . $this->_db->getQuery(true)
						->select(
							'CONCAT(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 3600,' .
							'":",LPAD(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 60 MOD 60, 2, "0"))'
						)
						->from($this->_db->qn('#__tw_work_log'))
						->where($this->_db->qn('projectid') . '=' . $this->_db->qn('projects.id')) . ') AS ' . $this->_db->qn('total_hours'),
					'(' . $this->_db->getQuery(true)
						->select('GREATEST(MAX(' . $this->_db->qn('created') . '), MAX(' . $this->_db->qn('modified') . '))')
						->from($this->_db->qn('#__tw_work_log'))
						->where($this->_db->qn('projectid') . '=' . $this->_db->qn('projects.id')) . ') AS ' . $this->_db->qn('latest_activity'),
				)
			)
			->from($this->_db->quoteName('#__tw_projects', 'projects'))
			->leftJoin($this->_db->qn('#__tw_clients', 'clients') . ' ON ' . $this->_db->qn('clients.id') . ' = ' . $this->_db->qn('projects.clientid'));

		$company = $this->getState('filter.company');

		if ($company)
		{
			$query->where($this->_db->quoteName('projects.clientid') . ' = ' . $this->_db->quote($company));
		}

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $this->_db->quote('%' . $this->_db->escape($search, true) . '%');
			$query->where(
				array(
					$this->_db->quoteName('projects.name') . ' LIKE ' . $search,
					$this->_db->quoteName('projects.description') . ' LIKE ' . $search,
					$this->_db->quoteName('clients.company') . ' LIKE ' . $search
				),
				'OR');
		}

		$query->order(
			$this->_db->escape($this->getState('list.ordering', 'clients.company')) . ' ' . $this->_db->escape($this->getState('list.direction', 'ASC'))
		);

		return $query;
	}

	/**
	 * Method to get a list of clients, which have at least one project.
	 *
	 * @return array An object list of identifiers and company names of clients.
	 */
	public function getClients()
	{
		$query = $this->_db->getQuery(true)
			->select('DISTINCT(' . $this->_db->quoteName('clients.id') . ')')
			->select($this->_db->quoteName('clients.company'))
			->from($this->_db->quoteName('#__tw_projects', 'projects'))
			->leftJoin($this->_db->quoteName('#__tw_clients', 'clients') . ' ON '
				. $this->_db->quoteName('clients.id') . ' = ' . $this->_db->quoteName('projects.clientid'))
			->where($this->_db->quoteName('clients.id') . ' IS NOT NULL')
			->order($this->_db->quoteName('clients.company') . ' ASC');
		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}
    
    public function unpublishProjectsByClient($clientId)
    {
        $query = $this->_db->getQuery(true)
                ->update($this->_db->qn('#__tw_projects'))
                ->set($this->_db->qn('published') . ' = 0')
                ->where($this->_db->qn('clientid') . ' = ' . $this->_db->q($clientId));
        
        $this->_db->setQuery($query)->execute();
    }
}
