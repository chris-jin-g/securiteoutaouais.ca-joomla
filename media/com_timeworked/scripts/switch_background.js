/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
(function ($) {
	$(document).ready(function () {
		var radio = $('#jform_set_background_color').find('input:checked'),
            label = $('#jform_set_background_color').find('label'),
            colorInput = $('#jform_color');

		changeState(~~radio.val());

		label.click(function (event) {
            var inp = $('#' + $(event.currentTarget).attr('for'));
            changeState(~~inp.val());
		});

		function changeState(enabled) {
			if (enabled) {
				colorInput.removeAttr('disabled');
			} else {
				colorInput.attr('disabled', 'disabled');
			}
		}
	});
})(jQuery);