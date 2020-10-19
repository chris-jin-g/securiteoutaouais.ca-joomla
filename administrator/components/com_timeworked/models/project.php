<?php
/**
 * TimeWorked Project model
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
jimport('joomla.application.component.modeladmin');

class TimeWorkedModelProject extends JModelAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_timeworked.project', 'project', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getItem($id = null)
	{
		$item               = parent::getItem($id);
		$item->staff_update = $this->_getStaff($id);

		return $item;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTable($type = 'projects', $prefix = 'TimeWorkedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_timeworked.edit.project.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function save($data)
	{
		if (!$this->_setStaff($data['staff_update'], $data['id']))
		{
			return false;
		}

		if (!isset($data['set_background_color']))
		{
			$data['set_background_color'] = 0;
		}
        if (!isset($data['published'])) 
        {
            $data['published'] = 0;
        }

		return parent::save($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete(&$pks)
	{
		$ids = (array) $pks;

		foreach ($ids as $id)
		{
			if (!$this->_setStaff(array(), $id))
			{
				return false;
			}
		}

		return parent::delete($pks);
	}

	/**
	 * Method to get staff of project.
	 *
	 * @param   integer $id Primary key of project.
	 *
	 * @return array Array of ids staff users.
	 */
	private function _getStaff($id = null)
	{
		$projectId = $id ? (int) $id : (int) $this->getState('project.id');

		$query = $this->_db->getQuery(true)
			->select($this->_db->quoteName('userid'))
			->from($this->_db->quoteName('#__tw_users_have_projects'))
			->where($this->_db->quoteName('projectid') . ' = ' . $this->_db->quote($projectId));
		$this->_db->setQuery($query);
		$users = $this->_db->loadColumn();

		return $users;
	}

	/**
	 * Method to update list of staff of project.
	 *
	 * @param   array   $users Primary keys of users.
	 * @param   integer $id    Primary key of project.
	 *
	 * @return array Array of ids staff users.
	 */
	private function _setStaff($users = array(), $id = null)
	{
		if ($id < 1)
		{
			return true;
		}

		$users     = (array) $users;
		$projectId = (int) $id;
		$oldUsers  = $this->_getStaff($projectId);

		$removeUsers = array_diff($oldUsers, $users);
		$addUsers    = array_diff($users, $oldUsers);

		$query = $this->_db->getQuery(true);

		if ($removeUsers)
		{
			foreach ($removeUsers as $key => $userId)
			{
				$removeUsers[$key] = (int) $userId;
			}

			$removeUsersStr = implode(',', $removeUsers);
			$query->delete($this->_db->quoteName('#__tw_users_have_projects'))
				->where($this->_db->quoteName('projectid') . ' = ' . $this->_db->quote($projectId))
				->where($this->_db->quoteName('userid') . " IN ($removeUsersStr)");
			$this->_db->setQuery($query);

			if (!$this->_db->execute())
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		if ($addUsers)
		{
			$query->insert($this->_db->quoteName('#__tw_users_have_projects'));

			$defaultEmployeeGroup = JComponentHelper::getParams('com_timeworked')->get('default_employee_group');
            $defaultManagerGroup  = JComponentHelper::getParams('com_timeworked')->get('default_manager_group');

			foreach ($addUsers as $userId)
			{
				$userId = (int) $userId;
				$query->values('NULL,' . $userId . ', ' . $projectId);

                $user = JFactory::getUser($userId);
                if (!in_array($defaultEmployeeGroup, $user->groups) && !in_array($defaultManagerGroup, $user->groups)) {
                    try
                    {

                        $this->_db->setQuery($this->_db->getQuery(true)
                            ->insert($this->_db->quoteName('#__user_usergroup_map'))
                            ->columns($this->_db->quoteName(array('user_id', 'group_id')))
                            ->values($this->_db->quote($userId) . ',' . $this->_db->quote($defaultEmployeeGroup)));
                        $this->_db->execute();
                    } catch (RuntimeException $e){

                    }
				}
			}

			$this->_db->setQuery($query);

			if (!$this->_db->execute())
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		return true;
	}
}