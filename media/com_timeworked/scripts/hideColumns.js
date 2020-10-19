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
	 * Initialize hide columns plugin
	 * @param {string} element
	 * @param {object} options
	 * @constructor
	 */
	var HideColumns = function (element, options) {
		this.element = $(element);
		this.cookieVar = 'worklogDataColumns';
		this.table = $('#worklog-data');
		this.setOptions(options);
		this.buildTogglers();
		this.update();
	};

	HideColumns.prototype = {
		constructor: HideColumns,

		setOptions: function (options) {
			if (options) {
				if (typeof options.table === 'string') {
					this.table = $(options.table);
				}

				if (typeof options.cookieVar === 'string') {
					this.cookieVar = options.cookieVar;
				}
			}
		},

		/**
		 * Build HTML with toggleres
		 */
		buildTogglers: function () {
			var filters = $('<ul/>').addClass('tw-slide-up-down');
			var cookieState = this.getCookies();

			this.table.find('th').each(function () {
				var id = $(this).attr('id').replace('tw-head-', '').toLowerCase();
				var text = $(this).text();

				if (text == '') {
					text = $.TimeWorked.capitaliseFirstLetter(id);
				}

				filters.append($('<li/>')
						.addClass(cookieState[id] == 'none' ? 'hidden-column' : '')
						.append($('<span/>')
							.addClass('not-link')
							.text(text)
							.attr('data-hide_column', id)
					)
				);
			});

			this.element.append(filters);
			this.element.on('click.hideColumns', '.tw-slide-up-down li span', $.proxy(this.changeToggler, this))
		},

		/**
		 * Update column status
		 */
		update: function () {
			var cookies = this.getCookies();
			var $this = this;

			$.each(cookies, function (index, value) {
				var element = $this.element.find('[data-hide_column="' + index + '"]');

				$this.changeDisplay(index, value, element);
			});
		},

		/**
		 * Hide/show column event
		 * @param {object} event
		 */
		changeToggler: function (event) {
			event.preventDefault();

			var element = $(event.target);
			var id = element.attr('data-hide_column');
			var cookie = this.getCookie(id);

			switch (cookie) {
				case 'none':
					cookie = 'table-cell';
					break;
				case 'table-cell':
				default:
					cookie = 'none';
					break;
			}

			this.changeDisplay(id, cookie, element);
			this.setCookie(id, cookie);
		},

		/**
		 * Get all plugin cookies in array format
		 * @returns {array} all cookies
		 */
		getCookies: function () {
			var cookieState = $.cookie(this.cookieVar);

			if (cookieState == undefined) {
				return {};
			}

			return $.parseJSON(cookieState);
		},

		/**
		 * Get plugin cookie by key
		 * @param {string} key
		 * @returns {string} cookie value
		 */
		getCookie: function (key) {
			var cookies = this.getCookies();

			return cookies[key];
		},

		/**
		 * Set cookie
		 * @param {string} key
		 * @param {string} value
		 */
		setCookie: function (key, value) {
			var cookies = this.getCookies();

			cookies[key] = value;

			$.cookie(this.cookieVar, JSON.stringify(cookies), {expires: 10 * 365, path: '/'});
		},

		/**
		 * Change dependent elements state
		 * @param {string} id element identifier
		 * @param {string} display css display property
		 * @param {object} element jquery control element
		 */
		changeDisplay: function (id, display, element) {
			this.table.find('#tw-head-' + id).toggleClass('hidden', display === 'none');
			this.table.find('.row-' + id).toggleClass('hidden', display === 'none');
            this.table.find('th, td').removeClass('tw-without-left-bdr');
            this.table.find('tr')
                    .find('th:visible:first, td:visible:first')
                    .addClass('tw-without-left-bdr');

			switch (display) {
				case 'none':
					element.addClass('hidden-column');
					break;
				case 'table-cell':
				default:
					element.removeClass('hidden-column');
					break;
			}
		}
	};

	$.fn.hideColumns = function (options) {
		this.each(function () {
			var el = $(this);

			if (el.data('hideColumns')) {
				el.removeData('hideColumns');
			}

			el.data('hideColumns', new HideColumns(el, options));
		});

		return this;
	};
})
(jQuery);
