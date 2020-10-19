<?php
/**
 * Staff field type
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
JFormHelper::loadFieldClass('checkboxes');

class JFormFieldProjectsSelect extends JFormFieldCheckboxes
{
	/**
	 * {@inheritdoc}
	 */
	protected $type = 'projectsselect';

	/**
	 * {@inheritdoc}
	 */
	protected function getInput()
	{
		$html = array();
		$link = 'index.php?option=com_timeworked&amp;view=projects&amp;layout=modal&amp;tmpl=component&amp;field=' . $this->id;

		$attr = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
		$attr .= $this->required ? ' required' : '';

		JHtml::_('behavior.modal', 'a.modal_' . $this->id);

		$script = array();
		$script[] = '	function jSelectProject_' . $this->id . '(id, title) {';
		$script[] = '		var old_id = document.getElementById("' . $this->id . '_id").value;';
		$script[] = '		if (old_id != id) {';
		$script[] = '			document.getElementById("' . $this->id . '_id").value = id;';
		$script[] = '			document.getElementById("' . $this->id . '").value = title;';
		$script[] = '			document.getElementById("' . $this->id . '").className = document.getElementById("' . $this->id . '").className.replace(" invalid" , "");';
		$script[] = '			' . $this->onchange;
		$script[] = '		}';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

		$table = JTable::getInstance('projects', 'TimeWorkedTable');

		if (is_numeric($this->value))
		{
			$table->load($this->value);
		}
        $table->name = JText::_('COM_TIMEWORKED_TASK_SELECT_PROJECT');

		$html[] = '<div class="input-append">';
		$html[] = '	<input type="text" id="' . $this->id . '" value="' . htmlspecialchars($table->name, ENT_COMPAT, 'UTF-8') . '"'
			. ' readonly' . $attr . ' />';

		if ($this->readonly === false)
		{
			$html[] = '		<a class="btn btn-primary modal_' . $this->id . '" title="' . JText::_('COM_TIMEWORKED_TASK_SELECT_PROJECT') . '" href="' . $link . '"'
				. ' rel="{handler: \'iframe\', size: {x: 800, y: 500}}">';
			$html[] = '<i class="icon-list"></i></a>';
		}

		$html[] = '</div>';

		// Create the real field, hidden, that stored the user id.
		$html[] = '<input type="hidden" id="' . $this->id . '_id" name="' . $this->name . '" value="' . $this->value . '" />';

		return implode("\n", $html);
	}
}
