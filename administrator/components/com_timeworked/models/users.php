<?php
/**
 * TimeWorked Users model
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

class TimeWorkedModelUsers extends JModelList
{
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

		parent::populateState('name', 'asc');
	}

	protected function getListQuery()
	{
		$query = parent::getListQuery()
			->select($this->_db->quoteName(array('users.id', 'users.name', 'users.email')))
			->select(
				array(
					'COUNT(' . $this->_db->quoteName('user_projects.projectid') . ') AS ' . $this->_db->qn('number_of_projects'),
					'(' . $this->_db->getQuery(true)
						->select(
							'CONCAT(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 3600,' .
							'":",LPAD(SUM(TIME_TO_SEC(' . $this->_db->qn('time') . ')) DIV 60 MOD 60, 2, "0"))'
						)
						->from('#__tw_work_log')
						->where($this->_db->quoteName('userid') . '=' . $this->_db->quoteName('users.id'))
					. ') AS ' . $this->_db->qn('total_hours'),
					'(' . $this->_db->getQuery(true)
						->select('GREATEST(MAX(' . $this->_db->qn('created') . '), MAX(' . $this->_db->qn('modified') . '))')
						->from($this->_db->qn('#__tw_work_log'))
						->where($this->_db->qn('userid') . '=' . $this->_db->qn('users.id')) . ') AS ' . $this->_db->qn('latest_activity'),
					'(' . $this->_db->getQuery(true)
						->select('GROUP_CONCAT(' . $this->_db->qn('usergroups.title') . ' SEPARATOR ", ")')
						->from($this->_db->quoteName('#__usergroups', 'usergroups'))
						->leftJoin(
							$this->_db->quoteName('#__user_usergroup_map', 'usergroup_map') . ' ON '
							. $this->_db->quoteName('usergroup_map.group_id') . '=' . $this->_db->quoteName('usergroups.id')
						)
						->where($this->_db->qn('usergroup_map.user_id') . '=' . $this->_db->qn('users.id')) . ') AS ' . $this->_db->qn('groups')
				)
			)
			->from($this->_db->quoteName('#__users', 'users'))
            ->where($this->_db->qn('users.block') . ' = 0')
			->leftJoin(
				$this->_db->quoteName('#__tw_users_have_projects', 'user_projects') . ' ON '
				. $this->_db->quoteName('user_projects.userid') . '=' . $this->_db->quoteName('users.id')
			)
			->group($this->_db->qn('users.id'))
			->order(
				$this->_db->escape($this->getState('list.ordering', 'users.name')) . ' ' . $this->_db->escape($this->getState('list.direction', 'ASC'))
			);

		return $query;
	}
}
