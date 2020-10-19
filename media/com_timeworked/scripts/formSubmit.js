/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
var dataTable;
var form;
var formWrapper;
var formSubmitting = false;
var toDeleteObject;
var newObject = false;
var curUser;

(function ($) {
	$(document).ready(function () {

		form = $('#tw-add-form');
		formWrapper = $('.tw-form-wrapper');
		dataTable = $('#worklog-data');
        curUser = form.find('#workentry_userid').val();

		form.submit(formSubmit);

		var editLinks = dataTable.find('.edit');
		$.each(editLinks, function (index, value) {
			$(value).click(editItem);
		});
        
        var copyItem = function(e) {
            var trim = function(val) {
                    var regexp = new RegExp('/(^\s+)|(\s+$)/', 'g');
                    return val.replace(regexp, '');
                },
                $btn = $(this), $row = $btn.closest('tr'),
                project = $row.find('.row-project_name').data('projectId'),
                task    = $row.find('.row-task').text(),
                done    = $row.find('.row-performed').text(),
                tickets = $row.find('.row-ticket_numbers').text().split(',');
                
            removeFormError();
            
            /* reset unnecessary fields */
            $('#workentry_id').val(0);
            $('#workentry_userid').val(curUser);
            /* fill out the form */
            $('#workentry_projectid').val(project).trigger('liszt:updated');
            $('#workentry_task').val(task);
            $('#workentry_performed_work').val(done);
            $('#workentry_ticket_numbers').tagsinput('removeAll');
            $.each(tickets, function(){
                $('#workentry_ticket_numbers').tagsinput('add', trim(this));
            });
            if ($('#workentry_taskid').size()) {
                loadTasksList(function(){
                    $('#workentry_taskid').val($row.find('.row-task').data('taskid')).trigger('liszt:updated');
                });
            }
            /* expand the form if it was collapsed */
            jQuery('#formToggleSwitcher').data('formSlider').slideDown();
            /* hide edit message if there is any */
            hideEditMessage();
            /* scroll top */
            $('html, body').animate({scrollTop: $('.tw-form-container').eq(0).offset().top}, '500', 'swing');
            /* stop default click handler */
            e.preventDefault();
        };
        
        dataTable.on('click', '.fa-copy', copyItem);

		var deleteLinks = dataTable.find('.delete');
		$.each(deleteLinks, function (index, value) {
			$(value).click(deleteItem);
		});

		$('#tw-form-reset-button').click(function (event) {
			event.preventDefault();

			$('#resetModal').modal('show');
		});

		$('#confirmResetModal').click(function () {
			$('#resetModal').modal('hide');
			formReset();
			$.TimeWorked.resetMessageContainer();
			updateChecked($('#tw-calendar').find('.checked-date').attr('class'));
		});

		$('#confirmDeleteModal').click(function () {
			$('#deleteModal').modal('hide');
			deleteItemRequest(toDeleteObject);
		});
        
        $('#workentry_projectid').change(loadTasksList);
        loadTasksList();
	});
})(jQuery);

/**
 * Task form submit
 *
 * @param event
 */
