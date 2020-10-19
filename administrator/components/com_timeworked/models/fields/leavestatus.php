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

class JFormFieldLeaveStatus extends JFormFieldList
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'leavestatus';

	/**
	 * {@inheritdoc}
	 */
	protected function getOptions()
	{
        $options = array(
            array(
                'value' => 0,
                'text'  => JText::_('COM_TIMEWORKED_LEAVE_STATUS_0'),
            ),
            array(
                'value' => 1,
                'text'  => JText::_('COM_TIMEWORKED_LEAVE_STATUS_1'),
            ),
            array(
                'value' => 2,
                'text'  => JText::_('COM_TIMEWORKED_LEAVE_STATUS_2'),
            ),
        );
        
        return json_decode(json_encode($options));
	}
}
