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
	var filterStartDate = null;
	var filterEndDate = null;
	var filterBar = null;
	var filterClientValue;
	var filterClient = null;
	var filterProject = null;
	var filterProjectValue;

	/**
	 * Reset filters
	 *
	 * @param filterBar filter bar selector
	 */
	function resetFiltersForm(filterBar) {
		filterBar.find('select').each(function () {
			$(this).find('option').each(function () {
				$(this).removeAttr('selected');
			});
		});

		filterBar.find('input[type="text"]').each(function () {
			$(this).val('');
		});

		projectsRequest();
        tasksRequest();
		autosubmitRequest();
	}

	/**
	 * Add events on filter bar selects
	 *
	 * @param {string} filterBar filter bar selector
	 */
	function addAutosubmitFiltersEvent() {
		$(filterBar.find('select')).each(function () {
			$(this).change(autosubmitRequest);
		});
	}

	function getProjects() {
		$('#filter_client').change(function () {
			projectsRequest();
			usersRequest();
		});
	}

	function usersRequest() {
		$.ajax({
			type    : "POST",
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=users&task=getUsers',
			data    : 'filter_client=' + $('#filter_client').val() + '&filter_project=' + $('#filter_project').val(),
			dataType: 'json',
			async   : false,
			success : function (response) {
				var filterProject = $('#filter_staff');
				filterProject.find('option').remove().end();

				filterProject.append($('<option/>').text('').attr('value', ''));

				$.each(response, function (index, value) {
					filterProject.append($('<option/>').text(value.name).attr('value', value.id));
				});
				$.TimeWorked.updateSelect();
			}
		});
	}

	function projectsRequest() {
		$.ajax({
			type    : "POST",
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=getProjects',
			data    : 'id=' + $('#filter_client').val(),
			dataType: 'json',
			async   : false,
			success : function (response) {
				var filterProject = $('#filter_project');
				filterProject.find('option').remove().end();

				filterProject.append($('<option/>').text('').attr('value', ''));

				$.each(response, function (index, value) {
					filterProject.append($('<option/>').text(value.name).attr('value', value.id));
				});
				$.TimeWorked.updateSelect();
			}
		});
	}

	function tasksRequest() {
		$.ajax({
			type    : "POST",
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=getReportTasks',
			data    : 'projectid=' + $('#filter_project').val(),
			dataType: 'json',
			async   : false,
			success : function (response) {
				var filterTask = $('#filter_task');
				filterTask.find('option').remove().end();

				filterTask.append($('<option/>').text('').attr('value', ''));

				$.each(response, function (index, value) {
					filterTask.append($('<option/>').text(value.task).attr('value', value.id));
				});
				filterTask.trigger('liszt:updated');
			}
		});
	}

	function updateFilterDates() {
		$.ajax({
			type    : "POST",
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=getDateRanges',
			data    : 'filter_client=' + $('#filter_client').val() + '&' + 'filter_project=' + $('#filter_project').val(),
			dataType: 'json',
			async   : false,
			success : function (response) {
				var filterDates = $('#filter_date_month'),
					selected = filterDates.find(":selected").val();

				filterDates
					.find('option').remove().end()
					.append($('<option/>').text('').attr('value', ''));

				$.each(response, function (index, value) {
					filterDates.append($('<option/>').text(value.name).attr('value', value.id));
				});

				filterDates.val(selected);

				$.TimeWorked.updateSelect();
			}
		})
	}

	/**
	 * Send request for filter update
	 *
	 * @param event event
	 */
	function autosubmitRequest(event) {
		var url = $.TimeWorked.updateQueryStringParameter(window.location.href, 'limitstart', 0);
		var params = 'limitstart=0';

		if (filterClient.val() != filterClientValue || filterProject.val() != filterProjectValue) {
			updateFilterDates();
		}

		if (filterClient.val() != filterClientValue) {
			$('#filter_project').val('');
		}

		filterClientValue = filterClient.val();
		filterProjectValue = filterProject.val();

		$.each(filterBar.closest('form').find('select, input[type="text"][name]'), function (index, value) {
			url = $.TimeWorked.updateQueryStringParameter(url, $(value).attr('id'), $(value).val());
			params += '&' + $(value).attr('id') + '=' + $(value).val();
		});

		history.pushState(null, document.title, url);
		jQuery('#tw-calendar').data('plugin_clndr').setEvents(getCalendarEvents());
		updateData(0, params);
	}

	function initLogFilters() {
		var filterReset = $('#tw-filters-reset');
		var filterDateRange = $('#tw-precise-dates-button');
		var filterDateMonth = $('#filter_date_month');
		filterBar = $('#tw-filter-bar');
		filterClient = $('#filter_client');
		filterProject = $('#filter_project');

		filterClientValue = filterClient.val();
		filterProjectValue = filterProject.val();

		filterProject.change(function () {
			usersRequest();
		});

		addAutosubmitFiltersEvent();
		getProjects();
        if ($('#filter_task').size()) {
            $('#filter_project').change(tasksRequest);
        }

		$('#filter_keyword').change(autosubmitRequest);
		$('#filter_ticket').change(autosubmitRequest);

		filterReset.click(function () {
			$.cookie('filterDate', null);
			resetFiltersForm(filterBar);
		});

		filterDateRange.daterangepicker({
			locale       : {firstDay: 1},
			format       : $.TimeWorked.dateFormats.momentPattern,
			buttonClasses: 'tw-btn tw-btn-small',
			applyClass   : 'tw-btn-success',
			cancelClass  : 'tw-btn-default',
			opens        : 'left',
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

		filterDateRange.on('apply.daterangepicker', function (event, picker) {
			filterStartDate = [];
			filterStartDate['val'] = picker.startDate.format($.TimeWorked.dateFormats.mysqlPattern);
			filterStartDate['text'] = picker.startDate.format($.TimeWorked.dateFormats.momentPattern);
			filterEndDate = [];
			filterEndDate['val'] = picker.endDate.format($.TimeWorked.dateFormats.mysqlPattern);
			filterEndDate['text'] = picker.endDate.format($.TimeWorked.dateFormats.momentPattern);
			var filterDate = $.cookie('filterDate');

            var obj = filterDate ? JSON.parse(filterDate) : [];
            var alreadyExists = false;
            if (filterDate && obj) {
                $.each(obj, function(i,v){
                    if (filterStartDate.val === v.start && filterEndDate.val === v.end) {
                        alreadyExists = true;
                        return false;
                    }
                });
            } else {
                obj = [];
            }
            if (!alreadyExists) {
                obj.push({start: filterStartDate['val'], end: filterEndDate['val']});
                var newOption = $('<option/>').attr('value', filterStartDate['val'] + '--' + filterEndDate['val'])
                    .attr('selected', 'selected').text(filterStartDate['text'] + ' — ' + filterEndDate['text']);
                $(filterDateMonth.find('option[value=""]')).after(newOption);
                $.cookie('filterDate', JSON.stringify(obj), {path: '/'});
            }

			filterDateMonth.find('option:selected').removeAttr('selected');
            filterDateMonth.find("[value='" + filterStartDate['val'] + '--' + filterEndDate['val'] + "']").attr('selected', 'selected');

			$.TimeWorked.updateSelect();

			autosubmitRequest();
		});

		filterDateRange.on('hide.daterangepicker', function (event, picker) {
			event.preventDefault();
		});

	}

    $.TimeWorked.initLogFilters = initLogFilters;

})
(jQuery);
