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
	/**
	 * Initialize mark billable plugin
	 * @param {string} element
	 * @param {object} options
	 * @constructor
	 */
	var MarkBillable = function (element, options) {
		this.element = $(element);

		this.element.on('click.markBillable', $.proxy(this.markBillableEvent, this));
	};

	MarkBillable.prototype = {
		constructor: MarkBillable,

		markBillableEvent: function (event) {
			event.preventDefault();

			var element = $(event.target);

			$.ajax({
				type    : "GET",
				url     : element.attr('href') + '&ajax=true',
				dataType: 'json',
				success : function (response) {
					var url = element.attr('href'),
						status = $.TimeWorked.getQueryStringParameter(url, 'status');

					switch (status) {
						case 'billable':
							status = 'not-billable';
							element.removeClass('billable').addClass('not-billable');
							break;
						case 'not-billable':
							status = 'billable';
							element.removeClass('not-billable').addClass('billable');
							break;
					}

					url = $.TimeWorked.updateQueryStringParameter(url, 'status', status);

					element.attr('href', url);
                    updateData(0, window.location.href.split('?')[1]);
				},
				error   : function () {
					alert($.i18n._('request error'));
				}
			});
		}
	};

	$.fn.markBillable = function () {
		this.each(function () {
			var el = $(this);

			if (el.data('markBillable')) {
				el.removeData('markBillable');
			}

			el.data('markBillable', new MarkBillable(el));
		});

		return this;
	};
})(jQuery);
