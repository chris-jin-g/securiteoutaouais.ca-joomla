<?php
/**
 * Styled radiobutton field type
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
JFormHelper::loadFieldClass('radio');

class JFormFieldDaily extends JFormFieldRadio
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'daily';

	protected function getInput()
	{
		$document = JFactory::getDocument();
		$document->addStyleDeclaration(
			'#' . $this->id . ' .btn-success.active,#' . $this->id . ' .btn-danger.active' .
			'{background-color:#e6e6e6;border-color:#bbb;color:#333}'
		);
		$document->addScriptDeclaration(
			'jQuery(document).ready(function(){function changeState(){var e=jQuery("#jform_notifications_days");' .
			'if(jQuery("#' . $this->id . '0").is(":checked"))e.attr("disabled", "disabled");else e.removeAttr("disabled");' .
			'jQuery.each(jQuery(".chzn-done"),function(index,value){jQuery(value).trigger("liszt:updated")});}changeState();' .
			'jQuery("label[for=' . $this->id . '0]").click(changeState);jQuery("label[for=' . $this->id . '1]").click(changeState)})'
		);

		return parent::getInput();
	}
}
