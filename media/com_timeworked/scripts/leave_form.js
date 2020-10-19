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
	 * Initialize leave form actions
	 * @param {string} element
	 * @constructor
	 */
	var LeaveForm = function (element) {
		this.element = $(element);
		this.prefix = 'leaves';
		this.editMessageContainer = this.element.siblings('.tw-edit-message');

		this.addDateRangePicker('#' + this.prefix + '_daterange_img', '#' + this.prefix + '_daterange');

		this.element.on('submit.leaveForm', $.proxy(this.formSubmit, this));
		this.element.find('input[type="reset"]').on('click.leaveForm', $.proxy(this.formResetModal, this));

		$('#confirmResetModal').on('click.leaveForm', $.proxy(this.formResetConfirm, this));
	};

	LeaveForm.prototype = {
		constructor: LeaveForm,

		/**
		 * Submit form action
		 * @param event
		 * @returns {LeaveForm}
		 */
		formSubmit: function (event) {
			event.preventDefault();

			var $this = this;

			$.ajax({
				type    : this.element.attr('method'),
				url     : this.element.attr('action'),
				dataType: 'json',
				data    : this.element.serialize() + '&format=json',
				success : function (response) {
					var messageContainer = $('<div/>'),
						messageStatus = response.success ? 'success' : 'error';

					$.TimeWorked.resetMessageContainer();
					$this.clearErrorHighlight();

					if (response.success) {
						$this.formReset();
						messageContainer.append($('<p/>').text(response.message));
						$this.removeEditMessage();
					}
					else {
						if (response.data.fields) {

							$.each(response.data.fields, function (index, value) {
								$this.element.find('[name="' + $this.prefix + '[' + value + ']"]').closest('.control-group').addClass('error');
							});

							messageContainer.append($('<p/>')._t('form submit error'));

							if (response.message) {
								messageContainer.append($('<p/>').text(response.message));
							}
						}
					}

					$.TimeWorked.addNotificationMessage(messageContainer, messageStatus, messageStatus);
					$.TimeWorked.addSystemMessages(response.messages);
					$('#leaveFormSwitcher').data('formSlider').easyClose();
					$('.list').data('leaveList').updateList();
				},
				error   : function () {
					alert($.i18n._('request error'));
				}
			});

			return this;
		},

		/**
		 * Reset form action
		 * @returns {LeaveForm}
		 */
		formReset: function () {
			this.element
				.find('input[type="text"], textarea').val('').end()
				.find('select').prop('selectedIndex', 0);

			$.each(this.element.find('input[type="hidden"]'), function (index, value) {
				var name = $(value).attr('name');

				if (name == 'option' || name == 'view' || name == 'task') {
					return;
				}

				$(value).val('');
			});

			var dateRangePicker = $('#' + this.prefix + '_daterange_img');

			dateRangePicker.data('daterangepicker').setStartDate(new Date);
			dateRangePicker.data('daterangepicker').setEndDate(new Date);

			$.TimeWorked.updateSelect();

			return this;
		},

		/**
		 * Confirm modal for form reset
		 * @param {object} event
		 */
		formResetModal: function (event) {
			event.preventDefault();

			$('#resetModal').modal('show');
		},

		/**
		 * Confirm form reset event
		 * @param {object} event
		 */
		formResetConfirm: function (event) {
			event.preventDefault();

			$('#resetModal').modal('hide');
			$.TimeWorked.resetMessageContainer();
			this.formReset();
		},

		/**
		 * Add date range picker
		 * @param {string} element date range picker element
		 * @param {string} target target input
		 * @returns {LeaveForm}
		 */
		addDateRangePicker: function (element, target) {
			var dateRange = $(element),
				$this = this;

			dateRange.daterangepicker({
				locale       : {firstDay: 1},
				format       : $.TimeWorked.dateFormats.momentPattern,
				buttonClasses: 'tw-btn tw-btn-small',
				applyClass   : 'tw-btn-success',
				cancelClass  : 'tw-btn-default',
				minDate      : new Date(),
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

			dateRange.on('apply.daterangepicker', function (event, picker) {
				$(target).val(picker.startDate.format($.TimeWorked.dateFormats.momentPattern) + ' — ' + picker.endDate.format($.TimeWorked.dateFormats.momentPattern));
				$('#' + $this.prefix + '_start_date').val(picker.startDate.format($.TimeWorked.dateFormats.mysqlPattern));
				$('#' + $this.prefix + '_end_date').val(picker.endDate.format($.TimeWorked.dateFormats.mysqlPattern));
			});

			return this;
		},

		/**
		 * Remove error highlighting from form
		 * @returns {LeaveForm}
		 */
		clearErrorHighlight: function () {
			this.element.find('.control-group').removeClass('error');

			return this;
		},

		/**
		 * Fill form
		 * @param {object} data form data
		 * @returns {LeaveForm}
		 */
		fillForm: function (data) {
			var $this = this,
				dateRangePicker = $('#' + this.prefix + '_daterange_img').data('daterangepicker');

			$.each(data, function (index, value) {
				$this.element.find('[name="' + $this.prefix + '[' + index + ']"]').val(value);
			});

			var startDate = moment($('#' + this.prefix + '_start_date').val()).format($.TimeWorked.dateFormats.momentPattern),
				endDate = moment($('#' + this.prefix + '_end_date').val()).format($.TimeWorked.dateFormats.momentPattern);

			$('#' + this.prefix + '_daterange').val(startDate + ' — ' + endDate);

			dateRangePicker.setStartDate(startDate);
			dateRangePicker.setEndDate(endDate);

			$.TimeWorked.updateSelect();

			return this;
		},

		/**
		 * Add edit message
		 * @param {string} message
		 * @returns {LeaveForm}
		 */
		addEditMessage: function (message) {
			this.editMessageContainer.html(message).removeClass('tw-hide').addClass('tw-show');

			return this;
		},

		/**
		 * Remove edit message
		 * @returns {LeaveForm}
		 */
		removeEditMessage: function () {
			this.editMessageContainer.text('').addClass('tw-hide').removeClass('tw-show');

			return this;
		}
	};

	$.fn.leaveForm = function () {
		this.each(function () {
			var el = $(this);

			if (el.data('leaveForm')) {
				el.removeData('leaveForm');
			}

			el.data('leaveForm', new LeaveForm(el));
		});

		return this;
	};
})(jQuery);
