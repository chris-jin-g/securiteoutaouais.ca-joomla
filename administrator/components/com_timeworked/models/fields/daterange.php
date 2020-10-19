<?php
/**
 * Date field type
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

class JFormFieldDateRange extends JFormField
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'daterange';

	/**
	 * {@inheritdoc}
	 */
	protected function getInput()
	{
		$readonly = '';
		$required = '';

		if ($this->readonly)
		{
			$readonly = ' readonly="readonly"';
		}

		if ($this->required)
		{
			$required = ' aria-required="true" required="required"';
		}

		return '<div class="input-append">
		<input type="text" value="" id="' . $this->id . '" name="' . $this->name . '"' . $readonly . $required . '>
		<button id="' . $this->id . '_img" class="btn" type="button"><i class="icon-calendar"></i></button></div>';
	}
}
