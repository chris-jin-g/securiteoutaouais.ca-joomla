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
jimport('joomla.application.component.modellist');

/**
 * Model to see the list of work entries in the work log.
 */
class TimeWorkedModelLeaves extends JModelList
{
	/**
	 * @var array filters (name => type)
	 */
	private $filters = array();

	/**
	 * Constructor.
	 *
	 * @param array $config An optional associative array of configuration settings.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->filters = array(
			'user'             => 'uint',
			'hide_past_leaves' => 'uint',
			'dates'            => 'string',
		);
        JLoader::register('DateFormatterHelper', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_timeworked' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'dateformatterhelper.php');
        JLoader::register('UsersModelGroups', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_users' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'groups.php');
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string $ordering  An optional ordering field.
	 * @param   string $direction An optional direction (asc|desc).
	 *
	 * @return  void
	 */
	protected function populateState($ordering = 'start_date', $direction = 'asc')
	{
		$layout = JFactory::getApplication()->input->getString('layout');
		$input  = JFactory::getApplication()->input->get;

		if ($layout)
		{
			$this->context .= '.' . $layout;
		}

		foreach ($this->filters as $filter => $type)
		{
			$this->setState("filter." . $filter, $input->get("filter_" . $filter, ($filter == 'hide_past_leaves' ? 1 : null), $type));
		}

		parent::populateState($ordering, $direction);
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string $id An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 */
	protected function getStoreId($id = '')
	{
		foreach ($this->filters as $filter => $type)
		{
			$id .= ':' . $this->getState('filter.' . $filter);
		}

		return parent::getStoreId($id);
	}

	/**
	 * Get model form
	 *
	 * @return JForm form object
	 */
	public function getForm()
	{
		return JForm::getInstance('leaves', 'leave', array('control' => $this->name));
	}

	/**
	 * Store object
	 *
	 * @param JForm|object $form form to store
	 *
	 * @return boolean store status
	 */
	public function store($form)
	{
		$table = JTable::getInstance('Leave');

		switch (get_class($form))
		{
			case 'JForm':
            case 'Joomla\CMS\Form\Form':
				$data = $form->getData()->toArray();
				break;
			default:
				$data = (array) $form;
				break;
		}

		if (JFactory::getApplication()->input->getCmd('task') == 'save')
		{
			if ($data['id'] != 0)
			{
				$data['status']           = 0;
				$data['admin_commentary'] = '';
			}
		}

		$table->bind($data);

		if (!$table->store())
		{
			return false;
		}

		return true;
	}

	protected function getListQuery()
	{
		$editOrRemoveCondition = $this->_db->qn('leaves.user_id') . ' = ' . $this->_db->q(JFactory::getUser()->get('id')) . ' AND ' .
			$this->_db->qn('start_date') . '>= CURDATE()';

		$query = parent::getListQuery()
			->select(
				$this->_db->quoteName(
					array(
						'leaves.id', 'leaves.start_date', 'leaves.end_date', 'leaves.work_days', 'leave_type.name',
						'users.name', 'leaves.user_commentary', 'leaves.admin_commentary', 'leaves.status'
					),
					array(
						'id', 'start_date', 'end_date', 'work_days', 'leave_type',
						'username', 'user_commentary', 'admin_commentary', 'status'
					)
				)
			)
			->select(
				array(
					'IF(' . $editOrRemoveCondition .
					",CONCAT('index.php?option=com_timeworked&view=leaves&task=edit&id='," . $this->_db->qn('leaves.id') . "), '') AS " . $this->_db->qn('edit_url'),
					'IF(' . $editOrRemoveCondition .
					",CONCAT('index.php?option=com_timeworked&view=leaves&task=remove&id='," . $this->_db->qn('leaves.id') . "), '') AS " .
					$this->_db->qn('remove_url'),
					"IF(" . $this->_db->qn('leaves.status') . "<>" . $this->_db->q('1') .
					",CONCAT('index.php?option=com_timeworked&view=leaves&task=approve&id='," . $this->_db->qn('leaves.id') . "), '') AS " .
					$this->_db->qn('approve_url'),
					"IF(" . $this->_db->qn('leaves.status') . "<>" . $this->_db->q('2') .
					",CONCAT('index.php?option=com_timeworked&view=leaves&task=decline&id='," . $this->_db->qn('leaves.id') . "), '') AS " .
					$this->_db->qn('decline_url'),
					$this->_db->quoteName('leaves.user_id') . ' = ' . $this->_db->quote(JFactory::getUser()->get('id', 0)) . ' AS ' . $this->_db->quoteName('owner')
				)
			)
			->from($this->_db->quoteName('#__tw_leaves', 'leaves'))
			->leftJoin(
				$this->_db->quoteName('#__users', 'users') . ' ON ' . $this->_db->quoteName('users.id') . ' = ' . $this->_db->quoteName('leaves.user_id')
			)
			->leftJoin(
				$this->_db->quoteName('#__tw_leave_types', 'leave_type') .
				' ON ' . $this->_db->quoteName('leave_type.id') . ' = ' . $this->_db->quoteName('leaves.leave_type')
			)
			->order($this->_db->quoteName($this->state->get('list.ordering')) . ' ' . $this->_db->escape($this->state->get('list.direction')));

		$user           = $this->state->get('filter.user');
		$hidePastLeaves = $this->state->get('filter.hide_past_leaves');
		$dates          = $this->state->get('filter.dates');

        if (!ACLHelper::canManageLeaves()) 
        {
            $query->where($this->_db->quoteName('leaves.user_id') . '=' . $this->_db->quote(JFactory::getUser()->id));
        } 
        elseif ($user)
        {
            $query->where($this->_db->qn('users.id') . '=' . $this->_db->q($user));
        }

		if ($hidePastLeaves)
		{
			$query->where($this->_db->quoteName('start_date') . ' >= DATE_FORMAT(NOW() ,"%Y-01-01")');
		}

		if ($dates)
		{
			list($startDate, $endDate) = explode('--', $dates);

			$between = ' BETWEEN STR_TO_DATE(' . $this->_db->quote($startDate) . ', \'%Y-%m-%d\') AND STR_TO_DATE(' .
				$this->_db->quote($endDate) . ', \'%Y-%m-%d\')';

			$query->where('(' . $this->_db->quoteName('start_date') . $between . ' OR ' . $this->_db->quoteName('end_date') . $between . ')');
		}

		return $query;
	}

	public function getItem($id = null)
	{
		if ($id == null)
		{
			$id = JFactory::getApplication()->input->getUint('id', null);
		}

		$query = $this->_db->getQuery(true)
			->select('*')
			->from($this->_db->quoteName('#__tw_leaves'))
			->where($this->_db->quoteName('id') . '=' . $this->_db->quote($id));
		$this->_db->setQuery($query);

		return $this->_db->loadObject();
	}

	/**
	 * Method to get a JPagination object for the data set.
	 *
	 * @return  JPagination  A JPagination object for the data set.
	 */
	public function getPagination()
	{
		$store = $this->getStoreId('getPagination');

		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		$limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
		$page  = new LeavesPagination($this->getTotal(), $this->getStart(), $limit);

		$this->cache[$store] = $page;

		return $this->cache[$store];
	}

	public function remove($item)
	{
		$query = $this->_db->getQuery(true)
			->delete($this->_db->quoteName('#__tw_leaves'))
			->where($this->_db->quoteName('id') . ' = ' . $this->_db->quote($item->id));
		$this->_db->setQuery($query);

		return $this->_db->execute();
	}

	public function setApproved($item, $adminCommentary)
	{
		$item->status           = 1;
		$item->admin_commentary = $adminCommentary;

		return $this->store($item);
	}

	public function setDeclined($item, $adminCommentary)
	{
		$item->status           = 2;
		$item->admin_commentary = $adminCommentary;

		return $this->store($item);
	}

	public function getMonths()
	{
		JLoader::register(
			'DateFormatterHelper',
			JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'dateformatterhelper.php'
		);

		$listQuery = clone $this->getListQuery();
		$listQuery->clear('order');

		$queryStartDate = clone $listQuery;
		$queryStartDate
			->clear('select')
			->select('DATE_FORMAT(' . $this->_db->quoteName('leaves.start_date') . ', \'%Y-%m-01\') AS ' . $this->_db->quoteName('first_date'));

		$queryEndDate = clone $listQuery;
		$queryEndDate
			->clear('select')
			->select('DATE_FORMAT(' . $this->_db->quoteName('leaves.end_date') . ', \'%Y-%m-01\') AS ' . $this->_db->quoteName('first_date'));

		$query = $this->_db->getQuery(true)
			->select(
				array(
					'CONCAT(' . $this->_db->qn('first_date') . ', \'--\', ' . 'LAST_DAY(' . $this->_db->qn('first_date') . ')) AS ' . $this->_db->qn('value'),
					'DATE_FORMAT(' . $this->_db->quoteName('first_date') . ', \'%M\') AS ' . $this->_db->quoteName('month'),
					'DATE_FORMAT(' . $this->_db->quoteName('first_date') . ', \'%Y\') AS ' . $this->_db->quoteName('year'),
				)
			)
			->from('(' . $queryStartDate . ' UNION ' . $queryEndDate . ') AS ' . $this->_db->quoteName('date_table'))
			->group($this->_db->quoteName('first_date'))
			->order($this->_db->quoteName('first_date') . ' ASC');
		$this->_db->setQuery($query);

		$data       = $this->_db->loadObjectList();
		$cookieData = json_decode(JFactory::getApplication()->input->cookie->getString('filterDateLeaves'));
		$result     = array();

		if ($cookieData)
		{
			foreach ($cookieData as $item)
			{
				$result[] = array(
					'id'   => $item->start . '--' . $item->end,
					'name' => DateFormatterHelper::format($item->start) . ' — ' . DateFormatterHelper::format($item->end),
				);
			}
		}

		foreach ($data as $item)
		{
			$result[] = array(
				'id'   => $item->value,
				'name' => JText::_(strtoupper($item->month)) . ' ' . $item->year,
			);
		}

		return $result;
	}
    
    /**
     * 
     * @param JForm $leaveForm
     * @return void
     */
    public function notifyManagerByEmail($leaveFormData)
    {
        if (ACLHelper::isAdmin()) {
            return;
        }
        $recipients           = array();
        $curUser              = JFactory::getUser();
        $projModel            = JModelLegacy::getInstance('Project', 'TimeWorkedModel');
        $userModel            = JModelLegacy::getInstance('Users', 'TimeWorkedModel');;
        $projects             = $projModel->getProjects();
        $defaultManagerGroup  = JComponentHelper::getParams('com_timeworked')->get('default_manager_group');
        /* @var $leaveType TimeWorkedTableLeaveType */
        $leaveType            = JTable::getInstance('LeaveType', 'TimeWorkedTable');
        
        
        // find all project managers
        foreach ($projects as $project) {
            $users = $userModel->getUsers(0, $project->id);
            foreach ($users as $usr) {
                $user = JFactory::getUser($usr->id);
                if (in_array($defaultManagerGroup, $user->groups) && $user->id !== $curUser->id) {
                    if (!isset($recipients[$user->id])) {
                        $recipients[$user->id] = $user;
                    }
                }
            }
        }
        
        // notify all the leave managers
        $userGroupModel = new UsersModelGroups();
        $groups = $userGroupModel->getItems();
        if ($groups) {
            foreach ($groups as $group) {
                if (JAccess::checkGroup($group->id, 'core.leaves', 'com_timeworked')
                        || JAccess::checkGroup($group->id, 'core.admin', 'com_timeworked')) {
                    $users = JAccess::getUsersByGroup($group->id);
                    if (count($users)) {
                        foreach ($users as $userId) {
                            if (!isset($recipients[$userId]) && $userId !== $curUser->id) {
                                $recipients[$userId] = JFactory::getUser($userId);
                            }
                        }
                    }
                }
            }
        }
        
        if (!count($recipients)) {
            return;
        }
        
        $leaveType->load($leaveFormData->get('leave_type'));
        
        $dates = DateFormatterHelper::format($leaveFormData->get('start_date'))
            . ' - '
            . DateFormatterHelper::format($leaveFormData->get('end_date'));
        
        foreach ($recipients as $recipient) {
            $body = JText::sprintf('COM_TIMEWORKED_EMAIL_LEAVE_NOTIFICATION', 
                    $recipient->name,
                    $curUser->name,
                    $dates,
                    $leaveFormData->get('work_days'),
                    $leaveType->get('name'),
                    $leaveFormData->get('user_commentary')
                    );
            
            $mailer = JFactory::getMailer();
            $mailer->setSender(
                array(
                    JFactory::getConfig()->get('config.mailfrom'),
                    JFactory::getConfig()->get('config.fromname')
                )
            );
            $mailer->addRecipient($recipient->get('email'), $recipient->get('name'));
            $mailer->isHtml(true);
            $mailer->setBody(preg_replace('/\n/u', '<br>', $body));
            $mailer->setSubject(JText::sprintf('COM_TIMEWORKED_EMAIL_LEAVE_NOTIFICATION_SUBJECT', $curUser->name));
            $mailer->Send();
        }
    }
    
    /**
     * 
     * @param mixed $leave
     * @param bool $approved
     */
    public function notifyEmployeeByEmail($leave, $approved = true)
    {
        /* @var $leaveType TimeWorkedTableLeaveType */
        $leaveType = JTable::getInstance('LeaveType', 'TimeWorkedTable');
        $employee  = JFactory::getUser($leave->user_id);
        $manager   = JFactory::getUser($leave->modified_by);
        $state     = $approved ? 'APPROVED' : 'DECLINED';
        $dates     = DateFormatterHelper::format($leave->start_date)
                   . ' - '
                   . DateFormatterHelper::format($leave->end_date);
        
        $leaveType->load($leave->leave_type);
        
        $body = JText::sprintf('COM_TIMEWORKED_EMAIL_LEAVE_' . $state, 
                $employee->name,
                $manager->name,
                $dates,
                $leave->work_days,
                $leaveType->get('name'),
                $leave->user_commentary,
                $leave->admin_commentary
            );
        
        $mailer = JFactory::getMailer();
        $mailer->setSender(
            array(
                JFactory::getConfig()->get('config.mailfrom'),
                JFactory::getConfig()->get('config.fromname')
            )
        );
        $mailer->addRecipient($employee->get('email'), $employee->get('name'));
        $mailer->isHtml(true);
        $mailer->setBody(preg_replace('/\n/u', '<br>', $body));
        $mailer->setSubject(JText::sprintf('COM_TIMEWORKED_EMAIL_LEAVE_' . $state . '_SUBJECT'));
        $mailer->Send();
    }
}
