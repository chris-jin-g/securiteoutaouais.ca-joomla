<?php
/**
 * Time worked type form template
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

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function (task) {
		if (task == 'timeworkedtype.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			Joomla.submitform(task, document.getElementById('item-form'));
		}
		else {
			alert('" . $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')) . "');
		}
	}
");
?>
<?php if (!empty($this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<?php endif; ?>
<div id="j-main-container" class="<?php if (!empty($this->sidebar)): ?>span10<?php endif; ?>">
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo ($this->item->id == 0 ? JText::_('JTOOLBAR_NEW') : JText::_('JTOOLBAR_EDIT')) . ' ' . JText::_('COM_TIMEWORKED_TIME_WORKED_TYPE'); ?></legend>
            <?php
            foreach ($this->form->getFieldset() as $field)
            {
                echo $this->form->getControlGroup($field->getAttribute('name'));
            }
            ?>
        </fieldset>
        <input type="hidden" name="option" value="com_timeworked" />
        <input type="hidden" name="task" value="timeworkedtype" />
        <input type="hidden" name="id" value="<?php echo $this->form->getValue('id'); ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo JText::_('COM_TIMEWORKED_DEFAULT_TIME_TYPE_NOTICE'); ?>
    </div>
</div>