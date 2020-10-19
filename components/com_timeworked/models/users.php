<?php
defined('_JEXEC') or die;
/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */

class TimeWorkedModelUsers extends JModelLegacy
{
	public function getUsers($clientId = 0, $projectId = 0)
	{
		$query = $this->_db->getQuery(true)
			->select($this->_db->quoteName(array('users.id', 'users.name')))
			->select('UPPER(' . $this->_db->quoteName('users.name') . ') AS ' . $this->_db->quoteName('user_upper_name'))
			->from($this->_db->quoteName('#__users', 'users'));

		if ($clientId || $projectId)
		{
			$query->innerJoin(
				$this->_db->quoteName('#__tw_users_have_projects', 'users_have_projects') . ' ON ' .
				$this->_db->quoteName('users_have_projects.userid') . '=' . $this->_db->quoteName('users.id')
			);
		}

		if ($clientId && !$projectId)
		{
			$query
				->innerJoin(
					$this->_db->quoteName('#__tw_projects', 'projects') . ' ON ' .
					$this->_db->quoteName('projects.id') . '=' . $this->_db->quoteName('users_have_projects.projectid')
				)
				->innerJoin(
					$this->_db->quoteName('#__tw_clients', 'clients') . ' ON ' .
					$this->_db->quoteName('clients.id') . '=' . $this->_db->quoteName('projects.clientid')
				)
				->where($this->_db->quoteName('clients.id') . '=' . $this->_db->quote($clientId));
		}
		elseif ($projectId)
		{
			$query->where($this->_db->quoteName('users_have_projects.projectid') . '=' . $this->_db->quote($projectId));
		}

		$query
			->group($this->_db->quoteName('users.id'))
			->order($this->_db->quoteName('user_upper_name') . ' ASC');

		$this->_db->setQuery($query);

		return $this->_db->loadObjectList();
	}
}