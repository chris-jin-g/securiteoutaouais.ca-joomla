/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
jQuery(document).ready(function () {
	var task = '';

	jQuery('#toolbar-publish, #toolbar-unpublish').find('button').removeAttr('onclick');

	jQuery('#toolbar-publish').find('button').click(function (event) {
		event.preventDefault();

		task = 'leaves.approve';
		jQuery('#approveModal').modal('show');
	});

	jQuery('#toolbar-unpublish').find('button').click(function (event) {
		event.preventDefault();

		task = 'leaves.reject';
		jQuery('#approveModal').modal('show');
	});

	jQuery('#confirmApproveModal').click(function (event) {
		event.preventDefault();

		jQuery('#admin_comment').val(jQuery('#approveLeaves').val());
		Joomla.submitbutton(task);
	});
});
