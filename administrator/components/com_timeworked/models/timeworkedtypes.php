<?php
/**
 * TimeTime Worked worked types model
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

class TimeWorkedModelTimeWorkedTypes extends JModelList
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array('id', 'name', 'short_name');
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

		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);
		parent::populateState('id', 'desc');
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.name');
		$id .= ':' . $this->getState('filter.indocator');

		return parent::getStoreId($id);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getListQuery()
	{
		$query  = $this->_db->getQuery(true)
			->select($this->_db->quoteName(array('id', 'name', 'short_name', 'color', 'default')))
			->from($this->_db->quoteName('#__tw_time_worked_type'));
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$search = $this->_db->quote('%' . $this->_db->escape($search, true) . '%');
			$query->where(array($this->_db->quoteName('name') . 'LIKE ' . $search, $this->_db->quoteName('short_name') . 'LIKE ' . $search), 'OR');
		}

		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		$query->order($this->_db->escape($orderCol . ' ' . $orderDirn));

		return $query;
	}

	/**
	 * Set default time worked type
	 *
	 * @param   int $id time worked type ID
	 */
	public function setDefault($id)
	{
		$query = $this->_db->getQuery(true)
			->update($this->_db->quoteName('#__tw_time_worked_type'))
			->set(array($this->_db->quoteName('default') . '=' . $this->_db->quote(0)));
		$this->_db->setQuery($query);
		$this->_db->execute();

		$query->set(array($this->_db->quoteName('default') . '=' . $this->_db->quote(1)))
			->where(array($this->_db->quoteName('id') . '=' . $this->_db->quote($id)));
		$this->_db->setQuery($query);
		$this->_db->execute();
	}

	/**
	 * Remove time worked type from DB
	 *
	 * @param   int $id time worked type ID
	 *
	 * @return mixed query result
	 */
	public function delete($id)
	{
		$query = $this->_db->getQuery(true)
			->delete($this->_db->quoteName('#__tw_time_worked_type'))
			->where(array($this->_db->quoteName('id') . '=' . $this->_db->quote($id)));
		$this->_db->setQuery($query);

		return $this->_db->execute();
	}
}
