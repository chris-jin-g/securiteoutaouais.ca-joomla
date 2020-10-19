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
	var LeaveList = function (element) {
		this.element = $(element);

		this.serviceColumn();
		this.initializePagination();
	};

	LeaveList.prototype = {
		constructor: LeaveList,

		/**
		 * Add events to service column
		 */
		serviceColumn: function () {
			this.element.find('a.edit').on('click.leaveList', $.proxy(this.editItem, this));
			this.element.find('a.remove').on('click.leaveList', $.proxy(this.removeItem, this));
			this.element.find('a.approve').on('click.leaveList', $.proxy(this.approveLeave, this));
			this.element.find('a.reject').on('click.leaveList', $.proxy(this.approveLeave, this));
		},

		/**
		 * Edit item from list. Ask before editing confirmed/declined item
		 * @param event
		 */
		editItem: function (event) {
			event.preventDefault();

			if ($(event.currentTarget).parent().data('row-service-status') != 0) {
				var confirmModal = $('#confirmModal');

				confirmModal.find('#confirmModalBody')._t('are you sure to edit it');
				confirmModal.find('#confirmModalLabel')._t('leave has been reviewed');
				confirmModal.find('#confirmModal')
					.on('click.leaveList', $.proxy(this.editItemConfirm, {url: $(event.target).attr('href'), editItemRequest: this.editItemRequest}));
				confirmModal.modal('show');
			} else {
				this.editItemRequest($(event.currentTarget).attr('href'));
			}
		},

		editItemRequest: function(url) {
			$.ajax({
				type    : "GET",
				url     : url + '&ajax=true',
				dataType: 'json',
				success : function (response) {
					if (response.success) {
						var formData = $('.tw-form').data('leaveForm');

						$('#leaveFormSwitcher').data('formSlider').slideDown();
						formData
							.fillForm(response.data)
							.addEditMessage($.i18n._(
								'current editing leave',
								moment(response.data.start_date).format($.TimeWorked.dateFormats.momentPatternFullMonth),
								moment(response.data.end_date).format($.TimeWorked.dateFormats.momentPatternFullMonth)
							));
					} else {
						$.TimeWorked
							.resetMessageContainer()
							.addNotificationMessage($('<div/>').append($('<p/>').text(response.message)), 'error', 'error');
					}

					$.TimeWorked.addSystemMessages(response.messages);
				},
				error   : function () {
					alert($.i18n._('request error'));
				}
			});
		},

		/**
		 * Remove item from list. Ask before deleting item
		 * @param event
		 */
		removeItem: function (event) {
			event.preventDefault();

			var confirmModal = $('#confirmModal');

			if ($(event.currentTarget).parent().data('rowServiceStatus') != 0) {
				confirmModal.find('#confirmModalBody')._t('are you sure to delete it');
				confirmModal.find('#confirmModalLabel')._t('leave has been reviewed');
			} else {
				confirmModal.find('#confirmModalBody')._t('items will be deleted');
				confirmModal.find('#confirmModalLabel')._t('are you sure');
			}

			confirmModal.find('#confirmModal')
				.on('click.leaveList', $.proxy(this.deleteItemConfirm, {url: $(event.target).attr('href'), obj: this}));
			confirmModal.modal('show');
		},

		/**
		 * Get item data from server and bind to form
		 * @param event
		 */
		editItemConfirm: function (event) {
			event.preventDefault();

			this.editItemRequest(this.url);

			var confirmModal = $('#confirmModal');

			confirmModal.modal('hide');
			confirmModal.find('#confirmModal').off('click.leaveList');
		},

		/**
		 * Delete request
		 */
		deleteItemConfirm: function () {
			var url = this.url,
				$this = this.obj,
				confirmModal = $('#confirmModal');

			$.ajax({
				type    : 'POST',
				url     : url,
				data    : {ajax: true},
				dataType: 'json',
				success : function (response) {
					var messageContainer = $('<div/>'),
						messageStatus = response.success ? 'success' : 'error';

					if (response.message) {
						messageContainer.append($('<p/>').text(response.message));
					}

					$.TimeWorked.addNotificationMessage(messageContainer, messageStatus, messageStatus);
					$.TimeWorked.addSystemMessages(response.messages);
					$this.updateList();
				},
				error   : function () {
					alert($.i18n._('request error'));
				}
			});

			confirmModal.modal('hide');
			confirmModal.find('#confirmModal').off('click.leaveList');
		},

		/**
		 * Edit item from list. Get item data from server and bind to form
		 * @param event
		 */
		approveLeave: function (event) {
			event.preventDefault();

			var target = $(event.target),
				url = target.attr('href'),
				$this = this,
				type = '',
				approveMessageContainer = $('#approveLeaves'),
				confirmButton = $('#confirmApproveModal');

			if (target.hasClass('approve')) {
				type = 'approve';
			} else if (target.hasClass('reject')) {
				type = 'reject';
			}

			$('#approveModalLabel')._t('leave ' + type + ' commentary');
			$('#approveModal').modal('show');

			confirmButton.click(function () {
				$('#approveModal').modal('hide');

				$.ajax({
					type    : 'POST',
					url     : url,
					data    : {
						ajax            : true,
						admin_commentary: approveMessageContainer.val()
					},
					dataType: 'json',
					success : function (response) {
						var messageContainer = $('<div/>'),
							messageStatus = response.success ? 'success' : 'error';

						if (response.message) {
							messageContainer.append($('<p/>').text(response.message));
						}

						$.TimeWorked.resetMessageContainer();
						$.TimeWorked.addNotificationMessage(messageContainer, messageStatus, messageStatus);
						$.TimeWorked.addSystemMessages(response.messages);
						$this.updateList();
						approveMessageContainer.val('');
					},
					error   : function () {
						alert($.i18n._('request error'));
					},
					complete: function () {
						confirmButton.unbind('click');
					}
				})
			});
		},

		/**
		 * Update list (data and pagination)
		 */
		updateList: function () {
			var $this = this;

			$.ajax({
				type    : $this.element.attr('method'),
				url     : $this.element.attr('action'),
				data    : 'ajax=true&' + $this.element.serialize(),
                cache   : false,
				dataType: 'json',
				success : function (response) {
					if (response.success) {
						$this.updateTable(response.data.items);
						$this.element.find('.tw-paginator td').find('.pagination').remove().end().append(response.data.pagination);
						$this.initializePagination();
						$this.serviceColumn();
						$('.tw-column-toggle').data('hideColumns').update();
						$('#tw-filter-bar').data('leaveFilters').updateDates(response.data.monthList);
					} else {
						var messageContainer = $('<div/>');

						messageContainer.append($('<p/>').text(response.message));
						$.TimeWorked.addNotificationMessage(messageContainer, 'error', 'error');
					}

					$.TimeWorked.addSystemMessages(response.messages);
				},
				error   : function () {
					alert($.i18n._('request error'));
				}
			});
		},

		/**
		 * Update table data
		 * @param {array} data table data
		 */
		updateTable: function (data) {
			var tableBody = this.element.find('#leaves-data tbody'),
				leadYear = 0,
				$this = this,
                canApprove = !!this.element.find('#tw-head-approving').size();

			tableBody.text('');

			$.each(data, function (index, value) {
				var row = $('<tr/>').addClass('row-' + value.id);

				if (leadYear != moment(value.start_date).format('YYYY')) {
					leadYear = moment(value.start_date).format('YYYY');
					tableBody.append($('<tr/>').addClass('year').append($('<td/>')
							.attr('colspan', tableBody.closest('table').find('th').length)
							.text(leadYear)
					));
				}

				$.each(value, function (idx, val) {
					switch (idx) {
						case 'id':
						case 'edit_url':
						case 'remove_url':
						case 'approve_url':
						case 'decline_url':
						case 'admin_commentary':
							return;
						case 'start_date':
						case 'end_date':
							val = moment(val).format($.TimeWorked.dateFormats.momentPattern);
							break;
						case 'status':
							var status = $.i18n._('leave status ' + val);

							val = $('<span/>')
								.addClass('change-color block-icon-background hasTooltip status')
								.attr('data-original-title', status)
								.text(status[0]);

							if (value.admin_commentary) {
								var userCommentary = $('<span/>')
									.addClass('hasTooltip fa fa-comment justification')
									.attr('data-original-title', '<strong>' + (value.status == 1 ? $.i18n._('comments') : $.i18n._('justification')) + '</strong><br/>' + value.admin_commentary);

								val = $.TimeWorked.objectToString(val) + $.TimeWorked.objectToString(userCommentary);
							}

							break;
					}

					var cell = $('<td/>').html(val ? val : '').addClass('row-' + idx.replace('_', '-') + (idx === 'status' ? ' leave-status-' + value.status : ''));

					if (idx === 'start_date' || idx === 'end_date') {
						cell.attr('nowrap', 'nowrap');
					}

					row.append(cell);
				});
                
                if (canApprove) {
                    var approveCell = $('<td/>').addClass('row-approving').attr('nowrap', 'nowrap');

                    if (value.approve_url) {
                        approveCell.append($('<a/>')
                            .attr('href', value.approve_url)
                            .addClass('fa fa-check-circle approve'));
                    } else if (value.status == 1) {
                        approveCell.append($('<i/>')
                            .addClass('fa fa-check-circle approve'));
                    }

                    if (value.decline_url) {
                        approveCell.append($('<a/>')
                            .attr('href', value.decline_url)
                            .addClass('fa fa-ban reject'));
                    } else if (value.status == 2) {
                        approveCell.append($('<i/>')
                            .addClass('fa fa-ban reject'));
                    }

                    row.append(approveCell);
                }
				var serviceCell = $('<td/>').addClass('row-service').attr('nowrap', 'nowrap').data('rowServiceStatus', value.status);

				if (value.edit_url) {
					serviceCell.append($('<a/>')
						.attr('href', value.edit_url)
						.addClass('fa fa-pencil-square-o edit'));
				}

				if (value.remove_url) {
					serviceCell.append($('<a/>')
						.attr('href', value.remove_url)
						.addClass('fa fa-times-circle remove'));
				}

				row.append(serviceCell);
				tableBody.append(row);
			});

			$('.change-color').changeColor();
			$('.hasTooltip').tooltip({"html": true, "container": "body"});
		},

		/**
		 * Initialize ajax pagination
		 */
		initializePagination: function () {
			this.element
				.find('.pagination a')
                    .off('click.ajaxPagination')
                    .on('click.ajaxPagination', $.proxy(this.pagination, this)).end()
				.find('#limit').removeAttr('onchange')
                    .off('change.ajaxPagination')
                    .on('change.ajaxPagination', $.proxy(this.limitbox, this));
		},

		/**
		 * Add click events to pagination links (prev, next, 1, 2, etc)
		 * @param {object} event
		 */
		pagination: function (event) {
			event.preventDefault();

			var url = $(event.currentTarget).attr('href'),
				limit = $.TimeWorked.getQueryStringParameter(url, 'limit'),
				limitstart = $.TimeWorked.getQueryStringParameter(url, 'limitstart'),
				start = $.TimeWorked.getQueryStringParameter(url, 'start');

			this.element.find('[name="limit"]').val(limit ? limit : 0);
			this.element.find('[name="limitstart"]').val(limitstart ? limitstart : (start ? start : 0));

			history.pushState(null, document.title, url);
			this.updateList();
		},

		/**
		 * Add change event to limit box
		 * @param {object} event
		 */
		limitbox: function (event) {
			event.preventDefault();

			var selectedVal = $(event.target).find(':selected').val();

			history.pushState(null, document.title, $.TimeWorked.updateQueryStringParameter(window.location.href, 'limit', selectedVal));
			this.updateList();
		}
	};

	$.fn.leaveList = function () {
		this.each(function () {
			var el = $(this);

			if (el.data('leaveList')) {
				el.removeData('leaveList');
			}

			el.data('leaveList', new LeaveList(el));
		});

		return this;
	};
})(jQuery);
