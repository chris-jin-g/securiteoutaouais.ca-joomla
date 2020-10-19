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

      

        /* fetch time value to the hh:mm template */

        $('#jform_from').off('keyup change').on('keyup change', function(){

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

                $('#jform_time').val(workedHours);

            }

            

            $this.val(val);

            $('#jform_to').val(val);

        });

        $('#jform_from').off('keydown').on('keydown', function(e){

            if (e.which !== 8) {

                return;

            }

            var $this = $(this), val = $this.val();

            if (val[val.length-1] === ':') {

                val = val.slice(0, -1);

                $this.val(val);

                $('#jform_to').val(val);

            }

        });



        /* fetch time value to the hh:mm template */

        $('#jform_to').off('keyup change').on('keyup change', function(){

            var $this = $(this), val = $this.val();

            val = val.replace(/[^\d\:]/, '');

            

            val = val.replace(/^(\d{2})(\d+)?$/, "$1:$2");

            if (val.length > 2) {

                var p = val.split(':'), h = p[0], m = p[1];

                if (isNaN(~~h) || ~~h > 23) {

                    h = '23';

                }

		if (h < fromHr)
		    h = fromHr;

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

                $('#jform_time').val(workedHours);

            }



            $this.val(val);

        });

        $('#jform_to').off('keydown').on('keydown', function(e){

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

