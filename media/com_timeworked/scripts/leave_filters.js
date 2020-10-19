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
	 * Initialize leave list actions
	 * @param {string} element
	 * @constructor
	 */
	var LeaveFilters = function (element) {
		this.element = $(element);

		this.element.find('#tw-filters-reset').on('click.leaveFilter', $.proxy(this.resetFilters, this));
		this.element.find('select').on('change.leaveFilter', this.submitFilters);
		this.element.find('input[type="checkbox"]').on('change.leaveFilters', $.proxy(this.hidePrevLeaves, this));

		this.setPreciseDates();
	};

	LeaveFilters.prototype = {
		constructor: LeaveFilters,

		resetFilters: function () {
			var text = this.element.find('input[type="text"], textarea, input[type="checkbox"]'),
				select = this.element.find('select'),
				url = window.location.href;

			text.val('');
			select.prop('selectedIndex', 0);

			$.each(text, function (index, value) {
				var name = $(value).attr('name');

				if (name != undefined) {
					url = $.TimeWorked.updateQueryStringParameter(url, name, $(value).val());
				}
			});

			$.each(select, function (index, value) {
				var name = $(value).attr('name');

				if (name != undefined) {
					url = $.TimeWorked.updateQueryStringParameter(url, name, $(value).find(':selected').val());
				}
			});

			$.TimeWorked.updateSelect();
			history.pushState(null, document.title, url);
			$('.list').data('leaveList').updateList();
		},

		submitFilters: function (event) {
			var element = $(event.currentTarget),
				val = '';

			switch (element.prop('tagName')) {
				case 'INPUT':
					switch (element.attr('type')) {
						case 'checkbox':
							val = element.is(':checked') ? element.val() : '';
							break;
						case 'text':
							val = element.val();
							break;
					}
					break;
				case 'SELECT':
					val = element.find(':selected').val();
					break;
			}

			if ($(event.currentTarget).attr('name') != 'filter_dates') {
				$('#filter_dates').val('');
			}

			history.pushState(
				null,
				document.title,
				$.TimeWorked.updateQueryStringParameter(window.location.href, element.attr('name'), val)
			);
			$('.list').data('leaveList').updateList();
		},

		hidePrevLeaves: function(event) {
			var element = $(event.currentTarget),
				value = ~~element.is(':checked');

			this.element.find('#filter_hide_past_leaves').val(value);

			history.pushState(
				null,
				document.title,
				$.TimeWorked.updateQueryStringParameter(window.location.href, 'filter_hide_past_leaves', value.toString())
			);
			$('.list').data('leaveList').updateList();
		},

		updateDates: function (dates) {
			if (!dates) {
				return this;
			}

			var filterDates = this.element.find('#filter_dates'),
				selected = filterDates.find(":selected").val();

			filterDates
				.find('option').remove().end()
				.append($('<option/>').text('').attr('value', ''));

			$.each(dates, function (index, value) {
				filterDates.append($('<option/>').text(value.name).attr('value', value.id));
			});

			filterDates.val(selected);
			$.TimeWorked.updateSelect();

			return this;
		},

		setPreciseDates: function () {
			var preciseDates = this.element.find('#tw-precise-dates-button');

			preciseDates.daterangepicker({
				locale       : {firstDay: 1},
				format       : $.TimeWorked.dateFormats.momentPattern,
				buttonClasses: 'tw-btn tw-btn-small',
				applyClass   : 'tw-btn-success',
				cancelClass  : 'tw-btn-default',
				template     : '<div class="daterangepicker dropdown-menu">' +
				'<div class="flex">'+
				'<div class="calendar left"></div>' +
				'<div class="calendar right"></div>' +
				'</div>'+
				'<div class="ranges">' +
				'<div class="range_inputs">' +
				'<div id="daterangepicker_range_inputs">' +
				'<input class="input-mini" type="text" name="daterangepicker_start" value="" disabled="disabled" /> — ' +
				'<input class="input-mini" type="text" name="daterangepicker_end" value="" disabled="disabled" />' +
				'</div>' +
				'<div class="daterangepicker_buttons">' +
				'<button class="applyBtn" disabled="disabled"></button>&nbsp;' +
				'<button class="cancelBtn"></button>' +
				'</div>' +
				'</div>' +
				'</div>' +
				'</div>'
			});

			preciseDates.on('apply.daterangepicker', function (event, picker) {
				var filterStartDate = [],
					filterEndDate = [],
					filterDateCookie = $.cookie('filterDateLeaves'),
					filterDates = $('#filter_dates');

				filterStartDate['val'] = picker.startDate.format($.TimeWorked.dateFormats.mysqlPattern);
				filterStartDate['text'] = picker.startDate.format($.TimeWorked.dateFormats.momentPattern);

				filterEndDate['val'] = picker.endDate.format($.TimeWorked.dateFormats.mysqlPattern);
				filterEndDate['text'] = picker.endDate.format($.TimeWorked.dateFormats.momentPattern);

				if (filterDateCookie == undefined || JSON.parse(filterDateCookie) == null) {
					filterDateCookie = [];
					filterDateCookie.push({start: filterStartDate['val'], end: filterEndDate['val']});
				} else {
					filterDateCookie = JSON.parse(filterDateCookie);
					filterDateCookie.push({start: filterStartDate['val'], end: filterEndDate['val']});
				}

				$.cookie('filterDateLeaves', JSON.stringify(filterDateCookie), {path: '/'});

				filterDates.find('option:selected').removeAttr('selected');

				var newOption = $('<option/>').attr('value', filterStartDate['val'] + '--' + filterEndDate['val'])
					.attr('selected', 'selected').text(filterStartDate['text'] + ' — ' + filterEndDate['text']);

				$(filterDates.find('option[value=""]')).after(newOption);

				$.TimeWorked.updateSelect();

				filterDates.trigger('change');
			});
		}
	};

	$.fn.leaveFilters = function () {
		this.each(function () {
			var el = $(this);

			if (el.data('leaveFilters')) {
				el.removeData('leaveFilters');
			}

			el.data('leaveFilters', new LeaveFilters(el));
		});

		return this;
	};
})(jQuery);
