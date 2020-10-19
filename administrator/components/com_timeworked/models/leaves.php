<?php
/**
 * TimeWorked LEaves model
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
jimport('joomla.application.component.modellist');

class TimeWorkedModelLeaves extends JModelList
{
    public static $STATUS_PENDING  = 0;
    public static $STATUS_APPROVED = 1;
    public static $STATUS_REJECTED = 2;
    
    /**
	 * {@inheritdoc}
	 */
	protected function populateState($ordering = 'start_date', $direction = 'desc')
	{
		$layout = JFactory::getApplication()->input->get('layout');

		if ($layout)
		{
			$this->context .= '.' . $layout;
		}

		parent::populateState($ordering, $direction);
	}

	protected function getListQuery()
	{
		$query = parent::getListQuery()
			->select(
				$this->_db->quoteName(
					array(
						'leaves.id', 'leaves.start_date', 'leaves.end_date', 'leaves.work_days', 'leave_type.name',
						'users.name', 'leaves.user_commentary', 'leaves.admin_commentary', 'leaves.status', 'users.id',
						'leaves.leave_type'
					),
					array(
						'id', 'start_date', 'end_date', 'work_days', 'leave_type',
						'username', 'user_commentary', 'admin_commentary', 'status', 'user_id',
						'leave_id'
					)
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

		return $query;
	}
    
    public function changeStatus($cid, $status, $comment = '')
    {
        if (is_array($cid)) {
            foreach ($cid as $k => $v) {
                $cid[$k] = (int)$v;
            }
        } else {
            $cid = array((int)$cid);
        }
        $query = $this->_db->getQuery(true)
            ->update($this->_db->qn('#__tw_leaves'))
            ->set($this->_db->qn('status') . ' = ' . (int)$status)
            ->set($this->_db->qn('admin_commentary') . ' = ' . $this->_db->q($comment))
            ->where($this->_db->qn('id') . ' IN (' . implode(',', $cid) . ')');
        
        $this->_db->setQuery($query)->execute();
    }
}
