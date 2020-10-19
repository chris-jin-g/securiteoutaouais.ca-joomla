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

/**
 * Class Missed
 */
class Missed {
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
   * @var bool isPluginRequest used to detect request source
   * true for plugins
   * false for cron tasks
   *
   */
  protected $isPluginRequest = false;

  /**
   * Prepare cron
   */
  public function __construct($isPluginRequest) {
    $this->isPluginRequest = $isPluginRequest;
    $this->db = JFactory::getDbo();
    $this->params = JComponentHelper::getParams('com_timeworked');
    JLoader::register(
      'DateFormatterHelper',
      JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_timeworked' . DIRECTORY_SEPARATOR .
      'helpers' . DIRECTORY_SEPARATOR . 'dateformatterhelper.php'
    );
  }



  public function run()
  {

    if ($this->isWeekend())
    {
      return null;
    }

    return $this->doTask();
  }

  /**
   *
   */
  protected function isAbleToAddCurrentDayToMissedList(){
    if(!$this->isPluginRequest){
      return true;
    }
    $settingsSavedTime = $this->params->get('plugin_reports_check_time');

    //current hours in 24 format
    $currentTime = new DateTime();

    $expl_arr_hours = explode(' : ', $settingsSavedTime);
    $settingsHours = $expl_arr_hours[0];
    $expl_arr_AMPM = explode(' ', $expl_arr_hours[1]);
    $settingsMinutes = $expl_arr_AMPM[0];

    if ($expl_arr_AMPM[1] == "PM") {
      $settingsHours += 12;
    }
    $settingsTime  = new DateTime();
    $settingsTime->setTime($settingsHours, $settingsMinutes);
    if($currentTime>=$settingsTime){
      return true;
    }else{
      return false;
    }
  }

  /**
   * Notify users about missing hours
   */
  protected function doTask()
  {

    $minHours              = $this->params->get('number_of_required_hours') * 3600;
    $notificationDaysCount = $this->params->get('notification_days_count');
    $dates = array();
    $weekends = $this->params->get('weekends');

    $i = ($this->params->get('check_todays_hours') && $this->isAbleToAddCurrentDayToMissedList()) ? 0 : 1;
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
    $user = JFactory::getUser();


    $records = $this->getRecords(key($dates),$user->id);

    $leaves = $this->getLeaves($user->id);



    $userDates = $dates;

    foreach ($userDates as $key => $value)
    {
      foreach ($leaves as $leave)
      {
        if ($key >= $leave['start_date'] && $key <= $leave['end_date'])
        {
          unset($userDates[$key]);
        }
      }
    }

    foreach ($records as $record)
    {
      if (isset($userDates[$record['date']]))
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
      return $userDates;
    }else
    {

      return null;
    }




  }


  /**
   * Get work log records for current period
   *
   * @return mixed records
   */
  protected function getRecords($firstDate,$userId)
  {

    $query = $this->db->getQuery(true)
      ->select(
        $this->db->qn(array('date'))
      )
      ->select('SUM(TIME_TO_SEC(' . $this->db->qn('time') . ')) AS ' . $this->db->qn('time'))
      ->from($this->db->qn('#__tw_work_log'))
      ->where($this->db->qn('date') . ' >= ' . $this->db->q($firstDate))
      ->where($this->db->qn('userid') . ' = ' . $this->db->q($userId))
      ->group($this->db->qn(array('date')))
      ->order($this->db->qn('date') . ' ASC');



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
  protected function getLeaves($userid)
  {
    $query = $this->db->getQuery(true)
      ->select($this->db->qn(array('start_date', 'end_date')))
      ->from($this->db->qn('#__tw_leaves'))
      ->where($this->db->qn('status') . '=1')
      ->where($this->db->qn('user_id') . ' = ' . $this->db->q($userid))
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