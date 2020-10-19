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
defined('_JEXEC') or die;

class TimeWorkedModelWorkentry extends JModelLegacy
{
	/**
	 * Model context string.
	 *
	 * @var        string
	 */
	protected $_context = 'com_timeworked.workentry';

	/**
	 * Item
	 *
	 * @var stdClass
	 */
	private $_item;

	/**
	 * @var array database store errors
	 */
	private $_storeErrors;

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since    1.6
	 */
	protected function populateState()
	{
		$app    = JFactory::getApplication();
		$params = $app->getParams();

		// Load the object state.
		$id = $app->input->getInt('id');
		$this->setState('workentry.id', $id);

		// Load the parameters.
		$this->setState('params', $params);
	}

	/**
	 * Method to get an ojbect.
	 *
	 * @param    integer    The id of the object to get.
	 *
	 * @return    mixed    Object on success, false on failure.
	 */
	public function &getItem($id = null)
	{
		if ($this->_item === null)
		{
			$this->_item = false;

			if (empty($id))
			{
				$id = $this->getState('workentry.id');
			}

			$table = JTable::getInstance('WorkLog', 'TimeWorkedTable');

			if ($table->load($id))
			{
				$properties  = $table->getProperties(1);
				$this->_item = JArrayHelper::toObject($properties, 'JObject');

				unset($this->_item->created);
				unset($this->_item->created_by);
				unset($this->_item->modified);
				unset($this->_item->modified_by);
				unset($this->_item->checked_out);
				unset($this->_item->checked_out_time);

				if (!JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number'))
				{
					unset($this->_item->ticket_numbers);
				}

				$from = explode(':', $this->_item->from);
				unset($from[2]);
				$this->_item->from = implode(':', $from);

				$to = explode(':', $this->_item->to);
				unset($to[2]);
				$this->_item->to = implode(':', $to);

				$time = explode(':', $this->_item->time);
				unset($time[2]);
				$this->_item->time = implode(':', $time);
			}
			elseif ($error = $table->getError())
			{
				$this->setError($error);
			}
		}
		
		return $this->_item;
	}

	public function store(JForm $form)
	{
		$table = JTable::getInstance('WorkLog', 'TimeWorkedTable');

		$table->bind($form->getData()->toArray());

		if (!$table->store())
		{
			$this->_storeErrors = $table->getErrors();

			return false;
		}

		return true;
	}

	public function getStoreErrors()
	{
		return $this->_storeErrors;
	}

	public function getStoredObject($id = null)
	{
		if (is_null($id))
		{
			$id = $this->_db->insertid();
		}

		$worklogModel = JModelLegacy::getInstance('WorkLog', 'TimeWorkedModel');

		return $worklogModel->getItem($id);
	}

	public function getFormFields()
	{
		return array(
			'id'             => 'string',
			'projectid'      => 'string',
			'task'           => 'string',
            'taskid'         => 'string',
			'performed_work' => 'string',
			'ticket_numbers' => 'string',
			'from'           => 'string',
			'to'           	 => 'string',
			'time'           => 'string',
			'timeworkedid'   => 'string',
			'userid'         => 'string',
			'date'           => 'string',
		);
	}

	public function remove($id)
	{
		$query = $this->_db->getQuery(true)
			->delete($this->_db->quoteName('#__tw_work_log'))
			->where($this->_db->quoteName('id') . '=' . $this->_db->quote($id));
		$this->_db->setQuery($query);

		if ($this->_db->execute())
		{
			$query = $this->_db->getQuery(true)
				->select('MIN(' . $this->_db->quoteName('id') . ')')
				->from($this->_db->quoteName('#__tw_work_log'))
				->where($this->_db->quoteName('id') . '>' . $this->_db->quote($id));
			$this->_db->setQuery($query);
			$min = $this->_db->loadResult();

			if (is_null($min))
			{
				$query = $this->_db->getQuery(true)
					->select('MAX(' . $this->_db->quoteName('id') . ')')
					->from($this->_db->quoteName('#__tw_work_log'))
					->where($this->_db->quoteName('id') . '<' . $this->_db->quote($id));
				$this->_db->setQuery($query);

				return $this->_db->loadResult();
			}
			else
			{
				return $min;
			}
		}
		else
		{
			return false;
		}
	}

	public function getTasksName($search, $project)
	{
		$query = $this->_db->getQuery(true)
			->select('DISTINCT ' . $this->_db->quoteName('task'))
			->from($this->_db->quoteName('#__tw_work_log'))
			->where(
				array(
					$this->_db->quoteName('task') . ' LIKE "%' . $this->_db->escape($search) . '%"',
					$this->_db->quoteName('userid') . '=' . $this->_db->quote(JFactory::getUser()->id)
				)
			);

		if ($project)
		{
			$query->where($this->_db->quoteName('projectid') . ' = ' . $this->_db->quote($project));
		}

		$this->_db->setQuery($query);

		return $this->_db->loadColumn();
	}

	public function getTasksList($projectId)
	{
        if ($projectId) {
            $db = JFactory::getDbo();

            $query = $db->getQuery(true)
                    ->select($db->quoteName(array('t.id', 't.task'), array('value', 'text')))
                    ->from($db->qn('#__tw_tasks') . ' AS t')
                    ->innerJoin($db->qn('#__tw_projects_have_tasks') . ' AS pt ON (t.id = pt.taskid)')
                    ->where('t.published = 1')
                    ->where('pt.projectid = ' . $db->q($projectId));

            $db->setQuery($query);

            $options = $db->loadObjectList();
        } else {
            $options = array();
        }

		return $options;
	}
    
    public function getFormGroupId()
	{
		return 'workentry';
	}

	public function getRejectedInfo($id)
	{
		$query = $this->_db->getQuery(true)
			->select($this->_db->qn(array('worklog.id', 'worklog.userid', 'users.name')))
			->select('TIME_FORMAT(' . $this->_db->quoteName('worklog.time') . ', \'%k:%i\') AS time')
			->from($this->_db->qn('#__tw_work_log', 'worklog'))
			->leftJoin($this->_db->qn('#__users', 'users') . ' ON ' . $this->_db->qn('users.id') . '=' . $this->_db->qn('worklog.userid'))
			->where($this->_db->qn('worklog.id') . '=' . $this->_db->q($id));

		$this->_db->setQuery($query);

		return $this->_db->loadObject();
	}

	public function removeRejected($id)
	{
		$this->_db->setQuery(
			$this->_db->getQuery(true)
				->update($this->_db->quoteName('#__tw_work_log'))
				->set(
					array(
						$this->_db->quoteName('rejected') . '=' . $this->_db->quote('0'),
						$this->_db->quoteName('rejected_comment') . '=' . $this->_db->quote(''),
					)
				)
				->where($this->_db->quoteName('id') . '=' . $this->_db->quote($id))
		);
		$this->_db->execute();
	}

	public function setBillable($id, $status)
	{
		$this->_db->setQuery(
			$this->_db->getQuery(true)
				->update($this->_db->quoteName('#__tw_work_log'))
				->set($this->_db->quoteName('billable') . ' = ' . $this->_db->quote($status))
				->where($this->_db->quoteName('id') . ' = ' . $this->_db->quote($id))
		);

		$this->_db->execute();
	}

	public function setRejected($entryId, $userId)
	{
		$query = $this->_db->getQuery(true)
			->update($this->_db->qn('#__tw_work_log'))
			->set(
				array(
					$this->_db->qn('rejected') . ' = ' . $this->_db->q('1'),
				)
			)
			->where(
				array(
					$this->_db->qn('id') . ' = ' . $this->_db->q($entryId),
				)
			);

		$this->_db->setQuery($query);

		return $this->_db->execute();
	}
}
