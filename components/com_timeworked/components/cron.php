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

class Cron
{
	/**
	 * @var JDatabaseDriver database connection
	 */
	protected $db;

	/**
	 * @var JRegistry com_timeworked parameters
	 */
	protected $params;
    
    /**
     * @var int Hours used as additional condition in detecting of processes 
     * are being runned. The parameter is designed to prevent total stopping 
     * of the notifier in case if some previous process hasn't been marked as 
     * finished for some reason
     */
    protected $checkpointHours = 5;

	/**
	 * Prepare cron
	 */
	public function __construct()
	{
		$this->db     = JFactory::getDbo();
		$this->params = JComponentHelper::getParams('com_timeworked');
		JLoader::register(
			'DateFormatterHelper',
			JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_timeworked' . DIRECTORY_SEPARATOR .
			'helpers' . DIRECTORY_SEPARATOR . 'dateformatterhelper.php'
		);
	}

	/**
	 * Is the job runned at current time
	 *
	 * @return bool is runned or not
	 */
	public function isRunned()
	{
        $checkpoint = mktime(date('H') - $this->checkpointHours);
        
        $query = $this->db->getQuery(true)
                ->select('COUNT(*)')
                ->from($this->db->qn('#__tw_notifications'))
                ->where($this->db->qn('in_process') . ' = 1')
                ->where($this->db->qn('time') . '>= ' . $this->db->q(date('Y:m:d H:i:s', $checkpoint)));
        
        $this->db->setQuery($query);

		return !!$this->db->loadResult();
	}

	/**
	 * Enter point to cron
     * @todo The checking logic needs to be improved
	 */
	public function run()
	{
        if ($this->isRunned() || $this->isWeekend())
        {
            return;
        }

		$this->doTask();
	}

	/**
	 * Notify users about missing hours
	 */
	protected function doTask()
	{
        
		$query = $this->db->getQuery(true)
			->insert($this->db->qn('#__tw_notifications'))
			->columns($this->db->qn('time'))
			->values($this->db->q(date('Y-m-d H:i:s')));
		
        $this->db->setQuery($query);
		$this->db->execute();
        
        $rowId = $this->db->insertid();

        $minHours              = $this->params->get('number_of_required_hours') * 3600;
		$notificationDaysCount = $this->params->get('notification_days_count');

		$dates = array();
        $weekends = $this->params->get('weekends');
        
        $i = $this->params->get('check_todays_hours') ? 0 : 1;
        while (count($dates) < $notificationDaysCount) 
        {
            $time = strtotime( -$i . ' days');

			if (!$this->isWeekend($time))
			{
				$dates[date('Y-m-d', $time)] = 0;
			}
            $i ++;
        }
        $dates = array_reverse($dates, true);
        
		$records = $this->getRecords(key($dates));
		$leaves = $this->getLeaves();
		$users = $this->getUsers();


		foreach ($users as $user)
		{
			$userDates = $dates;

			foreach ($userDates as $key => $value)
			{
				foreach ($leaves as $leave)
				{
					if (($user['id'] == $leave['user_id']) && ($key >= $leave['start_date'] && $key <= $leave['end_date']))
					{
						unset($userDates[$key]);
					}
				}
			}

			foreach ($records as $record)
			{
				if (($user['id'] == $record['userid']) && isset($userDates[$record['date']]))
				{
					if ($record['time'] < $minHours)
					{
						$userDates[$record['date']] = $record['time'];
					}
					else
					{
						unset($userDates[$record['date']]);
					}
				}
			}

			if (!empty($userDates))
			{
				$this->sendEmail($user, $userDates);
			}
		}
        
        $query = $this->db->getQuery(true)
            ->update($this->db->qn('#__tw_notifications'))
            ->set($this->db->qn('in_process') . ' = 0')
            ->where($this->db->qn('id') . ' = ' . $rowId);
        
        $this->db->setQuery($query)->execute();
	}

