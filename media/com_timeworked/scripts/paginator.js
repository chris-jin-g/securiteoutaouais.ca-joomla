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
	 * Initialize ajax pagination plugin
	 * @param {string} element
	 * @constructor
	 */
	var AjaxPagination = function (element) {
		this.element = $(element);

		this.element.find('.pagination a')
            .off('click.ajaxPagination')
			.on('click.ajaxPagination', $.proxy(this.pagination, this));
		this.element.find('#limit').removeAttr('onchange')
            .off('change.ajaxPagination')
			.on('change.ajaxPagination', $.proxy(this.limitbox, this));
	};

	AjaxPagination.prototype = {
		constructor: AjaxPagination,

		/**
		 * Pagination links (prev, next, 1, 2, etc) events
		 * @param {object} event
		 */
		pagination: function (event) {
			event.preventDefault();

			var url = $(event.currentTarget).attr('href'),
				params = $.TimeWorked.removeQueryStringParameter(
					$.TimeWorked.removeQueryStringParameter(url, 'option'),
					'view'
				),
				start = $.TimeWorked.getQueryStringParameter(params, 'start'),
				limitstart = $.TimeWorked.getQueryStringParameter(params, 'limitstart');

			if (start == undefined && limitstart != undefined) {
				params = $.TimeWorked.updateQueryStringParameter(params, 'start', limitstart);
			} else if (start != undefined && limitstart == undefined) {
				params = $.TimeWorked.updateQueryStringParameter(params, 'limitstart', start);
			} else if (start == undefined && limitstart == undefined) {
				params = $.TimeWorked.updateQueryStringParameter(params, 'start', 0);
				params = $.TimeWorked.updateQueryStringParameter(params, 'limitstart', 0);
			}

			history.pushState(null, document.title, url);

			updateData(0, params.split('?')[1]);
		},

		/**
		 * Limit box change event
		 * @param {object} event
		 */
		limitbox: function (event) {
			event.preventDefault();

			var selectedVal = $(event.target).find(':selected').val(),
				params = $.TimeWorked.updateQueryStringParameter(window.location.href, 'limit', selectedVal);

			params = params.split('?')[1];

			history.pushState(null, document.title, $.TimeWorked.updateQueryStringParameter(window.location.href, 'limit', selectedVal));

			updateData(0, params);
		}

	};

	$.fn.ajaxPagination = function () {
		this.each(function () {
			var el = $(this);

			if (el.data('ajaxPagination')) {
				el.removeData('ajaxPagination');
			}

			el.data('ajaxPagination', new AjaxPagination(el));
		});

		return this;
	};
})(jQuery);
