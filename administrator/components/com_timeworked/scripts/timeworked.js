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

        var fromHr, fromMin, toHr, toMin;

        var deltaHr, deltaMin;

        var workedHours;

        /* Add event listenrs for from and to calendar */
        document.addEventListener('DOMContentLoaded', function() {
            Joomla.fromDateTimeChanged();
            Joomla.toDateTimeChanged();
        });
  
        Joomla.fromDateTimeChanged = function(e) {
            var fromDateTimeValue = $('#jform_from').val();
            
            // Set jform_to value as default value-jform_from
            $("#jform_to").val(fromDateTimeValue);
            
            // Calculate total working hours
            calc_total_hour();
        }

        Joomla.toDateTimeChanged = function() {
            calc_total_hour();
            // var fromDateTimeValue = $('#jform_from').val();
            // var toDateTimeValue =  $('#jform_to').val();
            // var fromDateValue = fromDateTimeValue.split(" ")[0];
            // var toDateValue = toDateTimeValue.split(" ")[0];
            // if(fromDateValue === toDateValue) {
            //     calc_total_hour();
            // } else {
            //     $("#jform_to").val(fromDateTimeValue);
            //     alert("This field must be selected with same date.");
            // }
        }

        $(document).on('click','#jform_to_btn',function(){

            $("#jform_to").val($('#jform_from').val());

          
        });
        
        function calc_total_hour() {
            var startTime = $('#jform_from').val();
            var endTime = $('#jform_to').val();
            var timeStart = new Date(startTime).getTime();
            var timeEnd = new Date(endTime).getTime();

            var timeDiff = (timeEnd - timeStart)/1000;

            // Error handling when total working time is over 1 day.
            // if(timeDiff > 86400 ) {
            //     // Set default value as start time.
            //     $("#jform_to").val($('#jform_from').val());
            //     return false;
            // }

            // Error handling when end time is before than start time
            if(timeDiff < 0 ) {
                // Set default value as start time.
                $("#jform_to").val($('#jform_from').val());
                return false;
            }

            if( Number.isNaN(timeDiff)) {
                return false;
            }

            // Convert from second value to timeString: 180-> 03:00
            format_timeDiff = convertTimeString(timeDiff);

            // Display total working time
            $("#jform_time").val(format_timeDiff);    
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
        
	});

})(jQuery);

