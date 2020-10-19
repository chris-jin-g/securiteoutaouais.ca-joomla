/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */

 /**
 * Function to add a new user to staff list in admin part
 *
 * @param id user id
 */
function addUser(id) {
	var name = $('jform_user_add').value;
	var inputid = 'jform_staff_update' + id;
	if (!$(inputid)) {
		var elem = Element('li').inject($$('#jform_staff_update ul')[0], 'top');
		Element('input', {type: 'checkbox', id: inputid, name: 'jform[staff_update][]', value: id, checked: 'checked'})
			.inject(elem, 'top');
		Element('label', {'for': inputid}).set('text', name).inject(elem, 'bottom');
	}
}

/**
 * Function to check changes in the staff list every 100 ms
 */
function checkUsersChanges() {
	var elem = $('jform_user_add_id');
	if (!elem)
		return false;
	var oldval = elem.value;
	window.setInterval(function () {
		if (elem.value != oldval) {
			oldval = elem.value;
			addUser(elem.value);
		}
	}, 100);
	return true;
}

/**
 * Event to do when document loaded
 */
window.addEvent('domready', function () {
	checkUsersChanges();
});

(function($){
    $(document).ready(function(){
        if ($('#jform_taskid').size()) {
            var loadTasksList = function(){
                var projectId = $('#jform_projectid').val();
                if (!projectId) {
                    return;
                }
                $.ajax({
                    type : "POST",
                    url  : TW_BASE_PATH + "/index.php?option=com_timeworked&view=workentry&task=gettaskslist",
                    data : {projectid : projectId},
                    dataType : "json",
                    success : function(data) {
                        $('#jform_taskid').empty();
                        $.each(data, function(i, v){
                            $('#jform_taskid').append('<option value="' + v.value + '">' + v.text + '</option>');
                        });
                        if (data.length > 1) {
                            $('#jform_taskid').prepend('<option value=""></option>');
                        }
                        $('#jform_taskid').trigger('liszt:updated');
                    }
                });
            };
            $('#jform_projectid').change(loadTasksList);
    //        loadTasksList();
        }
    });
})(jQuery);