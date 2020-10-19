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
	$(document).ready(function () {

        document.addEventListener('DOMContentLoaded', function() {
            Joomla.startTimeChanged();
            Joomla.endTimeChanged();
        });
  
        Joomla.startTimeChanged = function(e) {
            var fromDateTimeValue = $('#workentry_from').val();
            
            // Set jform_to value as default value-jform_from
            $("#workentry_to").val(fromDateTimeValue);
            
            // Calculate total working hours
            calc_total_hour();
        }

        Joomla.endTimeChanged = function() {
            calc_total_hour();
        }

        $(document).on('click','#workentry_to_btn',function(){
            $("#workentry_to").val($('#workentry_from').val());          
        });
        
        function calc_total_hour() {
            var startTime = $('#workentry_from').val();
            var endTime = $('#workentry_to').val();
            var timeStart = new Date(startTime).getTime();
            var timeEnd = new Date(endTime).getTime();

            var timeDiff = (timeEnd - timeStart)/1000;

            // Error handling when total working time is over 1 day.
            if(timeDiff > 86400 ) {
                // Set default value as start time.
                $("#workentry_to").val($('#workentry_from').val());
                return false;
            }

            // Error handling when end time is before than start time
            if(timeDiff < 0 ) {
                // Set default value as start time.
                $("#workentry_to").val($('#workentry_from').val());
                return false;
            }

            if( Number.isNaN(timeDiff)) {
                return false;
            }

            // Convert from second value to timeString: 180-> 03:00
            format_timeDiff = convertTimeString(timeDiff);

            // Display total working time
            $("#workentry_time").val(format_timeDiff);        
        }

        function convertTimeString(sec_num) {
            var hours   = Math.floor(sec_num / 3600);
            var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
            var seconds = sec_num - (hours * 3600) - (minutes * 60);

            if (hours   < 10) {hours   = "0"+hours;}
            if (minutes < 10) {minutes = "0"+minutes;}
            if (seconds < 10) {seconds = "0"+seconds;}
            return hours+':'+minutes;
        }
        

        var fromHr, fromMin, toHr, toMin;
        var deltaHr, deltaMin;
        var workedHours;
        
		// Set moment.js language
		moment.locale($.TimeWorked.momentLang);
        $.TimeWorked.initLogFilters();
		// Add calendar
		var checkedDateClass = null;
		$('#tw-calendar').clndr({
			clickEvents            : {
				click        : function (target) {
					var date = target.date.format($.TimeWorked.dateFormats.mysqlPattern);

					$.TimeWorked.clearSelectedDate();
					checkedDateClass = 'calendar-day-' + date;
					$('#workentry_add_date').val(target.date.format($.TimeWorked.dateFormats.momentPattern));
					$(target.element).addClass('checked-date');
					$('.row-date-' + date).addClass('checked-row').addClass('info');
				},
				onMonthChange: function (month) {
					$('.' + checkedDateClass).addClass('checked-date');
				},
				today        : function (month) {
					var date = moment(new Date()).format($.TimeWorked.dateFormats.mysqlPattern);

					$.TimeWorked.clearSelectedDate();
					checkedDateClass = 'calendar-day-' + date;
					$('#workentry_add_date').val(moment(new Date()).format($.TimeWorked.dateFormats.momentPattern));
					$('.' + checkedDateClass).addClass('checked-date');
					$('.row-date-' + date).addClass('checked-row').addClass('info');
				}
			},
			ready                  : function () {
				var classes = $('.today').addClass('checked-date').attr('class');
				classes = classes.split(' ');
				$.each(classes, function (index, value) {
					if (value.match(/calendar-day-\d{4}-\d{2}-\d{2}/)) {
						$('#workentry_add_date').val(
							moment(value.replace('calendar-day-', '')).format($.TimeWorked.dateFormats.momentPattern)
						);
					}
				});
			},
			doneRendering          : function () {
				$('#tw-today-date').text(moment().format($.TimeWorked.dateFormats.momentPatternFullMonth));
			},
			events                 : clndrEvents,
			showAdjacentMonths     : true,
			adjacentDaysChangeMonth: true,
			forceSixRows           : true,
			template               : $('#clndr-template').html()
		});

        if ($.fn.typeahead) {
            // Add autocomplete function for task name
            $('#workentry_task').typeahead({
                source   : function (query, process) {
                    return $.ajax({
                        type    : "POST",
                        url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=workentry&task=gettasksname',
                        data    : {search: query, project: $('#workentry_projectid').val()},
                        dataType: 'json',
                        success : function (options) {
                            return process(options);
                        }
                    });
                },
                minLength: 2
            });
        }

		// Add tagsinput for Related Tickets field
		var taskId = $('#workentry_ticket_numbers');
		taskId.tagsinput({
			confirmKeys: [9, 32, 188],
			trimValue  : true
		});

		taskId.on('beforeItemAdd', function (event) {
			event.cancel = ($(event.currentTarget).val().length + event.item.length + 1) > 255;
		});

		// Add ajax pagination for list
		$('.tw-paginator').ajaxPagination();

		// Table settings
		$('.tw-column-toggle').hideColumns();

		// Add form collapse method
		$('.tw-slide-switcher').formSlider({
			cookiePrefix: 'tw_'
		});

		// Set text color
		$('.change-color').changeColor();

		// Add rejected elements functionality
		$('a.reject').reject();

		// Mark as billable/not billable items
		$('a.billable-toggler').markBillable()

        /* fetch time value to the hh:mm template */
        $('#workentry_from').off('keyup change').on('keyup change', function(){
            var $this = $(this), val = $this.val();
            val = val.replace(/[^\d\:]/, '');
            
            val = val.replace(/^(\d{2})(\d+)?$/, "$1:$2");
            if (val.length > 2) {
                var p = val.split(':'), h = p[0], m = p[1];
                if (isNaN(~~h) || ~~h > 23) {
                    h = '23';
                }
                if (m.length > 2) {
                    m = m.slice(0, 2);
                }
                if (m !== '' && (isNaN(~~m) || ~~m > 59)) {
                    m = '00';
                }
                val = h + ':' + m;
            }
            fromHr = parseInt(h);
            fromMin = parseInt(m);
            
	    deltaHr = parseInt(((toHr * 60 + toMin) - (fromHr * 60 + fromMin)) / 60);
            deltaMin = parseInt(((toHr * 60 + toMin) - (fromHr * 60 + fromMin)) % 60);
            if(deltaMin < 10)
                deltaMin = '0' + deltaMin;

            if(!(isNaN(deltaHr) || isNaN(deltaMin))) {
                workedHours = deltaHr + ':' + deltaMin;
                $('#workentry_time').val(workedHours);
            }
            
            $this.val(val);
	    $('#workentry_to').val(val);
        });
        $('#workentry_from').off('keydown').on('keydown', function(e){
            if (e.which !== 8) {
                return;
            }
            var $this = $(this), val = $this.val();
            if (val[val.length-1] === ':') {
                val = val.slice(0, -1);
                $this.val(val);
		$('#workentry_to').val(val);
            }
        });

        /* fetch time value to the hh:mm template */
        $('#workentry_to').off('keyup change').on('keyup change', function(){
            var $this = $(this), val = $this.val();
            val = val.replace(/[^\d\:]/, '');
            
            val = val.replace(/^(\d{2})(\d+)?$/, "$1:$2");
            if (val.length > 2) {
                var p = val.split(':'), h = p[0], m = p[1];
                if (isNaN(~~h) || ~~h > 23) {
                    h = '23';
                }
		if (h <= fromHr) 
		    h = fromHr
                if (m.length > 2) {
                    m = m.slice(0, 2);
                }
                if (m !== '' && (isNaN(~~m) || ~~m > 59)) {
                    m = '00';
                }
                val = h + ':' + m;
            }
            toHr = parseInt(h);
            toMin = parseInt(m);
            
            deltaHr = parseInt(((toHr * 60 + toMin) - (fromHr * 60 + fromMin)) / 60);
            deltaMin = parseInt(((toHr * 60 + toMin) - (fromHr * 60 + fromMin)) % 60);
            if(deltaMin < 10)
                deltaMin = '0' + deltaMin;

            if(!(isNaN(deltaHr) || isNaN(deltaMin))) {
                workedHours = deltaHr + ':' + deltaMin;
                $('#workentry_time').val(workedHours);
            }

            $this.val(val);
        });
        $('#workentry_to').off('keydown').on('keydown', function(e){
            if (e.which !== 8) {
                return;
            }
            var $this = $(this), val = $this.val();
            if (val[val.length-1] === ':') {
                val = val.slice(0, -1);
                $this.val(val);
            }
        });
	});
})(jQuery);
