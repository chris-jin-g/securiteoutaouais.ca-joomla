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

class TimeWorkedModelLeave_Types extends JModelList
{
	/**
	 * {@inheritdoc}
	 */
	protected function populateState($ordering = 'name', $direction = 'asc')
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
			->select('*')
			->from($this->_db->quoteName('#__tw_leave_types'))
			->order($this->_db->quoteName($this->state->get('list.ordering')) . ' ' . $this->_db->escape($this->state->get('list.direction')));

		return $query;
	}
}
