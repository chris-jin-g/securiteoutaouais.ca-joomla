<?php
/**
 * TimeWorked Task model
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

class TimeWorkedModelTask extends JModelAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_timeworked.task', 'task', array('control' => 'jform', 'load_data' => $loadData));

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
		$item = parent::getItem($id);
        $item->projects_update = $this->getProjects($id);

		return $item;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTable($type = 'tasks', $prefix = 'TimeWorkedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_timeworked.edit.task.data', array());

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
		if (!$this->setProjects($data['projects_update'], $data['id']))
		{
			return false;
		}

        if (!isset($data['published'])) 
        {
            $data['published'] = 0;
        }

		return parent::save($data);
	}

	/**
	 * Method to get a list of projects, which are linked to the task.
	 *
	 * @return array An object list
	 */
	private function getProjects($taskId = null)
	{
        $taskId = $taskId ? (int) $taskId : (int) $this->getState('task.id');
        
		$query = $this->_db->getQuery(true)
			->select($this->_db->quoteName('p.id'))
			->from($this->_db->quoteName('#__tw_projects_have_tasks', 'pt'))
			->innerJoin($this->_db->quoteName('#__tw_projects', 'p') . ' ON '
				. $this->_db->quoteName('p.id') . ' = ' . $this->_db->quoteName('pt.projectid'))
			->where($this->_db->quoteName('pt.taskid') . ' = ' . $this->_db->q($taskId))
			->order($this->_db->quoteName('p.name') . ' ASC');
		$this->_db->setQuery($query);

		return $this->_db->loadColumn();
	}

	/**
	 * Method to update list of projects linked to the task.
	 *
	 * @param   array   $projects Primary keys of projects.
	 * @param   integer $id       Primary key of task.
	 *
	 * @return array Array of ids staff users.
	 */
	private function setProjects($projects = array(), $id = null)
	{
		if ($id < 1)
		{
			return true;
		}

		$projects = (array) $projects;
		$taskId   = (int) $id;
		$oldProjects = $this->getProjects($taskId);

		$removeProjects = array_diff($oldProjects, $projects);
		$addProjects    = array_diff($projects, $oldProjects);

		$query = $this->_db->getQuery(true);

		if ($removeProjects)
		{
			foreach ($removeProjects as $key => $userId)
			{
				$removeProjects[$key] = (int) $userId;
			}

			$removeProjectsStr = implode(',', $removeProjects);
			$query->delete($this->_db->quoteName('#__tw_projects_have_tasks'))
				->where($this->_db->quoteName('taskid') . ' = ' . $this->_db->quote($taskId))
				->where($this->_db->quoteName('projectid') . " IN ($removeProjectsStr)");
			$this->_db->setQuery($query);

			if (!$this->_db->execute())
			{
				$this->setError($this->_db->getErrorMsg());

				return false;
			}
		}

		if ($addProjects)
		{
			$query->insert($this->_db->quoteName('#__tw_projects_have_tasks'))
                  ->columns($this->_db->quoteName(array('taskid', 'projectid')));

			foreach ($addProjects as $projectId)
			{
				$query->values($taskId . ', ' . (int)$projectId);
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