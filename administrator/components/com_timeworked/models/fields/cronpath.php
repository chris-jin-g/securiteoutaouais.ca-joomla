<?php
/**
 * Text input for time input
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
JFormHelper::loadFieldClass('text');

class JFormFieldCronpath extends JFormFieldText
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'cronpath';

	public function getInput()
	{
		$this->value = JPATH_ROOT . DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'com_timeworked_notifications.php';

		return parent::getInput();
	}
}