function formSubmit(event) {
	event.preventDefault();
	if (!formSubmitting) {
		formSubmitting = true;
		(function ($) {
			var paramObj = {},
                ticket = $('.bootstrap-tagsinput input').val(),
                tickets = $('#workentry_ticket_numbers').val();
            if (ticket !== '') {
                $('#workentry_ticket_numbers').val(tickets !== '' ? tickets + ',' + ticket : ticket);
            }
			$.each(form.serializeArray(), function (index, value) {
				paramObj[value.name] = value.value;
			});
			paramObj['workentry[date]'] = moment(paramObj['workentry[date]'], $.TimeWorked.dateFormats.momentPatternFullMonth)
				.format($.TimeWorked.dateFormats.mysqlPattern);
			paramObj['ajax'] = true;
			$.ajax({
				type      : "POST",
				url       : form.attr('action'),
				data      : paramObj,
				dataType  : 'json',
				success   : function (response) {
					$.TimeWorked.resetMessageContainer();
					removeFormError();

					var messageContainer = $('<div/>');

					switch (response.status) {
						case 'error':
							$.each(response.error, function (index, value) {
								if (index != 'ids') {
									messageContainer.append($('<p/>').text(value.message));
								}
							});
							if (response.error.ids) {
								$.each(response.error.ids, function (index, value) {
									$('#' + value).closest('.control-group').addClass('error');
								});
								messageContainer.append($('<p/>')._t('form submit error'));
							}
							break;
						case 'success':
							jQuery('#tw-calendar').data('plugin_clndr').setEvents(getCalendarEvents());
							$.each(response.success, function (index, value) {
								messageContainer.append($('<p/>').text(value.message));
								$('#' + value.id).closest('.control-group').addClass('error');
							});
							formReset();

							updateData(response.id, window.location.href.split('?')[1]);

							jQuery('#formToggleSwitcher').data('formSlider').easyClose();

							if (!newObject && ($('.row-' + response.id).offset() != undefined)) {
								$('html, body').animate({scrollTop: $('.row-' + response.id).offset().top}, '500', 'swing');
							}
							newObject = false;
							$('.hasTooltip').tooltip({html: true, container: 'body'});
							break;
						default:
							alert($.i18n._('unrecognized response status'));
					}

					if (messageContainer.text() != '') {
						$.TimeWorked.addNotificationMessage(messageContainer, response.status, response.status);
					}

				},
				error     : function () {
					alert($.i18n._('request error'));
				},
				complete  : function () {
					formSubmitting = false;
				},
				beforeSend: function () {
					newObject = $('#workentry_id').val() == '0';
				}
			});
		})(jQuery);
	}
}

/**
 * Display confirm delete window
 *
 * @param event event
 */
function deleteItem(event) {
	event.preventDefault();
	toDeleteObject = jQuery(this);
	(function ($) {
		$('#deleteModal').modal('show');
	})(jQuery);
}

/**
 * Send delete request to server
 *
 * @param object delete link
 */
function deleteItemRequest(object) {
	(function ($) {
		$.ajax({
			type    : "POST",
			url     : object.attr('href') + '&ajax=true',
			dataType: 'json',
			success : function (response) {
				if (response.status == false) {
					alert($.i18n._('unrecognized response status'));
				}
				else {
					var id = $.TimeWorked.getQueryStringParameter(object.attr('href'), 'id');

					updateData(response.id);

					if ($('#workentry_id').val() == id) {
						formReset();
					}

					$('#tw-calendar').data('plugin_clndr').setEvents(getCalendarEvents());

					$('a.reject')
						.reject('removeRejectedEntry', id)
						.reject('updateUserBlockRejection', response.userid);
				}
			},
			error   : function () {
				alert($.i18n._('request error'));
			}
		});
	})(jQuery);
}

/**
 * Update table data from server
 *
 * @param id item id
 * @param params url params
 */
function updateData(id, params) {
	(function ($) {
		var paginatorRow = $('.tw-paginator'),
			totalPageRow = $('.tw-total-page'),
			totalRow = $('.tw-total-summary'),
            totalPageBillableRow = $('.tw-total-page-billable'),
            totalBillableRow = $('.tw-total-summary-billable');

		$.TimeWorked.updateSelect();

		var data = getTableData(id, params);

		dataTable.find('tbody').text('');

		if (data.data.length === 0) {
			dataTable.append(
				$('<tr/>').append(
					$('<td/>').attr('colspan', '11').append(
						$('<p/>').css('text-align', 'center').append(
							$('<strong/>')._t('no results match')
						)
					)
				)
			);
			totalPageRow.css('display', 'none');
			totalRow.css('display', 'none');
		} else {
			$.each(data.data, function (index, value) {
				dataTable.append(addRowToTable(value));
			});

			totalRow.css('display', 'table-row');
		}
        
        if (!data.display_all) {
            totalPageBillableRow.css('display', (data.time_page._not_billable === '00:00') ? 'none' : 'table-row');
            totalPageBillableRow.find('.tw-total-value').text(data.time_page._total_billable + ' ' + $.i18n._('hours'));
            totalPageRow.css('display', 'table-row');
            updateTime(data.time_page, totalPageRow);
        }
        
        totalBillableRow.css('display', (data.time_total._not_billable === '00:00') ? 'none' : 'table-row');
        totalBillableRow.find('.tw-total-value').text(data.time_total._total_billable + ' ' + $.i18n._('hours'));

		$('.tw-column-toggle').data('hideColumns').update();

		history.pushState(null, document.title, $.TimeWorked.updateQueryStringParameter(window.location.href, 'limitstart', data.start));

		updateTime(data.time_total, totalRow);

		var paginationTd = paginatorRow.find('td');

		paginationTd
			.find('.pagination').remove().end()
			.append(data.paginator);

		paginatorRow
			.ajaxPagination()
			.find('#limit').chosen();

		updateChecked($('#tw-calendar').find('.checked-date').attr('class'));

		$('.change-color').changeColor();
		$('.hasTooltip').tooltip({"html": true, "container": "body"});
	})(jQuery);
	updateStatus();
}

