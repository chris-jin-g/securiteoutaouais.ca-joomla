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

class JFormFieldTimeWorked extends JFormFieldList
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'timeworked';

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
		$db      = JFactory::getDBO();
		$query   = $db->getQuery(true);
		$query
			->select($db->quoteName(array('id', 'name'), array('value', 'text')))
			->from($db->quoteName('#__tw_time_worked_type'))
			->order($db->quoteName('text'));
		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
}
