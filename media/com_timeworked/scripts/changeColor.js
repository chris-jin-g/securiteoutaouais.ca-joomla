/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
(function ($) {
	/**
	 * Change text color depending on background color
	 */
	$.fn.changeColor = function () {
		this.each(function () {
			var background = /^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(1|0\.\d+))?\)$/.exec($(this).css('background-color'));

			if (background != null) {
				background = [parseInt(background[1]), parseInt(background[2]), parseInt(background[3])];
				var intBackground = Math.round(((background[0] * 299) + (background[1] * 587) + (background[2] * 114)) / 1000);

				if (intBackground > 125) {
					$(this).css('color', '#000000');
				} else {
					$(this).css('color', '#ffffff');
				}
			}
		});

		return this;
	};
})(jQuery);
