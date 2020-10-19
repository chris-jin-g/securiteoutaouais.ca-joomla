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
?>

<form action="<?php echo JRoute::_('index.php'); ?>" novalidate="novalidate" method="post">
	<div class="control-group">
		<?php echo JText::_('COM_TIMEWORKED_CONFIRM_MESSAGE'); ?>
	</div>

	<div class="control-group">
		<input type="submit" value="<?php echo JText::_('JACTION_DELETE'); ?>" class="btn btn-danger" />
		<?php echo JText::_('COM_TIMEWORKED_OR'); ?>
		<a href="<?php echo JRoute::_('index.php?option=com_timeworked&view=worklog'); ?>" class="btn"><?php echo JText::_('JCANCEL'); ?></a>
	</div>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="option" value="com_timeworked" />
	<input type="hidden" name="view" value="workentry" />
	<input type="hidden" name="task" value="delete" />
	<input type="hidden" name="id" value="<?php echo $this->id; ?>" />
</form>