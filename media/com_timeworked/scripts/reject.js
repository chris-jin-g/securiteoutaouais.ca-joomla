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
	var methods = {
		init: function (element) {
			element = $(element);

			element.on('click.reject', rejectRecordEvent);
		},

		/**
		 * Remove rejection entry from array
		 * @param {number} id
		 * @returns {{id: {number}, name: {string}}}
		 */
		removeRejectedEntry: function (id) {
			var userObject = {};

			$.TimeWorked.tmpRejected = $.grep($.TimeWorked.tmpRejected, function (val) {
				if (val['id'] == id) {
					userObject = {id: val['userid'], name: val['name']};

					return false;
				}
				return true;
			});

			return userObject;
		},

		/**
		 * Update block with rejection information
		 * @param {number} userid user id
		 * @param {string} name username
		 */
		updateUserBlockRejection: function (userid, name) {
			var userCount = 0;

			$.each($.TimeWorked.tmpRejected, function (key, val) {
				if (val['userid'] == userid) {
					userCount++;
				}
			});

			if (userCount == 0) {
				$('div.alert.user-' + userid).remove();
			}
			else {
				var wrapper = $('.rejected-wrapper');
				var time = 0;
				var records = 0;
				var rejectText = '';

				$.each($.TimeWorked.tmpRejected, function (key, value) {
					if (value['userid'] == userid) {
						var tmp = value['time'].split(':');

						time += parseInt(tmp[0]) * 60 + parseInt(tmp[1]);
						records++;
					}
				});

				if ((time >= 60 && time < 120) && records === 1) {
					rejectText = 'notify user about rejected hours in his report 1 hour 1 record';
				} else if ((time >= 120 || (time > 0 && time < 60)) && records === 1) {
					rejectText = 'notify user about rejected hours in his report hours 1 record';
				} else if ((time >= 60 && time < 120) && records > 1) {
					rejectText = 'notify user about rejected hours in his report 1 hour records';
				} else if ((time >= 120 || (time > 0 && time < 60)) && records > 1) {
					rejectText = 'notify user about rejected hours in his report hours records';
				}

				var m = time % 60,
                    h = time / 60 >> 0;
                
                time = ((h > 10) ? h : '0' + h) + ':' + ((m > 10) ? m : '0' + m);
				
				if (wrapper.find('.user-' + userid).length > 0) {
					name = wrapper.find('.user-' + userid).find('.rejected-title').find('.user').text();
					wrapper.find('.user-' + userid).find('.rejected-title')._t(rejectText, name, time, records);
				}
				else {
					wrapper.append(
						$('<div/>').addClass('alert alert-block alert-error user-' + userid)
							.append($('<button/>').attr('type', 'button').attr('data-dismiss', 'alert').addClass('close').append($('<i/>').addClass('fa fa-times-circle')))
							.append($('<p/>').addClass('rejected-title')._t(rejectText, name, time, records))
							.append($('<p/>')._t('add a comment (optional)'))
							.append($('<textarea/>'))
							.append($('<a/>').attr('href', TW_BASE_PATH + '/index.php?option=com_timeworked&view=worklog&task=setRejected&id=' + userid)._t('notify'))
					);

					var userRejectionBlock = $('.alert.user-' + userid);

					userRejectionBlock.bind('close', function () {
						var id = 0;
						$.each($(this).closest('div').attr('class').split(' '), function (key, value) {
							if (value.match(/^user-\d+$/)) {
								id = value.replace('user-', '');
							}
						});

						rebuildRejectedArray(id, true);
					});

					userRejectionBlock.find('a').click(rejectEvent);
				}
			}
		},
	};

	/**
	 * Reject click event
	 * @param {object} event
	 */
	function rejectRecordEvent(event) {
		event.preventDefault();

		var row = $(this).closest('tr');
		var userObject;

		if (row.attr('class').indexOf('reject-highlight') > -1) {
			userObject = removeRejected(row);
		}
		else {
			userObject = addRejected(row, event.target);
		}

		if (userObject) {
			methods.updateUserBlockRejection(userObject.id, userObject.name);
		}
	}

	/**
	 * Remove rejection from item
	 * @param {object} row item row from table
	 */
	function removeRejected(row) {
		var id = row.attr('class').match(/row-\d+/)[0].replace('row-', '');
		var success = false;

		$.ajax({
			type    : 'POST',
			url     : TW_BASE_PATH + '/index.php?option=com_timeworked&view=workentry&task=removeRejected',
			data    : {
				ajax: true,
				id  : id
			},
			dataType: 'json',
			async   : false,
			success : function (request) {
				if (!request.error) {
					success = true;
                    updateData(0, window.location.href.split('?')[1]);
				}
				else {
					alert(response.error);
				}
			},
			error   : function () {
				alert($.i18n._('request error'));
			}
		});

		if (success) {
			row.removeClass('reject-highlight');

			return methods.removeRejectedEntry(id);
		}
	}

	/**
	 * Mark item as rejected
	 * @param {object} row item row from table
	 * @param {string} element target element
	 */
	function addRejected(row, element) {
		var success = false;
		var userObject;

		row.addClass('reject-highlight');

		$.ajax({
			type    : 'POST',
			url     : $(element).attr('href') + '&ajax=true',
			dataType: 'json',
			async   : false,
			success : function (response) {
				if (!response.error) {
					success = true;
					userObject = {name: response['name'], id: response['userid']};
					$.TimeWorked.tmpRejected.push(response);
				}
				else {
					alert(response.error);
				}
			},
			error   : function () {
				alert($.i18n._('request error'));
			}
		});

		return userObject;
	}

	/**
	 * Rebuild rejected array. Remove user items from rejection array
	 * @param {number} userid user id for removing from array
	 * @param {boolean} removeHighlight true - need remove highlight from table
	 */
	function rebuildRejectedArray(userid, removeHighlight) {
		$.TimeWorked.tmpRejected = $.grep($.TimeWorked.tmpRejected, function (value) {
			if (value['userid'] == userid) {
				if (removeHighlight) {
					$('.row-' + value['id']).removeClass('reject-highlight');
				}
				return false;
			}
			return true;
		});
	}

	/**
	 * Submit user block with rejected information. Set items as rejected
	 * @param {object} event
	 */
	function rejectEvent(event) {
		event.preventDefault();

		var userid = $.TimeWorked.getQueryStringParameter(jQuery(this).attr('href'), 'id');
		var block = jQuery(this).closest('div.alert');

		jQuery.ajax({
			type    : 'POST',
			url     : jQuery(this).attr('href') + '&ajax=true',
			data    : {
				ids    : jQuery.map($.TimeWorked.tmpRejected, function (value) {
					if (value['userid'] == userid) {
						return value['id'];
					}
				}),
				comment: block.find('textarea').val()
			},
			dataType: 'json',
			success : function (response) {
				if (response.error) {
					alert(response.error);
				}
				else {
					rebuildRejectedArray(userid, false);
					updateData(0, location.search.substring(1));
				}
				block.alert('close');
			},
			error   : function () {
				alert(jQuery.i18n._('request error'));
			}
		});
	}

	$.fn.reject = function (method, params) {
		if (method == undefined) {
			method = 'init';
		}

		this.each(function () {
			if (method == 'init') {
				params = this;
			}

			methods[method](params);
		});

		return this;
	};
})(jQuery);
