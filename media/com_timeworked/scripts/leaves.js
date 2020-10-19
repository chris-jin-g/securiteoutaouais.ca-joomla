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
		// Set moment.js language
		moment.locale($.TimeWorked.momentLang);

		// Add form functionality
		$('.tw-form').leaveForm();

		// Add list functionality
		$('.list').leaveList();

		// Add filters functionality
		$('#tw-filter-bar').leaveFilters();

		// Table settings
		$('.tw-column-toggle').hideColumns({
			table    : '#leaves-data',
			cookieVar: 'leavesDataColumns'
		});

		// Add form slider
		$('.tw-slide-switcher').formSlider({
			cookiePrefix: 'tw_'
		});

		// Set text color
		$('.change-color').changeColor();
	});
})(jQuery);
