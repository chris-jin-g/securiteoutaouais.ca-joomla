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
	 * Initialize export billable plugin
	 * @param {string} element
	 * @param {object} options
	 * @constructor
	 */
	var ExportBillable = function (element, options) {
		this.element = $(element);
		this.exportType = this.element.attr('data-export-billable-type');
		this.needConfirm = false;
		this.confirmModal = {
			window       : $('#billableModal'),
			buttonConfirm: $('#confirmBillableModal'),
			buttonCancel : $('#cancelBillableModal')
		};

		this.setOptions(options);

		this.element
			.attr('onclick', '')
			.on('click.exportBillable', $.proxy(this.openModalEvent, this));
	};

	ExportBillable.prototype = {
		constructor: ExportBillable,

		/**
		 * Set options
		 * @param {object} options
		 */
		setOptions: function (options) {
			this.setNeedConfirm(options.needConfirm);

			if (typeof options.modalWindowId === 'string') {
				this.confirmModal.window = $(options.modalWindowId);
			}

			if (typeof options.modalWindowConfirmButtonId === 'string') {
				this.confirmModal.buttonConfirm = $(options.modalWindowConfirmButtonId);
			}

			if (typeof options.modalWindowCancelButtonId === 'string') {
				this.confirmModal.buttonCancel = $(options.modalWindowCancelButtonId);
			}
		},

		/**
		 * Set need confirm flag for displaying modal window
		 * @param {boolean} needConfirm
		 */
		setNeedConfirm: function (needConfirm) {
			if (typeof needConfirm === 'boolean') {
				this.needConfirm = needConfirm;
			}
		},

		/**
		 * Open modal window event
		 * @param {object} event click event
		 */
		openModalEvent: function (event) {
			event.preventDefault();

			if (this.needConfirm) {
				this.confirmModal.window.modal('show');
				this.confirmModal.buttonConfirm
					.on('click.exportBillableConfirm', $.proxy(this.exportBillableEvent, this));
				this.confirmModal.buttonCancel
					.on('click.exportBillableCancel', $.proxy(this.exportBillableEvent, this));
			}
			else {
				this.exportBillableEvent({target: false});
			}
		},

		/**
		 * Modal buttons events
		 * @param {object} event click event
		 */
		exportBillableEvent: function (event) {
			var url = this.buildTargetUrl(event.target === this.confirmModal.buttonConfirm[0]);

			switch (this.exportType) {
				case 'xls':
					window.open(url, '_self');
					break;
				case 'print':
					window.open(url, 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1000,height=600,directories=no,location=no');
					break;
			}

			this.confirmModal.window.modal('hide');
		},

		/**
		 * Build export url
		 * @param {boolean} exportNotBillable true if export not billable hours
		 * @returns {string}
		 */
		buildTargetUrl: function (exportNotBillable) {
			var url = window.location.toString();
			url += (url.indexOf('?') == -1 ? '?' : '&') + 'billable=' + exportNotBillable + '&format=' + this.exportType;

			return url;
		}
	};

	$.fn.exportBillable = function (options) {
		this.each(function () {
			var el = $(this);

			if (el.data('exportBillable')) {
				el.removeData('exportBillable');
			}

			el.data('exportBillable', new ExportBillable(el, options));
		});

		return this;
	};
})(jQuery);
