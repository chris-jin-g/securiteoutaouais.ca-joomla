<?php
/**
 * TimeWorked Tasks model
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

class TimeWorkedModelTasks extends JModelList
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('task');
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

		$task = $this->getUserStateFromRequest($this->context . '.filter.task', 'filter_task', '', 'int');
		$this->setState('filter.task', $task);
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		parent::populateState('task', 'asc');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.task');

		return parent::getStoreId($id);
	}

    protected function getListQuery()
	{
		$query = $this->_db->getQuery(true)
			->select('*')
			->from($this->_db->qn('#__tw_tasks', 't'));

		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $this->_db->quote('%' . $this->_db->escape($search, true) . '%');
			$query->where(
				array(
					$this->_db->quoteName('t.task') . ' LIKE ' . $search,
				),
				'OR');
		}

		$query->order(
			$this->_db->escape($this->getState('list.ordering', 't.task')) . ' ' . $this->_db->escape($this->getState('list.direction', 'ASC'))
		);

		return $query;
	}
}