/**
 * Update table summary time
 *
 * @param data time data
 * @param placeholder jQuery selector
 */
function updateTime(data, placeholder) {
	(function ($) {
		var overtimeHours = [];
		var totalHours = null;

		$.each(data, function (index, value) {
            if (value === '00:00') {
                return;
            }
			if (index == '_rejected') {
				index = $.i18n._('rejected');
			}
			else if (index == '_not_billable') {
				index = $.i18n._('not billable small');
			}

			if (index !== '_default' && index !== '_total' && index !== '_total_billable') {
				overtimeHours.push($('<span/>').text(value + ' ' + index).addClass('total-overtime-' + index));
			}

			if (index == '_total') {
				totalHours = $('<span/>').text(value + ' ' + $.i18n._('hours')).addClass('total_hours');
			}
		});

		var timePlaceholder = placeholder.find('.tw-total-value');

		timePlaceholder.text('').append(totalHours);

		if (overtimeHours.length != 0) {
			timePlaceholder.append(' (');

			for (var i = 0; i < overtimeHours.length; i++) {
				timePlaceholder.append(overtimeHours[i]);

				if (i + 1 < overtimeHours.length) {
					timePlaceholder.append(' / ');
				}
			}

			timePlaceholder.append(')');
		}
	})(jQuery);
}

/**
 * Update checked rows from table
 *
 * @param checked
 */
function updateChecked(checked) {
	(function ($) {
		if (checked != undefined) {
			var checkedRegex = /^calendar-day-\d{4}-\d{2}-\d{2}$/;
			var checkedClass;

			$.each(checked.split(' '), function (index, value) {
				if (value.match(checkedRegex)) {
					checkedClass = value.replace('calendar-day-', 'row-date-');
				}
			});

			dataTable.find('tr').removeClass('info checked-row');
			dataTable.find('.' + checkedClass).addClass('info checked-row');
		}
	})(jQuery);
}

/**
 * Create tr to worlog data table
 *
 * @param object data object
 * @returns {HTMLElement} tr jquery element
 */
