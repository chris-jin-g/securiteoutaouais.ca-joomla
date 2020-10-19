<?php
/**
 * TimeWorked User model
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

class TimeWorkedModelUser extends JModelAdmin
{
	protected $table = '#__tw_users_have_projects';

	/**
	 * {@inheritdoc}
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_timeworked.user', 'user', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	public function getProjects($userId)
	{
		$this->_db->setQuery(
			$this->_db->getQuery(true)
				->select($this->_db->quoteName(array('id', 'name')))
				->select('IF(' . $this->_db->quoteName('id') . ' IN ('
					. $this->_db->getQuery(true)
						->select('projectid')
						->from($this->table)
						->where($this->_db->quoteName('userid') . '=' . $this->_db->quote($userId))
					. '), ' . $this->_db->quote('1') . ', ' . $this->_db->quote('0') . ') AS ' . $this->_db->quoteName('user_project')
				)
				->from('#__tw_projects')
				->where($this->_db->quoteName('published') . '=' . $this->_db->quote('1'))
				->order($this->_db->quoteName('name') . ' ASC')
		);

		return $this->_db->loadObjectList();
	}

	public function store($userId, $userProjects)
	{
        $query = $this->_db->getQuery(true)
               ->delete($this->_db->qn($this->table))
               ->where( array( $this->_db->qn('userid') . '=' . $this->_db->q($userId) ) );
        
        $this->_db->setQuery($query)->execute();
        
        if (is_array($userProjects) && count($userProjects)) {
            $query->clear()
                  ->insert($this->_db->qn($this->table))
                  ->columns($this->_db->qn(array('userid', 'projectid')));

            foreach ($userProjects as $projectId) {
                $query->values($this->_db->q($userId) . ',' . $this->_db->q($projectId));
            }
            $this->_db->setQuery($query)->execute();
        }
	}
}
