<?php
/**
 * Leave form template
 *
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

$document = JFactory::getApplication()->getDocument();

$document->addScript(JUri::root() . '/media/com_timeworked/scripts/moment/min/moment-with-locales.min.js');
$document->addScript(JUri::root() . '/media/com_timeworked/scripts/bootstrap-daterangepicker/daterangepicker.js');
$document->addScript(JUri::root() . '/media/com_timeworked/scripts/wt_lib.js');

$document->addStyleSheet(JUri::root() . '/media/com_timeworked/scripts/bootstrap-daterangepicker/daterangepicker-bs2.css');

?>
<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<?php endif; ?>
<div id="j-main-container" class="<?php if (!empty($this->sidebar)): ?>span10<?php endif; ?>">
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-horizontal">
        <fieldset class="adminform">
            <legend>
                <?php echo ($this->item->id == 0 ? JText::_('JTOOLBAR_NEW') : JText::_('JTOOLBAR_EDIT')) . ' ' . JText::_('COM_TIMEWORKED_LEAVE'); ?>
            </legend>
            <?php
            foreach ($this->form->getFieldset() as $field)
            {
                echo $this->form->getControlGroup($field->getAttribute('name'));
            }
            ?>
        </fieldset>

        <input type="hidden" name="option" value="com_timeworked" />
        <input type="hidden" name="task" value="leave" />
        <input type="hidden" name="id" value="<?php echo $this->item->id; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>

<script>
	var dateRange = jQuery('#jform_daterange_img'),
		startDate = jQuery('#jform_start_date').val(),
		endDate = jQuery('#jform_end_date').val();

	dateRange.daterangepicker({
		locale: {firstDay: 1},
		format: jQuery.TimeWorked.dateFormats.momentPattern
	});

	dateRange.on('apply.daterangepicker', function (event, picker) {
		jQuery('#jform_daterange')
			.val(picker.startDate.format(jQuery.TimeWorked.dateFormats.momentPattern) + ' — ' +
			picker.endDate.format(jQuery.TimeWorked.dateFormats.momentPattern));
		jQuery('#jform_start_date').val(picker.startDate.format(jQuery.TimeWorked.dateFormats.mysqlPattern));
		jQuery('#jform_end_date').val(picker.endDate.format(jQuery.TimeWorked.dateFormats.mysqlPattern));
	});

	if (startDate && endDate) {
		jQuery('#jform_daterange')
			.val(moment(startDate).format(jQuery.TimeWorked.dateFormats.momentPattern) + ' — ' +
			moment(endDate).format(jQuery.TimeWorked.dateFormats.momentPattern)
		);
		dateRange.data('daterangepicker').setStartDate(moment(startDate));
		dateRange.data('daterangepicker').setEndDate(moment(endDate));
	}
</script>