function addRowToTable(object) {
	var row;
	var currentCookie;
	(function ($) {
		var rowClass = 'row-date-' + object.date_mysql + ' row-' + object.id,
			clientBackgroundColor = object.client_set_background_color == 1 ? {'background-color': object.client_color} : {},
			projectBackgroundColor = object.project_set_background_color == 1 ? {'background-color': object.project_color} : {};

		$.each($.TimeWorked.tmpRejected, function (index, value) {
			if (value.id == object.id) {
				object.rejected = '1';
				return;
			}
		});

		if (object.rejected == '1') {
			rowClass += ' reject-highlight';
		}

        var $colorWrapper = $('<span/>')
                .attr('class','change-color block-icon-background');
        
		row = $('<tr/>')
			.addClass(rowClass)
			.append(getTableElement('<td/>', '', 'row-company')
                .append($colorWrapper.clone().css(clientBackgroundColor)
                    .append(getFieldText(object.company, object.client_short_name))))
			.append(getTableElement('<td data-project-id="'+object.projectid+'"></td>', '', 'row-project_name')
                .append($colorWrapper.clone().css(projectBackgroundColor)
                    .append(getFieldText(object.project_name, object.project_short_name, object.project_description))));

		if (object.user_name != undefined) {
			row.append(getTableElement('<td/>', object.user_name, 'row-user_name'));
		}

		row
			// .append(getTableElement('<td/>', object.date, 'row-date').attr('nowrap', 'nowrap'))
			.append(getTableElement('<td/>', object.task, 'row-task'))
			.append(getTableElement('<td/>', object.performed_work, 'row-performed'));

        if (typeof object.ticket_numbers !== 'undefined') {
            var taskids = [],
                taskidsstring = getTableElement('<td/>', '', 'row-ticket_numbers'),
                i = 0;
            if (object.ticket_numbers) {
                taskids = object.ticket_numbers.split(',');
            }
            if (object.bugtracker_url) {
                $.each(taskids, function (index, value) {
                    taskidsstring.append($('<a/>').text(value).attr('href', object.bugtracker_url + value));
                    taskidsstring.html(taskidsstring.html() + (taskids.length > i++ + 1 ? ',' : '') + ' ');
                });

            }
            else {
                $.each(taskids, function (index, value) {
                    taskidsstring.append(value);
                    taskidsstring.html(taskidsstring.html() + (taskids.length > i++ + 1 ? ',' : '') + ' ');
                });
            }

            row.append(taskidsstring);
        }

        //From
		var rowFrom = getTableElement('<td/>', object.from, 'row-hours').attr('nowrap', 'nowrap');

		if (object.time_worked_default == 0) {
			rowFrom.append(
				getTableElement(
					'<span/>', '',
					'block-icon-background change-color', {'background-color': object.time_worked_color}
				).append(getFieldText(object.time_worked_type, object.time_worked_short_name))
			);
		}
        if (~~object.rejected && !dataTable.find('#tw-head-rejected').size()) {
            var $reject = $('<span class="fa fa-exclamation-triangle reject"></span>');
            rowFrom.append($reject);
            if (object.rejected_comment) {
                var $comment = $('<span class="fa fa-comment tw-in-red hasTooltip"></span>');
                $comment.attr('data-original-title', object.rejected_comment);
                rowFrom.append($comment);
            }

        }

		row.append(rowFrom);
		//To
		var rowTo = getTableElement('<td/>', object.to, 'row-hours').attr('nowrap', 'nowrap');

		if (object.time_worked_default == 0) {
			rowHours.append(
				getTableElement(
					'<span/>', '',
					'block-icon-background change-color', {'background-color': object.time_worked_color}
				).append(getFieldText(object.time_worked_type, object.time_worked_short_name))
			);
		}
        if (~~object.rejected && !dataTable.find('#tw-head-rejected').size()) {
            var $reject = $('<span class="fa fa-exclamation-triangle reject"></span>');
            rowTo.append($reject);
            if (object.rejected_comment) {
                var $comment = $('<span class="fa fa-comment tw-in-red hasTooltip"></span>');
                $comment.attr('data-original-title', object.rejected_comment);
                rowTo.append($comment);
            }

        }

		row.append(rowTo);
        
        //Hours
		var rowHours = getTableElement('<td/>', object.time, 'row-hours').attr('nowrap', 'nowrap');

		if (object.time_worked_default == 0) {
			rowHours.append(
				getTableElement(
					'<span/>', '',
					'block-icon-background change-color', {'background-color': object.time_worked_color}
				).append(getFieldText(object.time_worked_type, object.time_worked_short_name))
			);
		}
        if (~~object.rejected && !dataTable.find('#tw-head-rejected').size()) {
            var $reject = $('<span class="fa fa-exclamation-triangle reject"></span>');
            rowHours.append($reject);
            if (object.rejected_comment) {
                var $comment = $('<span class="fa fa-comment tw-in-red hasTooltip"></span>');
                $comment.attr('data-original-title', object.rejected_comment);
                rowHours.append($comment);
            }

        }

		row.append(rowHours);

		if (object.reject_url != undefined) {
            var $td = $('<td/>').addClass('row-rejected');
            $td.append($('<a/>').addClass('fa fa-exclamation-triangle reject').attr('href', object.reject_url).text('').reject());
            if (~~object.rejected && object.rejected_comment) {
                var $comment = $('<span class="fa fa-comment tw-in-red hasTooltip"></span>');
                $comment.attr('data-original-title', object.rejected_comment);
                $td.append($comment);
            }
			row.append($td);
		}

		if (object.billable != undefined) {
			row.append($('<td/>').addClass('row-billable').append(
				$('<a/>')
					.addClass('fa fa-ban billable-toggler ' + (object.billable == '0' ? 'not-billable' : 'billable'))
					.attr('href', object.billable_url)
					.markBillable()
			));
		}

		var editElem = '',
			deleteElem = '',
            copyItem = $('<a />', {'href' : '#', 'class' : 'fa fa-pencil-square-o fa-copy'});

		if (object.edit_url != undefined) {
			editElem = $('<a/>').attr('href', object.edit_url).addClass('edit fa fa-pencil-square-o').click(editItem);
		}

		if (object.delete_url != undefined) {
			deleteElem = $('<a/>').attr('href', object.delete_url).addClass('delete fa fa-times-circle').click(deleteItem);
		}

		row.append($('<td/>').addClass('row-service').attr('nowrap', 'nowrap').append(editElem).append(copyItem).append(deleteElem));
	})(jQuery);

	return row;
}

