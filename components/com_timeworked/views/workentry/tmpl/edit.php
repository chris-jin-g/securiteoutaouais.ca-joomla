<?php
/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;

JHtml::_('jquery.framework');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

$document = JFactory::getDocument();

$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js');
$document->addScript(JUri::base(true) . '/media/com_timeworked/scripts/tags.js');

$document->addStyleSheet(JUri::base(true) . '/media/com_timeworked/scripts/bootstrap-tagsinput/dist/bootstrap-tagsinput.css');
?>
<h1><?php echo JText::_('COM_TIMEWORKED_EDIT'); ?></h1>
<form action="<?php echo JRoute::_('index.php'); ?>" novalidate="novalidate" class="form-horizontal add_action form-validate" method="post">
	<?php foreach ($this->form->getFieldset() as $field)
	{
		$name = $field->getAttribute('name');

		if (isset($this->postFormData[$this->control][$name]))
		{
			$this->form->setValue($name, null, $this->postFormData[$this->control][$name]);
		}

		echo $this->form->getControlGroup($name);
	}
	?>
	<div class="control-group">
		<input type="submit" value="<?php echo JText::_('JSUBMIT'); ?>" class="btn btn-primary pull-right" />
	</div>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="option" value="com_timeworked" />
	<input type="hidden" name="view" value="workentry" />
	<input type="hidden" name="task" value="save" />
</form>
