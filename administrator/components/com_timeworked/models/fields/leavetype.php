<?php
/**
 * Time worked type field type
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
JFormHelper::loadFieldClass('list');

class JFormFieldLeaveType extends JFormFieldList
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'leavetype';

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true)
			->select($db->quoteName(array('id', 'name'), array('value', 'text')))
			->from($db->quoteName('#__tw_leave_types'))
			->order($db->quoteName('text'));
		$db->setQuery($query);

		$emptyValue        = new stdClass();
		$emptyValue->value = '';
		$emptyValue->text  = JText::_('COM_TIMEWORKED_SELECT_LEAVE_TYPE');

		return array_merge(array($emptyValue), $db->loadObjectList());
	}
}
