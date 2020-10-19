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

class JFormFieldTime extends JFormFieldText {
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'time';

	protected function getWickedpicker24Format($str) {
		if (empty($str) || !isset($str)) {
			$str = "5 : 00 PM";
		}
		$expl_arr_hours = explode(' : ', $str);
		$hours = $expl_arr_hours[0];
		$expl_arr_minutes = explode(' ', $expl_arr_hours[1]);
		$minutes = $expl_arr_minutes[0];
		if ($expl_arr_minutes[1] == "PM") {
			$hours += 12;
		}
		return $hours . ' : ' . $minutes;
	}

	public function getInput() {
		$document = JFactory::getDocument();
		$document->addStyleSheet(JUri::root() . '/media/com_timeworked/scripts/wickedpicker/dist/wickedpicker.min.css');
		$document->addScript(JUri::root() . '/media/com_timeworked/scripts/wickedpicker/dist/wickedpicker.min.js');
		$document->addScriptDeclaration('jQuery(document).ready(function(){jQuery("#' . $this->id . '").wickedpicker({now: "' . $this->getWickedpicker24Format($this->value) . '" ,title: \'Select check time\',showSeconds: false,minutesInterval: 1});})');
		return parent::getInput();
	}
}
