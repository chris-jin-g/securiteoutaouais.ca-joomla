/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 * Overridden Joomla js core methods
 */

if (typeof(Joomla) === 'undefined') {
	var Joomla = {};
}

Joomla.tableOrdering = function (order, dir, task) {
	var url = jQuery.TimeWorked.updateQueryStringParameter(window.location.href, 'start', 0);
	var params = 'start=0';

	url = jQuery.TimeWorked.updateQueryStringParameter(url, 'filter_order', order);
	url = jQuery.TimeWorked.updateQueryStringParameter(url, 'filter_order_Dir', dir);
	params += '&filter_order=' + order + '&filter_order_Dir=' + dir;
    
    jQuery.each(jQuery('#tw-filter-bar').closest('form').find('select, input[type="text"][name]'), function (index, value) {
        params += '&' + jQuery(value).attr('id') + '=' + jQuery(value).val();
    });

	history.pushState(null, document.title, url);
	jQuery('#tw-calendar').data('plugin_clndr').setEvents(getCalendarEvents());
	updateData(0, params);

	dir = (dir === 'desc') ? 'asc' : 'desc';

	var classDir = 'icon-arrow-' + (dir === 'asc' ? 'down' : 'up') + '-3';
	var selector = jQuery('#tw-head-' + order);
	var onClick = 'Joomla.tableOrdering(\'' + order + '\',\'' + dir + '\',\'' + task + '\');return false;';

	jQuery(selector.find('a')).removeAttr('onclick').unbind('click').click(new Function(onClick));
    
    selector.closest('tr').find('i').remove();
    selector.append(jQuery('<i/>').addClass(classDir));
};
