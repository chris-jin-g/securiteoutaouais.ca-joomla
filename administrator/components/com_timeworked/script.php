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
defined('_JEXEC') or die('Restricted access');

class com_timeworkedInstallerScript
{
	public function postflight($type, $parent)
	{
		if ($type == 'install')
		{
			$employee = array(
				'parent_id' => 1,
				'title'     => 'Employee',
			);

			$manager = array(
				'parent_id' => 1,
				'title'     => 'Project Manager'
			);

			$employeeId = $this->_storeUserGroup($employee);
			$managerId  = $this->_storeUserGroup($manager);

			$viewLevel = $this->_buildViewLevelArray($employeeId);
			$viewLevel = $this->_buildViewLevelArray($managerId, $viewLevel);

			$this->_addIdsToRegisteredViewLevel($viewLevel);

			$viewLevel = array(
				$employeeId => array(
					'core.admin'    => 0,
					'core.manage'   => 0,
					'core.create'   => 1,
					'core.delete'   => 1,
					'core.edit'     => 0,
					'core.edit.own' => 1,
					'core.reports.assigned' => 0,
					'core.reports.all' => 0,
					'core.leaves' => 0,
				),
				$managerId  => array(
					'core.admin'    => 0,
					'core.manage'   => 0,
					'core.create'   => 1,
					'core.delete'   => 1,
					'core.edit'     => 1,
                    'core.edit.own' => 1,
					'core.reports.assigned' => 1,
					'core.reports.all' => 1,
					'core.leaves' => 1,
				)
			);
			$this->_addUserGroupsRights($viewLevel);

			$params = array(
				'enabled_ticket_number'    => '1',
				'required_ticket_numbers'  => '0',
				'bugtracker_url'           => '',
				'default_employee_group'   => $employeeId,
				'default_manager_group'    => $managerId,
				'clear_new_line_excel'     => '0',
				'excel_new_line_separator' => 'space',
				'not_billable_hours'       => '0',
				'reports_notifications'    => '0',
				'number_of_required_hours' => '0',
				'notifications_frequency'  => '0',
				'check_todays_hours'       => '1',
				'plugin_reports_check_time'=> '7 : 00 PM',
				'cron_simulator'           => '0',
				'cron_type'                => '1',
				'api_enabled'			   => '0'
			);
			$this->_setParamsDefaults($params);
		}
	}

	/**
	 * Add new user group to database
	 *
	 * @param array $data User Group table data
	 *
	 * @return bool|int false if not stored, int - id of stored user group
	 */
	private function _storeUserGroup($data)
	{
		JTable::addIncludePath(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'joomla' . DIRECTORY_SEPARATOR . 'database'
			. DIRECTORY_SEPARATOR . 'table' . DIRECTORY_SEPARATOR . 'usergroup.php');

		/**
		 * @var JTableUsergroup $userGroup user group
		 */
		$userGroup = JTable::getInstance('Usergroup');

		$stored = false;

		if ($userGroup->bind($data))
		{
			if ($userGroup->check())
			{
				if ($userGroup->store())
				{
					$stored = true;

					return $userGroup->id;
				}
			}
		}
		if (!$stored)
		{
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true)
				->select($db->quoteName('id'))
				->from($db->quoteName($userGroup->getTableName()));

			foreach ($data as $key => $value)
			{
				$query->where($db->quoteName($key) . ' = ' . $db->quote($value));
			}

			$db->setQuery($query);

			return intval($db->loadResult());
		}
	}

	/**
	 * Add to view levels array id
	 *
	 * @param int   $id         user group id
	 * @param array $viewLevels view levels array
	 *
	 * @return array update view levels array
	 */
	private function _buildViewLevelArray($id, $viewLevels = array())
	{
		if (is_int($id))
		{
			$viewLevels[] = $id;
		}

		return $viewLevels;
	}

	/**
	 * Add user groups to Registered access level
	 *
	 * @param array $data user groups ids
	 */
	private function _addIdsToRegisteredViewLevel($data)
	{
		if (!empty($data))
		{
			JTable::addIncludePath(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'joomla' . DIRECTORY_SEPARATOR . 'database'
				. DIRECTORY_SEPARATOR . 'table' . DIRECTORY_SEPARATOR . 'viewlevel.php');

			/**
			 * @var JTableViewlevel $viewLevel view level table
			 */
			$viewLevel = JTable::getInstance('Viewlevel');

			$title = 'Registered';

			$db    = JFactory::getDbo();
			$query = $db->getQuery(true)
				->select($db->quoteName('id'))
				->from($db->quoteName($viewLevel->getTableName()))
				->where($db->quoteName('title') . ' LIKE ' . $db->quote($title));
			$db->setQuery($query);
			$id = intval($db->loadResult());

			if ($id > 0)
			{
				$viewLevel->load($id);
				$rules = json_decode($viewLevel->get('rules'));
				$diff  = array_diff($data, $rules);
				$rules = array_merge($rules, $diff);
				$viewLevel->set('rules', json_encode($rules));

				if ($viewLevel->check())
				{
					$viewLevel->store();
				}
			}
			else
			{
				$object = array(
					'title'    => $title,
					'rules'    => json_encode($data),
					'ordering' => '0'
				);

				if ($viewLevel->bind($object))
				{
					if ($viewLevel->check())
					{
						$viewLevel->store();
					}
				}
			}
		}
	}

	private function _addUserGroupsRights($ids)
	{
		JTable::addIncludePath(JPATH_LIBRARIES . DIRECTORY_SEPARATOR . 'joomla' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'table' . DIRECTORY_SEPARATOR . 'asset.php');

		/**
		 * @var JTableAsset $asset view level table
		 */
		$asset = JTable::getInstance('Asset');

		$component = 'com_timeworked';

		$loaded = $asset->loadByName($component);

		if ($loaded)
		{
			$rules = json_decode($asset->get('rules'), true);
		}
		else
		{
			$rules = array();
		}

		foreach ($ids as $id => $value)
		{
			foreach ($value as $key => $item)
			{
				$rules[$key][$id] = $item;
			}
		}

		$rules = json_encode($rules);

		if ($loaded)
		{
			$asset->set('rules', $rules);
		}
		else
		{
			$item = array(
				'parent_id' => '1',
				'level'     => '1',
				'name'      => $component,
				'title'     => $component,
				'rules'     => $rules
			);
			$asset->bind($item);
		}

		if ($asset->check())
		{
			$asset->store();
		}
	}

	/**
	 * Set joomla component default params values
	 */
	private function _setParamsDefaults($params)
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true)
			->update($db->quoteName('#__extensions'))
			->set($db->quoteName('params') . ' = ' . $db->quote(json_encode($params)))
			->where($db->quoteName('name') . ' = ' . $db->quote('com_timeworked'));
		$db->setQuery($query);
		$db->execute();
	}
}
