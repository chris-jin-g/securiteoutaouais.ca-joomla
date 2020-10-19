<?php
/**
 * TimeWorked Work entry model
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

class TimeWorkedModelWorkEntry extends JModelAdmin
{
	/**
	 * {@inheritdoc}
	 */
	public function getForm($data = array(), $loadData = true)
	{
		/**
		 * @var JForm $form
		 */
		$form = $this->loadForm('com_timeworked.workentry', 'workentry', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		if (!JComponentHelper::getParams('com_timeworked')->get('required_ticket_numbers'))
		{
			$form->setFieldAttribute('ticket_numbers', 'required', 'false');
		}

		if (!JComponentHelper::getParams('com_timeworked')->get('enabled_ticket_number'))
		{
			$form->removeField('ticket_numbers');
		}

		return $form;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTable($type = 'worklog', $prefix = 'TimeWorkedTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState('com_timeworked.edit.workentry.data', array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function prepareTable($table)
	{
		parent::prepareTable($table);

		$user = JFactory::getUser();
		$date = JFactory::getDate();

		if (empty($table->userid))
		{
			$table->userid = $user->get('id');
		}

		if (empty($table->id))
		{
			$table->created    = $date->toSql();
			$table->created_by = $user->get('id');
		}
		else
		{
			$table->modified    = $date->toSql();
			$table->modified_by = $user->get('id');
		}
	}

	public function getItem($pk = null)
	{
		$item = parent::getItem($pk);

		if (isset($item->time))
		{
			$time = explode(':', $item->time);
			unset($time[2]);
			$item->time = implode(':', $time);
		}
		return $item;
	}
    
	public function getTasksList($projectId)
	{
        if ($projectId) {
            $db = JFactory::getDbo();

            $query = $db->getQuery(true)
                    ->select($db->quoteName(array('t.id', 't.task'), array('value', 'text')))
                    ->from($db->qn('#__tw_tasks') . ' AS t')
                    ->innerJoin($db->qn('#__tw_projects_have_tasks') . ' AS pt ON (t.id = pt.taskid)')
                    ->where('pt.projectid = ' . $db->q($projectId));

            $db->setQuery($query);

            $options = $db->loadObjectList();
        } else {
            $options = array();
        }

		return $options;
	}
	
	public function getProjectName($projectId)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select($db->quoteName(array('t.id', 't.name'), array('value', 'text')))
			->from($db->qn('#__tw_projects') . ' AS t')
			->where('t.id = ' . $db->q($projectId));

		$db->setQuery($query);

		return $db->loadObjectList();
	}
//select * from secur_tw_clients where id = (select clientid from secur_tw_projects where id = 2);
	public function getProjectManager($projectId)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select($db->quoteName(array('clientid'), array('value')))
			->from($db->qn('#__tw_projects'))
			->where('id = ' . $db->q($projectId));

		$db->setQuery($query);

		$clientId = $db->loadObjectList()[0]->value;
		
		$query = $db->getQuery(true)
			->select($db->quoteName(array('company', 'short_name', 'phone', 'address'), 
				array('company', 'short_name', 'phone', 'address')))
			->from($db->qn('#__tw_clients'))
			->where('id = ' . $db->q($clientId));
		
		$db->setQuery($query);

		return $db->loadObjectList();
	}

	public function getUserName($userId)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select($db->quoteName(array('u.id', 'u.name', 'u.phone', 'u.email'), array('value', 'name', 'phone', 'email')))
			->from($db->qn('#__users') . ' AS u')
			->where('u.id = ' . $db->q($userId));

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	public function getAddProjectSameDate($user_id, $compare_date)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select($db->quoteName(array('u.id', 'u.projectid', 'u.userid', 'u.date', 'u.task', 'u.to', 'u.from'), array('id', 'projectid', 'userid', 'date', 'task', 'to', 'from')))
			->from($db->qn('#__tw_work_log') . ' AS u')
			->where('u.to LIKE ' . $db->q($compare_date))
			->where('u.userid=' . $db->q($user_id));

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	public function getEditProjectSameDate($user_id, $compare_date, $report_id)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select($db->quoteName(array('u.id', 'u.projectid', 'u.userid', 'u.date', 'u.task', 'u.to', 'u.from'), array('id', 'projectid', 'userid', 'date', 'task', 'to', 'from')))
			->from($db->qn('#__tw_work_log') . ' AS u')
			->where('u.to LIKE ' . $db->q($compare_date))
			->where('u.userid=' . $db->q($user_id))
			->where('NOT u.id= ' . $db->q($report_id));

		$db->setQuery($query);

		return $db->loadObjectList();
	}

	public function getSMSOption($userId)
	{
		$db = JFactory::getDbo();

		$query = $db->getQuery(true)
			->select($db->quoteName(array('u.id', 'u.smsnotification'), array('value', 'smsOption')))
			->from($db->qn('#__users') . ' AS u')
			->where('u.id = ' . $db->q($userId));

		$db->setQuery($query);

		return $db->loadObjectList();
	}

    public function validate($form, $data, $group = null)
    {
        if (!JComponentHelper::getParams('com_timeworked')->get('enabled_tasks_list')) {
            $form->removeField('taskid');
        } else {
            $form->setFieldAttribute('task', 'required', 'false');
        }
		if (!JComponentHelper::getParams('com_timeworked')->get('required_performed_work')) {
			$form->setFieldAttribute('performed_work', 'required', 'false');
		}
        return parent::validate($form, $data, $group);
	}
}