/**
 * Create element by pattern
 *
 * @param element jquery element
 * @param text text of element
 * @param cssClass element css class
 * @param cssStyleProperties element style
 * @returns {HTMLElement} jquery element
 */
function getTableElement(element, text, cssClass, cssStyleProperties) {
	var elem;
	(function ($) {
		elem = $(element);
		if (text != undefined) {
			elem.html(text);
		}
		if (cssClass != undefined) {
			elem.addClass(cssClass);
		}
		if (cssStyleProperties != undefined) {
			$.each(cssStyleProperties, function (index, value) {
				elem.css(index, value);
			});
		}
	})(jQuery);
	return elem;
}

/**
 * Ckick event for edit links
 *
 * @param event
 */
function editItem(event) {
	removeFormError();
	(function ($) {
		var object = $(event.target);
		event.preventDefault();
		dataTable.find('tr').removeClass('editing warning');
		$.ajax({
			type    : "POST",
			url     : object.attr('href') + '&ajax=true',
			dataType: 'json',
			success : function (response) {
				if (response.error) {
					alert(response.error);
				}
				else {
					$.each(response, function (index, value) {
						if (value.id == 'workentry_add_date') {
							form.find('#' + value.id).val(moment(value.value, $.TimeWorked.dateFormats.mysqlPattern)
								.format($.TimeWorked.dateFormats.momentPatternFullMonth));
						}
						else if (value.id == 'workentry_ticket_numbers') {
							$('#workentry_ticket_numbers').tagsinput('removeAll');
							$('#workentry_ticket_numbers').tagsinput('add', value.value);
						}
						else {
							form.find('#' + value.id).val(value.value);
						}
					});
                    if ($('#workentry_taskid').size()) {
                        loadTasksList(function(){
                            $('#workentry_taskid').val(response.taskid.value).trigger('liszt:updated');
                        });
                    }
					$.TimeWorked.updateSelect();
					var date = new Date(response.date.value);
					jQuery('#tw-calendar').data('plugin_clndr')
						.setYear(date.getFullYear())
						.setMonth(date.getMonth());
					$.TimeWorked.clearSelectedDate();
					$('.row-date-' + response.date.value).addClass('checked-row').addClass('info');
					$('.calendar-day-' + response.date.value).addClass('checked-date');
					object.closest('tr').addClass('editing warning').removeClass('info');
					$('html, body').animate({scrollTop: $("#system-message-container").offset().top}, '500', 'swing');

					$.TimeWorked.resetMessageContainer();

					var messageContainer = $('<span/>').addClass('tw-edit-inner-message')
						._t('current editing workentry', response.task.value, response.project.name, moment(response.date.value, $.TimeWorked.dateFormats.mysqlPattern).format($.TimeWorked.dateFormats.momentPatternFullMonth));

					addEditMessage(messageContainer);

					jQuery('#formToggleSwitcher').data('formSlider').slideDown();
				}
			},
			error   : function () {
				alert($.i18n._('request error'));
			}
		});
	})(jQuery);
}