	/**
	 * Get work log records for current period
	 *
	 * @return mixed records
	 */
	protected function getRecords($firstDate)
	{
		$query = $this->db->getQuery(true)
			->select(
				$this->db->qn(array('userid', 'date'))
			)
			->select('SUM(TIME_TO_SEC(' . $this->db->qn('time') . ')) AS ' . $this->db->qn('time'))
			->from($this->db->qn('#__tw_work_log'))
			->where($this->db->qn('date') . ' >= ' . $this->db->q($firstDate))
			->group($this->db->qn(array('userid', 'date')))
			->order($this->db->qn('userid') . 'ASC,' . $this->db->qn('date') . ' ASC');

		if (!$this->params->get('check_todays_hours'))
		{
			$query->where($this->db->qn('date') . ' < CURDATE()');
		}

		$this->db->setQuery($query);

		return $this->db->loadAssocList();
	}

	/**
	 * Get list of leaves for current period
	 *
	 * @return mixed leaves list
	 */
	protected function getLeaves()
	{
		$query = $this->db->getQuery(true)
			->select($this->db->qn(array('start_date', 'end_date', 'user_id')))
			->from($this->db->qn('#__tw_leaves'))
            ->where($this->db->qn('status') . '=1')
			->where($this->db->qn('end_date') . ' >= CURDATE() - INTERVAL ' . $this->db->q($this->params->get('notification_days_count')) . ' DAY');
		$this->db->setQuery($query);

		return $this->db->loadAssocList();
	}

	/**
	 * Get users with projects
	 *
	 * @return mixed list of users
	 */
	protected function getUsers()
	{
		$query = $this->db->getQuery(true)
			->select($this->db->qn(array('users.id', 'users.name', 'users.email')))
			->from($this->db->qn('#__tw_users_have_projects', 'relation'))
			->leftJoin($this->db->qn('#__users', 'users') . ' ON ' . $this->db->qn('relation.userid') . '=' . $this->db->qn('users.id'))
            ->where($this->db->qn('block') . ' = 0')
			->group($this->db->qn('userid'))
			->order($this->db->qn('users.id') . ' ASC');
		$this->db->setQuery($query);

		return $this->db->loadAssocList();
	}

	/**
	 * Send email to user
	 *
	 * @param array $user  user data
	 * @param array $dates array with missing dates for user
	 */
	protected function sendEmail($user, $dates)
	{
		$datesString = '';

		foreach ($dates as $date => $hours)
		{
			$datesString .= '— ' . DateFormatterHelper::format($date) . "\r\n";
		}

		$lang         = JFactory::getLanguage();
		$extension    = 'com_timeworked';
		$base_dir     = JPATH_BASE;
		$language_tag = 'en-GB';
		$reload       = true;
		$lang->load($extension, $base_dir, $language_tag, $reload);

		$config = JFactory::getConfig();
		$mailer = JFactory::getMailer();
		$mailer->setSender(
			array(
				$config->get('config.mailfrom'),
				$config->get('config.fromname')
			)
		);
		$mailer->addRecipient($user['email'], $user['name']);
		$mailer->isHtml(false);
		$mailer->setBody(JText::sprintf('COM_TIMEWORKED_MISSING_REPORTS_NOTIFICATION_LETTER', $user['name'], $datesString));
		$mailer->setSubject(JText::_('COM_TIMEWORKED_MISSING_REPORTS_NOTIFICATION_THEME'));
		$mailer->Send();
	}
    
    /**
     * Is Weekend
     * @param int $timestamp [OPTIONAL] UNIX timestamp. 
     * @return boolean Returns TRUE if the given date is weekend
     */
    protected function isWeekend($timestamp = null)
    {
        if (is_null($timestamp)) {
            $timestamp = time();
        }
        $weekends = $this->params->get('weekends');
        if (!is_array($weekends)) {
            return false;
        }
        return in_array(date('N', $timestamp), $weekends);
    }
}