/**
 * Get choice from short and long text
 *
 * @param full full text
 * @param short short text
 * @param description project description
 * @returns string choice
 */
function getFieldText(full, short, description) {
	return jQuery('<span/>')
		.addClass('hasTooltip')
		.attr('data-original-title', '<strong>' + full + '</strong>' + (description ? ('<br/>' + description) : ''))
		.text(short ? short : full);
}

/**
 * get events for clndr
 */
function getCalendarEvents() {
	var events;
	(function ($) {
		return $.ajax({
			type    : "POST",
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=getEvents',
			data    : window.location.search.substring(1),
			dataType: 'json',
			async   : false,
			success : function (response) {
				events = response;
			}
		});
	})(jQuery);
	return (events == undefined) ? [] : events;
}

/**
 * Get table data via ajax
 *
 * @param id of changed element. 0 - if no element changed
 * @param params url params
 * @returns {Array} table data
 */
function getTableData(id, params) {
	var data;
	params = (params !== undefined) ? '&' + params : '';
	(function ($) {
		return $.ajax({
			type    : "POST",
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=getData',
			data    : 'id=' + id + params,
			dataType: 'json',
			async   : false,
			success : function (response) {
				data = response;
			}
		});
	})(jQuery);
	return (data == undefined) ? [] : data;
}

/**
 * Add edit message to container
 *
 * @param message jQuery element with message
 */
function addEditMessage(message) {
	hideEditMessage().addClass('tw-show').removeClass('tw-hide').append(message);
    form.addClass('edit-action').removeClass('add-action');
}

/**
 * Hide edit message container
 */
function hideEditMessage() {
    form.addClass('add-action').removeClass('edit-action');
	return jQuery('.tw-edit-message').removeClass('tw-show').addClass('tw-hide').text('');
}

/**
 * report form reset
 */
function formReset() {
	(function ($) {
		var projectInput = $('#workentry_projectid'),
			projectVal = projectInput.val(),
			taskInput = $('#workentry_task'),
			taskVal = taskInput.val(),
			leave = form.find('input[name="leaveData[]"]:checked');

		form[0].reset();
		$(form[0]).find('#workentry_id').val(0);
		$('#workentry_ticket_numbers').tagsinput('removeAll');
		$('#workentry_userid').val(curUser);

		$.each(leave, function (index, value) {
			var input = $(value);

			switch (input.val()) {
				case 'project':
					projectInput.val(projectVal);
					break;
				case 'taskName':
					taskInput.val(taskVal);
					break;
			}

			input.prop('checked', true);
		});

		$.TimeWorked.updateSelect();
		hideEditMessage();
	})(jQuery);
}

/**
 * Removed report form error classes
 */
function removeFormError() {
	(function ($) {
		$.each(form.find('.control-group'), function (index, value) {
			$(value).removeClass('error');
		});
	})(jQuery);
}

function updateStatus() {
	jQuery.ajax({
		type    : "GET",
		url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=isNotBillableHours',
		dataType: 'json',
		success : function (response) {
			jQuery('.tw-excel, .tw-print').each(function () {
				jQuery(this).data('exportBillable').setNeedConfirm(response);
			});
		}
	});
}
var loadTasksList = function(callback){
    var projectId = jQuery('#workentry_projectid').val();
    if (!projectId) {
        return;
    }
    jQuery.ajax({
        type : "POST",
        url  : TW_BASE_PATH + "/index.php?option=com_timeworked&view=workentry&task=gettaskslist",
        data : {projectid : projectId},
        dataType : "json",
        success : function(data) {
            jQuery('#workentry_taskid').empty();
            jQuery.each(data, function(i, v){
                jQuery('#workentry_taskid').append('<option value="' + v.value + '">' + v.text + '</option>');
            });
            if (data.length > 1) {
                jQuery('#workentry_taskid').prepend('<option value=""></option>');
            }
            jQuery('#workentry_taskid').trigger('liszt:updated');
            if (typeof callback === 'function') {
                callback();
            }
        }
    });
};
